@extends('layouts.app')

@section('title', 'Our Programs — Krousar Thmey')
@section('description', 'Discover Krousar Thmey\'s three core programs: child welfare, special education for deaf and blind children, and cultural and artistic development.')

@section('content')

{{-- Page Header --}}
<div class="bg-[#1a3c6e] pt-16 pb-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/60 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white">Our Programs</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Our Programs</h1>
        <p class="text-white/70 text-lg max-w-2xl">
            Three comprehensive programs across 15 Cambodian provinces, reaching over 4,000 children every year.
        </p>
    </div>
</div>

{{-- Program Overview --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-3 gap-6">
            @php $colors = ['bg-[#1a3c6e]', 'bg-[#e8a020]', 'bg-[#2554a0]']; @endphp
            @foreach($programs->take(3) as $index => $prog)
            <a href="#{{ $prog->slug }}" class="{{ $colors[$index % 3] }} rounded-2xl p-7 text-white hover:opacity-90 transition-opacity block group">
                <div class="text-2xl font-bold mb-1">
                    @if($prog->stats && count($prog->stats) > 0)
                        {{ $prog->stats[0]['value'] }} {{ strtolower($prog->stats[0]['label']) }}
                    @endif
                </div>
                <div class="font-semibold text-white/80 group-hover:text-white transition-colors">{{ $prog->title }}</div>
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

                @if($program->stats)
                <div class="grid grid-cols-2 gap-4 mb-8">
                    @foreach($program->stats as $stat)
                    <div class="{{ $isEven ? 'bg-[#f8f9fc]' : 'bg-white' }} rounded-xl p-4 border border-gray-100">
                        <div class="text-2xl font-bold text-[#1a3c6e] mb-1">{{ $stat['value'] ?? '' }}</div>
                        <div class="text-gray-500 text-xs uppercase">{{ $stat['label'] ?? '' }}</div>
                    </div>
                    @endforeach
                </div>
                @endif

                <div class="flex flex-col sm:flex-row gap-4 mb-8">
                    <a href="#" class="px-6 py-2.5 bg-[#1a3c6e] hover:bg-[#122a4d] text-white text-sm font-bold transition-colors text-center w-full sm:w-auto rounded-sm">Know more about the projects</a>
                    <a href="{{ route('donate') }}" class="px-6 py-2.5 border-2 border-[#d32f2f] text-[#d32f2f] hover:bg-red-50 text-sm font-bold transition-colors flex items-center justify-center gap-2 w-full sm:w-auto rounded-sm">
                        <svg class="w-4 h-4 text-[#d32f2f]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 17L17 7M17 7H7M17 7V17"/></svg>
                        DONATE NOW
                    </a>
                </div>
            </div>
            <div class="{{ $isEven ? 'order-2 lg:order-1 space-y-4' : 'space-y-4' }}">
                <img src="{{ $program->image_url }}" alt="{{ $program->title }}" class="w-full h-auto object-cover border-4 border-[#8da83a]/10 shadow-md">
                
                <div class="flex items-center justify-center gap-1.5 mt-4">
                    <a href="https://www.facebook.com/share/1LC1ZVXgen/?mibextid=wwXIfr" target="_blank" rel="noopener" class="w-8 h-8 bg-[#1877f2] text-white rounded flex items-center justify-center hover:opacity-90 transition-opacity">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="#" class="w-8 h-8 bg-[#1da1f2] text-white rounded flex items-center justify-center hover:opacity-90 transition-opacity">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    </a>
                    <a href="https://www.linkedin.com/company/krousar-thmey/" target="_blank" rel="noopener" class="w-8 h-8 bg-[#0a66c2] text-white rounded flex items-center justify-center hover:opacity-90 transition-opacity">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <a href="#" class="w-8 h-8 bg-blue-600 text-white rounded flex items-center justify-center hover:opacity-90 transition-opacity">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6v-2z"/></svg>
                    </a>
                </div>
            </div>
        </div>
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
                <div class="text-[#e8a020] font-semibold text-sm mb-2">
                    @if($program->stats && count($program->stats) > 0)
                        {{ $program->stats[0]['value'] }} {{ strtolower($program->stats[0]['label']) }}
                    @endif
                </div>
                <h3 class="text-xl font-bold text-[#1a3c6e] mb-3">{{ $program->title }}</h3>
                <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">{{ $program->description }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Testimonials --}}
@if(isset($testimonials) && $testimonials->count())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Stories from the Field</span>
            <h2 class="text-3xl font-bold text-[#1a3c6e] mt-3">Voices of Children We Support</h2>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($testimonials as $testimony)
            <div class="flex flex-col items-center text-center bg-[#f8f9fc] rounded-2xl p-8 shadow-sm border border-gray-100"
                 x-data="{ open: false }">

                {{-- Circular photo --}}
                <div class="relative mb-5">
                    <div class="w-28 h-28 rounded-full overflow-hidden border-4 border-white shadow-lg">
                        <img src="{{ $testimony->image_url }}"
                             alt="{{ $testimony->name }}"
                             class="w-full h-full object-cover">
                    </div>
                    {{-- Quote icon --}}
                    <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-8 h-8 bg-[#1a3c6e] text-white rounded-full flex items-center justify-center shadow">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                    </div>
                </div>

                {{-- Label & Name --}}
                @if($testimony->label)
                <p class="text-[#2554a0] text-xs font-bold uppercase tracking-widest mb-1">{{ $testimony->label }}</p>
                @endif
                <h3 class="font-bold text-[#1a3c6e] text-base">{{ $testimony->name }}</h3>
                @if($testimony->role)
                <p class="text-[#2554a0] text-sm mt-0.5 mb-4">{{ $testimony->role }}</p>
                @endif

                {{-- Short quote --}}
                @if($testimony->content)
                <p class="text-gray-600 text-sm italic leading-relaxed mb-4">
                    "{{ $testimony->content }}"
                </p>
                @endif

                {{-- Collapsible full story --}}
                @if($testimony->story)
                <div class="w-full mt-2">
                    <button @click="open = !open"
                            class="w-full flex items-center justify-between px-4 py-2.5 bg-white rounded-lg border border-gray-200 text-sm text-gray-600 hover:border-[#1a3c6e] hover:text-[#1a3c6e] transition-colors">
                        <span x-text="open ? 'Hide story' : 'Read {{ $testimony->name }} story'"></span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="open"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-2"
                         class="mt-2 bg-white rounded-lg border border-gray-100 p-4 text-left">
                        <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">{{ $testimony->story }}</p>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA --}}
<section class="py-16 bg-[#1a3c6e]">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Support Our Programs</h2>
        <p class="text-white/70 mb-8">Your donation goes directly to one of these programs. 100% of funds support children in Cambodia.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('donate') }}" class="btn-primary">Donate Now</a>
            <a href="{{ route('contact') }}" class="btn-outline">Contact Us</a>
        </div>
    </div>
</section>

@endsection
