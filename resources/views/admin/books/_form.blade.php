@php
    $isEdit = isset($book);
    $bookTitle = $isEdit ? $book->title : old('title');
    $bookAuthor = $isEdit ? $book->author : old('author');
    $bookDescription = $isEdit ? $book->description : old('description');
    $bookPrice = $isEdit ? $book->price : old('price', '');
    $bookStock = $isEdit ? $book->stock : old('stock', 0);
    $bookSort = $isEdit ? $book->sort_order : old('sort_order', 0);
    $bookAvailable = $isEdit ? $book->is_available : old('is_available', true);
@endphp

{{-- TITLE --}}
<div>
    <label for="title" class="block text-sm font-semibold text-gray-700 mb-1.5">
        Title <span class="text-red-400">*</span>
    </label>
    <div class="relative">
        <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
        </svg>
        <input type="text" id="title" name="title" required autocomplete="off"
            value="{{ old('title', $bookTitle ?? '') }}"
            class="w-full pl-11 pr-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 transition-all hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none
                {{ $errors->has('title') ? 'border-red-300 focus:border-red-400 focus:ring-red-100' : '' }}"
            placeholder="Enter book title">
    </div>
    @error('title')
        <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 9 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
            {{ $message }}
        </p>
    @enderror
</div>

{{-- AUTHOR --}}
<div>
    <label for="author" class="block text-sm font-semibold text-gray-700 mb-1.5">
        Author <span class="text-gray-400 font-normal">(optional)</span>
    </label>
    <div class="relative">
        <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none"
            fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        <input type="text" id="author" name="author" autocomplete="off"
            value="{{ old('author', $bookAuthor ?? '') }}"
            class="w-full pl-11 pr-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 transition-all hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none
                {{ $errors->has('author') ? 'border-red-300 focus:border-red-400 focus:ring-red-100' : '' }}"
            placeholder="Enter author name">
    </div>
    @error('author')
        <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 9 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
            {{ $message }}
        </p>
    @enderror
</div>

{{-- DESCRIPTION --}}
<div>
    <label for="description" class="block text-sm font-semibold text-gray-700 mb-1.5">
        Description <span class="text-gray-400 font-normal">(optional)</span>
    </label>
    <textarea id="description" name="description" rows="3" autocomplete="off"
        class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 transition-all hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none resize-none
            {{ $errors->has('description') ? 'border-red-300 focus:border-red-400 focus:ring-red-100' : '' }}"
        placeholder="Short description of the book">{{ old('description', $bookDescription ?? '') }}</textarea>
    @error('description')
        <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 9 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
            {{ $message }}
        </p>
    @enderror
</div>

<div class="grid grid-cols-2 gap-4">
    {{-- PRICE --}}
    <div>
        <label for="price" class="block text-sm font-semibold text-gray-700 mb-1.5">
            Price (USD) <span class="text-red-400">*</span>
        </label>
        <div class="relative">
            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-medium">$</span>
            <input type="number" id="price" name="price" step="0.01" min="0" required
                value="{{ old('price', $bookPrice) }}"
                class="w-full pl-8 pr-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 transition-all hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none
                    {{ $errors->has('price') ? 'border-red-300 focus:border-red-400 focus:ring-red-100' : '' }}"
                placeholder="0.00">
        </div>
        @error('price')
            <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 9 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                {{ $message }}
            </p>
        @enderror
    </div>

    {{-- STOCK --}}
    <div>
        <label for="stock" class="block text-sm font-semibold text-gray-700 mb-1.5">
            Stock
        </label>
        <input type="number" id="stock" name="stock" min="0" step="1"
            value="{{ old('stock', $bookStock) }}"
            class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 transition-all hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none
                {{ $errors->has('stock') ? 'border-red-300 focus:border-red-400 focus:ring-red-100' : '' }}"
            placeholder="0">
        @error('stock')
            <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 9 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                {{ $message }}
            </p>
        @enderror
    </div>
</div>

