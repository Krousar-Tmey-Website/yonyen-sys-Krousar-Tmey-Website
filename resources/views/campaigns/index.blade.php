@extends('layouts.app')

@section('title', (strip_tags($banner['title']) ?: __('Campaigns')) . ' — ' . ($settings['site_name'] ?? 'Krousar Thmey'))
@section('description', Str::limit(strip_tags($banner['subtitle']), 160))

@section('content')

{{-- ── Hero banner ────────────────────────────────────────── --}}
<section class="relative overflow-hidden bg-[#1d4e7a] h-[90vh] min-h-[600px] max-h-[900px]">
    @if($banner['image'])
    <div class="absolute inset-0 bg-cover bg-center hero-media-drift" style="background-image: url('{{ $banner['image'] }}');"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-[#12324f]/95 via-[#1d4e7a]/85 to-[#1d4e7a]/40"></div>
    @endif

    {{-- Animated decorative orbs --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full hero-float-slow" style="background: radial-gradient(circle, rgba(255,255,255,0.10) 0%, transparent 70%);"></div>
        <div class="absolute -bottom-32 -left-32 w-[30rem] h-[30rem] rounded-full hero-float-delayed" style="background: radial-gradient(circle, rgba(255,255,255,0.07) 0%, transparent 70%);"></div>
        <div class="absolute top-1/3 left-1/4 w-48 h-48 rounded-full hero-pulse" style="background: radial-gradient(circle, rgba(141,168,58,0.20) 0%, transparent 70%);"></div>
        <div class="absolute bottom-1/4 right-1/4 w-40 h-40 rounded-full hero-float-slow" style="animation-delay: 4s; background: radial-gradient(circle, rgba(238,169,29,0.15) 0%, transparent 70%);"></div>
    </div>

    <div class="relative h-full flex items-center">
        <div class="max-w-7xl mx-auto px-6 w-full">
            <nav data-reveal class="flex items-center gap-2 text-sm text-white/50 mb-8">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ __('Home') }}</a>
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-white/80">{{ __('Campaigns') }}</span>
            </nav>

            <div class="max-w-3xl">
                <div data-reveal style="--reveal-delay: 60" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#8da83a]/25 border border-[#8da83a]/40 mb-5">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#a3c04a]"></span>
                    <span class="text-[#cfe08a] font-semibold text-xs uppercase tracking-widest">{{ __('Support Our Cause') }}</span>
                </div>

                <h1 data-reveal style="--reveal-delay: 120" class="text-4xl md:text-5xl lg:text-6xl font-black text-white leading-[1.08] mb-5">
                    {{ strip_tags($banner['title']) }}
                </h1>

                @if($banner['subtitle'])
                <div data-reveal style="--reveal-delay: 180" class="max-w-2xl text-white/70 text-base md:text-lg leading-relaxed [&_p]:mb-3 [&_p:last-child]:mb-0">
                    {!! $banner['subtitle'] !!}
                </div>
                @endif

                <div data-reveal style="--reveal-delay: 240" class="flex flex-wrap items-center gap-3 mt-8">
                    <a href="{{ route('donate') }}"
                       class="inline-flex items-center gap-2 bg-[#8da83a] hover:bg-[#a3c04a] text-white px-7 py-3.5 rounded-full font-semibold text-sm shadow-lg shadow-black/20 hover:shadow-xl hover:-translate-y-0.5 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        {{ __('Donate Now') }}
                    </a>
                    @if($campaigns->isNotEmpty())
                    <a href="#campaign-list"
                       class="inline-flex items-center gap-2 border border-white/25 hover:border-white/50 hover:bg-white/10 text-white px-7 py-3.5 rounded-full font-semibold text-sm transition-all">
                        {{ __('Browse Campaigns') }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll cue --}}
    <a href="#campaign-list" data-reveal style="--reveal-delay: 320"
       class="absolute bottom-8 left-1/2 -translate-x-1/2 text-white/50 hover:text-white transition-colors animate-bounce">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
    </a>
</section>

{{-- ── Campaign list ──────────────────────────────────────── --}}
<section id="campaign-list" class="bg-[#f8f9fc] py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-6">

        @if($campaigns->isEmpty())
        <div class="text-center py-20 text-gray-400">
            <svg class="w-14 h-14 mx-auto mb-5 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/></svg>
            <p class="text-lg font-semibold text-gray-500 mb-2">{{ __('No campaigns yet') }}</p>
            <p class="text-sm">{{ __('Check back soon — new campaigns are published regularly.') }}</p>
        </div>
        @else

        <div data-reveal class="flex items-end justify-between gap-6 mb-10">
            <div>
                <span class="text-[#8da83a] font-bold text-xs uppercase tracking-widest">{{ __('Campaigns') }}</span>
                <h2 class="text-2xl md:text-3xl font-black text-[#1a3c6e] mt-2">{{ __('Causes you can support today') }}</h2>
            </div>
            <span class="hidden sm:inline-flex items-center gap-1.5 text-sm text-gray-400 flex-shrink-0 pb-1">
                <span class="font-bold text-[#2d6fa3]">{{ $campaigns->total() }}</span> {{ $campaigns->total() === 1 ? __('campaign') : __('campaigns') }}
            </span>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-7">
            @foreach($campaigns as $campaign)
            @include('campaigns._card', ['campaign' => $campaign, 'delay' => min($loop->index * 80, 480)])
            @endforeach
        </div>

        @if($campaigns->hasPages())
        <div class="mt-12">
            {{ $campaigns->onEachSide(1)->links() }}
        </div>
        @endif
        @endif
    </div>
</section>

{{-- ── Closing CTA ────────────────────────────────────────── --}}
<section class="bg-white py-16 border-t border-gray-100">
    <div data-reveal class="max-w-4xl mx-auto px-6">
        <div class="relative overflow-hidden rounded-3xl bg-[#1d4e7a] px-8 py-12 md:px-14 text-center">
            <div class="absolute top-0 right-0 w-72 h-72 rounded-full bg-[#8da83a]/20 -translate-y-1/2 translate-x-1/3"></div>
            <div class="relative">
                <h2 class="text-2xl md:text-3xl font-black text-white mb-3">{{ __('Every gift becomes a future') }}</h2>
                <p class="text-white/60 max-w-xl mx-auto mb-8 leading-relaxed">{{ __('100% of your donation directly supports disadvantaged children in Cambodia.') }}</p>
                <a href="{{ route('donate') }}"
                   class="inline-flex items-center gap-2 bg-[#8da83a] hover:bg-[#a3c04a] text-white px-8 py-3.5 rounded-full font-semibold text-sm shadow-lg shadow-black/20 hover:-translate-y-0.5 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    {{ __('Donate Now') }}
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
