@extends('admin.layouts.app')

@section('title', 'Add Page Item')
@section('page-title', 'Add Page Item')
@section('breadcrumb')
    <a href="{{ route('admin.program-pages.index') }}" class="hover:text-[#2d6fa3] transition-colors">Additional Pages</a> / Add
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
<form action="{{ route('admin.program-pages.store') }}" method="POST" enctype="multipart/form-data"
      class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    @csrf
    <div class="p-6 space-y-6">

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

        {{-- Objective --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Objective</label>
            <textarea name="objective" rows="3"
                      class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm"
                      placeholder="e.g. To protect the health of Cambodian children...">{{ old('objective') }}</textarea>
            @error('objective')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Detail Content (The Project) --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">The Project (Detail Content)</label>
            <textarea name="detail_content" rows="10"
                      class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm font-mono"
                      placeholder="Full content (HTML is supported)...">{{ old('detail_content') }}</textarea>
            @error('detail_content')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        {{-- Activities --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Activities</label>
            <textarea name="activities" rows="5"
                      class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm"
                      placeholder="Activity 1&#10;Activity 2...">{{ old('activities') }}</textarea>
            <p class="text-xs text-gray-500 mt-1.5">Each new line will be displayed as a bullet point on the public page.</p>
            @error('activities')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
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

    {{-- ── Action Bar (footer of this card) ───── --}}
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 flex items-center justify-end gap-3">
        <a href="{{ route('admin.program-pages.index') }}"
           class="px-5 py-2 text-sm font-medium text-gray-500 hover:text-gray-800 rounded-xl hover:bg-gray-100 transition-all border border-transparent hover:border-gray-200">
            Cancel
        </a>
        <button type="submit"
                class="inline-flex items-center gap-2 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white px-7 py-2.5 rounded-xl text-sm font-semibold transition-all shadow-sm hover:shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create Item
        </button>
    </div>
</form>
@endsection
