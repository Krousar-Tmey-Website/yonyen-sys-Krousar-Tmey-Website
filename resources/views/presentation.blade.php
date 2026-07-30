
@extends('layouts.app')

@section('title', 'Presentation — Krousar Thmey')
@section('description', 'Krousar Thmey is the first Cambodian organization helping disadvantaged children, born in 1991 in the Site II refugee camp in Thailand.')

@section('content')

@php
    // Picks the French value for a HomeSetting key when the visitor's locale is
    // French and a translation was actually provided, otherwise falls back to the
    // English value (or the given default).
    $t = function (string $key, string $default = '') use ($settings) {
        if (app()->getLocale() === 'fr' && !empty($settings[$key.'_fr'] ?? null)) {
            return $settings[$key.'_fr'];
        }
        return $settings[$key] ?? $default;
    };
@endphp

{{-- ========================================================
     PRESENTATION BANNER (hero)
     ======================================================== --}}
@php
$heroImage = $settings['presentation_banner_image'] ?? null;
$heroImageUrl = $heroImage ? (str_starts_with($heroImage, 'http') ? $heroImage : asset('storage/' . $heroImage)) : asset('images/cultural.jpg');
$heroTitle = $settings['presentation_banner_title'] ?? 'Krousar Thmey, the first Cambodian organization helping disadvantaged children';
$heroSubtitle = $settings['presentation_banner_subtitle'] ?? 'Born in 1991 in the Site II refugee camp in Thailand, Krousar Thmey has been supporting children for over 25 years.';
if (app()->getLocale() === 'fr' && !empty($settings['presentation_banner_subtitle_fr'] ?? null)) {
    $heroSubtitle = $settings['presentation_banner_subtitle_fr'];
}
$heroBadge = $settings['presentation_banner_badge'] ?? 'Since 1991';
$heroOverlayColor = $settings['presentation_banner_overlay_color'] ?? '#1a3c6e';
$btn1Text = $settings['presentation_banner_btn1_text'] ?? 'Learn More';
$btn1Url  = $settings['presentation_banner_btn1_url'] ?? '/our-programs';
$btn2Text = $settings['presentation_banner_btn2_text'] ?? 'Donate Now';
$btn2Url  = $settings['presentation_banner_btn2_url'] ?? '/donate';
$btn3Text = $settings['presentation_banner_btn3_text'] ?? '';
$btn3Url  = $settings['presentation_banner_btn3_url'] ?? '';
@endphp

