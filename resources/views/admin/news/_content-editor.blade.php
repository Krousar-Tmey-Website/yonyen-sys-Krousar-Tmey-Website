{{-- Rich text editor for the article content field, with one-click buttons
     for the site's recurring custom blocks. See resources/js/admin-news-editor.js. --}}
@php
    $name = $name ?? 'content';
    $placeholder = $placeholder ?? 'Write your article content here...';
@endphp
<div data-quill-root data-quill-placeholder="{{ $placeholder }}">
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
    </div>
    <div class="quill-insert-bar">
        <span class="quill-insert-label">Insert</span>
        <button type="button" class="quill-insert-btn" data-action="insert-image" title="Insert image + caption">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="9" cy="9" r="1.5"/><path stroke-linecap="round" stroke-linejoin="round" d="M21 15l-5-5L5 21"/></svg>
            Image
        </button>
        <button type="button" class="quill-insert-btn" data-action="insert-callout" title="Insert highlighted callout box">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 21c3 0 4-2 4-4V8a3 3 0 013-3h1m6 16c3 0 4-2 4-4V8a3 3 0 00-3-3h-1"/></svg>
            Callout
        </button>
        <button type="button" class="quill-insert-btn" data-action="insert-accordion" title="Insert collapsible box (e.g. About Krousar Thmey)">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><path stroke-linecap="round" stroke-linejoin="round" d="M8 10l4 4 4-4"/></svg>
            Box
        </button>
        <button type="button" class="quill-insert-btn" data-action="insert-video" title="Insert Facebook or YouTube video">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><path fill="currentColor" stroke="none" d="M10 9l5 3-5 3z"/></svg>
            Video
        </button>
    </div>
    <div data-quill-editor></div>
    <textarea name="{{ $name }}" data-quill-content class="hidden">{{ old($name, $contentValue ?? '') }}</textarea>
</div>
