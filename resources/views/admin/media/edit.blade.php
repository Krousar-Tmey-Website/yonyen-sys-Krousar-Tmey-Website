@extends('admin.layouts.app')
@section('title', 'Edit Media Item')
@section('page-title', 'Edit Media Item')

@section('content')

@if($errors->any())
<div class="max-w-3xl mx-auto mb-6 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
    <ul class="list-disc list-inside space-y-1">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="max-w-3xl mx-auto space-y-6">
    <form action="{{ route('admin.media.update', $item) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        {{-- Details --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                <span class="text-base">📝</span> Details
            </h3>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Title <span class="text-red-400">*</span></label>
                <input type="text" name="title" value="{{ old('title', $item->title) }}" required
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Type <span class="text-red-400">*</span></label>
                <select name="type" required
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    <option value="image" {{ (old('type', $item->type) === 'image') ? 'selected' : '' }}>Image</option>
                    <option value="video" {{ (old('type', $item->type) === 'video') ? 'selected' : '' }}>Video</option>
                    <option value="document" {{ (old('type', $item->type) === 'document') ? 'selected' : '' }}>Document</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Description (optional)</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('description', $item->description) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Alt Text (optional)</label>
                <input type="text" name="alt_text" value="{{ old('alt_text', $item->alt_text) }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400">For accessibility and SEO — describes the image content.</p>
            </div>
        </div>

        {{-- Media File --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                <span class="text-base">🖼️</span> Media File
            </h3>

            @if($item->file_path)
            <div class="flex items-center gap-4 p-3 bg-gray-50 rounded-xl border border-gray-100">
                @if($item->type === 'image')
                <img src="{{ $item->image_url }}" alt="{{ $item->alt_text ?? $item->title }}" class="h-16 w-24 object-cover rounded-lg border border-gray-200">
                @elseif($item->type === 'video')
                <div class="h-16 w-24 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M10 16.5l6-4.5-6-4.5v9zM21 19V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2z"/></svg>
                </div>
                @else
                <div class="h-16 w-24 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                @endif
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-medium text-gray-600 mb-0.5">Current file</p>
                    <p class="text-xs text-gray-400 truncate">{{ basename($item->file_path) }}</p>
                </div>
                <label class="flex items-center gap-1.5 text-xs text-red-500 hover:text-red-700 cursor-pointer flex-shrink-0">
                    <input type="checkbox" name="remove_file" value="1" class="rounded border-gray-300 text-red-500 w-3.5 h-3.5">
                    Remove
                </label>
            </div>
            @else
            <div class="flex items-center gap-3 p-3 bg-[#2d6fa3]/5 rounded-xl border border-[#2d6fa3]/10">
                <div class="h-16 w-24 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                    <span class="text-[#2d6fa3]/50 text-xs">No file</span>
                </div>
                <p class="text-xs text-gray-500">No file uploaded yet.</p>
            </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Replace File (optional)</label>
                <input type="file" name="file" accept="image/*,video/*,.pdf,.doc,.docx,.xls,.xlsx"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                <p class="mt-1.5 text-xs text-gray-400">Max 10MB. Leave empty to keep current file.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">External URL (optional)</label>
                <input type="url" name="external_url" value="{{ old('external_url', $item->external_url) }}" placeholder="https://..."
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400">If provided, clicking the item will open this URL instead of the uploaded file.</p>
            </div>
        </div>

        {{-- Display Options --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                <span class="text-base">⚙️</span> Display Options
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order) }}" min="0"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    <p class="mt-1.5 text-xs text-gray-400">Lower numbers appear first. Default 0.</p>
                </div>
                <div class="flex items-end">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl w-full">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $item->is_active) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                        <label for="is_active" class="text-sm font-medium text-gray-700">Active</label>
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-semibold rounded-xl transition-colors">
                Save Changes
            </button>
            <a href="{{ route('admin.media.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>
@endsection