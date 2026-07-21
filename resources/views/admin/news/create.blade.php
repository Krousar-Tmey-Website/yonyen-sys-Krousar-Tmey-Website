@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-news.css'])
@endpush

@section('title', 'Create Article')
@section('page-title', 'Create Article')
@section('breadcrumb', 'News → Create Article')

@section('content')
@php use Illuminate\Support\Str; @endphp

<div class="max-w-3xl mx-auto">
    <form id="articleForm" action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" data-news-ajax-form>
        @csrf

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
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="form-control @error('title') error @enderror"
                           placeholder="Enter article title...">
                    @error('title')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Used as page title and URL slug.</div>
                </div>

                <div class="form-group form-group--no-margin">
                    <label class="form-label">Excerpt <span class="optional">(optional)</span></label>
                    <textarea name="excerpt" rows="3" class="form-control textarea"
                              placeholder="Short summary for article cards...">{{ old('excerpt') }}</textarea>
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
                <div class="form-group form-group--no-margin">
                    @include('admin.news._content-editor')
                    @error('content')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Tags Section --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon purple">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <h3>Tags</h3>
                <span class="badge">Optional</span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Quick Add <span class="optional">(common categories)</span></label>
                    <div class="quick-tags-row" id="presetTagButtons"></div>
                    <div class="form-helper">Click to instantly add a common category. You can still edit or remove it below.</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Add a Custom Tag</label>
                    <div class="link-input-group">
                        <input type="text" id="tagLabel" class="form-control" placeholder="Tag label (e.g. Cambodia)">
                        <input type="url" id="tagUrl" class="form-control" placeholder="Link URL (optional)">
                        <button type="button" class="btn-add-link" onclick="addTagLink()">Add Tag</button>
                    </div>
                    <div class="form-helper">Shown on the article card and byline. The URL is optional — leave it blank for a plain (non-clickable) tag.</div>
                </div>

                <div class="form-group form-group--no-margin">
                    <label class="form-label">Added Tags</label>
                    <div class="links-container" id="tagLinksContainer">
                        <div class="no-links" id="noTagLinks">No tags added yet. Add one above.</div>
                    </div>
                    <input type="hidden" name="tag_links" id="tagLinksInput" value="">
                    @error('tag_links')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Image, Gallery, Videos & Publishing --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon green">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3>Image, Gallery & Videos</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Cover Image <span class="optional">(optional)</span></label>
                    <div class="upload-area" onclick="document.getElementById('imageInput').click()">
                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden">
                        <div id="imagePlaceholder">
                            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div class="upload-title">Click to upload</div>
                            <div class="upload-subtitle">Max 2MB. JPG, PNG, or WebP</div>
                        </div>
                        <div id="imagePreview" class="hidden mt-3"></div>
                    </div>
                    @error('image')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Video <span class="optional">(optional, multiple allowed)</span></label>
                    <div class="upload-area" onclick="document.getElementById('videosInput').click()">
                        <input type="file" name="videos[]" id="videosInput" accept="video/mp4,video/quicktime,video/webm" multiple class="hidden">
                        <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        <div class="upload-title">Click to upload a video</div>
                        <div class="upload-subtitle">Max 35MB each. MP4, MOV, or WebM.</div>
                    </div>
                    <div class="video-preview-list" id="videoPreviewList"></div>
                    @error('videos')<div class="form-error">{{ $message }}</div>@enderror
                    @error('videos.*')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Video Link <span class="optional">(optional)</span></label>
                    <input type="url" name="video_url" value="{{ old('video_url') }}"
                           class="form-control @error('video_url') error @enderror"
                           placeholder="https://www.facebook.com/watch/?v=...">
                    @error('video_url')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Paste a Facebook or YouTube video link to embed it on the article page.</div>
                </div>

                <div class="form-group form-group--no-margin">
                    <div class="form-grid">
                        <div class="publish-option">
                            <input type="checkbox" name="is_published" id="is_published" value="1"
                                   {{ old('is_published') ? 'checked' : '' }}>
                            <div>
                                <div class="label">Published</div>
                                <div class="description">Uncheck to save as draft</div>
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
                Create Article
            </button>
            <a href="{{ route('admin.news.index') }}" class="btn-cancel">Cancel</a>
            <span class="form-status" data-news-form-status>
                <span class="dot"></span>
                Ready to save
            </span>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image preview
    const imageInput = document.getElementById('imageInput');
    if (imageInput) {
        imageInput.addEventListener('change', function(e) {
            const preview = document.getElementById('imagePreview');
            const placeholder = document.getElementById('imagePlaceholder');
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    placeholder.classList.add('hidden');
                    preview.classList.remove('hidden');
                    preview.innerHTML = '<div class="image-preview-wrapper"><img src="' + ev.target.result + '" alt="Preview"><button type="button" class="remove-btn" onclick="this.closest(\'.image-preview-wrapper\').remove();document.getElementById(\'imageInput\').value=\'\';document.getElementById(\'imagePlaceholder\').classList.remove(\'hidden\');">x</button><div class="file-info">' + file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)</div></div>';
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Video upload preview (multiple files, listed by name/size)
    const videosInput = document.getElementById('videosInput');
    if (videosInput) {
        videosInput.addEventListener('change', function(e) {
            const list = document.getElementById('videoPreviewList');
            list.innerHTML = '';
            [...e.target.files].forEach(function(file) {
                const item = document.createElement('div');
                item.className = 'video-preview-item';
                item.textContent = `${file.name} (${(file.size / (1024 * 1024)).toFixed(1)} MB)`;
                list.appendChild(item);
            });
        });
    }


    // Enter key support for adding tags
    const tagLabel = document.getElementById('tagLabel');
    const tagUrl = document.getElementById('tagUrl');

    if (tagLabel) {
        tagLabel.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addTagLink();
            }
        });
    }

    if (tagUrl) {
        tagUrl.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addTagLink();
            }
        });
    }

    // Form submission - ensure tags are saved
    const articleForm = document.getElementById('articleForm');
    if (articleForm) {
        articleForm.addEventListener('submit', function(e) {
            document.getElementById('tagLinksInput').value = tagLinks.length ? JSON.stringify(tagLinks) : '';
        });
    }
});

