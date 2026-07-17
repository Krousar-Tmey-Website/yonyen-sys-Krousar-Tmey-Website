<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    @forelse($books as $book)
    <div class="bg-white rounded-2xl border border-gray-100 p-4 hover-lift shadow-sm hover:shadow-md transition-all duration-300 flex gap-4 relative group">
         {{-- Left: Cover Image --}}
         <div class="w-20 h-28 bg-slate-50 rounded-xl overflow-hidden flex-shrink-0 border border-gray-100 relative">
              @if($book->cover_image_url)
              <img src="{{ $book->cover_image_url }}" class="w-full h-full object-cover" alt="{{ $book->title }}">
              @else
              <div class="w-full h-full flex items-center justify-center bg-slate-50 text-3xl">
                   📖
              </div>
              @endif
         </div>

         {{-- Right: Content --}}
         <div class="flex-1 flex flex-col justify-between min-w-0 pr-6">
              <div>
                   {{-- Status Badges --}}
                   <div class="flex items-center gap-2 mb-1.5 flex-wrap">
                       @if($book->is_available && $book->stock > 0)
                       <span class="text-[9px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700">AVAILABLE</span>
                       @elseif($book->is_available)
                       <span class="text-[9px] font-bold px-2 py-0.5 rounded-full bg-amber-50 text-amber-700">OUT OF STOCK</span>
                       @else
                       <span class="text-[9px] font-bold px-2 py-0.5 rounded-full bg-gray-100 text-gray-500">HIDDEN</span>
                       @endif
                   </div>

                   <h4 class="font-bold text-gray-800 text-sm truncate group-hover:text-[#2d6fa3] transition-colors" title="{{ $book->title }}">{{ $book->title }}</h4>
                   @if($book->description)
                   <p class="text-xs text-gray-400 line-clamp-2 mt-1">{{ $book->description }}</p>
                   @endif
              </div>

              <div class="flex items-baseline justify-between mt-2 flex-wrap gap-2">
                   <span class="text-lg font-black text-gray-800">${{ number_format($book->price, 2) }}</span>
                   <span class="text-xs text-gray-400">Stock: <strong class="text-gray-700">{{ $book->stock }}</strong></span>
              </div>
         </div>

         {{-- Actions --}}
         <div class="absolute top-4 right-4 flex flex-col gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <a href="{{ route('admin.books.edit', $book) }}" title="Edit" class="w-8 h-8 rounded-full bg-[#2d6fa3]/10 text-[#2d6fa3] hover:bg-[#2d6fa3]/20 flex items-center justify-center transition shadow-sm">
                   <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                   </svg>
              </a>
              <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="inline">
                   @csrf @method('DELETE')
                   <button type="submit" title="Delete" class="w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center transition shadow-sm">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                        </svg>
                   </button>
              </form>
         </div>
    </div>
    @empty
    <div class="col-span-full bg-white rounded-2xl border border-gray-100 py-16 text-center">
        <div class="text-4xl text-slate-300 mb-3">📚</div>
        @if(($filters['search'] ?? '') !== '' || ($filters['availability'] ?? '') !== '')
        <p class="text-sm text-slate-400 font-medium">No books found.</p>
        <p class="text-xs text-slate-400 mt-1">Try a different search term or filter.</p>
        @else
        <p class="text-sm text-slate-400 font-medium">No books available</p>
        <p class="text-xs text-slate-400 mt-1">Add your first book using the button above</p>
        @endif
    </div>
    @endforelse
</div>