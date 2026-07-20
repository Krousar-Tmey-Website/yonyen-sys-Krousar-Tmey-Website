@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-news.css'])
@endpush

@section('title', 'Topics')
@section('page-title', 'Topics Management')
@section('breadcrumb', 'Manage the topic pages News tags link to')

@section('content')

<div class="filter-bar mb-6">
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div class="flex flex-wrap items-center gap-3 flex-1">
            <div class="relative flex-1 min-w-[180px]">
                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" placeholder="Search topics..." id="searchInput" class="form-control pl-9">
            </div>
        </div>
        <a href="{{ route('admin.resource-pages.create') }}" class="btn-primary">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            New Topic
        </a>
    </div>
</div>

<div class="table-container">
    <div class="table-header">
        <div class="flex items-center gap-3">
            <h3>All Topics</h3>
            <span class="count-badge">{{ $resourcePages->count() }} total</span>
        </div>
    </div>

    @if($resourcePages->isEmpty())
    <div class="empty-state">
        <div class="empty-icon">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
        </div>
        <h4 class="empty-title">No topics yet</h4>
        <p class="empty-desc">Topics are the categories News tags link to (e.g. Cambodia, Health and Hygiene).</p>
        <a href="{{ route('admin.resource-pages.create') }}" class="inline-flex items-center gap-2 mt-4 text-[#2d6fa3] font-medium hover:text-[#1a4a7a] transition-colors text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create your first topic
        </a>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="table-custom">
            <thead>
                <tr>
                    <th class="th-width-35">Topic</th>
                    <th class="th-width-15">Slug</th>
                    <th class="th-width-13">Status</th>
                    <th class="th-width-17">Sort Order</th>
                    <th class="th-width-15 th-text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($resourcePages as $page)
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            @if($page->image)
                            <div class="article-thumb">
                                <img src="{{ $page->image_url }}" alt="{{ $page->title }}" loading="lazy">
                            </div>
                            @else
                            <div class="article-thumb-placeholder">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            @endif
                            <div class="min-w-0">
                                <div class="font-medium text-gray-800 truncate max-w-xs">{{ $page->title }}</div>
                                @if($page->description)
                                <div class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">{{ \Illuminate\Support\Str::limit($page->description, 60) }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td><span class="text-xs text-gray-500">{{ $page->slug }}</span></td>
                    <td>
                        @if($page->is_active)
                        <span class="status-badge published"><span class="dot"></span>Active</span>
                        @else
                        <span class="status-badge draft"><span class="dot"></span>Inactive</span>
                        @endif
                    </td>
                    <td><span class="text-xs text-gray-500">{{ $page->sort_order }}</span></td>
                    <td>
                        <div class="flex items-center justify-end gap-1.5">
                            <a href="{{ route('resource-pages.show', $page->slug) }}" target="_blank" rel="noopener"
                               class="action-btn btn-view" title="View on site">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <span class="tooltip">View</span>
                            </a>
                            <a href="{{ route('admin.resource-pages.edit', $page) }}" class="action-btn btn-edit" title="Edit topic">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                <span class="tooltip">Edit</span>
                            </a>
                            <form action="{{ route('admin.resource-pages.destroy', $page) }}" method="POST"
                                  onsubmit="return confirm('⚠️ Delete this topic?\n\nTags pointing to it will fall back to a plain news filter instead.')"
                                  class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-btn btn-delete" title="Delete topic">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    <span class="tooltip">Delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>

<div class="tips-box mt-6">
    <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <div>
        <p class="text-sm font-medium text-blue-800">Quick Tips</p>
        <ul class="text-xs text-blue-700 mt-1 space-y-0.5">
            <li>• Topics power the "Quick Add" tag buttons on News articles — a tag with a matching title links here.</li>
            <li>• <strong>Inactive</strong> topics are hidden from the public site and the tag quick-add list.</li>
            <li>• Deleting a topic doesn't delete news articles — their tags just stop linking to a dedicated page.</li>
        </ul>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const rows = document.querySelectorAll('tbody tr');

    searchInput.addEventListener('input', function() {
        const search = searchInput.value.toLowerCase().trim();
        rows.forEach(row => {
            const title = row.querySelector('td:first-child .font-medium')?.textContent?.toLowerCase() || '';
            row.style.display = (!search || title.includes(search)) ? '' : 'none';
        });
    });
});
</script>

@endsection
