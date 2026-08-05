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
    if (app()->getLocale() === 'fr' && !empty($settings['resources_banner_title_fr'] ?? null)) {
        $resourcesBannerTitle = $settings['resources_banner_title_fr'];
    }
    $resourcesBannerSubtitle = $settings['resources_banner_subtitle'] ?? 'Annual reports, publications, and media resources from Krousar Thmey.';
    if (app()->getLocale() === 'fr' && !empty($settings['resources_banner_subtitle_fr'] ?? null)) {
        $resourcesBannerSubtitle = $settings['resources_banner_subtitle_fr'];
    }
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
            {{ strip_tags($resourcesBannerTitle) }}
        </h1>
        @if($resourcesBannerSubtitle)
        <div class="hero-reveal hero-reveal-delay-3 text-white/90 text-lg leading-relaxed max-w-2xl mx-auto mt-6 drop-shadow-md [&_p]:mb-2 [&_p:last-child]:mb-0">
            {!! $resourcesBannerSubtitle !!}
        </div>
        @endif
        @if($resourcesBannerBtn1Text || $resourcesBannerBtn2Text || $resourcesBannerBtn3Text)
        <div class="hero-reveal hero-reveal-delay-4 flex flex-wrap items-center justify-center gap-4 mt-8">
            @if($resourcesBannerBtn1Text)
            <a href="{{ $resourcesBannerBtn1Url }}"
               class="group inline-flex items-center gap-2 px-6 py-3 bg-[#8da83a] text-white font-semibold rounded-full hover:bg-[#a3c04a] transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                <span>{{ __($resourcesBannerBtn1Text) }}</span>
            </a>
            @endif
            @if($resourcesBannerBtn2Text)
            <a href="{{ $resourcesBannerBtn2Url }}"
               class="group inline-flex items-center gap-2 px-6 py-3 border-2 border-white/50 text-white font-semibold rounded-full hover:bg-white hover:text-[#2d6fa3] transition-all duration-300 hover:-translate-y-0.5">
                <svg class="w-5 h-5 opacity-0 -ml-4 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span>{{ __($resourcesBannerBtn2Text) }}</span>
            </a>
            @endif
            @if($resourcesBannerBtn3Text)
            <a href="{{ $resourcesBannerBtn3Url }}"
               class="group inline-flex items-center gap-2 px-6 py-3 border-2 border-white/50 text-white font-semibold rounded-full hover:bg-white hover:text-[#2d6fa3] transition-all duration-300 hover:-translate-y-0.5">
                <svg class="w-5 h-5 opacity-0 -ml-4 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>{{ __($resourcesBannerBtn3Text) }}</span>
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
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5 max-w-275 mx-auto">
            @forelse($reports as $report)
                <article class="group min-w-0 bg-white rounded-[14px] border border-gray-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 flex flex-col overflow-hidden">
                    @if ($report->has_pdf_file)
                        {{-- Prefer the server-generated first-page thumbnail. PDF.js is fallback-only.
                             aspect-[210/297] (A4) so the whole cover shows uncropped, letterboxed on brand navy. --}}
                        <div class="pdf-cover-wrapper relative w-full aspect-[210/297] overflow-hidden bg-[#1a3c6e]" data-pdf-src="{{ route('reports.view', $report) }}" data-needs-pdf-preview="{{ $report->has_thumbnail ? 'false' : 'true' }}">
                            @if ($report->has_thumbnail)
                                <img src="{{ $report->thumbnail_url }}" alt="{{ $report->localized_title }} cover" class="pdf-thumbnail absolute inset-0 h-full w-full object-contain object-center opacity-0 scale-95 transition-[opacity,transform] duration-500 ease-out group-hover:scale-[1.02]" onload="this.classList.remove('opacity-0','scale-95')" onerror="this.classList.add('hidden'); this.closest('.pdf-cover-wrapper').dataset.needsPdfPreview = 'true'; window.dispatchEvent(new Event('report-thumbnail-error'));">
                            @endif
                            {{-- Visible only until the PDF fallback has rendered. --}}
                            <div class="pdf-placeholder {{ $report->has_thumbnail ? 'hidden' : '' }} absolute inset-0 flex items-center justify-center bg-[#1a3c6e]">
                                <svg class="w-12 h-12 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            {{-- Canvas for PDF.js rendering (hidden until rendered) --}}
                            <canvas class="pdf-canvas hidden absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 opacity-0 scale-95 transition-[opacity,transform] duration-500 ease-out group-hover:scale-[1.02]" data-rendered="false"></canvas>
                            {{-- Fallback error icon (hidden by default) --}}
                            <div class="pdf-fallback hidden absolute inset-0 flex items-center justify-center bg-[#1a3c6e]" aria-label="PDF cover preview unavailable">
                                <svg class="w-12 h-12 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                        </div>
                    @else
                        {{-- No PDF available — show fallback hero --}}
                        <div class="w-full aspect-[210/297] overflow-hidden bg-[#1a3c6e]">
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
                        <div class="flex flex-col sm:flex-row gap-2 mt-auto pt-3">
                        @if ($report->has_pdf_file)
                            <a href="{{ route('reports.view', $report) }}" target="_blank" rel="noopener noreferrer"
                               class="inline-flex items-center justify-center gap-1.5 min-w-0 flex-1 rounded-lg border border-[#1a3c6e] bg-white px-3 py-2 text-xs sm:text-sm font-semibold text-[#1a3c6e] hover:bg-[#1a3c6e] hover:text-white hover:shadow-md active:scale-95 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#1a3c6e] focus:ring-offset-2">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                <span class="truncate">View PDF</span>
                            </a>
                            <a href="{{ route('reports.download', $report) }}"
                               class="inline-flex items-center justify-center gap-1.5 min-w-0 flex-1 rounded-lg bg-[#1a3c6e] px-3 py-2 text-xs sm:text-sm font-semibold text-white hover:bg-[#1d4e7a] hover:shadow-lg active:scale-95 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#1a3c6e] focus:ring-offset-2">
                                <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/>
                                </svg>
                                <span class="truncate">{{ __('Download') }}</span>
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

