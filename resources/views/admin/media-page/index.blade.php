@extends('admin.layouts.app')

@section('title', 'Media Page')
@section('page-title', 'Media Page')
@section('breadcrumb', 'Manage the public Media page (press article + latest news intro)')

@section('content')

@php
    $previewTitle       = $settings['media_title'] ?? 'Media';
    $previewSourceLabel = $settings['media_press_source_label'] ?? 'Press Article';
    $previewSourceName  = $settings['media_press_source_name'] ?? 'The Phnom Penh Post';
    $previewHeadline    = $settings['media_press_headline'] ?? 'Classical arts not a priority in schools today';
    $previewDate        = $settings['media_press_date'] ?? '07.25.17';
    $previewExcerpt     = $settings['media_press_excerpt'] ?? "Traditional Cambodian art forms such as classical dance and music have been passed down throughout the generations as a way for children to learn and preserve the meaning of their culture. However, as the education sector changes, gaining knowledge of the arts at a young age is proving less essential for the Kingdom's public schools…";
    $previewImage       = $settings['media_press_image'] ?? null;
    $previewImageUrl    = $previewImage ? (str_starts_with($previewImage, 'http') ? $previewImage : asset('storage/' . $previewImage)) : asset('images/cultural.jpg');
@endphp

<div class="max-w-3xl mx-auto space-y-6">

    {{-- Live Preview --}}
    <div class="rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
        <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-4 py-2 bg-gray-50 border-b border-gray-100 flex items-center gap-2">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            Live Preview
        </div>
        <div class="bg-white px-8 py-8">
            <p id="preview-title" class="text-center text-xl font-extrabold tracking-tight text-[#0A5EA8] uppercase mb-6">{{ $previewTitle }}</p>

            <div class="grid sm:grid-cols-2 gap-5 items-start">
                <img id="preview-image" src="{{ $previewImageUrl }}" alt="" class="w-full h-32 object-cover rounded-xl">
                <div>
                    <p class="text-xs mb-1.5">
                        <span id="preview-source-label" class="font-bold text-gray-700">{{ $previewSourceLabel }}</span>
                        <span class="text-gray-400">/</span>
                        <span id="preview-source-name" class="text-[#2d6fa3] font-semibold">{{ $previewSourceName }}</span>
                    </p>
                    <p id="preview-headline" class="font-bold text-gray-800 text-sm mb-1">&ldquo;{{ $previewHeadline }}&rdquo;</p>
                    <p class="italic text-gray-400 text-xs mb-2">published <span id="preview-date">{{ $previewDate }}</span></p>
                    <p id="preview-excerpt" class="italic text-gray-500 text-xs leading-relaxed line-clamp-3">{{ $previewExcerpt }}</p>
                </div>
            </div>
        </div>
    </div>

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.media-page.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Page Header --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                <span class="text-base">🏷️</span> Page Header
            </h3>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Page Title</label>
                <input type="text" name="media_title" value="{{ old('media_title', $settings['media_title'] ?? 'Media') }}"
                       oninput="document.getElementById('preview-title').textContent = this.value || 'Media'"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400">The large heading at the top of the Media page.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Communication Officer Email</label>
                <input type="email" name="media_contact_email" value="{{ old('media_contact_email', $settings['media_contact_email'] ?? 'communication@krousar-thmey.org') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400">Shown as "For any request, please contact our Communication Officer at…"</p>
            </div>
        </div>

        {{-- Featured Press Article --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                <span class="text-base">📰</span> Featured Press Article
                <span class="text-xs font-normal text-gray-400 normal-case tracking-normal">("Krousar Thmey In The News")</span>
            </h3>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Section Heading</label>
                <input type="text" name="media_press_heading" value="{{ old('media_press_heading', $settings['media_press_heading'] ?? 'Krousar Thmey In The News') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Photo</label>
                @if(!empty($settings['media_press_image']))
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100 mb-3">
                    <img src="{{ $previewImageUrl }}" alt="Current press photo" class="h-14 w-24 object-cover rounded-lg border border-gray-200">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium text-gray-600 mb-0.5">Current photo</p>
                        <p class="text-xs text-gray-400 truncate">{{ $settings['media_press_image'] }}</p>
                    </div>
                    <label class="flex items-center gap-1.5 text-xs text-red-500 hover:text-red-700 cursor-pointer flex-shrink-0">
                        <input type="checkbox" name="remove_media_press_image" value="1" class="rounded border-gray-300 text-red-500 w-3.5 h-3.5">
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
                <input type="file" name="media_press_image_file" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                <p class="mt-1.5 text-xs text-gray-400">Max 4MB. Landscape photos work best.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Source Label</label>
                    <input type="text" name="media_press_source_label" value="{{ old('media_press_source_label', $settings['media_press_source_label'] ?? 'Press Article') }}"
                           oninput="document.getElementById('preview-source-label').textContent = this.value"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Publication Name</label>
                    <input type="text" name="media_press_source_name" value="{{ old('media_press_source_name', $settings['media_press_source_name'] ?? 'The Phnom Penh Post') }}"
                           oninput="document.getElementById('preview-source-name').textContent = this.value"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Headline</label>
                <input type="text" name="media_press_headline" value="{{ old('media_press_headline', $settings['media_press_headline'] ?? 'Classical arts not a priority in schools today') }}"
                       oninput="document.getElementById('preview-headline').textContent = '“' + this.value + '”'"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Published Date</label>
                <input type="text" name="media_press_date" value="{{ old('media_press_date', $settings['media_press_date'] ?? '07.25.17') }}"
                       oninput="document.getElementById('preview-date').textContent = this.value"
                       placeholder="e.g. 07.25.17"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400">Free text — shown exactly as typed, e.g. "published 07.25.17".</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Excerpt</label>
                <textarea name="media_press_excerpt" rows="4"
                          oninput="document.getElementById('preview-excerpt').textContent = this.value"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('media_press_excerpt', $settings['media_press_excerpt'] ?? "Traditional Cambodian art forms such as classical dance and music have been passed down throughout the generations as a way for children to learn and preserve the meaning of their culture. However, as the education sector changes, gaining knowledge of the arts at a young age is proving less essential for the Kingdom's public schools…") }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Article URL</label>
                <input type="url" name="media_press_article_url" value="{{ old('media_press_article_url', $settings['media_press_article_url'] ?? '') }}" placeholder="https://..."
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400">Where the "Read the article" button sends visitors — link to the original press coverage.</p>
            </div>
        </div>

        {{-- Latest News Section --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
                <span class="text-base">🗞️</span> Latest News Section
            </h3>
            <p class="text-xs text-gray-400 -mt-2">The 3 news cards below this heading are pulled automatically from your most recent published News Articles — nothing to manage here.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Section Heading</label>
                    <input type="text" name="media_latest_heading" value="{{ old('media_latest_heading', $settings['media_latest_heading'] ?? 'Latest News') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Intro Link Text</label>
                    <input type="text" name="media_latest_intro" value="{{ old('media_latest_intro', $settings['media_latest_intro'] ?? "Visit our News section to find more of Krousar Thmey's news") }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-semibold rounded-xl transition-colors">
                Save Media Page
            </button>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
            <a href="{{ route('media') }}" target="_blank" class="ml-auto flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View live page
            </a>
        </div>
    </form>
</div>

@endsection
