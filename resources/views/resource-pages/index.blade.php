@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('title', 'Topics — Krousar Thmey')
@section('description', 'Explore Krousar Thmey\'s work across Cambodia, child welfare, education, culture, and more.')

@section('content')

{{-- Page Header --}}
<div class="bg-[#2d6fa3] pt-16 pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white/5 -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a]/40 translate-y-1/2 -translate-x-1/4"></div>
    <div class="relative max-w-7xl mx-auto px-6">
        <nav data-reveal class="flex items-center gap-2 text-sm text-white/50 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/80">Topics</span>
        </nav>
        <h1 data-reveal style="--reveal-delay: 60" class="text-3xl md:text-4xl font-black text-white mb-3 uppercase tracking-wide">Topics</h1>
        <p data-reveal style="--reveal-delay: 120" class="text-white/60 text-base max-w-2xl leading-relaxed">Explore Krousar Thmey's work across Cambodia and around the world.</p>
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
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-7">
            @foreach($pages as $page)
            <article data-reveal="scale" style="--reveal-delay: {{ min($loop->index * 80, 480) }}"
                      class="topic-card group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl border border-gray-100 hover:border-[#2d6fa3]/20 flex flex-col hover:-translate-y-2 transition-all duration-500">
                @if($page->image)
                <a href="{{ route('resource-pages.show', $page->slug) }}" class="relative overflow-hidden h-48 block bg-gray-100">
                    <img src="{{ $page->image_url }}" alt="{{ $page->localized_title }}"
                         class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-700 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/0 to-black/0 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    @if(($page->article_count ?? 0) > 0)
                    <span class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm text-[#1a3c6e] text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                        {{ $page->article_count }} {{ Str::plural('article', $page->article_count) }}
                    </span>
                    @endif
                </a>
                @endif
                <div class="p-6 flex flex-col flex-1">
                    <h3 class="font-extrabold text-gray-800 text-lg mb-2 leading-snug">
                        <a href="{{ route('resource-pages.show', $page->slug) }}" class="group-hover:text-[#1a3c6e] transition-colors">{{ $page->localized_title }}</a>
                    </h3>
                    @if($page->localized_description)
                    <p class="text-gray-500 text-sm leading-relaxed mb-5 flex-1">{{ $page->localized_description }}</p>
                    @else
                    <div class="flex-1"></div>
                    @endif
                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <a href="{{ route('resource-pages.show', $page->slug) }}"
                           class="inline-flex items-center gap-1.5 text-[#2d6fa3] text-sm font-bold group-hover:gap-3 transition-all">
                            View Detail
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
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
