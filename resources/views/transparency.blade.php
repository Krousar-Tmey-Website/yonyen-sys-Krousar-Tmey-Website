@extends('layouts.app')

@section('title', 'Transparency — Krousar Thmey')
@section('description', 'Financial transparency and accountability at Krousar Thmey. All administrative costs remain under 4% of the total budget.')

@section('content')

{{-- ========================================================
     PAGE HEADER
     ======================================================== --}}
<section class="pt-16 pb-8 bg-white text-center scroll-mt-20">
    <div class="max-w-4xl mx-auto px-6">
        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight text-[#0A5EA8] uppercase" data-reveal>
            {{ $settings['transparency_title'] ?? 'Transparency and Accountability' }}
        </h1>

        @php
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
        @if($sharingEnabled == '1')
        <div class="flex items-center justify-center gap-3 mt-6" data-reveal="up" style="--reveal-delay: 150">
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
        <div class="space-y-4 text-[#1d4e7a] leading-relaxed" data-reveal="up">
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
        <h2 class="text-sm font-bold uppercase tracking-wider text-[#11568c] mb-4" data-reveal="left">{{ $settings['transparency_origins_heading'] ?? 'Origins Of The Funds' }}</h2>
        <div class="space-y-4 text-[#1d4e7a] leading-relaxed" data-reveal="up">
            <p>{{ $settings['transparency_origins_p1'] ?? 'In support of its local activity in Cambodia, Krousar Thmey benefits from the involvement of volunteers in international entities: Krousar Thmey France, Krousar Thmey Switzerland and Krousar Thmey Singapore. As their main activity is fundraising, these branches are a privileged relay to donors outside of Cambodia. They enable Krousar Thmey to receive institutional funding and support from individual donors.' }}</p>
            <p>{{ $settings['transparency_origins_p2'] ?? 'Donations received in Cambodia come mainly from non-governmental organizations and to a lesser extent from private donors and the Cambodian authorities.' }}</p>
            <p>{{ $settings['transparency_origins_p3'] ?? "Financial or in-kind donations from the Cambodian authorities have increased steadily over the past few years, accounting for nearly 8% of Krousar Thmey's resources. All staff of special schools for deaf or blind children are civil servants of the Ministry of Education, Youth and Sports who pay their salary (excluding complements paid by Krousar Thmey). For the time being, this contribution is not included in the expenditure and income statement." }}</p>
        </div>

        <p class="text-center font-semibold text-[#11568c] mt-8" data-reveal="scale">
            {{ $settings['transparency_award_prefix'] ?? 'Krousar Thmey won the' }}
            <a href="{{ $settings['transparency_award_link_url'] ?? 'https://ideas.asso.fr/' }}" target="_blank" rel="noopener" class="text-[#2d6fa3] underline hover:text-[#1d4e7a]">{{ $settings['transparency_award_link_label'] ?? 'label Ideas' }}</a>
            {{ $settings['transparency_award_suffix'] ?? 'in 2010.' }}
        </p>
    </div>
</section>

@endsection
