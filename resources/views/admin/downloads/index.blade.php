@extends('admin.layouts.app')

@section('title', 'Downloads')
@section('page-title', 'Downloads')
@section('breadcrumb', 'Manage downloadable documents and resources')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h2 class="text-gray-700 font-semibold">All Downloads</h2>
    <a href="{{ route('admin.downloads.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-medium rounded-xl transition-colors">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Download
    </a>
</div>

@if($items->isEmpty())
<div class="bg-white rounded-2xl border border-gray-100 p-8 text-center">
    <p class="text-gray-400">No downloads added yet. Click "Add Download" to get started.</p>
</div>
@else
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
    @foreach($items as $item)
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
        <div class="w-full h-36 bg-gray-100 flex items-center justify-center">
            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <div class="p-5">
            <div class="flex items-start justify-between mb-2">
                <h3 class="font-semibold text-gray-700 text-sm leading-snug">{{ $item->title }}</h3>
                @if($item->is_active)
                <span class="px-2 py-0.5 rounded-full text-xs bg-green-50 text-green-600 flex-shrink-0 ml-2">Active</span>
                @else
                <span class="px-2 py-0.5 rounded-full text-xs bg-gray-100 text-gray-400 flex-shrink-0 ml-2">Hidden</span>
                @endif
            </div>
            @if($item->description)
            <p class="text-gray-400 text-xs leading-relaxed mb-4 line-clamp-2">{{ $item->description }}</p>
            @endif
            <div class="flex items-center justify-between mt-4">
                <a href="{{ route('admin.downloads.edit', $item) }}"
                   class="inline-flex items-center gap-1.5 text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit
                </a>
                <form action="{{ route('admin.downloads.destroy', $item) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this download?');" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-1.5 text-red-500 hover:text-red-700 text-xs font-medium">
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
@endsection