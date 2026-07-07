@extends('admin.layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('title', 'Edit Article')
@section('page-title', 'Edit Article')
@section('breadcrumb', 'News → ' . Str::limit($news->title, 40))

@section('content')

<style>
    /* Clean Form Styles */
    .form-container {
        max-width: 100%;
        padding: 0;
        background: #f8f9fa;
        min-height: 100vh;
    }

    .form-card {
        background: #ffffff;
        border: none;
        border-bottom: 1px solid #e9ecef;
        overflow: hidden;
    }
    .form-card:last-child {
        border-bottom: none;
    }

    .card-header {
        padding: 14px 24px;
        background: #fafbfc;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-header .icon {
        width: 28px;
        height: 28px;
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .card-header .icon.blue { background: #e3f0ff; color: #1a73e8; }
    .card-header .icon.purple { background: #f0e6ff; color: #7c3aed; }
    .card-header .icon.green { background: #e3f5e3; color: #16a34a; }
    .card-header .icon.orange { background: #fef3e2; color: #ea580c; }

    .card-header .icon svg {
        width: 16px;
        height: 16px;
    }

    .card-header h3 {
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
    }

    .card-header .badge {
        font-size: 11px;
        color: #94a3b8;
        margin-left: auto;
        background: #f1f4f9;
        padding: 2px 12px;
        border-radius: 12px;
    }

    .card-body {
        padding: 20px 24px;
    }

    .form-group {
        margin-bottom: 16px;
    }
    .form-group:last-child {
        margin-bottom: 0;
    }

    .form-label {
        display: block;
        font-size: 13px;
        font-weight: 500;
        color: #334155;
        margin-bottom: 5px;
    }
    .form-label .required {
        color: #ef4444;
    }
    .form-label .optional {
        font-weight: 400;
        color: #94a3b8;
        font-size: 12px;
    }

    .form-control {
        width: 100%;
        padding: 9px 14px;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        transition: all 0.2s;
        background: #fafbfc;
        color: #0f172a;
    }
    .form-control:focus {
        outline: none;
        border-color: #2d6fa3;
        box-shadow: 0 0 0 3px rgba(45, 111, 163, 0.08);
        background: #ffffff;
    }
    .form-control:hover {
        background: #ffffff;
    }
    .form-control::placeholder {
        color: #a0aec0;
    }
    .form-control.error {
        border-color: #ef4444;
        background: #fef2f2;
    }

    .form-control.textarea {
        min-height: 80px;
        resize: vertical;
        line-height: 1.6;
    }
    .form-control.content {
        min-height: 350px;
        resize: vertical;
        line-height: 1.8;
        background: #fafbfc;
    }
    .form-control.content:focus {
        background: #ffffff;
    }

    .form-helper {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 5px;
    }

    .form-error {
        font-size: 12px;
        color: #ef4444;
        margin-top: 4px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }
        .card-body {
            padding: 16px;
        }
        .card-header {
            padding: 12px 16px;
        }
        .form-actions {
            flex-direction: column;
            align-items: stretch !important;
            padding: 16px !important;
        }
        .form-actions .btn-primary,
        .form-actions .btn-cancel,
        .form-actions .btn-danger {
            justify-content: center;
            width: 100%;
        }
        .form-status {
            text-align: center;
            margin-left: 0 !important;
        }
    }

    /* Upload Area */
    .upload-area {
        border: 2px dashed #e2e8f0;
        border-radius: 8px;
        padding: 28px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #fafbfc;
    }
    .upload-area:hover {
        border-color: #2d6fa3;
        background: #f1f5f9;
    }
    .upload-area .upload-icon {
        width: 40px;
        height: 40px;
        color: #cbd5e1;
        margin: 0 auto 10px;
        transition: color 0.3s;
    }
    .upload-area:hover .upload-icon {
        color: #2d6fa3;
    }
    .upload-area .upload-title {
        font-size: 14px;
        color: #64748b;
    }
    .upload-area .upload-subtitle {
        font-size: 12px;
        color: #94a3b8;
        margin-top: 4px;
    }

    /* Current Image */
    .current-image {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 12px 16px;
        background: #fafbfc;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
    }
    .current-image img {
        height: 80px;
        width: auto;
        border-radius: 6px;
        border: 1px solid #e2e8f0;
        object-fit: cover;
    }
    .current-image .image-info {
        font-size: 13px;
        color: #64748b;
    }
    .current-image .image-info strong {
        color: #1e293b;
    }

    /* Publishing */
    .publish-option {
        padding: 12px 18px;
        background: #fafbfc;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .publish-option input[type="checkbox"] {
        width: 18px;
        height: 18px;
        accent-color: #2d6fa3;
        cursor: pointer;
        flex-shrink: 0;
    }
    .publish-option .label {
        font-size: 14px;
        font-weight: 500;
        color: #1e293b;
    }
    .publish-option .description {
        font-size: 12px;
        color: #94a3b8;
    }

    .info-box {
        padding: 12px 18px;
        background: #eff6ff;
        border-radius: 8px;
        border: 1px solid #dbeafe;
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }
    .info-box .info-icon {
        color: #3b82f6;
        flex-shrink: 0;
        margin-top: 1px;
        width: 18px;
        height: 18px;
    }
    .info-box .info-title {
        font-size: 13px;
        font-weight: 500;
        color: #1e40af;
    }
    .info-box .info-desc {
        font-size: 12px;
        color: #3b82f6;
        opacity: 0.8;
    }

    /* Actions */
    .form-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 12px;
        padding: 16px 24px;
        background: #fafbfc;
        border-top: 1px solid #e9ecef;
    }

    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 28px;
        background: #2d6fa3;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-primary:hover {
        background: #1a4a7a;
        transform: translateY(-1px);
    }
    .btn-primary svg {
        width: 18px;
        height: 18px;
    }

    .btn-cancel {
        padding: 10px 20px;
        color: #64748b;
        font-size: 14px;
        font-weight: 500;
        background: none;
        border: none;
        cursor: pointer;
        border-radius: 6px;
    }
    .btn-cancel:hover {
        color: #0f172a;
        background: #f1f5f9;
    }

    .btn-danger {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        color: #dc2626;
        font-size: 14px;
        font-weight: 500;
        background: none;
        border: none;
        cursor: pointer;
        border-radius: 6px;
        transition: all 0.2s;
        margin-left: auto;
    }
    .btn-danger:hover {
        color: #b91c1c;
        background: #fef2f2;
    }
    .btn-danger svg {
        width: 18px;
        height: 18px;
    }

    .form-status {
        font-size: 12px;
        color: #94a3b8;
        margin-left: auto;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .form-status .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #22c55e;
        display: inline-block;
    }

    /* Image Preview */
    .image-preview-wrapper {
        position: relative;
        display: inline-block;
    }
    .image-preview-wrapper img {
        height: 140px;
        width: auto;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        object-fit: cover;
    }
    .image-preview-wrapper .remove-btn {
        position: absolute;
        top: -8px;
        right: -8px;
        width: 26px;
        height: 26px;
        background: #ef4444;
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    .image-preview-wrapper .remove-btn:hover {
        background: #dc2626;
        transform: scale(1.1);
    }
    .image-preview-wrapper .file-info {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 6px;
        text-align: center;
    }

    /* Select */
    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 10 10'%3E%3Cpath fill='%2364748b' d='M5 7L1 3h8z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 36px;
        cursor: pointer;
    }

    /* Link Management */
    .link-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        margin-bottom: 8px;
        transition: all 0.2s;
    }
    .link-item:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
    }
    .link-item .link-url {
        flex: 1;
        color: #2563eb;
        text-decoration: none;
        font-size: 13px;
        word-break: break-all;
    }
    .link-item .link-url:hover {
        text-decoration: underline;
    }
    .link-item .link-title {
        font-weight: 500;
        color: #1e293b;
        font-size: 13px;
        min-width: 120px;
    }
    .link-item .remove-link {
        background: none;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        padding: 4px 8px;
        border-radius: 4px;
        transition: all 0.2s;
        font-size: 16px;
    }
    .link-item .remove-link:hover {
        color: #ef4444;
        background: #fef2f2;
    }
    .link-item .link-badge {
        font-size: 10px;
        background: #dbeafe;
        color: #1e40af;
        padding: 2px 10px;
        border-radius: 12px;
        font-weight: 500;
    }
    .link-input-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    .link-input-group .form-control {
        flex: 1;
        min-width: 150px;
    }
    .link-input-group .btn-add-link {
        padding: 9px 20px;
        background: #2d6fa3;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 500;
        font-size: 13px;
        white-space: nowrap;
        transition: all 0.2s;
    }
    .link-input-group .btn-add-link:hover {
        background: #1a4a7a;
    }
    .links-container {
        margin-top: 10px;
        max-height: 200px;
        overflow-y: auto;
    }
    .links-container:empty {
        display: none;
    }
    .no-links {
        color: #94a3b8;
        font-size: 13px;
        text-align: center;
        padding: 16px;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px dashed #e2e8f0;
    }
</style>

<div class="form-container">
    <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data" id="articleForm">
        @csrf @method('PUT')

        {{-- Article Details --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <h3>Article Details</h3>
                <span class="badge">Required *</span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Title <span class="required">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $news->title) }}" required
                           class="form-control @error('title') error @enderror"
                           placeholder="Enter article title...">
                    @error('title')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Used as page title and URL slug.</div>
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Category <span class="required">*</span></label>
                        <select name="category" required
                                class="form-control @error('category') error @enderror">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
