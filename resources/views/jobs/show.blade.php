@extends('layouts.app')

@section('title', $jobOpportunity->localized_title . ' — Krousar Thmey')
@section('description', $jobOpportunity->localized_description ?? 'Job opportunity at Krousar Thmey')

@section('content')

{{-- Header Banner --}}
<div class="relative bg-slate-50 border-b border-slate-100 py-12 overflow-hidden" data-reveal="up">
    <div class="absolute inset-0 opacity-40">
        <div class="absolute -top-10 -right-10 w-72 h-72 rounded-full bg-[#2d6fa3]/10 blur-3xl"></div>
        <div class="absolute -bottom-10 -left-10 w-48 h-48 rounded-full bg-[#8da83a]/10 blur-3xl"></div>
    </div>
    
    <div class="relative max-w-6xl mx-auto px-6">
        <div class="flex flex-col gap-4">
            <a href="{{ route('involved') }}#jobs" class="group/back inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-[#2d6fa3] transition-colors self-start">
                <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover/back:-translate-x-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to Opportunities
            </a>
            
            <div class="flex flex-wrap items-start gap-3">
                <h1 class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-slate-800 leading-tight uppercase tracking-wide">
                    {{ $jobOpportunity->localized_title }}
                </h1>
                <span class="inline-flex items-center gap-1 text-xs font-bold px-3 py-1 rounded-full border shadow-sm mt-1.5 uppercase tracking-wider transition-transform duration-300 hover:scale-105
                    {{ $jobOpportunity->status === 'open' ? 'bg-green-50 text-green-700 border-green-200' : ($jobOpportunity->status === 'filled' ? 'bg-yellow-50 text-yellow-700 border-yellow-200' : 'bg-red-50 text-red-700 border-red-200') }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $jobOpportunity->status === 'open' ? 'bg-green-600 animate-pulse' : ($jobOpportunity->status === 'filled' ? 'bg-amber-600' : 'bg-rose-600') }}"></span>
                    {{ $jobOpportunity->status === 'filled' ? 'FILLED' : strtoupper($jobOpportunity->status) }}
                </span>
            </div>
            
            <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-slate-500 text-xs md:text-sm">
                @if($jobOpportunity->type)
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 002 2v10a2 2 0 002 2z"/></svg>
                    {{ $jobOpportunity->type }}
                </span>
                @endif
                @if($jobOpportunity->location)
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    {{ $jobOpportunity->location }}
                </span>
                @endif
                @if($jobOpportunity->posted_date)
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Posted: {{ $jobOpportunity->posted_date->format('M d, Y') }}
                </span>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Content Section --}}
