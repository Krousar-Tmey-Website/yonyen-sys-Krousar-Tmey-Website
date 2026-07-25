@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])

@endpush

@section('title', 'Payment Methods')
@section('page-title', 'Payment Methods')
@section('breadcrumb', 'Manage payment methods available for donors')

@section('content')

<div class="payments-page" x-data="paymentManager()" x-init="init()">
    {{-- Residency Selector Tabs (styled like public donate page) --}}
    <div style="margin-bottom: 24px;">
        <div class="bg-white rounded-xl border border-slate-200/80 p-1 shadow-2xs flex flex-wrap lg:flex-nowrap justify-between gap-1 w-full">
            
            {{-- Tab: All Methods --}}
            <button type="button"
                    @click="tag = ''; applyFilters()"
                    :class="tag === '' ? 'bg-[#2d6fa3] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800'"
                    class="flex-1 flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold rounded-lg transition-all duration-200 select-none focus:outline-none cursor-pointer">
                <span>All Methods</span>
            </button>

            {{-- Tab: Cambodia --}}
            <button type="button"
                    @click="tag = 'cambodia'; applyFilters()"
                    :class="tag === 'cambodia' ? 'bg-[#2d6fa3] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800'"
                    class="flex-1 flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold rounded-lg transition-all duration-200 select-none focus:outline-none cursor-pointer">
                <span>Payment in Cambodia</span>
                <img src="{{ asset('images/Flag_of_Cambodia.svg.webp') }}" class="h-3.5 w-auto rounded-xs object-contain shrink-0 border border-slate-200/60 shadow-3xs" alt="KH">
            </button>

            {{-- Tab: France --}}
            <button type="button"
                    @click="tag = 'france'; applyFilters()"
                    :class="tag === 'france' ? 'bg-[#2d6fa3] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800'"
                    class="flex-1 flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold rounded-lg transition-all duration-200 select-none focus:outline-none cursor-pointer">
                <span>Fiscal residency in France</span>
                <img src="{{ asset('images/Flag_of_France.svg.webp') }}" class="h-3.5 w-auto rounded-xs object-contain shrink-0 border border-slate-200/60 shadow-3xs" alt="FR">
            </button>

            {{-- Tab: Switzerland --}}
            <button type="button"
                    @click="tag = 'switzerland'; applyFilters()"
                    :class="tag === 'switzerland' ? 'bg-[#2d6fa3] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800'"
                    class="flex-1 flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold rounded-lg transition-all duration-200 select-none focus:outline-none cursor-pointer">
                <span>Fiscal residency in Switzerland</span>
                <img src="{{ asset('images/Flag_of_Switzerland_(Pantone).svg.webp') }}" class="h-3.5 w-auto rounded-xs object-contain shrink-0 border border-slate-200/60 shadow-3xs" alt="CH">
            </button>

        </div>
    </div>

    {{-- Page Header --}}
    <div class="payments-header">
        <div class="payments-header-left">
            <div class="payments-header-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
            </div>
            <div>
                <h1 class="payments-header-title">Payment Methods</h1>
                <p class="payments-header-subtitle">Configure how donors can make payments on the Donate page</p>
            </div>
        </div>
        <div class="payments-header-right" style="display: flex; gap: 12px; align-items: center;">
            <div class="payments-header-stats" style="margin-right: 4px;">
                <span class="stat-item">
                    <span class="stat-value">{{ $totalMethods }}</span>
                    <span class="stat-label">Total</span>
                </span>
                <span class="stat-divider"></span>
                <span class="stat-item">
                    <span class="stat-value">{{ $paymentMethods->where('is_active', true)->count() }}</span>
                    <span class="stat-label">Active</span>
                </span>
            </div>
            {{-- Switzerland specific actions --}}
            <div style="display: flex; gap: 8px;" x-show="tag === 'switzerland'" x-cloak>
                <a href="{{ route('donate.international') }}?residency=switzerland" 
                   target="_blank" 
                   class="payments-btn-add" 
                   style="background-color: #f8fafc; color: #475569; border: 1px solid #cbd5e1; box-shadow: none;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px; margin-right: 6px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Preview SW Page
                </a>
                <a href="{{ route('admin.payments.create') }}?tag=switzerland" 
                   class="payments-btn-add" 
                   style="background-color: #0d9488; border-color: #0d9488; color: white;">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 16px; height: 16px; margin-right: 6px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create Switzerland Content
                </a>
            </div>

            <a href="{{ route('admin.payments.create') }}" class="payments-btn-add" x-show="tag !== 'france' && tag !== 'switzerland'">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Payment Method
            </a>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════
         FRANCE TAB: Donation Settings
         ════════════════════════════════════════════════ --}}
    <div x-show="tag === 'france'" x-cloak class="france-settings-panel">
        @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="w-full space-y-6">
            <form action="{{ route('admin.france-donation.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- ── Online Donation (HelloAsso) Card ── --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                            <span class="text-base">🔗</span> Online Donation (HelloAsso)
                        </h3>
                        @php
                            $hasHelloAsso = filled($settings['france_helloasso_url'] ?? '');
                        @endphp
                        <span class="text-xs px-3 py-1 rounded-full font-semibold {{ $hasHelloAsso ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-slate-100 text-slate-400 border border-slate-200' }}">
                            {{ $hasHelloAsso ? '✓ Configured' : 'Not set' }}
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Redirect URL <span class="text-gray-400 font-normal">(optional)</span></label>
                        <input type="url" name="helloasso_url"
                               value="{{ old('helloasso_url', $settings['france_helloasso_url'] ?? '') }}"
                               placeholder="https://www.helloasso.com/associations/..."
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        <p class="mt-1.5 text-xs text-gray-400">Donors will be redirected here to make an online donation via HelloAsso.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Description <span class="text-gray-400 font-normal">(optional)</span></label>
                        <textarea name="helloasso_description" rows="3"
                                  class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                                  placeholder="You can make a one-time or regular donation on our dedicated website...">{{ old('helloasso_description', $settings['france_helloasso_description'] ?? '') }}</textarea>
                        <p class="mt-1.5 text-xs text-gray-400">Shown above the HelloAsso button. Leave blank to use the default text.</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Logo / Brand Image <span class="text-gray-400 font-normal">(optional)</span></label>
                        @php $logo = $settings['france_helloasso_logo'] ?? ''; @endphp
                        @if($logo)
                        <div class="flex items-center gap-4 p-3 bg-blue-50/60 rounded-xl border border-blue-100 mb-3">
                            <div class="relative">
                                <img src="{{ str_starts_with($logo, 'http') ? $logo : asset('storage/' . $logo) . '?v=' . time() }}" alt="HelloAsso logo" class="h-16 w-auto rounded-xl border-2 border-white shadow-sm bg-white object-contain p-1.5">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-semibold text-gray-700 mb-0.5">Current logo</p>
                                <p class="text-xs text-gray-400 truncate">{{ basename($logo) }}</p>
                            </div>
                            <label class="flex items-center gap-1.5 text-xs font-semibold text-red-500 hover:text-red-700 cursor-pointer flex-shrink-0 bg-white px-3 py-1.5 rounded-lg border border-red-200 hover:bg-red-50 transition-colors">
                                <input type="checkbox" name="remove_helloasso_logo" value="1" class="rounded border-gray-300 text-red-500 w-3.5 h-3.5">
                                Remove
                            </label>
                        </div>
                        @endif
                        <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-[#2d6fa3] hover:bg-blue-50/30 transition-all duration-200 cursor-pointer group"
                             onclick="document.getElementById('helloassoLogoInput').click()">
                            <input type="file" name="helloasso_logo" id="helloassoLogoInput" accept="image/*" class="hidden">
                            <div class="flex flex-col items-center gap-2 pointer-events-none">
                                <div class="w-12 h-12 rounded-xl bg-gray-100 group-hover:bg-[#2d6fa3]/10 flex items-center justify-center transition-colors">
                                    <svg class="w-6 h-6 text-gray-400 group-hover:text-[#2d6fa3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-600 group-hover:text-[#2d6fa3] transition-colors">Click to upload logo</p>
                                    <p class="text-xs text-gray-400 mt-0.5">JPG, PNG, GIF or WebP &bull; Max 2MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ── Check / Bank Transfer Card ── --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                            <span class="text-base">📬</span> Check / Bank Transfer Details
                        </h3>
                        @php
                            $hasCheck = filled($settings['france_check_address'] ?? '');
                        @endphp
                        <span class="text-xs px-3 py-1 rounded-full font-semibold {{ $hasCheck ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-slate-100 text-slate-400 border border-slate-200' }}">
                            {{ $hasCheck ? '✓ Configured' : 'Not set' }}
                        </span>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Mailing Address <span class="text-gray-400 font-normal">(optional)</span></label>
                        <textarea name="check_address" rows="3"
                                  class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                                  placeholder="62 rue Greneta&#10;75002 Paris">{{ old('check_address', $settings['france_check_address'] ?? '') }}</textarea>
                        <p class="mt-1.5 text-xs text-gray-400">The address where donors can mail a physical check.</p>
                    </div>
                </div>

                {{-- ── Save Button ── --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-6">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <h3 class="text-sm font-bold text-gray-700">Save Settings</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Changes are saved to the database when you click Save.</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('donate') }}?residency=france" target="_blank"
                               class="flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors px-4 py-2 rounded-lg border border-gray-200 hover:border-[#2d6fa3]/30">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                Preview
                            </a>
                            <button type="submit"
                                    class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-semibold rounded-xl transition-colors inline-flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                Save France Settings
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- ════════════════════════════════════════════════
         OTHER TABS: Payment Methods Table
         ════════════════════════════════════════════════ --}}
    <div x-show="tag !== 'france'" class="payments-content">

        {{-- Filter Bar --}}
        <div class="payments-filter-bar" style="border-top: none;">
            <div class="payments-search-input">
                <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" x-model="search" @input.debounce="applyFilters()"
                       placeholder="Search by name...">
                <button x-show="search.length > 0" @click="search = ''; applyFilters()" class="search-clear-btn" type="button">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="payments-filter-select-wrap">
                <svg class="filter-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                <select x-model="status" @change="applyFilters()" class="payments-filter-select">
                    <option value="">All Statuses</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

        </div>

        {{-- Results Table --}}
        <div class="payments-table-wrapper">
            <div x-ref="results">
                @include('admin.payments._results')
            </div>

            {{-- Loading Overlay --}}
            <div x-show="loading" x-cloak class="payments-loading-overlay">
                <div class="payments-loading-spinner">
                    <svg class="animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                    </svg>
                    <span>Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Alpine.js Component --}}
<script>
function paymentManager() {
    return {
        search: '{{ $filters['search'] ?? '' }}',
        status: '{{ $filters['status'] ?? '' }}',
        tag: '{{ $filters['tag'] ?? '' }}',
        total: {{ $totalMethods ?? 0 }},
        activeFilters: {{ $activeCount ?? 0 }},
        loading: false,

        init() {},

        applyFilters() {
            const params = new URLSearchParams();
            if (this.search) params.set('search', this.search);
            if (this.status) params.set('status', this.status);
            if (this.tag) params.set('tag', this.tag);

            this.loading = true;

            fetch(`{{ route('admin.payments.index') }}?${params.toString()}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            })
            .then(res => res.json())
            .then(data => {
                this.$refs.results.innerHTML = data.html;
                this.total = data.total;
                this.activeFilters = data.activeFilters;
                history.replaceState(null, '', `?${params.toString()}`);
            })
            .catch(() => location.reload())
            .finally(() => this.loading = false);
        }
    };
}
</script>

@endsection
