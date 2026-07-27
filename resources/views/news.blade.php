@extends('layouts.app')

@section('title', 'News — Krousar Thmey')
@section('description', 'Latest news, success stories, and updates from Krousar Thmey\'s programs in Cambodia.')

@section('content')

{{-- ========================================================
     NEWS BANNER
     ======================================================== --}}
@php
    $newsBannerImage = $settings['news_banner_image'] ?? null;
    $newsBannerImageUrl = $newsBannerImage ? (str_starts_with($newsBannerImage, 'http') ? $newsBannerImage : asset('storage/' . $newsBannerImage)) : null;
    $newsBannerOverlay = $settings['news_banner_overlay_color'] ?? '#1a3c6e';
    $newsBannerBadge = $settings['news_banner_badge'] ?? 'Krousar Thmey';
    $newsBannerTitle = $settings['news_banner_title'] ?? "Krousar Thmey's news, in Cambodia and around the world";
    $newsBannerSubtitle = $settings['news_banner_subtitle'] ?? 'Updates from our programs, success stories from our beneficiaries, and events from Krousar Thmey.';
    $newsBtn1Text = $settings['news_banner_btn1_text'] ?? null;
    $newsBtn1Url  = $settings['news_banner_btn1_url'] ?? null;
    $newsBtn2Text = $settings['news_banner_btn2_text'] ?? null;
    $newsBtn2Url  = $settings['news_banner_btn2_url'] ?? null;
    $newsBtn3Text = $settings['news_banner_btn3_text'] ?? null;
    $newsBtn3Url  = $settings['news_banner_btn3_url'] ?? null;
@endphp

<section id="news-banner" class="relative pt-24 pb-28 md:pb-32 overflow-hidden"
         style="background-color: {{ $newsBannerOverlay }};">
    {{-- Background image --}}
    @if($newsBannerImageUrl)
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ $newsBannerImageUrl }}'); opacity: 0.4;"></div>
    @endif

    {{-- Decorative circles --}}
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white/5 -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a]/40 translate-y-1/2 -translate-x-1/4"></div>

    <div class="relative max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/50 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/80">News</span>
        </nav>

        <div data-reveal class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#e8a020]/20 border border-[#e8a020]/30 mb-4">
            <div class="w-1.5 h-1.5 rounded-full bg-[#e8a020]"></div>
            <span class="text-[#e8a020] font-semibold text-xs uppercase tracking-widest">{{ $newsBannerBadge }}</span>
        </div>
        <h1 data-reveal style="--reveal-delay: 60" class="text-3xl md:text-4xl font-black text-white mb-3 uppercase tracking-wide max-w-3xl">{{ $newsBannerTitle }}</h1>
        @if($newsBannerSubtitle)
        <p data-reveal style="--reveal-delay: 120" class="text-white/60 text-base max-w-2xl leading-relaxed">{{ $newsBannerSubtitle }}</p>
        @endif

        @if($newsBtn1Text)
        <div data-reveal style="--reveal-delay: 180" class="flex flex-wrap gap-4 mt-8">
            <a href="{{ $newsBtn1Url ?? route('donate') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#8da83a] text-white hover:bg-[#a3c04a] text-sm font-bold transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                {{ $newsBtn1Text }}
            </a>
            @if($newsBtn2Text)
            <a href="{{ $newsBtn2Url ?? route('get-involved') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full border-2 border-white/30 text-white hover:border-white hover:bg-white/10 text-sm font-bold transition-all duration-300">
                {{ $newsBtn2Text }}
            </a>
            @endif
            @if($newsBtn3Text)
            <a href="{{ $newsBtn3Url ?? route('resources') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full border-2 border-white/30 text-white hover:border-white hover:bg-white/10 text-sm font-bold transition-all duration-300">
                {{ $newsBtn3Text }}
            </a>
            @endif
        </div>
        @endif
    </div>
</section>

{{-- News Grid --}}
<section class="bg-[#f8f9fc] py-14">
    <div class="max-w-7xl mx-auto px-6">
        @if($activeTag ?? null)
        <div data-reveal class="flex items-center flex-wrap gap-2 mb-8 text-sm">
            <span class="text-gray-500">Showing articles tagged</span>
            <span class="inline-flex items-center gap-1.5 bg-[#2d6fa3]/10 text-[#2d6fa3] font-semibold px-3 py-1 rounded-full">{{ $activeTag }}</span>
            <a href="{{ route('news') }}" class="text-gray-400 hover:text-[#2d6fa3] font-medium inline-flex items-center gap-1 transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                Clear filter
            </a>
        </div>
        @endif
        @if($articles->isEmpty())
        <div class="text-center py-20 text-gray-400">
            <svg class="w-12 h-12 mx-auto mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            <p class="text-lg font-semibold text-gray-500 mb-2">{{ ($activeTag ?? null) ? 'No articles found for this tag' : 'No articles yet' }}</p>
            <p class="text-sm">{{ ($activeTag ?? null) ? 'Try clearing the filter to see all news.' : 'Check back soon for news and updates.' }}</p>
        </div>
        @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($articles as $article)
            <article data-reveal="scale" style="--reveal-delay: {{ min($loop->index * 80, 480) }}" class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg border border-gray-100 flex flex-col group hover:-translate-y-1 transition-all duration-300">
                @if($article->image)
                <a href="{{ route('news.show', $article->slug) }}" class="relative overflow-hidden h-44 block">
                    <img src="{{ $article->image_url }}" alt="{{ $article->localized_title }}"
                         class="w-full h-full object-cover object-center group-hover:scale-105 transition-transform duration-500">
                </a>
                @endif
                <div class="p-5 flex flex-col flex-1">
                    <h3 class="font-bold text-gray-800 text-base mb-1.5 leading-snug">
                        <a href="{{ route('news.show', $article->slug) }}" class="group-hover:text-[#1a3c6e] transition-colors">{{ $article->localized_title }}</a>
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
                            @php $topicPage = $topicPagesByTitle[strtolower($tag['label'])] ?? null; @endphp
                            <a href="{{ $topicPage ? route('resource-pages.show', $topicPage->slug) : (!empty($tag['url']) ? $tag['url'] : route('news', ['tag' => $tag['label']])) }}" class="text-[#2d6fa3] hover:underline">{{ $tag['label'] }}</a>
                            @if(!$loop->last)<span class="text-gray-400">,</span> @endif
                        @endforeach
                        @endif
                    </p>
                    <p class="text-gray-500 text-sm leading-relaxed mb-4 flex-1">{{ Str::limit(strip_tags($article->localized_excerpt ?? ''), 120) }}</p>
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
