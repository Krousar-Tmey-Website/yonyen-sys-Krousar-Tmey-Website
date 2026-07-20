@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-news.css'])
@endpush

@section('title', 'New Article')
@section('page-title', 'Create New Article')
@section('breadcrumb', 'News → Create')

@section('content')

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
                    <div class="form-helper">Shown on the article card and byline. The URL is optional — leave it blank for a plain (non-clickable) tag, or point it at an external page (e.g. a category on krousar-thmey.org).</div>
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

                <div class="form-group form-group--no-margin">
                    <label class="form-label">Added Links</label>
                    <div class="links-container" id="linksContainer">
                        <div class="no-links" id="noLinks">No links added yet. Add a link above.</div>
                    </div>
                    <input type="hidden" name="links" id="linksInput" value="">
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
                                <div class="label">Publish immediately</div>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Save Article
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
    // Image upload preview
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

    // Form submission - ensure links are saved
    const articleForm = document.getElementById('articleForm');
    if (articleForm) {
        articleForm.addEventListener('submit', function(e) {
            document.getElementById('linksInput').value = JSON.stringify(links);
            document.getElementById('tagLinksInput').value = tagLinks.length ? JSON.stringify(tagLinks) : '';
        });
    }
});

// ====== LINK MANAGEMENT ======

let links = [];

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

// ====== TAG LINK MANAGEMENT ======

{{-- Sourced live from the Resource Pages table, so a tag always points at the
     matching internal page and stays in sync with renames/additions there. --}}
const PRESET_TAGS = @json($presetTags ?? []);

let tagLinks = [];

function quickAddTag(label, url) {
    if (tagLinks.some(t => t.label.toLowerCase() === label.toLowerCase())) {
        return; // already added — silently ignore, no need to interrupt with an alert
    }
    tagLinks.push({ label: label, url: url || null });
    renderTagLinks();
}

function renderPresetButtons() {
    const container = document.getElementById('presetTagButtons');
    if (!container) return;

    container.innerHTML = PRESET_TAGS.map((preset, index) => {
        const isAdded = tagLinks.some(t => t.label.toLowerCase() === preset.label.toLowerCase());
        return `<button type="button" class="preset-tag-btn${isAdded ? ' is-added' : ''}"
                    onclick="quickAddPresetTag(${index})">
                    ${isAdded ? '✓' : '+'} ${escapeHtml(preset.label)}
                </button>`;
    }).join('');
}

function quickAddPresetTag(index) {
    const preset = PRESET_TAGS[index];
    if (!preset) return;
    quickAddTag(preset.label, preset.url);
}

function addTagLink() {
    const labelInput = document.getElementById('tagLabel');
    const urlInput = document.getElementById('tagUrl');

    const label = labelInput.value.trim();
    const url = urlInput.value.trim();

    if (!label) {
        alert('Please enter a tag label.');
        return;
    }

    if (url) {
        try {
            new URL(url);
        } catch (e) {
            alert('Please enter a valid URL (including http:// or https://), or leave it blank.');
            return;
        }
    }

    if (tagLinks.some(t => t.label.toLowerCase() === label.toLowerCase())) {
        alert('This tag has already been added.');
        return;
    }

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
    const tagLinksInput = document.getElementById('tagLinksInput');

    if (tagLinks.length === 0) {
        container.innerHTML = '<div class="no-links" id="noTagLinks">No tags added yet. Add one above.</div>';
        tagLinksInput.value = '';
        renderPresetButtons();
        return;
    }

    let html = '';
    tagLinks.forEach((tag, index) => {
        html += `
            <div class="link-item">
                <span class="link-title">${escapeHtml(tag.label)}</span>
                ${tag.url ? `<a href="${escapeHtml(tag.url)}" target="_blank" rel="noopener noreferrer" class="link-url">${escapeHtml(tag.url)}</a>` : '<span class="link-url" style="color:#9ca3af;">No link</span>'}
                <span class="link-badge">Tag</span>
                <button type="button" class="remove-link" onclick="removeTagLink(${index})" title="Remove tag">×</button>
            </div>
        `;
    });
    container.innerHTML = html;

    tagLinksInput.value = JSON.stringify(tagLinks);
    renderPresetButtons();
}

renderPresetButtons();
</script>

@vite(['resources/js/admin-news-editor.js', 'resources/js/admin-news-form.js'])

@endsection
