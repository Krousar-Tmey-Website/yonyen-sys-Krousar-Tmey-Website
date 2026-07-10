@extends('admin.layouts.app')

@section('title', 'Edit Item: ' . $item->title)
@section('page-title', 'Edit Page Item')
@section('breadcrumb')
    <a href="{{ route('admin.program-pages.index') }}" class="hover:text-[#2d6fa3] transition-colors">Additional Pages</a> / Edit
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
<form action="{{ route('admin.program-pages.update', $item) }}" method="POST" enctype="multipart/form-data"
      class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    @csrf
    @method('PUT')
    <div class="p-6 space-y-6">

        {{-- Title --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title', $item->title) }}" required
                   class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm">
            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Short Content --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Short Content <span class="text-gray-400 font-normal">(shown on card preview)</span></label>
            <textarea name="short_content" rows="3"
                      class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm"
                      placeholder="Brief description that appears on the card listing...">{{ old('short_content', $item->short_content) }}</textarea>
            @error('short_content')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Detail Content --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Full Detail Content <span class="text-gray-400 font-normal">(shown when viewer clicks "Read More")</span></label>
            <textarea name="detail_content" rows="14"
                      class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm font-mono"
                      placeholder="Full content (HTML is supported)...">{{ old('detail_content', $item->detail_content) }}</textarea>
            @error('detail_content')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <hr class="border-gray-100">

        {{-- Images --}}
        <div>
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Images</h3>
            @foreach([
                ['label' => 'Primary Image', 'field' => 'image', 'url_field' => 'image_url', 'current_url' => $item->image_url, 'has' => (bool)$item->image],
                ['label' => 'Image 2', 'field' => 'image_2', 'url_field' => 'image_2_url', 'current_url' => $item->image_2_url, 'has' => (bool)$item->image_2],
                ['label' => 'Image 3', 'field' => 'image_3', 'url_field' => 'image_3_url', 'current_url' => $item->image_3_url, 'has' => (bool)$item->image_3],
            ] as $img)
            <div class="mb-5 pb-5 border-b border-gray-50 last:border-0">
                <div class="font-medium text-xs text-gray-600 mb-2">{{ $img['label'] }}</div>
                @if($img['has'])
                <img src="{{ $img['current_url'] }}" class="h-20 rounded-lg object-cover mb-3 border border-gray-200" alt="Current">
                <p class="text-xs text-gray-400 mb-2">Upload or enter a new URL to replace the current image.</p>
                @endif
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">Upload new</label>
                        <input type="file" name="{{ $img['field'] }}" accept="image/*"
                               class="w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs text-gray-500 mb-1">OR new URL</label>
                        <input type="url" name="{{ $img['url_field'] }}" value="{{ old($img['url_field']) }}" placeholder="https://..."
                               class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm">
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <hr class="border-gray-100">

        {{-- Sort Order & Status --}}
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $item->sort_order) }}" min="0"
                       class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm">
                <p class="text-xs text-gray-400 mt-1">Lower = appears first</p>
            </div>
            <div class="flex items-end pb-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $item->is_active ? '1' : '0') == '1' ? 'checked' : '' }}
                           class="rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]">
                    <span class="text-sm font-medium text-gray-700">Publish this item</span>
                </label>
            </div>
        </div>

    </div>
    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex items-center justify-between gap-3">
        <form action="{{ route('admin.program-pages.destroy', $item) }}" method="POST"
              onsubmit="return confirm('Delete this item permanently?');">
            @csrf @method('DELETE')
            <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-medium flex items-center gap-1.5 hover:bg-red-50 px-3 py-2 rounded-lg transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Delete Item
            </button>
        </form>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.program-pages.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">Cancel</a>
            <button type="submit" class="bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white px-6 py-2 rounded-xl text-sm font-medium transition-colors">
                Update Item
            </button>
        </div>
    </div>
</form>
</div>
@endsection
