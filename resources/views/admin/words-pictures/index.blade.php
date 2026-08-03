@extends('admin.layouts.app')

@section('title', 'Words and Pictures')
@section('page-title', 'Words and Pictures')

@section('content')

<div x-data="{ tab: 'banner', lang: 'en' }">

    {{-- ── Professional Page Header ── --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8 mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-xl bg-gradient-to-br from-[#2d6fa3] to-[#1d4e7a] flex items-center justify-center flex-shrink-0 shadow-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/>
                        </svg>
                    </span>
                    Words and Pictures Settings
                </h2>
                <p class="text-sm text-gray-500 mt-1.5 ml-[42px]">Manage the public Words and Pictures page — banner, app details, and press article.</p>
            </div>
            <a href="{{ route('words-pictures') }}" target="_blank"
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
                    Words Banner
                </button>
                <button @click="tab = 'content'"
                        :class="tab === 'content' ? 'bg-white shadow-sm text-[#2d6fa3] font-semibold ring-1 ring-gray-200/50' : 'text-gray-500 hover:text-gray-700 font-medium'"
                        class="px-7 py-2.5 rounded-lg text-sm transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    Words Page
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
    $bannerImage = $bv('words_pictures_banner_image');
    $bannerOverlayColor = $bv('words_pictures_banner_overlay_color', '#1a3c6e');
    $bannerImageUrl = $bannerImage ? (str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage)) : null;
    $bannerBadge = $bv('words_pictures_banner_badge', 'Application');
    $bannerTitle = $bv('words_pictures_banner_title', 'Words and Pictures Application');
    $bannerTitleFr = $bvFr('words_pictures_banner_title');
    $bannerSubtitle = $bv('words_pictures_banner_subtitle', 'A free mobile app helping children with hearing and speech impairments practice Cambodian Sign Language.');
    $bannerSubtitleFr = $bvFr('words_pictures_banner_subtitle');
    $btn1Text = $bv('words_pictures_banner_btn1_text', 'Learn More');
    $btn1Url  = $bv('words_pictures_banner_btn1_url', '/our-programs');
    $btn2Text = $bv('words_pictures_banner_btn2_text', 'Donate Now');
    $btn2Url  = $bv('words_pictures_banner_btn2_url', '/donate');
    $btn3Text = $bv('words_pictures_banner_btn3_text', '');
    $btn3Url  = $bv('words_pictures_banner_btn3_url', '');
@endphp

{{-- ========================================================
     TAB: WORDS BANNER
     ======================================================== --}}
<div x-show="tab === 'banner'" class="space-y-6">
    {{-- Live Preview --}}
    <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
        <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-4 py-2 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Live Preview
        </div>
        <div id="words-banner-preview" class="relative py-14 px-6 text-center overflow-hidden" style="background-color: {{ $bannerOverlayColor }};">
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
    <form action="{{ route('admin.words-pictures.banner.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-5" x-data="bilingualForm()">
        @csrf
        <div class="flex items-center justify-between gap-3">
            <h3 class="font-bold text-gray-700 text-sm">Page Banner</h3>
            <div class="lang-tabs" title="Toggle editing language (English / French)">
                <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
            </div>
        </div>
        <p class="text-xs text-gray-400 -mt-3">Controls the hero banner shown at the top of the public Words and Pictures page.</p>

        {{-- Background Image --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Background Image</label>
            @if($bannerImage)
            <div class="mb-3">
                <img src="{{ str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage) }}"
                     alt="Current banner image"
                     class="w-full max-h-48 object-contain rounded-xl border border-gray-200 bg-gray-50 p-2">
                <label class="mt-2 inline-flex items-center gap-2 text-xs text-gray-500 cursor-pointer">
                    <input type="checkbox" name="words_pictures_banner_image_clear" value="1" class="rounded border-gray-300 text-red-500 focus:ring-red-400">
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
                <input type="file" name="words_pictures_banner_image"
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
                    <input type="text" name="words_pictures_banner_image_url"
                           value="{{ str_starts_with($bannerImage ?? '', 'http') ? $bannerImage : '' }}"
                           placeholder="https://example.com/image.png"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
                </div>
            </div>
        </div>

        {{-- Background Overlay Color --}}
        <div>
            <label for="words_pictures_banner_overlay_color" class="block text-sm font-medium text-gray-700 mb-1.5">Background Overlay Color</label>
            <div class="flex items-center gap-3">
                <input type="color" id="words_banner_overlay_color_picker"
                       value="{{ $bannerOverlayColor }}"
                       class="h-11 w-14 shrink-0 rounded-lg border border-gray-200 cursor-pointer p-1"
                       onchange="document.getElementById('words_pictures_banner_overlay_color').value = this.value; document.getElementById('words-banner-preview').style.backgroundColor = this.value;">
                <input type="text" id="words_pictures_banner_overlay_color" name="words_pictures_banner_overlay_color"
                       value="{{ $bannerOverlayColor }}"
                       placeholder="#1a3c6e"
                       oninput="if(/^#[0-9A-Fa-f]{6}$/.test(this.value)) { document.getElementById('words_banner_overlay_color_picker').value = this.value; document.getElementById('words-banner-preview').style.backgroundColor = this.value; }"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
            </div>
        </div>

        {{-- Badge Text --}}
        <div x-show="lang === 'en'">
            <label for="words_pictures_banner_badge" class="block text-sm font-medium text-gray-700 mb-1.5">Badge Text</label>
            <input type="text" id="words_pictures_banner_badge" name="words_pictures_banner_badge"
                   value="{{ $bannerBadge }}"
                   oninput="document.getElementById('preview-badge').textContent = this.value || 'Application'"
                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
        </div>

        {{-- Hero Title --}}
        <div x-show="lang === 'en'">
            <label for="words_pictures_banner_title" class="block text-sm font-medium text-gray-700 mb-1.5">Hero Title</label>
            <x-admin.rich-text id="words_pictures_banner_title" name="words_pictures_banner_title" :value="$bannerTitle" lang="en" :rows="1" />
        </div>
        <div x-show="lang === 'fr'" x-cloak>
            <label for="words_pictures_banner_title_fr" class="block text-sm font-medium text-gray-700 mb-1.5">Hero Title (French) <span class="text-gray-400 font-normal">(optional)</span></label>
            <x-admin.rich-text id="words_pictures_banner_title_fr" name="words_pictures_banner_title_fr" :value="$bannerTitleFr" lang="fr" :rows="1" placeholder="Application Mots et Images" />
            <p class="text-xs text-gray-400 mt-1">Shown to French-language visitors. Leave blank to reuse the English title.</p>
        </div>

        {{-- Hero Subtitle --}}
        <div x-show="lang === 'en'">
            <label for="words_pictures_banner_subtitle" class="block text-sm font-medium text-gray-700 mb-1.5">Hero Subtitle</label>
            <x-admin.rich-text id="words_pictures_banner_subtitle" name="words_pictures_banner_subtitle" :value="$bannerSubtitle" lang="en" :rows="2" />
        </div>
        <div x-show="lang === 'fr'" x-cloak>
            <label for="words_pictures_banner_subtitle_fr" class="block text-sm font-medium text-gray-700 mb-1.5">Hero Subtitle (French) <span class="text-gray-400 font-normal">(optional)</span></label>
            <x-admin.rich-text id="words_pictures_banner_subtitle_fr" name="words_pictures_banner_subtitle_fr" :value="$bannerSubtitleFr" lang="fr" :rows="2" placeholder="Une application mobile gratuite qui aide les enfants…" />
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
                    <label for="words_pictures_banner_btn1_text" class="block text-xs font-medium text-gray-600 mb-1">Button 1 Text</label>
                    <input type="text" id="words_pictures_banner_btn1_text" name="words_pictures_banner_btn1_text"
                           value="{{ $btn1Text }}"
                           oninput="document.getElementById('preview-btn1').textContent = this.value || 'Button 1'; document.getElementById('preview-btn1').classList.toggle('opacity-30', !this.value)"
                           placeholder="Learn More"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label for="words_pictures_banner_btn1_url" class="block text-xs font-medium text-gray-600 mb-1">Button 1 URL</label>
                    <input type="text" id="words_pictures_banner_btn1_url" name="words_pictures_banner_btn1_url"
                           value="{{ $btn1Url }}"
                           placeholder="/our-programs"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>

            {{-- Button 2 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="words_pictures_banner_btn2_text" class="block text-xs font-medium text-gray-600 mb-1">Button 2 Text</label>
                    <input type="text" id="words_pictures_banner_btn2_text" name="words_pictures_banner_btn2_text"
                           value="{{ $btn2Text }}"
                           oninput="document.getElementById('preview-btn2').textContent = this.value || 'Button 2'; document.getElementById('preview-btn2').classList.toggle('opacity-30', !this.value)"
                           placeholder="Donate Now"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label for="words_pictures_banner_btn2_url" class="block text-xs font-medium text-gray-600 mb-1">Button 2 URL</label>
                    <input type="text" id="words_pictures_banner_btn2_url" name="words_pictures_banner_btn2_url"
                           value="{{ $btn2Url }}"
                           placeholder="/donate"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>

            {{-- Button 3 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="words_pictures_banner_btn3_text" class="block text-xs font-medium text-gray-600 mb-1">Button 3 Text</label>
                    <input type="text" id="words_pictures_banner_btn3_text" name="words_pictures_banner_btn3_text"
                           value="{{ $btn3Text }}"
                           oninput="document.getElementById('preview-btn3').textContent = this.value || 'Button 3'; document.getElementById('preview-btn3').classList.toggle('opacity-30', !this.value)"
                           placeholder="Annual Report"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label for="words_pictures_banner_btn3_url" class="block text-xs font-medium text-gray-600 mb-1">Button 3 URL</label>
                    <input type="text" id="words_pictures_banner_btn3_url" name="words_pictures_banner_btn3_url"
                           value="{{ $btn3Url }}"
                           placeholder="/resources"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 pt-1">
            <button type="submit" class="btn-primary">Save Banner</button>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600 text-sm transition-colors">Cancel</a>
            <a href="{{ route('words-pictures') }}" target="_blank" class="ml-auto flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View live page
            </a>
        </div>
    </form>
</div>

{{-- ========================================================
     TAB: WORDS PAGE
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

    {{-- Page Content Form --}}
    <form action="{{ route('admin.words-pictures.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6" x-data="bilingualForm()">
        @csrf

        {{-- Page Title --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </span>
                Page Title
            </h3>
            <input type="text" name="words_pictures_title" value="{{ old('words_pictures_title', $settings['words_pictures_title'] ?? 'Words and Pictures Application') }}"
                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
        </div>

        {{-- Objective --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </span>
                    Objective
                </h3>
                <div class="lang-tabs" title="Toggle editing language (English / French)">
                    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                <input type="text" name="words_pictures_objective_heading" value="{{ old('words_pictures_objective_heading', $settings['words_pictures_objective_heading'] ?? 'Objective') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div x-show="lang === 'en'">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Text</label>
                <x-admin.rich-text name="words_pictures_objective_text" :value="old('words_pictures_objective_text', $settings['words_pictures_objective_text'] ?? 'To enable children with hearing and speech impairments and their relatives and friends access a tool to practice Cambodian Sign Language.')" lang="en" :rows="3" />
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Text (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="words_pictures_objective_text_fr" :value="old('words_pictures_objective_text_fr', $settings['words_pictures_objective_text_fr'] ?? '')" lang="fr" :rows="3" placeholder="Pour permettre aux enfants..." />
                <p class="mt-1.5 text-xs text-gray-400">Shown to French-language visitors. Leave blank to reuse the English text.</p>
            </div>
        </div>

        {{-- Project Description --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/>
                        </svg>
                    </span>
                    Project Description
                </h3>
                <div class="lang-tabs" title="Toggle editing language (English / French)">
                    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                <input type="text" name="words_pictures_project_heading" value="{{ old('words_pictures_project_heading', $settings['words_pictures_project_heading'] ?? 'Project') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div x-show="lang === 'en'">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Paragraph 1</label>
                <x-admin.rich-text name="words_pictures_project_p1" :value="old('words_pictures_project_p1', $settings['words_pictures_project_p1'] ?? 'For over 25 years, Krousar Thmey has implemented a unique mix of special and inclusive education for children with sensory disabilities in Cambodia, developing a unique expertise in visual and hearing impairments with an established track record of results, transforming lives through education, and lastingly influencing national policies. Children with hearing disabilities face many challenges in terms of communication, and have specific educational needs requiring adapted resources. As technology is an ever growing means of providing access to education and communication, Krousar Thmey is launching an educative and innovative mobile phone application:')" lang="en" :rows="4" />
                <p class="mt-1.5 text-xs text-gray-400">Ends right before the app name (shown in italics automatically).</p>
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Paragraph 1 (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="words_pictures_project_p1_fr" :value="old('words_pictures_project_p1_fr', $settings['words_pictures_project_p1_fr'] ?? '')" lang="fr" :rows="4" placeholder="Depuis plus de 25 ans, Krousar Thmey..." />
                <p class="mt-1.5 text-xs text-gray-400">Shown to French-language visitors. Leave blank to reuse the English text.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">App Name</label>
                <input type="text" name="words_pictures_app_name" value="{{ old('words_pictures_app_name', $settings['words_pictures_app_name'] ?? 'Words and Pictures') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div x-show="lang === 'en'">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Paragraph 2</label>
                <x-admin.rich-text name="words_pictures_project_p2" :value="old('words_pictures_project_p2', $settings['words_pictures_project_p2'] ?? 'Based on a very intuitive interface and simple design, the inclusive application is readily accessible to a very wide audience, and equally useful for families with young children with or without disabilities. Featuring over 500 words relevant to every-day life situations, selected for their suitability to the Cambodian background, the purpose of the application is to offer a fun picture dictionary with integrated sounds and sign language pictograms.')" lang="en" :rows="4" />
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Paragraph 2 (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="words_pictures_project_p2_fr" :value="old('words_pictures_project_p2_fr', $settings['words_pictures_project_p2_fr'] ?? '')" lang="fr" :rows="4" placeholder="Basée sur une interface très intuitive..." />
                <p class="mt-1.5 text-xs text-gray-400">Shown to French-language visitors. Leave blank to reuse the English text.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Download Line — Prefix</label>
                    <input type="text" name="words_pictures_download_prefix" value="{{ old('words_pictures_download_prefix', $settings['words_pictures_download_prefix'] ?? 'To download the application on your smartphone, please visit:') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div class="sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Download URL</label>
                    <input type="text" name="words_pictures_download_url" value="{{ old('words_pictures_download_url', $settings['words_pictures_download_url'] ?? 'http://onelink.to/krousarthmey') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div class="sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Download Line — Suffix</label>
                    <input type="text" name="words_pictures_download_suffix" value="{{ old('words_pictures_download_suffix', $settings['words_pictures_download_suffix'] ?? 'or scan the QR code below.') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>

            <div x-show="lang === 'en'">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Thanks / Credits</label>
                <x-admin.rich-text name="words_pictures_thanks_text" :value="old('words_pictures_thanks_text', $settings['words_pictures_thanks_text'] ?? 'Many thanks to Judit van Geystelen for the original idea and design, Open Institute for the development, as well as the Ministry of Education, Youth and Sport of Cambodia, Symphasis Foundation, and Clariant Foundation for their support.')" lang="en" :rows="3" />
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Thanks / Credits (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="words_pictures_thanks_text_fr" :value="old('words_pictures_thanks_text_fr', $settings['words_pictures_thanks_text_fr'] ?? '')" lang="fr" :rows="3" placeholder="Nos remerciements vont à..." />
                <p class="mt-1.5 text-xs text-gray-400">Shown to French-language visitors. Leave blank to reuse the English text.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Dedication</label>
                <input type="text" name="words_pictures_dedication_text" value="{{ old('words_pictures_dedication_text', $settings['words_pictures_dedication_text'] ?? 'This application is dedicated to Tina.') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Contact Line — Prefix</label>
                    <input type="text" name="words_pictures_contact_prefix" value="{{ old('words_pictures_contact_prefix', $settings['words_pictures_contact_prefix'] ?? 'If you are interested in developing this application in the language of your choice, please contact:') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Contact Email</label>
                    <input type="email" name="words_pictures_contact_email" value="{{ old('words_pictures_contact_email', $settings['words_pictures_contact_email'] ?? 'sign.picture.dictionary@gmail.com') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
        </div>

        {{-- QR Code --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-orange-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM14 14h2m4 0h-2m0 0v2m0 4v-2m0 0h-4m4 0h2"/>
                    </svg>
                </span>
                QR Code
            </h3>
            @if(!empty($settings['words_pictures_qr_image']))
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                <img src="{{ str_starts_with($settings['words_pictures_qr_image'], 'http') ? $settings['words_pictures_qr_image'] : asset('storage/' . $settings['words_pictures_qr_image']) }}"
                     alt="Current QR code" class="h-16 w-16 object-cover rounded-lg border border-gray-200 bg-white p-1">
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-medium text-gray-600 mb-0.5">Current QR code</p>
                    <p class="text-xs text-gray-400 truncate">{{ $settings['words_pictures_qr_image'] }}</p>
                </div>
                <label class="flex items-center gap-1.5 text-xs text-red-500 hover:text-red-700 cursor-pointer flex-shrink-0">
                    <input type="checkbox" name="remove_words_pictures_qr_image" value="1" class="rounded border-gray-300 text-red-500 w-3.5 h-3.5">
                    Remove
                </label>
            </div>
            @else
            <div class="flex items-center gap-3 p-3 bg-[#2d6fa3]/5 rounded-xl border border-[#2d6fa3]/10">
                <div class="h-16 w-16 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                    <span class="text-[#2d6fa3]/50 text-xs">None</span>
                </div>
                <p class="text-xs text-gray-500">No QR code uploaded yet — the QR code block is hidden from the page until one is added.</p>
            </div>
            @endif
            <input type="file" name="words_pictures_qr_image_file" accept="image/*"
                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
            <p class="text-xs text-gray-400">Max 4MB. Should point to the same Download URL above.</p>
        </div>

        {{-- Buttons --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                </span>
                Buttons
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">"Learn More" Button Text</label>
                    <input type="text" name="words_pictures_learn_more_text" value="{{ old('words_pictures_learn_more_text', $settings['words_pictures_learn_more_text'] ?? 'Learn more about the projects of this program') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">"Learn More" Button URL</label>
                    <input type="url" name="words_pictures_learn_more_url" value="{{ old('words_pictures_learn_more_url', $settings['words_pictures_learn_more_url'] ?? route('programs.show', 'special-education')) }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">"Donate Now" Button URL</label>
                <input type="text" name="words_pictures_donate_url" value="{{ old('words_pictures_donate_url', $settings['words_pictures_donate_url'] ?? route('donate')) }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
        </div>

        {{-- Photo --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </span>
                Main Photo
            </h3>
            @if(!empty($settings['words_pictures_photo']))
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                <img src="{{ str_starts_with($settings['words_pictures_photo'], 'http') ? $settings['words_pictures_photo'] : asset('storage/' . $settings['words_pictures_photo']) }}"
                     alt="Current photo" class="h-14 w-24 object-cover rounded-lg border border-gray-200">
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-medium text-gray-600 mb-0.5">Current photo</p>
                    <p class="text-xs text-gray-400 truncate">{{ $settings['words_pictures_photo'] }}</p>
                </div>
                <label class="flex items-center gap-1.5 text-xs text-red-500 hover:text-red-700 cursor-pointer flex-shrink-0">
                    <input type="checkbox" name="remove_words_pictures_photo" value="1" class="rounded border-gray-300 text-red-500 w-3.5 h-3.5">
                    Remove
                </label>
            </div>
            @else
            <div class="flex items-center gap-3 p-3 bg-[#2d6fa3]/5 rounded-xl border border-[#2d6fa3]/10">
                <div class="h-14 w-24 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                    <span class="text-[#2d6fa3]/50 text-xs">No photo</span>
                </div>
                <p class="text-xs text-gray-500">Falls back to a default photo until you upload one.</p>
            </div>
            @endif
            <input type="file" name="words_pictures_photo_file" accept="image/*"
                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
            <p class="text-xs text-gray-400">Max 4MB. Shown large on the right side of the page.</p>
        </div>

        {{-- In The News --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </span>
                    "In The News" Press Article
                </h3>
                <div class="lang-tabs" title="Toggle editing language (English / French)">
                    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Section Heading</label>
                <input type="text" name="words_pictures_press_heading" value="{{ old('words_pictures_press_heading', $settings['words_pictures_press_heading'] ?? 'Words and Pictures in the News') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Photo</label>
                @if(!empty($settings['words_pictures_press_image']))
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100 mb-3">
                    <img src="{{ str_starts_with($settings['words_pictures_press_image'], 'http') ? $settings['words_pictures_press_image'] : asset('storage/' . $settings['words_pictures_press_image']) }}"
                         alt="Current press photo" class="h-14 w-24 object-cover rounded-lg border border-gray-200">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium text-gray-600 mb-0.5">Current photo</p>
                        <p class="text-xs text-gray-400 truncate">{{ $settings['words_pictures_press_image'] }}</p>
                    </div>
                    <label class="flex items-center gap-1.5 text-xs text-red-500 hover:text-red-700 cursor-pointer flex-shrink-0">
                        <input type="checkbox" name="remove_words_pictures_press_image" value="1" class="rounded border-gray-300 text-red-500 w-3.5 h-3.5">
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
                <input type="file" name="words_pictures_press_image_file" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                <p class="mt-1.5 text-xs text-gray-400">Max 4MB.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Photo Caption</label>
                <input type="text" name="words_pictures_press_image_caption" value="{{ old('words_pictures_press_image_caption', $settings['words_pictures_press_image_caption'] ?? "The newly launched 'Words and Pictures' app is dedicated to helping children with hearing and speech impairments. Supplied") }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400">Shown as a dark caption bar over the bottom of the photo. Leave blank to hide it.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Source Label</label>
                    <input type="text" name="words_pictures_press_source_label" value="{{ old('words_pictures_press_source_label', $settings['words_pictures_press_source_label'] ?? 'Press Article') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Publication Name</label>
                    <input type="text" name="words_pictures_press_source_name" value="{{ old('words_pictures_press_source_name', $settings['words_pictures_press_source_name'] ?? 'The Phnom Penh Post') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Headline</label>
                <input type="text" name="words_pictures_press_headline" value="{{ old('words_pictures_press_headline', $settings['words_pictures_press_headline'] ?? 'Krousar Thmey empowering children with hearing issues') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Published Date</label>
                <input type="text" name="words_pictures_press_date" value="{{ old('words_pictures_press_date', $settings['words_pictures_press_date'] ?? '04.27.2020') }}"
                       placeholder="e.g. 04.27.2020"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div x-show="lang === 'en'">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Excerpt</label>
                <x-admin.rich-text name="words_pictures_press_excerpt" :value="old('words_pictures_press_excerpt', $settings['words_pictures_press_excerpt'] ?? 'As children with hearing disabilities face many challenges in terms of communication and have specific educational needs, Krousar Thmey has utilised technology to create a mobile learning app as a resource for disadvantaged children…')" lang="en" :rows="3" />
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Excerpt (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="words_pictures_press_excerpt_fr" :value="old('words_pictures_press_excerpt_fr', $settings['words_pictures_press_excerpt_fr'] ?? '')" lang="fr" :rows="3" placeholder="Les enfants souffrant de..." />
                <p class="mt-1.5 text-xs text-gray-400">Shown to French-language visitors. Leave blank to reuse the English text.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Article URL</label>
                <input type="url" name="words_pictures_press_article_url" value="{{ old('words_pictures_press_article_url', $settings['words_pictures_press_article_url'] ?? '') }}" placeholder="https://..."
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400">Where the \"Read the article\" button sends visitors.</p>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary">Save Words and Pictures Page</button>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
            <a href="{{ route('words-pictures') }}" target="_blank" class="ml-auto flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors">
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