<section class="relative py-24 md:py-32 overflow-hidden flex flex-col justify-center items-center text-center">
    <div class="absolute inset-0 bg-cover bg-center hero-media-drift" style="background-image: url('{{ $heroImageUrl }}');"></div>
    <div class="absolute inset-0" style="background-color: {{ $heroOverlayColor }}; opacity: 0.55;"></div>

    {{-- Animated decorative orbs --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full hero-float-slow" style="background: radial-gradient(circle, rgba(255,255,255,0.10) 0%, transparent 70%);"></div>
        <div class="absolute -bottom-32 -left-32 w-[30rem] h-[30rem] rounded-full hero-float-delayed" style="background: radial-gradient(circle, rgba(255,255,255,0.07) 0%, transparent 70%);"></div>
        <div class="absolute top-1/3 left-1/4 w-48 h-48 rounded-full hero-pulse" style="background: radial-gradient(circle, rgba(141,168,58,0.20) 0%, transparent 70%);"></div>
        <div class="absolute bottom-1/4 right-1/4 w-40 h-40 rounded-full hero-float-slow" style="animation-delay: 4s; background: radial-gradient(circle, rgba(238,169,29,0.15) 0%, transparent 70%);"></div>
    </div>
    
    {{-- Decorative gradient overlay --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-black/10"></div>

    <div class="relative z-10 max-w-3xl mx-auto px-6 text-center">
        {{-- Badge --}}
        <span class="hero-reveal hero-reveal-delay-1 inline-block bg-white/95 backdrop-blur-sm text-[#eea91d] text-xs font-semibold px-5 py-2 rounded-full mb-6 uppercase tracking-wider shadow-lg">{{ $heroBadge }}</span>

        {{-- Title --}}
        <h1 class="hero-reveal hero-reveal-delay-2 text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6 drop-shadow-lg">
            {{ $heroTitle }}
        </h1>

        {{-- Subtitle --}}
        <div class="hero-reveal hero-reveal-delay-3 rich-text-content text-white/90 text-lg leading-relaxed mb-10 drop-shadow-md max-w-2xl mx-auto">
            {!! $heroSubtitle !!}
        </div>

        {{-- Buttons --}}
        @if($btn1Text || $btn2Text || $btn3Text)
        <div class="hero-reveal hero-reveal-delay-4 flex flex-col sm:flex-row flex-wrap items-center justify-center gap-4">
                @if($btn1Text)
                <a href="{{ $btn1Url }}" class="btn-primary text-sm sm:text-base btn-micro inline-flex items-center gap-2 px-6 py-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                    {{ $btn1Text }}
                </a>
                @endif
                @if($btn2Text)
                <a href="{{ $btn2Url }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-[#8da83a] text-white hover:bg-[#a3c04a] text-sm sm:text-base font-bold transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    {{ $btn2Text }}
                </a>
                @endif
                @if($btn3Text)
                <a href="{{ $btn3Url }}" class="btn-outline text-sm sm:text-base btn-micro inline-flex items-center gap-2 px-6 py-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    {{ $btn3Text }}
                </a>
                @endif
            </div>
        </div>
        @endif
    </div>
</section>

{{-- Banner Animation Styles --}}
<style>
    /* ── Slow background zoom ─────────────────────────────── */
    @keyframes bannerZoom {
        0%   { transform: scale(1); }
        100% { transform: scale(1.08); }
    }
    .animate-banner-zoom {
        animation: bannerZoom 12s ease-out forwards;
    }

    /* ── Staggered content reveal ─────────────────────────── */
    @keyframes fadeSlideUp {
        0%   { opacity: 0; transform: translateY(30px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .animate-badge-reveal {
        animation: fadeSlideUp 0.7s cubic-bezier(0.16, 1, 0.3, 1) 0.3s forwards;
    }

    .animate-title-reveal {
        animation: fadeSlideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.6s forwards;
    }

    .animate-subtitle-reveal {
        animation: fadeSlideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) 0.9s forwards;
    }

    .animate-buttons-reveal {
        animation: fadeSlideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) 1.2s forwards;
    }

    @media (prefers-reduced-motion: reduce) {
        .animate-banner-zoom,
        .animate-badge-reveal,
        .animate-title-reveal,
        .animate-subtitle-reveal,
        .animate-buttons-reveal {
            animation: none !important;
            opacity: 1 !important;
            transform: none !important;
        }
    }
</style>

{{-- ========================================================
     WHO WE ARE / INTRO SECTION
     ======================================================== --}}
<section class="py-14 bg-[#f8f5f0] scroll-mt-20">
    <div class="max-w-5xl mx-auto px-6">
        <div class="text-center max-w-2xl mx-auto mb-8" data-reveal>
            <span class="inline-flex items-center gap-2 text-[11px] font-semibold text-[#8da83a] uppercase tracking-[0.2em] mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-[#8da83a]"></span>
                Since 1991
            </span>
            <h1 class="text-lg md:text-xl font-bold text-[#1d4e7a] leading-snug uppercase tracking-wide">
                {{ $settings['intro_heading'] ?? 'Krousar Thmey, the first Cambodian organization helping disadvantaged children, born in 1991 in the Site II refugee camp in Thailand.' }}
            </h1>
            <div class="w-10 h-0.5 bg-[#d32f2f] rounded-full mx-auto mt-3"></div>
        </div>

        {{-- Our Mission / Our Vision photo cards --}}
        <div class="grid md:grid-cols-2 gap-6">
            {{-- Our Mission --}}
            <div class="group relative rounded-2xl overflow-hidden shadow-lg ring-1 ring-black/5 h-64 md:h-72" data-reveal="left">
                @php
                $missionImage = $settings['mission_image'] ?? null;
                $missionImageUrl = $missionImage ? (str_starts_with($missionImage, 'http') ? $missionImage : asset('storage/' . $missionImage)) : asset('images/children.jpg');
                @endphp
                <img src="{{ $missionImageUrl }}" alt="Our Mission"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0f2448]/95 via-[#0f2448]/25 to-transparent"></div>
                <div class="absolute top-0 left-0 right-0 h-1 bg-[#2d6fa3]"></div>

                <div class="absolute inset-0 p-6 flex flex-col justify-end">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="w-9 h-9 rounded-full bg-white/10 border border-white/20 backdrop-blur-sm flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                        </span>
                        <h3 class="text-white font-bold text-sm uppercase tracking-[0.15em]">{{ $t('mission_title', 'Our Mission') }}</h3>
                    </div>
                    <div class="rich-text-content text-white/80 text-xs leading-relaxed max-h-0 opacity-0 group-hover:max-h-28 group-hover:opacity-100 transition-all duration-500 ease-out overflow-hidden">
                        {!! $t('mission_text', 'Enable the integration of underprivileged children into Cambodian society through education and support adapted to their needs, with respect to their traditions and beliefs.') !!}
                    </div>
                </div>
            </div>

            {{-- Our Vision --}}
            <div class="group relative rounded-2xl overflow-hidden shadow-lg ring-1 ring-black/5 h-64 md:h-72" data-reveal="right">
                @php
                $visionImage = $settings['vision_image'] ?? null;
                $visionImageUrl = $visionImage ? (str_starts_with($visionImage, 'http') ? $visionImage : asset('storage/' . $visionImage)) : asset('images/cultural.jpg');
                @endphp
                <img src="{{ $visionImageUrl }}" alt="Our Vision"
                     class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-[#0f2448]/95 via-[#0f2448]/25 to-transparent"></div>
                <div class="absolute top-0 left-0 right-0 h-1 bg-[#1d4e7a]"></div>

                <div class="absolute inset-0 p-6 flex flex-col justify-end">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="w-9 h-9 rounded-full bg-white/10 border border-white/20 backdrop-blur-sm flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        </span>
                        <h3 class="text-white font-bold text-sm uppercase tracking-[0.15em]">{{ $t('vision_title', 'Our Vision') }}</h3>
                    </div>
                    <div class="rich-text-content text-white/80 text-xs leading-relaxed max-h-0 opacity-0 group-hover:max-h-28 group-hover:opacity-100 transition-all duration-500 ease-out overflow-hidden">
                        {!! $t('vision_text', 'A world in which all children are empowered to grow into independent and responsible adults.') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================
     OUR IMPACT / KEY FIGURES SECTION — MODERN PREMIUM DESIGN
     ======================================================== --}}
@php
    $allStats = $impactStatistics->values();
@endphp

<section class="py-24 bg-[#fafafa] scroll-mt-20 overflow-hidden relative" id="key-figures">
    {{-- Decorative background shapes --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        {{-- Soft gradient circles --}}
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-gradient-to-br from-blue-200/20 to-blue-100/10 rounded-full blur-[100px]"></div>
        <div class="absolute top-1/2 -left-32 w-80 h-80 bg-gradient-to-tr from-green-200/15 to-green-100/5 rounded-full blur-[90px]"></div>
        <div class="absolute -bottom-24 right-1/4 w-72 h-72 bg-gradient-to-tl from-orange-200/20 to-orange-100/10 rounded-full blur-[85px]"></div>
        
        {{-- Subtle dotted pattern overlay --}}
        <div class="absolute inset-0 opacity-30" style="background-image: radial-gradient(circle, rgba(0,0,0,0.03) 1px, transparent 1px); background-size: 40px 40px;"></div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">
        {{-- Section Header --}}
        <div class="text-center max-w-3xl mx-auto mb-20" data-reveal>
            {{-- Badge --}}
            <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 rounded-full px-4 py-2 text-xs font-semibold text-blue-600 uppercase tracking-[0.15em] mb-6 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                Impact Statistics
            </div>

            {{-- Heading --}}
            <h2 class="text-4xl md:text-5xl font-extrabold text-[#1d4e7a] tracking-tight mb-5">
                Key <span class="font-serif italic text-[#8da83a]">Figures</span>
            </h2>

            {{-- Description --}}
            <p class="text-lg text-gray-600 leading-relaxed max-w-2xl mx-auto">
                Real numbers behind our commitment to Cambodia's children. Every statistic represents lives changed, futures transformed, and hope restored.
            </p>
        </div>

        @if($allStats->isEmpty())
            <p class="text-gray-400 text-center py-16">No impact statistics available yet.</p>
        @else

        {{-- ===== STATISTICS GRID — Premium 3-2 Layout ===== --}}
        @php
            $accentColors = [
                ['name' => 'blue', 'bg' => '#2d6fa3', 'light' => '#e3f2fd', 'lighter' => '#bbdefb'],
                ['name' => 'green', 'bg' => '#8da83a', 'light' => '#f1f8e9', 'lighter' => '#dcedc8'],
                ['name' => 'orange', 'bg' => '#e8a020', 'light' => '#fff3e0', 'lighter' => '#ffe0b2'],
                ['name' => 'red', 'bg' => '#d32f2f', 'light' => '#ffebee', 'lighter' => '#ffcdd2'],
                ['name' => 'purple', 'bg' => '#7c4dff', 'light' => '#f3e5f5', 'lighter' => '#e1bee7'],
            ];

            $mixWithWhite = function (?string $hex, float $whiteRatio = 0.88): string {
                if (!is_string($hex) || !preg_match('/^#([0-9a-fA-F]{6})$/', $hex, $matches)) {
                    return '#f3f4f6';
                }

                $rgb = sscanf($matches[1], '%02x%02x%02x');
                $mixed = array_map(fn ($channel) => (int) round($channel * (1 - $whiteRatio) + 255 * $whiteRatio), $rgb);

                return sprintf('#%02x%02x%02x', $mixed[0], $mixed[1], $mixed[2]);
            };

            $statIcons = [
                '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
                '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>',
                '<path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>',
                '<path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342"/>',
                '<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"/>',
            ];
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6 md:gap-5 stats-grid">
            @foreach($allStats as $index => $stat)
            @php
                $colorScheme = $accentColors[$index % count($accentColors)];
                $accentColor = $stat->accent_color ?: $colorScheme['bg'];
                $colorScheme['bg'] = $accentColor;
                $colorScheme['light'] = $stat->accent_color ? $mixWithWhite($accentColor) : $colorScheme['light'];
                $iconBackgroundColor = $stat->icon_background_color ?: $colorScheme['light'];
                $valueColor = $stat->value_color ?: $colorScheme['bg'];
                $labelColor = $stat->label_color ?: '#111827';
                $icon = $statIcons[$index % count($statIcons)];
            @endphp
            <div class="group relative" data-reveal="up" style="--reveal-delay: {{ $index * 100 }}">
                {{-- Card Container with soft shadow --}}
                <div class="relative h-full bg-white rounded-[24px] border border-gray-100 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-2 cursor-default">
                    {{-- Card content with generous padding --}}
                    <div class="p-8 h-full flex flex-col items-center text-center">
                        
                        {{-- Icon in soft circular background --}}
                        <div class="flex-shrink-0 mb-6">
                            <div class="relative inline-flex">
                                {{-- Icon background circle --}}
                                <div class="w-16 h-16 rounded-[18px] flex items-center justify-center transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg"
                                     style="background-color: {{ $iconBackgroundColor }}; box-shadow: inset 0 0 0 1px rgba(0,0,0,0.03);">
                                    <svg class="w-8 h-8 transition-all duration-300" fill="none" stroke="{{ $colorScheme['bg'] }}" stroke-width="1.5" viewBox="0 0 24 24">
                                        {!! $icon !!}
                                    </svg>
                                </div>
                                
                                {{-- Subtle glow on hover --}}
                                <div class="absolute inset-0 rounded-[18px] opacity-0 group-hover:opacity-30 transition-opacity duration-300" style="background: radial-gradient(circle, {{ $colorScheme['bg'] }} 0%, transparent 70%); filter: blur(12px);"></div>
                            </div>
                        </div>

                        {{-- Large bold number --}}
                        <div class="mb-3">
                            <div class="text-4xl md:text-3xl lg:text-4xl font-black transition-all duration-300 counter leading-none"
                                 data-target="{{ preg_replace('/[^0-9.]/', '', $stat->value) }}"
                                 data-suffix="{{ preg_match('/[KMBkmb]/', $stat->value) ? substr(trim($stat->value), -1) : '' }}"
                                 style="color: {{ $valueColor }}">
                                {{ $stat->value }}
                            </div>
                        </div>

                        {{-- Colored accent line below number --}}
                        <div class="w-10 h-1 rounded-full mx-auto mb-4 transition-all duration-300 group-hover:w-14" style="background-color: {{ $colorScheme['bg'] }}"></div>

                        {{-- Supporting text --}}
                        <div class="flex-1">
                            <p class="text-sm font-bold text-gray-900 leading-snug mb-2" style="color: {{ $labelColor }}">{{ $stat->localized_label }}</p>
                            @if($stat->localized_description)
                            <p class="text-xs text-gray-500 leading-relaxed">{{ strip_tags($stat->localized_description) }}</p>
                            @endif
                        </div>
                    </div>

                    {{-- Hover gradient overlay (very subtle) --}}
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-5 transition-opacity duration-300 pointer-events-none"
                         style="background: linear-gradient(135deg, {{ $colorScheme['bg'] }} 0%, transparent 100%);"></div>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Responsive grid adjustments --}}
        <style>
            @media (max-width: 1279px) {
                /* 5 items: 3-2 layout on desktop */
                #key-figures .stats-grid {
                    grid-template-columns: repeat(3, minmax(0, 1fr));
                }
                #key-figures .stats-grid > :nth-child(4),
                #key-figures .stats-grid > :nth-child(5) {
                    grid-column: span 1;
                }
                #key-figures .stats-grid > :nth-child(4) {
                    grid-column: 1;
                }
                #key-figures .stats-grid > :nth-child(5) {
                    grid-column: 2;
                }
            }

            @media (max-width: 767px) {
                /* Single column on mobile */
                #key-figures .stats-grid {
                    grid-template-columns: 1fr;
                }
            }

            @media (min-width: 768px) and (max-width: 1023px) {
                /* 2 columns on tablet */
                #key-figures .stats-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }
        </style>

        {{-- ===== ORGANISATION AT A GLANCE — Dashboard Row ===== --}}
        <div class="relative bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden mt-16" data-reveal>
            <div class="px-10 py-12 border-b border-gray-50">
                <div class="flex flex-col items-center text-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#2d6fa3] to-[#1d4e7a] flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-black text-[#1d4e7a]">Organization At A Glance</h3>
                        <p class="text-gray-400 text-xs mt-1">Key operational metrics that define our organization</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-gray-50">
                {{-- Human Resources --}}
                <div class="py-10 px-8 text-center group hover:bg-[#2d6fa3]/[0.02] transition-colors">
                    <div class="w-10 h-10 rounded-xl bg-[#2d6fa3]/10 flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-5 h-5 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 100-8 4 4 0 000 8zm6 1.13a4 4 0 00-3-3.87m-9 3.87a4 4 0 013-3.87"/></svg>
                    </div>
                    <div class="text-3xl font-black text-[#2d6fa3] mb-1.5">
                        <span class="counter" data-target="{{ preg_replace('/[^0-9]/', '', $settings['stat_employees'] ?? '68') }}" data-suffix="+">{{ $settings['stat_employees'] ?? '68' }}</span>
                        <span class="text-sm text-[#8da83a] font-semibold"> +{{ $settings['stat_expats'] ?? '2' }}</span>
                    </div>
                    <p class="text-gray-500 text-[11px] font-semibold uppercase tracking-wider">Cambodian &amp; Expat Staff</p>
                </div>

                {{-- Budget --}}
                <div class="py-8 px-6 text-center group hover:bg-[#8da83a]/[0.02] transition-colors">
                    <div class="w-10 h-10 rounded-xl bg-[#8da83a]/10 flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-5 h-5 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V6m0 10v2m0-2c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div class="text-3xl font-black text-[#8da83a] mb-1.5">
                        @php
                            $budgetTarget = (int) preg_replace('/[^0-9]/', '', $settings['stat_budget'] ?? '950');
                            if ($budgetTarget >= 1000) {
                                $budgetTarget = $budgetTarget / 1000;
                            }
                            $budgetDisplay = $settings['stat_budget'] ?? '950';
                            if (is_numeric($budgetDisplay) && (int)$budgetDisplay >= 1000) {
                                $budgetDisplay = ((int)$budgetDisplay / 1000) . 'K';
                            } elseif (!str_contains(strtoupper($budgetDisplay), 'K')) {
                                $budgetDisplay = $budgetDisplay . 'K';
                            }
                        @endphp
                        <span class="counter" data-target="{{ $budgetTarget }}" data-suffix="K">{{ $budgetDisplay }}</span>
                    </div>
                    <p class="text-gray-500 text-[11px] font-semibold uppercase tracking-wider">Annual Budget (USD)</p>
                </div>

                {{-- Admin Costs --}}
                <div class="py-8 px-6 text-center group hover:bg-[#e8a020]/[0.02] transition-colors">
                    <div class="w-10 h-10 rounded-xl bg-[#e8a020]/10 flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-5 h-5 text-[#e8a020]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.75" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <div class="text-3xl font-black text-[#e8a020] mb-1.5">
                        <span class="counter" data-target="{{ preg_replace('/[^0-9]/', '', $settings['stat_admin_costs'] ?? '4') }}" data-suffix="%">{{ $settings['stat_admin_costs'] ?? '4' }}%</span>
                    </div>
                    <p class="text-gray-500 text-[11px] font-semibold uppercase tracking-wider">Administrative Costs</p>
                </div>
            </div>
        </div>

        @endif
    </div>
</section>

{{-- Impact Animation Script --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // ── Animated Number Counter ───────────────────────────────
        const counters = document.querySelectorAll(".counter");

        const countObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = +counter.dataset.target;
                    const format = counter.dataset.format || 'plain';
                    const suffix = counter.dataset.suffix || '';
                    const prefix = counter.dataset.prefix || '';

                    let start = 0;
                    const duration = 2000;
                    const startTime = performance.now();

                    const updateCount = (currentTime) => {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        const easeProgress = 1 - Math.pow(1 - progress, 3);

                        let current = Math.floor(start + (target - start) * easeProgress);
                        const formatted = current.toLocaleString();

                        if (format === 'k') {
                            counter.innerText = formatted + 'K USD';
                        } else if (format === 'percent') {
                            counter.innerText = formatted + '%';
                        } else if (format === 'less-than-percent') {
                            counter.innerHTML = '<span class="text-[#e8a020]"><</span> ' + formatted + '%';
                        } else if (suffix) {
                            counter.innerText = prefix + formatted + suffix;
                        } else {
                            counter.innerText = prefix + formatted;
                        }

                        if (progress < 1) {
                            requestAnimationFrame(updateCount);
                        }
                    };

                    requestAnimationFrame(updateCount);
                    countObserver.unobserve(counter);
                }
            });
        }, { threshold: 0.3 });

        counters.forEach(counter => countObserver.observe(counter));

        // ── Scroll reveal for impact cards ─────────────────────────
        const impactCards = document.querySelectorAll("[data-reveal]");
        const cardObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-revealed");
                    cardObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        impactCards.forEach(card => cardObserver.observe(card));
    });
