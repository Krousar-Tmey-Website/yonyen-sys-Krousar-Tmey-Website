@extends('admin.layouts.app')

@section('title', 'Become a Partner Management')
@section('page-title', 'Become a Partner Management')
@section('breadcrumb', 'Edit the banner, partner stats, and call-to-action shown in the Partner section of the Get Involved page')

@section('content')

@php
    $ctaTitle = old('partner_cta_title', $settings['partner_cta_title']->value ?? $defaults['partner_cta_title']);
    $ctaDescription = old('partner_cta_description', $settings['partner_cta_description']->value ?? $defaults['partner_cta_description']);
    $ctaButtonText = old('partner_cta_button_text', $settings['partner_cta_button_text']->value ?? $defaults['partner_cta_button_text']);
    $ctaButtonLink = old('partner_cta_button_link', $settings['partner_cta_button_link']->value ?? $defaults['partner_cta_button_link']);
    $partnerCount = old('partner_count', $settings['partner_count']->value ?? $defaults['partner_count']);
    $partnerCountLabel = old('partner_count_label', $settings['partner_count_label']->value ?? $defaults['partner_count_label']);

    $bannerImage = $settings['partner_banner_image']->value ?? $defaults['partner_banner_image'];
    $bannerIsUrl = str_starts_with($bannerImage, 'http');
    $bannerSrc = $bannerImage ? ($bannerIsUrl ? $bannerImage : asset('storage/' . $bannerImage)) : null;
    $bannerImageTypeInit = ($bannerIsUrl && $bannerImage !== '') ? 'url' : 'upload';
@endphp

<form id="partnerPageForm" action="{{ route('admin.partner-page.update') }}" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>

<div class="max-w-4xl mx-auto pb-6">

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl mb-6">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="space-y-6">

        {{-- ── Section 1: Banner Image ─────────────────────────────────--}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5" x-data="{ imageType: '{{ $bannerImageTypeInit }}' }">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Banner Image</h3>
                    <p class="text-xs text-gray-400 mt-0.5">The photo shown in the Partner section.</p>
                </div>
                <div class="flex items-center gap-1 bg-gray-100 p-1 rounded-lg">
                    <button type="button" @click="imageType = 'upload'"
                            :class="imageType === 'upload' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'"
                            class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Upload File</button>
                    <button type="button" @click="imageType = 'url'"
                            :class="imageType === 'url' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'"
                            class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Image URL</button>
                </div>
            </div>

            @if($bannerSrc)
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                <img src="{{ $bannerSrc }}" alt="Current banner" class="h-20 w-36 rounded-lg object-cover border border-gray-200 flex-shrink-0">
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-medium text-gray-600 mb-0.5">Current banner image</p>
                    <p class="text-xs text-gray-400 truncate">{{ $bannerImage }}</p>
                </div>
                <label class="flex items-center gap-1.5 text-xs text-red-500 hover:text-red-700 cursor-pointer flex-shrink-0">
                    <input type="checkbox" name="partner_banner_image_clear" value="1" form="partnerPageForm" class="rounded border-gray-300 text-red-500 w-3.5 h-3.5">
                    Remove
                </label>
            </div>
            @else
            <div class="flex items-center gap-3 p-3 bg-[#2d6fa3]/5 rounded-xl border border-[#2d6fa3]/10">
                <div class="h-20 w-36 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                    <svg class="w-7 h-7 text-[#2d6fa3]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <p class="text-xs text-gray-500">No banner uploaded yet.</p>
            </div>
            @endif

            <div x-show="imageType === 'upload'" :style="imageType === 'upload' ? '' : 'display:none'">
                <input type="file" name="partner_banner_image" form="partnerPageForm" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                @error('partner_banner_image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div x-show="imageType === 'url'" :style="imageType === 'url' ? '' : 'display:none'">
                <input type="url" name="partner_banner_image_url" form="partnerPageForm"
                       value="{{ $bannerImageTypeInit === 'url' ? old('partner_banner_image_url', $bannerImage) : old('partner_banner_image_url') }}"
                       placeholder="https://example.com/banner.jpg"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                @error('partner_banner_image_url')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <p class="text-xs text-gray-400">Recommended: 1600 &times; 600px landscape. JPG, PNG or WebP — max 4MB.</p>
        </div>

        {{-- ── Section 2: Partner Count Stat ───────────────────────────--}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            <div>
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Partner Count Stat</h3>
                <p class="text-xs text-gray-400 mt-0.5">The statistic badge shown on the image card.</p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Count Value</label>
                    <input type="text" name="partner_count" form="partnerPageForm"
                           value="{{ $partnerCount }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="70+">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Count Label</label>
                    <input type="text" name="partner_count_label" form="partnerPageForm"
                           value="{{ $partnerCountLabel }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="Partner organisations">
                </div>
            </div>
        </div>

        {{-- ── Section 3: Call To Action ───────────────────────────────--}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Call To Action</h3>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">CTA Title</label>
                <input type="text" name="partner_cta_title" form="partnerPageForm"
                       value="{{ $ctaTitle }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="Interested in becoming a partner?">
                @error('partner_cta_title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">CTA Description</label>
                <textarea name="partner_cta_description" form="partnerPageForm" rows="2"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                          placeholder="Let's build together our future cooperation">{{ $ctaDescription }}</textarea>
                @error('partner_cta_description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Button Text</label>
                <input type="text" name="partner_cta_button_text" form="partnerPageForm"
                       value="{{ $ctaButtonText }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="Contact Us to Partner">
                @error('partner_cta_button_text')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Button Link</label>
                <input type="text" name="partner_cta_button_link" form="partnerPageForm"
                       value="{{ $ctaButtonLink }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="{{ route('contact') }}">
                <p class="text-xs text-gray-400 mt-1">Enter a URL or leave empty to link to the Contact page.</p>
                @error('partner_cta_button_link')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

    </div>
</div>

{{-- ── Bottom Actions (sticky footer) ───────────────────────────── --}}
<div class="sticky bottom-0 -mx-6 px-6 py-4 bg-white/95 backdrop-blur border-t border-gray-100 flex items-center gap-3 mt-2">
    <button type="submit" form="partnerPageForm"
            class="bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white px-7 py-2.5 rounded-xl text-sm font-semibold transition-all shadow-sm hover:shadow-md">
        Save Changes
    </button>
    <a href="{{ route('admin.partner-page.index') }}"
       class="px-5 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-800 rounded-xl hover:bg-gray-100 transition-all border border-transparent hover:border-gray-200">
        Cancel
    </a>
    <a href="{{ route('involved') }}#partner" target="_blank"
       class="ml-auto flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
        View live page
    </a>
</div>

@endsection
