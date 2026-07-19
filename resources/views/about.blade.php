@extends('layouts.app')

@section('title', 'Who We Are — Krousar Thmey')
@section('description', 'Krousar Thmey is the first Cambodian organization helping disadvantaged children, born in 1991 in the Site II refugee camp in Thailand.')

@section('content')

{{-- ========================================================
     OUR HISTORY
     ======================================================== --}}
<section id="history" class="pt-10 pb-20 bg-white scroll-mt-20">
    <div class="max-w-[1400px] mx-auto px-5 md:px-12 lg:px-20">
        @php
            $historySharingEnabled = \App\Models\HomeSetting::getValue('sharing_enabled', '1');
            $historyFacebookIcon = \App\Models\HomeSetting::getValue('sharing_facebook_icon', 'images/social/facebook.svg');
            $historyFacebookIcon = str_starts_with($historyFacebookIcon, 'social/') ? 'storage/' . $historyFacebookIcon : $historyFacebookIcon;
            $historyTwitterIcon = \App\Models\HomeSetting::getValue('sharing_twitter_icon', 'images/social/twitter.svg');
            $historyTwitterIcon = str_starts_with($historyTwitterIcon, 'social/') ? 'storage/' . $historyTwitterIcon : $historyTwitterIcon;
            $historyLinkedinIcon = \App\Models\HomeSetting::getValue('sharing_linkedin_icon', 'images/social/linkedin.svg');
            $historyLinkedinIcon = str_starts_with($historyLinkedinIcon, 'social/') ? 'storage/' . $historyLinkedinIcon : $historyLinkedinIcon;
            $historyShareIcon = \App\Models\HomeSetting::getValue('sharing_share_icon', 'images/social/share.svg');
            $historyShareIcon = str_starts_with($historyShareIcon, 'social/') ? 'storage/' . $historyShareIcon : $historyShareIcon;
            $historyFacebookLink = \App\Models\HomeSetting::getValue('sharing_facebook_link', '');
            $historyTwitterLink = \App\Models\HomeSetting::getValue('sharing_twitter_link', '');
            $historyLinkedinLink = \App\Models\HomeSetting::getValue('sharing_linkedin_link', '');
        @endphp
        <div class="text-center mb-16" data-reveal>
            <h2 class="text-5xl md:text-6xl font-extrabold tracking-tight text-[#0A5EA8]">OUR HISTORY</h2>
            @if($historySharingEnabled == '1')
            <div class="flex items-center justify-center gap-3 mt-6 mb-12">
                <a href="{{ $historyFacebookLink ?: 'https://www.addtoany.com/add_to/facebook?linkurl=' . urlencode(url()->current()) . '&linkname=' . urlencode('Our History') . '&linknote=' . urlencode('Krousar Thmey - Our History') }}"
                   target="_blank" rel="noopener noreferrer" aria-label="Share on Facebook"
                   class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                    <img src="{{ asset($historyFacebookIcon) }}" alt="Facebook" class="w-full h-full object-cover">
                </a>
                <a href="{{ $historyTwitterLink ?: 'https://www.addtoany.com/add_to/twitter?linkurl=' . urlencode(url()->current()) . '&linkname=' . urlencode('Our History') . '&linknote=' . urlencode('Krousar Thmey - Our History') }}"
                   target="_blank" rel="noopener noreferrer" aria-label="Share on Twitter"
                   class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                    <img src="{{ asset($historyTwitterIcon) }}" alt="Twitter" class="w-full h-full object-cover">
                </a>
                <a href="{{ $historyLinkedinLink ?: 'https://www.addtoany.com/add_to/linkedin?linkurl=' . urlencode(url()->current()) . '&linkname=' . urlencode('Our History') . '&linknote=' . urlencode('Krousar Thmey - Our History') }}"
                   target="_blank" rel="noopener noreferrer" aria-label="Share on LinkedIn"
                   class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                    <img src="{{ asset($historyLinkedinIcon) }}" alt="LinkedIn" class="w-full h-full object-cover">
                </a>
                <a href="https://www.addtoany.com/share#url={{ urlencode(url()->current()) }}&title={{ urlencode('Our History') }}"
                   target="_blank" rel="noopener noreferrer" aria-label="Share"
                   class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                    <img src="{{ asset($historyShareIcon) }}" alt="Share" class="w-full h-full object-cover">
                </a>
            </div>
            @endif
        </div>

        @php
            $timelineItems = [];
            foreach ($historyEvents as $event) {
                if ($event->left_text) {
                    $timelineItems[] = ['year' => $event->year, 'text' => $event->left_text, 'image' => $event->image_url];
                }
                if ($event->right_text) {
                    $timelineItems[] = ['year' => $event->year, 'text' => $event->right_text, 'image' => $event->left_text ? null : $event->image_url];
                }
                if (!$event->left_text && !$event->right_text && $event->image_url) {
                    $timelineItems[] = ['year' => $event->year, 'text' => null, 'image' => $event->image_url];
                }
            }
            $historyYears = collect($timelineItems)->pluck('year')->filter()->unique()->sort()->values();
        @endphp
        

        <div class="flex items-start gap-8">
            <x-timeline-year-nav :years="$historyYears" />
            <div class="flex-1 min-w-0">
                <x-timeline :items="$timelineItems" />
            </div>
        </div>
        <div class="mt-16 pt-14 text-center" data-reveal>
            <p class="text-[#a67c3d] font-semibold text-xs uppercase tracking-[0.2em] mb-3">Present Day</p>
            <h3 class="font-serif text-2xl md:text-3xl font-bold text-[#1d4e7a] mb-4">The Story Continues</h3>
            <p class="text-gray-500 max-w-2xl mx-auto leading-relaxed">
                Today, Krousar Thmey supports <strong class="text-[#1d4e7a]">{{ $settings['stat_children'] ?? '4,079' }} children</strong> across 15 Cambodian provinces — carrying forward the same promise made in 1991: that every child deserves the chance to grow, learn, and thrive.
            </p>
        </div>
    </div>
