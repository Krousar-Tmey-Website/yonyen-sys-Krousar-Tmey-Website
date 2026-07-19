@extends('layouts.app')

@section('title', $item->title . ' — Krousar Thmey')
@section('description', $item->short_content ?? $item->title)

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
                <span class="w-1.5 h-1.5 rounded-full bg-[#d32f2f]"></span>
                <a href="{{ route('programs') }}" class="text-xs font-semibold text-gray-500 hover:text-[#1a3c6e] uppercase tracking-wider transition-colors">Our Programs</a>
            </div>

            {{-- Title --}}
            <div class="flex items-stretch gap-5 mb-6">
                <div class="w-1.5 rounded-full bg-gradient-to-b from-[#d32f2f] to-[#e8a020]"></div>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-[#1a3c6e] uppercase tracking-wide leading-tight drop-shadow-sm">
                    {{ $item->title }}
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
                    
                    {{-- Objective Block --}}
                    @if($item->objective)
                    <div class="bg-blue-50/50 rounded-3xl p-8 border border-blue-100/50 shadow-sm relative overflow-hidden group hover:shadow-md transition-shadow">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-[#1a3c6e]/5 rounded-full -translate-y-1/2 translate-x-1/3 blur-xl group-hover:scale-110 transition-transform duration-700"></div>
                        <div class="flex items-center gap-3 mb-5 relative z-10">
                            <div class="w-8 h-8 rounded-full bg-[#1a3c6e] flex items-center justify-center text-white shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                            </div>
                            <h3 class="text-lg font-black text-[#1a3c6e] uppercase tracking-widest m-0">Objective</h3>
                        </div>
                        <p class="text-gray-700 text-[16px] leading-relaxed relative z-10">{{ $item->objective }}</p>
                    </div>
                    @endif

                    {{-- The Project (Detail) --}}
                    @if($item->detail_content)
                    <div class="bg-white">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-2 h-2 rounded-full bg-[#8da83a]"></div>
                            <h3 class="text-xl font-black text-[#1a3c6e] uppercase tracking-widest m-0">Our Approach</h3>
                        </div>
                        <div class="prose prose-lg max-w-none
                                    prose-headings:text-[#1a3c6e] prose-headings:font-black
                                    prose-h2:text-2xl prose-h2:mt-10 prose-h2:mb-5
                                    prose-h3:text-xl
                                    prose-p:text-gray-600 prose-p:text-[16px] prose-p:leading-loose
                                    prose-a:text-[#2d6fa3] prose-a:font-semibold prose-a:no-underline hover:prose-a:underline
                                    prose-strong:text-[#1a3c6e]
                                    prose-ul:text-gray-600 prose-ul:text-[16px] prose-li:marker:text-[#8da83a]
                                    prose-img:rounded-3xl prose-img:shadow-md">
                            {!! $item->detail_content !!}
                        </div>
                    </div>
                    @endif

                    {{-- Activities --}}
                    @if($item->activities)
                    <div class="bg-gray-50 rounded-3xl p-8 border border-gray-100 shadow-sm">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="w-2 h-2 rounded-full bg-[#e8a020]"></div>
                            <h3 class="text-xl font-black text-[#1a3c6e] uppercase tracking-widest m-0">Key Activities</h3>
                        </div>
                        <ul class="space-y-3">
                            @foreach(explode("\n", str_replace("\r", "", $item->activities)) as $activityLine)
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

                    {{-- Social Share --}}
                    <div class="pt-10 mt-10 border-t border-gray-100">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-4">Share this project</h4>
                        <div class="flex gap-3">
                            @php
                                $shareUrl = urlencode(request()->url());
                                $shareTitle = urlencode($item->title);
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
                            <button onclick="if(navigator.share) { navigator.share({title: '{{ $item->title }}', url: '{{ $shareUrl }}'}); }"
                               class="w-11 h-11 bg-gray-100 text-gray-600 hover:bg-gray-800 hover:text-white rounded-xl flex items-center justify-center transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                            </button>
                        </div>
                    </div>
                </div>


                {{-- RIGHT: Images --}}
                <div class="lg:w-5/12 lg:sticky lg:top-28 space-y-6" x-data="{ lightboxImage: null }">
                    @php
                        $rawUrls = [];
                        if ($item->image) $rawUrls[] = $item->image_url;
                        if ($item->image_2) $rawUrls[] = $item->image_2_url;
                        if ($item->image_3) $rawUrls[] = $item->image_3_url;
                        $imageUrls = array_values(array_unique($rawUrls));
                    @endphp
                    
                    
                    @forelse($imageUrls as $index => $imgUrl)
                    <div class="relative w-full aspect-square cursor-pointer group rounded-3xl overflow-hidden shadow-sm" @click="lightboxImage = '{{ $imgUrl }}'">
                        <img src="{{ $imgUrl }}" alt="{{ $item->title }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                        {{-- Hover Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1a3c6e]/80 via-[#1a3c6e]/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <div class="w-14 h-14 rounded-full bg-white/20 backdrop-blur-md flex items-center justify-center transform scale-75 group-hover:scale-100 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                            </div>
                        </div>
                    </div>
                    @empty
                    {{-- Placeholder if no images --}}
                    <div class="w-full aspect-square rounded-3xl bg-gray-50 border-2 border-dashed border-gray-200 flex flex-col items-center justify-center text-gray-400">
                        <svg class="w-12 h-12 mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L28 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <p class="text-sm font-medium">No images available</p>
                    </div>
                    @endforelse

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
        </div>
    </section>

@endsection