@extends('layouts.app')

@section('title', $page->title . ' — Krousar Thmey')
@section('description', $page->short_content ?? $page->title)

@section('content')

{{-- Page Header --}}
<div class="bg-[#2d6fa3] pt-16 pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white/5 -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a]/40 translate-y-1/2 -translate-x-1/4"></div>
    <div class="relative max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/50 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('programs') }}" class="hover:text-white transition-colors">Our Programs</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/80">{{ $page->title }}</span>
        </nav>
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#e8a020]/20 border border-[#e8a020]/30 mb-4">
            <div class="w-1.5 h-1.5 rounded-full bg-[#e8a020]"></div>
            <span class="text-[#e8a020] font-semibold text-xs uppercase tracking-widest">Our Programs</span>
        </div>
        <h1 class="text-3xl md:text-4xl font-black text-white mb-0 max-w-3xl leading-tight uppercase tracking-wide">{{ $page->title }}</h1>
    </div>
</div>

{{-- Main Page Content --}}
@if($page->content)
<section class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        <div class="prose prose-sm max-w-none prose-headings:text-[#1a3c6e] prose-a:text-[#2d6fa3] prose-img:rounded-xl prose-img:max-h-64 prose-img:object-cover">
            {!! $page->content !!}
        </div>
    </div>
</section>
@endif

{{-- Items Grid --}}
@if($page->items->count() > 0)
<section class="py-14 {{ $page->content ? 'bg-[#f8f9fc]' : 'bg-white' }}">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#e8a020]/10 border border-[#e8a020]/20 mb-4">
                <div class="w-1.5 h-1.5 rounded-full bg-[#e8a020]"></div>
                <span class="text-[#e8a020] font-semibold text-xs uppercase tracking-widest">Explore</span>
            </div>
            <h2 class="text-2xl md:text-3xl font-black text-[#1a3c6e] uppercase tracking-wide">All Items</h2>
            <div class="w-12 h-1 bg-[#d32f2f] mx-auto mt-3 rounded-full"></div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($page->items as $item)
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 flex flex-col h-full group hover:-translate-y-1">
                <div class="h-44 overflow-hidden relative bg-gray-100">
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                         class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1a3c6e]/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-5 flex flex-col flex-1">
                    <h3 class="text-base font-bold text-[#1a3c6e] mb-2 leading-snug group-hover:text-[#2d6fa3] transition-colors">{{ $item->title }}</h3>
                    @if($item->short_content)
                    <p class="text-gray-500 text-sm leading-relaxed flex-1 mb-4">{{ Str::limit($item->short_content, 120) }}</p>
                    @endif
                    <div class="mt-auto pt-3 border-t border-gray-100 flex items-center justify-between gap-3">
                        <a href="{{ route('donate') }}"
                           class="inline-flex items-center gap-1 text-[#d32f2f] text-xs font-bold hover:text-red-700 transition-colors">
                            ↗ Donate
                        </a>
                        <a href="{{ route('program-page-items.show', $item->id) }}"
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-full text-xs font-bold transition-colors">
                            Read More
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
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
<section class="relative py-16 overflow-hidden bg-[#1a3c6e]">
    <div class="absolute top-0 right-0 w-80 h-80 rounded-full bg-[#2d6fa3]/20 -translate-y-1/2 translate-x-1/4"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a]/10 translate-y-1/2 -translate-x-1/4"></div>
    <div class="relative max-w-4xl mx-auto px-6 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#8da83a]/20 border border-[#8da83a]/30 mb-5">
            <div class="w-1.5 h-1.5 rounded-full bg-[#8da83a]"></div>
            <span class="text-[#8da83a] font-semibold text-xs uppercase tracking-widest">Support Our Mission</span>
        </div>
        <h2 class="text-2xl md:text-3xl font-black text-white uppercase tracking-wide mb-3">Help Children in Cambodia</h2>
        <p class="text-white/60 text-sm mb-8 max-w-xl mx-auto leading-relaxed">Help us continue providing education, protection, and opportunities for disadvantaged children in Cambodia.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('donate') }}" class="btn-primary">Donate Now</a>
            <a href="{{ route('involved') }}" class="btn-outline">Get Involved</a>
        </div>
    </div>
</section>

@endsection
