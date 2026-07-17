{{-- Shared repeatable list item for Partnership Principles / Partner Categories.
     Expects: $item, $field (property to display/edit), $routePrefix (route name prefix), $confirmLabel --}}
<li data-drag-item data-id="{{ $item->id }}" x-data="{ editing: false }" class="flex items-center gap-3 px-4 py-3 bg-white group">
    <span data-drag-handle draggable="true" title="Drag to reorder"
          class="cursor-grab active:cursor-grabbing text-gray-300 group-hover:text-gray-400 flex-shrink-0 select-none">
        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path d="M7 4a1 1 0 11-2 0 1 1 0 012 0zM7 10a1 1 0 11-2 0 1 1 0 012 0zM7 16a1 1 0 11-2 0 1 1 0 012 0zM15 4a1 1 0 11-2 0 1 1 0 012 0zM15 10a1 1 0 11-2 0 1 1 0 012 0zM15 16a1 1 0 11-2 0 1 1 0 012 0z"/>
        </svg>
    </span>

    <div class="flex-1 min-w-0" x-show="!editing">
        <p class="text-sm text-gray-700">{{ $item->{$field} }}</p>
    </div>

    <div class="flex-1" x-show="editing" x-cloak>
        <form action="{{ route($routePrefix . '.update', $item) }}" method="POST" class="flex items-center gap-2">
            @csrf @method('PUT')
            <input type="text" name="{{ $field }}" value="{{ $item->{$field} }}" required maxlength="255"
                   class="flex-1 rounded-lg border border-gray-200 text-sm px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            <button type="submit" class="text-xs font-semibold text-[#2d6fa3] px-2 py-1.5 flex-shrink-0">Save</button>
            <button type="button" @click="editing = false" class="text-xs text-gray-400 hover:text-gray-600 px-2 py-1.5 flex-shrink-0">Cancel</button>
        </form>
    </div>

    <div class="flex items-center gap-1.5 flex-shrink-0" x-show="!editing">
        <button @click="editing = true" type="button" title="Edit"
                class="w-7 h-7 rounded-full bg-[#2d6fa3]/10 text-[#2d6fa3] hover:bg-[#2d6fa3]/20 flex items-center justify-center transition">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
            </svg>
        </button>
        <form action="{{ route($routePrefix . '.destroy', $item) }}" method="POST" onsubmit="return confirm('Remove this {{ $confirmLabel }}?')">
            @csrf @method('DELETE')
            <button type="submit" title="Delete"
                    class="w-7 h-7 rounded-full bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center transition">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16"/>
                </svg>
            </button>
        </form>
    </div>
</li>
