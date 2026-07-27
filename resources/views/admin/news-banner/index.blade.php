@extends('admin.layouts.app')

@section('title', 'News Banner')
@section('page-title', 'News Banner')

@section('content')

<div class="max-w-4xl mx-auto">

    {{-- ── Professional Page Header ── --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-xl bg-gradient-to-br from-[#2d6fa3] to-[#1d4e7a] flex items-center justify-center flex-shrink-0 shadow-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </span>
                    News Banner Settings
                </h2>
                <p class="text-sm text-gray-500 mt-1.5 ml-[42px]">Manage the hero banner shown at the top of the News page.</p>
            </div>
            <a href="{{ route('news') }}" target="_blank"
               class="inline-flex items-center gap-2 px-4 py-2 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                View Site
            </a>
        </div>
    </div>

    @php
    $bv = fn($key, $default = '') => old($key, $settings[$key] ?? $default);
    $bannerImage = $bv('news_banner_image');
    $bannerOverlayColor = $bv('news_banner_overlay_color', '#1a3c6e');
    $bannerImageUrl = $bannerImage ? (str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage)) : null;
    $bannerBadge = $bv('news_banner_badge', 'Krousar Thmey');
    $bannerTitle = $bv('news_banner_title', "Krousar Thmey's news, in Cambodia and around the world");
    $bannerSubtitle = $bv('news_banner_subtitle', 'Updates from our programs, success stories from our beneficiaries, and events from Krousar Thmey.');
    $btn1Text = $bv('news_banner_btn1_text', 'Donate Now');
    $btn1Url  = $bv('news_banner_btn1_url', '/donate');
    $btn2Text = $bv('news_banner_btn2_text', 'Get Involved');
    $btn2Url  = $bv('news_banner_btn2_url', '/get-involved');
    $btn3Text = $bv('news_banner_btn3_text', 'Annual Report');
    $btn3Url  = $bv('news_banner_btn3_url', '/resources#annual-reports');
    @endphp

    {{-- Live Preview --}}
    <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm mb-6">
        <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-4 py-2 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Live Preview
        </div>
        <div id="news-banner-preview" class="relative py-14 px-6 text-center overflow-hidden" style="background-color: {{ $bannerOverlayColor }};">
            @if($bannerImageUrl)
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $bannerImageUrl }}'); opacity: 0.35;"></div>
            @endif
            <div class="relative">
                <span id="preview-badge" class="inline-block bg-white text-[#eea91d] text-[10px] font-semibold px-3 py-1 rounded-full mb-3 uppercase tracking-wider">{{ $bannerBadge }}</span>
                <h2 id="preview-title" class="text-xl font-bold text-white mb-2 px-4">{{ $bannerTitle }}</h2>
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
    <form action="{{ route('admin.news-banner.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
        @csrf

        <div class="flex items-center justify-between gap-3">
            <h3 class="font-bold text-gray-700 text-sm">Page Banner</h3>
        </div>
        <p class="text-xs text-gray-400 -mt-3">Controls the hero banner shown at the top of the public News page.</p>

        {{-- Background Image --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Background Image</label>
            @if($bannerImage)
            <div class="mb-3">
                <img src="{{ str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage) }}"
                     alt="Current banner image"
                     class="w-full max-h-48 object-contain rounded-xl border border-gray-200 bg-gray-50 p-2">
                <label class="mt-2 inline-flex items-center gap-2 text-xs text-gray-500 cursor-pointer">
                    <input type="checkbox" name="news_banner_image_clear" value="1" class="rounded border-gray-300 text-red-500 focus:ring-red-400">
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
                <input type="file" name="news_banner_image"
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
                    <input type="text" name="news_banner_image_url"
                           value="{{ str_starts_with($bannerImage ?? '', 'http') ? $bannerImage : '' }}"
                           placeholder="https://example.com/image.png"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
                </div>
            </div>
        </div>

        {{-- Background Overlay Color --}}
        <div>
            <label for="news_banner_overlay_color" class="block text-sm font-medium text-gray-700 mb-1.5">Background Overlay Color</label>
            <div class="flex items-center gap-3">
                <input type="color" id="news_banner_overlay_color_picker"
                       value="{{ $bannerOverlayColor }}"
                       class="h-11 w-14 shrink-0 rounded-lg border border-gray-200 cursor-pointer p-1"
                       onchange="document.getElementById('news_banner_overlay_color').value = this.value; document.getElementById('news-banner-preview').style.backgroundColor = this.value;">
                <input type="text" id="news_banner_overlay_color" name="news_banner_overlay_color"
                       value="{{ $bannerOverlayColor }}"
                       placeholder="#1a3c6e"
                       oninput="if(/^#[0-9A-Fa-f]{6}$/.test(this.value)) { document.getElementById('news_banner_overlay_color_picker').value = this.value; document.getElementById('news-banner-preview').style.backgroundColor = this.value; }"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
            </div>
        </div>

        {{-- Badge Text --}}
        <div>
            <label for="news_banner_badge" class="block text-sm font-medium text-gray-700 mb-1.5">Badge Text</label>
            <input type="text" id="news_banner_badge" name="news_banner_badge"
                   value="{{ $bannerBadge }}"
                   oninput="document.getElementById('preview-badge').textContent = this.value || 'Krousar Thmey'"
                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
        </div>

        {{-- Hero Title --}}
        <div>
            <label for="news_banner_title" class="block text-sm font-medium text-gray-700 mb-1.5">Hero Title</label>
            <input type="text" id="news_banner_title" name="news_banner_title"
                   value="{{ $bannerTitle }}"
                   oninput="document.getElementById('preview-title').textContent = this.value || 'News'"
                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
        </div>

        {{-- Hero Subtitle --}}
        <div>
            <label for="news_banner_subtitle" class="block text-sm font-medium text-gray-700 mb-1.5">Hero Subtitle</label>
            <textarea id="news_banner_subtitle" name="news_banner_subtitle" rows="2"
                      oninput="document.getElementById('preview-subtitle').textContent = this.value || ''"
                      class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                      placeholder="Updates from our programs, success stories from our beneficiaries...">{{ $bannerSubtitle }}</textarea>
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
                    <label for="news_banner_btn1_text" class="block text-xs font-medium text-gray-600 mb-1">Button 1 Text</label>
                    <input type="text" id="news_banner_btn1_text" name="news_banner_btn1_text"
                           value="{{ $btn1Text }}"
                           oninput="document.getElementById('preview-btn1').textContent = this.value || 'Button 1'; document.getElementById('preview-btn1').classList.toggle('opacity-30', !this.value)"
                           placeholder="Donate Now"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label for="news_banner_btn1_url" class="block text-xs font-medium text-gray-600 mb-1">Button 1 URL</label>
                    <input type="text" id="news_banner_btn1_url" name="news_banner_btn1_url"
                           value="{{ $btn1Url }}"
                           placeholder="/donate"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>

            {{-- Button 2 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="news_banner_btn2_text" class="block text-xs font-medium text-gray-600 mb-1">Button 2 Text</label>
                    <input type="text" id="news_banner_btn2_text" name="news_banner_btn2_text"
                           value="{{ $btn2Text }}"
                           oninput="document.getElementById('preview-btn2').textContent = this.value || 'Button 2'; document.getElementById('preview-btn2').classList.toggle('opacity-30', !this.value)"
                           placeholder="Get Involved"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label for="news_banner_btn2_url" class="block text-xs font-medium text-gray-600 mb-1">Button 2 URL</label>
                    <input type="text" id="news_banner_btn2_url" name="news_banner_btn2_url"
                           value="{{ $btn2Url }}"
                           placeholder="/get-involved"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>

            {{-- Button 3 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="news_banner_btn3_text" class="block text-xs font-medium text-gray-600 mb-1">Button 3 Text</label>
                    <input type="text" id="news_banner_btn3_text" name="news_banner_btn3_text"
                           value="{{ $btn3Text }}"
                           oninput="document.getElementById('preview-btn3').textContent = this.value || 'Button 3'; document.getElementById('preview-btn3').classList.toggle('opacity-30', !this.value)"
                           placeholder="Annual Report"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label for="news_banner_btn3_url" class="block text-xs font-medium text-gray-600 mb-1">Button 3 URL</label>
                    <input type="text" id="news_banner_btn3_url" name="news_banner_btn3_url"
                           value="{{ $btn3Url }}"
                           placeholder="/resources#annual-reports"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3 pt-1">
            <button type="submit" class="btn-primary">Save Banner</button>
            <a href="{{ route('admin.news.index') }}" class="text-sm text-[#2d6fa3] hover:text-[#1d4e7a] transition-colors">← Back to News</a>
            <a href="{{ route('news') }}" target="_blank" class="ml-auto flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View live page
            </a>
        </div>
    </form>
</div>

@endsection
