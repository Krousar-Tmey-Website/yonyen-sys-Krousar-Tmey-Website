@extends('admin.layouts.app')

@section('title', 'Page Sections')
@section('page-title', 'Homepage Sections')
@section('breadcrumb', 'Manage dynamic content sections on the homepage')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-400">{{ $sections->count() }} section(s) &middot; shown in order on the homepage</p>
    <a href="{{ route('admin.page-sections.create') }}" class="btn-primary text-sm">+ Add Section</a>
</div>

@if($sections->isEmpty())
<div class="bg-white rounded-2xl border border-gray-100 py-16 text-center text-gray-400">
    <svg class="w-12 h-12 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
    </svg>
    <p class="text-sm font-medium">No page sections yet.</p>
    <a href="{{ route('admin.page-sections.create') }}" class="text-[#2d6fa3] text-sm underline mt-1 inline-block">Create your first section</a>
</div>
@else
<div class="space-y-4">
    @foreach($sections as $section)
    @php
        $image = $section->images->first();
        $activeLinks = $section->links->where('active', true);
    @endphp
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow flex">
        {{-- Preview image --}}
        <div class="relative w-52 flex-shrink-0 hidden sm:block">
            @if($image)
            <img src="{{ str_starts_with($image->path, 'http') ? $image->path : asset('storage/' . $image->path) }}"
                 alt="{{ $image->alt ?? $section->title }}"
                 class="w-full h-full object-cover absolute inset-0">
            @else
            <div class="w-full h-full min-h-[130px] bg-gradient-to-br from-[#2d6fa3]/10 to-[#8da83a]/10 flex items-center justify-center">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
            <div class="absolute bottom-3 left-3 right-3">
                <span class="text-xs text-white font-semibold bg-white/20 backdrop-blur-sm px-2.5 py-1 rounded-full">
                    {{ $section->section_name }}
                </span>
            </div>
        </div>

        {{-- Info --}}
        <div class="flex-1 p-5 flex items-center justify-between gap-4">
            <div class="min-w-0">
                <div class="flex items-center gap-2 mb-1">
                    <span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full
                                 {{ $section->active ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-400' }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $section->active ? 'bg-green-500' : 'bg-gray-300' }}"></span>
                        {{ $section->active ? 'Active' : 'Hidden' }}
                    </span>
                    <span class="text-gray-300 text-xs">Order: {{ $section->order }}</span>
                </div>
                <h3 class="font-bold text-gray-800 text-sm mb-1 truncate max-w-sm">{{ $section->title }}</h3>
                @if($section->description)
                <p class="text-gray-400 text-xs line-clamp-2 max-w-md">{{ Str::limit(strip_tags($section->description), 120) }}</p>
                @endif
                <div class="flex gap-3 mt-2">
                    <span class="text-xs text-gray-400">
                        <strong class="text-gray-500">{{ $section->images->count() }}</strong> image(s)
                    </span>
                    <span class="text-xs text-gray-400">
                        <strong class="text-gray-500">{{ $activeLinks->count() }}</strong> link(s)
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-3 flex-shrink-0">
                <a href="{{ route('admin.page-sections.edit', $section) }}"
                   class="text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium px-3 py-1.5 border border-[#2d6fa3]/30 rounded-lg hover:bg-[#2d6fa3]/5 transition-colors">
                    Edit
                </a>
                <form action="{{ route('admin.page-sections.destroy', $section) }}" method="POST"
                      onsubmit="return confirm('Delete this section and its images? This cannot be undone.')">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-red-400 hover:text-red-600 text-xs font-medium px-3 py-1.5 border border-red-200 rounded-lg hover:bg-red-50 transition-colors">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="mt-6 p-4 bg-blue-50 border border-blue-100 rounded-xl text-sm text-blue-600">
    <strong>💡 Tip:</strong> Sections appear on the homepage in the order defined by the <em>Order</em> number. Lower numbers appear first.
    Each section alternates layout (image left → image right → image left…).
</div>
@endif

@endsection
