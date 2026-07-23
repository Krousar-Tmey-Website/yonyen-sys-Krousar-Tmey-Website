@extends('layouts.app')

@section('title', 'Who We Are — Krousar Thmey')
@section('description', 'Krousar Thmey is the first Cambodian organization helping disadvantaged children, born in 1991 in the Site II refugee camp in Thailand.')

@section('content')

@php
$heroImage = $settings['history_banner_image'] ?? null;
$heroImageUrl = $heroImage ? (str_starts_with($heroImage, 'http') ? $heroImage : asset('storage/' . $heroImage)) : asset('images/children.jpg');
$heroTitle = $settings['history_banner_title'] ?? 'Help a Child Build Their Future';
$heroSubtitle = $settings['history_banner_subtitle'] ?? 'Discover the inspiring journey of Krousar Thmey, from our humble beginnings in 1991 to our ongoing mission supporting children across Cambodia.';
$heroBadge = $settings['history_banner_badge'] ?? 'Our History';
$heroOverlayColor = $settings['history_banner_overlay_color'] ?? '#1a3c6e';
@endphp

{{-- ========================================================
     HERO BACKGROUND IMAGE
     ======================================================== --}}
<section class="relative py-24 overflow-hidden" data-reveal="scale">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $heroImageUrl }}');"></div>
    <div class="absolute inset-0" style="background-color: {{ $heroOverlayColor }}; opacity: 0.55;"></div>
    <div class="relative z-10 max-w-3xl mx-auto px-6 text-center">
        <span class="inline-block bg-white text-[#eea91d] text-xs font-semibold px-4 py-1.5 rounded-full mb-6 uppercase tracking-wider">{{ $heroBadge }}</span>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6 drop-shadow-lg">
            {{ $heroTitle }}
        </h2>
        <p class="text-white/90 text-lg leading-relaxed mb-10 drop-shadow-md">
            {{ $heroSubtitle }}
        </p>
        <div class="flex flex-col sm:flex-row flex-wrap gap-6 justify-center">
            <a href="{{ route('donate') }}" class="btn-primary text-base btn-micro">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                Donate Now
            </a>
            <a href="{{ route('involved') }}" class="btn-outline text-base btn-micro">Get Involved</a>
            <a href="{{ route('resources') }}#annual-reports" class="btn-outline text-base btn-micro">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Annual Report
            </a>
        </div>
    </div>
</section>

{{-- ========================================================
     OUR HISTORY
     ======================================================== --}}
