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
    BlockQuote,
    Font,
    Alignment,
} from 'ckeditor5';
import 'ckeditor5/ckeditor5.css';

const editorPromises = new WeakMap();

const PLUGINS = [
    Essentials, Paragraph, Bold, Italic, Underline, Strikethrough,
    Heading, Link, List, BlockQuote, Font, Alignment,
];

const TOOLBAR = [
    'heading', '|',
    'fontFamily', 'fontSize', '|',
    'bold', 'italic', 'underline', 'strikethrough', '|',
    'fontColor', 'fontBackgroundColor', '|',
    'alignment', 'bulletedList', 'numberedList', 'blockQuote', 'link', '|',
    'undo', 'redo',
];

const FONT_SIZES = [10, 12, 14, 'default', 18, 20, 24, 28, 32, 40];

const FONT_COLORS = [
    { color: '#000000', label: 'Black' },
    { color: '#4a4a4a', label: 'Dark Grey' },
    { color: '#8a8a8a', label: 'Grey' },
    { color: '#ffffff', label: 'White', hasBorder: true },
    { color: '#e03131', label: 'Red' },
    { color: '#e8590c', label: 'Orange' },
    { color: '#e8a020', label: 'Gold' },
    { color: '#2f9e44', label: 'Green' },
    { color: '#1d4e7a', label: 'Navy' },
    { color: '#2d6fa3', label: 'Blue' },
    { color: '#8da83a', label: 'Olive' },
    { color: '#9c36b5', label: 'Purple' },
];

function createEditor(textarea) {
    if (editorPromises.has(textarea)) {
        return;
    }

    const lang = textarea.dataset.ckeditorLang === 'fr' ? 'fr' : 'en';
    const placeholder = textarea.getAttribute('placeholder') || '';

    const promise = ClassicEditor.create(textarea, {
        licenseKey: 'GPL',
        plugins: PLUGINS,
        toolbar: TOOLBAR,
        language: lang,
        placeholder,
        fontSize: { options: FONT_SIZES, supportAllValues: true },
        fontFamily: {
            options: [
                'default',
                'Inter, sans-serif',
                'Arial, Helvetica, sans-serif',
                'Georgia, serif',
                'Times New Roman, serif',
                'Courier New, monospace',
            ],
            supportAllValues: true,
        },
        fontColor: { colors: FONT_COLORS, columns: 6 },
        fontBackgroundColor: { colors: FONT_COLORS, columns: 6 },
    })
        .then((editor) => {
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
