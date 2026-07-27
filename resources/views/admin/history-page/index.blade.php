@extends('admin.layouts.app')

@section('title', 'History Page')
@section('page-title', 'Our History')
@section('breadcrumb', 'Who We Are → History')

@php
$bv = fn($key, $default = '') => old($key, $bannerSettings->get($key, $default));
$bvFr = fn($key, $default = '') => old($key.'_fr', $bannerSettings->get($key.'_fr', $default));
$bannerImage = $bv('history_banner_image');
$bannerOverlayColor = $bv('history_banner_overlay_color', '#1a3c6e');
$bannerImageUrl = $bannerImage ? (str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage)) : null;
$bannerBadge = $bv('history_banner_badge', 'Our History');
$bannerTitle = $bv('history_banner_title', 'Help a Child Build Their Future');
$bannerSubtitle = $bv('history_banner_subtitle', 'Discover the inspiring journey of Krousar Thmey, from our humble beginnings in 1991 to our ongoing mission supporting children across Cambodia.');
$bannerSubtitleFr = $bvFr('history_banner_subtitle');
@endphp

@section('content')

{{-- Decorative page accent bar --}}
<div class="h-1.5 w-full bg-gradient-to-r from-[#2d6fa3] via-[#8da83a] to-[#2d6fa3] rounded-full mb-8"></div>

