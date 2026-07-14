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
     PARTNERS SECTION
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

        {{-- Search Bar --}}
        <div class="max-w-xl mx-auto mb-8">
            <form method="GET" action="{{ route('partners') }}" class="relative">
                @if($category)
                    <input type="hidden" name="category" value="{{ $category }}">
                @endif
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search partners..."
                       class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all outline-none text-sm bg-white">
                @if($search)
                    <a href="{{ route('partners', array_filter(['category' => $category])) }}"
                       class="absolute right-3 top-1/2 -translate-y-1/2 w-7 h-7 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition-colors">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
            </form>
        </div>

        {{-- Category Filter Buttons --}}
        <div class="flex flex-wrap justify-center gap-2 mb-10">
            <a href="{{ route('partners', array_filter(['search' => $search])) }}"
               class="px-5 py-2 rounded-full text-sm font-medium transition-all {{ !$category ? 'bg-[#2d6fa3] text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200' }}">
                All Partners
            </a>
            @foreach(['Authorities', 'Companies', 'Organizations'] as $cat)
                <a href="{{ route('partners', array_filter(['category' => $cat, 'search' => $search])) }}"
                   class="px-5 py-2 rounded-full text-sm font-medium transition-all {{ $category === $cat ? 'bg-[#2d6fa3] text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200' }}">
                    {{ $cat }}
                </a>
            @endforeach
            <a href="{{ route('partners', array_filter(['category' => 'individual-donor', 'search' => $search])) }}"
               class="px-5 py-2 rounded-full text-sm font-medium transition-all {{ $category === 'individual-donor' ? 'bg-[#2d6fa3] text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200' }}">
                Individual Donor
            </a>
        </div>

        {{-- Partner Cards Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 auto-rows-fr">
            @forelse($partners as $partner)
            @php
                $isIndividual = is_null($partner->category_id);
                $iconText = $isIndividual ? 'ID' : Str::substr($partner->name, 0, 1);
            @endphp
            <div class="flex h-full flex-col justify-between gap-4 p-6 rounded-xl border border-gray-100 bg-[#f8f9fc] hover:border-[#2d6fa3]/20 hover:shadow-sm transition-all">
                <div class="flex items-start gap-4">
                    <div class="w-14 h-14 rounded-full bg-[#dbe9ff] flex items-center justify-center flex-shrink-0">
                        <span class="text-lg font-bold text-[#2d6fa3]">{{ $iconText }}</span>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="font-bold text-sm leading-tight text-gray-800 overflow-hidden break-words" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; text-overflow: ellipsis;">
                            {{ $partner->name }}
                        </p>
                        @if($partner->country)
                            <p class="text-gray-400 text-xs mt-1">{{ $partner->country }}</p>
                        @endif
                    </div>
                </div>
                @if($isIndividual)
                    <p class="inline-flex items-center px-2.5 py-1 text-[11px] font-semibold tracking-[0.15em] uppercase text-[#1d4e7a] bg-[#dbe9ff] rounded-full">
                        Individual Donor
                    </p>
                @endif
            </div>
            @empty
            <div class="col-span-full py-16 text-center">
                <p class="text-gray-400 text-lg mb-2">No partners found</p>
                <p class="text-gray-500 text-sm">Try a different search term or category.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if(method_exists($partners, 'links') && $partners->hasPages())
        <div class="mt-10 flex justify-center">
            {{ $partners->links('pagination::tailwind') }}
        </div>
        @endif

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