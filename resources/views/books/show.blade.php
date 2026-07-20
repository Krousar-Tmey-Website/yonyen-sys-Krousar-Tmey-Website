@extends('layouts.app')

@section('title', $book->title . ' — Books for Sale')
@section('description', $book->description ? Str::limit(strip_tags($book->description), 160) : 'Support children in Cambodia by purchasing ' . $book->title . '.')

@section('content')
<section class="py-16 md:py-24 bg-gradient-to-br from-slate-50 via-sky-50/20 to-slate-100/50 min-h-screen relative overflow-hidden">
    {{-- Ambient Decorative Lighting --}}
    <div class="absolute inset-0 opacity-20 pointer-events-none">
        <div class="absolute -top-32 -left-32 w-96 h-96 rounded-full bg-[#2d6fa3] blur-3xl hero-pulse"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 rounded-full bg-[#8da83a] blur-3xl hero-pulse" style="animation-delay: 2.5s;"></div>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto px-6">
        {{-- Back Navigation Link --}}
        <div class="mb-10" data-reveal="down">
            <a href="{{ route('involved') }}#book-for-sales" 
               class="group/back inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/80 backdrop-blur-md shadow-sm border border-slate-200/80 text-xs font-extrabold text-slate-600 hover:text-[#2d6fa3] hover:bg-white hover:border-[#2d6fa3]/30 transition-all duration-300">
                <svg class="w-4 h-4 transition-transform duration-300 group-hover/back:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Back to Books for Sale</span>
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start">
            
            {{-- Left: 3D Book Showcase Frame --}}
            <div class="lg:col-span-5" data-reveal="left">
                <div class="group/cover relative bg-gradient-to-br from-white via-slate-50 to-slate-100/80 rounded-3xl p-8 shadow-xl border border-white/80 flex items-center justify-center overflow-hidden">
                    {{-- Soft Ambient Glow behind Book Cover --}}
                    <div class="absolute -inset-4 bg-gradient-to-r from-[#2d6fa3]/15 to-[#8da83a]/15 rounded-3xl blur-2xl opacity-60 group-hover/cover:opacity-90 transition-opacity duration-500"></div>

                    @if($book->cover_image_url)
                    <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}" 
                         class="relative z-10 max-h-[28rem] md:max-h-[32rem] w-auto object-contain rounded-xl shadow-[0_20px_45px_-8px_rgba(0,0,0,0.3)] group-hover/cover:scale-[1.02] group-hover:-rotate-1 transition-all duration-500 ease-out">
                    @else
                    <div class="relative z-10 w-48 h-64 rounded-2xl bg-white border border-slate-200 shadow-xl flex flex-col items-center justify-center text-slate-400 gap-3">
                        <svg class="w-16 h-16 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        <span class="text-xs font-extrabold text-slate-400 uppercase tracking-widest">Krousar Thmey</span>
                    </div>
                    @endif

                    {{-- Glass Watermark Pill --}}
                    <div class="absolute bottom-4 right-4 z-20 inline-flex items-center gap-1.5 px-3 py-1 bg-white/80 backdrop-blur-md rounded-full text-[10px] font-extrabold text-[#2d6fa3] shadow-md border border-white/60 select-none">
                        <svg class="w-3.5 h-3.5 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        <span>Official Publication</span>
                    </div>
                </div>
            </div>

            {{-- Right: Information & Ordering Column --}}
            <div class="lg:col-span-7 flex flex-col gap-6" data-reveal="right">
                <div>
                    {{-- Category Tag & Stock Status --}}
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-[#2d6fa3]/10 border border-[#2d6fa3]/20 text-[#2d6fa3] text-xs font-extrabold uppercase tracking-wider">
                            <svg class="w-3.5 h-3.5 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                            Book for Sale
                        </span>

                        <span class="inline-flex items-center gap-1.5 text-xs font-extrabold px-3 py-1 rounded-full border shadow-2xs uppercase tracking-wider
                            {{ $book->is_available ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'bg-rose-50 text-rose-700 border-rose-200' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ $book->is_available ? 'bg-emerald-600 animate-pulse' : 'bg-rose-600' }}"></span>
                            {{ $book->is_available ? 'In Stock & Available' : 'Currently Unavailable' }}
                        </span>
                    </div>

                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-black text-slate-800 leading-tight tracking-wide mb-4">
                        {{ $book->title }}
                    </h1>

                    {{-- Price Display Box --}}
                    @if($book->price && $book->price > 0)
                    <div class="inline-flex items-baseline gap-2 bg-gradient-to-r from-amber-500/10 to-amber-500/5 px-5 py-3 rounded-2xl border border-amber-500/20 mb-6">
                        <span class="text-xs uppercase font-bold text-slate-400">Price:</span>
                        <span class="text-3xl md:text-4xl font-black text-[#e8a020]">
                            ${{ number_format($book->price, 2) }}
                        </span>
                    </div>
                    @endif
                </div>

                {{-- Description Box --}}
                @if($book->description)
                <div class="bg-white/80 backdrop-blur-md rounded-3xl p-6 md:p-8 border border-slate-200/70 shadow-sm">
                    <h2 class="text-xs font-extrabold uppercase tracking-wider text-slate-400 mb-3 flex items-center gap-2 border-b border-slate-100 pb-2">
                        <svg class="w-4 h-4 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        About this Book
                    </h2>
                    <div class="text-slate-600 text-sm md:text-base leading-relaxed whitespace-pre-line prose max-w-none">
                        {!! e($book->description) !!}
                    </div>
                </div>
                @endif

                {{-- Order Action Buttons --}}
                <div class="flex flex-col sm:flex-row gap-4 pt-2">
                    <a href="{{ route('contact') }}"
                       class="inline-flex items-center justify-center gap-2.5 px-8 py-4 bg-gradient-to-r from-[#2d6fa3] to-[#1d4e7a] hover:from-[#1d4e7a] hover:to-[#163b5d] text-white font-extrabold text-sm uppercase tracking-wider rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl hover:scale-[1.02] active:scale-[0.98]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>Order Book Now</span>
                    </a>

                    <a href="#" onclick="event.preventDefault(); openEmail('hr@krousar-thmey.org');"
                       class="inline-flex items-center justify-center gap-2 px-6 py-4 bg-white hover:bg-slate-50 text-slate-700 font-extrabold text-sm uppercase tracking-wider rounded-2xl border border-slate-200/80 transition-all duration-300 shadow-sm hover:shadow hover:border-slate-300">
                        <svg class="w-5 h-5 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <span>Order via Email</span>
                    </a>
                </div>

                {{-- Proceeds Callout Box --}}
                <div class="relative overflow-hidden bg-gradient-to-br from-[#8da83a]/15 to-[#8da83a]/5 border border-[#8da83a]/30 rounded-3xl p-6 flex items-start gap-4 shadow-sm">
                    <div class="w-10 h-10 rounded-2xl bg-[#8da83a] text-white flex items-center justify-center shrink-0 shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-slate-800 text-sm mb-1 uppercase tracking-wide">Direct Social Impact</h4>
                        <p class="text-slate-600 text-xs leading-relaxed">
                            100% of proceeds from book orders directly support educational, social, and healthcare programs for disadvantaged children across Cambodia.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