</script>

{{-- ========================================================
     OUR VALUES SECTION
     ======================================================== --}}
<section class="py-24 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16" data-reveal>
            <span class="inline-block text-xs font-semibold text-[#2d6fa3] uppercase tracking-wider mb-3">What Drives Us</span>
            <h2 class="text-4xl md:text-5xl font-bold text-[#1d4e7a] mb-4">Our Values</h2>
            <div class="rich-text-content text-gray-500 max-w-2xl mx-auto">
                {!! \App\Models\HomeSetting::getValue('values_supporting_description', 'The principles that guide everything we do, ensuring every child has the opportunity to grow, belong, and thrive.') !!}
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
            @php $valueAccents = ['#2d6fa3', '#8da83a', '#e8a020', '#d32f2f']; @endphp
            @forelse($coreValues as $i => $value)
            @php $accent = $valueAccents[$i % count($valueAccents)]; @endphp
            <div class="group relative bg-white rounded-2xl border border-gray-100 p-8 lg:p-10 shadow-sm hover:shadow-xl hover:-translate-y-1.5 transition-all duration-350"
                 data-reveal="up" style="--reveal-delay: {{ $i * 100 }}">
                <div class="flex items-center gap-4 mb-6">
                    <span class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold text-white" style="background-color: {{ $accent }}">
                        {{ sprintf('%02d', $i + 1) }}
                    </span>
                    <div class="h-px flex-1 bg-gray-100"></div>
                </div>
                <h3 class="text-xl font-black uppercase tracking-wider text-[#1d4e7a] mb-4">{{ $value->localized_title }}</h3>
                <div class="rich-text-content text-gray-600 leading-relaxed">
                    {!! $value->localized_description !!}
                </div>
            </div>
            @empty
            <p class="text-gray-400 text-center py-8 md:col-span-3">No values listed yet.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ========================================================
     OUR PORTFOLIO SECTION
     ======================================================== --}}
