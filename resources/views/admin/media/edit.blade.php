@extends('admin.layouts.app')

@section('title', 'Edit Media Item')
@section('page-title', 'Edit Media Item')
@section('breadcrumb', 'Media Gallery → Edit')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="font-bold text-gray-800">Edit Media Item</h3>
                <p class="text-sm text-gray-400 mt-0.5">Update media item details and configuration.</p>
            </div>
            <a href="{{ route('admin.media.index') }}"
               class="px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-200 transition">
                Back to list
            </a>
        </div>

        <form action="{{ route('admin.media.update', $media) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')

            <div class="space-y-4">
                {{-- Title --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Title <span class="text-red-400">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $media->title) }}" required
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="e.g. Classical arts not a priority in schools today">
                    @error('title')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>

                {{-- Source --}}
                <div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Source <span class="text-gray-400">(optional)</span></label>
                        <input type="text" name="source" value="{{ old('source', $media->source) }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="e.g. Press Article / The Phnom Penh Post">
                        @error('source')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                        <p class="text-xs text-gray-400 mt-1.5">Displayed as the section label on the Media page.</p>
                    </div>
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Description <span class="text-gray-400">(optional)</span></label>
                    <textarea name="description" rows="3"
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                              placeholder="The italic excerpt paragraph shown on the media page...">{{ old('description', $media->description) }}</textarea>
                    @error('description')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>

                {{-- External Link --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">External Article URL <span class="text-gray-400">(optional)</span></label>
                    <input type="url" name="external_link" value="{{ old('external_link', $media->external_link) }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="https://example.com/article-url">
                    @error('external_link')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                    <p class="text-xs text-gray-400 mt-1.5">Used for the "Read the article" button on the featured item.</p>
                </div>

                {{-- Image --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Media Image <span class="text-gray-400">(optional)</span></label>

                    {{-- Current Image --}}
                    @if($media->image)
                    <div class="mb-4 flex items-center gap-4 bg-gray-50 border border-gray-200 rounded-2xl p-4">
                        <div class="w-20 h-14 bg-white rounded-xl border border-gray-100 overflow-hidden flex-shrink-0">
                            <img src="{{ $media->image_url }}" alt="" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Current image</p>
                            <label class="inline-flex items-center gap-1.5 mt-1 text-xs text-gray-500 cursor-pointer hover:text-red-500 transition-colors">
                                <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]/20">
                                Remove this image
                            </label>
                        </div>
                    </div>
                    @endif

                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 bg-gray-50/30 text-center cursor-pointer hover:border-[#2d6fa3]/40 transition-colors"
                         onclick="document.getElementById('imageInput').click()">
                        <input type="file" name="image" id="imageInput" accept="image/*" class="hidden">
                        <div id="imagePlaceholder">
                            <svg class="mx-auto h-10 w-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-sm font-medium text-gray-600 mb-1">Click to upload new image</p>
                            <p class="text-xs text-gray-400">Max 2MB. JPG, PNG, or WebP</p>
                        </div>
                        <div id="imagePreview" class="hidden mt-3"></div>
                    </div>
                    @error('image')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>

                {{-- Sort Order --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Sort Order <span class="text-gray-400">(optional)</span></label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $media->sort_order) }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    @error('sort_order')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                    <p class="text-xs text-gray-400 mt-1.5">Lower numbers appear first.</p>
                </div>

                {{-- Publishing --}}
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" name="is_published" id="is_published" value="1"
                               {{ old('is_published', $media->is_published) ? 'checked' : '' }}
                               class="w-4 h-4 rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]/20">
                        <label for="is_published" class="text-sm font-medium text-gray-700">Visible on public page</label>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Published Date <span class="text-gray-400">(optional)</span></label>
                        <input type="date" name="published_at" value="{{ old('published_at', $media->published_at ? $media->published_at->format('Y-m-d') : date('Y-m-d')) }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        @error('published_at')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                        <p class="text-xs text-gray-400 mt-1.5">Set the publication date for this media item.</p>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-wrap items-center justify-between gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.media.index') }}"
                   class="px-4 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl transition">
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-semibold transition-all shadow-sm hover:shadow-md">
                    Update Media Item
                </button>
            </div>
        </form>
    </div>
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
                        <div class="relative inline-block">
                            <img src="${e.target.result}" alt="Preview" class="max-h-48 rounded-lg border border-gray-200">
                            <button type="button" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full text-xs flex items-center justify-center hover:bg-red-600 transition"
                                    onclick="document.getElementById('imageInput').value=''; preview.innerHTML=''; preview.classList.add('hidden'); placeholder.classList.remove('hidden');">
                                ×
                            </button>
                            <p class="text-xs text-gray-500 mt-1">${file.name} (${(file.size / 1024).toFixed(1)} KB)</p>
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
