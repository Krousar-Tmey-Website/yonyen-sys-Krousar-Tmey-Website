@extends('layouts.app')

@section('title', 'Transparency — Krousar Thmey')
@section('description', 'Financial transparency and accountability at Krousar Thmey. All administrative costs remain under 4% of the total budget.')

@section('content')

{{-- ========================================================
     PAGE HEADER / BANNER
     ======================================================== --}}
@php
    $transparencyBannerImage = $settings['transparency_banner_image'] ?? null;
    $transparencyBannerImageUrl = $transparencyBannerImage ? (str_starts_with($transparencyBannerImage, 'http') ? $transparencyBannerImage : asset('storage/' . $transparencyBannerImage)) : asset('images/children.jpg');
    $transparencyBannerOverlayColor = $settings['transparency_banner_overlay_color'] ?? '#1a3c6e';
    $transparencyBannerBlur = (int) ($settings['transparency_banner_blur'] ?? 0);
    $transparencyBannerBadge = $settings['transparency_banner_badge'] ?? 'Accountability';
    $transparencyBannerSubtitle = $settings['transparency_banner_subtitle'] ?? 'See how every donation is managed with strict financial discipline and independent oversight.';

    $sharingEnabled = \App\Models\HomeSetting::getValue('sharing_enabled', '1');
    $facebookIcon = \App\Models\HomeSetting::getValue('sharing_facebook_icon', 'images/social/facebook.svg');
    $facebookIcon = str_starts_with($facebookIcon, 'social/') ? 'storage/' . $facebookIcon : $facebookIcon;
    $twitterIcon = \App\Models\HomeSetting::getValue('sharing_twitter_icon', 'images/social/twitter.svg');
    $twitterIcon = str_starts_with($twitterIcon, 'social/') ? 'storage/' . $twitterIcon : $twitterIcon;
    $linkedinIcon = \App\Models\HomeSetting::getValue('sharing_linkedin_icon', 'images/social/linkedin.svg');
    $linkedinIcon = str_starts_with($linkedinIcon, 'social/') ? 'storage/' . $linkedinIcon : $linkedinIcon;
    $shareIcon = \App\Models\HomeSetting::getValue('sharing_share_icon', 'images/social/share.svg');
    $shareIcon = str_starts_with($shareIcon, 'social/') ? 'storage/' . $shareIcon : $shareIcon;
    $facebookLink = \App\Models\HomeSetting::getValue('social_facebook', '');
    $linkedinLink = \App\Models\HomeSetting::getValue('social_linkedin', '');
@endphp
<section class="relative py-24 overflow-hidden text-center scroll-mt-20">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $transparencyBannerImageUrl }}'); filter: blur({{ $transparencyBannerBlur }}px); {{ $transparencyBannerBlur > 0 ? 'transform: scale(1.05);' : '' }}"></div>
    <div class="absolute inset-0" style="background-color: {{ $transparencyBannerOverlayColor }}; opacity: 0.55;"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-6">
        <span class="hero-reveal hero-reveal-delay-1 inline-block bg-white text-[#eea91d] text-xs font-semibold px-4 py-1.5 rounded-full mb-6 uppercase tracking-wider">{{ $transparencyBannerBadge }}</span>
        <h1 class="hero-reveal hero-reveal-delay-2 text-3xl md:text-5xl font-extrabold tracking-tight text-white uppercase drop-shadow-lg">
            {{ $settings['transparency_title'] ?? 'Transparency and Accountability' }}
        </h1>
        <p class="hero-reveal hero-reveal-delay-3 text-white/90 text-lg leading-relaxed max-w-2xl mx-auto mt-6 drop-shadow-md">
            {{ $transparencyBannerSubtitle }}
        </p>

        @if($sharingEnabled == '1')
        <div class="hero-reveal hero-reveal-delay-4 flex items-center justify-center gap-3 mt-8">
            <a href="{{ $facebookLink ?: 'https://www.addtoany.com/add_to/facebook?linkurl=' . urlencode(url()->current()) . '&linkname=' . urlencode('Transparency and Accountability') . '&linknote=' . urlencode('Krousar Thmey - Transparency and Accountability') }}"
               target="_blank" rel="noopener noreferrer" aria-label="Share on Facebook"
               class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                <img src="{{ asset($facebookIcon) }}" alt="Facebook" class="w-full h-full object-cover">
            </a>
            <a href="https://www.addtoany.com/add_to/twitter?linkurl={{ urlencode(url()->current()) }}&linkname={{ urlencode('Transparency and Accountability') }}&linknote={{ urlencode('Krousar Thmey - Transparency and Accountability') }}"
               target="_blank" rel="noopener noreferrer" aria-label="Share on Twitter"
               class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                <img src="{{ asset($twitterIcon) }}" alt="Twitter" class="w-full h-full object-cover">
            </a>
            <a href="{{ $linkedinLink ?: 'https://www.addtoany.com/add_to/linkedin?linkurl=' . urlencode(url()->current()) . '&linkname=' . urlencode('Transparency and Accountability') . '&linknote=' . urlencode('Krousar Thmey - Transparency and Accountability') }}"
               target="_blank" rel="noopener noreferrer" aria-label="Share on LinkedIn"
               class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                <img src="{{ asset($linkedinIcon) }}" alt="LinkedIn" class="w-full h-full object-cover">
            </a>
            <a href="https://www.addtoany.com/share#url={{ urlencode(url()->current()) }}&title={{ urlencode('Transparency and Accountability') }}"
               target="_blank" rel="noopener noreferrer" aria-label="Share"
               class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                <img src="{{ asset($shareIcon) }}" alt="Share" class="w-full h-full object-cover">
            </a>
        </div>
        @endif
    </div>
