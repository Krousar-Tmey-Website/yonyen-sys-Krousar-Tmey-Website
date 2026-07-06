@extends('admin.layouts.app')

@section('title', 'Programs')
@section('page-title', 'Programs')
@section('breadcrumb', 'Edit program titles, descriptions and images')

@section('content')

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
    @foreach($programs as $program)
    <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
        @if($program->image)
        <img src="{{ asset('images/' . $program->image) }}" alt="{{ $program->title }}"
             class="w-full h-36 object-cover">
        @else
        <div class="w-full h-36 bg-gray-100 flex items-center justify-center text-gray-300">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
        </div>
        @endif
        <div class="p-5">
            <div class="flex items-start justify-between mb-2">
                <h3 class="font-semibold text-gray-700 text-sm leading-snug">{{ $program->title }}</h3>
                <span class="px-2 py-0.5 rounded-full text-xs {{ $program->is_active ? 'bg-green-50 text-green-600' : 'bg-gray-100 text-gray-400' }} flex-shrink-0 ml-2">
                    {{ $program->is_active ? 'Active' : 'Hidden' }}
                </span>
            </div>
            @if($program->description)
            <p class="text-gray-400 text-xs leading-relaxed mb-4 line-clamp-2">{{ $program->description }}</p>
            @endif
            <a href="{{ route('admin.programs.edit', $program) }}"
               class="inline-flex items-center gap-1.5 text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit
            </a>
        </div>
    </div>
    @endforeach
</div>

@endsection
