@extends('admin.layouts.app')

@section('title', 'Get Involved Page Banner')
@section('page-title', 'Get Involved Page Banner')
@section('breadcrumb', 'Get Involved → Banner')

@section('content')

@php
    $bv = fn($key, $default = '') => old($key, $bannerSettings->get($key, $default));

    // Hero Banner
    $heroImage = $bv('involved_banner_image');
    $heroOverlayColor = $bv('involved_banner_overlay_color', '#1d4e7a');
    $heroImageUrl = $heroImage ? (str_starts_with($heroImage, 'http') ? $heroImage : asset('storage/' . $heroImage)) : null;
    $heroBadge = $bv('involved_banner_badge', 'Join Our Mission');
    $heroTitle = $bv('involved_banner_title', 'Get Involved');
    $heroSubtitle = $bv('involved_banner_subtitle', 'There are many meaningful ways to support Krousar Thmey\'s mission — from partnerships and volunteering, to exploring job opportunities or purchasing our books.');
    $heroSubtitleFr = $bv('involved_banner_subtitle_fr');

    // Books for Sale Banner
    $booksImage = $bv('involved_books_banner_image');
    $booksOverlayColor = $bv('involved_books_banner_overlay_color', '#163b5d');
    $booksImageUrl = $booksImage ? (str_starts_with($booksImage, 'http') ? $booksImage : asset('storage/' . $booksImage)) : null;
    $booksBadge = $bv('involved_books_banner_badge', 'Books for Sale');
    $booksTitle = $bv('involved_books_banner_title', 'Support Through Literature');
    $booksSubtitle = $bv('involved_books_banner_subtitle', 'Browse our collection of publication titles. 100% of proceeds directly fund our educational and social programs for vulnerable children across Cambodia.');
    $booksSubtitleFr = $bv('involved_books_banner_subtitle_fr');

    // CTA Banner
    $ctaImage = $bv('involved_cta_banner_image');
    $ctaOverlayColor = $bv('involved_cta_banner_overlay_color', '#1d4e7a');
    $ctaImageUrl = $ctaImage ? (str_starts_with($ctaImage, 'http') ? $ctaImage : asset('storage/' . $ctaImage)) : null;
    $ctaBadge = $bv('involved_cta_banner_badge', 'Ready to Help?');
    $ctaTitle = $bv('involved_cta_banner_title', 'Every Action Counts');
    $ctaSubtitle = $bv('involved_cta_banner_subtitle', 'Whether you buy a book, volunteer, partner with us, or send your application - you are helping build a better future for Cambodia\'s children.');
    $ctaSubtitleFr = $bv('involved_cta_banner_subtitle_fr');
@endphp

