@extends('admin.layouts.app')

@section('title', 'News Articles')
@section('page-title', 'News Management')
@section('breadcrumb', 'Manage all news and updates')

@section('content')

{{-- Filter Bar --}}
<div class="filter-bar mb-6">
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div class="flex flex-wrap items-center gap-3 flex-1">
            <div class="relative flex-1 min-w-[180px]">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" 
                       placeholder="Search articles..." 
                       id="searchInput"
                       class="form-control pl-9">
            </div>
            <select class="form-select" id="categoryFilter">
                <option value="">All Categories</option>
                @foreach($articles->pluck('category')->unique()->sort()->values() as $cat)
                <option value="{{ $cat }}" class="capitalize">{{ str_replace('-', ' ', $cat) }}</option>
                @endforeach
            </select>
            <select class="form-select" id="statusFilter">
                <option value="">All Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
            </select>
            <button class="btn-reset" onclick="resetFilters()">Reset</button>
        </div>
        <a href="{{ route('admin.news.create') }}" class="btn-primary">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            New Article
        </a>
    </div>
</div>

{{-- Table --}}
<div class="table-container">
    <div class="table-header">
        <div class="flex items-center gap-3">
            <h3>All Articles</h3>
            <span class="count-badge">{{ $articles->total() }} total</span>
        </div>
        <div class="text-xs text-gray-400">
            Last updated: {{ now()->format('d M Y, h:i A') }}
        </div>
    </div>

    @if($articles->isEmpty())
    <div class="empty-state">
        <div class="empty-icon">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
        </div>
        <h4 class="empty-title">No articles yet</h4>
        <p class="empty-desc">Get started by creating your first news article.</p>
        <a href="{{ route('admin.news.create') }}" class="inline-flex items-center gap-2 mt-4 text-[#2d6fa3] font-medium hover:text-[#1a4a7a] transition-colors text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create your first article
        </a>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="table-custom">
            <thead>
                <tr>
                    <th class="th-width-40">Article</th>
                    <th class="th-width-15">Category</th>
                    <th class="th-width-13">Status</th>
                    <th class="th-width-17">Published</th>
                    <th class="th-width-15 th-text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                <tr data-category="{{ $article->category }}" data-status="{{ $article->is_published ? 'published' : 'draft' }}">
                    <td>
                        <div class="flex items-center gap-3">
                            @if($article->image)
                            <div class="article-thumb">
                                <img src="{{ $article->image_url }}" alt="{{ $article->title }}" loading="lazy">
                            </div>
                            @else
                            <div class="article-thumb-placeholder">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            @endif
                            <div class="min-w-0">
                                <div class="font-medium text-gray-800 hover:text-[#2d6fa3] transition-colors truncate max-w-xs">
                                    {{ $article->title }}
                                </div>
                                @if($article->excerpt)
                                <div class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">{{ Str::limit($article->excerpt, 60) }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="category-tag">
                            <span class="dot"></span>
                            {{ $article->category_name ?? str_replace('-', ' ', $article->category) }}
                        </span>
                    </td>
                    <td>
                        @if($article->is_published)
                        <span class="status-badge published">
                            <span class="dot"></span>
                            Published
                        </span>
                        @else
                        <span class="status-badge draft">
                            <span class="dot"></span>
                            Draft
                        </span>
                        @endif
                    </td>
                    <td>
                        @if($article->published_at)
                        <div class="text-xs">
                            <div class="text-gray-700 font-medium">{{ $article->published_at->format('d M Y') }}</div>
                            <div class="text-gray-400 text-[10px]">{{ $article->published_at->format('h:i A') }}</div>
                        </div>
                        @else
                        <span class="text-gray-400 text-xs">—</span>
                        @endif
                    </td>
                    <td>
                        <div class="flex items-center justify-end gap-1.5">
                            {{-- Edit Button --}}
                            <a href="{{ route('admin.news.edit', ['news' => $article->id]) }}" 
                               class="action-btn btn-edit" 
                               title="Edit article">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>

                            {{-- Delete Button --}}
                            <form action="{{ route('admin.news.destroy', ['news' => $article->id]) }}" method="POST"
                                  onsubmit="return confirm('⚠️ Permanently delete this article?\n\nThis action cannot be undone.')"
                                  class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="action-btn btn-delete"
                                        title="Delete article">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="pagination-wrapper">
        <div class="pagination-info">
            Showing <strong>{{ $articles->firstItem() ?? 0 }}</strong> to 
            <strong>{{ $articles->lastItem() ?? 0 }}</strong> of 
            <strong>{{ $articles->total() }}</strong> articles
        </div>
        <div class="pagination-links">
            {{ $articles->links() }}
        </div>
    </div>
    @endif
</div>

{{-- Quick Tips --}}
<div class="tips-box mt-6">
    <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <div>
        <p class="text-sm font-medium text-blue-800">Quick Tips</p>
        <ul class="text-xs text-blue-700 mt-1 space-y-0.5">
            <li>• <strong>Published</strong> articles are visible on the public news page.</li>
            <li>• <strong>Drafts</strong> are only visible to admins and editors.</li>
            <li>• Use the search and filters to quickly find articles.</li>
        </ul>
    </div>
</div>

{{-- Filter JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const statusFilter = document.getElementById('statusFilter');
    const rows = document.querySelectorAll('tbody tr');

    function filterTable() {
        const search = searchInput.value.toLowerCase().trim();
        const category = categoryFilter.value;
        const status = statusFilter.value;

        rows.forEach(row => {
            const title = row.querySelector('td:first-child .font-medium')?.textContent?.toLowerCase() || '';
            const excerpt = row.querySelector('td:first-child .text-xs')?.textContent?.toLowerCase() || '';
            const rowCategory = row.dataset.category || '';
            const rowStatus = row.dataset.status || '';

            const matchesSearch = !search || title.includes(search) || excerpt.includes(search);
            const matchesCategory = !category || rowCategory === category;
            const matchesStatus = !status || rowStatus === status;

            row.style.display = (matchesSearch && matchesCategory && matchesStatus) ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterTable);
    categoryFilter.addEventListener('change', filterTable);
    statusFilter.addEventListener('change', filterTable);
});

function resetFilters() {
    document.getElementById('searchInput').value = '';
    document.getElementById('categoryFilter').value = '';
    document.getElementById('statusFilter').value = '';
    document.getElementById('searchInput').dispatchEvent(new Event('input'));
}
</script>

@endsection