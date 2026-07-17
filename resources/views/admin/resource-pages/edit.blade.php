@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-news.css'])
@endpush

@section('title', 'Edit Resource Page')
@section('page-title', 'Edit Resource Page')
@section('breadcrumb', 'News & Resources → Resource Pages → ' . $page->title)

@section('content')

<div class="max-w-3xl mx-auto">
    <form action="{{ route('admin.resource-pages.update', $page) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        {{-- Card Details --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <h3>Card Details</h3>
                <span class="badge">Required *</span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Title <span class="required">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $page->title) }}" required
                           class="form-control @error('title') error @enderror">
                    @error('title')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Slug: {{ $page->slug }}</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Description <span class="optional">(optional)</span></label>
                    <textarea name="description" rows="3" class="form-control textarea">{{ old('description', $page->description) }}</textarea>
                    @error('description')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                @if($page->image)
                <div class="form-group">
                    <label class="form-label">Current Card Image</label>
                    <div class="current-image">
                        <img src="{{ $page->image_url }}" alt="Current image">
                        <div class="image-info">
                            <strong>Current card image</strong>
                            <div class="text-small-info">Upload below to replace</div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="form-group form-group--no-margin">
                    <label class="form-label">Card Image <span class="optional">(optional)</span></label>
                    <div class="upload-area" onclick="document.getElementById('imageInput').click()">
                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden">
                        <div id="imagePlaceholder">
                            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div class="upload-title">{{ $page->image ? 'Replace image' : 'Click to upload' }}</div>
                            <div class="upload-subtitle">Max 2MB. JPG, PNG, or WebP</div>
                        </div>
                        <div id="imagePreview" class="hidden mt-3"></div>
                    </div>
                    @error('image')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- View Detail Page --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon purple">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </div>
                <h3>"View Detail" Page</h3>
                <span class="badge">Optional</span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Header Text <span class="optional">(optional)</span></label>
                    <input type="text" name="header_text" value="{{ old('header_text', $page->header_text) }}" class="form-control">
                    @error('header_text')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">Detail Description <span class="optional">(optional)</span></label>
                    <textarea name="detail_description" rows="4" class="form-control textarea">{{ old('detail_description', $page->detail_description) }}</textarea>
                    @error('detail_description')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                @if($page->detail_image)
                <div class="form-group">
                    <label class="form-label">Current Detail Picture</label>
                    <div class="current-image">
                        <img src="{{ $page->detail_image_url }}" alt="Current detail image">
                        <div class="image-info">
                            <strong>Current detail picture</strong>
                            <div class="text-small-info">Upload below to replace</div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="form-group form-group--no-margin">
                    <label class="form-label">Detail Picture <span class="optional">(optional)</span></label>
                    <div class="upload-area" onclick="document.getElementById('detailImageInput').click()">
                        <input type="file" name="detail_image" id="detailImageInput" accept="image/*" class="hidden">
                        <div id="detailImagePlaceholder">
                            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div class="upload-title">{{ $page->detail_image ? 'Replace image' : 'Click to upload' }}</div>
                            <div class="upload-subtitle">Max 2MB. JPG, PNG, or WebP</div>
                        </div>
                        <div id="detailImagePreview" class="hidden mt-3"></div>
                    </div>
                    @error('detail_image')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Feature Items (3 photos) --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon orange">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3>Feature Items</h3>
                <span class="badge">Optional — up to 3</span>
            </div>
            <div class="card-body space-y-6">
                @for ($i = 1; $i <= 3; $i++)
                @php $existingItem = $page->items[$i - 1] ?? null; @endphp
                <div class="{{ $i < 3 ? 'pb-6 border-b border-gray-100' : '' }}">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Item {{ $i }}</p>
                    <div class="form-group">
                        <label class="form-label">Title</label>
                        <input type="text" name="item_{{ $i }}_title" value="{{ old('item_'.$i.'_title', $existingItem['title'] ?? '') }}"
                               class="form-control" placeholder="Item {{ $i }} title">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Description</label>
                        <textarea name="item_{{ $i }}_description" rows="2" class="form-control textarea"
                                  placeholder="Item {{ $i }} description...">{{ old('item_'.$i.'_description', $existingItem['description'] ?? '') }}</textarea>
                    </div>
                    @if(!empty($existingItem['image']))
                    <div class="form-group">
                        <label class="form-label">Current Image</label>
                        <div class="current-image">
                            <img src="{{ $page->items_for_display[$i - 1]['image_url'] ?? '' }}" alt="Current image">
                            <div class="image-info">
                                <strong>Current photo</strong>
                                <div class="text-small-info">Upload below to replace</div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="form-group form-group--no-margin">
                        <label class="form-label">Image</label>
                        <div class="upload-area" onclick="document.getElementById('item{{ $i }}ImageInput').click()">
                            <input type="file" name="item_{{ $i }}_image" id="item{{ $i }}ImageInput" accept="image/*" class="hidden">
                            <div id="item{{ $i }}ImagePlaceholder">
                                <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <div class="upload-title">{{ !empty($existingItem['image']) ? 'Replace image' : 'Click to upload' }}</div>
                                <div class="upload-subtitle">Max 2MB</div>
                            </div>
                            <div id="item{{ $i }}ImagePreview" class="hidden mt-3"></div>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>

        {{-- Publishing --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon green">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3>Publishing</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $page->sort_order) }}" class="form-control" style="max-width:140px">
                    <div class="form-helper">Lower numbers appear first in the list.</div>
                </div>
                <div class="form-group form-group--no-margin">
                    <div class="publish-option">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $page->is_active) ? 'checked' : '' }}>
                        <div>
                            <div class="label">Active</div>
                            <div class="description">Uncheck to hide this page from visitors</div>
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
                Update Page
            </button>
            <a href="{{ route('admin.resource-pages.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

