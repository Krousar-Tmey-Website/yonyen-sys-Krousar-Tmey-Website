@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
@endpush

@php use Illuminate\Support\Str; @endphp

@section('title', 'Edit Book')
@section('page-title', 'Edit Book')
@section('breadcrumb', 'Books → ' . Str::limit($book->title, 40))

@section('content')

<div class="form-container">
    <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Book Details --}}
        <div x-data="bilingualForm()">
        <div class="form-card">
            <div class="card-header">
                <div class="icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253\"/>
                    </svg>
                </div>
                <div class="flex items-center justify-between mb-4"><h3>Book Details</h3>
    <div class="lang-tabs" title="Toggle editing language (English / French)">
    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
</div>
</div>
                <div class="header-actions">
                    <span class="badge">Required *</span>
                </div>
            </div>
            <div class="card-body">
                <div class="form-grid grid grid-cols-1 md:grid-cols-2 gap-4">
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
                </div>
            </div>
        </div>

        {{-- Description --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon purple">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                </div>
                <h3>Description</h3>
                <div class="header-actions">
                </div>
            </div>
            <div class="card-body">
                <div class="form-group" x-show="lang === 'en'">
                    <textarea name="description" rows="3" class="form-control textarea"
                              placeholder="Write a short description or synopsis for the book...">{{ old('description', $book->description) }}</textarea>
                    @error('description')<div class="form-error">{{ $message }}</div>@enderror
                </div>

                <div class="form-group" x-show="lang === 'fr'" x-cloak>
                    <textarea name="description_fr" rows="3" class="form-control textarea"
                              placeholder="Rédigez une courte description ou un résumé du livre en français...">{{ old('description_fr', $book->description_fr) }}</textarea>
                    @error('description_fr')<div class="form-error">{{ $message }}</div>@enderror
                    <div class="form-helper">Shown to French-language visitors. Leave blank to reuse the English description.</div>
                </div>
            </div>
        </div>
        </div>

        {{-- Cover & Publishing --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon green">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h3>Cover Image &amp; Publishing</h3>
            </div>
            <div class="card-body">
                @if($book->cover_image)
                <div class="form-group">
                    <label class="form-label">Current Cover</label>
                    <div class="current-image">
                        <img src="{{ $book->cover_image_url }}" alt="Current cover">
                        <div class="image-info">
                            <strong>Current cover</strong>
                            <div class="text-small-info">Replace below if needed</div>
                        </div>
                    </div>
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
        </div>

        {{-- Actions --}}
        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                Update Book
            </button>
            <a href="{{ route('admin.books.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>

    {{-- Delete Form --}}
    <div class="form-actions form-actions--delete">
        <form action="{{ route('admin.books.destroy', $book) }}" method="POST"
              class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete Book
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const coverInput = document.getElementById('coverInput');
    if (coverInput) {
        coverInput.addEventListener('change', function(e) {
            const preview = document.getElementById('coverPreview');
            const placeholder = document.getElementById('coverPlaceholder');
            const file = e.target.files[0];
            if (file) {
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
