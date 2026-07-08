@extends('layouts.app')

@section('title', $project->title . ' — Krousar Thmey')

@section('content')

{{-- Page Header --}}
@php
    $bannerImg = $project->banner_image ?? '';
    $bannerImgSrc = $bannerImg
        ? (str_starts_with($bannerImg, 'http') ? $bannerImg : asset('storage/' . $bannerImg))
        : '';
    $bannerStyle = $bannerImgSrc
        ? 'background-image: linear-gradient(to right, rgba(26,60,110,0.92) 45%, rgba(26,60,110,0.70)), url(' . $bannerImgSrc . '); background-size: cover; background-position: center;'
        : '';
@endphp
<div class="bg-[#1a3c6e] pt-16 pb-20 relative overflow-hidden" style="{{ $bannerStyle }}">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/60 mb-8 font-medium">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('programs') }}" class="hover:text-white transition-colors">Our Programs</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white drop-shadow-sm">{{ $project->title }}</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 uppercase tracking-tight">{{ $project->title }}</h1>
        @if($project->description)
        <p class="text-white/70 text-lg max-w-2xl">{{ $project->description }}</p>
        @endif
    </div>
</div>

<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        
        <div class="grid lg:grid-cols-[1.5fr,1fr] gap-12 items-start">
            
            <div class="space-y-8">
                <div class="flex gap-4">
                    <div class="w-1.5 h-auto self-stretch bg-[#d32f2f]"></div>
                    <h2 class="text-3xl font-black text-[#1a3c6e] uppercase tracking-wide leading-tight">{{ $project->title }}</h2>
                </div>
                
                @if($project->objective)
                <div>
                    <h3 class="text-xs font-bold text-[#2d6fa3] tracking-widest uppercase mb-2">OBJECTIVE</h3>
                    <p class="text-gray-700 leading-relaxed text-sm whitespace-pre-line">{{ $project->objective }}</p>
                </div>
                @endif
                
                @if($project->content)
                <div>
                    <h3 class="text-xs font-bold text-[#2d6fa3] tracking-widest uppercase mb-2">PROJECT</h3>
                    <div class="text-gray-700 leading-relaxed text-sm whitespace-pre-line space-y-4">
                        {{ $project->content }}
                    </div>
                </div>
                @endif
                
                @if($project->activities)
                <div>
                    <h3 class="text-xs font-bold text-[#2d6fa3] tracking-widest uppercase mb-2">ACTIVITIES</h3>
                    <div class="text-gray-700 leading-relaxed text-sm whitespace-pre-line">
                        {{ $project->activities }}
                    </div>
                </div>
                @endif
            </div>

            <div>
                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-auto object-cover mb-4 shadow-sm border border-gray-100">
                
                {{-- Social Icons --}}
                <div class="flex justify-start gap-1.5 mt-4">
                    <a href="https://www.facebook.com/share/1LC1ZVXgen/" target="_blank" rel="noopener" class="w-8 h-8 flex items-center justify-center bg-[#1877f2] text-white hover:opacity-90 transition-opacity rounded">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="w-8 h-8 flex items-center justify-center bg-[#1da1f2] text-white hover:opacity-90 transition-opacity rounded">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="https://www.linkedin.com/company/krousar-thmey/" target="_blank" rel="noopener" class="w-8 h-8 flex items-center justify-center bg-[#0a66c2] text-white hover:opacity-90 transition-opacity rounded">
                        <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Testimony Section --}}
        @if($project->testimony_name && $project->testimony_story)
        @php
            $cleanTestimonyName = preg_replace('/^testimony\s*:?\s*/i', '', $project->testimony_name);
        @endphp
        <div class="mt-20 p-8 md:p-12 text-center max-w-4xl mx-auto rounded-3xl border border-[#1a3c6e]/10 bg-[#1a3c6e]/5 shadow-sm">
            <div class="relative inline-block mb-4">
                @if($project->testimony_image)
                <img src="{{ str_starts_with($project->testimony_image, 'http') ? $project->testimony_image : asset('storage/' . $project->testimony_image) }}" class="w-36 h-36 mx-auto rounded-full object-cover border-4 border-white shadow-md relative z-10" alt="Testimony">
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
            
            <div x-data="{ open: false }" class="bg-white text-left shadow-md rounded-2xl overflow-hidden border border-gray-100/50 w-full max-w-3xl mx-auto">
                <button @click="open = !open" class="w-full flex items-center justify-between p-5 hover:bg-gray-50/50 transition-colors focus:outline-none cursor-pointer">
                    <span class="text-gray-700 font-semibold text-sm">Read full story</span>
                    <svg class="w-5 h-5 text-[#2d6fa3] transform transition-transform duration-300" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                </button>
                
                <div x-show="open" class="p-6 border-t border-gray-100 bg-[#f8f9fc]/50" style="display: none;"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <p class="text-gray-700 leading-relaxed text-sm whitespace-pre-line font-medium">{{ $project->testimony_story }}</p>
                </div>
            </div>
        </div>
        @endif

        {{-- Make a Difference Section --}}
        <div class="border-t border-gray-200 pt-16 mt-16 max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-[1.5fr,1fr] gap-12 items-start">
                
                <div>
                    <h3 class="font-bold text-base uppercase tracking-wider mb-6 text-[#1a3c6e]">MAKE A DIFFERENCE!</h3>
                    
                    @if($project->make_difference_text)
                    <div class="text-gray-700 text-sm leading-relaxed whitespace-pre-line mb-8 font-medium">
                        {{ $project->make_difference_text }}
                    </div>
                    @endif
                    
                    <div class="space-y-4">
                        <a href="{{ route('donate') }}" class="flex items-center justify-center gap-2 w-full py-3 bg-white border-2 border-[#d32f2f] text-[#d32f2f] hover:bg-red-50 font-bold text-sm transition-colors rounded-full">
                            <span class="text-[#d32f2f] text-lg">↗</span> DONATE NOW
                        </a>
                        
                        <a href="{{ route('contact') }}" class="flex items-center justify-center w-full py-3 text-white font-bold text-sm transition-colors hover:bg-[#122a4d] rounded-full bg-[#1a3c6e]">
                            Want to know more about this project? Contact us
                        </a>
                    </div>
                </div>
                
                <div class="p-8 text-white space-y-4 rounded-3xl bg-[#1d4e7a] shadow-sm border border-white/5">
                    <h4 class="font-bold text-sm uppercase tracking-wider border-b border-white/10 pb-3 mb-4">Project Information</h4>
                    @if($project->area_of_work)
                    <div class="text-sm"><span class="text-white/60 font-medium">Area of work:</span> <span class="font-semibold">{{ $project->area_of_work }}</span></div>
                    @endif
                    @if($project->duration)
                    <div class="text-sm"><span class="text-white/60 font-medium">Duration:</span> <span class="font-semibold">{{ $project->duration }}</span></div>
                    @endif
                    @if($project->location)
                    <div class="text-sm"><span class="text-white/60 font-medium">Location:</span> <span class="font-semibold">{{ $project->location }}</span></div>
                    @endif
                    @if($project->beneficiaries)
                    <div class="text-sm"><span class="text-white/60 font-medium">Beneficiaries:</span> <span class="font-semibold">{{ $project->beneficiaries }}</span></div>
                    @endif
                </div>
                
            </div>
            
            <div class="text-center mt-16 mb-4">
                @if($project->program)
                <a href="{{ route('programs') }}#{{ $project->program->slug }}" class="inline-flex items-center justify-center gap-2 py-3 px-8 text-white font-bold text-sm transition-colors hover:bg-[#122a4d] rounded-full bg-[#1a3c6e] shadow-md">
                    Back to the list of projects of the {{ $project->program->title }} program
                </a>
                @else
                <a href="{{ route('programs') }}" class="inline-flex items-center justify-center gap-2 py-3 px-8 text-white font-bold text-sm transition-colors hover:bg-[#122a4d] rounded-full bg-[#1a3c6e] shadow-md">
                    Back to Our Programs
                </a>
                @endif
            </div>
        </div>

    </div>
</section>

@endsection
