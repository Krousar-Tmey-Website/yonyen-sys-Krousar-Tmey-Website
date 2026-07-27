@extends('layouts.app')

@section('title', 'Resources — Krousar Thmey')
@section('description', 'Access Krousar Thmey\'s annual reports, media resources, and publications.')

@section('content')

{{-- ========================================================
     PAGE HEADER / BANNER
     ======================================================== --}}
@php
    $resourcesBannerImage = $settings['resources_banner_image'] ?? null;
    $resourcesBannerImageUrl = $resourcesBannerImage ? (str_starts_with($resourcesBannerImage, 'http') ? $resourcesBannerImage : asset('storage/' . $resourcesBannerImage)) : asset('images/children.jpg');
    $resourcesBannerOverlayColor = $settings['resources_banner_overlay_color'] ?? '#1a3c6e';
    $resourcesBannerBadge = $settings['resources_banner_badge'] ?? 'Accountability';
    $resourcesBannerTitle = $settings['resources_banner_title'] ?? 'Resources & Annual Reports';
    $resourcesBannerSubtitle = $settings['resources_banner_subtitle'] ?? 'Annual reports, publications, and media resources from Krousar Thmey.';
    $resourcesBannerBtn1Text = $settings['resources_banner_btn1_text'] ?? 'Donate Now';
    $resourcesBannerBtn1Url  = $settings['resources_banner_btn1_url'] ?? '/donate';
    $resourcesBannerBtn2Text = $settings['resources_banner_btn2_text'] ?? 'Get Involved';
    $resourcesBannerBtn2Url  = $settings['resources_banner_btn2_url'] ?? '/get-involved';
    $resourcesBannerBtn3Text = $settings['resources_banner_btn3_text'] ?? 'Annual Report';
    $resourcesBannerBtn3Url  = $settings['resources_banner_btn3_url'] ?? '/resources#annual-reports';
@endphp
<section class="pt-20 pb-20 relative py-28 overflow-hidden text-center scroll-mt-20">
    {{-- Animated drifting background --}}
    <div class="absolute inset-0 bg-cover bg-center hero-media-drift" style="background-image: url('{{ $resourcesBannerImageUrl }}');"></div>
    <div class="absolute inset-0" style="background-color: {{ $resourcesBannerOverlayColor }}; opacity: 0.55;"></div>

    {{-- Animated decorative orbs --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full hero-float-slow" style="background: radial-gradient(circle, rgba(255,255,255,0.10) 0%, transparent 70%);"></div>
        <div class="absolute -bottom-32 -left-32 w-[30rem] h-[30rem] rounded-full hero-float-delayed" style="background: radial-gradient(circle, rgba(255,255,255,0.07) 0%, transparent 70%);"></div>
        <div class="absolute top-1/3 left-1/4 w-48 h-48 rounded-full hero-pulse" style="background: radial-gradient(circle, rgba(141,168,58,0.20) 0%, transparent 70%);"></div>
        <div class="absolute bottom-1/4 right-1/4 w-40 h-40 rounded-full hero-float-slow" style="animation-delay: 4s; background: radial-gradient(circle, rgba(238,169,29,0.15) 0%, transparent 70%);"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto px-6">
        <span class="hero-reveal hero-reveal-delay-1 inline-block bg-white text-[#eea91d] text-xs font-semibold px-4 py-1.5 rounded-full mb-6 uppercase tracking-wider shadow-lg">{{ $resourcesBannerBadge }}</span>
        <h1 class="hero-reveal hero-reveal-delay-2 text-3xl md:text-5xl font-extrabold tracking-tight text-white uppercase drop-shadow-lg">
            {{ $resourcesBannerTitle }}
        </h1>
        @if($resourcesBannerSubtitle)
        <p class="hero-reveal hero-reveal-delay-3 text-white/90 text-lg leading-relaxed max-w-2xl mx-auto mt-6 drop-shadow-md">
            {{ $resourcesBannerSubtitle }}
        </p>
        @endif
        @if($resourcesBannerBtn1Text || $resourcesBannerBtn2Text || $resourcesBannerBtn3Text)
        <div class="hero-reveal hero-reveal-delay-4 flex flex-wrap items-center justify-center gap-4 mt-8">
            @if($resourcesBannerBtn1Text)
            <a href="{{ $resourcesBannerBtn1Url }}"
               class="group inline-flex items-center gap-2 px-6 py-3 bg-[#8da83a] text-white font-semibold rounded-full hover:bg-[#a3c04a] transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                <span>{{ $resourcesBannerBtn1Text }}</span>
            </a>
            @endif
            @if($resourcesBannerBtn2Text)
            <a href="{{ $resourcesBannerBtn2Url }}"
               class="group inline-flex items-center gap-2 px-6 py-3 border-2 border-white/50 text-white font-semibold rounded-full hover:bg-white hover:text-[#2d6fa3] transition-all duration-300 hover:-translate-y-0.5">
                <svg class="w-5 h-5 opacity-0 -ml-4 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span>{{ $resourcesBannerBtn2Text }}</span>
            </a>
            @endif
            @if($resourcesBannerBtn3Text)
            <a href="{{ $resourcesBannerBtn3Url }}"
               class="group inline-flex items-center gap-2 px-6 py-3 border-2 border-white/50 text-white font-semibold rounded-full hover:bg-white hover:text-[#2d6fa3] transition-all duration-300 hover:-translate-y-0.5">
                <svg class="w-5 h-5 opacity-0 -ml-4 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>{{ $resourcesBannerBtn3Text }}</span>
            </a>
            @endif
        </div>
        @endif
    </div>
</section>


{{-- Annual Reports --}}
<section id="annual-reports" class="py-20 bg-white scroll-mt-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Accountability</span>
            <h2 class="section-title mt-3 mb-3">Annual Reports</h2>
            <p class="text-gray-500">Full reports on our programs, financials, and impact — published every year since 1991.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($reports as $report)
                <div class="bg-[#f8f9fc] rounded-2xl p-7 border border-gray-100 hover:shadow-md transition-shadow group flex flex-col gap-5">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-xl bg-[#1a3c6e] flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div class="flex-1">
                            <div class="font-bold text-[#1a3c6e]">{{ $report->localized_title }}</div>
                            <div class="text-gray-400 text-xs mt-0.5">{{ $report->year }} · PDF Report</div>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @if ($report->has_pdf_file)
                            <a href="{{ route('reports.view', $report) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center rounded-lg border border-[#1a3c6e] px-3 py-2 text-sm font-semibold text-[#1a3c6e] hover:bg-[#1a3c6e] hover:text-white transition-colors">
                                View PDF
                            </a>
                            <a href="{{ route('reports.download', $report) }}" class="inline-flex items-center justify-center rounded-lg bg-[#e8a020] px-3 py-2 text-sm font-semibold text-white hover:bg-[#c7830d] transition-colors">
                                Download PDF
                            </a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="md:col-span-2 lg:col-span-3 rounded-2xl border border-dashed border-gray-200 bg-gray-50 p-8 text-center text-gray-500">
                    No annual reports are available yet.
                </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
