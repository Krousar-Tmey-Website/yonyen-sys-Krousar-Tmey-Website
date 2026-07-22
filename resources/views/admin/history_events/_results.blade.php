@php $canReorder = ($filters['search'] ?? '') === ''; @endphp
@if($events->isEmpty())
<div class="bg-white rounded-2xl border border-gray-100 py-16 text-center">
    <svg class="w-12 h-12 mx-auto mb-3 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    @if(($filters['search'] ?? '') !== '')
    <p class="text-gray-500 text-sm font-medium">No history events found.</p>
    <p class="text-gray-400 text-xs mt-1">Try a different search term.</p>
    @else
    <p class="text-gray-500 text-sm">No history events available</p>
    <p class="text-gray-400 text-xs mt-1">Click <strong>Add Event</strong> to create one</p>
    @endif
</div>
@else
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-gray-400 text-xs uppercase tracking-wide bg-gray-50/60 border-b border-gray-100">
                <th class="w-8 px-2 py-3"></th>
                <th class="text-left font-semibold px-6 py-3">Year</th>
                <th class="text-left font-semibold px-6 py-3">Event</th>
                <th class="text-left font-semibold px-6 py-3">Status</th>
                <th class="text-right font-semibold px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody id="history-events-tbody">
            @foreach($events as $event)
            <tr data-id="{{ $event->id }}"
                draggable="{{ $canReorder ? 'true' : 'false' }}"
                @if($canReorder)
                @dragstart="startDrag($event)"
                @dragend="endDrag($event)"
                @dragover.prevent="dragOverRow($event, $el)"
                @drop.prevent="dropRow()"
                @endif
                class="border-t border-gray-50 hover:bg-gray-50/60 transition {{ $canReorder ? 'cursor-move' : '' }}">
                <td class="px-2 py-4 text-gray-300">
                    @if($canReorder)
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9h8M8 15h8"/>
                    </svg>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-3">
                        @if($event->image_url)
                        <img src="{{ $event->image_url }}" alt="Event image"
                             class="w-10 h-10 rounded-full object-cover border border-gray-100 bg-white">
                        @endif
                        <span class="font-medium text-gray-800">{{ $event->year }}</span>
                    </div>
                </td>
                <td class="px-6 py-4 text-xs leading-relaxed max-w-md">
                    @if($event->left_text)
                    <div class="flex items-start gap-1.5">
                        <span class="shrink-0 mt-0.5 px-1.5 py-0.5 rounded bg-[#2d6fa3]/10 text-[#2d6fa3] text-[10px] font-bold">L</span>
                        <span class="text-gray-600">{{ Str::limit($event->left_text, 70) }}</span>
                    </div>
                    @endif
                    @if($event->right_text)
                    <div class="flex items-start gap-1.5 {{ $event->left_text ? 'mt-1.5' : '' }}">
                        <span class="shrink-0 mt-0.5 px-1.5 py-0.5 rounded bg-[#8da83a]/10 text-[#8da83a] text-[10px] font-bold">R</span>
                        <span class="text-gray-500">{{ Str::limit($event->right_text, 70) }}</span>
                    </div>
                    @endif
                    @if(!$event->left_text && !$event->right_text)
                    <span class="text-gray-300 italic">No content</span>
                    @endif
                </td>
                <td class="px-6 py-4">
                    <button type="button" draggable="false" @click="toggleActive({{ $event->id }}, $event)"
                            title="{{ $event->is_active ? 'Active — click to hide' : 'Hidden — click to activate' }}"
                            class="relative inline-flex items-center h-6 w-11 rounded-full transition-colors cursor-pointer {{ $event->is_active ? 'bg-emerald-500' : 'bg-gray-300' }}">
                        <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform {{ $event->is_active ? 'translate-x-6' : 'translate-x-1' }}"></span>
                    </button>
                </td>
                <td class="px-6 py-4">
                    <div class="flex items-center justify-end gap-2">
                        <button draggable="false" @click="openEditModal(@js($event->toArray()))" title="Edit"
                                class="w-8 h-8 rounded-full bg-[#2d6fa3]/10 text-[#2d6fa3] hover:bg-[#2d6fa3]/20 flex items-center justify-center transition cursor-pointer">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                        </button>
                        <form action="{{ route('admin.history-events.destroy', $event) }}" method="POST" onsubmit="return confirm('Delete this history event?')">
                            @csrf @method('DELETE')
                            <button type="submit" draggable="false" title="Delete" class="w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center transition">
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
