@extends('layouts.app')

@section('title', 'Get Involved — Krousar Thmey')
@section('description', 'Join Krousar Thmey — volunteer, partner with us, find job opportunities, or make a donation to support children in Cambodia.')

@section('content')

{{-- Page Header --}}
<div class="relative bg-gradient-to-br from-[#1d4e7a] via-[#2d6fa3] to-[#153e63] pt-16 pb-28 overflow-hidden">
    {{-- Ambient Glowing Halos & Mesh Effects --}}
    <div class="absolute inset-0 opacity-20 pointer-events-none">
        <div class="absolute top-0 right-0 w-[30rem] h-[30rem] rounded-full bg-gradient-to-bl from-[#8da83a] to-transparent blur-3xl -translate-y-1/3 translate-x-1/3 hero-pulse"></div>
        <div class="absolute bottom-0 left-0 w-[24rem] h-[24rem] rounded-full bg-gradient-to-tr from-[#e8a020] to-transparent blur-3xl translate-y-1/3 -translate-x-1/4 hero-pulse" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/3 w-[20rem] h-[20rem] rounded-full bg-white blur-3xl opacity-10"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        {{-- Glass Breadcrumbs --}}
        <nav class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/15 text-xs text-white/80 mb-8 shadow-sm" data-reveal="down">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-3.5 h-3.5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white font-semibold">Get Involved</span>
        </nav>
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            <div class="lg:col-span-8">
                {{-- Glowing Pill Tag --}}
                <div class="inline-flex items-center gap-2 bg-[#8da83a]/25 border border-[#8da83a]/40 text-[#a3c04a] text-xs font-black uppercase tracking-widest px-4 py-1.5 rounded-full mb-4 shadow-inner" data-reveal="up">
                    <span class="w-2 h-2 rounded-full bg-[#8da83a] animate-ping"></span>
                    Join Our Mission
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black uppercase tracking-wide text-white mb-6 leading-tight" data-reveal="up" style="--reveal-delay: 100">
                    Get <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-100 to-[#a3c04a]">Involved</span>
                </h1>
                
                <p class="text-white/80 text-base md:text-lg leading-relaxed max-w-2xl font-light" data-reveal="up" style="--reveal-delay: 200">
                    There are many meaningful ways to support Krousar Thmey's mission — from partnerships and volunteering, to exploring job opportunities or purchasing our books.
                </p>
            </div>
            
            {{-- Floating Decorative Glass Badge --}}
            <div class="hidden lg:flex lg:col-span-4 justify-end" data-reveal="scale" style="--reveal-delay: 300">
                <div class="relative bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-6 text-white max-w-xs shadow-2xl hover:bg-white/15 transition-all duration-500">
                    <div class="w-12 h-12 rounded-2xl bg-gradient-to-tr from-[#8da83a] to-[#a3c04a] flex items-center justify-center mb-4 shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-extrabold text-lg text-white mb-1">Make a Difference</h3>
                    <p class="text-xs text-white/70 leading-relaxed mb-4">Together, we build a brighter future for disadvantaged children across Cambodia.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#a3c04a] hover:text-white transition-colors">
                        Get in touch
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Quick-nav cards (Overlapping Floating Grid) --}}
<section class="py-10 bg-slate-50/50 relative z-20">
    <div class="max-w-7xl mx-auto px-6 -mt-16 md:-mt-20">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                [
                    'svg' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 002 2v10a2 2 0 002 2z"/></svg>',
                    'title' => 'Partner',
                    'desc' => 'Formalize a CSR or institutional partnership to empower Cambodian communities.',
                    'anchor' => 'partner',
                    'badgeBg' => 'bg-sky-50 text-[#2d6fa3]',
                    'borderHover' => 'hover:border-[#2d6fa3]/40 hover:shadow-[#2d6fa3]/10',
                    'titleHover' => 'group-hover:text-[#2d6fa3]',
                ],
                [
                    'svg' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>',
                    'title' => 'Volunteer',
                    'desc' => 'Contribute your expertise, skills, and time for a minimum of 3 months.',
                    'anchor' => 'volunteer',
                    'badgeBg' => 'bg-emerald-50 text-[#8da83a]',
                    'borderHover' => 'hover:border-[#8da83a]/40 hover:shadow-[#8da83a]/10',
                    'titleHover' => 'group-hover:text-[#8da83a]',
                ],
                [
                    'svg' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>',
                    'title' => 'Work With Us',
                    'desc' => 'Join our Cambodian team across social work, education, and communications.',
                    'anchor' => 'jobs',
                    'badgeBg' => 'bg-amber-50 text-[#e8a020]',
                    'borderHover' => 'hover:border-[#e8a020]/40 hover:shadow-[#e8a020]/10',
                    'titleHover' => 'group-hover:text-[#e8a020]',
                ],
                [
                    'svg' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>',
                    'title' => 'Book for Sales',
                    'desc' => 'Browse our curated collection of books and support children directly.',
                    'anchor' => 'book-for-sales',
                    'badgeBg' => 'bg-rose-50 text-[#d32f2f]',
                    'borderHover' => 'hover:border-[#d32f2f]/40 hover:shadow-[#d32f2f]/10',
                    'titleHover' => 'group-hover:text-[#d32f2f]',
                ],
            ] as $index => $way)
            <a href="#{{ $way['anchor'] }}" 
               data-reveal="pop" style="--reveal-delay: {{ $index * 120 }}"
               class="group relative bg-white/90 backdrop-blur-xl rounded-3xl p-7 border border-slate-200/60 {{ $way['borderHover'] }} shadow-lg hover:shadow-2xl hover:-translate-y-2.5 transition-all duration-500 flex flex-col justify-between overflow-hidden">
                {{-- Subtle top color gradient bar --}}
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-current to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                <div>
                    <div class="w-12 h-12 rounded-2xl {{ $way['badgeBg'] }} flex items-center justify-center mb-5 group-hover:scale-110 group-hover:rotate-6 transition-transform duration-500 shadow-sm">
                        {!! $way['svg'] !!}
                    </div>
                    <h3 class="font-extrabold text-slate-800 text-base md:text-lg uppercase tracking-wide mb-2.5 {{ $way['titleHover'] }} transition-colors duration-300">
                        {{ $way['title'] }}
                    </h3>
                    <p class="text-slate-500 text-xs leading-relaxed mb-6 font-normal">
                        {{ $way['desc'] }}
                    </p>
                </div>

                <div class="inline-flex items-center gap-1.5 text-[#2d6fa3] text-xs font-bold transition-all duration-300 pt-2 border-t border-slate-100">
                    Learn more
                    <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Book for Sales --}}
