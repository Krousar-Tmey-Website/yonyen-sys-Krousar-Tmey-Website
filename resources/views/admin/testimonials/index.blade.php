@extends('admin.layouts.app')
@section('title', 'Testimonials')
@section('page-title', 'Testimonials')
@section('breadcrumb', 'Manage testimonials shown on the public site')

@section('content')

@if(session('success'))
<div class="mb-5 px-4 py-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded-xl">
    {{ session('success') }}
</div>
@endif

<div class="flex items-center justify-between mb-6">
    <h2 class="text-gray-700 font-semibold">All Testimonials</h2>
    <a href="{{ route('admin.testimonials.create') }}"
       class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-medium rounded-xl transition-colors">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Add Testimonial
    </a>
</div>

@if($items->isEmpty())
<div class="text-center py-20 bg-white rounded-2xl border border-gray-100">
    <svg class="w-12 h-12 text-gray-200 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
    <p class="text-gray-400 text-sm">No testimonials yet. Create your first one!</p>
    <a href="{{ route('admin.testimonials.create') }}" class="mt-3 inline-block text-[#2d6fa3] text-sm hover:underline">+ Add Testimonial</a>
</div>
@else
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
    @foreach($items as $item)
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow flex flex-col">
        {{-- Photo --}}
        <div class="relative">
            @if($item->image)
            <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="w-full h-44 object-cover">
            @else
            <div class="w-full h-44 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                <svg class="w-14 h-14 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            @endif
            <span class="absolute top-3 right-3 px-2 py-0.5 rounded-full text-xs font-medium {{ $item->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-400' }}">
                {{ $item->is_active ? 'Active' : 'Hidden' }}
            </span>
        </div>

        <div class="p-5 flex-1 flex flex-col">
            @if($item->label)
            <p class="text-[#2d6fa3] text-xs font-bold uppercase tracking-widest mb-1">{{ $item->label }}</p>
            @endif
            <h3 class="font-semibold text-gray-800 text-sm leading-snug mb-0.5">{{ $item->name }}</h3>
            @if($item->role)
            <p class="text-gray-400 text-xs mb-3">{{ $item->role }}</p>
            @endif
            @if($item->content)
            <p class="text-gray-500 text-xs leading-relaxed line-clamp-2 flex-1 italic">"{{ $item->content }}"</p>
            @endif
            @if($item->story)
            <p class="text-[#2d6fa3] text-xs mt-2">📖 Has full story</p>
            @endif

            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-50">
                <a href="{{ route('admin.testimonials.edit', $item) }}"
                   class="inline-flex items-center gap-1.5 text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit
                </a>
                <form action="{{ route('admin.testimonials.destroy', $item) }}" method="POST"
                      onsubmit="return confirm('Delete this testimonial?');" class="inline-block">
                    @csrf @method('DELETE')
                    <button type="submit" class="inline-flex items-center gap-1.5 text-red-400 hover:text-red-600 text-xs font-medium">
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