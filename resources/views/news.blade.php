@extends('layouts.app')

@section('title', 'News — Krousar Thmey')
@section('description', 'Latest news, success stories, and updates from Krousar Thmey\'s programs in Cambodia.')

@section('content')

{{-- Page Header --}}
<div class="bg-[#2d6fa3] pt-16 pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white/5 -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a]/40 translate-y-1/2 -translate-x-1/4"></div>
    <div class="relative max-w-7xl mx-auto px-6">
        <nav data-reveal class="flex items-center gap-2 text-sm text-white/50 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/80">News</span>
        </nav>
        <div data-reveal style="--reveal-delay: 60" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#e8a020]/20 border border-[#e8a020]/30 mb-4">
            <div class="w-1.5 h-1.5 rounded-full bg-[#e8a020]"></div>
            <span class="text-[#e8a020] font-semibold text-xs uppercase tracking-widest">Krousar Thmey</span>
        </div>
        <h1 data-reveal style="--reveal-delay: 120" class="text-3xl md:text-4xl font-black text-white mb-3 uppercase tracking-wide">Krousar Thmey's news, in Cambodia and around the world</h1>
        <p data-reveal style="--reveal-delay: 180" class="text-white/60 text-base max-w-2xl leading-relaxed">Updates from our programs, success stories from our beneficiaries, and events from Krousar Thmey.</p>
    </div>
</div>

{{-- News Grid --}}
<section class="bg-[#f8f9fc] py-14">
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
            <article data-reveal="scale" style="--reveal-delay: {{ min($loop->index * 80, 480) }}" class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg border border-gray-100 flex flex-col group hover:-translate-y-1 transition-all duration-300">
                @if($article->image)
                <a href="{{ route('news.show', $article->slug) }}" class="relative overflow-hidden h-44 block bg-gray-50">
                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                         class="w-full h-full object-contain object-center group-hover:scale-105 transition-transform duration-500">
                </a>
                @endif
                <div class="p-5 flex flex-col flex-1">
                    <h3 class="font-bold text-gray-800 text-base mb-1.5 leading-snug">
                        <a href="{{ route('news.show', $article->slug) }}" class="group-hover:text-[#1a3c6e] transition-colors">{{ $article->title }}</a>
                    </h3>
                    <p class="text-xs mb-3 leading-relaxed">
                        <span class="text-gray-500">by</span>
                        @if($krousarThmeyPage ?? null)
                        <a href="{{ route('resource-pages.show', $krousarThmeyPage->slug) }}" class="text-[#2d6fa3] font-semibold hover:underline">Krousar Thmey</a>
                        @else
                        <span class="text-[#2d6fa3] font-semibold">Krousar Thmey</span>
                        @endif
                        <span class="text-gray-300 mx-1">|</span>
                        <span class="text-gray-500">{{ $article->published_at?->format('M j, Y') ?? $article->created_at->format('M j, Y') }}</span>
                        @if(!empty($article->tag_links))
                        <span class="text-gray-300 mx-1">|</span>
                        @foreach($article->tag_links as $tag)
                            @if(!empty($tag['url']))
                            <a href="{{ $tag['url'] }}" class="text-[#2d6fa3] hover:underline">{{ $tag['label'] }}</a>
                            @else
                            <span class="text-[#2d6fa3]">{{ $tag['label'] }}</span>
                            @endif
                            @if(!$loop->last)<span class="text-gray-400">,</span> @endif
                        @endforeach
                        @endif
                    </p>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4 flex-1">{{ Str::limit($article->excerpt, 120) }}</p>
                    <div class="mt-auto pt-3 border-t border-gray-100">
                        <a href="{{ route('news.show', $article->slug) }}" class="inline-flex items-center gap-1.5 text-[#2d6fa3] text-xs font-bold group-hover:gap-2.5 transition-all">
                            Read More
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($articles->hasPages())
        <div data-reveal class="flex items-center justify-between mt-10 pt-6 border-t border-gray-200">
            <div>
                @if(!$articles->onFirstPage())
                <a href="{{ $articles->previousPageUrl() }}" class="inline-flex items-center gap-1.5 text-[#2d6fa3] text-sm font-semibold hover:underline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                    Newer Entries
                </a>
                @endif
            </div>
            <div>
                @if($articles->hasMorePages())
                <a href="{{ $articles->nextPageUrl() }}" class="inline-flex items-center gap-1.5 text-[#2d6fa3] text-sm font-semibold hover:underline">
                    Older Entries
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </a>
                @endif
            </div>
        </div>
        @endif
        @endif
    </div>
</section>

{{-- Newsletter CTA --}}
<section class="py-14 bg-white border-t border-gray-100">
    <div data-reveal class="max-w-2xl mx-auto px-6 text-center">
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