<div class="space-y-6" x-data="{ tab: 'hero' }">

    {{-- Tab Navigation --}}
    <div class="flex items-center gap-2 border-b border-gray-200 pb-0">
        <button type="button" @click="tab = 'hero'"
                :class="tab === 'hero' ? 'border-b-2 border-[#2d6fa3] text-[#2d6fa3] font-semibold' : 'text-gray-500 hover:text-gray-700 font-medium'"
                class="px-4 py-2.5 text-sm transition-colors">
            Hero Banner
        </button>
        <button type="button" @click="tab = 'books'"
                :class="tab === 'books' ? 'border-b-2 border-[#2d6fa3] text-[#2d6fa3] font-semibold' : 'text-gray-500 hover:text-gray-700 font-medium'"
                class="px-4 py-2.5 text-sm transition-colors">
            Books for Sale Section
        </button>
        <button type="button" @click="tab = 'cta'"
                :class="tab === 'cta' ? 'border-b-2 border-[#2d6fa3] text-[#2d6fa3] font-semibold' : 'text-gray-500 hover:text-gray-700 font-medium'"
                class="px-4 py-2.5 text-sm transition-colors">
            CTA Banner
        </button>
    </div>

    {{-- Single form wrapping both tabs so all fields are submitted regardless of active tab --}}
    <form action="{{ route('admin.involved-banner.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ═══════════════════════════════════════════ --}}
        {{-- HERO BANNER TAB --}}
        {{-- ═══════════════════════════════════════════ --}}
        <div x-show="tab === 'hero'" x-cloak class="space-y-6">
            <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-4 py-2 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Live Preview — Hero Banner
                </div>
                <div id="hero-banner-preview" class="relative py-14 px-6 text-center overflow-hidden" style="background-color: {{ $heroOverlayColor }};">
                    @if($heroImageUrl)
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $heroImageUrl }}'); opacity: 0.35;"></div>
                    @endif
                    <div class="relative">
                        <span id="preview-hero-badge" class="inline-block bg-white text-[#8da83a] text-[10px] font-semibold px-3 py-1 rounded-full mb-3 uppercase tracking-wider">{{ $heroBadge }}</span>
                        <h2 id="preview-hero-title" class="text-xl font-bold text-white mb-2">{{ $heroTitle }}</h2>
                        <p id="preview-hero-subtitle" class="text-white/80 text-xs max-w-md mx-auto">{{ $heroSubtitle }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8" x-data="bilingualForm()">
                <div class="flex items-center justify-between gap-3 mb-1">
                    <div class="flex items-center gap-3">
                        <span class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <h3 class="font-semibold text-gray-700 text-sm">Hero Banner</h3>
                    </div>
                    <div class="lang-tabs" title="Toggle editing language (English / French)">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                    </div>
                </div>
                <p class="text-xs text-gray-400 mb-4">Controls the hero banner at the top of the public "Get Involved" page.</p>

                <hr class="mb-5 border-gray-100">

                <div class="space-y-5">
                    {{-- Hero Background Image --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Background Image</label>

                        @if($heroImage)
                        <div class="mb-3">
                            <img src="{{ str_starts_with($heroImage, 'http') ? $heroImage : asset('storage/' . $heroImage) }}"
                                 alt="Current banner image"
                                 class="w-full max-h-48 object-contain rounded-xl border border-gray-200 bg-gray-50 p-2">
                            <label class="mt-2 inline-flex items-center gap-2 text-xs text-gray-500 cursor-pointer">
                                <input type="checkbox" name="involved_banner_image_clear" value="1" class="rounded border-gray-300 text-red-500 focus:ring-red-400">
                                Remove current image
                            </label>
                        </div>
                        @endif

                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-[#2d6fa3]/40 transition-colors cursor-pointer"
                             x-data="{ fileName: '' }"
                             @dragover.prevent="$el.classList.add('border-[#2d6fa3]')"
                             @dragleave.prevent="$el.classList.remove('border-[#2d6fa3]')"
                             @drop.prevent="$el.classList.remove('border-[#2d6fa3]'); const f = $event.dataTransfer.files[0]; if(f) { $refs.heroFileInput.files = $event.dataTransfer.files; fileName = f.name; }"
                             @click="$refs.heroFileInput.click()">
                            <input type="file" name="involved_banner_image"
                                   accept="image/png,image/jpg,image/jpeg,image/webp,image/svg+xml"
                                   class="hidden" x-ref="heroFileInput"
                                   @change="fileName = $event.target.files[0]?.name || ''">
                            <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm text-gray-500" x-text="fileName || 'Click or drag & drop to upload'"></p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, WebP or SVG — max 5MB</p>
                        </div>

                        <div class="mt-3" x-data="{ showUrl: {{ $heroImage && !str_starts_with($heroImage, 'http') ? 'false' : 'true' }} }">
                            <button type="button" @click="showUrl = !showUrl"
                                    class="text-xs text-[#2d6fa3] hover:text-[#1d4e7a] transition-colors mb-2">
                                <span x-show="!showUrl">+ Or paste an image URL instead</span>
                                <span x-show="showUrl">− Hide URL input</span>
                            </button>
                            <div x-show="showUrl" x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 -translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0">
                                <input type="text" name="involved_banner_image_url"
                                       value="{{ str_starts_with($heroImage ?? '', 'http') ? $heroImage : '' }}"
                                       placeholder="https://example.com/image.png"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
                            </div>
                        </div>
                    </div>

                    {{-- Hero Background Overlay Color --}}
                    <div>
                        <label for="involved_banner_overlay_color" class="block text-sm font-medium text-gray-700 mb-1.5">Background Overlay Color</label>
                        <div class="flex items-center gap-3">
                            <input type="color" id="involved_banner_overlay_color_picker"
                                   value="{{ $heroOverlayColor }}"
                                   class="h-11 w-14 shrink-0 rounded-lg border border-gray-200 cursor-pointer p-1"
                                   onchange="document.getElementById('involved_banner_overlay_color').value = this.value; document.getElementById('hero-banner-preview').style.backgroundColor = this.value;">
                            <input type="text" id="involved_banner_overlay_color" name="involved_banner_overlay_color"
                                   value="{{ $heroOverlayColor }}"
                                   placeholder="#1d4e7a"
                                   oninput="if(/^#[0-9A-Fa-f]{6}$/.test(this.value)) { document.getElementById('involved_banner_overlay_color_picker').value = this.value; document.getElementById('hero-banner-preview').style.backgroundColor = this.value; }"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
                        </div>
                    </div>

                    {{-- Hero Badge Text & Title --}}
                    <div class="grid lg:grid-cols-2 gap-5">
                        <div>
                            <label for="involved_banner_badge" class="block text-sm font-medium text-gray-700 mb-1.5">Badge Text</label>
                            <input type="text" id="involved_banner_badge" name="involved_banner_badge"
                                   value="{{ $heroBadge }}"
                                   oninput="document.getElementById('preview-hero-badge').textContent = this.value || 'Join Our Mission'"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>
                        <div>
                            <label for="involved_banner_title" class="block text-sm font-medium text-gray-700 mb-1.5">Hero Title</label>
                            <input type="text" id="involved_banner_title" name="involved_banner_title"
                                   value="{{ $heroTitle }}"
                                   oninput="document.getElementById('preview-hero-title').textContent = this.value || 'Get Involved'"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>
                    </div>

                    {{-- Hero Subtitle --}}
                    <div x-show="lang === 'en'">
                        <label for="involved_banner_subtitle" class="block text-sm font-medium text-gray-700 mb-1.5">Hero Subtitle</label>
                        <x-admin.rich-text id="involved_banner_subtitle" name="involved_banner_subtitle" :value="$heroSubtitle" lang="en" :rows="2" />
                    </div>
                    <div x-show="lang === 'fr'" x-cloak>
                        <label for="involved_banner_subtitle_fr" class="block text-sm font-medium text-gray-700 mb-1.5">Hero Subtitle (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                        <x-admin.rich-text id="involved_banner_subtitle_fr" name="involved_banner_subtitle_fr" :value="$heroSubtitleFr" lang="fr" :rows="2" placeholder="Découvrez les nombreuses façons de soutenir la mission de Krousar Thmey…" />
                        <p class="text-xs text-gray-400 mt-1">Shown to French-language visitors. Leave blank to reuse the English subtitle.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════ --}}
        {{-- BOOKS FOR SALE BANNER TAB --}}
        {{-- ═══════════════════════════════════════════ --}}
        <div x-show="tab === 'books'" x-cloak class="space-y-6">
            <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-4 py-2 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Live Preview — Books for Sale Section
                </div>
                <div id="books-banner-preview" class="relative py-14 px-6 text-center overflow-hidden" style="background-color: {{ $booksOverlayColor }};">
                    @if($booksImageUrl)
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $booksImageUrl }}'); opacity: 0.35;"></div>
                    @endif
                    <div class="relative">
                        <span id="preview-books-badge" class="inline-block bg-white text-[#e8a020] text-[10px] font-semibold px-3 py-1 rounded-full mb-3 uppercase tracking-wider">{{ $booksBadge }}</span>
                        <h2 id="preview-books-title" class="text-xl font-bold text-white mb-2">{{ $booksTitle }}</h2>
                        <p id="preview-books-subtitle" class="text-white/80 text-xs max-w-md mx-auto">{{ $booksSubtitle }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8">
                <div class="flex items-center gap-3 mb-1">
                    <span class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </span>
                    <h3 class="font-semibold text-gray-700 text-sm">Books for Sale Section Banner</h3>
                </div>
                <p class="text-xs text-gray-400 mb-4">Controls the banner background of the "Support Through Literature" section on the Get Involved page.</p>

                <hr class="mb-5 border-gray-100">

                <div class="space-y-5">
                    {{-- Books Background Image --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Background Image</label>

                        @if($booksImage)
                        <div class="mb-3">
                            <img src="{{ str_starts_with($booksImage, 'http') ? $booksImage : asset('storage/' . $booksImage) }}"
                                 alt="Current books section image"
                                 class="w-full max-h-48 object-contain rounded-xl border border-gray-200 bg-gray-50 p-2">
                            <label class="mt-2 inline-flex items-center gap-2 text-xs text-gray-500 cursor-pointer">
                                <input type="checkbox" name="involved_books_banner_image_clear" value="1" class="rounded border-gray-300 text-red-500 focus:ring-red-400">
                                Remove current image
                            </label>
                        </div>
                        @endif

                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-[#2d6fa3]/40 transition-colors cursor-pointer"
                             x-data="{ fileName: '' }"
                             @dragover.prevent="$el.classList.add('border-[#2d6fa3]')"
                             @dragleave.prevent="$el.classList.remove('border-[#2d6fa3]')"
                             @drop.prevent="$el.classList.remove('border-[#2d6fa3]'); const f = $event.dataTransfer.files[0]; if(f) { $refs.booksFileInput.files = $event.dataTransfer.files; fileName = f.name; }"
                             @click="$refs.booksFileInput.click()">
                            <input type="file" name="involved_books_banner_image"
                                   accept="image/png,image/jpg,image/jpeg,image/webp,image/svg+xml"
                                   class="hidden" x-ref="booksFileInput"
                                   @change="fileName = $event.target.files[0]?.name || ''">
                            <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm text-gray-500" x-text="fileName || 'Click or drag & drop to upload'"></p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, WebP or SVG — max 5MB</p>
                        </div>

                        <div class="mt-3" x-data="{ showUrl: {{ $booksImage && !str_starts_with($booksImage, 'http') ? 'false' : 'true' }} }">
                            <button type="button" @click="showUrl = !showUrl"
                                    class="text-xs text-[#2d6fa3] hover:text-[#1d4e7a] transition-colors mb-2">
                                <span x-show="!showUrl">+ Or paste an image URL instead</span>
                                <span x-show="showUrl">− Hide URL input</span>
                            </button>
                            <div x-show="showUrl" x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 -translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0">
                                <input type="text" name="involved_books_banner_image_url"
                                       value="{{ str_starts_with($booksImage ?? '', 'http') ? $booksImage : '' }}"
                                       placeholder="https://example.com/image.png"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
                            </div>
                        </div>
                    </div>

                    {{-- Books Overlay Color --}}
                    <div>
                        <label for="involved_books_banner_overlay_color" class="block text-sm font-medium text-gray-700 mb-1.5">Background Overlay Color</label>
                        <div class="flex items-center gap-3">
                            <input type="color" id="involved_books_banner_overlay_color_picker"
                                   value="{{ $booksOverlayColor }}"
                                   class="h-11 w-14 shrink-0 rounded-lg border border-gray-200 cursor-pointer p-1"
                                   onchange="document.getElementById('involved_books_banner_overlay_color').value = this.value; document.getElementById('books-banner-preview').style.backgroundColor = this.value;">
                            <input type="text" id="involved_books_banner_overlay_color" name="involved_books_banner_overlay_color"
                                   value="{{ $booksOverlayColor }}"
                                   placeholder="#163b5d"
                                   oninput="if(/^#[0-9A-Fa-f]{6}$/.test(this.value)) { document.getElementById('involved_books_banner_overlay_color_picker').value = this.value; document.getElementById('books-banner-preview').style.backgroundColor = this.value; }"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
                        </div>
                    </div>

                    {{-- Books Badge & Title --}}
                    <div class="grid lg:grid-cols-2 gap-5">
                        <div>
                            <label for="involved_books_banner_badge" class="block text-sm font-medium text-gray-700 mb-1.5">Badge Text</label>
                            <input type="text" id="involved_books_banner_badge" name="involved_books_banner_badge"
                                   value="{{ $booksBadge }}"
                                   oninput="document.getElementById('preview-books-badge').textContent = this.value || 'Books for Sale'"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>
                        <div>
                            <label for="involved_books_banner_title" class="block text-sm font-medium text-gray-700 mb-1.5">Section Title</label>
                            <input type="text" id="involved_books_banner_title" name="involved_books_banner_title"
                                   value="{{ $booksTitle }}"
                                   oninput="document.getElementById('preview-books-title').textContent = this.value || 'Support Through Literature'"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>
                    </div>

                    {{-- Books Subtitle --}}
                    <div x-data="bilingualForm()">
                        <div class="flex items-center justify-between gap-3 mb-1.5">
                            <label class="block text-sm font-medium text-gray-700 mb-0">Section Subtitle</label>
                            <div class="lang-tabs" title="Toggle editing language (English / French)">
                                <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                                <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                            </div>
                        </div>
                        <div x-show="lang === 'en'">
                            <x-admin.rich-text name="involved_books_banner_subtitle" :value="$booksSubtitle" lang="en" :rows="3" />
                        </div>
                        <div x-show="lang === 'fr'" x-cloak>
                            <x-admin.rich-text name="involved_books_banner_subtitle_fr" :value="$booksSubtitleFr" lang="fr" :rows="3"
                                               placeholder="Parcourez notre collection de publications…" />
                            <p class="text-xs text-gray-400 mt-1">Leave blank to reuse the English subtitle.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════ --}}
        {{-- CTA BANNER TAB --}}
        {{-- ═══════════════════════════════════════════ --}}
        <div x-show="tab === 'cta'" x-cloak class="space-y-6">
            <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-4 py-2 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Live Preview — CTA Banner
                </div>
                <div id="cta-banner-preview" class="relative py-14 px-6 text-center overflow-hidden" style="background-color: {{ $ctaOverlayColor }};">
                    @if($ctaImageUrl)
                    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $ctaImageUrl }}'); opacity: 0.35;"></div>
                    @endif
                    <div class="relative">
                        <span id="preview-cta-badge" class="inline-block bg-white text-[#8da83a] text-[10px] font-semibold px-3 py-1 rounded-full mb-3 uppercase tracking-wider">{{ $ctaBadge }}</span>
                        <h2 id="preview-cta-title" class="text-xl font-bold text-white mb-2">{{ $ctaTitle }}</h2>
                        <p id="preview-cta-subtitle" class="text-white/80 text-xs max-w-md mx-auto">{{ $ctaSubtitle }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8">
                <div class="flex items-center gap-3 mb-1">
                    <span class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                    <h3 class="font-semibold text-gray-700 text-sm">CTA Banner</h3>
                </div>
                <p class="text-xs text-gray-400 mb-4">Controls the "Ready to Help?" call-to-action banner at the bottom of the Get Involved page.</p>

                <hr class="mb-5 border-gray-100">

                <div class="space-y-5">
                    {{-- CTA Background Image --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Background Image</label>

                        @if($ctaImage)
                        <div class="mb-3">
                            <img src="{{ str_starts_with($ctaImage, 'http') ? $ctaImage : asset('storage/' . $ctaImage) }}"
                                 alt="Current CTA section image"
                                 class="w-full max-h-48 object-contain rounded-xl border border-gray-200 bg-gray-50 p-2">
                            <label class="mt-2 inline-flex items-center gap-2 text-xs text-gray-500 cursor-pointer">
                                <input type="checkbox" name="involved_cta_banner_image_clear" value="1" class="rounded border-gray-300 text-red-500 focus:ring-red-400">
                                Remove current image
                            </label>
                        </div>
                        @endif

                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-[#2d6fa3]/40 transition-colors cursor-pointer"
                             x-data="{ fileName: '' }"
                             @dragover.prevent="$el.classList.add('border-[#2d6fa3]')"
                             @dragleave.prevent="$el.classList.remove('border-[#2d6fa3]')"
                             @drop.prevent="$el.classList.remove('border-[#2d6fa3]'); const f = $event.dataTransfer.files[0]; if(f) { $refs.ctaFileInput.files = $event.dataTransfer.files; fileName = f.name; }"
                             @click="$refs.ctaFileInput.click()">
                            <input type="file" name="involved_cta_banner_image"
                                   accept="image/png,image/jpg,image/jpeg,image/webp,image/svg+xml"
                                   class="hidden" x-ref="ctaFileInput"
                                   @change="fileName = $event.target.files[0]?.name || ''">
                            <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm text-gray-500" x-text="fileName || 'Click or drag & drop to upload'"></p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, WebP or SVG — max 5MB</p>
                        </div>

                        <div class="mt-3" x-data="{ showUrl: {{ $ctaImage && !str_starts_with($ctaImage, 'http') ? 'false' : 'true' }} }">
                            <button type="button" @click="showUrl = !showUrl"
                                    class="text-xs text-[#2d6fa3] hover:text-[#1d4e7a] transition-colors mb-2">
                                <span x-show="!showUrl">+ Or paste an image URL instead</span>
                                <span x-show="showUrl">− Hide URL input</span>
                            </button>
                            <div x-show="showUrl" x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 -translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0">
                                <input type="text" name="involved_cta_banner_image_url"
                                       value="{{ str_starts_with($ctaImage ?? '', 'http') ? $ctaImage : '' }}"
                                       placeholder="https://example.com/image.png"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
                            </div>
                        </div>
                    </div>

                    {{-- CTA Overlay Color --}}
                    <div>
                        <label for="involved_cta_banner_overlay_color" class="block text-sm font-medium text-gray-700 mb-1.5">Background Overlay Color</label>
                        <div class="flex items-center gap-3">
                            <input type="color" id="involved_cta_banner_overlay_color_picker"
                                   value="{{ $ctaOverlayColor }}"
                                   class="h-11 w-14 shrink-0 rounded-lg border border-gray-200 cursor-pointer p-1"
                                   onchange="document.getElementById('involved_cta_banner_overlay_color').value = this.value; document.getElementById('cta-banner-preview').style.backgroundColor = this.value;">
                            <input type="text" id="involved_cta_banner_overlay_color" name="involved_cta_banner_overlay_color"
                                   value="{{ $ctaOverlayColor }}"
                                   placeholder="#1d4e7a"
                                   oninput="if(/^#[0-9A-Fa-f]{6}$/.test(this.value)) { document.getElementById('involved_cta_banner_overlay_color_picker').value = this.value; document.getElementById('cta-banner-preview').style.backgroundColor = this.value; }"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
                        </div>
                    </div>

                    {{-- CTA Badge & Title --}}
                    <div class="grid lg:grid-cols-2 gap-5">
                        <div>
                            <label for="involved_cta_banner_badge" class="block text-sm font-medium text-gray-700 mb-1.5">Badge Text</label>
                            <input type="text" id="involved_cta_banner_badge" name="involved_cta_banner_badge"
                                   value="{{ $ctaBadge }}"
                                   oninput="document.getElementById('preview-cta-badge').textContent = this.value || 'Ready to Help?'"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>
                        <div>
                            <label for="involved_cta_banner_title" class="block text-sm font-medium text-gray-700 mb-1.5">Section Title</label>
                            <input type="text" id="involved_cta_banner_title" name="involved_cta_banner_title"
                                   value="{{ $ctaTitle }}"
                                   oninput="document.getElementById('preview-cta-title').textContent = this.value || 'Every Action Counts'"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>
                    </div>

                    {{-- CTA Subtitle --}}
                    <div x-data="bilingualForm()">
                        <div class="flex items-center justify-between gap-3 mb-1.5">
                            <label class="block text-sm font-medium text-gray-700 mb-0">Section Subtitle</label>
                            <div class="lang-tabs" title="Toggle editing language (English / French)">
                                <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                                <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                            </div>
                        </div>
                        <div x-show="lang === 'en'">
                            <x-admin.rich-text name="involved_cta_banner_subtitle" :value="$ctaSubtitle" lang="en" :rows="3" />
                        </div>
                        <div x-show="lang === 'fr'" x-cloak>
                            <x-admin.rich-text name="involved_cta_banner_subtitle_fr" :value="$ctaSubtitleFr" lang="fr" :rows="3"
                                               placeholder="Que vous achetiez un livre, fassiez du bénévolat…" />
                            <p class="text-xs text-gray-400 mt-1">Leave blank to reuse the English subtitle.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Submit buttons (visible on all tabs) --}}
        <div x-show="tab === 'hero' || tab === 'books' || tab === 'cta'" class="flex items-center gap-3 pt-4 pb-2">
            <button type="submit" class="btn-primary">Save All Banners</button>
            <a href="{{ route('admin.jobs.index') }}" class="text-gray-400 hover:text-gray-600 text-sm transition-colors">Cancel</a>
            <a href="{{ route('involved') }}" target="_blank" class="ml-auto flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View live page
            </a>
        </div>

    </form>

</div>

@endsection
