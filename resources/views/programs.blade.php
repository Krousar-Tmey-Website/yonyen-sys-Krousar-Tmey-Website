@extends('layouts.app')

@section('title', 'Our Programs — Krousar Thmey')
@section('description', 'Discover Krousar Thmey\'s three core programs: child welfare, special education for deaf and blind children, and cultural and artistic development.')

@section('content')

{{-- Page Header --}}
@php
    $bannerBgStyle = !empty($bannerImage)
        ? 'background-image: linear-gradient(to right, rgba(26,60,110,0.90) 50%, rgba(26,60,110,0.65)), url(' . (str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage)) . '); background-size: cover; background-position: center;'
        : '';
@endphp
<div class="bg-[#1a3c6e] pt-16 pb-20 relative overflow-hidden" style="{{ $bannerBgStyle }}">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/60 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white">Our Programs</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">{{ $bannerTitle }}</h1>
        @if($bannerSubtitle)
        <p class="text-white/70 text-lg max-w-2xl">{{ $bannerSubtitle }}</p>
        @endif
    </div>
</div>

{{-- Program Overview --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        @php $progCount = $programs->take(3)->count(); @endphp
        <div class="grid md:grid-cols-{{ $progCount }} gap-6 {{ $progCount < 3 ? 'max-w-4xl mx-auto' : '' }}">
            @php $colors = ['bg-[#1a3c6e]', 'bg-[#e8a020]', 'bg-[#2d6fa3]']; @endphp
            @foreach($programs->take(3) as $index => $prog)
            <a href="#{{ $prog->slug }}" class="{{ $colors[$index % 3] }} rounded-2xl p-7 text-white hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between min-h-[140px] group">
                <div class="text-2xl font-bold mb-1">
                    {{ $prog->Status ?: '&nbsp;' }}
                </div>
                <div class="font-semibold text-white/80 group-hover:text-white transition-colors mt-auto">{{ $prog->title }}</div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Main Programs --}}
