@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-news.css'])
@endpush

@section('title', 'News')
@section('page-title', 'News')

@section('content')

<div x-data="{ tab: '{{ request('tab', 'banner') }}' }">

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
                    News Settings
                </h2>
                <p class="text-sm text-gray-500 mt-1.5 ml-[42px]">Manage the public News page — banner, articles, and updates.</p>
            </div>
            <a href="{{ route('news') }}" target="_blank"
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
                <button @click="tab = 'banner'; history.replaceState(null, '', window.location.pathname)"
                        :class="tab === 'banner' ? 'bg-white shadow-sm text-[#2d6fa3] font-semibold ring-1 ring-gray-200/50' : 'text-gray-500 hover:text-gray-700 font-medium'"
                        class="px-7 py-2.5 rounded-lg text-sm transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    News Banner
                </button>
                <button @click="tab = 'management'; history.replaceState(null, '', window.location.pathname + '?tab=management')"
                        :class="tab === 'management' ? 'bg-white shadow-sm text-[#2d6fa3] font-semibold ring-1 ring-gray-200/50' : 'text-gray-500 hover:text-gray-700 font-medium'"
                        class="px-7 py-2.5 rounded-lg text-sm transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                    News Management
                </button>
            </div>
        </div>
    </div>

    {{-- ========================================================
         TAB: NEWS BANNER
         ======================================================== --}}
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

    <div x-show="tab === 'banner'" class="space-y-6">

        {{-- Live Preview --}}
        <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
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
                <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600 text-sm transition-colors">Cancel</a>
                <a href="{{ route('news') }}" target="_blank" class="ml-auto flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    View live page
                </a>
            </div>
        </form>
    </div>

    {{-- ========================================================
         TAB: NEWS MANAGEMENT
         ======================================================== --}}
    <div x-show="tab === 'management'" class="space-y-6">

        {{-- Filter Bar --}}
        <div class="filter-bar mb-2">
            <div class="flex flex-wrap items-center justify-between gap-3">
                <div class="flex flex-wrap items-center gap-3 flex-1">
                    <div class="relative flex-1 min-w-[180px]">
                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text"
                               placeholder="Search articles..."
                               id="searchInput"
                               class="form-control pl-9">
                    </div>
                    <select class="form-select" id="statusFilter">
                        <option value="">All Status</option>
                        <option value="published">Published</option>
                        <option value="draft">Draft</option>
                    </select>
                    <button class="btn-reset" onclick="resetFilters()">Reset</button>
                </div>
                <a href="{{ route('admin.news.create') }}" class="btn-primary">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    New Article
                </a>
            </div>
        </div>

        {{-- Table --}}
        <div class="table-container">
            <div class="table-header">
                <div class="flex items-center gap-3">
                    <h3>All Articles</h3>
                    <span class="count-badge">{{ $articles->total() }} total</span>
                </div>
                <div class="text-xs text-gray-400">
                    Last updated: {{ now()->format('d M Y, h:i A') }}
                </div>
            </div>

            @if($articles->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <h4 class="empty-title">No articles yet</h4>
                <p class="empty-desc">Get started by creating your first news article.</p>
                <a href="{{ route('admin.news.create') }}" class="inline-flex items-center gap-2 mt-4 text-[#2d6fa3] font-medium hover:text-[#1a4a7a] transition-colors text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Create your first article
                </a>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="table-custom">
                    <thead>
                        <tr>
                            <th class="th-width-35">Article</th>
                            <th class="th-width-20">Tags</th>
                            <th class="th-width-13">Status</th>
                            <th class="th-width-17">Published</th>
                            <th class="th-width-15 th-text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                        <tr data-status="{{ $article->is_published ? 'published' : 'draft' }}">
                            <td>
                                <div class="flex items-center gap-3">
                                    @if($article->image)
                                    <div class="article-thumb">
                                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" loading="lazy">
                                    </div>
                                    @else
                                    <div class="article-thumb-placeholder">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    @endif
                                    <div class="min-w-0">
                                        <div class="font-medium text-gray-800 hover:text-[#2d6fa3] transition-colors truncate max-w-xs">
                                            {{ $article->title }}
                                        </div>
                                        @if($article->excerpt)
                                        <div class="text-xs text-gray-400 mt-0.5 truncate max-w-xs">{{ Str::limit(strip_tags($article->excerpt), 60) }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if(!empty($article->tag_links))
                                <span class="text-xs text-gray-600">{{ collect($article->tag_links)->pluck('label')->implode(', ') }}</span>
                                @else
                                <span class="text-gray-400 text-xs">—</span>
                                @endif
                            </td>
                            <td>
                                @if($article->is_published)
                                <span class="status-badge published">
                                    <span class="dot"></span>
                                    Published
                                </span>
                                @else
                                <span class="status-badge draft">
                                    <span class="dot"></span>
                                    Draft
                                </span>
                                @endif
                            </td>
                            <td>
                                @if($article->published_at)
                                <div class="text-xs">
                                    <div class="text-gray-700 font-medium">{{ $article->published_at->format('d M Y') }}</div>
                                    <div class="text-gray-400 text-[10px]">{{ $article->published_at->format('h:i A') }}</div>
                                </div>
                                @else
                                <span class="text-gray-400 text-xs">—</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex items-center justify-end gap-1.5">
                                    {{-- View Button --}}
                                    @if(Route::has('news.show'))
                                    <a href="{{ route('news.show', $article->slug) }}" target="_blank" rel="noopener"
                                       class="action-btn btn-view"
                                       title="View on site">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <span class="tooltip">View</span>
                                    </a>
                                    @endif

                                    {{-- Edit Button --}}
                                    <a href="{{ route('admin.news.edit', ['news' => $article->id]) }}"
                                       class="action-btn btn-edit"
                                       title="Edit article">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        <span class="tooltip">Edit</span>
                                    </a>

                                    {{-- Delete Button --}}
                                    <form action="{{ route('admin.news.destroy', ['news' => $article->id]) }}" method="POST"
                                          onsubmit="return confirm('⚠️ Permanently delete this article?\n\nThis action cannot be undone.')"
                                          class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="action-btn btn-delete"
                                                title="Delete article">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                            <span class="tooltip">Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                <div class="pagination-info">
                    Showing <strong>{{ $articles->firstItem() ?? 0 }}</strong> to
                    <strong>{{ $articles->lastItem() ?? 0 }}</strong> of
                    <strong>{{ $articles->total() }}</strong> articles
                </div>
                <div class="pagination-links">
                    {{ $articles->appends(['tab' => 'management'])->links() }}
                </div>
            </div>
            @endif
        </div>

        {{-- Quick Tips --}}
        <div class="tips-box">
            <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="text-sm font-medium text-blue-800">Quick Tips</p>
                <ul class="text-xs text-blue-700 mt-1 space-y-0.5">
                    <li>• <strong>Published</strong> articles are visible on the public news page.</li>
                    <li>• <strong>Drafts</strong> are only visible to admins and editors.</li>
                    @if(Route::has('news.show'))
                    <li>• Click the <strong>View</strong> icon to preview the article on the live site.</li>
                    @endif
                    <li>• Use the search and filters to quickly find articles.</li>
                </ul>
            </div>
        </div>

        {{-- Filter JavaScript --}}
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const statusFilter = document.getElementById('statusFilter');
            const rows = document.querySelectorAll('tbody tr');

            function filterTable() {
                const search = searchInput.value.toLowerCase().trim();
                const status = statusFilter.value;

                rows.forEach(row => {
                    const title = row.querySelector('td:first-child .font-medium')?.textContent?.toLowerCase() || '';
                    const excerpt = row.querySelector('td:first-child .text-xs')?.textContent?.toLowerCase() || '';
                    const rowStatus = row.dataset.status || '';

                    const matchesSearch = !search || title.includes(search) || excerpt.includes(search);
                    const matchesStatus = !status || rowStatus === status;

                    row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
                });
            }

            searchInput.addEventListener('input', filterTable);
            statusFilter.addEventListener('change', filterTable);
        });

        function resetFilters() {
            document.getElementById('searchInput').value = '';
            document.getElementById('statusFilter').value = '';
            document.getElementById('searchInput').dispatchEvent(new Event('input'));
        }
        </script>
    </div>
</div>

@endsection
