@extends('layouts.app')

@section('title', $item->title . ' — Krousar Thmey')
@section('description', $item->short_content ?? $item->title)

@section('content')

{{-- Page Header --}}
<div class="bg-[#1a3c6e] pt-16 pb-24 relative overflow-hidden">
    {{-- Decorative circles --}}
    <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white/5 -translate-y-1/2 translate-x-1/3"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#2d6fa3]/30 translate-y-1/2 -translate-x-1/4"></div>

    <div class="relative max-w-7xl mx-auto px-6">
        {{-- Breadcrumb --}}
        <nav class="flex items-center gap-2 text-sm text-white/50 mb-10 flex-wrap">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('programs') }}" class="hover:text-white transition-colors">Our Programs</a>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white/80">{{ $item->title }}</span>
        </nav>

        {{-- Label --}}
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#e8a020]/20 border border-[#e8a020]/30 mb-5">
            <div class="w-1.5 h-1.5 rounded-full bg-[#e8a020]"></div>
            <span class="text-[#e8a020] font-semibold text-xs uppercase tracking-widest">Additional Information</span>
        </div>

        <h1 class="text-4xl md:text-5xl font-black text-white mb-5 max-w-3xl leading-tight uppercase tracking-wide">{{ $item->title }}</h1>

        @if($item->short_content)
        <p class="text-white/60 text-lg max-w-2xl leading-relaxed">{{ $item->short_content }}</p>
        @endif
    </div>
</div>

{{-- Main Content --}}
<section class="bg-white">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Image Gallery — pulled up to overlap header --}}
        @php
            $imageUrls = array_values(array_filter([$item->image_url, $item->image_2_url, $item->image_3_url]));
            $imgCount  = count($imageUrls);
        @endphp

        @if($imgCount > 0)
        <div class="-mt-12 mb-14 relative z-10">
            @if($imgCount === 1)
            <div class="rounded-2xl overflow-hidden shadow-2xl border-4 border-white">
                <img src="{{ $imageUrls[0] }}" alt="{{ $item->title }}" class="w-full max-h-[520px] object-cover">
            </div>

            @elseif($imgCount === 2)
            <div class="grid grid-cols-2 gap-3">
                <div class="rounded-2xl overflow-hidden shadow-2xl border-4 border-white">
                    <img src="{{ $imageUrls[0] }}" alt="{{ $item->title }}" class="w-full h-80 object-cover">
                </div>
                <div class="rounded-2xl overflow-hidden shadow-2xl border-4 border-white">
                    <img src="{{ $imageUrls[1] }}" alt="{{ $item->title }}" class="w-full h-80 object-cover">
                </div>
            </div>

            @else
            <div class="grid grid-cols-3 gap-3">
                <div class="col-span-2 rounded-2xl overflow-hidden shadow-2xl border-4 border-white">
                    <img src="{{ $imageUrls[0] }}" alt="{{ $item->title }}" class="w-full h-80 object-cover">
                </div>
                <div class="flex flex-col gap-3">
                    <div class="rounded-2xl overflow-hidden shadow-xl border-4 border-white flex-1">
                        <img src="{{ $imageUrls[1] }}" alt="{{ $item->title }}" class="w-full h-full object-cover min-h-[148px]">
                    </div>
                    <div class="rounded-2xl overflow-hidden shadow-xl border-4 border-white flex-1">
                        <img src="{{ $imageUrls[2] }}" alt="{{ $item->title }}" class="w-full h-full object-cover min-h-[148px]">
                    </div>
                </div>
            </div>
            @endif
        </div>
        @else
        <div class="pt-14"></div>
        @endif

        {{-- Content body --}}
        @if($item->detail_content)
        <div class="max-w-4xl mx-auto pb-20">
            {{-- Decorative rule --}}
            <div class="flex items-center gap-4 mb-10">
                <div class="w-1.5 h-8 bg-[#d32f2f] rounded-full"></div>
                <span class="text-xs font-bold text-[#1a3c6e] uppercase tracking-widest">Full Details</span>
                <div class="flex-1 h-px bg-gray-100"></div>
            </div>

            <div class="prose prose-lg max-w-none
                        prose-headings:text-[#1a3c6e] prose-headings:font-black prose-headings:uppercase prose-headings:tracking-wide
                        prose-h2:text-2xl prose-h3:text-lg
                        prose-p:text-gray-600 prose-p:leading-relaxed
                        prose-a:text-[#2d6fa3] prose-a:font-semibold hover:prose-a:text-[#1d4e7a]
                        prose-strong:text-[#1a3c6e]
                        prose-img:rounded-2xl prose-img:shadow-lg
                        prose-ul:text-gray-600 prose-li:marker:text-[#8da83a]">
                {!! $item->detail_content !!}
            </div>
        </div>
        @else
        <div class="pb-20"></div>
        @endif

    </div>
</section>

{{-- Donate + Back bar --}}
<div class="bg-[#f8f9fc] border-t border-gray-100 py-10">
    <div class="max-w-7xl mx-auto px-6 flex flex-col sm:flex-row items-center justify-between gap-4">
        <a href="{{ route('programs') }}"
           class="inline-flex items-center gap-2 text-[#2d6fa3] hover:text-[#1d4e7a] font-semibold text-sm transition-colors group">
            <span class="w-8 h-8 rounded-full border-2 border-[#2d6fa3]/30 group-hover:border-[#2d6fa3] flex items-center justify-center transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </span>
            Back to Our Programs
        </a>
        <a href="{{ route('donate') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
            Donate Now
        </a>
    </div>
</div>

{{-- CTA Banner --}}
<section class="relative py-20 overflow-hidden bg-[#1a3c6e]">
    <div class="absolute top-0 right-0 w-80 h-80 rounded-full bg-[#2d6fa3]/20 -translate-y-1/2 translate-x-1/4"></div>
    <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a]/10 translate-y-1/2 -translate-x-1/4"></div>
    <div class="relative max-w-4xl mx-auto px-6 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-[#8da83a]/20 border border-[#8da83a]/30 mb-6">
            <div class="w-1.5 h-1.5 rounded-full bg-[#8da83a]"></div>
            <span class="text-[#8da83a] font-semibold text-xs uppercase tracking-widest">Support Our Mission</span>
        </div>
        <h2 class="text-3xl md:text-4xl font-black text-white uppercase tracking-wide mb-4">Help Children in Cambodia</h2>
        <p class="text-white/60 text-base mb-10 max-w-xl mx-auto leading-relaxed">Your support helps us continue providing education, protection, and opportunities for disadvantaged children.</p>
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
