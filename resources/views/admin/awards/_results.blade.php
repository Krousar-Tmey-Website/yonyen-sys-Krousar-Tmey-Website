@if($awards->isEmpty())
<div class="bg-white rounded-2xl border border-gray-100 py-16 text-center">
    <div class="text-gray-300 text-4xl mb-3">🏆</div>
    @if(($filters['search'] ?? '') !== '')
    <p class="text-gray-500 text-sm font-medium">No awards found.</p>
    <p class="text-gray-400 text-xs mt-1">Try a different search term.</p>
    @else
    <p class="text-gray-500 text-sm">No awards available</p>
    <p class="text-gray-400 text-xs mt-1">Click <strong>Add New Award</strong> to create one</p>
    @endif
</div>
@else
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-gray-400 text-xs border-b border-gray-50">
                <th class="text-left font-medium px-6 py-3">Award</th>
                <th class="text-left font-medium px-6 py-3">Organization</th>
                <th class="text-left font-medium px-6 py-3">Recipient</th>
                <th class="text-left font-medium px-6 py-3">Status</th>
                <th class="text-right font-medium px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($awards as $award)
            <tr class="border-t border-gray-50 hover:bg-gray-50/60 transition">
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        @if($award->image_url)
                        <img src="{{ $award->image_url }}" alt="{{ $award->title }}"
                             class="w-10 h-10 rounded-full object-cover border border-gray-100 bg-white">
                        @else
                        <div class="w-10 h-10 rounded-full bg-[#2d6fa3]/10 flex items-center justify-center text-[#2d6fa3] text-xs font-semibold">
                            🏆
                        </div>
                        @endif
                        <span class="font-medium text-gray-800">{{ $award->title }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-gray-500">{{ $award->organization ?? '—' }}</td>
                <td class="px-6 py-4 text-gray-500">{{ $award->recipient ?? '—' }}</td>
                <td class="px-6 py-4">
                    @if($award->is_active)
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-600">Active</span>
                    @else
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500">Hidden</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                        <button @click="openEditModal(@js($award->toArray()))" title="Edit"
                                class="w-8 h-8 rounded-full bg-[#2d6fa3]/10 text-[#2d6fa3] hover:bg-[#2d6fa3]/20 flex items-center justify-center transition cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                        <form action="{{ route('admin.awards.destroy', $award) }}" method="POST" onsubmit="return confirm('Delete this award?')">
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
            @endforeach
        </tbody>
    </table>
</div>
@endif