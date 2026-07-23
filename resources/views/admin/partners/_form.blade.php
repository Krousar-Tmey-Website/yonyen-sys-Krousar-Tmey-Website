@php
    $isEdit = isset($partner);
    $partnerName = $isEdit ? $partner->name : old('name');
    $selectedCategory = old('category', $isEdit ? $partner->category : '');
    $selectedSubcategory = old('subcategory', $isEdit ? $partner->subcategory : '');
@endphp

{{-- PARTNER NAME --}}
<div>
    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">
        Partner Name <span class="text-red-400">*</span>
    </label>
    <div class="relative">
        <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2M5 21H3m4-14h.01M11 7h.01M7 11h.01M11 11h.01M7 15h.01M11 15h.01" />
        </svg>
        <input type="text" id="name" name="name" required autocomplete="off"
            value="{{ old('name', $partnerName ?? '') }}"
            class="w-full pl-11 pr-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 transition-all hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none
                {{ $errors->has('name') ? 'border-red-300 focus:border-red-400 focus:ring-red-100' : '' }}"
            placeholder="Enter partner name">
    </div>
    @error('name')
        <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 9 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
            {{ $message }}
        </p>
    @enderror
</div>

{{-- CATEGORY & SUBCATEGORY --}}
<div x-data="{ category: {{ Js::from($selectedCategory) }} }">
    {{-- MAIN CATEGORY --}}
    <div>
        <label for="category" class="block text-sm font-semibold text-gray-700 mb-1.5">
            Main Category <span class="text-red-400">*</span>
        </label>
        <div class="relative">
            <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
            </svg>
            <select id="category" name="category" x-model="category" required
                class="w-full pl-11 pr-10 py-3 bg-white border-2 border-gray-200 rounded-xl text-sm text-gray-700 transition-all hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none appearance-none cursor-pointer
                    {{ $errors->has('category') ? 'border-red-300 focus:border-red-400 focus:ring-red-100' : '' }}">
                <option value="" disabled {{ $selectedCategory === '' ? 'selected' : '' }}>Select a category</option>
                @foreach (\App\Enums\PartnerCategory::cases() as $cat)
                    <option value="{{ $cat->value }}" {{ $selectedCategory === $cat->value ? 'selected' : '' }}>
                        {{ $cat->value }}
                    </option>
                @endforeach
            </select>
            {{-- Chevron --}}
            <svg class="w-4 h-4 text-gray-400 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
        @error('category')
            <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 9 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    {{-- SUBCATEGORY — only for Financial Partners --}}
    <div class="mt-5" x-show="category === 'Financial Partners'" x-cloak>
        <label for="subcategory" class="block text-sm font-semibold text-gray-700 mb-1.5">
            Subcategory <span class="text-red-400">*</span>
        </label>
        <div class="relative">
            <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <select id="subcategory" name="subcategory"
                :disabled="category !== 'Financial Partners'"
                class="w-full pl-11 pr-10 py-3 bg-white border-2 border-gray-200 rounded-xl text-sm text-gray-700 transition-all hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none appearance-none cursor-pointer
                    {{ $errors->has('subcategory') ? 'border-red-300 focus:border-red-400 focus:ring-red-100' : '' }}">
                <option value="" {{ $selectedSubcategory === '' ? 'selected' : '' }}>Select a subcategory</option>
                @foreach (\App\Enums\PartnerSubcategory::cases() as $sub)
                    <option value="{{ $sub->value }}" {{ $selectedSubcategory === $sub->value ? 'selected' : '' }}>
                        {{ $sub->value }}
                    </option>
                @endforeach
            </select>
            {{-- Chevron --}}
            <svg class="w-4 h-4 text-gray-400 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
        @error('subcategory')
            <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 9 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                {{ $message }}
            </p>
        @enderror
    </div>
</div>

{{-- DESCRIPTION --}}
<div x-data="{ lang: 'en' }">
    <div class="flex items-center justify-between mb-1.5">
        <label class="block text-sm font-semibold text-gray-700">
            Description <span class="text-gray-400 font-normal">(optional)</span>
        </label>
        <div class="lang-tabs">
            <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'">EN</button>
            <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'">FR</button>
        </div>
    </div>

    <div x-show="lang === 'en'">
        <textarea id="description" name="description" rows="4"
            class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 transition-all hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none
                {{ $errors->has('description') ? 'border-red-300 focus:border-red-400 focus:ring-red-100' : '' }}"
            placeholder="Short description of the partner organisation">{{ old('description', $isEdit ? $partner->description : '') }}</textarea>
        @error('description')
            <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 9 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    <div x-show="lang === 'fr'" x-cloak>
        <textarea id="description_fr" name="description_fr" rows="4"
            class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 transition-all hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none
                {{ $errors->has('description_fr') ? 'border-red-300 focus:border-red-400 focus:ring-red-100' : '' }}"
            placeholder="Description en français (facultatif)">{{ old('description_fr', $isEdit ? $partner->description_fr : '') }}</textarea>
        @error('description_fr')
            <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 9 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                {{ $message }}
            </p>
        @enderror
        <p class="text-xs text-gray-400 mt-1.5">Shown to French-language visitors. Leave blank to reuse the English description.</p>
    </div>
