@php
    $isEdit = isset($book);
    $bookTitle       = old('title', $book->title ?? '');
    $bookDescription = old('description', $book->description ?? '');
    $bookPrice       = old('price', $book->price ?? '');
    $bookStock       = old('stock', $book->stock ?? '');
    $bookAvailable   = old('is_available', $book->is_available ?? true);
@endphp

<div class="form-group">
    <label class="form-label">Title <span class="required">*</span></label>
    <input type="text" name="title" value="{{ $bookTitle }}" required
           class="form-control @error('title') error @enderror"
           placeholder="e.g. The Silent Patient">
    @error('title')<div class="form-error">{{ $message }}</div>@enderror
</div>

{{-- Description --}}
<div class="form-group">
    <label class="form-label">Description</label>
    <textarea name="description" rows="3" class="form-control textarea @error('description') error @enderror"
              placeholder="Write a short description or synopsis for the book...">{{ $bookDescription }}</textarea>
    @error('description')<div class="form-error">{{ $message }}</div>@enderror
</div>

<div class="form-grid grid grid-cols-1 md:grid-cols-2 gap-4">
    {{-- Price --}}
    <div class="form-group">
        <label class="form-label">Price (USD) <span class="text-xs text-slate-400 font-normal">(optional)</span></label>
        <input type="number" name="price" value="{{ $bookPrice }}" step="0.01" min="0"
               class="form-control @error('price') error @enderror"
               placeholder="e.g. 24.99">
        @error('price')<div class="form-error">{{ $message }}</div>@enderror
    </div>

    {{-- Stock --}}
    <div class="form-group">
        <label class="form-label">Stock</label>
        <input type="number" name="stock" value="{{ $bookStock }}" min="0"
               class="form-control @error('stock') error @enderror"
               placeholder="0">
        @error('stock')<div class="form-error">{{ $message }}</div>@enderror
    </div>

</div>{{-- Available for purchase --}}
<div class="form-group form-group--no-margin">
    <div class="publish-option">
        <input type="checkbox" name="is_available" id="is_available" value="1"
               {{ $bookAvailable ? 'checked' : '' }}>
        <div>
            <div class="label">Available for purchase</div>
            <div class="description">Show on the public Book for Sales page</div>
        </div>
    </div>
</div>

{{-- Cover Image --}}
<div class="form-group">
    <label class="form-label">Cover Image {{ $isEdit ? '' : '(optional)' }}</label>
    <div class="upload-area" onclick="document.getElementById('coverInput').click()">
        <input type="file" name="cover_image" id="coverInput" accept="image/*" class="hidden">
        <div id="coverPlaceholder">
            <svg class="upload-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <div class="upload-title">Click to upload cover image</div>
            <div class="upload-subtitle">JPG, PNG or WebP (Max 2MB)</div>
        </div>
        <div id="coverPreview" class="hidden mt-3"></div>
    </div>
    @if($isEdit && $book->cover_image)
    <div class="current-image">
        <img src="{{ $book->cover_image_url }}" alt="Cover">
        <div class="image-info">
            <strong>Current cover</strong>
            <div class="text-small-info">{{ $book->cover_image }}</div>
        </div>
    </div>
    @endif
    @error('cover_image')<div class="form-error">{{ $message }}</div>@enderror
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
