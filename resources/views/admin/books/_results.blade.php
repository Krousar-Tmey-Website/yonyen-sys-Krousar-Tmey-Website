<div class="table-container">
    <table class="table-custom">
        <thead>
            <tr>
                <th>Book</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th class="th-text-right">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
            <tr>
                <td>
                    <div class="flex items-center gap-3">
                        @if($book->cover_image_url)
                        <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}"
                             class="w-9 h-11 object-cover rounded border border-[#eef2f6]">
                        @else
                        <div class="w-9 h-11 rounded bg-slate-100 flex items-center justify-center text-base">
                            📖
                        </div>
                        @endif
                        <div class="min-w-0">
                            <span class="font-medium text-slate-800 block truncate">{{ $book->title }}</span>
                        </div>
                    </div>
                </td>
                <td>${{ number_format($book->price, 2) }}</td>
                <td>{{ $book->stock }}</td>
                <td>
                    @if($book->is_available && $book->stock > 0)
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-600">Available</span>
                    @elseif($book->is_available)
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-amber-100 text-amber-600">Out of stock</span>
                    @else
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-slate-100 text-slate-400">Hidden</span>
                    @endif
                </td>
                <td>
                    <div class="flex items-center justify-end gap-1">
                        <a href="{{ route('admin.books.edit', $book) }}" title="Edit" class="action-btn edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" title="Delete" class="action-btn delete">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-16 text-center">
                    <div class="text-4xl text-slate-300 mb-3">📚</div>
                    @if(($filters['search'] ?? '') !== '' || ($filters['availability'] ?? '') !== '')
                    <p class="text-sm text-slate-400 font-medium">No books found.</p>
                    <p class="text-xs text-slate-400 mt-1">Try a different search term or filter.</p>
                    @else
                    <p class="text-sm text-slate-400">No books available</p>
                    <p class="text-xs text-slate-400 mt-1">Add your first book using the form</p>
                    @endif
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>