</div>

@if ($isEdit)
{{-- DISPLAY ORDER & STATUS --}}
<div class="grid grid-cols-2 gap-4">
    <div>
        <label for="sort_order" class="block text-sm font-semibold text-gray-700 mb-1.5">
            Display Order
        </label>
        <div class="relative">
            <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none"
                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
            </svg>
            <input type="number" id="sort_order" name="sort_order"
                value="{{ old('sort_order', $partner->sort_order ?? 0) }}"
                class="w-full pl-11 pr-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-sm text-gray-700 transition-all hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none">
        </div>
    </div>

    <div>
        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Status</label>
        <label class="flex items-center justify-between px-4 py-3 bg-white border-2 border-gray-200 rounded-xl cursor-pointer select-none transition-all hover:border-gray-300">
            <span class="text-sm font-medium text-gray-600">Active</span>
            <span class="relative inline-flex items-center">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                       {{ old('is_active', $partner->is_active ?? true) ? 'checked' : '' }}>
                <span class="w-10 h-5.5 bg-gray-200 peer-checked:bg-blue-600 rounded-full transition-colors duration-200"></span>
                <span class="absolute top-[2px] left-[2px] w-[19px] h-[19px] bg-white rounded-full shadow-sm transition-transform duration-200 peer-checked:translate-x-[19px]"></span>
            </span>
        </label>
    </div>
</div>
@endif

{{-- HAS LOGO TOGGLE --}}
<div x-data="{ hasLogo: {{ $isEdit && $partner->logo ? 'true' : 'false' }} }">
    <label class="relative inline-flex items-center cursor-pointer gap-3">
        <input type="checkbox" name="has_logo" x-model="hasLogo"
               class="sr-only peer" value="1"
               {{ $isEdit && $partner->logo ? 'checked' : '' }}>
        <div class="w-10 h-5.5 bg-gray-200 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-blue-100 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
        <span class="text-sm font-medium text-gray-700 select-none">This partner has a logo</span>
    </label>

    {{-- LOGO UPLOAD -- conditional on hasLogo --}}
    <div x-show="hasLogo"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="mt-4">

                @if ($isEdit && $partner->logo_url)
                {{-- Current Logo Preview --}}
                <div class="mb-4 p-4 bg-gray-50/80 border-2 border-gray-200 rounded-xl flex items-center gap-4">
                    <div class="w-20 h-20 bg-white rounded-xl border-2 border-gray-100 flex items-center justify-center flex-shrink-0 overflow-hidden">
                        <img src="{{ $partner->logo_url }}"
                             alt="{{ $partner->name }}"
                             class="max-w-full max-h-full object-contain p-2">
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-gray-700">Current Logo</p>
                        <p class="text-xs text-gray-400 truncate">{{ basename($partner->logo) }}</p>
                        <p class="text-xs text-gray-400 mt-0.5">Upload a new logo below to replace it, or uncheck "has logo" to remove it.</p>
                    </div>
                </div>
                @endif

        {{-- Upload Box --}}
        <label for="logo" id="logo-dropzone"
            class="group flex flex-col items-center justify-center w-full h-44
            border-2 border-dashed border-gray-300 rounded-xl
            cursor-pointer bg-gray-50/50
            hover:border-blue-400 hover:bg-blue-50/40
            transition-all duration-200">

            <div class="flex flex-col items-center justify-center" id="logo-placeholder">
                <div
                    class="w-14 h-14 rounded-full bg-white shadow-sm border border-gray-100
                    flex items-center justify-center mb-3
                    group-hover:scale-110 group-hover:shadow-md transition-all duration-200">
                    <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1117.9 9H18a4 4 0 010 8h-1m-4-4l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
                <p class="text-sm text-gray-600 font-medium group-hover:text-blue-600 transition-colors">
                    Click to upload logo
                </p>
                <p class="text-xs text-gray-400 mt-1">
                    PNG, JPG, SVG or WebP (max 2MB)
                </p>
            </div>

            <div class="hidden flex-col items-center justify-center gap-2" id="logo-selected">
                <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-sm font-medium text-gray-700 px-4 text-center truncate max-w-full" id="logo-filename"></p>
                <p class="text-xs text-blue-500 font-medium">Click to choose a different file</p>
            </div>

            <input id="logo" type="file" name="logo" accept="image/*" class="hidden"
                onchange="
                    const f = this.files[0];
                    if (f) {
                        document.getElementById('logo-placeholder').classList.add('hidden');
                        document.getElementById('logo-selected').classList.remove('hidden');
                        document.getElementById('logo-selected').classList.add('flex');
                        document.getElementById('logo-filename').textContent = f.name;
                    }
                ">
        </label>

        @error('logo')
            <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 9 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    {{-- Hidden input to signal logo removal when checkbox is unchecked on edit --}}
    @if ($isEdit && $partner->logo)
        <input type="hidden" name="remove_logo" x-bind:value="hasLogo ? '0' : '1'">
    @endif
</div>

