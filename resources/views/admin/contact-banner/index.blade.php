@extends('admin.layouts.app')

@section('title', 'Contact Page Banner')
@section('page-title', 'Contact Page Banner')
@section('breadcrumb', 'Support → Contact Page Banner')

@section('content')

@php
    $bv = fn($key, $default = '') => old($key, $bannerSettings->get($key, $default));
    $bannerImage = $bv('contact_banner_image');
    $bannerOverlayColor = $bv('contact_banner_overlay_color', '#1d4e7a');
    $bannerImageUrl = $bannerImage ? (str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage)) : null;
    $bannerBadge = $bv('contact_banner_badge', 'Support Our Work');
    $bannerTitle = $bv('contact_banner_title', 'Make a Difference Today');
$bannerTitleFr = $bv('contact_banner_title_fr');
    $bannerSubtitle = $bv('contact_banner_subtitle', 'Every contribution goes directly to supporting children across Cambodia. 100% of funds reach the children.');
$bannerSubtitleFr = $bv('contact_banner_subtitle_fr');
    $btn1Text = $bv('contact_banner_btn1_text', 'Donate Now');
    $btn1Url  = $bv('contact_banner_btn1_url', '/donate');
    $btn2Text = $bv('contact_banner_btn2_text', 'Get Involved');
    $btn2Url  = $bv('contact_banner_btn2_url', '/get-involved');
@endphp

{{-- Decorative page accent bar --}}
<div class="h-1.5 w-full bg-gradient-to-r from-[#2d6fa3] via-[#8da83a] to-[#2d6fa3] rounded-full mb-8"></div>

<div class="space-y-6 max-w-5xl mx-auto">

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
        <div id="contact-banner-preview" class="relative py-16 px-8 text-center overflow-hidden" style="background-color: {{ $bannerOverlayColor }};">
            @if($bannerImageUrl)
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $bannerImageUrl }}'); opacity: 0.25;"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-black/10 via-transparent to-black/5"></div>
            <div class="relative z-10">
                <span id="preview-badge" class="inline-block text-[#8da83a] font-bold text-xs uppercase tracking-widest mb-3">{{ $bannerBadge }}</span>
                <h2 id="preview-title" class="text-3xl md:text-4xl font-black uppercase tracking-wide text-white mb-4 drop-shadow-lg">{!! $bannerTitle !!}</h2>
                <p id="preview-subtitle" class="text-white/70 text-base mb-6 max-w-2xl mx-auto">{!! $bannerSubtitle !!}</p>
                <div class="flex flex-wrap gap-3 justify-center">
                    <span id="preview-btn1" class="inline-flex items-center px-5 py-2.5 bg-[#2d6fa3] text-white rounded-full text-sm font-bold shadow-md">{{ $btn1Text }}</span>
                    <span id="preview-btn2" class="inline-flex items-center px-5 py-2.5 border-2 border-white/40 text-white rounded-full text-sm font-bold">{{ $btn2Text }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Settings Card --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="h-1 bg-gradient-to-r from-[#2d6fa3] via-[#8da83a] to-[#2d6fa3]"></div>

        <div class="p-6 lg:p-8">
            <div class="flex items-center justify-between gap-3 mb-1">
                <div class="flex items-center gap-3">
                    <span class="w-9 h-9 rounded-xl bg-gradient-to-br from-green-50 to-emerald-50 flex items-center justify-center flex-shrink-0 border border-green-100/50">
                        <svg class="w-4.5 h-4.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </span>
                    <div>
                        <h3 class="font-bold text-gray-800 text-sm">Contact Page CTA Banner</h3>
                        <p class="text-xs text-gray-400 mt-0.5">Controls the \"Support Our Work\" banner at the bottom of the Contact page</p>
                    </div>
                </div>
            </div>

            <form action="{{ route('admin.contact-banner.update') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-8" x-data="bilingualForm()">
                <div class="flex justify-end -mt-2">
                    <div class="lang-tabs" title="Toggle editing language (English / French) for this banner">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                    </div>
                </div>
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
                             alt="Current banner" class="h-16 w-24 object-cover rounded-lg border border-gray-200">
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium text-gray-700 truncate">{{ basename($bannerImage) }}</p>
                            <label class="mt-1.5 inline-flex items-center gap-1.5 text-xs text-red-500 hover:text-red-600 cursor-pointer transition-colors">
                                <input type="checkbox" name="contact_banner_image_clear" value="1" class="rounded border-gray-300 text-red-500 focus:ring-red-400">
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
                        <input type="file" name="contact_banner_image"
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
                            <input type="text" name="contact_banner_image_url"
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
                        <input type="color" id="contact_banner_overlay_color_picker"
                               value="{{ $bannerOverlayColor }}"
                               class="h-11 w-14 shrink-0 rounded-lg border border-gray-200 cursor-pointer p-1"
                               onchange="document.getElementById('contact_banner_overlay_color').value = this.value; document.getElementById('contact-banner-preview').style.backgroundColor = this.value;">
                        <input type="text" id="contact_banner_overlay_color" name="contact_banner_overlay_color"
                               value="{{ $bannerOverlayColor }}"
                               placeholder="#1d4e7a"
                               oninput="if(/^#[0-9A-Fa-f]{6}$/.test(this.value)) { document.getElementById('contact_banner_overlay_color_picker').value = this.value; document.getElementById('contact-banner-preview').style.backgroundColor = this.value; }"
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
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Badge Text</label>
                            <div x-show="lang === 'en'">
                                <input type="text" name="contact_banner_badge" value="{{ $bannerBadge }}"
                                       oninput="document.getElementById('preview-badge').textContent = this.value || 'Support Our Work'"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>
                            <div x-show="lang === 'fr'" x-cloak>
                                <input type="text" name="contact_banner_badge_fr" value="{{ $bv('contact_banner_badge_fr') }}"
                                       placeholder="Leave blank to reuse the English text"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Title</label>
                            <div x-show="lang === 'en'">
                                <x-admin.rich-text name="contact_banner_title" :value="$bannerTitle" lang="en" :rows="1" />
                            </div>
                            <div x-show="lang === 'fr'" x-cloak>
                                <x-admin.rich-text name="contact_banner_title_fr" :value="$bannerTitleFr" lang="fr" :rows="1" placeholder="Faites une différence aujourd'hui" />
                                <p class="text-xs text-gray-400 mt-1">Leave blank to reuse the English title.</p>
                            </div>
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
                    </div>
                    <div x-show="lang === 'en'">
                        <x-admin.rich-text name="contact_banner_subtitle" :value="$bannerSubtitle" lang="en" :rows="3" />
                    </div>
                    <div x-show="lang === 'fr'" x-cloak>
                        <x-admin.rich-text name="contact_banner_subtitle_fr" :value="$bannerSubtitleFr" lang="fr" :rows="3"
                                           placeholder="Chaque contribution soutient directement les enfants du Cambodge…" />
                        <p class="text-xs text-gray-400 mt-1">Leave blank to reuse the English subtitle.</p>
                    </div>
                </div>

                {{-- Section: Buttons --}}
                <div class="bg-gray-50/60 rounded-xl p-5 border border-gray-100/80">
                    <div class="flex items-center gap-2.5 mb-4">
                        <span class="w-6 h-6 rounded-lg bg-rose-50 flex items-center justify-center">
                            <svg class="w-3.5 h-3.5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </span>
                        <span class="text-sm font-semibold text-gray-700">Buttons</span>
                    </div>
                    <div class="grid lg:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Button 1 (Primary) — Text</label>
                            <div x-show="lang === 'en'">
                                <input type="text" name="contact_banner_btn1_text" value="{{ $btn1Text }}"
                                       oninput="document.getElementById('preview-btn1').textContent = this.value"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>
                            <div x-show="lang === 'fr'" x-cloak>
                                <input type="text" name="contact_banner_btn1_text_fr" value="{{ $bv('contact_banner_btn1_text_fr') }}"
                                       placeholder="Leave blank to reuse the English text"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Button 1 — URL</label>
                            <input type="text" name="contact_banner_btn1_url" value="{{ $btn1Url }}"
                                   placeholder="/donate"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Button 2 (Outline) — Text</label>
                            <div x-show="lang === 'en'">
                                <input type="text" name="contact_banner_btn2_text" value="{{ $btn2Text }}"
                                       oninput="document.getElementById('preview-btn2').textContent = this.value"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>
                            <div x-show="lang === 'fr'" x-cloak>
                                <input type="text" name="contact_banner_btn2_text_fr" value="{{ $bv('contact_banner_btn2_text_fr') }}"
                                       placeholder="Leave blank to reuse the English text"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Button 2 — URL</label>
                            <input type="text" name="contact_banner_btn2_url" value="{{ $btn2Url }}"
                                   placeholder="/get-involved"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="flex items-center gap-4 pt-2">
                    <button type="submit" class="btn-primary text-sm py-2.5 px-6">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Save Banner
                    </button>
                    <a href="{{ route('contact') }}" target="_blank"
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

@endsection
