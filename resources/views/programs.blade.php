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
                <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Program {{ $index + 1 }}</span>
                <h2 class="section-title mt-3 mb-6">{{ $program->title }}</h2>
                <p class="text-gray-600 leading-relaxed mb-5 whitespace-pre-line">{{ $program->full_description ?? $program->description }}</p>

                @if($program->stats)
                <div class="grid grid-cols-2 gap-4 mb-8">
                    @foreach($program->stats as $stat)
                    <div class="{{ $isEven ? 'bg-[#f8f9fc]' : 'bg-white' }} rounded-xl p-5 border border-gray-100">
                        <div class="text-3xl font-bold text-[#1a3c6e] mb-1">{{ $stat['value'] ?? '' }}</div>
                        <div class="text-gray-500 text-sm">{{ $stat['label'] ?? '' }}</div>
                    </div>
                    @endforeach
                </div>
                @endif

                <a href="{{ route('donate') }}" class="btn-blue">Support This Program</a>
            </div>
            <div class="{{ $isEven ? 'order-2 lg:order-1 space-y-5' : 'space-y-5' }}">
                <img src="{{ $program->image_url }}" alt="{{ $program->title }}" class="rounded-2xl w-full h-64 object-cover shadow-lg">
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
