@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-news.css'])
@endpush

@php use Illuminate\Support\Str; @endphp

@section('title', 'Resource Pages')
@section('page-title', 'Resource Pages')
@section('breadcrumb', 'News & Resources → Resource Pages')

@section('content')

{{-- Section Tabs --}}
<div class="section-tabs">
    <a href="{{ route('admin.news.index') }}">News Articles</a>
    <a href="{{ route('admin.resource-pages.index') }}" class="active">Resource Pages</a>
</div>

<div class="filter-bar mb-6">
    <div class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <h3 class="font-bold text-gray-800">All Resource Pages</h3>
            <p class="text-xs text-gray-400 mt-0.5">Standalone content pages shown under News &amp; Resources.</p>
        </div>
        <a href="{{ route('admin.resource-pages.create') }}" class="btn-primary">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            New Resource Page
        </a>
    </div>
</div>

<div class="table-container">
    <div class="table-header">
        <div class="flex items-center gap-3">
            <h3>All Pages</h3>
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
        <h4 class="empty-title">No resource pages yet</h4>
        <p class="empty-desc">Create your first resource page.</p>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="table-custom">
            <thead>
                <tr>
                    <th class="th-width-40">Page</th>
                    <th class="th-width-15">Slug</th>
                    <th class="th-width-13">Status</th>
                    <th class="th-width-13">Order</th>
                    <th class="th-width-19 th-text-right">Actions</th>
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
                                <div class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">{{ Str::limit($page->description, 60) }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="text-gray-400 text-xs">{{ $page->slug }}</td>
                    <td>
                        @if($page->is_active)
                        <span class="status-badge published"><span class="dot"></span>Active</span>
                        @else
                        <span class="status-badge draft"><span class="dot"></span>Hidden</span>
                        @endif
                    </td>
                    <td class="text-gray-500 text-sm">{{ $page->sort_order }}</td>
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
                            <a href="{{ route('admin.resource-pages.edit', $page) }}" class="action-btn btn-edit" title="Edit page">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                <span class="tooltip">Edit</span>
                            </a>
                            <form action="{{ route('admin.resource-pages.destroy', $page) }}" method="POST"
                                  onsubmit="return confirm('⚠️ Permanently delete this resource page?\n\nThis action cannot be undone.')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="action-btn btn-delete" title="Delete page">
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

@endsection
