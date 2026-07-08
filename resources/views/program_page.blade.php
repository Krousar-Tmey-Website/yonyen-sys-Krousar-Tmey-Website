@extends('layouts.app')

@section('title', $page->title . ' — Krousar Thmey')
@section('description', $page->short_content ?? $page->title)

@section('content')

{{-- Page Header --}}
@php
    $bannerStyle = $page->image
        ? 'background-image: linear-gradient(to right, rgba(26,60,110,0.92) 40%, rgba(26,60,110,0.70)), url(' . $page->image_url . '); background-size: cover; background-position: center;'
        : '';
@endphp
<div class="bg-[#1a3c6e] pt-16 pb-20 relative overflow-hidden" style="{{ $bannerStyle }}">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/60 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('programs') }}" class="hover:text-white transition-colors">Our Programs</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white">{{ $page->title }}</span>
        </nav>
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 text-white/80 text-xs font-bold uppercase tracking-wider mb-5">
            Our Programs
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $page->title }}</h1>
        @if($page->short_content)
        <p class="text-white/70 text-lg max-w-2xl">{{ $page->short_content }}</p>
        @endif
    </div>
</div>

{{-- Main Page Content (if any) --}}
@if($page->content)
<section class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        <div class="prose prose-lg max-w-none prose-headings:text-[#1a3c6e] prose-a:text-[#2d6fa3] prose-img:rounded-xl">
            {!! $page->content !!}
        </div>
    </div>
</section>
@endif

{{-- Items Grid --}}
@if($page->items->count() > 0)
<section class="py-20 {{ $page->content ? 'bg-[#f8f9fc]' : 'bg-white' }}">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Explore</span>
            <h2 class="text-3xl font-black text-[#1a3c6e] uppercase tracking-wide mt-3">All Items</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($page->items as $item)
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col h-full group hover:-translate-y-1">
                {{-- Primary Image --}}
                <div class="h-52 overflow-hidden relative bg-gray-100">
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>

                <div class="p-6 flex flex-col flex-1">
                    <h3 class="text-lg font-bold text-[#1a3c6e] mb-3 leading-snug">{{ $item->title }}</h3>

                    @if($item->short_content)
                    <p class="text-gray-600 text-sm leading-relaxed flex-1 mb-5">{{ Str::limit($item->short_content, 150) }}</p>
                    @endif

                    <div class="mt-auto pt-4 border-t border-gray-50 flex items-center justify-between gap-3">
                        <a href="{{ route('donate') }}"
                           class="inline-flex items-center gap-1.5 px-4 py-2 border-2 border-[#d32f2f] text-[#d32f2f] hover:bg-red-50 rounded-full text-xs font-bold transition-colors">
                            ↗ DONATE NOW
                        </a>
                        <a href="{{ route('program-page-items.show', $item->id) }}"
                           class="inline-flex items-center gap-1.5 px-4 py-2 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-full text-xs font-bold transition-colors">
                            Read More
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="relative py-20 overflow-hidden">
    <div class="absolute inset-0 bg-[#8da83a]"></div>
    <div class="relative max-w-4xl mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Support Our Mission</h2>
        <p class="text-white/90 text-lg mb-10 max-w-2xl mx-auto">Help us continue providing education, protection, and opportunities for disadvantaged children in Cambodia.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('donate') }}" class="w-full sm:w-auto px-8 py-4 bg-white text-[#8da83a] rounded-full font-bold text-sm hover:bg-gray-50 transition-colors shadow-lg">
                DONATE NOW
            </a>
            <a href="{{ route('involved') }}" class="w-full sm:w-auto px-8 py-4 bg-[#a3c04a] text-white rounded-full font-bold text-sm hover:bg-[#b5d35b] transition-colors border border-white/20">
                GET INVOLVED
            </a>
        </div>
    </div>
</section>

@endsection
