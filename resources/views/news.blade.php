@extends('layouts.app')

@section('title', 'News — Krousar Thmey')
@section('description', 'Latest news, success stories, and updates from Krousar Thmey\'s programs in Cambodia.')

@section('content')

{{-- Page Header --}}
<div class="bg-[#1a3c6e] pt-16 pb-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/60 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white">News</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">News &amp; Stories</h1>
        <p class="text-white/70 text-lg max-w-2xl">Updates from our programs, success stories from our beneficiaries, and events from Krousar Thmey.</p>
    </div>
</div>

{{-- Filter Tabs --}}
@php
$categories = $articles->pluck('category')->unique()->sort()->values();
@endphp
<section class="bg-white border-b border-gray-100 sticky top-[64px] lg:top-[80px] z-40"
         x-data="{ active: 'all' }">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center gap-1 overflow-x-auto py-3 scrollbar-hide">
            <button @click="active = 'all'"
                    :class="active === 'all' ? 'bg-[#1a3c6e] text-white' : 'text-gray-600 hover:bg-gray-50'"
                    class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-200 flex-shrink-0">
                All News
            </button>
            @foreach($categories as $cat)
            <button @click="active = '{{ $cat }}'"
                    :class="active === '{{ $cat }}' ? 'bg-[#1a3c6e] text-white' : 'text-gray-600 hover:bg-gray-50'"
                    class="px-5 py-2 rounded-full text-sm font-medium transition-all duration-200 flex-shrink-0 capitalize">
                {{ str_replace('-', ' ', $cat) }}
            </button>
            @endforeach
        </div>
    </div>
</section>

{{-- News Grid --}}
<section class="py-16 bg-[#f8f9fc]">
    <div class="max-w-7xl mx-auto px-6">
        @if($articles->isEmpty())
        <div class="text-center py-20 text-gray-400">
            <svg class="w-12 h-12 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            <p class="text-lg font-semibold text-gray-500 mb-2">No articles yet</p>
            <p class="text-sm">Check back soon for news and updates.</p>
        </div>
        @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" x-data="{ active: 'all' }">
            @foreach($articles as $article)
            <article class="card group flex flex-col"
                     x-show="active === 'all' || active === '{{ $article->category }}'"
                     x-transition>
                <div class="relative overflow-hidden h-52">
                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-[#1a3c6e] text-xs font-semibold px-3 py-1 rounded-full capitalize">{{ str_replace('-', ' ', $article->category) }}</span>
                </div>
                <div class="p-6 flex flex-col flex-1">
                    <time class="text-gray-400 text-xs mb-3 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $article->published_at?->format('F Y') ?? $article->created_at->format('F Y') }}
                    </time>
                    <h3 class="font-bold text-gray-800 text-lg mb-3 leading-snug group-hover:text-[#1a3c6e] transition-colors flex-1">{{ $article->title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed mb-5">{{ $article->excerpt }}</p>
                    <span class="text-[#1a3c6e] font-semibold text-sm flex items-center gap-1.5 mt-auto">
                        Read More
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </span>
                </div>
            </article>
            @endforeach
        </div>
        @endif
    </div>
</section>

@endsection
