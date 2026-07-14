@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
@endpush

@section('title', 'Payment Methods')
@section('page-title', 'Payment Methods')
@section('breadcrumb', 'Manage payment methods available for donors')

@section('content')

<div class="payments-page">
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
        <div class="payments-header-right">
            <div class="payments-header-stats">
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
            <a href="{{ route('admin.payments.create') }}" class="payments-btn-add">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Payment Method
            </a>
        </div>
    </div>

    {{-- Main Content Area --}}
    <div class="payments-content" x-data="paymentManager()" x-init="init()">

        {{-- Filter Bar --}}
        <div class="payments-filter-bar">
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
                    <option value="">All Methods</option>
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
        total: {{ $totalMethods ?? 0 }},
        activeFilters: {{ $activeCount ?? 0 }},
        loading: false,

        init() {},

        applyFilters() {
            const params = new URLSearchParams();
            if (this.search) params.set('search', this.search);
            if (this.status) params.set('status', this.status);

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
