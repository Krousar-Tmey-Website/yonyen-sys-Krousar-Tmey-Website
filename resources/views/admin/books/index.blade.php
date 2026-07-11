@extends('admin.layouts.app')

@section('title', 'Books for Sale')
@section('page-title', 'Books for Sale')
@section('breadcrumb', 'Manage books that visitors can purchase from the website')

@section('content')

<div class="grid lg:grid-cols-3 gap-6">

    {{-- Add Book form --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 h-fit">
        <h3 class="font-bold text-gray-700 mb-5 text-sm">Add New Book</h3>

        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @include('admin.books._form', ['book' => null])

            <button type="submit" class="w-full btn-primary justify-center text-sm py-2.5">
                Add Book
            </button>
        </form>
    </div>

    {{-- List --}}
    <div class="lg:col-span-2 space-y-5"
         x-data="{
             search: @js($filters['search'] ?? ''),
             availability: @js($filters['availability'] ?? ''),
             total: @js($totalBooks),
             activeFilters: @js($activeCount),
             loading: false,
             applyFilters() {
                 this.loading = true;
                 const params = new URLSearchParams();
                 if (this.search) params.set('search', this.search);
                 if (this.availability) params.set('availability', this.availability);
                 const url = '{{ route('admin.books.index') }}' + (params.toString() ? '?' + params.toString() : '');
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
                 this.availability = '';
                 this.applyFilters();
             }
          }"
         x-init="$watch('search', () => applyFilters()); $watch('availability', () => applyFilters())">

        {{-- Toolbar --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between flex-wrap gap-4 mb-4">
                <div class="flex items-center gap-2">
                    <h3 class="font-bold text-gray-800">All Books</h3>
                    <span class="px-2.5 py-1 bg-[#2d6fa3]/10 text-[#2d6fa3] rounded-full text-xs font-semibold">
                        Showing <span x-text="total">{{ $totalBooks }}</span>
                    </span>
                </div>
                <span class="px-2.5 py-1 bg-gray-50 border border-gray-100 text-gray-500 text-xs font-medium rounded-full"
                      x-show="activeFilters > 0" x-cloak
                      x-text="activeFilters + ' ' + (activeFilters === 1 ? 'filter' : 'filters') + ' applied'">
                </span>
            </div>

            <form method="GET" action="{{ route('admin.books.index') }}" class="flex flex-wrap items-center gap-3" @submit.prevent="applyFilters()">
                <div class="relative flex-1 min-w-[220px]">
                    <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                           x-model.debounce.400ms="search"
                            placeholder="Search by title..."
                           autocomplete="off"
                           class="w-full bg-gray-50 border border-gray-300 rounded-full pl-10 pr-4 py-2.5 text-sm text-gray-700 placeholder:text-gray-400 transition-all duration-150 hover:border-gray-400 focus:outline-none focus:bg-white focus:border-[#2d6fa3] focus:ring-4 focus:ring-[#2d6fa3]/15">
                </div>

                <div class="relative">
                    <select name="availability" x-model="availability"
                            class="pl-4 pr-9 py-2.5 rounded-full border border-gray-300 text-sm font-medium text-gray-600 bg-white appearance-none cursor-pointer transition-all duration-150 hover:border-gray-400 focus:outline-none focus:border-[#2d6fa3] focus:ring-4 focus:ring-[#2d6fa3]/15">
                        <option value="">All Books</option>
                        <option value="available" {{ ($filters['availability'] ?? '') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="unavailable" {{ ($filters['availability'] ?? '') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                    </select>
                    <svg class="w-3.5 h-3.5 text-gray-400 absolute right-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <button type="submit" @click.prevent="applyFilters()"
                        class="px-5 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-full text-sm font-semibold transition-colors">
                    Search
                </button>

                <a href="{{ route('admin.books.index') }}" @click.prevent="resetFilters()"
                   x-show="activeFilters > 0" x-cloak
                   class="px-5 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-500 rounded-full text-sm font-medium transition-colors">
                    Reset
                </a>
            </form>
        </div>

        <div x-ref="results" class="space-y-5" :class="loading ? 'opacity-50' : ''" style="transition: opacity 150ms">
            @include('admin.books._results', ['books' => $books, 'filters' => $filters])
        </div>
    </div>
</div>

@endsection
