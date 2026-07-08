@extends('admin.layouts.app')

@section('title', 'Add Page Item')
@section('page-title', 'Add Page Item')
@section('breadcrumb')
    <a href="{{ route('admin.program-page-items.index') }}" class="hover:text-[#2d6fa3] transition-colors">Page Items</a> / Add
@endsection

@section('content')
<div class="max-w-4xl">
<form action="{{ route('admin.program-page-items.store') }}" method="POST" enctype="multipart/form-data"
      class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    @csrf
    <div class="p-6 space-y-6">

        {{-- Assign to Page --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Assign to Page</label>
            <select name="program_page_id"
                    class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm">
                <option value="">— No page (unassigned) —</option>
                @foreach($pages as $p)
                <option value="{{ $p->id }}" {{ old('program_page_id') == $p->id ? 'selected' : '' }}>
                    {{ $p->title }}
                </option>
                @endforeach
            </select>
            <p class="text-gray-400 text-xs mt-1">Select which Additional Page this item will appear under. Leave blank to keep unassigned.</p>
            @error('program_page_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <hr class="border-gray-100">

        {{-- Title --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm"
                   placeholder="e.g. Child Protection Services">
            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Short Content --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Short Content <span class="text-gray-400 font-normal">(shown on card preview)</span></label>
            <textarea name="short_content" rows="3"
                      class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm"
                      placeholder="Brief description that appears on the card listing...">{{ old('short_content') }}</textarea>
            @error('short_content')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Detail Content --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Full Detail Content <span class="text-gray-400 font-normal">(shown when viewer clicks "Read More")</span></label>
            <textarea name="detail_content" rows="14"
                      class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm font-mono"
                      placeholder="Full content (HTML is supported)...">{{ old('detail_content') }}</textarea>
            @error('detail_content')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <hr class="border-gray-100">

        {{-- Images --}}
        <div>
            <h3 class="text-sm font-semibold text-gray-700 mb-4">Images <span class="text-gray-400 font-normal text-xs">(up to 3 — all shown on the detail page)</span></h3>

            @foreach([
                ['label' => 'Primary Image', 'field' => 'image', 'url_field' => 'image_url'],
                ['label' => 'Image 2', 'field' => 'image_2', 'url_field' => 'image_2_url'],
                ['label' => 'Image 3', 'field' => 'image_3', 'url_field' => 'image_3_url'],
            ] as $img)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4 pb-4 border-b border-gray-50 last:border-0">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">{{ $img['label'] }} (Upload)</label>
                    <input type="file" name="{{ $img['field'] }}" accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20 transition-all">
                    @error($img['field'])<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">OR Image URL</label>
                    <input type="url" name="{{ $img['url_field'] }}" value="{{ old($img['url_field']) }}" placeholder="https://..."
                           class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm">
                    @error($img['url_field'])<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
            @endforeach
        </div>

        <hr class="border-gray-100">

        {{-- Sort Order & Status --}}
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                       class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm">
                <p class="text-xs text-gray-400 mt-1">Lower = appears first</p>
            </div>
            <div class="flex items-end pb-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}
                           class="rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]">
                    <span class="text-sm font-medium text-gray-700">Publish this item</span>
                </label>
            </div>
        </div>

    </div>
    <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 flex items-center justify-end gap-3">
        <a href="{{ route('admin.program-page-items.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-gray-900">Cancel</a>
        <button type="submit" class="bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white px-6 py-2 rounded-xl text-sm font-medium transition-colors">
            Create Item
        </button>
    </div>
</form>
</div>
@endsection
