@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
@endpush

@php use Illuminate\Support\Str; @endphp

@section('title', 'Edit Book')
@section('page-title', 'Edit Book')
@section('breadcrumb', 'Books → ' . Str::limit($book->title, 40))

@section('content')

<div class="max-w-3xl mx-auto">
    <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data" class="space-y-5" x-data="bilingualForm()">
        @csrf
        @method('PUT')

        {{-- Book Details --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </span>
                    Book Details
                </h3>
                <div class="flex items-center gap-3">
                    <div class="lang-tabs" title="Toggle editing language (English / French)">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                    </div>
                    <span class="text-xs text-gray-400">Required *</span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="form-group" x-show="lang === 'en'">
                    <label class="form-label">Title <span class="required">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $book->title) }}"
                           class="form-control @error('title') error @enderror"
                           placeholder="e.g. The Silent Patient">
                    @error('title')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group" x-show="lang === 'fr'" x-cloak>
                    <label class="form-label">Title (French) <span class="optional">(optional)</span></label>
                    <input type="text" name="title_fr" value="{{ old('title_fr', $book->title_fr) }}"
                           class="form-control @error('title_fr') error @enderror"
                           placeholder="ex. Le Patient Silencieux">
                    @error('title_fr')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Shown to French-language visitors. Leave blank to reuse the English title.</div>
                </div>

                <div class="form-group" x-show="lang === 'en'">
                    <label class="form-label">Price (USD) <span class="text-xs text-slate-400 font-normal">(optional)</span></label>
                    <input type="number" name="price" value="{{ old('price', $book->price) }}" step="0.01" min="0"
                           class="form-control @error('price') error @enderror"
                           placeholder="e.g. 24.99">
                    @error('price')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group" x-show="lang === 'en'">
                    <label class="form-label">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock', $book->stock) }}" min="0"
                           class="form-control @error('stock') error @enderror"
                           placeholder="0">
                    @error('stock')<div class="form-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- Description --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                </span>
                Description
            </h3>

            <div class="form-group" x-show="lang === 'en'">
                <x-admin.rich-text name="description" :value="old('description', $book->description)" lang="en" :rows="3" placeholder="Write a short description or synopsis for the book..." />
                @error('description')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group" x-show="lang === 'fr'" x-cloak>
                <x-admin.rich-text name="description_fr" :value="old('description_fr', $book->description_fr)" lang="fr" :rows="3" placeholder="Rédigez une courte description ou un résumé du livre en français..." />
                @error('description_fr')<div class="form-error">{{ $message }}</div>@enderror
                <div class="form-helper">Shown to French-language visitors. Leave blank to reuse the English description.</div>
            </div>
        </div>

        {{-- Cover & Publishing --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </span>
                Cover Image &amp; Publishing
            </h3>

            @if($book->cover_image)
            <div class="form-group">
                <label class="form-label">Current Cover</label>
                <div class="current-image">
                    <img src="{{ $book->cover_image_url }}" alt="Current cover">
                    <div class="image-info">
                        <strong>Current cover</strong>
                        <div class="text-small-info">Replace below, or remove it entirely</div>
                    </div>
                </div>
                <label class="flex items-center gap-1.5 text-xs text-gray-500 mt-2">
                    <input type="checkbox" name="remove_cover" id="removeCoverInput" value="1" class="rounded border-gray-300">
                    Remove current cover
                </label>
            </div>
            @endif

            <div class="form-group">
                <label class="form-label">Replace Cover <span class="optional">(optional)</span></label>
                <div class="upload-area" onclick="document.getElementById('coverInput').click()">
                    <input type="file" name="cover_image" id="coverInput" accept="image/*" class="hidden">
                    <div id="coverPlaceholder">
                        <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <div class="upload-title">Click to upload new cover</div>
                        <div class="upload-subtitle">JPG, PNG or WebP (Max 2MB)</div>
                    </div>
                    <div id="coverPreview" class="hidden mt-3"></div>
                </div>
                @error('cover_image')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label class="form-label">Cover Background Color</label>
                <div class="flex items-center gap-3">
                    <input type="color" name="cover_background_color" value="{{ old('cover_background_color', $book->cover_background_color ?? '#f8fafc') }}"
                           class="h-10 w-16 rounded-lg border border-gray-200 bg-white p-1 cursor-pointer">
                    <span class="text-xs text-slate-400">The mat/backdrop shown behind the cover image on the Books for Sale listing.</span>
                </div>
                @error('cover_background_color')<div class="form-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group form-group--no-margin">
                <div class="publish-option">
                    <input type="checkbox" name="is_available" id="is_available" value="1"
                           {{ old('is_available', $book->is_available) ? 'checked' : '' }}>
                    <div>
                        <div class="label">Available for purchase</div>
                        <div class="description">Show on the public page</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary">Update Book</button>
            <a href="{{ route('admin.books.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
            <button type="submit" form="delete-book-form" class="text-red-400 hover:text-red-600 text-sm ml-auto">Delete Book</button>
        </div>
    </form>

    {{-- Delete Form --}}
    <form id="delete-book-form" action="{{ route('admin.books.destroy', $book) }}" method="POST" class="hidden"
          onsubmit="return confirm('Delete this book permanently? This action cannot be undone.')">
        @csrf
        @method('DELETE')
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const coverInput = document.getElementById('coverInput');
    const removeCoverInput = document.getElementById('removeCoverInput');
    if (coverInput) {
        coverInput.addEventListener('change', function(e) {
            const preview = document.getElementById('coverPreview');
            const placeholder = document.getElementById('coverPlaceholder');
            const file = e.target.files[0];
            if (file) {
                if (removeCoverInput) {
                    removeCoverInput.checked = false;
                }
                const reader = new FileReader();
                reader.onload = function(e) {
                    placeholder.classList.add('hidden');
                    preview.classList.remove('hidden');
                    preview.innerHTML = `
                        <div class="image-preview-wrapper">
                             <img src="${e.target.result}" alt="Preview" class="h-[180px]">
                            <button type="button" class="remove-btn"
                                    onclick="document.getElementById('coverInput').value=''; preview.innerHTML=''; preview.classList.add('hidden'); placeholder.classList.remove('hidden');">
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
