@extends('layouts.app')

@section('title', 'Topics — Krousar Thmey')
@section('description', 'Explore Krousar Thmey\'s work across Cambodia, child welfare, education, culture, and more.')

@section('content')

{{-- Page Header --}}
<div class="bg-[#2d6fa3] pt-16 pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white/5 -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a]/40 translate-y-1/2 -translate-x-1/4"></div>
    <div class="relative max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/50 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/80">Topics</span>
        </nav>
        <h1 class="text-3xl md:text-4xl font-black text-white mb-3 uppercase tracking-wide">Topics</h1>
        <p class="text-white/60 text-base max-w-2xl leading-relaxed">Explore Krousar Thmey's work across Cambodia and around the world.</p>
    </div>
</div>

{{-- Cards --}}
<section class="bg-[#f8f9fc] py-14">
    <div class="max-w-7xl mx-auto px-6">
        @if($pages->isEmpty())
        <div class="text-center py-20 text-gray-400">
            <p class="text-lg font-semibold text-gray-500 mb-2">No topics yet</p>
            <p class="text-sm">Check back soon.</p>
        </div>
        @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($pages as $page)
            <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg border border-gray-100 flex flex-col group hover:-translate-y-1 transition-all duration-300">
                @if($page->image)
                <a href="{{ route('resource-pages.show', $page->slug) }}" class="relative overflow-hidden h-40 block">
                    <img src="{{ $page->image_url }}" alt="{{ $page->title }}"
                         class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                </a>
                @endif
                <div class="p-5 flex flex-col flex-1">
                    <h3 class="font-bold text-gray-800 text-base mb-2 leading-snug">
                        <a href="{{ route('resource-pages.show', $page->slug) }}" class="group-hover:text-[#1a3c6e] transition-colors">{{ $page->title }}</a>
                    </h3>
                    @if($page->description)
                    <p class="text-gray-500 text-sm leading-relaxed mb-4 flex-1">{{ $page->description }}</p>
                    @else
                    <div class="flex-1"></div>
                    @endif
                    <div class="mt-auto pt-3 border-t border-gray-100">
                        <a href="{{ route('resource-pages.show', $page->slug) }}" class="inline-flex items-center gap-1.5 text-[#2d6fa3] text-xs font-bold group-hover:gap-2.5 transition-all">
                            View Detail
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        @endif
    </div>
</section>

@endsection
