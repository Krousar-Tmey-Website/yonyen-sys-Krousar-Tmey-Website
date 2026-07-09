@extends('layouts.app')

@section('title', $article->title . ' — Krousar Thmey')
@section('description', $article->excerpt ?? 'Read the latest news from Krousar Thmey.')

@php use Illuminate\Support\Str; @endphp

@section('content')

{{-- Page Header --}}
<div class="bg-[#1a3c6e] pt-16 pb-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/60 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('news') }}" class="hover:text-white transition-colors">News</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white">{{ Str::limit($article->title, 40) }}</span>
        </nav>
        <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ $article->title }}</h1>
        <div class="flex items-center gap-4 text-white/70 text-sm">
            <time class="flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                {{ $article->published_at?->format('F j, Y') ?? $article->created_at->format('F j, Y') }}
            </time>
            <span class="px-3 py-1 bg-white/10 rounded-full capitalize">{{ $article->category_name }}</span>
        </div>
    </div>
</div>

{{-- Article Content --}}
<article class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        @if($article->image)
        <div class="mb-10 -mx-6 md:mx-0">
            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full md:rounded-xl max-h-96 object-cover">
        </div>
        @endif

        <div class="prose prose-lg max-w-none prose-headings:text-[#1a3c6e] prose-a:text-[#2d6fa3] prose-a:hover:text-[#1a4a7a] prose-img:rounded-lg">
            {!! $article->content !!}
        </div>

        {{-- Related Links --}}
        @if(!empty($article->links))
        <div class="mt-12 pt-8 border-t border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Related Links</h3>
            <div class="flex flex-col gap-3">
                @foreach($article->links as $link)
                <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer"
                   class="inline-flex items-center gap-3 px-5 py-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-all duration-200 group">
                    <svg class="w-5 h-5 text-[#2d6fa3] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                    <div>
                        <div class="font-medium text-gray-800 group-hover:text-[#2d6fa3]">{{ $link['title'] ?? 'Link' }}</div>
                        <div class="text-sm text-gray-500 break-all">{{ $link['url'] }}</div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 ml-auto group-hover:text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-4M14 4h6m0 0l-3-3m3 3L20 7"/>
                    </svg>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Back to News --}}
        <div class="mt-12 pt-8 border-t border-gray-100">
            <a href="{{ route('news') }}" class="inline-flex items-center gap-2 text-[#2d6fa3] font-medium hover:text-[#1a4a7a] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to All News
            </a>
        </div>
    </div>
</article>

@endsection