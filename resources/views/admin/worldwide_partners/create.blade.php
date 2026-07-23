@extends('admin.layouts.app')

@section('title', isset($worldwidePartner) ? 'Edit Country Partner' : 'Add Country Partner')
@section('page-title', isset($worldwidePartner) ? 'Edit Country Partner' : 'Add Country Partner')
@section('breadcrumb', 'Krousar Thmey Worldwide / ' . (isset($worldwidePartner) ? 'Edit' : 'Add New'))

@section('content')

<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-100 p-6" x-data="bilingualForm()">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center justify-between mb-4"><h3 class="font-bold text-gray-700 text-sm">Country Information</h3>
    <div class="lang-tabs" title="Toggle editing language (English / French)">
    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
</div>
</div>
        </div>

        <form action="{{ isset($worldwidePartner) ? route('admin.worldwide-partners.update', $worldwidePartner) : route('admin.worldwide-partners.store') }}"
              method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @if(isset($worldwidePartner))
                @method('PUT')
            @endif
<div x-show="lang === 'en'">
                <label class="block text-xs font-medium text-gray-600 mb-1">Country Name <span class="text-red-400">*</span></label>
                <input type="text" name="country_name" value="{{ old('country_name', $worldwidePartner->country_name ?? '') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="e.g. France">
            </div>

            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-xs font-medium text-gray-600 mb-1">Country Name (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <input type="text" name="country_name_fr" value="{{ old('country_name_fr', $worldwidePartner->country_name_fr ?? '') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="ex. France">
                <p class="text-xs text-gray-400 mt-1">Shown to French-language visitors. Leave blank to reuse the English name.</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Country Image <span class="text-red-400">*</span></label>
                <div class="space-y-3">
                    @if(isset($worldwidePartner) && $worldwidePartner->image)
                    <div class="flex items-center gap-3">
                        <img src="{{ $worldwidePartner->image_url }}" alt="Current image" class="w-32 h-18 object-cover rounded-lg border border-gray-200">
                        <label class="flex items-center gap-1.5 text-xs text-gray-500">
                            <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300">
                            Remove current image
                        </label>
                    </div>
                    @endif
                    
                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp"
                           class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    
                    <div class="flex items-center gap-2">
                        <div class="flex-1 h-px bg-gray-200"></div>
                        <span class="text-xs text-gray-400">OR</span>
                        <div class="flex-1 h-px bg-gray-200"></div>
                    </div>
                    
                    <input type="url" name="image_url" value="{{ old('image_url', $worldwidePartner->image ?? '') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="https://example.com/image.jpg">
                </div>
                <p class="text-xs text-gray-400 mt-1">Recommended: 1600 × 900 px (16:9). Max 5MB. JPG, PNG, or WebP.</p>
            </div>

            <div x-show="lang === 'en'">
                <label class="block text-xs font-medium text-gray-600 mb-1">Short Description <span class="text-red-400">*</span></label>
                <textarea name="description" rows="3"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                          placeholder="Supports fundraising, volunteer engagement, and international partnerships...">{{ old('description', $worldwidePartner->description ?? '') }}</textarea>
            </div>

            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-xs font-medium text-gray-600 mb-1">Short Description (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <textarea name="description_fr" rows="3"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                          placeholder="Description courte en français...">{{ old('description_fr', $worldwidePartner->description_fr ?? '') }}</textarea>
                <p class="text-xs text-gray-400 mt-1">Shown to French-language visitors. Leave blank to reuse the English description.</p>
            </div>

            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Learn More URL <span class="text-red-400">*</span></label>
                <input type="url" name="learn_more_url" value="{{ old('learn_more_url', $worldwidePartner->learn_more_url ?? '') }}" required
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="https://www.krousar-thmey.org/france">
            </div>

            <div x-show="lang === 'en'">
                <label class="block text-xs font-medium text-gray-600 mb-1">Button Text</label>
                <input type="text" name="button_text" value="{{ old('button_text', $worldwidePartner->button_text ?? 'Learn More') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-xs font-medium text-gray-600 mb-1">Button Text (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <input type="text" name="button_text_fr" value="{{ old('button_text_fr', $worldwidePartner->button_text_fr ?? '') }}"
                       placeholder="En savoir plus"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="text-xs text-gray-400 mt-1">Shown to French-language visitors. Leave blank to reuse the English button text.</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Display Order</label>
                    <input type="number" name="display_order" value="{{ old('display_order', $worldwidePartner->display_order ?? 0) }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Status</label>
                    <select name="is_active" class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        <option value="1" {{ (old('is_active', $worldwidePartner->is_active ?? true) == '1') ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ (old('is_active', $worldwidePartner->is_active ?? true) == '0') ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="flex items-center gap-2 text-xs font-medium text-gray-600">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $worldwidePartner->is_featured ?? false) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]/20">
                    Featured Country
                </label>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="btn-primary text-sm py-2.5">{{ isset($worldwidePartner) ? 'Update' : 'Create' }} Country</button>
                <a href="{{ route('admin.worldwide-partners.index') }}" class="text-gray-400 hover:text-gray-600 text-sm transition-colors">Cancel</a>
            </div>
        </form>
    </div>
</div>

@endsection