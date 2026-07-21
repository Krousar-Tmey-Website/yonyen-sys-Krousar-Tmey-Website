@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-news.css'])
@endpush

@php
    $items = $resourcePage->items ?? [];
@endphp

@section('title', 'Edit Topic')
@section('page-title', 'Edit Topic')
@section('breadcrumb', 'Topics → ' . \Illuminate\Support\Str::limit($resourcePage->title, 40))

@section('content')

<div class="max-w-3xl mx-auto">
    <form action="{{ route('admin.resource-pages.update', $resourcePage) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Basic Info --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <h3>Basic Info</h3>
                <span class="badge">Required *</span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Title <span class="required">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $resourcePage->title) }}" required
                           class="form-control @error('title') error @enderror">
                    @error('title')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Also the label News tags match against to link here.</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Slug <span class="optional">(optional)</span></label>
                    <input type="text" name="slug" value="{{ old('slug', $resourcePage->slug) }}"
                           class="form-control @error('slug') error @enderror">
                    @error('slug')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Used in the URL: /topics/{{ $resourcePage->slug }} — changing this moves the page's URL.</div>
                </div>

                <div class="form-group form-group--no-margin">
                    <label class="form-label">Short Description <span class="optional">(optional)</span></label>
                    <textarea name="description" rows="2" class="form-control textarea @error('description') error @enderror">{{ old('description', $resourcePage->description) }}</textarea>
                    @error('description')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Detail Page Content --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon purple">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                </div>
                <h3>Detail Page Content</h3>
                <span class="badge">Optional</span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Header Text <span class="optional">(optional)</span></label>
                    <input type="text" name="header_text" value="{{ old('header_text', $resourcePage->header_text) }}"
                           class="form-control @error('header_text') error @enderror"
                           placeholder="Overrides the title as the page heading">
                    @error('header_text')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group form-group--no-margin">
                    <label class="form-label">Full Description <span class="optional">(optional)</span></label>
                    <textarea name="detail_description" rows="6" class="form-control textarea @error('detail_description') error @enderror">{{ old('detail_description', $resourcePage->detail_description) }}</textarea>
                    @error('detail_description')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Images --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon green">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3>Images</h3>
                <span class="badge">Optional</span>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Card Image <span class="optional">(shown on the Topics listing)</span></label>
                    @if($resourcePage->image)
                    <div class="current-image mb-2">
                        <img src="{{ $resourcePage->image_url }}" alt="Current image">
                        <div class="image-info">
                            <strong>Current image</strong>
                            <label class="text-small-info flex items-center gap-1.5 mt-1">
                                <input type="checkbox" name="remove_image" value="1"> Remove image
                            </label>
                        </div>
                    </div>
                    @endif
                    <div class="upload-area" onclick="document.getElementById('imageInput').click()">
                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden">
                        <div id="imagePlaceholder">
                            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div class="upload-title">Click to upload new image</div>
                            <div class="upload-subtitle">Max 2MB. JPG, PNG, or WebP</div>
                        </div>
                        <div id="imagePreview" class="hidden mt-3"></div>
                    </div>
                    @error('image')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group form-group--no-margin">
                    <label class="form-label">Detail Page Hero Image <span class="optional">(shown on the topic's own page)</span></label>
                    @if($resourcePage->detail_image)
                    <div class="current-image mb-2">
                        <img src="{{ $resourcePage->detail_image_url }}" alt="Current detail image">
                        <div class="image-info">
                            <strong>Current image</strong>
                            <label class="text-small-info flex items-center gap-1.5 mt-1">
                                <input type="checkbox" name="remove_detail_image" value="1"> Remove image
                            </label>
                        </div>
                    </div>
                    @endif
                    <div class="upload-area" onclick="document.getElementById('detailImageInput').click()">
                        <input type="file" name="detail_image" id="detailImageInput" accept="image/*" class="hidden">
                        <div id="detailImagePlaceholder">
                            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div class="upload-title">Click to upload new image</div>
                            <div class="upload-subtitle">Max 4MB. JPG, PNG, or WebP</div>
                        </div>
                        <div id="detailImagePreview" class="hidden mt-3"></div>
                    </div>
                    @error('detail_image')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Feature Items --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon orange">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/>
                    </svg>
                </div>
                <h3>Feature Items</h3>
                <span class="badge">Optional, up to 3</span>
            </div>
            <div class="card-body">
                @for ($i = 0; $i < 3; $i++)
                @php $existingItem = $items[$i] ?? null; @endphp
                <div class="form-group {{ $i < 2 ? '' : 'form-group--no-margin' }}" style="padding-bottom: 1rem; {{ $i < 2 ? 'border-bottom: 1px solid #f1f5f9; margin-bottom: 1rem;' : '' }}">
                    <label class="form-label">Item {{ $i + 1 }}</label>
                    <input type="text" name="items[{{ $i }}][title]" value="{{ old("items.$i.title", $existingItem['title'] ?? '') }}"
                           class="form-control mb-2" placeholder="Item title">
                    <textarea name="items[{{ $i }}][description]" rows="2" class="form-control textarea mb-2"
                              placeholder="Item description">{{ old("items.$i.description", $existingItem['description'] ?? '') }}</textarea>

                    @if(!empty($existingItem['image']))
                    <div class="current-image mb-2">
                        <img src="{{ str_starts_with($existingItem['image'], 'http') ? $existingItem['image'] : asset('storage/' . $existingItem['image']) }}" alt="Current item image">
                        <div class="image-info">
                            <strong>Current image</strong>
                            <label class="text-small-info flex items-center gap-1.5 mt-1">
                                <input type="checkbox" name="remove_item_image[{{ $i }}]" value="1"> Remove image
                            </label>
                        </div>
                    </div>
                    @endif

                    <div class="upload-area" onclick="document.getElementById('itemImageInput{{ $i }}').click()">
                        <input type="file" name="items[{{ $i }}][image]" id="itemImageInput{{ $i }}" accept="image/*" class="hidden">
                        <div id="itemImagePlaceholder{{ $i }}">
                            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div class="upload-title">Click to upload {{ !empty($existingItem['image']) ? 'new ' : '' }}image</div>
                        </div>
                        <div id="itemImagePreview{{ $i }}" class="hidden mt-3"></div>
                    </div>
                    @error("items.$i.title")<div class="form-error">{{ $message }}</div>@enderror
                    @error("items.$i.description")<div class="form-error">{{ $message }}</div>@enderror
                    @error("items.$i.image")<div class="form-error">{{ $message }}</div>@enderror
                </div>
                @endfor
            </div>
        </div>

        {{-- Settings --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                    </svg>
                </div>
                <h3>Settings</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $resourcePage->sort_order) }}"
                           class="form-control @error('sort_order') error @enderror">
                    @error('sort_order')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Lower numbers appear first on the Topics listing.</div>
                </div>

                <div class="form-group form-group--no-margin">
                    <div class="publish-option">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $resourcePage->is_active) ? 'checked' : '' }}>
                        <div>
                            <div class="label">Active</div>
                            <div class="description">Uncheck to hide from the public site and the tag quick-add list</div>
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
                Update Topic
            </button>
            <a href="{{ route('admin.resource-pages.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>

    {{-- Delete Form --}}
    <div class="form-actions form-actions--delete">
        <form action="{{ route('admin.resource-pages.destroy', $resourcePage) }}" method="POST"
              onsubmit="return confirm('⚠️ Delete this topic?\n\nTags pointing to it will fall back to a plain news filter instead.')"
              class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete Topic
            </button>
        </form>
    </div>
</div>

<script>
function initImagePreview(inputId, placeholderId, previewId) {
    const input = document.getElementById(inputId);
    if (!input) return;
    input.addEventListener('change', function(e) {
        const preview = document.getElementById(previewId);
        const placeholder = document.getElementById(placeholderId);
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
                                onclick="document.getElementById('${inputId}').value=''; document.getElementById('${previewId}').innerHTML=''; document.getElementById('${previewId}').classList.add('hidden'); document.getElementById('${placeholderId}').classList.remove('hidden');">
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

document.addEventListener('DOMContentLoaded', function() {
    initImagePreview('imageInput', 'imagePlaceholder', 'imagePreview');
    initImagePreview('detailImageInput', 'detailImagePlaceholder', 'detailImagePreview');
    for (let i = 0; i < 3; i++) {
        initImagePreview('itemImageInput' + i, 'itemImagePlaceholder' + i, 'itemImagePreview' + i);
    }
});
</script>

@endsection
