@extends('layouts.app')

@section('title', 'Media — Krousar Thmey')
@section('description', 'Press coverage and the latest news from Krousar Thmey.')

@section('content')

@php
$t = function (string $key, string $default = '') use ($settings) {
    if (app()->getLocale() === 'fr' && !empty($settings[$key.'_fr'] ?? null)) {
        return $settings[$key.'_fr'];
    }
    return $settings[$key] ?? $default;
};
$heroImage = $settings['media_banner_image'] ?? null;
$heroImageUrl = $heroImage ? (str_starts_with($heroImage, 'http') ? $heroImage : asset('storage/' . $heroImage)) : asset('images/cultural.jpg');
$heroTitle = $settings['media_banner_title'] ?? 'Krousar Thmey In The Media';
$heroSubtitle = $t('media_banner_subtitle', 'Press coverage and the latest news from Krousar Thmey.');
$heroBadge = $settings['media_banner_badge'] ?? 'Media';
$heroOverlayColor = $settings['media_banner_overlay_color'] ?? '#1a3c6e';
@endphp

{{-- ========================================================
     MEDIA BANNER (hero)
     ======================================================== --}}
<section class="relative py-24 overflow-hidden" data-reveal="scale">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $heroImageUrl }}');"></div>
    <div class="absolute inset-0" style="background-color: {{ $heroOverlayColor }}; opacity: 0.55;"></div>
    <div class="relative z-10 max-w-3xl mx-auto px-6 text-center">
        <span class="inline-block bg-white text-[#eea91d] text-xs font-semibold px-4 py-1.5 rounded-full mb-6 uppercase tracking-wider">{{ $heroBadge }}</span>
        <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6 drop-shadow-lg">
            {{ $heroTitle }}
        </h1>
        <div class="rich-text-content text-white/90 text-lg leading-relaxed mb-10 drop-shadow-md">
            {!! $heroSubtitle !!}
        </div>

        @php
            $btn1Text = $settings['media_banner_btn1_text'] ?? 'Donate Now';
            $btn1Url  = $settings['media_banner_btn1_url'] ?? '/donate';
            $btn2Text = $settings['media_banner_btn2_text'] ?? 'Get Involved';
            $btn2Url  = $settings['media_banner_btn2_url'] ?? '/get-involved';
            $btn3Text = $settings['media_banner_btn3_text'] ?? 'Annual Report';
            $btn3Url  = $settings['media_banner_btn3_url'] ?? '/resources#annual-reports';
        @endphp

        @if($btn1Text || $btn2Text || $btn3Text)
        <div class="flex flex-col sm:flex-row flex-wrap items-center justify-center gap-4">
            @if($btn1Text)
            <a href="{{ $btn1Url }}" class="btn-primary text-sm sm:text-base btn-micro inline-flex items-center gap-2 px-6 py-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                {{ $btn1Text }}
            </a>
            @endif
            @if($btn2Text)
            <a href="{{ $btn2Url }}" class="btn-outline text-sm sm:text-base btn-micro inline-flex items-center gap-2 px-6 py-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
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
        @endif
    </div>
</section>

{{-- ========================================================
     PAGE HEADER
     ======================================================== --}}
<section class="pt-20 pb-8 bg-white text-center scroll-mt-20">
<h1 class="py-10 text-5xl md:text-6xl font-extrabold text-[#1F3C6E] uppercase tracking-wide">
  Media Resources
