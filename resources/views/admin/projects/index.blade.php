@extends('admin.layouts.app')
@section('title', 'Projects')
@section('page-title', 'Projects')
@section('breadcrumb', 'Manage sub-pages that appear under each program')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h2 class="text-gray-700 font-semibold">All Projects <span class="text-gray-400 font-normal text-sm ml-1">({{ $items->count() }} total)</span></h2>
    <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-medium rounded-xl transition-colors">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        New Project
    </a>
</div>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
    @forelse($items as $item)
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow group">
        {{-- Thumbnail --}}
        <div class="relative">
            @if($item->image)
            <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}"
                 alt="{{ $item->title }}" class="w-full h-36 object-cover">
            @elseif($item->banner_image)
            <img src="{{ str_starts_with($item->banner_image, 'http') ? $item->banner_image : asset('storage/' . $item->banner_image) }}"
                 alt="{{ $item->title }}" class="w-full h-36 object-cover opacity-80">
            @else
            <div class="w-full h-36 bg-[#1a3c6e]/8 flex items-center justify-center text-gray-300">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            @endif
            {{-- Status badge --}}
            <span class="absolute top-2 right-2 px-2 py-0.5 rounded-full text-xs font-medium {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                {{ $item->is_active ? 'Active' : 'Hidden' }}
            </span>
            {{-- Banner indicator --}}
            @if($item->banner_image)
            <span class="absolute top-2 left-2 px-2 py-0.5 rounded-full text-xs font-medium bg-[#1a3c6e]/80 text-white">
                Has banner
            </span>
            @endif
        </div>

        <div class="p-5">
            <div class="mb-1 text-xs text-[#2d6fa3] font-semibold tracking-wide uppercase">
                {{ $item->program ? $item->program->title : 'No parent program' }}
            </div>
            <h3 class="font-semibold text-gray-800 text-sm leading-snug mb-1">{{ $item->title }}</h3>
            @if($item->description)
            <p class="text-gray-400 text-xs leading-relaxed line-clamp-2 mb-3">{{ $item->description }}</p>
            @endif

            <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-50">
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.projects.edit', $item) }}"
                       class="inline-flex items-center gap-1.5 text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </a>
                    <form action="{{ route('admin.projects.destroy', $item) }}" method="POST"
                          onsubmit="return confirm('Delete &quot;{{ addslashes($item->title) }}&quot;? This cannot be undone.');" class="inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center gap-1.5 text-red-400 hover:text-red-700 text-xs font-medium">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Delete
                        </button>
                    </form>
                </div>
                <a href="{{ route('projects.show', $item) }}" target="_blank"
                   class="inline-flex items-center gap-1 text-gray-400 hover:text-[#2d6fa3] text-xs transition-colors">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    Live
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-16 text-gray-400">
        <svg class="w-12 h-12 mx-auto mb-3 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        <p class="text-sm font-medium">No projects yet</p>
        <a href="{{ route('admin.projects.create') }}" class="mt-3 inline-block text-[#2d6fa3] text-sm hover:underline">Create the first project</a>
    </div>
    @endforelse
</div>

@endsection