<option value="{{ $category->CategoryName }}" {{ old('category', $news->category_name) == $category->CategoryName ? 'selected' : '' }}>
    {{ $category->CategoryName }}
</option>
                            @endforeach
                        </select>
                        @error('category')<div class="form-error">{{ $message }}</div>@enderror
                        <div class="form-helper">Select from created categories, or <a href="{{ route('admin.categories.create') }}" target="_blank">create a new one</a>.</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tags <span class="optional">(comma separated)</span></label>
                        <input type="text" name="tags" value="{{ old('tags', $news->tags) }}"
                               class="form-control" placeholder="e.g. Cambodia, Child welfare">
                        @error('tags')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Excerpt <span class="optional">(optional)</span></label>
                    <textarea name="excerpt" rows="3" class="form-control textarea"
                              placeholder="Short summary for article cards...">{{ old('excerpt', $news->excerpt) }}</textarea>
                    <div class="form-helper">Recommended: 120-160 characters.</div>
                    @error('excerpt')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon purple">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                </div>
                <h3>Content</h3>
            </div>
            <div class="card-body">
                <div class="form-group" style="margin-bottom: 0;">
                    <textarea name="content" rows="16" class="form-control content"
                              placeholder="Write your article content here...">{{ old('content', $news->content) }}</textarea>
                    @error('content')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Links Section --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon orange">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                </div>
                <h3>Related Links</h3>
                <span class="badge">Optional</span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Add a Link</label>
                    <div class="link-input-group">
                        <input type="text" id="linkTitle" class="form-control" placeholder="Link title (e.g. Krousar Thmey)">
                        <input type="url" id="linkUrl" class="form-control" placeholder="https://example.com">
                        <button type="button" class="btn-add-link" onclick="addLink()">Add Link</button>
                    </div>
                    <div class="form-helper">Add related links that will appear in the article.</div>
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Added Links</label>
                    <div class="links-container" id="linksContainer">
                        @if(!empty($news->links))
                            @foreach($news->links as $link)
                            <div class="link-item">
                                <span class="link-title">{{ $link['title'] ?? 'Link' }}</span>
                                <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer" class="link-url">{{ $link['url'] }}</a>
                                <span class="link-badge">Link</span>
                                <button type="button" class="remove-link" onclick="removeLink({{ $loop->index }})" title="Remove link">×</button>
                            </div>
                            @endforeach
                        @else
                            <div class="no-links" id="noLinks">No links added yet. Add a link above.</div>
                        @endif
                    </div>
                    <input type="hidden" name="links" id="linksInput" value="{{ !empty($news->links) ? json_encode($news->links) : '' }}">
                    @error('links')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Image & Publishing --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon green">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3>Image & Publishing</h3>
            </div>
            <div class="card-body">
                {{-- Current Image --}}
                @if($news->image)
                <div class="form-group">
                    <label class="form-label">Current Image</label>
                    <div class="current-image">
                        <img src="{{ $news->image_url }}" alt="Current image">
                        <div class="image-info">
                            <strong>Current cover image</strong>
                            <div style="font-size:12px; color:#94a3b8; margin-top:2px;">Replace below if needed</div>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Image Upload --}}
                <div class="form-group">
                    <label class="form-label">Cover Image <span class="optional">(optional)</span></label>
                    <div class="upload-area" onclick="document.getElementById('imageInput').click()">
                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden">
                        <div id="imagePlaceholder">
                            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div class="upload-title">{{ $news->image ? 'Replace image' : 'Click to upload' }}</div>
                            <div class="upload-subtitle">Max 2MB. JPG, PNG, or WebP</div>
                        </div>
                        <div id="imagePreview" class="hidden mt-3"></div>
                    </div>
                    @error('image')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                {{-- Publishing Options --}}
                <div class="form-group" style="margin-bottom: 0;">
                    <div class="form-grid">
                        <div class="publish-option">
                            <input type="checkbox" name="is_published" id="is_published" value="1" 
                                   {{ old('is_published', $news->is_published) ? 'checked' : '' }}>
                            <div>
                                <div class="label">Published</div>
                                <div class="description">Uncheck to save as draft</div>
                            </div>
                        </div>
                        <div class="info-box">
                            <svg class="info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <div>
                                <div class="info-title">Draft vs Published</div>
                                <div class="info-desc">Drafts are only visible to admins.</div>
                                @if($news->published_at)
                                <div style="font-size:11px; color:#3b82f6; opacity:0.6; margin-top:2px;">
                                    Published since {{ $news->published_at->format('d M Y') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Update Article
            </button>
            <a href="{{ route('admin.news.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

{{-- Delete Form (separate from main form) --}}
<div class="form-actions" style="justify-content: flex-end; margin-top: 16px;">
    <form action="{{ route('admin.news.destroy', $news) }}" method="POST"
          onsubmit="return confirm('⚠️ Permanently delete this article?\n\nThis action cannot be undone.')"
          class="inline delete-form">
        @csrf @method('DELETE')
        <button type="submit" class="btn-danger delete-btn">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            Delete Article
        </button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imageInput');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            const placeholder = document.getElementById('imagePlaceholder');
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    placeholder.classList.add('hidden');
                    preview.classList.remove('hidden');
                    preview.innerHTML = `
                        <div class="image-preview-wrapper">
                            <img src="${e.target.result}" alt="Preview">
                            <button type="button" class="remove-btn" 
                                    onclick="document.getElementById('imageInput').value=''; preview.innerHTML=''; preview.classList.add('hidden'); placeholder.classList.remove('hidden');">
                                ×
                            </button>
                            <div class="file-info">${file.name} (${(file.size / 1024).toFixed(1)} KB)</div>
                        </div>
                    `;
                };
                reader.readAsDataURL(file);
            }
        });
    }
    
    // Enter key support for adding links
    const linkUrl = document.getElementById('linkUrl');
    const linkTitle = document.getElementById('linkTitle');
    
    if (linkUrl) {
        linkUrl.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addLink();
            }
        });
    }
    
    if (linkTitle) {
        linkTitle.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('linkUrl').focus();
            }
        });
    }
    
    // Form submission - ensure links are saved
    const articleForm = document.getElementById('articleForm');
    if (articleForm) {
        articleForm.addEventListener('submit', function(e) {
            document.getElementById('linksInput').value = JSON.stringify(links);
        });
    }
});

