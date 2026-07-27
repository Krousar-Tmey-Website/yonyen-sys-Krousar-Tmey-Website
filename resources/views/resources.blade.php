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
                        @else
                            <p class="text-sm text-gray-400 w-full text-center py-2">No PDF file available.</p>
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
            // Cover the short preview area with the page. The canvas stays
            // proportional and is centre-cropped by the wrapper's overflow.
            var cssScale = Math.max(containerW / viewport.width, containerH / viewport.height);
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

            // Show canvas, hide placeholder
            canvas.classList.remove('hidden');
            canvas.dataset.rendered = 'true';
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

{{-- Words and Pictures application --}}
<section id="words-and-pictures-application" class="py-20 bg-[#f8f9fc] scroll-mt-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Application</span>
            <h2 class="section-title mt-3 mb-3">Words and Pictures</h2>
            <p class="text-gray-500">Information and downloads for the Words and Pictures application.</p>
        </div>

        <div class="rounded-2xl border border-dashed border-gray-200 bg-gray-50 p-8 text-center text-gray-500">
            More content coming soon.
        </div>
    </div>
</section>

@endsection
