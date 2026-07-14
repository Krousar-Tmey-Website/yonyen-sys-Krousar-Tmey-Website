@extends('admin.layouts.app')

@push('styles')
<style>
    .category-checkbox-group {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 8px;
        max-height: 240px;
        overflow-y: auto;
        padding: 4px;
    }
    .category-checkbox-group label {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        font-size: 13px;
        color: #374151;
        cursor: pointer;
        transition: all 0.15s;
    }
    .category-checkbox-group label:hover {
        border-color: #2d6fa3;
        background: #eff6ff;
    }
    .category-checkbox-group label:has(input:checked) {
        border-color: #2d6fa3;
        background: #eff6ff;
        color: #1e40af;
        font-weight: 500;
    }
    .category-checkbox-group input[type="checkbox"] {
        width: 16px;
        height: 16px;
        accent-color: #2d6fa3;
        flex-shrink: 0;
    }
    .media-preview-box {
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        background: #f9fafb;
    }
    .media-preview-box video,
    .media-preview-box img {
        width: 100%;
        max-height: 220px;
        object-fit: contain;
        background: #111827;
    }
</style>
@endpush

@section('title', 'Edit Media — ' . $media->title)
@section('page-title', 'Edit Media')
@section('breadcrumb', $media->title)

@section('content')

@if($errors->any())
<div class="max-w-3xl mx-auto mb-5 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
    <ul class="list-disc list-inside space-y-1">
        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
    </ul>
</div>
@endif

<div class="max-w-3xl mx-auto">
    <form action="{{ route('admin.media.update', $media) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        {{-- Current Media Preview --}}
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-50 bg-gray-50/50">
                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Current Media</h3>
            </div>
            <div class="p-6">
                <div class="media-preview-box max-w-sm">
                    @if($media->file_type === 'image')
                    <img src="{{ $media->file_url }}" alt="{{ $media->title }}">
                    @else
                    <video src="{{ $media->file_url }}" controls></video>
                    @endif
                </div>
                <div class="mt-3 flex flex-wrap items-center gap-3">
                    <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full
                        {{ $media->file_type === 'image' ? 'bg-blue-50 text-blue-600' : 'bg-purple-50 text-purple-600' }}">
                        @if($media->file_type === 'image')
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Image
                        @else
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                        Video
                        @endif
                    </span>
                    <span class="text-xs text-gray-400">{{ $media->mime_type }}</span>
                    <span class="text-xs text-gray-400">{{ $media->formatted_size }}</span>
                    <span class="text-xs text-gray-400">{{ $media->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>

        {{-- Replace File --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Replace File <span class="font-normal text-gray-400 normal-case">(optional)</span></h3>
            <div>
                <input type="file" name="file" accept=".jpg,.jpeg,.png,.webp,.gif,.svg,.mp4,.mov,.avi,.webm,.ogg"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                <p class="mt-1.5 text-xs text-gray-400">Leave empty to keep the current file. Max 100MB.</p>
            </div>
        </div>

        {{-- Thumbnail --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Thumbnail</h3>
            @if($media->thumbnail_url && $media->thumbnail_path !== $medium->file_path)
            <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl">
                <img src="{{ $media->thumbnail_url }}" alt="Thumbnail" class="h-16 w-auto rounded-lg border border-gray-200">
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-medium text-gray-600">Current thumbnail</p>
                    <p class="text-xs text-gray-400 truncate">{{ basename($media->thumbnail_path) }}</p>
                </div>
                <label class="flex items-center gap-1.5 text-xs text-red-500 hover:text-red-700 cursor-pointer flex-shrink-0">
                    <input type="checkbox" name="remove_thumbnail" value="1" class="rounded border-gray-300 text-red-500 w-3.5 h-3.5">
                    Remove
                </label>
            </div>
            @elseif($media->file_type === 'image')
            <p class="text-xs text-gray-400">The uploaded image is used as its own thumbnail.</p>
            @else
            <p class="text-xs text-gray-400">No custom thumbnail set. A default video icon will be shown.</p>
            @endif
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ $media->thumbnail_url && $media->thumbnail_path !== $medium->file_path ? 'Replace Thumbnail' : 'Upload Thumbnail' }}</label>
                <input type="file" name="thumbnail" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
            </div>
        </div>

        {{-- Title & Description --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Media Information</h3>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Title <span class="text-red-400">*</span></label>
                <input type="text" name="title" value="{{ old('title', $media->title) }}" required
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Description</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                          placeholder="Optional description or caption...">{{ old('description', $media->description) }}</textarea>
            </div>
        </div>

        {{-- Categories (multi-select) --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                Categories
                <span class="font-normal text-gray-400 normal-case">(select multiple)</span>
            </h3>
            @php $selectedCats = $media->categories->pluck('CategoryID')->toArray(); @endphp
            @if($categories->isEmpty())
            <p class="text-sm text-gray-400">No categories available.</p>
            @else
            <div class="category-checkbox-group">
                @foreach($categories as $cat)
                <label>
                    <input type="checkbox" name="category_ids[]" value="{{ $cat->CategoryID }}"
                           {{ in_array($cat->CategoryID, old('category_ids', $selectedCats)) ? 'checked' : '' }}>
                    {{ $cat->CategoryName }}
                </label>
                @endforeach
            </div>
            @endif
        </div>

        {{-- Active toggle --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                <input type="checkbox" name="is_active" id="is_active" value="1"
                       {{ old('is_active', $media->is_active) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                <label for="is_active" class="text-sm font-medium text-gray-700">Active (visible on the website)</label>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-between gap-3 pb-4">
            <div class="flex items-center gap-3">
                <button type="submit"
                        class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-semibold rounded-xl transition-colors inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Save Changes
                </button>
                <a href="{{ route('admin.media.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
            </div>
            {{-- Danger zone --}}
            <button type="button" onclick="confirmDelete({{ $media->id }}, '{{ addslashes($media->title) }}')"
                    class="inline-flex items-center gap-1.5 text-red-400 hover:text-red-600 text-xs font-medium">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Delete
            </button>
        </div>
    </form>
</div>

{{-- Delete Modal --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden" x-data="{ show: false }" x-show="show"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     style="display: none;">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="show = false"></div>
    <div class="relative z-10 flex items-center justify-center min-h-full p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6"
             @click.away="show = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            <div class="text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-red-50 flex items-center justify-center">
                    <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Delete Media</h3>
                <p class="text-sm text-gray-500 mb-1">Are you sure you want to delete</p>
                <p class="text-sm font-semibold text-gray-700 mb-6" id="deleteItemName">"this item"?</p>
                <p class="text-xs text-red-500 mb-6">This action cannot be undone. The file will be permanently removed.</p>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" onclick="closeDeleteModal()"
                        class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 text-sm font-medium rounded-xl hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" action="{{ route('admin.media.destroy', $media) }}" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm">
                        Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, title) {
    const modal = document.getElementById('deleteModal');
    const nameEl = document.getElementById('deleteItemName');
    nameEl.textContent = `"${title}"?`;
    modal.style.display = 'block';
    modal.__x.$data.show = true;
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    if (modal.__x) {
        modal.__x.$data.show = false;
    }
    modal.style.display = 'none';
}
</script>

@endsection
