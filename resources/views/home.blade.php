@extends('layouts.app')

@section('title', 'Krousar Thmey — Helping Children in Cambodia Since 1991')
@section('description', 'Krousar Thmey is Cambodia\'s first organization helping disadvantaged children through child welfare, special education for deaf and blind students, and cultural development.')

@section('content')

{{-- ===== SCROLL PROGRESS BAR ===== --}}
<div id="scroll-progress" class="fixed top-0 left-0 right-0 z-[9999] h-1 bg-gradient-to-r from-[#2d6fa3] via-[#e8a020] to-[#8da83a] origin-left scale-x-0 transition-transform duration-150 ease-out"></div>

{{-- ===== HERO CAROUSEL ===== --}}
<section class="relative h-[90vh] min-h-[520px] max-h-[800px] overflow-hidden"
    x-data="{
            current: 0,
            total: {{ max($slides->count(), 1) }},
            timer: null,
            start() {
                if (this.total <= 1) return;
                this.timer = setInterval(() => {
                    this.current = (this.current + 1) % this.total;
                }, 5500);
            },
            go(i) {
                this.current = i;
                clearInterval(this.timer);
                this.start();
            }
         }"
    x-init="start()">

    @forelse($slides as $slide)
    {{-- Slide {{ $loop->iteration }} --}}
    <div class="absolute inset-0 transition-opacity duration-1000"
        :class="current === {{ $loop->index }} ? 'opacity-100 z-10' : 'opacity-0 z-0'">
        <div class="absolute inset-0 bg-gradient-to-r from-[#0f2448]/85 via-[#0f2448]/60 to-transparent z-10"></div>
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('{{ $slide->image_url }}')"></div>
        <div class="relative z-20 h-full flex items-center">
            <div class="max-w-7xl mx-auto px-6 w-full">
                <div class="max-w-2xl"
                    x-show="current === {{ $loop->index }}"
                    x-transition:enter="transition ease-out duration-700 delay-300"
                    x-transition:enter-start="opacity-0 translate-y-8"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    @if($slide->localized_badge_text)
                    <span class="inline-block bg-[#e8a020] text-white text-xs font-semibold px-4 py-1.5 rounded-full mb-5 uppercase tracking-wider">{{ $slide->localized_badge_text }}</span>
                    @endif
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                        {!! nl2br(e($slide->localized_title)) !!}
                    </h1>
                    @if($slide->localized_subtitle)
                    <p class="text-white/80 text-lg mb-8 leading-relaxed">{{ $slide->localized_subtitle }}</p>
                    @endif

                    @if($slide->localized_cta_primary_text || $slide->localized_cta_secondary_text)
                    <div class="flex flex-wrap gap-6">
                        @if($slide->localized_cta_primary_text)
                        <a href="{{ $slide->cta_primary_url ?? '#' }}" class="btn-primary btn-micro">{{ $slide->localized_cta_primary_text }}</a>
                        @endif
                        @if($slide->localized_cta_secondary_text)
                        <a href="{{ $slide->cta_secondary_url ?? route('donate') }}" class="btn-outline btn-micro">{{ $slide->localized_cta_secondary_text }}</a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="absolute inset-0 bg-[#1d4e7a] flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-5xl font-bold text-white mb-4">Krousar Thmey</h1>
            <p class="text-white/70 text-lg">Supporting Cambodia's children since 1991</p>
        </div>
    </div>
    @endforelse

    {{-- Dot controls (only shown when multiple slides) --}}
    @if($slides->count() > 1)
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-30 flex items-center gap-6">
        <template x-for="i in total" :key="i">
            <button @click="go(i - 1)"
                class="transition-all duration-300 rounded-full"
                :class="current === i - 1 ? 'w-8 h-3 bg-[#e8a020]' : 'w-3 h-3 bg-white/50 hover:bg-white/80'"
                :aria-label="'Go to slide ' + i">
            </button>
        </template>
    </div>

    <button @click="go((current - 1 + total) % total)"
        class="absolute left-4 top-1/2 -translate-y-1/2 z-30 w-11 h-11 rounded-full bg-white/20 backdrop-blur-sm text-white flex items-center justify-center hover:bg-white/30 transition-colors" aria-label="Previous">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button @click="go((current + 1) % total)"
        class="absolute right-4 top-1/2 -translate-y-1/2 z-30 w-11 h-11 rounded-full bg-white/20 backdrop-blur-sm text-white flex items-center justify-center hover:bg-white/30 transition-colors" aria-label="Next">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
    @endif
</section>

{{-- ===== STATS / DATA SECTION ===== --}}
<section class="bg-[#1a3c6e] py-12 lg:py-16 overflow-hidden" data-reveal>
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-10 animate-fade-up">
            <p class="text-white text-lg md:text-xl lg:text-2xl font-medium leading-relaxed max-w-4xl mx-auto">
                The first Cambodian organization helping disadvantaged children, building a world in which children are empowered to grow into independent and responsible adults.
            </p>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            @php
            $statsData = \App\Models\HomeSetting::getStats();

            $stats = [
            [
            'number' => $statsData['children']['number'],
            'display' => $statsData['children']['display'],
            'label' => $settings['stat_children_label'] ?? 'CHILDREN SUPPORTED',
            'sub' => $settings['stat_children_sub'] ?? 'SINCE 1991',
            ],
            [
            'number' => $statsData['employees']['number'],
            'display' => $statsData['employees']['display'],
            'label' => $settings['stat_employees_label'] ?? 'EMPLOYEES',
            'sub' => '',
            ],
            [
            'number' => $statsData['budget']['number'],
            'display' => $statsData['budget']['display'],
            'label' => $settings['stat_budget_label'] ?? 'USD ANNUAL BUDGET',
            'sub' => '',
            ],
            [
            'number' => $statsData['provinces']['number'],
            'display' => $statsData['provinces']['display'],
            'label' => $settings['stat_provinces_label'] ?? 'PROVINCES IN CAMBODIA',
            'sub' => '',
            ],
            ];
            @endphp

            @foreach($stats as $stat)
            <div class="group text-center opacity-0 translate-y-10 animate-stat">
                <div class="text-4xl lg:text-5xl font-bold text-[#e8a020] mb-2 counter"
                    data-target="{{ $stat['number'] }}"
                    data-final="{{ $stat['display'] }}">
                    {{ $stat['display'] }}
                </div>

                <div class="text-white font-bold text-sm lg:text-base">
                    {{ $stat['label'] }}
                </div>

                @if($stat['sub'])
                <div class="text-white/50 text-xs mt-1">
                    {{ $stat['sub'] }}
                </div>
                @endif
            </div>
            @endforeach

        </div>
    </div>
</section>


{{-- ===== ANIMATION & SCROLL SYSTEM ===== --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {

        // ── Scroll Progress Bar ───────────────────────────────
        const progressBar = document.getElementById('scroll-progress');
        if (progressBar) {
            window.addEventListener('scroll', () => {
                const scrollTop = window.scrollY;
                const docHeight = document.documentElement.scrollHeight - window.innerHeight;
                const progress = docHeight > 0 ? scrollTop / docHeight : 0;
                progressBar.style.transform = `scaleX(${Math.min(progress, 1)})`;
            }, { passive: true });
        }

        // ── Animated Number Counter ───────────────────────────
        const counters = document.querySelectorAll(".counter");
        const countObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = +counter.dataset.target;
                    const finalVal = counter.dataset.final || target;

                    let start = 0;
                    const duration = 2000;
                    const startTime = performance.now();

                    const updateCount = (currentTime) => {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        const easeOut = 1 - Math.pow(1 - progress, 3);
                        const current = Math.floor(start + (target - start) * easeOut);
                        counter.innerText = current.toLocaleString();

                        if (progress < 1) {
                            requestAnimationFrame(updateCount);
                        } else {
                            counter.innerText = finalVal;
                        }
                    };

                    requestAnimationFrame(updateCount);
                    countObserver.unobserve(counter);
                }
            });
        }, { threshold: 0.4 });

        counters.forEach(counter => countObserver.observe(counter));

        // ── Unified Scroll Reveal System ─────────────────────
        const revealElements = document.querySelectorAll("[data-reveal]");

        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const delay = el.dataset.revealDelay || 0;
                    setTimeout(() => {
                        el.classList.add("is-revealed");
                    }, delay);
                    revealObserver.unobserve(el);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: "0px 0px -40px 0px"
        });

        revealElements.forEach(el => revealObserver.observe(el));

        // ── Smooth anchor scroll ─────────────────────────────
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

    });
</script>

{{-- ===== MAP PROVINCE PROJECT DATA ===== --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {

        // ── Project data by province (data-region key) ──
        // Loaded from database via PHP
        const provinceProjects = {!! json_encode($mapProjects) !!};

        // ── Province Hover Interactivity ──────────────
        const regions = document.querySelectorAll(".map-svg-cambodia .region");
        const tooltip = document.getElementById("mapTooltip");

        function formatProvinceName(name) {
            return name.split('-').map(w => w.charAt(0).toUpperCase() + w.slice(1)).join(' ');
        }

        // ── Project type → SVG icon mapping ────────────
        function getProjectIcon(projectType) {
            const icons = {
                'Child Welfare': {
                    svg: '<svg width="12" height="12" viewBox="0 0 16 16" fill="none"><path d="M2 8 Q2 2 8 2 Q14 2 14 8 Q14 14 8 14 Q2 14 2 8Z" fill="#EF4444" opacity="0.2"/><path d="M8 3 C5 3 4 5 4 7 C4 9 5 10 6 10 L10 10 C11 10 12 9 12 7 C12 5 11 3 8 3Z" fill="#EF4444"/><circle cx="8" cy="6.5" r="1.5" fill="white"/></svg>',
                    bg: '#fef2f2',
                    color: '#DC2626',
                },
                'Outside Cases': {
                    svg: '<svg width="12" height="12" viewBox="0 0 16 16" fill="none"><circle cx="5" cy="4" r="2" fill="#EF4444"/><path d="M2,10 L8,10 L8,14 L2,14Z" fill="#EF4444" opacity="0.7"/><circle cx="11" cy="4" r="2" fill="#EF4444"/><path d="M8,10 L14,10 L14,14 L8,14Z" fill="#EF4444" opacity="0.7"/></svg>',
                    bg: '#fef2f2',
                    color: '#DC2626',
                },
                'School for Deaf or Blind Children': {
                    svg: '<svg width="12" height="12" viewBox="0 0 16 16" fill="none"><circle cx="8" cy="8" r="6" fill="#22C55E" opacity="0.15"/><path d="M5 8 L7 10 L11 6" stroke="#22C55E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none"/></svg>',
                    bg: '#f0fdf4',
                    color: '#16A34A',
                },
                'School of Khmer Arts & Culture': {
                    svg: '<svg width="12" height="12" viewBox="0 0 16 16" fill="none"><path d="M8 2 C5 2 3 4 3 7 C3 9 4 10 5 10 C6 10 6 9 7 8 C8 7 9 7 10 8 C11 9 11 10 12 10 C13 10 14 9 14 7 C14 4 12 2 9 2Z" fill="#A855F7" opacity="0.2"/><path d="M6 6 L8 5 L10 6 L9 8 L7 8Z" fill="#A855F7"/></svg>',
                    bg: '#faf5ff',
                    color: '#7E22CE',
                },
            };
            return icons[projectType] || {
                svg: '<svg width="12" height="12" viewBox="0 0 16 16"><circle cx="8" cy="8" r="4" fill="#6b7280"/></svg>',
                bg: '#f8fafc',
                color: '#6b7280',
            };
        }

        function buildTooltipHTML(provinceKey) {
            const data = provinceProjects[provinceKey];
            if (!data) {
                return `<div class="tt-header"><span class="tt-title">${formatProvinceName(provinceKey)}</span><span class="tt-badge">No programs</span></div>`;
            }

            const locationsHtml = data.locations.map(loc => `
                <div class="tt-location">
                    <div class="tt-loc-name">${loc.name}</div>
                    <div class="tt-tags">
                        ${loc.projects.map(p => {
                            const icon = getProjectIcon(p);
                            return `<span class="tt-tag" style="background:${icon.bg};color:${icon.color};">${icon.svg} ${p}</span>`;
                        }).join('')}
                    </div>
                </div>
            `).join('');

            const totalProjects = data.locations.reduce((sum, l) => sum + l.projects.length, 0);

            return `
                <div class="tt-header">
                    <span class="tt-title">${data.label}</span>
                    <span class="tt-badge">${totalProjects} program${totalProjects > 1 ? 's' : ''}</span>
                </div>
                <div class="tt-body">
                    ${locationsHtml}
                </div>
            `;
        }

        if (tooltip) {
            regions.forEach(region => {
                region.addEventListener("mouseenter", (e) => {
                    const province = region.dataset.region;
                    tooltip.innerHTML = buildTooltipHTML(province);
                    tooltip.classList.toggle('no-projects', !provinceProjects[province]);
                    tooltip.classList.add("visible");
                });

                region.addEventListener("mousemove", (e) => {
                    let x = e.clientX;
                    let y = e.clientY;

                    if (y - tooltip.offsetHeight - 16 < 8) {
                        y = y + 14;
                        tooltip.style.transform = 'translate(-50%, 0%)';
                        tooltip.classList.add('flip-below');
                    } else {
                        y = y - 10;
                        tooltip.style.transform = 'translate(-50%, -100%)';
                        tooltip.classList.remove('flip-below');
                    }

                    tooltip.style.left = x + 'px';
                    tooltip.style.top = y + 'px';
                });

                region.addEventListener("mouseleave", () => {
                    tooltip.classList.remove("visible");
                });
            });
        }

    });
</script>

{{-- ===== PROFESSIONAL ANIMATION STYLES ===== --}}
<style>
    /* ── Scroll Reveal Base ──────────────────────────────── */
    [data-reveal] {
        opacity: 0;
        transform: translateY(40px);
        transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1),
                    transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    [data-reveal].is-revealed {
        opacity: 1;
        transform: translateY(0);
    }

    [data-reveal="left"] {
        transform: translateX(-50px);
    }

    [data-reveal="left"].is-revealed {
        transform: translateX(0);
    }

    [data-reveal="right"] {
        transform: translateX(50px);
    }

    [data-reveal="right"].is-revealed {
        transform: translateX(0);
    }

    [data-reveal="scale"] {
        transform: scale(0.85);
    }

    [data-reveal="scale"].is-revealed {
        transform: scale(1);
    }

    /* ── Staggered delay via CSS variable ─────────────────── */
    [data-reveal] {
        transition-delay: calc(var(--reveal-delay, 0ms) * 1ms);
    }

    /* ── Stats section animation ──────────────────────────── */
    .animate-stat {
        opacity: 0;
        transform: translateY(30px);
        animation: fadeUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    .animate-stat:nth-child(1) { animation-delay: 0.1s; }
    .animate-stat:nth-child(2) { animation-delay: 0.2s; }
    .animate-stat:nth-child(3) { animation-delay: 0.3s; }
    .animate-stat:nth-child(4) { animation-delay: 0.4s; }

    .animate-fade-up {
        animation: fadeUp 0.8s ease forwards;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ── Card hover effects ───────────────────────────────── */
    .card-hover {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .card-hover:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
    }

    .card-hover-light {
        transition: all 0.3s ease;
    }

    .card-hover-light:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 28px -8px rgba(0, 0, 0, 0.1);
    }

    /* ── Button micro-interactions ────────────────────────── */
    .btn-micro {
        transition: all 0.25s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .btn-micro:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 8px 24px -6px rgba(45, 111, 163, 0.35);
    }

    .btn-micro:active {
        transform: translateY(0) scale(0.98);
    }

    /* ── Link arrow slide ─────────────────────────────────── */
    .link-arrow svg {
        transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .link-arrow:hover svg {
        transform: translateX(4px);
    }

    /* ── Testimonial card ─────────────────────────────────── */
    .testimonial-card {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }

    .testimonial-card:hover {
        transform: translateY(-6px) scale(1.01);
        box-shadow: 0 24px 48px -12px rgba(0, 0, 0, 0.15);
        border-color: rgba(45, 111, 163, 0.15);
    }

    /* ── Marquee (kept from original) ─────────────────────── */
    @keyframes marqueeScroll {
        0% { transform: translate3d(0, 0, 0); }
        100% { transform: translate3d(-50%, 0, 0); }
    }

    @keyframes marqueeScrollReverse {
        0% { transform: translate3d(-50%, 0, 0); }
        100% { transform: translate3d(0, 0, 0); }
    }

    .marquee-track {
        will-change: transform;
        animation: marqueeScroll 30s linear infinite;
        width: max-content;
    }

    .marquee-track-reverse {
        will-change: transform;
        animation: marqueeScrollReverse 30s linear infinite;
        width: max-content;
    }

    /* ── Smooth scroll for the whole page ─────────────────── */
    html {
        scroll-behavior: smooth;
    }

    /* ── Reduced motion preference ────────────────────────── */
    @media (prefers-reduced-motion: reduce) {
        [data-reveal],
        .animate-stat,
        .animate-fade-up,
        .card-hover,
        .card-hover-light,
        .testimonial-card,
        .logo-glow,
        .overlay-content,
        .marquee-track,
        .marquee-track-reverse {
            animation: none !important;
            transition: none !important;
            transform: none !important;
            opacity: 1 !important;
        }
        html {
            scroll-behavior: auto;
        }
    }
</style>


{{-- ===== MAP INTERACTIVITY & MARKER STYLES ===== --}}
<style>
@php
    /* ── Build list of all Cambodia provinces ──────────────── */
    $allProvinces = [
        'banteay-meanchey', 'battambang', 'kampong-cham', 'kampong-chhnang',
        'kampong-speu', 'kampong-thom', 'kampot', 'kandal', 'koh-kong',
        'kratie', 'mondulkiri', 'pailin', 'phnom-penh', 'preah-sihanouk',
        'preah-vihear', 'prey-veng', 'pursat', 'ratanak-kiri', 'siem-reap',
        'stung-treng', 'svay-rieng', 'takeo', 'tboung-khmum', 'uddor-meanchey',
    ];

    /* ── Which provinces have projects? ──────────────────── */
    $activeKeys = array_keys($mapProjects ?? []);
    $inactiveKeys = array_diff($allProvinces, $activeKeys);

    /* ── Build CSS selectors ─────────────────────────────── */
    $inactiveSelectors = [];
    $inactiveHoverSelectors = [];
    foreach ($inactiveKeys as $key) {
        $inactiveSelectors[] = '.map-svg-cambodia .region[data-region="'.$key.'"]';
        $inactiveHoverSelectors[] = '.map-svg-cambodia .region[data-region="'.$key.'"]:hover';
    }
    $inactiveCss = implode(",\n    ", $inactiveSelectors);
    $inactiveHoverCss = implode(",\n    ", $inactiveHoverSelectors);
@endphp
    /* ── Province fill colors (dynamic from DB) ──────────── */
    .map-svg-cambodia .region {
        fill: #35a752 !important;
        cursor: pointer;
        transition: fill 0.25s ease;
    }

    .map-svg-cambodia .region:hover {
        fill: #2d8f45 !important;
    }

    {{-- Provinces WITHOUT projects get light gray --}}
    @if($inactiveCss)
    {!! $inactiveCss !!} {
        fill: #ececec !important;
        cursor: default;
    }

    {!! $inactiveHoverCss !!} {
        fill: #ececec !important;
    }
    @endif

    /* ── Province Tooltip (enhanced, multi-location) ─── */
    .map-tooltip {
        position: fixed;
        background: rgba(255, 255, 255, 0.6);
        backdrop-filter: blur(24px) saturate(1.5);
        -webkit-backdrop-filter: blur(24px) saturate(1.5);
        color: #1a3c6e;
        padding: 0;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 500;
        line-height: 1.5;
        pointer-events: none;
        z-index: 1000;
        opacity: 0;
        transform-origin: bottom center;
        transform: translateY(8px) scale(0.92);
        transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1), transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 12px 48px rgba(0, 0, 0, 0.1), 0 4px 12px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.6);
        max-width: 300px;
        white-space: normal;
        word-wrap: break-word;
    }

    .map-tooltip.flip-below {
        transform-origin: top center;
        transform: translateY(-8px) scale(0.92);
    }

    .map-tooltip.visible {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    .map-tooltip.flip-below.visible {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    /* ── Tooltip pointer (elegant glass arrow) ──────────── */
    .map-tooltip::after {
        content: '';
        position: absolute;
        bottom: -7px;
        left: 50%;
        transform: translateX(-50%);
        border-left: 7px solid transparent;
        border-right: 7px solid transparent;
        border-top: 7px solid rgba(255, 255, 255, 0.55);
        filter: drop-shadow(0 2px 2px rgba(0,0,0,0.03));
    }

    .map-tooltip::before {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 50%;
        transform: translateX(-50%);
        border-left: 6px solid transparent;
        border-right: 6px solid transparent;
        border-top: 6px solid rgba(255, 255, 255, 0.75);
        z-index: 2;
    }

    .map-tooltip.flip-below::after {
        bottom: auto;
        top: -7px;
        border-top: none;
        border-bottom: 7px solid rgba(255, 255, 255, 0.55);
    }

    .map-tooltip.flip-below::before {
        bottom: auto;
        top: -5px;
        border-top: none;
        border-bottom: 6px solid rgba(255, 255, 255, 0.75);
    }

    /* ── Header with clean teal glass ───────────────────── */
    .map-tooltip .tt-header {
        background: linear-gradient(135deg, rgba(15, 118, 110, 0.85), rgba(13, 94, 87, 0.85));
        backdrop-filter: blur(12px) saturate(1.3);
        -webkit-backdrop-filter: blur(12px) saturate(1.3);
        color: white;
        padding: 12px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        border-radius: 20px 20px 0 0;
    }

    .map-tooltip .tt-title {
        font-weight: 700;
        font-size: 14px;
        line-height: 1.3;
        letter-spacing: 0.01em;
    }

    .map-tooltip .tt-badge {
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        color: white;
        font-size: 10px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 20px;
        white-space: nowrap;
        flex-shrink: 0;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* ── Body with refined spacing ──────────────────────── */
    .map-tooltip .tt-body {
        padding: 12px 18px 14px;
        background: transparent;
        border-radius: 0 0 20px 20px;
    }

    .map-tooltip .tt-location {
        margin-bottom: 10px;
    }

    .map-tooltip .tt-location:last-child {
        margin-bottom: 0;
    }

    .map-tooltip .tt-loc-name {
        font-weight: 600;
        font-size: 12px;
        color: #1a3c6e;
        margin-bottom: 5px;
        letter-spacing: 0.01em;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .map-tooltip .tt-loc-name::before {
        content: '';
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: rgba(15, 118, 110, 0.5);
        flex-shrink: 0;
    }

    .map-tooltip .tt-tags {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .map-tooltip .tt-tag {
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 10px;
        font-weight: 600;
        letter-spacing: 0.2px;
        border: 1px solid rgba(0,0,0,0.06);
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
        color: #334155;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }

    .map-tooltip .tt-tag svg {
        vertical-align: middle;
        margin-right: 2px;
    }

    /* ── No-projects state ───────────────────────────────── */
    .map-tooltip.no-projects {
        background: rgba(26, 60, 110, 0.75);
        backdrop-filter: blur(24px) saturate(1.5);
        -webkit-backdrop-filter: blur(24px) saturate(1.5);
        color: white;
        padding: 10px 20px;
        max-width: 200px;
        font-size: 14px;
        font-weight: 600;
        border: 1px solid rgba(255, 255, 255, 0.15);
        text-align: center;
    }

    .map-tooltip.no-projects::after {
        border-top-color: rgba(26, 60, 110, 0.75);
    }

    .map-tooltip.no-projects::before {
        border-top-color: rgba(26, 60, 110, 0.7);
    }

    .map-tooltip.flip-below.no-projects::after {
        border-top: none;
        border-bottom-color: rgba(26, 60, 110, 0.75);
    }

    .map-tooltip.flip-below.no-projects::before {
        border-top: none;
        border-bottom-color: rgba(26, 60, 110, 0.7);
    }

    .map-tooltip.no-projects .tt-header {
        background: transparent;
        backdrop-filter: none;
        -webkit-backdrop-filter: none;
        padding: 0;
        color: white;
    }

    .map-tooltip.no-projects .tt-badge {
        background: rgba(255,255,255,0.15);
    }
</style>


{{-- ===== PROGRAMS ===== --}}
<section class="py-20 lg:py-28 bg-[#f8f9fc]" data-reveal>
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">{{ $settings['programs_badge'] ?? 'WHAT WE DO' }}</span>
            <h2 class="section-title mt-3 mx-auto">{{ $settings['programs_heading'] ?? 'Two Programs, One Mission' }}</h2>
            <p class="section-subtitle mx-auto text-center">{{ $settings['programs_subtitle'] ?? 'Operating across 15 Cambodian provinces, our programs address the most pressing needs of vulnerable children.' }}</p>
        </div>

        @php 
            $programs = collect($programs);
            $progCount = $programs->count(); 
            $gridCols = $progCount === 1 ? 'lg:grid-cols-1 max-w-md mx-auto' : ($progCount === 2 ? 'lg:grid-cols-2 max-w-4xl mx-auto' : 'lg:grid-cols-3');
        @endphp
        <div class="grid md:grid-cols-2 {{ $gridCols }} gap-8 justify-center">
            @foreach($programs as $program)
            <div class="card group flex flex-col card-hover" data-reveal="up" style="--reveal-delay: {{ $loop->index * 120 }}">
                <div class="relative overflow-hidden h-56">
                    <img src="{{ $program->image_url }}"
                        alt="{{ $program->localized_title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0f2448]/70 to-transparent"></div>
                    @if($program->stats && count($program->stats) > 0)
                    <span class="absolute top-4 left-4 bg-[#e8a020] text-white text-xs font-bold px-3 py-1 rounded-full">{{ $program->stats[0]['value'] }} {{ $program->stats[0]['label'] }}</span>
                    @endif
                </div>

                {{-- Content --}}
                <div class="p-6 flex flex-col flex-1">
                    <h3 class="text-xl font-bold text-[#1a3c6e] mb-3">{{ $program->localized_title }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-5 line-clamp-3">
                        {{ $program->localized_description }}
                    </p>
                    <ul class="space-y-1.5 mb-6">
                        @if($program->stats && count($program->stats) > 1)
                        @foreach(array_slice($program->stats, 1, 3) as $stat)
                        <li class="flex items-center gap-2 text-xs text-gray-500"><span class="w-1.5 h-1.5 rounded-full bg-[#e8a020] flex-shrink-0"></span>{{ $stat['value'] }} {{ strtolower($stat['label']) }}</li>
                        @endforeach
                        @endif
                    </ul>                        <a href="{{ route('programs') }}#{{ $program->slug }}" class="mt-auto text-[#1a3c6e] font-semibold text-sm flex items-center gap-2 hover:text-[#e8a020] transition-colors group-hover:gap-3 duration-300 link-arrow">
                        {{ $settings['programs_learn_btn'] ?? 'Learn More' }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">                    <a href="{{ route('programs') }}" class="btn-blue btn-micro">{{ $settings['programs_cta'] ?? 'View All Programs' }}</a>
        </div>
    </div>
</section>
{{-- ===== PROGRAM STRUCTURE MAP SECTION ===== --}}
@php
$structureWelfareItems = array_filter(explode("\n", $settings['structure_welfare_items'] ?? "2 Temporary Protection Centers\n2 Long-term Protection Centers\n2 Family Houses\nOutside Cases"));
$structureEducationItems = array_filter(explode("\n", $settings['structure_education_items'] ?? "5 Special Education High Schools"));
$structureImage = $settings['structure_image'] ?? null;
@endphp
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">

            {{-- Left Side - Map --}}
            <div class="col-pn animate__animated animate-pn-js animate__duration-1_2s" data-animate-pn="fadeIn" data-delay-pn="2s">
					<div class="map-svg-pn" data-map-mode="dynamic" data-active-regions="banteay-meanchey,uddor-meanchey,tboung-khmum,takeo,svay-rieng,stung-treng,siem-reap,ratanak-kiri,kampong-cham,pursat,preah-vihear,prey-veng,pailin,phnom-penh,mondulkiri,kratie,battambang,kampong-chhnang,kampong-speu,kampong-thom,kampot,kandal">
<svg class="map-svg-cambodia" viewBox="0 0 509 444.3">
  <defs>
    <style>
      .cls-1, .cls-2 {
        fill: #f3eae1;
      }

      .cls-3, .cls-4 {
        fill: #ffe7e2;
      }

      .cls-5 {
        fill: #fff;
      }

      .cls-6 {
        mask: url(#mask);
      }

      .cls-2, .cls-7, .cls-8 {
        stroke: #fafafa;
        stroke-miterlimit: 10;
        stroke-width: 3.1px;
      }

      .cls-9 {
        fill: #3d9cdd;
      }

      .cls-4 {
        isolation: isolate;
        opacity: .3;
      }

      .cls-7 {
        fill: none;
      }

      .cls-8 {
        fill: none;
      }
    </style>
    <mask id="mask" x="-2.09" y="-1.59" width="512.04" height="470.84" maskUnits="userSpaceOnUse">
      <g id="mask1_10294_6" data-name="mask1 10294 6">
        <path class="cls-5" d="M508.27,0H-.53v468h508.8V0Z"></path>
      </g>
    </mask>
  </defs>
  <g class="cls-6">
    <g>
      <path id="BanteayMeanchey" class="cls-2 region" data-region="banteay-meanchey" d="M66.77,43.8l4.6,9.4.3,1.6,1.5,1,.2.4.8.4.2.4h.5l.9.8.7-.3.9.4.3-.3h.6l.6.3.3-.4h.4l1.1.5h.9l1-.3.6.2.8-.3-.5,1.8-.5.8v1.7l-1.3,1.4.9,1.4-.2,1.5-.7,1.3-.9.8h-.5l-.2.6,3.2,5.8.3-.6,1.1-.5h2.8l1.6-.5,1.3-1.1,2.2-2.5,2.6-3.4.4,1.1,1.1,1.5,1.7,3.1,2.4,3.3.4.3,2,.3,1.5.9h.8l.3.3.2.6-.2.4.3.7-.2.4h-.3l-.3.3v.9l.2.3-.2.2-.4-.3-.4.4.4.2.2.8h-.4v.3l-.2.2-.2.2-.2.2v.5h.4l-.3.8h.3v.5l-.2.3.2.3.2.7.2.6.2.3.5.2.4-.3.2.2-.2.6-.5.3h-.5v.6l-.3.5.2.2v.3l-.6.3.3.5v.7l-.6-.2h-.7l-.2.2.4.7h.4l.5.3v.8l.2.3.6.2-.3.4-.3-.2-.4.8-.2.4v.3h.3l.5-.2h.3l-.3.5h-.2l-.4.2v.3l.7.3-.3.2h-.5v.2l.3.4-.2.7.2.3.6.6.3.5.8.4-.8,1-.7.2-1.1.6-.5.8-.7.9-.4,1.1.3.3h.4v.6l.4.2-.3.2-.8-.2-.2.2v.6l-.6.3.9.7v.2l-.4.2v.2h.6v-.5h.7v.5l-.2.3.7.3.2.5-.2.3h-.7l-.2.5.4.7.3.5.3.5-1,.2v.2l.3.4h.4l.5.2-.5,1,.2.2.3.2.3.4-.4.3v.6l-.2.5v1h-.3l-.3.3.5.8-.2.5-.4.7-.2.2v1.1l-.2.3.2.5.9.2.3.3v.3l-1.1,1-.2,1.6-.7,1.2v1.1l.3.3h.4l.2.9.4.2.4.9v.9l.3.5v.6l-.2.3-1.3.2-.5.4-1.9-1.4-2.2-.9h-1.2c0,.1-3.5,0-3.5,0l-2.2-.5-2.3.2-3.4-.3-1-.4-1.3-.2-1-.5-.2-.6-.6-.4-1.3-.2-.3.4-.8.5-.7-.9h-2.3l-.8.3-.3-.2v.4l-.9.4-.3-.4-.2.5-.5.3h-1.2l-2,.6h-1.5l-.6-.6-.6.2-1.3.5-.5.8h-.8v.5l-.2.2-.9-.5-.3.2-.5,1.8-5.9-.4h-.2v-.4l-5.9-1.8-1,.5-10-2.9-2.9,1.3-2.6,1.9v-9.7l-31.7.3-.2-.2.3-1.2v-1.6l-.2-.7-1-1.2-.8-.7-.5-.5v-.5c-.1,0,.4-1.8.4-1.8l1.8-.9.8-.9h.8l1.1.5.6.5h1.7l.5-.4h.6l1.1.9.6.2h1l1.4-.6,1.2-.3,1.4-.4.6.3h1.5l1.4.5,1-.2,1.2-1,1.3-.2.7-.7v-.5l.4-1.2,2.1-.5,1.4.3,1.3-.3-.2-.3-1.4-.3-1.1-.6-1.9-.7-.9-1.4-1-.6-.9-1,1.3-2.4.7-.8,1-.8,1.1-.7h.7l7.8-4.2.9-.2,2.7-2.2h1.4v-1l-.9-.8,3.1-4.9,1.2-1.4,1.5-7.5,1.5-.9h.5l.8-1.1.5-1.2,3.2-2,1.7-1.8h1.3l.2-.5h.3l.8.2.7-.8,1-.2-.3-.9-.7-.9-.2-.8-.2-.8v-1l.4-.6-.2-1.6.6-.8,1.5-1.3.2-.4v-2.2l1.1-1,.4-.6v-.4l-.4-1.4-.7-1.1,1.1-.9-.2-.8.6-.4.7.3h.3v-.3l-.3-.8,1-.5h.9l1.4-.3.4.2h.8l.3-.6,1-.7v-.5h.5l.4.2.4-.2.8-1v-.9l.2.2Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="Battambang" class="cls-2 region" data-region="battambang" d="M1.97,120l.2.2,31.6-.3v9.7l2.7-1.9,2.9-1.3,10,2.9,1-.5,5.9,1.8v.3c0,.1,5.9.5,5.9.5l.5-1.8.3-.2.9.5.2-.2v-.3h.7c0-.1.5-.9.5-.9l1.3-.3c0-.1.6-.3.6-.3l.6.7h1.5l2-.7h1.2l.5-.3.2-.5.3.4.9-.4v-.4l.4.2.8-.3h2.3l.7.9.8-.5.3-.4,1.3.2.6.4.2.6,1,.5,1.3.2,1,.4,3.4.3,2.3-.2,2.2.5,3.5.2h1.2c0-.1,2.2.7,2.2.7l1.9,1.4.5-.4h1.3c0-.1.2-.5.2-.5l.2-.2h.4c0,.1.4.6.4.6h.8l.7.2.3.5.3.2.8.2.2.3.9.2.9-.7h.3l1.3,1,1.1-.8,1.8.3.3.3v.7l1.3.2,1.2.7.2.7v.9l.3.3h.6c0,.1.3-.2.3-.2h1.1l.6.9v.6l.8.5,1-.2h1.5c0-.1.4-.3.4-.3l1.2.6.4-.2h.4l.5.7.9.4.2.5.3.4h.2l1-.6-.2-.4h.4c0-.1,1.8,1.1,1.8,1.1l.7.9.8,4.3,3.8,4.8,7.8,5.6,5.1,4.5.7.9-3.2,2.2-7.6,2.9-3.5-.2-.7.3-.2.9-.7.5v.9l-1.3,1.1v1.6l.3.6.8.3.2,1.5-.2.4h-.6c0-.1-1.1.2-1.1.2l-.2.5-.9.6v.7l-.6,1.1v1l.2.6v.9c-.1,0-.6.3-.6.3l-.5.2h-.3c0,.1-.4.1-.4.1h-1l-1.1.4-.4.4-.9.3-1,.8v.5l-.3.8v.9l1.4.2v.8l-.5.7-.2.3-.2.3v1.2l-.3.4h-.4l-.4.5.2.5-.5.7v.4l.4.5v.4l-.3.5.2,1,.2.4.2.3-.2.5v.4l.5.5h.4c0,.1.4.7.4.7v.8l-1.6,2.4,1.9,1.4h.4c0-.1.3,0,.3,0v1.8l.4.4-.2.3-.2.2h-.5v.5l-.4.2v1.3l.7.8-.9,1v.5l.5.4.3.6.2.4-.8.5-.2.3.2.2-.3.3-.8.7-.2.7-.5,1-.2.6-.4.8-.8.3-3.8.2-2.3.8-1.5,1h-1.1l-2.5-1.1-.4-.4-1.5-.8-.7-.8-1.4-.5h-.3l-3.6-1.7-1.1-.2-.3.2h-.5l-.9.7h-1.1v-.9l-3.5-.7v.5h.4v.2h-1c0,.1-.3,0-.3,0h-.3c0-.1-.4,0-.4,0l-.2-.2-.4.4v1l-1.7-.3-.4.6h-.8l-.6,1-1.2.4-.7.9-1.1-.6-.9-.2-.5.2-1.5,1.3-2.3.6-1.3,1.2-.8,1.1h-.4l-1.2-.8h-.5v.5h-.9c0,.1-2.1,1.4-2.1,1.4l-.3.6h-.8c0,.1-.6-.1-.6-.1h-.7l-.5.5h-.4l-.2.3v1.7l-.3.3-3.3-.6-.5-.4h-.7l-.2-.8-1-1.4v-.6l-1.2-.9-1.4,1.2-.8,1.4v.7l-.6.2-1.6.7v.5l-.8.5-1.9-.4-.2.3-.8.3-.2-.3-.4-.3h-.2v.5h-.3l-.4.8-.5.3-.7.6-.6.6-.3.4v.4l-2.1-.6v-.3l-1.5-.5-.5.8-.4.3v.5l-.6.3-.3.8.3.5-.2.3-.8.7-.2-.3-.9-.6-.5-.9-1-1.2.2-1.6-.5-1.7h-.8c0-.1-.7-2.1-.7-2.1h-1l-.3-.5-.4.4-1.1-1v-.9l.3-.7-.6-.6h-.3l-.7.4-.3-.3v-.4l.5-.5-.2-.6.6-.9h-.5l-.6.6-1.3-.8-.9-.6v-.3l-.3-.8-1.5-.7v-.4l.7-.5-.8-1-.9-.5v-1l-.5-.8h-1l-.7-.3v-.9l.3-.5-.2-1.1-1.3.2-.4-.6h-.9l-1.8-1.4-1.6-1.5-.3-.8h-.8l-.4-.4-1.4.5-.8-.4-.7.2h-.6c0-.1-1.2-1-1.2-1l14.2-2.5,8.3-5.8-.2-27.2-5.3-7.4-.6-.3-.2.4-.2-.6-.4-.3h-1.1v-.3l-.3-.2h-.2v.2c-.1,0-.6-.2-.6-.2h-.3c0,.1-.3-.2-.3-.2l-.6.5v-.4h-1v.9h-.8c0,.1-.6.5-.6.5l-.4-.2v.4l-.4.2h-.2l-.2-.4h-.3v.6h-.6l.5.4v.4h-1.5v.4l.5-.2v.2c.1,0-.5.7-.5.7h-.7v.8c-.1,0-.4.2-.4.2v.6l.4-.3.2.9.5.3-.2.9.3.3-.5.5.6.2-.5.4h.5l-.2.4h-.2l.3.6h-.5v.7l-.4.2v.5l-.2.4h-.4c0-.1-.3.3-.3.3l-.3-.3h-1.1l-.2-.3v.4h-.9l-.5.2v-.8c-.1,0-.4.2-.4.2h-.3c0-.1-.6-.6-.6-.6h-1.9l-.9-.7-3.3-6.7-1.6-.6h-.5c0,.1-.4-.2-.4-.2l-.2-1.4-.8-.5-.2-.9-.6-.6v-1.4c.1,0-.5-.6-.5-.6h-.5c0-.1-.7-1.2-.7-1.2v-1.4l-.6-.6-.2-.8.3-.6v-.8l-.4-.3-.3-1.4-.7-.6-.8-1.4-.4-1.8v-.7l-.2-.4-1.1-.4-.3-.6v-1.4l1-2.1-.2-1.1-.6-1.1-.5-1.1.6-2.5.4-.5.2-2,.3-2,.3-.7-.4-1.1-.2-1.5.2-2.4-.3-.3h-.1v-.1Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="TboungKhmum" class="cls-2 region" data-region="tboung-khmum" d="M326.87,237.3h-.7l-9.8-3.3-6.5-.9-3.3,3.5-.4,6.1.4,6-.2,4.6-2.3,2.3-2.6,4.9-1.6,5.3-.9,4.7-2.6,4.4-1.2,2.3v3.9h.2c0,.1.2.4.2.4l.2.5-.5.4v.5l.2,1.2-.2,1,.3,1.2.6.9,2,1.5h.5l1.4-1,3.3.2,1.7.8h1.3l.6.4,4,.3,3.9.6h3l1.7.4,3.3-.4,2,1.8,1.2,3.1,1.2,1h.4v.3h.6c0,.1.2,1,.2,1l.6.2.2.3v.5c-.1,0,.1.1.1.1v.2h-.3c0,.1.3.3.3.3v.5h.2v.4l.3.2v.3h.4c0,.1-.2.4-.2.4l.5.2h-.1c0,.1.6.6.6.6l.2.4h.4v.4c-.1,0,.3.3.3.3v.7c.1,0,1.2.2,1.2.2l.4.5.2-.7-.3-1.2,1.8-.2.4-.6.4-1.2v-.9l.6-.2.6-.9.6-.5,2.5-1.2h.9l1.1,1.1,2.2,1.5,2.7,1,.6-1.1.5-.2,1.5-1.6v-.9l-.4-.4.5-.9,1.3-1.1.3.2.4-.2.7-1.8.5-.5v-1l-.5-1.2.8-2,.6-.5h.9l.8-.4.7.4,1.2-.7h.6l.6.9,1.6.7.3.4v.5h.7l.3.7.6.5h2.4l2,.7,1.3-1.2h.4l.5.2.6-.6h.4l.5.5.2.7,1.2.9.7.3,1-.3,1.5.5.8-.2,1.6.8.3.6.3.2-.3.7,2.8,2.4v.6h1.7c0-.1,1.3-1.1,1.3-1.1h.3l.2.6h.4l2.5-1.4h1.9c0-.1.7.3.7.3h.8c0,.1,1.5,1.5,1.5,1.5h1v.5c.1,0,.7.3.7.3h1.6l.3-2-.4-.6-1.1-.9-1-2.1-.5-1.1v-.7l-.5-1.3v-1.1c.1,0,.9-1.8.9-1.8l.8-1.9.6-1,.6-.5-.2-.7-.7-.9.2-.4-.2-.8v-.5c.1,0,.7-.3.7-.3v-.6c.1,0,1.1.2,1.1.2l.9-.3-5.3-10.4-1.1-.4-.2.6h-.5c0,.1-.1.5-.1.5l-.5.2v.5l-.7.6-1,.2-.3-.4-.5.4-.4.2-1.4-.9-.7-.2h-.6l-.4-.2h-.4c0-.1-.5-.2-.5-.2h-.3l-.2.2h-.8l-.2.5h-.8c0,.1-.2-.3-.2-.3h-.4v.4h-.2c0,.1-.5.1-.5.1h-.4c0-.1-.7-.1-.7-.1h-.4l-.3.3h-.3l-.4-.4h-.7v-.7h-.6l-.5.4-.8.4-.3-.2-.2-.4-1-.4h-.7c0-.1-1.1.7-1.1.7l-.2.5-.6.5-.6-1,.3-.4h-1c0-.1.2-.5.2-.5h.4l.2-.2v-.7l-.3-.3v-1.6l.5-.2v-.5l.5-.3v-1.3l-.8-1v-.4l-.8-.4h-.7c0-.1-.3-.9-.3-.9h-.6v-.6l-.8.6h-.3c0,.1-.4-.7-.4-.7h-.1l-.3-.2h-.7c0,.1-.3-.5-.3-.5v-.5c.1,0-.5-.8-.5-.8h-1.7l-.3.3-.4.2-.4.2-.9-.3.3-1.1h-.6v.3c-.1,0-1.1-.3-1.1-.3l.2-.2-.2-.2-.5.3-.3.3h-.6c0-.1.6-.9.6-.9l-.5-.2-.2-.2-.2-.2.3-.4h.3c0,.1.2-.1.2-.1l.4-.5.6-.3v-.7c.1,0-.1,0-.1,0l-.3-.4v-.2h.5v-.7l-.9-.5-.3-1-.2-.4v-.7l-.4.2v.4c-.1,0-1.1.4-1.1.4h-.5l-.4-.3-.2-1.2-.5-.6-.7-.8.4-.3v-.2l-.4-.2-1-.2h-.3c0,.1-.3,0-.3,0l-.6-.4.4-.4v.4h.5v-1.1l-.7-.2-.2.5-.4-.7-.5.4h-.4v.4c.1,0,0,.2,0,.2h-1.1l-.4-.5h-.4c0,.1-.3.4-.3.4l-.3-.3v-.6l-.3-.5-.5-.2h-.3c0,.1-.5-.3-.5-.3l-1.2.4v-.3l-.3-.4h-.2l-.2.4-.5.2-.9.4-1-.4h-.4c0-.1-.4-.1-.4-.1h-.4l-.6-.8-.2.3h-.3v.8l-.5.3v.6l-.5-.2h-.4l-.8-1.4v-1.1c.1,0-.2-.5-.2-.5l-.4-.6v-1.6l-1.5-.2h-3.5c0,.1-3.3-.8-3.3-.8l-.2-.4v-.7h.2l-.6-.5Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="KampongCham" class="cls-1 region" data-region="kampong-cham" d="M324.37,215.6l-1.1.7h-1.3l-1.8.4-3.6-.5-8.5.3v.3h-.4c0,.1.2.3.2.3l-.6.5h.1c0,.1-.2.4-.2.4l-.2-.3-.3.7h-.3c0-.1.3.1.3.1l-.5.4v.2c.1,0-.3,0-.3,0l.2.2-.4.2v.3c.1,0-.2-.2-.2-.2v.3h-.7v.2c-.1,0-.9-.2-.9-.2v.3h-.2l-.3.2-1-.2v-.4h.3l-.5-.4v-.3h-.8v.6h-.3c0-.1.1-.8.1-.8l.2-.2h-.4c0-.1-.3-.5-.3-.5l-.4.2c-.1,0-.5-.2-.5-.2v-.2l-.3-.3-.3.2v-.3c-.1,0-.2.1-.2.1l.2.2h-.3v-.5c-.1,0,.2,0,.2,0l-.4-.2v-.3h-.3l-.2-.5h-.4c0-.1.2.2.2.2h-.3v-.3c-.1,0,.1-.2.1-.2h-.2l-.2.4-.2-.3h-.3l.3.4h-.3c0,.1-.4,0-.4,0v.2c-.1,0-.6-.1-.6-.1h-.3c0,.1-.1,0-.1,0v.5l-.4.3-.3-.2v.2c-.1,0-.3-.2-.3-.2v-.4h-.8l-.2.5.4.2.2.4-.4.2.4.6-.5.5h-.3v.4l-.4.5.2.8h-.2v1.1l-.5.4v.3c-.1,0,0,.3,0,.3h-.2v.3l-.8.7.5.5-.4.3-.2,1.1h-.2v.4c-.1,0,0,.1,0,.1h-.4c0,.1-.3,2-.3,2l-.8.6-1,.4h-1.5v-1.2l-.3-.3-.9-.3-.2-.7-2.9-.3-.9.2-.9-1.3-.8-.3-.4.2h-.7c0-.1-1,.4-1,.4l-.9-.2-.8-.6h-.7c0,.1-.3.7-.3.7l-1.3.3h-.8l-.2-.4-.6-.2-.6.2-.3-.4-.4.3.2.6-.2.3-.7.7h-.5l-.8.2-.8.9h-.5l-.3.5.2.5,1.4,1.3.3,1.2,1.1.5h.9l-.3.4-.2,1,.5.8-.3.8.5,1.4,2.3,2.1-.5,1.4v.9l1.2,4-.5.4-.4.7-.7-.7h-1.2c0,.1-.8-.7-.8-.7v-.8l-1-.2-.2-.6-.4-.2h-.5c0,.1-.7,0-.7,0l-.7.7-.2.6h-.9c0,.1-.2.4-.2.4h-1l-.3-.3v-1.3c.1,0,0-.2,0-.2h-2.8l-1-.4-3.2.4-.6.4-.7-.5-.2.4h-.2l-.4-.5-.3-.4v-.3c-.1,0-.3-.3-.3-.3l-.4-.4-.3-.2h-.4l-.2-.3v-.4c-.1,0-.5-.2-.5-.2l-.2-.5v-.4c-.1,0-1-.5-1-.5v-.2h-.8v.2c-.1,0,.1.6.1.6h-.8c0-.1-.4-.3-.4-.3h-.9c0-.1-.9.2-.9.2l-.5-.4h-.9l-.2.4h-.4c0-.1-.7,0-.7,0l-.3.4v.7l-1.8.7-1-.2v.7c.1,0,.4.1.4.1v.4c.1,0,1.2.4,1.2.4v.4h-.3v.5h-.3l.2.6h.3c0,.1,1,0,1,0l.3.7v4.2c.1,0-.6.9-.6.9l-.7,1.4v1.3l-1.6,4.8.3.2v-.3h.6l1,1.4v1l.4.8-.5,1,.7,1.3-.2.5-.5.2v.5c.1,0,0,.9,0,.9v.4l-.3.4h-.4c0-.1-.3-.3-.3-.3l-.8.3v.2l-.8.2-.8,1-.6,2.1-.4.4-.9.2-.4,1.1v2.3c-.1,0-.9,1.2-.9,1.2v1.1c.1,0,1.6,1.7,1.6,1.7l-.5,2.5.2.6-.3,1,.2.2,1.8-.2v-.7h.3l.6.5h.4l.3.3v.2l.4.2.6.2.5-.6.3.3h.3l.9.7.3.7h.6c0,.1.8-.1.8-.1l.2-.8.7-.6.3-.6.8-.3.3-.7v-.2h.2v-.4c.1,0,0-.6,0-.6l.9-.9v-1.1h.4v1.2l.5.5,1.1-.7,1.1-1.6h.5c0,.1.3.6.3.6h.3v.8l.6.8v.3l3.3.5.9,1.7,1.6,1.5v.8c.1,0-.5.6-.5.6h-.7c0,.1-.3.9-.3.9l-.4,1.7.2.6v1.6l3.7.2.8,1.3.5.2h.5l.5-.5.8-.2,2.2.7h1.6l.4-1.1-.2-.6-.5-.6v-.3h1.1c0-.1.5-.7.5-.7h.8l1.3-1.4,1.2-.3.9-.5.5-.8h.5c0,.1.9-.3.9-.3l.6-.4.8-.5,1.4-2.7h.2c0-.1.6,0,.6,0l.4-.7.7.2v-.6c.1,0-.2-.2-.2-.2v-.4l.5.2.5-.4h1.3c0-.1.6-.5.6-.5h.8c0-.1.4-.6.4-.6l.3.6.6.4v.4l.6.4.9.2,1-.5.3.4.6.3.2.4,1.3.3.2.3.9-.8h.5c0,.1.4.6.4.6v.5l.4.2v-3.9l1.2-2.3,2.6-4.4.9-4.7,1.6-5.3,2.6-4.9,2.3-2.3.2-4.6-.4-6,.4-6.1,3.3-3.5,6.5.9,9.8,3.3h.7l.3-1.2-.4-.8.4-.4h.2c0,.1.6-.2.6-.2l.6-.8.2.3h.3l.5-.5.5-1.9v-.7l-.3-3-.5-2.8-1.8-5.7-1.1-2-.4-1.3v-.7h-1.6c0-.1.9.4.9.4Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="KampongCham-2" data-name="KampongCham" class="cls-7" d="M300.27,218.4l.4-.2s.3.4.3.5h.4l-.2.2s-.1.7-.1.8h.3v-.6h.8v.3l.5.4h-.3v.4l1,.2.3-.2h.2v-.3s.8.2.9.2v-.2h.7v-.3s.3.2.2.2v-.3l.4-.2-.2-.2s.4,0,.3,0v-.2l.5-.4s-.3-.2-.3-.1h.3l.3-.7.2.3s.2-.3.2-.4h-.1l.6-.5s-.2-.2-.2-.3h.4v-.3l8.5-.3,3.6.5,1.8-.4h1.3l1.1-.7s-.9-.5-.9-.4h1.6v.7l.4,1.3,1.1,2,1.8,5.7.5,2.8.3,3v.7l-.5,1.9-.5.5h-.3l-.2-.3-.6.8s-.6.3-.6.2h-.2l-.4.4.4.8-.3,1.2h-.7l-9.8-3.3-6.5-.9-3.3,3.5-.4,6.1.4,6-.2,4.6-2.3,2.3-2.6,4.9-1.6,5.3-.9,4.7-2.6,4.4-1.2,2.3v3.9l-.4-.2v-.5s-.4-.5-.4-.6h-.5l-.9.8-.2-.3-1.3-.3-.2-.4-.6-.3-.3-.4-1,.5-.9-.2-.6-.4v-.4l-.6-.4-.3-.6s-.4.5-.4.6h-.8s-.6.4-.6.5h-1.3l-.5.4-.5-.2v.4s.3.2.2.2v.6l-.7-.2-.4.7s-.6-.1-.6,0h-.2l-1.4,2.7-.8.5-.6.4s-.9.4-.9.3h-.5l-.5.8-.9.5-1.2.3-1.3,1.4h-.8s-.5.6-.5.7h-1.1v.3l.5.6.2.6-.4,1.1h-1.6l-2.2-.7-.8.2-.5.5h-.5l-.5-.2-.8-1.3-3.7-.2v-1.6l-.2-.6.4-1.7s.3-.8.3-.9h.7s.6-.6.5-.6v-.8l-1.6-1.5-.9-1.7-3.3-.5v-.3l-.6-.8v-.8h-.3s-.3-.5-.3-.6h-.5l-1.1,1.6-1.1.7-.5-.5v-1.2h-.4v1.1l-.9.9s.1.6,0,.6v.4h-.2v.2l-.3.7-.8.3-.3.6-.7.6-.2.8s-.8.2-.8.1h-.6l-.3-.7-.9-.7h-.3l-.3-.3-.5.6-.6-.2-.4-.2v-.2l-.3-.3h-.4l-.6-.5h-.3v.7l-1.8.2-.2-.2.3-1-.2-.6.5-2.5s-1.5-1.7-1.6-1.7v-1.1s.8-1.2.9-1.2v-2.3l.4-1.1.9-.2.4-.4.6-2.1.8-1,.8-.2v-.2l.8-.3s.3.2.3.3h.4l.3-.4v-.4s.1-.9,0-.9v-.5l.5-.2.2-.5-.7-1.3.5-1-.4-.8v-1l-1-1.4h-.6v.3l-.3-.2,1.6-4.8v-1.3l.7-1.4s.7-.9.6-.9v-4.2l-.3-.7s-1,.1-1,0h-.3l-.2-.6h.3v-.5h.3v-.4s-1.1-.4-1.2-.4v-.4s-.3-.1-.4-.1v-.7l1,.2,1.8-.7v-.7l.3-.4s.7-.1.7,0h.4l.2-.4h.9l.5.4s.9-.3.9-.2h.9s.4.2.4.3h.8s-.2-.6-.1-.6v-.2h.8v.2s.9.5,1,.5v.4l.2.5s.4.2.5.2v.4l.2.3h.4l.3.2.4.4s.2.3.3.3v.3l.3.4.4.5h.2l.2-.4.7.5.6-.4,3.2-.4,1,.4h2.8s.1.2,0,.2v1.3l.3.3h1s.2-.3.2-.4h.9l.2-.6.7-.7s.7.1.7,0h.5l.4.2.2.6,1,.2v.8s.8.8.8.7h1.2l.7.7.4-.7.5-.4-1.2-4v-.9l.5-1.4-2.3-2.1-.5-1.4.3-.8-.5-.8.2-1,.3-.4h-.9l-1.1-.5-.3-1.2-1.4-1.3-.2-.5.3-.5h.5l.8-.9.8-.2h.5l.7-.7.2-.3-.2-.6.4-.3.3.4.6-.2.6.2.2.4h.8l1.3-.3s.3-.6.3-.7h.7l.8.6.9.2s1-.5,1-.4h.7l.4-.2.8.3.9,1.3.9-.2,2.9.3.2.7.9.3.3.3v1.2h1.5l1-.4.8-.6s.3-1.9.3-2h.4s-.1-.1,0-.1v-.4h.2l.2-1.1.4-.3-.5-.5.8-.7v-.3h.2s-.1-.3,0-.3v-.3l.5-.4v-1.1h.2l-.2-.8.4-.5v-.4h.3l.5-.5-.4-.6.4-.2-.2-.4-.4-.2.2-.5h.8v.4s.2.2.3.2v-.2l.3.2.4-.3v-.5s.1.1.1,0h.3s.5.1.6.1v-.2s.4.1.4,0h.3l-.3-.4h.3l.2.3.2-.4h.2s-.2.2-.1.2v.3h.3s-.2-.3-.2-.2h.4l.2.5h.3v.3l.4.2s-.3,0-.2,0v.5h.3M300.27,218.4v.4M300.27,218.4c-.1,0-.5-.2-.5-.2v-.2l-.3-.3-.3.2M299.17,217.9v-.3c-.1,0-.2.1-.2.1l.2.2Z"></path>
      <path id="KampongChhnang" class="cls-2 region" data-region="kampong-chhnang" d="M194.07,203l5.1,2.5.4,4.1h-.3c0-.1-.6,0-.6,0l-.4.6.6,1.5,2.2.8-1.7-1.7,1.1.3.6.8.8.3.8.4.3.5,2.4.9h1.7l.3-.4h.7l.6-1.6.5-.4.2-.5v-1.2c-.1,0,.2-.5.2-.5l.2-.6,2.2-1.4,2.6-1.1h1.1c0-.1,1.4-.9,1.4-.9h1.2l1.9-.5,2.7,1.3,2.1.6,1.7.8,4.8,2.9,7.2,1.9.9,1-.6,1.2.3.8-.3.3v.4l-.7.3v.6l.3.3h.6l.5.4h.7c0-.1.4.3.4.3v.4l-1.2.3v.4l.4.3v.3l.3.3v.3h.3c0-.1.3,0,.3,0l-.6.7h.6v.6l-.2.3.7.6h.4l.8-.3v.7c-.1,0,.2.2.2.2l-.2.3.4.6v1.4l-.6.7v.4c.1,0,0,.5,0,.5l.3.4-.2.5h.4l.2-.3.2.2h.3l.4-.9.7-.2v-.6c.1,0,0-.3,0-.3v-.3h.5l.2-.4.4.5v.5c.1,0-.2.8-.2.8v.3l.3.7.3.2v.4c-.1,0-.4.4-.4.4l-.4.7.4.5v.6c-.1,0-1.3.4-1.3.4l-1,.9-.2.4h-.6v1l-.9,1.1v1c.1,0-.2.3-.2.3v.5l.5.2.5,2,1.1,1.8v1.1h.4c0,.1.1.5.1.5l1.1.4v.4h-.3v.5h-.3l.2.6h.3c0,.1,1,0,1,0l.3.7v4.2c.1,0-.6.9-.6.9l-.7,1.4v1.3l-1.6,4.8.3.2v-.3h.6l1,1.4v1l.3.8-.5,1,.7,1.3-.2.5-.5.2v.5c.1,0,0,.9,0,.9v.4l-.3.4h-.4c0-.1-.3-.3-.3-.3l-.8.3v.2c-.1,0-.8.2-.8.2l-.8,1-.6,2.1-.4.4-.9.2-.4,1.1v2.3c-.1,0-.9,1.2-.9,1.2v1.1c.1,0-.9-.8-.9-.8l-2.3.6-.6.8-.7-.7-.8.6.8,1.4-.3.6.3.4-.2.5.5.3.6,1-.9.4h-.4c0-.1-.3.3-.3.3l-.8.3-1.1-.3-.6.2v.3c-.1,0-.5-.1-.5-.1l-.4.4-.4.6-.5.3h-.6l-.3.3h-.6c0,.1-1.5-.2-1.5-.2l-1.2.4h-.8c0,.1-1.2,0-1.2,0l-.4-.3-.3.2-.6.4h-1.9v.2c-.1,0-.6.5-.6.5l-.8.4-.7.4-.5.2-.7.6-1,.9-.2.6-.3.2-.6.2-.3.7-.9.5-.2.4-.8.6h-.2l-.3-.3-.7.3-.5.2-.9.4-.9-.3h-.5c0,.1-.6,0-.6,0l-.2.2h-.4l-.4-.5-.9-.4-.6-1h-.3c0-.1-.6,0-.6,0l-2-.4-1.9-.2-.4-.3-1.1-.2h-.8l-.6-.4-1.1.2-.8-.6-1.4-2-1.5-1.2-.3-.3-.4-.6v-.6l-.8-.5v-.6l-.3-.7.5-1.3-.7-.8v-.5l-.5-.2v-.9c-.1,0-.6-.1-.6-.1l-.5-.4-.8-.9-1.4-.6-1.2-1.3v-.5c-.1,0,.2-.9.2-.9l-.5-.8-.3-.2-.4-1.2v-.7l.6-1.1.2-1.1-.4-1v-.7l-.7-1h-1.2c0-.1-1.8-.9-1.8-.9l-1-2.2-.2-1.1-.3-.4v-.7l-.5-1.6v-.5l-.3-.9-.3-.7v-.5c-.1,0-.6-.4-.6-.4l-.2-5.4v-.4c-.1,0-1.2-.7-1.2-.7v-1.2l.4-.6-.4-.6.8-4,.8-1.1v-.5l1.1-.8.2-.5.4-.4.4-.8.7-.6,1.5-.4h.2l1-.3h.8l.9-.3.3-.8,1.6-1.5h1.3l.5-.3.8-.2.4.2v-.6l.8-.2.4-.3,1.2-1.7,1.4-4.3,1.6-.9.6-.8h.9l.7-.4-.5-.6.2-.9-.9-2v-1.5l.6-1.2.2-1.3v-2.4l-.4-.8-2.5-9.9-.6.3v.1Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="KampongSpeu" class="cls-2 region" data-region="kampong-speu" d="M178.77,257.1l.5,1.6v.7l.3.4.2,1.1,1,2.2,1.8.8h1.2c0,.1.7,1.1.7,1.1v.7l.5,1-.2,1.1-.5,1.1v.7l.4,1.2.3.2.4.8-.3.9v.5c.1,0,1.3,1.3,1.3,1.3l1.4.6.8.9.5.4h.5c0,.1.1,1,.1,1l.4.2v.5l.8.8-.5,1.3.3.6v.6l.6.5v.6l.5.6.3.3,1.5,1.2,1.4,2,.8.6,1.1-.2.6.4h.8l1.1.2.4.3,1.9.2,2,.4h.6c0-.1.3,0,.3,0l.6,1,.9.4.4.5h.4l.2-.3h.7c0,.1.5,0,.5,0l.9.3.7-.3h.2l.5-.3.7-.3.3.2h.2l.8-.5.2-.4.9-.5.3-.6.6-.3.3-.2.2-.6,1-.9.7-.6.5-.2.7-.4.8-.4.5-.5v-.3h2.1l.9-.6.4.3h1.2c0,.1.8,0,.8,0l1.2-.4,1.5.3h.6c0-.1.3-.5.3-.5h.6l.5-.2.4-.6.4-.4h.3c0,.1,1.3.6,1.3.6v2l-2.2,6.6-.9,2-1.9,3.4-1.1,3.6-.9,4.5.2,3.4-1.4,5.9-.3.5v2l-.6,3.8.6.2.6.7h.5c0,.1.4.6.4.6h.4l.2-.6.4-.2.2-.6h.6c0,.1.1.6.1.6h.5c0,.1,1.3-.4,1.3-.4l.4-.5h.2v.6l.6-.3.6.9h.5c0,.1.8.3.8.3l.4-.3h1v.4h.4c0,.1.6-.4.6-.4v-.4l.3.3-.4.6h.6c0,.1.1-.1.1-.1h.3l-.4.5h.1l.4.2.2-.2v-.7l.3.2h.3c0-.1,0,.2,0,.2l-1,1.6-4.8,5.2-1.9,2.6-.6,2.5v1.5l-2.1,12.1.3,3.1-.2,3.7-1-.2v.3l-.6.3h-1l-.4.3h-.8l-.4-.3-.3.6h-.5c0,.1-.6,0-.6,0l-.3-.4-2.9-.4-1.9-.9-1.8-.3-1.8-.6-.9-.6-1.1-1.1-.2-.7h-.7l-.9.5-1.3.3h-1.5c0-.1-.2-.3-.2-.3l-.7.3-.9-.5-.6-.3h-.7l-.3.4h-.5l-.6-.4h-.4c0,.1-.7-.5-.7-.5h-.2c0,.1-1-1.1-1-1.1l-.3.4-.5.3-.2.4h-1.6c0,.1-.2.5-.2.5l-.5-.4-.7-.2h-.4c0,.1-.5-.1-.5-.1h-.4l-1.1.9-.2.2v.5l-.3.6-.5.3v-.2c-.1,0-.4.2-.4.2l-.4,1-.5.2-1.3-.2-4.5,1.2h-3c0-.1-1.9-.8-1.9-.8l-.9-.7-1.4-1.7-.9-2-1.4-.7-1.2-1.8-1.5-1.6-1.4-2,.2-1.4-.7-1.1.2-.9-.2-.6-.5-.4v-.8l-.3-1.1.5-.9v-.4c-.1,0,.9-1,.9-1v-1.7c.1,0-.2-.6-.2-.6v-.7c.1,0-.8-1.6-.8-1.6l-.8-2.2-1.5-.4-1.9-1.6.3-1.5-.9-1.4v-1.1l-.2-.7.5-.6v-.7c.1,0,1.4-.6,1.4-.6l.3-.5-.4-2.2-.6-1.3-.7-.2-.7.3-.8-.5h-.5c0-.1-.7-1.5-.7-1.5l-1.5-1.4h-.5l-1.5.6-.3-.4-.9.2-1.1.8-.5-.3-.4.3h-1l-.5-.4-.5-1.4h-1v-1.1l-.5-.6-.7-.3-1.5-.2-.6-.9h-.5l-1.3-.7h-.3c0,.1.3-.5.3-.5l-1.2-1h-.6l-.2-.5h-.4l-.5-1.2-.6-.2-.8-.9-2.3-.5.2-2.9.6-1.2v-1.2l-.5-1-.7-.8-.8-.5-.4-.6-.4-1.3.2-1.7.5-.6.2-.6-.9-1.8v-.5l1.8-1.2v-.5c.1,0,.1-1.2.1-1.2l-.7-.3-.2-.4-.3-2.2v-.6l.4-.5v-.6h.3c0-.1,1.8.9,1.8.9l1.5.2.6.3h1.1l.9-.6.9-.2h.6c0-.1.4-.6.4-.6l.7.2v-.8l-.2-.5.9-1.2.5-.3.4-.8,2.1-.5.2-.6h.4v-.6h.2c0-.1-.2-.1-.2-.1l-.4-.6v-2c.1,0,1.8-.4,1.8-.4v-.4l.4-.3h.8l.4.4h.9l.2.3h1l.4.5.2,1,.8,1v.6c.1,0,.4.1.4.1h.7c0-.1,1.8.1,1.8.1l1.4-1.3.7-.3.2-.4,1.1.2.7-.2.3-.5-.8-2.2-.5-.6.7-1.1.4-.2.9.2h.2c0-.1.3-.8.3-.8l-.2-.5.4-.4h.3l.7.2v-.8l.4-.5.5-2.5-.4-1.7h1l.7-.6h.4c0-.1,1-.2,1-.2l.9.5h.8l.3-.7h1.5l.7.4.4.6.8.2.2-.2v-1.3c-.1,0,.7-1.7.7-1.7l.9-.6-.6-.4Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="KampongThom" class="cls-1 region" data-region="kampong-thom" d="M307.27,122.6v.4l.8.7v1.6l.5,1.3v1.9l-.6,2,.4,2-.3.9.3,1.1v1.2c-.1,0,.1.9.1.9l-.2.6.2.4-.2,1.8,1.9.8,1.8,1.9.2,2v2c-.1,0,1,2.8,1,2.8l.5,2.8.6.3.2.8,2,1.1.4,1.1.8.7v.8l-.6,1.8v.6l-.4.7v.9c-.1,0-.5.2-.5.2v.3c-.1,0,1.7,5.1,1.7,5.1v.6l-.7,1.3v.4l.6.9,1.3.4,1.5,1.5-.7,2-1.3.8v.6l.5,1.6,1.6.8,1.2,3-.7,2.1-1.1,1.2.4,1.1.5.2.4.8-.5.4v1.1c.1,0-.3,1.5-.3,1.5l.3.4.6.2.4,1.8.7.8-.5,1.3v1.2l.3.3.3,1,1.3,1.6v1.5l.5,1.4.4,2.4v1.1l-.5,1v2l.4,1.7v1.4l.7,1.9v2.2l.3.6v1.6c.1,0-1.6-.1-1.6-.1l-1.1.7h-1.3l-1.8.4-3.6-.5-8.5.3v.3h-.4c0,.1.2.3.2.3l-.6.5h.1c0,.1-.2.4-.2.4l-.2-.3-.3.7h-.3c0-.1.3.1.3.1l-.5.4.2.2h-.4l.2.2-.4.2v.3c.1,0-.2-.2-.2-.2v.3h-.7v.3c-.1,0-.9-.2-.9-.2v.3h-.2l-.3.2-1-.2v-.4h.3l-.5-.4v-.3h-.6l-.2.2v.4h-.3v-.7c.1,0,.3-.2.3-.2h-.4c0-.1-.3-.5-.3-.5h-.4v.5-.4c-.1,0-.5-.2-.5-.2v-.2l-.3-.3-.3.2v-.3c-.1,0-.2.1-.2.1l.2.2h-.3v-.5c-.1,0,.2,0,.2,0l-.4-.2v-.3h-.3v-.5c-.1,0-.5-.1-.5-.1l.2.3h-.3v-.3c-.1,0,.1-.2.1-.2h-.2l-.2.4-.2-.3h-.3l.3.4h-.3c0,.1-.4,0-.4,0v.2c-.1,0-.6-.1-.6-.1l-.3.2v-.2c-.1,0-.2.5-.2.5l-.3.3-.3-.2v.2c-.1,0-.3-.2-.3-.2v-.4h-.8l-.2.5.4.2.2.4-.4.2.4.6-.5.5h-.3v.4l-.4.5.2.8h-.2v1.1l-.5.4v.3c-.1,0,0,.3,0,.3h-.2v.3l-.8.7.5.5-.4.3-.2,1.1h-.2v.4c-.1,0,0,.2,0,.2h-.4c0,.1-.3,2-.3,2l-.8.6-1,.4h-1.5v-1.2l-.3-.3-.9-.3-.2-.6-2.9-.3-.9.2-.9-1.3-.8-.3-.4.2h-.7c0-.1-1,.4-1,.4l-.9-.2-.8-.6h-.7c0,.1-.3.7-.3.7l-1.3.3h-.8l-.2-.4-.6-.2-.6.2-.3-.4-.4.3.2.6-.2.3-.7.7h-.5l-.8.2-.8.9h-.5l-.3.5.2.5,1.4,1.3.3,1.2,1,.5h.9l-.3.4-.2,1,.5.8-.3.8.5,1.4,2.3,2.1-.5,1.4v.9l1.2,4-.5.4-.4.7-.7-.7h-1.2c0,.1-.8-.6-.8-.6v-.8l-1-.2-.2-.6-.4-.2h-.5c0,.1-.7,0-.7,0l-.7.7v.6c-.1,0-1.1.1-1.1.1l-.2.3h-1l-.3-.3v-1.3c.1,0,0-.2,0-.2h-2.8l-1-.4-3.2.4-.6.4-.7-.5-.2.4h-.2l-.4-.5-.3-.4v-.3c-.1,0-.2-.3-.2-.3l-.4-.4-.3-.2h-.4l-.2-.3v-.4c-.1,0-.5-.2-.5-.2l-.2-.5v-.4c-.1,0-1-.5-1-.5v-.2h-.8v.2c-.1,0,.1.6.1.6h-.8c0-.1-.4-.3-.4-.3h-.9c0-.1-.9.2-.9.2l-.5-.4h-.9l-.2.4h-.4c0-.1-.7,0-.7,0l-.3.4v.7l-1.8.7-1-.2v-.4l-1-1.8-.5-2-.5-.2v-.6l.3-.3v-1c-.1,0,.7-1.1.7-1.1v-1h.7l.2-.4,1-.9,1.2-.4v-.6c.1,0-.2-.5-.2-.5l.4-.7.3-.4v-.4c.1,0-.2-.2-.2-.2l-.4-.7v-.3l.3-.8v-.5c-.1,0-.6-.5-.6-.5l-.2.4h-.3v.4c-.1,0,0,.3,0,.3v.6c-.1,0-.8.2-.8.2l-.4.9h-.3l-.2-.2-.2.4h-.4l.2-.6-.3-.4.2-.5v-.4c-.1,0,.4-.7.4-.7v-1.4l-.4-.6.2-.3-.3-.2v-.7c.1,0-.7.4-.7.4h-.4l-.7-.7.2-.3v-.5h-.7l.6-.7-.3-.2h-.4c0,.1,0-.2,0-.2l-.4-.3v-.3l-.3-.3v-.4l1.1-.3v-.4l-.3-.4h-.8c0,.1-.5-.2-.5-.2h-.6l-.2-.4v-.6l.6-.3v-.4l.3-.3-.3-.8.6-1.2-.9-1-7.2-1.9-4.8-2.9-1.7-.8-2.1-.6-2.7-1.3-1.9.5h-1.2l-1.4.8h-1.1c0,.1-2.6,1.2-2.6,1.2l-2.2,1.4-.2.6-.3.5v1.2c.1,0,0,.5,0,.5l-.5.4-.6,1.5h-.7l-.3.4h-1.7l-2.4-.9-.3-.5-.8-.4-.8-.3-.6-.8-1.1-.3,1.7,1.7-2.2-.8-.6-1.5.4-.6.6-.2h.3c0,.1-.4-4-.4-4l-5.1-2.5-15.3-6.8-1.4-3.4,2.4-2.9v-1.7l.7-1.2.5-.6h.8c0,.1-.2-.6-.2-.6l.6-.3v-.5l1.1-1.2.2-.8,2.1-2.1-.2-.6.2-.3.8.2.4-.4-.2-.4.2-.3.7-.2h1c0-.1.4,0,.4,0l.5-.8.6.2,1.1-.5.9-.7,1-.2.5.2.9-.5,1-1.7-.2-.7.4-.7.2-.3.4-.2.4-.7.9-.9h.5l.5-.3,2-2.8h1.6l.5-.6v-.5l.4-.6h.6c0-.1.2-.6.2-.6l.3-.2v-.4l-.8-.5v-1.6l.2-.7.5-.3h.6v-1.6l.4-2.4v-3.9l.4-1.3-.3-1.4.7-2,.5-.7,1.2-.2,1.1-.9,4-1.4.8-1.9.7-2.4,4.3-.8,3.5-1.2,2.1-.9,1.7-1.1h.6c0-.1,1.6-1.5,1.6-1.5h.5c0-.1,1.1.1,1.1.1l.6-.6,1-.3h.4l.2.3,1.2-.4.5.4.2.5.7.3,5.7-.7,1.6.3,3.2-.4h.6c0,.1.9,1.9.9,1.9v.8c.1,0-.9,3.4-.9,3.4l-1,1.1v1c.1,0-.7.8-.7.8v1.2c.1,0-.2,1.3-.2,1.3l.3.7v1.9c.1,0,1.2,1.1,1.2,1.1v1.6l1.4,1.7v.6l.4.9,1,1,1.4,2.1,1.8,1.8,2.1.3,2.9-1.8,5.2-4,5.4-2.9,3.1-2.3,1-.9.8-1,1-2.3,1.3-1.7,4.4-2.8,3.1-1.1.9-.6,6.3-6.9.8-1.4.6-.5,3.9-2.1,4.7-1.7,3-1.9,4.2-1.2,1.3-1.6,1.2-.6h.1Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="KampongThom-2" data-name="KampongThom" class="cls-7" d="M299.07,218.1l.3-.2.3.3v.2s.4.2.5.2v.4-.5h.4s.3.4.3.5h.4s-.2.2-.3.2v.7h.3v-.4l.2-.2h.6v.3l.5.4h-.3v.4l1,.2.3-.2h.2v-.3s.8.2.9.2v-.3h.7v-.3s.3.2.2.2v-.3l.4-.2-.2-.2h.4l-.2-.2.5-.4s-.3-.2-.3-.1h.3l.3-.7.2.3s.2-.3.2-.4h-.1l.6-.5s-.2-.2-.2-.3h.4v-.3l8.5-.3,3.6.5,1.8-.4h1.3l1.1-.7s1.7.1,1.6.1v-1.6l-.3-.6v-2.2l-.7-1.9v-1.4l-.4-1.7v-2l.5-1v-1.1l-.4-2.4-.5-1.4v-1.5l-1.3-1.6-.3-1-.3-.3v-1.2l.5-1.3-.7-.8-.4-1.8-.6-.2-.3-.4s.4-1.5.3-1.5v-1.1l.5-.4-.4-.8-.5-.2-.4-1.1,1.1-1.2.7-2.1-1.2-3-1.6-.8-.5-1.6v-.6l1.3-.8.7-2-1.5-1.5-1.3-.4-.6-.9v-.4l.7-1.3v-.6s-1.8-5.1-1.7-5.1v-.3s.4-.2.5-.2v-.9l.4-.7v-.6l.6-1.8v-.8l-.8-.7-.4-1.1-2-1.1-.2-.8-.6-.3-.5-2.8s-1.1-2.8-1-2.8v-2l-.2-2-1.8-1.9-1.9-.8.2-1.8-.2-.4.2-.6s-.2-.9-.1-.9v-1.2l-.3-1.1.3-.9-.4-2,.6-2v-1.9l-.5-1.3v-1.6l-.8-.7v-.4h-.1l-1.2.6-1.3,1.6-4.2,1.2-3,1.9-4.7,1.7-3.9,2.1-.6.5-.8,1.4-6.3,6.9-.9.6-3.1,1.1-4.4,2.8-1.3,1.7-1,2.3-.8,1-1,.9-3.1,2.3-5.4,2.9-5.2,4-2.9,1.8-2.1-.3-1.8-1.8-1.4-2.1-1-1-.4-.9v-.6l-1.4-1.7v-1.6s-1.1-1.1-1.2-1.1v-1.9l-.3-.7s.3-1.3.2-1.3v-1.2s.8-.8.7-.8v-1l1-1.1s1-3.4.9-3.4v-.8s-.9-1.8-.9-1.9h-.6l-3.2.4-1.6-.3-5.7.7-.7-.3-.2-.5-.5-.4-1.2.4-.2-.3h-.4l-1,.3-.6.6s-1.1-.2-1.1-.1h-.5s-1.6,1.4-1.6,1.5h-.6l-1.7,1.1-2.1.9-3.5,1.2-4.3.8-.7,2.4-.8,1.9-4,1.4-1.1.9-1.2.2-.5.7-.7,2,.3,1.4-.4,1.3v3.9l-.4,2.4v1.6h-.6l-.5.3-.2.7v1.6l.8.5v.4l-.3.2s-.2.5-.2.6h-.6l-.4.6v.5l-.5.6h-1.6l-2,2.8-.5.3h-.5l-.9.9-.4.7-.4.2-.2.3-.4.7.2.7-1,1.7-.9.5-.5-.2-1,.2-.9.7-1.1.5-.6-.2-.5.8s-.4-.1-.4,0h-1l-.7.2-.2.3.2.4-.4.4-.8-.2-.2.3.2.6-2.1,2.1-.2.8-1.1,1.2v.5l-.6.3s.2.7.2.6h-.8l-.5.6-.7,1.2v1.7l-2.4,2.9,1.4,3.4,15.3,6.8,5.1,2.5s.4,4.1.4,4h-.3l-.6.2-.4.6.6,1.5,2.2.8-1.7-1.7,1.1.3.6.8.8.3.8.4.3.5,2.4.9h1.7l.3-.4h.7l.6-1.5.5-.4s.1-.5,0-.5v-1.2l.3-.5.2-.6,2.2-1.4s2.6-1.1,2.6-1.2h1.1l1.4-.8h1.2l1.9-.5,2.7,1.3,2.1.6,1.7.8,4.8,2.9,7.2,1.9.9,1-.6,1.2.3.8-.3.3v.4l-.6.3v.6l.2.4h.6s.5.3.5.2h.8l.3.4v.4l-1.1.3v.4l.3.3v.3l.4.3s0,.3,0,.2h.4l.3.2-.6.7h.7v.5l-.2.3.7.7h.4s.8-.4.7-.4v.7l.3.2-.2.3.4.6v1.4s-.5.7-.4.7v.4l-.2.5.3.4-.2.6h.4l.2-.4.2.2h.3l.4-.9s.7-.2.8-.2v-.6s-.1-.3,0-.3v-.4h.3l.2-.4s.5.5.6.5v.5l-.3.8v.3l.4.7s.3.2.2.2v.4l-.3.4-.4.7s.3.5.2.5v.6l-1.2.4-1,.9-.2.4h-.7v1s-.8,1.1-.7,1.1v1l-.3.3v.6l.5.2.5,2,1,1.8v.4l1,.2,1.8-.7v-.7l.3-.4s.7-.1.7,0h.4l.2-.4h.9l.5.4s.9-.3.9-.2h.9s.4.2.4.3h.8s-.2-.6-.1-.6v-.2h.8v.2s.9.5,1,.5v.4l.2.5s.4.2.5.2v.4l.2.3h.4l.3.2.4.4s.1.3.2.3v.3l.3.4.4.5h.2l.2-.4.7.5.6-.4,3.2-.4,1,.4h2.8s.1.2,0,.2v1.3l.3.3h1l.2-.3s1-.1,1.1-.1v-.6l.7-.7s.7.1.7,0h.5l.4.2.2.6,1,.2v.8s.8.7.8.6h1.2l.7.7.4-.7.5-.4-1.2-4v-.9l.5-1.4-2.3-2.1-.5-1.4.3-.8-.5-.8.2-1,.3-.4h-.9l-1-.5-.3-1.2-1.4-1.3-.2-.5.3-.5h.5l.8-.9.8-.2h.5l.7-.7.2-.3-.2-.6.4-.3.3.4.6-.2.6.2.2.4h.8l1.3-.3s.3-.6.3-.7h.7l.8.6.9.2s1-.5,1-.4h.7l.4-.2.8.3.9,1.3.9-.2,2.9.3.2.6.9.3.3.3v1.2h1.5l1-.4.8-.6s.3-1.9.3-2h.4s-.1-.2,0-.2v-.4h.2l.2-1.1.4-.3-.5-.5.8-.7v-.3h.2s-.1-.3,0-.3v-.3l.5-.4v-1.1h.2l-.2-.8.4-.5v-.4h.3l.5-.5-.4-.6.4-.2-.2-.4-.4-.2.2-.5h.8v.4s.2.2.3.2v-.2l.3.2.3-.3s.1-.5.2-.5v.2l.3-.2s.5.1.6.1v-.2s.4.1.4,0h.3l-.3-.4h.3l.2.3.2-.4h.2s-.2.2-.1.2v.3h.3l-.2-.3s.4.1.5.1v.5h.3v.3l.4.2s-.3,0-.2,0v.5h.3ZM299.07,218.1v-.3c-.1,0-.2.1-.2.1l.2.2Z"></path>
      <path id="Kampot" class="cls-2 region" data-region="kampot" d="M173.67,347.3l1.4.7.9,2,1.4,1.7.9.7,1.9.7h3c0,.1,4.5-1.1,4.5-1.1l1.3.2.5-.2.4-1,.2-.2v.2c.1,0,.6-.3.6-.3l.4-.6v-.7l1.1-.9h.4l.5.2h.4c0-.1.7,0,.7,0l.5.4.2-.3h1.6c0-.1.2-.6.2-.6l.5-.3.3-.4,1,1.2h.2c0-.1,0,5.7,0,5.7l.9-.5h1.1l.7.7,1.6.5v1.2l.6-.6.7.6,1.9-1.4v1.1h1.1c0,.1,2.2,3.4,2.2,3.4l1.5,3.6.3,2.3-.2,1.3v2c.1,0-1.6,3.5-1.6,3.5l1.3.7h2.6c0-.1,2.1,0,2.1,0l3.2-1.6h.6c0,.1.6-.2.6-.2h2.6c0-.1,1.5.6,1.5.6v.4h.4l.9,1.4.9,1.8.9,2.2v.5l-.3.2v1.9c.1,0,.3.3.3.3v.2c-.1,0,1.4,1.6,1.4,1.6v.6c.1,0,.5.3.5.3l-.3.4-1.9,1.1-.2.9-.3.2v.7l.3.7h-.3l-.2.7-1,1.1-.5,1.4-.6.3-.4.7.4,1.2v3.1c-.1,0,.3,1.5.3,1.5l-.3,1.4,3.1.2.4.2v1.2c.1,0-.3,1-.3,1v1l.6.6v3c-.1,0,0,.6,0,.6l.6.6-.6.5-1.8-.6-4.6-.3v1l-2.8.2-1.4-.6-1.2.3-.2.3v1.4l-.4.8-2.2,1.1-.2,1.9-.6,1.6-.8.8-1.5.2-.7,1.9-2.2,2-1.8-2.4-1.5.2-2.3.6-1.2-1.1v-.5l-.4-.2h-.6l-.2-.4h.3c0,.1.7-1.2.7-1.2h-.3c0-.1-.3-.7-.3-.7v-.5l-.3-.4h-.3c0,.1-.2.3-.2.3l-.4.4-.5-.3v-.5h.5c0,.1.3-.8.3-.8h-.5l-.4-.3.3-.6h.6l-.3.3.5.4.9-.3v-.3l-.6-.5.4-.3-.2-.6h-.4v-1.1h-.4l-1-.6-.5-1.1-1-.7v-2.5l-.5-.7h-.4l-.2.6-.4-.6v-.2h-2.2l-.9.3-1.6.2-2.5-.3-1.7-1.4-.4,1.7v1.1l-.6.5.3.4-.2.4-1.1-.8-.3-.7-.7-.6-.5.3h-1c0,.1-1.4-.3-1.4-.3h-.1c0,.1.5.7.5.7v.5c-.1,0-1.5-.2-1.5-.2l-1.6,1.1-.3.4v.4l-.3.2-.2-.4-.8-.2-.2-.6v-.6c.1,0,0-.6,0-.6l-.2-.5-1.4.9-.7-.4h-1l-.6.6h-.7l-1.8,1.1h-2.3c0-.1-2.7-.3-2.7-.3l-.7-.5h-.7l-.8-.6h-1c0-.1-1.2-.8-1.2-.8l-1-.3-1.9-1-1.3-.5h-2l-.9-.8-.9-1.2.4-.3v-.2l.9-.2h-.2v-.3h-.2l.2-.3h.4v.4l.2-.3h.2l.2.5.5-.7h.6l.3-1.7.9-1.9.2-1.1-.4-1.1v-1.5l-.6-1-1.1-.4-2-3.4-.3-2.1,1.2-1.1v-.8c.1,0,0-.5,0-.5v-.9l1.2-1.9-.8-1.5-1-.8-.4-.6v-.7l.9-.4-.2-.4-.8-.4-.4-.4.5-.9.2-1.1.2-.2h.5v-.2c.1,0,0-1.6,0-1.6l.3-.5v-1.4l-.4-.4-1.1-.3v-.2c.1,0-.3-.5-.3-.5v-.3l1.6-.7.5-.7,3.3-2.2,2.2-2.6h2.1l.5,1,2.3-.4,1.2-.9,1.4-.6.2-1.3-1.4-1.5v-.3l1.3-.6.4-.6-.7-3.4v-3.9c.1,0-1.6-2.2-1.6-2.2h2.6c0-.1,6.5,1.8,6.5,1.8v.1Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="Kandal" class="cls-2 region" data-region="kandal" d="M230.37,281.6v-.3c.1,0,.8-.2.8-.2l1.1.3.8-.3.3-.5h.4c0,.1.9-.3.9-.3l-.6-1-.5-.3.2-.5-.3-.4.3-.6-.8-1.4.8-.6.7.7.6-.8,2.3-.6,1.1.8,1.5,1.7-.5,2.5.2.6-.3,1,.2.2,1.8-.2v-.7h.3l.6.5h.4l.3.3v.2l.4.2.6.2.5-.6.3.3h.3l.9.7.3.7h.6c0,.1.8-.1.8-.1l.2-.8.7-.6.3-.6.8-.3.3-.7v-.2c-.1,0,.1,0,.1,0l.2-.4-.2-.6.9-.9v-1.1h.4v1.2l.5.5,1.1-.7,1.1-1.6h.5c0,.1.3.6.3.6h.3v.8l.6.8v.3l3.3.5.9,1.7,1.6,1.5v.8c.1,0-.5.6-.5.6l-.7.2-.3.8-.4,1.7.2.6v1.6l3.7.2.8,1.3.5.2h.5l.5-.5.8-.2,2.2.7h1.6v.3l-.5.4.3,1v.9c-.1,0-.9.2-.9.2v.6h-.9c0-.1-.4.1-.4.1l-.5.9v1.2l-.7.7.2.6.7.4v.7c.1,0-1.9.9-1.9.9v.8l-.5.4-.3.5v.4c.1,0,.9.7.9.7l-.2.3.2.6v.7l.5,1.2-.2.6-.2.5v.3l.8,1.6.2.2h.5l.4.3-.5.2v1.1l.8.6.7.2.8-.4h.6l.8.3.8.8.8.2,1.4-.5.6,1.4.6.5v.5c-.1,0,.2.9.2.9l.4-.2,1,.5v1.2l.7.5.6.4.4.2v.5l1,.5.7-.6.7.8.8-.9.8.9-.4.7.4.5h.4v.8l.5.5-1.3,1.5-2.6,1.8.4,3.2,1,2.4.3,1.2.7,5.3v1.5l-1.8,4.8-1.6,1.4v2.6l-1.1,3-1.1,1.5-1.8,1.5-1,1.2.2,5.9-.5,2.5-.2,2-.5,1.3v1.2l.5,4.3h-.8l-2.5-1.1-4.7.4-.3-.3v-.5c.1,0,1.5-2,1.5-2v-1.3c-.1,0-.6-.2-.6-.2l-1.4.5h-1.3l-.3.2-.2,1.7-1.1-.2-1.3.7-.4.5.3.9-1,.4.2,1.1-.7.4-.4-1,1-1.9-.4-.9v-1.1c-.1,0-.7-1.3-.7-1.3v-2.8l-3.4-.7-.5-.9.7-2.1-.5-.8.6-1.3-.3-.5v-.2h.5l.5-2,.4-.6v-1.1l.7-.5v-1.1l.2-.6-.4-.6.4-.3-.3-.8.4-1.4-.2-.7.6-.2v-.2l-.3-.2-1,.4.2-.6h.3l.2-.3-.2-.5h-3l-.7-1,.5-2-.4-1.7-3.8-2-.7-.9-.6-1.9.9-1.7.3-1v-2.9l-1.1.3-.8-.4v-.4l-1-.9h-.7l-.9-.6-.6.2-.4-.2v.2h-.8v-.5h-1.2c0,.1-1,.9-1,.9h-.5c0-.1-1.2,0-1.2,0l-.6-.3-1.3-.3-.7-.4h-.8l-2.8.7-1.4.9-2.2-1.4,4.8-5.2,1-1.6v-.4h-.3c0,.1-.3-.1-.3-.1v.8l-.2.2h-.4v-.2c-.1,0,.3-.5.3-.5h-.3v.2h-.7c0-.1.4-.8.4-.8l-.3-.3v.4l-.6.6h-.4v-.6h-1l-.4.2-.8-.2h-.5c0-.1-.6-1-.6-1l-.6.3v-.4h-.3c0-.1-.4.4-.4.4l-1.3.5h-.5c0-.1-.1-.7-.1-.7h-.6c0-.1-.2.5-.2.5l-.4.2-.2.5h-.4l-.4-.4h-.5c0-.1-.6-.8-.6-.8l-.6-.2.6-3.8v-2l.3-.5,1.4-5.9-.2-3.4.9-4.5,1.1-3.6,1.9-3.4.9-2,2.3-6.6v-2l-1.4-.5h.1l.7.6ZM238.87,298.6v-.5c.1,0-.2,0-.2,0l-.2-.3h-.4v.5l-.2.2-.4.3h-.2c0-.1-.5.1-.5.1l-.2.2.3.7-.5.4-.5-.2-.2.3.4.9h-.3l-.6.7v3.8c-.1,0-.1.7-.1.7v.3l-.3.5v1.2c-.1,0,.1.3.1.3h.9v.6c.1,0,.6,1,.6,1l1.2-.2.7,1.5v.8c-.1,0-1.9.1-1.9.1l-.8.5-1,4.6v.7l.6.4h.5c0,.1.4.4.4.4l.7.9h1c0,.1.4-.4.4-.4l-.4-.2.5-.5.6.4h1c0-.1.6-.6.6-.6l.5-.6.6-.2h.5v-.3c.1,0,.5-.2.5-.2v-1.2l1.1-.6h.5l.7.6v.5h.7v.4l.4.5h.4c0,.1.3.6.3.6l.8.5.4-.2v-.2c.1,0,.2-.1.2-.1l-.4-1.5.3-1.7,2.4-.9,1.3.2,1-.6.4-.4-1.5-3.7v-1.3l-1.3-.9-.3-2.8-2.3-6.1.5-1.7h-6.3l1,1.3-2.5,1.8-.2-.8h-.3l-.6.2-.5-.5v-.2h.1Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="KohKong" class="cls-2 region" data-region="koh-kong" d="M70.07,314.2l-.4-.3h-.4c0-.1-.8-.3-.8-.3l-.5-.5v-.4l-.7.2.7,2.4,1.1.2h1.4v-.4l.4-.3v-.4l-.9-.2h.1ZM69.37,320.7l.3.5v-.4l1-1.6-1.6-.4-.5.4.3.6h.3c0-.1.6.2.6.2v.5l-.4.2ZM70.37,316.3v-.5h-.3c0-.1-2-.1-2-.1l-.4-.4c0-.1-.3-1.1-.3-1.1v-.5h-.5c0,.1-.5-.1-.5-.1h.6l.2-.3-.8-1-1.1,1.1v-.4l.5-.5.2-.2-.4-.7v-1c0-.1-.6.1-.6.1v.4l-.3-.4-1.3.4-.9.7-.3.9.3.7,1.8,2.2,1,1.8v1.8l-.4.8.2.9.5.3.3-.5h.2c0,.1,1.1-.7,1.1-.7l.8-1.1.3-.3h.2c0,.1.7-.2.7-.2h1.1l.4-.3v.4h1.1l.2-.2.4-.4-.3-.3h.8c0,.1.9-.1.9-.1l.3-.3-.2-.2.6-.5h-.4l-1.1-.7-.4.2-.3.3-.6-.2v.9l-.2-.4-.4.2-.5-.5h-.4.2ZM67.17,330.9l.3-1.4-.7-.4-.6-.9v-.8l.6-2-1-2.1v-.8l-.6-.9-.4-.3h-1l-.6.5-.2.4-1.1.3v-.5l.2-.5h-.4v-.4h-.3l-.5.7-.5,1.9,1,2.4-.6,1.5.3.5h.2l.9,3.2-1,1.2v.4h.3v1.9l.2.4h-.5v.4l.9.5.2.9-.3.2v.3l.5-.2h.4c0,.1.2.5.2.5v.4l.6-.4.4.6.6.2.8-.6.2-1,.7-1.2-.3-.4v-.3l.6-.4.5-1.1v-1.2l-.4-1.4h.4v-.1ZM53.17,466.9l-.4-.9h-.2l-.4-.2-.3.2.2.6,1.4,1.1h1.1c0-.1-.8-.7-.8-.7h-.7.1v-.1ZM173.67,347.3l-1.2-1.8-1.5-1.6-1.4-2,.2-1.4-.7-1.1.2-.9-.2-.6-.5-.4v-.8l-.3-1.1.5-.9v-.4c-.1,0,.9-1,.9-1v-1.7c.1,0-.2-.6-.2-.6v-.7c.1,0-.8-1.6-.8-1.6l-.8-2.2-1.5-.4-1.9-1.6.3-1.5-.9-1.4v-1.1l-.3-.7.5-.6v-.7c.1,0,1.4-.6,1.4-.6l.3-.5-.4-2.2-.6-1.3-.7-.2-.7.3-.8-.5h-.5c0-.1-.7-1.5-.7-1.5l-1.5-1.4h-.5l-1.5.6-.3-.4-.9.2-1.1.8-.5-.3-.4.3h-1l-.5-.4-.6-1.4h-1v-1.1l-.5-.6-.7-.3-1.5-.2-.6-.9h-.5l-1.3-.7h-.3c0,.1.3-.5.3-.5l-1.2-1h-.6l-.2-.5h-.4l-.5-1.2-.6-.2-.8-.9-2.3-.5.2-2.9.6-1.2v-1.2l-.5-1-.7-.8-.8-.5-.4-.6-.4-1.3.2-1.7.5-.6.2-.6-.9-1.8v-.5l1.8-1.2v-.5c.1,0,.1-1.2.1-1.2l-.7-.3-.2-.4-.3-2.2v-.6l.4-.5v-.6h.3c0-.1,1.8.9,1.8.9l1.5.2.6.3h1.1l.9-.6.9-.2-.9-1h-.6c0-.1-.4-.7-.4-.7l-.3-1.2-.5-.7-1.5-1.5v-.6l-.6-.8-.4.2-.4-.3-.3-.5v-.7l-.9-.8h-1.3l-.5-.3-.6.8h-.7l-.9-.6-.7-.8-1.9,1.2-1.1-.4-.2-.5-1.3-.5.6-.5-.3-1.6-.4-.2h-1.8l-.8-.7-1.1-.3-.2-.4h-.3v-.5l-.6-.3h-.7l-.3-.5-.6-.3.8-.7v-.4l-.2-.7-2.1-.6-.7-.4-.4-.9-.6-.6h-.4c0-.1-.7-1.3-.7-1.3l-1.1-.3-.3-1h-.4c0,.1-.4-.4-.4-.4l-1-.4-.2-.3-1-.6v-.3l.4-.2-.3-.4-.7-.4h-.7c0,.1-.3-.2-.3-.2l-1.2-.4-1.6.7-.6-.9h-.3l-.6-.8h-.5l-1.1,1.5h-.4c0,.1-.6.6-.6.6l-1.1.3-.3.4-1.2-.6v-.3h-.6l-.2-.6h-.9c0-.1-.3-.6-.3-.6h-.8l-.9,1.2.2.4-.3.3.4.8-.2.5.4.4-.3.2h-.6c0-.1-.9.8-.9.8h-.3l-.4,1.7.2,1.4-1.5.3-.9.7h-.7l-.5.9-.4.2v.6l-.9,1.6h-1.5v.4l-.5.2-1.8-.9h-.3l-.5.5-.6.2v.4l-.3.5h-.7v-.3h-1.4c0,.1-.2.7-.2.7v.6l-.5.6-.4-.3-2-.3h-.4c0,.1-.9,1.1-.9,1.1l-1,.4h-.3c0-.1-1.1.5-1.1.5l-.7-.4-1.4.4-2.3-.3-9.2-4.1-2.1-.8-2.3-.5-16.8-1.1-1.8-.8-.3.8.4,2.2.4,1.2h.5c0,.1.5,1.5.5,1.5v.4l.3.8.8.4.7,1.1-.3,1,.5,1,.4.5-.2,1.5.5,1.9.8,1.7,1.1,1.1.3,1.1.6.9h.7l.2.7v.3l.2.7,1.8.8-.3.8,1.1.4,1.1,1.7.7,2.2v6.4l.2,2-.2,1.1,1,2h.4c0-.1,1,1.6,1,1.6l.2,1.1h-.5l-.2.4v.4l.2.7h.2c0,.1.3-.2.3-.2h.2l.8,1.7.6.5h.2c0-.1.8-2.9.8-2.9l-.2-.7.2-1.6-.5-.5-.2-.5-.3-.5.4-.2v-1.2l-.3-.3v-1.6l-.3-.2.6-1.1v-1.3l-.2-.5.7-.9.2-1.3-.4-.6-.9-.6.2-.7,1.6,2.1-.5,1.5h1.4c0,.1.2.3.2.3l-.4.7-.6.4-.3,1-.9.8-.2,1.5.5,1.1-.2.4.4.4.3.6.3.2.3-.7-.2-.9.6.4.2-.9.3.3.5.4.5-.4.5.4.8,1.1v.7h-.5l.2-.5v-.4l-.6.3-1.2-.6-.7.2-.5,4.4-.7,2,.4.5,1,.7-.6.3v-.3l-.8-.8h-.5l-1.2,1.6.5,1.2,1.4,1.6h.5l-1.1-1.2h.5l.5.5,1.3.4.2-.4v-.5l.4-.4v-1.3l.4.5v.5h.7c0,.1,1-.4,1-.4h1.8l.2-.4-.3-2.5v-.7l.2-.8v1.5l.3.3.2-.6.3.5-.6.8.3,1.2h.5l.2-.7h.2l-.6,1.3-.2-.4h-.3c0,.1.2,2.1.2,2.1l-.2.6.3.6.2.2v.2l1.5-.4-1,.6.2,1,1.8.3v.5h.7l.7.7v.5h-.4v.2l.9.2.5-.2,1.4.8.8-.2,1.1-.8.2-.6-.4-.9,1.1.5.5.5-.7,1.1-.2,1,.7.4.2.5.4.8-.8-.5-.8-1-1.4-.3-2.1,1.7-1.4.8.5.2v.2l-.4-.2-.5.2-.4.7v.6l.4.5.2-.7,1.3,2.2h-.3c0-.1-.2.4-.2.4l.4,2.9.5,1.4.7.3.3.5h.2l1.1-.6h1.2c0-.1.3,0,.3,0l.2.3-.3.6,1.5,2.4-.2,1.4.4.4v.3h-.6c0-.1-.2-.7-.2-.7v-1.6l-1,.6-1.3-.6v.9l-.7.4h-.5l-.2.6h-.4l-.8-.2.3.8-.4,1.1.6.8-.3.4h-.3v.4h-.3c0,.1.2-.6.2-.6h.4l-.6-.6v-.7h-1.9l.6,1.5v.5l-.5.4h-.4l-.2.5.4.6.2,1-1.3.4v.5h-.6l-.2.5h-.3c0,.1.7.9.7.9l1.3-.7h.7c0-.1.3.1.3.1l.9,1.2.5,1,1.5,4.6.5.4h-.2c0,.1.4,2.2.4,2.2l.2,2.5-.6.4v.8l-.4.7-.7.2-.5-.7-.5.5.8.4v2.2l.4.7.7,2.5v5.6l-.8.5-.4.9.2.4-.3.8.3,1.8,1.4.7.9.8.8,1.1v1.3l-.3.4h-.6l-.4-.4v.2l.5.6,1.9.8.4-.4v-.7h.8c0-.1.7.3.7.3l1,1.1.9.2-.3-.6.3-.6,2.3-.9.6-.2-.2-.3.7-1h.5l.5-.2v-.8l1.1-.4.4-.9,1.4-.5h1.8c0,.1,0-.2,0-.2h.2l.7.4-.2.3v.3l.9.2h.7c0-.1.7.2.7.2l.4.4.9.5.4-.2,1.2.7,1.1,1.4v.3l.2.5-.2.6.4.3.4-.8,1-.7h.7c0-.1,1,.5,1,.5l.5-.5,1.1-.5.3-.5.2-.3h1.6v-.4l-.4-1.3v-1.6l-.7-1.6-.2-1.7.4-1.3.7-1,.4-2.1,1.2-2.3v-.6l.6-.8.3-2.8,1.6-1.5.3-1.3-.2-.4h-.3l-.8.4-1,.2h-.4c0-.1.5-.6.5-.6l1-1.3.8-.5.6-.9.2-1,.5-.6v.3l.7-.2,1.5-1.5,1.2-.6h1.6l1.5.2h.7c0-.1,0,.9,0,.9l1.6,2.1.8,1.9,1,1.3.3.9,2,.8.5-.3h.8l2.5,1,.5-.2v1.1l1,.6,1-.4.5-.4.6-1.7.9-.7.6-.8.6-.3.4-.6.4-.2.4-.6,2.4-.9h.9l.4-.5,1-.5h.2c0,.1-1.2,1.3-1.2,1.3h-1.7l-2.3,1.4-2.7,3.1-.4.8h1l.3.3-.4.2v.3c-.1,0-.5-.3-.5-.3l-.2.5-.8.3-.4-.2h-1.7l-1.3.8v.3l1.4,1.8.2.8-.3.6.5,1-.2.5-.5.4,2.5,3.5v1.1c.1,0,.7.6.7.6l1.2,2.9.8,3.9v2.2l-.3,1.4-.7,1.3-1.5.4v.4l-.6.6h-.5v.8c-.1,0-.4.3-.4.3v1.9c.1,0-.4,1-.4,1h-.7l-.2.4.4.5.2,1,2.4.6,3.3-3.4,3.6-4.3.6-1.1.9-4.6,1.2-3.3,1.6.9,1.3.4,9.2-4.6.3-.4v-.3l1.6-.7.5-.7,3.3-2.2,2.2-2.6h2.1l.5,1,2.3-.4,1.2-.9,1.4-.6.2-1.3-1.4-1.5v-.3l1.3-.6.4-.6-.7-3.4v-3.9c.1,0-1.6-2.2-1.6-2.2h2.6c0-.1,6.5,1.8,6.5,1.8v-.2h.1ZM57.07,466.8l-.2-.3h-.4c0,.1-.4,0-.4,0l-.5-.9h-.4c0,.1.4.9.4.9l1.2,1.1h.4l.4-.3v-.4h-.5v-.1ZM59.17,422.9l-.3.5.4.2v-.4h.6l.5-.2-.8-.3h-.5v.2h.1ZM68.07,366.4l.4.2h.3l.2-.7h-.7l-.3.5h.1ZM90.27,394.2l.3-.9.8-.3.7.4.2-.4,1.2-.9.3-.7-.2-.6.3-.3-.7-.3-.3.7-.6.5-.8-.5.4-.6-.7-1.1-.6-.2-.5.4-.7-.2-.4.5-.4-.2v-.5h-.5l-.4-.8.4-.4v-1.5l-.7-1.1.6-.6-.9-.5h-1c0-.1-.5-.4-.5-.4l-.2.9-1.1.7h-.8c0-.1-1-.6-1-.6h-.4l-.5.6v1.1l-.7,1.6.5.5.6-.7.8.3v.8l.3.6-.3.6.9,1,1.4.3.7-.8,1.2.5.7,1.1.4,1,.2.8v1.8l.3.4h.4l.7-.8v-.7l.5-.5h.1ZM81.97,381.5l1.4-.4h-.2c0-.1-.6-.3-.6-.3l-.6.2v.5ZM79.67,434.7l.2.2.7-.5-.6-.3-.2.6h-.1ZM91.97,398.2v.3h.3l.4-.3.2-.3-.2-.3h-.5c0,.1-.2.6-.2.6ZM96.07,403l-.4-.2v-.5l-.2-.2-.9,1.7-1.1-.4-.6-.7v-.4l.5-.2v-.3l-.7-.5-.2-.3v-.3h.5l1.6-.4v-.5h-.4c0-.1-.3-.6-.3-.6l.2-.4-.5-.4-.7.7h-.5c0,.1-.6-.5-.6-.5l-.7.5-.7.9.6,2.2,1.1,1v1l.5-.2.3.3v.4h.4c0,.1.3.6.3.6v1l.5.3.8-.2.2-.8-.2-.9,1.4-1.4v-.5.2h-.2ZM71.77,372.3l-1.1-1h-.3v.5l-.3.4v.8h.6c0,.1,1.5.1,1.5.1v-.7h-.4v-.1ZM70.17,369.4l.4-.4v-.6l.5-.4v-.6l-.8.7v.6l-.4.4v.2h.3v.1ZM81.67,378.6l-.5-.6-1,.6h-.7l.6,1.1.5.3h1.2c0-.1.7-.5.7-.5v-.4l-.6-.2v-.3h-.2ZM70.27,363.9l-.4.7.2.3.2-.5h.7c0-.1.2-.5.2-.5h-1,.1ZM77.87,432l-.3-.6-.8-.9.3-1.1h.7c0-.1.3-.4.3-.4l-.2-.3-.7.2-.4-.2v-.3l-.3-.5-.2,1.1-1,.8.5,1,1.1.2.4.4.3,2.1.3-.5h.6l-.2-.5.3-.3h-.7v-.2Z" fill="#f3eae1" style="fill: rgb(243, 234, 225);"></path>
      <path id="Kratie" class="cls-2 region" data-region="kratie" d="M312.17,144.1h1.8l1.2,1,2.9.8.8.5h3.5l3.8,2.1.8.2.9.6.3.8,2.8,2,.6.2.4.9.7.5.9.4h.6l.7.2h.4c0,.1.4.3.4.3h.2c0-.1,1.7.9,1.7.9h1.2l.2-.4.7.3.4-.5h.6l.2-.4.9-.4v-.3l.7-.3.2-.4.5.2.8-.4h.8c0-.1.5-.6.5-.6l1.3-.4-.2-.8.4-.9.9-.9.4-.8v-.6c-.1,0,.2.1.2.1v-.3l.2-.3v-1.6c-.1,0,.2-1.7.2-1.7h.3c0-.1,1.3.3,1.3.3l2.1,1.2,1.3-1h.5c0-.1.2-.9.2-.9v-.8c-.1,0,.1-.1.1-.1l-.4-.9.4-.3v-.4c-.1,0,.6-.8.6-.8v-.3c-.1,0,.5-.6.5-.6v-.3h.5l.4-.4v-.5l.2-.5.9-.2v-1.2c.1,0,1.2-.5,1.2-.5l.2-1,.6-.8.6-.2.2-.8h-.2c0,.1-.3-.6-.3-.6l.4-.5,1.1-.5h.3l.2-.4h.4l.3-.3.9-.2,1.1.2.3-.4,1.5.5h.6c0-.1.3-.4.3-.4h.7c0-.1,1.4.2,1.4.2l.6-.2,1.6.8.4-.3,1.3.2,1.7-.8.3-1.9.4-.6.7.2,1.2-1.4,1.6.4.6-.2.7.4.4-.6.5-.2,1.6.7h2.6v1.5l.4.6-.3,1.6.4.6.3,1.4-.6,1.9v1.5l-.4,1.2v.8c.1,0,.6,1.3.6,1.3l1.4,2.3.4,1.6,2.9,1.4.8.7,1.5,1.8.6,2.2-.2.3-.9-.2h-.6c0,.1-1.4-.6-1.4-.6l-1,.4h-3.4c0-.1-.4,0-.4,0l-.5,1.2v.8l-.3.4-.2,1.2.2.5v.8l-.2.6.3.7v.3l.3.6,1,.5.5.7v.4l1.2,1.4.7,1.2,2.4,1.1v.9c.1,0,1.1,1,1.1,1v.3h.2v.2c.1,0,.7-.1.7-.1l1.5,1,.8-.4.8.3h.5c0-.1,3.1,1.9,3.1,1.9l3,1.4,2.2,1.3,2.5,1.6,2.3,1.9,1,1.4.3,1.3v1.5l-.4,2.8-.6,1.3-.9,1.1-4.9,4.4h-.4c0,.1-.5-.1-.5-.1l-.8.2-.2.3h-.5v.2l-.3-.2-.2.4-.8-.2v.2h-.4l-1.1.9-.6,1-.6.5-3.1,1.9-1.5,1.5-2.4,4.1-.4,3.3-3.4,8.4-.4,2.8,1.2,1.4,2.3,1,9.7,6.3h.8v-.2l.6.4h.3c0-.1.4,0,.4,0l.4.3.3.8.9.6,1,.2.5.6,1.4.4,1.5,3.6,1,3.1.7,1.3.8,1,1.1.4.7.5h1.3l1,.7h1.2c0,.1,1.6.8,1.6.8l2.5.4,1.6,1.2,1.6.5.6.4.5.9.7.5h.3l.6,1.6,1.5,1.7.5,1,.5.4.8,1.1-.6,1.5.4,1.1v.6c-.1,0-.6.6-.6.6l.4.8v.9c.1,0-.6,1.9-.6,1.9l.7,1.8v1.2c.1,0-.5.1-.5.1l-.2.7-.8.4v.6l-1.3,1.6v.7h-.6c0,.1-.3,1.2-.3,1.2l-.6.7h-.5v1.2l-.5.8-.3.5-.5.8-.7.6-.4.9-1.1.4h-1.1l-.4.4h-1.1l-.7-.9-.6-.3-.5-.6-1-.5h-.2v.6l-.3.2.4,1,.5.3v.3l-.3.2-1-.2-.3-.4.2-.3v-.2h-.5v.5h-.3v.8l-.5-.2v-.9l-.3-.2-9.4.6.2-.5.5-.2-.3-.2h-.4c0,.1-1.1-.2-1.1-.2h-.7l-.2.4h-.7c0,.1-.6.7-.6.7h-.4l-.6-.2h-1.4c0-.1-.4-1-.4-1l-.9-.6-1.3.2-.9.9v.4h-1c0,.1-1-.1-1-.1l-1.1-.4-.2.6h-.5c0,.1-.1.5-.1.5l-.5.2v.5l-.7.6-1,.2-.3-.4-.5.4-.4.2-1.4-.9-.7-.2h-.6l-.4-.2h-.4c0-.1-.5-.2-.5-.2h-.3l-.2.2h-.8l-.2.5h-.8c0,.1-.2-.3-.2-.3h-.4v.4l-.2.2h-.9c0-.1-.7-.1-.7-.1h-.4l-.3.3h-.3l-.4-.4h-.7v-.7h-.6l-.5.4-.8.4-.3-.2-.2-.4-1-.4h-.7c0-.1-1.1.6-1.1.6l-.2.5-.6.5-.6-1,.3-.4h-1c0-.1.2-.5.2-.5h.4l.2-.2v-.7l-.3-.3v-1.6l.5-.2v-.5l.5-.3v-1.3l-.8-1v-.4l-.8-.4h-.7c0-.1-.3-.9-.3-.9h-.6v-.6l-.8.6h-.3c0,.1-.4-.7-.4-.7h-.1l-.3-.2h-.7c0,.1-.3-.5-.3-.5v-.5c.1,0-.5-.8-.5-.8h-1.7l-.3.3-.4.2-.4.2-.9-.3.3-1.1h-.6v.3c-.1,0-1.1-.3-1.1-.3v-.2c.1,0,0-.2,0-.2l-.5.3-.3.3h-.6l.6-.9-.5-.2v-.2c-.1,0-.4-.2-.4-.2l.3-.4h.3c0,.1.2-.1.2-.1l.4-.5.6-.3v-.7c.1,0-.1,0-.1,0l-.3-.4v-.2h.5v-.7l-.9-.5-.3-1-.2-.4v-.7l-.4.2v.4c-.1,0-1.1.4-1.1.4h-.5l-.4-.3-.2-1.2-.5-.6-.7-.8.4-.3v-.2l-.4-.2-1-.2h-.3c0,.1-.3,0-.3,0l-.6-.4.4-.4v.4h.5v-1.1l-.7-.2-.2.5-.4-.7-.5.4h-.4v.4c.1,0-.1.2-.1.2h-1.1l-.4-.5h-.4c0,.1-.3.4-.3.4l-.3-.3v-.6l-.3-.5-.5-.2h-.3c0,.1-.5-.3-.5-.3l-1.2.4v-.3l-.3-.4h-.2l-.2.4-.5.2-.9.4-1-.4h-1.2l-.6-.8-.2.3h-.3v.8l-.5.3v.6l-.5-.2h-.4l-.8-1.4v-1.1c.1,0-.2-.5-.2-.5l-.4-.6v-1.6l-1.5-.2h-3.5c0,.1-3.3-.8-3.3-.8l-.2-.4.4-1.9-.4-.8.4-.4h.2c0,.1.6-.2.6-.2l.6-.8.2.3h.3l.5-.5.5-1.9v-.7l-.3-3-.5-2.8-1.8-5.7-1.1-2-.4-1.3v-2.3l-.2-.6v-2.2l-.8-1.9v-1.4l-.5-1.7v-2l.4-1v-1.1l-.3-2.4-.6-1.4v-1.5l-1.3-1.6-.3-1-.4-.3v-1.2l.6-1.3-.7-.8-.4-1.8-.6-.2-.3-.4.4-1.5v-1.1c-.1,0,.4-.4.4-.4l-.4-.8-.5-.2-.4-1.1,1.1-1.2.7-2.1-1.2-3-1.6-.8-.6-1.6v-.6l1.4-.8.7-2-1.5-1.5-1.3-.4-.6-.9v-.4l.7-1.3v-.6l-1.8-5.1v-.3c.1,0,.5-.2.5-.2v-.9c.1,0,.5-.7.5-.7v-.6l.7-1.8v-.8l-.8-.7-.4-1.1-2-1.1-.2-.8-.6-.3-.5-2.8-1.1-2.8v-2h.1l-1,.6Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="Mondulkiri" class="cls-2 region" data-region="mondulkiri" d="M385.17,127.4l2.6-.4,2.6-1,1.3-.3,3.9,2.3,3,1.4,2.2,2.6h.4l.6.4.9.2,2.4-.3,1.6,1.7.9.2,1.7,1.2h.3l.4-.4,13.2,9.4,2.9,2.8,5.2,1.3.5.3,2.3.6h1.2c0,.1,1.6,0,1.6,0h.8c0,.1.7-.3.7-.3h.9l1,.4h.9l1.4-.4.3.2,1.1-.7.5.2h.4c0-.1.7.4.7.4l.5-.2,1.5-.5.3-.3h.6l.3.4h.4l.6-.4.6.2v.4h.4l.3.4v.6h1.1l.4-.6.8-.4.4-.9.5-.3.6-.4h.3l.4-.4v-.3c.1,0,.2-.7.2-.7l-.3-.4.4-.7v-.6c-.1,0,.4-.4.4-.4v-.4c.1,0,.4-.4.4-.4l-.2-.6-.5-.5v-.6l.4-1.3-.5-.2-.4-.5v-.8h-.3v-.5l-.3-.5-.5-1v-.3h.8l-.3-.5.2-.3h.2l1.3,1h1.3l1.6-.6.9-1.4h1.1c0-.1,1.2.5,1.2.5l.2,1.2.6.5h.8c0,.1,1.6,0,1.6,0l1.9-1.1.9-1.2,1.5-.6.2-.9-.2-1.2.3-.5.5-.4,2.5.8,2.2,4.9,1,.2.8-.2.9-.6h1.7l.8,1.1,1.1.8.3.8.9,1.1,1.2-.6h1c0,.1.2-.6.2-.6l1,.2v-.2c.1,0-.2-.9-.2-.9h.5l1-.9,2.2-.6.4-.8h.4l.6.2.2-1.1.8-.5.5.4,1.7,2.4.5.3.3.6h.3c0,.1.8-.5.8-.5h.3l.3.6h.3c0,.1,1.5-.4,1.5-.4l1.8.7.4.5,1,.4.7-.9.8-.2.2-.9h.9c0-.1.6.3.6.3l.7-.3-11.2,26.6v1.3c.1,0,.1,1.9.1,1.9l.8.5-.2,1,.3.8.4.4-.3.3h-.7c0-.1-.7.3-.7.3l-.3,2.5.9.6.3.7-.4.5.3.4.6.5-.3.4-.2.7-.4.4v.4l.4.3.2,1.4.5.6.8.3v.5c.1,0,0,.6,0,.6l.9.3.5,1.3,1.2.5.6,1.4h.5c0-.1.3.4.3.4l-.2,1.1.5.2.5,1.7h-.4v.6l.3.8-.3,1.2v1.4l.4.9.4.9-.8,1.1v.9l.3.4h.4c0,.1.7,1.2.7,1.2l.8,1.3-.5.2v.6l-.5.4v1.8c-.1,0,.1.7.1.7v1.4l.6.3.6.9-.3.4.4.6v.5l-.4.7-.2,1.6.9,1.6v.3c-.1,0-1.2.9-1.2.9l-.2.6v.5c.1,0-.4.5-.4.5l-.7.3-.2.5v.6l.6.4-.2.5.2.3,1,.8-.4,1.6-.6.2-.4.6.4.6-.3.4.2.6-.2.5h-.3l-.7,1.5-.4,1.4-.6.3v2.1c.1,0,1,1.5,1,1.5l-.4.5-.6.3.2,1-.3.9-.2.2h-.6c0-.1-.3.5-.3.5l-.6.4-1,.3-.2.6-.4.3-4.2,1.7v1l-1,.7-1.3.2v1.4l-.6.6.3.8-.5.8-.3,1.1h-1.1l-.5.5-.4-.8-1.4-.8v-.5l-1.1-1v-.8l.2-.6-.5-.3-.2-.5-.4-.3v-.5l-.3-.4-.9-.7-.3-.6-.7-.2-.6-.5-.3-.7h-.2l-.7.7h-1.1l-.9.5h-.5v-.8l-.3-.3-.6.5h-1l-1,.6-1.2-.3-.4.8-1.4.5v.3l-.7.5-1.1.7h-.9l-1.2-.4h-.6c0,.1-1.1.5-1.1.5v.4l-1.5,1-.7.2h-.8l-.7.2v.6l-.6.6v.5c-.1,0,0,.7,0,.7h-.4v2.2h-.6l-.3.4-.3-.2-.5.7h-.3l-1,.6-.5.4v.6l-.4.4v.7l-.4,1h-.7v-.5h-.6c0,.1-.5-.2-.5-.2v.3l-.4.6.9.8v.6h-.5l-.5.4-.8.2-.5.6v.9h-.5l-.2.4.2.3-.5.3h-.7l-.8.6-.2.4h-.5l-.6.4-.2-.4-.9.5v.2h.8v.4l-.6.2.2.4-.6.4-.2.4h-.7v.6l-.4.3-3.7,1.1-.6.7h-.6c0-.1-1.1.4-1.1.4h-1.1l-.8-.5-.9.2-1.1-.7h-.7c0-.1-.9,0-.9,0l-1.2.4-.3.3-.9-.8-1,.2-.7-1h-.4c0-.1-.7-.1-.7-.1l-.2.4h-.7l-.7-.5v-1.2c-.1,0-.8-1.8-.8-1.8l.8-1.9v-.9c-.1,0-.6-.8-.6-.8l.5-.6v-.6c.1,0-.2-1.1-.2-1.1l.6-1.5-.8-1.1-.5-.4-.5-1-1.5-1.7-.6-1.6h-.3l-.7-.5-.5-.9-.6-.4-1.6-.5-1.6-1.2-2.5-.4-1.6-.7h-1.2c0-.1-1-.8-1-.8h-1.3l-.7-.6-1.1-.4-.8-1-.7-1.3-1-3.1-1.5-3.6-1.4-.4-.5-.6-1-.2-.9-.6-.3-.8-.4-.3-.4-.2h-.3c0,.1-.6-.2-.6-.2v.2h-.4c0,.1-.4,0-.4,0l-9.7-6.3-2.3-1.1-1.2-1.4.4-2.8,3.4-8.4.4-3.3,2.4-4.1,1.5-1.5,3.1-1.9.6-.5.6-1,1.1-.9h.4v-.3l.8.2.2-.4.3.2v-.3h.5l.2-.3.8-.2.5.3h.4c0-.1,4.9-4.5,4.9-4.5l.9-1.1.6-1.3.4-2.8v-1.5l-.3-1.3-1-1.4-2.3-1.9-2.5-1.6-2.2-1.3-3-1.4-3.1-2h-.5c0,.1-.8-.2-.8-.2l-.8.4-1.5-1h-.6c0,.1-.1-.1-.1-.1h-.2v-.3l-1-1v-.9c-.1,0-2.5-1.1-2.5-1.1l-.7-1.2-1.3-1.4v-.4l-.5-.7-1-.5-.3-.6v-.3l-.2-.7.2-.6v-.8l-.2-.5.2-1.2.3-.4v-.8l.5-1.2.4-.2h3.4c0,.1,1-.3,1-.3l1.4.7h.6c0-.1.9,0,.9,0l.2-.3-.6-2.2-1.5-1.8-.8-.7-2.9-1.4-.4-1.6-1.4-2.3-.5-1.3v-.8c-.1,0,.3-1.2.3-1.2v-1.5l.6-1.9-.3-1.4-.4-.6.3-1.6-.3-.6v-1.6.3h.1Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="PhnomPenh" class="cls-2 region" data-region="phnom-penh" d="M242.87,296.6h5.3l-.5,1.7,2.3,6.1.3,2.8,1.3.9v1.3l1.5,3.7-.4.4-1,.6-1.3-.2-2.4.9-.3,1.7.4,1.5h-.1c0,.1-.1.3-.1.3l-.4.2-.8-.5-.3-.5h-.4c0-.1-.4-.6-.4-.6v-.4h-.6v-.6c-.1,0-.8-.5-.8-.5h-.5l-1.1.5v1.2l-.5.2v.4h-.6l-.6.2-.5.6-.6.5h-1c0,.1-.6-.3-.6-.3l-.5.5.4.2-.4.5h-1c0-.1-.7-1-.7-1l-.4-.2h-.5c0-.1-.5-.6-.5-.6v-.7l1-4.6.8-.5h1.8c0-.1.1-.9.1-.9l-.7-1.5-1.2.2-.5-1v-.7h-1l-.2-.3v-1.2l.4-.5v-4c.1,0,.2-.8.2-.8l.6-.7h.3l-.4-1,.2-.3.5.2.5-.4-.3-.7.2-.2.5-.3h.2c0,.1.4-.2.4-.2v-.2c.1,0,.2-.3.2-.3h.4c0-.1.2.2.2.2h.3v.5c-.1,0,.4.5.4.5l.6-.2h.3l.2.9,2.5-1.8-1-1.2h1l-.2.2Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="PreahVihear" class="cls-2 region" data-region="preah-vihear" d="M238.27,26.5v.6h1l.9.4.2,1.1,1.1-.4.9-.2.9-.9.7.6,1.9.6.6.6h1.2l1.9.7.3.5.5.4.8.2.3-1,.7.2.7-.4.6.6.6.2.9,1,.6.6v.4l-.2,1.2-.6.8v2.1h-.7v.4l.6.7,1.1.7.3,1.2,1.1,1.6.5,1.1v1.2c-.1,0,.1,1.2.1,1.2l1.6,1.1.6.6.3.7,3.1.5,1-.6,1.3.2.7-.8,1.1-.3,1.5-1.3,1.1-1.6-.3-.5h-.7l.9-.9-.3-.8v-.8c.1,0,1-.4,1-.4v-1.2l.8-.3.7-1v-.7l-.9-.5v-.8l.9-1,.5.3h.4l.6-.5.7-.2.8.5v1.1l-.2,2,1,1.1.7,1.7,1.6,1.1.6,1.3v1.9l.2,1,.8.5v1.5l.9.8.4.8.4.9v.8l.8.6h.5l.5-.2.4.3.4.5,2.2.6.2.7-.3.7,1.5,1.6,1,.8.6,1,.5.7.9.2.8-.3h.5l.6.5h.6l.3-.5.6-.5h.8l.4.5h.9l.6-.4,1.1.6.9.2.2-.7.4-.3h.4l.8-.8.5.4.8-.2.3-.5.8-.7h.5l.9-.3,1.1-.7.9-.5,1.3-.8,1-.5,1.1.5.5,1,1.2.7-.2-.6v-.5l.7.3.8-.3.3.4h.4v.9l.8.9.3-.9,1.2.8.3.9-.3,1,1.2,1.1h.4l.2-1.3.4-.7,1.1.4,1.5.5.4.8,1.2.7.5.7.5-.2.2-.8.7-1,.6-.2h.3l1.4,1.3,3,.7,1.2.5.2.5-.6,1.9v1.5c.1,0,1,2.1,1,2.1l1.1.6.6.8,1.3.8.9,1.4,1.2.9,2.4,1.2,1.2,1,1.2,1.2.3.6-1.5,1.1-1.4.4h-9.3l-1.4-.2-4.5.6-.9.7v.6c-.1,0,0,.4,0,.4l.4.2v.8c-.1,0,.2,0,.2,0v.4c-.1,0,.3.2.3.2h.4v.3l-.2.2v.4c.1,0,0,.4,0,.4l-1.2.2-.2.3-.8-.6v.3h-.3l-.3.2h-.4l-.5-.8-.9-.5-1.3.7-.5-.3v.3h-1.2l-.5.4-.2.7h-.8v-.4c-.1,0-.7-.3-.7-.3h.1l-.3-.5-.5-.2v-.4l-.4-.4-.8-.4h-.3l-.7-.4-1.3,1-.2.4h-.7l-.4,1-.6-.2-1.8,1.2v.9c-.1,0-.8.7-.8.7h.2l-.3,1,.3.6v.2c-.1,0,.3.3.3.3v.2h.1l.2.7-.5.7.4.4v.5c.1,0-.6,1-.6,1l.2,1.4.7.5.2,1.2,1.5.9.3,1.2,1.2,1.8.5,1.8v1.1l.5,1v1.6c.1,0-.5,1.5-.5,1.5l.2,1.5v2.6c-.1,0-.7,4-.7,4l-.4,1.1.4,5.2-2.1,2.7v.7c-.1,0-.6.6-.6.6l-1.3,1.6-4.2,1.2-3,1.9-4.7,1.7-3.9,2.1-.6.5-.8,1.4-6.3,6.9-.9.5-3.1,1.1-4.4,2.8-1.3,1.7-1,2.3-.8,1-1.1.9-3.1,2.3-5.4,2.9-5.2,4-2.9,1.8-2.1-.3-1.8-1.8-1.4-2.1-1-1-.4-.9v-.6l-1.6-1.7v-1.6l-1-1.1v-1.9c-.1,0-.4-.7-.4-.7l.3-1.3v-1.2c-.1,0,.7-.8.7-.8v-1c-.1,0,.9-1.1.9-1.1l1-3.4v-.8c-.1,0-1-1.7-1-1.7h-.6c0-.1-3.2.2-3.2.2l-1.6-.3-5.7.7-.7-.3-.2-.5-.5-.4-1.2.4-.2-.2h-.4l-1,.2-.6.6-1.1-.3h-.5c0,.1-1.6,1.5-1.6,1.5h-.6c0,.1-1.7,1.2-1.7,1.2l-2.2.9-3.5,1.2-4.3.8.7-2.3-.7-2.2.2-1.1.5-1.1-.4-1.2v-2.8l.6-2.4,1.2-1.3.6-1.4.6-.8,3.4-2.5.4-.9,1.1-1.5.2-1.2v-1.5c-.1,0,.4-.7.4-.7l.9-.5.2-.5,1-.7.6-.9-.9-.6v.3c-.1,0-1.5.7-1.5.7l-.8.8-3.3,1.1-.4-.7-.8-.3-.7-.8-3,.2-.9-.4h-.4l-.9-.6-1-1.3h-1.7l-1.3-.4h-.3l-.6-.2-1.5-.2-6.3-.3-.2-.4v-.4l.3-.4-.5-.7-.4-2.1.7-.9.8-.2.6-.4.2-1.2v-.4c-.1,0,.8-1.8.8-1.8l.6-.6v-1.4l-.8-.6-.4-.5v-.8l.4-1.2-.4-1.2v-.9l-.6-1.3-.9-.7-.4-1,.6-1v-.6l-1.4-.7-.6-.6-.2-1.4-.8-1.4-2,.2-.3-.2-.2-.6.9-1v-1.3h1.1l.3-.6v-.8l.7-.2v-.6l.7-.4-.6-.5.8-2,.3-.3,1.2.3h.5v-.6l-.9-.9.2-.5,1.2-.9.4-1.6v-.3h-.4l.2-.8-.4-.8.6-.4.2-1.3-1-2.2.2-1.1.6-.8-.2-.8.6-.3v-2.1l.3-.2.5-2,.4-.6.7-.2.7-1.1v-.6l.5-.2.7-1h.5l.5-1.1.7-.2.5-.8.8-.5v-.6h.6l.2-.7-.2-.4-.7-.6-1-.2v-.3l-.6-.3h-.4l-.5-.5v-.5l-.9-.4-.2-.7-.8-.7v-.6l-.6-.4-.4-.3v-.6h1.1l.4-.3v-.7c-.1,0,.1-.3.1-.3l.2-.8.3-.3-.4-.6.2-.3-.2-1.2-.6-.4.3-.4-.2-.7.3-.8-.2-.4.3-1.9.7-1.8.2-2.4.4-.2.6-.6v-.5l-.2-.4.2-.4.5-.5h.8c0-.1.6-.5.6-.5l1.6.6,1.4,1,.5.6.9-.2,1.9.3.4-.6.9.2-.2-1,.4-.8.8-.5.5-.7,1-.8h.9l1.3-.9,1.7-1.8.7.2.2,1.5.6.6,1.3.2,1.1.2.6-1.1v-.5l.5-.8.5-.7.7-.5h.5l1.1,1.2.2.5-.4.8.2.5.9-.9h.7c0-.1,1.3.7,1.3.7l.4-.9.9-.8,1-.2,1.3-1,1.6-.2.9.7.2.5h-.1v.7Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="PreyVeng" class="cls-2 region" data-region="prey-veng" d="M270.97,290.5l.4-1-.2-.6-.5-.6v-.3h1.1c0-.1.5-.7.5-.7h.8l1.3-1.4,1.2-.3.9-.5.5-.8h.5c0,.1.9-.3.9-.3l.6-.4.8-.5,1.4-2.7h.2c0-.1.6,0,.6,0l.4-.7.7.2v-.6c.1,0-.2-.2-.2-.2v-.4l.5.2.5-.4h1.3c0-.1.6-.5.6-.5h.8c0-.1.4-.6.4-.6l.3.6.6.4v.4l.6.4.9.2,1-.5.3.5.6.3.2.4,1.3.3.2.3.9-.8h.5c0,.1.4.6.4.6v.5l.6.3.2.3.2.5-.9.6.3.3.2,1.1-.2,1,.3,1.2.6.9,2,1.5h.5l1.4-1,3.3.2,1.7.8h1.3l.6.4,4,.3,3.9.6h3l1.7.4,3.3-.4,2,1.8,1.2,3.1,1.2,1h.4v.3h.6c0,.1.2,1,.2,1l.6.2.2.3v.5c-.1,0,.1.1.1.1v.2h-.3c0,.1.3.3.3.3v.5h.2v.4l.3.2v.3h.4c0,.1-.2.4-.2.4l.5.2h-.1c0,.1.6.6.6.6l.2.4h.4v.4c-.1,0,.3.3.3.3l.2.7,1,.2.4.5c0,.1-1.3.2-1.3.2l-1.3.9h-1.5l-1.2.2-.8-.2-.3.5v.5l-1.6.2-3.2,1.1-.4.5v1.3c.1,0-1.1,1.2-1.1,1.2l.3.4v.7l.5,1.4-.4.5v.5l-1,.5-.5.7v.7c-.1,0,.3,1.4.3,1.4v1l-.9,1.6-.7,3.8.2,5.5-.2,2.2.2.9.5.7.2,1.4.7,1.5v1.1h-1.7l-.8-.8-1,.6.3.3v.5l-.6.7-.6.2v1.2l-.7,1.3-.7,2.2-.3.3.6,2v2.3l.3,1.2.3.6,1.5,1.4-1,1.2-1.1.8v.4l-.7.5v.3l-.3.7.2.2-.4.6.2.4-.2.5.2,1-.8,1.2v.9l-.6.3v.4l-.3.2v.4l-.6.9.5.7.7.4,1.5.2.3.4v.8l-.3.2v.2l.5.6-3.5,1-2.4.4-1.5.7-2.7.2-.8-.5-.3.6-1.2-.4v-.5l-.9-.6h-.9l-.8.8h-.4l-.9-.4-1-1.3h-.5l-.3,1-1.2,2v.4l-.4.4v.5l-1.9,1.1-.4.4v.4l-.3.7h-.5c0-.1-.2.1-.2.1l-.4,1.4h-.9v.8h-.6c0,.1-.7,1.3-.7,1.3h-.5l-.2.2v.6l-5-2.7h-1.1c0-.1-.9-1-.9-1l-2.5.4-2.4-.9-1.4-.9h-1l-.6-4.4v-1.2l.5-1.3.2-2,.5-2.5-.2-5.9,1-1.2,1.8-1.5,1.1-1.5,1.1-3v-2.6l1.6-1.4,1.8-4.8v-1.5l-.7-5.2-.3-1.2-1-2.4-.4-3.2,2.6-1.7,1.3-1.5-.5-.5v-.6h-.5c0-.1-.4-.6-.4-.6l.4-.7-.8-.9-.8.9-.7-.8-.7.6-1-.5v-.5l-.4-.2-.6-.4-.7-.5v-1.2l-.9-.5-.4.2-.3-.9v-.5c.1,0-.5-.5-.5-.5l-.6-1.4-1.4.5-.8-.2-.8-.8-.8-.4h-.6l-.8.5-.7-.2-.9-.6v-1.1l.6-.2-.4-.4h-.7c0-.1-.8-1.7-.8-1.7v-.3l.2-.5.2-.6-.5-1.2v-1.3c-.1,0,.1-.3.1-.3l-.8-.7v-.4c-.1,0,.2-.5.2-.5l.5-.4v-.8l2-.9v-.7c-.1,0-.9-.4-.9-.4l-.2-.6.7-.7v-1.2l.5-.9.4-.2h.9c0,.1,0-.5,0-.5l.8-.2v-.9c.1,0-.2-1-.2-1l.5-.4v-1.2Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="Pursat" class="cls-1 region" data-region="pursat" d="M149.87,160.9l3.5,5.2,5.9,7.3,2.2,1.9,5.7,6.6,5.6,2.6,2.2,2.6,2.4,5.7,1.4,3.4,15.3,6.8,2.5,9.9.3.8v3.6c-.1,0-.7,1.2-.7,1.2v1.5l.8,2-.2.9.5.6-.7.3h-.9l-.6.9-1.7.9-1.3,4.3-1.2,1.7-.4.3-.8.2v.6l-.4-.2-.8.2-.5.4h-1.3l-1.6,1.5-.3.8-.9.4h-.8l-1,.3h-.2l-1.5.3-.7.6-.4.8-.4.4-.2.5-1.1.8v.5l-.8,1.1-.8,4,.4.6-.5.6v1.2l1.2.7v.4c.1,0,.3,5.4.3,5.4l.4.4v.5c.1,0,.4.7.4.7l.4.9v.5l-.9.6-.9,1.7v1.3c.1,0,0,.2,0,.2l-.8-.2-.4-.6-.7-.4h-1.5l-.3.7h-.8l-.9-.4h-1l-.4.2-.7.7h-1l.4,1.6-.5,2.5-.4.5v.8l-.7-.3h-.3l-.4.4.2.5-.3.7h-.2c0,.1-.9-.1-.9-.1l-.4.2-.7,1.1.5.6.8,2.2-.3.5-.7.2-1.1-.2-.2.4-.7.3-1.4,1.3-1.8-.3h-.7c0,.1-.3,0-.3,0v-.6c-.1,0-.9-1-.9-1l-.2-1-.4-.5h-1l-.2-.3h-.9l-.4-.5h-.8l-.4.3v.4l-1.8.4v2c-.1,0,.3.6.3.6v.6h-.4c0,.1-.2.7-.2.7l-2.1.5-.4.8-.5.3-.9,1.2.3.5v.8h-.8c0-.1-.4.4-.4.4h-.6c0,.1-.9-.9-.9-.9h-.6c0-.1-.4-.7-.4-.7l-.3-1.2-.5-.7-1.5-1.5v-.6l-.6-.8-.4.2-.4-.3-.3-.5v-.7l-.9-.8h-1.3l-.5-.3-.6.8h-.7l-.9-.6-.7-.8-1.9,1.2-1.1-.4-.2-.5-1.3-.5.6-.5-.3-1.6-.4-.2h-1.8l-.7-.7-1.1-.3-.2-.4h-.3v-.5l-.6-.3h-.7l-.3-.5-.6-.3.8-.7v-.4l-.3-.7-2.1-.6-.7-.4-.4-.9-.6-.6h-.4c0-.1-.7-1.3-.7-1.3l-1.1-.3-.3-1h-.4c0,.1-.4-.4-.4-.4l-1-.4-.2-.3-1-.6v-.3l.4-.2-.3-.4-.7-.4h-.7c0,.1-.3-.2-.3-.2l-1.2-.4-1.6.7-.6-.9h-.3l-.6-.8h-.5l-1.1,1.5h-.4c0,.1-.6.6-.6.6l-1.1.3-.3.4-1.2-.6v-.3h-.6l-.2-.6h-.9c0-.1-.3-.6-.3-.6h-.8l-.9,1.2.2.4-.3.3.4.8-.2.5.4.4-.3.2h-.6c0-.1-.9.8-.9.8h-.3l-.4,1.8.2,1.4-1.5.3-.9.7h-.7l-.5.9-.4.2v.6l-.9,1.6h-1.5v.4l-.5.2-1.8-.9h-.3l-.5.5-.6.2v.4l-.3.5h-.7v-.3h-1.4c0,.1-.2.8-.2.8v.6l-.5.6-.4-.3-2-.3h-.4c0,.1-.9,1.1-.9,1.1l-1,.4h-.3c0-.1-1.1.5-1.1.5l-.7-.4-1.4.4-2.3-.3-9.2-4.1-2.1-.8-2.3-.5-16.8-1.1-1.8-.8-.7-1.5v-1.5l-.4-1.3-.4-.9-.7-.5-1.1-1.6-1.1-1.3-.4-1.7-.3-.4-.6-.2-.5-.6-.7-1.3v-1.3l-.6-.7.3-1.3.5-.9-.3-1.1.4-1.5.5-.4v-2.2l-.5-1.2.9-2.3.3-1.8v-2.1l-.3-.9v-1.3l.2-1.6,1.3-1.5.2-.6.5-.3,1.3-.5h1.1l.7-.6h.6l1,1.2.5.9.9.6.2.3.8-.7.2-.3-.3-.5.3-.8.5-.3v-.5l.5-.3.5-.8,1.5.5v.3l2,.6v-.4l.3-.4.6-.6.7-.6.5-.3.4-.7h.3v-.4h.2l.4.2.2.3.8-.3.2-.3,1.9.4.9-.5v-.5l1.5-.7.5-.2v-.7l.9-1.4,1.4-1.3,1.1.9v.6l1.1,1.4.2.8h.7l.5.4,3.3.7.4-.3v-1.9h.4l.5-.5h.7l.6.2h.8c0-.1.3-.7.3-.7l2.1-1.3h.8v-.6h.5l1.2.8h.4l.8-1.1,1.3-1.2,2.3-.6,1.5-1.3.5-.2.9.2,1.1.6.7-.9,1.2-.4.6-1h.8l.4-.7,1.7.3v-1l.4-.4.2.2.4-.2h.3c0,.1.3.3.3.3l.4-.2h.6v-.2h-.3v-.6l3.4.7v.9h1.2l.9-.8h.8c0-.1,1.1,0,1.1,0l3.6,1.7h.3l1.4.4.7.8,1.5.8.4.4,2.5,1h1.1l1.5-.9,2.3-.8,3.8-.2.8-.3.4-.8.2-.6.5-1,.2-.7.8-.7.3-.3-.2-.2.2-.3.8-.5-.2-.4-.3-.6-.5-.4v-.5l.8-1-.7-.8v-.3l.2-.5v-.5l.3-.2v-.4h.6c0-.1.2-.3.2-.3l.2-.3-.4-.4v-1.8h-.7l-1.9-1.4,1.7-2.4v-.8l-.5-.6h-.4c0-.1-.4-.6-.4-.6v-.4l.2-.5-.2-.3-.2-.4-.2-1,.3-.5v-.4l-.3-.5v-.4l.5-.7-.2-.5.4-.6h.4l.3-.3v-1.2l.2-.3.2-.3.5-.7v-.8l-1.2-.2v-.9l.2-.8v-.5l.9-.8.9-.3.4-.4,1.1-.4h1.7c0-.1.5-.3.5-.3l.4-.3v-.9c.1,0,0-.6,0-.6v-1l.6-1.1-.2-.2v-.5l.9-.6.2-.5,1.1-.3h.6c0,.1.2-.3.2-.3l-.2-1.5-.8-.3-.3-.6-.2-.6v-1l1.3-1.1v-.9l.8-.5.2-.9.7-.3,3.5.2,7.6-2.9,3.2-2.2,1.4.2v.1Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="Pursat-2" data-name="Pursat" class="cls-7" d="M151.47,273.5s-.4-.6-.3-.6v-2l1.8-.4v-.4l.4-.3h.8l.4.5h.9l.2.3h1l.4.5.2,1s.8,1,.9,1v.6s.3.1.3,0h.7l1.8.3,1.4-1.3.7-.3.2-.4,1.1.2.7-.2.3-.5-.8-2.2-.5-.6.7-1.1.4-.2s.9.2.9.1h.2l.3-.7-.2-.5.4-.4h.3l.7.3v-.8l.4-.5.5-2.5-.4-1.6h1l.7-.7.4-.2h1l.9.4h.8l.3-.7h1.5l.7.4.4.6.8.2s.1-.2,0-.2v-1.3l.9-1.7.9-.6v-.5l-.4-.9s-.3-.7-.4-.7v-.5l-.4-.4s-.2-5.4-.3-5.4v-.4l-1.2-.7v-1.2l.5-.6-.4-.6.8-4,.8-1.1v-.5l1.1-.8.2-.5.4-.4.4-.8.7-.6,1.5-.3h.2l1-.3h.8l.9-.4.3-.8,1.6-1.5h1.3l.5-.4.8-.2.4.2v-.6l.8-.2.4-.3,1.2-1.7,1.3-4.3,1.7-.9.6-.9h.9l.7-.3-.5-.6.2-.9-.8-2v-1.5s.6-1.2.7-1.2v-3.6l-.3-.8-2.5-9.9-15.3-6.8-1.4-3.4-2.4-5.7-2.2-2.6-5.6-2.6-5.7-6.6-2.2-1.9-5.9-7.3-3.5-5.2v-.1l-1.4-.2-3.2,2.2-7.6,2.9-3.5-.2-.7.3-.2.9-.8.5v.9l-1.3,1.1v1l.2.6.3.6.8.3.2,1.5s-.2.4-.2.3h-.6l-1.1.3-.2.5-.9.6v.5l.2.2-.6,1.1v1s.1.6,0,.6v.9l-.4.3s-.5.2-.5.3h-1.7l-1.1.4-.4.4-.9.3-.9.8v.5l-.2.8v.9l1.2.2v.8l-.5.7-.2.3-.2.3v1.2l-.3.3h-.4l-.4.6.2.5-.5.7v.4l.3.5v.4l-.3.5.2,1,.2.4.2.3-.2.5v.4s.4.5.4.6h.4l.5.6v.8l-1.7,2.4,1.9,1.4h.7v1.8l.4.4-.2.3s-.2.2-.2.3h-.6v.4l-.3.2v.5l-.2.5v.3l.7.8-.8,1v.5l.5.4.3.6.2.4-.8.5-.2.3.2.2-.3.3-.8.7-.2.7-.5,1-.2.6-.4.8-.8.3-3.8.2-2.3.8-1.5.9h-1.1l-2.5-1-.4-.4-1.5-.8-.7-.8-1.4-.4h-.3l-3.6-1.7s-1.1-.1-1.1,0h-.8l-.9.8h-1.2v-.9l-3.4-.7v.6h.3v.2h-.6l-.4.2s-.3-.2-.3-.3h-.3l-.4.2-.2-.2-.4.4v1l-1.7-.3-.4.7h-.8l-.6,1-1.2.4-.7.9-1.1-.6-.9-.2-.5.2-1.5,1.3-2.3.6-1.3,1.2-.8,1.1h-.4l-1.2-.8h-.5v.6h-.8l-2.1,1.3s-.3.6-.3.7h-.8l-.6-.2h-.7l-.5.5h-.4v1.9l-.4.3-3.3-.7-.5-.4h-.7l-.2-.8-1.1-1.4v-.6l-1.1-.9-1.4,1.3-.9,1.4v.7l-.5.2-1.5.7v.5l-.9.5-1.9-.4-.2.3-.8.3-.2-.3-.4-.2h-.2v.4h-.3l-.4.7-.5.3-.7.6-.6.6-.3.4v.4l-2-.6v-.3l-1.5-.5-.5.8-.5.3v.5l-.5.3-.3.8.3.5-.2.3-.8.7-.2-.3-.9-.6-.5-.9-1-1.2h-.6l-.7.6h-1.1l-1.3.5-.5.3-.2.6-1.3,1.5-.2,1.6v1.3l.3.9v2.1l-.3,1.8-.9,2.3.5,1.2v2.2l-.5.4-.4,1.5.3,1.1-.5.9-.3,1.3.6.7v1.3l.7,1.3.5.6.6.2.3.4.4,1.7,1.1,1.3,1.1,1.6.7.5.4.9.4,1.3v1.5l.7,1.5,1.8.8,16.8,1.1,2.3.5,2.1.8,9.2,4.1,2.3.3,1.4-.4.7.4s1.1-.6,1.1-.5h.3l1-.4s.9-1,.9-1.1h.4l2,.3.4.3.5-.6v-.6s.2-.7.2-.8h1.4v.3h.7l.3-.5v-.4l.6-.2.5-.5h.3l1.8.9.5-.2v-.4h1.5l.9-1.6v-.6l.4-.2.5-.9h.7l.9-.7,1.5-.3-.2-1.4.4-1.8h.3s.9-.9.9-.8h.6l.3-.2-.4-.4.2-.5-.4-.8.3-.3-.2-.4.9-1.2h.8s.3.5.3.6h.9l.2.6h.6v.3l1.2.6.3-.4,1.1-.3s.6-.5.6-.6h.4l1.1-1.5h.5l.6.8h.3l.6.9,1.6-.7,1.2.4s.3.3.3.2h.7l.7.4.3.4-.4.2v.3l1,.6.2.3,1,.4s.4.5.4.4h.4l.3,1,1.1.3s.7,1.2.7,1.3h.4l.6.6.4.9.7.4,2.1.6.3.7v.4l-.8.7.6.3.3.5h.7l.6.3v.5h.3l.2.4,1.1.3.7.7h1.8l.4.2.3,1.6-.6.5,1.3.5.2.5,1.1.4,1.9-1.2.7.8.9.6h.7l.6-.8.5.3h1.3l.9.8v.7l.3.5.4.3.4-.2.6.8v.6l1.5,1.5.5.7.3,1.2s.4.6.4.7h.6s.9,1,.9.9h.6s.4-.5.4-.4h.8v-.8l-.3-.5.9-1.2.5-.3.4-.8,2.1-.5s.2-.6.2-.7h.4v-.6ZM151.47,273.5h.2"></path>
      <path id="SiemReap" class="cls-2 region" data-region="siem-reap" d="M105.57,80.4l.4.2.3-.3v-.5h.4l.2.3.2-.2.3-.4v-.2l1.1-.2.3-.2.6.2.4-.5.6-.3h1.2l.5.2h.6l.7-.3.3.5h.2v-.3l.8.2h.6l.2-.2.2-.2h.6l.5-.4h.6l.6-.3h.6l-.2-.8h.7l.3-.6.4-.5.6-.2.4-.3,1.1-.9v-.4h1l.4-.4.3-.3.2-.4.6-.3v-.6l.2-.2h.6l.3.3.5.4h.2l-.4-.5.7-.5v.3h1l.2.2h.3v.4l.5.3h.8l-.6-.5.7-.5v-.4c-.1,0,.3-.8.3-.8l.4-.5.8-.4v-.8c.1,0,.6.2.6.2l.4-.4-.3-1.5v-.3h.9v.2h1l1-.7v-.9l.8-.6h1.3l.4-.3v-.2l-.3-.7.9-.4v-.5l1.2-.2v-.3l-1.1-.7v-.5l.9-1.1v-.4l.8-.6.3-.4,1.2-.5.2-.5v-1l.6.2.5-.3.3-.2.6-.4h1.2l.7-.6.8-.3h1.5l.7-.4.8-.3.7.2,1.5-.2v-.2c.1,0,.4-.4.4-.4v-.3h.7l1.5.3h1.7l1.9-.8,5.5-.2h.3l.2-.5,1.5-.2-.5,1.1-.2,2,1.4,2.6.4.3.8.2.5.7,1.5,1.1.4.6.7.5.7,1.2h.4l.9,1h.7l1.8.3,1-.4,1.4-1.4.2-.7.5-.7.4.2.7-.4h1.2l1-.5h.5l.2-.7,1.4-.6.9-.9,2-.2,1.4-.6,1.6-1.6,2.6-.5.9-.5h.8l1-.9.9-.2.3-.4,1.2-.4.8-.5v-1.3c.1,0,.6-.8.6-.8l.6-.4.2-.9.9-.6v-.4h2.4l.3.3h.3l.4.2.6.4v.6l.8.7.2.7.9.4v.5l.6.4h.4l.6.4h.1v.4c-.1,0,.9.2.9.2l.8.6.2.4-.2.7h-.5v.6l-.8.5-.5.8-.7.2-.5,1h-.5l-.7,1.1-.4.2v.6l-.8,1.1-.7.2-.4.6-.5,2-.3.2v2.1l-.6.3.2.8-.6.8-.2,1.1,1,2.2-.2,1.3-.6.4.4.8-.2.8h.3v.3c.1,0-.3,1.6-.3,1.6l-1.2.9-.2.5.9.9v.4h-.4l-1.2-.2-.3.3-.8,2,.6.5-.6.4v.6l-.7.2v.8l-.4.6h-1v1.3c-.1,0-1,1-1,1l.2.6.3.2,2-.2.8,1.4.2,1.4.6.6,1.3.7v.6l-.6,1,.4,1,.9.7.6,1.3v.9l.4,1.2-.4,1.2v.8l.4.5.8.6v1.4l-.6.6-.9,1.8v.4c.1,0-.1,1.2-.1,1.2l-.6.4-.8.2-.7.9.4,2.1.5.7-.4.4v.4l.3.4,6.3.3,1.5.2.6.3h.3l1.3.3h1.7l1,1.3.9.6h.4l.9.4,3-.2.7.8.8.3.4.7,3.3-1.1.8-.8,1.4-.7v-.3c.1,0,1,.5,1,.5l-.6.9-1,.7-.2.5-.9.5-.5.7v1.5c.1,0,0,1.2,0,1.2l-1.1,1.5-.4.9-3.4,2.5-.6.8-.6,1.4-1.2,1.3-.6,2.4v2.8l.5,1.2-.5,1.1-.2,1.1.7,2.2-.7,2.3-.7,2.4-.8,1.9-4,1.4-1.1.9-1.2.2-.5.7-.6,2,.3,1.4-.4,1.3v3.9l-.4,2.4v1.5h-.6c0,.1-.5.4-.5.4l-.2.7v1.6l.8.5v.4l-.2.2-.2.5h-.6c0,.1-.5.7-.5.7v.5l-.4.7h-1.7l-2,2.7-.5.3h-.5l-.9.9-.4.7-.4.2-.2.3-.4.8.2.7-1,1.7-.9.5-.5-.2-1,.2-.9.7-1.1.5-.6-.2-.5.8h-.4c0-.1-1,0-1,0l-.7.2-.2.3.2.4-.4.4-.8-.2-.2.3.2.6-2.2,2.1-.2.8-1.2,1.2v.5l-.5.3.2.7-.8-.2-.5.6-.6,1.2v1.7l-2.5,2.9-2.4-5.7-2.2-2.6-5.6-2.6-5.7-6.6-2.2-1.9-5.9-7.3-3.5-5.2-.7-.9-5.1-4.5-7.8-5.6-3.8-4.8-.8-4.3-.7-.9-1.8-1.2h-.4c0,.1.2.5.2.5l-1,.7h-.2l-.3-.5-.2-.5-.9-.4-.5-.6h-.8c0,.1-1.2-.5-1.2-.5l-.4.2h-1.5c0,.1-1,.3-1,.3l-.7-.5v-.6l-.7-.9h-1.1l-.3.3-.6-.2-.3-.3v-.9l-.2-.7-1.2-.7-1.3-.2v-.7l-.4-.3-1.8-.3-1.1.8-1.3-.9h-.3l-.9.6-.9-.2-.2-.3-.8-.2-.3-.2-.3-.5h-.7c0-.1-.8-.2-.8-.2l-.4-.5h-.4c0-.1-.2,0-.2,0l-.2-.2v-.4l-.2-.5v-.9l-.4-.9-.4-.2-.2-.9h-.4l-.3-.3v-1.1l.7-1.2.2-1.6,1.1-1v-.3l-.3-.3-.9-.2-.2-.5.2-.3v-1.1l.2-.2.4-.6.2-.6-.5-.8.3-.3h.2v-1.1l.2-.5v-.6l.4-.3-.3-.4-.3-.2-.2-.2.5-1h-.5l-.4-.2-.2-.4v-.2l.9-.2-.3-.5-.3-.5-.4-.7.2-.5h.7l.2-.3-.2-.5-.7-.3.3-.3v-.4h-.7v.4h-.6v-.2l.3-.2v-.2l-.9-.7.7-.3v-.8l.8.2.3-.2-.4-.2v-.6h-.5l-.3-.3.4-1.1.7-.9.5-.8,1.1-.6.7-.2.8-1-.8-.4-.3-.5-.6-.6-.2-.3.2-.7-.3-.4v-.2h.5l.3-.2-.7-.3v-.3l.3-.2h.2l.3-.3h-.3l-.5.2h-.3v-.4l.2-.4.4-.8.3.2.3-.4-.6-.2-.2-.3.2-.4v-.4l-.6-.4h-.4l-.4-.5.2-.2h.7l.5.2v-.7l-.2-.5.6-.3v-.3l-.2-.2.3-.5v-.6h.5l.5-.3.2-.6-.2-.2-.4.3-.5-.2-.2-.3-.2-.6-.2-.7-.2-.3.2-.3v-.4h-.2l.3-.8h-.4v-.5l.2-.2.2-.2.2-.2v-.3h.3l-.2-.8-.4-.2.4-.4.4.3.2-.2v1h.2v-.1Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="PreahSihanouk" class="cls-2 region" data-region="preah-sihanouk" d="M139.57,416.8l.6.5h.4v.3h1.4l.6.4v.3c-.1,0-.7.1-.7.1v.4h-.5c0-.1-.5.2-.5.2v.4l.3.5-.2.4-.6-.2-.6-1h-.7c0,.1-.4-.1-.4-.1l-.2-.5.6-.4-.3-.7.3-.4h.4v-.2h.1ZM117.67,411.2l.3.5-.2.4h-.4l-.4-.7h-.8l1.1-.6.4.5v-.1ZM120.17,410.3h.9v.8l.7.6.2.8-.8.3v.6h-.3l-.4-.6h-.6c0,.1-.6-.2-.6-.2v-.3h.5c0-.1.2-.6.2-.6l-.3-.5-.6-.5v-.6l.5-.2.6.4ZM135.67,408.9l1.9.2,1.7.9.6.8v1.4c-.1,0,.1,2.7.1,2.7l-.2.2-1.4.4-.3.6h-.5l-.4.5-.4-.6h-.3l-.4-.3-.3-.7-1.3-1.2-.4-.2h-.3c0,.1-.3-.2-.3-.2v-.6l1.1.4.2-.2v-1.1c.1,0-.1-1.8-.1-1.8l-.4-.8.4-.3h1v-.1ZM115.67,408.9l-.2-.5.2-.4.4-.3v.6l-.4.6ZM103.97,399.9l1.1.3-.3.2h-1.9l.5-.4h.8-.2v-.1ZM109.47,398.2l.5-.3.4.4-.7.6-.8-.5.2-.7.4.5ZM151.47,366.7l.4.5v.2c-.1,0,1,.3,1,.3l.3.4v1.4l-.3.5.2,1.6v.2h-.6l-.2.3-.2,1.1-.5.9.4.4.8.4.2.4-.8.4v.7l.3.6,1,.8.8,1.5-1.2,1.9v.9l.2.5v.8c-.1,0-1.3,1.1-1.3,1.1l.3,2.1,2,3.4,1.1.4.5,1v1.5l.5,1.1-.2,1.1-.9,1.9-.3,1.6h-.6l-.5.8-.2-.5h-.2v.3-.4h-.4l-.2.3h.2v.3h.2l-.9.2v.2l-.3.3-.3-.3-.9-2.2-.5-.4v-1c.1,0,0-.4,0-.4l-2-.8-1,.7-.9-.3v-.4l.4-.5v-.7c.1,0,.1-.6.1-.6l-.3-.4.4-.9-.3-.5h-.5l-.4-.6v-.2l.5-.3h-.5l-.4.4v.6c.1,0,1,.3,1,.3l.3.5-.6.6.2.8-.6.6.2.9-.5.6v.5l.5,1.3.2.3.5-.2.3.9-.2.6-3.8,5.1-2.4,4.4-.5.2-.8-.5-.5-.6v-.3l.2-.2h-.8l-.8.6-.5-.2h-.7l-1.6-.8h-.7l-.2-.4v-.9h-.3c0,.1-.7-.2-.7-.2l-.2.2v.3l-.6-.5v.4l.6.2v.4c.1,0,.7.4.7.4l.4.7.8.4.2.8v1c-.1,0-.6,1-.6,1l-.6.2-2.1-1h-2.4c0-.1-.4.1-.4.1v.5l-.2.2-1-.3-.7.4h-.7l-.4.5.2.4h-.8l-.4.2-.5-.8-1-.2-.9-.6.3-.4v-1.5l.4-.9-.3-.9-.8-1-1.4-.8-1.6,1.8-.7.3-.4-1.5-1.1-2-1.7-2.2-.8-.7h-.5c0,.1-.9-.4-.9-.4l-.8.6v-.8l-1-1.2.9-1.1.2-1.2.7-.2.4.3.6-.9v-.9l.5-.4.5-.9.4-.4h.4l.4-.4.3-1.3-.2-2.1.5.2.4-.3.6-.2,1-.5,1.1-1.3h.5l.7.7h2.2l-.2-.3.2-.8.3-.2h.4v.3l.5.2.3.5h.4l1.2-.6.6.2h1.1c0-.1.7,0,.7,0h1.3c0-.1,3.3-3.5,3.3-3.5l3.6-4.3.6-1.1.9-4.6,1.2-3.3,1.6.9,1.3.4,9.2-4.6.3-.4-.2.3Z" fill="#f3eae1" style="fill: rgb(243, 234, 225);"></path>
      <path id="StungTreng" class="cls-2 region" data-region="stung-treng" d="M403.87,9.9l.5,1.8.9,1,.5,1.8-.2.8,1,1.3-.4,1.2-.5.3.3,1h.7l1-.7.6-.2h1.3v1.4h.5l.4-.3h.1c0,.1.2,1.1.2,1.1l-.2,1.3.2.6.5.5.8.3.3,1.5.8-.5,1.3.2.5-.3h.4l-.2.6.5.4,1.9.5,2.2,1h.8c0,.1.4,0,.4,0l.5-1.2,1.4.6.4.4.5.9.8,1.6v1.4l-.9,2.5v3.9l.3,4.9.4,3,.5.8-.3,1.6-.4.8v3.7c-.1,0,.1.7.1.7l.4.3,2.1,5.5.8,2.3v1l-3.2,4.6-1,.6-.3-.2h-.3v.3l-.6-.3-.6.7h-.7l-.7.8h-.4v.4l-.5.6-.5.2-.3-.3-.8-.2-.8.4v-.2l-.4.2-.5-.2-.5.6-.7.4-2-.5-.4-.3h-1.5l.3.6-.2.3.2.2-.2.5h-.3v1l.3.4.2,2.2.8.8-.2.3.2.8-.3.8v.7l.2.7,1,1.2-.5,1.7v.7c.1,0,.3.3.3.3l.6.2v.4c.1,0,.8.3.8.3l.3,1.6h.8l.5.9-.8,1.9.2.9.5.9v1.6l-.5,1-1,1.1-.2.7-.8.5-.3.6v.3c.1,0-.2,1.2-.2,1.2l-1,.9-.4.8-1,.5-.5.6-1.3.4-.3.4h-1.3l-1.9,1-2.2.3v11.5h1l1.1.8.7,1.4,1.1,1.2.3,1.1v1.3l1,2.2,1.3,2.1v.3c-.1,0,0,.6,0,.6h.3l-.2.3.6.2v.2l.7.6v.8l.2.3-.4.2v.2l-.4.6h-.3l.3.8v.2h.4v.6h.3l.3.3.3-.2.2.3v1.1c-.1,0,.2.4.2.4h.4l-.4.8v.2c.1,0,.3-.1.3-.1v.6l-.2,1.1-.4.3-1.2.2v.3c.1,0,0,.2,0,.2l.2.4v.2c-.1,0,0,.4,0,.4l-.3.3-.4.4h-.3l-1.7-1.2-.9-.2-1.6-1.7-2.4.3-.9-.2-.6-.4h-.4l-2.2-2.6-3-1.4-3.9-2.3-1.3.3-2.6,1-2.6.4h-2.6l-1.7-.7-.5.2-.4.6-.7-.4-.6.2-1.6-.4-1.2,1.4-.7-.2-.4.6-.3,1.9-1.7.8-1.3-.2-.4.3-1.6-.8-.6.2-1.4-.3-.3.2h-.4l-.3.2h-.6c0,.1-1.5-.4-1.5-.4l-.3.4-1.1-.2-.9.2-.3.3h-.4l-.2.4h-.3l-1.1.5-.4.5.3.8h.2c0-.1-.2.7-.2.7l-.6.2-.6.8-.2,1-1.1.5v1.2c-.1,0-1,.2-1,.2l-.2.5v.5l-.3.3h-.5v.4l-.6.6v.3c.1,0-.7.8-.7.8v.4c.1,0-.2.3-.2.3l.4.9h-.2c0,.1.1,1,.1,1l-.2.7h-.5c0,.1-1.3,1.1-1.3,1.1l-2.1-1.2-1.3-.4h-.3c0,.1-.3,1.9-.3,1.9v1.6c.1,0-.1.3-.1.3v.3h-.3c0-.1,0,.5,0,.5.1,0-.3.8-.3.8l-.9.9-.4.9.2.8-1.3.4-.5.5v.2h-.7l-.8.4-.5-.2-.2.4-.7.3v.3l-.9.4-.2.4h-.6l-.4.5-.7-.3-.2.4h-1.2l-1.7-.9h-.2c0,.1-.4,0-.4,0l-.2-.2h-.3l-.7-.2h-.6l-.9-.4-.7-.5-.4-.9-.6-.2-2.8-2-.3-.8-.9-.6-.8-.2-3.8-2.1h-3.5l-.8-.5-2.9-.8-1.2-.9h-1.8l-.2-2.1-1.8-1.9-1.9-.8.2-1.9-.2-.4.2-.6-.2-.9v-1.2c.1,0-.2-1.1-.2-1.1l.3-.9-.4-2,.5-2v-1.9l-.6-1.3v-1.6l-.7-.7v-.4l.4-.6v-.7c.1,0,2.3-2.7,2.3-2.7l-.4-5.2.4-1.1.5-4v-2.6c.1,0-.1-1.5-.1-1.5l.6-1.5v-1.6c-.1,0-.7-1-.7-1v-1.1l-.5-1.8-1.2-1.8-.3-1.2-1.5-.9-.2-1.2-.7-.5-.2-1.4.7-1v-.5c-.1,0-.5-.4-.5-.4l.5-.7-.2-.7h-.2v-.3l-.5-.3v-.2c.1,0-.1-.6-.1-.6l.3-1h-.2l.6-.7v-.9c.1,0,1.9-1.2,1.9-1.2l.6.2.4-.8h.7l.2-.5,1.3-1,.7.5h.3l.8.3.4.4v.4l.6.2.3.4h-.1l.6.4v.4h.9l.2-.7.5-.4h1.1v-.3c.1,0,.6.3.6.3l1.4-.7.9.5.5.7h.4l.3-.3h.2v-.2l.8.6.2-.3,1.2-.2.2-.4v-.4c-.1,0,.1-.2.1-.2h-.1v-.4c.1,0-.1-.3-.1-.3h-.6v-.4c.1,0-.3,0-.3,0v-.8c.1,0-.2-.2-.2-.2v-1l.9-.7,4.5-.6,1.4.2,5.5-.2h3.8l1.4-.3,1.5-1.1,1.2.8,3,.2.9-.2h1.3l2,.7.4-.4,1-.4h.8l2.9,1h2.1l4.2,1,.4-3.5-.5-4.1.5-.6h.9l1.3-1,.2-.8.4-.3h.7l2.3-.6.5-.6.2-.6.4-1.7.6-1.1-3.4-2.1-.9-.8-1.1-1.5-1.8-3.8v-2.8l-.2-1.2-.5-.2h-1.4l-.8-.8-2.2-.6-.5-.3-.3-.7-1.5-2-.5-1.7.6-2.2-.2-1.4-.8-2.2-.6-.5h-.5l-1-.2-.3-.5v-1.6c-.1,0-.2-1.2-.2-1.2l.4-2.1.8.6,1.8,2.1,1.5.2.7-.4h.8l.7-.3.7.6.5.8.4-.3.3-1-.4-1.4.8-.6.5-.2,1,.5,1.4,1,2-1.2h.6l.6.5.6,1.2,1,.3h2l1.1-.8,1.7-.4,1.7-3.6.2-.8v-1.1l.3-.9v-.9l.2-.2.6-.5-.3-.7-.5-.4-.3-.8.7-.8.2-1.3.3-.4h.5l.7,1.5.9-.4,1.1.5.6.4.2.5v.5l.3.6h.4c0-.1.6,0,.6,0l.2.7.5.4h.7c0-.1.6,0,.6,0l1.1-.7,2.6-.8,2.2.4h1.6c0-.1,1.1-1.2,1.1-1.2v-1.1l1.4-.9.4-.6v-.5l-.9-1v-1.1c-.1,0,.4-.8.4-.8l.7-.2,2.8,1.2h.4l.3-.5-.3-.6-1.6-1.7-.2-.6.4-.6,3.3-2,.6-.9,1-.6,1-.3h2.1l.4-1.5Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="SvayRieng" class="cls-2 region" data-region="svay-rieng" d="M333.37,304.8l.6.6-.3.6.5.5.6.5,2.3.4.2-.4.9-.2.4.7.8.4,1,1.7v.6c.1,0,0,1.1,0,1.1l-.5,1v.7l.5.9v.9h-.3l-.3.6v.8l-.2.8,1.2,1h.5c0-.1,1,.4,1,.4l-.2,1.7-1,.5-.5,1.3-.3.3-1.1.4.8,1.3-.8,1.1v.6l1.2.5v.9l-.5.9-.4,2.1-.7.9.4,1-.2.9-.5.7v1.1l.5.2.9-.9h1l1,.6h.9v.8l.4.8-.4.9.3,1.4,1.5,2.2,1.5,1.2,2.1.9h.3l.9-.2,1.2.6h2.1c0,.1.3.7.3.7l.4,3.3.5,1,3,1.8,1.2,1.1.5,1,.4.4.8-.4.4.2,1,1.2v1l.3.5h.5l1.5-1.7,1.4-.6.6-.6h.9l1.9,2.5,1.3,2.4.3,3.1.7,2.7.8,1.3-1.2.4-2-.5-.4.4-.4-.4h-.6l-.4-.4-1,.5v2.7c.1,0,.7.8.7.8l-1.3,2.5,2.4,2.8v.8l2.4,3.7.3,5-2.5-2.2-6.5.4-2.4-.4-5.9-4.2-3.3-3.3-3-2.7h-.2l.2.7.8,1.4v.7c-.1,0,.4.5.4.5l-.8.8-.8.4-.4.5h-.3v.3c-.1,0-.1,1.4-.1,1.4l.6.3v.7l-3.7-.5-4.7-1.8v-.3c-.1,0,1.4-3.2,1.4-3.2l-2.4-3.5-3.1-3.8-1.5-2.8-1.2-3h-.9c0,.1-1.5.7-1.5.7h-2.1l-1.3.5-1.3,1-.7.8-2.7,1.4-5.2,1.4-.5-.6v-.2l.2-.2v-.8l-.2-.4-1.5-.2-.7-.4-.5-.7.7-.9v-.4l.3-.2v-.4l.6-.3v-.9l.8-1.2-.2-1,.2-.5-.2-.4.4-.6-.2-.2.4-.7v-.3l.6-.5v-.4l1.1-.8,1-1.2-1.5-1.4-.3-.6-.3-1.2v-2.3l-.7-2,.3-.3.7-2.2.8-1.3v-1.2l.5-.2.5-.7v-.5l-.2-.3,1-.6.8.8h1.6v-1.1l-.7-1.5-.2-1.4-.5-.7-.2-.9.2-2.2-.2-5.5.7-3.8.9-1.6v-1l-.5-1.4v-.7c.1,0,.6-.7.6-.7l.9-.5v-.5l.5-.5-.5-1.4v-.7l-.2-.4,1.2-1.2v-1.3c-.1,0,.3-.5.3-.5l3.2-1.1,1.7-.2v-.5l.2-.5.8.2,1.2-.2h1.5l1.3-.9h1.3c0-.1,0,.9,0,.9l-.4.5Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="Takeo" class="cls-2 region" data-region="takeo" d="M229.87,328l2.2,1.4,1.4-.9,2.8-.7h.8l.7.5,1.3.3.6.3h1.2c0-.1.5,0,.5,0l1-.8h1.1c0-.1,0,.4,0,.4h.6v-.3c.1,0,.5.2.5.2l.6-.2.9.7h.7l1,.9v.4l.8.4,1.1-.3v2.9l-.2,1-.9,1.7.6,1.9.7.9,3.8,2,.4,1.7-.5,2,.7.9h3l.2.5-.2.3h-.3l-.2.5,1-.4.4.2v.2l-.7.2.2.7-.4,1.4.3.8-.4.3.4.6-.3.6v1.1l-.6.5v1.1l-.4.6-.5,2h-.4l-.2.2.3.5-.6,1.3.5.8-.7,2.1.5.9,3.3.7v2.8l.6,1.3v1.1c.1,0,.5.9.5.9l-1,1.9.4,1-.8.6.8,2.7,2.1,4.3-.2,1.6.6.7.3,1.4,1,.4,1.6,2,.6,3.4-10.1,5.8-3.5,2.3-2.2,2.6-3.5,6.1-2.8,2.5-10.9.4-3.9-1.3.6-.5-.6-.6v-.6c-.1,0,0-3,0-3l-.6-.6v-1l.5-1-.2-1.2-.4-.2-3.1-.2.3-1.4-.4-1.5.2-.6v-2.5l-.4-1.2.4-.7.6-.3.5-1.4,1-1.1.2-.6h.3l-.3-.7v-.7l.3-.2.2-.9,1.9-1.1.3-.4-.4-.3v-.6c-.1,0-1.7-1.6-1.7-1.6v-.2c.1,0,0-.3,0-.3v-1.9c-.1,0,.1-.2.1-.2v-.5l-.9-2.2-.9-1.8-.9-1.4h-.3v-.5l-1.5-.8h-2.6c0,.1-.6.5-.6.5h-.6c0-.1-3.2,1.5-3.2,1.5l-2.1-.2h-2.6c0,.1-1.3-.6-1.3-.6l1.8-3.5v-2c-.1,0,0-1.3,0-1.3l-.3-2.3-1.5-3.6-2.2-3.3h-1.2v-1.2l-1.9,1.4-.7-.6-.6.6v-1.2l-1.6-.5-.7-.6h-1.1l-.9.4v-5.9l.7.6h.4c0-.1.6.3.6.3h.5l.3-.4h.7l.6.3.9.5.7-.3.2.2h1.5c0,.1,1.3-.1,1.3-.1l.9-.6h.7l.2.8,1.1,1.1.9.6,1.8.6,1.8.3,1.9.9,2.9.4.3.4.6.2h.5c0-.1.3-.7.3-.7l.4.3h.8l.4-.2h1l.5-.3v-.3l1.1.2.2-3.7-.3-3.1,2.2-12.1v-1.5l.5-2.5,1.9-2.6h-.1v.1Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="UddorMeanchey" class="cls-2 region" data-region="uddor-meanchey" d="M130.07,25.1l1.7.7v1.8l-.6.8-.2,1.5.3,1,.5.4,1.5-.3h1.2l.9.2.5.6.6-.6,1,1.1.6.6.9-.6,1.7-.3.2.4v.9c-.1,0,.4.2.4.2l1.6.2.3-.6.6-1.1.4-.2h.8l1.4.5v.9c-.1,0,.7.3.7.3l.7.8.9.7.9-.3.6.6,1.3.2,1.5.4,1.1.2.5-.2v-.9c-.1,0,.2-.9.2-.9h2.1l.8-.5h.4l.4.8h.7l.5-.6.8-.4.2.2v.5l.4.6,1.2.3h2.3l1.8-.3,1.6-.4.6-.3.7-1.6.8-.4v-.7c.1,0,1.5.4,1.5.4l.8-.3.7.3v.7c.1,0-.2.7-.2.7l.3.4h.5l2.8-.5-.2-.7-.2-.9,1.4-.9,1.4.2.9,1.3.9.2,2.8-1,.4-1.4.6-.3.9-.5.8-.8h.4l1.3.9,2.1,1.7.8.8.9.4h1.8l1.4-.3,1.3-.4.7.5.8-.4h.4l.7.9.9-.6,1.1.4.4.8,1,.2.8.2.5-.4h.5l.3.4-.2,1h.9l-.4.2-.2,2.4-.7,1.8-.3,1.9.2.4-.3.8.2.7-.3.4.6.4.2,1.2-.2.3.4.6-.3.3-.2.8-.3.3v.7c.1,0-.3.3-.3.3h-1v.5h-.4l-.3-.3h-2.3v.4l-.9.6-.2.9-.6.4-.5.8v.4c-.1,0-.2.6-.2.6v.3l-.7.5-1.2.4-.3.4-.9.2-1,.8h-.8l-.9.6-2.6.5-1.6,1.6-1.4.6-2,.2-.9.9-1.4.6-.2.7h-.5l-1,.6h-1.2l-.7.3-.4-.2-.5.7-.2.7-1.4,1.4-1,.4-1.8-.4h-.7l-.9-.8h-.4l-.7-1.3-.7-.5-.4-.6-1.5-1.1-.5-.7-.8-.2-.4-.3-1.4-2.6.2-2,.5-1.1-1.5.2-.2.5h-.3l-5.5.2-1.9.8h-1.7l-1.5-.4h-.7v.3l-.3.4v.2c-.1,0-1.7.2-1.7.2l-.7-.2-.8.3-.7.3h-1.5l-.8.4-.7.5h-1.2l-.6.5-.3.2-.5.3-.6-.2v1l-.2.5-1.2.5-.3.4-.8.6v.4l-.9,1.1v.5l1,.7v.3l-1.1.2v.5l-1,.4.3.7v.2l-.4.2h-1.3l-.7.7v.9l-1,.8h-.4l-.5-.2v-.2h-.9v.3c-.1,0,.1,1.5.1,1.5l-.4.4-.5-.2v.8c-.1,0-.9.4-.9.4l-.4.5-.4.8v.4c.1,0-.5.5-.5.5l.6.4h-.8l-.5-.2v-.3h-.3l-.2-.3-.6.2h-.3v-.5l-.7.5.4.3h-.2l-.5-.2-.3-.3h-.6l-.2.2v.6l-.6.3-.2.4-.3.3-.4.4h-.9v.5l-1.1.9-.4.3-.6.2-.4.5-.3.5h-.7l.2.9h-.6l-.6.2h-.6l-.5.5h-.6l-.2.2-.2.2h-.6l-.8-.2v.2h-.2l-.3-.4h-.7l-.6.3h-.5l-.2-.2h-1l-.6.3-.4.5-.6-.2-.3.2-.9.2v.2l-.4.4-.2.2-.2-.3h-.4v.4l-.3.3-.4-.2-.2-.3v-.9l.3-.4h.3l.2-.3-.3-.7.2-.4-.2-.6-.3-.2h-.8l-1.5-1-2-.3-.4-.3-2.4-3.3-1.7-3.1-1.1-1.5-.4-1.1-2.6,3.4-2.2,2.5-1.3,1.1-1.6.4h-2.8l-1.1.6-.3.6-3.2-5.8.2-.5h.5l.9-.9.7-1.3.2-1.5-.9-1.4,1.3-1.4.2-.9v-.8l.4-.8.5-1.8-.8.3-.6-.2-1,.4h-.9l-1.1-.7h-.4l-.3.4-.6-.4h-.6l-.3.4-.9-.4-.7.3-.9-.7h-.5l-.2-.5-.8-.4-.2-.4-1.5-1-.3-1.6-4.6-9.4h.6l1.8-2.3v-1.1h1.7l.8-1.1,4-.6.7-.5-.2-.5v-.7l1.3-.6h.5l.7,1.2.7-1.6.6-.4h1.9l1.5.7h1.2l.4.3,1.7-1.2,2.7-1.5,1.7.3,3.3-.8,1.2.5h4.6l3.1-.5.3-.4-.2-.9.6-.9,1.8-1.1.3.2.7.9.5,1.1,1.6.4.3-.3.2-.8.8-.4.2-.8h1.1l.6-1.4,1.7-.5.3.4h.3l.4-.9.8-.5,1.3-.3.7-.4,1.2-.2.9-.2,1,.2.9.8,1.3.8.3.7.7.3,1.8-1.2.8-.2.5.2.2-.8-1.4-.3.3-.8.9-.7h.4c0-.1.9.1.9.1h1.1l.6-.4h.5l-.5-.5v-.1Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path class="cls-8" d="M185.07,406l.2-.4-.3-.4.6-.5v-1.1l.4-1.7,1.7,1.4,2.5.3,1.6-.2.9-.3h2.2v.3l.4.6.2-.6h.4l.6.8v2.5l.9.7.5,1.1,1,.5h.4v1h.3c0,.1.2.6.2.6l-.4.3.7.5v.3l-1,.3-.5-.4.3-.3h-.6l-.3.7.4.3h.6l-.3,1-.3-.2h-.2v.5l.5.3.4-.4.2-.2h.3c0-.1.3.3.3.3v.5l.2.6h.3c0,.1-.7,1.4-.7,1.4h-.3c0-.1-1.4-.3-1.4-.3l-1.1-.5-.2-.4h-.4c0-.1-.6-1.3-.6-1.3l-1.1-1.4-1.6-1.2h-.5l-2.7,1.7-.9.3h-.5l-.8-.4-.3.2-.2-.4v-.9c.1,0-.1-2.1-.1-2.1l-.8-1.8-1.2-1.7h.1v.1Z"></path>
      <path id="Pailin" class="cls-2 region" data-region="pailin" d="M18.67,166.6h.3c0,.1.2,0,.2,0v.8c.1,0,.6-.2.6-.2h.8v-.4l.2.3h1.1l.3.3.3-.4h.4c0,.1.3-.2.3-.2v-.5l.3-.2v-.6h.5l-.3-.5h.2l.2-.5h-.5l.5-.4-.6-.2.5-.5-.3-.3.2-.9-.5-.3-.2-.9-.3.3v-.6l.3-.2v-.8h.9l.6-.7v-.2c-.1,0-.7.2-.7.2v-.4h1.4v-.5c.1,0-.4-.3-.4-.3h.6v-.6h.3c0-.1.2.3.2.3h.2l.4-.2v-.4l.4.2.6-.4h.9v-1h.9v.3l.6-.5.3.3h.3c0-.1.5,0,.5,0l.2-.3h.2l.3.2v.2h1l.4.3.2.6.2-.4.6.3,5.3,7.4.2,27.2-8.3,5.8-14.2,2.5-.8-.6-.5-1.3.5-.5-.2-.6-1-.8.6-1v-.6c-.1,0,0-1.2,0-1.2l-.4-.8.7-1.2h.4c0-.1.7,0,.7,0l.6-1,.8-.5.3-1.6-.8-1.3.4-1.4-.3-.7-1.4-.5v-1.7l-1.4-1-.2-.7.3-.4.7-.3-.3-1.6v-.6c.1,0,.4-.7.4-.7l-.6-.6v-1.3l-.6-.7-1-2.4,1.1-.5.4-.8-.4-.7-1.1-1,.2-.5,1.1-.3.2-.5.6-.4h.3l.2.4h.2v-.5l1.4-.6h.3Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <path id="RatanakKiri" class="cls-2 region" data-region="ratanak-kiri" d="M499.67.6l1.1-.2.3.3-.7.9.5.9v.8h-.6l.4,1,.5,1.6.2,1.1-.8.5h-.7v1l-1,.9h-.8l-.3,1v2.2c.1,0,.4.6.4.6l.5.4v.9l-.4.9-.5.8-.6,1.7-.2.9-.7,1.7-.2,1.5v1.2c.1,0-.6,2.1-.6,2.1l-.5.2-.3.6v2.1l-.8.4h-1.3c0-.1-.8-.3-.8-.3v-.6c-.1,0-.9-.5-.9-.5l-.3,1.6-.5.6v1.4l-1.1.5-1.3,1.4-.4.6-.8,1.4-.3,1-.8.7v.9l.6.9.7.5.2.4v1.2l.3.8v1.4l-.9,1.5.8,1.3-1,1.1-.9,1.4-.7,2.2-.5.8-.8-.2-1,1,.3.7-.8,1.3-1.3,1.7-.3.6-.3,1.2v1c-.1,0,0,.4,0,.4l.7.5,1.9,1.1,1.9.4.2.3-.3,1.2h-1.2l-.3.2v1.3c-.1,0,0,1.6,0,1.6l-.8.7.2,1.2.8.4,1.5,1.8.3.7,1.1-.5.8.3.7-.4h1.8l1.1-.4.2.9,1,.8-.2,4.9.8.8h.9l.4.5-.2.9v1.8l-1.3,1.2-.3.6.8.7.9.3.2.4v.7l-.7,1.1-1,1.1v.4l.6.8-.2.9-.8,1.2,1.7,1.5.9.3h1l4.2,3.2,1.7,5.1,1.8,2.7.2,4.1,4.3,9.5,1.3,16.2-2.2,5.6-.7.3-.6-.4h-.9c0,.1-.2,1.1-.2,1.1l-.8.2-.7.9-1-.4-.4-.5-1.8-.7-1.5.5h-.3c0-.1-.3-.7-.3-.7h-.3l-.8.6h-.3c0-.1-.3-.8-.3-.8l-.5-.3-1.7-2.4-.5-.4-.8.5-.2,1.1-.6-.2h-.4l-.4.8-2.2.6-1,.8h-.5l.3,1v.2c-.1,0-1.1-.2-1.1-.2l-.2.7h-1c0-.1-1.2.4-1.2.4l-.9-1.1-.3-.8-1.1-.8-.8-1.1h-1.7l-.9.6-.8.2-1-.2-2.2-4.9-2.5-.8-.5.4-.3.5.2,1.2-.2.9-1.5.6-.9,1.2-1.9,1.1-1.6.2h-.8c0-.1-.6-.6-.6-.6l-.2-1.2-1.2-.6h-1.1c0,.1-.9,1.5-.9,1.5l-1.6.7h-1.3l-1.3-1.2h-.2l-.2.3.3.5h-.7v.4c-.1,0,.4,1,.4,1l.2.5v.5h.4v.8l.3.5.5.2-.3,1.3v.6l.4.5.2.6-.3.4v.4c-.1,0-.7.4-.7.4v.6c.1,0-.2.7-.2.7l.3.4v.7l-.2.3-.4.4h-.3l-.6.4-.5.3-.4.9-.8.4-.4.6h-1v-.6l-.3-.4h-.3v-.4l-.7-.2-.6.3h-.4l-.3-.3h-.6l-.3.2-1.5.5-.5.2-.7-.5h-.4c0,.1-.5-.1-.5-.1l-1.1.7-.3-.2-1.4.4h-.9l-1-.5h-.9l-.7.4h-.8c0-.1-1.6,0-1.6,0h-1.2c0-.1-2.3-.8-2.3-.8l-.5-.3-5.2-1.3-2.9-2.8-13.2-9.4.3-.3-.2-.4v-.2c.1,0,0-.4,0-.4l.2-.2-.2-.3,1.2-.2.4-.3.3-1.1v-.6h-.2c-.1,0,.3-.8.3-.8h-.4l-.3-.5v-1.1c.1,0-.1-.3-.1-.3l-.3.2-.3-.3h-.2v-.5h-.5l-.3-.9h.3l.4-.7v-.2l.3-.2-.3-.3v-.8l-.7-.6v-.2l-.6-.2.2-.2h-.3v-.7c-.1,0-.1-.3-.1-.3.1,0-1.2-2.1-1.2-2.1l-1-2.2v-1.3l-.4-1.1-1.1-1.2-.7-1.4-1.1-.7h-1.1v-11.6l2.2-.3,1.9-1h1.3l.3-.5,1.3-.4.5-.6,1-.5.4-.8,1-.9.3-1.2v-.3c-.1,0,.2-.6.2-.6l.8-.5.2-.7,1-1.1.5-1v-1.6l-.4-.9-.2-.9.8-1.9-.5-.8h-.8l-.3-1.6-.7-.3v-.4c-.1,0-.7-.2-.7-.2v-.3c-.1,0-.3-.7-.3-.7l.5-1.7-1-1.2-.2-.7v-.7l.2-.8-.2-.8.2-.3-.8-.8-.2-2.2-.3-.4v-.9h.2l.2-.5-.2-.2.2-.3-.3-.4h1.5l.4.2,2,.5.7-.4.5-.6.5.2.4-.2v.2l.8-.4.8.2.3.3.5-.2.5-.6v-.4h.5l.7-.7h.7l.6-.8.6.3v-.2h.6l1-.6,3.2-4.6v-1l-.7-2.3-2.1-5.5-.4-.3-.3-.7v-3.7c.1,0,.5-.8.5-.8l.3-1.6-.5-.8-.4-3-.3-4.9v-3.9l.8-2.5h.2l2.4,3,.3,1,.7.9.4,1.1,1.6,1.4,1.7.4.5,1v.3l.7.5.8.2.7-1.6.5-.6.8-.5h.5l.7.3h.8l.3-1.6.6-.2,1.2.2,4,1.8h.8l.9-.9.2-.9-.4-.8v-.7l.6-.6.8-.4h.9l1.2-2.4.9-1.1,2.2-1.9.3-.6v-1.5l-.5-1.1,2.2.5,1.2,1.7v.5c-.1,0,.6,1.8.6,1.8l.7.4h2.1c0,.1.6-.2.6-.2l1.7-2h1c0,.1.4-.2.4-.2h1.1l.8-.3.5-.5.4-.8,1.1-.7,1.2-3.6.5-.8.4-.3,1.4.5h1.8c0,.1.8-.2.8-.2l.4-.5v-2.4c-.1,0,.4-1.9.4-1.9l.5-.9,1.1.4.5-.8.6-2.8.5-.7.7-.5h2.9c0-.1.6,0,.6,0l1.3,1.2,1,1.3v.4c-.1,0,.8,1.4.8,1.4l1,.7,1.5-.3,3.2,1.5h1.1l.6-.3.5-.7-.7-.8,1.1-1.5.3-1.7-.2-1.2.7-.6v-.5c.1,0-.2-.9-.2-.9v-.6l1-.8.6-.2h1.5l1.3-2.3,1-.5v-.8c.1,0,.5-.5.5-.5v-1.2c-.1,0,0-.4,0-.4l1-1,.6.3Z" fill="#ffc184" style="fill: rgb(255, 193, 132);"></path>
      <g id="Kampot-2" data-name="Kampot" class="tooltip" data-tooltip="kampot" style="display: none;">
        <path class="cls-4" d="M185.37,372.4c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M185.37,382.3c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M185.37,375.7l6.4-11.1h-12.8l6.4,11.1Z"></path>
        <path class="cls-9" d="M197.37,340.4h-55.2c-3.98,0-7.2,3.22-7.2,7.2v10.6c0,3.98,3.22,7.2,7.2,7.2h55.2c3.98,0,7.2-3.22,7.2-7.2v-10.6c0-3.98-3.22-7.2-7.2-7.2Z"></path>
        <path class="cls-5" d="M147.63,356.1v-8.73h1.85v3.85h.12l3.14-3.85h2.21l-3.24,3.91,3.28,4.82h-2.21l-2.39-3.59-.91,1.11v2.48h-1.85ZM157.73,356.22c-.42,0-.79-.07-1.12-.22-.33-.15-.58-.37-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6.23-.15.49-.26.78-.34.29-.08.6-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.02c0-.27-.08-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.33.09.63.22.89.4.26.18.47.41.62.69.15.28.22.61.22,1v4.42h-1.72v-.91h-.05c-.1.21-.25.39-.42.54-.18.15-.39.27-.63.36-.25.08-.53.13-.86.13ZM158.25,354.97c.27,0,.5-.05.71-.16.2-.11.36-.25.48-.43.12-.18.18-.39.18-.62v-.69c-.06.04-.13.07-.24.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15s-.28.16-.37.28c-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM162.83,356.1v-6.55h1.73v1.15h.08c.14-.38.36-.69.68-.91.32-.22.7-.33,1.14-.33s.83.11,1.15.34c.32.22.52.52.63.9h.07c.13-.38.38-.67.72-.9.35-.23.77-.34,1.25-.34.61,0,1.11.2,1.49.58.38.39.57.93.57,1.64v4.4h-1.81v-4.04c0-.36-.1-.64-.29-.82-.19-.18-.43-.27-.72-.27-.33,0-.59.11-.77.32-.18.21-.28.48-.28.82v4h-1.76v-4.08c0-.32-.09-.58-.28-.77-.18-.19-.42-.29-.72-.29-.2,0-.38.05-.54.15-.16.1-.29.24-.38.42-.09.18-.14.39-.14.63v3.93h-1.82ZM173.77,358.55v-9h1.79v1.1h.08c.08-.18.19-.35.35-.54.15-.18.35-.34.6-.46.25-.12.55-.19.92-.19.48,0,.92.12,1.32.38.4.25.73.62.97,1.12.24.5.36,1.12.36,1.87s-.12,1.35-.35,1.85c-.23.5-.55.88-.96,1.14-.4.26-.85.38-1.35.38-.35,0-.65-.06-.9-.17-.25-.12-.45-.26-.6-.44-.16-.18-.28-.36-.36-.54h-.06v3.5h-1.82ZM175.55,352.83c0,.39.05.73.16,1.02.11.29.26.51.47.68.2.16.45.24.75.24s.55-.08.75-.24c.2-.17.36-.39.46-.68.11-.29.16-.63.16-1.01s-.05-.71-.16-1c-.1-.29-.26-.51-.46-.67-.21-.16-.46-.24-.75-.24s-.55.08-.75.23c-.2.16-.36.38-.46.66-.11.29-.16.62-.16,1.01ZM184.32,356.23c-.66,0-1.23-.14-1.72-.42-.48-.28-.85-.68-1.11-1.18-.26-.51-.39-1.1-.39-1.77s.13-1.27.39-1.77c.26-.51.63-.9,1.11-1.18.48-.28,1.05-.43,1.72-.43s1.23.14,1.71.43c.48.28.86.68,1.12,1.18.26.51.39,1.1.39,1.77s-.13,1.26-.39,1.77c-.26.51-.63.9-1.12,1.18-.48.28-1.05.42-1.71.42ZM184.33,354.82c.3,0,.55-.09.75-.26.2-.17.35-.41.46-.71.1-.3.16-.64.16-1.02s-.05-.72-.16-1.02c-.1-.3-.25-.53-.46-.71-.2-.17-.45-.26-.75-.26s-.56.09-.77.26c-.21.17-.36.41-.46.71-.1.3-.15.64-.15,1.02s.05.72.15,1.02c.1.3.26.53.46.71.21.17.46.26.77.26ZM192.21,349.55v1.36h-3.94v-1.36h3.94ZM189.16,347.99h1.82v6.1c0,.17.03.3.08.39.05.09.12.15.21.19.09.04.2.06.32.06.08,0,.17,0,.26-.02.09-.02.15-.03.2-.04l.29,1.35c-.09.03-.22.06-.38.1-.17.04-.37.06-.6.07-.44.02-.82-.04-1.15-.17-.33-.13-.58-.34-.76-.62-.18-.28-.27-.64-.27-1.07v-6.34Z"></path>
      </g>
      <g id="SvayRieng-2" data-name="SvayRieng" class="tooltip" data-tooltip="svay-rieng" style="display: none;">
        <path class="cls-4" d="M347.52,348.65c-3.8,0-7,3.2-7,7s3.2,7,7,7,7-3.2,7-7-3.2-7-7-7Z"></path>
        <path class="cls-3" d="M347.52,358.55c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M347.42,352.25l6.4-11.1h-12.8l6.4,11.1Z"></path>
        <path class="cls-9" d="M400.72,317.15h-65.4c-3.65,0-6.6,2.96-6.6,6.6v11.8c0,3.65,2.95,6.6,6.6,6.6h65.4c3.64,0,6.6-2.95,6.6-6.6v-11.8c0-3.64-2.96-6.6-6.6-6.6Z"></path>
        <path class="cls-5" d="M342.97,327.52c-.03-.34-.18-.61-.44-.8-.26-.19-.61-.29-1.05-.29-.3,0-.55.04-.76.13-.21.08-.37.2-.48.35-.11.15-.16.32-.16.5,0,.16.03.29.1.41.07.12.17.22.3.3.13.08.28.15.44.22.17.06.35.11.54.15l.78.19c.38.08.73.2,1.05.34.32.14.59.32.83.52.23.21.41.45.54.73.13.28.2.6.2.97,0,.53-.14,1-.41,1.39-.27.39-.65.69-1.16.91-.5.21-1.11.32-1.82.32s-1.32-.11-1.84-.32c-.52-.22-.93-.54-1.22-.96-.29-.43-.44-.95-.46-1.58h1.79c.02.29.1.54.25.73.15.19.35.34.6.44.25.1.54.14.86.14s.58-.05.81-.14c.23-.09.41-.22.54-.38.13-.16.19-.35.19-.56,0-.2-.06-.36-.17-.49-.11-.13-.28-.25-.5-.34-.22-.09-.49-.18-.81-.26l-.95-.24c-.74-.18-1.32-.46-1.74-.84-.43-.38-.64-.89-.63-1.54,0-.53.14-.99.42-1.38.29-.39.68-.7,1.18-.92.5-.22,1.07-.33,1.7-.33s1.21.11,1.7.33c.49.22.86.53,1.13.92.27.39.41.85.42,1.37h-1.77ZM352.17,327.2l-2.29,6.54h-2.05l-2.29-6.54h1.92l1.36,4.68h.07l1.35-4.68h1.92ZM354.79,333.86c-.42,0-.79-.07-1.12-.22-.33-.15-.58-.36-.77-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6.23-.15.49-.26.78-.34.3-.08.61-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.03c0-.27-.08-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.34.08.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.11.2-.25.39-.42.54-.18.15-.39.27-.64.36-.25.09-.53.13-.86.13ZM355.31,332.61c.27,0,.5-.05.71-.16.2-.11.36-.25.48-.43.12-.18.18-.39.18-.62v-.7c-.06.04-.14.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM360.77,336.2c-.23,0-.45-.02-.65-.06-.2-.03-.36-.08-.49-.13l.41-1.35c.21.07.4.1.58.11.17,0,.32-.03.45-.12.13-.09.23-.23.31-.43l.11-.28-2.35-6.73h1.91l1.36,4.81h.07l1.37-4.81h1.92l-2.54,7.25c-.12.35-.29.66-.5.92-.21.26-.47.47-.79.61-.32.15-.7.22-1.15.22ZM369.46,333.74v-6.54h1.76v1.14h.07c.12-.41.32-.71.6-.92.28-.21.61-.31.97-.31.09,0,.19,0,.29.02.1.01.2.03.28.05v1.61c-.08-.03-.2-.05-.35-.07-.15-.02-.29-.03-.41-.03-.27,0-.51.06-.72.17-.21.11-.37.27-.49.48-.12.2-.18.44-.18.71v3.7h-1.82ZM374.37,333.74v-6.54h1.82v6.54h-1.82ZM375.28,326.35c-.27,0-.5-.09-.69-.27-.19-.18-.29-.4-.29-.65s.1-.46.29-.64c.19-.18.42-.27.69-.27s.5.09.69.27c.19.18.29.39.29.64s-.1.47-.29.65c-.19.18-.42.27-.69.27ZM380.62,333.87c-.67,0-1.25-.14-1.74-.41-.48-.28-.85-.67-1.12-1.17-.26-.51-.39-1.1-.39-1.79s.13-1.26.39-1.77c.26-.51.63-.9,1.1-1.19.48-.28,1.04-.43,1.68-.43.43,0,.83.07,1.2.21.38.14.7.34.98.62.28.28.5.62.66,1.04.16.41.23.9.23,1.46v.5h-5.53v-1.12h3.82c0-.26-.06-.49-.17-.7-.11-.2-.27-.36-.47-.47-.2-.12-.43-.18-.7-.18s-.52.06-.73.19c-.21.12-.38.29-.49.51-.12.21-.18.45-.18.7v1.07c0,.32.06.6.18.84.12.23.29.42.52.55.22.13.48.19.79.19.2,0,.39-.03.55-.09.17-.06.31-.14.43-.26.12-.11.21-.25.27-.42l1.68.11c-.08.4-.26.76-.52,1.06-.26.3-.6.53-1.01.7-.41.16-.89.25-1.43.25ZM386.62,329.96v3.78h-1.82v-6.54h1.73v1.15h.08c.14-.38.39-.68.73-.9.34-.22.76-.34,1.24-.34.46,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.24,0-.46.05-.65.16-.18.11-.33.26-.43.46-.1.2-.15.44-.16.72ZM395.22,336.33c-.59,0-1.09-.08-1.51-.24-.42-.16-.75-.38-1-.65-.25-.28-.41-.58-.48-.93l1.68-.23c.05.13.13.25.24.37.11.11.26.2.44.27.19.07.41.11.67.11.4,0,.72-.1.98-.29.26-.19.39-.51.39-.96v-1.2h-.08c-.08.18-.2.35-.36.52-.16.16-.36.29-.61.4-.25.1-.55.15-.89.15-.49,0-.94-.11-1.34-.34-.4-.23-.72-.58-.96-1.05-.24-.47-.35-1.07-.35-1.8s.12-1.36.36-1.86c.24-.5.56-.87.96-1.12.4-.25.85-.37,1.33-.37.37,0,.67.06.92.19.25.12.45.27.6.46.15.18.27.36.35.54h.07v-1.1h1.8v6.61c0,.56-.14,1.02-.41,1.4-.27.38-.65.66-1.13.84-.48.19-1.03.29-1.66.29ZM395.26,332.28c.29,0,.54-.07.74-.22.21-.15.36-.36.47-.63.11-.28.17-.61.17-.99s-.05-.72-.16-1c-.11-.28-.26-.5-.47-.66-.2-.16-.45-.23-.75-.23s-.55.08-.75.24c-.2.16-.36.38-.46.67-.11.28-.16.61-.16.98s.05.7.16.98c.11.27.26.48.46.64.2.15.46.22.75.22Z"></path>
      </g>
      <g id="Pursat-3" data-name="Pursat" class="tooltip" data-tooltip="pursat" style="display: none;">
        <path class="cls-4" d="M144.67,204.9c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M144.67,214.9c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M144.67,208.3l6.4-11.1h-12.8l6.4,11.1Z"></path>
        <path class="cls-9" d="M157.37,174.2h-43.4c-4.25,0-7.7,3.45-7.7,7.7v9.6c0,4.25,3.45,7.7,7.7,7.7h43.4c4.25,0,7.7-3.45,7.7-7.7v-9.6c0-4.25-3.45-7.7-7.7-7.7Z"></path>
        <path class="cls-5" d="M117.23,190v-8.73h3.44c.66,0,1.23.13,1.69.38.47.25.82.6,1.07,1.04.25.44.37.96.37,1.53s-.12,1.09-.38,1.53c-.25.44-.61.79-1.09,1.04-.47.25-1.04.37-1.71.37h-2.19v-1.48h1.9c.35,0,.65-.06.88-.18.23-.12.41-.3.52-.51.12-.22.18-.48.18-.76s-.06-.54-.18-.76c-.11-.22-.29-.39-.52-.51-.23-.12-.53-.18-.89-.18h-1.24v7.22h-1.85ZM129.16,187.21v-3.76h1.82v6.55h-1.74v-1.19h-.07c-.15.38-.39.69-.74.92-.34.23-.76.35-1.25.35-.44,0-.82-.1-1.15-.3-.33-.2-.59-.48-.78-.85-.18-.37-.28-.81-.28-1.32v-4.17h1.82v3.84c0,.39.11.69.31.92.21.22.48.34.82.34.22,0,.42-.05.61-.15.19-.1.34-.25.46-.45.12-.2.18-.44.17-.74ZM132.43,190v-6.55h1.76v1.14h.07c.12-.41.32-.71.6-.92.28-.21.6-.32.97-.32.09,0,.19,0,.29.02.1.01.2.03.28.05v1.61c-.08-.03-.2-.05-.35-.07-.15-.02-.29-.03-.41-.03-.27,0-.5.06-.72.18-.21.11-.37.27-.49.48-.12.21-.18.44-.18.71v3.7h-1.82ZM142.79,185.32l-1.66.1c-.03-.14-.09-.27-.18-.38-.09-.12-.22-.21-.37-.28-.15-.07-.33-.11-.54-.11-.28,0-.52.06-.71.18-.19.12-.29.27-.29.47,0,.16.06.29.19.4s.34.2.64.26l1.19.24c.64.13,1.11.34,1.42.63.31.29.47.67.47,1.14,0,.43-.13.8-.38,1.13-.25.32-.59.58-1.03.76-.43.18-.94.27-1.51.27-.87,0-1.56-.18-2.07-.54-.51-.36-.81-.86-.9-1.48l1.79-.09c.05.26.18.47.39.61.21.14.47.21.8.21s.57-.06.77-.18c.2-.12.29-.29.3-.48,0-.16-.07-.3-.21-.4-.14-.11-.35-.19-.63-.25l-1.13-.23c-.64-.13-1.11-.35-1.43-.66-.31-.32-.46-.72-.46-1.21,0-.42.11-.78.34-1.09.23-.3.55-.54.97-.7.42-.16.91-.25,1.47-.25.83,0,1.48.18,1.95.52.48.35.76.83.84,1.43ZM145.94,190.12c-.42,0-.79-.07-1.12-.22-.33-.15-.58-.37-.77-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6.23-.15.49-.26.78-.34.3-.08.6-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16s.16-.18.16-.32v-.02c0-.27-.08-.48-.25-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.08-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.34.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.1.21-.25.39-.42.54-.18.15-.39.28-.63.36-.25.08-.53.13-.86.13ZM146.46,188.87c.27,0,.5-.05.71-.16.21-.11.36-.25.48-.43.12-.18.18-.39.18-.62v-.69c-.06.04-.13.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM154.52,183.45v1.36h-3.94v-1.36h3.94ZM151.47,181.89h1.81v6.1c0,.17.03.3.08.39.05.09.12.15.21.19.09.04.2.06.32.06.09,0,.17,0,.26-.02.09-.02.15-.03.2-.04l.29,1.35c-.09.03-.22.06-.38.1-.16.04-.37.06-.6.07-.44.02-.82-.04-1.15-.17-.33-.13-.58-.34-.76-.62-.18-.28-.27-.64-.27-1.07v-6.34Z"></path>
      </g>
      <g id="KohKong-2" data-name="KohKong" class="tooltip" data-tooltip="koh-kong" style="display: none;">
        <path class="cls-4" d="M85.4,288.7c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M85.4,298.7c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M85.4,292.1l6.4-11.1h-12.8l6.4,11.1Z"></path>
        <path class="cls-9" d="M95.79,258h-57.57c-5.64,0-10.21,3.45-10.21,7.7v9.6c0,4.25,4.57,7.7,10.21,7.7h57.57c5.64,0,10.21-3.45,10.21-7.7v-9.6c0-4.25-4.57-7.7-10.21-7.7Z"></path>
        <path class="cls-5" d="M39.76,275v-8.73h1.85v3.85h.12l3.14-3.85h2.21l-3.24,3.91,3.28,4.82h-2.21l-2.39-3.59-.91,1.11v2.48h-1.85ZM50.47,275.13c-.66,0-1.23-.14-1.72-.42-.48-.28-.85-.68-1.11-1.18-.26-.51-.39-1.1-.39-1.77s.13-1.27.39-1.77c.26-.51.63-.9,1.11-1.18.48-.28,1.06-.43,1.72-.43s1.23.14,1.71.43c.48.28.86.68,1.12,1.18.26.51.39,1.1.39,1.77s-.13,1.26-.39,1.77c-.26.51-.63.9-1.12,1.18-.48.28-1.05.42-1.71.42ZM50.48,273.72c.3,0,.55-.09.75-.26.2-.17.35-.41.46-.71.11-.3.16-.64.16-1.02s-.05-.72-.16-1.02c-.1-.3-.25-.53-.46-.71-.2-.17-.45-.26-.75-.26s-.56.09-.77.26c-.2.17-.36.41-.46.71-.1.3-.15.64-.15,1.02s.05.72.15,1.02c.11.3.26.53.46.71.21.17.46.26.77.26ZM56.69,271.22v3.78h-1.82v-8.73h1.76v3.34h.08c.15-.39.39-.69.72-.91.33-.22.74-.33,1.24-.33.45,0,.85.1,1.19.3.34.2.61.48.79.85.19.37.28.81.28,1.32v4.17h-1.82v-3.84c0-.4-.1-.72-.31-.94-.2-.22-.49-.34-.86-.34-.25,0-.47.05-.66.16-.19.1-.34.26-.44.46-.11.2-.16.44-.16.72ZM65.18,275v-8.73h1.85v3.85h.12l3.14-3.85h2.21l-3.24,3.91,3.28,4.82h-2.21l-2.39-3.59-.91,1.11v2.48h-1.85ZM75.89,275.13c-.66,0-1.23-.14-1.72-.42-.48-.28-.85-.68-1.11-1.18-.26-.51-.39-1.1-.39-1.77s.13-1.27.39-1.77c.26-.51.63-.9,1.11-1.18.48-.28,1.06-.43,1.72-.43s1.23.14,1.71.43c.48.28.86.68,1.12,1.18.26.51.39,1.1.39,1.77s-.13,1.26-.39,1.77c-.26.51-.63.9-1.12,1.18-.48.28-1.05.42-1.71.42ZM75.9,273.72c.3,0,.55-.09.75-.26.2-.17.35-.41.46-.71.11-.3.16-.64.16-1.02s-.05-.72-.16-1.02c-.1-.3-.25-.53-.46-.71-.2-.17-.45-.26-.75-.26s-.56.09-.77.26c-.2.17-.36.41-.46.71-.1.3-.15.64-.15,1.02s.05.72.15,1.02c.11.3.26.53.46.71.21.17.46.26.77.26ZM82.11,271.22v3.78h-1.82v-6.55h1.73v1.15h.08c.14-.38.39-.68.73-.9.34-.22.75-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.24,0-.46.05-.65.16-.18.1-.33.26-.43.46-.1.2-.15.44-.16.72ZM90.71,277.59c-.59,0-1.09-.08-1.51-.24-.42-.16-.75-.38-1-.65-.25-.28-.41-.59-.48-.93l1.68-.23c.05.13.13.25.24.37.11.11.26.2.44.27.18.07.41.11.67.11.39,0,.72-.1.98-.29.26-.19.39-.51.39-.96v-1.2h-.08c-.08.18-.2.35-.36.52-.16.16-.36.29-.61.4-.25.1-.55.15-.89.15-.49,0-.94-.11-1.34-.34-.4-.23-.72-.58-.96-1.05-.24-.48-.35-1.07-.35-1.8s.12-1.36.36-1.86c.24-.5.56-.87.96-1.12.4-.25.85-.37,1.33-.37.37,0,.67.06.92.19.25.12.45.27.6.46.15.18.27.36.35.54h.07v-1.1h1.8v6.61c0,.56-.14,1.02-.41,1.4-.27.38-.65.66-1.13.84-.48.19-1.03.29-1.66.29ZM90.75,273.54c.29,0,.54-.07.74-.22.2-.15.36-.36.47-.63.11-.28.17-.61.17-.99s-.05-.72-.16-1c-.11-.28-.26-.5-.47-.66-.2-.16-.45-.23-.75-.23s-.55.08-.75.24c-.2.16-.36.38-.46.66-.11.28-.16.61-.16.98s.05.71.16.98c.11.27.26.48.46.64.2.15.46.22.75.22Z"></path>
      </g>
      <g id="UddorMeanchey-2" data-name="UddorMeanchey" class="tooltip" data-tooltip="uddor-meanchey" style="display: none;">
        <path class="cls-4" d="M118.57,45.3c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M118.57,55.2c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M118.57,48.7l6.4-11.1h-12.8l6.4,11.1Z"></path>
        <path class="cls-9" d="M126.37,14.2H22.87c-4.58,0-8.3,3.72-8.3,8.3v8.4c0,4.58,3.72,8.3,8.3,8.3h103.5c4.58,0,8.3-3.72,8.3-8.3v-8.4c0-4.58-3.72-8.3-8.3-8.3Z"></path>
        <path class="cls-5" d="M30.72,21.27h1.85v5.67c0,.64-.15,1.19-.46,1.67-.3.48-.72.85-1.27,1.12-.54.26-1.17.4-1.9.4s-1.36-.13-1.9-.4c-.54-.27-.96-.64-1.27-1.12-.3-.48-.45-1.03-.45-1.67v-5.67h1.85v5.51c0,.33.07.63.22.89.15.26.36.46.62.61.27.15.58.22.93.22s.67-.07.93-.22c.27-.15.47-.35.62-.61.15-.26.22-.55.22-.89v-5.51ZM36.46,30.11c-.5,0-.95-.13-1.35-.38-.4-.26-.72-.64-.95-1.14-.23-.5-.35-1.12-.35-1.85s.12-1.37.36-1.87c.24-.5.56-.87.96-1.12.4-.25.85-.38,1.33-.38.37,0,.67.06.92.19.25.12.45.28.6.46.15.18.27.36.35.54h.06v-3.28h1.81v8.73h-1.79v-1.05h-.08c-.09.18-.21.36-.36.54-.15.18-.35.32-.6.44-.24.12-.54.17-.89.17ZM37.04,28.66c.29,0,.54-.08.74-.24.2-.16.36-.39.47-.68.11-.29.17-.63.17-1.02s-.05-.73-.16-1.01c-.11-.29-.26-.51-.47-.66-.2-.16-.45-.23-.75-.23s-.55.08-.75.24c-.2.16-.36.39-.46.67-.11.29-.16.62-.16,1s.05.72.16,1.01c.11.29.26.52.46.68.2.16.46.24.75.24ZM44.09,30.11c-.5,0-.95-.13-1.35-.38-.4-.26-.72-.64-.95-1.14-.23-.5-.35-1.12-.35-1.85s.12-1.37.36-1.87c.24-.5.56-.87.96-1.12.4-.25.85-.38,1.33-.38.37,0,.67.06.92.19.25.12.45.28.6.46.15.18.27.36.35.54h.06v-3.28h1.81v8.73h-1.79v-1.05h-.08c-.09.18-.21.36-.36.54-.15.18-.35.32-.6.44-.24.12-.54.17-.89.17ZM44.66,28.66c.29,0,.54-.08.74-.24.2-.16.36-.39.47-.68.11-.29.17-.63.17-1.02s-.05-.73-.16-1.01c-.11-.29-.26-.51-.47-.66-.2-.16-.45-.23-.75-.23s-.55.08-.75.24c-.2.16-.36.39-.46.67-.11.29-.16.62-.16,1s.05.72.16,1.01c.11.29.26.52.46.68.2.16.46.24.75.24ZM52.26,30.13c-.66,0-1.23-.14-1.72-.42-.48-.28-.85-.68-1.11-1.18-.26-.51-.39-1.1-.39-1.77s.13-1.27.39-1.77c.26-.51.63-.9,1.11-1.18.48-.28,1.06-.43,1.72-.43s1.23.14,1.71.43c.48.28.86.68,1.12,1.18.26.51.39,1.1.39,1.77s-.13,1.26-.39,1.77c-.26.51-.63.9-1.12,1.18-.48.28-1.05.42-1.71.42ZM52.27,28.72c.3,0,.55-.09.75-.26.2-.17.35-.41.46-.71.11-.3.16-.64.16-1.02s-.05-.72-.16-1.02c-.1-.3-.25-.53-.46-.71-.2-.17-.45-.26-.75-.26s-.56.09-.77.26c-.2.17-.36.41-.46.71-.1.3-.15.64-.15,1.02s.05.72.15,1.02c.11.3.26.53.46.71.21.17.46.26.77.26ZM56.67,30v-6.55h1.76v1.14h.07c.12-.41.32-.71.6-.92.28-.21.61-.32.97-.32.09,0,.19,0,.29.02.11.01.2.03.28.05v1.61c-.09-.03-.2-.05-.35-.07s-.29-.03-.41-.03c-.27,0-.51.06-.72.17-.21.11-.37.27-.49.48-.12.2-.18.44-.18.71v3.7h-1.82ZM64.39,21.27h2.28l2.4,5.86h.1l2.4-5.86h2.28v8.73h-1.79v-5.68h-.07l-2.26,5.64h-1.22l-2.26-5.66h-.07v5.7h-1.79v-8.73ZM78.32,30.13c-.67,0-1.25-.14-1.74-.41-.48-.28-.86-.66-1.12-1.17-.26-.51-.39-1.1-.39-1.79s.13-1.26.39-1.77c.26-.51.63-.9,1.1-1.19.48-.28,1.04-.43,1.68-.43.43,0,.83.07,1.21.21.38.14.7.34.98.62.28.28.5.62.66,1.04.16.41.23.9.23,1.46v.5h-5.53v-1.12h3.82c0-.26-.06-.49-.17-.69-.11-.2-.27-.36-.47-.47-.2-.12-.43-.17-.69-.17s-.52.06-.73.19c-.21.12-.38.29-.49.51-.12.21-.18.44-.18.7v1.07c0,.32.06.6.18.84.12.24.29.42.52.55.22.13.48.19.79.19.2,0,.39-.03.55-.09.17-.06.31-.14.43-.26.12-.11.21-.25.27-.42l1.68.11c-.09.4-.26.76-.52,1.06-.26.3-.6.53-1.01.7-.41.16-.89.25-1.43.25ZM84.37,30.12c-.42,0-.79-.07-1.12-.22-.33-.15-.59-.36-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6.23-.15.49-.26.78-.34.3-.08.61-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.03c0-.27-.09-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.34.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.11.2-.25.39-.42.54-.18.15-.39.27-.64.36-.25.09-.53.13-.86.13ZM84.89,28.87c.27,0,.5-.05.71-.16.2-.11.37-.25.48-.43.12-.18.17-.39.17-.62v-.69c-.06.04-.13.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM91.28,26.22v3.78h-1.82v-6.55h1.73v1.15h.08c.14-.38.39-.68.73-.9.34-.22.75-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.24,0-.46.05-.65.16-.18.11-.33.26-.43.46-.1.2-.15.44-.16.72ZM99.89,30.13c-.67,0-1.25-.14-1.73-.43-.48-.29-.85-.68-1.11-1.19-.26-.51-.38-1.09-.38-1.76s.13-1.26.39-1.76c.26-.51.63-.9,1.11-1.19.48-.29,1.05-.43,1.71-.43.57,0,1.07.1,1.5.31.43.21.77.5,1.02.87s.39.82.41,1.32h-1.71c-.05-.33-.18-.59-.38-.79-.2-.2-.47-.3-.81-.3-.28,0-.53.08-.74.23-.21.15-.37.37-.49.66-.12.29-.17.64-.17,1.05s.06.77.17,1.07c.12.29.28.52.49.67.21.15.46.23.74.23.21,0,.39-.04.56-.13.17-.09.31-.21.41-.37.11-.16.18-.36.22-.59h1.71c-.03.5-.16.94-.41,1.32-.24.38-.57.67-1,.89-.43.21-.93.32-1.51.32ZM105.79,26.22v3.78h-1.82v-8.73h1.76v3.34h.08c.15-.39.39-.69.72-.91.33-.22.74-.33,1.24-.33.45,0,.85.1,1.19.3.34.2.61.48.79.85.19.37.28.81.28,1.32v4.17h-1.81v-3.84c0-.4-.1-.72-.31-.94-.21-.22-.49-.34-.86-.34-.25,0-.47.05-.66.16-.19.11-.34.26-.44.46-.1.2-.16.44-.16.72Z"></path>
        <path class="cls-5" d="M114.38,30.13c-.67,0-1.25-.14-1.74-.41-.48-.28-.86-.66-1.12-1.17-.26-.51-.39-1.1-.39-1.79s.13-1.26.39-1.77c.26-.51.63-.9,1.1-1.19.48-.28,1.04-.43,1.68-.43.43,0,.83.07,1.21.21.38.14.7.34.98.62.28.28.5.62.66,1.04.16.41.24.9.24,1.46v.5h-5.53v-1.12h3.82c0-.26-.06-.49-.17-.69-.11-.2-.27-.36-.47-.47-.2-.12-.43-.17-.69-.17s-.52.06-.73.19c-.21.12-.38.29-.49.51-.12.21-.18.44-.18.7v1.07c0,.32.06.6.18.84.12.24.29.42.52.55.22.13.48.19.79.19.2,0,.39-.03.55-.09.17-.06.31-.14.43-.26.12-.11.21-.25.27-.42l1.68.11c-.08.4-.26.76-.52,1.06-.26.3-.6.53-1.01.7-.41.16-.89.25-1.43.25Z"></path>
        <path class="cls-5" d="M119.51,32.45c-.23,0-.45-.02-.65-.06-.2-.03-.36-.08-.49-.13l.41-1.36c.21.07.4.1.58.11.17,0,.32-.03.45-.12.13-.09.23-.23.31-.43l.11-.28-2.35-6.73h1.91l1.36,4.81h.07l1.37-4.81h1.92l-2.54,7.25c-.12.35-.29.66-.5.92-.21.26-.47.47-.79.61-.32.14-.7.22-1.15.22Z"></path>
      </g>
      <g id="BanteayMeanchey-2" data-name="BanteayMeanchey" class="tooltip" data-tooltip="banteay-meanchey" style="display: none;">
        <path class="cls-4" d="M56.77,87.5c-3.8,0-7,3.1-7,7s3.2,7,7,7,7-3.1,7-7-3.2-7-7-7Z"></path>
        <path class="cls-3" d="M56.77,97.4c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M56.77,90.9l7-11.1h-14l7,11.1Z"></path>
        <path class="cls-9" d="M156.87,55.2H42.07c-4.58,0-8.3,3.72-8.3,8.3v8.4c0,4.58,3.72,8.3,8.3,8.3h114.8c4.58,0,8.3-3.72,8.3-8.3v-8.4c0-4.58-3.72-8.3-8.3-8.3Z"></path>
        <path class="cls-5" d="M44.33,71v-8.73h3.49c.64,0,1.18.1,1.61.29.43.19.75.45.97.79.22.34.32.72.32,1.16,0,.34-.07.64-.2.9-.14.26-.32.47-.56.63-.24.16-.51.28-.81.35v.09c.33.01.64.11.93.28.29.17.53.42.71.73.18.31.27.68.27,1.11,0,.46-.12.88-.35,1.24-.23.36-.56.65-1.01.86-.45.21-1,.32-1.65.32h-3.73ZM46.17,69.49h1.5c.51,0,.89-.1,1.12-.29.24-.2.35-.46.35-.79,0-.24-.06-.45-.17-.64-.12-.18-.28-.33-.5-.43-.21-.11-.47-.16-.76-.16h-1.55v2.32ZM46.17,65.92h1.37c.25,0,.48-.04.67-.13.2-.09.36-.22.47-.38.12-.16.17-.36.17-.59,0-.32-.11-.57-.34-.76-.22-.19-.54-.29-.95-.29h-1.4v2.16ZM54.09,71.12c-.42,0-.79-.07-1.12-.22-.33-.15-.59-.36-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6.23-.15.49-.26.78-.34.3-.08.61-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.03c0-.27-.09-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.34.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.11.2-.25.38-.42.54-.18.15-.39.27-.63.36-.25.09-.53.13-.86.13ZM54.61,69.87c.27,0,.5-.05.71-.16.2-.11.37-.25.48-.43.12-.18.17-.39.17-.62v-.69c-.06.04-.13.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15s-.28.16-.37.28c-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM61,67.22v3.78h-1.82v-6.55h1.73v1.15h.08c.14-.38.39-.68.73-.9.34-.22.75-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.24,0-.46.05-.65.16-.18.11-.33.26-.43.46-.1.2-.15.44-.16.72Z"></path>
        <path class="cls-5" d="M70.08,64.45v1.36h-3.94v-1.36h3.94ZM67.03,62.89h1.82v6.1c0,.17.03.3.08.39.05.09.12.15.21.19.09.04.2.06.32.06.09,0,.17,0,.26-.02.09-.02.15-.03.2-.04l.29,1.35c-.09.03-.22.06-.38.1-.16.04-.37.06-.6.07-.44.02-.82-.04-1.15-.17-.33-.13-.58-.34-.76-.62-.18-.28-.27-.64-.27-1.07v-6.34Z"></path>
        <path class="cls-5" d="M74.18,71.13c-.67,0-1.25-.14-1.74-.41-.48-.28-.86-.66-1.12-1.17-.26-.51-.39-1.1-.39-1.79s.13-1.26.39-1.77c.26-.51.63-.9,1.1-1.19.48-.28,1.04-.43,1.68-.43.43,0,.83.07,1.21.21.38.14.7.34.98.62.28.28.5.62.66,1.04.16.41.23.9.23,1.46v.5h-5.53v-1.12h3.82c0-.26-.06-.49-.17-.69-.11-.2-.27-.36-.47-.47-.2-.12-.43-.17-.69-.17s-.52.06-.73.19c-.21.12-.38.29-.49.51-.12.21-.18.44-.18.7v1.07c0,.32.06.6.18.84.12.24.29.42.52.55.22.13.48.19.79.19.2,0,.39-.03.55-.09s.31-.14.43-.26c.12-.11.21-.25.27-.42l1.68.11c-.09.4-.26.76-.52,1.06-.26.3-.6.53-1.01.7-.41.16-.89.25-1.43.25Z"></path>
        <path class="cls-5" d="M80.26,71.12c-.42,0-.79-.07-1.12-.22-.33-.15-.59-.36-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6.23-.15.49-.26.78-.34.3-.08.61-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16s.16-.18.16-.32v-.03c0-.27-.09-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.34.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.11.2-.25.38-.42.54-.18.15-.39.27-.63.36-.25.09-.53.13-.86.13ZM80.78,69.87c.27,0,.5-.05.71-.16.2-.11.37-.25.48-.43.12-.18.17-.39.17-.62v-.69c-.06.04-.14.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19Z"></path>
        <path class="cls-5" d="M86.22,73.45c-.23,0-.45-.02-.65-.06-.2-.03-.36-.08-.49-.13l.41-1.36c.21.07.4.1.58.11.17,0,.32-.03.45-.12.13-.09.23-.23.31-.43l.11-.28-2.35-6.73h1.91l1.36,4.81h.07l1.37-4.81h1.92l-2.54,7.25c-.12.35-.29.66-.5.92-.21.26-.47.47-.79.61-.32.14-.7.22-1.15.22ZM94.94,62.27h2.28l2.4,5.86h.1l2.4-5.86h2.28v8.73h-1.79v-5.68h-.07l-2.26,5.64h-1.22l-2.26-5.66h-.07v5.7h-1.79v-8.73ZM108.87,71.13c-.67,0-1.25-.14-1.74-.41-.48-.28-.85-.66-1.12-1.17-.26-.51-.39-1.1-.39-1.79s.13-1.26.39-1.77c.26-.51.63-.9,1.1-1.19.48-.28,1.04-.43,1.68-.43.43,0,.83.07,1.21.21.38.14.7.34.98.62.28.28.5.62.66,1.04.16.41.24.9.24,1.46v.5h-5.53v-1.12h3.82c0-.26-.06-.49-.17-.69-.11-.2-.27-.36-.47-.47-.2-.12-.43-.17-.69-.17s-.52.06-.73.19c-.21.12-.38.29-.49.51-.12.21-.18.44-.18.7v1.07c0,.32.06.6.18.84.12.24.29.42.52.55.22.13.48.19.79.19.2,0,.39-.03.55-.09.17-.06.31-.14.43-.26.12-.11.21-.25.27-.42l1.68.11c-.08.4-.26.76-.52,1.06-.26.3-.6.53-1.01.7-.41.16-.89.25-1.43.25ZM114.92,71.12c-.42,0-.79-.07-1.12-.22-.33-.15-.58-.36-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6.23-.15.49-.26.78-.34.3-.08.61-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.1-.07.16-.18.16-.32v-.03c0-.27-.09-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.33.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.1.2-.25.38-.42.54-.18.15-.39.27-.64.36-.25.09-.53.13-.86.13ZM115.44,69.87c.27,0,.5-.05.71-.16.2-.11.36-.25.48-.43.12-.18.17-.39.17-.62v-.69c-.06.04-.14.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15s-.28.16-.37.28c-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM121.83,67.22v3.78h-1.82v-6.55h1.73v1.15h.08c.15-.38.39-.68.73-.9.34-.22.75-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.24,0-.46.05-.65.16-.19.11-.33.26-.44.46-.1.2-.15.44-.16.72ZM130.44,71.13c-.67,0-1.25-.14-1.73-.43-.48-.29-.85-.68-1.11-1.19-.25-.51-.38-1.09-.38-1.76s.13-1.26.39-1.76c.26-.51.63-.9,1.11-1.19.48-.29,1.05-.43,1.71-.43.57,0,1.07.1,1.5.31.43.21.77.5,1.02.87s.39.82.41,1.32h-1.71c-.05-.33-.18-.59-.38-.79-.2-.2-.47-.3-.8-.3-.28,0-.53.08-.74.23-.21.15-.37.37-.49.66-.12.29-.18.64-.18,1.05s.06.77.17,1.07c.12.29.28.52.49.67.21.15.46.23.74.23.21,0,.39-.04.56-.13.17-.09.3-.21.41-.37.11-.16.18-.36.22-.59h1.71c-.03.5-.16.94-.41,1.32-.24.38-.58.67-1,.89-.43.21-.93.32-1.51.32ZM136.34,67.22v3.78h-1.82v-8.73h1.76v3.34h.08c.15-.39.39-.69.72-.91.33-.22.74-.33,1.24-.33.46,0,.85.1,1.19.3.34.2.61.48.79.85.19.37.28.81.28,1.32v4.17h-1.82v-3.84c0-.4-.1-.72-.31-.94-.21-.22-.49-.34-.86-.34-.25,0-.47.05-.66.16-.19.11-.34.26-.44.46-.11.2-.16.44-.16.72Z"></path>
        <path class="cls-5" d="M144.98,71.13c-.67,0-1.25-.14-1.74-.41-.48-.28-.85-.66-1.12-1.17-.26-.51-.39-1.1-.39-1.79s.13-1.26.39-1.77c.26-.51.63-.9,1.1-1.19.48-.28,1.04-.43,1.68-.43.43,0,.83.07,1.21.21.38.14.7.34.98.62.28.28.5.62.66,1.04.16.41.24.9.24,1.46v.5h-5.53v-1.12h3.82c0-.26-.06-.49-.17-.69-.11-.2-.27-.36-.47-.47-.2-.12-.43-.17-.69-.17s-.52.06-.73.19c-.21.12-.38.29-.49.51-.12.21-.18.44-.18.7v1.07c0,.32.06.6.18.84.12.24.29.42.52.55.22.13.48.19.79.19.2,0,.39-.03.55-.09.17-.06.31-.14.43-.26.12-.11.21-.25.27-.42l1.68.11c-.08.4-.26.76-.52,1.06-.26.3-.6.53-1.01.7-.41.16-.89.25-1.43.25Z"></path>
        <path class="cls-5" d="M150.52,72.33c-.22,0-.42-.02-.61-.05-.19-.03-.35-.07-.47-.13l.39-1.29c.2.06.38.1.55.1.16,0,.31-.03.42-.11.12-.08.22-.22.3-.41l.1-.26-2.23-6.39h1.81l1.29,4.56h.06l1.3-4.56h1.82l-2.41,6.88c-.12.33-.27.63-.47.87-.2.25-.45.44-.75.58-.3.14-.67.21-1.09.21Z"></path>
      </g>
      <g id="SiemReap-2" data-name="SiemReap" class="tooltip" data-tooltip="siem-reap" style="display: none;">
        <path class="cls-4" d="M170.57,119c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M170.57,128.9c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M170.57,122.3l6.4-11.1h-12.8l6.4,11.1Z"></path>
        <path class="cls-9" d="M179.37,87.9h-69.5c-4.2,0-7.6,3.4-7.6,7.6v9.7c0,4.2,3.4,7.6,7.6,7.6h69.5c4.2,0,7.6-3.4,7.6-7.6v-9.7c0-4.2-3.4-7.6-7.6-7.6Z"></path>
        <path class="cls-5" d="M119.36,97.38c-.03-.34-.18-.61-.44-.8-.26-.19-.61-.29-1.05-.29-.3,0-.56.04-.76.13-.21.08-.37.2-.48.35-.11.15-.16.32-.16.5,0,.16.03.29.1.41.07.12.17.22.3.3.13.08.28.15.44.22.17.06.35.11.54.15l.78.19c.38.09.73.2,1.05.34.32.14.59.32.83.52.23.21.41.45.54.73.13.28.2.6.2.97,0,.53-.14,1-.41,1.39-.27.39-.65.69-1.16.91-.5.21-1.11.32-1.82.32s-1.32-.11-1.84-.32c-.52-.22-.93-.54-1.22-.96-.29-.43-.44-.95-.46-1.58h1.79c.02.29.1.54.25.73.15.19.35.34.6.44.25.1.54.15.86.15s.58-.05.81-.14c.23-.09.41-.22.54-.38.13-.16.19-.35.19-.56,0-.2-.06-.36-.17-.49-.11-.13-.28-.25-.5-.34-.22-.09-.49-.18-.81-.26l-.95-.24c-.74-.18-1.32-.46-1.74-.84-.43-.38-.64-.89-.63-1.54,0-.53.14-.99.42-1.38.29-.39.68-.7,1.18-.92.5-.22,1.07-.33,1.7-.33s1.21.11,1.7.33c.49.22.86.53,1.13.92.27.39.41.85.42,1.37h-1.77ZM122.46,103.6v-6.55h1.82v6.55h-1.82ZM123.37,96.21c-.27,0-.5-.09-.69-.27-.19-.18-.29-.4-.29-.65s.1-.46.29-.64c.19-.18.42-.27.69-.27s.5.09.69.27c.19.18.29.39.29.64s-.1.47-.29.65c-.19.18-.42.27-.69.27ZM128.71,103.73c-.67,0-1.25-.14-1.74-.41-.48-.28-.86-.67-1.12-1.17-.26-.51-.39-1.1-.39-1.79s.13-1.26.39-1.77c.26-.51.63-.9,1.1-1.19.48-.28,1.04-.43,1.68-.43.43,0,.83.07,1.21.21.38.14.7.34.98.62.28.28.5.62.66,1.04.16.41.23.9.23,1.46v.5h-5.53v-1.13h3.82c0-.26-.06-.49-.17-.69-.11-.2-.27-.36-.47-.47-.2-.12-.43-.17-.69-.17s-.52.06-.73.19c-.21.12-.38.29-.49.51-.12.21-.18.44-.18.7v1.07c0,.32.06.6.18.84.12.24.29.42.52.55.22.13.48.19.79.19.2,0,.39-.03.55-.09.17-.06.31-.14.43-.26.12-.11.21-.25.27-.42l1.68.11c-.08.4-.26.76-.52,1.06-.26.3-.6.53-1.01.7-.41.16-.89.25-1.43.25ZM132.9,103.6v-6.55h1.73v1.15h.08c.14-.38.36-.69.68-.91.32-.22.7-.33,1.14-.33s.83.11,1.15.34c.32.22.53.52.63.9h.07c.13-.38.38-.67.72-.9.35-.23.77-.34,1.25-.34.61,0,1.11.19,1.49.58.38.39.57.93.57,1.64v4.4h-1.81v-4.04c0-.36-.1-.64-.29-.82-.19-.18-.43-.27-.72-.27-.33,0-.59.11-.77.32-.18.21-.28.48-.28.82v4h-1.76v-4.08c0-.32-.09-.58-.28-.77-.18-.19-.42-.29-.72-.29-.2,0-.38.05-.55.15-.16.1-.28.24-.38.42-.09.18-.14.39-.14.63v3.93h-1.82Z"></path>
        <path class="cls-5" d="M146.63,103.6v-8.73h3.44c.66,0,1.22.12,1.69.35.47.23.82.56,1.07.99.25.43.37.93.37,1.5s-.12,1.08-.38,1.5c-.25.41-.61.73-1.09.95-.47.22-1.04.33-1.71.33h-2.31v-1.48h2.01c.35,0,.64-.05.88-.14.23-.1.41-.24.52-.43.12-.19.18-.43.18-.72s-.06-.53-.18-.73c-.11-.2-.29-.35-.52-.45-.23-.11-.53-.16-.88-.16h-1.24v7.22h-1.85ZM151.34,99.63l2.17,3.97h-2.04l-2.12-3.97h1.99Z"></path>
        <path class="cls-5" d="M157.38,103.73c-.67,0-1.25-.14-1.74-.41-.48-.28-.86-.67-1.12-1.17-.26-.51-.39-1.1-.39-1.79s.13-1.26.39-1.77c.26-.51.63-.9,1.1-1.19.48-.28,1.04-.43,1.68-.43.43,0,.83.07,1.21.21.38.14.7.34.98.62.28.28.5.62.66,1.04.16.41.24.9.24,1.46v.5h-5.53v-1.13h3.82c0-.26-.06-.49-.17-.69-.11-.2-.27-.36-.47-.47-.2-.12-.43-.17-.69-.17s-.52.06-.73.19c-.21.12-.38.29-.49.51-.12.21-.18.44-.18.7v1.07c0,.32.06.6.18.84.12.24.29.42.52.55.22.13.48.19.79.19.2,0,.39-.03.55-.09.17-.06.31-.14.43-.26.12-.11.21-.25.27-.42l1.68.11c-.09.4-.26.76-.52,1.06-.26.3-.6.53-1.01.7-.41.16-.89.25-1.43.25ZM163.43,103.72c-.42,0-.79-.07-1.12-.22-.33-.15-.58-.36-.77-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.31-.45.54-.6.23-.15.49-.26.78-.34.3-.08.6-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.03c0-.27-.09-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.08-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.34.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.1.21-.25.39-.42.54-.18.15-.39.28-.63.36-.25.08-.53.13-.86.13ZM163.95,102.47c.27,0,.5-.05.71-.16.21-.11.36-.25.48-.44.12-.18.17-.39.17-.62v-.69c-.06.04-.13.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM168.53,106.06v-9h1.79v1.1h.08c.08-.18.2-.36.35-.54.15-.18.35-.34.6-.46.25-.12.55-.19.92-.19.48,0,.92.12,1.32.38.4.25.73.62.97,1.12.24.5.36,1.12.36,1.87s-.12,1.35-.35,1.85c-.23.5-.55.88-.95,1.14-.4.26-.85.38-1.35.38-.35,0-.65-.06-.9-.18-.24-.12-.44-.26-.6-.44-.16-.18-.28-.36-.36-.54h-.05v3.5h-1.82ZM170.3,100.33c0,.39.05.73.16,1.02.11.29.26.51.47.68.21.16.45.24.75.24s.54-.08.75-.24c.2-.17.36-.39.46-.68.11-.29.16-.63.16-1.01s-.05-.71-.16-1c-.1-.29-.26-.51-.46-.67s-.46-.24-.75-.24-.55.08-.75.23c-.2.16-.36.38-.46.66-.11.29-.16.62-.16,1.01Z"></path>
      </g>
      <g id="PreahVihear-2" data-name="PreahVihear" class="tooltip" data-tooltip="preah-vihear" style="display: none;">
        <path class="cls-4" d="M273.17,103.8c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M273.17,113.7c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M272.97,107.1l5.3-11.1h-10.7l5.3,11.1h.1Z"></path>
        <path class="cls-9" d="M289.57,72.7h-85.1c-4.09,0-7.4,3.31-7.4,7.4v10.4c0,4.09,3.31,7.4,7.4,7.4h85.1c4.09,0,7.4-3.31,7.4-7.4v-10.4c0-4.09-3.31-7.4-7.4-7.4Z"></path>
        <path class="cls-5" d="M210.03,88.6v-8.73h3.44c.66,0,1.23.13,1.69.38.47.25.82.6,1.07,1.04.25.44.37.95.37,1.53s-.12,1.09-.38,1.53-.61.79-1.09,1.04c-.47.25-1.04.37-1.71.37h-2.2v-1.48h1.9c.35,0,.65-.06.88-.18.23-.12.41-.3.52-.52.12-.22.18-.48.18-.76s-.06-.54-.18-.76c-.11-.22-.29-.39-.52-.51-.23-.12-.53-.18-.89-.18h-1.24v7.22h-1.84Z"></path>
        <path class="cls-5" d="M217.7,88.6v-6.55h1.76v1.14h.07c.12-.41.32-.71.6-.92.28-.21.61-.32.97-.32.09,0,.19,0,.29.02.1.01.2.03.28.05v1.61c-.09-.03-.2-.05-.35-.07-.15-.02-.29-.03-.41-.03-.27,0-.51.06-.72.17-.21.11-.37.27-.49.48-.12.2-.18.44-.18.71v3.7h-1.81Z"></path>
        <path class="cls-5" d="M225.28,88.73c-.67,0-1.25-.14-1.74-.41-.48-.28-.85-.66-1.12-1.17-.26-.51-.39-1.1-.39-1.79s.13-1.26.39-1.77c.26-.51.63-.9,1.1-1.19.48-.28,1.04-.43,1.68-.43.43,0,.83.07,1.21.21.38.14.7.34.98.62.28.28.5.62.66,1.04.16.41.24.9.24,1.46v.5h-5.53v-1.12h3.82c0-.26-.06-.49-.17-.69-.11-.2-.27-.36-.47-.47-.2-.12-.43-.17-.69-.17s-.52.06-.73.19c-.21.12-.38.29-.49.51-.12.21-.18.44-.18.7v1.07c0,.32.06.6.18.84.12.24.29.42.52.55.22.13.48.19.79.19.2,0,.39-.03.55-.09.17-.06.31-.14.43-.26.12-.11.21-.25.27-.42l1.68.11c-.08.4-.26.76-.52,1.06-.26.3-.6.53-1.01.7-.41.16-.89.25-1.43.25ZM231.33,88.72c-.42,0-.79-.07-1.12-.22-.33-.15-.59-.37-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.54-.6.23-.15.49-.26.78-.34.3-.08.61-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.1-.07.16-.18.16-.32v-.03c0-.27-.09-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.33.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.1.2-.25.38-.42.54-.18.15-.39.27-.64.36-.25.09-.53.13-.86.13ZM231.85,87.47c.27,0,.5-.05.71-.16.21-.11.37-.25.48-.43.12-.18.17-.39.17-.62v-.69c-.06.04-.14.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM238.24,84.82v3.78h-1.82v-8.73h1.76v3.34h.08c.15-.39.39-.69.72-.91.33-.22.74-.33,1.24-.33.46,0,.85.1,1.19.3.34.2.61.48.79.85.19.37.28.81.28,1.32v4.17h-1.82v-3.84c0-.4-.1-.72-.31-.94-.21-.22-.49-.34-.86-.34-.25,0-.47.05-.66.16-.19.11-.34.26-.44.46-.11.2-.16.44-.16.72ZM248.3,79.87l2.11,6.63h.08l2.11-6.63h2.04l-3.01,8.73h-2.38l-3.01-8.73h2.05ZM255.67,88.6v-6.55h1.81v6.55h-1.81ZM256.58,81.21c-.27,0-.5-.09-.69-.27-.19-.18-.29-.4-.29-.65s.1-.46.29-.64c.19-.18.43-.27.69-.27s.5.09.69.27c.19.18.29.39.29.64s-.1.47-.29.65c-.19.18-.42.27-.69.27ZM260.75,84.82v3.78h-1.82v-8.73h1.76v3.34h.08c.15-.39.39-.69.72-.91.33-.22.74-.33,1.24-.33.45,0,.85.1,1.19.3.34.2.61.48.79.85.19.37.29.81.28,1.32v4.17h-1.82v-3.84c0-.4-.1-.72-.31-.94-.21-.22-.49-.34-.86-.34-.25,0-.47.05-.66.16-.19.11-.34.26-.44.46-.1.2-.16.44-.16.72ZM269.41,88.73c-.67,0-1.25-.14-1.74-.41-.48-.28-.86-.66-1.12-1.17-.26-.51-.39-1.1-.39-1.79s.13-1.26.39-1.77c.26-.51.63-.9,1.1-1.19.48-.28,1.04-.43,1.68-.43.43,0,.83.07,1.21.21.38.14.7.34.98.62.28.28.5.62.66,1.04.16.41.24.9.24,1.46v.5h-5.53v-1.12h3.82c0-.26-.06-.49-.17-.69-.11-.2-.27-.36-.47-.47-.2-.12-.43-.17-.69-.17s-.52.06-.73.19c-.21.12-.38.29-.49.51-.12.21-.18.44-.18.7v1.07c0,.32.06.6.18.84.12.24.29.42.52.55.22.13.48.19.79.19.2,0,.39-.03.55-.09s.31-.14.43-.26c.12-.11.21-.25.27-.42l1.68.11c-.09.4-.26.76-.52,1.06-.26.3-.6.53-1.01.7-.41.16-.89.25-1.43.25ZM275.47,88.72c-.42,0-.79-.07-1.12-.22-.33-.15-.58-.37-.77-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.54-.6.23-.15.49-.26.78-.34.3-.08.61-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.03c0-.27-.08-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.34.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.11.2-.25.38-.42.54-.18.15-.39.27-.64.36-.25.09-.53.13-.86.13ZM275.99,87.47c.27,0,.5-.05.71-.16.2-.11.37-.25.48-.43.12-.18.17-.39.17-.62v-.69c-.06.04-.14.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM280.56,88.6v-6.55h1.76v1.14h.07c.12-.41.32-.71.6-.92.28-.21.6-.32.97-.32.09,0,.19,0,.29.02.1.01.2.03.28.05v1.61c-.09-.03-.2-.05-.35-.07s-.29-.03-.41-.03c-.27,0-.51.06-.72.17-.21.11-.37.27-.5.48-.12.2-.18.44-.18.71v3.7h-1.82Z"></path>
      </g>
      <g id="StungTreng-2" data-name="StungTreng" class="tooltip" data-tooltip="stung-treng" style="display: none;">
        <path class="cls-4" d="M372.07,108.9c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M372.07,118.8c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M371.87,112.2l5.3-11.1h-10.7l5.3,11.1h.1Z"></path>
        <path class="cls-9" d="M388.47,77.8h-75.7c-4.09,0-7.4,3.31-7.4,7.4v10.4c0,4.09,3.31,7.4,7.4,7.4h75.7c4.09,0,7.4-3.31,7.4-7.4v-10.4c0-4.09-3.31-7.4-7.4-7.4Z"></path>
        <path class="cls-5" d="M321.21,87.38c-.03-.34-.18-.61-.44-.8-.26-.19-.61-.29-1.05-.29-.3,0-.56.04-.76.13-.21.08-.37.2-.48.35-.11.15-.16.32-.16.5,0,.16.03.29.1.41.07.12.18.22.3.3.13.08.28.15.44.22.17.06.35.11.54.15l.78.19c.38.09.73.2,1.05.34.32.14.59.32.83.52s.41.45.54.73c.13.28.2.6.2.97,0,.53-.14,1-.41,1.39-.27.39-.65.69-1.16.91-.5.21-1.11.32-1.82.32s-1.32-.11-1.84-.32c-.52-.22-.93-.54-1.22-.96-.29-.43-.44-.95-.46-1.58h1.79c.02.29.1.54.25.73.15.19.35.34.6.44.25.1.54.14.86.14s.58-.05.81-.14c.23-.09.41-.22.54-.38.13-.16.19-.35.19-.56,0-.2-.06-.36-.17-.49-.11-.13-.28-.25-.5-.34-.22-.09-.49-.18-.81-.26l-.95-.24c-.74-.18-1.32-.46-1.74-.84-.43-.38-.64-.89-.64-1.54,0-.53.14-.99.42-1.38.29-.39.68-.7,1.18-.92s1.07-.33,1.7-.33,1.21.11,1.7.33c.49.22.86.53,1.13.92.27.39.41.85.42,1.37h-1.77ZM327.79,87.05v1.36h-3.94v-1.36h3.94ZM324.74,85.49h1.82v6.1c0,.17.02.3.08.39.05.09.12.15.21.19.09.04.2.06.32.06.09,0,.17,0,.26-.02.08-.02.15-.03.2-.04l.29,1.35c-.09.03-.22.06-.38.1-.17.04-.36.06-.6.07-.44.02-.82-.04-1.15-.17-.33-.13-.58-.34-.76-.62-.18-.28-.27-.64-.27-1.07v-6.34ZM333.17,90.81v-3.76h1.82v6.55h-1.74v-1.19h-.07c-.15.38-.39.69-.74.92-.34.23-.76.35-1.25.35-.44,0-.82-.1-1.15-.3-.33-.2-.59-.48-.78-.85-.18-.37-.28-.81-.28-1.32v-4.17h1.82v3.84c0,.39.11.69.31.92.21.22.48.34.82.34.22,0,.42-.05.61-.15.19-.1.34-.25.46-.45.12-.2.18-.44.18-.74ZM338.25,89.82v3.78h-1.82v-6.55h1.73v1.15h.08c.14-.38.39-.68.73-.9.34-.22.75-.34,1.24-.34.45,0,.85.1,1.19.3s.6.48.79.85c.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.24,0-.46.05-.65.16-.18.11-.33.26-.43.46-.1.2-.15.44-.16.72ZM346.85,96.19c-.59,0-1.09-.08-1.51-.24-.42-.16-.75-.38-1-.65-.25-.28-.41-.59-.48-.93l1.68-.23c.05.13.13.25.24.37.11.11.26.2.44.27.18.07.41.11.67.11.39,0,.72-.1.98-.29.26-.19.39-.51.39-.96v-1.2h-.08c-.08.18-.2.35-.36.52-.16.16-.36.29-.61.4-.25.1-.55.15-.9.15-.49,0-.94-.11-1.34-.34-.4-.23-.72-.58-.96-1.05-.24-.47-.35-1.07-.35-1.8s.12-1.36.36-1.86c.24-.5.56-.87.96-1.12.4-.25.85-.37,1.32-.37.37,0,.67.06.92.19.25.12.45.28.6.46.15.18.27.36.35.54h.07v-1.1h1.8v6.61c0,.56-.14,1.02-.41,1.4-.27.38-.65.66-1.13.84-.48.19-1.03.29-1.66.29ZM346.89,92.14c.29,0,.54-.07.74-.22.2-.15.36-.36.47-.63.11-.28.17-.61.17-.99s-.05-.72-.16-1c-.11-.28-.26-.5-.47-.66-.2-.16-.45-.23-.74-.23s-.55.08-.76.24c-.2.16-.36.38-.46.66-.11.28-.16.61-.16.98s.05.7.16.98c.11.27.26.48.46.63.2.15.46.22.76.22ZM357.75,87.05v1.36h-3.94v-1.36h3.94ZM354.71,85.49h1.82v6.1c0,.17.02.3.08.39.05.09.12.15.21.19.09.04.2.06.32.06.09,0,.17,0,.26-.02.08-.02.15-.03.2-.04l.28,1.35c-.09.03-.22.06-.38.1-.16.04-.36.06-.6.07-.44.02-.82-.04-1.15-.17-.33-.13-.58-.34-.76-.62-.18-.28-.27-.64-.27-1.07v-6.34ZM358.94,93.6v-6.55h1.76v1.14h.07c.12-.41.32-.71.6-.92.28-.21.61-.32.97-.32.09,0,.19,0,.29.02.1.01.2.03.28.05v1.61c-.08-.03-.2-.05-.35-.07-.15-.02-.29-.03-.41-.03-.27,0-.51.06-.72.17-.21.11-.37.27-.49.48-.12.2-.18.44-.18.71v3.7h-1.82ZM366.52,93.73c-.67,0-1.25-.14-1.74-.41-.48-.28-.86-.66-1.12-1.17-.26-.51-.39-1.1-.39-1.79s.13-1.26.39-1.77c.26-.51.63-.9,1.1-1.19.48-.28,1.04-.43,1.68-.43.43,0,.83.07,1.21.21.38.14.7.34.98.62.28.28.5.62.66,1.04.16.41.23.9.23,1.46v.5h-5.53v-1.12h3.82c0-.26-.06-.49-.17-.69-.11-.2-.27-.36-.47-.47-.2-.12-.43-.17-.7-.17s-.52.06-.73.19c-.21.12-.38.29-.49.51-.12.21-.18.44-.18.7v1.07c0,.32.06.6.18.84.12.24.29.42.51.55.22.13.49.19.79.19.2,0,.39-.03.55-.09.17-.06.31-.14.43-.26.12-.11.21-.25.27-.42l1.68.11c-.08.4-.26.76-.52,1.06-.26.3-.6.53-1.01.7-.41.16-.89.25-1.43.25ZM372.53,89.82v3.78h-1.82v-6.55h1.73v1.15h.08c.14-.38.39-.68.73-.9.34-.22.76-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.81v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.24,0-.46.05-.65.16-.18.11-.33.26-.43.46-.1.2-.15.44-.16.72ZM381.13,96.19c-.59,0-1.09-.08-1.51-.24-.42-.16-.75-.38-1-.65-.25-.28-.41-.59-.48-.93l1.68-.23c.05.13.13.25.24.37.11.11.26.2.44.27.18.07.41.11.67.11.39,0,.72-.1.98-.29.26-.19.39-.51.39-.96v-1.2h-.08c-.08.18-.2.35-.36.52-.16.16-.36.29-.61.4-.25.1-.55.15-.89.15-.49,0-.94-.11-1.34-.34-.4-.23-.72-.58-.96-1.05-.24-.47-.35-1.07-.35-1.8s.12-1.36.36-1.86c.24-.5.56-.87.96-1.12.4-.25.85-.37,1.33-.37.37,0,.67.06.92.19.25.12.45.28.6.46.15.18.27.36.35.54h.07v-1.1h1.8v6.61c0,.56-.14,1.02-.41,1.4-.27.38-.65.66-1.13.84-.48.19-1.03.29-1.66.29ZM381.17,92.14c.29,0,.54-.07.74-.22.2-.15.36-.36.47-.63.11-.28.17-.61.17-.99s-.05-.72-.16-1c-.11-.28-.26-.5-.47-.66-.2-.16-.45-.23-.75-.23s-.55.08-.75.24c-.2.16-.36.38-.46.66-.1.28-.16.61-.16.98s.05.7.16.98c.11.27.26.48.46.63.2.15.46.22.75.22Z"></path>
      </g>
      <g id="Mondulkiri-2" data-name="Mondulkiri" class="tooltip" data-tooltip="mondulkiri" style="display: none;">
        <path class="cls-4" d="M462.12,192.01c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M462.12,201.91c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M461.92,195.31l5.3-11.1h-10.7l5.3,11.1h.1Z"></path>
        <path class="cls-9" d="M478.52,160.91h-75.7c-4.09,0-7.4,3.31-7.4,7.4v10.4c0,4.09,3.31,7.4,7.4,7.4h75.7c4.09,0,7.4-3.31,7.4-7.4v-10.4c0-4.09-3.31-7.4-7.4-7.4Z"></path>
        <path class="cls-5" d="M409.47,168.23h2.28l2.4,5.86h.1l2.4-5.86h2.28v8.73h-1.79v-5.68h-.07l-2.26,5.64h-1.22l-2.26-5.66h-.07v5.7h-1.79v-8.73ZM423.37,177.09c-.66,0-1.23-.14-1.72-.42-.48-.28-.85-.68-1.11-1.18-.26-.51-.39-1.1-.39-1.77s.13-1.27.39-1.77c.26-.51.63-.9,1.11-1.18.48-.28,1.05-.43,1.72-.43s1.23.14,1.71.43c.48.28.86.68,1.12,1.18.26.51.39,1.1.39,1.77s-.13,1.26-.39,1.77c-.26.51-.63.9-1.12,1.18-.48.28-1.05.42-1.71.42ZM423.38,175.68c.3,0,.55-.09.75-.26.2-.17.35-.41.46-.71.11-.3.16-.64.16-1.02s-.05-.72-.16-1.02c-.1-.3-.25-.54-.46-.71s-.45-.26-.75-.26-.56.09-.77.26c-.21.17-.36.41-.47.71-.1.3-.15.64-.15,1.02s.05.72.15,1.02c.11.3.26.54.47.71.21.17.46.26.77.26ZM429.59,173.18v3.78h-1.82v-6.55h1.73v1.15h.08c.15-.38.39-.68.73-.9.34-.23.75-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.24,0-.46.05-.65.16-.18.11-.33.26-.43.46-.1.2-.15.44-.16.72ZM437.65,177.07c-.5,0-.95-.13-1.35-.38-.4-.26-.72-.64-.95-1.14-.23-.5-.35-1.12-.35-1.85s.12-1.37.36-1.87c.24-.5.56-.87.96-1.12.4-.25.85-.38,1.33-.38.37,0,.67.06.92.19.25.12.45.28.6.46.15.18.27.36.35.54h.05v-3.28h1.81v8.73h-1.79v-1.05h-.08c-.08.18-.21.36-.36.54-.15.18-.35.32-.6.44-.24.12-.54.17-.89.17ZM438.23,175.62c.29,0,.54-.08.74-.24.2-.16.36-.39.47-.68.11-.29.17-.63.17-1.02s-.05-.73-.16-1.01-.26-.51-.47-.67c-.2-.16-.45-.23-.75-.23s-.55.08-.75.24c-.2.16-.36.39-.46.67-.11.29-.16.62-.16,1s.05.72.16,1.01c.11.29.26.52.46.68.21.16.46.24.75.24ZM447.07,174.17v-3.76h1.82v6.55h-1.74v-1.19h-.07c-.15.38-.39.69-.74.93-.34.23-.76.35-1.25.35-.44,0-.82-.1-1.16-.3-.33-.2-.59-.48-.78-.85-.18-.37-.28-.81-.28-1.32v-4.17h1.82v3.84c0,.39.11.69.31.92.21.23.48.34.82.34.22,0,.42-.05.61-.15.19-.1.34-.25.46-.45.12-.2.18-.44.17-.74ZM452.15,168.23v8.73h-1.82v-8.73h1.82ZM455.25,175.08v-2.18h.27l2.1-2.48h2.08l-2.82,3.29h-.43l-1.2,1.37ZM453.6,176.96v-8.73h1.82v8.73h-1.82ZM457.69,176.96l-1.93-2.85,1.21-1.28,2.84,4.13h-2.13ZM460.59,176.96v-6.55h1.82v6.55h-1.82ZM461.5,169.57c-.27,0-.5-.09-.7-.27-.19-.18-.28-.4-.28-.65s.1-.46.28-.64c.19-.18.43-.27.7-.27s.5.09.69.27c.19.18.29.39.29.64s-.1.47-.29.65c-.19.18-.42.27-.69.27ZM463.86,176.96v-6.55h1.76v1.14h.07c.12-.41.32-.71.6-.92.28-.21.61-.32.97-.32.09,0,.19,0,.29.02.11.01.2.03.28.05v1.61c-.08-.02-.2-.05-.35-.07-.15-.02-.29-.03-.41-.03-.27,0-.51.06-.72.18-.21.11-.37.27-.49.48-.12.21-.18.44-.18.71v3.7h-1.82ZM468.77,176.96v-6.55h1.82v6.55h-1.82ZM469.68,169.57c-.27,0-.5-.09-.69-.27-.19-.18-.29-.4-.29-.65s.1-.46.29-.64c.19-.18.42-.27.69-.27s.5.09.69.27c.19.18.29.39.29.64s-.1.47-.29.65c-.19.18-.42.27-.69.27Z"></path>
      </g>
      <g id="Kratie-2" data-name="Kratie" class="tooltip" data-tooltip="kratie" style="display: none;">
        <path class="cls-4" d="M361.02,190.15c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M361.02,200.05c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M360.82,193.45l5.3-11.1h-10.7l5.3,11.1h.1Z"></path>
        <path class="cls-9" d="M377.42,159.05h-41.12c-4.09,0-7.4,3.31-7.4,7.4v10.4c0,4.09,3.31,7.4,7.4,7.4h41.12c4.09,0,7.4-3.31,7.4-7.4v-10.4c0-4.09-3.31-7.4-7.4-7.4Z"></path>
        <path class="cls-5" d="M340.33,176v-8.73h1.85v3.85h.11l3.14-3.85h2.21l-3.24,3.91,3.28,4.82h-2.21l-2.39-3.59-.91,1.11v2.48h-1.85ZM348.57,176v-6.54h1.76v1.14h.07c.12-.41.32-.71.6-.92.28-.21.6-.32.97-.32.09,0,.19,0,.29.02.11.01.2.03.28.05v1.61c-.09-.03-.2-.05-.35-.07-.15-.02-.29-.03-.41-.03-.27,0-.51.06-.71.17-.21.11-.37.27-.49.48-.12.21-.18.44-.18.71v3.7h-1.82ZM355.16,176.12c-.42,0-.79-.07-1.12-.22-.33-.15-.59-.37-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6.23-.15.49-.26.78-.34.29-.08.6-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.02c0-.27-.09-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.33.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.11.21-.24.39-.42.54-.18.15-.39.27-.63.36-.25.08-.53.13-.86.13ZM355.68,174.87c.27,0,.5-.05.71-.16.2-.11.36-.25.48-.43.12-.18.17-.39.17-.62v-.69c-.06.04-.13.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM363.73,169.46v1.36h-3.94v-1.36h3.94ZM360.69,167.89h1.82v6.1c0,.17.02.3.08.39.05.09.12.15.21.19.09.04.2.06.32.06.09,0,.17,0,.26-.02.08-.02.15-.03.2-.04l.29,1.35c-.09.03-.22.06-.38.1-.17.04-.36.06-.6.07-.44.02-.82-.04-1.15-.17-.33-.13-.58-.34-.76-.62-.18-.28-.27-.64-.27-1.07v-6.34ZM364.92,176v-6.54h1.82v6.54h-1.82ZM365.83,168.61c-.27,0-.5-.09-.7-.27-.19-.18-.29-.4-.29-.65s.1-.46.29-.64c.19-.18.43-.27.7-.27s.5.09.69.27c.19.18.29.39.29.64s-.1.47-.29.65c-.19.18-.42.27-.69.27ZM371.17,176.13c-.67,0-1.25-.14-1.74-.41-.48-.28-.85-.66-1.12-1.17-.26-.51-.39-1.1-.39-1.79s.13-1.26.39-1.77c.26-.51.63-.9,1.1-1.19.48-.28,1.04-.43,1.68-.43.43,0,.83.07,1.21.21.38.14.7.34.98.62.28.28.5.62.66,1.04.16.42.23.9.23,1.46v.5h-5.53v-1.12h3.82c0-.26-.06-.49-.17-.7-.11-.2-.27-.36-.47-.47-.2-.12-.43-.18-.7-.18s-.52.06-.73.19c-.21.12-.38.29-.49.51-.12.21-.18.44-.18.7v1.07c0,.32.06.6.18.84.12.24.29.42.52.54.22.13.48.19.79.19.2,0,.39-.03.55-.08.17-.06.31-.14.43-.26.12-.11.21-.25.27-.42l1.68.11c-.08.4-.26.76-.52,1.06-.26.3-.6.53-1.01.7-.41.16-.89.25-1.43.25Z"></path>
      </g>
      <g id="Pailin-2" data-name="Pailin" class="tooltip" data-tooltip="pailin" style="display: none;">
        <path class="cls-4" d="M28.45,176.2c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M28.45,186.1c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M28.25,179.5l5.3-11.1h-10.7l5.3,11.1h.1Z"></path>
        <path class="cls-9" d="M44.85,145.1H9.04c-4.09,0-7.4,3.31-7.4,7.4v10.4c0,4.09,3.31,7.4,7.4,7.4h35.81c4.09,0,7.4-3.31,7.4-7.4v-10.4c0-4.09-3.31-7.4-7.4-7.4Z"></path>
        <path class="cls-5" d="M12.16,162.17v-8.73h3.44c.66,0,1.23.13,1.69.38.47.25.82.6,1.07,1.04.25.44.37.96.37,1.53s-.12,1.09-.38,1.53c-.25.44-.61.79-1.09,1.04-.47.25-1.04.37-1.71.37h-2.19v-1.48h1.9c.36,0,.65-.06.88-.18.23-.12.41-.3.52-.52.12-.22.17-.48.17-.76s-.06-.54-.17-.76c-.11-.22-.29-.39-.52-.51-.23-.12-.53-.18-.89-.18h-1.24v7.22h-1.85ZM21.58,162.29c-.42,0-.79-.07-1.12-.22-.33-.15-.59-.37-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6.23-.15.49-.26.78-.34.3-.08.61-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.03c0-.27-.09-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.34.08.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.11.21-.25.39-.42.54-.18.15-.39.27-.64.36-.25.09-.53.13-.86.13ZM22.1,161.04c.27,0,.5-.05.71-.16.2-.11.36-.25.48-.43.12-.18.17-.39.17-.62v-.69c-.06.04-.13.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM26.68,162.17v-6.54h1.82v6.54h-1.82ZM27.59,154.78c-.27,0-.5-.09-.69-.27-.19-.18-.29-.4-.29-.65s.1-.46.29-.64c.19-.18.42-.27.69-.27s.5.09.69.27c.19.18.29.39.29.64s-.1.47-.29.65c-.19.18-.42.27-.69.27ZM31.76,153.44v8.73h-1.82v-8.73h1.82ZM33.22,162.17v-6.54h1.82v6.54h-1.82ZM34.13,154.78c-.27,0-.5-.09-.69-.27-.19-.18-.29-.4-.29-.65s.1-.46.29-.64c.19-.18.42-.27.69-.27s.5.09.69.27c.19.18.29.39.29.64s-.1.47-.29.65c-.19.18-.42.27-.69.27ZM38.3,158.39v3.78h-1.82v-6.54h1.73v1.15h.08c.14-.38.39-.68.73-.9.34-.22.75-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.24,0-.46.05-.65.16-.18.11-.33.26-.43.46-.1.2-.15.44-.16.72Z"></path>
      </g>
      <g id="RatanakKiri-2" data-name="RatanakKiri" class="tooltip" data-tooltip="ratanak-kiri" style="display: none;">
        <path class="cls-4" d="M451.97,81.8c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M451.97,91.7c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M452.17,85.2l5.2-11.1h-10.4l5.2,11.1Z"></path>
        <path class="cls-9" d="M465.57,49.7h-81.2c-4.58,0-8.3,3.72-8.3,8.3v8.4c0,4.58,3.72,8.3,8.3,8.3h81.2c4.58,0,8.3-3.72,8.3-8.3v-8.4c0-4.58-3.72-8.3-8.3-8.3Z"></path>
        <path class="cls-5" d="M390.33,65.5v-8.73h3.44c.66,0,1.22.12,1.69.35.47.23.83.56,1.07.99.25.43.37.93.37,1.5s-.12,1.08-.38,1.5c-.25.41-.61.73-1.09.95-.47.22-1.04.33-1.71.33h-2.3v-1.48h2.01c.35,0,.64-.05.88-.14.23-.1.41-.24.52-.43.12-.19.17-.43.17-.72s-.06-.53-.17-.73c-.11-.2-.29-.35-.52-.45-.23-.11-.53-.16-.88-.16h-1.24v7.22h-1.85ZM395.04,61.53l2.17,3.97h-2.04l-2.12-3.97h1.99ZM400.04,65.62c-.42,0-.79-.07-1.12-.22-.33-.15-.59-.36-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6.23-.15.49-.26.79-.34.29-.08.6-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.03c0-.27-.09-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.33.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.11.2-.24.38-.42.54-.18.15-.39.27-.63.36-.25.09-.53.13-.86.13ZM400.56,64.37c.27,0,.5-.05.71-.16.2-.11.36-.25.48-.43.12-.18.18-.39.18-.62v-.69c-.06.04-.14.07-.24.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM408.61,58.95v1.36h-3.94v-1.36h3.94ZM405.57,57.39h1.82v6.1c0,.17.03.3.08.39.05.09.12.15.21.19.09.04.2.06.32.06.09,0,.17,0,.26-.02.08-.02.15-.03.2-.04l.28,1.35c-.09.03-.22.06-.38.1-.16.04-.36.06-.6.07-.44.02-.82-.04-1.15-.17-.33-.13-.58-.34-.76-.62-.18-.28-.27-.64-.27-1.07v-6.34ZM411.66,65.62c-.42,0-.79-.07-1.12-.22-.33-.15-.59-.36-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6.23-.15.49-.26.79-.34.29-.08.6-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.03c0-.27-.09-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.33.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.11.2-.24.38-.42.54-.18.15-.39.27-.63.36-.25.09-.53.13-.86.13ZM412.18,64.37c.27,0,.5-.05.71-.16.2-.11.36-.25.48-.43.12-.18.18-.39.18-.62v-.69c-.06.04-.14.07-.24.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM418.57,61.72v3.78h-1.82v-6.55h1.73v1.15h.08c.14-.38.39-.68.73-.9.34-.22.75-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.24,0-.46.05-.65.16-.18.11-.33.26-.43.46-.1.2-.15.44-.16.72ZM426.09,65.62c-.42,0-.79-.07-1.12-.22-.33-.15-.58-.36-.77-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.31-.45.54-.6s.49-.26.78-.34c.3-.08.61-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.03c0-.27-.08-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.08-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.34.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.11.2-.25.38-.42.54-.18.15-.39.27-.64.36-.25.09-.53.13-.86.13ZM426.61,64.37c.27,0,.5-.05.71-.16.21-.11.36-.25.48-.43.12-.18.17-.39.17-.62v-.69c-.06.04-.14.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM432.83,63.62v-2.18h.27l2.1-2.48h2.08l-2.82,3.29h-.43l-1.2,1.37ZM431.18,65.5v-8.73h1.82v8.73h-1.82ZM435.27,65.5l-1.93-2.85,1.21-1.28,2.84,4.13h-2.13Z"></path>
        <path class="cls-5" d="M441.03,65.5v-8.73h1.85v3.85h.12l3.14-3.85h2.21l-3.24,3.91,3.28,4.82h-2.21l-2.39-3.59-.91,1.11v2.48h-1.85Z"></path>
        <path class="cls-5" d="M449.7,65.5v-6.55h1.82v6.55h-1.82ZM450.61,58.11c-.27,0-.5-.09-.69-.27-.19-.18-.29-.4-.29-.65s.1-.46.29-.64c.19-.18.43-.27.69-.27s.5.09.69.27c.19.18.29.39.29.64s-.1.47-.29.65c-.19.18-.42.27-.69.27ZM452.96,65.5v-6.55h1.76v1.14h.07c.12-.41.32-.71.6-.92.28-.21.6-.32.97-.32.09,0,.19,0,.29.02.11.01.2.03.28.05v1.61c-.09-.03-.2-.05-.35-.07-.15-.02-.29-.03-.41-.03-.27,0-.51.06-.72.17-.21.11-.37.27-.49.48-.12.2-.18.44-.18.71v3.7h-1.82ZM457.87,65.5v-6.55h1.82v6.55h-1.82ZM458.79,58.11c-.27,0-.5-.09-.69-.27-.19-.18-.29-.4-.29-.65s.1-.46.29-.64c.19-.18.42-.27.69-.27s.5.09.69.27c.19.18.29.39.29.64s-.1.47-.29.65c-.19.18-.42.27-.69.27Z"></path>
      </g>
      <g id="KampongThom-3" data-name="KampongThom" class="tooltip" data-tooltip="kampong-thom" style="display: none;">
        <path class="cls-4" d="M247.37,178.4c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M247.37,188.4c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M246.97,181.6l6.4-11.1h-12.8l6.4,11.1Z"></path>
        <path class="cls-9" d="M261.67,146.3h-103.3c-4.8,0-8.7,3.9-8.7,8.7v7.6c0,4.8,3.9,8.7,8.7,8.7h103.3c4.8,0,8.7-3.9,8.7-8.7v-7.6c0-4.8-3.89-8.7-8.7-8.7Z"></path>
        <path class="cls-5" d="M164.33,162v-8.73h1.85v3.85h.12l3.14-3.85h2.21l-3.24,3.91,3.28,4.82h-2.21l-2.39-3.59-.91,1.11v2.48h-1.85ZM174.43,162.12c-.42,0-.79-.07-1.12-.22-.33-.15-.58-.37-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6.23-.15.49-.26.78-.34.29-.08.6-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.02c0-.27-.08-.48-.26-.63-.17-.15-.41-.22-.71-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.33.09.63.22.89.4.26.18.47.41.62.69.15.28.22.61.22,1v4.41h-1.72v-.91h-.05c-.11.21-.25.39-.42.54-.18.15-.39.27-.63.36-.25.08-.53.13-.86.13ZM174.95,160.87c.27,0,.5-.05.71-.16.2-.11.36-.25.48-.43.12-.18.17-.39.17-.62v-.69c-.06.04-.13.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM179.53,162v-6.54h1.73v1.15h.08c.14-.38.36-.69.68-.91.32-.22.7-.33,1.14-.33s.83.11,1.15.34c.32.22.52.52.63.9h.07c.13-.38.38-.67.72-.9.35-.23.77-.34,1.25-.34.61,0,1.11.19,1.49.58.38.39.57.93.57,1.65v4.4h-1.81v-4.04c0-.36-.1-.64-.29-.82-.19-.18-.43-.27-.72-.27-.33,0-.59.1-.77.31-.18.21-.28.48-.28.82v4h-1.76v-4.08c0-.32-.09-.58-.28-.77-.18-.19-.42-.29-.72-.29-.2,0-.38.05-.55.15-.16.1-.29.24-.38.42-.09.18-.14.39-.14.63v3.93h-1.81ZM190.47,164.46v-9h1.79v1.1h.08c.08-.18.19-.35.35-.54.15-.18.35-.34.6-.46.25-.12.55-.19.92-.19.48,0,.92.12,1.32.38.4.25.73.62.97,1.12.24.5.36,1.12.36,1.87s-.12,1.35-.35,1.85c-.23.5-.55.88-.96,1.14-.4.26-.85.38-1.35.38-.35,0-.65-.06-.9-.17-.24-.12-.45-.26-.6-.44-.16-.18-.28-.36-.36-.54h-.06v3.5h-1.82ZM192.25,158.73c0,.39.05.73.16,1.02.11.29.26.51.47.68.2.16.45.24.75.24s.54-.08.75-.24c.2-.17.36-.39.46-.68.11-.29.16-.63.16-1.01s-.05-.71-.16-1c-.1-.29-.26-.51-.46-.67-.21-.16-.46-.24-.75-.24s-.55.08-.75.23c-.2.16-.36.38-.47.66s-.16.62-.16,1.01ZM201.02,162.13c-.66,0-1.23-.14-1.72-.42-.48-.28-.85-.68-1.11-1.18-.26-.51-.39-1.1-.39-1.77s.13-1.27.39-1.77c.26-.51.63-.9,1.11-1.18.48-.28,1.06-.43,1.72-.43s1.23.14,1.71.43c.48.28.86.68,1.12,1.18.26.51.39,1.1.39,1.77s-.13,1.26-.39,1.77c-.26.51-.63.9-1.12,1.18-.48.28-1.05.42-1.71.42ZM201.03,160.72c.3,0,.55-.09.75-.26.2-.17.35-.41.46-.71.1-.3.16-.64.16-1.02s-.05-.72-.16-1.02c-.1-.3-.25-.54-.46-.71-.2-.17-.45-.26-.75-.26s-.56.09-.77.26c-.21.17-.36.41-.46.71-.1.3-.15.64-.15,1.02s.05.72.15,1.02c.1.3.26.53.46.71.21.17.46.26.77.26ZM207.24,158.22v3.78h-1.82v-6.54h1.73v1.15h.08c.15-.38.39-.68.73-.9.34-.22.75-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.24,0-.46.05-.65.16-.19.11-.33.26-.44.46-.1.2-.15.44-.16.72ZM215.84,164.59c-.59,0-1.09-.08-1.51-.24-.42-.16-.75-.38-1-.65-.25-.28-.41-.59-.48-.93l1.68-.23c.05.13.13.25.24.37.11.11.26.2.44.27.18.07.41.11.67.11.4,0,.72-.1.97-.29.26-.19.39-.51.39-.96v-1.2h-.08c-.08.18-.2.35-.36.52-.16.16-.36.29-.61.4-.25.1-.55.15-.9.15-.49,0-.94-.11-1.34-.34-.4-.23-.72-.58-.96-1.05-.24-.48-.35-1.07-.35-1.8s.12-1.36.36-1.86c.24-.5.56-.87.96-1.12.4-.25.85-.37,1.32-.37.37,0,.67.06.92.19.25.12.45.27.6.46.15.18.27.36.35.54h.07v-1.1h1.8v6.61c0,.56-.14,1.02-.41,1.4-.27.38-.65.66-1.13.84-.48.19-1.03.29-1.66.29ZM215.88,160.54c.29,0,.54-.07.74-.22.2-.15.36-.36.47-.63.11-.28.17-.61.17-.99s-.05-.72-.16-1c-.11-.28-.26-.5-.47-.66-.2-.16-.45-.23-.75-.23s-.55.08-.75.24c-.2.16-.36.38-.46.66-.1.28-.16.61-.16.98s.05.71.16.98c.11.27.26.48.46.63.21.15.46.22.75.22ZM222.96,154.79v-1.52h7.17v1.52h-2.67v7.21h-1.82v-7.21h-2.67ZM233.09,158.22v3.78h-1.81v-8.73h1.76v3.34h.08c.15-.39.39-.69.72-.91.33-.22.74-.33,1.24-.33.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.32v4.17h-1.82v-3.84c0-.4-.1-.72-.31-.94-.2-.22-.49-.34-.86-.34-.25,0-.47.05-.66.16-.19.11-.34.26-.44.46-.1.2-.16.44-.16.72ZM241.73,162.13c-.66,0-1.24-.14-1.72-.42-.48-.28-.85-.68-1.11-1.18-.26-.51-.39-1.1-.39-1.77s.13-1.27.39-1.77c.26-.51.63-.9,1.11-1.18.48-.28,1.06-.43,1.72-.43s1.23.14,1.71.43c.48.28.85.68,1.12,1.18.26.51.39,1.1.39,1.77s-.13,1.26-.39,1.77c-.26.51-.63.9-1.12,1.18-.48.28-1.05.42-1.71.42ZM241.73,160.72c.3,0,.55-.09.75-.26.2-.17.35-.41.46-.71.11-.3.16-.64.16-1.02s-.05-.72-.16-1.02c-.1-.3-.25-.54-.46-.71-.2-.17-.45-.26-.75-.26s-.56.09-.77.26c-.21.17-.36.41-.46.71-.1.3-.15.64-.15,1.02s.05.72.15,1.02c.1.3.26.53.46.71.21.17.46.26.77.26ZM246.13,162v-6.54h1.73v1.15h.08c.14-.38.36-.69.68-.91.32-.22.7-.33,1.14-.33s.83.11,1.15.34c.31.22.52.52.63.9h.07c.13-.38.38-.67.72-.9.35-.23.77-.34,1.25-.34.61,0,1.11.19,1.49.58.38.39.57.93.57,1.65v4.4h-1.81v-4.04c0-.36-.1-.64-.29-.82-.19-.18-.43-.27-.72-.27-.33,0-.59.1-.77.31-.18.21-.28.48-.28.82v4h-1.76v-4.08c0-.32-.09-.58-.28-.77-.18-.19-.42-.29-.72-.29-.2,0-.38.05-.54.15-.16.1-.29.24-.38.42-.09.18-.14.39-.14.63v3.93h-1.82Z"></path>
      </g>
      <g id="Battambang-2" data-name="Battambang" class="tooltip" data-tooltip="battambang" style="display: none;">
        <path class="cls-4" d="M107.57,160.55c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M107.57,170.55c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M107.57,163.95l6.4-11.1h-12.8l6.4,11.1Z"></path>
        <path class="cls-9" d="M121.37,129.35H45.57c-5.25,0-9.5,4.25-9.5,9.5v5.1c0,5.25,4.25,9.5,9.5,9.5h75.8c5.25,0,9.5-4.25,9.5-9.5v-5.1c0-5.25-4.25-9.5-9.5-9.5Z"></path>
        <path class="cls-5" d="M48.33,144.65v-8.73h3.49c.64,0,1.18.1,1.61.28.43.19.75.46.97.79.22.33.32.72.32,1.16,0,.34-.07.64-.2.9-.14.26-.32.47-.56.63-.24.16-.51.28-.81.35v.08c.33.01.64.11.93.28.29.17.53.42.71.73.18.31.27.68.27,1.11,0,.46-.12.88-.35,1.24-.23.36-.56.65-1.01.86-.45.21-1,.31-1.65.31h-3.73ZM50.17,143.14h1.5c.51,0,.89-.1,1.12-.29.24-.2.35-.46.35-.79,0-.24-.06-.45-.17-.64-.12-.18-.28-.33-.5-.43-.21-.1-.47-.16-.76-.16h-1.55v2.32ZM50.17,139.57h1.37c.25,0,.48-.04.67-.13.2-.09.36-.22.47-.38.12-.17.17-.36.17-.59,0-.32-.11-.57-.34-.76-.22-.19-.54-.29-.95-.29h-1.4v2.16ZM58.09,144.77c-.42,0-.79-.07-1.12-.22-.33-.15-.59-.37-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6s.49-.26.78-.34c.3-.08.61-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.03c0-.27-.09-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.34.08.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.11.21-.25.38-.42.54-.18.15-.39.27-.63.36-.25.09-.53.13-.86.13ZM58.61,143.52c.27,0,.5-.05.71-.16.2-.11.37-.25.48-.44.12-.18.17-.39.17-.62v-.69c-.06.04-.13.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM66.67,138.1v1.36h-3.94v-1.36h3.94ZM63.62,136.54h1.82v6.1c0,.17.03.3.08.39.05.09.12.15.21.19.09.04.2.06.32.06.09,0,.17,0,.26-.02.09-.02.15-.03.2-.04l.29,1.35c-.09.03-.22.06-.38.1-.16.04-.37.06-.6.07-.44.02-.82-.04-1.15-.17-.33-.13-.58-.34-.76-.62-.18-.28-.27-.64-.27-1.07v-6.34ZM71.33,138.1v1.36h-3.94v-1.36h3.94ZM68.29,136.54h1.82v6.1c0,.17.03.3.08.39.05.09.12.15.21.19.09.04.2.06.32.06.09,0,.17,0,.26-.02.09-.02.15-.03.2-.04l.29,1.35c-.09.03-.22.06-.38.1-.16.04-.36.06-.6.07-.44.02-.82-.04-1.15-.17-.33-.13-.58-.34-.76-.62-.18-.28-.27-.64-.27-1.07v-6.34ZM74.38,144.77c-.42,0-.79-.07-1.12-.22-.33-.15-.59-.37-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6s.49-.26.78-.34c.3-.08.61-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.03c0-.27-.09-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.34.08.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.11.21-.25.38-.42.54-.18.15-.39.27-.63.36-.25.09-.53.13-.86.13ZM74.9,143.52c.27,0,.5-.05.71-.16.2-.11.37-.25.48-.44.12-.18.17-.39.17-.62v-.69c-.06.04-.13.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM79.48,144.65v-6.54h1.73v1.15h.08c.14-.38.36-.69.68-.91.32-.22.7-.33,1.14-.33s.83.11,1.15.34c.32.22.53.52.63.9h.07c.13-.38.38-.67.72-.9.35-.23.77-.34,1.25-.34.61,0,1.11.2,1.49.58.38.39.58.93.58,1.65v4.4h-1.81v-4.04c0-.36-.1-.64-.29-.82-.19-.18-.43-.27-.72-.27-.33,0-.59.1-.77.32-.18.21-.28.48-.28.82v4h-1.76v-4.08c0-.32-.09-.58-.28-.77-.18-.19-.42-.29-.72-.29-.2,0-.38.05-.55.15-.16.1-.29.24-.38.42-.09.18-.14.39-.14.63v3.93h-1.82ZM90.46,144.65v-8.73h1.82v3.28h.06c.08-.18.19-.35.35-.54.15-.19.35-.34.6-.46.25-.12.55-.19.92-.19.48,0,.92.12,1.32.38.4.25.73.62.97,1.12.24.5.36,1.12.36,1.87s-.12,1.35-.35,1.85c-.23.5-.55.88-.95,1.14-.4.26-.85.38-1.35.38-.35,0-.65-.06-.9-.17-.24-.12-.44-.26-.6-.44-.16-.18-.28-.36-.36-.54h-.08v1.05h-1.79ZM92.23,141.38c0,.39.05.73.16,1.02.11.29.26.51.47.68.2.16.45.24.75.24s.55-.08.75-.24c.2-.16.36-.39.46-.68.11-.29.16-.63.16-1.01s-.05-.71-.16-1c-.11-.29-.26-.51-.46-.67-.2-.16-.46-.24-.75-.24s-.55.08-.75.23c-.2.16-.36.38-.46.67-.11.29-.16.62-.16,1.01ZM99.92,144.77c-.42,0-.79-.07-1.12-.22-.33-.15-.59-.37-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6.23-.15.49-.26.78-.34.3-.08.61-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.1-.07.16-.18.16-.32v-.03c0-.27-.09-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.34.08.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.11.21-.25.38-.42.54-.18.15-.39.27-.64.36-.25.09-.53.13-.86.13ZM100.44,143.52c.27,0,.5-.05.71-.16.2-.11.36-.25.48-.44.12-.18.17-.39.17-.62v-.69c-.06.04-.14.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM106.83,140.87v3.78h-1.82v-6.54h1.73v1.15h.08c.14-.38.39-.68.73-.9.34-.23.75-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.81v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.25,0-.46.05-.65.16-.18.11-.33.26-.43.46-.1.2-.15.44-.16.72ZM115.43,147.24c-.59,0-1.09-.08-1.51-.24-.42-.16-.75-.38-1-.65-.25-.28-.41-.58-.48-.93l1.68-.23c.05.13.13.25.24.37.11.11.26.2.44.27.19.07.41.11.67.11.39,0,.72-.1.97-.29.26-.19.39-.51.39-.96v-1.2h-.08c-.08.18-.2.35-.36.51-.16.16-.36.29-.61.4s-.55.15-.9.15c-.49,0-.94-.11-1.34-.34-.4-.23-.72-.58-.96-1.05-.24-.47-.35-1.07-.35-1.8s.12-1.36.36-1.86c.24-.5.56-.87.96-1.12.4-.25.85-.37,1.33-.37.37,0,.67.06.92.19.25.12.45.27.6.46.15.18.27.36.35.54h.07v-1.1h1.8v6.61c0,.56-.14,1.02-.41,1.4-.27.38-.65.66-1.13.84-.48.19-1.03.29-1.66.29ZM115.46,143.19c.29,0,.54-.07.74-.22.2-.15.36-.36.47-.63.11-.28.17-.61.17-.99s-.05-.72-.16-1c-.11-.28-.26-.5-.47-.66-.2-.16-.45-.23-.75-.23s-.55.08-.75.24c-.2.16-.36.38-.46.66-.11.28-.16.61-.16.98s.05.7.16.98c.11.27.26.48.46.63.21.15.46.22.75.22Z"></path>
      </g>
      <g id="KampongChhnang-2" data-name="KampongChhnang" class="tooltip" data-tooltip="kampong-chhnang" style="display: none;">
        <path class="cls-4" d="M211.17,252.2c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M211.17,262.1c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M211.17,255.5l6.4-11.1h-12.8l6.4,11.1Z"></path>
        <path class="cls-9" d="M227.07,221.6h-113.1c-5.3,0-9.6,4.3-9.6,9.6v6.3c0,5.3,4.3,9.6,9.6,9.6h113.1c5.3,0,9.6-4.3,9.6-9.6v-6.3c0-5.3-4.3-9.6-9.6-9.6Z"></path>
        <path class="cls-5" d="M115.13,238.1v-8.73h1.85v3.85h.11l3.14-3.85h2.21l-3.24,3.91,3.28,4.82h-2.21l-2.39-3.59-.91,1.11v2.48h-1.85ZM125.23,238.22c-.42,0-.79-.07-1.12-.22-.33-.15-.58-.36-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6.23-.15.49-.26.78-.34.29-.08.6-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.02c0-.27-.09-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.08-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.34.09.63.22.89.4.26.18.47.41.62.69.15.28.22.61.22,1v4.42h-1.72v-.91h-.05c-.11.21-.25.38-.42.54-.18.15-.39.27-.63.36-.25.09-.53.13-.86.13ZM125.75,236.97c.27,0,.5-.05.71-.16.2-.11.37-.25.48-.43.12-.18.17-.39.17-.62v-.69c-.06.04-.13.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM130.33,238.1v-6.55h1.73v1.15h.08c.14-.38.36-.69.68-.91.32-.22.7-.33,1.14-.33s.83.11,1.15.34c.32.22.52.52.63.9h.07c.13-.38.38-.67.72-.9.35-.23.77-.34,1.25-.34.61,0,1.11.2,1.49.58.38.39.57.94.57,1.65v4.4h-1.81v-4.04c0-.36-.1-.64-.29-.82-.19-.18-.43-.27-.72-.27-.33,0-.59.11-.77.32-.18.21-.28.48-.28.82v4h-1.76v-4.08c0-.32-.09-.58-.28-.77-.18-.19-.42-.29-.72-.29-.2,0-.38.05-.54.15-.16.1-.29.24-.38.42-.09.18-.14.39-.14.63v3.93h-1.82ZM141.27,240.55v-9h1.79v1.1h.08c.08-.18.19-.36.35-.54.15-.18.35-.34.6-.46.25-.12.55-.19.92-.19.48,0,.92.12,1.32.38.4.25.73.62.97,1.12.24.5.36,1.12.36,1.87s-.12,1.35-.35,1.85c-.23.5-.55.88-.96,1.14-.4.26-.85.38-1.35.38-.35,0-.65-.06-.9-.18-.25-.12-.45-.26-.6-.44-.16-.18-.28-.36-.36-.54h-.06v3.5h-1.82ZM143.05,234.83c0,.39.05.73.16,1.02.11.29.26.51.47.68.2.16.45.24.75.24s.55-.08.75-.24c.2-.16.36-.39.46-.68.11-.29.16-.63.16-1.01s-.05-.71-.16-1c-.1-.29-.26-.51-.46-.67-.21-.16-.46-.24-.75-.24s-.55.08-.75.23c-.2.16-.36.38-.46.67s-.16.62-.16,1.01ZM151.82,238.23c-.66,0-1.23-.14-1.72-.42-.48-.28-.85-.68-1.11-1.18-.26-.51-.39-1.1-.39-1.77s.13-1.27.39-1.77c.26-.51.63-.9,1.11-1.18.48-.28,1.05-.43,1.72-.43s1.23.14,1.71.43c.48.28.86.68,1.12,1.18.26.51.39,1.1.39,1.77s-.13,1.26-.39,1.77c-.26.51-.63.9-1.12,1.18-.48.28-1.05.42-1.71.42ZM151.83,236.82c.3,0,.55-.09.75-.26.2-.17.35-.41.46-.71.1-.3.16-.64.16-1.02s-.05-.72-.16-1.02c-.1-.3-.25-.54-.46-.71s-.45-.26-.75-.26-.56.09-.77.26c-.21.17-.36.41-.46.71-.1.3-.15.64-.15,1.02s.05.72.15,1.02c.1.3.26.54.46.71.21.17.46.26.77.26ZM158.04,234.32v3.78h-1.82v-6.55h1.73v1.15h.08c.15-.38.39-.68.73-.9.34-.22.75-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.25,0-.46.05-.65.16-.18.11-.33.26-.43.46-.1.2-.15.44-.16.72ZM166.64,240.69c-.59,0-1.09-.08-1.51-.24-.42-.16-.75-.38-1-.65-.25-.28-.41-.59-.48-.93l1.68-.23c.05.13.13.25.24.37.11.11.26.2.44.27.19.07.41.11.67.11.39,0,.72-.1.97-.29.26-.19.39-.51.39-.96v-1.2h-.08c-.08.18-.2.35-.36.52-.16.16-.36.29-.61.4-.25.1-.55.15-.89.15-.49,0-.94-.11-1.34-.34-.4-.23-.72-.58-.96-1.05-.24-.48-.35-1.07-.35-1.8s.12-1.36.36-1.86c.24-.5.56-.87.96-1.12.4-.25.85-.37,1.33-.37.37,0,.67.06.92.19.25.12.45.28.6.46.15.18.27.36.35.54h.07v-1.1h1.8v6.61c0,.56-.14,1.02-.41,1.4-.27.38-.65.66-1.13.84-.48.19-1.03.29-1.66.29ZM166.68,236.64c.29,0,.54-.07.74-.22.2-.15.36-.36.47-.63.11-.28.17-.61.17-.99s-.05-.72-.16-1c-.11-.28-.26-.5-.47-.66-.21-.16-.45-.23-.75-.23s-.55.08-.75.24c-.21.16-.36.38-.46.67-.11.28-.16.61-.16.98s.05.7.16.98c.11.27.26.48.46.64.21.15.46.22.75.22ZM181.8,232.43h-1.87c-.03-.24-.1-.46-.21-.64-.1-.19-.24-.35-.4-.49-.16-.13-.35-.24-.57-.31-.21-.07-.44-.11-.69-.11-.45,0-.85.11-1.18.34-.34.22-.6.55-.78.97-.18.42-.28.94-.28,1.54s.09,1.15.28,1.57c.19.42.45.74.78.96.33.22.72.32,1.16.32.25,0,.48-.03.69-.1.21-.07.4-.16.57-.29.16-.13.3-.28.41-.46.11-.18.19-.39.23-.62h1.87c-.05.41-.17.79-.36,1.17-.19.37-.45.7-.77.99-.32.29-.71.52-1.15.69-.44.17-.94.25-1.5.25-.78,0-1.47-.18-2.09-.53-.61-.35-1.09-.86-1.45-1.53-.35-.67-.53-1.48-.53-2.43s.18-1.76.54-2.43c.36-.67.84-1.18,1.46-1.53.61-.35,1.3-.53,2.07-.53.51,0,.97.07,1.41.21.44.14.82.35,1.16.62.34.27.61.6.82.99.21.39.35.84.41,1.35ZM184.9,234.32v3.78h-1.81v-8.73h1.76v3.34h.08c.15-.39.39-.69.72-.91.33-.22.74-.33,1.24-.33.46,0,.85.1,1.19.3.34.2.61.48.79.85.19.37.28.81.28,1.32v4.17h-1.82v-3.84c0-.4-.1-.72-.31-.94-.2-.22-.49-.34-.86-.34-.25,0-.47.05-.66.16-.19.11-.34.26-.44.46-.1.2-.16.44-.16.72ZM192.39,234.32v3.78h-1.82v-8.73h1.76v3.34h.08c.15-.39.39-.69.72-.91.33-.22.74-.33,1.24-.33.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.81.28,1.32v4.17h-1.82v-3.84c0-.4-.1-.72-.31-.94-.2-.22-.49-.34-.86-.34-.25,0-.47.05-.66.16-.19.11-.33.26-.44.46-.1.2-.16.44-.16.72ZM199.88,234.32v3.78h-1.82v-6.55h1.73v1.15h.08c.15-.38.39-.68.73-.9.34-.22.75-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.25,0-.46.05-.65.16-.18.11-.33.26-.43.46-.1.2-.15.44-.16.72ZM207.39,238.22c-.42,0-.79-.07-1.12-.22-.33-.15-.59-.36-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6.23-.15.49-.26.78-.34.29-.08.6-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.1-.07.16-.18.16-.32v-.02c0-.27-.09-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.34.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.42h-1.72v-.91h-.05c-.1.21-.25.38-.42.54-.18.15-.39.27-.63.36-.25.09-.53.13-.86.13ZM207.91,236.97c.27,0,.5-.05.71-.16.2-.11.37-.25.48-.43.12-.18.18-.39.18-.62v-.69c-.06.04-.13.07-.23.1-.1.03-.21.06-.33.08-.12.02-.25.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM214.3,234.32v3.78h-1.82v-6.55h1.73v1.15h.08c.14-.38.39-.68.73-.9.34-.22.76-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.24,0-.46.05-.65.16-.18.11-.33.26-.43.46-.1.2-.15.44-.16.72ZM222.9,240.69c-.59,0-1.09-.08-1.51-.24-.42-.16-.75-.38-1-.65-.25-.28-.41-.59-.48-.93l1.68-.23c.05.13.13.25.24.37.11.11.26.2.44.27.18.07.41.11.67.11.39,0,.72-.1.98-.29.26-.19.39-.51.39-.96v-1.2h-.08c-.08.18-.2.35-.36.52-.16.16-.36.29-.61.4-.25.1-.55.15-.9.15-.49,0-.94-.11-1.34-.34-.4-.23-.72-.58-.96-1.05-.24-.48-.35-1.07-.35-1.8s.12-1.36.36-1.86c.24-.5.56-.87.96-1.12.4-.25.85-.37,1.32-.37.37,0,.67.06.92.19.25.12.45.28.6.46.15.18.27.36.35.54h.07v-1.1h1.8v6.61c0,.56-.14,1.02-.41,1.4s-.65.66-1.13.84c-.48.19-1.03.29-1.66.29ZM222.94,236.64c.29,0,.54-.07.74-.22.2-.15.36-.36.47-.63.11-.28.17-.61.17-.99s-.05-.72-.16-1c-.11-.28-.26-.5-.47-.66-.21-.16-.45-.23-.75-.23s-.55.08-.75.24c-.21.16-.36.38-.46.67-.1.28-.16.61-.16.98s.05.7.16.98c.11.27.26.48.46.64.2.15.46.22.75.22Z"></path>
      </g>
      <g id="KampongCham-3" data-name="KampongCham" class="tooltip" data-tooltip="kampong-cham" style="display: none;">
        <path class="cls-4" d="M278.17,255c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M278.17,264.9c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M278.17,258.3l6.4-11.1h-12.8l6.4,11.1Z"></path>
        <path class="cls-9" d="M374.57,224.2h-105.1c-4.25,0-7.7,3.45-7.7,7.7v9.6c0,4.25,3.45,7.7,7.7,7.7h105.1c4.25,0,7.7-3.45,7.7-7.7v-9.6c0-4.25-3.45-7.7-7.7-7.7Z"></path>
        <path class="cls-5" d="M276.03,240v-8.73h1.85v3.85h.12l3.14-3.85h2.21l-3.24,3.91,3.28,4.82h-2.21l-2.39-3.59-.91,1.11v2.48h-1.85ZM286.13,240.12c-.42,0-.79-.07-1.12-.22-.33-.15-.58-.37-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6s.49-.26.78-.34c.3-.08.61-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.02c0-.27-.08-.48-.26-.63-.17-.15-.41-.22-.71-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.08-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.33.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.11.21-.25.39-.42.54-.18.15-.39.28-.64.36-.25.08-.53.13-.86.13ZM286.65,238.87c.27,0,.5-.05.71-.16.2-.11.36-.25.48-.43.12-.18.18-.39.18-.62v-.69c-.06.04-.14.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM291.23,240v-6.55h1.73v1.15h.08c.14-.38.36-.69.68-.91.32-.22.7-.33,1.14-.33s.83.11,1.15.34c.32.22.52.52.63.9h.07c.13-.38.38-.67.72-.9.35-.23.77-.34,1.25-.34.61,0,1.11.19,1.49.58.38.39.57.93.57,1.65v4.4h-1.81v-4.04c0-.36-.1-.64-.29-.82-.19-.18-.43-.27-.72-.27-.33,0-.59.1-.77.31-.18.21-.28.48-.28.82v4h-1.76v-4.08c0-.32-.09-.58-.28-.77-.18-.19-.42-.29-.72-.29-.2,0-.38.05-.55.15-.16.1-.29.24-.38.42-.09.18-.14.39-.14.63v3.93h-1.82ZM302.17,242.45v-9h1.79v1.1h.08c.08-.18.19-.35.35-.54.15-.18.35-.34.6-.46.25-.12.55-.19.92-.19.48,0,.92.12,1.32.38.4.25.73.62.97,1.12.24.5.36,1.12.36,1.87s-.12,1.35-.35,1.85c-.23.5-.55.88-.96,1.14-.4.26-.85.38-1.35.38-.35,0-.65-.06-.9-.17-.24-.12-.45-.26-.6-.44-.16-.18-.28-.36-.36-.54h-.06v3.5h-1.82ZM303.95,236.73c0,.39.05.73.16,1.02.11.29.26.51.47.68.2.16.45.24.75.24s.54-.08.75-.24c.2-.17.36-.39.46-.68.11-.29.16-.63.16-1.01s-.05-.71-.16-1c-.1-.29-.26-.51-.46-.67-.2-.16-.46-.24-.75-.24s-.55.08-.75.23c-.2.16-.36.38-.46.66s-.16.62-.16,1.01ZM312.73,240.13c-.66,0-1.23-.14-1.72-.42-.48-.28-.85-.68-1.11-1.18-.26-.51-.39-1.1-.39-1.77s.13-1.27.39-1.77c.26-.51.63-.9,1.11-1.18.48-.28,1.05-.43,1.72-.43s1.23.14,1.71.43c.48.28.86.68,1.12,1.18.26.51.39,1.1.39,1.77s-.13,1.26-.39,1.77c-.26.51-.63.9-1.12,1.18-.48.28-1.05.42-1.71.42ZM312.73,238.72c.3,0,.55-.09.75-.26.2-.17.35-.41.46-.71.11-.3.16-.64.16-1.02s-.05-.72-.16-1.02c-.1-.3-.25-.54-.46-.71-.2-.17-.45-.26-.75-.26s-.56.09-.77.26c-.21.17-.36.41-.46.71-.1.3-.15.64-.15,1.02s.05.72.15,1.02c.1.3.26.54.46.71.21.17.46.26.77.26ZM318.94,236.22v3.78h-1.82v-6.55h1.73v1.15h.08c.15-.38.39-.68.73-.9.34-.22.75-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.25,0-.46.05-.65.16-.18.11-.33.26-.43.46-.1.2-.15.44-.16.72ZM327.54,242.59c-.59,0-1.09-.08-1.51-.24-.42-.16-.75-.38-1-.65s-.41-.59-.48-.93l1.68-.23c.05.13.13.25.24.37.11.11.26.2.44.27.18.07.41.11.67.11.39,0,.72-.1.97-.29.26-.19.39-.51.39-.96v-1.2h-.08c-.08.18-.2.35-.36.51-.16.16-.36.29-.61.4-.25.1-.55.15-.89.15-.49,0-.94-.11-1.34-.34-.4-.23-.72-.58-.96-1.05-.24-.48-.35-1.07-.35-1.8s.12-1.36.36-1.86c.24-.5.56-.87.96-1.12.4-.25.85-.37,1.33-.37.37,0,.67.06.92.19.25.12.45.27.6.46.15.18.27.36.35.54h.07v-1.1h1.8v6.61c0,.56-.14,1.02-.41,1.4s-.65.66-1.13.84c-.48.19-1.03.29-1.66.29ZM327.58,238.54c.29,0,.54-.07.74-.22.2-.15.36-.36.47-.63.11-.28.17-.61.17-.99s-.05-.72-.16-1c-.11-.28-.26-.51-.47-.66-.2-.16-.45-.23-.75-.23s-.55.08-.75.24c-.2.16-.36.38-.46.66-.11.28-.16.61-.16.98s.05.7.16.98c.11.27.26.48.46.63.2.15.46.22.75.22ZM342.7,234.33h-1.87c-.03-.24-.1-.46-.21-.64-.11-.19-.24-.35-.4-.49-.16-.13-.36-.24-.57-.31-.21-.07-.44-.11-.69-.11-.45,0-.85.11-1.18.34-.33.22-.6.55-.78.97-.18.42-.28.94-.28,1.54s.09,1.15.28,1.57c.19.42.45.74.78.96.33.22.72.32,1.16.32.25,0,.48-.03.69-.1.21-.07.4-.16.57-.29.17-.13.3-.28.41-.46.11-.18.19-.39.23-.62h1.87c-.05.41-.17.79-.36,1.17-.19.37-.45.7-.77.99-.32.29-.7.52-1.15.69-.44.17-.94.25-1.5.25-.78,0-1.47-.18-2.09-.53-.61-.35-1.09-.86-1.45-1.53-.35-.67-.53-1.48-.53-2.43s.18-1.76.54-2.43c.36-.67.84-1.18,1.46-1.52.61-.35,1.3-.53,2.07-.53.51,0,.98.07,1.41.21.43.14.82.35,1.15.62.34.27.61.6.82.99.21.39.35.84.41,1.35ZM345.8,236.22v3.78h-1.82v-8.73h1.76v3.34h.08c.15-.39.39-.69.71-.91.33-.22.74-.33,1.24-.33.45,0,.85.1,1.19.3.34.2.61.48.79.85.19.37.28.8.28,1.32v4.17h-1.82v-3.84c0-.4-.1-.72-.31-.94-.2-.22-.49-.34-.86-.34-.25,0-.47.05-.66.16-.19.11-.34.26-.44.46-.1.2-.16.44-.16.72ZM353.34,240.12c-.42,0-.79-.07-1.12-.22-.33-.15-.58-.37-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6s.49-.26.78-.34c.3-.08.61-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.02c0-.27-.08-.48-.26-.63-.17-.15-.41-.22-.71-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.08-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.33.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.41h-1.72v-.91h-.05c-.11.21-.25.39-.42.54-.18.15-.39.28-.64.36-.25.08-.53.13-.86.13ZM353.86,238.87c.27,0,.5-.05.71-.16.2-.11.36-.25.48-.43.12-.18.18-.39.18-.62v-.69c-.06.04-.14.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM358.44,240v-6.55h1.73v1.15h.08c.14-.38.36-.69.68-.91.32-.22.7-.33,1.14-.33s.83.11,1.15.34c.32.22.52.52.63.9h.07c.13-.38.38-.67.72-.9.35-.23.77-.34,1.25-.34.61,0,1.11.19,1.49.58.38.39.57.93.57,1.65v4.4h-1.81v-4.04c0-.36-.1-.64-.29-.82-.19-.18-.43-.27-.72-.27-.33,0-.59.1-.77.31-.19.21-.28.48-.28.82v4h-1.76v-4.08c0-.32-.09-.58-.28-.77-.18-.19-.42-.29-.72-.29-.2,0-.38.05-.55.15-.16.1-.29.24-.38.42-.09.18-.14.39-.14.63v3.93h-1.82Z"></path>
      </g>
      <g id="PhnomPenh-2" data-name="PhnomPenh" class="tooltip" data-tooltip="phnom-penh" style="display: none;">
        <path class="cls-4" d="M241.97,298.2c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M241.97,308.2c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M241.97,301.6l6.4-11.1h-12.8l6.4,11.1Z"></path>
        <path class="cls-9" d="M254.37,266.6h-84.3c-4.47,0-8.1,3.63-8.1,8.1v9c0,4.47,3.63,8.1,8.1,8.1h84.3c4.47,0,8.1-3.63,8.1-8.1v-9c0-4.47-3.63-8.1-8.1-8.1Z"></path>
        <path class="cls-5" d="M176.23,282.5v-8.73h3.44c.66,0,1.23.13,1.69.38.47.25.82.6,1.07,1.04.25.44.37.95.37,1.53s-.12,1.09-.38,1.53-.61.79-1.09,1.04c-.47.25-1.04.37-1.71.37h-2.2v-1.48h1.9c.36,0,.65-.06.88-.18.23-.12.41-.3.52-.52.12-.22.18-.48.18-.76s-.06-.54-.18-.76c-.11-.22-.29-.39-.52-.51-.23-.12-.53-.18-.89-.18h-1.24v7.22h-1.85ZM185.78,278.72v3.78h-1.82v-8.73h1.76v3.34h.08c.15-.39.39-.69.72-.91.33-.22.74-.33,1.24-.33.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.81.28,1.32v4.17h-1.82v-3.84c0-.4-.1-.72-.31-.94-.2-.22-.49-.34-.86-.34-.25,0-.47.05-.66.16-.19.1-.34.26-.44.46-.1.2-.16.44-.16.72ZM193.27,278.72v3.78h-1.82v-6.55h1.73v1.15h.08c.15-.38.39-.68.73-.9.34-.22.75-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.81v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.24,0-.46.05-.65.16-.18.1-.33.26-.43.46-.1.2-.15.44-.16.72ZM201.87,282.63c-.66,0-1.23-.14-1.72-.42-.48-.28-.85-.68-1.11-1.18-.26-.51-.39-1.1-.39-1.77s.13-1.27.39-1.77c.26-.51.63-.9,1.11-1.18.48-.28,1.06-.43,1.72-.43s1.23.14,1.71.43c.48.28.85.68,1.12,1.18.26.51.39,1.1.39,1.77s-.13,1.26-.39,1.77c-.26.51-.63.9-1.12,1.18-.48.28-1.05.42-1.71.42ZM201.88,281.22c.3,0,.55-.09.75-.26.2-.17.35-.41.46-.71.1-.3.16-.64.16-1.02s-.05-.72-.16-1.02c-.1-.3-.25-.53-.46-.71-.2-.17-.45-.26-.75-.26s-.56.09-.77.26c-.21.17-.36.41-.46.71-.1.3-.15.64-.15,1.02s.05.72.15,1.02c.11.3.26.53.46.71.21.17.46.26.77.26ZM206.28,282.5v-6.55h1.73v1.15h.08c.14-.38.36-.69.68-.91.32-.22.7-.33,1.14-.33s.83.11,1.15.34c.32.22.53.52.63.9h.07c.13-.38.38-.67.73-.9.35-.23.77-.34,1.25-.34.61,0,1.11.2,1.49.58.38.39.57.93.57,1.64v4.4h-1.81v-4.04c0-.36-.1-.64-.29-.82-.19-.18-.43-.27-.72-.27-.33,0-.59.11-.77.32-.18.21-.28.48-.28.82v4h-1.76v-4.08c0-.32-.09-.58-.28-.77-.18-.19-.42-.29-.72-.29-.2,0-.38.05-.54.15-.16.1-.29.24-.38.42-.09.18-.14.39-.14.63v3.93h-1.82Z"></path>
        <path class="cls-5" d="M220.03,282.5v-8.73h3.44c.66,0,1.23.13,1.69.38.47.25.82.6,1.07,1.04.25.44.37.95.37,1.53s-.12,1.09-.38,1.53-.61.79-1.09,1.04c-.47.25-1.04.37-1.71.37h-2.2v-1.48h1.9c.35,0,.65-.06.88-.18.23-.12.41-.3.52-.52.12-.22.18-.48.18-.76s-.06-.54-.18-.76c-.11-.22-.29-.39-.52-.51-.23-.12-.53-.18-.89-.18h-1.24v7.22h-1.84Z"></path>
        <path class="cls-5" d="M230.58,282.63c-.67,0-1.25-.14-1.74-.41-.48-.28-.86-.67-1.12-1.17-.26-.51-.39-1.1-.39-1.79s.13-1.26.39-1.77c.26-.51.63-.9,1.1-1.19.48-.28,1.04-.43,1.68-.43.43,0,.83.07,1.21.21.38.14.7.34.98.62.28.28.5.62.66,1.04.16.42.24.9.24,1.46v.5h-5.53v-1.12h3.82c0-.26-.06-.49-.17-.69-.11-.2-.27-.36-.47-.47-.2-.12-.43-.17-.69-.17s-.52.06-.73.19c-.21.12-.38.29-.49.51-.12.21-.18.45-.18.7v1.07c0,.32.06.6.18.84.12.23.29.42.52.54.22.13.48.19.79.19.2,0,.39-.03.55-.09.17-.06.31-.14.43-.26.12-.11.21-.25.27-.42l1.68.11c-.09.4-.26.76-.52,1.06-.26.3-.6.53-1.01.7-.41.16-.89.25-1.43.25ZM236.58,278.72v3.78h-1.82v-6.55h1.73v1.15h.08c.15-.38.39-.68.73-.9.34-.22.75-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.25,0-.46.05-.65.16-.18.1-.33.26-.43.46-.1.2-.15.44-.16.72ZM244.05,278.72v3.78h-1.82v-8.73h1.76v3.34h.08c.15-.39.39-.69.72-.91.33-.22.74-.33,1.24-.33.46,0,.85.1,1.19.3.34.2.61.48.79.85.19.37.28.81.28,1.32v4.17h-1.82v-3.84c0-.4-.1-.72-.31-.94-.21-.22-.49-.34-.86-.34-.25,0-.47.05-.66.16-.19.1-.34.26-.44.46-.1.2-.16.44-.16.72Z"></path>
      </g>
      <g id="PreahSihanouk-2" data-name="PreahSihanouk" class="tooltip" data-tooltip="preah-sihanouk" style="display: none;">
        <path class="cls-4" d="M128.27,387.9c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M128.27,397.9c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M128.27,391.3l6.4-11.1h-12.8l6.4,11.1Z"></path>
        <path class="cls-9" d="M137.77,356.9H33.07c-3.81,0-6.9,3.09-6.9,6.9v10c0,3.81,3.09,6.9,6.9,6.9h104.7c3.81,0,6.9-3.09,6.9-6.9v-10c0-3.81-3.09-6.9-6.9-6.9Z"></path>
        <path class="cls-5" d="M40.43,372.1v-8.73h3.44c.66,0,1.23.13,1.69.38.47.25.82.6,1.07,1.04.25.44.37.96.37,1.53s-.12,1.09-.38,1.53c-.25.44-.61.79-1.09,1.04-.47.25-1.04.37-1.71.37h-2.19v-1.48h1.9c.36,0,.65-.06.88-.18.23-.12.41-.3.52-.52.12-.22.17-.48.17-.76s-.06-.54-.17-.76c-.11-.22-.29-.39-.52-.51-.23-.12-.53-.18-.89-.18h-1.24v7.22h-1.85Z"></path>
        <path class="cls-5" d="M48.09,372.1v-6.55h1.76v1.14h.07c.12-.41.32-.71.6-.92.28-.21.61-.32.97-.32.09,0,.19,0,.29.02.11.01.2.03.28.05v1.61c-.09-.03-.2-.05-.35-.07-.15-.02-.29-.03-.41-.03-.27,0-.51.06-.72.17-.21.11-.37.27-.49.48-.12.21-.18.44-.18.71v3.7h-1.82Z"></path>
        <path class="cls-5" d="M55.68,372.23c-.67,0-1.25-.14-1.74-.41-.48-.28-.86-.67-1.12-1.17-.26-.51-.39-1.1-.39-1.79s.13-1.26.39-1.77c.26-.51.63-.9,1.1-1.19.48-.28,1.04-.43,1.68-.43.43,0,.83.07,1.21.21.38.14.7.34.98.62.28.28.5.62.66,1.04.16.42.23.9.23,1.46v.5h-5.53v-1.12h3.82c0-.26-.06-.49-.17-.7-.11-.2-.27-.36-.47-.47-.2-.12-.43-.17-.69-.17s-.52.06-.73.19c-.21.12-.38.29-.49.51-.12.21-.18.44-.18.7v1.07c0,.32.06.6.18.84.12.24.29.42.52.55.22.13.48.19.79.19.2,0,.39-.03.55-.08.17-.06.31-.14.43-.26.12-.11.21-.25.27-.42l1.68.11c-.09.4-.26.76-.52,1.06-.26.3-.6.53-1.01.7-.41.16-.89.25-1.43.25ZM61.73,372.22c-.42,0-.79-.07-1.12-.22-.33-.15-.59-.37-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6.23-.15.49-.26.78-.34.3-.08.61-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.02c0-.27-.09-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.34.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.42h-1.72v-.91h-.05c-.11.21-.25.39-.42.54-.18.15-.39.27-.63.36-.25.08-.53.13-.86.13ZM62.25,370.97c.27,0,.5-.05.71-.16.2-.11.37-.25.48-.43.12-.18.17-.39.17-.62v-.69c-.06.04-.13.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15s-.28.16-.37.28c-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM68.64,368.32v3.78h-1.82v-8.73h1.76v3.34h.08c.15-.39.39-.69.72-.91.33-.22.74-.33,1.24-.33.45,0,.85.1,1.19.3.34.2.61.48.79.85.19.37.28.8.28,1.32v4.17h-1.82v-3.84c0-.4-.1-.72-.31-.94-.2-.22-.49-.34-.86-.34-.25,0-.47.05-.66.16-.19.11-.34.26-.44.46-.11.2-.16.44-.16.72ZM81.86,365.88c-.03-.34-.18-.61-.44-.8-.26-.19-.61-.29-1.05-.29-.3,0-.56.04-.76.13-.21.08-.37.2-.48.35-.11.15-.16.32-.16.5,0,.16.03.29.1.41.07.12.17.22.3.3.13.08.28.15.44.22.17.06.35.11.54.15l.78.19c.38.09.73.2,1.05.34s.59.32.83.52c.23.21.41.45.54.73.13.28.2.6.2.97,0,.53-.14,1-.41,1.39-.27.39-.65.69-1.16.91-.5.21-1.11.32-1.82.32s-1.32-.11-1.84-.32c-.52-.22-.93-.54-1.22-.96-.29-.43-.44-.95-.46-1.58h1.79c.02.29.1.54.25.73.15.19.35.34.6.44.25.1.54.14.86.14s.58-.05.81-.14c.23-.09.41-.22.54-.38.13-.16.19-.35.19-.56,0-.2-.06-.36-.17-.49-.11-.13-.28-.25-.5-.34-.22-.09-.49-.18-.81-.26l-.95-.24c-.74-.18-1.32-.46-1.74-.84-.43-.38-.64-.89-.64-1.54,0-.53.14-.99.42-1.38.29-.39.68-.7,1.18-.92.5-.22,1.07-.33,1.7-.33s1.21.11,1.7.33c.49.22.86.53,1.13.92.27.39.41.85.42,1.37h-1.77ZM84.96,372.1v-6.55h1.82v6.55h-1.82ZM85.87,364.71c-.27,0-.5-.09-.69-.27-.19-.18-.29-.4-.29-.65s.1-.46.29-.64c.19-.18.42-.27.69-.27s.5.09.69.27c.19.18.29.39.29.64s-.1.47-.29.65c-.19.18-.42.27-.69.27ZM90.04,368.32v3.78h-1.82v-8.73h1.76v3.34h.08c.15-.39.39-.69.72-.91.33-.22.74-.33,1.24-.33.45,0,.85.1,1.19.3.34.2.61.48.79.85.19.37.28.8.28,1.32v4.17h-1.82v-3.84c0-.4-.1-.72-.31-.94-.2-.22-.49-.34-.86-.34-.25,0-.47.05-.66.16-.19.11-.34.26-.44.46-.11.2-.16.44-.16.72ZM97.58,372.22c-.42,0-.79-.07-1.12-.22-.33-.15-.59-.37-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6.23-.15.49-.26.78-.34.3-.08.61-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.02c0-.27-.09-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.34.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.42h-1.72v-.91h-.05c-.11.21-.25.39-.42.54-.18.15-.39.27-.63.36-.25.08-.53.13-.86.13ZM98.1,370.97c.27,0,.5-.05.71-.16.2-.11.37-.25.48-.43.12-.18.17-.39.17-.62v-.69c-.06.04-.14.07-.23.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15-.16.07-.28.16-.37.28-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM104.49,368.32v3.78h-1.81v-6.55h1.73v1.15h.08c.14-.38.39-.68.73-.9.34-.22.75-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.24,0-.46.05-.65.16-.18.11-.33.26-.43.46-.1.2-.16.44-.16.72ZM113.1,372.23c-.66,0-1.23-.14-1.72-.42-.48-.28-.85-.68-1.11-1.18-.26-.51-.39-1.1-.39-1.77s.13-1.27.39-1.77c.26-.51.63-.9,1.11-1.18.48-.28,1.06-.43,1.72-.43s1.23.14,1.71.43c.48.28.86.68,1.12,1.18.26.51.39,1.1.39,1.77s-.13,1.26-.39,1.77c-.26.51-.63.9-1.12,1.18-.48.28-1.05.42-1.71.42ZM113.11,370.82c.3,0,.55-.09.75-.26.2-.17.35-.41.46-.71.1-.3.16-.64.16-1.02s-.05-.72-.16-1.02c-.1-.3-.25-.53-.46-.71-.2-.17-.45-.26-.75-.26s-.56.09-.77.26c-.2.17-.36.41-.46.71-.1.3-.15.64-.15,1.02s.05.72.15,1.02c.1.3.26.53.46.71.21.17.46.26.77.26ZM121.7,369.31v-3.76h1.82v6.55h-1.74v-1.19h-.07c-.15.38-.39.69-.74.92-.34.23-.76.35-1.25.35-.44,0-.82-.1-1.15-.3-.33-.2-.59-.48-.78-.85-.18-.37-.28-.8-.28-1.32v-4.17h1.82v3.84c0,.39.11.69.31.92.2.23.48.34.82.34.22,0,.42-.05.61-.15.19-.1.34-.25.46-.45.12-.2.18-.44.17-.74ZM126.61,370.22v-2.18h.27l2.1-2.48h2.08l-2.82,3.29h-.43l-1.2,1.37ZM124.96,372.1v-8.73h1.82v8.73h-1.82ZM129.05,372.1l-1.93-2.85,1.21-1.28,2.84,4.13h-2.13Z"></path>
      </g>
      <g id="TboungKhmum-2" data-name="TboungKhmum" class="tooltip" data-tooltip="tboung-khmum" style="display: none;">
        <path class="cls-9" d="M336.57,265.3l6.4-11.1h-12.8l6.4,11.1Z"></path>
        <path class="cls-9" d="M432.97,231.1h-105.1c-4.25,0-7.7,3.45-7.7,7.7v9.6c0,4.25,3.45,7.7,7.7,7.7h105.1c4.25,0,7.7-3.45,7.7-7.7v-9.6c0-4.25-3.45-7.7-7.7-7.7Z"></path>
        <path class="cls-5" d="M334.2,239.69v-1.52h7.17v1.52h-2.67v7.21h-1.82v-7.21h-2.67ZM342.54,246.9v-8.73h1.82v3.28h.06c.08-.18.19-.35.35-.54.15-.19.35-.34.6-.46.25-.12.55-.19.92-.19.48,0,.92.12,1.32.38.4.25.73.62.97,1.12.24.5.36,1.12.36,1.87s-.12,1.35-.35,1.85c-.23.5-.55.88-.96,1.14-.4.26-.85.38-1.35.38-.35,0-.65-.06-.9-.17-.24-.12-.45-.26-.6-.44-.16-.18-.28-.36-.36-.54h-.08v1.05h-1.79ZM344.32,243.63c0,.39.05.73.16,1.02.11.29.26.51.47.68.2.16.45.24.75.24s.55-.08.75-.24c.2-.16.36-.39.46-.68.11-.29.16-.63.16-1.01s-.05-.71-.16-1c-.1-.29-.26-.51-.46-.67-.2-.16-.46-.24-.75-.24s-.55.08-.75.23c-.2.16-.36.38-.46.67-.11.29-.16.62-.16,1.01ZM353.1,247.03c-.66,0-1.23-.14-1.72-.42-.48-.28-.85-.68-1.11-1.18-.26-.51-.39-1.1-.39-1.77s.13-1.27.39-1.77c.26-.51.63-.9,1.11-1.18.48-.28,1.05-.43,1.72-.43s1.23.14,1.71.43c.48.28.86.68,1.12,1.18.26.51.39,1.1.39,1.77s-.13,1.26-.39,1.77c-.26.51-.63.9-1.12,1.18-.48.28-1.05.42-1.71.42ZM353.11,245.62c.3,0,.55-.09.75-.26.2-.17.35-.41.46-.71.11-.3.16-.64.16-1.02s-.05-.72-.16-1.02c-.1-.3-.25-.53-.46-.71s-.45-.26-.75-.26-.56.09-.77.26c-.21.17-.36.41-.47.71-.1.3-.15.64-.15,1.02s.05.72.15,1.02c.11.3.26.53.47.71.21.17.46.26.77.26ZM361.7,244.11v-3.76h1.81v6.54h-1.74v-1.19h-.07c-.15.38-.39.69-.74.93-.34.23-.76.35-1.25.35-.44,0-.82-.1-1.15-.3-.33-.2-.59-.48-.78-.85-.18-.37-.28-.81-.28-1.32v-4.17h1.82v3.84c0,.39.11.69.31.92.2.23.48.34.82.34.22,0,.42-.05.61-.15.19-.1.34-.25.46-.45.12-.2.18-.44.18-.74ZM366.78,243.12v3.78h-1.82v-6.54h1.73v1.15h.08c.15-.38.39-.68.73-.9.34-.23.75-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.25,0-.46.05-.65.16-.18.11-.33.26-.43.46-.1.2-.15.44-.16.72ZM375.38,249.49c-.59,0-1.09-.08-1.51-.24-.42-.16-.75-.38-1-.65-.25-.28-.41-.58-.48-.93l1.68-.23c.05.13.13.25.24.37.11.11.26.2.44.27.18.07.41.11.67.11.39,0,.72-.1.97-.29.26-.19.39-.51.39-.96v-1.2h-.08c-.08.18-.2.35-.36.51-.16.16-.36.29-.61.4s-.55.15-.89.15c-.49,0-.94-.11-1.34-.34-.4-.23-.72-.58-.96-1.05-.24-.47-.35-1.07-.35-1.8s.12-1.36.36-1.86c.24-.5.56-.87.96-1.12.4-.25.85-.37,1.33-.37.37,0,.67.06.92.19.25.12.45.27.6.46.15.18.27.36.35.54h.07v-1.1h1.8v6.61c0,.56-.14,1.02-.41,1.4s-.65.66-1.13.84c-.48.19-1.03.29-1.66.29ZM375.42,245.44c.29,0,.54-.07.74-.22.2-.15.36-.36.47-.63.11-.28.17-.61.17-.99s-.05-.72-.16-1c-.11-.28-.26-.5-.47-.66-.21-.16-.45-.23-.75-.23s-.55.08-.75.24c-.21.16-.36.38-.46.66-.11.28-.16.61-.16.98s.05.7.16.98c.11.27.26.48.46.63.2.15.46.22.75.22ZM382.83,246.9v-8.73h1.85v3.85h.11l3.14-3.85h2.21l-3.24,3.91,3.28,4.82h-2.21l-2.39-3.59-.91,1.11v2.48h-1.85ZM392.89,243.12v3.78h-1.82v-8.73h1.76v3.34h.08c.15-.39.39-.69.72-.91.33-.22.74-.33,1.24-.33.46,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.32v4.17h-1.82v-3.84c0-.4-.1-.72-.31-.94-.2-.22-.49-.34-.86-.34-.25,0-.47.05-.66.16-.19.11-.34.26-.44.46-.1.2-.16.44-.16.72ZM398.56,246.9v-6.54h1.73v1.15h.08c.14-.38.36-.69.68-.91.32-.22.7-.33,1.14-.33s.83.11,1.15.34c.32.22.52.52.63.9h.07c.13-.38.38-.67.72-.9.35-.23.77-.34,1.25-.34.61,0,1.11.2,1.49.58.38.39.57.93.57,1.65v4.4h-1.81v-4.04c0-.36-.1-.64-.29-.82-.19-.18-.43-.27-.72-.27-.33,0-.59.1-.77.32-.19.21-.28.48-.28.82v4h-1.76v-4.08c0-.32-.09-.58-.28-.77-.18-.19-.42-.29-.72-.29-.2,0-.38.05-.55.15-.16.1-.29.24-.38.42-.09.18-.14.39-.14.63v3.93h-1.82ZM413.7,244.11v-3.76h1.82v6.54h-1.74v-1.19h-.07c-.15.38-.39.69-.74.93-.34.23-.76.35-1.25.35-.44,0-.82-.1-1.15-.3-.33-.2-.59-.48-.78-.85-.18-.37-.28-.81-.28-1.32v-4.17h1.82v3.84c0,.39.11.69.31.92.2.23.48.34.82.34.22,0,.42-.05.61-.15.19-.1.34-.25.46-.45.12-.2.18-.44.18-.74ZM416.97,246.9v-6.54h1.73v1.15h.08c.14-.38.36-.69.68-.91.32-.22.7-.33,1.14-.33s.83.11,1.15.34c.32.22.53.52.63.9h.07c.13-.38.38-.67.72-.9.35-.23.77-.34,1.25-.34.61,0,1.11.2,1.49.58.38.39.57.93.57,1.65v4.4h-1.81v-4.04c0-.36-.1-.64-.29-.82-.19-.18-.43-.27-.72-.27-.33,0-.59.1-.77.32-.18.21-.28.48-.28.82v4h-1.76v-4.08c0-.32-.09-.58-.28-.77-.18-.19-.42-.29-.72-.29-.2,0-.38.05-.55.15-.16.1-.29.24-.38.42-.09.18-.14.39-.14.63v3.93h-1.82Z"></path>
        <path class="cls-4" d="M336.67,261.6c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M336.67,271.5c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
      </g>
      <g id="PreyVeng-2" data-name="PreyVeng" class="tooltip" data-tooltip="prey-veng" style="display: none;">
        <path class="cls-4" d="M303.37,302.7c-3.8,0-7,3.2-7,7s3.2,7,7,7,7-3.2,7-7-3.2-7-7-7Z"></path>
        <path class="cls-3" d="M303.37,312.6c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M303.27,306.3l6.4-11.1h-12.8l6.4,11.1Z"></path>
        <path class="cls-9" d="M356.57,271.2h-65.4c-3.65,0-6.6,2.95-6.6,6.6v11.8c0,3.64,2.95,6.6,6.6,6.6h65.4c3.64,0,6.6-2.96,6.6-6.6v-11.8c0-3.64-2.96-6.6-6.6-6.6Z"></path>
        <path class="cls-5" d="M294.73,287v-8.73h3.44c.66,0,1.23.13,1.69.38.46.25.82.6,1.06,1.04.25.44.37.95.37,1.53s-.12,1.09-.38,1.53-.61.79-1.09,1.04c-.47.25-1.04.37-1.71.37h-2.2v-1.48h1.9c.36,0,.65-.06.88-.18.23-.12.41-.3.52-.52.12-.22.17-.48.17-.76s-.06-.54-.17-.76c-.11-.22-.29-.39-.52-.51-.23-.12-.53-.18-.89-.18h-1.24v7.22h-1.85Z"></path>
        <path class="cls-5" d="M302.49,287v-6.55h1.76v1.14h.07c.12-.41.32-.71.6-.92.28-.21.61-.32.97-.32.09,0,.19,0,.29.02.11.01.2.03.28.05v1.61c-.08-.03-.2-.05-.35-.07-.15-.02-.29-.03-.41-.03-.27,0-.51.06-.72.17-.21.11-.37.27-.49.48-.12.21-.18.44-.18.71v3.7h-1.82Z"></path>
        <path class="cls-5" d="M310.08,287.13c-.67,0-1.25-.14-1.74-.41-.48-.28-.85-.67-1.12-1.17-.26-.51-.39-1.1-.39-1.79s.13-1.26.39-1.77c.26-.51.63-.9,1.1-1.19.48-.28,1.04-.43,1.68-.43.43,0,.83.07,1.21.21.38.14.7.34.98.62.28.28.5.62.66,1.04.16.42.24.9.24,1.46v.5h-5.53v-1.12h3.82c0-.26-.06-.49-.17-.69-.11-.2-.27-.36-.47-.47-.2-.12-.43-.17-.69-.17s-.52.06-.73.19c-.21.12-.38.29-.49.51-.12.21-.18.45-.18.7v1.07c0,.32.06.6.18.84.12.23.29.42.52.54.22.13.48.19.79.19.2,0,.39-.03.55-.09.17-.06.31-.14.43-.26.12-.11.21-.25.27-.42l1.68.11c-.08.4-.26.76-.52,1.06-.26.3-.6.53-1.01.7-.41.16-.89.25-1.43.25Z"></path>
        <path class="cls-5" d="M315.21,289.45c-.23,0-.45-.02-.65-.06-.2-.03-.36-.08-.49-.13l.41-1.36c.21.07.4.1.58.11.17,0,.32-.03.45-.12.13-.08.23-.23.31-.43l.11-.28-2.35-6.73h1.91l1.35,4.81h.07l1.37-4.81h1.92l-2.54,7.25c-.12.35-.29.66-.5.92-.21.26-.47.47-.79.61-.32.14-.7.22-1.15.22Z"></path>
        <path class="cls-5" d="M325.51,278.27l2.11,6.63h.08l2.11-6.63h2.05l-3.01,8.73h-2.38l-3.01-8.73h2.05Z"></path>
        <path class="cls-5" d="M335.08,287.13c-.67,0-1.25-.14-1.74-.41-.48-.28-.85-.67-1.12-1.17-.26-.51-.39-1.1-.39-1.79s.13-1.26.39-1.77c.26-.51.63-.9,1.1-1.19.48-.28,1.04-.43,1.68-.43.43,0,.83.07,1.21.21.38.14.7.34.98.62.28.28.5.62.66,1.04.16.42.24.9.24,1.46v.5h-5.53v-1.12h3.82c0-.26-.06-.49-.17-.69-.11-.2-.27-.36-.47-.47-.2-.12-.43-.17-.69-.17s-.52.06-.73.19c-.21.12-.38.29-.49.51-.12.21-.18.45-.18.7v1.07c0,.32.06.6.18.84.12.23.29.42.52.54.22.13.48.19.79.19.2,0,.39-.03.55-.09.17-.06.31-.14.43-.26.12-.11.21-.25.27-.42l1.68.11c-.08.4-.26.76-.52,1.06-.26.3-.6.53-1.01.7-.41.16-.89.25-1.43.25ZM341.08,283.22v3.78h-1.82v-6.55h1.73v1.15h.08c.14-.38.39-.68.73-.9.34-.22.75-.34,1.24-.34.46,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.24,0-.46.05-.65.16-.18.1-.33.26-.43.46-.1.2-.15.44-.16.72ZM349.68,289.59c-.59,0-1.09-.08-1.51-.24-.42-.16-.75-.38-1-.65-.25-.28-.41-.59-.48-.93l1.68-.23c.05.13.13.25.24.37.11.11.26.2.44.27.18.07.41.11.67.11.4,0,.72-.1.98-.29.26-.19.39-.51.39-.96v-1.2h-.08c-.08.18-.2.35-.36.52-.16.16-.36.29-.61.4-.25.1-.55.15-.89.15-.49,0-.94-.11-1.34-.34-.4-.23-.72-.58-.96-1.05-.24-.48-.35-1.07-.35-1.8s.12-1.36.36-1.86c.24-.5.56-.87.96-1.12.4-.25.85-.37,1.33-.37.37,0,.67.06.92.19.25.12.45.27.6.46.15.18.27.36.35.54h.07v-1.1h1.8v6.61c0,.56-.14,1.02-.41,1.4-.27.38-.65.66-1.13.84-.48.19-1.03.29-1.66.29ZM349.72,285.54c.29,0,.54-.07.74-.22.21-.15.36-.36.47-.63.11-.28.17-.61.17-.99s-.05-.72-.16-1c-.11-.28-.26-.5-.47-.66-.2-.16-.45-.23-.75-.23s-.55.08-.75.24c-.2.16-.36.38-.46.66-.11.28-.16.61-.16.98s.05.71.16.98c.11.27.26.48.46.64.21.15.46.22.75.22Z"></path>
      </g>
      <g id="Kandal-2" data-name="Kandal" class="tooltip" data-tooltip="kandal" style="display: none;">
        <path class="cls-4" d="M266.77,337.8c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M266.77,347.7c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M266.77,341.1l6.4-11.1h-12.8l6.4,11.1Z"></path>
        <path class="cls-9" d="M308.27,306.8h-50.1c-4.14,0-7.5,3.36-7.5,7.5v9.1c0,4.14,3.36,7.5,7.5,7.5h50.1c4.14,0,7.5-3.36,7.5-7.5v-9.1c0-4.14-3.36-7.5-7.5-7.5Z"></path>
        <path class="cls-5" d="M263.63,322.1v-8.73h1.85v3.85h.11l3.14-3.85h2.21l-3.24,3.91,3.28,4.82h-2.21l-2.39-3.59-.91,1.11v2.48h-1.85ZM273.73,322.22c-.42,0-.79-.07-1.12-.22-.33-.15-.59-.37-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.55-.6.23-.15.49-.26.78-.34.29-.08.61-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.11-.07.16-.18.16-.32v-.02c0-.27-.09-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.09-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.33.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.42h-1.72v-.91h-.05c-.11.21-.25.39-.42.54-.18.15-.39.27-.64.36-.25.08-.53.13-.86.13ZM274.25,320.97c.27,0,.5-.05.71-.16.2-.11.36-.25.48-.43.12-.18.18-.39.18-.62v-.69c-.06.04-.14.07-.24.1-.1.03-.2.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15s-.28.16-.37.28c-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM280.64,318.32v3.78h-1.82v-6.55h1.73v1.15h.08c.15-.38.39-.68.73-.9.34-.22.75-.34,1.24-.34.45,0,.85.1,1.19.3.34.2.6.48.79.85.19.37.28.8.28,1.31v4.17h-1.82v-3.84c0-.4-.1-.71-.31-.94-.21-.23-.49-.34-.86-.34-.24,0-.46.05-.65.16-.18.11-.33.26-.43.46-.1.2-.15.44-.16.72ZM288.71,322.21c-.5,0-.95-.13-1.35-.38-.4-.26-.72-.64-.96-1.14-.23-.5-.35-1.12-.35-1.85s.12-1.37.36-1.87c.24-.5.56-.87.96-1.12.4-.25.85-.38,1.32-.38.37,0,.67.06.92.19.25.12.45.27.6.46.15.18.27.36.35.54h.05v-3.28h1.81v8.73h-1.79v-1.05h-.08c-.09.18-.21.36-.36.54-.15.18-.35.32-.6.44-.24.12-.54.17-.89.17ZM289.28,320.76c.29,0,.54-.08.74-.24.2-.16.36-.39.47-.68.11-.29.17-.63.17-1.02s-.05-.73-.16-1.01c-.11-.29-.26-.51-.47-.66-.21-.16-.45-.23-.75-.23s-.55.08-.75.24c-.21.16-.36.39-.46.67-.11.29-.16.62-.16,1s.05.72.16,1.01c.11.29.26.52.46.68.2.16.46.24.75.24ZM295.79,322.22c-.42,0-.79-.07-1.12-.22-.33-.15-.59-.37-.78-.65-.19-.29-.28-.65-.28-1.08,0-.36.07-.67.2-.92.13-.25.32-.45.54-.6.23-.15.49-.26.79-.34.3-.08.61-.13.93-.16.38-.04.69-.08.92-.11.23-.04.4-.09.51-.16.1-.07.16-.18.16-.32v-.02c0-.27-.08-.48-.26-.63-.17-.15-.41-.22-.72-.22-.33,0-.59.07-.78.22-.19.14-.32.32-.38.54l-1.68-.14c.08-.4.25-.74.5-1.03.25-.29.57-.52.97-.67.4-.16.86-.24,1.38-.24.36,0,.71.04,1.04.13.33.09.63.22.89.4.26.18.47.41.62.69.15.28.23.61.23,1v4.42h-1.72v-.91h-.05c-.11.21-.24.39-.42.54-.18.15-.39.27-.64.36-.25.08-.53.13-.86.13ZM296.31,320.97c.27,0,.5-.05.71-.16.21-.11.37-.25.48-.43.12-.18.18-.39.18-.62v-.69c-.06.04-.14.07-.24.1-.1.03-.21.06-.33.08-.12.02-.24.04-.37.06-.12.02-.23.03-.33.05-.21.03-.4.08-.56.15s-.28.16-.37.28c-.09.11-.13.26-.13.43,0,.25.09.44.27.57.18.13.41.19.69.19ZM302.7,313.37v8.73h-1.82v-8.73h1.82Z"></path>
      </g>
      <g id="Takeo-2" data-name="Takeo" class="tooltip" data-tooltip="takeo" style="display: none;">
        <path class="cls-4" d="M242.47,376.6c-3.9,0-7,3.1-7,7s3.1,7,7,7,7-3.1,7-7-3.1-7-7-7Z"></path>
        <path class="cls-3" d="M242.47,386.5c1.6,0,2.9-1.3,2.9-2.9s-1.3-2.9-2.9-2.9-2.9,1.3-2.9,2.9,1.3,2.9,2.9,2.9Z"></path>
        <path class="cls-9" d="M242.47,380l6.4-11.1h-12.8l6.4,11.1Z"></path>
        <path class="cls-9" d="M278.07,345.4h-42.6c-3.42,0-6.2,2.78-6.2,6.2v12.7c0,3.42,2.78,6.2,6.2,6.2h42.6c3.42,0,6.2-2.78,6.2-6.2v-12.7c0-3.42-2.78-6.2-6.2-6.2Z"></path>
        <path class="cls-5" d="M239.62,353.7l.03-1.52,7.17.13-.03,1.52-2.67-.05-.13,7.2-1.82-.03.12-7.21-2.67-.05Z"></path>
        <path class="cls-5" d="M248.76,361.27c-.42,0-.79-.09-1.11-.24-.32-.15-.58-.38-.76-.67-.18-.29-.27-.66-.26-1.09,0-.36.08-.67.22-.91s.32-.44.56-.59c.23-.15.5-.26.79-.33.3-.07.61-.12.93-.15.38-.03.69-.07.92-.1.23-.03.4-.08.51-.15.11-.07.16-.17.16-.31v-.03c0-.27-.08-.48-.24-.63-.17-.15-.4-.23-.71-.23-.33,0-.59.06-.78.2-.2.14-.33.32-.39.53l-1.68-.17c.09-.4.26-.74.52-1.02.26-.29.58-.51.98-.66.4-.15.86-.22,1.38-.21.36,0,.71.05,1.04.15.33.09.63.23.88.41.26.18.46.42.61.7.15.28.21.62.21,1.01l-.08,4.41-1.72-.03.02-.91h-.05c-.11.2-.25.38-.43.53-.18.15-.39.27-.64.35-.25.08-.54.12-.86.11ZM249.3,360.02c.27,0,.5-.04.71-.14.21-.1.37-.25.49-.43.12-.18.18-.39.19-.62v-.69s-.12.07-.22.1c-.1.03-.21.05-.33.07-.12.02-.24.04-.37.06-.12.02-.23.03-.33.04-.21.03-.4.07-.56.14-.16.07-.29.15-.38.27-.09.11-.14.25-.14.42,0,.25.08.44.26.57.18.13.41.2.69.2Z"></path>
        <path class="cls-5" d="M255.57,359.36l.04-2.18h.26s2.14-2.44,2.14-2.44l2.08.04-2.87,3.24h-.43s-1.22,1.34-1.22,1.34ZM253.89,361.21l.15-8.73,1.82.03-.15,8.73-1.82-.03ZM257.98,361.28l-1.88-2.88,1.23-1.26,2.77,4.18-2.13-.04Z"></path>
        <path class="cls-5" d="M263.58,361.49c-.67-.01-1.25-.16-1.73-.44-.48-.28-.84-.68-1.1-1.19-.25-.51-.37-1.11-.36-1.8.01-.67.15-1.26.42-1.77s.64-.89,1.12-1.17c.48-.28,1.04-.41,1.69-.4.43,0,.83.08,1.2.23.37.14.7.35.97.63.28.28.49.63.64,1.05.15.42.22.9.21,1.46v.5s-5.53-.1-5.53-.1l.02-1.12,3.82.07c0-.26-.05-.49-.16-.7-.11-.2-.27-.36-.46-.48-.2-.12-.43-.18-.69-.19-.27,0-.52.06-.74.18-.21.12-.38.29-.5.5-.12.21-.19.44-.2.7l-.02,1.07c0,.32.05.6.16.84.12.24.29.42.51.56.22.13.48.2.79.2.2,0,.39-.02.56-.08.17-.05.31-.14.43-.25.12-.11.21-.25.28-.41l1.68.14c-.09.4-.27.75-.54,1.05-.27.29-.61.52-1.03.68-.41.16-.89.23-1.43.22ZM270.72,361.62c-.66-.01-1.23-.16-1.71-.45-.48-.29-.84-.69-1.09-1.2-.25-.51-.37-1.11-.36-1.77.01-.68.15-1.27.42-1.77.27-.5.65-.89,1.13-1.16.49-.28,1.06-.41,1.73-.4.66.01,1.23.16,1.7.46.48.29.84.69,1.1,1.2.25.51.37,1.1.36,1.78-.01.67-.15,1.26-.42,1.76-.27.5-.65.89-1.14,1.17-.49.27-1.06.4-1.72.39ZM270.75,360.21c.3,0,.55-.08.76-.24.2-.17.36-.4.47-.7.11-.3.17-.63.17-1.02,0-.38-.04-.72-.14-1.02-.1-.3-.25-.54-.44-.71-.2-.18-.45-.27-.75-.27-.3,0-.56.08-.77.25-.21.17-.37.4-.48.7-.11.3-.17.64-.17,1.02,0,.38.04.72.13,1.02.1.3.25.54.45.71.21.17.46.26.76.27Z"></path>
      </g>
    </g>
  </g>

  {{-- Project markers container (populated by JS) --}}
  <g id="projectMarkers"></g>
</svg>
<div class="map-tooltip" id="mapTooltip"></div>

{{-- Marker Tooltip --}}
</div>
				</div>

            {{-- Right Side - Content --}}
            <div>

                <h2 class="text-3xl font-bold text-[#1a3c6e] mb-8">
                    {{ $settings['structure_heading'] ?? "KROUSAR THMEY'S STRUCTURES" }}
                </h2>

                {{-- Child Welfare --}}
                @if(!empty($structureWelfareItems))
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">
                        • {{ $settings['structure_welfare_title'] ?? 'Child Welfare Program' }}
                    </h3>

                    <ul class="space-y-2 ml-8 text-gray-600">
                        @foreach($structureWelfareItems as $item)
                        <li>– {{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Education --}}
                @if(!empty($structureEducationItems))
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">
                        • {{ $settings['structure_education_title'] ?? 'Education for Deaf or Blind Children Program' }}
                    </h3>

                    <ul class="space-y-2 ml-8 text-gray-600">
                        @foreach($structureEducationItems as $item)
                        <li>– {{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

        </div>

    </div>
</section>
{{-- ===== PAGE SECTIONS (Focus / Video / etc.) ===== --}}
@if($pageSections->isNotEmpty())
@foreach($pageSections as $index => $section)
@php
$isReversed = $index % 2 !== 0;
$sectionImage = $section->images->first();
$sectionLinks = $section->links->where('active', true)->sortBy('order');
@endphp
<section class="py-20 lg:py-28 {{ $isReversed ? 'bg-[#f8f9fc]' : 'bg-white' }} overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            {{-- Image side --}}
            <div class="{{ $isReversed ? 'lg:order-2' : '' }}">
                <div class="relative group">
                    {{-- Decorative accent --}}
                    <div class="absolute -top-4 -left-4 w-24 h-24 rounded-2xl {{ $isReversed ? 'bg-[#8da83a]/10' : 'bg-[#2d6fa3]/10' }} -z-10"></div>
                    <div class="absolute -bottom-4 -right-4 w-32 h-32 rounded-2xl {{ $isReversed ? 'bg-[#2d6fa3]/10' : 'bg-[#8da83a]/10' }} -z-10"></div>

                    @if($sectionImage)
                    <img src="{{ str_starts_with($sectionImage->path, 'http') ? $sectionImage->path : asset('storage/' . $sectionImage->path) }}"
                        alt="{{ $sectionImage->alt ?? $section->localized_title }}"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                        class="w-full h-[340px] lg:h-[420px] object-cover rounded-2xl shadow-xl
                                group-hover:shadow-2xl transition-all duration-700
                                group-hover:scale-[1.02]">
                    @endif
                    {{-- Placeholder (shown when no image or image fails to load) --}}
                    <div class="w-full h-[340px] lg:h-[420px] rounded-2xl shadow-xl
                                bg-gradient-to-br from-[#2d6fa3]/5 to-[#8da83a]/5
                                border-2 border-dashed border-gray-200
                                flex flex-col items-center justify-center text-gray-300
                                group-hover:border-[#2d6fa3]/30 group-hover:shadow-2xl transition-all duration-500
                                {{ $sectionImage ? 'hidden' : '' }}">
                        <svg class="w-16 h-16 mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="text-sm font-medium">Image placeholder</p>
                        <p class="text-xs mt-1">Upload via admin panel</p>
                    </div>

                    {{-- Floating badge --}}
                    <div class="absolute -bottom-3 -right-3 bg-white rounded-xl shadow-lg px-4 py-2 border border-gray-100">
                        <span class="text-xs font-bold text-[#2d6fa3] uppercase tracking-wider">{{ $section->section_name }}</span>
                    </div>
                </div>
            </div>

            {{-- Content side --}}
            <div class="{{ $isReversed ? 'lg:order-1' : '' }}" data-reveal="up" style="--reveal-delay: 100">
                {{-- Section label --}}
                <div class="flex items-center gap-6 mb-4">
                    <span class="h-px w-8 bg-[#e8a020]"></span>
                    <span class="text-[#e8a020] font-semibold text-xs uppercase tracking-[0.2em]">
                        {{ str_replace('-', ' ', $section->section_name) }}
                    </span>
                </div>

                {{-- Title --}}
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 leading-tight mb-6">
                    {{ $section->localized_title }}
                </h2>

                {{-- Description --}}
                @if($section->localized_description)
                <div class="text-gray-600 leading-relaxed space-y-4 mb-8">
                    @foreach(explode("\n\n", $section->localized_description) as $paragraph)
                    <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
                @endif

                {{-- CTA Buttons --}}
                @if($sectionLinks->isNotEmpty())
                <div class="flex flex-wrap gap-6">
                    @foreach($sectionLinks as $link)
                    <a href="{{ $link->url }}"
                        target="{{ $link->target ?? '_self' }}"
                        class="group inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold text-sm transition-all duration-300
                              {{ $loop->first
                                  ? 'bg-[#2d6fa3] text-white hover:bg-[#1d4e7a] shadow-md hover:shadow-lg'
                                  : 'bg-white text-[#2d6fa3] border-2 border-[#2d6fa3]/20 hover:border-[#2d6fa3] hover:bg-[#2d6fa3]/5'
                              }}">
                        <span>{{ $link->localized_text }}</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    @endforeach
                </div>
                @endif
            </div>

        </div>
    </div>
</section>
@endforeach
@endif



{{-- ===== PROJECTS ===== --}}
@if($projects->count())
<section class="py-16 lg:py-24 bg-white border-t border-gray-100" data-reveal>
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">{{ $settings['projects_badge'] ?? 'Our Projects' }}</span>
            <h2 class="section-title mt-3 mx-auto">{{ $settings['projects_title'] ?? 'Cross-cutting Initiatives' }}</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($projects as $project)
            <div class="bg-[#f8f9fc] rounded-2xl p-7 border border-gray-100 card-hover-light group relative flex flex-col h-full" data-reveal="up" style="--reveal-delay: {{ $loop->index * 100 }}">
                {{-- Main Card Link --}}
                <a href="{{ route('projects.show', $project) }}" class="absolute inset-0 z-10" aria-label="View {{ $project->localized_title }}"></a>

                @if($project->image)
                <img src="{{ str_starts_with($project->image, 'http') ? $project->image : asset('storage/' . $project->image) }}" class="w-full h-40 object-cover rounded-xl mb-5 group-hover:opacity-90 transition-opacity relative z-0">
                @endif
                <h3 class="text-xl font-bold text-[#1a3c6e] mb-3 relative z-0">{{ $project->localized_title }}</h3>
                <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-5 flex-1 relative z-0">{{ $project->localized_description }}</p>
                
                <div class="mt-auto flex items-center justify-between border-t border-gray-200/50 pt-5">
                    <span class="inline-flex items-center gap-2 text-[#e8a020] font-bold text-sm group-hover:text-[#1a3c6e] transition-colors group-hover:gap-3 duration-300 pointer-events-none">
                        {{ $settings['projects_read_more'] ?? 'Read More Detail' }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </span>
                    
                    {{-- Donate Button (Z-20 to sit above stretched link) --}}
                    <a href="{{ route('donate') }}" class="group/btn relative z-20 px-5 py-2.5 text-[#8da83a] bg-transparent hover:text-white hover:bg-[#8da83a] text-[11px] font-black uppercase tracking-widest rounded-full hover:shadow-[0_8px_20px_rgba(141,168,58,0.6)] hover:-translate-y-1 transition-all duration-300 flex items-center gap-2" title="Donate to {{ $project->localized_title }}">
                        <svg class="w-4 h-4 group-hover/btn:scale-125 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                        <span>Donate Now</span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== GALLERY ===== --}}
@if($galleries->count())
<section class="py-16 lg:py-24 bg-[#1a3c6e]" data-reveal>
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">In Pictures</span>
            <h2 class="text-3xl font-bold text-white mt-3">A Glimpse Into Our Work</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($galleries as $photo)
            <div class="group relative overflow-hidden rounded-xl aspect-square bg-white/5 gallery-overlay" data-reveal="scale" style="--reveal-delay: {{ $loop->index * 80 }}">
                @if($photo->image)
                <img src="{{ str_starts_with($photo->image, 'http') ? $photo->image : asset('storage/' . $photo->image) }}" alt="{{ $photo->localized_title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-5">
                    <p class="text-white font-medium text-sm">{{ $photo->localized_title }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== NEWS ===== --}}
<section class="py-20 lg:py-28 bg-white" data-reveal>
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-14 gap-6">
            <div>
                <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">{{ $settings['news_title'] ?? 'Latest Updates' }}</span>
                <h2 class="section-title mt-3">{{ $settings['news_title'] ?? 'News & Stories' }}</h2>
                <p class="text-gray-500 mt-3 max-w-2xl">{{ $settings['news_subtitle'] ?? 'News and stories about our impact, events, and community progress.' }}</p>
            </div>
            <a href="{{ route('news') }}" class="text-[#1a3c6e] font-semibold text-sm flex items-center gap-2 hover:text-[#e8a020] transition-colors flex-shrink-0 link-arrow">
                {{ $settings['news_view_all'] ?? 'All News' }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($latestNews as $article)
            <article class="card group flex flex-col card-hover" data-reveal="up" style="--reveal-delay: {{ $loop->index * 100 }}">
                <div class="relative overflow-hidden h-52">
                    <img src="{{ $article->image_url }}" alt="{{ $article->localized_title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-[#1a3c6e] text-xs font-semibold px-3 py-1 rounded-full capitalize">{{ str_replace('-', ' ', $article->category) }}</span>
                </div>
                <div class="p-6 flex flex-col flex-1">
                    <time class="text-gray-400 text-xs mb-3 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $article->published_at?->format('F Y') ?? $article->created_at->format('F Y') }}
                    </time>
                    <h3 class="font-bold text-gray-800 text-lg mb-3 leading-snug group-hover:text-[#1a3c6e] transition-colors">{{ $article->localized_title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed flex-1">{{ $article->localized_excerpt }}</p>
                    <a href="{{ route('news') }}" class="mt-5 text-[#1a3c6e] font-semibold text-sm flex items-center gap-1.5 hover:text-[#e8a020] transition-colors link-arrow">
                        Read More
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-3 py-12 text-center text-gray-400">
                <p class="text-sm">No articles published yet.</p>
                <a href="{{ route('news') }}" class="text-[#1a3c6e] text-sm underline mt-2 inline-block">Visit the news page</a>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ===== TESTIMONIALS ===== --}}
@if($testimonials->count())
<section class="py-20 lg:py-28 bg-[#f8f9fc]" data-reveal>
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Voices</span>
            <h2 class="section-title mt-3 mx-auto">What People Say</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($testimonials as $testimony)
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 relative testimonial-card" data-reveal="up" style="--reveal-delay: {{ $loop->index * 120 }}">
                <svg class="w-10 h-10 text-[#e8a020]/20 absolute top-6 right-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                </svg>
                <div class="flex items-center gap-4 mb-6 relative z-10">
                    @if($testimony->image)
                    <img src="{{ str_starts_with($testimony->image, 'http') ? $testimony->image : asset('storage/' . $testimony->image) }}" alt="{{ $testimony->name }}" class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-md">
                    @else
                    <div class="w-14 h-14 rounded-full bg-[#1a3c6e]/10 flex items-center justify-center text-[#1a3c6e] font-bold text-xl">{{ substr($testimony->name, 0, 1) }}</div>
                    @endif
                    <div>
                        <h4 class="font-bold text-gray-800">{{ $testimony->name }}</h4>
                        <p class="text-xs text-gray-500">{{ $testimony->localized_role }}</p>
                    </div>
                </div>
                <p class="text-gray-600 leading-relaxed text-sm italic line-clamp-4 relative z-10">"{{ $testimony->localized_content }}"</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== CALL TO ACTION ===== --}}
@php
    $ctaImage = $settings['cta_background_image'] ?? null;
    $ctaImageUrl = $ctaImage ? (str_starts_with($ctaImage, 'http') ? $ctaImage : asset('storage/' . $ctaImage)) : 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1400&q=80';
@endphp
<section class="relative py-24 overflow-hidden" data-reveal="scale">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $ctaImageUrl }}');"></div>
    <div class="absolute inset-0 bg-[#1a3c6e]/85"></div>
    <div class="relative z-10 max-w-3xl mx-auto px-6 text-center">
        <span class="inline-block bg-[#e8a020] text-white text-xs font-semibold px-4 py-1.5 rounded-full mb-6 uppercase tracking-wider">{{ $settings['cta_label'] ?? 'Support Our Work' }}</span>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6">
            {{ $settings['cta_title'] ?? 'Help a Child Build Their Future' }}
        </h2>
        <p class="text-white/80 text-lg leading-relaxed mb-10">
            {{ $settings['cta_subtitle'] ?? 'We guarantee that 100% of your donation is used to support children across Cambodia. Every contribution, big or small, changes a life.' }}
        </p>
        <div class="flex flex-col sm:flex-row gap-6 justify-center">
            <a href="{{ $settings['cta_primary_url'] ?? route('donate') }}" class="btn-primary text-base btn-micro">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                {{ $settings['cta_primary_text'] ?? 'Donate Now' }}
            </a>
            @if(!empty($settings['cta_secondary_text']))
            <a href="{{ $settings['cta_secondary_url'] ?? route('get-involved') }}" class="btn-outline text-base btn-micro">{{ $settings['cta_secondary_text'] }}</a>
            @endif
            <a href="{{ route('resources') }}" class="btn-outline text-base btn-micro">{{ $settings['cta_annual_report_text'] ?? 'Annual Report' }}</a>
        </div>
    </div>
</section>

{{-- ===== SPONSORS ===== --}}
@if(isset($sponsors) && $sponsors->isNotEmpty())
<section class="py-16 bg-gradient-to-b from-white to-[#f8f9fc] relative overflow-hidden" data-reveal>
    <div class="max-w-7xl mx-auto px-6 relative z-10">

        {{-- Section Header --}}
        <div class="text-center mb-12">
            <h2 class="section-title mt-2 text-[#1a3c6e]">{{ __('Among our loyal supporters') }}</h2>
            <div class="w-16 h-1 bg-[#e8a020] mx-auto mt-4 rounded-full opacity-80"></div>
        </div>

        {{-- Sponsors Marquee --}}
        <div class="relative max-w-7xl mx-auto"
            x-data="{ paused: false }"
            @mouseenter="paused = true"
            @mouseleave="paused = false">

            {{-- Gradient fade edges --}}
            <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-[#fcfcfd] to-transparent z-10 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-[#f8f9fc] to-transparent z-10 pointer-events-none"></div>

            <div class="overflow-hidden py-6">
                <div class="flex marquee-track items-center"
                    :style="{ animationPlayState: paused ? 'paused' : 'running' }">

                    {{-- Set 1 --}}
                    @foreach($sponsors as $sponsor)
                    <div class="group w-72 flex-shrink-0 mx-4">
                        <a href="{{ $sponsor->url ?? '#' }}" {{ $sponsor->url ? 'target="_blank" rel="noopener noreferrer"' : '' }}
                            class="flex flex-col items-center justify-center h-48 px-6 py-5 bg-white rounded-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] border border-gray-100 transition-all duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:-translate-y-1 hover:border-[#1a3c6e]/20">

                            <div class="flex-grow flex items-center justify-center w-full mb-4">
                                @if($sponsor->logo)
                                <img src="{{ str_starts_with($sponsor->logo, 'http') ? $sponsor->logo : asset('storage/' . $sponsor->logo) }}"
                                    alt="{{ $sponsor->localized_name }}"
                                    class="max-h-20 max-w-full object-contain transition-transform duration-500 transform group-hover:scale-110 group-hover:brightness-110">
                                @else
                                <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center text-[#1a3c6e] font-bold text-2xl transition-transform duration-500 group-hover:scale-110">{{ substr($sponsor->localized_name, 0, 1) }}</div>
                                @endif
                            </div>

                            <div class="h-12 flex items-center justify-center w-full border-t border-gray-50 pt-3">
                                <h4 class="text-gray-600 font-medium text-sm text-center leading-snug transition-colors duration-300 group-hover:text-[#1a3c6e] line-clamp-2">{{ $sponsor->localized_name }}</h4>
                            </div>
                        </a>
                    </div>
                    @endforeach

                    {{-- Set 2 for seamless loop --}}
                    @foreach($sponsors as $sponsor)
                    <div class="group w-72 flex-shrink-0 mx-4">
                        <a href="{{ $sponsor->url ?? '#' }}" {{ $sponsor->url ? 'target="_blank" rel="noopener noreferrer"' : '' }}
                            class="flex flex-col items-center justify-center h-48 px-6 py-5 bg-white rounded-2xl shadow-[0_4px_20px_-4px_rgba(0,0,0,0.05)] border border-gray-100 transition-all duration-300 hover:shadow-[0_8px_30px_rgb(0,0,0,0.08)] hover:-translate-y-1 hover:border-[#1a3c6e]/20">

                            <div class="flex-grow flex items-center justify-center w-full mb-4">
                                @if($sponsor->logo)
                                <img src="{{ str_starts_with($sponsor->logo, 'http') ? $sponsor->logo : asset('storage/' . $sponsor->logo) }}"
                                    alt="{{ $sponsor->localized_name }}"
                                    class="max-h-20 max-w-full object-contain transition-transform duration-500 transform group-hover:scale-110 group-hover:brightness-110">
                                @else
                                <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center text-[#1a3c6e] font-bold text-2xl transition-transform duration-500 group-hover:scale-110">{{ substr($sponsor->localized_name, 0, 1) }}</div>
                                @endif
                            </div>

                            <div class="h-12 flex items-center justify-center w-full border-t border-gray-50 pt-3">
                                <h4 class="text-gray-600 font-medium text-sm text-center leading-snug transition-colors duration-300 group-hover:text-[#1a3c6e] line-clamp-2">{{ $sponsor->localized_name }}</h4>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- ===== PARTNERS ===== --}}
@php
$homePartners = \App\Models\Partner::active()->whereNotNull('logo')->where('logo', '!=', '')->get();
@endphp

@if($homePartners->isNotEmpty())
<section class="py-16 bg-gradient-to-b from-white to-[#ffffff] relative overflow-hidden" data-reveal>
    <div class="max-w-7xl mx-auto px-6 relative z-10">

        {{-- Section Header --}}
        <div class="text-center mb-12">
            <h2 class="section-title mt-2 text-[#1a3c6e]">{{ __('Supported by Our Partners Worldwide') }}</h2>
            <div class="w-16 h-1 bg-[#e8a020] mx-auto mt-4 rounded-full opacity-80"></div>
        </div>

        {{-- Partners Marquee (reverse direction) --}}
        <div class="relative max-w-7xl mx-auto"
            x-data="{ paused: false }"
            @mouseenter="paused = true"
            @mouseleave="paused = false">

            {{-- Gradient fade edges --}}
            <div class="absolute left-0 top-0 bottom-0 w-32 bg-gradient-to-r from-[#fcfcfd] to-transparent z-10 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 w-32 bg-gradient-to-l from-[#f8f9fc] to-transparent z-10 pointer-events-none"></div>

            <div class="overflow-hidden py-6">
                <div class="flex marquee-track-reverse items-center"
                    :style="{ animationPlayState: paused ? 'paused' : 'running' }">

                    {{-- Set 2 (first in DOM so -50% shows Set 1 / originals) --}}
                    @foreach($homePartners as $partner)
                    <div class="group w-72 flex-shrink-0 mx-4">
                        <a href="{{ $partner->url ?? '#' }}" {{ $partner->url ? 'target="_blank" rel="noopener noreferrer"' : '' }}
                            class="flex flex-col items-center justify-center h-32 px-6 py-5 rounded-2xl transition-all duration-300  hover:-translate-y-1">
                            <div class="flex-grow flex items-center justify-center w-full mb-4">
                                @if($partner->logo)
                                <img src="{{ str_starts_with($partner->logo, 'http') ? $partner->logo : asset('storage/' . $partner->logo) }}"
                                    alt="{{ $partner->name }}"
                                    class="max-h-20 max-w-full object-contain transition-transform duration-500 transform group-hover:scale-110 group-hover:brightness-110">
                                @else
                                <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center text-[#1a3c6e] font-bold text-2xl transition-transform duration-500 group-hover:scale-110">{{ substr($partner->name, 0, 1) }}</div>
                                @endif
                            </div>

                            <div class="h-12 flex items-center justify-center w-full pt-3">
                            </div>
                        </a>
                    </div>
                    @endforeach

                    {{-- Set 1 (original logos — shown first when page loads at -50%) --}}
                    @foreach($homePartners as $partner)
                    <div class="group w-72 flex-shrink-0 mx-4">
                        <a href="{{ $partner->url ?? '#' }}" {{ $partner->url ? 'target="_blank" rel="noopener noreferrer"' : '' }}
                            class="flex flex-col items-center justify-center h-32 px-6 py-5 rounded-2xl transition-all duration-300  hover:-translate-y-1">
                           <div class="flex-grow flex items-center justify-center w-full mb-4">
                                @if($partner->logo)
                                <img src="{{ str_starts_with($partner->logo, 'http') ? $partner->logo : asset('storage/' . $partner->logo) }}"
                                    alt="{{ $partner->name }}"
                                    class="max-h-20 max-w-full object-contain transition-transform duration-500 transform group-hover:scale-110 group-hover:brightness-110">
                                @else
                                <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center text-[#1a3c6e] font-bold text-2xl transition-transform duration-500 group-hover:scale-110">{{ substr($partner->name, 0, 1) }}</div>
                                @endif
                            </div>

                            <div class="h-12 flex items-center justify-center w-full pt-3">
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Bottom CTA --}}
        <div class="text-center mt-10">
            <a href="{{ route('presentation') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#2d6fa3] hover:text-[#1d4e7a] transition-colors group">
                {{ $settings['partners_view_all'] ?? 'View All Partners' }}
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>
    </div>
</section>
@endif



@endsection
