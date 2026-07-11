<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-gray-400 text-xs border-b border-gray-50">
                <th class="text-left font-medium px-6 py-3">Book</th>
                <th class="text-left font-medium px-6 py-3">Price</th>
                <th class="text-left font-medium px-6 py-3">Stock</th>
                <th class="text-left font-medium px-6 py-3">Status</th>
                <th class="text-right font-medium px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
            <tr class="border-t border-gray-50 hover:bg-gray-50/60 transition">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        @if($book->cover_image_url)
                        <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}"
                             class="w-10 h-12 object-cover rounded border border-gray-100 bg-white">
                        @else
                        <div class="w-10 h-12 rounded bg-[#2d6fa3]/10 flex items-center justify-center text-[#2d6fa3] text-xs font-semibold">
                            📖
                        </div>
                        @endif
                        <div class="min-w-0">
                            <span class="font-medium text-gray-800 truncate block">{{ $book->title }}</span>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-600">${{ number_format($book->price, 2) }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $book->stock }}</td>
                <td class="px-6 py-4">
                    @if($book->is_available && $book->stock > 0)
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-600">Available</span>
                    @elseif($book->is_available)
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-600">Out of stock</span>
                    @else
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500">Hidden</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                        <a href="{{ route('admin.books.edit', $book) }}" title="Edit"
                           class="w-8 h-8 rounded-full bg-[#2d6fa3]/10 text-[#2d6fa3] hover:bg-[#2d6fa3]/20 flex items-center justify-center transition">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Delete this book?')">
                            @csrf @method('DELETE')
                            <button type="submit" title="Delete" class="w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-16 text-center">
                    <div class="text-gray-300 text-4xl mb-3">📚</div>
                    @if(($filters['search'] ?? '') !== '' || ($filters['availability'] ?? '') !== '')
                    <p class="text-gray-500 text-sm font-medium">No books found.</p>
                    <p class="text-gray-400 text-xs mt-1">Try a different search term or filter.</p>
                    @else
                    <p class="text-gray-500 text-sm">No books available</p>
                    <p class="text-gray-400 text-xs mt-1">Add your first book using the form</p>
                    @endif
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
