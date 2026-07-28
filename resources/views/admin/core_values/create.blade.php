@extends('admin.layouts.app')

@section('title', 'Add Value')
@section('page-title', 'Add Value')
@section('breadcrumb', 'Our Values → Add Value')

@section('content')
<div>

    <form action="{{ route('admin.core-values.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5" x-data="bilingualForm()">
        @csrf

        {{-- Value Details --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                    Value Details
                </h3>
                <div class="lang-tabs" title="Toggle editing language (English / French)">
                    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                </div>
            </div>

            <div x-show="lang === 'en'">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Title <span class="text-gray-400 font-normal">(optional)</span></label>
                <input type="text" name="title" value="{{ old('title') }}"
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

                <div>
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
                </div>
            </div>
        </div>

        {{-- Description --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </span>
                Description
            </h3>

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
        </div>

        {{-- Image & Order --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-orange-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </span>
                Image & Order
            </h3>

            <div class="grid lg:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Icon <span class="text-gray-400">(optional — emoji, default ⭐)</span></label>
                    <input type="text" name="icon" value="{{ old('icon') }}" maxlength="10"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="⭐">
                    @error('icon')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Order <span class="text-gray-400">(optional)</span></label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    @error('sort_order')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Image <span class="text-gray-400">(optional)</span></label>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                <p class="text-[11px] text-gray-400 mt-1">Shown next to the icon on the value's detail page.</p>
                @error('image')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary">Add Value</button>
            <a href="{{ route('admin.core-values.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>

@endsection