<section id="our-portfolio" class="py-24 bg-[#f8f5f0] scroll-mt-20">
    <div class="max-w-4xl mx-auto px-6" data-reveal>
        <div class="text-center mb-12">
            <span class="inline-block text-xs font-semibold text-[#2d6fa3] uppercase tracking-wider mb-3">Our Portfolio</span>
            <h2 class="text-3xl md:text-4xl font-bold text-[#1d4e7a]">How We Work</h2>
        </div>

        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 px-8 py-12 md:px-16 md:py-14 text-center">
            <div class="rich-text-content text-gray-700 leading-relaxed mb-10">
                {!! $t('portfolio_text', 'Krousar Thmey offers a portfolio of cross-cutting programs and projects supporting 4,079 children in their development: Child Welfare, special and inclusive Education for Deaf or Blind Children, Cultural and Artistic Development, Academic and Career Counseling, as well as Health and Hygiene. In the spirit of sustainable action, Krousar Thmey ensures that its support does not lead to any privilege, dependence or disparity in the community.') !!}
            </div>

            <div class="relative py-8 border-y border-gray-100">
                <div class="rich-text-content text-xl md:text-2xl font-serif italic text-[#1d4e7a] leading-snug max-w-2xl mx-auto">
                    "{!! $t('principle_quote', "Krousar Thmey's main principle is the development of projects led by Cambodians for Cambodians.") !!}"
                </div>
            </div>

            <div class="rich-text-content text-gray-500 text-sm leading-relaxed mt-10 max-w-2xl mx-auto">
                {!! $t('portfolio_volunteers_text', 'Only two foreign volunteers provide the organization with support in communication, donor relations and project coordination. Apolitical and secular, the action of Krousar Thmey has been acknowledged internationally for its impact, capacity for innovation and sustainability.') !!}
            </div>
        </div>
    </div>
