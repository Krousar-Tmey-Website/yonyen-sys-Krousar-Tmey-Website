@extends('admin.layouts.app')

@section('title', 'Programs Page Banner')
@section('page-title', 'Programs Page Banner')
@section('breadcrumb', 'Edit the hero banner shown at the top of the Our Programs public page')

@section('content')

<div class="max-w-3xl mx-auto space-y-6">

    {{-- Live Preview --}}
    @php
        $previewTitle    = $settings['programs_banner_title']->value    ?? 'Our Programs';
        $previewSubtitle = $settings['programs_banner_subtitle']->value  ?? '';
        $previewImage    = $settings['programs_banner_image']->value     ?? '';
        $isUrlImage      = str_starts_with($previewImage, 'http');
        $previewImgSrc   = $previewImage ? ($isUrlImage ? $previewImage : asset('storage/' . $previewImage)) : '';
        $previewBgStyle  = $previewImgSrc
            ? 'background-image: linear-gradient(to right, rgba(26,60,110,0.88) 50%, rgba(26,60,110,0.65)), url(' . $previewImgSrc . '); background-size: cover; background-position: center;'
            : '';
        $currentImage    = $previewImage;
        $currentImageUrl = $previewImgSrc ?: null;
        $imageTypeInit   = (str_starts_with($currentImage, 'http') && $currentImage !== '') ? 'url' : 'upload';
    @endphp

    <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
        <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-4 py-2 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Live Preview
        </div>
        <div id="banner-preview" class="bg-[#1a3c6e] pt-10 pb-12 px-8 relative overflow-hidden" style="{{ $previewBgStyle }}">
            <div class="absolute inset-0 opacity-10">
                <div class="absolute top-0 right-0 w-64 h-64 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
            </div>
            <div class="relative">
                <nav class="flex items-center gap-2 text-xs text-white/50 mb-5">
                    <span>Home</span>
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-white">Our Programs</span>
                </nav>
                <h1 id="preview-title" class="text-2xl font-bold text-white mb-2">{{ $previewTitle }}</h1>
                <p id="preview-subtitle" class="text-white/70 text-sm max-w-xl">{{ $previewSubtitle }}</p>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <form action="{{ route('admin.programs-banner.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Text content --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                <span class="text-base">&#9997;&#65039;</span> Banner Text
            </h3>

            <div>
                <label for="programs_banner_title" class="block text-sm font-medium text-gray-700 mb-1.5">
                    Page Title <span class="text-red-400">*</span>
                </label>
                <input type="text"
                       id="programs_banner_title"
                       name="programs_banner_title"
                       value="{{ old('programs_banner_title', $settings['programs_banner_title']->value ?? 'Our Programs') }}"
                       required
                       oninput="document.getElementById('preview-title').textContent = this.value || 'Our Programs'"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="Our Programs">
                <p class="mt-1.5 text-xs text-gray-400">The large heading displayed at the top of the page.</p>
            </div>

            <div>
                <label for="programs_banner_subtitle" class="block text-sm font-medium text-gray-700 mb-1.5">Subtitle / Description</label>
                <textarea id="programs_banner_subtitle"
                          name="programs_banner_subtitle"
                          rows="3"
                          oninput="document.getElementById('preview-subtitle').textContent = this.value"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                          placeholder="Short description shown below the title...">{{ old('programs_banner_subtitle', $settings['programs_banner_subtitle']->value ?? '') }}</textarea>
                <p class="mt-1.5 text-xs text-gray-400">One or two sentences summarising the programs section.</p>
            </div>
        </div>

        {{-- Background image (x-data uses PHP-computed value to avoid quote conflict) --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5"
             x-data="{ imageType: '{{ $imageTypeInit }}' }">

            <div class="flex items-center justify-between">
                <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                    <span class="text-base">&#128444;&#65039;</span> Background Image
                    <span class="text-xs font-normal text-gray-400 normal-case tracking-normal">(optional &mdash; falls back to solid blue)</span>
                </h3>
                <div class="flex items-center gap-1 bg-gray-100 p-1 rounded-lg">
                    <button type="button" @click="imageType = 'upload'"
                            :class="imageType === 'upload' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'"
                            class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Upload File</button>
                    <button type="button" @click="imageType = 'url'"
                            :class="imageType === 'url' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'"
                            class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Image URL</button>
                </div>
            </div>

            {{-- Current image preview --}}
            @if($currentImageUrl)
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                <img src="{{ $currentImageUrl }}" alt="Current banner" class="h-14 w-24 rounded-lg object-cover border border-gray-200">
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-medium text-gray-600 mb-0.5">Current background image</p>
                    <p class="text-xs text-gray-400 truncate">{{ $currentImage }}</p>
                </div>
                <label class="flex items-center gap-1.5 text-xs text-red-500 hover:text-red-700 cursor-pointer">
                    <input type="checkbox" name="programs_banner_image_clear" value="1" class="rounded border-gray-300 text-red-500 w-3.5 h-3.5">
                    Remove image
                </label>
            </div>
            @else
            <div class="flex items-center gap-3 p-3 bg-[#1a3c6e]/5 rounded-xl border border-[#1a3c6e]/10">
                <div class="h-14 w-24 rounded-lg bg-[#1a3c6e] flex items-center justify-center flex-shrink-0">
                    <span class="text-white/40 text-xs">No image</span>
                </div>
                <p class="text-xs text-gray-500">Banner currently uses a solid blue background. Upload or link an image to add a photo backdrop.</p>
            </div>
            @endif

            <div x-show="imageType === 'upload'" :style="imageType === 'upload' ? '' : 'display:none'">
                <input type="file" name="programs_banner_image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                <p class="mt-2 text-xs text-gray-400">Max 4MB. Recommended: 1400x400px landscape. The image will be darkened with a blue overlay.</p>
            </div>

            <div x-show="imageType === 'url'" :style="imageType === 'url' ? '' : 'display:none'">
                <input type="url" name="programs_banner_image_url"
                       value="{{ $imageTypeInit === 'url' ? $currentImage : '' }}"
                       placeholder="https://example.com/banner.jpg"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-2 text-xs text-gray-400">Enter a direct link to an image (Unsplash, your CDN, etc.).</p>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-semibold rounded-xl transition-colors">
                Save Banner
            </button>
            <a href="{{ route('admin.programs.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
            <a href="{{ route('programs') }}" target="_blank" class="ml-auto flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View live page
            </a>
        </div>
    </form>
</div>

@endsection