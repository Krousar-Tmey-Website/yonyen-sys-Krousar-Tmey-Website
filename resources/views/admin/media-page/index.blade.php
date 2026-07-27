@extends('admin.layouts.app')

@section('title', 'Media Page')
@section('page-title', 'Media Page')

@section('content')

<div x-data="{ tab: 'banner', lang: 'en' }">

    {{-- ── Professional Page Header ── --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8 mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-xl bg-gradient-to-br from-[#2d6fa3] to-[#1d4e7a] flex items-center justify-center flex-shrink-0 shadow-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </span>
                    Media Page Settings
                </h2>
                <p class="text-sm text-gray-500 mt-1.5 ml-[42px]">Manage the public Media page — banner, press article, and latest news section.</p>
            </div>
            <a href="{{ route('media') }}" target="_blank"
               class="inline-flex items-center gap-2 px-4 py-2 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                View Site
            </a>
        </div>

        {{-- Tab Navigation --}}
        <div class="flex justify-center mt-6 pt-5 border-t border-gray-100">
            <div class="inline-flex bg-gray-100/80 rounded-xl p-1 gap-1 shadow-inner">
                <button @click="tab = 'banner'"
                        :class="tab === 'banner' ? 'bg-white shadow-sm text-[#2d6fa3] font-semibold ring-1 ring-gray-200/50' : 'text-gray-500 hover:text-gray-700 font-medium'"
                        class="px-7 py-2.5 rounded-lg text-sm transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Media Banner
                </button>
                <button @click="tab = 'content'"
                        :class="tab === 'content' ? 'bg-white shadow-sm text-[#2d6fa3] font-semibold ring-1 ring-gray-200/50' : 'text-gray-500 hover:text-gray-700 font-medium'"
                        class="px-7 py-2.5 rounded-lg text-sm transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    Media Page
                </button>
            </div>
        </div>
    </div>

    {{-- Tab Content Wrapper --}}
    <div class="space-y-6">

@php
    // ── Banner tab variables ──
    $bv = fn($key, $default = '') => old($key, $settings[$key] ?? $default);
    $bvFr = fn($key, $default = '') => old($key.'_fr', $settings[$key.'_fr'] ?? $default);
    $bannerImage = $bv('media_banner_image');
    $bannerOverlayColor = $bv('media_banner_overlay_color', '#1a3c6e');
    $bannerImageUrl = $bannerImage ? (str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage)) : null;
    $bannerBadge = $bv('media_banner_badge', 'Media');
    $bannerTitle = $bv('media_banner_title', 'Krousar Thmey In The Media');
    $bannerSubtitle = $bv('media_banner_subtitle', 'Press coverage and the latest news from Krousar Thmey.');
    $bannerSubtitleFr = $bvFr('media_banner_subtitle');
    $btn1Text = $bv('media_banner_btn1_text', 'Donate Now');
    $btn1Url  = $bv('media_banner_btn1_url', '/donate');
    $btn2Text = $bv('media_banner_btn2_text', 'Get Involved');
    $btn2Url  = $bv('media_banner_btn2_url', '/get-involved');
    $btn3Text = $bv('media_banner_btn3_text', 'Annual Report');
    $btn3Url  = $bv('media_banner_btn3_url', '/resources#annual-reports');

    // ── Content tab variables ──
    $previewTitle       = $settings['media_title'] ?? 'Media';
    $previewSourceLabel = $settings['media_press_source_label'] ?? 'Press Article';
    $previewSourceName  = $settings['media_press_source_name'] ?? 'The Phnom Penh Post';
    $previewHeadline    = $settings['media_press_headline'] ?? 'Classical arts not a priority in schools today';
    $previewDate        = $settings['media_press_date'] ?? '07.25.17';
    $previewExcerpt     = $settings['media_press_excerpt'] ?? "Traditional Cambodian art forms such as classical dance and music have been passed down throughout the generations as a way for children to learn and preserve the meaning of their culture. However, as the education sector changes, gaining knowledge of the arts at a young age is proving less essential for the Kingdom's public schools…";
    $previewImage       = $settings['media_press_image'] ?? null;
    $previewImageUrl    = $previewImage ? (str_starts_with($previewImage, 'http') ? $previewImage : asset('storage/' . $previewImage)) : asset('images/cultural.jpg');
@endphp

{{-- ========================================================
     TAB: MEDIA BANNER
     ======================================================== --}}
<div x-show="tab === 'banner'" class="space-y-6">
    {{-- Live Preview --}}
    <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
        <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-4 py-2 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Live Preview
        </div>
        <div id="media-banner-preview" class="relative py-14 px-6 text-center overflow-hidden" style="background-color: {{ $bannerOverlayColor }};">
            @if($bannerImageUrl)
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $bannerImageUrl }}'); opacity: 0.35;"></div>
            @endif
            <div class="relative">
                <span id="preview-badge" class="inline-block bg-white text-[#eea91d] text-[10px] font-semibold px-3 py-1 rounded-full mb-3 uppercase tracking-wider">{{ $bannerBadge }}</span>
                <h2 id="preview-title" class="text-xl font-bold text-white mb-2">{{ $bannerTitle }}</h2>
                <p id="preview-subtitle" class="text-white/80 text-xs max-w-md mx-auto mb-4">{{ $bannerSubtitle }}</p>
                <div id="preview-buttons" class="flex flex-wrap items-center justify-center gap-2">
                    <span id="preview-btn1" class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-[10px] font-semibold bg-white text-[#2d6fa3] {{ $btn1Text ? '' : 'opacity-30' }}">{{ $btn1Text ?: 'Button 1' }}</span>
                    <span id="preview-btn2" class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-[10px] font-semibold border border-white/40 text-white {{ $btn2Text ? '' : 'opacity-30' }}">{{ $btn2Text ?: 'Button 2' }}</span>
                    <span id="preview-btn3" class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-[10px] font-semibold border border-white/40 text-white {{ $btn3Text ? '' : 'opacity-30' }}">{{ $btn3Text ?: 'Button 3' }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Banner Form --}}
    <form action="{{ route('admin.media-banner.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-5" x-data="bilingualForm()">
        @csrf
        <div class="flex items-center justify-between gap-3">
            <h3 class="font-bold text-gray-700 text-sm">Page Banner</h3>
            <div class="lang-tabs" title="Toggle editing language (English / French)">
                <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
            </div>
        </div>
        <p class="text-xs text-gray-400 -mt-3">Controls the hero banner shown at the top of the public Media page.</p>

        {{-- Background Image --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Background Image</label>
            @if($bannerImage)
            <div class="mb-3">
                <img src="{{ str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage) }}"
                     alt="Current banner image"
                     class="w-full max-h-48 object-contain rounded-xl border border-gray-200 bg-gray-50 p-2">
                <label class="mt-2 inline-flex items-center gap-2 text-xs text-gray-500 cursor-pointer">
                    <input type="checkbox" name="media_banner_image_clear" value="1" class="rounded border-gray-300 text-red-500 focus:ring-red-400">
                    Remove current image
                </label>
            </div>
            @endif
            <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-[#2d6fa3]/40 transition-colors cursor-pointer"
                 x-data="{ fileName: '' }"
                 @dragover.prevent="$el.classList.add('border-[#2d6fa3]')"
                 @dragleave.prevent="$el.classList.remove('border-[#2d6fa3]')"
                 @drop.prevent="$el.classList.remove('border-[#2d6fa3]'); const f = $event.dataTransfer.files[0]; if(f) { $refs.fileInput.files = $event.dataTransfer.files; fileName = f.name; }"
                 @click="$refs.fileInput.click()">
                <input type="file" name="media_banner_image"
                       accept="image/png,image/jpg,image/jpeg,image/webp,image/svg+xml"
                       class="hidden" x-ref="fileInput"
                       @change="fileName = $event.target.files[0]?.name || ''">
                <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-sm text-gray-500" x-text="fileName || 'Click or drag & drop to upload'"></p>
                <p class="text-xs text-gray-400 mt-1">PNG, JPG, WebP or SVG — max 5MB</p>
            </div>
            <div class="mt-3" x-data="{ showUrl: {{ $bannerImage && !str_starts_with($bannerImage, 'http') ? 'false' : 'true' }} }">
                <button type="button" @click="showUrl = !showUrl" class="text-xs text-[#2d6fa3] hover:text-[#1d4e7a] transition-colors mb-2">
                    <span x-show="!showUrl">+ Or paste an image URL instead</span>
                    <span x-show="showUrl">− Hide URL input</span>
                </button>
                <div x-show="showUrl" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                    <input type="text" name="media_banner_image_url"
                           value="{{ str_starts_with($bannerImage ?? '', 'http') ? $bannerImage : '' }}"
                           placeholder="https://example.com/image.png"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
                </div>
            </div>
        </div>

        {{-- Background Overlay Color --}}
        <div>
            <label for="media_banner_overlay_color" class="block text-sm font-medium text-gray-700 mb-1.5">Background Overlay Color</label>
            <div class="flex items-center gap-3">
                <input type="color" id="media_banner_overlay_color_picker"
                       value="{{ $bannerOverlayColor }}"
                       class="h-11 w-14 shrink-0 rounded-lg border border-gray-200 cursor-pointer p-1"
                       onchange="document.getElementById('media_banner_overlay_color').value = this.value; document.getElementById('media-banner-preview').style.backgroundColor = this.value;">
                <input type="text" id="media_banner_overlay_color" name="media_banner_overlay_color"
                       value="{{ $bannerOverlayColor }}"
                       placeholder="#1a3c6e"
                       oninput="if(/^#[0-9A-Fa-f]{6}$/.test(this.value)) { document.getElementById('media_banner_overlay_color_picker').value = this.value; document.getElementById('media-banner-preview').style.backgroundColor = this.value; }"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
            </div>
        </div>

        {{-- Badge Text --}}
        <div x-show="lang === 'en'">
            <label for="media_banner_badge" class="block text-sm font-medium text-gray-700 mb-1.5">Badge Text</label>
            <input type="text" id="media_banner_badge" name="media_banner_badge"
                   value="{{ $bannerBadge }}"
                   oninput="document.getElementById('preview-badge').textContent = this.value || 'Media'"
                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
        </div>

        {{-- Hero Title --}}
        <div x-show="lang === 'en'">
            <label for="media_banner_title" class="block text-sm font-medium text-gray-700 mb-1.5">Hero Title</label>
            <input type="text" id="media_banner_title" name="media_banner_title"
                   value="{{ $bannerTitle }}"
                   oninput="document.getElementById('preview-title').textContent = this.value || 'Krousar Thmey In The Media'"
                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
        </div>

        {{-- Hero Subtitle --}}
        <div x-show="lang === 'en'">
            <label for="media_banner_subtitle" class="block text-sm font-medium text-gray-700 mb-1.5">Hero Subtitle</label>
            <x-admin.rich-text id="media_banner_subtitle" name="media_banner_subtitle" :value="$bannerSubtitle" lang="en" :rows="2" />
        </div>
        <div x-show="lang === 'fr'" x-cloak>
            <label for="media_banner_subtitle_fr" class="block text-sm font-medium text-gray-700 mb-1.5">Hero Subtitle (French) <span class="text-gray-400 font-normal">(optional)</span></label>
            <x-admin.rich-text id="media_banner_subtitle_fr" name="media_banner_subtitle_fr" :value="$bannerSubtitleFr" lang="fr" :rows="2" placeholder="Couverture médiatique et actualités de Krousar Thmey…" />
            <p class="text-xs text-gray-400 mt-1">Shown to French-language visitors. Leave blank to reuse the English subtitle.</p>
        </div>

        {{-- Banner Action Buttons --}}
        <div class="border-t border-gray-100 pt-4 space-y-4">
            <p class="text-sm font-medium text-gray-700 flex items-center gap-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                Banner Action Buttons
            </p>
            <p class="text-xs text-gray-400 -mt-2">Configure up to 3 buttons. Leave empty to hide.</p>

            {{-- Button 1 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="media_banner_btn1_text" class="block text-xs font-medium text-gray-600 mb-1">Button 1 Text</label>
                    <input type="text" id="media_banner_btn1_text" name="media_banner_btn1_text"
                           value="{{ $btn1Text }}"
                           oninput="document.getElementById('preview-btn1').textContent = this.value || 'Button 1'; document.getElementById('preview-btn1').classList.toggle('opacity-30', !this.value)"
                           placeholder="Donate Now"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label for="media_banner_btn1_url" class="block text-xs font-medium text-gray-600 mb-1">Button 1 URL</label>
                    <input type="text" id="media_banner_btn1_url" name="media_banner_btn1_url"
                           value="{{ $btn1Url }}"
                           placeholder="/donate"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>

            {{-- Button 2 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="media_banner_btn2_text" class="block text-xs font-medium text-gray-600 mb-1">Button 2 Text</label>
                    <input type="text" id="media_banner_btn2_text" name="media_banner_btn2_text"
                           value="{{ $btn2Text }}"
                           oninput="document.getElementById('preview-btn2').textContent = this.value || 'Button 2'; document.getElementById('preview-btn2').classList.toggle('opacity-30', !this.value)"
                           placeholder="Get Involved"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label for="media_banner_btn2_url" class="block text-xs font-medium text-gray-600 mb-1">Button 2 URL</label>
                    <input type="text" id="media_banner_btn2_url" name="media_banner_btn2_url"
                           value="{{ $btn2Url }}"
                           placeholder="/get-involved"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>

            {{-- Button 3 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="media_banner_btn3_text" class="block text-xs font-medium text-gray-600 mb-1">Button 3 Text</label>
                    <input type="text" id="media_banner_btn3_text" name="media_banner_btn3_text"
                           value="{{ $btn3Text }}"
                           oninput="document.getElementById('preview-btn3').textContent = this.value || 'Button 3'; document.getElementById('preview-btn3').classList.toggle('opacity-30', !this.value)"
                           placeholder="Annual Report"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label for="media_banner_btn3_url" class="block text-xs font-medium text-gray-600 mb-1">Button 3 URL</label>
                    <input type="text" id="media_banner_btn3_url" name="media_banner_btn3_url"
                           value="{{ $btn3Url }}"
                           placeholder="/resources#annual-reports"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 pt-1">
            <button type="submit" class="btn-primary">Save Banner</button>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600 text-sm transition-colors">Cancel</a>
            <a href="{{ route('media') }}" target="_blank" class="ml-auto flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View live page
            </a>
        </div>
    </form>
</div>

{{-- ========================================================
     TAB: MEDIA PAGE
     ======================================================== --}}
<div x-show="tab === 'content'" class="space-y-6">

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- Live Preview --}}
    <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
        <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-4 py-2 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Live Preview
        </div>
        <div class="bg-white px-8 py-8">
            <p id="preview-page-title" class="text-center text-xl font-extrabold tracking-tight text-[#0A5EA8] uppercase mb-6">{{ $previewTitle }}</p>
            <div class="grid sm:grid-cols-2 gap-5 items-start">
                <img id="preview-image" src="{{ $previewImageUrl }}" alt="" class="w-full h-32 object-cover rounded-xl">
                <div>
                    <p class="text-xs mb-1.5">
                        <span id="preview-source-label" class="font-bold text-gray-700">{{ $previewSourceLabel }}</span>
                        <span class="text-gray-400">/</span>
                        <span id="preview-source-name" class="text-[#2d6fa3] font-semibold">{{ $previewSourceName }}</span>
                    </p>
                    <p id="preview-headline" class="font-bold text-gray-800 text-sm mb-1">&ldquo;{{ $previewHeadline }}&rdquo;</p>
                    <p class="italic text-gray-400 text-xs mb-2">published <span id="preview-date">{{ $previewDate }}</span></p>
                    <div id="preview-excerpt" class="italic text-gray-500 text-xs leading-relaxed line-clamp-3 rich-text-content">{!! $previewExcerpt !!}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Page Content Form --}}
    <form action="{{ route('admin.media-page.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6" x-data="bilingualForm()">
        @csrf

        {{-- Page Header --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-5">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </span>
                Page Header
            </h3>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Page Title</label>
                <input type="text" name="media_title" value="{{ old('media_title', $settings['media_title'] ?? 'Media') }}"
                       oninput="document.getElementById('preview-page-title').textContent = this.value || 'Media'"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400">The large heading at the top of the Media page.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Communication Officer Email</label>
                <input type="email" name="media_contact_email" value="{{ old('media_contact_email', $settings['media_contact_email'] ?? 'communication@krousar-thmey.org') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400">Shown as "For any request, please contact our Communication Officer at…"</p>
            </div>
        </div>

        {{-- Featured Press Article --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-5">
            <div class="flex items-center justify-between gap-3">
                <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </span>
                    Featured Press Article
                    <span class="text-xs font-normal text-gray-400">("Krousar Thmey In The News")</span>
                </h3>
                <div class="lang-tabs" title="Toggle editing language (English / French)">
                    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Section Heading</label>
                <input type="text" name="media_press_heading" value="{{ old('media_press_heading', $settings['media_press_heading'] ?? 'Krousar Thmey In The News') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Photo</label>
                @if(!empty($settings['media_press_image']))
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100 mb-3">
                    <img src="{{ $previewImageUrl }}" alt="Current press photo" class="h-14 w-24 object-cover rounded-lg border border-gray-200">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium text-gray-600 mb-0.5">Current photo</p>
                        <p class="text-xs text-gray-400 truncate">{{ $settings['media_press_image'] }}</p>
                    </div>
                    <label class="flex items-center gap-1.5 text-xs text-red-500 hover:text-red-700 cursor-pointer flex-shrink-0">
                        <input type="checkbox" name="remove_media_press_image" value="1" class="rounded border-gray-300 text-red-500 w-3.5 h-3.5">
                        Remove
                    </label>
                </div>
                @else
                <div class="flex items-center gap-3 p-3 bg-[#2d6fa3]/5 rounded-xl border border-[#2d6fa3]/10 mb-3">
                    <div class="h-14 w-24 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                        <span class="text-[#2d6fa3]/50 text-xs">No photo</span>
                    </div>
                    <p class="text-xs text-gray-500">Falls back to a default photo until you upload one.</p>
                </div>
                @endif
                <input type="file" name="media_press_image_file" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                <p class="mt-1.5 text-xs text-gray-400">Max 4MB. Landscape photos work best.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Source Label</label>
                    <input type="text" name="media_press_source_label" value="{{ old('media_press_source_label', $settings['media_press_source_label'] ?? 'Press Article') }}"
                           oninput="document.getElementById('preview-source-label').textContent = this.value"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Publication Name</label>
                    <input type="text" name="media_press_source_name" value="{{ old('media_press_source_name', $settings['media_press_source_name'] ?? 'The Phnom Penh Post') }}"
                           oninput="document.getElementById('preview-source-name').textContent = this.value"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Headline</label>
                <input type="text" name="media_press_headline" value="{{ old('media_press_headline', $settings['media_press_headline'] ?? 'Classical arts not a priority in schools today') }}"
                       oninput="document.getElementById('preview-headline').textContent = '“' + this.value + '”'"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Published Date</label>
                <input type="text" name="media_press_date" value="{{ old('media_press_date', $settings['media_press_date'] ?? '07.25.17') }}"
                       oninput="document.getElementById('preview-date').textContent = this.value"
                       placeholder="e.g. 07.25.17"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400">Free text — shown exactly as typed, e.g. "published 07.25.17".</p>
            </div>

            @php $excerptDefault = "Traditional Cambodian art forms such as classical dance and music have been passed down throughout the generations as a way for children to learn and preserve the meaning of their culture. However, as the education sector changes, gaining knowledge of the arts at a young age is proving less essential for the Kingdom's public schools…"; @endphp
            <div x-show="lang === 'en'">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Excerpt</label>
                <x-admin.rich-text name="media_press_excerpt" :value="old('media_press_excerpt', $settings['media_press_excerpt'] ?? $excerptDefault)" lang="en" :rows="3" />
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Excerpt (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="media_press_excerpt_fr" :value="old('media_press_excerpt_fr', $settings['media_press_excerpt_fr'] ?? '')" lang="fr" :rows="3" placeholder="Les formes d'art traditionnelles cambodgiennes…" />
                <p class="mt-1.5 text-xs text-gray-400">Shown to French-language visitors. Leave blank to reuse the English excerpt.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Article URL</label>
                <input type="url" name="media_press_article_url" value="{{ old('media_press_article_url', $settings['media_press_article_url'] ?? '') }}" placeholder="https://..."
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400">Where the "Read the article" button sends visitors — link to the original press coverage.</p>
            </div>
        </div>

        {{-- Latest News Section --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-5">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </span>
                Latest News Section
            </h3>
            <p class="text-xs text-gray-400 -mt-2">The 3 news cards below this heading are pulled automatically from your most recent published News Articles.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Section Heading</label>
                    <input type="text" name="media_latest_heading" value="{{ old('media_latest_heading', $settings['media_latest_heading'] ?? 'Latest News') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Intro Link Text</label>
                    <input type="text" name="media_latest_intro" value="{{ old('media_latest_intro', $settings['media_latest_intro'] ?? "Visit our News section to find more of Krousar Thmey's news") }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-semibold rounded-xl transition-colors">
                Save Page Content
            </button>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
            <a href="{{ route('media') }}" target="_blank" class="ml-auto flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View live page
            </a>
        </div>
    </form>
</div>

    </div>
    {{-- End Tab Content Wrapper --}}
</div>

@endsection