<section id="book-for-sales" class="py-24 bg-gradient-to-br from-[#163b5d] via-[#1d4e7a] to-[#2d6fa3] scroll-mt-20 relative overflow-hidden">
    {{-- Ambient Lighting Effects --}}
    <div class="absolute inset-0 opacity-15 pointer-events-none">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-[#8da83a] blur-3xl hero-pulse"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-[#e8a020] blur-3xl hero-pulse" style="animation-delay: 3s;"></div>
    </div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-6">
        <div class="max-w-2xl mb-14" data-reveal="left">
            <span class="inline-flex items-center gap-2 bg-[#e8a020]/20 border border-[#e8a020]/30 text-[#e8a020] text-xs font-extrabold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4 shadow-sm">
                <svg class="w-3.5 h-3.5 text-[#e8a020]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                Books for Sale
            </span>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-black uppercase tracking-wide text-white mb-4 leading-tight">
                Support Through <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-slate-100 to-[#e8a020]">Literature</span>
            </h2>
            <p class="text-white/80 leading-relaxed text-sm md:text-base font-light">
                Browse our collection of publication titles. 100% of proceeds directly fund our educational and social programs for vulnerable children across Cambodia.
            </p>
        </div>

        @if($books->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($books as $book)
            <a href="{{ route('books.show', $book) }}" data-reveal="pop" style="--reveal-delay: {{ ($loop->index % 3) * 120 }}"
               class="group bg-white rounded-3xl p-5 border border-slate-100 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex items-center gap-4 md:gap-5 overflow-hidden relative">
                
                {{-- Left Image Container --}}
                <div class="relative w-24 sm:w-28 md:w-32 h-36 md:h-40 shrink-0 bg-slate-50 rounded-2xl flex items-center justify-center p-2 shadow-inner border border-slate-100/80 overflow-hidden">
                    @if($book->cover_image_url)
                    <img src="{{ $book->cover_image_url }}" alt="{{ $book->localized_title }}"
                         class="max-h-full max-w-full object-contain rounded-lg shadow-md group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="flex flex-col items-center justify-center text-slate-300 gap-1">
                        <svg class="w-8 h-8 text-[#2d6fa3]/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        <span class="text-[8px] font-bold text-slate-400 uppercase">Book</span>
                    </div>
                    @endif
                </div>

                {{-- Right Content Column --}}
                <div class="flex-1 min-w-0 flex flex-col justify-between h-36 md:h-40 py-0.5">
                    <div>
                        {{-- Top Badge --}}
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="inline-flex items-center text-[9px] font-extrabold px-2.5 py-0.5 rounded-full tracking-wider uppercase
                                {{ $book->is_available ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-amber-50 text-amber-600 border border-amber-200' }}">
                                {{ $book->is_available ? 'AVAILABLE' : 'OUT OF STOCK' }}
                            </span>
                        </div>

                        {{-- Title --}}
                        <h3 class="font-extrabold text-slate-800 text-sm md:text-base uppercase tracking-wide group-hover:text-[#2d6fa3] transition-colors line-clamp-1 leading-snug mb-1">
                            {{ $book->localized_title }}
                        </h3>

                        {{-- Description --}}
                        @if($book->localized_description)
                        <p class="text-slate-400 text-xs line-clamp-2 leading-relaxed">
                            {{ strip_tags($book->localized_description) }}
                        </p>
                        @else
                        <p class="text-slate-300 text-xs italic">No description provided.</p>
                        @endif
                    </div>

                    {{-- Bottom Row: Price & Stock --}}
                    <div class="flex items-center justify-between border-t border-slate-100 pt-2.5 mt-auto">
                        @if($book->price && $book->price > 0)
                        <span class="text-xl md:text-2xl font-black text-slate-800 group-hover:text-[#2d6fa3] transition-colors">
                            ${{ number_format($book->price, 2) }}
                        </span>
                        @else
                        <span></span>
                        @endif
                        <span class="text-xs text-slate-400 font-semibold">
                            Stock: <strong class="text-slate-600 font-bold">{{ $book->stock }}</strong>
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-12 text-center max-w-xl mx-auto shadow-xl">
            <svg class="w-12 h-12 text-white/50 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            <p class="text-white/80 text-sm font-medium">No books are currently listed for sale. Please check back soon.</p>
        </div>
        @endif
    </div>
</section>

{{-- Partner --}}
{{--
    ===================================================================
    STATIC CONTENT — Developer-only changes, no admin/CMS
    ===================================================================
    The entire "Become a Partner" section is hardcoded — heading, intro,
    principles, approach, CTA, and partner categories. To modify any of
    this content, edit the HTML directly in this template.
    ===================================================================
--}}
<section id="partner" class="py-20 md:py-28 bg-white scroll-mt-20 relative overflow-hidden">
    {{-- Subtle decorative background --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute top-40 right-0 w-[600px] h-[600px] rounded-full bg-gradient-to-br from-[#2d6fa3]/[0.03] to-transparent blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] rounded-full bg-gradient-to-tr from-[#8da83a]/[0.03] to-transparent blur-3xl"></div>
        <div class="absolute top-1/3 left-1/4 w-2 h-2 rounded-full bg-[#2d6fa3]/10"></div>
        <div class="absolute bottom-1/4 right-1/3 w-3 h-3 rounded-full bg-[#8da83a]/10"></div>
        <div class="absolute top-1/2 right-1/4 w-1.5 h-1.5 rounded-full bg-[#e8a020]/10"></div>
    </div>

    <div class="relative max-w-5xl mx-auto px-6">
        <div class="space-y-16">
            {{-- ── Section Header ── --}}
            <div data-reveal="up">
                <span class="inline-flex items-center gap-2 bg-[#2d6fa3]/10 border border-[#2d6fa3]/15 text-[#2d6fa3] text-[11px] font-bold uppercase tracking-[0.15em] px-4 py-1.5 rounded-full mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#2d6fa3]"></span>
                    Institutional Support
                </span>
                <h2 class="text-4xl md:text-5xl lg:text-[3.25rem] font-bold leading-tight text-[#1d4e7a] mb-4">
                    Become a Partner
                </h2>
                <div class="w-20 h-[3px] bg-gradient-to-r from-[#2d6fa3] via-[#8da83a] to-[#2d6fa3] rounded-full mb-8"></div>
                <p class="text-gray-600 leading-relaxed text-base md:text-lg max-w-3xl">
                    The partnership is based on a <span class="font-bold text-[#1d4e7a]">co-construction dynamic</span> built on shared values and mutual respect.
                </p>
            </div><br>

            {{-- ── Partnership Principles — Icon Cards ── --}}
            <div data-reveal="up">
                <h3 class="text-lg font-bold text-[#1d4e7a] mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#2d6fa3]"></span>
                    Our Partnership Principles
                </h3>
                <div class="grid sm:grid-cols-2 gap-4">
                    @php
                        $principles = [
                            [
                                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                                'title' => 'Trust and respect',
                                'color' => 'from-blue-50 to-indigo-50',
                                'iconBg' => 'bg-[#2d6fa3]/10 text-[#2d6fa3]',
                                'hover' => 'group-hover:border-[#2d6fa3]/30 group-hover:shadow-blue-100/50',
                            ],
                            [
                                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>',
                                'title' => 'Compliance with commitments',
                                'subtitle' => 'technical and financial',
                                'color' => 'from-green-50 to-emerald-50',
                                'iconBg' => 'bg-[#8da83a]/10 text-[#8da83a]',
                                'hover' => 'group-hover:border-[#8da83a]/30 group-hover:shadow-green-100/50',
                            ],
                            [
                                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>',
                                'title' => 'Reciprocity',
                                'subtitle' => 'seeking balance in exchange, valorization of talents',
                                'color' => 'from-amber-50 to-orange-50',
                                'iconBg' => 'bg-[#e8a020]/10 text-[#e8a020]',
                                'hover' => 'group-hover:border-[#e8a020]/30 group-hover:shadow-amber-100/50',
                            ],
                            [
                                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/></svg>',
                                'title' => 'Search for equality of power',
                                'subtitle' => 'in the relationship',
                                'color' => 'from-red-50 to-rose-50',
                                'iconBg' => 'bg-[#d32f2f]/10 text-[#d32f2f]',
                                'hover' => 'group-hover:border-[#d32f2f]/30 group-hover:shadow-rose-100/50',
                            ],
                        ];
                    @endphp
                    
                    @foreach($partnerPrinciples as $index => $principle)
                        @php
                            // Wrap index if there are more principles in DB than hardcoded styles
                            $styleIndex = $index % count($principles);
                            $pStyle = $principles[$styleIndex];
                        @endphp
                        <div class="group p-5 rounded-2xl border-2 border-gray-200 bg-gradient-to-br {{ $pStyle['color'] }} {{ $pStyle['hover'] }} hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 cursor-default">
                            <div class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-xl {{ $pStyle['iconBg'] }} flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300" aria-hidden="true">
                                    {!! $pStyle['icon'] !!}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-bold text-[#1d4e7a] text-sm mb-0.5">{{ $principle->content }}</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div><br>

            {{-- ── Dynamic Emphasis ── --}}
            <div data-reveal="up" class="mb-6">
                <h3 class="text-lg font-bold text-[#1d4e7a] mb-10 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#8da83a]"></span>
                    This Dynamic Emphasizes
                </h3>
                <div class="grid sm:grid-cols-3 gap-8">
                    @php
                        $emphases = [
                            [
                                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
                                'title' => 'A close relationship',
                                'desc' => 'Translated by know-how and postures of listening, understanding and exchange / dialogue',
                            ],
                            [
                                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>',
                                'title' => 'Adapted & tailored solutions',
                                'desc' => 'The search for solutions adapted to the problems / needs of partners and indirectly children',
                            ],
                            [
                                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                                'title' => 'Duration & respect of pace',
                                'desc' => 'This in the duration and the respect of the rhythm of the partner',
                            ],
                        ];
                    @endphp
                    @foreach($emphases as $e)
                        <div class="group p-6 rounded-2xl border border-gray-100 bg-white hover:border-[#2d6fa3]/20 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                            <div class="w-10 h-10 rounded-lg bg-[#2d6fa3]/5 text-[#2d6fa3] flex items-center justify-center mb-5 group-hover:bg-[#2d6fa3]/10 group-hover:scale-110 transition-all duration-300" aria-hidden="true">
                                {!! $e['icon'] !!}
                            </div>
                            <h4 class="font-bold text-[#1d4e7a] text-sm mb-3">{{ $e['title'] }}</h4>
                            <p class="text-gray-500 text-xs leading-relaxed">{{ $e['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ── Worldwide Partners ── --}}
            @if(isset($worldwidePartners) && $worldwidePartners->isNotEmpty())
            <div data-reveal="up" class="mb-16">
                <h3 class="text-lg font-bold text-[#1d4e7a] mb-10 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#2d6fa3]"></span>
                    Our Worldwide Partners
                </h3>
                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($worldwidePartners as $wwp)
                        <div class="group relative bg-white border border-gray-100 rounded-3xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-1 flex flex-col h-full">
                            @if($wwp->image)
                                <div class="relative h-48 overflow-hidden bg-gray-50 flex items-center justify-center">
                                    <div class="absolute inset-0 bg-gradient-to-t from-[#1d4e7a]/20 to-transparent z-10"></div>
                                    <img src="{{ $wwp->image_url }}" alt="{{ $wwp->localized_country_name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out z-0">
                                </div>
                            @else
                                <div class="relative h-48 overflow-hidden bg-gray-100 flex items-center justify-center">
                                    <span class="text-gray-400 font-bold text-xl">{{ $wwp->localized_country_name }}</span>
                                </div>
                            @endif
                            <div class="p-6 flex flex-col flex-grow relative z-20 bg-white">
                                <h4 class="font-black text-[#1d4e7a] text-xl mb-3">{{ $wwp->localized_country_name }}</h4>
                                <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-grow">
                                    {{ $wwp->localized_description }}
                                </p>
                                @if($wwp->learn_more_url)
                                    <a href="{{ $wwp->learn_more_url }}" target="_blank" rel="noopener"
                                       class="inline-flex items-center justify-center gap-2 w-full bg-white text-[#2d6fa3] font-bold text-sm px-6 py-2.5 rounded-xl border-2 border-[#2d6fa3]/20 hover:border-[#2d6fa3] hover:bg-[#2d6fa3] hover:text-white transition-all duration-300">
                                        <span>{{ $wwp->localized_button_text ?: 'Learn More' }}</span>
                                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- ── CTA Section — Enhanced with overlays & hover effects ── --}}
            <div data-reveal="up" class="relative group/card">
                <div class="grid grid-cols-1 md:grid-cols-3 items-stretch bg-gradient-to-br from-[#f8f9fc] to-white rounded-3xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-500">
                    {{-- Left Image --}}
                    <div class="relative h-56 md:h-full overflow-hidden">
                        <img src="{{ asset('images/become_partner01.webp') }}" alt="Children in Cambodia"
                             class="w-full h-full object-cover object-center group-hover/card:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1d4e7a]/40 to-transparent md:bg-gradient-to-r md:from-[#1d4e7a]/30 md:to-transparent"></div>
                    </div>
                    {{-- Center Content --}}
                    <div class="flex flex-col items-center justify-center text-center px-8 py-10 md:py-0 relative">
                        <div class="absolute -top-3 left-1/2 -translate-x-1/2 w-12 h-[3px] bg-gradient-to-r from-[#2d6fa3] to-[#8da83a] rounded-full hidden md:block"></div>
                        <div class="w-14 h-14 rounded-2xl bg-white shadow-lg border border-gray-100 flex items-center justify-center mb-5 group-hover/card:scale-110 transition-all duration-500">
                            <svg class="w-7 h-7 text-[#2d6fa3]" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <p class="text-[#1d4e7a] font-bold text-lg md:text-xl mb-2">Interested in becoming a partner?</p>
                        <p class="text-gray-500 text-sm mb-6">Let's build together our future cooperation</p>
                        <a href="{{ route('contact') }}"
                           class="group/btn mt-4 inline-flex items-center gap-2 bg-white text-[#1d4e7a] font-bold text-sm px-7 py-2.5 rounded-xl border-2 border-[#1d4e7a] hover:bg-[#1d4e7a] hover:text-white hover:gap-3 transition-all duration-300 active:scale-[0.97] shadow-sm hover:shadow-md">
                            <span>Contact us</span>
                            <svg class="w-4 h-4 transition-transform duration-300 group-hover/btn:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                    {{-- Right Image --}}
                    <div class="relative h-56 md:h-full overflow-hidden">
                        <img src="{{ asset('images/become_partner02.webp') }}" alt="Children in Cambodia"
                             class="w-full h-full object-cover object-center group-hover/card:scale-105 transition-transform duration-700 ease-out">
                        <div class="absolute inset-0 bg-gradient-to-b from-[#1d4e7a]/40 to-transparent md:bg-gradient-to-l md:from-[#1d4e7a]/30 md:to-transparent"></div>

                    </div>
                </div>
            </div><br>

            {{-- ── Who Can Partner — Enhanced Category Cards ── --}}
            <div data-reveal="up">
                <h3 class="text-lg font-bold text-[#1d4e7a] mb-2 flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#e8a020]"></span>
                    Who Can Partner
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-8 max-w-4xl">
                    Krousar Thmey may work in partnership with a variety of public, private and civil society actors and at different administrative levels: village, district, province, region, country. The following list, although not exhaustive, gives an overview of the type of organizations Krousar Thmey can work with.
                </p>

                <div class="space-y-8">
                    @php
                        $catStyles = [
                            [
                                'border' => 'border-[#2d6fa3]',
                                'bg' => 'from-[#2d6fa3]/[0.02]',
                                'iconBg' => 'bg-[#2d6fa3]/10 text-[#2d6fa3]',
                                'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>',
                            ],
                            [
                                'border' => 'border-[#8da83a]',
                                'bg' => 'from-[#8da83a]/[0.02]',
                                'iconBg' => 'bg-[#8da83a]/10 text-[#8da83a]',
                                'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>',
                            ],
                            [
                                'border' => 'border-[#e8a020]',
                                'bg' => 'from-[#e8a020]/[0.02]',
                                'iconBg' => 'bg-[#e8a020]/10 text-[#e8a020]',
                                'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>',
                            ],
                            [
                                'border' => 'border-[#d32f2f]',
                                'bg' => 'from-[#d32f2f]/[0.02]',
                                'iconBg' => 'bg-[#d32f2f]/10 text-[#d32f2f]',
                                'icon' => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 002 2v10a2 2 0 002 2z"/></svg>',
                            ]
                        ];

                        $staticDescriptions = [
                            'Organizations from associative sector' =>
                                '<p class="font-bold text-[#1d4e7a] mb-1">Associations/ local NGOs</p>
                                <p class="mb-4">Can be of any size, from the small local association benefiting from a local fort, to the professional NGO (basic organizations that have structured and professionalized).</p>
                                <p class="font-bold text-[#1d4e7a] mb-1">Platforms/ thematic networks (locals)</p>
                                <p class="mb-4">The thematic platforms or networks are clusters of local and / or international NGOs working on specific fields and / or international and UN agencies. They are places of reflection, exchange of practices and experiences and pooling of the stakes in targeted fields, in order to define strategies and actions to raise awareness and advocate with stakeholders.</p>
                                <p class="font-bold text-[#1d4e7a] mb-1">NGOs or local branches of international organizations</p>
                                <p>A partnership with these international organizations and bilateral and multilateral agencies (eg United Nations Agencies or European Union) can be developed from Cambodia or Europe.</p>',

                            'Local education structures' =>
                                '<p class="font-bold text-[#1d4e7a] mb-1">Research institutes</p>
                                <p class="mb-4">Les ONG et les chercheurs, du fait de cultures professionnelles très différentes, n’ont a priori ni les mêmes intérêts, ni les mêmes connaissances de la réalité terrain ou de la démarche scientifique. Cependant, il y a, du côté de la recherche comme celui des ONG, une volonté et des intérêts à coopérer pour améliorer de part et d’autre l’efficacité, l’ancrage terrain, la connaissance et le plaidoyer.</p>
                                <p class="font-bold text-[#1d4e7a] mb-1">Universities / Training institutes</p>
                                <p>Due to very different professional cultures, NGOs and researchers have neither the same interests nor the same knowledge of the field reality or the scientific approach at first glance. However, there is both willingness and interest on the part of researchers and NGOs to work together to improve effectiveness, anchoring, knowledge and advocacy.</p>',

                            'Public services' =>
                                '<p class="font-bold text-[#1d4e7a] mb-1">Centralized or decentralized state services</p>
                                <p class="mb-4">Local services related to Krousar Thmey fields of intervention (inclusive education and child welfare) can be relevant partners in experimenting and disseminating good practice at the local level. Collaboration with the decision-making level (Ministry of Education / Ministry of Social Affairs, for example) should allow scaling up at a provincial or even national level.</p>
                                <p class="font-bold text-[#1d4e7a] mb-1">Local authorities</p>
                                <p>Municipalities, districts or provinces have often defined policies of international solidarity cooperation with substantial financing. They also undertake a project selection procedure.</p>',

                            'Companies and foundations from private sector' =>
                                '<p class="font-bold text-[#1d4e7a] mb-1">Companies</p>
                                <p class="mb-4">Beside the financial aspect of a partnership with the economic sector, it can also allow empowering the employees of Krousar Thmey. In addition, it can also involve volunteering by the company’s employees, such as Khmer or English classes.</p>
                                <p class="font-bold text-[#1d4e7a] mb-1">Foundations</p>
                                <p>The requirement level of some foundations has reached an almost equivalent level of international donors. They are increasingly interested in committing not only financially but also technically to projects with long-term impact.</p>',
                        ];

                        // Research institutes / Universities & Training institutes are shown as
                        // sub-items inside "Local education structures" above, not as their own cards.
                        $visibleCategories = $partnershipCategories->whereNotIn('name', [
                            'Research institutes',
                            'Universities / Training institutes',
                        ])->values();
                    @endphp

                    @foreach($visibleCategories as $index => $category)
                        @php
                            $style = $catStyles[$index % count($catStyles)];
                            $description = $staticDescriptions[$category->name] ?? $category->description;
                        @endphp
                        <div data-reveal-card style="--reveal-card-delay: {{ ($index % 4) * 150 }}" class="group/cat relative bg-white border-l-4 {{ $style['border'] }} rounded-2xl p-6 md:p-8 shadow-sm hover:shadow-lg transition-all duration-300 hover:-translate-y-0.5 overflow-hidden">
                            <div class="absolute inset-0 rounded-2xl bg-gradient-to-r {{ $style['bg'] }} to-transparent pointer-events-none"></div>
                            <div class="relative">
                                <div class="flex items-center gap-3 mb-5">
                                    <div class="w-10 h-10 rounded-xl {{ $style['iconBg'] }} flex items-center justify-center flex-shrink-0 group-hover/cat:scale-110 transition-all duration-300" aria-hidden="true">
                                        {!! $style['icon'] !!}
                                    </div>
                                    <h4 class="font-black text-[#1d4e7a] text-sm uppercase tracking-wide">{{ $category->name }}</h4>
                                </div>
                                @if($description)
                                    <div class="space-y-4">
                                        <div class="pl-4 border-l-2 border-gray-100 hover:border-gray-300 transition-colors">
                                            <div class="text-gray-500 text-sm leading-relaxed prose prose-sm max-w-none">
                                                {!! $description !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Volunteer --}}
{{-- Volunteer --}}
<section id="volunteer" class="py-24 bg-gradient-to-b from-[#f8f9fc] to-[#f1f3f9] relative overflow-hidden scroll-mt-20">
    {{-- Decorative Background Patterns --}}
    <div class="absolute inset-0 pointer-events-none opacity-20">
        <svg class="absolute top-10 right-10 w-80 h-80 text-gray-300" fill="currentColor" viewBox="0 0 100 100">
            <defs>
                <pattern id="dotPattern" x="0" y="0" width="10" height="10" patternUnits="userSpaceOnUse">
                    <circle cx="2" cy="2" r="1.5" />
                </pattern>
            </defs>
            <rect width="100" height="100" fill="url(#dotPattern)" />
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative">
        {{-- Intro Grid --}}
        <div class="grid lg:grid-cols-2 gap-12 items-center mb-16">
            <div data-reveal="left">
                <span class="inline-flex items-center gap-2 bg-[#e8a020]/15 border border-[#e8a020]/25 text-[#e8a020] text-xs font-black uppercase tracking-widest px-4 py-1.5 rounded-full mb-4 shadow-xs">
                    Give Your Time
                </span>
                <h2 class="text-3xl md:text-5xl font-black tracking-tight text-[#1d4e7a] uppercase mb-4">
                    Volunteer <span class="text-[#2d6fa3]">With Us</span>
                </h2>
                <div class="w-16 h-1.5 bg-[#d32f2f] rounded-full mb-6"></div>
                <p class="text-gray-600 leading-relaxed text-base max-w-xl">
                    Volunteering with Krousar Thmey is an opportunity to contribute meaningfully, transfer crucial know-how, or raise resources that directly impact the lives of children in Cambodia. We offer two distinct tracks based on your location and expertise.
                </p>
            </div>
            <div class="relative" data-reveal="right">
                {{-- Modern landscape image frame with background offset decoration --}}
                <div class="absolute inset-0 rounded-3xl bg-gradient-to-tr from-[#2d6fa3] to-[#8da83a] opacity-80 translate-x-2 translate-y-2 blur-xs"></div>
                <div class="relative h-[280px] rounded-3xl overflow-hidden shadow-xl border-4 border-white bg-slate-100">
                    <img src="{{ asset('images/special-ed.jpg') }}" alt="Special education volunteering" class="w-full h-full object-cover object-center transition-transform duration-500 hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 bg-white/90 backdrop-blur-sm rounded-lg px-3 py-1.5 shadow-md">
                        <p class="text-[#2d6fa3] font-bold text-[10px] uppercase tracking-wide">Hands-on Impact</p>
                        <p class="text-gray-500 text-[9px]">Work directly with children</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Side-by-Side Track Cards --}}
        <div class="grid md:grid-cols-2 gap-8 items-stretch">
            {{-- Card 1: Cambodia --}}
            <div class="group/card relative rounded-3xl p-8 border border-slate-200/60 hover:border-slate-300 shadow-md hover:shadow-xl transition-all duration-500 flex flex-col justify-between" data-reveal="left" data-glow-card style="background: radial-gradient(350px circle at var(--mouse-x, 0px) var(--mouse-y, 0px), rgba(255, 255, 255, 0.85), transparent 80%), #f9fafb;">
                {{-- Top Border Accent Gradient --}}
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#2d6fa3] to-[#8da83a] rounded-t-3xl"></div>
                
                <div>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-[#2d6fa3]/10 flex items-center justify-center text-[#2d6fa3] shadow-inner group-hover/card:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-black text-[#1d4e7a] text-lg uppercase tracking-wide">Volunteering in Cambodia</h3>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mt-0.5">Locational Track</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">
                        At Krousar Thmey, our priority is for all work to be done by Cambodians. However, the organization welcomes foreign volunteers with a specific project involving knowledge and know-how lacking in Cambodia, that they would be willing to transfer to our Cambodian team.
                    </p>
                    
                    {{-- Requirements & Process details --}}
                    <div class="space-y-3 mb-8">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Requirements & Process:</h4>
                        <div class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#2d6fa3] mt-2 flex-shrink-0"></span>
                            <p class="text-gray-500 text-xs">Specific project outline focused on knowledge and skills transfer.</p>
                        </div>
                        <div class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#2d6fa3] mt-2 flex-shrink-0"></span>
                            <p class="text-gray-500 text-xs">Cooperation with the existing local Cambodian staff.</p>
                        </div>
                        <div class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#2d6fa3] mt-2 flex-shrink-0"></span>
                            <p class="text-gray-500 text-xs">Direct review and validation by the communications office.</p>
                        </div>
                    </div>
                </div>
                
                <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <span class="text-xs text-gray-400 font-medium">To submit a volunteering project:</span>
                    <a href="mailto:communication@krousar-thmey.org" class="group/mail inline-flex items-center gap-2 px-5 py-3 bg-[#2d6fa3] text-white hover:bg-[#1d4e7a] rounded-2xl text-xs font-bold transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L23 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        communication@krousar-thmey.org
                    </a>
                </div>
            </div>

            {{-- Card 2: International --}}
            <div class="group/card relative rounded-3xl p-8 border border-slate-200/60 hover:border-slate-300 shadow-md hover:shadow-xl transition-all duration-500 flex flex-col justify-between" data-reveal="right" data-glow-card style="background: radial-gradient(350px circle at var(--mouse-x, 0px) var(--mouse-y, 0px), rgba(255, 255, 255, 0.85), transparent 80%), #f9fafb; --reveal-delay: 150;">
                {{-- Top Border Accent Gradient --}}
                <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#e8a020] to-[#f8bb86] rounded-t-3xl"></div>
                
                <div>
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-2xl bg-[#e8a020]/10 flex items-center justify-center text-[#e8a020] shadow-inner group-hover/card:scale-110 transition-transform duration-300">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h2.913M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-black text-[#1d4e7a] text-lg uppercase tracking-wide">Volunteering Internationally</h3>
                            <p class="text-xs text-gray-400 font-bold uppercase tracking-wider mt-0.5">International structures</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed mb-6">
                        Krousar Thmey does not hire any employee in Europe or Singapore. Fundraising, which is the main activity of our international entities, is handled by volunteers.
                    </p>
                    
                    {{-- Possibilities details --}}
                    <div class="space-y-3 mb-8">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Ways to help in our entities:</h4>
                        <div class="flex gap-2.5 items-start">
                            <span class="w-5 h-5 rounded-full bg-green-50 flex items-center justify-center text-green-600 text-xs font-bold mt-0.5 flex-shrink-0">✓</span>
                            <p class="text-gray-500 text-xs leading-relaxed">
                                <strong>Voluntary Actions:</strong> Participate within your available time in internal & external communication, funding, mobilization, or administration.
                            </p>
                        </div>
                        <div class="flex gap-2.5 items-start">
                            <span class="w-5 h-5 rounded-full bg-green-50 flex items-center justify-center text-green-600 text-xs font-bold mt-0.5 flex-shrink-0">✓</span>
                            <p class="text-gray-500 text-xs leading-relaxed">
                                <strong>Fundraising Support:</strong> Mobilize people in your company, host presentation meetings, share films, photos & posters.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <span class="text-xs text-gray-400 font-medium">To learn more and get involved:</span>
                    <button type="button" id="openVolunteerModal" class="btn-blue py-3 px-6 text-xs font-black uppercase tracking-wider flex items-center justify-center gap-2 group/btn">
                        <span>Apply to Volunteer</span>
                        <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Volunteer Modal --}}
<div id="volunteerModal"
    class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6">

    {{-- Background Overlay --}}
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm close-volunteer-modal"></div>

    {{-- Modal Content --}}
    <div
        class="relative w-full max-w-lg bg-white rounded-2xl shadow-xl border border-slate-200 flex flex-col"
        style="max-height: 90vh;">

        {{-- Header --}}
        <div class="flex-shrink-0 flex items-center justify-between px-5 py-3 border-b border-slate-100 bg-white rounded-t-2xl">
            <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center">
                    <svg class="w-4 h-4 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-900">Apply to Volunteer</h2>
                    <p class="text-[10px] text-slate-400">Join our mission to help children in Cambodia</p>
                </div>
            </div>
            <button type="button"
                class="close-volunteer-modal flex h-7 w-7 items-center justify-center rounded-full bg-slate-100 text-slate-400 hover:bg-slate-200 hover:text-slate-600 transition-all flex-shrink-0">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Scrollable Form Body --}}
        <div class="flex-1 overflow-y-auto p-5 scroll-smooth"
             style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;">

            <form method="POST"
                action="{{ route('volunteer.store') }}"
                enctype="multipart/form-data"
                class="space-y-4">

                @csrf

                {{-- Section 1: Personal Details --}}
                <div class="border border-slate-200 rounded-none bg-white shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-2.5 px-4 py-3 border-b border-slate-100 bg-gradient-to-r from-[#2d6fa3]/5 to-transparent rounded-t-none">
                        <div class="w-6 h-6 rounded-full bg-[#2d6fa3] flex items-center justify-center">
                            <span class="text-white text-[10px] font-bold">1</span>
                        </div>
                        <span class="text-xs font-semibold text-slate-800">Personal Details</span>
                        <span class="text-[10px] text-slate-400 ml-auto">Your basic info</span>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" name="full_name" value="{{ old('full_name') }}" required placeholder="John Doe"
                                    class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                                @error('full_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com"
                                    class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Phone <span class="text-red-500">*</span></label>
                                <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="+855 12 345 678"
                                    class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                                @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Country <span class="text-red-500">*</span></label>
                                <input type="text" name="country" value="{{ old('country') }}" required placeholder="Cambodia"
                                    class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                                @error('country')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Date of Birth <span class="text-slate-400">(opt)</span></label>
                                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                    class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                                @error('date_of_birth')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Gender <span class="text-slate-400">(opt)</span></label>
                                <select name="gender"
                                    class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                                    <option value="">Select...</option>
                                    <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Other</option>
                                    <option value="Prefer not to say" {{ old('gender') === 'Prefer not to say' ? 'selected' : '' }}>Prefer not to say</option>
                                </select>
                                @error('gender')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section 2: Volunteer Details --}}
                <div class="border border-slate-200 rounded-none bg-white shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-2.5 px-4 py-3 border-b border-slate-100 bg-gradient-to-r from-[#2d6fa3]/5 to-transparent rounded-t-none">
                        <div class="w-6 h-6 rounded-full bg-[#2d6fa3] flex items-center justify-center">
                            <span class="text-white text-[10px] font-bold">2</span>
                        </div>
                        <span class="text-xs font-semibold text-slate-800">Volunteer Details</span>
                        <span class="text-[10px] text-slate-400 ml-auto">Your preferences</span>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Availability</label>
                                <select name="availability"
                                    class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                                    <option value="">Select...</option>
                                    <option value="Weekdays">Weekdays</option>
                                    <option value="Weekends">Weekends</option>
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Flexible">Flexible</option>
                                </select>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Interested Program</label>
                                <select name="interested_program"
                                    class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                                    <option value="">Select...</option>
                                    <option value="Education">Education</option>
                                    <option value="Environment">Environment</option>
                                    <option value="Community Development">Community Development</option>
                                    <option value="Events">Events</option>
                                    <option value="Healthcare">Healthcare</option>
                                    <option value="Fundraising">Fundraising</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section 3: Experience & Skills --}}
                <div class="border border-slate-200 rounded-none bg-white shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-2.5 px-4 py-3 border-b border-slate-100 bg-gradient-to-r from-[#2d6fa3]/5 to-transparent rounded-t-none">
                        <div class="w-6 h-6 rounded-full bg-[#2d6fa3] flex items-center justify-center">
                            <span class="text-white text-[10px] font-bold">3</span>
                        </div>
                        <span class="text-xs font-semibold text-slate-800">Experience &amp; Skills</span>
                        <span class="text-[10px] text-slate-400 ml-auto">Your background</span>
                    </div>
                    <div class="p-4 space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Skills <span class="text-red-500">*</span></label>
                            <input type="text" name="skills" value="{{ old('skills') }}" required placeholder="e.g. Teaching, fundraising, content writing..."
                                class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                            @error('skills')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Motivation <span class="text-red-500">*</span></label>
                            <textarea name="motivation" rows="2" required placeholder="Why do you want to volunteer with Krousar Thmey?"
                                class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all resize-none bg-white hover:border-slate-300">{{ old('motivation') }}</textarea>
                            @error('motivation')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Previous Experience <span class="text-slate-400">(opt)</span></label>
                            <input type="text" name="previous_experience" value="{{ old('previous_experience') }}" placeholder="Any relevant experience..."
                                class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                        </div>
                    </div>
                </div>

                {{-- Section 4: Documents --}}
                <div class="border border-slate-200 rounded-none bg-white shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-2.5 px-4 py-3 border-b border-slate-100 bg-gradient-to-r from-[#2d6fa3]/5 to-transparent rounded-t-none">
                        <div class="w-6 h-6 rounded-full bg-[#2d6fa3] flex items-center justify-center">
                            <span class="text-white text-[10px] font-bold">4</span>
                        </div>
                        <span class="text-xs font-semibold text-slate-800">Documents</span>
                        <span class="text-[10px] text-slate-400 ml-auto">Optional files</span>
                    </div>
                    <div class="p-4">
                        <div id="resumeUploadZone"
                            class="border-2 border-dashed border-slate-200 rounded-none p-5 text-center hover:border-[#2d6fa3]/30 hover:bg-[#2d6fa3]/5 transition-all cursor-pointer group">
                            <div class="mb-2 group-hover:scale-105 transition-transform">
                                <svg class="w-8 h-8 text-slate-300 mx-auto group-hover:text-[#2d6fa3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                            </div>
                            <label class="block text-xs font-medium text-slate-600 mb-1 group-hover:text-[#2d6fa3] transition-colors">CV / Resume <span class="text-slate-400">(opt)</span></label>
                            <p class="text-[10px] text-slate-400 mb-2">PDF, DOC or DOCX (max 5MB)</p>
                            <input type="file" id="resumeInput" name="resume" accept=".pdf,.doc,.docx"
                                class="hidden">
                            <div id="resumeFileName" class="text-xs text-[#2d6fa3] font-medium hidden"></div>
                            <div class="inline-flex items-center gap-1.5 text-xs text-slate-500 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-lg group-hover:bg-white group-hover:border-[#2d6fa3]/30 group-hover:text-[#2d6fa3] transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                <span id="resumeBtnLabel">Choose file</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Terms --}}
                <div class="flex items-start gap-3 bg-gradient-to-r from-slate-50 to-white border border-slate-200 p-4 rounded-none">
                    <input type="checkbox" name="agreed_to_terms" value="1"
                        class="mt-0.5 h-4 w-4 rounded border-slate-300 text-[#2d6fa3] accent-[#2d6fa3] focus:ring-[#2d6fa3]/30 flex-shrink-0"
                        {{ old('agreed_to_terms') ? 'checked' : '' }}>
                    <label class="text-xs text-slate-500 leading-relaxed">
                        I agree to the volunteer terms and conditions and confirm that the information provided is accurate. <span class="text-red-500">*</span>
                    </label>
                </div>
                @error('agreed_to_terms')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror

                {{-- Buttons --}}
                <div class="flex items-center gap-3 pt-1">
                    <button type="submit"
                        class="flex-1 bg-[#2d6fa3] text-white px-5 py-3 rounded-2xl font-semibold text-sm hover:bg-[#245b87] transition-all shadow-sm hover:shadow-md active:scale-[0.98]">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Submit Application
                        </span>
                    </button>
                    <button type="button"
                        class="close-volunteer-modal flex-1 border-2 border-slate-200 px-5 py-3 rounded-2xl font-semibold text-sm text-slate-600 hover:bg-slate-50 hover:border-slate-300 transition-all active:scale-[0.98]">
                        Cancel
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- Success Modal --}}
<div id="volunteerSuccessModal"
    class="hidden fixed inset-0 z-[60] flex items-center justify-center p-4">

    {{-- Background Overlay --}}
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm close-success-modal"></div>

    {{-- Modal Content --}}
    <div
        class="relative w-full max-w-sm bg-white rounded-3xl shadow-2xl border border-green-200 flex flex-col overflow-hidden animate-fade-in">

        <div class="px-6 py-8 text-center">
            {{-- Success checkmark --}}
            <div class="mx-auto mb-4 w-16 h-16 rounded-full bg-green-100 flex items-center justify-center">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <h3 class="text-xl font-bold text-slate-800 mb-2">Thank You!</h3>
            <p class="text-sm text-slate-500 leading-relaxed">
                Your volunteer application has been submitted successfully.
            </p>
            <p class="text-xs text-slate-400 mt-3">
                We will review your application and get back to you soon.
            </p>

            <button type="button"
                class="close-success-modal mt-6 w-full bg-gradient-to-r from-[#2d6fa3] to-[#1d4e7a] text-white px-5 py-2.5 rounded-xl font-semibold text-sm hover:from-[#1d4e7a] hover:to-[#153d63] active:scale-[0.98] transition-all shadow-sm">
                Got it!
            </button>
        </div>
    </div>
</div>

{{-- Jobs --}}
<section id="jobs" class="py-20 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14" data-reveal>
            <span class="inline-flex items-center gap-2 bg-[#e8a020]/20 border border-[#e8a020]/30 text-[#e8a020] text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4">Career Opportunities</span>
            <h2 class="text-3xl md:text-4xl font-black uppercase tracking-wide text-[#2d6fa3] mt-4 mb-2">Work With Us</h2>
            <div class="w-12 h-1 bg-[#d32f2f] rounded-full mx-auto mb-5"></div>
            <p class="text-gray-500 max-w-2xl mx-auto text-sm leading-relaxed">Join a dedicated team making a real difference in Cambodia. We hire primarily Cambodian professionals across a range of disciplines.</p>
        </div>

        @if($jobs->isNotEmpty())
        <div class="mb-12 mt-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($jobs as $job)
            <div data-reveal="pop" style="--reveal-delay: {{ ($loop->index % 3) * 150 }}" class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-2xl hover:border-[#2d6fa3]/30 hover:-translate-y-2.5 transition-all duration-500 ease-out overflow-hidden flex flex-col">
                    {{-- Premium image container (full card image) --}}
                    <div class="relative h-48 w-full overflow-hidden flex-shrink-0 bg-slate-100">
                        @if($job->image)
                        <img src="{{ asset('storage/' . $job->image) }}" alt="{{ $job->localized_title }}"
                             class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700 ease-out"
                             onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden'); this.nextElementSibling.classList.add('flex');">
                        @endif
                        <div class="{{ $job->image ? 'hidden' : 'flex' }} absolute inset-0 items-center justify-center bg-gradient-to-br from-[#2d6fa3]/15 to-[#8da83a]/15 flex-col gap-2">
                            <div class="w-12 h-12 rounded-full bg-white/90 backdrop-blur-sm flex items-center justify-center text-[#2d6fa3] shadow-sm group-hover:scale-110 transition-transform duration-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 002 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="text-[10px] font-extrabold text-[#2d6fa3]/60 uppercase tracking-widest">Krousar Thmey</span>
                        </div>
                    </div>

                    <div class="flex-1 p-5 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-3">
                                <span class="text-[9px] font-extrabold px-2.5 py-1 rounded-full tracking-wider uppercase transition-transform duration-300 group-hover:scale-105
                                    {{ $job->status === 'open' ? 'bg-green-50 text-green-700 border border-green-200' : ($job->status === 'filled' ? 'bg-amber-50 text-amber-700 border border-amber-200' : 'bg-rose-50 text-rose-700 border border-rose-200') }}">
                                    {{ $job->status === 'filled' ? 'FILLED' : strtoupper($job->status) }}
                                </span>
                                @if($job->posted_date)
                                <span class="text-[10px] text-slate-400 font-medium">
                                    {{ $job->posted_date->format('M d, Y') }}
                                </span>
                                @endif
                            </div>

                            <h3 class="font-extrabold text-slate-800 text-base md:text-lg mb-2 group-hover:text-[#2d6fa3] transition-colors duration-300 line-clamp-2 leading-snug">
                                {{ $job->localized_title }}
                            </h3>

                            <div class="flex flex-wrap items-center gap-x-2.5 gap-y-1.5 text-xs text-slate-500 mb-4">
                                @if($job->type)
                                <span class="inline-flex items-center gap-1 bg-slate-50 group-hover:bg-sky-50/70 group-hover:border-[#2d6fa3]/20 text-slate-600 px-2 py-0.5 rounded-md font-medium text-[11px] border border-slate-100 transition-all duration-300">
                                    <svg class="w-3.5 h-3.5 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 002 2v10a2 2 0 002 2z"/></svg>
                                    {{ $job->type }}
                                </span>
                                @endif
                                @if($job->location)
                                <span class="inline-flex items-center gap-1 bg-slate-50 group-hover:bg-emerald-50/70 group-hover:border-[#8da83a]/20 text-slate-600 px-2 py-0.5 rounded-md font-medium text-[11px] border border-slate-100 max-w-full transition-all duration-300">
                                    <svg class="w-3.5 h-3.5 text-[#8da83a] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span class="truncate" title="{{ $job->location }}">{{ $job->location }}</span>
                                </span>
                                @endif
                            </div>

                            @if($job->description)
                            <p class="text-slate-500 text-xs leading-relaxed mb-5 line-clamp-3">
                                {{ $job->localized_description }}
                            </p>
                            @endif
                        </div>

                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between">
                            <a href="{{ route('jobs.show', $job) }}" class="inline-flex items-center gap-1.5 text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-bold group/link transition-all duration-300">
                                View details & apply
                                <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover/link:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
            </div>
            @endforeach
            </div>
        </div>
        @endif

        <div class="relative bg-gradient-to-br from-slate-50 via-white to-slate-50/50 rounded-3xl p-8 md:p-12 border border-slate-200/60 shadow-sm overflow-hidden mt-12" data-reveal>
            {{-- Decorative elements --}}
            <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full bg-[#2d6fa3]/5 blur-2xl"></div>
            <div class="absolute -left-10 -bottom-10 w-40 h-40 rounded-full bg-[#8da83a]/5 blur-2xl"></div>
            
            <div class="relative z-10 max-w-3xl mx-auto text-center">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-[#2d6fa3]/10 to-[#8da83a]/10 flex items-center justify-center mx-auto mb-6 shadow-inner transition-transform duration-500 hover:scale-110">
                    <svg class="w-8 h-8 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                
                <h3 class="text-xl md:text-2xl font-extrabold text-[#2d6fa3] uppercase tracking-wide mb-3">Don't see the right fit?</h3>
                <p class="text-slate-500 mb-8 max-w-xl mx-auto text-sm leading-relaxed">
                    We regularly post new positions in social work, education, communications, and administration. Reach out directly to enquire about current opportunities or send your unsolicited application to our HR department.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-2xl mx-auto mb-8">
                    {{-- Phone Contact --}}
                    <div class="group/contact flex items-center gap-4 p-4 rounded-2xl bg-white border border-slate-100 hover:border-[#2d6fa3]/40 hover:shadow-lg hover:-translate-y-1.5 transition-all duration-300 text-left">
                        <div class="w-10 h-10 rounded-xl bg-sky-50 flex items-center justify-center text-[#2d6fa3] shrink-0 group-hover/contact:scale-110 group-hover/contact:rotate-6 transition-transform duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="block text-[10px] uppercase font-bold text-slate-400 tracking-wider">Call HR Department</span>
                            <div class="flex flex-wrap gap-x-2 text-sm font-semibold text-slate-700">
                                <a href="tel:023880502" class="hover:text-[#2d6fa3] transition-colors">023 880 502</a>
                                <span class="text-slate-300">/</span>
                                <a href="tel:023880503" class="hover:text-[#2d6fa3] transition-colors">023 880 503</a>
                            </div>
                        </div>
                    </div>

                    {{-- Email Contact --}}
                    <div class="group/contact flex items-center gap-4 p-4 rounded-2xl bg-white border border-slate-100 hover:border-[#8da83a]/40 hover:shadow-lg hover:-translate-y-1.5 transition-all duration-300 text-left">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-[#8da83a] shrink-0 group-hover/contact:scale-110 group-hover/contact:-rotate-6 transition-transform duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="block text-[10px] uppercase font-bold text-slate-400 tracking-wider">Email Inquiry</span>
                            <a href="#" onclick="event.preventDefault(); openEmail('hr@krousar-thmey.org')" class="block text-sm font-semibold text-slate-700 hover:text-[#8da83a] transition-colors break-all">
                                hr@krousar-thmey.org
                            </a>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center gap-3">
                    <a href="#" onclick="event.preventDefault(); openEmail('hr@krousar-thmey.org')" class="btn-blue text-sm shadow-md hover:shadow-lg transition-all">
                        Send Your Application
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA Banner --}}
<section class="bg-[#1d4e7a] py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-72 h-72 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 rounded-full bg-[#2d6fa3] translate-y-1/2 -translate-x-1/3"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-6 text-center" data-reveal="scale">
        <p class="text-[#8da83a] font-bold text-sm uppercase tracking-widest mb-3">Ready to Help?</p>
        <h2 class="text-3xl md:text-4xl font-black uppercase tracking-wide text-white mb-4">Every Action Counts</h2>
        <p class="text-white/70 text-lg mb-8 max-w-2xl mx-auto">Whether you buy a book, volunteer, partner with us, or send your application — you are helping build a better future for Cambodia's children.</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('involved') }}#book-for-sales" class="btn-primary text-base">Book for Sales</a>
            <a href="{{ route('contact') }}" class="btn-outline text-base">Contact Us</a>
        </div>
    </div>
</section>

{{-- Modal JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    const volunteerModal = document.getElementById('volunteerModal');
    const successModal = document.getElementById('volunteerSuccessModal');
    const openBtn = document.getElementById('openVolunteerModal');
    const body = document.body;

    /** Lock/unlock body scroll */
    function lockScroll() {
        body.style.overflow = 'hidden';
    }

    function unlockScroll() {
        body.style.overflow = '';
    }

    /** Show a modal (remove 'hidden') */
    function showModal(modal) {
        if (!modal) return;
        modal.classList.remove('hidden');
        lockScroll();
    }

    /** Hide a modal (add 'hidden') */
    function hideModal(modal) {
        if (!modal) return;
        modal.classList.add('hidden');
        unlockScroll();
    }

    // ── Open volunteer modal ──
    if (openBtn && volunteerModal) {
        openBtn.addEventListener('click', function(e) {
            e.preventDefault();
            showModal(volunteerModal);
        });
    }

    // ── Close volunteer modal ──
    if (volunteerModal) {
        // Close on overlay, X button, or Cancel click
        volunteerModal.addEventListener('click', function(e) {
            if (e.target.closest('.close-volunteer-modal')) {
                hideModal(volunteerModal);
            }
        });
    }

    // ── Show success modal if form was submitted successfully ──
    @if(session('volunteer_success'))
        if (successModal) {
            showModal(successModal);
        }
    @endif

    // ── Auto-open volunteer modal on validation errors ──
    @if($errors->any())
        if (volunteerModal) {
            showModal(volunteerModal);
        }
    @endif

    // ── Resume upload: click zone triggers hidden file input ──
    const uploadZone = document.getElementById('resumeUploadZone');
    const resumeInput = document.getElementById('resumeInput');
    const resumeFileName = document.getElementById('resumeFileName');

    if (uploadZone && resumeInput) {
        uploadZone.addEventListener('click', function(e) {
            // Don't trigger if the user clicks the actual file input (it's hidden anyway)
            if (e.target !== resumeInput) {
                resumeInput.click();
            }
        });

        resumeInput.addEventListener('change', function() {
            if (resumeInput.files && resumeInput.files.length > 0) {
                const name = resumeInput.files[0].name;
                if (resumeFileName) {
                    resumeFileName.textContent = 'Selected: ' + name;
                    resumeFileName.classList.remove('hidden');
                }
                // Update the "Choose file" label
                const btnLabel = document.getElementById('resumeBtnLabel');
                if (btnLabel) {
                    btnLabel.textContent = 'Change file';
                }
            }
        });
    }

    // ── Close success modal ──
    if (successModal) {
        successModal.addEventListener('click', function(e) {
            if (e.target.classList.contains('close-success-modal')) {
                hideModal(successModal);
            }
        });
    }

    // ── Escape key closes any open modal ──
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (successModal && !successModal.classList.contains('hidden')) {
                hideModal(successModal);
            } else if (volunteerModal && !volunteerModal.classList.contains('hidden')) {
                hideModal(volunteerModal);
            }
        }
    });

    // ── Cursor-Tracking Spotlight Glow Animation on Volunteer Cards ──
    document.querySelectorAll('[data-glow-card]').forEach(card => {
        card.addEventListener('mousemove', e => {
            const rect = card.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            card.style.setProperty('--mouse-x', `${x}px`);
            card.style.setProperty('--mouse-y', `${y}px`);
            card.style.transform = 'translateY(-6px) scale(1.015)';
            card.style.boxShadow = '0 25px 50px -12px rgba(0, 0, 0, 0.08)';
            card.style.transition = 'transform 0.15s cubic-bezier(0.25, 1, 0.5, 1), box-shadow 0.15s ease';
        });
        
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0) scale(1)';
            card.style.boxShadow = '';
            card.style.transition = 'transform 0.6s cubic-bezier(0.25, 1, 0.5, 1), box-shadow 0.6s ease';
        });
    });

    // ── Clean up body scroll on page unload (just in case) ──
    window.addEventListener('beforeunload', function() {
        unlockScroll();
    });
});
</script>

@endsection
