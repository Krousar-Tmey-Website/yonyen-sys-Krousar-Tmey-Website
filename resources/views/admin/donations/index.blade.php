@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
@endpush

@section('title', 'Manage Donations')
@section('page-title', 'Manage Donations')
@section('breadcrumb', 'Record and track local donations received at the NGO')

@section('content')

<div class="form-container" x-data="donationManager()" x-init="init()">

    {{-- ── Header + Add Button ── --}}
    <div class="flex items-center justify-between mb-5">
        <div>
            <h2 class="text-lg font-bold text-gray-800">All Donations</h2>
            <p class="text-xs text-gray-400 mt-0.5">
                Showing <span x-text="total">{{ $totalDonations ?? 0 }}</span> donations
            </p>
        </div>
        <a href="{{ route('admin.donations.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add New Donation
        </a>
    </div>

    {{-- ── Toolbar ── --}}
    <div class="table-container mb-5">
        <div class="px-6 py-4 bg-white">
            <div class="flex flex-wrap items-center gap-3">
                {{-- Search --}}
                <div class="relative flex-1 min-w-[220px]">
                    <svg​​ fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" x-model="search" @input.debounce="applyFilters()"
                           placeholder="Search donor, transaction ID..."
                           class="form-control pl-10">
                </div>

                {{-- Donation Type --}}
                <div class="relative">
                    <select x-model="type" @change="applyFilters()" class="form-control min-w-[140px]">
                        <option value="">All types</option>
                        @foreach($donationTypes as $dt)
                        <option value="{{ $dt }}">{{ $dt }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Payment Method --}}
                <div class="relative">
                    <select x-model="payment" @change="applyFilters()" class="form-control min-w-[150px]">
                        <option value="">All payments</option>
                        @foreach($paymentMethods as $pm)
                        <option value="{{ $pm }}">{{ $pm }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Clear filters --}}
                <button x-show="activeFilters > 0" @click="clearFilters()"
                        class="text-xs text-gray-500 hover:text-gray-700 px-2.5 py-1.5 rounded-lg hover:bg-gray-100 border border-gray-200 transition-colors">
                    Clear filters
                </button>
            </div>
        </div>

        {{-- Active filter indicators --}}
        <div x-show="activeFilters > 0" x-cloak class="px-6 py-2 bg-gray-50 border-t border-gray-100 flex items-center gap-2 text-xs text-gray-500">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
            <span><span x-text="activeFilters"></span> filter(s) active</span>
        </div>
    </div>

    {{-- ── Results ── --}}
    <div x-ref="results">
        @include('admin.donations._results')
    </div>

    {{-- Loading --}}
    <div x-show="loading" class="text-center py-8">
        <svg class="animate-spin h-6 w-6 text-[#2d6fa3] mx-auto" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z" />
        </svg>
    </div>

    {{-- Quick Tips --}}
    <div class="tips-box mt-6">
        <svg class="tips-icon w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
            <div class="text-[13px] font-medium text-[#1e40af]">Quick Tips</div>
            <ul class="text-xs text-[#3b82f6]/80 mt-1 pl-4 list-disc">
                <li>Search works by donor name, email, or transaction ID.</li>
                <li>Click <strong>View</strong> to see full donation details, or <strong>Edit</strong> to make changes.</li>
            </ul>
        </div>
    </div>
</div>

{{-- Alpine.js Component --}}
<script>
function donationManager() {
    return {
        search: '{{ $filters['search'] ?? '' }}',
        type: '{{ $filters['type'] ?? '' }}',
        payment: '{{ $filters['payment'] ?? '' }}',
        total: {{ $totalDonations ?? 0 }},
        activeFilters: {{ $activeCount ?? 0 }},
        loading: false,

        init() {},

        applyFilters() {
            const params = new URLSearchParams();
            if (this.search) params.set('search', this.search);
            if (this.type) params.set('type', this.type);
            if (this.payment) params.set('payment', this.payment);

            this.loading = true;

            fetch(`{{ route('admin.donations.index') }}?${params.toString()}`, {
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
        },

        clearFilters() {
            this.search = '';
            this.type = '';
            this.payment = '';
            this.applyFilters();
        }
    };
}
</script>

@endsection
