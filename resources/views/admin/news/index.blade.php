@extends('admin.layouts.app')

@section('title', 'News Articles')
@section('page-title', 'News Management')
@section('breadcrumb', 'Manage all news and updates')

@section('content')

<style>
    .stat-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #f0f2f5;
        padding: 20px 24px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        opacity: 0.8;
    }
    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
        border-color: #dce1e8;
    }
    .stat-card .stat-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .stat-card .stat-number {
        font-size: 26px;
        font-weight: 700;
        letter-spacing: -0.02em;
        line-height: 1.2;
    }
    .stat-card .stat-label {
        font-size: 12px;
        font-weight: 500;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .stat-card .stat-change {
        font-size: 11px;
        font-weight: 600;
        padding: 2px 10px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .stat-total::before { background: #3b82f6; }
    .stat-published::before { background: #10b981; }
    .stat-drafts::before { background: #f59e0b; }
    .stat-categories::before { background: #8b5cf6; }
    .stat-recent::before { background: #ef4444; }

    .filter-bar {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #f0f2f5;
        padding: 16px 20px;
    }
    .filter-bar .form-control {
        border: 1px solid #e8ecf1;
        border-radius: 10px;
        padding: 8px 14px 8px 38px;
        font-size: 13px;
        background: #fafbfc;
        transition: all 0.2s;
        width: 100%;
        min-width: 180px;
    }
    .filter-bar .form-control:focus {
        outline: none;
        border-color: #2d6fa3;
        box-shadow: 0 0 0 3px rgba(45,111,163,0.08);
        background: #ffffff;
    }
    .filter-bar .form-select {
        border: 1px solid #e8ecf1;
        border-radius: 10px;
        padding: 8px 36px 8px 14px;
        font-size: 13px;
        background: #fafbfc;
        transition: all 0.2s;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        cursor: pointer;
        min-width: 140px;
    }
    .filter-bar .form-select:focus {
        outline: none;
        border-color: #2d6fa3;
        box-shadow: 0 0 0 3px rgba(45,111,163,0.08);
        background-color: #ffffff;
    }

    .table-container {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #f0f2f5;
        overflow: hidden;
    }
    .table-container .table-header {
        background: #fafbfc;
        border-bottom: 1px solid #f0f2f5;
        padding: 14px 24px;
    }
    .table-container .table-header h3 {
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
        margin: 0;
    }
    .table-container .table-header .count-badge {
        background: #eef2f6;
        padding: 2px 12px;
        border-radius: 20px;
        font-size: 12px;
        color: #475569;
        font-weight: 500;
    }

    .table-custom {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    .table-custom thead th {
        padding: 12px 20px;
        text-align: left;
        font-size: 11px;
        font-weight: 600;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        background: #f8fafc;
        border-bottom: 1px solid #f0f2f5;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    .table-custom tbody tr {
        transition: background 0.15s ease;
        border-bottom: 1px solid #f8f9fa;
    }
    .table-custom tbody tr:last-child {
        border-bottom: none;
    }
    .table-custom tbody tr:hover {
        background: #fafbfc;
    }
    .table-custom tbody td {
        padding: 14px 20px;
        vertical-align: middle;
        font-size: 13px;
        color: #1e293b;
    }

    .article-thumb {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        overflow: hidden;
        flex-shrink: 0;
        background: #f1f4f9;
        border: 1px solid #f0f2f5;
    }
    .article-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .article-thumb-placeholder {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        flex-shrink: 0;
        background: linear-gradient(135deg, #f1f4f9 0%, #e8ecf1 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #f0f2f5;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
        letter-spacing: 0.01em;
    }
    .status-badge .dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        display: inline-block;
    }
    .status-badge.published {
        background: #ecfdf5;
        color: #065f46;
    }
    .status-badge.published .dot { background: #10b981; }
    .status-badge.draft {
        background: #fffbeb;
        color: #92400e;
    }
    .status-badge.draft .dot { background: #f59e0b; }

    .category-tag {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 12px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 500;
        background: #f1f4f9;
        color: #475569;
    }
    .category-tag .dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        display: inline-block;
        background: #94a3b8;
    }

    .action-btn {
        padding: 6px 10px;
        border-radius: 8px;
        border: none;
        background: transparent;
        color: #94a3b8;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
    }
    .action-btn:hover {
        background: #f1f4f9;
        color: #475569;
    }
    .action-btn.edit:hover {
        background: #eff6ff;
        color: #2563eb;
    }
    .action-btn.view:hover {
        background: #ecfdf5;
        color: #059669;
    }
    .action-btn.delete:hover {
        background: #fef2f2;
        color: #ef4444;
    }

    .pagination-custom {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .pagination-custom .page-link {
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        color: #64748b;
        text-decoration: none;
        transition: all 0.2s;
        border: 1px solid transparent;
        min-width: 36px;
        text-align: center;
    }
    .pagination-custom .page-link:hover {
        background: #f1f4f9;
        color: #1e293b;
    }
    .pagination-custom .page-link.active {
        background: #2d6fa3;
        color: #ffffff;
        border-color: #2d6fa3;
    }
    .pagination-custom .page-link.disabled {
        opacity: 0.4;
        pointer-events: none;
    }

    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }
    .empty-state .empty-icon {
        width: 72px;
        height: 72px;
        border-radius: 20px;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        border: 1px solid #f0f2f5;
    }
    .empty-state .empty-title {
        font-size: 18px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 4px;
    }
    .empty-state .empty-desc {
        font-size: 14px;
        color: #94a3b8;
    }

    .tips-box {
        background: linear-gradient(135deg, #f0f7ff 0%, #e8f0fe 100%);
        border-radius: 16px;
        border: 1px solid #dbeafe;
        padding: 16px 20px;
    }
    .tips-box .tips-icon {
        color: #3b82f6;
        flex-shrink: 0;
        margin-top: 2px;
    }

    /* Responsive tweaks */
    @media (max-width: 768px) {
        .stat-card {
            padding: 16px 18px;
        }
        .stat-card .stat-number {
            font-size: 20px;
        }
        .filter-bar {
            flex-direction: column;
            align-items: stretch !important;
            gap: 12px;
        }
        .filter-bar .flex-wrap {
            flex-direction: column;
            gap: 10px;
        }
        .filter-bar .form-control,
        .filter-bar .form-select {
            min-width: 100%;
        }
        .table-custom tbody td,
        .table-custom thead th {
            padding: 10px 14px;
            font-size: 12px;
        }
        .article-thumb,
        .article-thumb-placeholder {
            width: 40px;
            height: 40px;
        }
        .status-badge {
            font-size: 11px;
            padding: 3px 10px;
        }
        .action-btn {
            padding: 4px 8px;
        }
        .action-btn span {
            display: none;
        }
    }
</style>

{{-- Stats Overview Cards --}}
@php
    $total = $articles->total();
    $published = $articles->where('is_published', true)->count();
    $drafts = $articles->where('is_published', false)->count();
    $categories = $articles->pluck('category')->unique()->count();
    $recentCount = $articles->where('is_published', true)
        ->where('published_at', '>=', now()->subDays(7))
        ->count();
@endphp

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-6">
    {{-- Total --}}
    <div class="stat-card stat-total">
        <div class="flex items-center justify-between">
            <div>
                <div class="stat-number text-slate-800">{{ $total }}</div>
                <div class="stat-label mt-0.5">Total Articles</div>
            </div>
            <div class="stat-icon bg-blue-50 text-blue-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
        </div>
        <div class="mt-2 flex items-center gap-2">
            <span class="stat-change bg-blue-50 text-blue-600">All articles</span>
        </div>
    </div>

    {{-- Published --}}
    <div class="stat-card stat-published">
        <div class="flex items-center justify-between">
            <div>
                <div class="stat-number text-emerald-600">{{ $published }}</div>
                <div class="stat-label mt-0.5">Published</div>
            </div>
            <div class="stat-icon bg-emerald-50 text-emerald-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="mt-2 flex items-center gap-2">
            <span class="stat-change bg-emerald-50 text-emerald-600">● Live</span>
        </div>
    </div>

    {{-- Drafts --}}
    <div class="stat-card stat-drafts">
        <div class="flex items-center justify-between">
            <div>
                <div class="stat-number text-amber-600">{{ $drafts }}</div>
                <div class="stat-label mt-0.5">Drafts</div>
            </div>
            <div class="stat-icon bg-amber-50 text-amber-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
        </div>
        <div class="mt-2 flex items-center gap-2">
            <span class="stat-change bg-amber-50 text-amber-600">● In progress</span>
        </div>
    </div>

    {{-- Categories --}}
    <div class="stat-card stat-categories">
        <div class="flex items-center justify-between">
            <div>
                <div class="stat-number text-purple-600">{{ $categories }}</div>
                <div class="stat-label mt-0.5">Categories</div>
            </div>
            <div class="stat-icon bg-purple-50 text-purple-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
        </div>
        <div class="mt-2 flex items-center gap-2">
            <span class="stat-change bg-purple-50 text-purple-600">{{ $categories }} types</span>
        </div>
    </div>

    {{-- Recent --}}
    <div class="stat-card stat-recent">
        <div class="flex items-center justify-between">
            <div>
                <div class="stat-number text-rose-600">{{ $recentCount }}</div>
                <div class="stat-label mt-0.5">Recent</div>
            </div>
            <div class="stat-icon bg-rose-50 text-rose-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="mt-2 flex items-center gap-2">
            <span class="stat-change bg-rose-50 text-rose-600">Last 7 days</span>
        </div>
    </div>
</div>

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
            <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-colors" onclick="resetFilters()">
                Reset
            </button>
        </div>
        <a href="{{ route('admin.news.create') }}" 
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2d6fa3] text-white rounded-lg text-sm font-medium hover:bg-[#1d4e7a] transition-all shadow-sm hover:shadow-md whitespace-nowrap flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            New Article
        </a>
    </div>
</div>

{{-- Table --}}
<div class="table-container">
    <div class="table-header flex items-center justify-between">
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
            <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
            </svg>
        </div>
        <h4 class="empty-title">No articles yet</h4>
        <p class="empty-desc">Get started by creating your first news article.</p>
        <a href="{{ route('admin.news.create') }}" class="inline-flex items-center gap-2 mt-4 text-[#2d6fa3] font-medium hover:text-[#1d4e7a] transition-colors text-sm">
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
                    <th style="width: 40%;">Article</th>
                    <th style="width: 15%;">Category</th>
                    <th style="width: 13%;">Status</th>
                    <th style="width: 17%;">Published</th>
                    <th style="width: 15%; text-align: right;">Actions</th>
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
                                <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            {{ $article->category_name }}
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
                        <div class="flex items-center justify-end gap-0.5">
                            <a href="{{ route('admin.news.edit', $article) }}" 
                               class="action-btn edit" 
                               title="Edit article">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                <span class="sr-only">Edit</span>
                            </a>

                            @if(Route::has('news.show'))
                            <a href="{{ route('news.show', $article->slug) }}" target="_blank" rel="noopener"
                               class="action-btn view" 
                               title="View on site">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                <span class="sr-only">View</span>
                            </a>
                            @endif

                            <form action="{{ route('admin.news.destroy', $article) }}" method="POST"
                                  onsubmit="return confirm('⚠️ Permanently delete this article?\n\nThis action cannot be undone.')"
                                  class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="action-btn delete"
                                        title="Delete article">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    <span class="sr-only">Delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Table Footer --}}
    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/40 flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="text-sm text-gray-500">
            Showing <span class="font-medium text-gray-700">{{ $articles->firstItem() ?? 0 }}</span> to 
            <span class="font-medium text-gray-700">{{ $articles->lastItem() ?? 0 }}</span> of 
            <span class="font-medium text-gray-700">{{ $articles->total() }}</span> articles
        </div>
        <div>
            {{ $articles->links() }}
        </div>
    </div>
    @endif
</div>

{{-- Quick Tips --}}
<div class="tips-box mt-6">
    <div class="flex items-start gap-3">
        <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <div>
            <p class="text-sm font-medium text-blue-800">Quick Tips</p>
            <ul class="text-xs text-blue-700 mt-1 space-y-0.5">
                <li>• <strong>Published</strong> articles are visible on the public news page.</li>
                <li>• <strong>Drafts</strong> are only visible to admins and editors.</li>
                @if(Route::has('news.show'))
                <li>• Click the <strong>View</strong> icon to preview the article on the live site.</li>
                @endif
                <li>• Use the search and filters to quickly find articles.</li>
            </ul>
        </div>
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
    // Trigger filter
    document.getElementById('searchInput').dispatchEvent(new Event('input'));
}
</script>

@endsection