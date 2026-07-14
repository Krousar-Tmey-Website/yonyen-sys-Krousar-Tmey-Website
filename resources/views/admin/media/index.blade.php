@extends('admin.layouts.app')

@push('styles')
<style>
    .media-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
    }
    .media-grid .media-card {
        transition: all 0.2s ease;
    }
    .media-grid .media-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    }
    .media-card .thumbnail-wrap {
        position: relative;
        aspect-ratio: 4/3;
        overflow: hidden;
        background: #f3f4f6;
    }
    .media-card .thumbnail-wrap img,
    .media-card .thumbnail-wrap video {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
    .media-card:hover .thumbnail-wrap img,
    .media-card:hover .thumbnail-wrap video {
        transform: scale(1.05);
    }
    .media-card .type-badge {
        position: absolute;
        top: 8px;
        left: 8px;
        background: rgba(0,0,0,0.65);
        color: white;
        font-size: 10px;
        padding: 2px 8px;
        border-radius: 6px;
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        gap: 4px;
        font-weight: 500;
        letter-spacing: 0.02em;
    }
    .media-card .active-badge {
        position: absolute;
        top: 8px;
        right: 8px;
        font-size: 10px;
        padding: 2px 8px;
        border-radius: 6px;
        font-weight: 600;
    }
    .media-card .cat-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
    }
    .media-card .cat-tag {
        font-size: 10px;
        background: #eff6ff;
        color: #1e40af;
        padding: 1px 8px;
        border-radius: 10px;
        font-weight: 500;
        white-space: nowrap;
        max-width: 100px;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .filter-chip {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        padding: 4px 10px;
        border-radius: 20px;
        background: #dbeafe;
        color: #1e40af;
        font-weight: 500;
    }
    .filter-chip .remove-filter {
        cursor: pointer;
        opacity: 0.6;
        transition: opacity 0.15s;
    }
    .filter-chip .remove-filter:hover {
        opacity: 1;
    }
    .upload-zone {
        border: 2px dashed #d1d5db;
        border-radius: 12px;
        padding: 2.5rem 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s ease;
        background: #f9fafb;
    }
    .upload-zone:hover {
        border-color: #2d6fa3;
        background: #eff6ff;
    }
    .upload-zone.dragover {
        border-color: #2d6fa3;
        background: #dbeafe;
        transform: scale(1.01);
    }
    .progress-bar-wrap {
        width: 100%;
        height: 6px;
        background: #e5e7eb;
        border-radius: 3px;
        overflow: hidden;
        margin-top: 12px;
    }
    .progress-bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #2d6fa3, #1d4e7a);
        border-radius: 3px;
        transition: width 0.3s ease;
        width: 0%;
    }
    .pagination-info {
        font-size: 13px;
        color: #6b7280;
    }
    .view-toggle-btn {
        padding: 6px 10px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        background: white;
        color: #6b7280;
        cursor: pointer;
        transition: all 0.15s;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 12px;
    }
    .view-toggle-btn.active {
        background: #2d6fa3;
        color: white;
        border-color: #2d6fa3;
    }
    .view-toggle-btn:not(.active):hover {
        background: #f3f4f6;
    }
    /* List view */
    .media-list-table th {
        font-size: 11px;
        font-weight: 600;
        color: #9ca3af;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        padding: 12px 16px;
        background: #f9fafb;
        border-bottom: 1px solid #f3f4f6;
    }
    .media-list-table td {
        padding: 12px 16px;
        vertical-align: middle;
        font-size: 13px;
        color: #374151;
        border-bottom: 1px solid #f9fafb;
    }
    .media-list-table tr:hover td {
        background: #f9fafb;
    }
</style>
@endpush

@section('title', 'Media Gallery')
@section('page-title', 'Media Gallery')
@section('breadcrumb', 'Upload and manage photos &amp; videos')

@section('content')

<div class="mb-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="text-lg font-bold text-gray-800">All Media</h2>
            <p class="text-xs text-gray-400 mt-0.5">{{ $items->total() }} {{ Str::plural('item', $items->total()) }} total</p>
        </div>
        <a href="{{ route('admin.media.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-medium rounded-xl transition-colors shadow-sm hover:shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Upload Media
        </a>
    </div>
</div>

