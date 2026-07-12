@php
    $isEdit = isset($book);
    $bookTitle       = $isEdit ? old('title', $book->title) : old('title');
    $bookAuthor      = $isEdit ? old('author', $book->author) : old('author');
    $bookDescription = $isEdit ? old('description', $book->description) : old('description');
    $bookPrice       = $isEdit ? old('price', $book->price) : old('price');
    $bookStock       = $isEdit ? old('stock', $book->stock) : old('stock');
    $bookSortOrder   = $isEdit ? old('sort_order', $book->sort_order) : old('sort_order');
    $bookAvailable   = $isEdit ? old('is_available', $book->is_available) : old('is_available', true);
@endphp

<div class="form-grid grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Title --}}
    <div class="form-group">
        <label class="form-label">Title <span class="required">*</span></label>
        <input type="text" name="title" value="{{ $bookTitle }}" required
               class="form-control @error('title') error @enderror"
               placeholder="e.g. The Silent Patient">
        @error('title')<div class="form-error">{{ $message }}</div>@enderror
    </div>

    {{-- Author --}}
    <div class="form-group">
        <label class="form-label">Author</label>
        <input type="text" name="author" value="{{ $bookAuthor }}"
               class="form-control @error('author') error @enderror"
               placeholder="e.g. Alex Michaelides">
        @error('author')<div class="form-error">{{ $message }}</div>@enderror
    </div>
</div>

{{-- Description --}}
<div class="form-group">
    <label class="form-label">Description</label>
    <textarea name="description" rows="3" class="form-control content @error('description') error @enderror"
              placeholder="Write a short description or synopsis for the book...">{{ $bookDescription }}</textarea>
    @error('description')<div class="form-error">{{ $message }}</div>@enderror
</div>

<div class="form-grid grid grid-cols-1 md:grid-cols-3 gap-6">
    {{-- Price --}}
    <div class="form-group">
        <label class="form-label">Price (USD) <span class="required">*</span></label>
        <input type="number" name="price" value="{{ $bookPrice }}" required step="0.01" min="0"
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

    {{-- Sort Order --}}
    <div class="form-group">
        <label class="form-label">Display Order</label>
        <input type="number" name="sort_order" value="{{ $bookSortOrder }}" min="0"
               class="form-control @error('sort_order') error @enderror"
               placeholder="0">
        @error('sort_order')<div class="form-error">{{ $message }}</div>@enderror
    </div>
</div>

{{-- Available for purchase --}}
<div class="form-group form-group--no-margin">
    <div class="publish-option bg-white border border-gray-100 rounded-2xl p-4 flex items-center gap-4 hover:shadow-sm transition-all">
        <input type="checkbox" name="is_available" id="is_available" value="1"
               class="w-5 h-5 accent-[#2d6fa3] cursor-pointer"
               {{ $bookAvailable ? 'checked' : '' }}>
        <div>
            <div class="text-sm font-bold text-[#1a3c6e]">Available for purchase</div>
            <div class="text-[11px] text-gray-400">Show on the public Books for Sale page</div>
        </div>
    </div>
</div>

{{-- Cover Image --}}
<div class="form-group">
    <label class="form-label">Cover Image {{ $isEdit ? '' : '(optional)' }}</label>
    <div class="upload-area border-2 border-dashed border-[#2d6fa3]/30 hover:border-[#2d6fa3] hover:bg-[#f8fafc] transition-all rounded-2xl p-10 text-center cursor-pointer"
         onclick="document.getElementById('coverInput').click()">
        <input type="file" name="cover_image" id="coverInput" accept="image/*" class="hidden">
        <div id="coverPlaceholder">
            <svg class="w-12 h-12 text-[#2d6fa3]/40 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <div class="text-sm font-bold text-[#1a3c6e]">Click to upload cover image</div>
            <div class="text-xs text-gray-400 mt-2">JPG, PNG or WebP (Max 2MB)</div>
        </div>
        <div id="coverPreview" class="hidden mt-4"></div>
    </div>
    @if($isEdit && $book->cover_image)
    <div class="mt-3 flex items-center gap-3">
        <img src="{{ $book->cover_image_url }}" alt="Cover" class="w-12 h-16 object-cover rounded-lg shadow-sm">
        <div class="text-xs text-gray-500">Current cover: {{ $book->cover_image }}</div>
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
                            <img src="${e.target.result}" alt="Preview" style="height: 180px;">
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