</section>

{{-- ========================================================
     PROGRAMS STRIP SECTION
     ======================================================== --}}
<section class="py-24 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16" data-reveal>
            <span class="inline-block text-xs font-semibold text-[#2d6fa3] uppercase tracking-wider mb-3">Our Reach</span>
            <h2 class="text-2xl md:text-3xl font-black uppercase tracking-wide text-[#1d4e7a] max-w-3xl mx-auto">
                Krousar Thmey operates 3 programs and 2 cross-cutting projects in {{ $settings['stat_provinces'] ?? '15' }} Cambodian provinces
            </h2>
        </div>

        @php
        $programs = [
            [
                'title' => 'Child Welfare',
                'accent' => '#d32f2f',
                'light' => '#fde8e8',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>',
            ],
            [
                'title' => 'Education for Deaf or Blind Children',
                'accent' => '#8da83a',
                'light' => '#eef3dc',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>',
            ],
            [
                'title' => 'Cultural and Artistic Development',
                'accent' => '#7c4dff',
                'light' => '#ede7fb',
                'icon' => '<circle cx="12.6" cy="4.2" r="1.3" fill="currentColor" stroke="none"/><path stroke-linecap="round" stroke-linejoin="round" d="M12.3 6.2c-.5 1.4-.3 2.9.4 4.1M12.3 6.2c-1.1 0-2.2-.5-2.9-1.5m2.9 1.5c1.1.6 2.4.6 3.4-.1M9.4 4.7c-.5-.6-.6-1.4-.4-2.1M15.1 4.6c.6-.5 1-1.2 1-2M12.7 10.3c-1.7.7-2.9 2.3-3.1 4.2M12.7 10.3c1.7.9 2.7 2.8 2.4 4.7M9.6 21l1.1-6.6M15.1 20.6l-2-5.6"/>',
            ],
            [
                'title' => 'Academic and Career Counseling',
                'accent' => '#e8a020',
                'light' => '#fbf0dc',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 21V4M12 6.5h6l1.75 1.75L18 10h-6M12 11h-6l-1.75 1.75L6 14.5h6"/>',
            ],
            [
                'title' => 'Health and Hygiene',
                'accent' => '#2d6fa3',
                'light' => '#e1ecf4',
                'icon' => '<circle cx="12" cy="5" r="2.2"/><path stroke-linecap="round" stroke-linejoin="round" d="M7 20v-3a5 5 0 0110 0v3"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 9.5c2.3 1.2 3.5 3.8 2.7 6.5"/><circle cx="17.9" cy="17.3" r="1.3"/>',
            ],
        ];
        $programRows = collect($programs)->chunk(3);
        @endphp

        <div class="space-y-14">
            @foreach($programRows as $row)
            <div class="grid gap-x-10 gap-y-14 mx-auto" style="grid-template-columns: repeat({{ $row->count() }}, minmax(0, 1fr)); max-width: {{ $row->count() * 260 }}px;">
                @foreach($row as $j => $program)
                <div class="group flex flex-col items-center text-center" data-reveal="up" style="--reveal-delay: {{ $j * 100 }}">
                    <div class="relative w-28 h-28 rounded-full flex items-center justify-center mb-5 shadow-sm transition-all duration-300 group-hover:-translate-y-1.5 group-hover:shadow-xl"
                         style="background-color: {{ $program['light'] }}; box-shadow: inset 0 0 0 1px {{ $program['accent'] }}22;">
                        <svg class="w-11 h-11" fill="none" stroke="{{ $program['accent'] }}" stroke-width="1.6" viewBox="0 0 24 24">
                            {!! $program['icon'] !!}
                        </svg>
                        <div class="absolute inset-0 rounded-full opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="box-shadow: 0 8px 24px -6px {{ $program['accent'] }}66;"></div>
                    </div>
                    <p class="text-sm font-semibold text-[#1d4e7a] leading-snug max-w-[10rem]">{{ $program['title'] }}</p>
                    <div class="w-16 h-1 rounded-full mt-3 transition-all duration-300 group-hover:w-20" style="background-color: {{ $program['accent'] }}"></div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</section>



