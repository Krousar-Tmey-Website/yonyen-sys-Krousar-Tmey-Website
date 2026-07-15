@extends('admin.layouts.app')

@section('title', 'Media Gallery')
@section('page-title', 'Media Gallery')
@section('breadcrumb', 'Manage media items for the public Media page')

@section('content')

{{-- Toolbar --}}
<div class="flex flex-wrap items-center justify-between gap-3 mb-6">
    <div>
        <p class="text-sm text-gray-500">Media items appear on the <a href="{{ route('media') }}" target="_blank" class="text-[#2d6fa3] hover:underline font-medium">public Media page</a>.</p>
    </div>
    <a href="{{ route('admin.media.create') }}" class="btn-primary">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
        New Media Item
    </a>
</div>

{{-- Table --}}
<div class="table-container">
    <div class="table-header">
        <div class="flex items-center gap-3">
            <h3>All Media Items</h3>
            <span class="count-badge">{{ $mediaItems->total() }} total</span>
        </div>
    </div>

    @if($mediaItems->isEmpty())
    <div class="empty-state">
        <div class="empty-icon">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
        </div>
        <h4 class="empty-title">No media items yet</h4>
        <p class="empty-desc">Add your first media item to feature on the public Media page.</p>
        <a href="{{ route('admin.media.create') }}" class="inline-flex items-center gap-2 mt-4 text-[#2d6fa3] font-medium hover:text-[#1a4a7a] transition-colors text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Create your first media item
        </a>
    </div>
    @else
    <div class="overflow-x-auto">
        <table class="table-custom">
            <thead>
                <tr>
                    <th class="w-[40%]">Media Item</th>
                    <th class="w-[15%]">Category</th>
                    <th class="w-[12%]">Status</th>
                    <th class="w-[18%]">Published</th>
                    <th class="w-[15%] text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mediaItems as $item)
                <tr>
                    <td>
                        <div class="flex items-center gap-3">
                            @if($item->image)
                            <div class="article-thumb">
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="lazy">
                            </div>
                            @else
                            <div class="article-thumb-placeholder">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            @endif
                            <div class="min-w-0">
                                <div class="font-medium text-gray-800 hover:text-[#2d6fa3] transition-colors truncate max-w-xs">
                                    {{ $item->title }}
                                </div>
                                @if($item->source)
                                <div class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">{{ $item->source }}</div>
                                @endif
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($item->category)
                        <span class="category-tag">
                            <span class="dot"></span>
                            {{ $item->category }}
                        </span>
                        @else
                        <span class="text-gray-400 text-xs">—</span>
                        @endif
                    </td>
                    <td>
                        @if($item->is_published)
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
                        @if($item->published_at)
                        <div class="text-xs">
                            <div class="text-gray-700 font-medium">{{ $item->published_at->format('d M Y') }}</div>
                            <div class="text-gray-400 text-[10px]">{{ $item->published_at->format('h:i A') }}</div>
                        </div>
                        @else
                        <span class="text-gray-400 text-xs">—</span>
                        @endif
                    </td>
                    <td>
                        <div class="flex items-center justify-end gap-1.5">
                            <a href="{{ route('admin.media.edit', $item) }}"
                               class="action-btn btn-edit"
                               title="Edit item">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                <span class="tooltip">Edit</span>
                            </a>

                            <form action="{{ route('admin.media.destroy', $item) }}" method="POST"
                                  onsubmit="return confirm('⚠️ Permanently delete this media item?\n\nThis action cannot be undone.')"
                                  class="inline">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="action-btn btn-delete"
                                        title="Delete item">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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

    <div class="pagination-wrapper">
        <div class="pagination-info">
            Showing <strong>{{ $mediaItems->firstItem() ?? 0 }}</strong> to
            <strong>{{ $mediaItems->lastItem() ?? 0 }}</strong> of
            <strong>{{ $mediaItems->total() }}</strong> items
        </div>
        <div class="pagination-links">
            {{ $mediaItems->links() }}
        </div>
    </div>
    @endif
</div>

<div class="tips-box mt-6">
    <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <div>
        <p class="text-sm font-medium text-blue-800">Quick Tips</p>
        <ul class="text-xs text-blue-700 mt-1 space-y-0.5">
            <li>• The first <strong>published</strong> media item (by sort order + date) appears as the featured item on the Media page.</li>
            <li>• <strong>Published</strong> items are visible on the public <a href="{{ route('media') }}" target="_blank" class="underline">Media page</a>.</li>
            <li>• Use the <strong>Source</strong> field for press sources like "The Phnom Penh Post"</li>
            <li>• The <strong>External Link</strong> is used for the "Read the article" button on featured items.</li>
        </ul>
    </div>
</div>

@endsection
