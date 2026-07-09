@extends('admin.layouts.app')

@section('title', 'Programs')
@section('page-title', 'Programs')
@section('breadcrumb', 'Manage program images, titles and descriptions')

@section('content')

<div class="space-y-4 mb-6">
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
        <p class="text-sm text-blue-700"><span class="font-semibold">💡 Tip:</span> Upload images for your programs (JPG, PNG). Images appear on the homepage with hover effects showing the description.</p>
    </div>
</div>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($programs as $program)
    <a href="{{ route('admin.programs.edit', $program) }}" class="group bg-white rounded-2xl border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 hover:border-[#2d6fa3]/30">
        {{-- Image Preview --}}
        <div class="relative overflow-hidden h-44 bg-gray-100">
            <img src="{{ $program->image_url }}" alt="{{ $program->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
        </div>
        
        {{-- Content --}}
        <div class="p-5">
            <div class="flex items-start justify-between mb-3">
                <h3 class="font-bold text-gray-800 text-base leading-snug flex-1">{{ $program->title }}</h3>
                <span class="px-2.5 py-1 rounded-full text-xs font-medium ml-2 flex-shrink-0 {{ $program->is_active ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                    {{ $program->is_active ? '✓ Active' : '○ Hidden' }}
                </span>
            </div>
            
            {{-- Description Preview --}}
            @if($program->description)
            <p class="text-gray-600 text-xs leading-relaxed mb-4 line-clamp-2">{{ $program->description }}</p>
            @else
            <p class="text-gray-400 text-xs italic mb-4">No description added yet</p>
            @endif
            
            {{-- Edit Button --}}
            <div class="flex items-center gap-2 text-[#2d6fa3] group-hover:text-[#1d4e7a] text-xs font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Program
            </div>
        </div>
    </a>
    @endforeach
</div>

@endsection
