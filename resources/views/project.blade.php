@extends('layouts.app')

@section('title', $project->title . ' — Krousar Thmey')
@section('description', $project->description ?? $project->title)

@section('content')

    {{-- Premium Header --}}
    <div class="relative bg-gradient-to-b from-gray-50 to-white pt-16 pb-12 overflow-hidden border-b border-gray-100">
        {{-- Decorative Blur Orbs --}}
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#1a3c6e]/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-[#d32f2f]/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4"></div>

        <div class="relative max-w-7xl mx-auto px-6 z-10">
            {{-- Breadcrumb / Badge --}}
            <div class="flex items-center gap-3 mb-8">
                <span class="px-4 py-1.5 rounded-full bg-[#1a3c6e] text-white text-xs font-bold uppercase tracking-widest shadow-sm">
                    Project
                </span>
                @if($project->program)
                <span class="w-1.5 h-1.5 rounded-full bg-[#d32f2f]"></span>
                <a href="{{ route('programs') }}#{{ $project->program->slug }}" class="text-xs font-semibold text-gray-500 hover:text-[#1a3c6e] uppercase tracking-wider transition-colors">{{ $project->program->title }}</a>
                @endif
            </div>

            {{-- Title --}}
            <div class="flex items-stretch gap-5 mb-6">
                <div class="w-1.5 rounded-full bg-gradient-to-b from-[#d32f2f] to-[#e8a020]"></div>
                <h1 class="text-3xl md:text-4xl lg:text-[40px] font-extrabold text-[#1a3c6e] uppercase tracking-tight leading-tight drop-shadow-sm">
                    {{ $project->title }}
                </h1>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <section class="bg-white py-12 lg:py-20 relative z-20">
        <div class="max-w-7xl mx-auto px-6">
            
            <div class="flex flex-col lg:flex-row gap-16 items-start">
                
                {{-- LEFT: Text Content --}}
                <div class="lg:w-7/12 space-y-12">
                    
                    {{-- Description (Intro) --}}
                    @if($project->description)
                    <div class="text-xl font-medium text-[#1a3c6e] leading-relaxed relative" data-reveal="up">
                        <svg class="absolute -top-4 -left-4 w-12 h-12 text-[#8da83a]/10 transform -rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                        <div class="relative z-10 prose prose-lg max-w-none">{!! $project->description !!}</div>
                    </div>
                    @endif

                    {{-- Objective Block --}}
                    @if($project->objective)
                    <div class="bg-blue-50/50 rounded-3xl p-8 border border-blue-100/50 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow" data-reveal="up">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-[#1a3c6e]/5 rounded-full -translate-y-1/2 translate-x-1/3 blur-xl group-hover:scale-110 transition-transform duration-700"></div>
                        <div class="flex items-center gap-3 mb-5 relative z-10">
                            <div class="w-8 h-8 rounded-full bg-[#1a3c6e] flex items-center justify-center text-white shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <h3 class="text-lg font-black text-[#1a3c6e] uppercase tracking-widest m-0">Objective</h3>
                        </div>
                        <div class="text-gray-700 text-[16px] leading-relaxed relative z-10 whitespace-pre-line prose prose-lg max-w-none">{!! $project->objective !!}</div>
                    </div>
                    @endif

                    {{-- The Project (Detail) --}}
                    @if($project->content)
                    <div class="bg-white" data-reveal="up">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-2 h-2 rounded-full bg-[#8da83a]"></div>
                            <h3 class="text-xl font-black text-[#1a3c6e] uppercase tracking-widest m-0">The Project</h3>
                        </div>
                        <div class="prose prose-lg max-w-none
                                    prose-headings:text-[#1a3c6e] prose-headings:font-black
                                    prose-p:text-gray-600 prose-p:text-[16px] prose-p:leading-loose
                                    prose-a:text-[#2d6fa3] prose-a:font-semibold prose-a:no-underline hover:prose-a:underline
                                    prose-strong:text-[#1a3c6e]
                                    prose-ul:text-gray-600 prose-ul:text-[16px] prose-li:marker:text-[#8da83a]">
                            <div class="whitespace-pre-line">{!! $project->content !!}</div>
                        </div>
                    </div>
                    @endif

                    {{-- Activities --}}
                    @if($project->activities)
                    <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 shadow-sm" data-reveal="up">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="w-2 h-2 rounded-full bg-[#e8a020]"></div>
                            <h3 class="text-xl font-black text-[#1a3c6e] uppercase tracking-widest m-0">Key Activities</h3>
                        </div>
                        <ul class="space-y-3">
                            @foreach(explode("\n", str_replace("\r", "", $project->activities)) as $activityLine)
                                @if(trim($activityLine))
                                <li class="flex items-start gap-4 p-4 rounded-2xl bg-white shadow-sm border border-gray-100 hover:border-[#1a3c6e]/20 hover:shadow-md transition-all group">
                                    <div class="w-7 h-7 rounded-full bg-[#1a3c6e]/5 flex items-center justify-center flex-shrink-0 mt-0.5 group-hover:bg-[#1a3c6e]/10 transition-colors">
                                        <div class="w-2.5 h-2.5 rounded-full bg-[#1a3c6e]"></div>
                                    </div>
                                    <span class="text-gray-700 text-[15px] font-medium leading-relaxed pt-1">{{ trim($activityLine) }}</span>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    {{-- Make a Difference --}}
                    @if($project->effective_make_difference_text)
                    <div class="bg-yellow-50/50 rounded-3xl p-8 border border-yellow-100/50 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow" data-reveal="up">
                        <div class="absolute bottom-0 left-0 w-32 h-32 bg-[#e8a020]/10 rounded-full translate-y-1/2 -translate-x-1/3 blur-xl group-hover:scale-110 transition-transform duration-700"></div>
                        <div class="flex items-center gap-3 mb-5 relative z-10">
                            <div class="w-8 h-8 rounded-full bg-[#e8a020] flex items-center justify-center text-white shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <h3 class="text-lg font-black text-[#1a3c6e] uppercase tracking-widest m-0">{{ $project->effective_make_difference_title ?: 'Make a Difference' }}</h3>
                        </div>
                        <p class="text-gray-700 text-[16px] leading-relaxed relative z-10 whitespace-pre-line">{{ $project->effective_make_difference_text }}</p>
                        
                        <div class="mt-6 flex flex-col sm:flex-row gap-4 relative z-10">
                            @if($project->effective_donate_button_text)
                            <a href="{{ route('donate') }}" class="px-6 py-3 bg-[#d32f2f] hover:bg-[#b72424] text-white text-sm font-bold uppercase tracking-wider rounded-xl shadow-md hover:shadow-lg transition-all flex items-center justify-center">
                                {{ $project->effective_donate_button_text }}
                            </a>
                            @endif
                            @if($project->effective_contact_button_text)
                            <a href="{{ route('contact') }}" class="px-6 py-3 bg-[#1a3c6e] hover:bg-[#122b52] text-white text-sm font-bold rounded-xl shadow-md hover:shadow-lg transition-all flex items-center justify-center text-center">
                                {{ $project->effective_contact_button_text }}
                            </a>
                            @endif
                        </div>
                    </div>
                    @endif

                    {{-- Grants --}}
                    @if($project->grants->isNotEmpty())
                    <div class="pt-4" data-reveal="up">
                        <h3 class="text-xl font-black text-[#1a3c6e] uppercase tracking-widest mb-6">Income Generation Grants</h3>
                        <div class="grid sm:grid-cols-2 gap-4">
                            @foreach($project->grants as $grant)
                            <div class="bg-white rounded-3xl border border-gray-100 p-6 flex flex-col gap-2 shadow-sm hover:border-[#8da83a]/30 hover:shadow-md transition-all group">
                                <div class="w-12 h-12 rounded-xl bg-[#8da83a]/10 text-[#8da83a] flex items-center justify-center flex-shrink-0 group-hover:bg-[#8da83a] group-hover:text-white transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                                <div class="mt-2">
                                    <p class="text-[11px] font-black text-[#8da83a] uppercase tracking-widest mb-1">{{ $grant->title ?: 'Grant' }}</p>
                                    <p class="text-3xl font-black text-[#1a3c6e]">${{ number_format($grant->amount, 2) }}</p>
                                    <p class="text-[13px] text-gray-500 mt-2 font-medium leading-snug">
                                        @if($grant->label){{ $grant->label }}@endif
                                        @if($grant->label && $grant->recipient) &middot; @endif
                                        @if($grant->recipient){{ $grant->recipient }}@endif
                                    </p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- Social Share --}}
                    <div class="pt-10 mt-10 border-t border-gray-100" data-reveal="up">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Share this project</h4>
                        <div class="flex gap-3">
                            @php
                                $shareUrl = urlencode(request()->url());
                                $shareTitle = urlencode($project->title);
                            @endphp
                            {{-- Facebook --}}
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" rel="noopener"
                               class="w-11 h-11 bg-[#1877f2]/10 text-[#1877f2] hover:bg-[#1877f2] hover:text-white rounded-xl flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            {{-- Twitter --}}
                            <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" target="_blank" rel="noopener"
                               class="w-11 h-11 bg-[#1da1f2]/10 text-[#1da1f2] hover:bg-[#1da1f2] hover:text-white rounded-xl flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                            {{-- LinkedIn --}}
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ $shareUrl }}&title={{ $shareTitle }}" target="_blank" rel="noopener"
                               class="w-11 h-11 bg-[#0a66c2]/10 text-[#0a66c2] hover:bg-[#0a66c2] hover:text-white rounded-xl flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                            </a>
                            {{-- Generic Share --}}
                            <button onclick="if(navigator.share) { navigator.share({title: '{{ $project->title }}', url: '{{ $shareUrl }}'}); }"
                               class="w-11 h-11 bg-gray-100 text-gray-600 hover:bg-gray-800 hover:text-white rounded-xl flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- RIGHT: Sidebar (Images + Info) --}}
                <div class="lg:w-5/12 space-y-8 lg:sticky lg:top-28" x-data="{ lightboxImage: null }">
                    
                    {{-- Images --}}
                    @if($project->image)
                    <div class="relative w-full h-[300px] lg:h-[350px] cursor-pointer group rounded-3xl overflow-hidden shadow-sm" @click="lightboxImage = '{{ $project->image_url }}'" data-reveal="left">
                        <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        
                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1a3c6e]/80 via-[#1a3c6e]/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <div class="w-14 h-14 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center transform scale-75 group-hover:scale-100 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                            </div>
                        </div>
                    </div>
                    @endif

                    {{-- Project info card --}}
                    @if($project->effective_area_of_work || $project->effective_duration || $project->effective_location || $project->effective_beneficiaries)
                    <div class="bg-gradient-to-br from-[#1a3c6e] to-[#2d6fa3] rounded-3xl p-8 text-white shadow-md relative overflow-hidden group" data-reveal="left">
                        <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-white/5 rounded-full blur-2xl group-hover:scale-125 transition-transform duration-700"></div>
                        
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
                                    <p class="text-white text-[15px] font-bold">{{ $project->effective_area_of_work }}</p>
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
                                    <p class="text-white text-[15px] font-bold">{{ $project->effective_duration }}</p>
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
                                    <p class="text-white text-[15px] font-bold">{{ $project->effective_location }}</p>
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
                                    <p class="text-white text-[15px] font-bold">{{ $project->effective_beneficiaries }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    {{-- Lightbox Modal --}}
                    <div x-show="lightboxImage" style="display:none;"
                         class="fixed inset-0 z-[100] bg-[#1a3c6e]/95 flex items-center justify-center p-4 lg:p-12 backdrop-blur-md"
                         @click.self="lightboxImage = null"
                         @keydown.escape.window="lightboxImage = null"
                         x-transition:enter="transition ease-out duration-300" 
                         x-transition:enter-start="opacity-0 scale-95" 
                         x-transition:enter-end="opacity-100 scale-100" 
                         x-transition:leave="transition ease-in duration-200" 
                         x-transition:leave-start="opacity-100 scale-100" 
                         x-transition:leave-end="opacity-0 scale-95">
                         
                         <button @click="lightboxImage = null" class="absolute top-6 right-6 w-12 h-12 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center text-white transition-colors" aria-label="Close">
                             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                         </button>
                         
                         <img :src="lightboxImage" class="max-w-full max-h-full rounded-2xl shadow-2xl object-contain border border-white/10">
                    </div>
                </div>

            </div>

            {{-- Testimony --}}
            @if($project->testimony_name && $project->testimony_story)
            @php $cleanName = preg_replace('/^testimony\s*:?\s*/i', '', $project->testimony_name); @endphp
            <div class="mt-24" data-reveal="up">
                <div class="max-w-4xl mx-auto bg-white border border-gray-100 p-8 md:p-14 rounded-[3rem] text-center shadow-lg relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#2d6fa3] via-[#8da83a] to-[#e8a020]"></div>
                    <div class="absolute -top-32 -left-32 w-64 h-64 bg-[#2d6fa3]/5 rounded-full blur-3xl group-hover:scale-150 transition-transform duration-1000"></div>
                    
                    <div class="relative inline-block mb-8">
                        @if($project->testimony_image)
                        <img src="{{ str_starts_with($project->testimony_image, 'http') ? $project->testimony_image : asset('storage/' . $project->testimony_image) }}"
                             class="w-32 h-32 mx-auto rounded-full object-cover border-[6px] border-white shadow-xl relative z-10" alt="{{ $cleanName }}">
                        @else
                        <div class="w-32 h-32 mx-auto rounded-full bg-blue-50 flex items-center justify-center text-[#2d6fa3] font-black text-5xl border-[6px] border-white shadow-xl relative z-10">{{ substr($cleanName, 0, 1) }}</div>
                        @endif
                        <div class="absolute -top-3 left-1/2 -translate-x-1/2 z-20 w-12 h-12 bg-[#e8a020] text-white rounded-full flex items-center justify-center shadow-lg border-4 border-white">
                            <span class="text-4xl leading-none font-serif mt-2 relative top-0.5">"</span>
                        </div>
                    </div>
                    
                    <p class="text-[#2d6fa3] font-bold text-xs tracking-widest uppercase mb-1">Impact Testimony</p>
                    <p class="text-gray-900 font-bold text-lg md:text-xl mb-8 px-4">{{ $cleanName }}</p>
                    
                    <div x-data="{ open: false }" class="bg-gray-50/80 rounded-[2rem] text-left border border-gray-100 relative group-hover:bg-white group-hover:shadow-sm transition-all duration-500 overflow-hidden">
                        <button @click="open = !open" class="w-full flex items-center justify-between p-8 md:p-10 hover:bg-gray-100/50 transition-colors focus:outline-none">
                            <span class="text-[#1a3c6e] font-bold text-sm uppercase tracking-widest">Read The Full Story</span>
                            <svg class="w-6 h-6 text-[#1a3c6e] transform transition-transform duration-500" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" style="display: none;" class="px-8 pb-8 md:px-10 md:pb-10 pt-2 border-t border-gray-200/50" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                            <svg class="absolute -top-5 -left-5 w-16 h-16 text-[#1a3c6e]/5" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                            <div class="text-gray-700 leading-relaxed text-[16px] whitespace-pre-line font-medium relative z-10 prose prose-lg max-w-none">{!! $project->testimony_story !!}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </section>

    {{-- CTA Banner --}}
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
                <a href="{{ route('donate') }}" class="px-8 py-3.5 bg-[#8da83a] hover:bg-[#a3c04a] text-white rounded-xl font-bold shadow-lg hover:shadow-xl transition-all">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    Donate Now
                </a>
                <a href="{{ route('involved') }}" class="px-8 py-3.5 rounded-xl bg-transparent border-2 border-white/30 text-white hover:bg-white hover:text-[#1a3c6e] font-bold transition-colors">
                    Get Involved
                </a>
            </div>
        </div>
    </section>

@endsection
