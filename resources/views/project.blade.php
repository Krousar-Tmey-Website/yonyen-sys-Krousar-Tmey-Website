@extends('layouts.app')

@section('title', $project->title . ' — Krousar Thmey')
@section('description', $project->description ?? $project->title)

@section('content')

{{-- ── Page Header ─────────────────────────────────────────────── --}}
@php
    $bannerImg    = $project->banner_image ?? '';
    $bannerImgSrc = $bannerImg
        ? (str_starts_with($bannerImg, 'http') ? $bannerImg : asset('storage/' . $bannerImg))
        : '';
    $bannerStyle  = $bannerImgSrc
        ? 'background-image: linear-gradient(to right, rgba(26,60,110,0.92) 45%, rgba(26,60,110,0.70)), url(' . $bannerImgSrc . '); background-size: cover; background-position: center;'
        : '';
@endphp

<div class="bg-[#2d6fa3] pt-16 pb-20 relative overflow-hidden" style="{{ $bannerStyle }}">
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white/5 -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a]/40 translate-y-1/2 -translate-x-1/4"></div>

    <div class="relative max-w-7xl mx-auto px-6">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-white/50 mb-10 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('programs') }}" class="hover:text-white transition-colors">Our Programs</a>
            @if($project->program)
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('programs') }}#{{ $project->program->slug }}" class="hover:text-white transition-colors">{{ $project->program->title }}</a>
            @endif
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/80">{{ $project->title }}</span>
        </nav>

        {{-- Label --}}
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#e8a020]/20 border border-[#e8a020]/30 mb-5">
            <div class="w-1.5 h-1.5 rounded-full bg-[#e8a020]"></div>
            <span class="text-[#e8a020] font-semibold text-xs uppercase tracking-widest">
                {{ $project->program ? $project->program->title : 'Project' }}
            </span>
        </div>

        <h1 class="text-3xl md:text-4xl font-black text-white mb-0 max-w-3xl leading-tight uppercase tracking-wide">{{ $project->title }}</h1>
    </div>
</div>

