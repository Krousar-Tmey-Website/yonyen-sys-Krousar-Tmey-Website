@extends('layouts.app')

@section('title', $article->title . ' — Krousar Thmey')
@section('description', $article->excerpt ?? 'Read the latest news from Krousar Thmey.')

@php use Illuminate\Support\Str; @endphp

@section('content')

<article class="py-12 bg-white">
    <div class="max-w-4xl mx-auto px-6">
        {{-- Breadcrumb --}}
        <nav data-reveal class="flex items-center gap-2 text-sm text-gray-400 mb-6">
            <a href="{{ route('home') }}" class="hover:text-[#1a3c6e] transition-colors">Home</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('news') }}" class="hover:text-[#1a3c6e] transition-colors">News</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-600">{{ Str::limit($article->title, 40) }}</span>
        </nav>

        {{-- Title --}}
        <h1 data-reveal style="--reveal-delay: 60" class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-[#1a3c6e] leading-tight mb-3">{{ $article->title }}</h1>

        {{-- Byline: date | tags --}}
        <div data-reveal style="--reveal-delay: 120" class="text-sm mb-8">
            <span class="text-gray-500">{{ $article->published_at?->format('F j, Y') ?? $article->created_at->format('F j, Y') }}</span>
            @if(!empty($article->tag_links))
            <span class="text-gray-300 mx-1.5">|</span>
            @foreach($article->tag_links as $tag)
                @if(!empty($tag['url']))
                <a href="{{ $tag['url'] }}" class="text-[#8da83a] hover:underline">{{ $tag['label'] }}</a>
                @else
                <span class="text-[#8da83a]">{{ $tag['label'] }}</span>
                @endif
                @if(!$loop->last)<span class="text-gray-400">,</span>@endif
            @endforeach
            @endif
        </div>

        {{-- Cover Image --}}
        @if($article->image)
        <div data-reveal="scale" style="--reveal-delay: 180" class="mb-8 overflow-hidden rounded-lg">
            <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full rounded-lg object-cover transition-transform duration-700 ease-out hover:scale-105">
        </div>
        @endif

        {{-- Content --}}
        <div class="article-content prose prose-lg max-w-none text-justify prose-p:text-gray-700 prose-headings:text-[#1a3c6e] prose-a:text-[#2d6fa3] prose-a:hover:text-[#1a4a7a] prose-img:rounded-lg">
            {!! $article->content !!}
        </div>

        {{-- Gallery --}}
        @if(!empty($article->gallery_urls))
        <div data-reveal class="mt-10 grid grid-cols-2 md:grid-cols-3 gap-3">
            @foreach($article->gallery_urls as $url)
            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer"
               data-reveal="scale" style="--reveal-delay: {{ $loop->index * 70 }}"
               class="block aspect-square rounded-lg overflow-hidden bg-gray-50 group">
                <img src="{{ $url }}" alt="{{ $article->title }} — gallery image" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </a>
            @endforeach
        </div>
        @endif

        {{-- Videos --}}
        @if(!empty($article->video_urls))
        <div data-reveal="scale" class="mt-8 flex flex-col gap-6">
            @foreach($article->video_urls as $videoUrl)
                @if(Str::contains($videoUrl, 'facebook.com'))
                <div class="relative w-full overflow-hidden rounded-lg" style="padding-top: 56.25%;">
                    <iframe
                        src="https://www.facebook.com/plugins/video.php?href={{ urlencode($videoUrl) }}&show_text=false"
                        class="absolute inset-0 w-full h-full"
                        style="border:none;overflow:hidden"
                        scrolling="no" frameborder="0"
                        allowfullscreen
                        allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                </div>
                @elseif(Str::contains($videoUrl, ['youtube.com', 'youtu.be']))
                <div class="relative w-full overflow-hidden rounded-lg" style="padding-top: 56.25%;">
                    <iframe
                        src="{{ Str::of($videoUrl)->replace('watch?v=', 'embed/')->replace('youtu.be/', 'youtube.com/embed/') }}"
                        class="absolute inset-0 w-full h-full"
                        frameborder="0" allowfullscreen
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                </div>
                @else
                <video controls class="w-full rounded-lg">
                    <source src="{{ $videoUrl }}">
                </video>
                @endif
            @endforeach
        </div>
        @endif

        {{-- Related Links --}}
        @if(!empty($article->links))
        <div data-reveal class="mt-12 pt-8 border-t border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Related Links</h3>
            <div class="flex flex-col gap-3">
                @foreach($article->links as $link)
                <a href="{{ $link['url'] }}" target="_blank" rel="noopener noreferrer"
                   data-reveal style="--reveal-delay: {{ $loop->index * 70 }}"
                   class="inline-flex items-center gap-3 px-5 py-4 bg-gray-50 rounded-lg hover:bg-gray-100 hover:-translate-y-0.5 hover:shadow-md transition-all duration-200 group">
                    <svg class="w-5 h-5 text-[#2d6fa3] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                    <div>
                        <div class="font-medium text-gray-800 group-hover:text-[#2d6fa3]">{{ $link['title'] ?? 'Link' }}</div>
                        <div class="text-sm text-gray-500 break-all">{{ $link['url'] }}</div>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 ml-auto group-hover:text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v12a2 2 0 002-2h12a2 2 0 002-2v-4M14 4h6m0 0l-3-3m3 3L20 7"/>
                    </svg>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Back to News --}}
        <div data-reveal class="mt-12 pt-8 border-t border-gray-100">
            <a href="{{ route('news') }}" class="inline-flex items-center gap-2 text-[#2d6fa3] font-medium hover:text-[#1a4a7a] transition-colors group">
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to All News
            </a>
        </div>
    </div>
</article>

@endsection
