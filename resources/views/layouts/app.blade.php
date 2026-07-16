<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', ($settings['site_name'] ?? 'Krousar Thmey') . ' — ' . ($settings['site_tagline'] ?? 'Helping Children in Cambodia'))</title>
    <meta name="description" content="@yield('description', $settings['site_description'] ?? 'Krousar Thmey is Cambodia\'s first organization dedicated to helping disadvantaged children — through child welfare, special education, and cultural development.')">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white text-gray-800" x-data>

<script>
function openEmail(email) {
  if (email.toLowerCase().endsWith('@gmail.com')) {
    window.open('https://mail.google.com/mail/?view=cm&fs=1&to=' + encodeURIComponent(email), '_blank', 'noopener');
  } else {
    window.location.href = 'mailto:' + email;
  }
}
function changeGTranslate(lang) {
    document.cookie = 'googtrans=/en/' + lang + '; path=/; domain=' + window.location.hostname;
    document.cookie = 'googtrans=/en/' + lang + '; path=/';
    window.location.reload();
}
function getCurrentLang() {
    let match = document.cookie.match(new RegExp('(^| )googtrans=([^;]+)'));
    if (match) {
        let parts = match[2].split('/');
        if (parts.length === 3 && parts[2] !== 'en') return parts[2];
    }
    // Fall back to Laravel session locale
    return '{{ session("locale", "en") }}';
}
function switchLang(lang) {
    if (lang === 'km' || lang === 'fr') {
        // Use Google Translate for non-English
        document.cookie = 'googtrans=/en/' + lang + '; path=/; domain=' + window.location.hostname;
        document.cookie = 'googtrans=/en/' + lang + '; path=/';
    } else {
        // Clear Google Translate cookie for English
        document.cookie = 'googtrans=; path=/; domain=' + window.location.hostname + '; expires=Thu, 01 Jan 1970 00:00:00 UTC';
        document.cookie = 'googtrans=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC';
    }
    window.location.href = '{{ url("/lang") }}/' + lang + '?redirect=' + encodeURIComponent(window.location.href);
}
</script>

<style>
/* Hide the Google Translate UI completely */
iframe.goog-te-banner-frame { display: none !important; }
.goog-te-banner-frame { display: none !important; }
.goog-logo-link { display: none !important; }
.goog-te-gadget { color: transparent !important; }
.VIpgJd-ZVi9od-ORHb-OEVmcd, .VIpgJd-ZVi9od-aZ2wEe-wOHMyf { display: none !important; } /* New GT classes */
body > .skiptranslate > iframe.skiptranslate { display: none !important; visibility: hidden !important; }

html { margin-top: 0 !important; top: 0 !important; }
body { margin-top: 0 !important; top: 0 !important; position: static !important; }

.goog-tooltip { display: none !important; }
.goog-tooltip:hover { display: none !important; }
.goog-text-highlight { background-color: transparent !important; border: none !important; box-shadow: none !important; }
#google_translate_element { display: none !important; }
</style>