</section>

{{-- ========================================================
     AWARDS
     ======================================================== --}}
<section id="awards" class="pt-10 pb-20 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
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
            $facebookLink = \App\Models\HomeSetting::getValue('sharing_facebook_link', '');
            $twitterLink = \App\Models\HomeSetting::getValue('sharing_twitter_link', '');
            $linkedinLink = \App\Models\HomeSetting::getValue('sharing_linkedin_link', '');
        @endphp
        <div class="text-center mb-16" data-reveal>
            <h2 class="text-5xl md:text-6xl font-extrabold tracking-tight text-[#0A5EA8]">AWARDS</h2>
            @if($sharingEnabled == '1')
            <div class="flex items-center justify-center gap-3 mt-6">
                <a href="{{ $facebookLink ?: 'https://www.addtoany.com/add_to/facebook?linkurl=' . urlencode(url()->current()) . '&linkname=' . urlencode('Awards') . '&linknote=' . urlencode('Krousar Thmey - Awards') }}"
                   target="_blank" rel="noopener noreferrer" aria-label="Share on Facebook"
                   class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                    <img src="{{ asset($facebookIcon) }}" alt="Facebook" class="w-full h-full object-cover">
                </a>
                <a href="{{ $twitterLink ?: 'https://www.addtoany.com/add_to/twitter?linkurl=' . urlencode(url()->current()) . '&linkname=' . urlencode('Awards') . '&linknote=' . urlencode('Krousar Thmey - Awards') }}"
                   target="_blank" rel="noopener noreferrer" aria-label="Share on Twitter"
                   class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                    <img src="{{ asset($twitterIcon) }}" alt="Twitter" class="w-full h-full object-cover">
                </a>
                <a href="{{ $linkedinLink ?: 'https://www.addtoany.com/add_to/linkedin?linkurl=' . urlencode(url()->current()) . '&linkname=' . urlencode('Awards') . '&linknote=' . urlencode('Krousar Thmey - Awards') }}"
                   target="_blank" rel="noopener noreferrer" aria-label="Share on LinkedIn"
                   class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                    <img src="{{ asset($linkedinIcon) }}" alt="LinkedIn" class="w-full h-full object-cover">
                </a>
                <a href="https://www.addtoany.com/share#url={{ urlencode(url()->current()) }}&title={{ urlencode('Awards') }}"
                   target="_blank" rel="noopener noreferrer" aria-label="Share"
                   class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                    <img src="{{ asset($shareIcon) }}" alt="Share" class="w-full h-full object-cover">
                </a>
            </div>
            @endif
        </div>

        @if($awards->isNotEmpty())
        @php
            $awardItems = $awards->map(function ($award) {
                $cta = null;
                $link = null;
                if ($award->website_url) {
                    $cta = 'Visit Website';
                    $link = $award->website_url;
                } elseif ($award->article_url) {
                    $cta = 'Read Article';
                    $link = $award->article_url;
                } elseif ($award->video_url) {
                    $cta = 'Watch Video';
                    $link = $award->video_url;
                }
                return [
                    'year' => $award->year,
                    'image' => $award->image_url,
                    'title' => $award->organization ? trim($award->organization) : $award->title,
                    'description' => trim(($award->recipient ? $award->recipient . ' ' : '') . ($award->description ?? '')),
                    'buttonText' => $cta,
                    'buttonLink' => $link,
                ];
            });
        @endphp
        <x-award-grid :items="$awardItems" />
        @else
        <p class="text-gray-400 text-center py-8">No awards listed yet.</p>
        @endif
    </div>
