@extends('admin.layouts.app')

@section('title', 'Partners')
@section('page-title', 'Partners')
@section('breadcrumb', 'Manage partner organisations displayed on the About page')

@section('content')

<div class="grid lg:grid-cols-3 gap-6">

    {{-- Add / Edit Partner form --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 h-fit">
        <h3 class="font-bold text-gray-700 mb-5 text-sm">
            {{ isset($editPartner) ? 'Edit Partner' : 'Add New Partner' }}
        </h3>

        <form action="{{ isset($editPartner) ? route('admin.partners.update', $editPartner) : route('admin.partners.store') }}"
              method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @if(isset($editPartner))
                @method('PUT')
            @endif

            {{-- NAME --}}
            <div>
                <label for="name" class="form-label">
                    Partner Name <span class="text-red-400 font-normal">*</span>
                </label>
                <input type="text" id="name" name="name" required autocomplete="off"
                       value="{{ old('name', $editPartner->name ?? '') }}"
                       class="form-input {{ $errors->has('name') ? 'form-input-error' : '' }}"
                       placeholder="Enter partner name">
                @error('name')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- CATEGORY --}}
            <div>
                <label for="category" class="form-label">
                    Category <span class="text-red-400 font-normal">*</span>
                </label>
                <div class="relative">
                    <select id="category" name="category"
                            class="form-input appearance-none pr-9 cursor-pointer {{ $errors->has('category') ? 'form-input-error' : '' }}">
                        <option value="">Select a category</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->name }}" {{ old('category', $editPartner->category ?? '') == $cat->name ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    <svg class="w-4 h-4 text-gray-400 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>
                @error('category')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- COUNTRY --}}
            <div>
                <label for="country" class="form-label">
                    Country <span class="text-gray-400 font-normal">(optional)</span>
                </label>
                <input type="text" id="country" name="country" autocomplete="off"
                       value="{{ old('country', $editPartner->country ?? '') }}"
                       class="form-input"
                       placeholder="Example: Switzerland">
            </div>

            <div class="grid grid-cols-2 gap-3">
                {{-- SORT ORDER --}}
                <div>
                    <label for="sort_order" class="form-label">Order</label>
                    <input type="number" id="sort_order" name="sort_order"
                           value="{{ old('sort_order', $editPartner->sort_order ?? 0) }}"
                           class="form-input">
                </div>

                {{-- ACTIVE (edit only — new partners are active by default) --}}
                @if(isset($editPartner))
                <div class="flex items-end pb-1.5">
                    <label class="flex items-center gap-2 cursor-pointer select-none px-3.5 py-2.5 rounded-xl border border-gray-300 bg-gray-50 hover:border-gray-400 hover:bg-white transition-all duration-150 w-full">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $editPartner->is_active) ? 'checked' : '' }}
                               class="w-4 h-4 accent-[#2d6fa3] cursor-pointer">
                        <span class="text-xs font-semibold text-gray-600">Active</span>
                    </label>
                </div>
                @endif
            </div>

            {{-- LOGO --}}
            <div>
                <label class="form-label">Partner Logo</label>
                <p class="text-xs text-gray-400 mb-2.5">PNG, JPG or SVG (max 2MB)</p>

                <label for="logo" id="logo-dropzone"
                       class="group flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-gray-300 rounded-2xl cursor-pointer bg-gray-50 hover:bg-[#2d6fa3]/5 hover:border-[#2d6fa3] transition-all duration-200">
                    <div class="flex flex-col items-center justify-center" id="logo-placeholder">
                        <div class="w-11 h-11 rounded-full bg-white border border-gray-200 shadow-sm flex items-center justify-center mb-2.5 group-hover:scale-110 group-hover:border-[#2d6fa3]/30 transition-all duration-200">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-[#2d6fa3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1117.9 9H18a4 4 0 010 8h-1m-4-4l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-[#2d6fa3]">Click to upload logo</p>
                        <p class="text-xs text-gray-400 mt-0.5">or drag and drop — PNG, JPG, SVG</p>
                    </div>
                    <div class="hidden flex-col items-center justify-center gap-1.5" id="logo-selected">
                        <div class="w-11 h-11 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-700 px-4 text-center truncate max-w-full" id="logo-filename"></p>
                        <p class="text-xs text-[#2d6fa3]">Click to choose a different file</p>
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
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror

                @if(isset($editPartner) && $editPartner->logo_url)
                <div class="mt-4 flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-3">
                    <div class="w-12 h-12 bg-white rounded-lg border border-gray-100 flex items-center justify-center">
                        <img src="{{ $editPartner->logo_url }}" class="max-w-full max-h-full object-contain p-1">
                    </div>
                    <p class="text-xs text-gray-400">Current logo</p>
                </div>
                @endif
            </div>

            <button type="submit" class="w-full btn-primary justify-center text-sm py-2.5">
                {{ isset($editPartner) ? 'Update Partner' : 'Add Partner' }}
            </button>

            @if(isset($editPartner))
            <a href="{{ route('admin.partners.index') }}" class="block text-center text-xs text-gray-400 hover:text-gray-600 transition-colors">Cancel edit</a>
            @endif
        </form>
    </div>

    {{-- List --}}
    <div class="lg:col-span-2 space-y-5"
         x-data="{
            search: @js($filters['search'] ?? ''),
            categoryId: @js($filters['category'] ?? ''),
            total: @js($totalPartners),
            activeFilters: @js($activeCount),
            loading: false,
            applyFilters() {
                this.loading = true;
                const params = new URLSearchParams();
                if (this.search) params.set('search', this.search);
                if (this.categoryId) params.set('category', this.categoryId);
                const url = '{{ route('admin.partners.index') }}' + (params.toString() ? '?' + params.toString() : '');
                fetch(url, { headers: { 'Accept': 'application/json' } })
                    .then(r => r.json())
                    .then(data => {
                        this.$refs.results.innerHTML = data.html;
                        this.total = data.total;
                        this.activeFilters = data.activeFilters;
                        history.replaceState(null, '', url);
                        this.loading = false;
                    })
                    .catch(() => { this.loading = false; });
            },
            resetFilters() {
                this.search = '';
                this.categoryId = '';
                this.applyFilters();
            }
         }"
         x-init="$watch('search', () => applyFilters()); $watch('categoryId', () => applyFilters())">

        {{-- Toolbar: title, count, search + category filter --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between flex-wrap gap-4 mb-4">
                <div class="flex items-center gap-2">
                    <h3 class="font-bold text-gray-800">All Partners</h3>
                    <span class="px-2.5 py-1 bg-[#2d6fa3]/10 text-[#2d6fa3] rounded-full text-xs font-semibold">
                        Showing <span x-text="total">{{ $totalPartners }}</span>
                    </span>
                </div>
                <span class="px-2.5 py-1 bg-gray-50 border border-gray-100 text-gray-500 text-xs font-medium rounded-full"
                      x-show="activeFilters > 0" x-cloak
                      x-text="activeFilters + ' ' + (activeFilters === 1 ? 'filter' : 'filters') + ' applied'">
                </span>
            </div>

            <form method="GET" action="{{ route('admin.partners.index') }}" class="flex flex-wrap items-center gap-3" @submit.prevent="applyFilters()">
                <div class="relative flex-1 min-w-[220px]">
                    <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                           x-model.debounce.400ms="search"
                           placeholder="Search by name or country..."
                           autocomplete="off"
                           class="w-full bg-gray-50 border border-gray-300 rounded-full pl-10 pr-4 py-2.5 text-sm text-gray-700 placeholder:text-gray-400 transition-all duration-150 hover:border-gray-400 focus:outline-none focus:bg-white focus:border-[#2d6fa3] focus:ring-4 focus:ring-[#2d6fa3]/15">
                </div>

                <div class="relative">
                    <select name="category" x-model="categoryId"
                            class="pl-4 pr-9 py-2.5 rounded-full border border-gray-300 text-sm font-medium text-gray-600 bg-white appearance-none cursor-pointer transition-all duration-150 hover:border-gray-400 focus:outline-none focus:border-[#2d6fa3] focus:ring-4 focus:ring-[#2d6fa3]/15">
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->name }}" {{ ($filters['category'] ?? '') == $cat->name ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    <svg class="w-3.5 h-3.5 text-gray-400 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <button type="submit" @click.prevent="applyFilters()"
                        class="px-5 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-full text-sm font-semibold transition-colors">
                    Search
                </button>

                <a href="{{ route('admin.partners.index') }}" @click.prevent="resetFilters()"
                   x-show="activeFilters > 0" x-cloak
                   class="px-5 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-500 rounded-full text-sm font-medium transition-colors">
                    Reset
                </a>
            </form>
        </div>

        {{-- Results (swapped in place on search/filter — never re-renders the inputs above) --}}
        <div x-ref="results" class="space-y-5" :class="loading ? 'opacity-50' : ''" style="transition: opacity 150ms">
            @include('admin.partners._results', ['partners' => $partners, 'filters' => $filters])
        </div>
    </div>
</div>

@endsection
