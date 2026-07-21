@extends('admin.layouts.app')

@section('title', 'Partners')
@section('page-title', 'Partners')
@section('breadcrumb', 'Manage partner organisations displayed on the About page')

@section('content')

<div class="space-y-6"
     x-data="{
        viewing: false,
        viewPartner: {},

        openViewModal(partner) {
            this.viewPartner = partner;
            this.viewing = true;
        },

        closeView() {
            this.viewing = false;
        },

        formatDate(value) {
            if (!value) return '—';
            const d = new Date(value);
            if (isNaN(d)) return '—';
            return d.toLocaleDateString('en-GB', { day: '2-digit', month: 'short', year: 'numeric' });
        },
     }">

    {{-- Partners List --}}
    <div class="lg:col-span-2 space-y-5"
         x-data="{
            search: @js($filters['search'] ?? ''),
            category: @js($filters['category'] ?? ''),
            subcategory: @js($filters['subcategory'] ?? ''),
            total: @js($totalPartners),
            activeFilters: @js($activeCount),
            loading: false,
            applyFilters() {
                this.loading = true;
                const params = new URLSearchParams();
                if (this.search) params.set('search', this.search);
                if (this.category) params.set('category', this.category);
                if (this.subcategory) params.set('subcategory', this.subcategory);
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
                this.category = '';
                this.subcategory = '';
                this.applyFilters();
            }
         }"
         x-init="
            $watch('search', () => applyFilters());
            $watch('category', (value) => { if (value !== 'Financial Partners') { subcategory = ''; } applyFilters(); });
            $watch('subcategory', () => applyFilters());
         ">

        {{-- Toolbar: title, count, search + category filter --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between flex-wrap gap-4 mb-4">
                <div class="flex items-center gap-2">
                    <h3 class="font-bold text-gray-800">All Partners</h3>
                    <span class="px-2.5 py-1 bg-[#2d6fa3]/10 text-[#2d6fa3] rounded-full text-xs font-semibold">
                        Showing <span x-text="total">{{ $totalPartners }}</span>
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <span class="px-2.5 py-1 bg-gray-50 border border-gray-100 text-gray-500 text-xs font-medium rounded-full"
                          x-show="activeFilters > 0" x-cloak
                          x-text="activeFilters + ' ' + (activeFilters === 1 ? 'filter' : 'filters') + ' applied'">
                    </span>

                    <a href="{{ route('admin.partners.create') }}"
                       class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-full text-sm font-semibold transition-colors shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add New Partner
                    </a>
                </div>
            </div>

            <form method="GET" action="{{ route('admin.partners.index') }}" class="flex flex-wrap items-center gap-3" @submit.prevent="applyFilters()">
                <div class="relative flex-1 min-w-[220px]">
                    <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                           x-model.debounce.400ms="search"
                           placeholder="Search by name..."
                           autocomplete="off"
                           class="w-full bg-gray-50 border border-gray-300 rounded-full pl-10 pr-4 py-2.5 text-sm text-gray-700 placeholder:text-gray-400 transition-all duration-150 hover:border-gray-400 focus:outline-none focus:bg-white focus:border-[#2d6fa3] focus:ring-4 focus:ring-[#2d6fa3]/15">
                </div>

                <div class="relative">
                    <select name="category" x-model="category"
                            class="pl-4 pr-9 py-2.5 rounded-full border border-gray-300 text-sm font-medium text-gray-600 bg-white appearance-none cursor-pointer transition-all duration-150 hover:border-gray-400 focus:outline-none focus:border-[#2d6fa3] focus:ring-4 focus:ring-[#2d6fa3]/15">
                        <option value="">All Categories</option>
                        @foreach($mainCategories as $cat)
                            <option value="{{ $cat->value }}" {{ ($filters['category'] ?? '') === $cat->value ? 'selected' : '' }}>
                                {{ $cat->value }}
                            </option>
                        @endforeach
                    </select>
                    <svg class="w-3.5 h-3.5 text-gray-400 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <div class="relative" x-show="category === 'Financial Partners'" x-cloak>
                    <select name="subcategory" x-model="subcategory"
                            class="pl-4 pr-9 py-2.5 rounded-full border border-gray-300 text-sm font-medium text-gray-600 bg-white appearance-none cursor-pointer transition-all duration-150 hover:border-gray-400 focus:outline-none focus:border-[#2d6fa3] focus:ring-4 focus:ring-[#2d6fa3]/15">
                        <option value="">All Subcategories</option>
                        @foreach($subcategories as $sub)
                            <option value="{{ $sub->value }}" {{ ($filters['subcategory'] ?? '') === $sub->value ? 'selected' : '' }}>
                                {{ $sub->value }}
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

        {{-- Results --}}
        <div x-ref="results" class="space-y-5" :class="loading ? 'opacity-50' : ''" style="transition: opacity 150ms">
            @include('admin.partners._results', ['partners' => $partners, 'filters' => $filters])
        </div>
    </div>

    {{-- View Partner Details Modal --}}
    <template x-teleport="body">
        <div x-show="viewing"
             x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center p-4"
             @keydown.escape.window="closeView()">
            <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" @click="closeView()"></div>

            <div class="relative bg-white rounded-3xl shadow-2xl w-full max-w-[700px] max-h-[90vh] overflow-y-auto z-10"
                 @click.stop
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">

                {{-- Header --}}
                <div class="sticky top-0 bg-white border-b border-gray-100 px-8 py-6 flex items-start justify-between rounded-t-3xl z-10">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900" x-text="viewPartner.name"></h3>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium"
                                  :class="viewPartner.category === 'Financial Partners' ? 'bg-amber-50 text-amber-700' : 'bg-blue-50 text-[#2d6fa3]'"
                                  x-text="viewPartner.subcategory || viewPartner.category"></span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold"
                                  :class="viewPartner.is_active ? 'bg-emerald-100 text-emerald-600' : 'bg-gray-100 text-gray-500'"
                                  x-text="viewPartner.is_active ? 'Active' : 'Hidden'"></span>
                        </div>
                    </div>
                    <button @click="closeView()" type="button"
                            class="w-9 h-9 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors duration-150 flex-shrink-0">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="p-8 space-y-6">
                    {{-- Logo --}}
                    <div class="flex items-center justify-center">
                        <template x-if="viewPartner.logo_url">
                            <div class="w-28 h-28 bg-[#F8FAFC] rounded-2xl border border-gray-100 flex items-center justify-center overflow-hidden">
                                <img :src="viewPartner.logo_url" class="max-w-full max-h-full object-contain p-3">
                            </div>
                        </template>
                        <template x-if="!viewPartner.logo_url">
                            <div class="w-28 h-28 bg-[#F8FAFC] rounded-2xl border-2 border-dashed border-gray-200 flex flex-col items-center justify-center gap-1.5 text-center px-2">
                                <svg class="w-7 h-7 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M14 8h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-[11px] text-gray-400 font-medium leading-tight">No Logo Available</p>
                            </div>
                        </template>
                    </div>

                    {{-- Info card --}}
                    <div class="bg-[#F8FAFC] border border-gray-100 rounded-2xl divide-y divide-gray-100">
                        <div class="flex items-center justify-between px-5 py-4">
                            <div class="flex items-center gap-3 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <span class="text-sm font-medium">Main Category</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-800" x-text="viewPartner.category"></span>
                        </div>
                        <template x-if="viewPartner.subcategory">
                            <div class="flex items-center justify-between px-5 py-4">
                                <div class="flex items-center gap-3 text-gray-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    <span class="text-sm font-medium">Subcategory</span>
                                </div>
                                <span class="text-sm font-semibold text-gray-800" x-text="viewPartner.subcategory"></span>
                            </div>
                        </template>
                        <div class="flex items-center justify-between px-5 py-4">
                            <div class="flex items-center gap-3 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4" />
                                </svg>
                                <span class="text-sm font-medium">Display Order</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-800" x-text="viewPartner.sort_order ?? 0"></span>
                        </div>
                        <div class="flex items-center justify-between px-5 py-4">
                            <div class="flex items-center gap-3 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm font-medium">Status</span>
                            </div>
                            <span class="text-sm font-semibold" :class="viewPartner.is_active ? 'text-emerald-600' : 'text-gray-500'" x-text="viewPartner.is_active ? 'Active' : 'Hidden'"></span>
                        </div>
                        <div class="flex items-center justify-between px-5 py-4">
                            <div class="flex items-center gap-3 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-sm font-medium">Created At</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-800" x-text="formatDate(viewPartner.created_at)"></span>
                        </div>
                        <div class="flex items-center justify-between px-5 py-4">
                            <div class="flex items-center gap-3 text-gray-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm font-medium">Last Updated</span>
                            </div>
                            <span class="text-sm font-semibold text-gray-800" x-text="formatDate(viewPartner.updated_at)"></span>
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="sticky bottom-0 bg-white border-t border-gray-100 px-8 py-5 flex items-center justify-between rounded-b-3xl">
                    <button type="button" @click="closeView()"
                            class="text-sm font-medium text-gray-400 hover:text-gray-600 transition-colors duration-150">
                        Close
                    </button>
                    <a :href="'{{ route('admin.partners.edit', '__ID__') }}'.replace('__ID__', viewPartner.id)"
                       class="h-[52px] w-[180px] inline-flex items-center justify-center gap-2 bg-[#2563EB] hover:bg-blue-700 active:bg-blue-800 text-white rounded-2xl text-sm font-semibold transition-all duration-200 shadow-sm hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Partner
                    </a>
                </div>
            </div>
        </div>
    </template>
</div>
@endsection
