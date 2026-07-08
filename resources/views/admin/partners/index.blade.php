@extends('admin.layouts.app')

@section('title', 'Partners')
@section('page-title', 'Partners')
@section('breadcrumb', 'Manage partner organisations displayed on the About page')

@section('content')

    <div class="space-y-5"
         x-data="partnerSearch()">

        {{-- HEADER: Add button + search + category filter --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">

            <div class="flex items-center justify-between flex-wrap gap-4 mb-4">
                <div class="flex items-center gap-2">
                    <h3 class="font-bold text-gray-800">All Partners</h3>
                    <span class="px-2.5 py-1 bg-blue-50 text-blue-600 rounded-full text-xs font-semibold"
                          x-text="`Showing ${total}`">
                        Showing {{ $partners->count() }}
                    </span>
                </div>
                <a href="{{ route('admin.partners.create') }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white rounded-xl text-sm font-semibold transition-all shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Partner
                </a>
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

                {{-- Category filter dropdown --}}
                <div class="relative min-w-[200px]">
                    <select x-model="categoryId"
                            @change="fetchPartners()"
                            class="w-full bg-gray-50 border border-gray-100 rounded-full pl-4 pr-10 py-2.5 text-sm text-gray-600 appearance-none cursor-pointer focus:outline-none focus:ring-2 focus:ring-blue-100 transition-all">
                        <option value="">All Categories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $categoryId == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                {{-- Reset --}}
                <button x-show="hasFilters"
                        @click="search = ''; categoryId = ''; fetchPartners()"
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

@push('scripts')
<script>
    function partnerSearch() {
        return {
            search: '{{ $search ?? '' }}',
            categoryId: '{{ $categoryId ?? '' }}',
            loading: false,
            total: {{ $partners->count() }},
            hasSearch: {{ filled($search ?? null) ? 'true' : 'false' }},

            get hasFilters() {
                return this.hasSearch || this.categoryId !== '';
            },

            async fetchPartners() {
                this.loading = true;
                try {
                    const params = new URLSearchParams();
                    if (this.search) params.set('search', this.search);
                    if (this.categoryId) params.set('category_id', this.categoryId);
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
                } catch (e) {
                    console.error('Partner search failed:', e);
                } finally {
                    this.loading = false;
                }
            },

            resetFilters() {
                this.search = '';
                this.categoryId = '';
                this.fetchPartners();
            }
        };
    }
</script>
@endpush

@endsection