<div class="grid grid-cols-2 gap-4">
    {{-- SORT ORDER --}}
    <div>
        <label for="sort_order" class="block text-sm font-semibold text-gray-700 mb-1.5">
            Display Order
        </label>
        <input type="number" id="sort_order" name="sort_order" min="0" step="1"
            value="{{ old('sort_order', $bookSort) }}"
            class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 transition-all hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none"
            placeholder="0">
    </div>

    {{-- AVAILABLE --}}
    <div class="flex items-end pb-1.5">
        <label class="flex items-center gap-2 cursor-pointer select-none px-3.5 py-2.5 rounded-xl border border-gray-300 bg-gray-50 hover:border-gray-400 hover:bg-white transition-all duration-150 w-full">
            <input type="hidden" name="is_available" value="0">
            <input type="checkbox" name="is_available" value="1" {{ $bookAvailable ? 'checked' : '' }}
                   class="w-4 h-4 accent-[#2d6fa3] cursor-pointer">
            <span class="text-xs font-semibold text-gray-600">Available for purchase</span>
        </label>
    </div>
</div>

{{-- COVER IMAGE --}}
<div x-data="{ hasCover: {{ $isEdit && $book->cover_image ? 'true' : 'false' }} }">
    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
        Cover Image <span class="text-gray-400 font-normal">(optional)</span>
    </label>
    <p class="text-xs text-gray-400 mb-2.5">PNG, JPG or WebP (max 2MB)</p>

    @if ($isEdit && $book->cover_image_url)
        <div class="mb-4 p-4 bg-gray-50/80 border-2 border-gray-200 rounded-xl flex items-center gap-4">
            <div class="w-20 h-20 bg-white rounded-xl border-2 border-gray-100 flex items-center justify-center flex-shrink-0 overflow-hidden">
                <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}" class="max-w-full max-h-full object-cover p-1">
            </div>
            <div class="min-w-0">
                <p class="text-sm font-semibold text-gray-700">Current Cover</p>
                <p class="text-xs text-gray-400 truncate">{{ basename($book->cover_image) }}</p>
                <p class="text-xs text-gray-400 mt-0.5">Upload a new cover to replace it, or uncheck "has cover" to remove it.</p>
            </div>
        </div>
    @endif

    <label for="cover_image" id="cover-dropzone"
        class="group flex flex-col items-center justify-center w-full h-40 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50/50 hover:border-blue-400 hover:bg-blue-50/40 transition-all duration-200">
        <div class="flex flex-col items-center justify-center" id="cover-placeholder">
            <div class="w-14 h-14 rounded-full bg-white shadow-sm border border-gray-100 flex items-center justify-center mb-3 group-hover:scale-110 group-hover:shadow-md transition-all duration-200">
                <svg class="w-6 h-6 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1117.9 9H18a4 4 0 010 8h-1m-4-4l-3-3m0 0l-3 3m3-3v12" />
                </svg>
            </div>
            <p class="text-sm text-gray-600 font-medium group-hover:text-blue-600 transition-colors">Click to upload cover</p>
            <p class="text-xs text-gray-400 mt-1">PNG, JPG or WebP (max 2MB)</p>
        </div>
        <div class="hidden flex-col items-center justify-center gap-2" id="cover-selected">
            <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm font-medium text-gray-700 px-4 text-center truncate max-w-full" id="cover-filename"></p>
            <p class="text-xs text-blue-500 font-medium">Click to choose a different file</p>
        </div>
        <input id="cover_image" type="file" name="cover_image" accept="image/*" class="hidden"
            onchange="
                const f = this.files[0];
                if (f) {
                    document.getElementById('cover-placeholder').classList.add('hidden');
                    document.getElementById('cover-selected').classList.remove('hidden');
                    document.getElementById('cover-selected').classList.add('flex');
                    document.getElementById('cover-filename').textContent = f.name;
                }
            ">
    </label>

    @error('cover_image')
        <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 9 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
            {{ $message }}
        </p>
    @enderror

    @if ($isEdit && $book->cover_image)
        <label class="flex items-center gap-2 mt-3 cursor-pointer select-none text-xs text-gray-500">
            <input type="checkbox" name="remove_cover" value="1"
                   class="w-4 h-4 accent-red-500 cursor-pointer">
            <span>Remove current cover image</span>
        </label>
    @endif
</div>
