// Wires plain <textarea data-ckeditor data-ckeditor-lang="en|fr"> elements up to a
// CKEditor 5 Classic instance. Used across the admin bilingual forms (EN/FR tabs).
// The admin panel's SPA-style navigation (see app.js) swaps page fragments via
// fetch instead of a full reload, so editors must be explicitly destroyed before
// their host textarea is removed from the DOM — otherwise CKEditor throws trying
// to reuse/re-render into a detached element, and instances would leak forever.
//
// Bundled via Vite (npm package `ckeditor5`) rather than the CDN "classic" build,
// because that prebuilt CDN bundle doesn't include the Font plugin (size/color/
// family) — the full plugin catalog is only available through real ES imports.
import {
    ClassicEditor,
    Essentials,
    Paragraph,
    Bold,
    Italic,
    Underline,
    Strikethrough,
    Heading,
    Link,
    List,
    ListProperties,
    BlockQuote,
    FontFamily,
    FontSize,
    FontColor,
    FontBackgroundColor,
    Alignment,
    Table,
    TableToolbar,
    RemoveFormat,
    HorizontalLine,
    Indent,
    IndentBlock,
    Image,
    ImageUpload,
    ImageToolbar,
    ImageStyle,
    ImageResize,
    Plugin,
    createDropdown,
    View
} from 'ckeditor5';
import 'ckeditor5/ckeditor5.css';
import enTranslations from 'ckeditor5/translations/en.js';
import frTranslations from 'ckeditor5/translations/fr.js';

const editorPromises = new WeakMap();

class CustomFontSize extends Plugin {
    init() {
        const editor = this.editor;
        editor.ui.componentFactory.add('customFontSize', locale => {
            const dropdownView = createDropdown(locale);
            const command = editor.commands.get('fontSize');

            dropdownView.bind('isEnabled').to(command);
            
            dropdownView.buttonView.set({
                withText: true,
                tooltip: 'Font Size',
                class: 'ck-custom-font-size-btn'
            });

            dropdownView.buttonView.bind('label').to(command, 'value', value => {
                return value ? value.replace('px', '') : 'Size';
            });

            class FormView extends View {
                constructor(locale) {
                    super(locale);
                    this.presetSizes = [8, 9, 10, 11, 12, 14, 16, 18, 20, 22, 24, 28, 32, 36, 48, 72];

                    this.setTemplate({
                        tag: 'div',
                        attributes: {
                            class: ['ck', 'ck-custom-font-size-panel'],
                            style: { padding: '10px', minWidth: '180px' }
                        },
                        children: [
                            {
                                tag: 'form',
                                attributes: { style: { display: 'flex', gap: '5px', marginBottom: '10px' } },
                                children: [
                                    {
                                        tag: 'input',
                                        attributes: {
                                            type: 'text',
                                            placeholder: 'e.g. 24',
                                            class: ['ck', 'ck-input', 'ck-input-text'],
                                            style: { width: '80px', flexGrow: '1' }
                                        }
                                    },
                                    {
                                        tag: 'button',
                                        attributes: {
                                            type: 'submit',
                                            class: ['ck', 'ck-button', 'ck-button_save']
                                        },
                                        children: [{ tag: 'span', attributes: { class: ['ck', 'ck-button__label'] }, children: ['Apply'] }]
                                    }
                                ]
                            },
                            {
                                tag: 'div',
                                attributes: {
                                    class: 'preset-grid',
                                    style: { 
                                        display: 'grid', 
                                        gridTemplateColumns: 'repeat(4, 1fr)', 
                                        gap: '2px', 
                                        borderTop: '1px solid var(--ck-color-base-border)', 
                                        paddingTop: '10px' 
                                    }
                                },
                                children: []
                            }
                        ]
                    });
                }
                
                render() {
                    super.render();
                    const form = this.element.querySelector('form');
                    form.addEventListener('submit', (e) => {
                        e.preventDefault();
                        this.fire('submit', this.inputValue);
                    });

                    const grid = this.element.querySelector('.preset-grid');
                    this.presetSizes.forEach(size => {
                        const btn = document.createElement('button');
                        btn.type = 'button';
                        btn.className = 'ck ck-button';
                        btn.style.padding = '4px 0';
                        btn.style.textAlign = 'center';
                        btn.style.minHeight = '24px';
                        
                        const span = document.createElement('span');
                        span.className = 'ck ck-button__label';
                        span.textContent = size;
                        btn.appendChild(span);

                        btn.addEventListener('click', (e) => {
                            e.preventDefault();
                            this.fire('submit', size.toString());
                        });
                        grid.appendChild(btn);
                    });
                }
                
                get inputValue() { return this.element.querySelector('input').value; }
                set inputValue(val) { this.element.querySelector('input').value = val; }
                focus() { this.element.querySelector('input').focus(); }
            }

            const formView = new FormView(locale);
            dropdownView.panelView.children.add(formView);

            formView.on('submit', (evt, size) => {
                dropdownView.isOpen = false;
                editor.editing.view.focus();

                if (size) {
                    const value = isNaN(size) ? size : size + 'px';
                    setTimeout(() => {
                        editor.execute('fontSize', { value });
                    }, 10);
                }
            });

            dropdownView.on('change:isOpen', () => {
                const selection = editor.model.document.selection;
                
                if (dropdownView.isOpen) {
                    // When opening, turn the current selection into a 'fake' selection 
                    // so it stays highlighted even when the input steals browser focus.
                    if (!selection.isCollapsed) {
                        const ranges = Array.from(selection.getRanges());
                        editor.model.change(writer => {
                            writer.setSelection(ranges, { backward: selection.isBackward, fake: true });
                        });
                    }

                    const currentVal = command.value ? command.value.replace('px', '') : '';
                    formView.inputValue = currentVal;
                    setTimeout(() => formView.focus(), 50);
                } else {
                    // When closing, remove the 'fake' flag so it becomes a normal native selection again
                    if (selection.isFake) {
                        const ranges = Array.from(selection.getRanges());
                        editor.model.change(writer => {
                            writer.setSelection(ranges, { backward: selection.isBackward });
                        });
                    }
                }
            });

            return dropdownView;
        });
    }
}

