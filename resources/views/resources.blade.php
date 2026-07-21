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
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Accountability</span>
            <h2 class="section-title mt-3 mb-3">Annual Reports</h2>
            <p class="text-gray-500">Full reports on our programs, financials, and impact — published every year since 1991.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($reports as $report)
                <div class="bg-[#f8f9fc] rounded-2xl p-7 border border-gray-100 hover:shadow-md transition-shadow group flex flex-col gap-5">
                    <div class="flex items-center gap-5">
                        <div class="w-14 h-14 rounded-xl bg-[#1a3c6e] flex items-center justify-center flex-shrink-0">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div class="flex-1">
                            <div class="font-bold text-[#1a3c6e]">{{ $report->title }}</div>
                            <div class="text-gray-400 text-xs mt-0.5">{{ $report->year }} · PDF Report</div>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        @if ($report->has_pdf_file)
                            <a href="{{ route('reports.view', $report) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center rounded-lg border border-[#1a3c6e] px-3 py-2 text-sm font-semibold text-[#1a3c6e] hover:bg-[#1a3c6e] hover:text-white transition-colors">
                                View PDF
                            </a>
                            <a href="{{ route('reports.download', $report) }}" class="inline-flex items-center justify-center rounded-lg bg-[#e8a020] px-3 py-2 text-sm font-semibold text-white hover:bg-[#c7830d] transition-colors">
                                Download PDF
                            </a>
                        @else
                            <p class="text-sm text-gray-500">No PDF file available.</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="md:col-span-2 lg:col-span-3 rounded-2xl border border-dashed border-gray-200 bg-gray-50 p-8 text-center text-gray-500">
                    No annual reports are available yet.
                </div>
            @endforelse
        </div>
    </div>
</section>

