{{-- Rich text editor for the article content field, with one-click buttons
     for the site's recurring custom blocks. See resources/js/admin-news-editor.js. --}}
<div data-quill-root>
    <div data-quill-toolbar>
        <span class="ql-formats">
            <button class="ql-bold"></button>
            <button class="ql-italic"></button>
        </span>
        <span class="ql-formats">
            <select class="ql-header">
                <option value="2"></option>
                <option value="3"></option>
                <option selected></option>
            </select>
        </span>
        <span class="ql-formats">
            <button class="ql-blockquote"></button>
            <button class="ql-link"></button>
            <button class="ql-list" value="ordered"></button>
            <button class="ql-list" value="bullet"></button>
        </span>
        <span class="ql-formats">
            <button class="ql-clean"></button>
        </span>
        <span class="ql-formats">
            <button type="button" data-action="insert-image" title="Insert image + caption">🖼️ Image</button>
            <button type="button" data-action="insert-callout" title="Insert highlighted callout box">❝ Callout</button>
            <button type="button" data-action="insert-accordion" title="Insert collapsible box (e.g. About Krousar Thmey)">▾ Box</button>
            <button type="button" data-action="insert-video" title="Insert Facebook or YouTube video">▶ Video</button>
        </span>
    </div>
    <div data-quill-editor></div>
    <textarea name="content" data-quill-content class="hidden">{{ old('content', $contentValue ?? '') }}</textarea>
</div>
