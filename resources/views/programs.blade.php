@extends('layouts.app')

@section('title', 'Our Programs — Krousar Thmey')
@section('description', 'Discover Krousar Thmey\'s three core programs: child welfare, special education for deaf and blind children, and cultural and artistic development.')

@section('content')

{{-- Per-program icon helper (simple, safe SVG primitives keyed off the program title) --}}
@php
$programIconFor = function (string $title, string $size = 'w-5 h-5') {
    $t = strtolower($title);
    $attrs = "class=\"{$size}\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\" stroke-width=\"1.75\" stroke-linecap=\"round\" stroke-linejoin=\"round\"";
    if (str_contains($t, 'welfare')) {
        return "<svg {$attrs} stroke-width=\"2\"><path d=\"M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z\"/></svg>";
    }
    if (str_contains($t, 'educat') || str_contains($t, 'deaf') || str_contains($t, 'blind')) {
        return "<svg {$attrs}><path d=\"M12 6c-1.5-1-4-1.5-6-1.2v12.4c2-.3 4.5.2 6 1.2 1.5-1 4-1.5 6-1.2V4.8c-2-.3-4.5.2-6 1.2z\"/><line x1=\"12\" y1=\"6\" x2=\"12\" y2=\"18.4\"/></svg>";
    }
    if (str_contains($t, 'cultur') || str_contains($t, 'art')) {
        return "<svg {$attrs}><circle cx=\"7\" cy=\"17\" r=\"2.3\"/><circle cx=\"17\" cy=\"15\" r=\"2.3\"/><line x1=\"9.3\" y1=\"17\" x2=\"9.3\" y2=\"5.5\"/><line x1=\"19.3\" y1=\"15\" x2=\"19.3\" y2=\"3.5\"/><line x1=\"9.3\" y1=\"5.5\" x2=\"19.3\" y2=\"3.5\"/></svg>";
    }
    if (str_contains($t, 'career') || str_contains($t, 'counsel')) {
        return "<svg {$attrs}><rect x=\"3.5\" y=\"8\" width=\"17\" height=\"11\" rx=\"2\"/><path d=\"M8.5 8V6a2 2 0 012-2h3a2 2 0 012 2v2\"/><line x1=\"3.5\" y1=\"13\" x2=\"20.5\" y2=\"13\"/></svg>";
    }
    if (str_contains($t, 'health') || str_contains($t, 'hygiene')) {
        return "<svg {$attrs}><circle cx=\"12\" cy=\"12\" r=\"8.3\"/><line x1=\"12\" y1=\"8.3\" x2=\"12\" y2=\"15.7\"/><line x1=\"8.3\" y1=\"12\" x2=\"15.7\" y2=\"12\"/></svg>";
    }
    return "<svg {$attrs}><path d=\"M12 3l1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8z\"/></svg>";
};
@endphp

