@extends('admin.layouts.app')

@section('title', 'Edit Item: ' . $item->title)
@section('page-title', 'Edit Page Item')
@section('breadcrumb')
    <a href="{{ route('admin.program-pages.index') }}" class="hover:text-[#2d6fa3] transition-colors">Additional Pages</a> / Edit
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
<form id="main-update-form" action="{{ route('admin.program-pages.update', $item) }}" method="POST" enctype="multipart/form-data"
      class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    @csrf
    @method('PUT')
    <div class="p-6 space-y-6">

        <div x-data="{ lang: 'en' }" class="space-y-6">

        {{-- Language Tabs --}}
        <div class="flex items-center justify-between">
            <span class="text-xs font-semibold text-gray-400 uppercase tracking-wide">Translatable Fields</span>
            <div class="lang-tabs">
                <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'">EN</button>
                <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'">FR</button>
            </div>
        </div>

        {{-- Title --}}
        <div x-show="lang === 'en'">
            <label class="block text-sm font-medium text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title', $item->title) }}"
                   class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm">
            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div x-show="lang === 'fr'" x-cloak>
            <label class="block text-sm font-medium text-gray-700 mb-1">Title (French) <span class="text-gray-400 font-normal">(optional)</span></label>
            <input type="text" name="title_fr" value="{{ old('title_fr', $item->title_fr) }}"
                   class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm"
                   placeholder="Titre en français...">
            @error('title_fr')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-gray-400 mt-1.5">Shown to French-language visitors. Leave blank to reuse the English value.</p>
        </div>

        {{-- Short Content --}}
        <div x-show="lang === 'en'">
            <label class="block text-sm font-medium text-gray-700 mb-1">Short Content <span class="text-gray-400 font-normal">(shown on card preview)</span></label>
            <textarea name="short_content" rows="3"
                      class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm"
                      placeholder="Brief description that appears on the card listing...">{{ old('short_content', $item->short_content) }}</textarea>
            @error('short_content')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div x-show="lang === 'fr'" x-cloak>
            <label class="block text-sm font-medium text-gray-700 mb-1">Short Content (French) <span class="text-gray-400 font-normal">(optional)</span></label>
            <textarea name="short_content_fr" rows="3"
                      class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm"
                      placeholder="Brève description en français...">{{ old('short_content_fr', $item->short_content_fr) }}</textarea>
            @error('short_content_fr')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-gray-400 mt-1.5">Shown to French-language visitors. Leave blank to reuse the English value.</p>
        </div>

        {{-- Objective --}}
        <div x-show="lang === 'en'">
            <label class="block text-sm font-medium text-gray-700 mb-1">Objective</label>
            <textarea name="objective" rows="3"
                      class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm"
                      placeholder="e.g. To protect the health of Cambodian children...">{{ old('objective', $item->objective) }}</textarea>
            @error('objective')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div x-show="lang === 'fr'" x-cloak>
            <label class="block text-sm font-medium text-gray-700 mb-1">Objective (French) <span class="text-gray-400 font-normal">(optional)</span></label>
            <textarea name="objective_fr" rows="3"
                      class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm"
                      placeholder="Objectif en français...">{{ old('objective_fr', $item->objective_fr) }}</textarea>
            @error('objective_fr')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-gray-400 mt-1.5">Shown to French-language visitors. Leave blank to reuse the English value.</p>
        </div>

        {{-- Detail Content (The Project) --}}
        <div x-show="lang === 'en'">
            <label class="block text-sm font-medium text-gray-700 mb-1">The Project (Detail Content)</label>
            <textarea name="detail_content" rows="10"
                      class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm font-mono"
                      placeholder="Full content (HTML is supported)...">{{ old('detail_content', $item->detail_content) }}</textarea>
            @error('detail_content')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div x-show="lang === 'fr'" x-cloak>
            <label class="block text-sm font-medium text-gray-700 mb-1">The Project (French) <span class="text-gray-400 font-normal">(optional)</span></label>
            <textarea name="detail_content_fr" rows="10"
                      class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm font-mono"
                      placeholder="Contenu complet en français (HTML pris en charge)...">{{ old('detail_content_fr', $item->detail_content_fr) }}</textarea>
            @error('detail_content_fr')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-gray-400 mt-1.5">Shown to French-language visitors. Leave blank to reuse the English value.</p>
        </div>

        {{-- Activities --}}
        <div x-show="lang === 'en'">
            <label class="block text-sm font-medium text-gray-700 mb-1">Activities</label>
            <textarea name="activities" rows="5"
                      class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm"
                      placeholder="Activity 1&#10;Activity 2...">{{ old('activities', $item->activities) }}</textarea>
            <p class="text-xs text-gray-500 mt-1.5">Each new line will be displayed as a bullet point on the public page.</p>
            @error('activities')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div x-show="lang === 'fr'" x-cloak>
            <label class="block text-sm font-medium text-gray-700 mb-1">Activities (French) <span class="text-gray-400 font-normal">(optional)</span></label>
            <textarea name="activities_fr" rows="5"
                      class="w-full rounded-xl border-gray-300 focus:border-[#2d6fa3] focus:ring focus:ring-[#2d6fa3]/20 transition-all text-sm"
                      placeholder="Activité 1&#10;Activité 2...">{{ old('activities_fr', $item->activities_fr) }}</textarea>
            <p class="text-xs text-gray-400 mt-1.5">Shown to French-language visitors. Leave blank to reuse the English value.</p>
            @error('activities_fr')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

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
                <div class="flex items-start gap-4 mb-3">
                    <img src="{{ $img['current_url'] }}" class="h-20 w-32 rounded-lg object-cover border border-gray-200" alt="Current">
                    <div class="pt-1">
                        <label class="flex items-center gap-2 cursor-pointer mb-1 text-sm text-red-600 hover:text-red-700 font-medium">
                            <input type="checkbox" name="remove_{{ $img['field'] }}" value="1" class="rounded border-gray-300 text-red-500 focus:ring-red-500">
                            Remove Image
                        </label>
                        <p class="text-[11px] text-gray-400">Check this to delete this image.</p>
                    </div>
                </div>
                <p class="text-xs text-gray-400 mb-2">Or upload/enter a new URL below to replace it.</p>
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

    {{-- ── Action Bar (footer of this card) ───── --}}
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50 flex items-center justify-between gap-4">

        {{-- Delete --}}
        <button type="button" onclick="if(confirm('Delete this item permanently?')) document.getElementById('delete-item-form').submit();"
                class="flex items-center gap-2 text-sm font-medium text-red-400 hover:text-red-600 hover:bg-red-50 px-4 py-2 rounded-xl transition-all border border-transparent hover:border-red-100">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
            Delete Item
        </button>

        {{-- Save / Cancel --}}
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.program-pages.index') }}"
               class="px-5 py-2 text-sm font-medium text-gray-500 hover:text-gray-800 rounded-xl hover:bg-gray-100 transition-all border border-transparent hover:border-gray-200">
                Cancel
            </a>
            <button type="submit"
                    class="inline-flex items-center gap-2 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white px-7 py-2.5 rounded-xl text-sm font-semibold transition-all shadow-sm hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Update Item
            </button>
        </div>
    </div>
</form>

<form id="delete-item-form" action="{{ route('admin.program-pages.destroy', $item) }}" method="POST"
      onsubmit="return confirm('Delete this item permanently?');" class="hidden">
    @csrf @method('DELETE')
</form>
@endsection