</section>

{{-- ========================================================
     PARTNERS
     ======================================================== --}}
<section id="partners" class="py-20 bg-[#f8f9fc] scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12" data-reveal>
            <p class="text-[#8da83a] font-bold text-sm uppercase tracking-widest mb-3">Support</p>
            <h2 class="text-4xl font-bold text-[#2d6fa3]">Partners</h2>
            <p class="text-gray-500 mt-4 max-w-3xl mx-auto text-sm leading-relaxed">
                Since its creation, Krousar Thmey has set up long-term partnerships with Cambodian and international organizations. Donors can financially support a program or project of their choice. Technical partners allow us to benefit from specific expertise.
            </p>
            <a href="{{ route('partners') }}" class="inline-flex items-center mt-6 px-5 py-2.5 border border-[#2d6fa3] text-[#2d6fa3] font-semibold text-sm rounded-full hover:bg-[#2d6fa3] hover:text-white transition-colors">
                See all partners
            </a>
        </div>

        <div class="bg-white rounded-3xl p-8 lg:p-10 border border-gray-100 shadow-sm mb-8">
            <h3 class="text-xl font-bold text-[#2d6fa3] mb-4 flex items-center gap-3">
                <span class="text-2xl">🇰🇭</span> Partnerships with the Cambodian Authorities
            </h3>
            <p class="text-gray-500 text-sm leading-relaxed mb-6">
                Krousar Thmey constantly seeks to develop and maintain lasting relations with the Cambodian authorities. «&nbsp;Memorandums of understanding&nbsp;» are regularly renewed between Krousar Thmey and governing authorities:
            </p>
            <div class="grid md:grid-cols-3 gap-4 mb-6">
                @foreach([
                    ['ministry'=>'Ministry of Education, Youth and Sport','prog'=>'Education for Deaf or Blind Children Program'],
                    ['ministry'=>'Ministry of Social Affairs',            'prog'=>'Child Welfare Program'],
                    ['ministry'=>'Ministry of Culture and Fine Arts',     'prog'=>'Cultural and Artistic Development Program'],
                ] as $mou)
                <div class="bg-[#2d6fa3]/5 border border-[#2d6fa3]/15 rounded-xl p-5">
                    <p class="text-[#2d6fa3] font-bold text-sm mb-1">{{ $mou['ministry'] }}</p>
                    <p class="text-gray-500 text-xs">{{ $mou['prog'] }}</p>
                </div>
                @endforeach
            </div>
            <div class="bg-[#8da83a]/10 border border-[#8da83a]/20 rounded-xl p-4 text-sm text-gray-600">
                Whether for an inauguration or to show their support, H.M. the King, the Prime Minister and his wife, as well as members of the royal family, regularly visit Krousar Thmey's structures. From 2020 onwards, Krousar Thmey works collaboratively with the Ministry of Education, Youth and Sport on the Education for Deaf or Blind Children Program.
            </div>
        </div>

        @php
            $financialPartnerGroups = [
                [
                    'title' => 'Cambodian Public Authorities',
                    'dot' => 'bg-[#2d6fa3]',
                    'items' => [
                        'His Majesty the King NORODOM Sihamoni',
                        'Her Majesty the Queen Mother NORODOM Monineath Sihanouk',
                        'Prime Minister Samdech Moha Borvor Thipadei HUN Manet',
                        'Samdech Akka Moha Sena Padei Techo Hun Sen, President of the Senate',
                        'Samdech Dr. Bun Rany HUN Sen',
                        'The Royal Government of Cambodia',
                        'Ministry of Social Affairs',
                        'Ministry of Education, Youth and Sport',
                        'Ministry of Culture and Fine Arts',
                        'Ministry of Defense',
                        'Ministry of Information',
                        'Ministry of Interior',
                        'His Excellency the ambassador for Cambodia at UNESCO',
                        'His Excellency the ambassador for Cambodia to France',
                    ],
                ],
                [
                    'title' => 'Organizations, Foundations and Institutions',
                    'dot' => 'bg-[#8da83a]',
                    'items' => [
                        'DUBRULLE Family',
                        'ENFANCE ESPOIR Foundation',
                        'Fondation Amanjaya',
                        'Fondation André & Cyprien',
                        'Fondation Masalina',
                        'Fonds Mécénat SIG',
                        'Foundation Philantropique Famille Sandoz',
                        'Gertrude Hirzel Foundation',
                        'GREEN LEAVES EDUCATION Foundation',
                        'Individual donor: Peter Tschofen',
                        'Individual donor: Suzanne ROY, Grants Barbe.',
                        'INTERNATIONAL COUNCIL FOR EDUCATION OF PEOPLE WITH VISUAL IMPAIRMENT (ICEVI)',
                        "LA VOIX DE L'ENFANT Association",
                        'LES AMIS DES ENFANTS DU MONDE Association',
                        'MAY-OUI Foundation',
                        'Miwako Fujiwara – Musica Felice Foundation',
                        'Musica Felice',
                        'OVERBROOK SCHOOL FOR THE BLIND (ONNET)',
                        "PEOPLE'S ACTION FOR INCLUSIVE DEVELOPMENT (PAfID)",
                        'Raksa Koma Organization',
                        'ROTARY CLUB OF PERTH',
                        'ROTARY CLUB OF PHNOM PENH',
                        'STIFTUNG HIRTEN KINDER Foundation',
                        'TALIKA',
                        'UNICEF',
                    ],
                ],
                [
                    'title' => 'Companies',
                    'dot' => 'bg-[#1d4e7a]',
                    'items' => [
                        'ABA BANK',
                        'AMANJAYA HOTEL',
                        'ANGKOR ARTWORK (Eric STOCKER)',
                        'BAJAJ INTRACITY',
                        'BRED BANK CAMBODIA',
                        'BLIND MASSAGE CENTER',
                        'BODIA NATURE',
                        'CAMH Co. LTD',
                        'CMDK',
                        'D+Z URBAN HOTEL',
                        'KHMER CERAMICS & FINE ARTS CENTER',
                        'LONG RA Car mechanic',
                        'PROMOTION FOR DISABILITY PROJECT',
                        'PUNLEU THMEY Restaurant',
                        'RADIO HAPPINESS VOICE FOR THE BLIND',
                        'SAN FRANSISCO COMPANY',
                        'SEIN LIM',
                        'SENG POV Car mechanic',
                        'SMART Cambodia',
                        'SOCIAL COFFEE',
                        'SOFITEL Phnom Penh Phokeethra',
                        'SOFT SKILL PROFESSIONAL TRAINING SERVICE',
                        'TEMPLATION ANGKOR BOUTIQUE',
                        'THALIAS (Malis Restaurant, Khema, Arunreas Hotel)',
                        'TOP STREET RESTAURANT',
                        'VOICE OF THE BLIND Radio station',
                    ],
                ],
                [
                    'title' => 'Towns and Municipalities',
                    'dot' => 'bg-[#2d6fa3]',
                    'flag' => '🇨🇭',
                    'items' => [
                        'City of Geneva',
                        'City of Meyrin',
                        'Town of Hermance',
                        'Towns of Collonge-Bellerive, Hermance and Vandoeuvres',
                    ],
                ],
            ];
        @endphp

        @foreach ($financialPartnerGroups as $group)
        <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm mb-8">
            <h3 class="text-lg font-bold text-[#2d6fa3] mb-6 flex items-center gap-2">
                @if (isset($group['flag']))
                    <span>{{ $group['flag'] }}</span>
                @endif
                {{ $group['title'] }}
            </h3>
            <ul class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-2 text-sm text-gray-600">
                @foreach ($group['items'] as $item)
                <li class="flex items-start gap-2">
                    <span class="w-1.5 h-1.5 rounded-full {{ $group['dot'] }} mt-2 flex-shrink-0"></span>
                    {{ $item }}
                </li>
                @endforeach
            </ul>
        </div>
        @endforeach

        <div class="text-center bg-[#2d6fa3] rounded-3xl p-10" data-reveal="scale">
            <p class="text-white/80 text-lg mb-2">Many thanks to all our partners for their support!</p>
            <h3 class="text-white font-bold text-2xl mb-6">Do you wish to get involved with Krousar Thmey?</h3>
            <a href="{{ route('involved') }}" class="btn-primary text-base">Learn More</a>
        </div>
    </div>
