@extends('admin.layouts.app')

@section('title', $program->title)
@section('page-title', 'Program Details')
@section('breadcrumb', 'Programs → ' . $program->title)

@section('content')

<div class="max-w-3xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        {{-- Header with image --}}
        @if($program->image)
        <div class="relative h-52 overflow-hidden">
            <img src="{{ asset('storage/' . $program->image) }}" alt="{{ $program->title }}"
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-6">
                <h2 class="text-2xl font-bold text-white">{{ $program->title }}</h2>
            </div>
        </div>
        @else
        <div class="px-6 py-5 bg-gray-50 border-b border-gray-100">
            <h2 class="text-xl font-bold text-gray-800">{{ $program->title }}</h2>
        </div>
        @endif

        {{-- Details --}}
        <div class="p-6 space-y-5">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Status</p>
                    @if ($program->is_active)
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-600">
                            Active
                        </span>
                    @else
                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-500">
                            Hidden
                        </span>
                    @endif
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Sort Order</p>
                    <p class="text-sm font-medium text-gray-800">{{ $program->sort_order }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Created</p>
                    <p class="text-sm font-medium text-gray-800">{{ $program->created_at->format('d M Y, h:i A') }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Last Updated</p>
                    <p class="text-sm font-medium text-gray-800">{{ $program->updated_at->format('d M Y, h:i A') }}</p>
                </div>
            </div>

            @if($program->description)
            <div class="border-t border-gray-100 pt-5">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Short Description</p>
                <p class="text-sm text-gray-600 leading-relaxed">{{ $program->description }}</p>
            </div>
            @endif

            @if($program->full_description)
            <div class="border-t border-gray-100 pt-5">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Full Description</p>
                <div class="text-sm text-gray-600 leading-relaxed whitespace-pre-wrap">{{ $program->full_description }}</div>
            </div>
            @endif

            @if($program->stats)
            <div class="border-t border-gray-100 pt-5">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Statistics</p>
                <div class="grid grid-cols-3 gap-3">
                    @foreach((array) $program->stats as $key => $value)
                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <div class="text-lg font-bold text-[#2d6fa3]">{{ $value }}</div>
                        <div class="text-xs text-gray-500 capitalize">{{ $key }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        {{-- Actions --}}
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center gap-3">
            <a href="{{ route('admin.programs.edit', $program) }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-medium transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Program
            </a>
            <a href="{{ route('admin.programs.index') }}"
               class="px-4 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl text-sm font-medium transition">
                Back to Programs
            </a>
        </div>
    </div>
</div>

@endsection
