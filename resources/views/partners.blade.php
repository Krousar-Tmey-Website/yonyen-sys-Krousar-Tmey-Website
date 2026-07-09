@extends('layouts.app')

@section('title', 'Our Partners — Krousar Thmey')
@section('description', 'Krousar Thmey partners with organizations worldwide to support children in Cambodia. View all our partners and supporters.')

@section('content')

{{-- ========================================================
     PAGE HEADER
     ======================================================== --}}
<div class="bg-[#2d6fa3] pt-16 pb-24 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a] translate-y-1/2 -translate-x-1/3"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/50 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white">Partners</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Our Partners</h1>
        <p class="text-white/70 text-lg max-w-2xl">Organizations and institutions that support Krousar Thmey's mission</p>
    </div>
</div>

{{-- ========================================================
     PARTNERS GRID
     ======================================================== --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <p class="text-[#8da83a] font-bold text-sm uppercase tracking-widest mb-3">Support</p>
            <h2 class="text-3xl md:text-4xl font-bold text-[#2d6fa3] mb-4">Organizations, Foundations & Institutions</h2>
            <p class="text-gray-500 max-w-3xl mx-auto text-sm leading-relaxed">
                Krousar Thmey benefits from the support of various organizations worldwide. Their fundraising and communication networks greatly contribute to the success of all programs and projects.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($partners as $partner)
            <div class="flex items-center justify-center p-6 bg-[#f8f9fc] rounded-xl border border-gray-100 hover:shadow-lg hover:border-[#2d6fa3]/20 transition-all duration-300 group">
                @if($partner->logo)
                <img src="{{ asset('storage/' . $partner->logo) }}"
                     alt="{{ $partner->name }}" 
                     class="max-h-20 max-w-full object-contain group-hover:scale-105 transition-transform duration-300">
                @else
                <div class="text-center">
                    <p class="text-[#2d6fa3] font-bold text-base mb-1">{{ $partner->name }}</p>
                    @if($partner->country)
                    <p class="text-gray-400 text-xs">{{ $partner->country }}</p>
                    @endif
                </div>
                @endif
            </div>
            @empty
            <div class="col-span-3 py-16 text-center">
                <p class="text-gray-400 text-lg mb-4">No partners listed yet.</p>
                <p class="text-gray-500 text-sm">Partners will appear here once they are added to the system.</p>
            </div>
            @endforelse
        </div>

        @if($partners->count() > 0)
        <div class="text-center mt-16">
            <a href="{{ route('about') }}" class="inline-flex items-center gap-2 text-[#1a3c6e] font-semibold text-sm hover:text-[#e8a020] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Who We Are
            </a>
        </div>
        @endif
    </div>
</section>

{{-- ========================================================
     CTA SECTION
     ======================================================== --}}
<section class="py-16 bg-[#f8f9fc]">
    <div class="max-w-4xl mx-auto px-6 text-center">
        <h3 class="text-2xl md:text-3xl font-bold text-[#2d6fa3] mb-4">Become a Partner</h3>
        <p class="text-gray-600 mb-8 leading-relaxed">
            Join our network of supporters and help us make a difference in the lives of Cambodian children. We welcome partnerships with organizations, foundations, and institutions that share our vision.
        </p>
        <a href="{{ route('involved') }}" class="btn-primary">Get Involved</a>
    </div>
</section>

@endsection