<section class="bg-white py-12">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            
            {{-- Main Content --}}
            <div class="lg:col-span-8 flex flex-col gap-8" data-reveal="left">
                @if($jobOpportunity->image)
                <div class="group/img relative my-2 flex justify-center">
                    {{-- Ambient Glow Backdrop --}}
                    <div class="absolute -inset-2 bg-gradient-to-r from-[#2d6fa3]/20 via-[#8da83a]/20 to-[#2d6fa3]/20 rounded-3xl blur-xl opacity-60 group-hover/img:opacity-100 transition-opacity duration-500"></div>
                    
                    {{-- Creative Gradient Ring Frame --}}
                    <div class="relative p-1 bg-gradient-to-tr from-[#2d6fa3]/30 via-white to-[#8da83a]/30 rounded-3xl shadow-lg border border-white/80 overflow-hidden bg-white">
                        <img src="{{ asset('storage/' . $jobOpportunity->image) }}" alt="{{ $jobOpportunity->localized_title }}"
                             class="max-h-64 md:max-h-72 w-auto object-contain rounded-2xl group-hover/img:scale-[1.025] transition-transform duration-500 ease-out"
                             onerror="this.closest('.group\\/img').style.display='none';">
                        
                        {{-- Branded Glass Watermark Tag --}}
                        <div class="absolute bottom-3 right-3 z-10 inline-flex items-center gap-1.5 px-3 py-1 bg-white/80 backdrop-blur-md rounded-full text-[10px] font-extrabold text-[#2d6fa3] shadow-md border border-white/60 select-none group-hover/img:bg-white transition-all duration-300">
                            <svg class="w-3.5 h-3.5 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span>Krousar Thmey</span>
                        </div>
                    </div>
                </div>
                @endif

                <div>
                    <h2 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Job Description & Requirements
                    </h2>
                    
                    @if($jobOpportunity->description)
                    <div class="text-slate-600 text-sm leading-relaxed whitespace-pre-line prose max-w-none">
                        {{ $jobOpportunity->localized_description }}
                    </div>
                    @else
                    <p class="text-slate-400 text-sm italic">No description provided for this opening.</p>
                    @endif
                </div>
            </div>
            
            {{-- Sidebar --}}
            <div class="lg:col-span-4 flex flex-col gap-6" data-reveal="right">
                
                {{-- How to Apply Card --}}
                <div class="relative overflow-hidden bg-gradient-to-br from-[#2d6fa3] to-[#1d4e7a] text-white rounded-3xl p-6 shadow-md border border-[#2d6fa3]/30 hover:shadow-xl hover:-translate-y-1.5 transition-all duration-500">
                    <div class="absolute -right-8 -top-8 w-24 h-24 rounded-full bg-white/5"></div>
                    <div class="absolute -left-8 -bottom-8 w-20 h-20 rounded-full bg-white/5"></div>
                    
                    <h3 class="text-base font-extrabold uppercase tracking-wider mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#8da83a] bg-white/10 p-1 rounded-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2-2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        How to Apply
                    </h3>
                    
                    <p class="text-white/85 text-xs leading-relaxed mb-6">
                        Send your CV and a cover letter detailing your qualifications and experience to our HR department. Please specify the job title <strong>"{{ $jobOpportunity->localized_title }}"</strong> in the subject line of your email.
                    </p>
                    
                    {{-- Contact info grid --}}
                    <div class="flex flex-col gap-4 border-t border-white/10 pt-4 mb-6">
                        <div class="flex items-start gap-3 group/item p-1.5 rounded-xl hover:bg-white/10 transition-all duration-300">
                            <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-white shrink-0 group-hover/item:scale-110 transition-transform duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <span class="block text-[10px] text-white/50 uppercase tracking-wider font-semibold">Phone Support</span>
                                <div class="flex flex-col gap-0.5 text-xs font-semibold">
                                    <a href="tel:023880502" class="hover:text-[#8da83a] transition-colors">023 880 502</a>
                                    <a href="tel:023880503" class="hover:text-[#8da83a] transition-colors">023 880 503</a>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-start gap-3 group/item p-1.5 rounded-xl hover:bg-white/10 transition-all duration-300">
                            <div class="w-8 h-8 rounded-lg bg-white/10 flex items-center justify-center text-white shrink-0 group-hover/item:scale-110 transition-transform duration-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <span class="block text-[10px] text-white/50 uppercase tracking-wider font-semibold">HR Department Email</span>
                                <a href="#" onclick="event.preventDefault(); openEmail('hr@krousar-thmey.org')" class="text-xs font-semibold hover:text-[#8da83a] transition-colors break-all">
                                    hr@krousar-thmey.org
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="#" onclick="event.preventDefault(); window.location.href = 'mailto:hr@krousar-thmey.org?subject=' + encodeURIComponent('Application for ' + '{{ $jobOpportunity->localized_title }}');"
                       class="block w-full text-center bg-[#8da83a] hover:bg-[#a3c04a] text-white font-bold text-xs uppercase tracking-wider py-3.5 px-4 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg hover:scale-[1.02] active:scale-[0.98] border border-[#a3c04a]/10">
                        Apply via Email
                    </a>
                </div>

                {{-- Job details Card --}}
                <div class="bg-slate-50 border border-slate-100 rounded-3xl p-6 flex flex-col gap-4 hover:shadow-md hover:border-slate-200 hover:-translate-y-1 transition-all duration-500">
                    <h4 class="text-xs font-bold text-slate-400 uppercase tracking-wider border-b border-slate-200/60 pb-2">
                        Summary
                    </h4>
                    
                    <div class="flex flex-col gap-3.5 text-xs">
                        <div class="flex justify-between items-center border-b border-slate-100 pb-2.5">
                            <span class="text-slate-400">Position Status</span>
                            <span class="font-bold text-slate-700 capitalize">
                                {{ $jobOpportunity->status === 'filled' ? 'Position Filled' : $jobOpportunity->status }}
                            </span>
                        </div>
                        @if($jobOpportunity->type)
                        <div class="flex justify-between items-center border-b border-slate-100 pb-2.5">
                            <span class="text-slate-400">Employment Type</span>
                            <span class="font-bold text-slate-700">{{ $jobOpportunity->type }}</span>
                        </div>
                        @endif
                        @if($jobOpportunity->location)
                        <div class="flex flex-col gap-1.5 border-b border-slate-100 pb-2.5">
                            <span class="text-slate-400 font-semibold">Location</span>
                            <div class="font-semibold text-slate-700 text-xs bg-white p-2.5 rounded-xl border border-slate-200/70 hover:border-[#8da83a]/40 flex items-start gap-2 shadow-2xs transition-all duration-300">
                                <svg class="w-4 h-4 text-[#8da83a] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span class="leading-relaxed text-slate-700 break-words">{{ $jobOpportunity->location }}</span>
                            </div>
                        </div>
                        @endif
                        @if($jobOpportunity->posted_date)
                        <div class="flex justify-between items-center pb-1">
                            <span class="text-slate-400">Date Posted</span>
                            <span class="font-bold text-slate-700">{{ $jobOpportunity->posted_date->format('M d, Y') }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <a href="{{ route('involved') }}#jobs" class="group/all inline-flex items-center justify-center gap-2 w-full border border-slate-200 hover:border-slate-300 bg-white text-slate-600 hover:text-[#2d6fa3] hover:bg-slate-50 py-3 rounded-2xl text-xs font-bold transition-all duration-300 shadow-sm hover:shadow">
                    <svg class="w-4 h-4 text-slate-400 group-hover/all:text-[#2d6fa3] transition-transform duration-300 group-hover/all:-translate-x-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    All Open Positions
                </a>
            </div>

        </div>
    </div>
</section>

@endsection
