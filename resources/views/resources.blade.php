@extends('layouts.app')

@section('title', 'Resources — Krousar Thmey')
@section('description', 'Access Krousar Thmey\'s annual reports, media resources, and publications.')

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
            <span class="text-white">Resources</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Resources</h1>
        <p class="text-white/70 text-lg max-w-2xl">Annual reports, publications, and media resources from Krousar Thmey.</p>
    </div>
</div>

{{-- Annual Reports --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Accountability</span>
            <h2 class="section-title mt-3 mb-3">Annual Reports</h2>
            <p class="text-gray-500">Full reports on our programs, financials, and impact — published every year since 1991.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($reports as $report)
                <div class="bg-[#f8f9fc] rounded-2xl p-7 border border-gray-100 hover:shadow-md transition-shadow group flex flex-col gap-5">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-xl bg-[#1a3c6e] flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div class="flex-1">
                            <div class="font-bold text-[#1a3c6e]">{{ $report->title }}</div>
                            <div class="text-gray-400 text-xs mt-0.5">{{ $report->year }} · PDF Report</div>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @if ($report->has_pdf_file)
                            <a href="{{ route('reports.view', $report) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center rounded-lg border border-[#1a3c6e] px-3 py-2 text-sm font-semibold text-[#1a3c6e] hover:bg-[#1a3c6e] hover:text-white transition-colors">
                                View PDF
                            </a>
                            <a href="{{ route('reports.download', $report) }}" class="inline-flex items-center justify-center rounded-lg bg-[#e8a020] px-3 py-2 text-sm font-semibold text-white hover:bg-[#c7830d] transition-colors">
                                Download PDF
                            </a>
                        @else
                            <p class="text-sm text-gray-500">No PDF file available.</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="md:col-span-2 lg:col-span-3 rounded-2xl border border-dashed border-gray-200 bg-gray-50 p-8 text-center text-gray-500">
                    No annual reports are available yet.
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- 🌐 MEDIA — REDESIGNED TO MATCH KROUSAR-THMEY.ORG/MEDIA --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        {{-- ============================== --}}
        {{-- SECTION HEADER - MEDIA TITLE  --}}
        {{-- ============================== --}}
        <div class="text-center mb-16">
            <h1 class="text-5xl md:text-6xl font-bold text-[#1a4fa0] mb-6 tracking-tight">MEDIA</h1>

            {{-- Social share icons --}}
            <div class="flex items-center justify-center gap-3 mb-6">
                <a href="https://www.facebook.com/KrousarThmey/" target="_blank" rel="noopener noreferrer"
                   class="w-10 h-10 rounded-full bg-[#1a4fa0]/10 hover:bg-[#1a4fa0] text-[#1a4fa0] hover:text-white flex items-center justify-center transition-all duration-200">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="https://twitter.com/krousarthmey" target="_blank" rel="noopener noreferrer"
                   class="w-10 h-10 rounded-full bg-[#1a4fa0]/10 hover:bg-[#1a4fa0] text-[#1a4fa0] hover:text-white flex items-center justify-center transition-all duration-200">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="https://www.linkedin.com/company/krousar-thmey/" target="_blank" rel="noopener noreferrer"
                   class="w-10 h-10 rounded-full bg-[#1a4fa0]/10 hover:bg-[#1a4fa0] text-[#1a4fa0] hover:text-white flex items-center justify-center transition-all duration-200">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
                <button onclick="if(navigator.share){navigator.share({title:'Krousar Thmey Media',url:window.location.href})}else{navigator.clipboard.writeText(window.location.href);this.classList.add('bg-green-500','text-white');setTimeout(()=>this.classList.remove('bg-green-500','text-white'),1500)}"
                   class="w-10 h-10 rounded-full bg-[#1a4fa0]/10 hover:bg-[#1a4fa0] text-[#1a4fa0] hover:text-white flex items-center justify-center transition-all duration-200 cursor-pointer"
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                </button>
            </div>

            <p class="text-gray-600 text-sm max-w-2xl mx-auto leading-relaxed">
                For any request, please contact our Communication Officer at
                <a href="mailto:communication@krousar-thmey.org" class="text-[#1a4fa0] font-semibold hover:underline">communication@krousar-thmey.org</a>
            </p>
        </div>

        {{-- ============================== --}}
        {{-- KROUSAR THMEY IN THE NEWS    --}}
        {{-- ============================== --}}
        @if($featuredArticle)
        <div class="mb-20">
            <h3 class="text-[#1a4fa0] font-bold text-sm uppercase tracking-[0.15em] mb-8">Krousar Thmey in the News</h3>

            <div class="bg-white border border-gray-200 overflow-hidden">
                <div class="grid md:grid-cols-2 gap-0">
                    {{-- Image side --}}
                    <div class="relative h-72 md:h-full min-h-[320px] overflow-hidden bg-gray-100">
                        <img src="{{ $featuredArticle->image_url }}"
                             alt="{{ $featuredArticle->title }}"
                             class="absolute inset-0 w-full h-full object-cover">
                        @if($featuredArticle->image_caption)
                        <p class="absolute bottom-0 left-0 right-0 bg-black/60 text-white text-xs px-4 py-2">
                            {{ $featuredArticle->image_caption }}
                        </p>
                        @endif
                    </div>

                    {{-- Content side --}}
                    <div class="p-8 lg:p-10 xl:p-12 flex flex-col justify-center">
                        @if($featuredArticle->category)
                        <div class="text-[#1a4fa0] text-xs font-bold uppercase tracking-[0.12em] mb-5">
                            PRESS ARTICLE / {{ strtoupper($featuredArticle->category) }}
                        </div>
                        @endif

                        <h4 class="text-2xl lg:text-3xl font-bold text-[#1a4fa0] leading-tight mb-4">
                            &ldquo;{{ $featuredArticle->title }}&rdquo;
                        </h4>

                        <p class="text-gray-500 italic text-sm mb-6">
                            published {{ $featuredArticle->published_at?->format('m.d.y') ?? $featuredArticle->created_at->format('m.d.y') }}
                        </p>

                        <hr class="border-gray-200 mb-6">

                        <p class="text-gray-600 italic leading-relaxed mb-8 line-clamp-4">
                            {{ $featuredArticle->excerpt ?? Str::limit(strip_tags($featuredArticle->content ?? ''), 300) }}
                        </p>

                        <a href="{{ route('news.show', $featuredArticle->slug) }}"
                           class="inline-flex items-center justify-center px-6 py-3 bg-[#1a4fa0] hover:bg-[#0e3470] text-white text-sm font-semibold transition-colors w-fit">
                            Read the article
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- ======================= --}}
        {{-- LATEST NEWS            --}}
        {{-- ======================= --}}
        @if($latestNews->isNotEmpty())
        <div>
            <h3 class="text-[#1a4fa0] font-bold text-sm uppercase tracking-[0.15em] mb-2">Latest News</h3>
            <p class="text-gray-500 text-sm mb-8">
                Visit our <a href="{{ route('news') }}" class="text-[#1a4fa0] font-semibold hover:underline">News section</a> to find more of Krousar Thmey's news
            </p>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($latestNews as $index => $article)
                <article class="border border-gray-200 bg-white flex flex-col">
                    @if($article->image_url)
                    <div class="relative h-48 overflow-hidden bg-gray-100">
                        <img src="{{ $article->image_url }}"
                             alt="{{ $article->title }}"
                             class="w-full h-full object-cover">
                    </div>
                    @endif

                    <div class="p-6 flex flex-col flex-1">
                        <h4 class="font-bold text-[#1a4fa0] text-base leading-snug mb-3 line-clamp-2">
                            {{ $article->title }}
                        </h4>

                        <div class="text-gray-500 text-xs mb-3">
                            {{ $article->published_at?->format('M j, Y') ?? $article->created_at->format('M j, Y') }}
                            @if($article->category)
                            <span class="text-gray-300 mx-1.5">|</span>
                            {{ $article->category }}
                            @endif
                        </div>

                        <p class="text-gray-700 text-sm leading-relaxed flex-1 line-clamp-3 mb-4">
                            {{ $article->excerpt ?? Str::limit(strip_tags($article->content ?? ''), 150) }}
                        </p>

                        <a href="{{ route('news.show', $article->slug) }}"
                           class="text-[#1a4fa0] font-semibold text-sm hover:underline">
                            read more
                        </a>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        @endif



        {{-- Fallback when nothing exists --}}
        @if(!$featuredArticle && $latestNews->isEmpty())
        <div class="text-center py-16">
            <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-5">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-400 mb-2">No resources yet</h3>
            <p class="text-gray-400 text-sm max-w-md mx-auto">Check back soon for news articles, annual reports, and publications from Krousar Thmey.</p>
            <a href="{{ route('contact') }}" class="inline-flex items-center gap-2 text-[#1a4fa0] font-semibold text-sm mt-5 hover:underline">
                Contact us for more information
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        @endif

    </div>
</section>

@endsection
