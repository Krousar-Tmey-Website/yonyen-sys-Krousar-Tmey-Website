@extends('admin.layouts.app')

@section('title', 'Media Gallery')
@section('page-title', 'Media Gallery')
@section('breadcrumb', 'Manage media items for the public Media page')

@section('content')

<div class="space-y-6">
    {{-- Media Items List --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
        {{-- Toolbar --}}
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center gap-2">
                <h3 class="font-bold text-gray-800">All Media Items</h3>
                @if($mediaItems->total() > 0)
                <span class="px-2.5 py-1 bg-[#2d6fa3]/10 text-[#2d6fa3] rounded-full text-xs font-semibold">
                    {{ $mediaItems->total() }}
                </span>
                @endif
            </div>

            <a href="{{ route('admin.media.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-full text-sm font-semibold transition-colors shadow-sm hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                New Media Item
            </a>
        </div>

        {{-- Empty state --}}
        @if($mediaItems->isEmpty())
        <div class="py-16 text-center text-gray-400">
            <div class="flex justify-center mb-4">
                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-500">No media items yet</p>
            <p class="text-xs mt-1">Click <strong>New Media Item</strong> to create your first item.</p>
        </div>
        @else
        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-400 text-xs border-b border-gray-50">
                        <th class="text-left font-medium px-6 py-3">Media Item</th>
                        <th class="text-left font-medium px-6 py-3">Category</th>
                        <th class="text-left font-medium px-6 py-3">Status</th>
                        <th class="text-left font-medium px-6 py-3">Published</th>
                        <th class="text-right font-medium px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mediaItems as $item)
                    <tr class="border-t border-gray-50 hover:bg-gray-50/60 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($item->image)
                                <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                                     class="w-10 h-10 rounded-lg object-cover border border-gray-100 bg-white flex-shrink-0">
                                @else
                                <div class="w-10 h-10 rounded-lg bg-gray-100 border border-gray-100 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-800 truncate max-w-xs">{{ $item->title }}</p>
                                    @if($item->source)
                                    <p class="text-gray-400 text-xs mt-0.5 truncate max-w-xs">{{ $item->source }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($item->category)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-[#2d6fa3]/5 text-[#2d6fa3] rounded-full text-xs font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#2d6fa3]"></span>
                                {{ $item->category }}
                            </span>
                            @else
                            <span class="text-gray-300 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($item->is_published)
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-50 text-green-700 rounded-full text-xs font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                Published
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-100 text-gray-500 rounded-full text-xs font-medium">
                                <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span>
                                Draft
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($item->published_at)
                            <div class="text-xs">
                                <span class="text-gray-700 font-medium">{{ $item->published_at->format('d M Y') }}</span>
                                <span class="text-gray-400 ml-1">{{ $item->published_at->format('h:i A') }}</span>
                            </div>
                            @else
                            <span class="text-gray-300 text-xs">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.media.edit', $item) }}" title="Edit"
                                   class="w-8 h-8 rounded-full bg-[#2d6fa3]/10 text-[#2d6fa3] hover:bg-[#2d6fa3]/20 flex items-center justify-center transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                <form action="{{ route('admin.media.destroy', $item) }}" method="POST"
                                      onsubmit="return confirm('⚠️ Permanently delete this media item?\n\nThis action cannot be undone.')">
                                    @csrf @method('DELETE')
                                    <button type="submit" title="Delete"
                                            class="w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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

        {{-- Pagination --}}
        <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between flex-wrap gap-4">
            <p class="text-xs text-gray-400">
                Showing <strong>{{ $mediaItems->firstItem() ?? 0 }}</strong> to
                <strong>{{ $mediaItems->lastItem() ?? 0 }}</strong> of
                <strong>{{ $mediaItems->total() }}</strong> items
            </p>
            <div class="flex items-center gap-1">
                {{ $mediaItems->links() }}
            </div>
        </div>
        @endif
    </div>

    {{-- Quick Tips --}}
    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 flex gap-3">
        <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div>
            <p class="text-sm font-medium text-blue-800">Quick Tips</p>
            <ul class="text-xs text-blue-700 mt-1 space-y-0.5">
                <li>• The first <strong>published</strong> media item (by sort order + date) appears as the featured item on the Media page.</li>
                <li>• <strong>Published</strong> items are visible on the public <a href="{{ route('resources') }}" target="_blank" class="underline">Resources page</a>.</li>
                <li>• Use the <strong>Source</strong> field for press sources like "The Phnom Penh Post"</li>
                <li>• The <strong>External Link</strong> is used for the "Read the article" button on featured items.</li>
            </ul>
        </div>
    </div>
</div>

@endsection