</h1>    <div class="max-w-4xl mx-auto px-6">
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
            <a href="{{ $facebookLink ?: 'https://www.addtoany.com/add_to/facebook?linkurl=' . urlencode(url()->current()) . '&linkname=' . urlencode('Media') . '&linknote=' . urlencode('Krousar Thmey - Media') }}"
               target="_blank" rel="noopener noreferrer" aria-label="Share on Facebook"
               class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                <img src="{{ asset($facebookIcon) }}" alt="Facebook" class="w-full h-full object-cover">
            </a>
            <a href="https://www.addtoany.com/add_to/twitter?linkurl={{ urlencode(url()->current()) }}&linkname={{ urlencode('Media') }}&linknote={{ urlencode('Krousar Thmey - Media') }}"
               target="_blank" rel="noopener noreferrer" aria-label="Share on Twitter"
               class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                <img src="{{ asset($twitterIcon) }}" alt="Twitter" class="w-full h-full object-cover">
            </a>
            <a href="{{ $linkedinLink ?: 'https://www.addtoany.com/add_to/linkedin?linkurl=' . urlencode(url()->current()) . '&linkname=' . urlencode('Media') . '&linknote=' . urlencode('Krousar Thmey - Media') }}"
               target="_blank" rel="noopener noreferrer" aria-label="Share on LinkedIn"
               class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                <img src="{{ asset($linkedinIcon) }}" alt="LinkedIn" class="w-full h-full object-cover">
            </a>
            <a href="https://www.addtoany.com/share#url={{ urlencode(url()->current()) }}&title={{ urlencode('Media') }}"
               target="_blank" rel="noopener noreferrer" aria-label="Share"
               class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                <img src="{{ asset($shareIcon) }}" alt="Share" class="w-full h-full object-cover">
            </a>
        </div>
        @endif

        @php $mediaEmail = $settings['media_contact_email'] ?? 'communication@krousar-thmey.org'; @endphp
        <p class="text-gray-500 text-sm mt-8" data-reveal="up" style="--reveal-delay: 250">
            For any request, please contact our Communication Officer at
            <a href="mailto:{{ $mediaEmail }}" class="text-[#2d6fa3] hover:underline">{{ $mediaEmail }}</a>
        </p>
    </div>
</section>

{{-- ========================================================
     KROUSAR THMEY IN THE NEWS
     ======================================================== --}}
<section class="py-12 md:py-16 bg-white scroll-mt-20">
    <div class="max-w-5xl mx-auto px-6">
        <h2 class="text-sm font-bold uppercase tracking-wider text-[#11568c] mb-8" data-reveal="left">
            {{ $settings['media_press_heading'] ?? 'Krousar Thmey In The News' }}
        </h2>

        @php
            $pressImage = $settings['media_press_image'] ?? null;
            $pressImageUrl = $pressImage ? (str_starts_with($pressImage, 'http') ? $pressImage : asset('storage/' . $pressImage)) : asset('images/cultural.jpg');
            $pressArticleUrl = $settings['media_press_article_url'] ?? '#';
        @endphp
        <div class="grid md:grid-cols-2 gap-8 items-start">
            <div class="rounded-2xl overflow-hidden shadow-sm" data-reveal="left">
                <img src="{{ $pressImageUrl }}" alt="{{ $settings['media_press_headline'] ?? 'Krousar Thmey in the news' }}" class="w-full h-64 md:h-full object-cover">
            </div>

            <div data-reveal="right">
                <p class="text-sm mb-2">
                    <span class="font-bold text-gray-700">{{ $settings['media_press_source_label'] ?? 'Press Article' }}</span>
                    <span class="text-gray-400">/</span>
                    <span class="text-[#2d6fa3] font-semibold">{{ $settings['media_press_source_name'] ?? 'The Phnom Penh Post' }}</span>
                </p>
                <p class="font-bold text-gray-800 text-lg mb-2">&ldquo;{{ $settings['media_press_headline'] ?? 'Classical arts not a priority in schools today' }}&rdquo;</p>
                <p class="italic text-gray-400 text-sm mb-4">published {{ $settings['media_press_date'] ?? '07.25.17' }}</p>
                <hr class="border-gray-100 mb-4">
                <div class="rich-text-content italic text-gray-600 leading-relaxed mb-6">
                    {!! $t('media_press_excerpt', "Traditional Cambodian art forms such as classical dance and music have been passed down throughout the generations as a way for children to learn and preserve the meaning of their culture. However, as the education sector changes, gaining knowledge of the arts at a young age is proving less essential for the Kingdom's public schools…") !!}
                </div>
                <a href="{{ $pressArticleUrl }}" target="_blank" rel="noopener"
                   class="inline-flex items-center justify-center px-6 py-2.5 bg-[#2d6fa3] text-white text-sm font-semibold rounded hover:bg-[#1d4e7a] transition-colors">
                    Read the article
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================
     LATEST NEWS
     ======================================================== --}}