{{-- Page Header --}}
<section class="bg-[#1a3c6e] relative overflow-hidden min-h-[560px] md:min-h-[620px] lg:min-h-[680px] flex items-center">
    @if(!empty($bannerImage))
    <div class="absolute inset-0">
        <img
            src="{{ str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage) }}"
            alt=""
            aria-hidden="true"
            class="absolute inset-0 w-full h-full object-cover object-[center_30%] scale-110 blur-xl opacity-22 hero-media-drift"
        >
        <img
            src="{{ str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage) }}"
            alt="{{ $bannerTitle }}"
            class="absolute inset-0 w-full h-full object-cover object-[center_30%] hero-media-drift"
        >
    </div>
    @endif
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_78%_18%,_rgba(255,255,255,0.18),_transparent_0,_transparent_26%),radial-gradient(circle_at_12%_84%,_rgba(141,168,58,0.12),_transparent_0,_transparent_24%),linear-gradient(180deg,_rgba(255,255,255,0.04),_transparent_36%)]"></div>
    <div class="absolute inset-0 bg-[linear-gradient(112deg,rgba(10,29,56,0.96)_0%,rgba(16,40,74,0.92)_32%,rgba(22,55,99,0.72)_56%,rgba(45,111,163,0.18)_100%)]"></div>
    @if(empty($bannerImage))
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white/5 -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#2d6fa3]/30 translate-y-1/2 -translate-x-1/4"></div>
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-[#163763]/56 via-[#163763]/12 to-transparent"></div>
    <div class="absolute top-16 left-[10%] hidden lg:block w-32 h-32 rounded-full border border-white/10 bg-white/[0.03] hero-float-slow"></div>
    <div class="absolute top-24 right-[14%] hidden lg:block w-3 h-3 rounded-full bg-[#8da83a] shadow-[0_0_0_12px_rgba(141,168,58,0.12)] hero-pulse"></div>
    <div class="absolute bottom-20 right-[8%] hidden lg:block w-44 h-44 rounded-full border border-white/8 bg-white/[0.02] hero-float-delayed"></div>
    <div class="relative w-full max-w-7xl mx-auto px-6 py-16 md:py-20 lg:py-24">
        <div class="max-w-[38rem]">
        <div class="inline-flex items-center gap-3 px-3.5 py-1.5 rounded-full bg-white/6 backdrop-blur-md border border-white/10 shadow-lg shadow-[#081a33]/20 mb-6 hero-reveal">
            <span class="inline-flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.28em] text-white/80">
                <span class="w-2 h-2 rounded-full bg-[#8da83a]"></span>
                Cambodia Since 1991
            </span>
        </div>
        <div class="max-w-[34rem] rounded-[1.75rem] border border-white/10 bg-[linear-gradient(135deg,rgba(255,255,255,0.10),rgba(255,255,255,0.035))] backdrop-blur-xl shadow-[0_24px_60px_rgba(4,18,37,0.24)] px-5 py-6 md:px-8 md:py-7 hero-reveal hero-reveal-delay-1">
        <nav class="flex items-center gap-2 text-sm text-white/60 mb-6 flex-wrap hero-reveal hero-reveal-delay-2">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/90">Our Programs</span>
        </nav>
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#e8a020]/12 backdrop-blur-sm border border-[#e8a020]/25 mb-5 shadow-lg shadow-[#10284c]/10 hero-reveal hero-reveal-delay-2">
            <div class="w-1.5 h-1.5 rounded-full bg-[#e8a020]"></div>
            <span class="text-[#e8a020] font-semibold text-xs uppercase tracking-widest">Krousar Thmey</span>
        </div>
        <h1 class="text-4xl md:text-6xl lg:text-[4.5rem] font-black text-white mb-5 uppercase tracking-[0.03em] leading-[0.92] drop-shadow-[0_8px_24px_rgba(8,21,41,0.28)] hero-reveal hero-reveal-delay-3">{{ $bannerTitle }}</h1>
        <div class="flex items-center gap-4 mb-6 hero-reveal hero-reveal-delay-3">
            <div class="w-18 md:w-20 h-1.5 bg-[#8da83a] rounded-full"></div>
            <div class="w-10 h-px bg-white/20"></div>
        </div>
        @if($bannerSubtitle)
        <p class="text-white/84 text-base md:text-[1.15rem] max-w-xl leading-relaxed hero-reveal hero-reveal-delay-4">{{ $bannerSubtitle }}</p>
        @endif
        <div class="mt-6 flex flex-wrap items-center gap-3 text-white/72 hero-reveal hero-reveal-delay-4">
            <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] px-3.5 py-1.5 text-sm backdrop-blur-sm transition-transform duration-300 hover:-translate-y-1">
                <span class="w-2 h-2 rounded-full bg-[#8da83a]"></span>
                15 Provinces
            </div>
            <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] px-3.5 py-1.5 text-sm backdrop-blur-sm transition-transform duration-300 hover:-translate-y-1">
                <span class="w-2 h-2 rounded-full bg-[#e8a020]"></span>
                4,000+ Children
            </div>
            <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/[0.04] px-3.5 py-1.5 text-sm backdrop-blur-sm transition-transform duration-300 hover:-translate-y-1">
                <span class="w-2 h-2 rounded-full bg-white/70"></span>
                Three Core Programs
            </div>
        </div>
        </div>
        </div>
    </div>
