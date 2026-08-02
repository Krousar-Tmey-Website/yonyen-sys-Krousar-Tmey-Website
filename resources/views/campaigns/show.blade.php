@extends('layouts.app')

@section('title', $campaign->localized_title . ' — ' . ($settings['site_name'] ?? 'Krousar Thmey'))
@section('description', $campaign->excerpt(160))

@section('content')

@php
$embedUrl = $campaign->video_embed_url;
$isPdf = $campaign->has_file && Str::endsWith(Str::lower($campaign->file), '.pdf');
@endphp

{{-- ── Header ─────────────────────────────────────────────── --}}
<section class="relative overflow-hidden bg-[#1d4e7a] min-h-[520px]">
    @if($banner['image'])
    <div class="absolute inset-0 bg-cover bg-center hero-media-drift"
        style="background-image: url('{{ $banner['image'] }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-[#12324f]/95 via-[#1d4e7a]/85 to-[#1d4e7a]/40"></div>
    @endif

    {{-- Animated decorative orbs --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full hero-float-slow"
            style="background: radial-gradient(circle, rgba(255,255,255,0.10) 0%, transparent 70%);"></div>
        <div class="absolute -bottom-32 -left-32 w-[30rem] h-[30rem] rounded-full hero-float-delayed"
            style="background: radial-gradient(circle, rgba(255,255,255,0.07) 0%, transparent 70%);"></div>
        <div class="absolute top-1/3 left-1/4 w-48 h-48 rounded-full hero-pulse"
            style="background: radial-gradient(circle, rgba(141,168,58,0.20) 0%, transparent 70%);"></div>
        <div class="absolute bottom-1/4 right-1/4 w-40 h-40 rounded-full hero-float-slow"
            style="animation-delay: 4s; background: radial-gradient(circle, rgba(238,169,29,0.15) 0%, transparent 70%);">
        </div>
    </div>

    <div class="relative">
        <div class="max-w-7xl mx-auto px-6 w-full pt-28 pb-20 lg:pt-32 lg:pb-24">
            <nav data-reveal class="flex items-center flex-wrap gap-2 text-sm text-white/50 mb-8">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ __('Home') }}</a>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('campaigns.index') }}" class="hover:text-white transition-colors">{{
                    __('Campaigns') }}</a>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-white/80 truncate max-w-[16rem]">{{ $campaign->localized_title }}</span>
            </nav>

            <div class="max-w-3xl">
                @if($campaign->year)
                <div data-reveal style="--reveal-delay: 60"
                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#8da83a]/25 border border-[#8da83a]/40 mb-5">
                    <svg class="w-3.5 h-3.5 text-[#cfe08a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="text-[#cfe08a] font-bold text-xs uppercase tracking-widest">{{ $campaign->year
                        }}</span>
                </div>
                @endif

                <h1 data-reveal style="--reveal-delay: 120"
                    class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-[1.08] mb-5">
                    {{ $campaign->localized_title }}
                </h1>

                @if($campaign->localized_description)
                <div data-reveal style="--reveal-delay: 180"
                    class="max-w-2xl text-white/70 text-base md:text-lg leading-relaxed">
                    {{ $campaign->excerpt(200) }}
                </div>
                @endif

                <div data-reveal style="--reveal-delay: 240" class="flex flex-wrap items-center gap-3 mt-8">
                    <a href="{{ route('donate') }}"
                        class="inline-flex items-center gap-2 bg-[#8da83a] hover:bg-[#a3c04a] text-white px-7 py-3.5 rounded-full font-semibold text-sm shadow-lg shadow-black/20 hover:shadow-xl hover:-translate-y-0.5 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        {{ __('Donate Now') }}
                    </a>
                    <a href="{{ route('campaigns.index') }}"
                        class="inline-flex items-center gap-2 border border-white/25 hover:border-white/50 hover:bg-white/10 text-white px-6 py-3.5 rounded-full font-semibold text-sm transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M15 19l-7-7 7-7" />
                        </svg>
                        {{ __('All Campaigns') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll cue --}}
    <a href="#campaign-detail" data-reveal style="--reveal-delay: 320"
        class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white/50 hover:text-white transition-colors animate-bounce">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
        </svg>
    </a>
</section>

