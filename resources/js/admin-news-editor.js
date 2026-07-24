import Quill from 'quill';
import 'quill/dist/quill.snow.css';

/**
 * Quill treats normal formatting (bold, headings, lists, links, native
 * blockquote/image) as its own Delta model, which round-trips cleanly.
 * The site's custom blocks (callout box, collapsible accordion, video embed)
 * use Tailwind classes and Alpine.js directives Quill doesn't understand, so
 * they're registered as an opaque "raw HTML" embed blot: Quill stores and
 * moves it as a single atomic unit and never tries to reinterpret its
 * contents, so the markup survives edit/save/reload untouched.
 */
const BlockEmbed = Quill.import('blots/block/embed');

class RawHtmlBlot extends BlockEmbed {
    static create(value) {
        const node = super.create();
        node.innerHTML = value;
        node.setAttribute('contenteditable', 'false');
        return node;
    }

    static value(node) {
        return node.innerHTML;
    }
}
RawHtmlBlot.blotName = 'rawHtml';
RawHtmlBlot.tagName = 'div';
RawHtmlBlot.className = 'ql-raw-html-block';
Quill.register(RawHtmlBlot);

/**
 * Existing article content (built by hand across dozens of articles) mixes
 * plain paragraphs/headings/lists with custom blocks that carry Tailwind
 * classes, Alpine directives, or iframes. Feeding all of it through Quill's
 * normal HTML-to-Delta parser would strip anything it doesn't recognize —
 * so each top-level element is inspected, and only "complex" ones (that
 * would lose fidelity) are loaded as opaque raw-HTML blots; everything
 * plain loads through Quill's normal parser and stays natively editable.
 */
function loadExistingHtml(quill, html) {
    const container = document.createElement('div');
    container.innerHTML = html;

    // True if THIS element (not just its descendants) carries a class, style,
    // target/rel, or Alpine directive — any of which Quill's native parser
    // would silently drop.
    const hasComplexAttrs = (el) =>
        el.hasAttribute('class') || el.hasAttribute('style') || el.hasAttribute('target') || el.hasAttribute('rel')
        || Array.from(el.attributes).some((attr) => /^(x-|@|:)/.test(attr.name));

    // Complex if the element itself, or ANY descendant, carries one of those
    // attributes, or if an iframe appears anywhere in the subtree.
    const isComplex = (el) =>
        hasComplexAttrs(el) || el.querySelector('iframe') !== null || Array.from(el.querySelectorAll('*')).some(hasComplexAttrs);

    let simpleBuffer = '';
    const flushSimple = () => {
        if (!simpleBuffer) return;
        quill.clipboard.dangerouslyPasteHTML(Math.max(quill.getLength() - 1, 0), simpleBuffer);
        simpleBuffer = '';
    };

    Array.from(container.children).forEach((node) => {
        if (node.classList.contains('ql-raw-html-block')) {
            // Already a saved raw block from a previous edit — use its inner
            // content as the value directly, so re-editing doesn't nest a
            // fresh wrapper around an existing one.
            flushSimple();
            quill.insertEmbed(Math.max(quill.getLength() - 1, 0), 'rawHtml', node.innerHTML, 'silent');
        } else if (isComplex(node)) {
            flushSimple();
            quill.insertEmbed(Math.max(quill.getLength() - 1, 0), 'rawHtml', node.outerHTML, 'silent');
        } else {
            simpleBuffer += node.outerHTML;
        }
    });
    flushSimple();
}

/**
 * getSemanticHTML() serializes the live DOM, so raw-HTML embeds come back
 * wrapped in their .ql-raw-html-block container div (plus the
 * contenteditable attribute Quill adds for editing safety) — neither of
 * which belongs in the stored article content. Unwrap each one back to its
 * bare inner markup before saving.
 */
function unwrapRawHtmlBlocks(html) {
    const container = document.createElement('div');
    container.innerHTML = html;
    container.querySelectorAll('.ql-raw-html-block').forEach((block) => {
        block.replaceWith(...Array.from(block.childNodes));
    });
    // Raw blocks are contenteditable="false" and never touched by the
    // browser's text engine, so this can't affect them — but as soon as a
    // user clicks/types anywhere in the editor, the browser's contenteditable
    // silently rewrites plain spaces in surrounding text to non-breaking
    // spaces (U+00A0), which getSemanticHTML() then serializes as literal
    // "&nbsp;" entities. Left alone, every edit would replace normal spacing
    // with non-breaking spaces throughout the paragraph.
    return container.innerHTML.replace(/&nbsp;/g, ' ');
}

