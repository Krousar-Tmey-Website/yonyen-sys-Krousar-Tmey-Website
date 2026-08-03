@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css'])
@endpush

@section('title', 'Annual Reports')
@section('page-title', 'Annual Reports')

@section('content')

<div x-data="{ tab: 'reports' }">

    {{-- ── Professional Page Header ── --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-xl bg-gradient-to-br from-[#2d6fa3] to-[#1d4e7a] flex items-center justify-center flex-shrink-0 shadow-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </span>
                    Resources &amp; Reports
                </h2>
                <p class="text-sm text-gray-500 mt-1.5 ml-[42px]">Manage the public Resources page — banner, annual reports, and downloads.</p>
            </div>
            <a href="{{ route('resources') }}" target="_blank"
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
                <button @click="tab = 'reports'"
                        :class="tab === 'reports' ? 'bg-white shadow-sm text-[#2d6fa3] font-semibold ring-1 ring-gray-200/50' : 'text-gray-500 hover:text-gray-700 font-medium'"
                        class="px-7 py-2.5 rounded-lg text-sm transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Annual Reports
                </button>
                <button @click="tab = 'banner'"
                        :class="tab === 'banner' ? 'bg-white shadow-sm text-[#2d6fa3] font-semibold ring-1 ring-gray-200/50' : 'text-gray-500 hover:text-gray-700 font-medium'"
                        class="px-7 py-2.5 rounded-lg text-sm transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Resources Banner
                </button>
            </div>
        </div>
    </div>

    {{-- ========================================================
         TAB: ANNUAL REPORTS
         ======================================================== --}}
    <div x-show="tab === 'reports'" class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center gap-2">
                    <h3 class="font-bold text-gray-800">Annual Reports</h3>
                    <span class="px-2.5 py-1 bg-[#2d6fa3]/10 text-[#2d6fa3] rounded-full text-xs font-semibold">{{ $reports->total() }}</span>
                </div>
                <a href="{{ route('admin.reports.create') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-full text-sm font-semibold transition-colors shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Report
                </a>
            </div>
            <p class="px-6 pt-3 pb-4 text-sm text-gray-500">Upload, search, and manage report PDFs for the public Resources page.</p>
        </div>

        <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-sm sm:p-6">
            <form method="GET" action="{{ route('admin.reports.index') }}" class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div class="w-full md:max-w-md">
                    <label for="search" class="sr-only">Search</label>
                    <input id="search" name="search" type="text" value="{{ $search ?? '' }}" placeholder="Search by title or year" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#1d4e7a] focus:outline-none focus:ring-2 focus:ring-[#1d4e7a]/20">
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.reports.index') }}" class="rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-50">Reset</a>
                    <button type="submit" class="rounded-xl bg-[#1d4e7a] px-4 py-2.5 text-sm font-semibold text-white hover:bg-[#173e63]">Search</button>
                </div>
            </form>
        </div>

        <div class="rounded-2xl border border-gray-100 bg-white shadow-sm p-6 space-y-3">
            @forelse ($reports as $report)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 rounded-xl border border-gray-100 bg-white p-5 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-bold text-gray-800 truncate">{{ $report->title }}</h4>
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-1">
                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-[#2d6fa3] bg-[#2d6fa3]/10 px-2 py-0.5 rounded-full">{{ $report->year }}</span>
                            <span class="text-xs text-gray-400 truncate">{{ $report->original_filename ?? 'Uploaded PDF' }}</span>
                            <span class="text-xs text-gray-400">• {{ $report->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <a href="{{ route('admin.reports.show', $report) }}" title="View report" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-blue-200 text-blue-700 hover:bg-blue-50 transition-colors">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </a>
                        <a href="{{ route('admin.reports.edit', $report) }}" title="Edit report" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-amber-200 text-amber-700 hover:bg-amber-50 transition-colors">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        </a>
                        <form action="{{ route('admin.reports.destroy', $report) }}" method="POST" onsubmit="return confirm('Delete this report permanently?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Delete report" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-red-200 text-red-700 hover:bg-red-50 transition-colors">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="py-16 text-center text-gray-400">
                    <div class="text-4xl mb-3">📄</div>
                    <p class="text-sm font-medium text-gray-500">No annual reports found</p>
                    <p class="text-xs mt-1">Click <strong>Add Report</strong> to create your first report.</p>
                </div>
            @endforelse

            <div class="mt-6 pt-4 border-t border-gray-100">
                {{ $reports->links() }}
            </div>
        </div>
    </div>

    {{-- ========================================================
         TAB: RESOURCES BANNER
         ======================================================== --}}
    @php
    $bv = fn($key, $default = '') => old($key, $settings[$key] ?? $default);
    $bannerImage = $bv('resources_banner_image');
    $bannerOverlayColor = $bv('resources_banner_overlay_color', '#1a3c6e');
    $bannerImageUrl = $bannerImage ? (str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage)) : null;
    $bannerBadge = $bv('resources_banner_badge', 'Accountability');
    $bannerTitle = $bv('resources_banner_title', 'Resources & Annual Reports');
    $bannerSubtitle = $bv('resources_banner_subtitle', 'Annual reports, publications, and media resources from Krousar Thmey.');
    $bannerSubtitleFr = $bv('resources_banner_subtitle_fr');
    $btn1Text = $bv('resources_banner_btn1_text', 'Donate Now');
    $btn1Url  = $bv('resources_banner_btn1_url', '/donate');
    $btn2Text = $bv('resources_banner_btn2_text', 'Get Involved');
    $btn2Url  = $bv('resources_banner_btn2_url', '/get-involved');
    $btn3Text = $bv('resources_banner_btn3_text', 'Annual Report');
    $btn3Url  = $bv('resources_banner_btn3_url', '/resources#annual-reports');
    @endphp

    <div x-show="tab === 'banner'" class="space-y-6">

        {{-- Live Preview --}}
        <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
            <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-4 py-2 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                Live Preview
            </div>
            <div id="resources-banner-preview" class="relative py-14 px-6 text-center overflow-hidden" style="background-color: {{ $bannerOverlayColor }};">
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
        <form action="{{ route('admin.resources-banner.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            @csrf

            <div class="flex items-center justify-between gap-3">
                <h3 class="font-bold text-gray-700 text-sm">Page Banner</h3>
            </div>
            <p class="text-xs text-gray-400 -mt-3">Controls the hero banner shown at the top of the public Resources page.</p>

            {{-- Background Image --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Background Image</label>
                @if($bannerImage)
                <div class="mb-3">
                    <img src="{{ str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage) }}"
                         alt="Current banner image"
                         class="w-full max-h-48 object-contain rounded-xl border border-gray-200 bg-gray-50 p-2">
                    <label class="mt-2 inline-flex items-center gap-2 text-xs text-gray-500 cursor-pointer">
                        <input type="checkbox" name="resources_banner_image_clear" value="1" class="rounded border-gray-300 text-red-500 focus:ring-red-400">
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
                    <input type="file" name="resources_banner_image"
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
                        <input type="text" name="resources_banner_image_url"
                               value="{{ str_starts_with($bannerImage ?? '', 'http') ? $bannerImage : '' }}"
                               placeholder="https://example.com/image.png"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
                    </div>
                </div>
            </div>

            {{-- Background Overlay Color --}}
            <div>
                <label for="resources_banner_overlay_color" class="block text-sm font-medium text-gray-700 mb-1.5">Background Overlay Color</label>
                <div class="flex items-center gap-3">
                    <input type="color" id="resources_banner_overlay_color_picker"
                           value="{{ $bannerOverlayColor }}"
                           class="h-11 w-14 shrink-0 rounded-lg border border-gray-200 cursor-pointer p-1"
                           onchange="document.getElementById('resources_banner_overlay_color').value = this.value; document.getElementById('resources-banner-preview').style.backgroundColor = this.value;">
                    <input type="text" id="resources_banner_overlay_color" name="resources_banner_overlay_color"
                           value="{{ $bannerOverlayColor }}"
                           placeholder="#1a3c6e"
                           oninput="if(/^#[0-9A-Fa-f]{6}$/.test(this.value)) { document.getElementById('resources_banner_overlay_color_picker').value = this.value; document.getElementById('resources-banner-preview').style.backgroundColor = this.value; }"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
                </div>
            </div>

            {{-- Badge Text --}}
            <div>
                <label for="resources_banner_badge" class="block text-sm font-medium text-gray-700 mb-1.5">Badge Text</label>
                <input type="text" id="resources_banner_badge" name="resources_banner_badge"
                       value="{{ $bannerBadge }}"
                       oninput="document.getElementById('preview-badge').textContent = this.value || 'Resources'"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            {{-- Hero Title --}}
            <div>
                <label for="resources_banner_title" class="block text-sm font-medium text-gray-700 mb-1.5">Hero Title</label>
                <input type="text" id="resources_banner_title" name="resources_banner_title"
                       value="{{ $bannerTitle }}"
                       oninput="document.getElementById('preview-title').textContent = this.value || 'Resources'"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            {{-- Hero Subtitle --}}
            <div x-data="bilingualForm()">
                <div class="flex items-center justify-between gap-3 mb-1.5">
                    <label class="block text-sm font-medium text-gray-700 mb-0">Hero Subtitle</label>
                    <div class="lang-tabs" title="Toggle editing language (English / French)">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                    </div>
                </div>
                <div x-show="lang === 'en'">
                    <x-admin.rich-text name="resources_banner_subtitle" :value="$bannerSubtitle" lang="en" :rows="2"
                                       placeholder="Annual reports, publications, and media resources..." />
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <x-admin.rich-text name="resources_banner_subtitle_fr" :value="$bannerSubtitleFr" lang="fr" :rows="2"
                                       placeholder="Rapports annuels, publications et ressources médiatiques…" />
                    <p class="text-xs text-gray-400 mt-1">Leave blank to reuse the English subtitle.</p>
                </div>
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
                        <label for="resources_banner_btn1_text" class="block text-xs font-medium text-gray-600 mb-1">Button 1 Text</label>
                        <input type="text" id="resources_banner_btn1_text" name="resources_banner_btn1_text"
                               value="{{ $btn1Text }}"
                               oninput="document.getElementById('preview-btn1').textContent = this.value || 'Button 1'; document.getElementById('preview-btn1').classList.toggle('opacity-30', !this.value)"
                               placeholder="Donate Now"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label for="resources_banner_btn1_url" class="block text-xs font-medium text-gray-600 mb-1">Button 1 URL</label>
                        <input type="text" id="resources_banner_btn1_url" name="resources_banner_btn1_url"
                               value="{{ $btn1Url }}"
                               placeholder="/donate"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>

                {{-- Button 2 --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="resources_banner_btn2_text" class="block text-xs font-medium text-gray-600 mb-1">Button 2 Text</label>
                        <input type="text" id="resources_banner_btn2_text" name="resources_banner_btn2_text"
                               value="{{ $btn2Text }}"
                               oninput="document.getElementById('preview-btn2').textContent = this.value || 'Button 2'; document.getElementById('preview-btn2').classList.toggle('opacity-30', !this.value)"
                               placeholder="Get Involved"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label for="resources_banner_btn2_url" class="block text-xs font-medium text-gray-600 mb-1">Button 2 URL</label>
                        <input type="text" id="resources_banner_btn2_url" name="resources_banner_btn2_url"
                               value="{{ $btn2Url }}"
                               placeholder="/get-involved"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>

                {{-- Button 3 --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label for="resources_banner_btn3_text" class="block text-xs font-medium text-gray-600 mb-1">Button 3 Text</label>
                        <input type="text" id="resources_banner_btn3_text" name="resources_banner_btn3_text"
                               value="{{ $btn3Text }}"
                               oninput="document.getElementById('preview-btn3').textContent = this.value || 'Button 3'; document.getElementById('preview-btn3').classList.toggle('opacity-30', !this.value)"
                               placeholder="Annual Report"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label for="resources_banner_btn3_url" class="block text-xs font-medium text-gray-600 mb-1">Button 3 URL</label>
                        <input type="text" id="resources_banner_btn3_url" name="resources_banner_btn3_url"
                               value="{{ $btn3Url }}"
                               placeholder="/resources#annual-reports"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 pt-1">
                <button type="submit" class="btn-primary">Save Banner</button>
                <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600 text-sm transition-colors">Cancel</a>
                <a href="{{ route('resources') }}" target="_blank" class="ml-auto flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    View live page
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
