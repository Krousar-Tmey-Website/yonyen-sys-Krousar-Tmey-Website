@extends('layouts.app')

@section('title', $item->title . ' — Krousar Thmey')
@section('description', $item->short_content ?? $item->title)

@section('content')

{{-- Page Header --}}
<div class="bg-[#1a3c6e] pt-16 pb-24 relative overflow-hidden">
    <div class="absolute inset-0 z-0">
        @if($item->image_url)
            <img src="{{ $item->image_url }}" class="w-full h-full object-cover opacity-20 mix-blend-overlay" alt="">
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-[#1a3c6e] via-[#1a3c6e]/80 to-transparent"></div>
    </div>
    
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white/5 -translate-y-1/2 translate-x-1/3 blur-3xl z-0"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a]/20 translate-y-1/2 -translate-x-1/4 blur-3xl z-0"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/50 mb-8 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('programs') }}" class="hover:text-white transition-colors">Our Programs</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/80">{{ Str::limit($item->title, 50) }}</span>
        </nav>

        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur border border-white/20 mb-4 shadow-sm">
            <div class="w-1.5 h-1.5 rounded-full bg-[#e8a020] animate-pulse"></div>
            <span class="text-white font-semibold text-xs uppercase tracking-widest shadow-sm">Program Update</span>
        </div>

        <h1 class="text-3xl md:text-5xl font-black text-white mb-0 max-w-4xl leading-tight tracking-wide drop-shadow-md">{{ $item->title }}</h1>
    </div>
</div>

{{-- Main Content --}}
<section class="bg-gray-50 py-12 -mt-8 relative z-20">
    <div class="max-w-6xl mx-auto px-6">

        @php
            $rawUrls   = array_filter([$item->image_url, $item->image_2_url, $item->image_3_url]);
            $imageUrls = array_values(array_unique($rawUrls));
            $imgCount  = count($imageUrls);

            // Admin parsing: fallbacks gracefully
            $metaDate  = clone $item->created_at;
            $metaDateFormatted = $metaDate->format('F j, Y');
            $metaTags  = [];
            $introPara = $item->short_content;
            
            // Allow admin to override date/tags using "Date | tag, tag\n\nContent" pattern
            if ($item->short_content && str_contains($item->short_content, "\n\n")) {
                $parts = preg_split('/\n\n+/', trim($item->short_content), 2);
                $first = $parts[0] ?? '';
                $rest  = $parts[1] ?? '';
                if (str_contains($first, '|')) {
                    [$dateStr, $tagStr] = explode('|', $first, 2);
                    $metaDateFormatted = trim($dateStr) ?: $metaDateFormatted;
                    $metaTags = array_filter(array_map('trim', explode(',', $tagStr)));
                    $introPara = $rest;
                }
            }
        @endphp

        {{-- Two-column layout --}}
        <div class="grid lg:grid-cols-12 gap-10">

            {{-- LEFT: article body (8 cols) --}}
            <div class="lg:col-span-8 space-y-10">

                {{-- Image Gallery --}}
                @if($imgCount > 0)
                <div class="bg-white p-2 rounded-3xl shadow-sm border border-gray-100">
                    <div class="rounded-2xl overflow-hidden relative group">
                        <img src="{{ $imageUrls[0] }}"
                             alt="{{ $item->title }}"
                             class="w-full h-[400px] object-cover transition-transform duration-700 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    
                    @if($imgCount > 1)
                    <div class="grid grid-cols-{{ $imgCount - 1 }} gap-2 mt-2">
                        @for($i = 1; $i < $imgCount; $i++)
                        <div class="rounded-xl overflow-hidden relative group h-40">
                            <img src="{{ $imageUrls[$i] }}"
                                 alt="{{ $item->title }}"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors duration-300"></div>
                        </div>
                        @endfor
                    </div>
                    @endif
                </div>
                @endif

                <div class="bg-white rounded-3xl p-8 md:p-10 shadow-sm border border-gray-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-gray-50 to-white rounded-full translate-x-1/3 -translate-y-1/3 z-0"></div>
                    
                    <div class="relative z-10">
                        {{-- Pull-quote intro --}}
                        @if($introPara)
                        <div class="mb-10 text-xl font-medium text-[#1a3c6e] leading-relaxed relative">
                            <svg class="absolute -top-4 -left-4 w-12 h-12 text-[#8da83a]/10 transform -rotate-12" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                            <p class="relative z-10">{{ $introPara }}</p>
                        </div>
                        @endif

                        {{-- Full detail content --}}
                        @if($item->detail_content)
                        <div class="prose prose-lg max-w-none
                                    prose-headings:text-[#1a3c6e] prose-headings:font-black
                                    prose-h2:text-2xl prose-h2:mt-10 prose-h2:mb-4
                                    prose-h3:text-xl
                                    prose-p:text-gray-600 prose-p:leading-relaxed
                                    prose-a:text-[#2d6fa3] prose-a:font-semibold prose-a:no-underline hover:prose-a:underline
                                    prose-strong:text-[#1a3c6e]
                                    prose-ul:text-gray-600 prose-li:marker:text-[#8da83a]
                                    prose-img:rounded-2xl prose-img:shadow-sm">
                            {!! $item->detail_content !!}
                        </div>
                        @endif
                    </div>
                </div>

                {{-- Back link --}}
                <div class="pt-4 flex items-center justify-between">
                    <a href="{{ route('programs') }}"
                       class="inline-flex items-center gap-3 px-6 py-3 rounded-full bg-white shadow-sm border border-gray-200 text-[#2d6fa3] hover:text-[#1a3c6e] hover:border-[#2d6fa3]/30 hover:shadow-md font-semibold text-sm transition-all group">
                        <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Back to Our Programs
                    </a>
                </div>
            </div>

            {{-- RIGHT: sidebar (4 cols) --}}
            <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-24 self-start">

                {{-- Meta card --}}
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                    <h4 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-5 flex items-center gap-2">
                        <svg class="w-4 h-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Article Info
                    </h4>
                    
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center flex-shrink-0 text-[#2d6fa3]">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 font-medium mb-1">Published</p>
                            <p class="text-sm text-gray-800 font-bold">{{ $metaDateFormatted }}</p>
                        </div>
                    </div>
                    
                    @if(count($metaTags))
                    <div class="pt-5 border-t border-gray-100">
                        <p class="text-xs text-gray-400 font-medium mb-3">Tags</p>
                        <div class="flex flex-wrap gap-2">
                            @foreach($metaTags as $tag)
                            <span class="px-3 py-1.5 rounded-lg bg-gray-50 border border-gray-100 text-gray-600 text-xs font-semibold hover:bg-gray-100 transition-colors">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                {{-- Donate CTA --}}
                <div class="bg-gradient-to-br from-[#8da83a] to-[#738b2d] rounded-3xl p-6 shadow-md text-white relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full translate-x-8 -translate-y-8 transform group-hover:scale-110 transition-transform duration-500"></div>
                    <div class="relative z-10">
                        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center mb-4 backdrop-blur">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        </div>
                        <h4 class="text-lg font-black tracking-wide mb-2">Support Our Cause</h4>
                        <p class="text-white/80 text-sm leading-relaxed mb-6 font-medium">Your donation helps us provide education, protection, and opportunities for children in need.</p>
                        <a href="{{ route('donate') }}" class="flex items-center justify-center gap-2 w-full px-5 py-3 bg-white text-[#738b2d] rounded-xl font-bold text-sm hover:bg-gray-50 transition-colors shadow-sm">
                            Make a Donation
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

@endsection