function initEditor(root) {
    const editorEl = root.querySelector('[data-quill-editor]');
    const toolbarEl = root.querySelector('[data-quill-toolbar]');
    const hiddenInput = root.querySelector('[data-quill-content]');
    if (!editorEl || !toolbarEl || !hiddenInput) return;

    const quill = new Quill(editorEl, {
        theme: 'snow',
        modules: {
            toolbar: toolbarEl,
        },
        placeholder: root.dataset.quillPlaceholder || 'Write your article content here...',
    });

    if (hiddenInput.value.trim()) {
        loadExistingHtml(quill, hiddenInput.value);
        quill.history.clear();
    }

    const syncHiddenInput = () => {
        // Quill documents always carry a trailing newline, so length <= 1 means
        // truly empty — checked by length (covers embeds like images/raw-html
        // blocks, which contribute to length but not to getText()).
        if (quill.getLength() <= 1) {
            hiddenInput.value = '';
            return;
        }
        const html = quill.getSemanticHTML ? quill.getSemanticHTML() : editorEl.querySelector('.ql-editor').innerHTML;
        hiddenInput.value = unwrapRawHtmlBlocks(html);
    };
    quill.on('text-change', syncHiddenInput);

    const form = root.closest('form');
    if (form) {
        form.addEventListener('submit', syncHiddenInput);
    }

    const insertRawHtml = (html) => {
        const range = quill.getSelection(true) || { index: quill.getLength(), length: 0 };
        quill.insertEmbed(range.index, 'rawHtml', html, 'user');
        quill.insertText(range.index + 1, '\n', 'user');
        quill.setSelection(range.index + 2, 0);
        syncHiddenInput();
    };

    // ── Image + caption ──
    const insertImage = (src, caption) => {
        const alt = (caption || '').replace(/"/g, '&quot;');
        const html = `<p><img src="${src}" alt="${alt}"></p>` +
            (caption ? `<p class="text-center text-sm italic">${caption}</p>` : '');
        insertRawHtml(html);
    };

    const insertImageBtn = root.querySelector('[data-action="insert-image"]');
    insertImageBtn?.addEventListener('click', () => {
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.accept = 'image/*';
        fileInput.style.display = 'none';
        document.body.appendChild(fileInput);

        fileInput.addEventListener('change', async () => {
            const file = fileInput.files[0];
            fileInput.remove();
            if (!file) return;

            const originalLabel = insertImageBtn.innerHTML;
            insertImageBtn.disabled = true;
            insertImageBtn.style.opacity = '0.6';

            try {
                const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
                const formData = new FormData();
                formData.append('image', file);

                const res = await fetch('/admin/news/upload-image', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' },
                    body: formData,
                });
                const data = await res.json().catch(() => ({}));
                if (!res.ok) {
                    throw new Error(data.errors?.image?.[0] || data.message || 'Upload failed');
                }

                const caption = prompt('Caption text (optional, shown centered under the image):') || '';
                insertImage(data.url, caption);
            } catch (err) {
                alert(err.message || 'Image upload failed. Please try again.');
            } finally {
                insertImageBtn.disabled = false;
                insertImageBtn.innerHTML = originalLabel;
                insertImageBtn.style.opacity = '';
            }
        });

        fileInput.click();
    });

    // ── Callout / pull-quote box ──
    root.querySelector('[data-action="insert-callout"]')?.addEventListener('click', () => {
        const text = prompt('Callout text:');
        if (!text) return;
        insertRawHtml(`<blockquote class="not-italic border-l-4 border-[#2d6fa3] bg-blue-50 pl-4 py-2 text-gray-700">${text}</blockquote>`);
    });

    // ── Collapsible "accordion" box ──
    root.querySelector('[data-action="insert-accordion"]')?.addEventListener('click', () => {
        const title = prompt('Box title (e.g. "About Krousar Thmey"):');
        if (!title) return;
        const body = prompt('Box text (shown when expanded):');
        if (!body) return;
        const html = `<div x-data="{ open: false }" class="not-prose bg-gray-50 rounded-2xl border border-gray-100 overflow-hidden my-8">
    <button @click="open = !open" type="button" class="w-full flex items-center justify-between p-5 text-left hover:bg-gray-100/50 transition-colors focus:outline-none">
        <span class="text-[#1a3c6e] font-bold text-sm">${title}</span>
        <svg class="w-5 h-5 text-[#1a3c6e] flex-shrink-0 transform transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
        </svg>
    </button>
    <div x-show="open" style="display:none;" class="px-5 pb-5 pt-1 border-t border-gray-200/50" x-transition>
        <p class="text-gray-700 text-sm leading-relaxed">${body}</p>
    </div>
</div>`;
        insertRawHtml(html);
    });

    // ── Video embed (Facebook or YouTube), with optional heading/subtitle ──
    root.querySelector('[data-action="insert-video"]')?.addEventListener('click', () => {
        const url = prompt('Video URL (Facebook watch/post link, or YouTube link):');
        if (!url) return;
        const heading = prompt('Heading above the video (optional, leave blank for none):') || '';
        const subtitle = heading ? (prompt('Subtitle under the heading (optional):') || '') : '';

        let iframeSrc;
        let allow;
        if (url.includes('facebook.com')) {
            iframeSrc = `https://www.facebook.com/plugins/video.php?href=${encodeURIComponent(url)}&show_text=false`;
            allow = 'autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share';
        } else if (url.includes('youtube.com') || url.includes('youtu.be')) {
            iframeSrc = url.replace('watch?v=', 'embed/').replace('youtu.be/', 'youtube.com/embed/');
            allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture';
        } else {
            alert('Only Facebook and YouTube links are supported for video embeds.');
            return;
        }

        const headingHtml = heading
            ? `<h3 class="text-lg font-bold text-[#1a3c6e] mb-1">${heading}</h3>${subtitle ? `<p class="text-sm text-gray-500 mb-4">${subtitle}</p>` : ''}`
            : '';

        const html = `<div class="not-prose my-8">
    ${headingHtml}
    <div class="relative w-full overflow-hidden rounded-lg" style="padding-top: 56.25%;">
        <iframe src="${iframeSrc}" class="absolute inset-0 w-full h-full" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen allow="${allow}"></iframe>
    </div>
</div>`;
        insertRawHtml(html);
    });

    // ── "Insert into article" buttons on already-uploaded gallery thumbnails ──
    document.querySelectorAll('[data-insert-image-src]').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const src = btn.getAttribute('data-insert-image-src');
            const caption = prompt('Caption text (optional, shown centered under the image):') || '';
            insertImage(src, caption);
        });
    });
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-quill-root]').forEach(initEditor);
});
