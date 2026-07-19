@extends('admin.layouts.app')

@section('title', 'Partners')
@section('page-title', 'Partners')
@section('breadcrumb', 'Manage partner organisations displayed on the About page')

@section('content')

<div class="space-y-6"
     x-data="{
        showModal: false,
        editing: false,
        editingId: null,
        form: {},

        openAddModal() {
            this.editing = false;
            this.editingId = null;
            this.form = {};
            this.showModal = true;
            this.$nextTick(() => {
                const fileInput = document.getElementById('modal-logo-input');
                if (fileInput) fileInput.value = '';
                document.getElementById('modal-logo-placeholder')?.classList.remove('hidden');
                document.getElementById('modal-logo-selected')?.classList.add('hidden');
                document.getElementById('modal-logo-selected')?.classList.remove('flex');
            });
        },

        openEditModal(partner) {
            this.editing = true;
            this.editingId = partner.id;
            this.form = partner;
            this.showModal = true;
            this.$nextTick(() => {
                const fileInput = document.getElementById('modal-logo-input');
                if (fileInput) fileInput.value = '';
                document.getElementById('modal-logo-placeholder')?.classList.remove('hidden');
                document.getElementById('modal-logo-selected')?.classList.add('hidden');
                document.getElementById('modal-logo-selected')?.classList.remove('flex');
            });
        },

        closeModal() {
            this.showModal = false;
            this.editing = false;
            this.editingId = null;
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
                           placeholder="Search by name or country..."
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

    {{-- Modal Backdrop & Container --}}
    <template x-teleport="body">
        <div x-show="showModal"
             x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center p-4"
             @keydown.escape.window="closeModal()">
            {{-- Backdrop --}}
            <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" @click="closeModal()"></div>

            {{-- Modal panel --}}
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto z-10"
                 @click.stop
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">

                {{-- Header --}}
                <div class="sticky top-0 bg-white border-b border-gray-100 px-6 py-4 flex items-center justify-between rounded-t-2xl z-10">
                    <h3 class="font-bold text-gray-800" x-text="editing ? 'Edit Partner' : 'Add New Partner'"></h3>
                    <button @click="closeModal()" type="button"
                            class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Form (exact same layout as original inline form) --}}
                <form :action="editing ? '{{ route('admin.partners.update', '__ID__') }}'.replace('__ID__', editingId) : '{{ route('admin.partners.store') }}'"
                      method="POST" enctype="multipart/form-data" class="p-6 space-y-5">
                    @csrf
                    <template x-if="editing">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    {{-- NAME --}}
                    <div>
                        <label for="modal-name" class="form-label">
                            Partner Name <span class="text-red-400 font-normal">*</span>
                        </label>
                        <input type="text" id="modal-name" name="name" required autocomplete="off"
                               :value="form.name ?? ''"
                               class="form-input"
                               placeholder="Enter partner name">
                    </div>

                    {{-- CATEGORY --}}
                    <div>
                        <label for="modal-category" class="form-label">
                            Main Category <span class="text-red-400 font-normal">*</span>
                        </label>
                        <div class="relative">
                            <select id="modal-category" name="category" x-model="form.category"
                                    @change="if (form.category !== 'Financial Partners') form.subcategory = ''"
                                    class="form-input appearance-none pr-9 cursor-pointer">
                                <option value="">Select a category</option>
                                @foreach(\App\Enums\PartnerCategory::cases() as $cat)
                                    <option value="{{ $cat->value }}">{{ $cat->value }}</option>
                                @endforeach
                            </select>
                            <svg class="w-4 h-4 text-gray-400 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    {{-- SUBCATEGORY — only for Financial Partners --}}
                    <div x-show="form.category === 'Financial Partners'" x-cloak>
                        <label for="modal-subcategory" class="form-label">
                            Subcategory <span class="text-red-400 font-normal">*</span>
                        </label>
                        <div class="relative">
                            <select id="modal-subcategory" name="subcategory" x-model="form.subcategory"
                                    :disabled="form.category !== 'Financial Partners'"
                                    class="form-input appearance-none pr-9 cursor-pointer">
                                <option value="">Select a subcategory</option>
                                @foreach(\App\Enums\PartnerSubcategory::cases() as $sub)
                                    <option value="{{ $sub->value }}">{{ $sub->value }}</option>
                                @endforeach
                            </select>
                            <svg class="w-4 h-4 text-gray-400 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        {{-- SORT ORDER --}}
                        <div>
                            <label for="modal-sort_order" class="form-label">Order</label>
                            <input type="number" id="modal-sort_order" name="sort_order"
                                   :value="form.sort_order ?? 0"
                                   class="form-input">
                        </div>

                        {{-- ACTIVE (edit only) --}}
                        <template x-if="editing">
                            <div class="flex items-end pb-1.5">
                                <label class="flex items-center gap-2 cursor-pointer select-none px-3.5 py-2.5 rounded-xl border border-gray-300 bg-gray-50 hover:border-gray-400 hover:bg-white transition-all duration-150 w-full">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" value="1"
                                           :checked="form.is_active"
                                           class="w-4 h-4 accent-[#2d6fa3] cursor-pointer">
                                    <span class="text-xs font-semibold text-gray-600">Active</span>
                                </label>
                            </div>
                        </template>
                    </div>

                    {{-- LOGO --}}
                    <div>
                        <label class="form-label">Partner Logo</label>
                        <p class="text-xs text-gray-400 mb-2.5">PNG, JPG or SVG (max 2MB) — optional</p>

                        <label for="modal-logo-input" id="modal-logo-dropzone"
                               class="group flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-gray-300 rounded-2xl cursor-pointer bg-gray-50 hover:bg-[#2d6fa3]/5 hover:border-[#2d6fa3] transition-all duration-200">
                            <div class="flex flex-col items-center justify-center" id="modal-logo-placeholder">
                                <div class="w-11 h-11 rounded-full bg-white border border-gray-200 shadow-sm flex items-center justify-center mb-2.5 group-hover:scale-110 group-hover:border-[#2d6fa3]/30 transition-all duration-200">
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-[#2d6fa3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1117.9 9H18a4 4 0 010 8h-1m-4-4l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                </div>
                                <p class="text-sm font-semibold text-[#2d6fa3]">Click to upload logo</p>
                                <p class="text-xs text-gray-400 mt-0.5">or drag and drop — PNG, JPG, SVG</p>
                            </div>
                            <div class="hidden flex-col items-center justify-center gap-1.5" id="modal-logo-selected">
                                <div class="w-11 h-11 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p class="text-sm font-medium text-gray-700 px-4 text-center truncate max-w-full" id="modal-logo-filename"></p>
                                <p class="text-xs text-[#2d6fa3]">Click to choose a different file</p>
                            </div>
                            <input id="modal-logo-input" type="file" name="logo" accept="image/*" class="hidden"
                                   onchange="
                                       const f = this.files[0];
                                       if (f) {
                                           document.getElementById('modal-logo-placeholder').classList.add('hidden');
                                           document.getElementById('modal-logo-selected').classList.remove('hidden');
                                           document.getElementById('modal-logo-selected').classList.add('flex');
                                           document.getElementById('modal-logo-filename').textContent = f.name;
                                       }
                                   ">
                        </label>

                        {{-- Current logo (edit mode) --}}
                        <template x-if="editing && form.logo_url">
                            <div class="mt-4 flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-3">
                                <div class="w-12 h-12 bg-white rounded-lg border border-gray-100 flex items-center justify-center overflow-hidden">
                                    <img :src="form.logo_url" class="max-w-full max-h-full object-contain p-1">
                                </div>
                                <p class="text-xs text-gray-400">Current logo</p>
                            </div>
                        </template>
                    </div>


                    <button type="submit" class="w-full btn-primary justify-center text-sm py-2.5"
                            x-text="editing ? 'Update Partner' : 'Add Partner'">
                    </button>

                    <button type="button" @click="closeModal()"
                            class="block w-full text-center text-xs text-gray-400 hover:text-gray-600 transition-colors">
                        Cancel
                    </button>
                </form>
            </div>
        </div>
    </template>
</div>
@endsection
