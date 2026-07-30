@extends('layouts.app')

@section('title', 'Transparency — Krousar Thmey')
@section('description', 'Financial transparency and accountability at Krousar Thmey. All administrative costs remain under 4% of the total budget.')

@section('content')

{{-- Scopes full-viewport scroll-snap to this page only, without touching the shared layout. --}}
<style>
html:has(.transparency-immersive) { scroll-snap-type: y proximity; }
</style>
<div class="transparency-immersive">

{{-- ========================================================
     PAGE HEADER / BANNER
     ======================================================== --}}
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
    $transparencyBannerImage = $settings['transparency_banner_image'] ?? null;
    $transparencyBannerImageUrl = $transparencyBannerImage ? (str_starts_with($transparencyBannerImage, 'http') ? $transparencyBannerImage : asset('storage/' . $transparencyBannerImage)) : asset('images/children.jpg');
    $transparencyBannerOverlayColor = $settings['transparency_banner_overlay_color'] ?? '#1a3c6e';
    $transparencyBannerBlur = (int) ($settings['transparency_banner_blur'] ?? 0);
    $transparencyBannerBadge = $t('transparency_banner_badge', 'Accountability');
    $transparencyBannerSubtitle = $t('transparency_banner_subtitle', 'See how every donation is managed with strict financial discipline and independent oversight.');
    $transparencyBtn1Text = $settings['transparency_banner_btn1_text'] ?? 'Donate Now';
    $transparencyBtn1Url = $settings['transparency_banner_btn1_url'] ?? route('donate');
    $transparencyBtn2Text = $settings['transparency_banner_btn2_text'] ?? 'Get Involved';
    $transparencyBtn2Url = $settings['transparency_banner_btn2_url'] ?? route('involved');
    $transparencyBtn3Text = $settings['transparency_banner_btn3_text'] ?? 'Annual Report';
    $transparencyBtn3Url = $settings['transparency_banner_btn3_url'] ?? (route('resources') . '#annual-reports');
