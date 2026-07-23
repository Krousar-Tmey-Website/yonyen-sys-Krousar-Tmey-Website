import {
    Alignment,
    Autoformat,
    AutoImage,
    AutoLink,
    Bold,
    ClassicEditor,
    Essentials,
    Font,
    GeneralHtmlSupport,
    Heading,
    Image,
    ImageCaption,
    ImageResize,
    ImageStyle,
    ImageToolbar,
    ImageUpload,
    Italic,
    Link,
    List,
    Paragraph,
    PasteFromOffice,
    SimpleUploadAdapter,
    Table,
    TableToolbar,
    Underline,
} from 'ckeditor5';
import 'ckeditor5/ckeditor5.css';

const editorInstances = new WeakMap();

function uploadUrl() {
    return document.querySelector('meta[name="ckeditor-upload-url"]')?.content || '/admin/editor/upload-image';
}

function csrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.content || '';
}

function initEditor(textarea) {
    if (editorInstances.has(textarea)) return;

    ClassicEditor.create(textarea, {
        licenseKey: 'GPL',
        plugins: [
            Alignment,
            Autoformat,
            AutoImage,
            AutoLink,
            Bold,
            Essentials,
            Font,
            GeneralHtmlSupport,
            Heading,
            Image,
            ImageCaption,
            ImageResize,
            ImageStyle,
            ImageToolbar,
            ImageUpload,
            Italic,
            Link,
            List,
            Paragraph,
            PasteFromOffice,
            SimpleUploadAdapter,
            Table,
            TableToolbar,
            Underline,
        ],
        toolbar: {
            items: [
                'heading',
                '|',
                'bold',
                'italic',
                'underline',
                '|',
                'fontFamily',
                'fontSize',
                'fontColor',
                'fontBackgroundColor',
                '|',
                'alignment',
                '|',
                'bulletedList',
                'numberedList',
                '|',
                'link',
                'insertTable',
                'uploadImage',
                '|',
                'undo',
                'redo',
            ],
            shouldNotGroupWhenFull: true,
        },
        fontFamily: {
            supportAllValues: false,
            options: [
                'default',
                'Inter, Arial, sans-serif',
                'Arial, Helvetica, sans-serif',
                'Georgia, serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
            ],
        },
        fontSize: {
            supportAllValues: false,
            options: [ 'tiny', 'small', 'default', 'big', 'huge' ],
        },
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
            ],
        },
        image: {
            toolbar: [
                'imageStyle:inline',
                'imageStyle:block',
                'imageStyle:side',
                '|',
                'toggleImageCaption',
                'imageTextAlternative',
                '|',
                'resizeImage',
            ],
        },
        table: {
            contentToolbar: [ 'tableColumn', 'tableRow', 'mergeTableCells' ],
        },
        link: {
            addTargetToExternalLinks: true,
            defaultProtocol: 'https://',
        },
        simpleUpload: {
            uploadUrl: uploadUrl(),
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken(),
                'X-Requested-With': 'XMLHttpRequest',
            },
        },
        htmlSupport: {
            allow: [
                {
                    name: /^(p|h1|h2|h3|h4|h5|h6|span|figure|figcaption|img|table|thead|tbody|tfoot|tr|td|th|ul|ol|li|blockquote|a|strong|em|u|br|hr)$/,
                    classes: true,
                    styles: true,
                    attributes: {
                        href: true,
                        src: true,
                        alt: true,
                        title: true,
                        target: true,
                        rel: true,
                        colspan: true,
                        rowspan: true,
                    },
                },
            ],
        },
    }).then((editor) => {
        editorInstances.set(textarea, editor);

        const form = textarea.closest('form');
        form?.addEventListener('submit', () => {
            editor.updateSourceElement();
        });
    }).catch((error) => {
        console.error('CKEditor initialization failed:', error);
    });
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('textarea[data-ckeditor]').forEach(initEditor);
});
