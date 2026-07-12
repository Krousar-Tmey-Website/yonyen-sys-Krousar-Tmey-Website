@extends('admin.layouts.app')

@section('title', 'Books for Sale')
@section('page-title', 'Books for Sale')
@section('breadcrumb', 'Manage books available for purchase on the Get Involved page')

@section('content')

<div class="grid xl:grid-cols-3 gap-6">
    {{-- Add form --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="font-bold text-gray-800">Add New Book</h3>
                <p class="text-sm text-gray-400 mt-0.5">Add a book that visitors can purchase.</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </div>
        </div>

        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @include('admin.books._form', ['book' => null])

            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <button type="reset"
                   class="px-4 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl transition">
                    Reset
                </button>
                <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white rounded-xl text-sm font-semibold transition-all flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Book
                </button>
            </div>
        </form>
    </div>

    {{-- Listing --}}
    <div class="xl:col-span-2" x-data="bookManager()" x-init="init()">
        {{-- Toolbar --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-4 mb-4 flex flex-wrap items-center justify-between gap-3">
            <div class="flex items-center gap-3 flex-wrap">
                {{-- Search --}}
                <div class="relative">
                    <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" x-model="search" @input.debounce="applyFilters()"
                           placeholder="Search by title or author..."
                           class="pl-9 pr-4 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] w-56">
                </div>

                {{-- Availability filter --}}
                <select x-model="availability" @change="applyFilters()"
                        class="px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    <option value="">All books</option>
                    <option value="available">Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>

                {{-- Active filter count --}}
                <template x-if="activeFilters > 0">
                    <span class="text-xs text-gray-400 bg-gray-50 px-3 py-1.5 rounded-lg" x-text="`${total} result(s)`"></span>
                </template>
            </div>
            <a href="{{ route('admin.books.create') }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-semibold transition-all shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add New Book
            </a>
        </div>

        {{-- Results --}}
        <div id="results" x-html="resultsHTML">
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
        <div class="mt-6 bg-[#f8f9fc] rounded-2xl border border-gray-100 p-5">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-4 h-4 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-semibold text-gray-700">Quick Tips</span>
            </div>
            <ul class="text-xs text-gray-500 space-y-1 ml-6 list-disc">
                <li>Only books marked as <strong>Available</strong> with stock &gt; 0 appear on the public page.</li>
                <li>Use <strong>Display Order</strong> to control the sort position (lower = first).</li>
                <li>Search supports partial title and author matches.</li>
            </ul>
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
        resultsHTML: '',

        init() {
            // Store initial HTML from server-rendered list
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
                this.resultsHTML = data.html;
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