@endphp
<section class=" pb-20 relative min-h-[calc(100dvh-4rem)] lg:min-h-[calc(100dvh-7.25rem)] flex items-center overflow-hidden text-center scroll-mt-20 [scroll-snap-align:start]">
    <div class="absolute inset-0 bg-cover bg-center hero-media-drift" style="background-image: url('{{ $transparencyBannerImageUrl }}'); filter: blur({{ $transparencyBannerBlur }}px); {{ $transparencyBannerBlur > 0 ? 'transform: scale(1.05);' : '' }}"></div>
    <div class="absolute inset-0" style="background-color: {{ $transparencyBannerOverlayColor }}; opacity: 0.55;"></div>

    {{-- Animated decorative orbs --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full hero-float-slow" style="background: radial-gradient(circle, rgba(255,255,255,0.10) 0%, transparent 70%);"></div>
        <div class="absolute -bottom-32 -left-32 w-[30rem] h-[30rem] rounded-full hero-float-delayed" style="background: radial-gradient(circle, rgba(255,255,255,0.07) 0%, transparent 70%);"></div>
        <div class="absolute top-1/3 left-1/4 w-48 h-48 rounded-full hero-pulse" style="background: radial-gradient(circle, rgba(141,168,58,0.20) 0%, transparent 70%);"></div>
        <div class="absolute bottom-1/4 right-1/4 w-40 h-40 rounded-full hero-float-slow" style="animation-delay: 4s; background: radial-gradient(circle, rgba(238,169,29,0.15) 0%, transparent 70%);"></div>
    </div>

    <div class="relative z-10 max-w-3xl mx-auto px-6">
        <span class="hero-reveal hero-reveal-delay-1 inline-block bg-white text-[#eea91d] text-xs font-semibold px-4 py-1.5 rounded-full mb-6 uppercase tracking-wider">{{ $transparencyBannerBadge }}Transparency</span>
        <h1 class="hero-reveal hero-reveal-delay-2 text-3xl md:text-5xl font-extrabold tracking-tight text-white uppercase drop-shadow-lg"> 
            {{ $t('transparency_title', 'Transparency and Accountabilitys') }} 
        </h1>
        <div class="rich-text-content hero-reveal hero-reveal-delay-3 text-white/90 text-lg leading-relaxed max-w-3xl mx-auto mt-6 drop-shadow-md">
            {!! $transparencyBannerSubtitle !!}
        </div>

        @if($transparencyBtn1Text || $transparencyBtn2Text || $transparencyBtn3Text)
        <div class="hero-reveal hero-reveal-delay-4 flex flex-wrap items-center justify-center gap-4 mt-8">
            @if($transparencyBtn1Text)
            <a href="{{ $transparencyBtn1Url }}"
               class="group inline-flex items-center gap-2 px-6 py-3 bg-[#8da83a] text-white font-semibold rounded-full hover:bg-[#a3c04a] transition-all duration-300 shadow-md hover:shadow-lg hover:-translate-y-0.5">
                <svg class="w-5 h-5 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                <span>{{ $transparencyBtn1Text }}</span>
            </a>
            @endif
            @if($transparencyBtn2Text)
            <a href="{{ $transparencyBtn2Url }}"
               class="group inline-flex items-center gap-2 px-6 py-3 border-2 border-white/50 text-white font-semibold rounded-full hover:bg-white hover:text-[#2d6fa3] transition-all duration-300 hover:-translate-y-0.5">
                <svg class="w-5 h-5 opacity-0 -ml-4 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <span>{{ $transparencyBtn2Text }}</span>
            </a>
            @endif
            @if($transparencyBtn3Text)
            <a href="{{ $transparencyBtn3Url }}"
               class="group inline-flex items-center gap-2 px-6 py-3 border-2 border-white/50 text-white font-semibold rounded-full hover:bg-white hover:text-[#2d6fa3] transition-all duration-300 hover:-translate-y-0.5">
                <svg class="w-5 h-5 opacity-0 -ml-4 group-hover:opacity-100 group-hover:ml-0 transition-all duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>{{ $transparencyBtn3Text }}</span>
            </a>
            @endif
        </div>
        @endif
    </div>

    <a href="#financial-transparency" class="hero-reveal hero-reveal-delay-4 absolute bottom-8 left-1/2 -translate-x-1/2 z-10 flex flex-col items-center gap-2 text-white/80 hover:text-white transition-colors" aria-label="Scroll to explore">
        <span class="text-xs uppercase tracking-widest font-medium">Scroll to Explore</span>
        <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
        </svg>
    </a>
</section>

{{-- ========================================================
     FINANCIAL TRANSPARENCY
     ======================================================== --}}
<section id="financial-transparency" class="relative min-h-[calc(100dvh-5rem)] flex items-center py-16 md:py-20 bg-white scroll-mt-20 [scroll-snap-align:start]">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-10 w-full">
        <div class="text-center mb-12" data-reveal="left">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Accountability</span>
            <h2 class="section-title mt-3">{{ $t('transparency_financial_heading', 'Financial Transparency') }}</h2>
        </div>

        @php
            $financialCardColor = $settings['transparency_financial_card_color'] ?? null;
            $financialRulerColor = $settings['transparency_financial_ruler_color'] ?? null;
        @endphp
        <div class="group relative border border-[#f2e6c9] rounded-2xl p-7 md:p-10 shadow-sm overflow-hidden space-y-5 text-[#1d4e7a] leading-relaxed transition-all duration-300 hover:shadow-lg {{ $financialCardColor ? '' : 'bg-[#fffdf8]' }}"
             @if($financialCardColor) style="background-color: {{ $financialCardColor }}" @endif
             data-reveal="up">
            @if($financialRulerColor)
            <div class="absolute top-0 left-0 w-[6px] h-full" style="background-color: {{ $financialRulerColor }}"></div>
            @else
            <div class="absolute top-0 left-0 w-[6px] h-full bg-gradient-to-b from-[#e8a020] to-[#d32f2f]"></div>
            @endif

            <div class="flex items-center gap-3 mb-2">
                <div class="w-9 h-9 rounded-full bg-[#e8a020]/10 flex items-center justify-center shrink-0 transition-transform duration-300 group-hover:scale-110">
                    <svg class="w-4 h-4 text-[#e8a020]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-sm font-black text-[#e8a020] uppercase tracking-widest">Overview</h3>
            </div>

            <div class="rich-text-content">{!! $t('transparency_financial_body', '<p>Financial transparency is a key principle for Krousar Thmey. Everybody has the right to know how the funds raised are used.</p><p>The implementation of programs and projects is our priority.</p><blockquote><p>Thanks to the strict financial management and the involvement of European volunteers, all administrative costs remain under 4% of the total budget.</p></blockquote><p>Krousar Thmey Cambodia\'s accounts are all audited and certified each year by an independent audit firm (PricewaterhouseCoopers since 2013 and KPMG before then). Working closely with the auditors, Krousar Thmey is committed to constantly improving the quality and precision of its financial processes in order to provide greater efficiency to the organization and transparency to its partners.</p>') !!}</div>

            <p class="!mb-2 font-semibold text-[#11568c]">{{ $t('transparency_financial_list_intro', 'Audited financial statements are available here:') }}</p>
            @php $availableReports = $reports->filter(fn ($report) => $report->download_url)->values(); @endphp
            @if($availableReports->isNotEmpty())
            <div class="!mt-3 grid sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($availableReports as $i => $report)
                <a href="{{ $report->download_url }}" target="_blank" rel="noopener"
                   class="group/doc flex items-center gap-4 bg-white border border-[#f2e6c9] rounded-xl px-5 py-4 transition-all duration-200 hover:shadow-md hover:-translate-y-0.5 hover:border-[#2d6fa3]/30"
                   data-reveal="up" style="--reveal-delay: {{ $i * 60 }}">
                    <div class="w-11 h-11 rounded-lg bg-[#1a3c6e] flex items-center justify-center shrink-0 transition-transform duration-200 group-hover/doc:scale-105">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="font-semibold text-[#1a3c6e] text-sm truncate">{{ $report->localized_title ?: 'Audited Financial Statement' }}</p>
                        <p class="text-gray-400 text-xs mt-0.5">{{ $report->year }} · PDF</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-300 shrink-0 transition-transform duration-200 group-hover/doc:translate-x-1 group-hover/doc:text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
                @endforeach
            </div>
            @else
            <p class="text-gray-400 text-sm">No reports available yet.</p>
            @endif

            <div class="rich-text-content text-sm text-[#1d4e7a]/80">{!! $t('transparency_financial_outro', "Our French and Swiss organisations' accounts are also audited annually.") !!}</div>
        </div>
    </div>
</section>

{{-- ========================================================
     ORIGINS OF THE FUNDS
     ======================================================== --}}
<section id="origins-of-the-funds" class="min-h-[calc(100dvh-5rem)] flex items-center py-16 md:py-20 bg-[#f8f9fc] scroll-mt-20 [scroll-snap-align:start]">
    <div class="max-w-[1400px] mx-auto px-6 lg:px-10 w-full">
        <div class="text-center mb-12" data-reveal="left" style="--reveal-delay: 80">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Where It Comes From</span>
            <h2 class="section-title mt-3">{{ $t('transparency_origins_heading', 'Origins Of The Funds') }}</h2>
        </div>

        @php
            $originsCardColor = $settings['transparency_origins_card_color'] ?? null;
            $originsRulerColor = $settings['transparency_origins_ruler_color'] ?? null;
        @endphp
        <div class="group relative border border-[#f2e6c9] rounded-2xl p-7 md:p-10 shadow-sm overflow-hidden space-y-5 text-[#1d4e7a] leading-relaxed transition-all duration-300 hover:shadow-lg {{ $originsCardColor ? '' : 'bg-[#fffdf8]' }}"
             data-reveal="up" style="--reveal-delay: 80 @if($originsCardColor); background-color: {{ $originsCardColor }}@endif">
            @if($originsRulerColor)
            <div class="absolute top-0 left-0 w-[6px] h-full" style="background-color: {{ $originsRulerColor }}"></div>
            @else
            <div class="absolute top-0 left-0 w-[6px] h-full bg-gradient-to-b from-[#e8a020] to-[#d32f2f]"></div>
            @endif

            <div class="flex items-center gap-3 mb-2">
                <div class="w-9 h-9 rounded-full bg-[#e8a020]/10 flex items-center justify-center shrink-0 transition-transform duration-300 group-hover:scale-110">
                    <svg class="w-4 h-4 text-[#e8a020]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-sm font-black text-[#e8a020] uppercase tracking-widest">Overview</h3>
            </div>

            <div class="rich-text-content">{!! $t('transparency_origins_body', '<p>In support of its local activity in Cambodia, Krousar Thmey benefits from the involvement of volunteers in international entities: Krousar Thmey France, Krousar Thmey Switzerland and Krousar Thmey Singapore. As their main activity is fundraising, these branches are a privileged relay to donors outside of Cambodia. They enable Krousar Thmey to receive institutional funding and support from individual donors.</p><p>Donations received in Cambodia come mainly from non-governmental organizations and to a lesser extent from private donors and the Cambodian authorities.</p><blockquote><p>Financial or in-kind donations from the Cambodian authorities have increased steadily over the past few years, accounting for nearly 8% of Krousar Thmey\'s resources. All staff of special schools for deaf or blind children are civil servants of the Ministry of Education, Youth and Sports who pay their salary (excluding complements paid by Krousar Thmey). For the time being, this contribution is not included in the expenditure and income statement.</p></blockquote>') !!}</div>
        </div>

        <div class="group flex items-center justify-center gap-3 text-center font-semibold text-[#11568c] mt-8 bg-[#eea91d]/10 border border-[#eea91d]/30 rounded-2xl px-6 py-5 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5 hover:bg-[#eea91d]/15" data-reveal="scale" style="--reveal-delay: 160">
            <svg class="w-6 h-6 text-[#eea91d] shrink-0 transition-transform duration-300 group-hover:scale-110 group-hover:rotate-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
            <p>
                {{ $t('transparency_award_prefix', 'Krousar Thmey won the') }}
                <a href="{{ $settings['transparency_award_link_url'] ?? 'https://ideas.asso.fr/' }}" target="_blank" rel="noopener" class="text-[#2d6fa3] underline hover:text-[#1d4e7a]">{{ $t('transparency_award_link_label', 'label Ideas') }}</a>
                {{ $t('transparency_award_suffix', 'in 2010.') }}
            </p>
        </div>
    </div>
</section>

</div>

@endsection