const PLUGINS = [
    Essentials, Paragraph, Bold, Italic, Underline, Strikethrough,
    Heading, Link, List, ListProperties, BlockQuote, FontFamily, FontSize, CustomFontSize, FontColor, FontBackgroundColor,
    Alignment, Table, TableToolbar, RemoveFormat, HorizontalLine, Indent, IndentBlock,
];

const TOOLBAR = [
    'heading', '|',
    'fontFamily', 'customFontSize', '|',
    'bold', 'italic', 'underline', 'strikethrough', 'removeFormat', '|',
    'fontColor', 'fontBackgroundColor', '|',
    'alignment', 'bulletedList', 'numberedList', 'outdent', 'indent', 'blockQuote', '|',
    'insertTable', 'horizontalLine', 'link', '|',
    'undo', 'redo',
];

const FONT_SIZES = [
    8, 9, 10, 11, 12, 13, 'default', 14, 15, 16, 17, 18, 19, 20, 22, 24, 26, 28, 30, 32, 34, 36, 40, 44, 48, 56, 64, 72
];

const FONT_FAMILIES = [
    'default',
    'Inter, sans-serif',
    'Arial, Helvetica, sans-serif',
    'Georgia, serif',
    'Times New Roman, Times, serif',
    'Courier New, Courier, monospace',
    'Verdana, Geneva, sans-serif',
    'Trebuchet MS, Helvetica, sans-serif',
    'Tahoma, Geneva, sans-serif',
    'Playfair Display, serif',
    'Montserrat, sans-serif',
    'Roboto, sans-serif',
];

const FONT_COLORS = [
    { color: '#000000', label: 'Black' },
    { color: '#1a1a1a', label: 'Dark Charcoal' },
    { color: '#4a4a4a', label: 'Dark Grey' },
    { color: '#71717a', label: 'Zinc Grey' },
    { color: '#a1a1aa', label: 'Light Grey' },
    { color: '#ffffff', label: 'White', hasBorder: true },
    { color: '#1a3c6e', label: 'Krousar Primary Dark' },
    { color: '#2d6fa3', label: 'Krousar Blue' },
    { color: '#0284c7', label: 'Sky Blue' },
    { color: '#0d9488', label: 'Teal' },
    { color: '#16a34a', label: 'Green' },
    { color: '#854d0e', label: 'Bronze Gold' },
    { color: '#ca8a04', label: 'Golden Yellow' },
    { color: '#ea580c', label: 'Orange' },
    { color: '#dc2626', label: 'Red' },
    { color: '#9333ea', label: 'Purple' },
    { color: '#db2777', label: 'Pink' },
];

function isVisible(el) {
    return !!(el.offsetWidth || el.offsetHeight || el.getClientRects().length);
}