</section>
{{-- Wave divider: a separate element below the banner, never overlapping banner text regardless of subtitle length --}}
<div class="relative h-10 md:h-12 bg-transparent overflow-hidden -mt-px" aria-hidden="true">
    <svg class="absolute inset-0 w-full h-full text-white" viewBox="0 0 1440 56" preserveAspectRatio="none" fill="currentColor">
        <path d="M0,56 C220,30 470,14 720,14 C1000,14 1228,30 1440,56 L1440,56 L0,56 Z"></path>
    </svg>
</div>

{{-- Program Overview --}}
@php
    $programColours = ['bg-[#1a3c6e]', 'bg-[#e8a020]', 'bg-[#2554a0]'];
@endphp
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        @php $progCount = $programs->take(3)->count(); @endphp
        <div class="grid md:grid-cols-{{ $progCount }} gap-6 {{ $progCount < 3 ? 'max-w-4xl mx-auto' : '' }}">
            @php $colors = ['bg-[#1a3c6e]', 'bg-[#e8a020]', 'bg-[#2d6fa3]']; @endphp
            @foreach($programs->take(3) as $index => $prog)
            <a href="#{{ $prog->slug }}" class="{{ $colors[$index % 3] }} rounded-2xl p-7 text-white hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between min-h-[170px] group relative overflow-hidden"
               data-reveal="up" style="--reveal-delay: {{ $index * 100 }}">
                <div class="absolute top-0 right-0 w-32 h-32 rounded-full bg-white/5 -translate-y-1/2 translate-x-1/2"></div>
                <div class="relative flex items-center justify-between">
                    <div class="w-11 h-11 rounded-xl bg-white/15 flex items-center justify-center group-hover:bg-white/25 group-hover:scale-110 transition-all duration-300">
                        {!! $programIconFor($prog->title) !!}
                    </div>
                    @if($prog->Status)
                    <span class="text-[10px] font-bold uppercase tracking-widest text-white/70 bg-white/10 px-2.5 py-1 rounded-full">{{ $prog->Status }}</span>
                    @endif
                </div>
                <div class="relative mt-6">
                    <div class="font-bold text-white/90 group-hover:text-white transition-colors text-sm uppercase tracking-wide">{{ $prog->title }}</div>
                    <div class="mt-3 flex items-center gap-1.5 text-white/50 group-hover:text-white/80 transition-colors text-xs font-semibold">
                        View program
                        <svg class="w-3 h-3 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Main Programs --}}
