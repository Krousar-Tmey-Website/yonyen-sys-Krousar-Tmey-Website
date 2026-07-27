@extends('admin.layouts.app')

@section('title', 'Transparency')
@section('page-title', 'Transparency')
@section('breadcrumb', 'Manage the transparency page banner and text content')

@section('content')

<div class="space-y-8 max-w-3xl mx-auto" x-data="{ tab: 'banner', lang: 'en' }">
    {{-- Tab Navigation --}}
    <div class="border-b border-gray-200">
        <nav class="flex space-x-8 overflow-x-auto">
            <button @click="tab = 'banner'"
                    :class="tab === 'banner' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Transparency Banner
            </button>
            <button @click="tab = 'content'"
                    :class="tab === 'content' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Page Text
            </button>
        </nav>
    </div>

    <div class="lang-tabs" title="Toggle editing language (English / French)">
        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
    </div>

@php
    $bv = fn($key, $default = '') => old($key, $settings[$key] ?? $default);
    $bvFr = fn($key, $default = '') => old($key.'_fr', $settings[$key.'_fr'] ?? $default);
    $bannerImage = $bv('transparency_banner_image');
    $bannerImageUrl = $bannerImage ? (str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage)) : null;
    $bannerOverlayColor = $bv('transparency_banner_overlay_color', '#1a3c6e');
    $bannerBlur = (int) $bv('transparency_banner_blur', 0);
    $bannerBadge = $bv('transparency_banner_badge', 'Accountability');
    $bannerBadgeFr = $bvFr('transparency_banner_badge');
    $bannerTitle = $bv('transparency_title', 'Transparency and Accountability');
    $bannerTitleFr = $bvFr('transparency_title');
    $bannerSubtitle = $bv('transparency_banner_subtitle', 'See how every donation is managed with strict financial discipline and independent oversight.');
    $bannerSubtitleFr = $bvFr('transparency_banner_subtitle');
@endphp

{{-- ========================================================
     TAB: TRANSPARENCY BANNER — hero shown at the top of /who-we-are/transparency
     ======================================================== --}}
