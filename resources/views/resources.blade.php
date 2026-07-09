@extends('layouts.app')

@section('title', 'Resources — Krousar Thmey')
@section('description', 'Access Krousar Thmey\'s annual reports, media resources, and publications.')

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
            <span class="text-white">Resources</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Resources</h1>
        <p class="text-white/70 text-lg max-w-2xl">Annual reports, publications, and media resources from Krousar Thmey.</p>
    </div>
</div>

{{-- Annual Reports --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Accountability</span>
            <h2 class="section-title mt-3 mb-3">Annual Reports</h2>
            <p class="text-gray-500">Full reports on our programs, financials, and impact — published every year since 1991.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($reports ?? [] as $report)
            <div class="bg-[#f8f9fc] rounded-2xl p-7 border border-gray-100 hover:shadow-md transition-shadow group flex items-center gap-5">
                <div class="w-14 h-14 rounded-xl bg-[#1a3c6e] flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div class="flex-1">
                    <div class="font-bold text-[#1a3c6e]">{{ $report->title ?? 'Annual Report ' . $report->year }}</div>
                    <div class="text-gray-400 text-xs mt-0.5">PDF · Full Report</div>
                </div>
                <a href="{{ $report->file_path ? asset('storage/' . $report->file_path) : '#' }}" class="text-gray-400 hover:text-[#e8a020] transition-colors p-2 rounded-lg hover:bg-white" @if(!$report->file_path) onclick="return false;" @endif>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                </a>
            </div>
            @empty
            <div class="col-span-3 text-center py-12 text-gray-500">
                <p>No annual reports available at the moment. Please check back later.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Media --}}
<section class="py-20 bg-[#f8f9fc]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Press</span>
            <h2 class="section-title mt-3 mb-3">Media Resources</h2>
            <p class="text-gray-500">Press kits, images, and logos for media and communications use.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            @foreach([
                ['title' => 'Press Kit 2024', 'desc' => 'Organization overview, key facts, and leadership bios', 'icon' => '📦'],
                ['title' => 'Photo Library', 'desc' => 'High-resolution images from our programs (contact us for access)', 'icon' => '📷'],
                ['title' => 'Logo & Brand Assets', 'desc' => 'Official Krousar Thmey logos in various formats', 'icon' => '🎨'],
            ] as $item)
            <div class="bg-white rounded-2xl p-7 border border-gray-100 hover:shadow-md transition-shadow">
                <div class="text-4xl mb-4">{{ $item['icon'] }}</div>
                <h3 class="font-bold text-[#1a3c6e] mb-2">{{ $item['title'] }}</h3>
                <p class="text-gray-500 text-sm mb-5">{{ $item['desc'] }}</p>
                <a href="{{ route('contact') }}" class="text-[#1a3c6e] font-semibold text-sm flex items-center gap-1.5 hover:text-[#e8a020] transition-colors">
                    Request Access
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection