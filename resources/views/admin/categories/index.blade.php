@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css'])
@endpush

@section('title', 'Categories')
@section('page-title', 'Categories')
@section('breadcrumb', 'Manage news categories')

@section('content')

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
                    <th class="th-width-30">Name</th>
                    <th class="th-width-50">Description</th>
                    <th class="th-width-20 th-text-right">Actions</th>
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
<<<<<<< HEAD
                        <div class="flex items-center justify-end gap-1">
                            <a href="{{ route('admin.categories.show', ['category' => $category->CategoryID]) }}" 
                               class="action-btn view" 
                               title="View category">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                            </a>
=======
                        <div class="flex items-center justify-end gap-1.5">
                            {{-- Edit Button --}}
>>>>>>> 01ced46837208653412f3897238fda41f0865cf3
                            <a href="{{ route('admin.categories.edit', ['category' => $category->CategoryID]) }}" 
                               class="action-btn edit" 
                               title="Edit category">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>

                            {{-- Delete Button --}}
                            <form action="{{ route('admin.categories.destroy', ['category' => $category->CategoryID]) }}" method="POST"
                                  onsubmit="return confirm('⚠️ Permanently delete this category?\n\nThis action cannot be undone.')"
                                  class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" 
                                        class="action-btn delete"
                                        title="Delete category">
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