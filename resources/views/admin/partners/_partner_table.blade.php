<table class="w-full text-sm">
    <thead>
        <tr class="text-gray-400 text-xs border-b border-gray-50">
            <th class="text-left font-medium px-6 py-3">Partner</th>
            <th class="text-left font-medium px-6 py-3">Category</th>
            <th class="text-left font-medium px-6 py-3">Status</th>
            <th class="text-left font-medium px-6 py-3">Created</th>
            <th class="text-right font-medium px-6 py-3">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($catPartners as $partner)
        <tr class="border-t border-gray-50 hover:bg-gray-50/60 transition">
            <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                    @if($partner->logo_url)
                    <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}"
                         class="w-10 h-10 rounded-full object-cover border border-gray-100 bg-white">
                    @else
                    <div class="w-10 h-10 rounded-full bg-[#2d6fa3]/10 flex items-center justify-center text-[#2d6fa3] text-xs font-semibold">
                        {{ Str::substr($partner->name, 0, 1) }}
                    </div>
                    @endif
                    <span class="font-medium text-gray-800">{{ $partner->name }}</span>
                </div>
            </td>
            <td class="px-6 py-4">
                <span class="text-gray-700">{{ $partner->subcategory ?? $partner->category }}</span>
            </td>
            <td class="px-6 py-4">
                @if($partner->is_active)
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-600">Active</span>
                @else
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500">Hidden</span>
                @endif
            </td>
            <td class="px-6 py-4 text-gray-400 text-xs">{{ $partner->created_at->format('d M Y') }}</td>
            <td class="px-6 py-4">
                <div class="flex items-center justify-end gap-2">
                    <span class="group/tip relative">
                        <button type="button" @click="openViewModal(@js($partner->toArray()))"
                                class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 hover:bg-emerald-100 hover:scale-105 flex items-center justify-center transition-all duration-150 cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                        <span class="pointer-events-none absolute -top-9 left-1/2 -translate-x-1/2 whitespace-nowrap rounded-lg bg-gray-800 px-2.5 py-1 text-xs font-medium text-white opacity-0 group-hover/tip:opacity-100 transition-opacity duration-150 z-10">View</span>
                    </span>
                    <span class="group/tip relative">
                        <a href="{{ route('admin.partners.edit', $partner) }}"
                           class="w-8 h-8 rounded-full bg-[#2d6fa3]/10 text-[#2d6fa3] hover:bg-[#2d6fa3]/20 hover:scale-105 flex items-center justify-center transition-all duration-150">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </a>
                        <span class="pointer-events-none absolute -top-9 left-1/2 -translate-x-1/2 whitespace-nowrap rounded-lg bg-gray-800 px-2.5 py-1 text-xs font-medium text-white opacity-0 group-hover/tip:opacity-100 transition-opacity duration-150 z-10">Edit</span>
                    </span>
                    <span class="group/tip relative">
                        <form action="{{ route('admin.partners.destroy', $partner) }}" method="POST" onsubmit="return confirm('Delete this partner? This cannot be undone.')">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-100 hover:scale-105 flex items-center justify-center transition-all duration-150 cursor-pointer">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                                </svg>
                            </button>
                        </form>
                        <span class="pointer-events-none absolute -top-9 left-1/2 -translate-x-1/2 whitespace-nowrap rounded-lg bg-gray-800 px-2.5 py-1 text-xs font-medium text-white opacity-0 group-hover/tip:opacity-100 transition-opacity duration-150 z-10">Delete</span>
                    </span>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
