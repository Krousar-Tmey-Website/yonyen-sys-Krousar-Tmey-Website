@extends('admin.layouts.app')

@section('title', 'Media Gallery')
@section('page-title', 'Media Gallery')
@section('breadcrumb', 'Manage media resources for the public Media page')

@section('content')

@if(session('success'))
<div class="max-w-3xl mx-auto mb-6 bg-green-50 border border-green-200 text-green-700 text-sm px-4 py-3 rounded-xl flex items-center gap-2">
    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    {{ session('success') }}
</div>
@endif

<div class="max-w-6xl mx-auto space-y-6">
    {{-- Header --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 flex items-center justify-between">
        <div>
            <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider">All Media Items</h2>
            <p class="text-xs text-gray-400 mt-1">{{ $items->count() }} item(s) — adjust sort order to re-arrange</p>
        </div>
        <a href="{{ route('admin.media.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-semibold rounded-xl transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Media Item
        </a>
    </div>

    @if($items->isEmpty())
    <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center">
        <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-[#2d6fa3]/10 flex items-center justify-center">
            <svg class="w-8 h-8 text-[#2d6fa3]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
        </div>
        <p class="text-gray-400 text-sm">No media items added yet.</p>
        <a href="{{ route('admin.media.create') }}" class="mt-3 inline-flex items-center gap-1.5 text-[#2d6fa3] font-semibold text-sm hover:underline">
            Add your first media item
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
        </a>
    </div>
    @else
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
        @foreach($items as $item)
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow flex flex-col">
            {{-- Preview --}}
            @if($item->file_path)
                @if($item->type === 'image')
                <div class="h-40 overflow-hidden">
                    <img src="{{ $item->image_url }}" alt="{{ $item->alt_text ?? $item->title }}" class="w-full h-full object-cover">
                </div>
                @elseif($item->type === 'video')
                <div class="h-40 bg-gray-100 flex items-center justify-center">
                    <svg class="w-14 h-14 text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M10 16.5l6-4.5-6-4.5v9zM21 19V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2z"/></svg>
                </div>
                @else
                <div class="h-40 bg-gray-100 flex items-center justify-center">
                    <svg class="w-14 h-14 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                @endif
            @else
            <div class="h-40 bg-gray-100 flex items-center justify-center text-gray-300">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            @endif

            {{-- Content --}}
            <div class="p-5 flex flex-col flex-1">
                <div class="flex items-start justify-between mb-2">
                    <h3 class="font-bold text-[#1d4e7a] uppercase text-sm leading-snug">{{ $item->title }}</h3>
                    <span class="px-2 py-0.5 rounded-full text-xs flex-shrink-0 ml-2
                        @if($item->type === 'image') bg-blue-50 text-blue-600
                        @elseif($item->type === 'video') bg-purple-50 text-purple-600
                        @else bg-amber-50 text-amber-600 @endif">
                        {{ ucfirst($item->type) }}
                    </span>
                </div>

                <div class="flex items-center gap-2 mb-2">
                    @if($item->is_active)
                    <span class="px-2 py-0.5 rounded-full text-xs bg-green-50 text-green-600">Active</span>
                    @else
                    <span class="px-2 py-0.5 rounded-full text-xs bg-gray-100 text-gray-400">Hidden</span>
                    @endif
                    <span class="text-xs text-gray-400">Sort: {{ $item->sort_order }}</span>
                </div>

                @if($item->description)
                <p class="text-gray-400 text-xs leading-relaxed line-clamp-2 flex-1">{{ $item->description }}</p>
                @endif

                {{-- Actions --}}
                <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-50">
                    <a href="{{ route('admin.media.edit', $item) }}"
                       class="inline-flex items-center gap-1.5 text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-semibold transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </a>
                    <form action="{{ route('admin.media.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete this media item permanently?');" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-1.5 text-red-400 hover:text-red-600 text-xs font-semibold transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection