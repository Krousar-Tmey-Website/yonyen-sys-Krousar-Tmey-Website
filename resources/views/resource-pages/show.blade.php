@extends('layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('title', $page->title . ' — Krousar Thmey')
@section('description', $page->description ?? $page->title)

@section('content')

<article class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        {{-- Breadcrumb --}}
        <nav data-reveal class="flex items-center gap-2 text-sm text-gray-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-[#1a3c6e] transition-colors">Home</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('resource-pages.index') }}" class="hover:text-[#1a3c6e] transition-colors">Topics</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-600">{{ $page->title }}</span>
        </nav>

        {{-- Header --}}
        <h1 data-reveal style="--reveal-delay: 60" class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-[#1a3c6e] leading-tight mb-8">
            {{ $page->header_text ?: $page->title }}
        </h1>

        {{-- Main picture --}}
        @if($page->detail_image)
        <div data-reveal="scale" style="--reveal-delay: 120" class="mb-8 -mx-6 md:mx-0 overflow-hidden">
            <img src="{{ $page->detail_image_url }}" alt="{{ $page->title }}" class="w-full object-cover transition-transform duration-700 ease-out hover:scale-105">
        </div>
        @endif

        {{-- Description --}}
        @if($page->detail_description)
        <div data-reveal style="--reveal-delay: 180" class="prose prose-lg max-w-none text-justify prose-p:text-gray-700 mb-8">
            {!! nl2br(e($page->detail_description)) !!}
        </div>
        @endif

        {{-- Feature Items (up to 3) --}}
        @if(!empty($page->items_for_display))
        <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($page->items_for_display as $item)
            <div data-reveal="scale" style="--reveal-delay: {{ $loop->index * 90 }}" class="bg-gray-50 rounded-xl overflow-hidden border border-gray-100">
                @if(!empty($item['image_url']))
                <div class="h-40 overflow-hidden">
                    <img src="{{ $item['image_url'] }}" alt="{{ $item['title'] ?? '' }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                </div>
                @endif
                <div class="p-4">
                    @if(!empty($item['title']))
                    <h3 class="font-bold text-gray-800 text-sm mb-1.5">{{ $item['title'] }}</h3>
                    @endif
                    @if(!empty($item['description']))
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $item['description'] }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Related News Articles (no heading — just the list) --}}
        @if($relatedArticles->isNotEmpty())
        <div data-reveal class="mt-12 pt-8 border-t border-gray-100">
            <div class="divide-y divide-gray-100">
                @foreach($relatedArticles as $article)
                <div data-reveal style="--reveal-delay: {{ min($loop->index * 70, 400) }}" class="py-6 first:pt-0">
                    <h3 class="font-bold text-[#1a3c6e] text-sm uppercase tracking-wide mb-2">
                        <a href="{{ route('news.show', $article->slug) }}" class="hover:underline">{{ $article->title }}</a>
                    </h3>
                    @if($article->excerpt)
                    <p class="text-gray-600 text-sm leading-relaxed mb-3">{{ Str::limit($article->excerpt, 220) }}</p>
                    @endif
                    <a href="{{ route('news.show', $article->slug) }}"
                       class="inline-flex items-center gap-1.5 bg-[#2d6fa3] text-white text-xs font-bold px-4 py-2 rounded-full hover:bg-[#1a4a7a] hover:-translate-y-0.5 hover:shadow-md transition-all duration-200">
                        Read More
                        <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
                @endforeach
            </div>

            @if($relatedArticles instanceof \Illuminate\Contracts\Pagination\Paginator && $relatedArticles->hasPages())
            <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-200">
                <div>
                    @if(!$relatedArticles->onFirstPage())
                    <a href="{{ $relatedArticles->previousPageUrl() }}" class="inline-flex items-center gap-1.5 text-[#2d6fa3] text-sm font-semibold hover:underline">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                        Newer Entries
                    </a>
                    @endif
                </div>
                <div>
                    @if($relatedArticles->hasMorePages())
                    <a href="{{ $relatedArticles->nextPageUrl() }}" class="inline-flex items-center gap-1.5 text-[#2d6fa3] text-sm font-semibold hover:underline">
                        Older Entries
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    @endif
                </div>
            </div>
            @endif
        </div>
        @endif

        {{-- Back --}}
        <div data-reveal class="mt-12 pt-8 border-t border-gray-100">
            <a href="{{ route('resource-pages.index') }}" class="inline-flex items-center gap-2 text-[#2d6fa3] font-medium hover:text-[#1a4a7a] transition-colors group">
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Topics
            </a>
        </div>
    </div>
</article>

@endsection