<div class="space-y-8" x-data="{ tab: 'banner' }">
    {{-- ── Centered Pill Tab Navigation ── --}}
    <div class="flex justify-center">
        <div class="inline-flex items-center bg-white shadow-lg shadow-gray-200/50 rounded-2xl p-1.5 border border-gray-200/80">
            <button type="button"
                    @click="tab = 'banner'"
                    :class="tab === 'banner'
                        ? 'bg-gradient-to-r from-[#2d6fa3] to-[#1d4e7a] shadow-md shadow-[#2d6fa3]/20 text-white'
                        : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
                    class="flex items-center gap-2.5 px-6 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 active:scale-95">
                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>History Banner</span>
            </button>
            <button type="button"
                    @click="tab = 'timeline'"
                    :class="tab === 'timeline'
                        ? 'bg-gradient-to-r from-[#2d6fa3] to-[#1d4e7a] shadow-md shadow-[#2d6fa3]/20 text-white'
                        : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
                    class="flex items-center gap-2.5 px-6 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 active:scale-95">
                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                </svg>
                <span>History Timeline</span>
            </button>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════ --}}
    {{-- HISTORY BANNER TAB --}}
    {{-- ═══════════════════════════════════════════ --}}
    <div x-show="tab === 'banner'" x-cloak class="space-y-6 max-w-5xl mx-auto">

        {{-- Live Preview Card --}}
        <div class="bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
            <div class="flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
                <span class="w-6 h-6 rounded-lg bg-blue-50 flex items-center justify-center">
                    <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </span>
                <span class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Live Preview</span>
                <span class="ml-auto flex items-center gap-1.5 text-[10px] text-gray-400">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    Real-time
                </span>
            </div>
            <div id="history-banner-preview" class="relative py-16 px-8 text-center overflow-hidden" style="background-color: {{ $bannerOverlayColor }};">
                @if($bannerImageUrl)
                <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $bannerImageUrl }}'); opacity: 0.35;"></div>
                @endif
                {{-- Subtle gradient depth overlay --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/10 via-transparent to-black/5"></div>
                <div class="relative z-10">
                    <span id="preview-badge" class="inline-block bg-white/95 backdrop-blur-sm text-[#eea91d] text-[10px] font-semibold px-4 py-1.5 rounded-full mb-4 uppercase tracking-wider shadow-lg">{{ $bannerBadge }}</span>
                    <h2 id="preview-title" class="text-2xl font-bold text-white mb-3 drop-shadow-lg">{{ $bannerTitle }}</h2>
                    <p id="preview-subtitle" class="text-white/80 text-sm max-w-lg mx-auto leading-relaxed">{{ $bannerSubtitle }}</p>
                </div>
            </div>
        </div>

        {{-- Settings Card --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            {{-- Card header with gradient accent top --}}
            <div class="h-1 bg-gradient-to-r from-[#2d6fa3] via-[#8da83a] to-[#2d6fa3]"></div>

            <div class="p-6 lg:p-8" x-data="bilingualForm()">
                {{-- Header row --}}
                <div class="flex items-center justify-between gap-3 mb-1">
                    <div class="flex items-center gap-3">
                        <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-orange-50 to-amber-50 flex items-center justify-center flex-shrink-0 border border-orange-100/50">
                            <svg class="w-4.5 h-4.5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <div>
                            <h3 class="font-bold text-gray-800 text-sm">History Page Banner</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Controls the hero banner at the top of the public "Who We Are" page</p>
                        </div>
                    </div>
                    <div class="lang-tabs" title="Toggle editing language">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                    </div>
                </div>

                <form action="{{ route('admin.history-banner.update') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-8">
                    @csrf

                    {{-- Section: Background Image --}}
                    <div class="bg-gray-50/60 rounded-xl p-5 border border-gray-100/80">
                        <div class="flex items-center gap-2.5 mb-4">
                            <span class="w-6 h-6 rounded-lg bg-blue-50 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <span class="text-sm font-semibold text-gray-700">Background Image</span>
                        </div>

                        @if($bannerImage)
                        <div class="mb-4 flex items-center gap-4 p-3 bg-white rounded-xl border border-gray-200 shadow-sm">
                            <img src="{{ str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage) }}"
                                 alt="Current banner"
                                 class="h-16 w-24 object-cover rounded-lg border border-gray-200">
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-medium text-gray-700 truncate">{{ basename($bannerImage) }}</p>
                                <label class="mt-1.5 inline-flex items-center gap-1.5 text-xs text-red-500 hover:text-red-600 cursor-pointer transition-colors">
                                    <input type="checkbox" name="history_banner_image_clear" value="1" class="rounded border-gray-300 text-red-500 focus:ring-red-400">
                                    Remove current image
                                </label>
                            </div>
                        </div>
                        @endif

                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-5 text-center hover:border-[#2d6fa3]/50 transition-all duration-200 cursor-pointer bg-white hover:bg-blue-50/30 group"
                             x-data="{ fileName: '' }"
                             @dragover.prevent="$el.classList.add('border-[#2d6fa3]', 'bg-blue-50/40')"
                             @dragleave.prevent="$el.classList.remove('border-[#2d6fa3]', 'bg-blue-50/40')"
                             @drop.prevent="$el.classList.remove('border-[#2d6fa3]', 'bg-blue-50/40'); const f = $event.dataTransfer.files[0]; if(f) { $refs.fileInput.files = $event.dataTransfer.files; fileName = f.name; }"
                             @click="$refs.fileInput.click()">
                            <input type="file" name="history_banner_image"
                                   accept="image/png,image/jpg,image/jpeg,image/webp,image/svg+xml"
                                   class="hidden" x-ref="fileInput"
                                   @change="fileName = $event.target.files[0]?.name || ''">
                            <div class="w-12 h-12 rounded-xl bg-gray-50 group-hover:bg-blue-100 flex items-center justify-center mx-auto mb-3 transition-all duration-200">
                                <svg class="w-6 h-6 text-gray-300 group-hover:text-[#2d6fa3] transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <p class="text-sm font-medium text-gray-600 group-hover:text-[#2d6fa3] transition-colors" x-text="fileName || 'Click or drag &amp; drop to upload'"></p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, WebP or SVG — max 5MB</p>
                        </div>

                        <div class="mt-3" x-data="{ showUrl: {{ $bannerImage && !str_starts_with($bannerImage, 'http') ? 'false' : 'true' }} }">
                            <button type="button" @click="showUrl = !showUrl"
                                    class="text-xs font-medium text-[#2d6fa3] hover:text-[#1d4e7a] transition-colors inline-flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                                </svg>
                                <span x-show="!showUrl">Use image URL instead</span>
                                <span x-show="showUrl">Hide URL input</span>
                            </button>
                            <div x-show="showUrl" x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 -translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0" class="mt-2">
                                <input type="text" name="history_banner_image_url"
                                       value="{{ str_starts_with($bannerImage ?? '', 'http') ? $bannerImage : '' }}"
                                       placeholder="https://example.com/image.png"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
                            </div>
                        </div>
                    </div>

                    {{-- Section: Overlay Color --}}
                    <div class="bg-gray-50/60 rounded-xl p-5 border border-gray-100/80">
                        <div class="flex items-center gap-2.5 mb-4">
                            <span class="w-6 h-6 rounded-lg bg-purple-50 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                                </svg>
                            </span>
                            <span class="text-sm font-semibold text-gray-700">Overlay Color</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <input type="color" id="history_banner_overlay_color_picker"
                                   value="{{ $bannerOverlayColor }}"
                                   class="h-11 w-14 shrink-0 rounded-lg border border-gray-200 cursor-pointer p-1"
                                   onchange="document.getElementById('history_banner_overlay_color').value = this.value; document.getElementById('history-banner-preview').style.backgroundColor = this.value;">
                            <input type="text" id="history_banner_overlay_color" name="history_banner_overlay_color"
                                   value="{{ $bannerOverlayColor }}"
                                   placeholder="#1a3c6e"
                                   oninput="if(/^#[0-9A-Fa-f]{6}$/.test(this.value)) { document.getElementById('history_banner_overlay_color_picker').value = this.value; document.getElementById('history-banner-preview').style.backgroundColor = this.value; }"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
                        </div>
                    </div>

                    {{-- Section: Badge & Title --}}
                    <div class="bg-gray-50/60 rounded-xl p-5 border border-gray-100/80">
                        <div class="flex items-center gap-2.5 mb-4">
                            <span class="w-6 h-6 rounded-lg bg-amber-50 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </span>
                            <span class="text-sm font-semibold text-gray-700">Badge &amp; Title</span>
                        </div>
                        <div class="grid lg:grid-cols-2 gap-5">
                            <div>
                                <label for="history_banner_badge" class="block text-xs font-medium text-gray-600 mb-1.5">Badge Text</label>
                                <input type="text" id="history_banner_badge" name="history_banner_badge"
                                       value="{{ $bannerBadge }}"
                                       oninput="document.getElementById('preview-badge').textContent = this.value || 'Our History'"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>
                            <div>
                                <label for="history_banner_title" class="block text-xs font-medium text-gray-600 mb-1.5">Hero Title</label>
                                <input type="text" id="history_banner_title" name="history_banner_title"
                                       value="{{ $bannerTitle }}"
                                       oninput="document.getElementById('preview-title').textContent = this.value || 'Help a Child Build Their Future'"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>
                        </div>
                    </div>

                    {{-- Section: Subtitle --}}
                    <div class="bg-gray-50/60 rounded-xl p-5 border border-gray-100/80">
                        <div class="flex items-center gap-2.5 mb-4">
                            <span class="w-6 h-6 rounded-lg bg-emerald-50 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                                </svg>
                            </span>
                            <span class="text-sm font-semibold text-gray-700">Subtitle</span>
                            <div class="ml-auto lang-tabs">
                                <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                                <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                            </div>
                        </div>
                        <div x-show="lang === 'en'">
                            <x-admin.rich-text id="history_banner_subtitle" name="history_banner_subtitle" :value="$bannerSubtitle" lang="en" :rows="2" />
                        </div>
                        <div x-show="lang === 'fr'" x-cloak>
                            <x-admin.rich-text id="history_banner_subtitle_fr" name="history_banner_subtitle_fr" :value="$bannerSubtitleFr" lang="fr" :rows="2" placeholder="Découvrez le parcours inspirant de Krousar Thmey…" />
                            <p class="text-xs text-gray-400 mt-1.5">Shown to French-language visitors. Leave blank to reuse the English subtitle.</p>
                        </div>
                    </div>

                    {{-- Form Actions --}}
                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" class="btn-primary text-sm py-2.5 px-6">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Save Banner
                        </button>
                        <a href="{{ route('about') }}" target="_blank"
                           class="inline-flex items-center gap-2 text-xs font-medium text-[#2d6fa3] hover:text-[#1d4e7a] bg-blue-50 hover:bg-blue-100 px-4 py-2.5 rounded-xl transition-all duration-200 ml-auto">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            View live page
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════ --}}
    {{-- HISTORY TIMELINE TAB --}}
    {{-- ═══════════════════════════════════════════ --}}
    <div x-show="tab === 'timeline'" x-cloak class="space-y-5 max-w-5xl mx-auto"
         x-data="{
            showModal: false,
            editing: false,
            editingId: null,
            submitting: false,
            lang: 'en',
            form: { year: '', left_text: '', left_text_fr: '', right_text: '', right_text_fr: '', sort_order: 0, is_active: true },
            imageFile: null,
            removeCurrentImage: false,
            currentImageUrl: null,
            errors: {},
            toast: { show: false, message: '', type: 'success' },
            search: @js($filters['search'] ?? ''),
            total: @js($totalEvents),
            loading: false,

            get modalTitle() { return this.editing ? 'Edit History Event' : 'Add History Event'; },
            get submitButtonText() { return this.editing ? 'Update Event' : 'Add Event'; },

            openAddModal() {
                this.editing = false; this.editingId = null; this.lang = 'en';
                this.form = { year: '', left_text: '', left_text_fr: '', right_text: '', right_text_fr: '', sort_order: 0, is_active: true };
                this.imageFile = null; this.removeCurrentImage = false; this.currentImageUrl = null;
                this.errors = {}; this.submitting = false; this.showModal = true;
                this.$nextTick(() => {
                    const fi = document.getElementById('modal-image-input'); if(fi) fi.value = '';
                    this.updateImagePreview(null); this.syncCKEditors();
                });
            },

            syncCKEditors() {
                window.setCKEditorContent?.(document.getElementById('history-left-text'), this.form.left_text);
                window.setCKEditorContent?.(document.getElementById('history-left-text-fr'), this.form.left_text_fr);
                window.setCKEditorContent?.(document.getElementById('history-right-text'), this.form.right_text);
                window.setCKEditorContent?.(document.getElementById('history-right-text-fr'), this.form.right_text_fr);
            },

            openEditModal(eventData) {
                this.editing = true; this.editingId = eventData.id; this.lang = 'en';
                this.form = {
                    year: eventData.year ?? '', left_text: eventData.left_text ?? '', left_text_fr: eventData.left_text_fr ?? '',
                    right_text: eventData.right_text ?? '', right_text_fr: eventData.right_text_fr ?? '',
                    sort_order: eventData.sort_order ?? 0, is_active: Boolean(eventData.is_active),
                };
                this.imageFile = null; this.removeCurrentImage = false; this.currentImageUrl = eventData.image_url ?? null;
                this.errors = {}; this.submitting = false; this.showModal = true;
                this.$nextTick(() => {
                    const fi = document.getElementById('modal-image-input'); if(fi) fi.value = '';
                    this.updateImagePreview(null); this.syncCKEditors();
                });
            },

            closeModal() { this.showModal = false; this.editing = false; this.editingId = null; this.errors = {}; this.submitting = false; },

            handleImageUpload(event) {
                const file = event.target.files[0];
                if(file) { this.imageFile = file; this.updateImagePreview(file); }
                else { this.imageFile = null; this.updateImagePreview(null); }
            },

            updateImagePreview(file) {
                const preview = document.getElementById('modal-image-preview-placeholder');
                const selected = document.getElementById('modal-image-selected');
                const filename = document.getElementById('modal-image-filename');
                if(!preview || !selected) return;
                if(file) { preview.classList.add('hidden'); selected.classList.remove('hidden'); selected.classList.add('flex'); if(filename) filename.textContent = file.name; }
                else { preview.classList.remove('hidden'); selected.classList.add('hidden'); selected.classList.remove('flex'); }
            },

            submitForm() {
                this.submitting = true; this.errors = {};
                const fd = new FormData();
                fd.append('year', this.form.year); fd.append('left_text', this.form.left_text); fd.append('left_text_fr', this.form.left_text_fr);
                fd.append('right_text', this.form.right_text); fd.append('right_text_fr', this.form.right_text_fr);
                fd.append('sort_order', this.form.sort_order);
                if(this.editing) {
                    fd.append('is_active', this.form.is_active ? '1' : '0');
                    if(this.removeCurrentImage) fd.append('remove_image', '1');
                }
                if(this.imageFile) fd.append('image', this.imageFile);
                let url;
                if(this.editing) { url = '{{ route('admin.history-events.update', '__ID__') }}'.replace('__ID__', this.editingId); fd.append('_method', 'PUT'); }
                else { url = '{{ route('admin.history-events.store') }}'; }
                fd.append('_token', '{{ csrf_token() }}');
                fetch(url, { method: 'POST', body: fd, headers: { 'Accept': 'application/json' } })
                .then(r => r.json().then(d => ({ status: r.status, data: d })))
                .then(({ status, data }) => {
                    if(status === 422) {
                        if(data.errors) { const flat = {}; Object.keys(data.errors).forEach(k => { flat[k] = data.errors[k][0]; }); this.errors = flat; }
                        this.submitting = false; return;
                    }
                    if(data.success) { this.closeModal(); this.showToast(data.message, 'success'); this.refreshList(); }
                    else { this.showToast(data.message || 'An error occurred.', 'error'); this.submitting = false; }
                })
                .catch(() => { this.showToast('Network error. Please try again.', 'error'); this.submitting = false; });
            },

            refreshList() {
                this.loading = true;
                const params = new URLSearchParams(); if(this.search) params.set('search', this.search);
                const url = '{{ route('admin.history-events.index') }}' + (params.toString() ? '?' + params.toString() : '');
                fetch(url, { headers: { 'Accept': 'application/json' } })
                    .then(r => r.json()).then(d => { this.$refs.results.innerHTML = d.html; this.total = d.total; history.replaceState(null, '', url); this.loading = false; })
                    .catch(() => { this.loading = false; });
            },

            applyFilters() { this.loading = true; this.refreshList(); },

            showToast(message, type = 'success') { this.toast = { show: true, message, type }; setTimeout(() => { this.toast.show = false; }, 3000); },
         }"
         x-init="$watch('search', () => applyFilters())">

        {{-- Toolbar Card --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="h-1 bg-gradient-to-r from-[#2d6fa3] via-[#8da83a] to-[#2d6fa3]"></div>

            <div class="p-5 lg:p-6">
                {{-- Header Row --}}
                <div class="flex items-center justify-between flex-wrap gap-4 pb-4 mb-4 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-50 to-indigo-50 flex items-center justify-center border border-blue-100/50">
                            <svg class="w-4.5 h-4.5 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                            </svg>
                        </span>
                        <div>
                            <h3 class="font-bold text-gray-800 text-sm">History Timeline</h3>
                            <p class="text-xs text-gray-400 mt-0.5">Manage key events in Krousar Thmey's journey</p>
                        </div>
                    </div>
                    <button @click="openAddModal()"
                            class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-[#2d6fa3] to-[#1d4e7a] text-white rounded-xl text-sm font-semibold transition-all duration-200 shadow-md shadow-[#2d6fa3]/20 hover:shadow-lg hover:shadow-[#2d6fa3]/30 hover:-translate-y-0.5 active:scale-95">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Add Event
                    </button>
                </div>

                {{-- Search Bar --}}
                <form method="GET" action="{{ route('admin.history-events.index') }}" class="flex flex-wrap items-center gap-3" @submit.prevent="applyFilters()">
                    <div class="relative flex-1 min-w-[240px]">
                        <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                               x-model.debounce.400ms="search"
                               placeholder="Search by year or event..."
                               autocomplete="off"
                               class="w-full bg-gray-50 border border-gray-200 rounded-xl pl-10 pr-4 py-2.5 text-sm text-gray-700 placeholder:text-gray-400 transition-all duration-150 hover:border-gray-300 focus:outline-none focus:bg-white focus:border-[#2d6fa3] focus:ring-4 focus:ring-[#2d6fa3]/10">
                    </div>
                    <button type="submit" @click.prevent="applyFilters()"
                            class="px-5 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-xl text-sm font-semibold transition-all duration-200 shadow-sm hover:shadow-md">
                        Search
                    </button>
                    <a href="{{ route('admin.history-events.index') }}" @click.prevent="search = ''; applyFilters()"
                       class="px-5 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-500 rounded-xl text-sm font-medium transition-all duration-200 border border-gray-200 hover:border-gray-300">
                        Reset
                    </a>
                </form>
            </div>
        </div>

        {{-- Results Counter --}}
        <div class="flex items-center justify-between px-1">
            <div class="flex items-center gap-2">
                <span class="px-2.5 py-1 bg-[#2d6fa3]/10 text-[#2d6fa3] rounded-full text-xs font-semibold">
                    <span x-text="total">{{ $totalEvents }}</span> events
                </span>
                <span class="text-xs text-gray-400" x-show="search" x-cloak>
                    matching "<span x-text="search" class="font-medium"></span>"
                </span>
            </div>
            <div x-show="loading" class="flex items-center gap-2 text-xs text-gray-400">
                <svg class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                </svg>
                Loading...
            </div>
        </div>

        {{-- Events List --}}
        <div x-ref="results" :class="loading ? 'opacity-50 pointer-events-none' : ''" style="transition: opacity 150ms">
            @include('admin.history_events._results', ['events' => $events, 'filters' => $filters])
        </div>

        {{-- ── Event Modal ── --}}
        <template x-teleport="body">
            <div x-show="showModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4" @keydown.escape.window="closeModal()">
                <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="closeModal()"></div>

                <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-hidden z-10"
                     @click.stop
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                     x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                     x-transition:leave-end="opacity-0 scale-95 translate-y-4">

                    {{-- Gradient accent bar --}}
                    <div class="h-1.5 w-full bg-gradient-to-r from-[#2d6fa3] via-[#8da83a] to-[#2d6fa3]"></div>

                    {{-- Modal Header --}}
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center">
                                <svg class="w-4 h-4 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 text-sm" x-text="modalTitle"></h3>
                                <p class="text-xs text-gray-400" x-text="editing ? 'Modify this history event' : 'Add a new milestone to the timeline'"></p>
                            </div>
                        </div>
                        <button @click="closeModal()" type="button"
                                class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 hover:rotate-90 flex items-center justify-center transition-all duration-200">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>

                    {{-- Modal Form --}}
                    <form @submit.prevent="submitForm()" class="p-6 space-y-4 overflow-y-auto max-h-[70vh]">
                        @csrf

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Year <span class="text-red-400">*</span></label>
                                <input type="text" x-model="form.year" required autocomplete="off"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] transition-shadow"
                                       :class="errors.year ? 'border-red-300 bg-red-50' : ''"
                                       placeholder="e.g. 1991">
                                <p class="text-xs text-red-500 mt-1" x-show="errors.year" x-text="errors.year" x-cloak></p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Sort Order</label>
                                <input type="number" x-model="form.sort_order"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] transition-shadow">
                            </div>
                        </div>

                        {{-- Language Tabs for Event Content --}}
                        <div class="flex justify-end -mb-2">
                            <div class="lang-tabs">
                                <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                                <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                            </div>
                        </div>

                        {{-- English Fields --}}
                        <div x-show="lang === 'en'" class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Left Column Text <span class="text-gray-400 font-normal">(optional)</span></label>
                                <x-admin.rich-text id="history-left-text" name="left_text_display" :value="''" lang="en" :rows="3"
                                    @input="form.left_text = $event.target.value" placeholder="Main event description..." />
                                <p class="text-xs text-red-500 mt-1" x-show="errors.left_text" x-text="errors.left_text" x-cloak></p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Right Column Text <span class="text-gray-400 font-normal">(optional)</span></label>
                                <x-admin.rich-text id="history-right-text" name="right_text_display" :value="''" lang="en" :rows="3"
                                    @input="form.right_text = $event.target.value" placeholder="Second event for same year..." />
                                <p class="text-xs text-red-500 mt-1" x-show="errors.right_text" x-text="errors.right_text" x-cloak></p>
                            </div>
                        </div>
                        <p class="text-xs text-gray-400" x-show="lang === 'en'">At least one of Left or Right Column Text is required.</p>

                        {{-- French Fields --}}
                        <div x-show="lang === 'fr'" x-cloak class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Left Column Text <span class="text-gray-400 font-normal">(French, optional)</span></label>
                                <x-admin.rich-text id="history-left-text-fr" name="left_text_fr_display" :value="''" lang="fr" :rows="3"
                                    @input="form.left_text_fr = $event.target.value" placeholder="Description principale..." />
                                <p class="text-xs text-red-500 mt-1" x-show="errors.left_text_fr" x-text="errors.left_text_fr" x-cloak></p>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Right Column Text <span class="text-gray-400 font-normal">(French, optional)</span></label>
                                <x-admin.rich-text id="history-right-text-fr" name="right_text_fr_display" :value="''" lang="fr" :rows="3"
                                    @input="form.right_text_fr = $event.target.value" placeholder="Deuxième événement..." />
                                <p class="text-xs text-red-500 mt-1" x-show="errors.right_text_fr" x-text="errors.right_text_fr" x-cloak></p>
                            </div>
                        </div>

                        {{-- Active Toggle --}}
                        <div class="flex items-center gap-3 px-4 py-3 bg-gray-50 rounded-xl border border-gray-200">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" x-model="form.is_active" class="sr-only peer">
                                <div class="w-9 h-5 bg-gray-300 peer-focus:outline-none peer-focus:ring-2 peer-focus:ring-[#2d6fa3]/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-[#2d6fa3]"></div>
                            </label>
                            <div>
                                <p class="text-xs font-semibold text-gray-700">Active</p>
                                <p class="text-[10px] text-gray-400" x-text="form.is_active ? 'Visible on the public timeline' : 'Hidden from visitors'"></p>
                            </div>
                        </div>

                        {{-- Image Upload --}}
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Event Image <span class="text-gray-400 font-normal">(PNG, JPG or SVG, max 2MB)</span></label>
                            <label for="modal-image-input"
                                   class="group flex items-center justify-center w-full h-14 border-2 border-dashed border-gray-200 rounded-xl cursor-pointer bg-gray-50 hover:bg-[#2d6fa3]/5 hover:border-[#2d6fa3]/40 transition-all duration-200">
                                <div class="flex items-center gap-2" id="modal-image-preview-placeholder">
                                    <svg class="w-4 h-4 text-gray-400 group-hover:text-[#2d6fa3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1117.9 9H18a4 4 0 010 8h-1m-4-4l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="text-xs font-semibold text-[#2d6fa3] group-hover:text-[#1d4e7a]">Click to upload or drag and drop</p>
                                </div>
                                <div class="hidden items-center gap-2" id="modal-image-selected">
                                    <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-xs font-medium text-gray-700 truncate max-w-[240px]" id="modal-image-filename"></p>
                                </div>
                                <input id="modal-image-input" type="file" name="image" accept="image/png,image/jpeg,image/webp,image/svg+xml" class="hidden" @change="handleImageUpload($event)">
                            </label>
                            <p class="text-xs text-red-500 mt-1.5" x-show="errors.image" x-text="errors.image" x-cloak></p>

                            <template x-if="editing && currentImageUrl">
                                <div class="mt-2 flex items-center gap-3 bg-white border border-gray-200 rounded-xl p-3 shadow-sm">
                                    <div class="w-10 h-10 rounded-lg bg-gray-50 border border-gray-100 flex items-center justify-center overflow-hidden flex-shrink-0">
                                        <img :src="currentImageUrl" class="max-w-full max-h-full object-contain">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-medium text-gray-700 truncate">Current image</p>
                                    </div>
                                    <label class="flex items-center gap-1.5 text-xs text-red-500 hover:text-red-600 cursor-pointer transition-colors">
                                        <input type="checkbox" x-model="removeCurrentImage" class="rounded border-gray-300 text-red-500 focus:ring-red-400">
                                        Remove
                                    </label>
                                </div>
                            </template>
                        </div>

                        {{-- Submit --}}
                        <div class="flex items-center gap-3 pt-2 border-t border-gray-100">
                            <button type="submit"
                                    class="flex-1 btn-primary justify-center text-sm py-2.5"
                                    x-text="submitButtonText"
                                    :disabled="submitting">
                            </button>
                            <button type="button" @click="closeModal()"
                                    class="px-5 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-xl transition-all duration-200">
                                Cancel
                            </button>
                        </div>

                        <div x-show="submitting" class="text-center text-xs text-gray-400 flex items-center justify-center gap-2" x-cloak>
                            <svg class="w-3.5 h-3.5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/>
                            </svg>
                            Saving...
                        </div>
                    </form>

                    {{-- Bottom accent bar --}}
                    <div class="h-1 w-full bg-gradient-to-r from-[#2d6fa3] to-[#8da83a]"></div>
                </div>
            </div>
        </template>

        {{-- Toast Notification --}}
        <div x-show="toast.show"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 translate-y-4"
             x-cloak
             class="fixed bottom-6 right-6 z-50 flex items-center gap-3 px-5 py-3.5 rounded-xl shadow-lg"
             :class="toast.type === 'success' ? 'bg-emerald-500 text-white' : 'bg-red-500 text-white'">
            <template x-if="toast.type === 'success'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </template>
            <template x-if="toast.type !== 'success'">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </template>
            <span x-text="toast.message" class="text-sm font-medium"></span>
            <button @click="toast.show = false" class="ml-2 hover:opacity-80">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
</div>

@endsection
