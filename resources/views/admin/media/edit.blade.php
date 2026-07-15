@extends('admin.layouts.app')

@section('title', 'Edit Media Item')
@section('page-title', 'Edit Media Item')
@section('breadcrumb', 'Media Gallery → Edit')

@section('content')

<div class="max-w-3xl mx-auto">
    <form action="{{ route('admin.media.update', $media) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        {{-- Details --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                </div>
                <h3>Media Item Details</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Title <span class="required">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $media->title) }}" required
                           class="form-control @error('title') error @enderror"
                           placeholder="e.g. Classical arts not a priority in schools today">
                    @error('title')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Category <span class="optional">(optional)</span></label>
                        <input type="text" name="category" value="{{ old('category', $media->category) }}"
                               class="form-control"
                               placeholder="e.g. Cultural and artistic development">
                        @error('category')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Source <span class="optional">(optional)</span></label>
                        <input type="text" name="source" value="{{ old('source', $media->source) }}"
                               class="form-control"
                               placeholder="e.g. Press Article / The Phnom Penh Post">
                        @error('source')<div class="form-error">{{ $message }}</div>@enderror
                        <div class="form-helper">Displayed as the section label e.g. "PRESS ARTICLE / THE PHNOM PENH POST"</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description <span class="optional">(optional)</span></label>
                    <textarea name="description" rows="4" class="form-control textarea"
                              placeholder="The italic excerpt paragraph shown on the media page...">{{ old('description', $media->description) }}</textarea>
                    @error('description')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group form-group--no-margin">
                    <label class="form-label">Caption <span class="optional">(optional)</span></label>
                    <textarea name="caption" rows="2" class="form-control textarea"
                              placeholder="Shown below the image on the featured media item...">{{ old('caption', $media->caption) }}</textarea>
                    @error('caption')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">E.g. "Students at the Krousar Thmey organisation learn how to dance. Photo supplied"</div>
                </div>
            </div>
        </div>

        {{-- External Link --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon orange">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                </div>
                <h3>External Link</h3>
                <span class="badge">Optional</span>
            </div>
            <div class="card-body">
                <div class="form-group form-group--no-margin">
                    <label class="form-label">External Article URL</label>
                    <input type="url" name="external_link" value="{{ old('external_link', $media->external_link) }}"
                           class="form-control"
                           placeholder="https://example.com/article-url">
                    <div class="form-helper">Used for the "Read the article" button on the featured item.</div>
                    @error('external_link')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Image & Publishing --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon green">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h3>Image & Publishing</h3>
            </div>
            <div class="card-body">
                {{-- Current image --}}
                @if($media->image)
                <div class="mb-4 flex items-center gap-4 bg-gray-50 border border-gray-200 rounded-2xl p-4">
                    <div class="w-20 h-14 bg-white rounded-xl border border-gray-100 overflow-hidden flex-shrink-0">
                        <img src="{{ $media->image_url }}" alt="" class="w-full h-full object-cover">
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-700">Current image</p>
                        <label class="inline-flex items-center gap-1.5 mt-1 text-xs text-gray-500 cursor-pointer hover:text-red-500 transition-colors">
                            <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300 accent-[#2d6fa3]">
                            Remove this image
                        </label>
                    </div>
                </div>
                @endif

                <div class="form-group">
                    <label class="form-label">Upload New Image <span class="optional">(optional)</span></label>
                    <div class="upload-area" onclick="document.getElementById('imageInput').click()">
                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden">
                        <div id="imagePlaceholder">
                            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div class="upload-title">Click to upload new image</div>
                            <div class="upload-subtitle">Max 2MB. JPG, PNG, or WebP</div>
                        </div>
                        <div id="imagePreview" class="hidden mt-3"></div>
                    </div>
                    @error('image')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="mt-3">
                        <input type="url" name="image_url" value="{{ old('image_url', $media->image_url) }}"
                               class="form-control"
                               placeholder="...or paste an image URL directly">
                        <div class="form-helper">Either upload a file or enter a URL above.</div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" value="{{ old('sort_order', $media->sort_order) }}"
                                   class="form-control">
                            <div class="form-helper">Lower numbers appear first.</div>
                        </div>
                    </div>
                </div>

                <div class="form-group form-group--no-margin">
                    <div class="form-grid">
                        <div class="publish-option">
                            <input type="checkbox" name="is_published" id="is_published" value="1"
                                   {{ old('is_published', $media->is_published) ? 'checked' : '' }}>
                            <div>
                                <div class="label">Published</div>
                                <div class="description">Uncheck to save as draft</div>
                            </div>
                        </div>
                        <div class="info-box">
                            <svg class="info-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
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
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                Update Media Item
            </button>
            <a href="{{ route('admin.media.index') }}" class="btn-cancel">Cancel</a>
        </div>
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
});
</script>

@endsection