// ====== LINK MANAGEMENT ======

let links = {!! !empty($news->links) ? json_encode($news->links) : '[]' !!};

function addLink() {
    const titleInput = document.getElementById('linkTitle');
    const urlInput = document.getElementById('linkUrl');
    
    const linkTitle = titleInput.value.trim();
    const linkUrl = urlInput.value.trim();
    
    if (!linkUrl) {
        alert('Please enter a URL.');
        return;
    }
    
    if (!linkTitle) {
        alert('Please enter a title for the link.');
        return;
    }
    
    // Validate URL
    try {
        new URL(linkUrl);
    } catch (e) {
        alert('Please enter a valid URL (including http:// or https://).');
        return;
    }
    
    // Check for duplicate
    if (links.some(link => link.url === linkUrl)) {
        alert('This link has already been added.');
        return;
    }
    
    // Add to links array
    links.push({ title: linkTitle, url: linkUrl });
    
    // Update the UI
    renderLinks();
    
    // Clear inputs
    titleInput.value = '';
    urlInput.value = '';
    titleInput.focus();
}

function removeLink(index) {
    links.splice(index, 1);
    renderLinks();
}

function renderLinks() {
    const container = document.getElementById('linksContainer');
    const noLinks = document.getElementById('noLinks');
    const linksInput = document.getElementById('linksInput');
    
    if (links.length === 0) {
        if (!noLinks) {
            const div = document.createElement('div');
            div.className = 'no-links';
            div.id = 'noLinks';
            div.textContent = 'No links added yet. Add a link above.';
            container.appendChild(div);
        }
        linksInput.value = '';
        return;
    }
    
    // Remove "no links" message
    const noLinksEl = document.getElementById('noLinks');
    if (noLinksEl) noLinksEl.remove();
    
    // Build HTML
    let html = '';
    links.forEach((link, index) => {
        html += `
            <div class="link-item">
                <span class="link-title">${escapeHtml(link.title)}</span>
                <a href="${escapeHtml(link.url)}" target="_blank" rel="noopener noreferrer" class="link-url">${escapeHtml(link.url)}</a>
                <span class="link-badge">Link</span>
                <button type="button" class="remove-link" onclick="removeLink(${index})" title="Remove link">×</button>
            </div>
        `;
    });
    container.innerHTML = html;
    
    // Update hidden input
    linksInput.value = JSON.stringify(links);
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

</script>

@endsection