@foreach($programs->take(3) as $index => $program)
@php $isEven = $index % 2 != 0; @endphp
<section id="{{ $program->slug }}" class="py-20 {{ $isEven ? 'bg-white' : 'bg-[#f8f9fc]' }}">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-start">
            <div class="{{ $isEven ? 'order-1 lg:order-2' : '' }}">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-1.5 h-8 bg-[#d32f2f]"></div>
                    <h2 class="text-3xl font-black text-[#1a3c6e] uppercase tracking-wide">{{ $program->title }}</h2>
                </div>
                
                @if($program->description)
                <div class="mb-6">
                    <h3 class="text-sm font-bold text-[#1a3c6e] uppercase tracking-wider mb-2">Objective</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $program->description }}</p>
                </div>
                @endif
                
                @if($program->full_description)
                <div class="mb-8">
                    <h3 class="text-sm font-bold text-[#1a3c6e] uppercase tracking-wider mb-2">Program</h3>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $program->full_description }}</p>
                </div>
                @endif

                <div class="flex flex-col sm:flex-row gap-4 mb-8">
                    @if($program->projects && $program->projects->count() > 0)
                    <a href="#projects-{{ $program->slug }}" class="btn-blue justify-center text-center w-full sm:w-auto">Know more about the projects</a>
                    @endif
                    <a href="{{ route('donate') }}" class="btn-primary flex items-center justify-center gap-2 w-full sm:w-auto">
                        <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                        DONATE NOW
                    </a>
                </div>
            </div>
            <div class="{{ $isEven ? 'order-2 lg:order-1 space-y-4' : 'space-y-4' }}">
                <img src="{{ $program->image_url }}" alt="{{ $program->title }}" class="w-full h-auto object-cover border-4 border-[#8da83a]/10 shadow-md">
                
                @if($program->facebook_url || $program->linkedin_url || $program->instagram_url || $program->telegram_url || $program->youtube_url)
                <div class="flex items-center justify-center gap-1.5 mt-4">
                    @if($program->facebook_url)
                    <a href="{{ $program->facebook_url }}" target="_blank" rel="noopener" class="w-8 h-8 text-white rounded flex items-center justify-center hover:opacity-90 transition-opacity" style="background-color: #1877f2;" title="Facebook">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    @endif
                    @if($program->telegram_url)
                    <a href="{{ $program->telegram_url }}" target="_blank" rel="noopener" class="w-8 h-8 text-white rounded flex items-center justify-center hover:opacity-90 transition-opacity" style="background-color: #0088cc;" title="Telegram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M9.78 18.65l.28-4.28 7.68-6.92c.34-.3-.07-.46-.52-.18L7.74 13.3 3.64 12c-.88-.28-.9-.88.18-1.3l16.1-6.2c.74-.28 1.38.16 1.14 1.25l-2.74 12.92c-.2 1-.8 1.24-1.64.78l-4.18-3.08-2.02 1.95c-.22.22-.4.4-.78.4z"/></svg>
                    </a>
                    @endif
                    @if($program->linkedin_url)
                    <a href="{{ $program->linkedin_url }}" target="_blank" rel="noopener" class="w-8 h-8 text-white rounded flex items-center justify-center hover:opacity-90 transition-opacity" style="background-color: #0a66c2;" title="LinkedIn">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    @endif
                    @if($program->instagram_url)
                    <a href="{{ $program->instagram_url }}" target="_blank" rel="noopener" class="w-8 h-8 text-white rounded flex items-center justify-center hover:opacity-90 transition-opacity" style="background-color: #e1306c;" title="Instagram">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 1 0 0 12.324 6.162 6.162 0 0 0 0-12.324zM12 16a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/></svg>
                    </a>
                    @endif
                    @if($program->youtube_url)
                    <a href="{{ $program->youtube_url }}" target="_blank" rel="noopener" class="w-8 h-8 text-white rounded flex items-center justify-center hover:opacity-90 transition-opacity" style="background-color: #ff0000;" title="YouTube">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.163a3.003 3.003 0 0 0-2.11-2.11C19.517 3.545 12 3.545 12 3.545s-7.516 0-9.387.507a3.003 3.003 0 0 0-2.11 2.11C0 8.033 0 12 0 12s0 3.967.502 5.837a3.003 3.003 0 0 0 2.11 2.11c1.871.507 9.387.507 9.387.507s7.517 0 9.387-.507a3.003 3.003 0 0 0 2.11-2.11C24 15.967 24 12 24 12s0-3.967-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    @endif
                </div>
                @endif
            </div>
        </div>

        {{-- Testimony Section --}}
        @if($program->testimony_name && $program->testimony_story)
        @php
            $cleanTestimonyName = preg_replace('/^testimony\s*:?\s*/i', '', $program->testimony_name);
        @endphp
        <div class="mt-16 bg-[#1a3c6e]/5 border border-[#1a3c6e]/10 p-8 md:p-12 rounded-3xl text-center max-w-4xl mx-auto shadow-sm">
            <div class="relative inline-block mb-4">
                @if($program->testimony_image)
                <img src="{{ str_starts_with($program->testimony_image, 'http') ? $program->testimony_image : asset('storage/' . $program->testimony_image) }}" class="w-36 h-36 mx-auto rounded-full object-cover border-4 border-white shadow-md relative z-10" alt="Testimony">
                @else
                <div class="w-36 h-36 mx-auto rounded-full bg-[#1a3c6e]/10 flex items-center justify-center text-[#1a3c6e] font-bold text-4xl border-4 border-white shadow-md relative z-10">{{ substr($cleanTestimonyName, 0, 1) }}</div>
                @endif
                {{-- Quote Icon Badge --}}
                <div class="absolute -top-2 left-1/2 -translate-x-1/2 z-20 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-sm border border-gray-100">
                    <span class="text-[#e8a020] text-2xl leading-none font-serif mt-1">"</span>
                </div>
            </div>
            
            <h3 class="text-[#1a3c6e] font-bold text-xs tracking-widest uppercase mb-1">TESTIMONY</h3>
            <p class="text-[#1a3c6e] font-semibold text-base mb-8">{{ $cleanTestimonyName }}</p>
            
            <div x-data="{ open: false }" class="bg-white text-left shadow-md rounded-2xl overflow-hidden border border-gray-100/50">
                <button @click="open = !open" class="w-full flex items-center justify-between p-5 hover:bg-gray-50/50 transition-colors focus:outline-none cursor-pointer">
                    <span class="text-gray-700 font-semibold text-sm">Read full story</span>
                    <svg class="w-5 h-5 text-[#2d6fa3] transform transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div x-show="open" class="p-6 border-t border-gray-100 bg-[#f8f9fc]/50" style="display: none;" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <p class="text-gray-700 leading-relaxed text-sm whitespace-pre-line font-medium">{{ $program->testimony_story }}</p>
                </div>
            </div>
        </div>
        @endif

        {{-- Projects specific to this program --}}
        @if($program->projects && $program->projects->count() > 0)
        <div id="projects-{{ $program->slug }}" class="mt-20 border-t border-gray-200 pt-16">
            <h3 class="text-[#1a3c6e] font-black text-lg uppercase tracking-wider mb-10 text-left">DISCOVER THE PROJECTS OF THIS PROGRAM</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($program->projects as $project)
                <div class="card flex flex-col group shadow-sm">
                    <div class="overflow-hidden h-44 relative">
                        <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6 flex flex-col flex-1 items-center text-center px-4">
                        <h4 class="text-xs font-bold text-gray-800 uppercase tracking-wide mb-4 leading-relaxed min-h-[36px] flex items-center justify-center">{{ $project->title }}</h4>
                        <p class="text-gray-500 text-xs leading-relaxed mb-6 flex-1 w-full">{{ $project->description }}</p>
                        
                        <div class="w-full space-y-2 mt-auto">
                            <a href="{{ route('donate') }}" class="flex items-center justify-center gap-2 w-full py-2 border-2 border-[#d32f2f] text-[#d32f2f] hover:bg-red-50 transition-colors text-xs font-bold bg-white rounded-full">
                                <span class="text-[#d32f2f]">↗</span> DONATE NOW
                            </a>
                            <a href="{{ route('projects.show', $project) }}" class="inline-flex items-center justify-center gap-2 w-full py-2 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white transition-colors text-xs font-bold rounded-full mt-1">
                                Read More Detail
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

{{-- Additional Projects --}}
@if($programs->count() > 3)
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Cross-cutting Work</span>
            <h2 class="section-title mt-3 mx-auto">Additional Projects</h2>
        </div>
        <div class="grid md:grid-cols-2 gap-6">
            @php $colors = ['bg-[#1a3c6e]', 'bg-[#e8a020]']; @endphp
            @foreach($programs->skip(3) as $index => $program)
            <div class="bg-[#f8f9fc] rounded-2xl p-8 border border-gray-100">
                <div class="w-12 h-12 rounded-xl {{ $colors[$index % 2] }} flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                @if($program->Status)
                <div class="text-[#e8a020] font-semibold text-sm mb-2">
                    {{ $program->Status }}
                </div>
                @endif
                <h3 class="text-xl font-bold text-[#1a3c6e] mb-3">{{ $program->title }}</h3>
                <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">{{ $program->description }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="relative py-20 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1400&q=80')] bg-cover bg-center"></div>
    <div class="absolute inset-0 bg-[#1a3c6e]/90"></div>
    <div class="relative z-10 max-w-3xl mx-auto px-6 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Support Our Programs</h2>
        <p class="text-white/70 mb-8">Your donation goes directly to one of these programs. 100% of funds support children in Cambodia.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('donate') }}" class="btn-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                Donate Now
            </a>
            <a href="{{ route('contact') }}" class="btn-outline">Contact Us</a>
        </div>
    </div>
</section>

@endsection