<script>
(function() {
    'use strict';

    var pdfJsPromise;

    function loadPdfJs() {
        if (window.pdfjsLib) return Promise.resolve(window.pdfjsLib);
        if (pdfJsPromise) return pdfJsPromise;

        pdfJsPromise = new Promise(function(resolve, reject) {
            var script = document.createElement('script');
            script.src = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js';
            script.async = true;
            script.onload = function() {
                if (!window.pdfjsLib) return reject(new Error('PDF.js did not load.'));
                window.pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';
                resolve(window.pdfjsLib);
            };
            script.onerror = function() { reject(new Error('PDF.js could not be loaded.')); };
            document.head.appendChild(script);
        });

        return pdfJsPromise;
    }

    function showFallback(wrapper) {
        var placeholder = wrapper.querySelector('.pdf-placeholder');
        var fallback = wrapper.querySelector('.pdf-fallback');
        if (placeholder) placeholder.classList.add('hidden');
        if (fallback) fallback.classList.remove('hidden');
        // No small-icon fallback needed — the card body already has title + year
    }

    async function renderCover(wrapper) {
        var canvas = wrapper.querySelector('.pdf-canvas');
        if (!canvas || canvas.dataset.rendered === 'true') return;

        var placeholder = wrapper.querySelector('.pdf-placeholder');
        var fallback = wrapper.querySelector('.pdf-fallback');
        var pdfUrl = wrapper.dataset.pdfSrc;

        if (!pdfUrl) {
            return showFallback(wrapper);
        }

        try {
            var pdfjsLib = await loadPdfJs();
            var loadingTask = pdfjsLib.getDocument(pdfUrl);
            var pdf = await loadingTask.promise;
            var page = await pdf.getPage(1);

            // Get reliable container dimensions (fallback if layout hasn't settled)
            var rect = wrapper.getBoundingClientRect();
            var containerW = rect.width || wrapper.parentElement.clientWidth || 300;
            var containerH = rect.height || wrapper.clientHeight || 260;

            var viewport = page.getViewport({ scale: 1 });
            // Fit the whole page inside the preview area — nothing gets cropped,
            // any leftover space is letterboxed by the wrapper's background.
            var cssScale = Math.min(containerW / viewport.width, containerH / viewport.height);
            var cssViewport = page.getViewport({ scale: cssScale });

            // Render a higher-resolution bitmap, then display it at the fitted
            // CSS dimensions so document text stays crisp on dense screens.
            var pixelRatio = Math.min(window.devicePixelRatio || 1, 2);
            var renderViewport = page.getViewport({ scale: cssScale * pixelRatio });
            canvas.width = Math.round(renderViewport.width);
            canvas.height = Math.round(renderViewport.height);
            canvas.style.width = Math.round(cssViewport.width) + 'px';
            canvas.style.height = Math.round(cssViewport.height) + 'px';

            var ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            // Render the PDF page onto the canvas
            await page.render({ canvasContext: ctx, viewport: renderViewport }).promise;

            // Show canvas, hide placeholder — fade/scale in on the next frame so the
            // opacity-0/scale-95 starting state has already painted once.
            canvas.classList.remove('hidden');
            canvas.dataset.rendered = 'true';
            requestAnimationFrame(function() {
                requestAnimationFrame(function() {
                    canvas.classList.remove('opacity-0', 'scale-95');
                });
            });
            if (placeholder) placeholder.classList.add('hidden');

        } catch (err) {
            console.warn('PDF render failed:', err);
            if (fallback) fallback.classList.remove('hidden');
            if (placeholder) placeholder.classList.add('hidden');
        }
    }

    function observePreview(wrapper) {
        if (wrapper.dataset.needsPdfPreview !== 'true') return;

        if ('IntersectionObserver' in window) {
            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        renderCover(entry.target);
                        observer.unobserve(entry.target);
                    }
                });
            }, { rootMargin: '200px' });
            observer.observe(wrapper);
        } else {
            renderCover(wrapper);
        }
    }

    document.querySelectorAll('.pdf-cover-wrapper').forEach(observePreview);

    window.addEventListener('report-thumbnail-error', function() {
        document.querySelectorAll('.pdf-cover-wrapper[data-needs-pdf-preview="true"]').forEach(observePreview);
    });
})();
</script>

@endsection