<section id="history" class="pt-20 md:pt-28 pb-24 bg-white scroll-mt-20">
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
            $historyFacebookLink = \App\Models\HomeSetting::getValue('social_facebook', '');
            $historyLinkedinLink = \App\Models\HomeSetting::getValue('social_linkedin', '');
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
                <a href="https://www.addtoany.com/add_to/twitter?linkurl={{ urlencode(url()->current()) }}&linkname={{ urlencode('Our History') }}&linknote={{ urlencode('Krousar Thmey - Our History') }}"
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

            // Some history rows were entered more than once (e.g. once with a photo,
            // once without). Merge entries that share the same year and the same text
            // so the timeline doesn't show the same moment twice.
            $deduped = [];
            foreach ($timelineItems as $entry) {
                $normalizedText = $entry['text'] ? strtolower(trim(strip_tags($entry['text']))) : null;
                $key = $entry['year'] . '|' . ($normalizedText ?? 'img:' . $entry['image']);
                if (isset($deduped[$key])) {
                    $deduped[$key]['image'] = $deduped[$key]['image'] ?: $entry['image'];
                } else {
                    $deduped[$key] = $entry;
                }
            }

            $timelineItems = collect($deduped)->sortBy('year')->values()->all();
        @endphp

        <x-timeline-horizontal :items="$timelineItems" />
        <div class="mt-10 pt-0 text-center" data-reveal>
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
<section id="awards" class="pt-10 pb-20 bg-[#f8f9fc] scroll-mt-20">
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
            $facebookLink = \App\Models\HomeSetting::getValue('social_facebook', '');
            $linkedinLink = \App\Models\HomeSetting::getValue('social_linkedin', '');
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
                <a href="https://www.addtoany.com/add_to/twitter?linkurl={{ urlencode(url()->current()) }}&linkname={{ urlencode('Awards') }}&linknote={{ urlencode('Krousar Thmey - Awards') }}"
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
<div class="kt-partners bg-white">

    {{-- ========================================================
         PAGE HEADER
         ======================================================== --}}
    <div class="text-center py-14 md:py-16" data-reveal>
        <div class="max-w-4xl mx-auto px-5 md:px-8">
            {{-- Decorative top ornament --}}
            <div class="flex items-center justify-center gap-3 mb-6">
                <span class="w-8 h-px bg-[#8da83a]/40"></span>
                <span class="w-2 h-2 rounded-full bg-[#8da83a]/60"></span>
                <span class="w-8 h-px bg-[#8da83a]/40"></span>
            </div>
            
            <h1 class="text-5xl md:text-6xl font-extrabold tracking-tight text-[#0A5EA8]">PARTNERS</h1>
            
            {{-- Decorative underline --}}
            <div class="flex items-center justify-center gap-2 mt-5 mb-8">
                <span class="w-12 h-0.5 bg-[#0A5EA8]/30 rounded-full"></span>
                <span class="w-16 h-0.5 bg-[#8da83a] rounded-full"></span>
                <span class="w-12 h-0.5 bg-[#0A5EA8]/30 rounded-full"></span>
            </div>
            
            {{-- Sharing icons --}}
            <div class="flex items-center justify-center gap-2">
                <span class="text-xs text-gray-400 uppercase tracking-widest mr-2">Share</span>
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.krousar-thmey.org/partners/" target="_blank" rel="noopener"
                   class="w-9 h-9 rounded-full flex items-center justify-center text-white transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md"
                   style="background-color:#1877f2;">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="https://twitter.com/intent/tweet?url=https://www.krousar-thmey.org/partners/" target="_blank" rel="noopener"
                   class="w-9 h-9 rounded-full flex items-center justify-center text-white transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md"
                   style="background-color:#1da1f2;">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                <a href="https://www.linkedin.com/shareArticle?mini=true&url=https://www.krousar-thmey.org/partners/" target="_blank" rel="noopener"
                   class="w-9 h-9 rounded-full flex items-center justify-center text-white transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md"
                   style="background-color:#0a66c2;">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
                <a href="#"
                   class="w-9 h-9 rounded-full flex items-center justify-center text-white transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md"
                   style="background-color:#11568c;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/></svg>
                </a>
            </div>
        </div>
    </div>

    {{-- Divider between header and first section --}}
    <div class="h-px bg-gradient-to-r from-transparent via-gray-200 to-transparent max-w-4xl mx-auto"></div>

    {{-- ========================================================
         PARTNERSHIPS AROUND THE WORLD
         ======================================================== --}}
    <section id="partners" class="py-16 md:py-20 relative scroll-mt-20">
        {{-- Decorative background accent --}}
        <div class="absolute inset-0 bg-[#f8f9fc]/60 pointer-events-none"></div>
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#8da83a]/30 to-transparent"></div>
        
        <div class="relative max-w-4xl mx-auto px-5 md:px-8" data-reveal>
            {{-- Section header --}}
            <div class="flex items-center justify-center gap-3 mb-6">
                <span class="w-8 h-px bg-[#8da83a]/40"></span>
                <span class="w-2 h-2 rounded-full bg-[#8da83a]/60"></span>
                <span class="w-8 h-px bg-[#8da83a]/40"></span>
            </div>
            
            <h2 class="text-center text-3xl md:text-4xl font-extrabold tracking-tight text-[#0A5EA8] mb-3">Partnerships Around The World</h2>
            
            <div class="flex items-center justify-center gap-2 mb-10">
                <span class="w-10 h-0.5 bg-[#0A5EA8]/30 rounded-full"></span>
                <span class="w-4 h-0.5 bg-[#8da83a] rounded-full"></span>
                <span class="w-10 h-0.5 bg-[#0A5EA8]/30 rounded-full"></span>
            </div>
            
            {{-- Intro text --}}
            <p class="text-center text-gray-600 text-base md:text-lg leading-relaxed max-w-3xl mx-auto mb-12">
                Since its creation, Krousar Thmey has set up long-term partnerships with Cambodian and international organizations.
            </p>
            
            {{-- Partner type cards --}}
            <div class="grid md:grid-cols-3 gap-6 mb-12">
                {{-- Financial Support --}}
                <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-11 h-11 rounded-xl bg-[#2d6fa3]/10 flex items-center justify-center mb-4 group-hover:bg-[#2d6fa3] transition-colors duration-300">
                        <svg class="w-5 h-5 text-[#2d6fa3] group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-[#1d4e7a] text-base mb-2">Financial Support</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Donors can financially support a program or project of their choice.</p>
                </div>
                
                {{-- Technical Expertise --}}
                <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-11 h-11 rounded-xl bg-[#8da83a]/10 flex items-center justify-center mb-4 group-hover:bg-[#8da83a] transition-colors duration-300">
                        <svg class="w-5 h-5 text-[#8da83a] group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-[#1d4e7a] text-base mb-2">Technical Expertise</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Technical partners allow us to benefit from specific expertise that Krousar Thmey does not have. Krousar Thmey always ensures that the projects implemented include a transfer of skills to the staff of the Foundation.</p>
                </div>
                
                {{-- Career Counseling --}}
                <div class="bg-white rounded-xl border border-gray-100 p-6 shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-11 h-11 rounded-xl bg-[#a67c3d]/10 flex items-center justify-center mb-4 group-hover:bg-[#a67c3d] transition-colors duration-300">
                        <svg class="w-5 h-5 text-[#a67c3d] group-hover:text-white transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-[#1d4e7a] text-base mb-2">Academic &amp; Career Guidance</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Organizations, universities, institutions help Krousar Thmey&rsquo;s Academic and Career Counseling Project support young people in finding their path.</p>
                </div>
            </div>
            
            {{-- CTA --}}
            <div class="text-center">
                <a href="#financial-partners" 
                   class="inline-flex items-center gap-2 px-7 py-3.5 bg-[#2d6fa3] text-white font-semibold rounded-full shadow-md hover:bg-[#3a82bb] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                    See All Partners
                </a>
            </div>
        </div>
    </section>

    {{-- ========================================================
         PARTNERSHIPS WITH THE CAMBODIAN AUTHORITIES
         ======================================================== --}}
    <section class="py-16 md:py-20 relative">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#8da83a]/30 to-transparent"></div>
        
        <div class="relative max-w-4xl mx-auto px-5 md:px-8" data-reveal>
            {{-- Section header --}}
            <div class="flex items-center justify-center gap-3 mb-6">
                <span class="w-8 h-px bg-[#8da83a]/40"></span>
                <span class="w-2 h-2 rounded-full bg-[#8da83a]/60"></span>
                <span class="w-8 h-px bg-[#8da83a]/40"></span>
            </div>
            
            <h2 class="text-center text-3xl md:text-4xl font-extrabold tracking-tight text-[#0A5EA8] mb-3">Partnerships With The Cambodian Authorities</h2>
            
            <div class="flex items-center justify-center gap-2 mb-10">
                <span class="w-10 h-0.5 bg-[#0A5EA8]/30 rounded-full"></span>
                <span class="w-4 h-0.5 bg-[#8da83a] rounded-full"></span>
                <span class="w-10 h-0.5 bg-[#0A5EA8]/30 rounded-full"></span>
            </div>
            
            {{-- Intro paragraph --}}
            <p class="text-center text-gray-600 text-base md:text-lg leading-relaxed max-w-3xl mx-auto mb-10">
                Krousar Thmey constantly seeks to develop and maintain lasting relations with the Cambodian authorities. In addition to greater recognition, it brings us legitimacy, notoriety to the Cambodian population as well as financial contributions.
            </p>
            
            {{-- MoU box --}}
            <div class="bg-[#f8f9fc] rounded-2xl border border-gray-100 p-8 mb-10">
                <div class="flex items-center gap-3 mb-5">
                    <div class="w-10 h-10 rounded-xl bg-[#1d4e7a] flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <p class="text-[#1d4e7a] font-semibold text-sm">Memorandums of Understanding</p>
                </div>
                <p class="text-gray-500 text-sm mb-5">
                    &laquo;&nbsp;Memorandums of understanding&nbsp;&raquo; are regularly renewed between Krousar Thmey and governing authorities:
                </p>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3 text-gray-600 text-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#8da83a] mt-2 shrink-0"></span>
                        <span>the Ministry of Education, Youth and Sport regarding the Education for Deaf or Blind Children Program</span>
                    </li>
                    <li class="flex items-start gap-3 text-gray-600 text-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#8da83a] mt-2 shrink-0"></span>
                        <span>the Ministry of Social Affairs regarding the Child Welfare Program</span>
                    </li>
                    <li class="flex items-start gap-3 text-gray-600 text-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#8da83a] mt-2 shrink-0"></span>
                        <span>the Ministry of Culture and Fine Arts regarding the Cultural and Artistic Development Program</span>
                    </li>
                </ul>
            </div>
            
            {{-- Royal support --}}
            <p class="text-center text-gray-500 text-sm leading-relaxed max-w-2xl mx-auto mb-10 italic">
                Whether for an inauguration or to show their support, H.M. the King, the Prime Minister and his wife, as well as members of the royal family, regularly visit Krousar Thmey&rsquo;s structures.
            </p>
            
            {{-- Image + CTA row --}}
            <div class="flex flex-col md:flex-row items-center gap-8 bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">
                <div class="shrink-0">
                    <div class="w-28 h-28 rounded-2xl bg-[#f8f9fc] border border-gray-100 flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('images/partners/university.png') }}" alt="" class="w-20 h-20 object-contain">
                    </div>
                </div>
                <div class="flex-1 text-center md:text-left">
                    <p class="text-gray-600 text-sm leading-relaxed mb-5">
                        From 2020 onwards, Krousar Thmey will work collaboratively with the Ministry of Education, Youth and Sport on the Education for Deaf or Blind Children Program.
                    </p>
                    <a href="{{ $transferProgramItem ? route('program-page-items.show', $transferProgramItem->id) : route('programs.show', 'special-education') }}"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-[#2d6fa3] text-white font-semibold rounded-full shadow-md hover:bg-[#3a82bb] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                        Know More
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================================
         THANKS BANNER / GET INVOLVED
         ======================================================== --}}
    <section class="py-16 md:py-20 bg-[#f8f9fc]/60" data-reveal>
        <div class="max-w-5xl mx-auto px-5 md:px-8">
            <h2 class="text-center text-2xl md:text-3xl font-bold text-[#1d4e7a] mb-10">
                Many thanks to all our partners for their support!
            </h2>
            
            <div class="grid md:grid-cols-3 rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                {{-- Left image --}}
                <div class="aspect-[4/3] md:aspect-auto overflow-hidden bg-gray-100">
                    <img src="{{ asset('images/partners/partner_image1.webp') }}" alt=""
                         class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                </div>
                
                {{-- Center CTA --}}
                <div class="bg-white flex flex-col items-center justify-center text-center px-8 py-10 md:py-12">
                    <div class="w-14 h-14 rounded-full bg-[#11568c]/10 flex items-center justify-center mb-5">
                        <svg class="w-6 h-6 text-[#11568c]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <p class="font-bold text-lg text-[#11568c] mb-4">Do you wish to get involved with Krousar Thmey?</p>
                    <a href="{{ route('involved') }}#partner"
                       class="inline-flex items-center gap-2 px-6 py-3 bg-[#11568c] text-white font-semibold rounded-full hover:bg-[#1d6fa3] hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                        Learn More
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                </div>
                
                {{-- Right image --}}
                <div class="aspect-[4/3] md:aspect-auto overflow-hidden bg-gray-100">
                    <img src="{{ asset('images/partners/partner_image2.webp') }}" alt=""
                         class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                </div>
            </div>
        </div>
    </section>

    {{-- ========================================================
         TECHNICAL PARTNERS
         ======================================================== --}}
    <section class="py-16 md:py-20 relative">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#8da83a]/30 to-transparent"></div>
        
        <div class="relative max-w-4xl mx-auto px-5 md:px-8" data-reveal>
            {{-- Section header --}}
            <div class="flex items-center justify-center gap-3 mb-6">
                <span class="w-8 h-px bg-[#8da83a]/40"></span>
                <span class="w-2 h-2 rounded-full bg-[#8da83a]/60"></span>
                <span class="w-8 h-px bg-[#8da83a]/40"></span>
            </div>
            
            <h2 class="text-center text-3xl md:text-4xl font-extrabold tracking-tight text-[#0A5EA8] mb-3">Technical Partners</h2>
            
            <div class="flex items-center justify-center gap-2 mb-10">
                <span class="w-10 h-0.5 bg-[#0A5EA8]/30 rounded-full"></span>
                <span class="w-4 h-0.5 bg-[#8da83a] rounded-full"></span>
                <span class="w-10 h-0.5 bg-[#0A5EA8]/30 rounded-full"></span>
            </div>
            
            {{-- Logo grid --}}
            <div class="grid grid-cols-2 md:grid-cols-3 gap-5 mb-10">
                @foreach($technicalPartners as $partner)
                    @continue(!$partner->logo_url)
                <div class="bg-white rounded-xl border border-gray-100 p-8 flex items-center justify-center aspect-[3/2] shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all duration-300 group">
                    @if($partner->website_url)
                    <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="w-full h-full flex items-center justify-center" title="{{ $partner->description ?? $partner->name }}">
                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" class="max-h-24 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                    </a>
                    @else
                    <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}" title="{{ $partner->description ?? $partner->name }}" class="max-h-24 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                    @endif
                </div>
                @endforeach
            </div>
            
            {{-- Description --}}
            <p class="text-center text-gray-500 text-sm leading-relaxed max-w-2xl mx-auto">
                Krousar Thmey develops partnerships with other local organizations to give access to the children supported by the Foundation to other activities.
            </p>
        </div>
    </section>

    {{-- ========================================================
         FINANCIAL PARTNERS
         ======================================================== --}}
    <section id="financial-partners" class="py-16 md:py-20 relative">
        <div class="absolute top-0 left-0 right-0 h-px bg-gradient-to-r from-transparent via-[#8da83a]/30 to-transparent"></div>
        
        <div class="relative max-w-4xl mx-auto px-5 md:px-8" data-reveal>
            {{-- Section header --}}
            <div class="flex items-center justify-center gap-3 mb-6">
                <span class="w-8 h-px bg-[#8da83a]/40"></span>
                <span class="w-2 h-2 rounded-full bg-[#8da83a]/60"></span>
                <span class="w-8 h-px bg-[#8da83a]/40"></span>
            </div>
            
            <h2 class="text-center text-3xl md:text-4xl font-extrabold tracking-tight text-[#0A5EA8] mb-3">Financial Partners</h2>
            
            <div class="flex items-center justify-center gap-2 mb-12">
                <span class="w-10 h-0.5 bg-[#0A5EA8]/30 rounded-full"></span>
                <span class="w-4 h-0.5 bg-[#8da83a] rounded-full"></span>
                <span class="w-10 h-0.5 bg-[#0A5EA8]/30 rounded-full"></span>
            </div>

            @php
                $authorityHalves = $financialPartnersBySubcategory->get(\App\Enums\PartnerSubcategory::CambodianPublicAuthorities->value, collect())->split(2);
                $orgHalves = $financialPartnersBySubcategory->get(\App\Enums\PartnerSubcategory::OrganizationsFoundationsInstitutions->value, collect())->split(2);
                $companyHalves = $financialPartnersBySubcategory->get(\App\Enums\PartnerSubcategory::Companies->value, collect())->split(2);
                $towns = $financialPartnersBySubcategory->get(\App\Enums\PartnerSubcategory::TownsAndMunicipalities->value, collect());
            @endphp

            {{-- Cambodian Public Authorities: always visible --}}
            <div class="bg-[#f8f9fc] rounded-2xl border border-gray-100 p-8 mb-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-[#1d4e7a] flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-[#1d4e7a] text-lg">Cambodian Public Authorities</h3>
                </div>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <ul class="space-y-2">
                        @foreach(($authorityHalves[0] ?? []) as $partner)
                        <li class="flex items-start gap-2 text-gray-600 text-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#2d6fa3] mt-2 shrink-0"></span>
                            <span>
                                @if($partner->website_url)
                                <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#2d6fa3] hover:underline">{{ $partner->name }}</a>
                                @else
                                {{ $partner->name }}
                                @endif
                            </span>
                        </li>
                        @endforeach
                    </ul>
                    <ul class="space-y-2">
                        @foreach(($authorityHalves[1] ?? []) as $partner)
                        <li class="flex items-start gap-2 text-gray-600 text-sm">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#2d6fa3] mt-2 shrink-0"></span>
                            <span>
                                @if($partner->website_url)
                                <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#2d6fa3] hover:underline">{{ $partner->name }}</a>
                                @else
                                {{ $partner->name }}
                                @endif
                            </span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Accordion groups using Alpine.js --}}
            <div class="space-y-3" x-data="{ openPanel: null }">
                
                {{-- Organizations, Foundations and Institutions --}}
                <div class="bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm">
                    <button @click="openPanel = openPanel === 'org' ? null : 'org'"
                            class="w-full flex items-center justify-between px-6 py-4 text-left transition-colors hover:bg-[#f8f9fc]">
                        <span class="font-semibold text-[#1d4e7a] text-sm">Organizations, Foundations and Institutions</span>
                        <svg class="w-4 h-4 text-[#8da83a] transition-transform duration-300"
                             :class="openPanel === 'org' ? 'rotate-180' : ''"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openPanel === 'org'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-2"
                         class="border-t border-gray-100">
                        <div class="px-6 py-5">
                            <div class="grid md:grid-cols-2 gap-4">
                                <ul class="space-y-2">
                                    @foreach(($orgHalves[0] ?? []) as $partner)
                                    <li class="flex items-start gap-2 text-gray-600 text-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#8da83a] mt-2 shrink-0"></span>
                                        <span>
                                            @if($partner->website_url)
                                            <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#2d6fa3] hover:underline">{{ $partner->name }}</a>
                                            @else
                                            {{ $partner->name }}
                                            @endif
                                        </span>
                                    </li>
                                    @endforeach
                                </ul>
                                <ul class="space-y-2">
                                    @foreach(($orgHalves[1] ?? []) as $partner)
                                    <li class="flex items-start gap-2 text-gray-600 text-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#8da83a] mt-2 shrink-0"></span>
                                        <span>
                                            @if($partner->website_url)
                                            <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#2d6fa3] hover:underline">{{ $partner->name }}</a>
                                            @else
                                            {{ $partner->name }}
                                            @endif
                                        </span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Companies --}}
                <div class="bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm">
                    <button @click="openPanel = openPanel === 'companies' ? null : 'companies'"
                            class="w-full flex items-center justify-between px-6 py-4 text-left transition-colors hover:bg-[#f8f9fc]">
                        <span class="font-semibold text-[#1d4e7a] text-sm">Companies</span>
                        <svg class="w-4 h-4 text-[#8da83a] transition-transform duration-300"
                             :class="openPanel === 'companies' ? 'rotate-180' : ''"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openPanel === 'companies'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-2"
                         class="border-t border-gray-100">
                        <div class="px-6 py-5">
                            <div class="grid md:grid-cols-2 gap-4">
                                <ul class="space-y-2">
                                    @foreach(($companyHalves[0] ?? []) as $partner)
                                    <li class="flex items-start gap-2 text-gray-600 text-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#2d6fa3] mt-2 shrink-0"></span>
                                        <span>
                                            @if($partner->website_url)
                                            <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#2d6fa3] hover:underline">{{ $partner->name }}</a>
                                            @else
                                            {{ $partner->name }}
                                            @endif
                                        </span>
                                    </li>
                                    @endforeach
                                </ul>
                                <ul class="space-y-2">
                                    @foreach(($companyHalves[1] ?? []) as $partner)
                                    <li class="flex items-start gap-2 text-gray-600 text-sm">
                                        <span class="w-1.5 h-1.5 rounded-full bg-[#2d6fa3] mt-2 shrink-0"></span>
                                        <span>
                                            @if($partner->website_url)
                                            <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#2d6fa3] hover:underline">{{ $partner->name }}</a>
                                            @else
                                            {{ $partner->name }}
                                            @endif
                                        </span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Towns and Municipalities --}}
                <div class="bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm">
                    <button @click="openPanel = openPanel === 'towns' ? null : 'towns'"
                            class="w-full flex items-center justify-between px-6 py-4 text-left transition-colors hover:bg-[#f8f9fc]">
                        <span class="font-semibold text-[#1d4e7a] text-sm">Towns and Municipalities</span>
                        <svg class="w-4 h-4 text-[#8da83a] transition-transform duration-300"
                             :class="openPanel === 'towns' ? 'rotate-180' : ''"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="openPanel === 'towns'"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-2"
                         class="border-t border-gray-100">
                        <div class="px-6 py-5">
                            <ul class="space-y-2 max-w-lg">
                                @foreach($towns as $partner)
                                <li class="flex items-start gap-2 text-gray-600 text-sm">
                                    <span class="w-1.5 h-1.5 rounded-full bg-[#a67c3d] mt-2 shrink-0"></span>
                                    <span>
                                        @if($partner->website_url)
                                        <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer" class="hover:text-[#2d6fa3] hover:underline">{{ $partner->name }}</a>
                                        @else
                                        {{ $partner->name }}
                                        @endif
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

</div>

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
