@extends('admin.layouts.app')

@section('title', $slide->title)
@section('page-title', 'Slide Details')
@section('breadcrumb', 'Slideshow → ' . $slide->title)

@section('content')

<div class="max-w-3xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        {{-- Image preview --}}
        <div class="relative h-56 bg-cover bg-center" style="background-image: url('{{ $slide->image_url }}')">
            <div class="absolute inset-0 bg-gradient-to-r from-[#0f2448]/80 to-transparent"></div>
            <div class="absolute inset-0 flex flex-col justify-end p-6">
                @if($slide->badge_text)
                <span class="text-xs bg-[#e8a020] text-white px-3 py-1 rounded-full w-fit mb-3">{{ $slide->badge_text }}</span>
                @endif
                <h2 class="text-2xl font-bold text-white leading-tight">{{ $slide->title }}</h2>
                @if($slide->subtitle)
                <p class="text-white/70 text-sm mt-2">{{ $slide->subtitle }}</p>
                @endif
            </div>
        </div>

        {{-- Details --}}
        <div class="p-6 space-y-5">
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Status</p>
                    @if ($slide->is_active)
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
                    <p class="text-sm font-medium text-gray-800">{{ $slide->sort_order }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Badge Text</p>
                    <p class="text-sm font-medium text-gray-800">{{ $slide->badge_text ?? '—' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Subtitle</p>
                    <p class="text-sm font-medium text-gray-800">{{ $slide->subtitle ?? '—' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Created</p>
                    <p class="text-sm font-medium text-gray-800">{{ $slide->created_at->format('d M Y, h:i A') }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Last Updated</p>
                    <p class="text-sm font-medium text-gray-800">{{ $slide->updated_at->format('d M Y, h:i A') }}</p>
                </div>
            </div>

            {{-- CTAs --}}
            <div class="border-t border-gray-100 pt-5">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Call-to-Action Buttons</p>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-xs text-gray-400 mb-1">Primary CTA</p>
                        @if($slide->cta_primary_text)
                            <p class="text-sm font-semibold text-gray-800">{{ $slide->cta_primary_text }}</p>
                            <p class="text-xs text-blue-600 mt-1">{{ $slide->cta_primary_url ?? '—' }}</p>
                        @else
                            <p class="text-sm text-gray-400">Not set</p>
                        @endif
                    </div>
                    <div class="bg-gray-50 rounded-xl p-4">
                        <p class="text-xs text-gray-400 mb-1">Secondary CTA</p>
                        @if($slide->cta_secondary_text)
                            <p class="text-sm font-semibold text-gray-800">{{ $slide->cta_secondary_text }}</p>
                            <p class="text-xs text-blue-600 mt-1">{{ $slide->cta_secondary_url ?? '—' }}</p>
                        @else
                            <p class="text-sm text-gray-400">Not set</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center gap-3">
            <a href="{{ route('admin.slides.edit', $slide) }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-medium transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Slide
            </a>
            <a href="{{ route('admin.slides.index') }}"
               class="px-4 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl text-sm font-medium transition">
                Back to Slides
            </a>
        </div>
    </div>
</div>

@endsection
