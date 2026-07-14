@if($viewMode === 'list')
{{-- ===== LIST VIEW ===== --}}
<div class="overflow-x-auto">
    <table class="media-list-table w-full">
        <thead>
            <tr>
                <th>Media</th>
                <th>Type</th>
                <th>Categories</th>
                <th>Date</th>
                <th>Status</th>
                <th class="text-right">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-9 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                            @if($item->file_type === 'image')
                            <img src="{{ $item->file_url }}" alt="{{ $item->title }}"
                                 class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center bg-gray-800 text-white">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                            @endif
                        </div>
                        <div class="min-w-0">
                            <span class="font-medium text-gray-800 text-sm block truncate max-w-[200px]">{{ $item->title }}</span>
                            @if($item->description)
                            <span class="text-xs text-gray-400 truncate block max-w-[200px]">{{ Str::limit($item->description, 40) }}</span>
                            @endif
                        </div>
                    </div>
                </td>
                <td>
                    <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full
                        {{ $item->file_type === 'image' ? 'bg-blue-50 text-blue-600' : 'bg-purple-50 text-purple-600' }}">
                        @if($item->file_type === 'image')
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Image
                        @else
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                        Video
                        @endif
                    </span>
                </td>
                <td>
                    <div class="cat-tags">
                        @forelse($item->categories as $cat)
                        <span class="cat-tag">{{ $cat->CategoryName }}</span>
                        @empty
                        <span class="text-xs text-gray-400">—</span>
                        @endforelse
                    </div>
                </td>
                <td class="text-xs text-gray-500 whitespace-nowrap">{{ $item->created_at->format('M d, Y') }}</td>
                <td>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                        {{ $item->is_active ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-500' }}">
                        {{ $item->is_active ? 'Active' : 'Hidden' }}
                    </span>
                </td>
                <td>
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.media.edit', $item) }}" title="Edit"
                           class="action-btn edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        <button type="button" title="Delete"
                                onclick="confirmDelete({{ $item->id }}, '{{ addslashes($item->title) }}')"
                                class="action-btn delete">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-16 text-center">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-sm font-medium text-gray-500">No media found</p>
                    @if($search || $type || $categoryId || $dateFrom || $dateTo)
                    <p class="text-xs text-gray-400 mt-1">Try different search terms or filters.</p>
                    @else
                    <p class="text-xs text-gray-400 mt-1">Upload your first media item to get started.</p>
                    @endif
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@else
{{-- ===== GRID VIEW ===== --}}
<div class="media-grid p-5">
    @forelse($items as $item)
    <div class="media-card bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm">
        <div class="thumbnail-wrap">
            @if($item->file_type === 'image')
            <img src="{{ $item->file_url }}" alt="{{ $item->title }}" loading="lazy">
            @else
            @if($item->thumbnail_url)
            <img src="{{ $item->thumbnail_url }}" alt="{{ $item->title }}" loading="lazy">
            @else
            <div class="w-full h-full flex items-center justify-center bg-gray-800">
                <svg class="w-10 h-10 text-white/70" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z"/>
                </svg>
            </div>
            @endif
            <div class="type-badge">
                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                Video
            </div>
            @endif
            <span class="active-badge {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                {{ $item->is_active ? 'Active' : 'Hidden' }}
            </span>
        </div>
        <div class="p-3.5">
            <h3 class="text-sm font-semibold text-gray-800 truncate" title="{{ $item->title }}">{{ $item->title }}</h3>
            <p class="text-xs text-gray-400 mt-0.5">{{ $item->formatted_size }} &middot; {{ $item->created_at->format('M d, Y') }}</p>
            @if($item->categories->isNotEmpty())
            <div class="cat-tags mt-2">
                @foreach($item->categories as $cat)
                <span class="cat-tag">{{ $cat->CategoryName }}</span>
                @endforeach
            </div>
            @endif
            <div class="flex items-center justify-between mt-3 pt-2.5 border-t border-gray-50">
                <a href="{{ route('admin.media.edit', $item) }}"
                   class="inline-flex items-center gap-1 text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                <button type="button" onclick="confirmDelete({{ $item->id }}, '{{ addslashes($item->title) }}')"
                        class="inline-flex items-center gap-1 text-red-400 hover:text-red-600 text-xs font-medium">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Delete
                </button>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-16">
        <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
        </svg>
        <p class="text-sm font-medium text-gray-500">No media found</p>
        @if($search || $type || $categoryId || $dateFrom || $dateTo)
        <p class="text-xs text-gray-400 mt-1">Try different search terms or filters.</p>
        @else
        <p class="text-xs text-gray-400 mt-1">Upload your first media item to get started.</p>
        @endif
    </div>
    @endforelse
</div>
@endif

{{-- Pagination --}}
@if($items->hasPages())
<div class="px-5 py-4 border-t border-gray-100 flex flex-wrap items-center justify-between gap-4">
    <div class="pagination-info">
        Showing <strong>{{ $items->firstItem() }}</strong> to <strong>{{ $items->lastItem() }}</strong> of <strong>{{ $items->total() }}</strong> {{ Str::plural('item', $items->total()) }}
    </div>
    <div class="flex items-center gap-1">
        {{ $items->onEachSide(2)->links('pagination::simple-tailwind') }}
    </div>
</div>
@endif


