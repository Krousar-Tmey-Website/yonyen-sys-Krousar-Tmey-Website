@extends('admin.layouts.app')

@section('title', 'Add Value')
@section('page-title', 'Add Value')
@section('breadcrumb', 'Our Values → Add Value')

@section('content')    <div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6" x-data="bilingualForm()">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="font-bold text-gray-800">New Value</h3>
                <p class="text-sm text-gray-400 mt-0.5">Add a new core value card to the About page.</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="lang-tabs" title="Toggle editing language (English / French)">
                    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                </div>
                <a href="{{ route('admin.core-values.index') }}"
                   class="px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-200 transition">
                    Back to values
                </a>
            </div>
        </div>

        <form action="{{ route('admin.core-values.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="space-y-4">
                <div x-show="lang === 'en'">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Title <span class="text-red-400">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" :required="lang === 'en'"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="Enter value title">
                    @error('title')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Title (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <input type="text" name="title_fr" value="{{ old('title_fr') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="Enter value title in French">
                </div>

                <div x-show="lang === 'en'">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Headline <span class="text-gray-400">(optional)</span></label>
                    <input type="text" name="headline" value="{{ old('headline') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="Short headline shown on the card">
                    @error('headline')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Headline (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <input type="text" name="headline_fr" value="{{ old('headline_fr') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="Short headline in French">
                </div>

                <div x-show="lang === 'en'">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Description <span class="text-gray-400">(optional)</span></label>
                    <x-admin.rich-text name="description" :value="old('description')" lang="en" placeholder="Describe the value" />
                    @error('description')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Description (French) <span class="text-gray-400">(optional)</span></label>
                    <x-admin.rich-text name="description_fr" :value="old('description_fr')" lang="fr" placeholder="Describe the value in French" />
                </div>

                <div x-show="lang === 'en'">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Supporting Description <span class="text-gray-400">(optional)</span></label>
                    <x-admin.rich-text name="supporting_description" :value="old('supporting_description')" lang="en" :rows="3" placeholder="Extra detail shown on the value's detail page" />
                    @error('supporting_description')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Supporting Description (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <x-admin.rich-text name="supporting_description_fr" :value="old('supporting_description_fr')" lang="fr" :rows="3" placeholder="Extra detail in French" />
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Icon <span class="text-gray-400">(optional — emoji, default ⭐)</span></label>
                    <input type="text" name="icon" value="{{ old('icon') }}" maxlength="10"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="⭐">
                    @error('icon')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Image <span class="text-gray-400">(optional)</span></label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                    <p class="text-[11px] text-gray-400 mt-1">Shown next to the icon on the value's detail page.</p>
                    @error('image')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Order <span class="text-gray-400">(optional)</span></label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    @error('sort_order')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-between gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.core-values.index') }}"
                   class="px-4 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl transition">
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-semibold transition-all shadow-sm hover:shadow-md">
                    Add Value
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
