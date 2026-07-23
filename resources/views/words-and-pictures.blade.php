@extends('layouts.app')

@section('title', 'Words and Pictures Application — Krousar Thmey')
@section('description', 'Words and Pictures — a free mobile app helping children with hearing and speech impairments practice Cambodian Sign Language.')

@section('content')

<section class="py-20 bg-white scroll-mt-24">
    <div class="max-w-7xl mx-auto px-6">
        @php
            $wp = fn (string $key, string $default) => \App\Models\HomeSetting::getValue($key, $default);
            $wpPhoto = $wp('words_pictures_photo', '');
            $wpPhotoUrl = $wpPhoto ? (str_starts_with($wpPhoto, 'http') ? $wpPhoto : asset('storage/' . $wpPhoto)) : asset('images/cultural.jpg');
            $wpQr = $wp('words_pictures_qr_image', '');
            $wpQrUrl = $wpQr ? (str_starts_with($wpQr, 'http') ? $wpQr : asset('storage/' . $wpQr)) : null;
        @endphp

        <h1 class="border-l-4 border-[#8da83a] pl-4 text-2xl md:text-3xl font-extrabold text-[#1a3c6e] uppercase mb-10" data-reveal>
            {{ $wp('words_pictures_title', 'Words and Pictures Application') }}
        </h1>

        <div class="grid lg:grid-cols-2 gap-12 items-start">
            {{-- Left: Text content --}}
            <div data-reveal="left">
                <h3 class="text-xs font-bold uppercase tracking-wider text-[#11568c] mb-2">{{ $wp('words_pictures_objective_heading', 'Objective') }}</h3>
                <p class="text-gray-700 leading-relaxed mb-6">{{ $wp('words_pictures_objective_text', 'To enable children with hearing and speech impairments and their relatives and friends access a tool to practice Cambodian Sign Language.') }}</p>

                <h3 class="text-xs font-bold uppercase tracking-wider text-[#11568c] mb-2">{{ $wp('words_pictures_project_heading', 'Project') }}</h3>
                <div class="space-y-4 text-gray-700 leading-relaxed">
                    <p>{!! nl2br(e($wp('words_pictures_project_p1', "For over 25 years, Krousar Thmey has implemented a unique mix of special and inclusive education for children with sensory disabilities in Cambodia, developing a unique expertise in visual and hearing impairments with an established track record of results, transforming lives through education, and lastingly influencing national policies. Children with hearing disabilities face many challenges in terms of communication, and have specific educational needs requiring adapted resources. As technology is an ever growing means of providing access to education and communication, Krousar Thmey is launching an educative and innovative mobile phone application:"))) !!} <em>{{ $wp('words_pictures_app_name', 'Words and Pictures') }}</em>.</p>

                    <p>{{ $wp('words_pictures_project_p2', "Based on a very intuitive interface and simple design, the inclusive application is readily accessible to a very wide audience, and equally useful for families with young children with or without disabilities. Featuring over 500 words relevant to every-day life situations, selected for their suitability to the Cambodian background, the purpose of the application is to offer a fun picture dictionary with integrated sounds and sign language pictograms.") }}</p>

                    <p>
                        {{ $wp('words_pictures_download_prefix', 'To download the application on your smartphone, please visit:') }}
                        <a href="{{ $wp('words_pictures_download_url', 'http://onelink.to/krousarthmey') }}" target="_blank" rel="noopener" class="text-[#2d6fa3] hover:underline">{{ $wp('words_pictures_download_url', 'http://onelink.to/krousarthmey') }}</a>
                        {{ $wp('words_pictures_download_suffix', 'or scan the QR code below.') }}
                    </p>

                    <p>{{ $wp('words_pictures_thanks_text', 'Many thanks to Judit van Geystelen for the original idea and design, Open Institute for the development, as well as the Ministry of Education, Youth and Sport of Cambodia, Symphasis Foundation, and Clariant Foundation for their support.') }}</p>

                    <p>{{ $wp('words_pictures_dedication_text', 'This application is dedicated to Tina.') }}</p>

                    <p>
                        {{ $wp('words_pictures_contact_prefix', 'If you are interested in developing this application in the language of your choice, please contact:') }}
                        <a href="mailto:{{ $wp('words_pictures_contact_email', 'sign.picture.dictionary@gmail.com') }}" class="text-[#2d6fa3] hover:underline">{{ $wp('words_pictures_contact_email', 'sign.picture.dictionary@gmail.com') }}</a>
                    </p>
                </div>

                @if($wpQrUrl)
                <div class="flex justify-center my-8">
                    <img src="{{ $wpQrUrl }}" alt="QR code to download Words and Pictures" class="w-32 h-32 border border-gray-200 rounded-lg p-1">
                </div>
                @endif

                <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-6">
                    <a href="{{ $wp('words_pictures_learn_more_url', route('programs.show', 'special-education')) }}"
                       class="inline-flex items-center justify-center px-5 py-2 border border-[#2d6fa3] text-[#2d6fa3] text-sm font-medium rounded hover:bg-[#2d6fa3] hover:text-white transition-colors">
                        {{ $wp('words_pictures_learn_more_text', 'Learn more about the projects of this program') }}
                    </a>
                    <a href="{{ $wp('words_pictures_donate_url', route('donate')) }}"
                       class="inline-flex items-center justify-center gap-1.5 px-5 py-2 border border-red-500 text-red-600 text-sm font-bold uppercase rounded hover:bg-red-500 hover:text-white transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                        Donate Now
                    </a>
                </div>
            </div>

            {{-- Right: Photo --}}
            <div class="relative" data-reveal="right">
                <div class="rounded-2xl overflow-hidden shadow-lg">
                    <img src="{{ $wpPhotoUrl }}" alt="Teacher using Cambodian Sign Language with students" class="w-full h-[420px] lg:h-[560px] object-cover">
                </div>

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
                <div class="flex items-center justify-center gap-3 mt-5">
                    <a href="{{ $facebookLink ?: 'https://www.addtoany.com/add_to/facebook?linkurl=' . urlencode(url()->current()) . '&linkname=' . urlencode('Words and Pictures Application') }}"
                       target="_blank" rel="noopener noreferrer" aria-label="Share on Facebook"
                       class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                        <img src="{{ asset($facebookIcon) }}" alt="Facebook" class="w-full h-full object-cover">
                    </a>
                    <a href="https://www.addtoany.com/add_to/twitter?linkurl={{ urlencode(url()->current()) }}&linkname={{ urlencode('Words and Pictures Application') }}"
                       target="_blank" rel="noopener noreferrer" aria-label="Share on Twitter"
                       class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                        <img src="{{ asset($twitterIcon) }}" alt="Twitter" class="w-full h-full object-cover">
                    </a>
                    <a href="{{ $linkedinLink ?: 'https://www.addtoany.com/add_to/linkedin?linkurl=' . urlencode(url()->current()) . '&linkname=' . urlencode('Words and Pictures Application') }}"
                       target="_blank" rel="noopener noreferrer" aria-label="Share on LinkedIn"
                       class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                        <img src="{{ asset($linkedinIcon) }}" alt="LinkedIn" class="w-full h-full object-cover">
                    </a>
                    <a href="https://www.addtoany.com/share#url={{ urlencode(url()->current()) }}&title={{ urlencode('Words and Pictures Application') }}"
                       target="_blank" rel="noopener noreferrer" aria-label="Share"
                       class="group w-9 h-9 rounded-full overflow-hidden shadow-sm transition duration-300 hover:-translate-y-0.5 hover:scale-110">
                        <img src="{{ asset($shareIcon) }}" alt="Share" class="w-full h-full object-cover">
                    </a>
                </div>
                @endif
            </div>
        </div>

        {{-- Words and Pictures in the News --}}
        @php
            $wpPressImage = $wp('words_pictures_press_image', '');
            $wpPressImageUrl = $wpPressImage ? (str_starts_with($wpPressImage, 'http') ? $wpPressImage : asset('storage/' . $wpPressImage)) : asset('images/community-work.png');
            $wpPressArticleUrl = $wp('words_pictures_press_article_url', '#');
        @endphp
        <div class="mt-20 pt-16 border-t border-gray-100">
            <h3 class="text-xs font-bold uppercase tracking-wider text-[#11568c] mb-8" data-reveal="left">
                {{ $wp('words_pictures_press_heading', 'Words and Pictures in the News') }}
            </h3>

            <div class="grid lg:grid-cols-2 gap-8 items-start">
                <div data-reveal="left">
                    <div class="rounded overflow-hidden shadow-sm relative">
                        <img src="{{ $wpPressImageUrl }}" alt="{{ $wp('words_pictures_press_headline', 'Krousar Thmey empowering children with hearing issues') }}" class="w-full h-72 object-cover">
                        @if($wp('words_pictures_press_image_caption', "The newly launched 'Words and Pictures' app is dedicated to helping children with hearing and speech impairments. Supplied"))
                        <p class="absolute bottom-0 left-0 right-0 bg-black/60 text-white text-xs px-3 py-2">
                            {{ $wp('words_pictures_press_image_caption', "The newly launched 'Words and Pictures' app is dedicated to helping children with hearing and speech impairments. Supplied") }}
                        </p>
                        @endif
                    </div>
                </div>

                <div data-reveal="right">
                    <p class="text-sm mb-2">
                        <span class="font-bold text-[#2d6fa3]">{{ $wp('words_pictures_press_source_label', 'Press Article') }}</span>
                        <span class="text-gray-400">/</span>
                        <span class="font-bold text-[#2d6fa3]">{{ $wp('words_pictures_press_source_name', 'The Phnom Penh Post') }}</span>
                    </p>
                    <p class="font-bold text-[#2d6fa3] text-lg mb-2">&ldquo;{{ $wp('words_pictures_press_headline', 'Krousar Thmey empowering children with hearing issues') }}&rdquo;</p>
                    <p class="italic text-gray-500 text-sm mb-4">published {{ $wp('words_pictures_press_date', '04.27.2020') }}</p>
                    <p class="italic text-gray-600 leading-relaxed mb-6">
                        {{ $wp('words_pictures_press_excerpt', 'As children with hearing disabilities face many challenges in terms of communication and have specific educational needs, Krousar Thmey has utilised technology to create a mobile learning app as a resource for disadvantaged children…') }}
                    </p>
                    <a href="{{ $wpPressArticleUrl }}" target="_blank" rel="noopener"
                       class="inline-flex items-center justify-center px-6 py-2.5 bg-[#1a3c6e] text-white text-sm font-semibold rounded hover:bg-[#12294d] transition-colors">
                        Read the article
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
