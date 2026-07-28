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
        <div class="mb-14 text-center">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Accountability</span>
            <h2 class="section-title mt-3 mb-3">Annual Reports</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">Full reports on our programs, financials, and impact — published every year since 1991.</p>
        </div>

        {{-- Compact two-column document gallery --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 max-w-[960px] mx-auto">
            @forelse($reports as $report)
                <article class="group min-w-0 bg-white rounded-[14px] border border-gray-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 flex flex-col overflow-hidden">
                    @if ($report->has_pdf_file)
                        {{-- Prefer the server-generated first-page thumbnail. PDF.js is fallback-only. --}}
                        <div class="pdf-cover-wrapper relative w-full h-[170px] overflow-hidden bg-[#1a3c6e]" data-pdf-src="{{ route('reports.view', $report) }}" data-needs-pdf-preview="{{ $report->has_thumbnail ? 'false' : 'true' }}">
                            @if ($report->has_thumbnail)
                                <img src="{{ $report->thumbnail_url }}" alt="{{ $report->localized_title }} cover" class="pdf-thumbnail absolute inset-0 h-full w-full object-cover object-center transition-transform duration-300 group-hover:scale-105" onerror="this.classList.add('hidden'); this.closest('.pdf-cover-wrapper').dataset.needsPdfPreview = 'true'; window.dispatchEvent(new Event('report-thumbnail-error'));">
                            @endif
                            {{-- Visible only until the PDF fallback has rendered. --}}
                            <div class="pdf-placeholder {{ $report->has_thumbnail ? 'hidden' : '' }} absolute inset-0 flex items-center justify-center bg-[#1a3c6e]">
                                <svg class="w-12 h-12 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            {{-- Canvas for PDF.js rendering (hidden until rendered) --}}
                            <canvas class="pdf-canvas hidden absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2" data-rendered="false"></canvas>
                            {{-- Fallback error icon (hidden by default) --}}
                            <div class="pdf-fallback hidden absolute inset-0 flex items-center justify-center bg-[#1a3c6e]" aria-label="PDF cover preview unavailable">
                                <svg class="w-12 h-12 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                        </div>
                    @else
                        {{-- No PDF available — show fallback hero --}}
                        <div class="w-full h-[170px] overflow-hidden bg-[#1a3c6e]">
                            <div class="w-full h-full flex flex-col items-center justify-center">
                                <svg class="w-12 h-12 text-white/60 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                <span class="text-white/40 text-sm font-medium">No PDF Available</span>
                            </div>
                        </div>
                    @endif

                    {{-- Content area --}}
                    <div class="p-4 flex flex-col flex-1">
                        <div>
                            <h3 class="font-bold text-gray-900 text-base sm:text-lg leading-snug">{{ $report->localized_title }}</h3>
                            <div class="text-gray-400 text-sm mt-2">{{ $report->year }} · PDF Report</div>
                        </div>
                        <div class="flex gap-2.5 mt-auto pt-3">
                        @if ($report->has_pdf_file)
                            <a href="{{ route('reports.view', $report) }}" target="_blank" rel="noopener noreferrer" class="min-w-0 flex-1 text-center rounded-lg border border-[#1a3c6e] bg-white px-3 py-2 text-sm font-semibold text-[#1a3c6e] hover:bg-[#1a3c6e] hover:text-white transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#1a3c6e] focus:ring-offset-2">
                                View PDF
                            </a>
                            <a href="{{ route('reports.download', $report) }}" class="min-w-0 flex-1 text-center rounded-lg bg-[#1a3c6e] px-3 py-2 text-sm font-semibold text-white hover:bg-[#1d4e7a] hover:shadow-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#1a3c6e] focus:ring-offset-2">
                                Download PDF
                            </a>
                        @endif
                    </div>
                </article>
            @empty
                <div class="col-span-full rounded-2xl border border-dashed border-gray-200 bg-gray-50 p-12 text-center">
                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <p class="text-gray-400 font-medium">No annual reports are available yet.</p>
                </div>
            @endforelse
        </div>

    </div>
</section>

@endsection
