@extends('admin.layouts.app')

@section('title', 'New Article')
@section('page-title', 'Create New Article')
@section('breadcrumb', 'News → Create')

@section('content')

<div class="max-w-3xl mx-auto">
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Category <span class="required">*</span></label>
                        <select name="category" required
                                class="form-control @error('category') error @enderror">
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
<option value="{{ $category->CategoryName }}" {{ old('category') == $category->CategoryName ? 'selected' : '' }}>
    {{ $category->CategoryName }}
</option>
                            @endforeach
                        </select>
                        @error('category')<div class="form-error">{{ $message }}</div>@enderror
                        <div class="form-helper">Select from created categories, or <a href="{{ route('admin.categories.create') }}" target="_blank">create a new one</a>.</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Tags <span class="optional">(comma separated)</span></label>
                        <input type="text" name="tags" value="{{ old('tags') }}"
                               class="form-control" placeholder="e.g. Cambodia, Child welfare">
                        @error('tags')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
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
                    <textarea name="content" rows="16" class="form-control content"
                              placeholder="Write your article content here...">{{ old('content') }}</textarea>
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
            <span class="form-status">
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
</script>

@endsection