{{-- Delete Form --}}
<div class="form-actions form-actions--delete">
    <form action="{{ route('admin.resource-pages.destroy', $page) }}" method="POST"
          onsubmit="return confirm('⚠️ Permanently delete this resource page?\n\nThis action cannot be undone.')"
          class="inline delete-form">
        @csrf @method('DELETE')
        <button type="submit" class="btn-danger delete-btn">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            Delete Page
        </button>
    </form>
</div>

<script>
function setupImagePreview(inputId, placeholderId, previewId) {
    const input = document.getElementById(inputId);
    if (!input) return;
    input.addEventListener('change', function(e) {
        const preview = document.getElementById(previewId);
        const placeholder = document.getElementById(placeholderId);
        const file = e.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = function(ev) {
            placeholder.classList.add('hidden');
            preview.classList.remove('hidden');
            preview.innerHTML = `
                <div class="image-preview-wrapper">
                    <img src="${ev.target.result}" alt="Preview">
                    <button type="button" class="remove-btn"
                            onclick="document.getElementById('${inputId}').value=''; document.getElementById('${previewId}').innerHTML=''; document.getElementById('${previewId}').classList.add('hidden'); document.getElementById('${placeholderId}').classList.remove('hidden');">
                        ×
                    </button>
                    <div class="file-info">${file.name} (${(file.size / 1024).toFixed(1)} KB)</div>
                </div>
            `;
        };
        reader.readAsDataURL(file);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    setupImagePreview('imageInput', 'imagePlaceholder', 'imagePreview');
    setupImagePreview('detailImageInput', 'detailImagePlaceholder', 'detailImagePreview');
    setupImagePreview('item1ImageInput', 'item1ImagePlaceholder', 'item1ImagePreview');
    setupImagePreview('item2ImageInput', 'item2ImagePlaceholder', 'item2ImagePreview');
    setupImagePreview('item3ImageInput', 'item3ImagePlaceholder', 'item3ImagePreview');
});
</script>

@endsection