{{-- MEDIA SECTION — from admin Media Gallery --}}
<section class="py-20 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-6">

        @php
            $mediaContactEmail = \App\Models\HomeSetting::getValue('media_contact_email', 'communication@krousar-thmey.org');

            // Sharing settings (same system as Awards/History sections)
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
            <h2 class="text-5xl md:text-6xl font-extrabold tracking-tight text-[#0A5EA8]">MEDIA RESOURCES</h2>

            {{-- Sharing icons (same style as Awards/History) --}}
            @if($sharingEnabled == '1')
            <div class="flex items-center justify-center gap-3 mt-6">
                <a href="{{ $facebookLink ?: 'https://www.addtoany.com/add_to/facebook?linkurl=' . urlencode(url()->current()) . '&linkname=' . urlencode('Media Resources') . '&linknote=' . urlencode('Krousar Thmey - Media Resources') }}"
                   target="_blank" rel="noopener noreferrer" aria-label="Share on Facebook"
                   class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                    <img src="{{ asset($facebookIcon) }}" alt="Facebook" class="w-full h-full object-cover">
                </a>
                <a href="{{ $twitterLink ?: 'https://www.addtoany.com/add_to/twitter?linkurl=' . urlencode(url()->current()) . '&linkname=' . urlencode('Media Resources') . '&linknote=' . urlencode('Krousar Thmey - Media Resources') }}"
                   target="_blank" rel="noopener noreferrer" aria-label="Share on Twitter"
                   class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                    <img src="{{ asset($twitterIcon) }}" alt="Twitter" class="w-full h-full object-cover">
                </a>
                <a href="{{ $linkedinLink ?: 'https://www.addtoany.com/add_to/linkedin?linkurl=' . urlencode(url()->current()) . '&linkname=' . urlencode('Media Resources') . '&linknote=' . urlencode('Krousar Thmey - Media Resources') }}"
                   target="_blank" rel="noopener noreferrer" aria-label="Share on LinkedIn"
                   class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                    <img src="{{ asset($linkedinIcon) }}" alt="LinkedIn" class="w-full h-full object-cover">
                </a>
                <a href="https://www.addtoany.com/share#url={{ urlencode(url()->current()) }}&title={{ urlencode('Media Resources') }}"
                   target="_blank" rel="noopener noreferrer" aria-label="Share"
                   class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                    <img src="{{ asset($shareIcon) }}" alt="Share" class="w-full h-full object-cover">
                </a>
            </div>
            @endif

            <p class="text-gray-600 text-sm max-w-2xl mx-auto leading-relaxed mt-6">
                For any request, please contact our Communication Officer at
                <a href="mailto:{{ $mediaContactEmail }}" class="text-[#0A5EA8] font-semibold hover:underline">{{ $mediaContactEmail }}</a>
            </p>
        </div>

        {{-- Featured Media Item --}}
        @if($featuredMedia)
        <div class="mb-20">
            <h3 class="text-[#1a4fa0] font-bold text-sm uppercase tracking-[0.15em] mb-8">Krousar Thmey In The News</h3>

            <div class="bg-white border border-gray-200 overflow-hidden">
                <div class="grid md:grid-cols-2 gap-0">

                    <div class="relative h-72 md:h-full min-h-[360px] overflow-hidden bg-gray-100">
                        <img src="{{ $featuredMedia->image_url }}"
                             alt="{{ $featuredMedia->title }}"
                             class="absolute inset-0 w-full h-full object-cover">
                        @if($featuredMedia->caption)
                        <div class="absolute bottom-0 left-0 right-0 bg-black/70 text-white text-xs px-4 py-2.5 leading-relaxed">
                            {{ $featuredMedia->caption }}
                        </div>
                        @endif
                    </div>

                    <div class="p-8 lg:p-10 xl:p-12 flex flex-col justify-center">
                        @if($featuredMedia->source)
                        <div class="text-[#1a4fa0] text-xs font-bold uppercase tracking-[0.12em] mb-5">
                            {{ strtoupper($featuredMedia->source) }}
                        </div>
                        @endif

                        <h4 class="text-2xl lg:text-3xl font-bold text-[#1a4fa0] leading-tight mb-4">
                            &ldquo;{{ $featuredMedia->title }}&rdquo;
                        </h4>

                        <p class="text-gray-500 italic text-sm mb-6">
                            published {{ $featuredMedia->published_at?->format('m.d.y') ?? $featuredMedia->created_at->format('m.d.y') }}
                        </p>

                        <hr class="border-gray-200 mb-6">

                        <p class="text-gray-600 italic leading-relaxed mb-8 line-clamp-4">
                            {{ $featuredMedia->description ?? 'No description available.' }}
                        </p>

                        @if($featuredMedia->external_link)
                        <a href="{{ $featuredMedia->external_link }}" target="_blank" rel="noopener noreferrer"
                           class="inline-flex items-center justify-center px-6 py-3 bg-[#1a4fa0] hover:bg-[#0e3470] text-white text-sm font-semibold transition-colors w-fit">
                            Read the article
                        </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        @endif

        {{-- Media Items Grid --}}
        @if($mediaItems->isNotEmpty())
        <div>
            <h3 class="text-[#1a4fa0] font-bold text-sm uppercase tracking-[0.15em] mb-2">Media Coverage</h3>
            <p class="text-gray-500 text-sm mb-8">
                Browse more articles and media coverage of Krousar Thmey's work.
            </p>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($mediaItems as $item)
                <article class="border border-gray-200 bg-white flex flex-col group hover:shadow-lg transition-shadow duration-300">
                    @if($item->image)
                    <div class="relative h-48 overflow-hidden bg-gray-100">
                        <img src="{{ $item->image_url }}"
                             alt="{{ $item->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    @else
                    <div class="h-48 bg-gray-100 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @endif

                    <div class="p-6 flex flex-col flex-1">
                        @if($item->source)
                        <div class="text-xs text-[#1a4fa0] font-bold uppercase tracking-wide mb-2">
                            {{ $item->source }}
                        </div>
                        @endif

                        <h4 class="font-bold text-[#1a4fa0] text-base leading-snug mb-3 line-clamp-2">
                            {{ $item->title }}
                        </h4>

                        <div class="text-gray-500 text-xs mb-3">
                            {{ $item->published_at?->format('M j, Y') ?? $item->created_at->format('M j, Y') }}
                            @if($item->category)
                            <span class="text-gray-300 mx-1.5">|</span>
                            {{ $item->category }}
                            @endif
                        </div>

                        <p class="text-gray-700 text-sm leading-relaxed flex-1 line-clamp-3 mb-4">
                            {{ $item->description ?? '' }}
                        </p>

                        @if($item->external_link)
                        <a href="{{ $item->external_link }}" target="_blank" rel="noopener noreferrer"
                           class="text-[#1a4fa0] font-semibold text-sm hover:underline inline-flex items-center gap-1">
                            read more
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        @endif
                    </div>
                </article>
                @endforeach
            </div>
        </div>
        @endif

        @if(!$featuredMedia && $mediaItems->isEmpty())
        <div class="text-center py-16">
            <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-5">
                <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-400 mb-2">No media items yet</h3>
            <p class="text-gray-400 text-sm max-w-md mx-auto">Check back soon for press articles and media coverage.</p>
        </div>
        @endif

    </div>
</section>

@endsection