{{-- ── Body ───────────────────────────────────────────────── --}}
<section id="campaign-detail" class="bg-[#f8f9fc] py-12 lg:py-16">
    <div class="max-w-5xl mx-auto px-6 space-y-8">

        {{-- Hero image --}}
        @if($campaign->has_image)
        <figure data-reveal class="rounded-3xl overflow-hidden shadow-xl shadow-gray-900/10 bg-white">
            <img src="{{ $campaign->image_url }}" alt="{{ $campaign->localized_title }}"
                class="w-full max-h-[34rem] object-cover object-center">
        </figure>
        @endif

        {{-- Description --}}
        @if($campaign->localized_description)
        <article data-reveal class="bg-white rounded-3xl border border-gray-100 shadow-sm p-7 md:p-10">
            <div class="flex items-center gap-3 pb-5 mb-6 border-b border-gray-100">
                <span class="w-9 h-9 rounded-xl bg-[#8da83a]/12 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4.5 h-4.5 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h10" />
                    </svg>
                </span>
                <div>
                    <h2 class="font-bold text-gray-800">{{ __('About This Campaign') }}</h2>
                    @if($campaign->year)
                    <p class="text-xs text-gray-400 mt-0.5">{{ $campaign->year }}</p>
                    @endif
                </div>
            </div>
            {{-- .article-content, not `prose` — the typography plugin isn't installed;
            see the rules in resources/css/app.css. --}}
            <div class="article-content">
                {!! $campaign->localized_description !!}
            </div>
        </article>
        @endif

        {{-- Video --}}
        @if($campaign->has_video)
        <div data-reveal class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="flex items-center gap-2.5 px-6 py-4 border-b border-gray-100">
                <span class="w-8 h-8 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-[#2d6fa3]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z" />
                    </svg>
                </span>
                <h2 class="font-bold text-gray-800 text-sm">{{ __('Campaign Video') }}</h2>
            </div>
            <div class="bg-black aspect-video">
                @if($embedUrl)
                <iframe src="{{ $embedUrl }}" title="{{ $campaign->localized_title }}" class="w-full h-full"
                    frameborder="0" loading="lazy"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
                @elseif($campaign->is_external_video)
                {{-- Unrecognised external host: link out rather than embed something that may be blocked. --}}
                <a href="{{ $campaign->video_url }}" target="_blank" rel="noopener"
                    class="w-full h-full flex flex-col items-center justify-center gap-3 text-white/80 hover:text-white transition-colors">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664zM21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm font-semibold">{{ __('Watch the video') }}</span>
                </a>
                @else
                <video controls preload="metadata" class="w-full h-full" @if($campaign->has_image) poster="{{
                    $campaign->image_url }}" @endif>
                    <source src="{{ $campaign->video_url }}">
                    {{ __('Your browser does not support the video tag.') }}
                </video>
                @endif
            </div>
        </div>
        @endif


        {{-- Attached document --}}
        @if($campaign->has_file)
        <div data-reveal class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="flex flex-wrap items-center justify-between gap-4 px-6 py-5 border-b border-gray-100">
                <div class="flex items-center gap-3 min-w-0">
                    <span class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </span>
                    <div class="min-w-0">
                        <h2 class="font-bold text-gray-800 text-sm truncate">{{ $campaign->file_name }}</h2>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $campaign->file_size_for_humans }}</p>
                    </div>
                </div>
                <a href="{{ $campaign->file_url }}" download="{{ $campaign->file_name }}"
                    class="inline-flex items-center gap-2 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white px-5 py-2.5 rounded-full text-sm font-semibold transition-colors flex-shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    {{ __('Download') }}
                </a>
            </div>
            @if($isPdf)
            <object data="{{ $campaign->file_url }}" type="application/pdf" class="w-full h-[38rem] bg-gray-50">
                <div class="flex flex-col items-center justify-center h-full gap-3 text-gray-400 p-8 text-center">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-sm">{{ __('Your browser cannot display this PDF inline.') }}</p>
                    <a href="{{ $campaign->file_url }}" target="_blank" rel="noopener"
                        class="text-[#2d6fa3] font-semibold text-sm hover:underline">{{ __('Open it in a new tab')
                        }}</a>
                </div>
            </object>
            @endif
        </div>
        @endif

        {{-- Inline donate CTA --}}
        <div data-reveal
            class="relative overflow-hidden rounded-3xl bg-[#1d4e7a] px-7 py-9 md:px-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="absolute top-0 right-0 w-64 h-64 rounded-full bg-[#8da83a]/20 -translate-y-1/2 translate-x-1/3">
            </div>
            <div class="relative">
                <h2 class="text-xl md:text-2xl font-black text-white mb-1.5">{{ __('Support this campaign') }}</h2>
                <p class="text-white/60 text-sm leading-relaxed">{{ __('100% of your donation directly supports children
                    in Cambodia.') }}</p>
            </div>
            <a href="{{ route('donate') }}"
                class="relative inline-flex items-center justify-center gap-2 bg-[#8da83a] hover:bg-[#a3c04a] text-white px-8 py-3.5 rounded-full font-semibold text-sm shadow-lg shadow-black/20 hover:-translate-y-0.5 transition-all flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                {{ __('Donate Now') }}
            </a>
        </div>
    </div>
</section>

{{-- ── More campaigns ─────────────────────────────────────── --}}
@if($relatedCampaigns->isNotEmpty())
<section class="bg-white py-16 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <div data-reveal class="flex items-end justify-between gap-6 mb-10">
            <div>
                <span class="text-[#8da83a] font-bold text-xs uppercase tracking-widest">{{ __('Keep Exploring')
                    }}</span>
                <h2 class="text-2xl md:text-3xl font-black text-[#1a3c6e] mt-2">{{ __('More Campaigns') }}</h2>
            </div>
            <a href="{{ route('campaigns.index') }}"
                class="hidden sm:inline-flex items-center gap-1.5 text-[#2d6fa3] text-sm font-bold hover:gap-2.5 transition-all flex-shrink-0 pb-1">
                {{ __('View all') }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-7">
            @foreach($relatedCampaigns as $related)
            @include('campaigns._card', ['campaign' => $related, 'delay' => min($loop->index * 80, 240)])
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection