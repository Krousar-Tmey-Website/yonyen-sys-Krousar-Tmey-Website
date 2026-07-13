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
@endphp

<div class="bg-[#1a3c6e] pt-16 pb-24 relative overflow-hidden">
    <div class="absolute inset-0 z-0">
        @if($bannerImgSrc)
            <img src="{{ $bannerImgSrc }}" class="w-full h-full object-cover opacity-30 mix-blend-overlay" alt="">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-[#1a3c6e] via-[#1a3c6e]/80 to-transparent"></div>
    </div>

    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white/5 -translate-y-1/2 translate-x-1/3 blur-3xl z-0"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a]/20 translate-y-1/2 -translate-x-1/4 blur-3xl z-0"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">
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
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur border border-white/20 mb-5 shadow-sm">
            <div class="w-1.5 h-1.5 rounded-full bg-[#e8a020] animate-pulse"></div>
            <span class="text-white font-semibold text-xs uppercase tracking-widest shadow-sm">
                {{ $project->program ? $project->program->title : 'Project' }}
            </span>
        </div>

        <h1 class="text-3xl md:text-5xl font-black text-white mb-0 max-w-4xl leading-tight tracking-wide drop-shadow-md">{{ $project->title }}</h1>
    </div>
</div>

{{-- ── Main Content ─────────────────────────────────────────────── --}}
<section class="bg-gray-50 py-12 -mt-8 relative z-20">
    <div class="max-w-6xl mx-auto px-6">

        {{-- Two-column layout: content + sidebar --}}
        <div class="grid lg:grid-cols-12 gap-10 items-start">

            {{-- Left: text content (8 cols) --}}
            <div class="lg:col-span-8 space-y-10">

                {{-- Hero image --}}
                @if($project->image)
                <div class="bg-white p-2 rounded-3xl shadow-sm border border-gray-100">
                    <div class="rounded-2xl overflow-hidden relative group">
                        <img src="{{ $project->image_url }}" alt="{{ $project->title }}"
                             class="w-full h-64 md:h-96 object-cover object-center transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                </div>
                @endif

                <div class="bg-white rounded-3xl p-8 md:p-10 shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-gray-50 to-white rounded-full translate-x-1/3 -translate-y-1/3 z-0"></div>
                    
                    <div class="relative z-10 space-y-8">
                        @if($project->description)
                        <div class="text-xl font-medium text-[#1a3c6e] leading-relaxed relative">
                            <svg class="absolute -top-4 -left-4 w-12 h-12 text-[#8da83a]/10 transform -rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                            <p class="relative z-10">{{ $project->description }}</p>
                        </div>
                        @endif

                        @if($project->objective)
                        <div>
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-8 h-8 rounded-full bg-red-50 text-red-500 flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                </div>
                                <h3 class="text-lg font-black text-[#1a3c6e] uppercase tracking-wide">Objective</h3>
                            </div>
                            <p class="text-gray-600 text-[15px] leading-relaxed whitespace-pre-line ml-11">{{ $project->objective }}</p>
                        </div>
                        @endif

                        @if($project->content)
                        <div>
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-8 h-8 rounded-full bg-blue-50 text-[#2d6fa3] flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                                </div>
                                <h3 class="text-lg font-black text-[#1a3c6e] uppercase tracking-wide">Project Details</h3>
                            </div>
                            <p class="text-gray-600 text-[15px] leading-relaxed whitespace-pre-line ml-11">{{ $project->content }}</p>
                        </div>
                        @endif

                        @if($project->activities)
                        <div>
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-8 h-8 rounded-full bg-green-50 text-[#8da83a] flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                </div>
                                <h3 class="text-lg font-black text-[#1a3c6e] uppercase tracking-wide">Activities</h3>
                            </div>
                            <p class="text-gray-600 text-[15px] leading-relaxed whitespace-pre-line ml-11">{{ $project->activities }}</p>
                        </div>
                        @endif

                        @if($project->effective_make_difference_text)
                        <div class="bg-yellow-50/50 rounded-2xl p-6 border border-yellow-100/50">
                            <div class="flex items-center gap-3 mb-3">
                                <div class="w-8 h-8 rounded-full bg-yellow-100 text-[#e8a020] flex items-center justify-center">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                </div>
                                <h3 class="text-lg font-black text-[#1a3c6e] uppercase tracking-wide">Make a Difference</h3>
                            </div>
                            <p class="text-gray-700 text-[15px] leading-relaxed whitespace-pre-line ml-11">{{ $project->effective_make_difference_text }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                @if($project->grants->isNotEmpty())
                <div class="grid sm:grid-cols-2 gap-4">
                    @foreach($project->grants as $grant)
                    <div class="bg-white rounded-2xl border border-gray-100 p-6 flex items-start gap-4 shadow-sm hover:shadow-md transition-shadow group">
                        <div class="w-12 h-12 rounded-xl bg-[#8da83a]/10 text-[#8da83a] flex items-center justify-center flex-shrink-0 group-hover:bg-[#8da83a] group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-[#8da83a] uppercase tracking-widest mb-1">{{ $grant->title ?: 'Income Generation' }}</p>
                            <p class="text-2xl font-black text-[#1a3c6e]">${{ number_format($grant->amount, 2) }}</p>
                            <p class="text-[13px] text-gray-500 mt-1 font-medium">
                                @if($grant->label){{ $grant->label }}@endif
                                @if($grant->label && $grant->recipient) &middot; @endif
                                @if($grant->recipient){{ $grant->recipient }}@endif
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- Right: sidebar (4 cols) --}}
            <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-24 self-start">

                {{-- Project info card --}}
                @if($project->effective_area_of_work || $project->effective_duration || $project->effective_location || $project->effective_beneficiaries)
                <div class="bg-gradient-to-br from-[#1a3c6e] to-[#2d6fa3] rounded-3xl p-8 text-white shadow-md relative overflow-hidden">
                    <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/5 rounded-full blur-2xl"></div>
                    
                    <h4 class="font-black text-xs uppercase tracking-widest text-white/70 mb-6 pb-4 border-b border-white/10 flex items-center gap-2">
                        <svg class="w-4 h-4 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Project Information
                    </h4>
                    
                    <div class="space-y-5 relative z-10">
                        @if($project->effective_area_of_work)
                        <div class="flex gap-4">
                            <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            </div>
                            <div>
                                <p class="text-white/60 text-xs font-medium mb-0.5">Area of work</p>
                                <p class="text-white text-sm font-bold">{{ $project->effective_area_of_work }}</p>
                            </div>
                        </div>
                        @endif
                        @if($project->effective_duration)
                        <div class="flex gap-4">
                            <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <p class="text-white/60 text-xs font-medium mb-0.5">Duration</p>
                                <p class="text-white text-sm font-bold">{{ $project->effective_duration }}</p>
                            </div>
                        </div>
                        @endif
                        @if($project->effective_location)
                        <div class="flex gap-4">
                            <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-white/60 text-xs font-medium mb-0.5">Location</p>
                                <p class="text-white text-sm font-bold">{{ $project->effective_location }}</p>
                            </div>
                        </div>
                        @endif
                        @if($project->effective_beneficiaries)
                        <div class="flex gap-4">
                            <div class="w-8 h-8 rounded-full bg-white/10 flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-white/60 text-xs font-medium mb-0.5">Beneficiaries</p>
                                <p class="text-white text-sm font-bold">{{ $project->effective_beneficiaries }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                {{-- Share --}}
                <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Share this project</p>
                    <div class="flex gap-3">
                        <a href="https://www.facebook.com/KrousarThmey" target="_blank" rel="noopener"
                           class="w-10 h-10 rounded-xl bg-[#1877f2]/10 text-[#1877f2] hover:bg-[#1877f2] hover:text-white flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        <a href="https://www.linkedin.com/company/krousar-thmey/" target="_blank" rel="noopener"
                           class="w-10 h-10 rounded-xl bg-[#0a66c2]/10 text-[#0a66c2] hover:bg-[#0a66c2] hover:text-white flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="https://www.youtube.com/@KrousarThmey" target="_blank" rel="noopener"
                           class="w-10 h-10 rounded-xl bg-[#ff0000]/10 text-[#ff0000] hover:bg-[#ff0000] hover:text-white flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Testimony --}}
        @if($project->testimony_name && $project->testimony_story)
        @php $cleanName = preg_replace('/^testimony\s*:?\s*/i', '', $project->testimony_name); @endphp
        <div class="mt-20">
            <div class="max-w-4xl mx-auto bg-white border border-gray-100 p-8 md:p-12 rounded-[2.5rem] text-center shadow-lg relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#2d6fa3] to-[#8da83a]"></div>
                
                <div class="relative inline-block mb-6">
                    @if($project->testimony_image)
                    <img src="{{ str_starts_with($project->testimony_image, 'http') ? $project->testimony_image : asset('storage/' . $project->testimony_image) }}"
                         class="w-32 h-32 mx-auto rounded-full object-cover border-[6px] border-white shadow-xl relative z-10" alt="{{ $cleanName }}">
                    @else
                    <div class="w-32 h-32 mx-auto rounded-full bg-blue-50 flex items-center justify-center text-[#2d6fa3] font-black text-5xl border-[6px] border-white shadow-xl relative z-10">{{ substr($cleanName, 0, 1) }}</div>
                    @endif
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 z-20 w-10 h-10 bg-[#e8a020] text-white rounded-full flex items-center justify-center shadow-md border-4 border-white">
                        <span class="text-3xl leading-none font-serif mt-2">"</span>
                    </div>
                </div>
                
                <p class="text-[#2d6fa3] font-bold text-xs tracking-widest uppercase mb-1">Impact Testimony</p>
                <p class="text-gray-900 font-black text-xl mb-8">{{ $cleanName }}</p>
                
                <div class="bg-gray-50/80 rounded-2xl p-6 md:p-8 text-left border border-gray-100 relative">
                    <svg class="absolute -top-4 -left-4 w-12 h-12 text-[#1a3c6e]/5" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                    <p class="text-gray-700 leading-relaxed text-[15px] whitespace-pre-line font-medium relative z-10">{{ $project->testimony_story }}</p>
                </div>
            </div>
        </div>
        @endif

    </div>
</section>

{{-- ── Back bar ─────────────────────────────────────────────────── --}}
<div class="bg-white border-t border-gray-100 py-8 relative z-20">
    <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-6">
        @if($project->program)
        <a href="{{ route('programs') }}#projects-{{ $project->program->slug }}"
           class="inline-flex items-center gap-3 text-[#2d6fa3] hover:text-[#1a3c6e] font-semibold text-sm transition-colors group">
            <span class="w-10 h-10 rounded-full bg-blue-50 group-hover:bg-[#2d6fa3] group-hover:text-white flex items-center justify-center transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </span>
            Back to {{ $project->program->title }}
        </a>
        @else
        <a href="{{ route('programs') }}"
           class="inline-flex items-center gap-3 text-[#2d6fa3] hover:text-[#1a3c6e] font-semibold text-sm transition-colors group">
            <span class="w-10 h-10 rounded-full bg-blue-50 group-hover:bg-[#2d6fa3] group-hover:text-white flex items-center justify-center transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </span>
            Back to Our Programs
        </a>
        @endif
        <a href="{{ route('donate') }}" class="btn-primary px-8 py-3 rounded-xl shadow-md">
            <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            Donate Now
        </a>
    </div>
</div>

{{-- ── CTA Banner ───────────────────────────────────────────────── --}}
<section class="relative py-20 overflow-hidden bg-[#1a3c6e]">
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-[#2d6fa3]/20 -translate-y-1/2 translate-x-1/4 blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-80 h-80 rounded-full bg-[#8da83a]/10 translate-y-1/2 -translate-x-1/4 blur-3xl"></div>
    
    <div class="relative max-w-4xl mx-auto px-6 text-center z-10">
        <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white/10 backdrop-blur border border-white/20 mb-6 shadow-sm">
            <div class="w-1.5 h-1.5 rounded-full bg-[#8da83a] animate-pulse"></div>
            <span class="text-white font-semibold text-xs uppercase tracking-widest">Support Our Mission</span>
        </div>
        
        <h2 class="text-3xl md:text-5xl font-black text-white tracking-wide mb-4 drop-shadow">Help Children in Cambodia</h2>
        <p class="text-white/80 text-base md:text-lg mb-10 max-w-2xl mx-auto leading-relaxed">Your support helps us continue providing education, protection, and opportunities for disadvantaged children.</p>
        
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('donate') }}" class="btn-primary px-8 py-3.5 rounded-xl shadow-lg hover:shadow-xl transition-all">
                <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                Donate Now
            </a>
            <a href="{{ route('involved') }}" class="btn-outline px-8 py-3.5 rounded-xl bg-transparent border-2 border-white/30 text-white hover:bg-white hover:text-[#1a3c6e] transition-colors">
                Get Involved
            </a>
        </div>
    </div>
</section>

@endsection
