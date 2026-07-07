@extends('admin.layouts.app')

@section('title', 'Partners')
@section('page-title', 'Partners')
@section('breadcrumb', 'Manage partner organisations displayed on the About page')


@section('content')

    <div class="grid lg:grid-cols-3 gap-6">


        {{-- FORM CARD --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 h-fit">

            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-bold text-gray-800">
                        {{ isset($editPartner) ? 'Edit Partner' : 'Add Partner' }}
                    </h3>
                    
                </div>
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
            </div>

            <form
                action="{{ isset($editPartner) ? route('admin.partners.update', $editPartner) : route('admin.partners.store') }}"
                method="POST" enctype="multipart/form-data" class="space-y-5">

                @csrf

                @if (isset($editPartner))
                    @method('PUT')

                    {{-- is_active checkbox --}}
                    <div class="flex items-center justify-between px-5 py-4 bg-gray-50/80 border-2 border-gray-200 rounded-xl transition hover:border-gray-300">
                        <div>
                            <p class="text-sm font-semibold text-gray-700">Status</p>
                            <p class="text-xs text-gray-400 mt-0.5">Show on public website</p>
                        </div>
                        <label class="flex items-center gap-3 cursor-pointer select-none">
                            <input type="checkbox" name="is_active" value="1"
                                   {{ old('is_active', $editPartner->is_active ?? true) ? 'checked' : '' }}
                                   class="w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500 focus:ring-2">
                            <span class="text-sm font-medium {{ $editPartner->is_active ? 'text-emerald-600' : 'text-gray-400' }}">
                                {{ $editPartner->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </label>
                    </div>

                    {{-- sort_order --}}
                    <div>
                        <label for="sort_order" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Sort Order <span class="text-gray-400 font-normal">(lower = first)</span>
                        </label>
                        <input type="number" id="sort_order" name="sort_order"
                            value="{{ old('sort_order', $editPartner->sort_order ?? 0) }}"
                            class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 transition-all hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none"
                            placeholder="0">
                    </div>
                @endif

                {{-- NAME --}}
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
                            value="{{ old('name', $editPartner->name ?? '') }}"
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
                    <label for="category" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Category <span class="text-red-400">*</span>
                    </label>
                    <div class="relative">
                        <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v2a2 2 0 002 2m14 0v6a2 2 0 01-2 2H7a2 2 0 01-2-2v-6" />
                        </svg>
                        <select id="category" name="category"
                            class="w-full pl-11 pr-10 py-3 bg-white border-2 border-gray-200 rounded-xl text-sm text-gray-700 appearance-none cursor-pointer transition-all hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none
                                {{ $errors->has('category') ? 'border-red-300 focus:border-red-400 focus:ring-red-100' : '' }}">
                            @foreach ($categories as $value => $label)
                                <option value="{{ $value }}"
                                    {{ old('category', $editPartner->category ?? '') == $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        <svg class="w-4 h-4 text-gray-400 absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                    @error('category')
                        <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- COUNTRY --}}
                <div>
                    <label for="country" class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Country <span class="text-gray-400 font-normal">(optional)</span>
                    </label>
                    <div class="relative">
                        <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h1A1.5 1.5 0 0113 9.5v0A1.5 1.5 0 0014.5 11h1a1.5 1.5 0 011.5 1.5v0a1.5 1.5 0 001.5 1.5h1.535M15 21v-2a2 2 0 012-2h1.535M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <input type="text" id="country" name="country" autocomplete="off"
                            value="{{ old('country', $editPartner->country ?? '') }}"
                            class="w-full pl-11 pr-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 transition-all hover:border-gray-300 focus:border-blue-500 focus:ring-4 focus:ring-blue-100 focus:outline-none"
                            placeholder="Example: Switzerland">
                    </div>
                </div>

                {{-- LOGO --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Partner Logo
                    </label>
                 

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
                                PNG, JPG or SVG (max 2MB)
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

                    {{-- Existing Logo --}}
                    @if (isset($editPartner) && $editPartner->logo)
                        <div class="mt-6">
                            <p class="text-xs font-semibold text-gray-500 mb-2">Current Logo</p>
                            <div class="flex items-center gap-4 bg-gray-50/80 border-2 border-gray-200 rounded-xl p-4 hover:border-gray-300 transition">
                                <div class="w-20 h-20 bg-white rounded-xl border-2 border-gray-100 flex items-center justify-center flex-shrink-0 overflow-hidden">
                                    <img src="{{ asset('storage/' . $editPartner->logo) }}"
                                        class="max-w-full max-h-full object-contain p-2">
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-gray-700">Partner Logo</p>
                                    <p class="text-xs text-gray-400 truncate">{{ basename($editPartner->logo) }}</p>
                                    <p class="text-xs text-gray-400 mt-0.5">Currently uploaded — replace above if needed</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white rounded-xl py-3 text-sm font-semibold transition-all flex items-center justify-center gap-2 shadow-sm hover:shadow-md hover:-translate-y-0.5 active:translate-y-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        @if (isset($editPartner))
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 13l4 4L19 7" />
                        @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v16m8-8H4" />
                        @endif
                    </svg>
                    {{ isset($editPartner) ? 'Update Partner' : 'Add Partner' }}
                </button>

            </form>

        </div>








        {{-- LIST --}}
        <div class="lg:col-span-2 space-y-5"
             x-data="partnerSearch()">

            {{-- LIST HEADER: toolbar with live search + filter --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

                <div class="flex items-center justify-between flex-wrap gap-4 mb-4">
                    <div class="flex items-center gap-2">
                        <h3 class="font-bold text-gray-800">All Partners</h3>
                        <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-semibold"
                              x-text="`Showing ${total}`">
                            Showing {{ collect($partners)->sum(fn($g) => $g->count()) }}
                        </span>
                    </div>
                    <template x-if="hasFilters">
                        <span class="px-2.5 py-1 bg-gray-50 border border-gray-100 text-gray-500 text-xs font-medium rounded-full"
                              x-text="filtersActive === 1 ? '1 filter applied' : filtersActive + ' filters applied'">
                        </span>
                    </template>
                </div>

                <div class="flex flex-wrap items-center gap-3">

                    {{-- Live search input --}}
                    <div class="relative flex-1 min-w-[220px]">
                        <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" x-model="search"
                               x-on:input.debounce.400ms="fetchPartners()"
                            placeholder="Search partner name..."
                            class="w-full bg-gray-50 border border-gray-100 rounded-full pl-10 pr-10 py-2.5 text-sm text-gray-600 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-100 transition-all">
                        {{-- Clear button --}}
                        <button x-show="search.length > 0"
                                @click="search = ''; fetchPartners()"
                                class="absolute right-2 top-1/2 -translate-y-1/2 p-1 rounded-full text-gray-400 hover:text-gray-600 hover:bg-gray-200 transition"
                                type="button">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    {{-- Category filter --}}
                    <div class="relative">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-9.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                        </svg>
                        <select x-model="category" @change="fetchPartners()"
                            class="pl-10 pr-8 py-2.5 rounded-full border border-gray-200 text-sm font-medium text-gray-600 bg-white appearance-none focus:outline-none focus:ring-2 focus:ring-blue-100 cursor-pointer">
                            <option value="">All Categories</option>
                            @foreach ($categories as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                        <svg class="w-3.5 h-3.5 text-gray-400 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>

                    {{-- Reset --}}
                    <button x-show="hasFilters"
                            @click="resetFilters()"
                            class="px-5 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-500 rounded-full text-sm font-medium transition">
                        Reset
                    </button>

                </div>
            </div>

            {{-- Loading overlay --}}
            <div x-show="loading"
                 x-transition:enter="transition ease-out duration-150"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 class="flex items-center justify-center py-8 text-gray-400 gap-2">
                <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-sm">Searching...</span>
            </div>

            {{-- Results container (replaced by AJAX) --}}
            <div id="partners-results" x-show="!loading">
                @include('admin.partners._results')
            </div>

        </div>


    </div>



@push('scripts')
<script>
    function partnerSearch() {
        return {
            search: '{{ $filters['search'] ?? '' }}',
            category: '{{ $filters['category'] ?? '' }}',
            loading: false,
            total: {{ collect($partners)->sum(fn($g) => $g->count()) }},
            hasSearch: {{ filled($filters['search'] ?? null) ? 'true' : 'false' }},
            hasCategory: {{ filled($filters['category'] ?? null) ? 'true' : 'false' }},
            get hasFilters() {
                return this.hasSearch || this.hasCategory;
            },

            get filtersActive() {
                return (this.hasSearch ? 1 : 0) + (this.hasCategory ? 1 : 0);
            },

            async fetchPartners() {
                this.loading = true;
                try {
                    const params = new URLSearchParams();
                    if (this.search) params.set('search', this.search);
                    if (this.category) params.set('category', this.category);
                    const res = await fetch(`{{ route('admin.partners.index') }}?${params}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                        }
                    });
                    if (!res.ok) throw new Error('Search request failed');
                    const data = await res.json();
                    document.getElementById('partners-results').innerHTML = data.html;
                    this.total = data.total;
                    this.hasSearch = data.hasSearch;
                    this.hasCategory = data.hasCategory;
                } catch (e) {
                    console.error('Partner search failed:', e);
                } finally {
                    this.loading = false;
                }
            },

            resetFilters() {
                this.search = '';
                this.category = '';
                this.fetchPartners();
            }
        };
    }
</script>
@endpush

@endsection