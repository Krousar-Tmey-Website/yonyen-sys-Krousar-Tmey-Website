@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-news.css'])
@endpush

@section('title', 'New Topic')
@section('page-title', 'Create New Topic')
@section('breadcrumb', 'Topics → Create')

@section('content')

<div class="max-w-3xl mx-auto">
    <form action="{{ route('admin.resource-pages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div x-data="{ lang: 'en' }">
        {{-- Basic Info --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                </div>
                <h3>Basic Info</h3>
                <div class="header-actions">
                    <span class="badge">Required *</span>
                    <div class="lang-tabs">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'">FR</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group" x-show="lang === 'en'">
                    <label class="form-label">Title <span class="required">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}"
                           class="form-control @error('title') error @enderror"
                           placeholder="e.g. Cambodia">
                    @error('title')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Also the label News tags match against to link here.</div>
                </div>

                <div class="form-group" x-show="lang === 'fr'" x-cloak>
                    <label class="form-label">Title (French) <span class="optional">(optional)</span></label>
                    <input type="text" name="title_fr" value="{{ old('title_fr') }}"
                           class="form-control @error('title_fr') error @enderror"
                           placeholder="ex. Cambodge">
                    @error('title_fr')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Shown to French-language visitors. Leave blank to reuse the English value.</div>
                </div>

                <div class="form-group" x-show="lang === 'en'">
                    <label class="form-label">Slug <span class="optional">(optional)</span></label>
                    <input type="text" name="slug" value="{{ old('slug') }}"
                           class="form-control @error('slug') error @enderror"
                           placeholder="Auto-generated from title if left blank">
                    @error('slug')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Used in the URL: /topics/your-slug</div>
                </div>

                <div class="form-group form-group--no-margin" x-show="lang === 'en'">
                    <label class="form-label">Short Description <span class="optional">(optional)</span></label>
                    <textarea name="description" rows="2" class="form-control textarea @error('description') error @enderror"
                              placeholder="Shown on the Topics listing card...">{{ old('description') }}</textarea>
                    @error('description')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group form-group--no-margin" x-show="lang === 'fr'" x-cloak>
                    <label class="form-label">Short Description (French) <span class="optional">(optional)</span></label>
                    <textarea name="description_fr" rows="2" class="form-control textarea @error('description_fr') error @enderror"
                              placeholder="Affiché sur la fiche de la liste des sujets...">{{ old('description_fr') }}</textarea>
                    @error('description_fr')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Shown to French-language visitors. Leave blank to reuse the English value.</div>
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
                <div class="header-actions">
                    <span class="badge">Optional</span>
                    <div class="lang-tabs">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'">FR</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group" x-show="lang === 'en'">
                    <label class="form-label">Header Text <span class="optional">(optional)</span></label>
                    <input type="text" name="header_text" value="{{ old('header_text') }}"
                           class="form-control @error('header_text') error @enderror"
                           placeholder="Overrides the title as the page heading">
                    @error('header_text')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group" x-show="lang === 'fr'" x-cloak>
                    <label class="form-label">Header Text (French) <span class="optional">(optional)</span></label>
                    <input type="text" name="header_text_fr" value="{{ old('header_text_fr') }}"
                           class="form-control @error('header_text_fr') error @enderror"
                           placeholder="Remplace le titre comme en-tête de page">
                    @error('header_text_fr')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Shown to French-language visitors. Leave blank to reuse the English value.</div>
                </div>

                <div class="form-group form-group--no-margin" x-show="lang === 'en'">
                    <label class="form-label">Full Description <span class="optional">(optional)</span></label>
                    <textarea name="detail_description" rows="6" class="form-control textarea @error('detail_description') error @enderror"
                              placeholder="The main body text shown on the topic's detail page...">{{ old('detail_description') }}</textarea>
                    @error('detail_description')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group form-group--no-margin" x-show="lang === 'fr'" x-cloak>
                    <label class="form-label">Full Description (French) <span class="optional">(optional)</span></label>
                    <textarea name="detail_description_fr" rows="6" class="form-control textarea @error('detail_description_fr') error @enderror"
                              placeholder="Le texte principal affiché sur la page détaillée du sujet...">{{ old('detail_description_fr') }}</textarea>
                    @error('detail_description_fr')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Shown to French-language visitors. Leave blank to reuse the English value.</div>
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
                    <label class="form-label">Detail Page Hero Image <span class="optional">(shown on the topic's own page)</span></label>
                    <div class="upload-area" onclick="document.getElementById('detailImageInput').click()">
                        <input type="file" name="detail_image" id="detailImageInput" accept="image/*" class="hidden">
                        <div id="detailImagePlaceholder">
                            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div class="upload-title">Click to upload</div>
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
                <div class="header-actions">
                    <span class="badge">Optional, up to 3</span>
                    <div class="lang-tabs">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'">FR</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @for ($i = 0; $i < 3; $i++)
                <div class="form-group {{ $i < 2 ? '' : 'form-group--no-margin' }}" style="padding-bottom: 1rem; {{ $i < 2 ? 'border-bottom: 1px solid #f1f5f9; margin-bottom: 1rem;' : '' }}">
                    <label class="form-label">Item {{ $i + 1 }}</label>

                    <div x-show="lang === 'en'">
                        <input type="text" name="items[{{ $i }}][title]" value="{{ old("items.$i.title") }}"
                               class="form-control mb-2" placeholder="Item title">
                        <textarea name="items[{{ $i }}][description]" rows="2" class="form-control textarea mb-2"
                                  placeholder="Item description">{{ old("items.$i.description") }}</textarea>
                    </div>

                    <div x-show="lang === 'fr'" x-cloak>
                        <input type="text" name="items[{{ $i }}][title_fr]" value="{{ old("items.$i.title_fr") }}"
                               class="form-control mb-2" placeholder="Titre de l'élément (optionnel)">
                        <textarea name="items[{{ $i }}][description_fr]" rows="2" class="form-control textarea mb-2"
                                  placeholder="Description de l'élément (optionnel)">{{ old("items.$i.description_fr") }}</textarea>
                        <div class="form-helper">Shown to French-language visitors. Leave blank to reuse the English value.</div>
                    </div>

                    <div class="upload-area" onclick="document.getElementById('itemImageInput{{ $i }}').click()">
                        <input type="file" name="items[{{ $i }}][image]" id="itemImageInput{{ $i }}" accept="image/*" class="hidden">
                        <div id="itemImagePlaceholder{{ $i }}">
                            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <div class="upload-title">Click to upload image</div>
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
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                           class="form-control @error('sort_order') error @enderror" placeholder="0">
                    @error('sort_order')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Lower numbers appear first on the Topics listing.</div>
                </div>

                <div class="form-group form-group--no-margin">
                    <div class="publish-option">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Save Topic
            </button>
            <a href="{{ route('admin.resource-pages.index') }}" class="btn-cancel">Cancel</a>
        </div>
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