const PRESET_TAGS = @json($presetTags);
let tagLinks = [];

function quickAddTag(label, url) {
    if (tagLinks.some(t => t.label.toLowerCase() === label.toLowerCase())) return;
    tagLinks.push({ label: label, url: url || null });
    renderTagLinks();
}

function renderPresetButtons() {
    const container = document.getElementById('presetTagButtons');
    if (!container) return;

    // Combine preset tags with custom added tags (custom tags first, then presets)
    const allTags = [
        ...tagLinks.filter(t => !PRESET_TAGS.some(p => p.label.toLowerCase() === t.label.toLowerCase())),
        ...PRESET_TAGS
    ];

    container.innerHTML = allTags.map((tag, index) => {
        const isAdded = tagLinks.some(t => t.label.toLowerCase() === tag.label.toLowerCase());
        return `<button type="button" class="preset-tag-btn${isAdded ? ' is-added' : ''}"
                    onclick="quickAddTagFromAll(${index})">
                    ${isAdded ? '✓' : '+'} ${escapeHtml(tag.label)}
                </button>`;
    }).join('');
}

function quickAddTagFromAll(index) {
    // Get all tags (custom + preset)
    const allTags = [
        ...tagLinks.filter(t => !PRESET_TAGS.some(p => p.label.toLowerCase() === t.label.toLowerCase())),
        ...PRESET_TAGS
    ];
    const tag = allTags[index];
    if (!tag) return;
    quickAddTag(tag.label, tag.url);
}


function addTagLink() {
    const labelInput = document.getElementById('tagLabel');
    const urlInput = document.getElementById('tagUrl');
    const label = labelInput.value.trim();
    const url = urlInput.value.trim();
    if (!label) { alert('Please enter a tag label.'); return; }
    if (url) { try { new URL(url); } catch(e) { alert('Please enter a valid URL.'); return; } }
    if (tagLinks.some(t => t.label.toLowerCase() === label.toLowerCase())) { alert('Tag already added.'); return; }
    tagLinks.push({ label: label, url: url || null });
    renderTagLinks();
    labelInput.value = '';
    urlInput.value = '';
    labelInput.focus();
}

function removeTagLink(index) {
    tagLinks.splice(index, 1);
    renderTagLinks();
}

function renderTagLinks() {
    const container = document.getElementById('tagLinksContainer');
    const input = document.getElementById('tagLinksInput');
    if (tagLinks.length === 0) {
        container.innerHTML = '<div class="no-links">No tags added yet. Add one above.</div>';
        input.value = '';
        renderPresetButtons();
        return;
    }
    let html = '';
    tagLinks.forEach(function(tag, i) {
        html += '<div class="link-item"><span class="link-title">' + escapeHtml(tag.label) + '</span>';
        html += tag.url ? '<a href="' + escapeHtml(tag.url) + '" target="_blank" class="link-url">' + escapeHtml(tag.url) + '</a>' : '<span class="link-url" style="color:#9ca3af;">No link</span>';
        html += '<span class="link-badge">Tag</span><button type="button" class="remove-link" onclick="removeTagLink(' + i + ')" title="Remove">x</button></div>';
    });
    container.innerHTML = html;
    input.value = JSON.stringify(tagLinks);
    renderPresetButtons();
}

// Link management
let links = [];

function addLink() {
    const titleInput = document.getElementById('linkTitle');
    const urlInput = document.getElementById('linkUrl');
    const title = titleInput.value.trim();
    const url = urlInput.value.trim();
    if (!title || !url) { alert('Please enter both a title and URL.'); return; }
    try { new URL(url); } catch(e) { alert('Please enter a valid URL.'); return; }
    links.push({ title: title, url: url });
    renderLinks();
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
    const input = document.getElementById('linksInput');
    if (links.length === 0) {
        container.innerHTML = '<div class="no-links" id="noLinks">No links added yet. Add one above.</div>';
        input.value = '';
        return;
    }
    let html = '';
    links.forEach(function(link, i) {
        html += '<div class="link-item"><span class="link-title">' + escapeHtml(link.title) + '</span>';
        html += '<a href="' + escapeHtml(link.url) + '" target="_blank" class="link-url">' + escapeHtml(link.url) + '</a>';
        html += '<span class="link-badge">Link</span><button type="button" class="remove-link" onclick="removeLink(' + i + ')" title="Remove">x</button></div>';
    });
    container.innerHTML = html;
    input.value = JSON.stringify(links);
}

function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
}

renderPresetButtons();
</script>

@vite(['resources/js/admin-news-editor.js', 'resources/js/admin-news-form.js'])

@endsection
