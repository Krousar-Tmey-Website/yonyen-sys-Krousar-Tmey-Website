@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
@endpush

@section('title', 'Book for Sales')
@section('page-title', 'Book for Sales')
@section('breadcrumb', 'Manage books available for purchase on the Get Involved page')

@section('content')

<div class="form-container">
    <div class="grid lg:grid-cols-3 gap-6">
        {{-- Add form --}}
        <div class="form-card lg:col-span-1">
            <div class="card-header">
                <div class="icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <h3>Add New Book</h3>
                <span class="badge">New</span>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.books._form', ['book' => null])

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Add Book
                        </button>
                        <button type="reset" class="btn-cancel">Reset</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Listing --}}
        <div class="lg:col-span-2" x-data="bookManager()" x-init="init()">
            {{-- Toolbar --}}
            <div class="table-container mb-5">
                <div class="table-header">
                    <h3>All Books</h3>
                    <span class="count-badge">Showing <span x-text="total">{{ $totalBooks ?? 0 }}</span></span>
                </div>
                <div class="px-6 py-3.5 bg-white">
                    <div class="flex flex-wrap items-center gap-3">
                        {{-- Search --}}
                        <div class="relative flex-1 min-w-[200px]">
                            <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" x-model="search" @input.debounce="applyFilters()"
                                   placeholder="Search by title..."
                                   class="form-control pl-10">
                        </div>

                        {{-- Availability filter --}}
                        <div class="relative">
                            <select x-model="availability" @change="applyFilters()" class="form-control min-w-[140px]">
                                <option value="">All books</option>
                                <option value="available">Available</option>
                                <option value="unavailable">Unavailable</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Results --}}
            <div x-ref="results">
                @include('admin.books._results')
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
                        <li>Only books marked as <strong>Available</strong> appear on the public Get Involved page.</li>
                        <li>Search supports partial title or author matches.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Alpine.js Component --}}
<script>
function bookManager() {
    return {
        search: '{{ $filters['search'] ?? '' }}',
        availability: '{{ $filters['availability'] ?? '' }}',
        total: {{ $totalBooks ?? 0 }},
        activeFilters: {{ $activeCount ?? 0 }},
        loading: false,

        init() {
            // Initial list is server-rendered; only re-rendered on filter.
        },

        applyFilters() {
            const params = new URLSearchParams();
            if (this.search) params.set('search', this.search);
            if (this.availability) params.set('availability', this.availability);

            this.loading = true;

            fetch(`{{ route('admin.books.index') }}?${params.toString()}`, {
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
