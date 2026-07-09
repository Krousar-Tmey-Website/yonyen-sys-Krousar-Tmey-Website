@extends('layouts.app')

@section('title', 'News — Krousar Thmey')
@section('description', 'Latest news, success stories, and updates from Krousar Thmey\'s programs in Cambodia.')

@section('content')

{{-- Page Header --}}
<div class="bg-[#2d6fa3] pt-16 pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white/5 -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a]/40 translate-y-1/2 -translate-x-1/4"></div>
    <div class="relative max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/50 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/80">News</span>
        </nav>
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#e8a020]/20 border border-[#e8a020]/30 mb-4">
            <div class="w-1.5 h-1.5 rounded-full bg-[#e8a020]"></div>
            <span class="text-[#e8a020] font-semibold text-xs uppercase tracking-widest">Krousar Thmey</span>
        </div>
        <h1 class="text-3xl md:text-4xl font-black text-white mb-3 uppercase tracking-wide">News &amp; Stories</h1>
        <p class="text-white/60 text-base max-w-2xl leading-relaxed">Updates from our programs, success stories from our beneficiaries, and events from Krousar Thmey.</p>
    </div>
</div>

{{-- Filter Tabs --}}
@php $categories = $articles->pluck('category')->unique()->sort()->values(); @endphp
<section class="bg-white border-b border-gray-100 sticky top-[64px] lg:top-[80px] z-40"
         x-data="{ active: 'all' }">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center gap-1 overflow-x-auto py-3 scrollbar-hide">
            <button @click="active = 'all'"
                    :class="active === 'all' ? 'bg-[#2d6fa3] text-white' : 'text-gray-600 hover:bg-gray-50'"
                    class="px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200 flex-shrink-0">
                All News
            </button>
            @foreach($categories as $cat)
            <button @click="active = '{{ $cat }}'"
                    :class="active === '{{ $cat }}' ? 'bg-[#2d6fa3] text-white' : 'text-gray-600 hover:bg-gray-50'"
                    class="px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200 flex-shrink-0 capitalize">
                {{ str_replace('-', ' ', $cat) }}
            </button>
            @endforeach
        </div>
    </div>

    {{-- News Grid --}}
    <div class="bg-[#f8f9fc] py-14">
        <div class="max-w-7xl mx-auto px-6">
            @if($articles->isEmpty())
            <div class="text-center py-20 text-gray-400">
                <svg class="w-12 h-12 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                <p class="text-lg font-semibold text-gray-500 mb-2">No articles yet</p>
                <p class="text-sm">Check back soon for news and updates.</p>
            </div>
            @else
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($articles as $article)
                <article class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg border border-gray-100 flex flex-col group hover:-translate-y-1 transition-all duration-300"
                         x-show="active === 'all' || active === '{{ $article->category }}'"
                         x-transition>
                    <div class="relative overflow-hidden h-44">
                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                             class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                        <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-[#1a3c6e] text-xs font-bold px-3 py-1 rounded-full capitalize">{{ str_replace('-', ' ', $article->category) }}</span>
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <time class="text-gray-400 text-xs mb-2 flex items-center gap-1.5">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            {{ $article->published_at?->format('F Y') ?? $article->created_at->format('F Y') }}
                        </time>
                        <h3 class="font-bold text-gray-800 text-base mb-2 leading-snug group-hover:text-[#1a3c6e] transition-colors">{{ $article->title }}</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-4 flex-1">{{ Str::limit($article->excerpt, 120) }}</p>
                        <div class="mt-auto pt-3 border-t border-gray-100">
                            <span class="inline-flex items-center gap-1.5 text-[#2d6fa3] text-xs font-bold group-hover:gap-2.5 transition-all">
                                Read More
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </span>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>

{{-- Newsletter CTA --}}
<section class="py-14 bg-white border-t border-gray-100">
    <div class="max-w-2xl mx-auto px-6 text-center">
        <h2 class="text-2xl font-bold text-[#1a3c6e] mb-3">Stay Updated</h2>
        <p class="text-gray-500 mb-8">Subscribe to our newsletter for the latest stories and updates from Cambodia.</p>
        <form class="flex gap-3 max-w-md mx-auto" onsubmit="return false;">
            <input type="email" placeholder="Enter your email address"
                   class="flex-1 px-5 py-3 rounded-full border border-gray-200 focus:outline-none focus:border-[#1a3c6e] text-sm transition-colors">
            <button type="submit" class="btn-blue flex-shrink-0 rounded-full">Subscribe</button>
        </form>
    </div>
</section>

@endsection