<div id="google_translate_element"></div>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', includedLanguages: 'en,km,fr', autoDisplay: false}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


    {{-- Flash Message Popup --}}
    @if(session('success') || session('info'))
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 6000)"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/40"
         @click.self="show = false">
        <div class="bg-white rounded-3xl shadow-2xl max-w-sm w-full p-8 text-center relative">
            <button @click="show = false" class="absolute top-4 right-4 text-gray-300 hover:text-gray-500 transition-colors" aria-label="Close">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            @if(session('success'))
            <div class="w-16 h-16 rounded-full bg-[#8da83a]/15 flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Success!</h3>
            <p class="text-gray-500 text-sm leading-relaxed">{{ session('success') }}</p>
            @else
            <div class="w-16 h-16 rounded-full bg-[#2d6fa3]/15 flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Heads Up</h3>
            <p class="text-gray-500 text-sm leading-relaxed">{{ session('info') }}</p>
            @endif

            <button @click="show = false" class="btn-blue w-full justify-center mt-6">Got It</button>
        </div>
    </div>
    @endif

    {{-- Top bar --}}
    <div class="hidden lg:block bg-[#1d4e7a] text-white text-sm">
        <div class="max-w-7xl mx-auto px-6 flex items-center justify-between h-9">
            <span class="text-white/60 text-xs">{{ $settings['site_tagline'] ?? "Cambodia's first organization helping disadvantaged children since 1991" }}</span>
            <div class="flex items-center gap-5">
                <a href="{{ route('contact') }}" class="text-white/60 hover:text-white transition-colors text-xs">{{ __('Contact') }}</a>
                <span class="text-white/20">|</span>
                <div class="flex items-center gap-3">
                    <a href="{{ $settings['social_facebook'] ?? 'https://www.facebook.com/KrousarThmey' }}" target="_blank" rel="noopener" aria-label="Facebook"
                       class="text-white/50 hover:text-[#8da83a] transition-colors">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="{{ $settings['social_instagram'] ?? 'https://www.instagram.com/krousarthmey/' }}" target="_blank" rel="noopener" aria-label="Instagram"
                       class="text-white/50 hover:text-[#8da83a] transition-colors">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-4.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                    <a href="{{ $settings['social_linkedin'] ?? 'https://www.linkedin.com/company/krousar-thmey/' }}" target="_blank" rel="noopener" aria-label="LinkedIn"
                       class="text-white/50 hover:text-[#8da83a] transition-colors">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                    <a href="{{ $settings['social_youtube'] ?? 'https://www.youtube.com/@KrousarThmey' }}" target="_blank" rel="noopener" aria-label="YouTube"
                       class="text-white/50 hover:text-[#8da83a] transition-colors">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                    </a>
                    <a href="{{ $settings['social_telegram'] ?? 'https://t.me/krousarthmey' }}" target="_blank" rel="noopener" aria-label="Telegram"
                       class="text-white/50 hover:text-[#8da83a] transition-colors">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                    </a>
                </div>

                <a href="{{ route('donate') }}"
                    class="bg-[#8da83a] text-white px-4 py-1 rounded-full font-semibold hover:bg-[#a3c04a] transition-colors text-xs">
                    {{ __('Donate') }}
                </a>
            </div>
        </div>
    </div>

    {{-- Main Navbar --}}
    <nav class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-100"
        x-data="{ open: false }">

        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-between h-16 lg:h-20">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center flex-shrink-0">
                    @php
                        $logoPath = $settings['site_logo'] ?? 'images/logo.png';
                        $logoUrl = str_starts_with($logoPath, 'http') ? $logoPath : (str_starts_with($logoPath, 'logos/') ? asset('storage/' . $logoPath) : asset($logoPath));
                        $siteName = $settings['site_name'] ?? 'Krousar Thmey';
                        $siteTagline = $settings['site_tagline'] ?? 'គ្រួសារថ្មី · New Family';
                    @endphp
                    <img src="{{ $logoUrl }}"
                         alt="{{ $siteName }}"
                         class="h-12 lg:h-14 w-auto object-contain"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    {{-- Fallback if image not yet placed --}}
                    <div class="hidden items-center gap-3">
                        <div>
                            <div class="text-[#2d6fa3] font-bold text-lg leading-tight">{{ $siteName }}</div>
                            <div class="text-[#8da83a] text-xs font-medium">{{ $siteTagline }}</div>
                        </div>
                    </div>
                </a>

                {{-- Desktop Nav --}}
                <div class="hidden lg:flex items-center gap-1">

                    {{-- Who We Are --}}
                    @php $isWhoWeAre = request()->routeIs('about') || request()->routeIs('presentation') || request()->routeIs('transparency'); @endphp
                    <div class="relative" x-data="{ open: false }"
                         @mouseenter="open = true" @mouseleave="open = false">
                        <a href="{{ route('about') }}" class="nav-link flex items-center gap-1 px-3 py-2 rounded-lg hover:bg-gray-50">
                            {{ __('Who We Are') }}
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute top-full left-0 mt-1 w-52 bg-white rounded-xl shadow-xl border border-gray-100 py-1 z-50">
                            <a href="{{ route('presentation') }}" class="dropdown-item rounded-t-xl">{{ __('Presentation') }}</a>
                            <a href="{{ route('about') }}#history" class="dropdown-item">{{ __('History') }}</a>
                            <a href="{{ route('about') }}#values" class="dropdown-item">{{ __('Our Values') }}</a>
                            <a href="{{ route('about') }}#partners" class="dropdown-item">{{ __('Partners') }}</a>
                            <a href="{{ route('transparency') }}" class="dropdown-item rounded-b-xl">{{ __('Transparency') }}</a>
                        </div>
                    </div>

                    {{-- Our Programs --}}
                    @php $isPrograms = request()->routeIs('programs') || request()->routeIs('programs.*') || request()->routeIs('program-page-items.*') || request()->routeIs('projects.*'); @endphp
                    <div class="relative" x-data="{ open: false }"
                         @mouseenter="open = true" @mouseleave="open = false">
                        <a href="{{ route('programs') }}" class="nav-link flex items-center gap-1 px-3 py-2 rounded-lg hover:bg-gray-50">
                            {{ __('Our Programs') }}
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute top-full left-0 mt-1 w-64 bg-white rounded-xl shadow-xl border border-gray-100 py-1 z-50">
                             @php 
                                 $navProgramsList = \App\Models\Program::active()->take(3)->get(); 
                             @endphp
                             @foreach($navProgramsList as $index => $navProg)
                             <a href="{{ route('programs.show', $navProg->slug) }}" class="dropdown-item {{ $index === 0 ? 'rounded-t-xl' : '' }} {{ $index === count($navProgramsList) - 1 ? 'rounded-b-xl' : '' }}">{{ $navProg->title }}</a>
                             @endforeach
                        </div>
                    </div>

                    {{-- Get Involved --}}
                    @php $isInvolved = request()->routeIs('involved') || request()->routeIs('jobs.*') || request()->routeIs('volunteer') || request()->routeIs('books.*'); @endphp
                    <div class="relative" x-data="{ open: false }"
                         @mouseenter="open = true" @mouseleave="open = false">
                        <a href="{{ route('involved') }}" class="nav-link flex items-center gap-1 px-3 py-2 rounded-lg hover:bg-gray-50">
                            {{ __('Get Involved') }}
                            <svg class="w-4 h-4 text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </a>
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-100"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute top-full left-0 mt-1 w-52 bg-white rounded-xl shadow-xl border border-gray-100 py-1 z-50">
                            <a href="{{ route('involved') }}#partner" class="dropdown-item rounded-t-xl">{{ __('Partnerships') }}</a>
                            <a href="{{ route('involved') }}#volunteer" class="dropdown-item">{{ __('Volunteering') }}</a>
                            <a href="{{ route('involved') }}#book-for-sales" class="dropdown-item">{{ __('Book for Sales') }}</a>
                            <a href="{{ route('involved') }}#jobs" class="dropdown-item rounded-b-xl">{{ __('Job Opportunities') }}</a>
                        </div>
                    </div>

                    <a href="{{ route('news') }}" class="nav-link px-3 py-2 rounded-lg hover:bg-gray-50">{{ __('News') }}</a>
                    <a href="{{ route('resources') }}" class="nav-link px-3 py-2 rounded-lg hover:bg-gray-50">{{ __('Resources') }}</a>
                    <a href="{{ route('contact') }}" class="nav-link px-3 py-2 rounded-lg hover:bg-gray-50">{{ __('Contact') }}</a>
                </div>

                {{-- CTA + Mobile toggle --}}
                <div class="flex items-center gap-4">
                    {{-- Translate Dropdown --}}
                    <div class="hidden lg:block border-r border-gray-200 pr-4" x-data="{ open: false, lang: getCurrentLang() }">
                        <div class="relative">
                            <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 text-gray-700 hover:text-[#2d6fa3] transition-colors text-sm font-medium py-1.5 px-3 rounded-lg hover:bg-gray-50 border border-gray-100 shadow-sm bg-white">
                                <img :src="lang === 'km' ? 'https://flagcdn.com/w20/kh.png' : (lang === 'fr' ? 'https://flagcdn.com/w20/fr.png' : 'https://flagcdn.com/w20/gb.png')" class="w-4 h-auto rounded-sm" alt="Flag">
                                <span x-text="lang === 'km' ? 'ខ្មែរ' : (lang === 'fr' ? 'FR' : 'EN')">EN</span>
                                <svg class="w-3 h-3 transition-transform duration-200 text-gray-400" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 scale-100"
                                 x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-36 bg-white rounded-xl shadow-lg border border-gray-100 py-1 z-[100] overflow-hidden">
                                <button @click="switchLang('en')" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#2d6fa3] transition-colors flex items-center gap-2" :class="lang === 'en' ? 'bg-blue-50 text-[#2d6fa3] font-medium' : ''">
                                    <img src="https://flagcdn.com/w20/gb.png" class="w-4 h-auto rounded-sm" alt="English"> English
                                </button>
                                <button @click="switchLang('fr')" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#2d6fa3] transition-colors flex items-center gap-2" :class="lang === 'fr' ? 'bg-blue-50 text-[#2d6fa3] font-medium' : ''">
                                    <img src="https://flagcdn.com/w20/fr.png" class="w-4 h-auto rounded-sm" alt="Français"> Français
                                </button>
                                <button @click="switchLang('km')" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#2d6fa3] transition-colors flex items-center gap-2" :class="lang === 'km' ? 'bg-blue-50 text-[#2d6fa3] font-medium' : ''">
                                    <img src="https://flagcdn.com/w20/kh.png" class="w-4 h-auto rounded-sm" alt="Khmer"> ខ្មែរ
                                </button>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('donate') }}" class="btn-primary text-sm hidden sm:inline-flex">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        Donate
                    </a>
                    <button @click="open = !open"
                        class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors"
                        aria-label="Toggle menu">
                        <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-2"
            class="lg:hidden border-t border-gray-100 bg-white">
            <div class="max-w-7xl mx-auto px-6 py-4 space-y-1">
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-[#2d6fa3] font-medium">{{ __('Who We Are') }}</a>
                <a href="{{ route('programs') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-[#2d6fa3] font-medium">{{ __('Our Programs') }}</a>
                <a href="{{ route('involved') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-[#2d6fa3] font-medium">{{ __('Get Involved') }}</a>
                <a href="{{ route('news') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-[#2d6fa3] font-medium">{{ __('News') }}</a>
                <a href="{{ route('resources') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-[#2d6fa3] font-medium">{{ __('Resources') }}</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-lg text-gray-700 hover:bg-gray-50 hover:text-[#2d6fa3] font-medium">{{ __('Contact') }}</a>
                <div class="pt-3 pb-1 border-t border-gray-100 mt-2">
                    <div class="flex items-center gap-2 mb-4" x-data="{ lang: getCurrentLang() }">
                        <button @click="switchLang('en')" :class="lang === 'en' ? 'bg-[#2d6fa3] text-white' : 'bg-gray-100 text-gray-600'" class="flex-1 flex items-center justify-center gap-1.5 py-2.5 rounded-xl text-sm font-medium transition-colors border border-transparent hover:border-gray-200">
                            <img src="https://flagcdn.com/w20/gb.png" class="w-4 h-auto rounded-sm" alt="English"> EN
                        </button>
                        <button @click="switchLang('fr')" :class="lang === 'fr' ? 'bg-[#2d6fa3] text-white' : 'bg-gray-100 text-gray-600'" class="flex-1 flex items-center justify-center gap-1.5 py-2.5 rounded-xl text-sm font-medium transition-colors border border-transparent hover:border-gray-200">
                            <img src="https://flagcdn.com/w20/fr.png" class="w-4 h-auto rounded-sm" alt="Français"> FR
                        </button>
                        <button @click="switchLang('km')" :class="lang === 'km' ? 'bg-[#2d6fa3] text-white' : 'bg-gray-100 text-gray-600'" class="flex-1 flex items-center justify-center gap-1.5 py-2.5 rounded-xl text-sm font-medium transition-colors border border-transparent hover:border-gray-200">
                            <img src="https://flagcdn.com/w20/kh.png" class="w-4 h-auto rounded-sm" alt="Khmer"> KM
                        </button>
                    </div>
                    <a href="{{ route('donate') }}" class="btn-primary w-full justify-center py-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                        {{ __('Donate Now') }}
                    </a>
                </div>
            </div>
        </div>
    </nav>

    {{-- Page Content --}}
    <main>@yield('content')</main>

    {{-- Footer --}}
    <footer class="bg-[#1d4e7a] text-white">

        {{-- Donation Banner --}}
        <div class="bg-[#8da83a]">
            <div class="max-w-7xl mx-auto px-6 py-8 flex flex-col md:flex-row items-center justify-between gap-6">
                <div>
                    <h3 class="text-white font-bold text-xl">Make a Difference Today</h3>
                    <p class="text-white/80 mt-1 text-sm">100% of your donation directly supports children in Cambodia.</p>
                </div>
                <a href="{{ route('donate') }}" class="btn-outline flex-shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                    Donate Now
                </a>
            </div>
        </div>

        {{-- Main Footer --}}
        <div class="max-w-7xl mx-auto px-6 py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

                {{-- Brand --}}
                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}" class="inline-block mb-5">
                        <div class="bg-white rounded-xl px-4 py-2">
                            @php $footerLogoUrl = str_starts_with($logoPath, 'http') ? $logoPath : (str_starts_with($logoPath, 'logos/') ? asset('storage/' . $logoPath) : asset($logoPath)); @endphp
                            <img src="{{ $footerLogoUrl }}"
                                 alt="{{ $siteName }}"
                                 class="h-10 w-auto">
                        </div>
                    </a>
                    <p class="text-white/50 text-sm leading-relaxed">
                        {{ $settings['footer_description'] ?? "Cambodia's first organization helping disadvantaged children — building a world where every child grows into an independent, responsible adult." }}
                    </p>
                    <div class="flex items-center gap-3 mt-6">
                        @php
                            $socialLinks = [
                                ['href' => $settings['social_facebook'] ?? '#', 'label' => 'Facebook',  'svg' => '<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>'],
                                ['href' => $settings['social_instagram'] ?? '#', 'label' => 'Instagram', 'svg' => '<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-4.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>'],
                                ['href' => $settings['social_linkedin'] ?? '#', 'label' => 'LinkedIn', 'svg' => '<path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>'],
                                ['href' => $settings['social_youtube'] ?? '#', 'label' => 'YouTube',  'svg' => '<path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>'],
                                ['href' => $settings['social_telegram'] ?? '#', 'label' => 'Telegram', 'svg' => '<path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>'],
                            ];
                        @endphp
                        @foreach($socialLinks as $social)
                        <a href="{{ $social['href'] }}" target="_blank" rel="noopener" aria-label="{{ $social['label'] }}"
                            class="w-9 h-9 rounded-lg bg-white/10 flex items-center justify-center hover:bg-[#8da83a] transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">{!! $social['svg'] !!}</svg>
                        </a>
                        @endforeach
                    </div>

                </div>

                {{-- Organization --}}
                <div>
                    <h4 class="font-semibold text-white mb-5 text-xs uppercase tracking-wider">{{ __('Organization') }}</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('about') }}" class="text-white/50 hover:text-white text-sm transition-colors">{{ __('Who We Are') }}</a></li>
                        <li><a href="{{ route('programs') }}" class="text-white/50 hover:text-white text-sm transition-colors">{{ __('Our Programs') }}</a></li>
                        <li><a href="{{ route('news') }}" class="text-white/50 hover:text-white text-sm transition-colors">{{ __('News') }}</a></li>
                        <li><a href="{{ route('resources') }}" class="text-white/50 hover:text-white text-sm transition-colors">{{ __('Resources') }}</a></li>
                        <li><a href="{{ route('contact') }}" class="text-white/50 hover:text-white text-sm transition-colors">{{ __('Contact') }}</a></li>
                    </ul>
                </div>

                {{-- Programs --}}
                <div>
                    <h4 class="font-semibold text-white mb-5 text-xs uppercase tracking-wider">Programs</h4>
                    <ul class="space-y-3">
                        @php $footerPrograms = \App\Models\Program::active()->take(3)->get(); @endphp
                        @foreach($footerPrograms as $footerProg)
                        <li><a href="{{ route('programs') }}#{{ $footerProg->slug }}" class="text-white/50 hover:text-white text-sm transition-colors">{{ $footerProg->title }}</a></li>
                        @endforeach
                        <li><a href="{{ route('involved') }}#volunteer" class="text-white/50 hover:text-white text-sm transition-colors">{{ __('Volunteering') }}</a></li>
                        <li><a href="{{ route('involved') }}#book-for-sales" class="text-white/50 hover:text-white text-sm transition-colors">{{ __('Book for Sales') }}</a></li>
                        <li><a href="{{ route('donate') }}" class="text-white/50 hover:text-white text-sm transition-colors">{{ __('Donate') }}</a></li>
                    </ul>

                </div>

                {{-- Newsletter --}}
                <div>
                    <h4 class="font-semibold text-white mb-5 text-xs uppercase tracking-wider">{{ __('Stay Connected') }}</h4>
                    <p class="text-white/50 text-sm mb-4">Subscribe for updates on our work in Cambodia.</p>
                    <form class="flex gap-2" method="POST" action="{{ route('newsletter.store') }}">
                        @csrf
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Your email" required
                            class="flex-1 px-4 py-2 rounded-lg bg-white/10 border border-white/20 text-white placeholder-white/30 text-sm focus:outline-none focus:border-[#8da83a] transition-colors">
                        <button type="submit"
                            class="px-4 py-2 bg-[#8da83a] rounded-lg text-white text-sm font-medium hover:bg-[#a3c04a] transition-colors flex-shrink-0">
                            OK
                        </button>
                    </form>
                    @error('email') <p class="text-red-300 text-xs mt-2">{{ $message }}</p> @enderror
                    <div class="mt-6 space-y-1.5">
                        <p class="text-white/30 text-xs uppercase tracking-wider font-medium">{{ __('Contact') }}</p>
                        @php
                            $footerAddress = data_get($settings, 'footer_address', '#58, Street 478, Phnom Penh, Cambodia');
                            $footerPhone = data_get($settings, 'footer_phone', '+855 (0)23 211 955');
                            $footerEmail = data_get($settings, 'footer_email', 'info@krousar-thmey.org');
                        @endphp
                        <p class="text-white/50 text-xs">{{ $footerAddress }}</p>
                        <p class="text-white/50 text-xs">{{ $footerPhone }}</p>
                        <p class="text-white/50 text-xs">{{ $footerEmail }}</p>
                    </div>
                    <div class="mt-8 pt-6 border-t border-white/10">
                        <p class="text-white/30 text-xs uppercase tracking-wider font-medium mb-3">
                            {{ __('Administration') }}
                        </p>

                        <a href="{{ url('/admin/login') }}"
                            class="inline-flex items-center justify-center gap-2 w-full px-4 py-3 rounded-xl border border-white/15 bg-white/5 text-sm font-medium text-white/70 hover:bg-white/10 hover:text-white transition-all duration-300">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 9V5.25A3.75 3.75 0 008.25 5.25V9m-.75 0h9a1.5 1.5 0 011.5 1.5v7.5a1.5 1.5 0 01-1.5 1.5h-9A1.5 1.5 0 016 18v-7.5A1.5 1.5 0 017.5 9z" />
                            </svg>
                            Admin Login
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="border-t border-white/10">
            <div class="max-w-7xl mx-auto px-6 py-5 flex flex-col sm:flex-row items-center justify-between gap-3">                        <p class="text-white/30 text-xs">© {{ date('Y') }} {{ $settings['footer_copyright'] ?? 'Krousar Thmey. All rights reserved.' }}</p>
                <div class="flex items-center gap-4">
                    <a href="#" class="text-white/30 hover:text-white/60 text-xs transition-colors">Privacy Policy</a>
                    <a href="#" class="text-white/30 hover:text-white/60 text-xs transition-colors">Terms of Use</a>
                    <a href="{{ route('resources') }}" class="text-white/30 hover:text-white/60 text-xs transition-colors">Annual Reports</a>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>