</section>

{{-- ========================================================
     FINANCIAL TRANSPARENCY
     ======================================================== --}}
<section class="py-12 md:py-16 bg-white scroll-mt-20">
    <div class="max-w-3xl mx-auto px-6">
        <h2 class="text-sm font-bold uppercase tracking-wider text-[#11568c] mb-4" data-reveal="left">{{ $settings['transparency_financial_heading'] ?? 'Financial Transparency' }}</h2>
        <div class="group relative bg-[#fffdf8] border border-[#f2e6c9] rounded-2xl p-7 md:p-8 shadow-sm overflow-hidden space-y-4 text-[#1d4e7a] leading-relaxed transition-all duration-300 hover:shadow-lg hover:-translate-y-1" data-reveal="up">
            <div class="absolute top-0 left-0 w-[6px] h-full bg-gradient-to-b from-[#e8a020] to-[#d32f2f]"></div>

            <div class="flex items-center gap-3 mb-4">
                <div class="w-9 h-9 rounded-full bg-[#e8a020]/10 flex items-center justify-center shrink-0 transition-transform duration-300 group-hover:scale-110">
                    <svg class="w-4 h-4 text-[#e8a020]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-sm font-black text-[#e8a020] uppercase tracking-widest">Overview</h3>
            </div>

            <p>{{ $settings['transparency_financial_p1'] ?? 'Financial transparency is a key principle for Krousar Thmey. Everybody has the right to know how the funds raised are used.' }}</p>
            <p>{{ $settings['transparency_financial_p2'] ?? 'The implementation of programs and projects is our priority.' }}</p>
            <p class="font-bold">{{ $settings['transparency_financial_p3'] ?? 'Thanks to the strict financial management and the involvement of European volunteers, all administrative costs remain under 4% of the total budget.' }}</p>
            <p>{{ $settings['transparency_financial_p4'] ?? "Krousar Thmey Cambodia's accounts are all audited and certified each year by an independent audit firm (PricewaterhouseCoopers since 2013 and KPMG before then). Working closely with the auditors, Krousar Thmey is committed to constantly improving the quality and precision of its financial processes in order to provide greater efficiency to the organization and transparency to its partners." }}</p>

            <p class="!mb-2">{{ $settings['transparency_financial_list_intro'] ?? 'Audited financial statements are available here:' }}</p>
            @php $availableReports = $reports->filter(fn ($report) => $report->download_url)->values(); @endphp
            @if($availableReports->isNotEmpty())
            <ul class="!mt-0 space-y-4">
                @foreach($availableReports as $i => $report)
                <li data-reveal="up" style="--reveal-delay: {{ $i * 60 }}">
                    <a href="{{ $report->download_url }}" target="_blank" rel="noopener"
                       class="inline-block text-[#2d6fa3] font-medium transition-transform duration-200 hover:underline hover:translate-x-1">
                        Audited financial statement {{ $report->year }}
                    </a>
                </li>
                @endforeach
            </ul>
            @else
            <p class="text-gray-400 text-sm">No reports available yet.</p>
            @endif

            <p>{{ $settings['transparency_financial_outro'] ?? "Our French and Swiss organisations' accounts are also audited annually." }}</p>
        </div>
    </div>