// Uploads a single file to the given endpoint (e.g. admin.news.upload-image) and
// resolves to the { default: url } shape CKEditor's FileRepository expects.
class EndpointUploadAdapter {
    constructor(loader, uploadUrl) {
        this.loader = loader;
        this.uploadUrl = uploadUrl;
    }

    async upload() {
        const file = await this.loader.file;
        const body = new FormData();
        body.append('image', file);

        const response = await fetch(this.uploadUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                'Accept': 'application/json',
            },
            body,
        });

        if (!response.ok) {
            const problem = await response.json().catch(() => null);
            throw problem?.message || 'Image upload failed.';
        }

        const data = await response.json();
        return { default: data.url };
    }

    abort() {
        // Nothing to cancel — fetch() here isn't wired to an AbortController.
    }
}

function createEditor(textarea) {
    if (editorPromises.has(textarea)) {
        return;
    }

    // Skip hidden textareas — CKEditor renders at zero height inside display:none.
    // initCKEditors() is called again after each language tab switch.
    if (!isVisible(textarea)) {
        return;
    }

    const lang = textarea.dataset.ckeditorLang === 'fr' ? 'fr' : 'en';
    const placeholder = textarea.getAttribute('placeholder') || '';
    const uploadUrl = textarea.dataset.ckeditorUploadUrl || null;

    const plugins = uploadUrl
        ? [...PLUGINS, Image, ImageUpload, ImageToolbar, ImageStyle, ImageResize]
        : PLUGINS;
    const toolbar = uploadUrl
        ? [...TOOLBAR.slice(0, -3), 'uploadImage', ...TOOLBAR.slice(-3)]
        : TOOLBAR;

    const promise = ClassicEditor.create(textarea, {
        licenseKey: 'GPL',
        plugins,
        toolbar,
        language: lang,
        translations: [enTranslations, frTranslations],
        placeholder,
        fontSize: { options: FONT_SIZES, supportAllValues: true },
        fontFamily: { options: FONT_FAMILIES, supportAllValues: true },
        fontColor: { colors: FONT_COLORS, columns: 6, colorPicker: { format: 'hex' } },
        fontBackgroundColor: { colors: FONT_COLORS, columns: 6, colorPicker: { format: 'hex' } },
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        table: {
            contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
        },
        ...(uploadUrl ? { image: { toolbar: ['imageStyle:inline', 'imageStyle:block', 'imageStyle:side', '|', 'resizeImage'] } } : {})
    })
        .then((editor) => {
            if (uploadUrl) {
                editor.plugins.get('FileRepository').createUploadAdapter = (loader) => new EndpointUploadAdapter(loader, uploadUrl);
            }

            editor.model.document.on('change:data', () => {
                textarea.value = editor.getData();
                textarea.dispatchEvent(new Event('input', { bubbles: true }));
            });
            return editor;
        })
        .catch((error) => {
            console.error('CKEditor failed to initialize:', error);
        });

    editorPromises.set(textarea, promise);
}

function destroyEditor(textarea) {
    const promise = editorPromises.get(textarea);
    if (!promise) {
        return;
    }
    editorPromises.delete(textarea);
    promise.then((editor) => editor?.destroy?.()).catch(() => {});
}

export function initCKEditors(root = document) {
    root.querySelectorAll('textarea[data-ckeditor]').forEach(createEditor);
}

export function destroyCKEditors(root = document) {
    root.querySelectorAll('textarea[data-ckeditor]').forEach(destroyEditor);
}

// For Alpine x-model driven modals (e.g. an "edit" modal reused for every row):
// when the modal is opened with a different record's data, the underlying
// textarea's value is replaced programmatically rather than typed, and CKEditor
// has no way to know that happened on its own — call this right after such an
// assignment (wrap in $nextTick so the textarea exists/has its new value first).
export function setCKEditorContent(textarea, html) {
    if (!textarea) return;
    const promise = editorPromises.get(textarea);
    if (!promise) {
        textarea.value = html ?? '';
        return;
    }
    promise.then((editor) => {
        if (editor) editor.setData(html ?? '');
    });
}

window.setCKEditorContent = setCKEditorContent;

// For Alpine-driven tab switches (e.g. the Donate page content tabs on the
// Payment Methods admin screen): panels hidden via x-show are display:none at
// load, so their CKEditor textareas get skipped by initCKEditors(). Call this
// after the tab becomes visible (wrap in requestAnimationFrame so Alpine has
// applied the style change first) to initialize any editors that were skipped.
window.initCKEditors = initCKEditors;