@foreach($programs->take(3) as $index => $program)
@php $isEven = $index % 2 != 0; @endphp
<section id="{{ $program->slug }}" class="py-20 {{ $isEven ? 'bg-white' : 'bg-[#f8f9fc]' }}">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-start">
            <div class="{{ $isEven ? 'order-1 lg:order-2' : '' }}" data-reveal="{{ $isEven ? 'right' : 'left' }}">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-12 h-12 rounded-xl bg-[#1a3c6e]/8 flex items-center justify-center text-[#1a3c6e] flex-shrink-0">
                        {!! $programIconFor($program->title) !!}
                    </div>
                    <div>
                        <div class="w-10 h-1 bg-[#d32f2f] rounded-full mb-2"></div>
                        <h2 class="text-3xl font-black text-[#1a3c6e] uppercase tracking-wide leading-tight">{{ $program->title }}</h2>
                    </div>
                </div>

                @if($program->description)
                <div class="mb-7 pl-4 border-l-2 border-[#2d6fa3]/20">
                    <h3 class="flex items-center gap-2 text-xs font-bold text-[#2d6fa3] uppercase tracking-widest mb-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="8"/><circle cx="12" cy="12" r="3"/></svg>
                        Objective
                    </h3>
                    <p class="text-gray-700 leading-relaxed">{{ $program->description }}</p>
                </div>
                @endif

                @if($program->full_description)
                <div class="mb-8 pl-4 border-l-2 border-[#8da83a]/25">
                    <h3 class="flex items-center gap-2 text-xs font-bold text-[#8da83a] uppercase tracking-widest mb-2">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="3.5" width="14" height="17" rx="1.5"/><line x1="8.3" y1="8" x2="15.7" y2="8"/><line x1="8.3" y1="12" x2="15.7" y2="12"/><line x1="8.3" y1="16" x2="13" y2="16"/></svg>
                        Program
                    </h3>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $program->full_description }}</p>
                </div>
                @endif

                <div class="flex flex-col sm:flex-row gap-4 mb-8">
                    @if($program->projects && $program->projects->count() > 0)
                    <a href="#projects-{{ $program->slug }}" class="btn-blue justify-center text-center w-full sm:w-auto">Know more about the projects</a>
                    @endif
                    <a href="{{ route('donate') }}" class="btn-primary flex items-center justify-center gap-2 w-full sm:w-auto">
                        <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                        DONATE NOW
                    </a>
                </div>
            </div>
            <div class="{{ $isEven ? 'order-2 lg:order-1 space-y-8' : 'space-y-8' }}" data-reveal="{{ $isEven ? 'left' : 'right' }}">
                <div class="relative">
                    <img src="{{ $program->image_url }}" alt="{{ $program->title }}" class="w-full h-auto object-cover rounded-3xl border-4 border-white shadow-2xl">
                    <div class="absolute -top-3 {{ $isEven ? '-left-3' : '-right-3' }} w-16 h-16 rounded-2xl bg-[#e8a020]/15 -z-10 hidden lg:block"></div>
                    <div class="absolute -bottom-4 {{ $isEven ? 'right-6' : 'left-6' }} bg-white rounded-xl shadow-lg px-4 py-2.5 border border-gray-100 flex items-center gap-2 max-w-[85%]">
                        <div class="w-2 h-2 rounded-full bg-[#8da83a] flex-shrink-0"></div>
                        <span class="text-xs font-bold text-[#1a3c6e] uppercase tracking-wider truncate">{{ $program->title }}</span>
                    </div>
                </div>

                @if($program->facebook_url || $program->linkedin_url || $program->instagram_url || $program->telegram_url || $program->youtube_url)
                <div class="flex items-center justify-center gap-2 pt-2">
                    @if($program->facebook_url)
                    <a href="{{ $program->facebook_url }}" target="_blank" rel="noopener" class="w-9 h-9 text-white rounded-lg flex items-center justify-center shadow-sm hover:shadow-md hover:scale-110 transition-all duration-200" style="background-color: #1877f2;" title="Facebook">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    @endif
                    @if($program->telegram_url)
                    <a href="{{ $program->telegram_url }}" target="_blank" rel="noopener" class="w-9 h-9 text-white rounded-lg flex items-center justify-center shadow-sm hover:shadow-md hover:scale-110 transition-all duration-200" style="background-color: #0088cc;" title="Telegram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9.78 18.65l.28-4.28 7.68-6.92c.34-.3-.07-.46-.52-.18L7.74 13.3 3.64 12c-.88-.28-.9-.88.18-1.3l16.1-6.2c.74-.28 1.38.16 1.14 1.25l-2.74 12.92c-.2 1-.8 1.24-1.64.78l-4.18-3.08-2.02 1.95c-.22.22-.4.4-.78.4z"/></svg>
                    </a>
                    @endif
                    @if($program->linkedin_url)
                    <a href="{{ $program->linkedin_url }}" target="_blank" rel="noopener" class="w-9 h-9 text-white rounded-lg flex items-center justify-center shadow-sm hover:shadow-md hover:scale-110 transition-all duration-200" style="background-color: #0a66c2;" title="LinkedIn">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    @endif
                    @if($program->instagram_url)
                    <a href="{{ $program->instagram_url }}" target="_blank" rel="noopener" class="w-9 h-9 text-white rounded-lg flex items-center justify-center shadow-sm hover:shadow-md hover:scale-110 transition-all duration-200" style="background-color: #e1306c;" title="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                    </a>
                    @endif
                    @if($program->youtube_url)
                    <a href="{{ $program->youtube_url }}" target="_blank" rel="noopener" class="w-9 h-9 text-white rounded-lg flex items-center justify-center shadow-sm hover:shadow-md hover:scale-110 transition-all duration-200" style="background-color: #ff0000;" title="YouTube">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.163a3.003 3.003 0 0 0-2.11-2.11C19.517 3.545 12 3.545 12 3.545s-7.516 0-9.387.507a3.003 3.003 0 0 0-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 0 0 2.11 2.11c1.871.507 9.387.507 9.387.507s7.517 0 9.387-.507a3.003 3.003 0 0 0 2.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    @endif
                </div>
                @endif
            </div>
        </div>

        {{-- Testimony Section --}}
        @if($program->testimony_name && $program->testimony_story)
        @php
            $cleanTestimonyName = preg_replace('/^testimony\s*:?\s*/i', '', $program->testimony_name);
        @endphp
        <div class="mt-16 relative bg-[#1a3c6e]/5 border border-[#1a3c6e]/10 p-8 md:p-12 rounded-3xl text-center max-w-4xl mx-auto shadow-sm overflow-hidden" data-reveal="scale">
            <div class="absolute inset-0 pointer-events-none" style="background-image: radial-gradient(circle, #1a3c6e 1px, transparent 1px); background-size: 20px 20px; opacity: 0.06; mask-image: linear-gradient(to bottom, black, transparent 75%); -webkit-mask-image: linear-gradient(to bottom, black, transparent 75%);"></div>
            <div class="relative">
                <div class="relative inline-block mb-4">
                    @if($program->testimony_image)
                    <img src="{{ str_starts_with($program->testimony_image, 'http') ? $program->testimony_image : asset('storage/' . $program->testimony_image) }}" class="w-36 h-36 mx-auto rounded-full object-cover border-4 border-white shadow-lg relative z-10" alt="Testimony">
                    @else
                    <div class="w-36 h-36 mx-auto rounded-full bg-[#1a3c6e]/10 flex items-center justify-center text-[#1a3c6e] font-bold text-4xl border-4 border-white shadow-lg relative z-10">{{ substr($cleanTestimonyName, 0, 1) }}</div>
                    @endif
                    {{-- Quote Icon Badge --}}
                    <div class="absolute -top-2 left-1/2 -translate-x-1/2 z-20 w-9 h-9 bg-[#e8a020] rounded-full flex items-center justify-center shadow-md border-2 border-white">
                        <span class="text-white text-xl leading-none font-serif mt-0.5">"</span>
                    </div>
                </div>

                <h3 class="text-[#1a3c6e] font-bold text-xs tracking-widest uppercase mb-1.5">Testimony</h3>
                <p class="text-[#1a3c6e] font-semibold text-base mb-8">{{ $cleanTestimonyName }}</p>

                <div x-data="{ open: false }" class="bg-white text-left shadow-md rounded-2xl overflow-hidden border border-gray-100/50 max-w-2xl mx-auto">
                    <button @click="open = !open" class="w-full flex items-center justify-between p-5 hover:bg-gray-50/50 transition-colors focus:outline-none cursor-pointer">
                        <span class="text-gray-700 font-semibold text-sm flex items-center gap-2">
                            <svg class="w-4 h-4 text-[#2d6fa3] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="3.5" width="16" height="17" rx="2"/><line x1="7.5" y1="8" x2="16.5" y2="8"/><line x1="7.5" y1="12" x2="16.5" y2="12"/><line x1="7.5" y1="16" x2="13" y2="16"/></svg>
                            Read full story
                        </span>
                        <svg class="w-5 h-5 text-[#2d6fa3] flex-shrink-0 transform transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" class="p-6 border-t border-gray-100 bg-[#f8f9fc]/50" style="display: none;"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0">
                        <p class="text-gray-700 leading-relaxed text-sm whitespace-pre-line font-medium">{{ $program->testimony_story }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        {{-- Projects specific to this program --}}
        @if($program->projects && $program->projects->count() > 0)
        <div id="projects-{{ $program->slug }}" class="mt-20 pt-16 border-t border-gray-200">
            <div class="flex items-center gap-3 mb-10">
                <div class="w-9 h-9 rounded-lg bg-[#d32f2f]/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4.5 h-4.5 text-[#d32f2f]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="7" height="7" rx="1.5"/><rect x="13" y="4" width="7" height="7" rx="1.5"/><rect x="4" y="13" width="7" height="7" rx="1.5"/><rect x="13" y="13" width="7" height="7" rx="1.5"/></svg>
                </div>
                <span class="text-xs font-bold text-[#1a3c6e] uppercase tracking-widest">Discover the Projects</span>
                <div class="flex-1 h-px bg-gray-100"></div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($program->projects as $project)
                <a href="{{ route('projects.show', $project) }}" class="group bg-white rounded-2xl border border-gray-100 hover:border-[#2d6fa3]/30 overflow-hidden hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col"
                   data-reveal="up" style="--reveal-delay: {{ $loop->index * 90 }}">
                    <div class="overflow-hidden h-48 relative bg-[#1a3c6e]/5">
                        <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1a3c6e]/55 via-[#1a3c6e]/5 to-transparent"></div>
                        <span class="absolute top-3 left-3 w-7 h-7 rounded-lg bg-white/90 backdrop-blur-sm flex items-center justify-center text-[10px] font-black text-[#1a3c6e]">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="p-5 flex flex-col flex-1">
                        <h4 class="text-xs font-bold text-[#1a3c6e] uppercase tracking-wide mb-2 leading-relaxed group-hover:text-[#2d6fa3] transition-colors">{{ $project->title }}</h4>
                        @if($project->description)
                        <p class="text-gray-500 text-xs leading-relaxed flex-1 mb-4">{{ Str::limit($project->description, 100) }}</p>
                        @endif
                        <div class="mt-auto pt-3 border-t border-gray-100 flex items-center justify-between">
                            <span class="inline-flex items-center gap-1 text-[#2d6fa3] text-xs font-semibold group-hover:gap-2 transition-all">
                                Read More
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                            </span>
                            <a href="{{ route('donate') }}" onclick="event.stopPropagation()"
                               class="inline-flex items-center gap-1 text-xs font-bold text-[#d32f2f] hover:text-white hover:bg-[#d32f2f] px-2.5 py-1 rounded-full border border-[#d32f2f]/20 hover:border-[#d32f2f] transition-colors">
                                Donate ↗
                            </a>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endforeach

{{-- Additional Programs (4th+) --}}
@if($programs->count() > 3)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14" data-reveal>
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#e8a020]/10 border border-[#e8a020]/20 mb-4">
                <div class="w-1.5 h-1.5 rounded-full bg-[#e8a020]"></div>
                <span class="text-[#e8a020] font-semibold text-xs uppercase tracking-widest">Cross-cutting Work</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-black text-[#1a3c6e] uppercase tracking-wide">Additional Programs</h2>
            <div class="w-16 h-1 bg-[#d32f2f] mx-auto mt-4 rounded-full"></div>
        </div>
        <div class="grid md:grid-cols-2 gap-6">
            @php $extraColors = ['bg-[#1a3c6e]', 'bg-[#2d6fa3]']; @endphp
            @foreach($programs->skip(3) as $index => $program)
            <div class="group bg-[#f8f9fc] rounded-2xl p-8 border border-gray-100 hover:border-[#2d6fa3]/20 hover:shadow-lg hover:-translate-y-1 transition-all duration-300"
                 data-reveal="up" style="--reveal-delay: {{ $index * 100 }}">
                <div class="w-12 h-12 rounded-xl {{ $extraColors[$index % 2] }} flex items-center justify-center mb-5 text-white group-hover:scale-110 transition-transform duration-300">
                    {!! $programIconFor($program->title, 'w-6 h-6') !!}
                </div>
                @if($program->Status)
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#e8a020]/10 border border-[#e8a020]/20 mb-3">
                    <span class="text-[#e8a020] font-semibold text-xs">{{ $program->Status }}</span>
                </div>
                @endif
                <h3 class="text-xl font-black text-[#1a3c6e] uppercase tracking-wide mb-3">{{ $program->title }}</h3>
                <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">{{ $program->description }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Additional Pages --}}
@php $additionalItems = \App\Models\ProgramPageItem::active()->orderBy('sort_order')->get(); @endphp
@if($additionalItems->count() > 0)
<section class="py-20 bg-[#f8f9fc]">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Section Header --}}
        <div class="text-center mb-14" data-reveal>
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#e8a020]/10 border border-[#e8a020]/20 mb-4">
                <div class="w-1.5 h-1.5 rounded-full bg-[#e8a020]"></div>
                <span class="text-[#e8a020] font-semibold text-xs uppercase tracking-widest">Learn More</span>
            </div>
            <h2 class="text-3xl md:text-4xl font-black text-[#1a3c6e] uppercase tracking-wide">Additional Information</h2>
            <div class="w-16 h-1 bg-[#d32f2f] mx-auto mt-4 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($additionalItems as $item)
            <a href="{{ route('program-page-items.show', $item->id) }}"
               class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col h-full hover:-translate-y-1"
               data-reveal="up" style="--reveal-delay: {{ min($loop->index * 90, 360) }}">

                {{-- Image --}}
                @if($item->image)
                <div class="h-52 overflow-hidden relative bg-[#1a3c6e]/5">
                    <img src="{{ $item->image_url }}" alt="{{ $item->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1a3c6e]/50 to-transparent"></div>
                </div>
                @else
                <div class="h-32 bg-gradient-to-br from-[#1a3c6e] to-[#2d6fa3] flex items-center justify-center">
                    <svg class="w-10 h-10 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                </div>
                @endif

                {{-- Body --}}
                <div class="p-6 flex flex-col flex-1">
                    <h3 class="text-base font-bold text-[#1a3c6e] mb-2 leading-snug group-hover:text-[#2d6fa3] transition-colors">{{ $item->title }}</h3>
                    @if($item->short_content)
                    <p class="text-gray-500 text-sm leading-relaxed flex-1 mb-5">{{ Str::limit($item->short_content, 130) }}</p>
                    @endif

                    {{-- Footer --}}
                    <div class="mt-auto pt-4 border-t border-gray-100 flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 text-[#2d6fa3] text-xs font-semibold group-hover:gap-2.5 transition-all">
                            Read More
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </span>
                        <span class="w-7 h-7 rounded-full bg-[#2d6fa3]/10 group-hover:bg-[#2d6fa3] flex items-center justify-center transition-colors">
                            <svg class="w-3.5 h-3.5 text-[#2d6fa3] group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="relative py-20 overflow-hidden bg-[#1a3c6e]">
    <div class="absolute top-0 right-0 w-80 h-80 rounded-full bg-[#2d6fa3]/20 -translate-y-1/2 translate-x-1/4"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a]/10 translate-y-1/2 -translate-x-1/4"></div>
    <div class="relative max-w-4xl mx-auto px-6 text-center" data-reveal="scale">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#8da83a]/20 border border-[#8da83a]/30 mb-6">
            <div class="w-1.5 h-1.5 rounded-full bg-[#8da83a]"></div>
            <span class="text-[#8da83a] font-semibold text-xs uppercase tracking-widest">Support Our Mission</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-black text-white uppercase tracking-wide mb-4">Help Children in Cambodia</h2>
        <p class="text-white/60 text-base mb-10 max-w-xl mx-auto leading-relaxed">Your donation goes directly to one of these programs. 100% of funds support children in Cambodia.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('donate') }}" class="btn-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                Donate Now
            </a>
            <a href="{{ route('contact') }}" class="btn-outline">Contact Us</a>
        </div>
    </div>
</section>

@endsection