{{-- Filters --}}
<div class="bg-white rounded-2xl border border-gray-100 mb-6 overflow-hidden" x-data="mediaFilter()" x-init="init()">
    <div class="p-5 space-y-4">
        {{-- Search row --}}
        <div class="flex flex-wrap items-center gap-3">
            <div class="relative flex-1 min-w-[200px]">
                <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" x-model="search" @input.debounce.300ms="applyFilters()"
                       placeholder="Search by title or description..."
                       class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            <select x-model="type" @change="applyFilters()" class="form-control min-w-[130px]">
                <option value="">All types</option>
                <option value="image">Images</option>
                <option value="video">Videos</option>
            </select>

            <select x-model="categoryId" @change="applyFilters()" class="form-control min-w-[160px]">
                <option value="">All categories</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->CategoryID }}">{{ $cat->CategoryName }}</option>
                @endforeach
            </select>

            <input type="date" x-model="dateFrom" @change="applyFilters()"
                   class="form-control min-w-[140px]" placeholder="From date">

            <input type="date" x-model="dateTo" @change="applyFilters()"
                   class="form-control min-w-[140px]" placeholder="To date">

            {{-- View toggle --}}
            <div class="flex items-center gap-1 bg-gray-100 rounded-lg p-0.5">
                <button type="button" @click="viewMode = 'grid'; applyFilters()"
                        :class="viewMode === 'grid' ? 'active' : ''"
                        class="view-toggle-btn border-0 px-2.5 py-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                    </svg>
                </button>
                <button type="button" @click="viewMode = 'list'; applyFilters()"
                        :class="viewMode === 'list' ? 'active' : ''"
                        class="view-toggle-btn border-0 px-2.5 py-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Active filter chips --}}
        <div class="flex flex-wrap items-center gap-2" x-show="activeCount > 0">
            <template x-if="search">
                <span class="filter-chip">
                    Search: "<span x-text="search"></span>"
                    <span class="remove-filter" @click="search = ''; applyFilters()">&times;</span>
                </span>
            </template>
            <template x-if="type">
                <span class="filter-chip">
                    <span x-text="type === 'image' ? 'Images' : 'Videos'"></span>
                    <span class="remove-filter" @click="type = ''; applyFilters()">&times;</span>
                </span>
            </template>
            <template x-if="categoryId">
                <span class="filter-chip">
                    Category: <span x-text="categoryName"></span>
                    <span class="remove-filter" @click="categoryId = ''; applyFilters()">&times;</span>
                </span>
            </template>
            <template x-if="dateFrom">
                <span class="filter-chip">
                    From: <span x-text="dateFrom"></span>
                    <span class="remove-filter" @click="dateFrom = ''; applyFilters()">&times;</span>
                </span>
            </template>
            <template x-if="dateTo">
                <span class="filter-chip">
                    To: <span x-text="dateTo"></span>
                    <span class="remove-filter" @click="dateTo = ''; applyFilters()">&times;</span>
                </span>
            </template>
            <button @click="clearAll()" class="text-xs text-red-500 hover:text-red-700 font-medium ml-1">
                Clear all
            </button>
        </div>
    </div>

    {{-- Results container --}}
    <div x-ref="results" id="media-results">
        @include('admin.media._results')
    </div>

    {{-- Loading indicator --}}
    <div x-show="loading" class="text-center py-8 border-t border-gray-100">
        <svg class="animate-spin h-6 w-6 text-[#2d6fa3] mx-auto" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
        </svg>
    </div>
</div>

{{-- Alpine Component --}}
<script>
// Fix: Use named route for delete form action
const mediaDeleteBaseUrl = '{{ route('admin.media.destroy', 0) }}';

function confirmDelete(id, title) {
    const modal = document.getElementById('deleteModal');
    const nameEl = document.getElementById('deleteItemName');
    const form = document.getElementById('deleteForm');

    nameEl.textContent = `"${title}"?`;
    form.action = mediaDeleteBaseUrl.replace(/\/0$/, '/' + id);
    modal.style.display = 'block';
    modal.__x.$data.show = true;
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    if (modal.__x) {
        modal.__x.$data.show = false;
    }
    modal.style.display = 'none';
}

function mediaFilter() {
    return {
        search: '{{ $search }}',
        type: '{{ $type }}',
        categoryId: '{{ $categoryId }}',
        categoryName: '',
        dateFrom: '{{ $dateFrom }}',
        dateTo: '{{ $dateTo }}',
        viewMode: '{{ $viewMode }}',
        activeCount: {{ $activeFilters }},
        loading: false,

        init() {
            // Get category name for display
            if (this.categoryId) {
                const sel = document.querySelector('select[x-model="categoryId"]');
                if (sel) {
                    const opt = sel.querySelector(`option[value="${this.categoryId}"]`);
                    if (opt) this.categoryName = opt.textContent;
                }
            }
        },

        applyFilters() {
            const params = new URLSearchParams();
            if (this.search) params.set('search', this.search);
            if (this.type) params.set('type', this.type);
            if (this.categoryId) params.set('category_id', this.categoryId);
            if (this.dateFrom) params.set('date_from', this.dateFrom);
            if (this.dateTo) params.set('date_to', this.dateTo);
            if (this.viewMode !== 'grid') params.set('view', this.viewMode);

            this.loading = true;

            fetch(`{{ route('admin.media.index') }}?${params.toString()}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            })
            .then(res => res.json())
            .then(data => {
                this.$refs.results.innerHTML = data.html;
                this.activeCount = data.activeFilters;
                history.replaceState(null, '', `?${params.toString()}`);
            })
            .catch(() => location.reload())
            .finally(() => this.loading = false);
        },

        clearAll() {
            this.search = '';
            this.type = '';
            this.categoryId = '';
            this.categoryName = '';
            this.dateFrom = '';
            this.dateTo = '';
            this.applyFilters();
        }
    };
}
</script>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" class="fixed inset-0 z-50 hidden" x-data="{ show: false }" x-show="show"
     x-transition:enter="transition ease-out duration-200"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     style="display: none;">
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="show = false"></div>
    <div class="relative z-10 flex items-center justify-center min-h-full p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6"
             @click.away="show = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100">
            <div class="text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-red-50 flex items-center justify-center">
                    <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Delete Media</h3>
                <p class="text-sm text-gray-500 mb-1">Are you sure you want to delete</p>
                <p class="text-sm font-semibold text-gray-700 mb-6" id="deleteItemName">"this item"?</p>
                <p class="text-xs text-red-500 mb-6">This action cannot be undone. The file will be permanently removed.</p>
            </div>
            <div class="flex items-center gap-3">
                <button type="button" onclick="closeDeleteModal()"
                        class="flex-1 px-4 py-2.5 border border-gray-200 text-gray-600 text-sm font-medium rounded-xl hover:bg-gray-50 transition-colors">
                    Cancel
                </button>
                <form id="deleteForm" method="POST" action="" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="w-full px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold rounded-xl transition-colors shadow-sm">
                        Yes, Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
