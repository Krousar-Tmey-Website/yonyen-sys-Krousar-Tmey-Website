@extends('admin.layouts.app')

@section('title', 'Presentation Slides')
@section('page-title', 'Hero Slideshow')
@section('breadcrumb', 'Presentation → Manage slides for the presentation page hero carousel')

@section('content')

<div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6">
    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between flex-wrap gap-4">
        <div class="flex items-center gap-2">
            <h3 class="font-bold text-gray-800">Hero Slideshow</h3>
            <span class="px-2.5 py-1 bg-[#2d6fa3]/10 text-[#2d6fa3] rounded-full text-xs font-semibold">{{ $slides->count() }}</span>
        </div>
        <a href="{{ route('admin.presentation-slides.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-full text-sm font-semibold transition-colors shadow-sm hover:shadow-md">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Add Slide
        </a>
    </div>
    <p class="px-6 pb-4 -mt-2 text-xs text-gray-400">drag to reorder (coming soon)</p>
</div>

@if($slides->isEmpty())
<div class="bg-white rounded-2xl border border-gray-100 py-16 text-center text-gray-400">
    <div class="text-4xl mb-3">🖼️</div>
    <p class="text-sm font-medium text-gray-500">No slides yet</p>
    <p class="text-xs mt-1">Click <strong>Add Slide</strong> to create your first slide.</p>
</div>
@else
<div class="space-y-4">
    @foreach($slides as $slide)
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow flex">

        {{-- Preview --}}
        <div class="relative w-40 flex-shrink-0 hidden sm:block">
            <div class="h-24 rounded-l-xl overflow-hidden">
                <img src="{{ $slide->image_url }}" alt="{{ $slide->title }}" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-[#1d4e7a]/60"></div>
            </div>
            <div class="absolute inset-0 flex flex-col justify-end p-3 pointer-events-none">
                @if($slide->badge_text)
                <span class="text-xs bg-[#e8a020] text-white px-2 py-0.5 rounded-full w-fit mb-1">{{ $slide->badge_text }}</span>
                @endif
                <p class="text-white text-xs font-bold leading-snug line-clamp-2">{{ $slide->title }}</p>
            </div>
        </div>

        {{-- Info --}}
        <div class="flex-1 p-5 flex items-center justify-between gap-4">
            <div class="min-w-0">
                <div class="flex items-center gap-2 mb-1">
                    <span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full
                              {{ $slide->is_active ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-400' }}">
                        <span class="w-1.5 h-1.5 rounded-full {{ $slide->is_active ? 'bg-green-500' : 'bg-gray-300' }}"></span>
                        {{ $slide->is_active ? 'Active' : 'Hidden' }}
                    </span>
                    <span class="text-gray-300 text-xs">Order: {{ $slide->sort_order }}</span>
                </div>
                <h3 class="font-bold text-gray-800 text-sm mb-1 truncate max-w-sm">{{ $slide->title }}</h3>
                @if($slide->subtitle)
                <p class="text-gray-400 text-xs line-clamp-2 max-w-sm">{{ Str::limit(strip_tags($slide->subtitle), 100) }}</p>
                @endif
                <div class="flex gap-4 mt-2">
                    @if($slide->cta_primary_text)
                    <span class="text-xs text-[#2d6fa3]">CTA: {{ $slide->cta_primary_text }}</span>
                    @endif
                    @if($slide->cta_secondary_text)
                    <span class="text-xs text-gray-400">+ {{ $slide->cta_secondary_text }}</span>
                    @endif
                </div>
            </div>
            <div class="flex items-center gap-3 flex-shrink-0">
                <a href="{{ route('admin.presentation-slides.edit', $slide) }}"
                   class="text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium px-3 py-1.5 border border-[#2d6fa3]/30 rounded-lg hover:bg-[#2d6fa3]/5 transition-colors">
                    Edit
                </a>
                <form action="{{ route('admin.presentation-slides.destroy', $slide) }}" method="POST"
                      onsubmit="return confirm('Delete this slide?')">
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
    <strong>Tip:</strong> Change the <em>Sort Order</em> number on each slide to control which appears first. Lower numbers appear first.
    The carousel auto-advances every 5.5 seconds.
</div>
@endif

@endsection