{{-- ── Main Content ─────────────────────────────────────────────── --}}
<section class="bg-white py-12">
    <div class="max-w-6xl mx-auto px-6">

        {{-- Two-column layout: content + sidebar --}}
        <div class="grid lg:grid-cols-3 gap-10 items-start">

            {{-- Left: text content (2/3) --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Hero image — medium, contained --}}
                @if($project->image)
                <div class="rounded-2xl overflow-hidden shadow-lg ring-1 ring-gray-200">
                    <img src="{{ $project->image_url }}" alt="{{ $project->title }}"
                         class="w-full h-64 md:h-80 object-cover object-center">
                </div>
                @endif

                @if($project->description)
                <blockquote class="border-l-4 border-[#8da83a] pl-5 py-3 pr-4 bg-[#8da83a]/5 rounded-r-xl">
                    <p class="text-gray-700 text-sm leading-relaxed italic">{{ $project->description }}</p>
                </blockquote>
                @endif

                @if($project->objective)
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-1 h-6 bg-[#d32f2f] rounded-full"></div>
                        <span class="text-xs font-bold text-[#1a3c6e] uppercase tracking-widest">Objective</span>
                        <div class="flex-1 h-px bg-gray-100"></div>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">{{ $project->objective }}</p>
                </div>
                @endif

                @if($project->content)
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-1 h-6 bg-[#2d6fa3] rounded-full"></div>
                        <span class="text-xs font-bold text-[#1a3c6e] uppercase tracking-widest">Project Details</span>
                        <div class="flex-1 h-px bg-gray-100"></div>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">{{ $project->content }}</p>
                </div>
                @endif

                @if($project->activities)
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-1 h-6 bg-[#8da83a] rounded-full"></div>
                        <span class="text-xs font-bold text-[#1a3c6e] uppercase tracking-widest">Activities</span>
                        <div class="flex-1 h-px bg-gray-100"></div>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">{{ $project->activities }}</p>
                </div>
                @endif

                @if($project->make_difference_text)
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-1 h-6 bg-[#e8a020] rounded-full"></div>
                        <span class="text-xs font-bold text-[#1a3c6e] uppercase tracking-widest">Make a Difference</span>
                        <div class="flex-1 h-px bg-gray-100"></div>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">{{ $project->make_difference_text }}</p>
                </div>
                @endif

                @if($project->grants->isNotEmpty())
                @foreach($project->grants as $grant)
                <div class="rounded-2xl border border-[#8da83a]/30 bg-[#8da83a]/5 p-5 flex items-center gap-5">
                    <div class="w-12 h-12 rounded-xl bg-[#8da83a] flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-[#8da83a] uppercase tracking-widest mb-0.5">{{ $grant->title ?: 'Income Generation' }}</p>
                        <p class="text-2xl font-black text-[#1a3c6e]">${{ number_format($grant->amount, 2) }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">
                            @if($grant->label){{ $grant->label }}@endif
                            @if($grant->label && $grant->recipient) &middot; @endif
                            @if($grant->recipient){{ $grant->recipient }}@endif
                        </p>
                    </div>
                </div>
                @endforeach
                @endif

                {{-- Action buttons --}}
                <div class="flex flex-col sm:flex-row gap-3 pt-2 border-t border-gray-100">
                    <a href="{{ route('donate') }}" class="btn-primary justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        Donate Now
                    </a>
                    <a href="{{ route('contact') }}" class="btn-blue justify-center">
                        Contact Us
                    </a>
                </div>
            </div>

            {{-- Right: sidebar (1/3) --}}
            <div class="space-y-5 lg:sticky lg:top-24">

                {{-- Project info card --}}
                @if($project->area_of_work || $project->duration || $project->location || $project->beneficiaries)
                <div class="bg-[#1a3c6e] rounded-2xl p-6 text-white">
                    <h4 class="font-bold text-xs uppercase tracking-widest text-white/60 mb-4 pb-3 border-b border-white/10">Project Information</h4>
                    <div class="space-y-3">
                        @if($project->area_of_work)
                        <div class="flex gap-3">
                            <svg class="w-4 h-4 text-[#8da83a] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            <div><p class="text-white/50 text-xs">Area of work</p><p class="text-white text-sm font-semibold">{{ $project->area_of_work }}</p></div>
                        </div>
                        @endif
                        @if($project->duration)
                        <div class="flex gap-3">
                            <svg class="w-4 h-4 text-[#8da83a] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <div><p class="text-white/50 text-xs">Duration</p><p class="text-white text-sm font-semibold">{{ $project->duration }}</p></div>
                        </div>
                        @endif
                        @if($project->location)
                        <div class="flex gap-3">
                            <svg class="w-4 h-4 text-[#8da83a] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <div><p class="text-white/50 text-xs">Location</p><p class="text-white text-sm font-semibold">{{ $project->location }}</p></div>
                        </div>
                        @endif
                        @if($project->beneficiaries)
                        <div class="flex gap-3">
                            <svg class="w-4 h-4 text-[#8da83a] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <div><p class="text-white/50 text-xs">Beneficiaries</p><p class="text-white text-sm font-semibold">{{ $project->beneficiaries }}</p></div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                {{-- Share --}}
                <div class="bg-[#f8f9fc] rounded-2xl p-5 border border-gray-100">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-3">Share this project</p>
                    <div class="flex gap-2">
                        <a href="https://www.facebook.com/KrousarThmey" target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-xl bg-[#1877f2] text-white flex items-center justify-center hover:opacity-90 transition-opacity">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="https://www.linkedin.com/company/krousar-thmey/" target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-xl bg-[#0a66c2] text-white flex items-center justify-center hover:opacity-90 transition-opacity">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="https://www.youtube.com/@KrousarThmey" target="_blank" rel="noopener"
                           class="w-9 h-9 rounded-xl bg-[#ff0000] text-white flex items-center justify-center hover:opacity-90 transition-opacity">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Testimony --}}
        @if($project->testimony_name && $project->testimony_story)
        @php $cleanName = preg_replace('/^testimony\s*:?\s*/i', '', $project->testimony_name); @endphp
        <div class="border-t border-gray-100 mt-10 pt-12 pb-16">
            <div class="max-w-4xl mx-auto bg-[#1a3c6e]/5 border border-[#1a3c6e]/10 p-8 md:p-12 rounded-3xl text-center shadow-sm">
                <div class="relative inline-block mb-4">
                    @if($project->testimony_image)
                    <img src="{{ str_starts_with($project->testimony_image, 'http') ? $project->testimony_image : asset('storage/' . $project->testimony_image) }}"
                         class="w-28 h-28 mx-auto rounded-full object-cover border-4 border-white shadow-md relative z-10" alt="{{ $cleanName }}">
                    @else
                    <div class="w-28 h-28 mx-auto rounded-full bg-[#1a3c6e]/10 flex items-center justify-center text-[#1a3c6e] font-black text-4xl border-4 border-white shadow-md relative z-10">{{ substr($cleanName, 0, 1) }}</div>
                    @endif
                    <div class="absolute -top-2 left-1/2 -translate-x-1/2 z-20 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm border border-gray-100">
                        <span class="text-[#e8a020] text-2xl leading-none font-serif mt-1">"</span>
                    </div>
                </div>
                <p class="text-[#1a3c6e] font-bold text-xs tracking-widest uppercase mb-1">Testimony</p>
                <p class="text-[#1a3c6e] font-semibold text-base mb-8">{{ $cleanName }}</p>
                <div x-data="{ open: false }" class="bg-white text-left shadow-md rounded-2xl overflow-hidden border border-gray-100/50 max-w-3xl mx-auto">
                    <button @click="open = !open" class="w-full flex items-center justify-between p-5 hover:bg-gray-50/50 transition-colors focus:outline-none cursor-pointer">
                        <span class="text-gray-700 font-semibold text-sm">Read full story</span>
                        <svg class="w-5 h-5 text-[#2d6fa3] transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div x-show="open" style="display:none"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         class="p-6 border-t border-gray-100 bg-[#f8f9fc]/50">
                        <p class="text-gray-700 leading-relaxed text-sm whitespace-pre-line font-medium">{{ $project->testimony_story }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
</section>

{{-- ── Back bar ─────────────────────────────────────────────────── --}}
<div class="bg-[#f8f9fc] border-t border-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        @if($project->program)
        <a href="{{ route('programs') }}#projects-{{ $project->program->slug }}"
           class="inline-flex items-center gap-2 text-[#2d6fa3] hover:text-[#1d4e7a] font-semibold text-sm transition-colors group">
            <span class="w-8 h-8 rounded-full border-2 border-[#2d6fa3]/30 group-hover:border-[#2d6fa3] flex items-center justify-center transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </span>
            Back to {{ $project->program->title }}
        </a>
        @else
        <a href="{{ route('programs') }}"
           class="inline-flex items-center gap-2 text-[#2d6fa3] hover:text-[#1d4e7a] font-semibold text-sm transition-colors group">
            <span class="w-8 h-8 rounded-full border-2 border-[#2d6fa3]/30 group-hover:border-[#2d6fa3] flex items-center justify-center transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </span>
            Back to Our Programs
        </a>
        @endif
        <a href="{{ route('donate') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            Donate Now
        </a>
    </div>
</div>

{{-- ── CTA Banner ───────────────────────────────────────────────── --}}
<section class="relative py-16 overflow-hidden bg-[#1a3c6e]">
    <div class="absolute top-0 right-0 w-80 h-80 rounded-full bg-[#2d6fa3]/20 -translate-y-1/2 translate-x-1/4"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a]/10 translate-y-1/2 -translate-x-1/4"></div>
    <div class="relative max-w-4xl mx-auto px-6 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#8da83a]/20 border border-[#8da83a]/30 mb-6">
            <div class="w-1.5 h-1.5 rounded-full bg-[#8da83a]"></div>
            <span class="text-[#8da83a] font-semibold text-xs uppercase tracking-widest">Support Our Mission</span>
        </div>
        <h2 class="text-2xl md:text-3xl font-black text-white uppercase tracking-wide mb-3">Help Children in Cambodia</h2>
        <p class="text-white/60 text-sm mb-8 max-w-xl mx-auto leading-relaxed">Your support helps us continue providing education, protection, and opportunities for disadvantaged children.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('donate') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                Donate Now
            </a>
            <a href="{{ route('involved') }}" class="btn-outline">Get Involved</a>
        </div>
    </div>
</section>

@endsection
