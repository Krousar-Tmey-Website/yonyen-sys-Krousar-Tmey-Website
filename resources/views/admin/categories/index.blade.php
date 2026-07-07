@extends('admin.layouts.app')

@section('title', 'Categories')
@section('page-title', 'Categories')
@section('breadcrumb', 'Manage news categories')

@section('content')

<style>
    /* ============================================
       STATISTICS CARDS
    ============================================ */
    .stat-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #eef2f6;
        padding: 20px 24px;
        transition: all 0.2s ease;
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
    }
    .stat-card:hover {
        border-color: #dce1e8;
        box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        transform: translateY(-2px);
    }
    .stat-card .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .stat-card .stat-number {
        font-size: 28px;
        font-weight: 700;
        color: #0f172a;
        line-height: 1.2;
    }
    .stat-card .stat-label {
        font-size: 13px;
        font-weight: 500;
        color: #64748b;
        margin-top: 2px;
    }
    .stat-card.total::before { background: #3b82f6; }
    .stat-card.articles::before { background: #10b981; }

    /* ============================================
       TABLE CONTAINER
    ============================================ */
    .table-container {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #eef2f6;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.02);
    }
    .table-container .table-header {
        padding: 16px 24px;
        background: #fafbfc;
        border-bottom: 1px solid #eef2f6;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .table-container .table-header h3 {
        font-size: 15px;
        font-weight: 600;
        color: #0f172a;
        margin: 0;
    }
    .table-container .table-header .count-badge {
        font-size: 12px;
        font-weight: 500;
        color: #64748b;
        background: #f1f4f9;
        padding: 2px 12px;
        border-radius: 20px;
    }

    /* ============================================
       TABLE
    ============================================ */
    .table-custom {
        width: 100%;
        border-collapse: collapse;
    }
    .table-custom thead th {
        padding: 12px 20px;
        text-align: left;
        font-size: 11px;
        font-weight: 600;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        background: #f8fafc;
        border-bottom: 1px solid #eef2f6;
        position: sticky;
        top: 0;
        z-index: 10;
    }
    .table-custom tbody tr {
        border-bottom: 1px solid #f1f4f9;
        transition: background 0.15s ease;
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
        font-size: 14px;
        color: #1e293b;
    }

    /* ============================================
       ACTION BUTTONS
    ============================================ */
    .action-btn {
        padding: 6px 10px;
        border-radius: 8px;
        border: none;
        background: transparent;
        color: #94a3b8;
        cursor: pointer;
        transition: all 0.2s ease;
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
    .action-btn.delete:hover {
        background: #fef2f2;
        color: #ef4444;
    }

    /* ============================================
       EMPTY STATE
    ============================================ */
    .empty-state {
        padding: 60px 20px;
        text-align: center;
    }
    .empty-state .empty-icon {
        width: 72px;
        height: 72px;
        border-radius: 16px;
        background: #f8fafc;
        border: 1px solid #eef2f6;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }
    .empty-state .empty-icon svg {
        color: #cbd5e1;
    }
    .empty-state .empty-title {
        font-size: 18px;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 4px;
    }
    .empty-state .empty-desc {
        font-size: 14px;
        color: #94a3b8;
    }

    /* ============================================
       PAGINATION
    ============================================ */
    .pagination-wrapper {
        padding: 14px 24px;
        border-top: 1px solid #eef2f6;
        background: #fafbfc;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .pagination-wrapper .pagination-info {
        font-size: 13px;
        color: #64748b;
    }
    .pagination-wrapper .pagination-info strong {
        color: #0f172a;
    }

    /* ============================================
       BUTTONS
    ============================================ */
    .btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 22px;
        background: #2d6fa3;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .btn-primary:hover {
        background: #1a4a7a;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(45,111,163,0.25);
    }
    .btn-primary:active {
        transform: translateY(0);
    }
    .btn-primary svg {
        width: 18px;
        height: 18px;
    }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 768px) {
        .table-container .table-header {
            flex-direction: column;
            align-items: stretch;
        }
        .table-container .table-header .flex {
            justify-content: space-between;
        }
        .stat-card .stat-number {
            font-size: 22px;
        }
        .table-custom thead th,
        .table-custom tbody td {
            padding: 10px 14px;
            font-size: 13px;
        }
        .pagination-wrapper {
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 8px;
        }
        .pagination-wrapper .pagination-info {
            order: 2;
        }
        .pagination-wrapper .pagination-links {
            order: 1;
        }
    }

    @media (max-width: 480px) {
        .stat-card {
            padding: 16px 18px;
        }
        .stat-card .stat-number {
            font-size: 20px;
        }
        .stat-card .stat-icon {
            width: 36px;
            height: 36px;
        }
        .stat-card .stat-icon svg {
            width: 18px;
            height: 18px;
        }
        .table-custom thead th,
        .table-custom tbody td {
            padding: 8px 12px;
            font-size: 12px;
        }
        .table-custom tbody td:last-child {
            min-width: 80px;
        }
        .action-btn {
            padding: 4px 8px;
        }
        .action-btn svg {
            width: 16px;
            height: 16px;
        }
        .btn-primary {
            padding: 8px 16px;
            font-size: 13px;
            justify-content: center;
            width: 100%;
        }
        .btn-primary svg {
            width: 16px;
            height: 16px;
        }
        .empty-state {
            padding: 40px 16px;
        }
        .empty-state .empty-icon {
            width: 56px;
            height: 56px;
        }
        .empty-state .empty-title {
            font-size: 16px;
        }
        .empty-state .empty-desc {
            font-size: 13px;
        }
    }
</style>

{{-- Statistics --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div class="stat-card total">
        <div class="flex items-center justify-between">
            <div>
                <div class="stat-number">{{ $categories->total() }}</div>
                <div class="stat-label">Total Categories</div>
            </div>
            <div class="stat-icon bg-blue-50 text-blue-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="stat-card articles">
        <div class="flex items-center justify-between">
            <div>
                <div class="stat-number">{{ $categories->sum(fn($c) => $c->news_count ?? 0) }}</div>
                <div class="stat-label">Total Articles</div>
            </div>
            <div class="stat-icon bg-emerald-50 text-emerald-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

{{-- Table --}}
<div class="table-container">
    <div class="table-header">
        <div class="flex items-center gap-3">
            <h3>All Categories</h3>
            <span class="count-badge">{{ $categories->total() }} total</span>
        </div>
        <a href="{{ route('admin.categories.create') }}" class="btn-primary">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            New Category
        </a>
    </div>

    @if($categories->isEmpty())
    <div class="empty-state">
        <div class="empty-icon">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
            </svg>
        </div>
        <h4 class="empty-title">No categories yet</h4>
        <p class="empty-desc">Get started by creating your first category.</p>
        <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center gap-2 mt-4 text-[#2d6fa3] font-medium hover:text-[#1d4e7a] transition-colors text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Create your first category
        </a>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width: 30%;">Name</th>
                    <th style="width: 50%;">Description</th>
                    <th style="width: 20%; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>
                        <div class="font-medium text-gray-800">{{ $category->CategoryName }}</div>
                    </td>
                    <td>
                        <span class="text-gray-500 text-sm">{{ $category->Description ?? '-' }}</span>
                    </td>
                    <td>
                        <div class="flex items-center justify-end gap-1">
                            <a href="{{ route('admin.categories.show', ['category' => $category->CategoryID]) }}" 
                               class="action-btn view" 
                               title="View category">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
                            <a href="{{ route('admin.categories.edit', ['category' => $category->CategoryID]) }}" 
                               class="action-btn edit" 
                               title="Edit category">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>

                            <form action="{{ route('admin.categories.destroy', ['category' => $category->CategoryID]) }}" method="POST"
                                  onsubmit="return confirm('⚠️ Permanently delete this category?\n\nThis action cannot be undone.')"
                                  class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="action-btn delete"
                                        title="Delete category">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
            Showing <strong>{{ $categories->firstItem() ?? 0 }}</strong> to 
            <strong>{{ $categories->lastItem() ?? 0 }}</strong> of 
            <strong>{{ $categories->total() }}</strong> categories
        </div>
        <div class="pagination-links">
            {{ $categories->links() }}
        </div>
    </div>
    @endif
</div>

@endsection