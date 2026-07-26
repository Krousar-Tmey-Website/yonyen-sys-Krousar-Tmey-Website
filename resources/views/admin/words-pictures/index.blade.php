@extends('admin.layouts.app')

@section('title', 'Words and Pictures')
@section('page-title', 'Words and Pictures')
@section('breadcrumb', 'Manage the public Words and Pictures Application page')

@section('content')

@if($errors->any())
<div class="max-w-3xl mx-auto mb-6 bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
    <ul class="list-disc list-inside space-y-1">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="max-w-3xl mx-auto space-y-6">
    <form action="{{ route('admin.words-pictures.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6" x-data="bilingualForm()">
        @csrf

        {{-- Page Title --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </span>
                Page Title
            </h3>
            <input type="text" name="words_pictures_title" value="{{ old('words_pictures_title', $settings['words_pictures_title'] ?? 'Words and Pictures Application') }}"
                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
        </div>

        {{-- Objective --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                        </svg>
                    </span>
                    Objective
                </h3>
                <div class="lang-tabs" title="Toggle editing language (English / French)">
                    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                <input type="text" name="words_pictures_objective_heading" value="{{ old('words_pictures_objective_heading', $settings['words_pictures_objective_heading'] ?? 'Objective') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div x-show="lang === 'en'">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Text</label>
                <x-admin.rich-text name="words_pictures_objective_text" :value="old('words_pictures_objective_text', $settings['words_pictures_objective_text'] ?? 'To enable children with hearing and speech impairments and their relatives and friends access a tool to practice Cambodian Sign Language.')" lang="en" :rows="3" />
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Text (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="words_pictures_objective_text_fr" :value="old('words_pictures_objective_text_fr', $settings['words_pictures_objective_text_fr'] ?? '')" lang="fr" :rows="3" placeholder="Pour permettre aux enfants..." />
                <p class="mt-1.5 text-xs text-gray-400">Shown to French-language visitors. Leave blank to reuse the English text.</p>
            </div>
        </div>

        {{-- Project Description --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3"/>
                        </svg>
                    </span>
                    Project Description
                </h3>
                <div class="lang-tabs" title="Toggle editing language (English / French)">
                    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Heading</label>
                <input type="text" name="words_pictures_project_heading" value="{{ old('words_pictures_project_heading', $settings['words_pictures_project_heading'] ?? 'Project') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div x-show="lang === 'en'">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Paragraph 1</label>
                <x-admin.rich-text name="words_pictures_project_p1" :value="old('words_pictures_project_p1', $settings['words_pictures_project_p1'] ?? 'For over 25 years, Krousar Thmey has implemented a unique mix of special and inclusive education for children with sensory disabilities in Cambodia, developing a unique expertise in visual and hearing impairments with an established track record of results, transforming lives through education, and lastingly influencing national policies. Children with hearing disabilities face many challenges in terms of communication, and have specific educational needs requiring adapted resources. As technology is an ever growing means of providing access to education and communication, Krousar Thmey is launching an educative and innovative mobile phone application:')" lang="en" :rows="4" />
                <p class="mt-1.5 text-xs text-gray-400">Ends right before the app name (shown in italics automatically).</p>
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Paragraph 1 (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="words_pictures_project_p1_fr" :value="old('words_pictures_project_p1_fr', $settings['words_pictures_project_p1_fr'] ?? '')" lang="fr" :rows="4" placeholder="Depuis plus de 25 ans, Krousar Thmey..." />
                <p class="mt-1.5 text-xs text-gray-400">Shown to French-language visitors. Leave blank to reuse the English text.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">App Name</label>
                <input type="text" name="words_pictures_app_name" value="{{ old('words_pictures_app_name', $settings['words_pictures_app_name'] ?? 'Words and Pictures') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div x-show="lang === 'en'">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Paragraph 2</label>
                <x-admin.rich-text name="words_pictures_project_p2" :value="old('words_pictures_project_p2', $settings['words_pictures_project_p2'] ?? 'Based on a very intuitive interface and simple design, the inclusive application is readily accessible to a very wide audience, and equally useful for families with young children with or without disabilities. Featuring over 500 words relevant to every-day life situations, selected for their suitability to the Cambodian background, the purpose of the application is to offer a fun picture dictionary with integrated sounds and sign language pictograms.')" lang="en" :rows="4" />
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Paragraph 2 (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="words_pictures_project_p2_fr" :value="old('words_pictures_project_p2_fr', $settings['words_pictures_project_p2_fr'] ?? '')" lang="fr" :rows="4" placeholder="Basée sur une interface très intuitive..." />
                <p class="mt-1.5 text-xs text-gray-400">Shown to French-language visitors. Leave blank to reuse the English text.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Download Line — Prefix</label>
                    <input type="text" name="words_pictures_download_prefix" value="{{ old('words_pictures_download_prefix', $settings['words_pictures_download_prefix'] ?? 'To download the application on your smartphone, please visit:') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div class="sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Download URL</label>
                    <input type="text" name="words_pictures_download_url" value="{{ old('words_pictures_download_url', $settings['words_pictures_download_url'] ?? 'http://onelink.to/krousarthmey') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div class="sm:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Download Line — Suffix</label>
                    <input type="text" name="words_pictures_download_suffix" value="{{ old('words_pictures_download_suffix', $settings['words_pictures_download_suffix'] ?? 'or scan the QR code below.') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>

            <div x-show="lang === 'en'">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Thanks / Credits</label>
                <x-admin.rich-text name="words_pictures_thanks_text" :value="old('words_pictures_thanks_text', $settings['words_pictures_thanks_text'] ?? 'Many thanks to Judit van Geystelen for the original idea and design, Open Institute for the development, as well as the Ministry of Education, Youth and Sport of Cambodia, Symphasis Foundation, and Clariant Foundation for their support.')" lang="en" :rows="3" />
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Thanks / Credits (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="words_pictures_thanks_text_fr" :value="old('words_pictures_thanks_text_fr', $settings['words_pictures_thanks_text_fr'] ?? '')" lang="fr" :rows="3" placeholder="Nos remerciements vont à..." />
                <p class="mt-1.5 text-xs text-gray-400">Shown to French-language visitors. Leave blank to reuse the English text.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Dedication</label>
                <input type="text" name="words_pictures_dedication_text" value="{{ old('words_pictures_dedication_text', $settings['words_pictures_dedication_text'] ?? 'This application is dedicated to Tina.') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Contact Line — Prefix</label>
                    <input type="text" name="words_pictures_contact_prefix" value="{{ old('words_pictures_contact_prefix', $settings['words_pictures_contact_prefix'] ?? 'If you are interested in developing this application in the language of your choice, please contact:') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Contact Email</label>
                    <input type="email" name="words_pictures_contact_email" value="{{ old('words_pictures_contact_email', $settings['words_pictures_contact_email'] ?? 'sign.picture.dictionary@gmail.com') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
        </div>

        {{-- QR Code --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-orange-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 15a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1H5a1 1 0 01-1-1v-4zM14 5a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM14 14h2m4 0h-2m0 0v2m0 4v-2m0 0h-4m4 0h2"/>
                    </svg>
                </span>
                QR Code
            </h3>
            @if(!empty($settings['words_pictures_qr_image']))
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                <img src="{{ str_starts_with($settings['words_pictures_qr_image'], 'http') ? $settings['words_pictures_qr_image'] : asset('storage/' . $settings['words_pictures_qr_image']) }}"
                     alt="Current QR code" class="h-16 w-16 object-cover rounded-lg border border-gray-200 bg-white p-1">
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-medium text-gray-600 mb-0.5">Current QR code</p>
                    <p class="text-xs text-gray-400 truncate">{{ $settings['words_pictures_qr_image'] }}</p>
                </div>
                <label class="flex items-center gap-1.5 text-xs text-red-500 hover:text-red-700 cursor-pointer flex-shrink-0">
                    <input type="checkbox" name="remove_words_pictures_qr_image" value="1" class="rounded border-gray-300 text-red-500 w-3.5 h-3.5">
                    Remove
                </label>
            </div>
            @else
            <div class="flex items-center gap-3 p-3 bg-[#2d6fa3]/5 rounded-xl border border-[#2d6fa3]/10">
                <div class="h-16 w-16 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                    <span class="text-[#2d6fa3]/50 text-xs">None</span>
                </div>
                <p class="text-xs text-gray-500">No QR code uploaded yet — the QR code block is hidden from the page until one is added.</p>
            </div>
            @endif
            <input type="file" name="words_pictures_qr_image_file" accept="image/*"
                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
            <p class="text-xs text-gray-400">Max 4MB. Should point to the same Download URL above.</p>
        </div>

        {{-- Buttons --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                </span>
                Buttons
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">"Learn More" Button Text</label>
                    <input type="text" name="words_pictures_learn_more_text" value="{{ old('words_pictures_learn_more_text', $settings['words_pictures_learn_more_text'] ?? 'Learn more about the projects of this program') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">"Learn More" Button URL</label>
                    <input type="url" name="words_pictures_learn_more_url" value="{{ old('words_pictures_learn_more_url', $settings['words_pictures_learn_more_url'] ?? route('programs.show', 'special-education')) }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">"Donate Now" Button URL</label>
                <input type="text" name="words_pictures_donate_url" value="{{ old('words_pictures_donate_url', $settings['words_pictures_donate_url'] ?? route('donate')) }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
        </div>

        {{-- Photo --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </span>
                Main Photo
            </h3>
            @if(!empty($settings['words_pictures_photo']))
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                <img src="{{ str_starts_with($settings['words_pictures_photo'], 'http') ? $settings['words_pictures_photo'] : asset('storage/' . $settings['words_pictures_photo']) }}"
                     alt="Current photo" class="h-14 w-24 object-cover rounded-lg border border-gray-200">
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-medium text-gray-600 mb-0.5">Current photo</p>
                    <p class="text-xs text-gray-400 truncate">{{ $settings['words_pictures_photo'] }}</p>
                </div>
                <label class="flex items-center gap-1.5 text-xs text-red-500 hover:text-red-700 cursor-pointer flex-shrink-0">
                    <input type="checkbox" name="remove_words_pictures_photo" value="1" class="rounded border-gray-300 text-red-500 w-3.5 h-3.5">
                    Remove
                </label>
            </div>
            @else
            <div class="flex items-center gap-3 p-3 bg-[#2d6fa3]/5 rounded-xl border border-[#2d6fa3]/10">
                <div class="h-14 w-24 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                    <span class="text-[#2d6fa3]/50 text-xs">No photo</span>
                </div>
                <p class="text-xs text-gray-500">Falls back to a default photo until you upload one.</p>
            </div>
            @endif
            <input type="file" name="words_pictures_photo_file" accept="image/*"
                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
            <p class="text-xs text-gray-400">Max 4MB. Shown large on the right side of the page.</p>
        </div>

        {{-- In The News --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </span>
                    "In The News" Press Article
                </h3>
                <div class="lang-tabs" title="Toggle editing language (English / French)">
                    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Section Heading</label>
                <input type="text" name="words_pictures_press_heading" value="{{ old('words_pictures_press_heading', $settings['words_pictures_press_heading'] ?? 'Words and Pictures in the News') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Photo</label>
                @if(!empty($settings['words_pictures_press_image']))
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100 mb-3">
                    <img src="{{ str_starts_with($settings['words_pictures_press_image'], 'http') ? $settings['words_pictures_press_image'] : asset('storage/' . $settings['words_pictures_press_image']) }}"
                         alt="Current press photo" class="h-14 w-24 object-cover rounded-lg border border-gray-200">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium text-gray-600 mb-0.5">Current photo</p>
                        <p class="text-xs text-gray-400 truncate">{{ $settings['words_pictures_press_image'] }}</p>
                    </div>
                    <label class="flex items-center gap-1.5 text-xs text-red-500 hover:text-red-700 cursor-pointer flex-shrink-0">
                        <input type="checkbox" name="remove_words_pictures_press_image" value="1" class="rounded border-gray-300 text-red-500 w-3.5 h-3.5">
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
                <input type="file" name="words_pictures_press_image_file" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                <p class="mt-1.5 text-xs text-gray-400">Max 4MB.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Photo Caption</label>
                <input type="text" name="words_pictures_press_image_caption" value="{{ old('words_pictures_press_image_caption', $settings['words_pictures_press_image_caption'] ?? "The newly launched 'Words and Pictures' app is dedicated to helping children with hearing and speech impairments. Supplied") }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400">Shown as a dark caption bar over the bottom of the photo. Leave blank to hide it.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Source Label</label>
                    <input type="text" name="words_pictures_press_source_label" value="{{ old('words_pictures_press_source_label', $settings['words_pictures_press_source_label'] ?? 'Press Article') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Publication Name</label>
                    <input type="text" name="words_pictures_press_source_name" value="{{ old('words_pictures_press_source_name', $settings['words_pictures_press_source_name'] ?? 'The Phnom Penh Post') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Headline</label>
                <input type="text" name="words_pictures_press_headline" value="{{ old('words_pictures_press_headline', $settings['words_pictures_press_headline'] ?? 'Krousar Thmey empowering children with hearing issues') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Published Date</label>
                <input type="text" name="words_pictures_press_date" value="{{ old('words_pictures_press_date', $settings['words_pictures_press_date'] ?? '04.27.2020') }}"
                       placeholder="e.g. 04.27.2020"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div x-show="lang === 'en'">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Excerpt</label>
                <x-admin.rich-text name="words_pictures_press_excerpt" :value="old('words_pictures_press_excerpt', $settings['words_pictures_press_excerpt'] ?? 'As children with hearing disabilities face many challenges in terms of communication and have specific educational needs, Krousar Thmey has utilised technology to create a mobile learning app as a resource for disadvantaged children…')" lang="en" :rows="3" />
            </div>
            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Excerpt (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <x-admin.rich-text name="words_pictures_press_excerpt_fr" :value="old('words_pictures_press_excerpt_fr', $settings['words_pictures_press_excerpt_fr'] ?? '')" lang="fr" :rows="3" placeholder="Les enfants souffrant de..." />
                <p class="mt-1.5 text-xs text-gray-400">Shown to French-language visitors. Leave blank to reuse the English text.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Article URL</label>
                <input type="url" name="words_pictures_press_article_url" value="{{ old('words_pictures_press_article_url', $settings['words_pictures_press_article_url'] ?? '') }}" placeholder="https://..."
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400">Where the "Read the article" button sends visitors.</p>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary">Save Words and Pictures Page</button>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
            <a href="{{ route('words-pictures') }}" target="_blank" class="ml-auto flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View live page
            </a>
        </div>
    </form>
</div>

@endsection
