@php
    $isEdit = isset($partner);
    $partnerName = $isEdit ? $partner->name : old('name');
    $selectedCategoryId = old('category_id', $isEdit ? $partner->category_id : '');
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
            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
            {{ $message }}
        </p>
    @enderror
</div>

{{-- CATEGORY --}}
<div>
    <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-1.5">
        Category <span class="text-red-400">*</span>
    </label>
    <div class="relative">
        <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
        </svg>
        <select id="category_id" name="category_id" required
            class="w-full pl-11 pr-10 py-3 bg-white border-2 border-gray-200 rounded-xl text-sm text-gray-700 transition-all hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none appearance-none cursor-pointer
                {{ $errors->has('category_id') ? 'border-red-300 focus:border-red-400 focus:ring-red-100' : '' }}">
            <option value="" disabled {{ $selectedCategoryId === '' ? 'selected' : '' }}>Select a category</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ $selectedCategoryId == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
        {{-- Chevron --}}
        <svg class="w-4 h-4 text-gray-400 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </div>
    @error('category_id')
        <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
            {{ $message }}
        </p>
    @enderror
</div>

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

        @if ($isEdit && $partner->logo)
            {{-- Current Logo Preview --}}
            <div class="mb-4 p-4 bg-gray-50/80 border-2 border-gray-200 rounded-xl flex items-center gap-4">
                <div class="w-20 h-20 bg-white rounded-xl border-2 border-gray-100 flex items-center justify-center flex-shrink-0 overflow-hidden">
                    <img src="{{ asset('storage/' . $partner->logo) }}"
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
                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    {{-- Hidden input to signal logo removal when checkbox is unchecked on edit --}}
    @if ($isEdit && $partner->logo)
        <input type="hidden" name="remove_logo" x-bind:value="hasLogo ? '0' : '1'">
    @endif
</div>
