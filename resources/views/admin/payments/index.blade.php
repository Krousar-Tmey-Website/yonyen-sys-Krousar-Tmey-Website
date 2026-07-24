@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
    <style>
        .payments-fr-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            text-decoration: none;
            white-space: nowrap;
            transition: all 0.15s ease;
        }
        .payments-fr-btn.primary {
            background: #eef2ff;
            color: #4f46e5;
            border: 1px solid #c7d2fe;
        }
        .payments-fr-btn.primary:hover {
            background: #e0e7ff;
            border-color: #a5b4fc;
        }
        .payments-fr-btn.secondary {
            background: #f8fafc;
            color: #64748b;
            border: 1px solid #cbd5e1;
        }
        .payments-fr-btn.secondary:hover {
            background: #f1f5f9;
            border-color: #94a3b8;
            color: #475569;
        }
        .payments-fr-btn svg {
            flex-shrink: 0;
        }
        .payments-fr-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: auto;
        }
    </style>
@endpush

@section('title', 'Payment Methods')
@section('page-title', 'Payment Methods')
@section('breadcrumb', 'Manage payment methods available for donors')

@section('content')

<div class="payments-page" x-data="paymentManager()" x-init="init()">
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
    <div class="payments-content">

        {{-- Residency Selector Tabs --}}
        <div style="padding: 20px 24px 8px 24px; border-bottom: 1px solid #eef2f6;">
            <div style="background-color: #f1f5f9; padding: 4px; border-radius: 12px; display: inline-flex; border: 1px solid #e2e8f0; gap: 4px; flex-wrap: wrap;">
                <button type="button" 
                        @click="tag = ''; applyFilters()" 
                        class="px-4 py-2 text-sm font-bold transition-all cursor-pointer border-none outline-none"
                        style="border-radius: 8px; font-weight: 700; font-size: 13px; line-height: 1.5; padding: 8px 16px;"
                        :style="tag === '' ? 'background: #1c3a5e; color: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.1);' : 'background: transparent; color: #64748b;'">
                    All Methods
                </button>
                <button type="button" 
                        @click="tag = 'cambodia'; applyFilters()" 
                        class="px-4 py-2 text-sm font-bold transition-all cursor-pointer border-none outline-none"
                        style="border-radius: 8px; font-weight: 700; font-size: 13px; line-height: 1.5; padding: 8px 16px;"
                        :style="tag === 'cambodia' ? 'background: #1c3a5e; color: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.1);' : 'background: transparent; color: #64748b;'">
                    Payment in Cambodia 🇰🇭
                </button>
                <button type="button" 
                        @click="tag = 'france'; applyFilters()" 
                        class="px-4 py-2 text-sm font-bold transition-all cursor-pointer border-none outline-none"
                        style="border-radius: 8px; font-weight: 700; font-size: 13px; line-height: 1.5; padding: 8px 16px;"
                        :style="tag === 'france' ? 'background: #1c3a5e; color: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.1);' : 'background: transparent; color: #64748b;'">
                    Fiscal residency in France 🇫🇷
                </button>
                <button type="button" 
                        @click="tag = 'switzerland'; applyFilters()" 
                        class="px-4 py-2 text-sm font-bold transition-all cursor-pointer border-none outline-none"
                        style="border-radius: 8px; font-weight: 700; font-size: 13px; line-height: 1.5; padding: 8px 16px;"
                        :style="tag === 'switzerland' ? 'background: #1c3a5e; color: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.1);' : 'background: transparent; color: #64748b;'">
                    Fiscal residency in Switzerland 🇨🇭
                </button>

                <button type="button" 
                        @click="tag = 'elsewhere'; applyFilters()" 
                        class="px-4 py-2 text-sm font-bold transition-all cursor-pointer border-none outline-none"
                        style="border-radius: 8px; font-weight: 700; font-size: 13px; line-height: 1.5; padding: 8px 16px;"
                        :style="tag === 'elsewhere' ? 'background: #1c3a5e; color: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.1);' : 'background: transparent; color: #64748b;'">
                    Fiscal residency elsewhere 🌐
                </button>
            </div>
        </div>

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

            {{-- France Content Management --}}
            <div class="payments-fr-actions">
                <a href="{{ route('admin.website.index') }}"
                   class="payments-fr-btn primary"
                   title="Manage France donation page content (contact info, settings)">
                    <span>🇫🇷</span>
                    <span>France Content</span>
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="opacity: 0.6;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
                <a href="{{ route('donate.international') }}?residency=france"
                   target="_blank" rel="noopener"
                   class="payments-fr-btn secondary"
                   title="Preview the France international donation page">
                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <span>Preview</span>
                </a>
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