{{-- ========================================================
     KROUSAR THMEY WORLDWIDE SECTION
     ======================================================== --}}
<section class="py-24 bg-[#fafbfd] scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6">
        {{-- Section Header --}}
        <div class="text-center max-w-2xl mx-auto mb-16" data-reveal>
            <span class="inline-flex items-center gap-2 text-xs font-semibold text-[#2d6fa3] uppercase tracking-[0.2em] mb-3">
                <span class="w-1.5 h-1.5 rounded-full bg-[#2d6fa3]"></span>
                Global Network
            </span>
            <h2 class="text-4xl md:text-5xl font-bold text-[#1d4e7a] mb-5">Krousar Thmey Worldwide</h2>
            <p class="text-gray-500 leading-relaxed mb-4">
                {{ $settings['worldwide_text'] ?? 'Krousar Thmey benefits from the support of various entities around the world. Their fundraising and communication networks greatly contribute to the success of all programs and projects.' }}
            </p>
            <p class="text-[#1d4e7a] font-semibold text-sm">To know more about each international structure:</p>
        </div>

        {{-- Country Cards Grid --}}
        @php
            $flagSvgs = [
                'france' => '<rect width="3" height="2" fill="#ED2939"/><rect width="2" height="2" fill="#FFF"/><rect width="1" height="2" fill="#002395"/>',
                'switzerland' => '<rect width="3" height="2" fill="#D52B1E"/><rect x="1.25" y="0.4" width="0.5" height="1.2" fill="#FFF"/><rect x="0.9" y="0.75" width="1.2" height="0.5" fill="#FFF"/>',
                'singapore' => '<rect width="3" height="1" fill="#EF3340"/><rect y="1" width="3" height="1" fill="#FFF"/><circle cx="0.75" cy="0.5" r="0.4" fill="#FFF"/><circle cx="0.9" cy="0.5" r="0.32" fill="#EF3340"/><g fill="#FFF"><circle cx="1.25" cy="0.22" r="0.045"/><circle cx="1.45" cy="0.36" r="0.045"/><circle cx="1.38" cy="0.6" r="0.045"/><circle cx="1.12" cy="0.6" r="0.045"/><circle cx="1.05" cy="0.36" r="0.045"/></g>',
                'cambodia' => '<rect width="3" height="2" fill="#032EA1"/><rect y="0.5" width="3" height="1" fill="#E00025"/><rect x="1.2" y="0.65" width="0.6" height="0.7" fill="#FFF"/>',
            ];
        @endphp
        <div class="grid sm:grid-cols-2 gap-7 max-w-3xl mx-auto">
            @forelse($offices as $loc)
            @php
                preg_match('/#([0-9a-fA-F]{3,8})/', $loc->accent_color, $m);
                $hex = '#' . ($m[1] ?? '2d6fa3');
                $flagKey = strtolower(trim($loc->country));
                $flagSvg = $flagSvgs[$flagKey] ?? null;
            @endphp
            <div class="relative bg-white rounded-[28px] border border-gray-100 shadow-sm hover:shadow-[0_20px_45px_-10px_rgba(45,111,163,0.12)] hover:-translate-y-2.5 hover:scale-[1.02] transition-all duration-500 ease-[cubic-bezier(0.16,1,0.3,1)] overflow-hidden group flex flex-col"
                 data-reveal="up" style="--reveal-delay: {{ $loop->index * 100 }}">
                <div class="p-7 md:p-8 flex-1 flex flex-col">
                    <div class="flex items-start justify-between mb-6">
                        @if($flagSvg)
                        <span class="w-16 h-11 rounded-lg overflow-hidden border border-gray-100 shadow-sm flex-shrink-0 transition-transform duration-500 ease-[cubic-bezier(0.16,1,0.3,1)] group-hover:scale-[1.08]">
                            <svg class="w-full h-full" viewBox="0 0 3 2" preserveAspectRatio="xMidYMid slice">{!! $flagSvg !!}</svg>
                        </span>
                        @else
                        <span class="w-16 h-11 rounded-lg bg-gray-50 border border-gray-100 flex items-center justify-center text-2xl flex-shrink-0">{{ $loc->flag }}</span>
                        @endif
                        @if($loc->badge)
                        <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full {{ $loc->badge_color }}">{{ $loc->badge }}</span>
                        @endif
                    </div>

                    <h3 class="text-xl font-black uppercase tracking-wide mb-1" style="color: {{ $hex }}">{{ $loc->country }}</h3>
                    <p class="text-[#8da83a] text-xs font-semibold uppercase tracking-wide mb-6">{{ $loc->city }}</p>

                    <div class="space-y-4 flex-1">
                        <div class="flex items-start gap-3">
                            <span class="w-7 h-7 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5 transition-transform duration-300 group-hover:scale-105" style="background-color: {{ $hex }}1a">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="{{ $hex }}" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </span>
                            <p class="text-gray-500 text-xs leading-relaxed pt-1">{{ $loc->address }}</p>
                        </div>
                        @if($loc->phone)
                        <a href="tel:{{ preg_replace('/[^+0-9]/', '', $loc->phone) }}" class="flex items-center gap-3 group/link">
                            <span class="w-7 h-7 rounded-lg flex items-center justify-center flex-shrink-0 transition-transform duration-300 group-hover/link:scale-110" style="background-color: {{ $hex }}1a">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="{{ $hex }}" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </span>
                            <span class="text-gray-500 text-xs group-hover/link:text-[#1d4e7a] transition-colors">{{ $loc->phone }}</span>
                        </a>
                        @endif
                        @if($loc->email)
                        <a href="mailto:{{ $loc->email }}" class="flex items-center gap-3 group/link">
                            <span class="w-7 h-7 rounded-lg flex items-center justify-center flex-shrink-0 transition-transform duration-300 group-hover/link:scale-110" style="background-color: {{ $hex }}1a">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="{{ $hex }}" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </span>
                            <span class="text-gray-500 text-xs group-hover/link:text-[#1d4e7a] transition-colors break-all">{{ $loc->email }}</span>
                        </a>
                        @endif
                    </div>
                </div>
                @if($loc->email)
                <div class="px-7 md:px-8 pb-7 md:pb-8 pt-1">
                    <a href="mailto:{{ $loc->email }}" class="flex items-center justify-center gap-2 w-full py-3 rounded-xl text-white text-xs font-semibold uppercase tracking-wide shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-200" style="background-color: {{ $hex }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Send Email
                    </a>
                </div>
                @endif
            </div>
            @empty
            <div class="col-span-full text-center text-gray-400 py-8">
                <p>Office information coming soon.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection
