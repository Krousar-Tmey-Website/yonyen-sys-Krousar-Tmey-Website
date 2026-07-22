@extends('admin.layouts.app')

@section('title', 'History Page Banner')
@section('page-title', 'History Page Banner')
@section('breadcrumb', 'Who We Are → History Banner')

@section('content')

@php
    $bv = fn($key, $default = '') => old($key, $bannerSettings->get($key, $default));
    $bannerImage = $bv('history_banner_image');
    $bannerOverlayColor = $bv('history_banner_overlay_color', '#1a3c6e');
    $bannerImageUrl = $bannerImage ? (str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage)) : null;
    $bannerBadge = $bv('history_banner_badge', 'Our History');
    $bannerTitle = $bv('history_banner_title', 'Help a Child Build Their Future');
    $bannerSubtitle = $bv('history_banner_subtitle', 'Discover the inspiring journey of Krousar Thmey, from our humble beginnings in 1991 to our ongoing mission supporting children across Cambodia.');
@endphp

<div class="max-w-3xl mx-auto space-y-6">

    {{-- Live Preview --}}
    <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
        <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-4 py-2 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Live Preview
        </div>
        <div id="history-banner-preview" class="relative py-14 px-6 text-center overflow-hidden" style="background-color: {{ $bannerOverlayColor }};">
            @if($bannerImageUrl)
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $bannerImageUrl }}'); opacity: 0.35;"></div>
            @endif
            <div class="relative">
                <span id="preview-badge" class="inline-block bg-white text-[#eea91d] text-[10px] font-semibold px-3 py-1 rounded-full mb-3 uppercase tracking-wider">{{ $bannerBadge }}</span>
                <h2 id="preview-title" class="text-xl font-bold text-white mb-2">{{ $bannerTitle }}</h2>
                <p id="preview-subtitle" class="text-white/80 text-xs max-w-md mx-auto">{{ $bannerSubtitle }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center gap-3 mb-1">
            <span class="text-xl">🎨</span>
            <h3 class="font-bold text-gray-800 text-base">History Page Banner</h3>
        </div>
        <p class="text-xs text-gray-400 mb-4">Controls the hero banner at the top of the public "Who We Are" page, shown above the history timeline.</p>

        <hr class="mb-5 border-gray-100">

        <form action="{{ route('admin.history-banner.update') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- Background Image --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Background Image</label>

                @if($bannerImage)
                <div class="mb-3">
                    <img src="{{ str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage) }}"
                         alt="Current banner image"
                         class="w-full max-h-48 object-contain rounded-xl border border-gray-200 bg-gray-50 p-2">
                    <label class="mt-2 inline-flex items-center gap-2 text-xs text-gray-500 cursor-pointer">
                        <input type="checkbox" name="history_banner_image_clear" value="1" class="rounded border-gray-300 text-red-500 focus:ring-red-400">
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
                    <input type="file" name="history_banner_image"
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
                    <button type="button" @click="showUrl = !showUrl"
                            class="text-xs text-[#2d6fa3] hover:text-[#1d4e7a] transition-colors mb-2">
                        <span x-show="!showUrl">+ Or paste an image URL instead</span>
                        <span x-show="showUrl">− Hide URL input</span>
                    </button>
                    <div x-show="showUrl" x-transition:enter="transition ease-out duration-150"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0">
                        <input type="text" name="history_banner_image_url"
                               value="{{ str_starts_with($bannerImage ?? '', 'http') ? $bannerImage : '' }}"
                               placeholder="https://example.com/image.png"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
                    </div>
                </div>
            </div>

            {{-- Background Overlay Color --}}
            <div>
                <label for="history_banner_overlay_color" class="block text-sm font-medium text-gray-700 mb-1.5">Background Overlay Color</label>
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

            {{-- Badge Text --}}
            <div>
                <label for="history_banner_badge" class="block text-sm font-medium text-gray-700 mb-1.5">Badge Text</label>
                <input type="text" id="history_banner_badge" name="history_banner_badge"
                       value="{{ $bannerBadge }}"
                       oninput="document.getElementById('preview-badge').textContent = this.value || 'Our History'"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            {{-- Hero Title --}}
            <div>
                <label for="history_banner_title" class="block text-sm font-medium text-gray-700 mb-1.5">Hero Title</label>
                <input type="text" id="history_banner_title" name="history_banner_title"
                       value="{{ $bannerTitle }}"
                       oninput="document.getElementById('preview-title').textContent = this.value || 'Help a Child Build Their Future'"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            {{-- Hero Subtitle --}}
            <div>
                <label for="history_banner_subtitle" class="block text-sm font-medium text-gray-700 mb-1.5">Hero Subtitle</label>
                <textarea id="history_banner_subtitle" name="history_banner_subtitle" rows="2"
                          oninput="document.getElementById('preview-subtitle').textContent = this.value"
                          class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ $bannerSubtitle }}</textarea>
            </div>

            <div class="flex items-center gap-3 pt-1">
                <button type="submit" class="btn-primary">Save Banner</button>
                <a href="{{ route('admin.history-events.index') }}" class="text-gray-400 hover:text-gray-600 text-sm transition-colors">Cancel</a>
                <a href="{{ route('about') }}" target="_blank" class="ml-auto flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    View live page
                </a>
            </div>
        </form>
    </div>
</div>

@endsection
