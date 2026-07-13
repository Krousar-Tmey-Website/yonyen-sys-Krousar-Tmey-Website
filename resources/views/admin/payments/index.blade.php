@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
@endpush

@section('title', 'Payment Methods')
@section('page-title', 'Payment Methods')
@section('breadcrumb', 'Manage payment methods available for donors')

@section('content')

<div style="max-width:100%;padding:0;background:#f8f9fa;min-height:100vh;">
    <div class="grid lg:grid-cols-3 gap-6">

        {{-- Add Payment Method Form --}}
        <div class="form-card-compact lg:col-span-1" style="border-radius:12px;border:1px solid #e5e7eb;box-shadow:0 1px 3px rgba(0,0,0,0.06),0 1px 2px rgba(0,0,0,0.04);">
            <div class="card-head" style="background:#f9fafb;">
                <div class="icon-box blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:20px;height:20px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <h3>Add Payment Method</h3>
                <span class="badge-new">New</span>
            </div>
            <div class="card-body" style="padding:20px;">
                <form action="{{ route('admin.payments.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.payments._form', ['paymentMethod' => null])

                    <div class="form-actions-compact" style="margin:20px -20px -20px;">
                        <button type="submit" class="btn-primary" style="flex:1;justify-content:center;">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add Method
                        </button>
                        <button type="reset" class="btn-cancel">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Payment Methods List --}}
        <div class="lg:col-span-2" x-data="paymentManager()" x-init="init()">

            {{-- Toolbar --}}
            <div class="table-container mb-5">
                <div class="table-header-modern">
                    <h3>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                        All Payment Methods
                    </h3>
                    <span class="count-badge">Showing <span x-text="total">{{ $totalMethods ?? 0 }}</span></span>
                </div>
                <div class="filter-bar">
                    <div class="search-input">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" x-model="search" @input.debounce="applyFilters()"
                               placeholder="Search by name...">
                    </div>
                    <div class="filter-icon-wrap">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:14px;height:14px;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                        </svg>
                        <select x-model="status" @change="applyFilters()" class="filter-select" style="padding-left:32px;">
                            <option value="">All methods</option>
                            <option value="active">Active</option>
                            <option value="inactive">Disabled</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Results --}}
            <div x-ref="results">
                @include('admin.payments._results')
            </div>

            {{-- Loading Spinner --}}
            <div x-show="loading" x-cloak class="text-center py-8">
                <svg class="animate-spin" fill="none" viewBox="0 0 24 24" style="width:22px;height:22px;color:#2d6fa3;margin:0 auto;">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
                </svg>
            </div>

            {{-- Quick Tips --}}
            <div class="tips-box mt-6">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:20px;height:20px;flex-shrink:0;color:#3b82f6;margin-top:2px;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <div class="text-[13px] font-medium text-[#1e40af]">Quick Tips</div>
                    <ul class="text-xs text-[#3b82f6]/80 mt-1 pl-4 list-disc space-y-0.5">
                        <li>Only <strong>Active</strong> payment methods appear on the public Donate page.</li>
                        <li>Upload a QR code image so donors can scan and pay easily.</li>
                        <li>Use <strong>Sort Order</strong> to control display priority (lowest number = first).</li>
                        <li>Click the <strong>QR thumbnail</strong> to preview in full size.</li>
                    </ul>
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