<div x-show="tab === 'banner'" class="space-y-6">
    {{-- Live Preview --}}
    <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
        <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-4 py-2 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Live Preview
        </div>
        <div id="transparency-banner-preview" class="relative py-14 px-6 text-center overflow-hidden" style="background-color: {{ $bannerOverlayColor }};">
            @if($bannerImageUrl)
            <div id="preview-image" class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $bannerImageUrl }}'); opacity: 0.35; filter: blur({{ $bannerBlur }}px);"></div>
            @endif
            <div class="relative">
                <span id="preview-badge" class="inline-block bg-white text-[#eea91d] text-[10px] font-semibold px-3 py-1 rounded-full mb-3 uppercase tracking-wider">{{ $bannerBadge }}</span>
                <h2 id="preview-title" class="text-xl font-bold text-white mb-2 uppercase">{{ $bannerTitle }}</h2>
                <p id="preview-subtitle" class="text-white/80 text-xs max-w-md mx-auto">{!! $bannerSubtitle !!}</p>
            </div>
        </div>
    </div>

    {{-- Banner Form (separate — needs multipart for the image upload) --}}
    <form action="{{ route('admin.transparency.banner.update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
        @csrf
        <h3 class="font-bold text-gray-700 text-sm">Page Banner</h3>
        <p class="text-xs text-gray-400 -mt-3">Controls the hero banner shown at the top of the public page (image, colors, title and subtitle).</p>

        {{-- Background Image --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Background Image</label>

            @if($bannerImage)
            <div class="mb-3">
                <img src="{{ str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage) }}"
                     alt="Current banner image"
                     class="w-full max-h-48 object-contain rounded-xl border border-gray-200 bg-gray-50 p-2">
                <label class="mt-2 inline-flex items-center gap-2 text-xs text-gray-500 cursor-pointer">
                    <input type="checkbox" name="transparency_banner_image_clear" value="1" class="rounded border-gray-300 text-red-500 focus:ring-red-400">
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
                <input type="file" name="transparency_banner_image"
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
                    <input type="text" name="transparency_banner_image_url"
                           value="{{ str_starts_with($bannerImage ?? '', 'http') ? $bannerImage : '' }}"
                           placeholder="https://example.com/image.png"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
                </div>
            </div>
        </div>

        {{-- Background Overlay Color --}}
        <div>
            <label for="transparency_banner_overlay_color" class="block text-sm font-medium text-gray-700 mb-1.5">Background Overlay Color</label>
            <div class="flex items-center gap-3">
                <input type="color" id="transparency_banner_overlay_color_picker"
                       value="{{ $bannerOverlayColor }}"
                       class="h-11 w-14 shrink-0 rounded-lg border border-gray-200 cursor-pointer p-1"
                       onchange="document.getElementById('transparency_banner_overlay_color').value = this.value; document.getElementById('transparency-banner-preview').style.backgroundColor = this.value;">
                <input type="text" id="transparency_banner_overlay_color" name="transparency_banner_overlay_color"
                       value="{{ $bannerOverlayColor }}"
                       placeholder="#1a3c6e"
                       oninput="if(/^#[0-9A-Fa-f]{6}$/.test(this.value)) { document.getElementById('transparency_banner_overlay_color_picker').value = this.value; document.getElementById('transparency-banner-preview').style.backgroundColor = this.value; }"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
            </div>
        </div>

        {{-- Background Blur --}}
        <div>
            <label for="transparency_banner_blur" class="block text-sm font-medium text-gray-700 mb-1.5">
                Background Blur <span class="text-gray-400 font-normal">(<span id="blur-value-label">{{ $bannerBlur }}</span>px)</span>
            </label>
            <input type="range" id="transparency_banner_blur" name="transparency_banner_blur"
                   min="0" max="20" step="1"
                   value="{{ $bannerBlur }}"
                   oninput="document.getElementById('blur-value-label').textContent = this.value; var img = document.getElementById('preview-image'); if (img) { img.style.filter = 'blur(' + this.value + 'px)'; }"
                   class="w-full accent-[#2d6fa3] cursor-pointer">
            <p class="text-xs text-gray-400 mt-1">0 = sharp/clean image. Higher values soften the photo so text stands out more.</p>
        </div>

        {{-- Badge Text --}}
        <div x-show="lang === 'en'">
            <label for="transparency_banner_badge" class="block text-sm font-medium text-gray-700 mb-1.5">Badge Text</label>
            <input type="text" id="transparency_banner_badge" name="transparency_banner_badge"
                   value="{{ $bannerBadge }}"
                   oninput="document.getElementById('preview-badge').textContent = this.value || 'Accountability'"
                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
        </div>
        <div x-show="lang === 'fr'" x-cloak>
            <label for="transparency_banner_badge_fr" class="block text-sm font-medium text-gray-700 mb-1.5">Badge Text (French) <span class="text-gray-400 font-normal">(optional)</span></label>
            <input type="text" id="transparency_banner_badge_fr" name="transparency_banner_badge_fr"
                   value="{{ $bannerBadgeFr }}"
                   oninput="document.getElementById('preview-badge').textContent = this.value || 'Accountability'"
                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            <p class="text-xs text-gray-400 mt-1">Shown to French-language visitors. Leave blank to reuse the English badge.</p>
        </div>

        {{-- Page Title --}}
        <div x-show="lang === 'en'">
            <label for="transparency_title" class="block text-sm font-medium text-gray-700 mb-1.5">Page Title</label>
            <input type="text" id="transparency_title" name="transparency_title"
                   value="{{ $bannerTitle }}"
                   oninput="document.getElementById('preview-title').textContent = this.value || 'Transparency and Accountability'"
                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
        </div>
        <div x-show="lang === 'fr'" x-cloak>
            <label for="transparency_title_fr" class="block text-sm font-medium text-gray-700 mb-1.5">Page Title (French) <span class="text-gray-400 font-normal">(optional)</span></label>
            <input type="text" id="transparency_title_fr" name="transparency_title_fr"
                   value="{{ $bannerTitleFr }}"
                   oninput="document.getElementById('preview-title').textContent = this.value || 'Transparency and Accountability'"
                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            <p class="text-xs text-gray-400 mt-1">Shown to French-language visitors. Leave blank to reuse the English title.</p>
        </div>

        {{-- Subtitle --}}
        <div x-show="lang === 'en'">
            <label for="transparency_banner_subtitle" class="block text-sm font-medium text-gray-700 mb-1.5">Subtitle</label>
            <x-admin.rich-text id="transparency_banner_subtitle" name="transparency_banner_subtitle" :value="$bannerSubtitle" lang="en" :rows="2" />
        </div>
        <div x-show="lang === 'fr'" x-cloak>
            <label for="transparency_banner_subtitle_fr" class="block text-sm font-medium text-gray-700 mb-1.5">Subtitle (French) <span class="text-gray-400 font-normal">(optional)</span></label>
            <x-admin.rich-text id="transparency_banner_subtitle_fr" name="transparency_banner_subtitle_fr" :value="$bannerSubtitleFr" lang="fr" :rows="2" />
            <p class="text-xs text-gray-400 mt-1">Shown to French-language visitors. Leave blank to reuse the English subtitle.</p>
        </div>

        <div class="flex items-center gap-3 pt-1">
            <button type="submit" class="btn-primary">Save Banner</button>
            @if(Route::has('transparency'))
            <a href="{{ route('transparency') }}" target="_blank" class="ml-auto flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View live page
            </a>
            @endif
        </div>
    </form>
</div>

{{-- ========================================================
     TAB: PAGE TEXT — everything shown on /who-we-are/transparency
     ======================================================== --}}
<div x-show="tab === 'content'" class="space-y-6">
    <form action="{{ route('admin.transparency.content.update') }}" method="POST" class="space-y-6">
        @csrf

        @php
            $cv = fn($key, $default = '') => old($key, $settings[$key] ?? $default);
            $cvFr = fn($key, $default = '') => old($key.'_fr', $settings[$key.'_fr'] ?? $default);
        @endphp

        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="font-bold text-gray-700 text-sm">Financial Transparency</h3>
            <div x-show="lang === 'en'">
                <label class="block text-xs font-medium text-gray-600 mb-1">Section Heading</label>
                <input type="text" name="transparency_financial_heading" value="{{ $cv('transparency_financial_heading', 'Financial Transparency') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-xs font-medium text-gray-600 mb-1">Section Heading (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <input type="text" name="transparency_financial_heading_fr" value="{{ $cvFr('transparency_financial_heading') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            <div x-show="lang === 'en'">
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 1</label>
                <x-admin.rich-text name="transparency_financial_p1" :value="$cv('transparency_financial_p1', 'Financial transparency is a key principle for Krousar Thmey. Everybody has the right to know how the funds raised are used.')" lang="en" :rows="2" />
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 1 (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="transparency_financial_p1_fr" :value="$cvFr('transparency_financial_p1')" lang="fr" :rows="2" />
            </div>

            <div x-show="lang === 'en'">
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 2</label>
                <x-admin.rich-text name="transparency_financial_p2" :value="$cv('transparency_financial_p2', 'The implementation of programs and projects is our priority.')" lang="en" :rows="2" />
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 2 (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="transparency_financial_p2_fr" :value="$cvFr('transparency_financial_p2')" lang="fr" :rows="2" />
            </div>

            <div x-show="lang === 'en'">
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 3</label>
                <x-admin.rich-text name="transparency_financial_p3" :value="$cv('transparency_financial_p3', 'Thanks to the strict financial management and the involvement of European volunteers, all administrative costs remain under 4% of the total budget.')" lang="en" :rows="2" />
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 3 (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="transparency_financial_p3_fr" :value="$cvFr('transparency_financial_p3')" lang="fr" :rows="2" />
            </div>

            <div x-show="lang === 'en'">
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 4 (Audit firm)</label>
                <x-admin.rich-text name="transparency_financial_p4" :value="$cv('transparency_financial_p4', 'Krousar Thmey Cambodia\'s accounts are all audited and certified each year by an independent audit firm (PricewaterhouseCoopers since 2013 and KPMG before then). Working closely with the auditors, Krousar Thmey is committed to constantly improving the quality and precision of its financial processes in order to provide greater efficiency to the organization and transparency to its partners.')" lang="en" :rows="3" />
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 4 (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="transparency_financial_p4_fr" :value="$cvFr('transparency_financial_p4')" lang="fr" :rows="3" />
            </div>


            <div x-show="lang === 'en'">
                <label class="block text-xs font-medium text-gray-600 mb-1">Closing Line</label>
                <x-admin.rich-text name="transparency_financial_outro" :value="$cv('transparency_financial_outro', 'Our French and Swiss organisations\' accounts are also audited annually.')" lang="en" :rows="2" />
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-xs font-medium text-gray-600 mb-1">Closing Line (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="transparency_financial_outro_fr" :value="$cvFr('transparency_financial_outro')" lang="fr" :rows="2" />
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="font-bold text-gray-700 text-sm">Origins Of The Funds</h3>
            <div x-show="lang === 'en'">
                <label class="block text-xs font-medium text-gray-600 mb-1">Section Heading</label>
                <input type="text" name="transparency_origins_heading" value="{{ $cv('transparency_origins_heading', 'Origins Of The Funds') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-xs font-medium text-gray-600 mb-1">Section Heading (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <input type="text" name="transparency_origins_heading_fr" value="{{ $cvFr('transparency_origins_heading') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            <div x-show="lang === 'en'">
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 1 (International support)</label>
                <x-admin.rich-text name="transparency_origins_p1" :value="$cv('transparency_origins_p1', 'In support of its local activity in Cambodia, Krousar Thmey benefits from the involvement of volunteers in international entities: Krousar Thmey France, Krousar Thmey Switzerland and Krousar Thmey Singapore. As their main activity is fundraising, these branches are a privileged relay to donors outside of Cambodia. They enable Krousar Thmey to receive institutional funding and support from individual donors.')" lang="en" :rows="3" />
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 1 (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="transparency_origins_p1_fr" :value="$cvFr('transparency_origins_p1')" lang="fr" :rows="3" />
            </div>

            <div x-show="lang === 'en'">
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 2 (Local support)</label>
                <x-admin.rich-text name="transparency_origins_p2" :value="$cv('transparency_origins_p2', 'Donations received in Cambodia come mainly from non-governmental organizations and to a lesser extent from private donors and the Cambodian authorities.')" lang="en" :rows="2" />
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 2 (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="transparency_origins_p2_fr" :value="$cvFr('transparency_origins_p2')" lang="fr" :rows="2" />
            </div>

            <div x-show="lang === 'en'">
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 3</label>
                <x-admin.rich-text name="transparency_origins_p3" :value="$cv('transparency_origins_p3', 'Financial or in-kind donations from the Cambodian authorities have increased steadily over the past few years, accounting for nearly 8% of Krousar Thmey\'s resources. All staff of special schools for deaf or blind children are civil servants of the Ministry of Education, Youth and Sports who pay their salary (excluding complements paid by Krousar Thmey). For the time being, this contribution is not included in the expenditure and income statement.')" lang="en" :rows="3" />
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-xs font-medium text-gray-600 mb-1">Paragraph 3 (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="transparency_origins_p3_fr" :value="$cvFr('transparency_origins_p3')" lang="fr" :rows="3" />
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="font-bold text-gray-700 text-sm">Award Line</h3>
            <p class="text-xs text-gray-400">Renders as: "{prefix} {link label} {suffix}" — e.g. Krousar Thmey won the <span class="text-[#2d6fa3] underline">label Ideas</span> in 2010.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" x-show="lang === 'en'">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Prefix</label>
                    <input type="text" name="transparency_award_prefix" value="{{ $cv('transparency_award_prefix', 'Krousar Thmey won the') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Suffix</label>
                    <input type="text" name="transparency_award_suffix" value="{{ $cv('transparency_award_suffix', 'in 2010.') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Link Label</label>
                    <input type="text" name="transparency_award_link_label" value="{{ $cv('transparency_award_link_label', 'label Ideas') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Link URL</label>
                    <input type="url" name="transparency_award_link_url" value="{{ $cv('transparency_award_link_url', 'https://ideas.asso.fr/') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    <p class="text-xs text-gray-400 mt-1">Same URL used for both languages.</p>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" x-show="lang === 'fr'" x-cloak>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Prefix (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <input type="text" name="transparency_award_prefix_fr" value="{{ $cvFr('transparency_award_prefix') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Suffix (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <input type="text" name="transparency_award_suffix_fr" value="{{ $cvFr('transparency_award_suffix') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Link Label (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <input type="text" name="transparency_award_link_label_fr" value="{{ $cvFr('transparency_award_link_label') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
        </div>

        <button type="submit" class="px-6 py-2.5 bg-[#2d6fa3] text-white rounded-xl text-sm font-semibold hover:bg-[#1d4e7a] transition">
            Save Page Text
        </button>
    </form>
</div>

</div>

@endsection