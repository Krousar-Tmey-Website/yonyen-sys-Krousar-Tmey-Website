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

<div>
    <form action="{{ route('admin.resource-pages.update', $resourcePage) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div x-data="bilingualForm()" class="space-y-6">
        {{-- Basic Info --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </span>
                    Basic Info
                </h3>
                <div class="lang-tabs" title="Toggle editing language (English / French)">
                    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-5">
                <div>
                    <div class="form-group form-group--no-margin" x-show="lang === 'en'">
                        <label class="form-label">Title <span class="required">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $resourcePage->title) }}"
                               class="form-control @error('title') error @enderror">
                        @error('title')<div class="form-error">{{ $message }}</div>@enderror
                        <div class="form-helper">Also the label News tags match against to link here.</div>
                    </div>
                    <div class="form-group form-group--no-margin" x-show="lang === 'fr'" x-cloak>
                        <label class="form-label">Title (French) <span class="optional">(optional)</span></label>
                        <input type="text" name="title_fr" value="{{ old('title_fr', $resourcePage->title_fr) }}"
                               class="form-control @error('title_fr') error @enderror">
                        @error('title_fr')<div class="form-error">{{ $message }}</div>@enderror
                        <div class="form-helper">Shown to French-language visitors. Leave blank to reuse the English value.</div>
                    </div>
                </div>

                <div class="form-group form-group--no-margin" x-show="lang === 'en'">
                    <label class="form-label">Slug <span class="optional">(optional)</span></label>
                    <input type="text" name="slug" value="{{ old('slug', $resourcePage->slug) }}"
                           class="form-control @error('slug') error @enderror">
                    @error('slug')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Used in the URL: /topics/{{ $resourcePage->slug }} — changing this moves the page's URL.</div>
                </div>
            </div>

            <div class="form-group form-group--no-margin" x-show="lang === 'en'">
                <label class="form-label">Short Description <span class="optional">(optional)</span></label>
                <x-admin.rich-text name="description" :value="old('description', $resourcePage->description)" lang="en" :rows="2" />
                @error('description')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group form-group--no-margin" x-show="lang === 'fr'" x-cloak>
                <label class="form-label">Short Description (French) <span class="optional">(optional)</span></label>
                <x-admin.rich-text name="description_fr" :value="old('description_fr', $resourcePage->description_fr)" lang="fr" :rows="2" />
                @error('description_fr')<div class="form-error">{{ $message }}</div>@enderror
                <div class="form-helper">Shown to French-language visitors. Leave blank to reuse the English value.</div>
            </div>
        </div>

        {{-- Detail Page Content --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                </span>
                Detail Page Content
            </h3>

            <div class="form-group" x-show="lang === 'en'">
                <label class="form-label">Header Text <span class="optional">(optional)</span></label>
                <input type="text" name="header_text" value="{{ old('header_text', $resourcePage->header_text) }}"
                       class="form-control @error('header_text') error @enderror"
                       placeholder="Overrides the title as the page heading">
                @error('header_text')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group" x-show="lang === 'fr'" x-cloak>
                <label class="form-label">Header Text (French) <span class="optional">(optional)</span></label>
                <input type="text" name="header_text_fr" value="{{ old('header_text_fr', $resourcePage->header_text_fr) }}"
                       class="form-control @error('header_text_fr') error @enderror"
                       placeholder="Remplace le titre comme en-tête de page">
                @error('header_text_fr')<div class="form-error">{{ $message }}</div>@enderror
                <div class="form-helper">Shown to French-language visitors. Leave blank to reuse the English value.</div>
            </div>

            <div class="form-group form-group--no-margin" x-show="lang === 'en'">
                <label class="form-label">Full Description <span class="optional">(optional)</span></label>
                <x-admin.rich-text name="detail_description" :value="old('detail_description', $resourcePage->detail_description)" lang="en" :rows="6" />
                @error('detail_description')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group form-group--no-margin" x-show="lang === 'fr'" x-cloak>
                <label class="form-label">Full Description (French) <span class="optional">(optional)</span></label>
                <x-admin.rich-text name="detail_description_fr" :value="old('detail_description_fr', $resourcePage->detail_description_fr)" lang="fr" :rows="6" />
                @error('detail_description_fr')<div class="form-error">{{ $message }}</div>@enderror
                <div class="form-helper">Shown to French-language visitors. Leave blank to reuse the English value.</div>
            </div>
        </div>

        {{-- Images --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </span>
                Images
            </h3>

            <div class="grid lg:grid-cols-2 gap-5">
                <div class="form-group form-group--no-margin">
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
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-orange-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2H6a2 2 0 01-2-2V6z"/>
                    </svg>
                </span>
                Feature Items
            </h3>

            @for ($i = 0; $i < 3; $i++)
            @php $existingItem = $items[$i] ?? null; @endphp
            <div class="form-group {{ $i < 2 ? '' : 'form-group--no-margin' }}" style="padding-bottom: 1rem; {{ $i < 2 ? 'border-bottom: 1px solid #f1f5f9; margin-bottom: 1rem;' : '' }}">
                <label class="form-label">Item {{ $i + 1 }}</label>

                <div x-show="lang === 'en'">
                    <input type="text" name="items[{{ $i }}][title]" value="{{ old("items.$i.title", $existingItem['title'] ?? '') }}"
                           class="form-control mb-2" placeholder="Item title">
                    <x-admin.rich-text name="items[{{ $i }}][description]" :value="old('items.'.$i.'.description', $existingItem['description'] ?? '')" lang="en" :rows="2" placeholder="Item description..." />
                </div>

                <div x-show="lang === 'fr'" x-cloak>
                    <input type="text" name="items[{{ $i }}][title_fr]" value="{{ old("items.$i.title_fr", $existingItem['title_fr'] ?? '') }}"
                           class="form-control mb-2" placeholder="Titre de l'élément (optionnel)">
                    <x-admin.rich-text name="items[{{ $i }}][description_fr]" :value="old('items.'.$i.'.description_fr', $existingItem['description_fr'] ?? '')" lang="fr" :rows="2" placeholder="Description de l'élément (optionnel)..." />
                    <div class="form-helper">Shown to French-language visitors. Leave blank to reuse the English value.</div>
                </div>

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
                @error("items.$i.title_fr")<div class="form-error">{{ $message }}</div>@enderror
                @error("items.$i.description")<div class="form-error">{{ $message }}</div>@enderror
                @error("items.$i.description_fr")<div class="form-error">{{ $message }}</div>@enderror
                @error("items.$i.image")<div class="form-error">{{ $message }}</div>@enderror
            </div>
            @endfor
        </div>
        </div>

        {{-- Settings --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </span>
                Settings
            </h3>

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

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary">Update Topic</button>
            <a href="{{ route('admin.resource-pages.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
            <button type="submit" form="delete-resource-page-form" class="text-red-400 hover:text-red-600 text-sm ml-auto">Delete Topic</button>
        </div>
    </form>

    {{-- Delete Form --}}
    <form id="delete-resource-page-form" action="{{ route('admin.resource-pages.destroy', $resourcePage) }}" method="POST" class="hidden"
          onsubmit="return confirm('⚠️ Delete this topic?\n\nTags pointing to it will fall back to a plain news filter instead.')">
        @csrf
        @method('DELETE')
    </form>
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
