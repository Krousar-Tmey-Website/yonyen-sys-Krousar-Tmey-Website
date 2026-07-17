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
        {{-- Listing --}}
        <div class="lg:col-span-3" x-data="bookManager()" x-init="init()">
            {{-- Add form modal --}}
            <div x-show="openAddModal" class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-cloak>
                <div class="bg-white rounded-2xl border border-gray-100 p-6 max-w-lg w-full max-h-[90vh] overflow-y-auto shadow-2xl relative" @click.away="openAddModal = false">
                    {{-- Close button --}}
                    <button @click="openAddModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>

                    <h3 class="font-bold text-gray-800 text-lg mb-4">Add New Book</h3>
                    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        @include('admin.books._form', ['book' => null])

                        <div class="flex justify-end gap-2 pt-4 border-t border-gray-50">
                            <button type="button" @click="openAddModal = false" class="px-4 py-2 border border-gray-200 rounded-xl text-sm font-medium text-gray-500 hover:bg-gray-50 transition">Cancel</button>
                            <button type="submit" class="btn-primary text-sm py-2 px-5">Add Book</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Header & Toolbar --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-5 mb-6 shadow-sm">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
                    <div class="flex items-center gap-3">
                        <h3 class="font-bold text-gray-800 text-base">All Books</h3>
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-[#2d6fa3]/5 text-[#2d6fa3]">
                            Showing <span x-text="total">{{ $totalBooks ?? 0 }}</span>
                        </span>
                    </div>
                    <button @click="openAddModal = true" class="btn-primary flex items-center gap-1.5 text-xs py-2 px-4 shadow-sm self-start sm:self-auto">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Add New Book
                    </button>
                </div>
                
                {{-- Search & Filters --}}
                <div class="flex flex-col sm:flex-row items-center gap-3">
                    {{-- Search Input --}}
                    <div class="relative flex-1 w-full">
                        <svg class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" x-model="search" @input.debounce="applyFilters()"
                               placeholder="Search by title..."
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>

                    {{-- Availability Dropdown --}}
                    <div class="w-full sm:w-auto">
                        <select x-model="availability" @change="applyFilters()"
                                class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] min-w-[150px]">
                            <option value="">All books</option>
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                        </select>
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
        </div>
    </div>
</div>

{{-- Alpine.js Component --}}
<script>
function bookManager() {
    return {
        openAddModal: {{ $errors->any() ? 'true' : 'false' }},
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
