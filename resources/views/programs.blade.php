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
                <img src="{{ str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage) }}" alt="{{ $bannerTitle }}" class="absolute inset-0 w-full h-full object-cover object-[center_30%] hero-media-drift">
            </div>
        @endif
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
                    {{ $bannerTitle }}
                </h1>
                
                <div class="flex items-center gap-4 mb-8 hero-reveal hero-reveal-delay-2">
                    <div class="w-24 h-1.5 bg-gradient-to-r from-[#d32f2f] to-[#e8a020] rounded-full"></div>
                </div>
                
                @if($bannerSubtitle)
                    <p class="text-white/90 text-lg md:text-xl max-w-xl leading-relaxed hero-reveal hero-reveal-delay-2 font-medium drop-shadow-md">
                        {{ $bannerSubtitle }}
                    </p>
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
                        class="bg-gradient-to-br {{ $colors[$index % 3] }} rounded-3xl p-8 text-white shadow-xl shadow-[#1a3c6e]/20 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 flex flex-col justify-between min-h-[200px] group relative overflow-hidden"
                        data-reveal="up" style="--reveal-delay: {{ $index * 100 }}">
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
                            <div class="w-2 h-10 rounded-full bg-gradient-to-b from-[#d32f2f] to-[#e8a020]"></div>
                            <h2 class="text-3xl lg:text-4xl font-black text-[#1a3c6e] uppercase tracking-wide leading-tight drop-shadow-sm">
                                {{ $program->localized_title }}
                            </h2>
                        </div>

                        @if($program->localized_description)
                            <div class="mb-10" data-reveal="{{ $isEven ? 'right' : 'left' }}" style="--reveal-delay: 100">
                                <div class="relative bg-[#fffdf8] border border-[#f2e6c9] rounded-2xl p-7 md:p-8 shadow-sm overflow-hidden">
                                    <!-- Clean left accent bar -->
                                    <div class="absolute top-0 left-0 w-[6px] h-full bg-gradient-to-b from-[#e8a020] to-[#d32f2f]"></div>
                                    
                                    <div class="flex items-center gap-3 mb-4">
                                        <div class="w-9 h-9 rounded-full bg-[#e8a020]/10 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-[#e8a020]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                            </svg>
                                        </div>
                                        <h3 class="text-sm font-black text-[#e8a020] uppercase tracking-widest">Objective</h3>
                                    </div>
                                    <p class="text-gray-800 leading-relaxed text-lg md:text-[1.15rem] font-medium pl-1">
                                        {{ $program->localized_description }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if($program->localized_full_description)
                            <div class="mb-10 bg-white/50 backdrop-blur rounded-3xl p-6 border border-gray-100 shadow-sm" data-reveal="{{ $isEven ? 'right' : 'left' }}" style="--reveal-delay: 200">
                                <h3 class="text-sm font-black text-[#1a3c6e] uppercase tracking-widest mb-4">Program Details</h3>
                                <div class="prose prose-lg prose-p:text-gray-600 prose-p:leading-loose max-w-none">
                                    <p class="whitespace-pre-line">{{ $program->localized_full_description }}</p>
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

                        <div x-data="{ open: false }" class="bg-white/10 backdrop-blur rounded-[2rem] text-left mx-auto max-w-4xl border border-white/20 overflow-hidden transition-all duration-500">
                            <button @click="open = !open" class="w-full flex items-center justify-between px-8 py-6 hover:bg-white/5 transition-colors focus:outline-none">
                                <span class="text-white font-bold text-sm uppercase tracking-widest">Read The Full Story</span>
                                <svg class="w-6 h-6 text-white transform transition-transform duration-500" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" class="px-8 pb-8 pt-4 border-t border-white/10" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0">
                                <p class="text-white/90 leading-loose text-lg whitespace-pre-line italic font-medium drop-shadow-sm">{{ $program->localized_testimony_story }}</p>
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
                                <div class="group bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 border border-gray-100 flex flex-col h-full relative" data-reveal="up" style="--reveal-delay: {{ $loop->index * 100 }}">
                                    {{-- Main Card Link --}}
                                    <a href="{{ route('projects.show', $project) }}" class="absolute inset-0 z-10" aria-label="View {{ $project->title }}"></a>

                                    <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#1a3c6e]/5 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                                    <div class="h-48 overflow-hidden relative">
                                        <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                        <div class="absolute inset-0 bg-gradient-to-t from-[#1a3c6e]/90 via-[#1a3c6e]/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-300"></div>
                                        <div class="absolute bottom-6 left-6 right-6">
                                            <h4 class="text-lg font-black text-white uppercase tracking-wide leading-snug drop-shadow-md">{{ $project->title }}</h4>
                                        </div>
                                    </div>
                                    <div class="p-8 flex flex-col flex-1 relative">
                                        @if($project->description)
                                            <p class="text-gray-600 text-[15px] leading-relaxed flex-1 mb-8">{{ Str::limit($project->description, 130) }}</p>
                                        @endif
                                        <div class="mt-auto flex items-center justify-between">
                                            <span class="inline-flex items-center gap-2 text-[#2d6fa3] text-xs font-black uppercase tracking-widest group-hover:text-[#1a3c6e] transition-colors duration-300">
                                                Read More
                                                <svg class="w-4 h-4 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                            </span>
                                            
                                            {{-- Donate Button (Z-20 to sit above stretched link) --}}
                                            <a href="{{ route('donate') }}" class="group/btn relative z-20 px-5 py-2.5 text-[#8da83a] bg-transparent hover:text-white hover:bg-[#8da83a] text-[11px] font-black uppercase tracking-widest rounded-full hover:shadow-[0_8px_20px_rgba(141,168,58,0.6)] hover:-translate-y-1 transition-all duration-300 flex items-center gap-2" title="Donate to {{ $project->title }}">
                                                <svg class="w-4 h-4 group-hover/btn:scale-125 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                                <span>Donate Now</span>
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
                        <span class="text-[#e8a020] font-bold text-xs uppercase tracking-widest">{{ $additionalLabel }}</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-black text-[#1a3c6e] uppercase tracking-wide">{{ $additionalTitle }}</h2>
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
                            <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line relative z-10 font-medium">{{ $program->localized_description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- Additional Information (Page Items) --}}
    @php $additionalItems = \App\Models\ProgramPageItem::active()->orderBy('sort_order')->get(); @endphp
    @if($additionalItems->count() > 0)
        <section class="py-24 bg-white relative overflow-hidden">
            <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-[#2d6fa3]/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/4"></div>
            
            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="text-center mb-16" data-reveal="up">
                    <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-[#2d6fa3]/10 border border-[#2d6fa3]/20 mb-5 shadow-sm">
                        <div class="w-2 h-2 rounded-full bg-[#2d6fa3]"></div>
                        <span class="text-[#2d6fa3] font-bold text-xs uppercase tracking-widest">{{ $infoLabel }}</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-black text-[#1a3c6e] uppercase tracking-wide">{{ $infoTitle }}</h2>
                    <div class="w-24 h-1.5 bg-gradient-to-r from-[#d32f2f] to-[#e8a020] mx-auto mt-6 rounded-full"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($additionalItems as $item)
                        <div class="group bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 flex flex-col h-full hover:-translate-y-2 relative" data-reveal="up" style="--reveal-delay: {{ min($loop->index * 90, 360) }}">
                            
                            {{-- Main Card Link --}}
                            <a href="{{ route('program-page-items.show', $item->id) }}" class="absolute inset-0 z-10" aria-label="View {{ $item->localized_title }}"></a>

                            <div class="absolute -top-20 -right-20 w-40 h-40 bg-[#2d6fa3]/5 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>

                            @if($item->image)
                                <div class="h-48 overflow-hidden relative bg-[#1a3c6e]/5 p-2">
                                    <img src="{{ $item->image_url }}" alt="{{ $item->localized_title }}" class="w-full h-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-700 shadow-inner">
                                </div>
                            @else
                                <div class="h-48 bg-gradient-to-br from-[#1a3c6e] to-[#2d6fa3] flex items-center justify-center m-2 rounded-2xl">
                                    <svg class="w-10 h-10 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            @endif

                            <div class="p-8 flex flex-col flex-1 relative">
                                <h3 class="text-lg font-black text-[#1a3c6e] mb-3 uppercase tracking-wide group-hover:text-[#2d6fa3] transition-colors">{{ $item->localized_title }}</h3>

                                @if($item->short_content)
                                    <p class="text-gray-600 text-sm font-medium leading-relaxed flex-1 mb-8">{{ Str::limit($item->localized_short_content, 110) }}</p>
                                @endif

                                <div class="mt-auto flex items-center justify-between pt-6 border-t border-gray-100">
                                    <span class="inline-flex items-center gap-2 text-[#2d6fa3] text-xs font-black uppercase tracking-widest group-hover:text-[#1a3c6e] transition-colors duration-300">
                                        Read More
                                        <svg class="w-4 h-4 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                    </span>

                                    {{-- Donate Button (Z-20 to sit above stretched link) --}}
                                    <a href="{{ route('donate') }}" class="group/btn relative z-20 px-5 py-2.5 text-[#8da83a] bg-transparent hover:text-white hover:bg-[#8da83a] text-[11px] font-black uppercase tracking-widest rounded-full hover:shadow-[0_8px_20px_rgba(141,168,58,0.6)] hover:-translate-y-1 transition-all duration-300 flex items-center gap-2" title="Donate to {{ $item->localized_title }}">
                                        <svg class="w-4 h-4 group-hover/btn:scale-125 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                                        <span>Donate Now</span>
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
                <span class="text-white font-bold text-xs uppercase tracking-widest">{{ $ctaLabel }}</span>
            </div>
            
            <h2 class="text-4xl md:text-6xl font-black text-white uppercase tracking-wide mb-6 drop-shadow-md">{{ $ctaTitle }}</h2>
            
            <p class="text-white/80 text-lg md:text-xl mb-12 max-w-2xl mx-auto leading-relaxed font-medium">{{ $ctaSubtitle }}</p>
            
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