</section>

{{-- ========================================================
     TRANSPARENCY AND ACCOUNTABILITY
     ======================================================== --}}
<section id="transparency" class="py-20 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16" data-reveal>
            <p class="text-[#8da83a] font-bold text-sm uppercase tracking-widest mb-3">Accountability</p>
            <h2 class="text-4xl font-bold text-[#2d6fa3]">Transparency & Accountability</h2>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 mb-16">

            <div data-reveal="left">
                <h3 class="text-2xl font-bold text-[#2d6fa3] mb-5 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#2d6fa3] flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M9 14h.01M12 14h.01M15 14h.01M3 6a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V6z"/></svg>
                    </div>
                    Financial Transparency
                </h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Financial transparency is a key principle for Krousar Thmey. Everybody has the right to know how the funds raised are used. The implementation of programs and projects is our priority.
                </p>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Thanks to strict financial management and the involvement of European volunteers, <strong class="text-[#2d6fa3]">all administrative costs remain under 4% of the total budget.</strong>
                </p>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Krousar Thmey Cambodia's accounts are all audited and certified each year by an independent audit firm (<strong>PricewaterhouseCoopers since 2013</strong> and KPMG before then). Working closely with the auditors, Krousar Thmey is committed to constantly improving the quality and precision of its financial processes.
                </p>
                <div class="grid grid-cols-2 gap-4">
                    @foreach([
                        ['v'=>'< 4%',   'l'=>'Administrative costs'],
                        ['v'=>'100%',   'l'=>'Funds reach the children'],
                        ['v'=>'Annual', 'l'=>'Independent audit (PwC)'],
                        ['v'=>'2013',   'l'=>'PricewaterhouseCoopers since'],
                    ] as $fig)
                    <div class="bg-[#f8f9fc] rounded-2xl p-5 border border-gray-100">
                        <div class="text-2xl font-black text-[#2d6fa3] mb-1">{{ $fig['v'] }}</div>
                        <div class="text-gray-500 text-xs">{{ $fig['l'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div data-reveal="right">
                <h3 class="text-2xl font-bold text-[#2d6fa3] mb-5 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#8da83a] flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    Audited Financial Statements
                </h3>
                <p class="text-gray-500 text-sm mb-6">Audited statements are available for download. Our French and Swiss organisations' accounts are also audited annually.</p>
                <div class="space-y-3">
                    @forelse($reports as $report)
                    <a href="{{ $report->download_url }}"
                       {{ $report->download_url !== '#' ? 'target="_blank"' : '' }}
                       class="flex items-center justify-between bg-[#f8f9fc] border border-gray-100 rounded-xl px-5 py-4 hover:border-[#2d6fa3]/30 hover:shadow-sm transition-all group">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-[#2d6fa3] flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <span class="text-gray-700 font-medium text-sm">{{ $report->title }}</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-300 group-hover:text-[#2d6fa3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    </a>
                    @empty
                    <p class="text-gray-400 text-sm">No reports available yet. <a href="{{ route('resources') }}" class="text-[#2d6fa3] hover:underline">View resources page</a>.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="bg-[#f8f9fc] rounded-3xl p-8 lg:p-10 border border-gray-100" data-reveal>
            <h3 class="text-2xl font-bold text-[#2d6fa3] mb-5 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#1d4e7a] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                </div>
                Origins of the Funds
            </h3>
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <p class="text-gray-600 leading-relaxed mb-4 text-sm">
                        In support of its local activity in Cambodia, Krousar Thmey benefits from the involvement of volunteers in international entities: Krousar Thmey France, Krousar Thmey Switzerland and Krousar Thmey Singapore. As their main activity is fundraising, these branches are a privileged relay to donors outside of Cambodia.
                    </p>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Donations received in Cambodia come mainly from non-governmental organizations and to a lesser extent from private donors and the Cambodian authorities.
                    </p>
                </div>
                <div>
                    <p class="text-gray-600 leading-relaxed mb-4 text-sm">
                        Financial or in-kind donations from the Cambodian authorities have increased steadily over the past few years, accounting for nearly <strong class="text-[#2d6fa3]">8% of Krousar Thmey's resources</strong>. All staff of special schools for deaf or blind children are civil servants of the Ministry of Education, Youth and Sports.
                    </p>
                    <div class="bg-[#8da83a]/10 border border-[#8da83a]/20 rounded-xl p-4 text-sm text-gray-600">
                        🏆 Krousar Thmey won the label <strong>Ideas</strong> in 2010 — recognising organisations committed to social innovation and impact.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