</section>

{{-- ========================================================
     ORIGINS OF THE FUNDS
     ======================================================== --}}
<section class="py-12 md:py-16 bg-white scroll-mt-20">
    <div class="max-w-3xl mx-auto px-6">
        <h2 class="text-sm font-bold uppercase tracking-wider text-[#11568c] mb-4" data-reveal="left" style="--reveal-delay: 80">{{ $settings['transparency_origins_heading'] ?? 'Origins Of The Funds' }}</h2>
        <div class="group relative bg-[#fffdf8] border border-[#f2e6c9] rounded-2xl p-7 md:p-8 shadow-sm overflow-hidden space-y-4 text-[#1d4e7a] leading-relaxed transition-all duration-300 hover:shadow-lg hover:-translate-y-1" data-reveal="up" style="--reveal-delay: 80">
            <div class="absolute top-0 left-0 w-[6px] h-full bg-gradient-to-b from-[#e8a020] to-[#d32f2f]"></div>

            <div class="flex items-center gap-3 mb-4">
                <div class="w-9 h-9 rounded-full bg-[#e8a020]/10 flex items-center justify-center shrink-0 transition-transform duration-300 group-hover:scale-110">
                    <svg class="w-4 h-4 text-[#e8a020]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-sm font-black text-[#e8a020] uppercase tracking-widest">Overview</h3>
            </div>

            <p>{{ $settings['transparency_origins_p1'] ?? 'In support of its local activity in Cambodia, Krousar Thmey benefits from the involvement of volunteers in international entities: Krousar Thmey France, Krousar Thmey Switzerland and Krousar Thmey Singapore. As their main activity is fundraising, these branches are a privileged relay to donors outside of Cambodia. They enable Krousar Thmey to receive institutional funding and support from individual donors.' }}</p>
            <p>{{ $settings['transparency_origins_p2'] ?? 'Donations received in Cambodia come mainly from non-governmental organizations and to a lesser extent from private donors and the Cambodian authorities.' }}</p>
            <p>{{ $settings['transparency_origins_p3'] ?? "Financial or in-kind donations from the Cambodian authorities have increased steadily over the past few years, accounting for nearly 8% of Krousar Thmey's resources. All staff of special schools for deaf or blind children are civil servants of the Ministry of Education, Youth and Sports who pay their salary (excluding complements paid by Krousar Thmey). For the time being, this contribution is not included in the expenditure and income statement." }}</p>
        </div>

        <div class="group flex items-center justify-center gap-3 text-center font-semibold text-[#11568c] mt-8 bg-[#eea91d]/10 border border-[#eea91d]/30 rounded-2xl px-6 py-5 transition-all duration-300 hover:shadow-md hover:-translate-y-0.5 hover:bg-[#eea91d]/15" data-reveal="scale" style="--reveal-delay: 160">
            <svg class="w-6 h-6 text-[#eea91d] shrink-0 transition-transform duration-300 group-hover:scale-110 group-hover:rotate-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
            <p>
                {{ $settings['transparency_award_prefix'] ?? 'Krousar Thmey won the' }}
                <a href="{{ $settings['transparency_award_link_url'] ?? 'https://ideas.asso.fr/' }}" target="_blank" rel="noopener" class="text-[#2d6fa3] underline hover:text-[#1d4e7a]">{{ $settings['transparency_award_link_label'] ?? 'label Ideas' }}</a>
                {{ $settings['transparency_award_suffix'] ?? 'in 2010.' }}
            </p>
        </div>
    </div>
</section>

@endsection
