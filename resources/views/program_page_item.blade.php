@extends('layouts.app')

@section('title', $item->title . ' — Krousar Thmey')
@section('description', $item->short_content ?? $item->title)

@section('content')

{{-- Page Header --}}
<div class="bg-[#2d6fa3] pt-16 pb-20 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white/5 -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a]/40 translate-y-1/2 -translate-x-1/4"></div>

    <div class="relative max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/50 mb-8 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('programs') }}" class="hover:text-white transition-colors">Our Programs</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/80">{{ Str::limit($item->title, 50) }}</span>
        </nav>

        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#e8a020]/20 border border-[#e8a020]/30 mb-4">
            <div class="w-1.5 h-1.5 rounded-full bg-[#e8a020]"></div>
            <span class="text-[#e8a020] font-semibold text-xs uppercase tracking-widest">Success Story</span>
        </div>

        <h1 class="text-3xl md:text-4xl font-black text-white mb-0 max-w-3xl leading-tight uppercase tracking-wide">{{ $item->title }}</h1>
    </div>
</div>

{{-- Main Content --}}
<section class="bg-white py-12">
    <div class="max-w-6xl mx-auto px-6">

        @php
            $rawUrls   = array_filter([$item->image_url, $item->image_2_url, $item->image_3_url]);
            $imageUrls = array_values(array_unique($rawUrls));
            $imgCount  = count($imageUrls);

            // Parse short_content: "Date | tag, tag\n\nIntro text..."
            $metaDate  = '';
            $metaTags  = [];
            $introPara = '';
            if ($item->short_content) {
                $parts = preg_split('/\n\n+/', trim($item->short_content), 2);
                $first = $parts[0] ?? '';
                $rest  = $parts[1] ?? '';
                if (str_contains($first, '|')) {
                    [$dateStr, $tagStr] = explode('|', $first, 2);
                    $metaDate = trim($dateStr);
                    $metaTags = array_filter(array_map('trim', explode(',', $tagStr)));
                    $introPara = $rest;
                } else {
                    $introPara = $item->short_content;
                }
            }
        @endphp

        {{-- Two-column layout --}}
        <div class="grid lg:grid-cols-3 gap-10">

            {{-- LEFT: article body (2/3) --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- Hero image — medium, not full-bleed --}}
                @if($imgCount > 0)
                <div class="rounded-2xl overflow-hidden shadow-lg ring-1 ring-gray-200">
                    <img src="{{ $imageUrls[0] }}"
                         alt="{{ $item->title }}"
                         class="w-full h-64 md:h-80 object-cover object-center">
                </div>

                {{-- Additional distinct images in a small row --}}
                @if($imgCount > 1)
                <div class="grid grid-cols-{{ $imgCount - 1 }} gap-3">
                    @for($i = 1; $i < $imgCount; $i++)
                    <div class="rounded-xl overflow-hidden shadow ring-1 ring-gray-200">
                        <img src="{{ $imageUrls[$i] }}"
                             alt="{{ $item->title }}"
                             class="w-full h-40 object-cover object-center">
                    </div>
                    @endfor
                </div>
                @endif
                @else
                <div class="rounded-2xl overflow-hidden shadow-lg h-48 bg-gradient-to-br from-[#2d6fa3] to-[#1a3c6e] flex items-center justify-center">
                    <svg class="w-12 h-12 text-white/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                @endif

                {{-- Pull-quote intro --}}
                @if($introPara)
                <blockquote class="border-l-4 border-[#8da83a] pl-5 py-3 pr-4 bg-[#8da83a]/5 rounded-r-xl">
                    <p class="text-gray-700 text-sm leading-relaxed italic">{{ $introPara }}</p>
                </blockquote>
                @endif

                {{-- Full detail content --}}
                @if($item->detail_content)
                <div>
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-1 h-6 bg-[#d32f2f] rounded-full"></div>
                        <span class="text-xs font-bold text-[#1a3c6e] uppercase tracking-widest">Full Story</span>
                        <div class="flex-1 h-px bg-gray-100"></div>
                    </div>
                    <div class="prose prose-sm max-w-none
                                prose-headings:text-[#1a3c6e] prose-headings:font-black prose-headings:not-italic
                                prose-h2:text-lg prose-h2:uppercase prose-h2:tracking-wide prose-h2:mt-8 prose-h2:mb-3
                                prose-h3:text-base prose-h3:uppercase prose-h3:tracking-wide
                                prose-p:text-gray-600 prose-p:leading-relaxed prose-p:text-sm
                                prose-a:text-[#2d6fa3] prose-a:font-semibold
                                prose-strong:text-[#1a3c6e]
                                prose-ul:text-gray-600 prose-li:marker:text-[#8da83a] prose-li:text-sm
                                prose-img:rounded-xl prose-img:shadow-md prose-img:max-h-64 prose-img:object-cover">
                        {!! $item->detail_content !!}
                    </div>
                </div>
                @endif

                {{-- Back link --}}
                <div class="pt-4 border-t border-gray-100">
                    <a href="{{ route('programs') }}"
                       class="inline-flex items-center gap-2 text-[#2d6fa3] hover:text-[#1d4e7a] font-semibold text-sm transition-colors group">
                        <span class="w-7 h-7 rounded-full border-2 border-[#2d6fa3]/30 group-hover:border-[#2d6fa3] flex items-center justify-center transition-colors">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        </span>
                        Back to Our Programs
                    </a>
                </div>
            </div>

            {{-- RIGHT: sidebar (1/3) --}}
            <div class="space-y-5">

                {{-- Meta card --}}
                @if($metaDate || count($metaTags))
                <div class="bg-[#f8f9fc] rounded-2xl p-5 border border-gray-100">
                    <h4 class="text-xs font-bold text-[#1a3c6e] uppercase tracking-widest mb-4">Article Info</h4>
                    @if($metaDate)
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-7 h-7 rounded-full bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3.5 h-3.5 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <span class="text-xs text-gray-600 font-medium">{{ $metaDate }}</span>
                    </div>
                    @endif
                    @if(count($metaTags))
                    <div class="flex flex-wrap gap-1.5">
                        @foreach($metaTags as $tag)
                        <span class="px-2.5 py-1 rounded-full bg-[#2d6fa3]/10 text-[#2d6fa3] text-xs font-semibold">{{ $tag }}</span>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endif

                {{-- Impact card --}}
                <div class="bg-[#1a3c6e] rounded-2xl p-5 text-white">
                    <div class="w-9 h-9 rounded-full bg-[#8da83a]/20 flex items-center justify-center mb-3">
                        <svg class="w-4 h-4 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    </div>
                    <h4 class="text-xs font-black uppercase tracking-wide mb-1.5">Income Generation</h4>
                    <p class="text-white/55 text-xs leading-relaxed">Small business grants help families build sustainable livelihoods so children can stay in school.</p>
                    <div class="mt-4 pt-3 border-t border-white/10">
                        <div class="text-xl font-black text-[#8da83a]">$779.50</div>
                        <div class="text-white/45 text-xs mt-0.5">Initial grant · Mrs. Huot Khatna</div>
                    </div>
                </div>

                {{-- Donate CTA --}}
                <div class="bg-[#8da83a]/10 border border-[#8da83a]/20 rounded-2xl p-5">
                    <h4 class="text-sm font-black text-[#1a3c6e] uppercase tracking-wide mb-1.5">Support Families Like This</h4>
                    <p class="text-gray-500 text-xs leading-relaxed mb-4">Your donation funds income generation grants for vulnerable families across Cambodia.</p>
                    <a href="{{ route('donate') }}" class="btn-primary w-full justify-center text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        Donate Now
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>

{{-- CTA Banner --}}
<section class="relative py-16 overflow-hidden bg-[#1a3c6e]">
    <div class="absolute top-0 right-0 w-80 h-80 rounded-full bg-[#2d6fa3]/20 -translate-y-1/2 translate-x-1/4"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a]/10 translate-y-1/2 -translate-x-1/4"></div>
    <div class="relative max-w-4xl mx-auto px-6 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#8da83a]/20 border border-[#8da83a]/30 mb-5">
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
