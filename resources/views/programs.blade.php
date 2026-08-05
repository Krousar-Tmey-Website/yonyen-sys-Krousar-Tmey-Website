@extends('layouts.app')

@section('title', 'Our Programs — Krousar Thmey')
@section('description', 'Discover Krousar Thmey\'s three core programs: child welfare, special education for deaf and blind children, and cultural and artistic development.')

@section('content')

    {{-- Per-program icon helper --}}
    @php
        $programs = collect($programs);
        $programIconFor = function (string $title, string $size = 'w-5 h-5') {
            $t = strtolower($title);
            $attrs = "class=\"{$size}\" fill=\"none\" stroke=\"currentColor\" viewBox=\"0 0 24 24\" stroke-width=\"1.75\" stroke-linecap=\"round\" stroke-linejoin=\"round\"";
            if (str_contains($t, 'welfare')) {
                return "<svg {$attrs} stroke-width=\"2\"><path d=\"M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z\"/></svg>";
            }
            if (str_contains($t, 'educat') || str_contains($t, 'deaf') || str_contains($t, 'blind')) {
                return "<svg {$attrs}><path d=\"M12 6c-1.5-1-4-1.5-6-1.2v12.4c2-.3 4.5.2 6 1.2 1.5-1 4-1.5 6-1.2V4.8c-2-.3-4.5.2-6 1.2z\"/><line x1=\"12\" y1=\"6\" x2=\"12\" y2=\"18.4\"/></svg>";
            }
            if (str_contains($t, 'cultur') || str_contains($t, 'art')) {
                return "<svg {$attrs}><circle cx=\"7\" cy=\"17\" r=\"2.3\"/><circle cx=\"17\" cy=\"15\" r=\"2.3\"/><line x1=\"9.3\" y1=\"17\" x2=\"9.3\" y2=\"5.5\"/><line x1=\"19.3\" y1=\"15\" x2=\"19.3\" y2=\"3.5\"/><line x1=\"9.3\" y1=\"5.5\" x2=\"19.3\" y2=\"3.5\"/></svg>";
            }
            if (str_contains($t, 'career') || str_contains($t, 'counsel')) {
                return "<svg {$attrs}><rect x=\"3.5\" y=\"8\" width=\"17\" height=\"11\" rx=\"2\"/><path d=\"M8.5 8V6a2 2 0 012-2h3a2 2 0 012 2v2\"/><line x1=\"3.5\" y1=\"13\" x2=\"20.5\" y2=\"13\"/></svg>";
            }
            if (str_contains($t, 'health') || str_contains($t, 'hygiene')) {
                return "<svg {$attrs}><circle cx=\"12\" cy=\"12\" r=\"8.3\"/><line x1=\"12\" y1=\"8.3\" x2=\"12\" y2=\"15.7\"/><line x1=\"8.3\" y1=\"12\" x2=\"15.7\" y2=\"12\"/></svg>";
            }
            return "<svg {$attrs}><path d=\"M12 3l1.8 5.2L19 10l-5.2 1.8L12 17l-1.8-5.2L5 10l5.2-1.8z\"/></svg>";
        };
    @endphp

    {{-- Premium Page Header --}}
    <section class="bg-[#1a3c6e] relative overflow-hidden min-h-[560px] md:min-h-[620px] lg:min-h-[680px] flex items-center">
        @if(!empty($bannerImage))
            <div class="absolute inset-0">
                <img src="{{ str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage) }}" alt="" aria-hidden="true" class="absolute inset-0 w-full h-full object-cover object-[center_30%] scale-110 blur-xl opacity-22 hero-media-drift">
                <img src="{{ str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage) }}" alt="{{ strip_tags($bannerTitle) }}" class="absolute inset-0 w-full h-full object-cover object-[center_30%] hero-media-drift">
            </div>
        @endif
        
        {{-- Animated decorative orbs --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
            <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full hero-float-slow" style="background: radial-gradient(circle, rgba(255,255,255,0.10) 0%, transparent 70%);"></div>
            <div class="absolute -bottom-32 -left-32 w-[30rem] h-[30rem] rounded-full hero-float-delayed" style="background: radial-gradient(circle, rgba(255,255,255,0.07) 0%, transparent 70%);"></div>
            <div class="absolute top-1/3 left-1/4 w-48 h-48 rounded-full hero-pulse" style="background: radial-gradient(circle, rgba(141,168,58,0.20) 0%, transparent 70%);"></div>
            <div class="absolute bottom-1/4 right-1/4 w-40 h-40 rounded-full hero-float-slow" style="animation-delay: 4s; background: radial-gradient(circle, rgba(238,169,29,0.15) 0%, transparent 70%);"></div>
        </div>
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_78%_18%,_rgba(255,255,255,0.18),_transparent_0,_transparent_26%),radial-gradient(circle_at_12%_84%,_rgba(141,168,58,0.12),_transparent_0,_transparent_24%),linear-gradient(180deg,_rgba(255,255,255,0.04),_transparent_36%)]"></div>
        <div class="absolute inset-0 bg-[linear-gradient(112deg,rgba(10,29,56,0.96)_0%,rgba(16,40,74,0.92)_32%,rgba(22,55,99,0.72)_56%,rgba(45,111,163,0.18)_100%)]"></div>
        @if(empty($bannerImage))
            <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white/5 -translate-y-1/2 translate-x-1/3"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#2d6fa3]/30 translate-y-1/2 -translate-x-1/4"></div>
        @endif
        <div class="absolute inset-0 bg-gradient-to-t from-[#163763]/56 via-[#163763]/12 to-transparent"></div>
        
        <div class="relative w-full max-w-7xl mx-auto px-6 py-16 md:py-20 lg:py-24 z-10">
            <div class="max-w-[38rem]">
                <div class="inline-flex items-center gap-3 px-3.5 py-1.5 rounded-full bg-white/10 backdrop-blur-md border border-white/20 shadow-lg mb-6 hero-reveal">
                    <span class="inline-flex items-center gap-2 text-[11px] font-bold uppercase tracking-[0.28em] text-white">
                        <span class="w-2 h-2 rounded-full bg-[#8da83a]"></span>
                        Cambodia Since 1991
                    </span>
                </div>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-6 uppercase tracking-wide leading-tight drop-shadow-lg hero-reveal hero-reveal-delay-1">
                    {{ strip_tags($bannerTitle) }}
                </h1>
                
                <div class="flex items-center gap-4 mb-8 hero-reveal hero-reveal-delay-2">
                    <div class="w-24 h-1.5 bg-gradient-to-r from-[#d32f2f] to-[#e8a020] rounded-full"></div>
                </div>
                
                @if($bannerSubtitle)
                    <div class="rich-text-content text-white/90 text-lg md:text-xl max-w-xl leading-relaxed hero-reveal hero-reveal-delay-2 font-medium drop-shadow-md">
                        {!! $bannerSubtitle !!}
                    </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Program Overview Anchors --}}
    <section class="relative -mt-20 z-20 pb-16">
        <div class="max-w-7xl mx-auto px-6">
            @php 
                $progCount = $programs->take(3)->count(); 
                $gridCols = $progCount === 1 ? 'md:grid-cols-1 max-w-md mx-auto' : ($progCount === 2 ? 'md:grid-cols-2 max-w-4xl mx-auto' : 'md:grid-cols-3');
            @endphp
            <div class="grid {{ $gridCols }} gap-6 justify-center">
                @php $colors = ['from-[#1a3c6e] to-[#2d6fa3]', 'from-[#e8a020] to-[#f4b642]', 'from-[#2d6fa3] to-[#458bc2]']; @endphp
                @foreach($programs->take(3) as $index => $prog)
                    <a href="#{{ $prog->slug }}"
                        class="rounded-3xl p-8 text-white shadow-xl shadow-[#1a3c6e]/20 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between min-h-[200px] group relative overflow-hidden {{ $prog->overview_card_color ? '' : 'bg-gradient-to-br ' . $colors[$index % 3] }}"
                        data-reveal="up" style="--reveal-delay: {{ $index * 100 }} @if($prog->overview_card_color); background-color: {{ $prog->overview_card_color }}@endif">
                        <div class="absolute top-0 right-0 w-40 h-40 rounded-full bg-white/10 -translate-y-1/2 translate-x-1/3 blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                        <div class="relative flex items-center justify-between">
                            <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur flex items-center justify-center group-hover:bg-white group-hover:text-[#1a3c6e] transition-all duration-300 shadow-inner">
                                {!! $programIconFor($prog->title, 'w-7 h-7') !!}
                            </div>
                            @if($prog->localized_status)
                                <span class="text-[10px] font-black uppercase tracking-widest text-white/90 bg-white/20 backdrop-blur px-3 py-1.5 rounded-full">{{ $prog->localized_status }}</span>
                            @endif
                        </div>
                        <div class="relative mt-8">
                            <div class="font-black text-white text-lg uppercase tracking-wider drop-shadow-sm">{{ $prog->localized_title }}</div>
                            <div class="mt-4 flex items-center gap-2 text-white/70 group-hover:text-white transition-colors text-xs font-bold uppercase tracking-widest">
                                Discover
                                <svg class="w-4 h-4 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Main Programs --}}
    @foreach($programs->take(3) as $index => $program)
        @php $isEven = $index % 2 != 0; @endphp
        <section id="{{ $program->slug }}" class="py-20 lg:py-28 {{ $isEven ? 'bg-gray-50' : 'bg-white' }} relative overflow-hidden">
            @if($isEven)
            <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-[#2d6fa3]/5 rounded-full blur-3xl -translate-y-1/2 -translate-x-1/4"></div>
            @else
            <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-[#e8a020]/5 rounded-full blur-3xl translate-y-1/2 translate-x-1/4"></div>
            @endif

            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="grid lg:grid-cols-12 gap-12 lg:gap-20 items-center">

                    {{-- Left Side: Content --}}
                    <div class="lg:col-span-6 {{ $isEven ? 'lg:order-2' : '' }} flex flex-col justify-center">
                        <div class="flex items-center gap-4 mb-8" data-reveal="{{ $isEven ? 'right' : 'left' }}">
                            @if($program->accent_color)
                            <div class="w-2 h-10 rounded-full" style="background-color: {{ $program->accent_color }}"></div>
                            @else
                            <div class="w-2 h-10 rounded-full bg-gradient-to-b from-[#d32f2f] to-[#e8a020]"></div>
                            @endif
                            <h2 class="text-3xl lg:text-4xl font-black text-[#1a3c6e] uppercase tracking-wide leading-tight drop-shadow-sm">
                                {{ $program->localized_title }}
                            </h2>
                        </div>

                        @if($program->localized_description)
                            <div class="mb-10" data-reveal="{{ $isEven ? 'right' : 'left' }}" style="--reveal-delay: 100">
                                <div class="relative border border-[#f2e6c9] rounded-2xl p-7 md:p-8 shadow-sm overflow-hidden {{ $program->card_background_color ? '' : 'bg-[#fffdf8]' }}"
                                     @if($program->card_background_color) style="background-color: {{ $program->card_background_color }}" @endif>
                                    {{-- Clean left accent bar --}}
                                    @if($program->accent_color)
                                    <div class="absolute top-0 left-0 w-[6px] h-full" style="background-color: {{ $program->accent_color }}"></div>
                                    @else
                                    <div class="absolute top-0 left-0 w-[6px] h-full bg-gradient-to-b from-[#e8a020] to-[#d32f2f]"></div>
                                    @endif

                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-9 h-9 rounded-full bg-[#e8a020]/10 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-[#e8a020]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-black text-[#e8a020] uppercase tracking-widest">Objective</h3>
                                    </div>
                                    <div class="rich-text-content text-gray-800 leading-relaxed text-lg md:text-[1.15rem] font-medium pl-1">
                                        {!! $program->localized_description !!}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($program->localized_full_description)
                            <div class="mb-10 rounded-3xl p-6 border border-gray-100 shadow-sm {{ $program->details_background_color ? '' : 'bg-white/50 backdrop-blur' }}"
                                 data-reveal="{{ $isEven ? 'right' : 'left' }}" style="--reveal-delay: 200 @if($program->details_background_color); background-color: {{ $program->details_background_color }}@endif">
                                <h3 class="text-sm font-black text-[#1a3c6e] uppercase tracking-widest mb-4">Program Details</h3>
                                <div class="rich-text-content text-gray-600 leading-loose">
                                    {!! $program->localized_full_description !!}
                                </div>
                            </div>
                        @endif

                        <div class="flex flex-col sm:flex-row gap-4 mb-10" data-reveal="{{ $isEven ? 'right' : 'left' }}" style="--reveal-delay: 300">
                            @if($program->projects && $program->projects->count() > 0)
                                <a href="#projects-{{ $program->slug }}"
                                    class="bg-[#1a3c6e] text-white px-8 py-4 rounded-xl text-sm font-bold hover:bg-[#2d6fa3] hover:shadow-lg transition-all text-center uppercase tracking-widest">
                                    Explore Projects
                                </a>
                            @endif
                            <a href="{{ route('donate') }}"
                                class="group bg-transparent text-[#8da83a] border-2 border-[#8da83a] px-8 py-4 rounded-full text-[15px] font-black uppercase tracking-widest hover:bg-[#8da83a] hover:text-white hover:shadow-[0_8px_20px_rgba(141,168,58,0.4)] transition-all duration-300 text-center flex items-center justify-center gap-2.5">
                                <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                Donate Now
                            </a>
                        </div>
                    </div>

                    {{-- Right Side: Image --}}
                    <div class="lg:col-span-6 {{ $isEven ? 'lg:order-1' : '' }} relative hidden md:block group" data-reveal="{{ $isEven ? 'left' : 'right' }}">
                        <div class="absolute inset-0 bg-[#1a3c6e]/5 rounded-3xl transform rotate-3 scale-105 group-hover:rotate-6 transition-transform duration-700"></div>
                        <div class="relative w-full h-[350px] rounded-3xl overflow-hidden shadow-xl shadow-[#1a3c6e]/20 border-[6px] border-white z-10">
                            <img src="{{ $program->image_url }}" alt="{{ $program->localized_title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        </div>
                    </div>
                </div>

                {{-- Testimony Section --}}
                @if($program->localized_testimony_name && $program->localized_testimony_story)
                    @php $cleanTestimonyName = preg_replace('/^testimony\s*:?\s*/i', '', $program->localized_testimony_name); @endphp
                    <div class="mt-24 max-w-5xl mx-auto bg-gradient-to-br from-[#1a3c6e] to-[#2d6fa3] rounded-[3rem] p-10 md:p-16 text-center shadow-2xl relative overflow-hidden group" data-reveal="up">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4 group-hover:scale-150 transition-transform duration-1000"></div>

                        <div class="relative inline-block mb-6">
                            @if($program->testimony_image)
                                <img src="{{ str_starts_with($program->testimony_image, 'http') ? $program->testimony_image : asset('storage/' . $program->testimony_image) }}"
                                     class="w-32 h-32 mx-auto rounded-full object-cover border-[6px] border-white/20 shadow-xl relative z-10" alt="Testimony">
                            @else
                                <div class="w-32 h-32 mx-auto rounded-full bg-white/10 flex items-center justify-center text-white font-black text-5xl border-[6px] border-white/20 shadow-xl relative z-10">
                                    {{ substr($cleanTestimonyName, 0, 1) }}
                                </div>
                            @endif
                            <div class="absolute -top-3 left-1/2 -translate-x-1/2 z-20 w-12 h-12 bg-[#e8a020] text-white rounded-full flex items-center justify-center shadow-lg border-4 border-[#1a3c6e]">
                                <span class="text-4xl leading-none font-serif mt-2 relative top-0.5">"</span>
                            </div>
                        </div>

                        <p class="text-white/70 font-bold text-xs tracking-widest uppercase mb-2">Impact Testimony</p>
                        <p class="text-white font-black text-2xl md:text-3xl mb-10 drop-shadow-md">{{ $cleanTestimonyName }}</p>

                        @php $testimonyStoryText = strip_tags($program->localized_testimony_story); @endphp
                        <div x-data="{ open: false }" class="bg-white/10 backdrop-blur rounded-[2rem] text-left mx-auto max-w-4xl border border-white/20 overflow-hidden transition-all duration-500">
                            <button @click="open = !open" class="w-full flex items-center justify-between px-8 py-6 hover:bg-white/5 transition-colors focus:outline-none">
                                <span class="text-white font-bold text-sm uppercase tracking-widest" x-text="open ? 'Show Less' : 'Read The Full Story'"></span>
                                <svg class="w-6 h-6 text-white transform transition-transform duration-500 flex-shrink-0" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="px-8 pb-8 pt-0 border-t border-white/10">
                                <p x-show="!open" class="text-white/80 leading-relaxed text-base md:text-lg italic font-medium line-clamp-2 pt-6">{{ $testimonyStoryText }}</p>
                                <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="pt-6">
                                    <div class="rich-text-content text-white/90 leading-loose text-lg italic font-medium drop-shadow-sm">{!! $program->localized_testimony_story !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Projects specific to this program --}}
                @if($program->projects && $program->projects->count() > 0)
                    <div id="projects-{{ $program->slug }}" class="mt-28">
                        <div class="text-center mb-16" data-reveal="up">
                            <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-[#1a3c6e]/10 border border-[#1a3c6e]/20 mb-5 shadow-sm">
                                <div class="w-2 h-2 rounded-full bg-[#1a3c6e]"></div>
                                <span class="text-[#1a3c6e] font-bold text-xs uppercase tracking-widest">Discover</span>
                            </div>
                            <h3 class="text-3xl md:text-4xl font-black text-[#1a3c6e] uppercase tracking-wide">Projects Under This Program</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            @foreach($program->projects as $project)
                                <div class="card group relative overflow-hidden rounded-[2rem] shadow-xl h-[420px] cursor-pointer text-center text-white" data-reveal="up" style="--reveal-delay: {{ $loop->index * 100 }}" x-data="{ adminMenuOpen: false }">
                                    {{-- Background Image --}}
                                    <img src="{{ $project->image_url }}" alt="{{ $project->localized_title }}"
                                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 z-0">
                                    
                                    {{-- Default Gradient (Dark at bottom) --}}
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent z-10 transition-opacity duration-500 group-hover:opacity-0"></div>

                                    {{-- Hover Full Overlay --}}
                                    <div class="absolute inset-0 bg-black/70 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10"></div>

                                    {{-- Default Content (Visible only when NOT hovering) --}}
                                    <div class="absolute inset-0 z-20 flex flex-col justify-end p-8 pb-10 transition-all duration-500 group-hover:opacity-0 group-hover:translate-y-4">
                                        <h4 class="text-xl font-bold uppercase tracking-wide leading-snug drop-shadow-md">{{ $project->localized_title }}</h4>
                                    </div>

                                    {{-- Hover Content (Visible only when hovering; pointer-events-none so blank areas fall through to the Main Card Link below) --}}
                                    <div class="absolute inset-0 z-30 flex flex-col justify-center items-center p-8 opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0 pointer-events-none">
                                        <h4 class="text-xl font-bold uppercase tracking-wide leading-snug mb-4">{{ $project->localized_title }}</h4>
                                        <p class="text-white/90 text-sm leading-relaxed mb-6 line-clamp-5">
                                            {{ Str::limit(strip_tags($project->localized_description), 150) }}
                                        </p>

                                        <div class="mt-auto flex items-center justify-between w-full gap-4 relative z-40 pointer-events-auto">
                                            <a href="{{ route('projects.show', $project) }}" class="inline-flex items-center gap-2 text-white font-black uppercase text-xs tracking-widest hover:text-[#e8a020] transition-colors duration-300 group/read">
                                                Read More
                                                <svg class="w-4 h-4 transform group-hover/read:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                            </a>
                                            
                                            {{-- Donate Button (Z-50 to sit above stretched link) --}}
                                            <a href="{{ route('donate') }}" class="group/btn relative z-50 px-4 py-2.5 text-[#8da83a] bg-white hover:text-white hover:bg-[#8da83a] text-[10px] font-black uppercase tracking-widest rounded-full hover:shadow-[0_8px_20px_rgba(141,168,58,0.6)] hover:-translate-y-1 transition-all duration-300 flex items-center gap-1.5" title="Donate to {{ $project->localized_title }}">
                                                <svg class="w-3.5 h-3.5 group-hover/btn:scale-125 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                                <span>{{ __('Donate') }}</span>
                                            </a>
                                        </div>
                                    </div>
                                    
                                    {{-- Main Card Link --}}
                                    <a href="{{ route('projects.show', $project) }}" class="absolute inset-0 z-20" aria-label="View {{ $project->localized_title }}"></a>

                                    {{-- More Options (View More Detail / Edit Info). Visible to every viewer;
                                         "Edit Info" is protected by AdminMiddleware itself — a logged-out
                                         click redirects to admin login and back to this exact edit page. --}}
                                    <div class="absolute top-4 right-4 z-50 opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto transition-opacity duration-300">
                                        <button type="button" @click="adminMenuOpen = !adminMenuOpen"
                                            class="w-9 h-9 rounded-full bg-black/50 backdrop-blur hover:bg-black/70 text-white flex items-center justify-center transition-colors"
                                            aria-label="More options" title="More options">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="12" cy="19" r="2"/></svg>
                                        </button>
                                        <div x-show="adminMenuOpen" x-cloak @click.away="adminMenuOpen = false"
                                            x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                            class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-1.5 text-left text-gray-700 text-sm overflow-hidden">
                                            <a href="{{ route('projects.show', $project) }}" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-gray-50 transition-colors">
                                                <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                                {{ __('View More Detail') }}
                                            </a>
                                            <a href="{{ route('admin.projects.edit', $project) }}" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-gray-50 transition-colors border-t border-gray-100">
                                                <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                                {{ __('Edit Info') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </section>
    @endforeach

    {{-- Additional Programs (4th+) --}}
    @if($programs->count() > 3)
        <section class="py-24 bg-gray-50 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-[#e8a020]/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4"></div>
            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="text-center mb-16" data-reveal="up">
                    <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-[#e8a020]/10 border border-[#e8a020]/20 mb-5 shadow-sm">
                        <div class="w-2 h-2 rounded-full bg-[#e8a020]"></div>
                        <span class="text-[#e8a020] font-bold text-xs uppercase tracking-widest">{{ strip_tags($additionalLabel) }}</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-black text-[#1a3c6e] uppercase tracking-wide">{{ strip_tags($additionalTitle) }}</h2>
                    <div class="w-24 h-1.5 bg-gradient-to-r from-[#d32f2f] to-[#e8a020] mx-auto mt-6 rounded-full"></div>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @php $extraColors = ['text-[#1a3c6e] bg-[#1a3c6e]/5', 'text-[#e8a020] bg-[#e8a020]/10', 'text-[#2d6fa3] bg-[#2d6fa3]/10']; @endphp
                    @foreach($programs->skip(3) as $index => $program)
                        <div class="group bg-white rounded-[2rem] p-10 border border-gray-100 hover:border-transparent hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 relative overflow-hidden" data-reveal="up" style="--reveal-delay: {{ $index * 100 }}">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-gray-50 rounded-full -translate-y-1/2 translate-x-1/3 group-hover:scale-150 transition-transform duration-700"></div>
                            
                            <div class="w-14 h-14 rounded-2xl {{ $extraColors[$index % 3] }} flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 relative z-10">
                                {!! $programIconFor($program->title, 'w-7 h-7') !!}
                            </div>
                            
                            @if($program->localized_status)
                                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#e8a020]/10 border border-[#e8a020]/20 mb-4 relative z-10">
                                    <span class="text-[#e8a020] font-black text-[10px] uppercase tracking-widest">{{ $program->localized_status }}</span>
                                </div>
                            @endif

                            <h3 class="text-xl font-black text-[#1a3c6e] uppercase tracking-wide mb-3 relative z-10">{{ $program->localized_title }}</h3>
                            <div class="rich-text-content text-gray-600 text-sm leading-relaxed relative z-10 font-medium">{!! $program->localized_description !!}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Additional Information (Page Items) --}}
    @php $additionalItems = \App\Models\ProgramPageItem::active()->orderBy('sort_order')->get()->filter(fn ($item) => filled(app()->getLocale() === 'fr' ? $item->title_fr : $item->title))->values(); @endphp
    @if($additionalItems->count() > 0)
        <section class="py-24 bg-white relative overflow-hidden">
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-[#2d6fa3]/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4"></div>
            
            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="text-center mb-16" data-reveal="up">
                    <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-[#2d6fa3]/10 border border-[#2d6fa3]/20 mb-5 shadow-sm">
                        <div class="w-2 h-2 rounded-full bg-[#2d6fa3]"></div>
                        <span class="text-[#2d6fa3] font-bold text-xs uppercase tracking-widest">{{ strip_tags($infoLabel) }}</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-black text-[#1a3c6e] uppercase tracking-wide">{{ strip_tags($infoTitle) }}</h2>
                    <div class="w-24 h-1.5 bg-gradient-to-r from-[#d32f2f] to-[#e8a020] mx-auto mt-6 rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($additionalItems as $item)
                        <div class="card group relative overflow-hidden rounded-[2rem] shadow-xl h-[420px] cursor-pointer text-center text-white" data-reveal="up" style="--reveal-delay: {{ min($loop->index * 90, 360) }}" x-data="{ adminMenuOpen: false }">

                            {{-- Background Image or Gradient --}}
                            @if($item->image)
                                <img src="{{ $item->image_url }}" alt="{{ $item->localized_title }}"
                                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 z-0">
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-[#1a3c6e] to-[#2d6fa3] z-0 flex items-center justify-center">
                                    <svg class="w-24 h-24 text-white/10 group-hover:scale-110 transition-transform duration-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            @endif

                            {{-- Default Gradient (Dark at bottom) --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent z-10 transition-opacity duration-500 group-hover:opacity-0"></div>

                            {{-- Hover Full Overlay --}}
                            <div class="absolute inset-0 bg-black/70 backdrop-blur-sm opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-10"></div>

                            {{-- Default Content (Visible only when NOT hovering) --}}
                            <div class="absolute inset-0 z-20 flex flex-col justify-end p-8 pb-10 transition-all duration-500 group-hover:opacity-0 group-hover:translate-y-4">
                                <h4 class="text-xl font-bold uppercase tracking-wide leading-snug drop-shadow-md">{{ $item->localized_title }}</h4>
                            </div>

                            {{-- Hover Content (Visible only when hovering; pointer-events-none so blank areas fall through to the Main Card Link below) --}}
                            <div class="absolute inset-0 z-30 flex flex-col justify-center items-center p-8 opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0 pointer-events-none">
                                <h4 class="text-xl font-bold uppercase tracking-wide leading-snug mb-4">{{ $item->localized_title }}</h4>

                                @if($item->short_content)
                                    <p class="text-white/90 text-sm leading-relaxed mb-6 line-clamp-5">
                                        {{ Str::limit(strip_tags($item->localized_short_content), 150) }}
                                    </p>
                                @endif

                                <div class="mt-auto flex items-center justify-between w-full gap-4 relative z-40 pointer-events-auto">
                                    <a href="{{ route('program-page-items.show', $item->id) }}" class="inline-flex items-center gap-2 text-white font-black uppercase text-xs tracking-widest hover:text-[#e8a020] transition-colors duration-300 group/read">
                                        Read More
                                        <svg class="w-4 h-4 transform group-hover/read:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </a>
                                    
                                    {{-- Donate Button --}}
                                    <a href="{{ route('donate') }}" class="group/btn relative z-50 px-4 py-2.5 text-[#8da83a] bg-white hover:text-white hover:bg-[#8da83a] text-[10px] font-black uppercase tracking-widest rounded-full hover:shadow-[0_8px_20px_rgba(141,168,58,0.6)] hover:-translate-y-1 transition-all duration-300 flex items-center gap-1.5" title="Donate to {{ $item->localized_title }}">
                                        <svg class="w-3.5 h-3.5 group-hover/btn:scale-125 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                        <span>{{ __('Donate') }}</span>
                                    </a>
                                </div>
                            </div>
                            
                            {{-- Main Card Link --}}
                            <a href="{{ route('program-page-items.show', $item->id) }}" class="absolute inset-0 z-20" aria-label="View {{ $item->localized_title }}"></a>

                            {{-- More Options (View More Detail / Edit Info). Visible to every viewer;
                                 "Edit Info" is protected by AdminMiddleware itself — a logged-out
                                 click redirects to admin login and back to this exact edit page. --}}
                            <div class="absolute top-4 right-4 z-50 opacity-0 group-hover:opacity-100 pointer-events-none group-hover:pointer-events-auto transition-opacity duration-300">
                                <button type="button" @click="adminMenuOpen = !adminMenuOpen"
                                    class="w-9 h-9 rounded-full bg-black/50 backdrop-blur hover:bg-black/70 text-white flex items-center justify-center transition-colors"
                                    aria-label="More options" title="More options">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="12" cy="19" r="2"/></svg>
                                </button>
                                <div x-show="adminMenuOpen" x-cloak @click.away="adminMenuOpen = false"
                                    x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                    class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-1.5 text-left text-gray-700 text-sm overflow-hidden">
                                    <a href="{{ route('program-page-items.show', $item->id) }}" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-gray-50 transition-colors">
                                        <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        {{ __('View More Detail') }}
                                    </a>
                                    <a href="{{ route('admin.program-pages.edit', $item) }}" class="flex items-center gap-2.5 px-4 py-2.5 hover:bg-gray-50 transition-colors border-t border-gray-100">
                                        <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        {{ __('Edit Info') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- CTA --}}
    <section class="relative py-24 overflow-hidden bg-[#1a3c6e]">
        <div class="absolute top-0 right-0 w-[600px] h-[600px] rounded-full bg-[#2d6fa3]/20 -translate-y-1/2 translate-x-1/4 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] rounded-full bg-[#8da83a]/10 translate-y-1/2 -translate-x-1/4 blur-3xl"></div>
        
        <div class="relative max-w-4xl mx-auto px-6 text-center z-10" data-reveal="scale">
            <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-white/10 backdrop-blur border border-white/20 mb-8 shadow-sm">
                <div class="w-2 h-2 rounded-full bg-[#8da83a] animate-pulse"></div>
                <span class="text-white font-bold text-xs uppercase tracking-widest">{{ strip_tags($ctaLabel) }}</span>
            </div>
            
            <h2 class="text-4xl md:text-6xl font-black text-white uppercase tracking-wide mb-6 drop-shadow-md">{{ strip_tags($ctaTitle) }}</h2>
            
            <div class="rich-text-content text-white/80 text-lg md:text-xl mb-12 max-w-2xl mx-auto leading-relaxed font-medium">{!! $ctaSubtitle !!}</div>
            
            <div class="flex flex-col sm:flex-row gap-5 justify-center items-center">
                <a href="{{ route('donate') }}" class="w-full sm:w-auto px-10 py-4 bg-[#8da83a] hover:bg-[#7a932d] text-white rounded-full text-xl font-bold shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    Donate
                </a>
                <a href="{{ route('contact') }}" class="w-full sm:w-auto px-10 py-4 bg-transparent border-2 border-white/30 text-white hover:bg-white hover:text-[#1a3c6e] rounded-xl font-bold transition-all uppercase tracking-widest text-center">
                    Contact Us
                </a>
            </div>
        </div>
    </section>

@endsection