<section class="py-12 md:py-16 bg-[#f8f9fc] scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6">
        <h2 class="text-sm font-bold uppercase tracking-wider text-[#11568c] mb-3" data-reveal="left">
            {{ $settings['media_latest_heading'] ?? 'Latest News' }}
        </h2>
        <p class="mb-10" data-reveal="up">
            <a href="{{ route('news') }}" class="text-[#2d6fa3] hover:underline">
                {{ $settings['media_latest_intro'] ?? "Visit our News section to find more of Krousar Thmey's news" }}
            </a>
        </p>

        @if($latestNews->isNotEmpty())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($latestNews as $i => $article)
            <article class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow flex flex-col overflow-hidden"
                     data-reveal="up" style="--reveal-delay: {{ $i * 100 }}">
                <div class="h-44 overflow-hidden">
                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                </div>
                <div class="p-6 flex flex-col flex-1">
                    <p class="text-xs mb-2 leading-relaxed">
                        <span class="text-gray-500">{{ $article->published_at?->format('M j, Y') ?? $article->created_at->format('M j, Y') }}</span>
                        @if(!empty($article->tag_links))
                        <span class="text-gray-300 mx-1">|</span>
                        @foreach($article->tag_links as $tag)
                            @php $topicPage = $topicPagesByTitle[strtolower($tag['label'])] ?? null; @endphp
                            <a href="{{ $topicPage ? route('resource-pages.show', $topicPage->slug) : (!empty($tag['url']) ? $tag['url'] : route('news', ['tag' => $tag['label']])) }}" class="text-[#2d6fa3] hover:underline">{{ $tag['label'] }}</a>
                            @if(!$loop->last)<span class="text-gray-400">,</span> @endif
                        @endforeach
                        @endif
                    </p>
                    <h3 class="font-bold text-[#1d4e7a] uppercase text-sm mb-3 leading-snug">{{ $article->title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed flex-1">{{ Str::limit(strip_tags($article->excerpt ?? ''), 160) }}</p>
                    <a href="{{ route('news.show', $article->slug) }}" class="mt-4 text-[#2d6fa3] font-semibold text-sm hover:underline">
                        read more
                    </a>
                </div>
            </article>
            @endforeach
        </div>
        @else
        <p class="text-gray-400 text-sm" data-reveal="up">No news articles published yet.</p>
        @endif
        </div>
    </section>

    {{-- ========================================================
         MEDIA GALLERY
         ======================================================== --}}
    @if($mediaGallery->isNotEmpty())
    <section class="py-12 md:py-16 bg-white scroll-mt-20">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-sm font-bold uppercase tracking-wider text-[#11568c] mb-8" data-reveal="left">
                Media Gallery
            </h2>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($mediaGallery as $i => $item)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow flex flex-col overflow-hidden"
                     data-reveal="up" style="--reveal-delay: {{ $i * 100 }}">
                    @if($item->file_path)
                        @if($item->type === 'image')
                        <div class="h-44 overflow-hidden">
                            <img src="{{ $item->image_url }}" alt="{{ $item->alt_text ?? $item->title }}" class="w-full h-full object-cover">
                        </div>
                        @elseif($item->type === 'video')
                        <div class="h-44 bg-gray-100 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M10 16.5l6-4.5-6-4.5v9zM21 19V5a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2z"/>
                            </svg>
                        </div>
                        @else
                        <div class="h-44 bg-gray-100 flex items-center justify-center">
                            <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        @endif
                    @else
                    <div class="h-44 bg-gray-100 flex items-center justify-center">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    @endif
                    <div class="p-6 flex flex-col flex-1">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-bold text-[#1d4e7a] uppercase text-sm leading-snug">{{ $item->title }}</h3>
                            <span class="px-2 py-0.5 rounded-full text-xs flex-shrink-0 ml-2
                                @if($item->type === 'image') bg-blue-50 text-blue-600
                                @elseif($item->type === 'video') bg-purple-50 text-purple-600
                                @else bg-amber-50 text-amber-600 @endif">
                                {{ ucfirst($item->type) }}
                            </span>
                        </div>
                        @if($item->description)
                        <div class="rich-text-content text-gray-500 text-sm leading-relaxed flex-1">{!! $item->description !!}</div>
                        @endif
                        <div class="mt-4">
                            @if($item->external_url)
                            <a href="{{ $item->external_url }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-1.5 text-[#2d6fa3] font-semibold text-sm hover:underline">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                                View
                            </a>
                            @elseif($item->file_path)
                            <a href="{{ $item->image_url }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-1.5 text-[#2d6fa3] font-semibold text-sm hover:underline">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                View
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @endsection
