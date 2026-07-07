@extends('admin.layouts.app')

@section('title', 'Slideshow')
@section('page-title', 'Hero Slideshow')
@section('breadcrumb', 'Manage homepage carousel slides')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-400">{{ $slides->count() }} slide(s) · drag to reorder (coming soon)</p>
    <a href="{{ route('admin.slides.create') }}" class="btn-primary text-sm">+ Add Slide</a>
</div>

@if($slides->isEmpty())
<div class="bg-white rounded-2xl border border-gray-100 py-16 text-center text-gray-400">
    <svg class="w-12 h-12 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
    </svg>
    <p class="text-sm font-medium">No slides yet.</p>
    <a href="{{ route('admin.slides.create') }}" class="text-[#2d6fa3] text-sm underline mt-1 inline-block">Add your first slide</a>
</div>
@else
<div class="space-y-4">
    @foreach($slides as $slide)
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow flex">

        {{-- Preview --}}
        <div class="relative w-52 flex-shrink-0 hidden sm:block">
            <div class="h-full min-h-[130px] bg-cover bg-center"
                 style="background-image: url('{{ $slide->image_url }}')">
                <div class="absolute inset-0 bg-[#1d4e7a]/60"></div>
            </div>
            <div class="absolute inset-0 flex flex-col justify-end p-4">
                @if($slide->badge_text)
                <span class="text-xs bg-[#e8a020] text-white px-2 py-0.5 rounded-full w-fit mb-2">{{ $slide->badge_text }}</span>
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
                <p class="text-gray-400 text-xs line-clamp-2 max-w-sm">{{ $slide->subtitle }}</p>
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
                <a href="{{ route('admin.slides.show', $slide) }}"
                   class="text-emerald-600 hover:text-emerald-700 text-xs font-medium px-3 py-1.5 border border-emerald-200 rounded-lg hover:bg-emerald-50 transition-colors">
                    View
                </a>
                <a href="{{ route('admin.slides.edit', $slide) }}"
                   class="text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium px-3 py-1.5 border border-[#2d6fa3]/30 rounded-lg hover:bg-[#2d6fa3]/5 transition-colors">
                    Edit
                </a>
                <form action="{{ route('admin.slides.destroy', $slide) }}" method="POST"
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
