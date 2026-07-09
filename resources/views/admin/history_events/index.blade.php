@extends('admin.layouts.app')

@section('title', 'History Events')
@section('page-title', 'History Timeline')
@section('breadcrumb', 'Who We Are → Our History')

@section('content')
<div class="grid lg:grid-cols-3 gap-6">

    {{-- Add Form --}}
    <div class="lg:col-span-1">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <h3 class="font-bold text-gray-700 mb-5 flex items-center gap-2">
                <span class="w-6 h-6 rounded-lg bg-[#2d6fa3] flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                </span>
                Add History Event
            </h3>
            <form action="{{ route('admin.history-events.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Year <span class="text-red-400">*</span></label>
                    <input type="text" name="year" value="{{ old('year') }}" placeholder="e.g. 1991"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Left Column Text <span class="text-red-400">*</span></label>
                    <textarea name="left_text" rows="3" placeholder="Main event description..."
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('left_text') }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Right Column Text <span class="text-gray-400 font-normal">(optional)</span></label>
                    <textarea name="right_text" rows="3" placeholder="Second event for same year..."
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('right_text') }}</textarea>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <button type="submit" class="w-full btn-primary justify-center">Add Event</button>
            </form>
        </div>
    </div>

    {{-- Events List --}}
    <div class="lg:col-span-2 space-y-3">
        @forelse($events as $event)
        <div x-data="{ editing: false }" class="bg-white rounded-2xl border border-gray-100 overflow-hidden">

            {{-- View row --}}
            <div x-show="!editing" class="p-5 flex items-start gap-4">
                <div class="w-16 h-16 rounded-xl bg-[#2d6fa3] flex items-center justify-center flex-shrink-0">
                    <span class="text-white font-black text-sm">{{ $event->year }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-gray-700 leading-relaxed mb-1">{{ $event->left_text }}</p>
                    @if($event->right_text)
                    <p class="text-sm text-gray-500 leading-relaxed border-t border-gray-100 pt-1 mt-1">{{ $event->right_text }}</p>
                    @endif
                    <div class="flex items-center gap-3 mt-2">
                        <span class="text-xs text-gray-400">Order: {{ $event->sort_order }}</span>
                        @if(!$event->is_active)
                        <span class="text-xs bg-gray-100 text-gray-400 px-2 py-0.5 rounded-full">Hidden</span>
                        @endif
                    </div>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <button @click="editing = true"
                            class="p-2 text-gray-400 hover:text-[#2d6fa3] hover:bg-[#2d6fa3]/5 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </button>
                    <form action="{{ route('admin.history-events.destroy', $event) }}" method="POST"
                          onsubmit="return confirm('Delete this history event?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                </div>
            </div>

            {{-- Edit form --}}
            <div x-show="editing" x-cloak class="p-5 bg-[#f8f9fc] border-t border-gray-100">
                <form action="{{ route('admin.history-events.update', $event) }}" method="POST" class="space-y-4">
                    @csrf @method('PUT')
                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Year</label>
                            <input type="text" name="year" value="{{ $event->year }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5">Sort Order</label>
                            <input type="number" name="sort_order" value="{{ $event->sort_order }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Left Column Text</label>
                        <textarea name="left_text" rows="3"
                                  class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3] resize-none">{{ $event->left_text }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1.5">Right Column Text</label>
                        <textarea name="right_text" rows="3"
                                  class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3] resize-none">{{ $event->right_text }}</textarea>
                    </div>
                    <div class="flex items-center gap-3">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" {{ $event->is_active ? 'checked' : '' }}
                                   class="w-4 h-4 accent-[#2d6fa3]">
                            <span class="text-sm text-gray-600">Active (visible on site)</span>
                        </label>
                    </div>
                    <div class="flex gap-3">
                        <button type="submit" class="btn-primary text-sm">Save Changes</button>
                        <button type="button" @click="editing = false"
                                class="px-4 py-2 text-sm text-gray-500 hover:text-gray-700 border border-gray-200 rounded-xl hover:bg-white transition-colors">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center">
            <p class="text-gray-400 text-sm">No history events yet. Add the first one.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
