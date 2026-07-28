@extends('admin.layouts.app')

@section('title', 'Volunteer Section')
@section('page-title', 'Volunteer Section')
@section('breadcrumb', 'Get Involved → Volunteer Section')

@section('content')

@php
    $sv = fn ($key, $default = '') => old($key, $settings[$key] ?? $default);
    $tracks = \App\Models\VolunteerTrack::ordered()->get();
    $volunteerImage = $sv('volunteer_image');
@endphp

<div class="space-y-8" x-data="{ tab: '{{ request('tab', 'header') }}' }">
    {{-- Tab Navigation --}}
    <div class="border-b border-gray-200">
        <nav class="flex space-x-8 overflow-x-auto">
            <button @click="tab = 'header'"
                    :class="tab === 'header' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Header &amp; Intro
            </button>
            <button @click="tab = 'tracks'"
                    :class="tab === 'tracks' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Volunteer Tracks
            </button>
        </nav>
    </div>

    {{-- ═══════════════════════════════════════════ --}}
    {{-- HEADER & INTRO TAB --}}
    {{-- ═══════════════════════════════════════════ --}}
    <div x-show="tab === 'header'" x-cloak class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6" x-data="bilingualForm()">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-700 text-sm">Section Header</h3>
                <div class="lang-tabs" title="Toggle editing language">
                    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                </div>
            </div>

            <form action="{{ route('admin.volunteer-section.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div x-show="lang === 'en'">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Badge Label</label>
                    <input type="text" name="volunteer_badge" value="{{ $sv('volunteer_badge', 'Give Your Time') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Badge Label (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <input type="text" name="volunteer_badge_fr" value="{{ $sv('volunteer_badge_fr') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>

                <div x-show="lang === 'en'">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Title</label>
                    <input type="text" name="volunteer_title" value="{{ $sv('volunteer_title', 'Volunteer With Us') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Title (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <input type="text" name="volunteer_title_fr" value="{{ $sv('volunteer_title_fr') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>

                <div x-show="lang === 'en'">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Intro Paragraph</label>
                    <x-admin.rich-text name="volunteer_intro" :value="$sv('volunteer_intro', 'Volunteering with Krousar Thmey is an opportunity to contribute meaningfully, transfer crucial know-how, or raise resources that directly impact the lives of children in Cambodia. We offer two distinct tracks based on your location and expertise.')" lang="en" :rows="3" />
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Intro Paragraph (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <x-admin.rich-text name="volunteer_intro_fr" :value="$sv('volunteer_intro_fr')" lang="fr" :rows="3" />
                </div>

                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Photo</label>
                    @if($volunteerImage)
                    <div class="flex items-center gap-3 mb-2">
                        <img src="{{ str_starts_with($volunteerImage, 'http') ? $volunteerImage : asset('storage/' . $volunteerImage) }}" class="w-32 h-20 object-cover rounded-lg border border-gray-200">
                        <label class="flex items-center gap-1.5 text-xs text-gray-500">
                            <input type="checkbox" name="volunteer_image_clear" value="1" class="rounded border-gray-300">
                            Remove
                        </label>
                    </div>
                    @endif
                    <input type="file" name="volunteer_image" accept="image/png,image/jpg,image/jpeg,image/webp"
                           class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    <div class="flex items-center gap-2 my-1.5">
                        <div class="flex-1 h-px bg-gray-200"></div>
                        <span class="text-xs text-gray-400">OR</span>
                        <div class="flex-1 h-px bg-gray-200"></div>
                    </div>
                    <input type="url" name="volunteer_image_url" placeholder="https://example.com/image.jpg"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div x-show="lang === 'en'">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Photo Caption Title</label>
                        <input type="text" name="volunteer_image_caption_title" value="{{ $sv('volunteer_image_caption_title', 'Hands-on Impact') }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div x-show="lang === 'fr'" x-cloak>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Photo Caption Title (French)</label>
                        <input type="text" name="volunteer_image_caption_title_fr" value="{{ $sv('volunteer_image_caption_title_fr') }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div x-show="lang === 'en'">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Photo Caption Subtitle</label>
                        <input type="text" name="volunteer_image_caption_subtitle" value="{{ $sv('volunteer_image_caption_subtitle', 'Work directly with children') }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div x-show="lang === 'fr'" x-cloak>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Photo Caption Subtitle (French)</label>
                        <input type="text" name="volunteer_image_caption_subtitle_fr" value="{{ $sv('volunteer_image_caption_subtitle_fr') }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>

                <button type="submit" class="btn-primary text-sm py-2.5">Save Header</button>
            </form>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════ --}}
    {{-- VOLUNTEER TRACKS TAB --}}
    {{-- ═══════════════════════════════════════════ --}}
    <div x-show="tab === 'tracks'" x-cloak class="space-y-6"
         x-data="{
             showModal: false,
             editMode: false,
             lang: 'en',
             actionUrl: '{{ route('admin.volunteer-tracks.store') }}',
             itemId: '',
             title: '',
             titleFr: '',
             subtitle: '',
             subtitleFr: '',
             description: '',
             descriptionFr: '',
             extraHeading: '',
             extraHeadingFr: '',
             extraContent: '',
             extraContentFr: '',
             footerLabel: '',
             footerLabelFr: '',
             ctaType: 'url',
             ctaValue: '',
             ctaButtonText: '',
             ctaButtonTextFr: '',
             accentColor: '#2d6fa3',
             accentColorSecondary: '#8da83a',
             iconBackgroundColor: '#dbeafe',
             buttonColor: '#2d6fa3',
             buttonTextColor: '#ffffff',
             sortOrder: 0,
             isActive: true,
             openAddModal() {
                 this.editMode = false;
                 this.lang = 'en';
                 this.actionUrl = '{{ route('admin.volunteer-tracks.store') }}';
                 this.itemId = '';
                 this.title = '';
                 this.titleFr = '';
                 this.subtitle = '';
                 this.subtitleFr = '';
                 this.description = '';
                 this.descriptionFr = '';
                 this.extraHeading = '';
                 this.extraHeadingFr = '';
                 this.extraContent = '';
                 this.extraContentFr = '';
                 this.footerLabel = '';
                 this.footerLabelFr = '';
                 this.ctaType = 'url';
                 this.ctaValue = '';
                 this.ctaButtonText = '';
                 this.ctaButtonTextFr = '';
                 this.accentColor = '#2d6fa3';
                 this.accentColorSecondary = '#8da83a';
                 this.iconBackgroundColor = '#dbeafe';
                 this.buttonColor = '#2d6fa3';
                 this.buttonTextColor = '#ffffff';
                 this.sortOrder = 0;
                 this.isActive = true;
                 this.showModal = true;
                 this.$nextTick(() => this.syncCKEditors());
             },
             openEditModal(item) {
                 this.editMode = true;
                 this.lang = 'en';
                 this.actionUrl = `/admin/volunteer-tracks/${item.id}`;
                 this.itemId = item.id;
                 this.title = item.title || '';
                 this.titleFr = item.title_fr || '';
                 this.subtitle = item.subtitle || '';
                 this.subtitleFr = item.subtitle_fr || '';
                 this.description = item.description || '';
                 this.descriptionFr = item.description_fr || '';
                 this.extraHeading = item.extra_heading || '';
                 this.extraHeadingFr = item.extra_heading_fr || '';
                 this.extraContent = item.extra_content || '';
                 this.extraContentFr = item.extra_content_fr || '';
                 this.footerLabel = item.footer_label || '';
                 this.footerLabelFr = item.footer_label_fr || '';
                 this.ctaType = item.cta_type || 'url';
                 this.ctaValue = item.cta_value || '';
                 this.ctaButtonText = item.cta_button_text || '';
                 this.ctaButtonTextFr = item.cta_button_text_fr || '';
                 this.accentColor = item.accent_color || item.fallback_accent_color || '#2d6fa3';
                 this.accentColorSecondary = item.accent_color_secondary || item.fallback_accent_color_secondary || '#8da83a';
                 this.iconBackgroundColor = item.icon_background_color || item.fallback_icon_background_color || '#dbeafe';
                 this.buttonColor = item.button_color || item.fallback_accent_color || '#2d6fa3';
                 this.buttonTextColor = item.button_text_color || '#ffffff';
                 this.sortOrder = item.sort_order;
                 this.isActive = !!item.is_active;
                 this.showModal = true;
                 this.$nextTick(() => this.syncCKEditors());
             },
             syncCKEditors() {
                 window.setCKEditorContent?.(document.getElementById('track-description'), this.description);
                 window.setCKEditorContent?.(document.getElementById('track-description-fr'), this.descriptionFr);
                 window.setCKEditorContent?.(document.getElementById('track-extra-content'), this.extraContent);
                 window.setCKEditorContent?.(document.getElementById('track-extra-content-fr'), this.extraContentFr);
             }
         }">
        @php
            $trackPalette = [
                ['accent' => '#2d6fa3', 'secondary' => '#8da83a', 'icon_bg' => '#dbeafe'],
                ['accent' => '#e8a020', 'secondary' => '#f8bb86', 'icon_bg' => '#fef3c7'],
                ['accent' => '#d32f2f', 'secondary' => '#8da83a', 'icon_bg' => '#fee2e2'],
            ];
        @endphp
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-bold text-gray-700 text-sm">Volunteer Tracks</h3>
                    <p class="text-xs text-gray-400 mt-0.5">The side-by-side track cards shown under "Volunteer With Us".</p>
                </div>
                <button @click="openAddModal()"
                        class="inline-flex items-center gap-1.5 text-xs font-medium text-white bg-[#2d6fa3] hover:bg-[#1d4e7a] px-3.5 py-2 rounded-lg transition-all duration-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Track
                </button>
            </div>

            @if($tracks->isEmpty())
            <div class="bg-gray-50 rounded-xl py-12 text-center text-gray-400">
                <p class="text-sm font-medium mb-2">No volunteer tracks configured yet.</p>
                <button @click="openAddModal()" class="text-[#2d6fa3] text-sm underline hover:text-[#1d4e7a]">Add your first track</button>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                @foreach($tracks as $index => $item)
                @php
                    $palette = $trackPalette[$index % count($trackPalette)];
                    $itemForModal = array_merge($item->toArray(), [
                        'fallback_accent_color' => $palette['accent'],
                        'fallback_accent_color_secondary' => $palette['secondary'],
                        'fallback_icon_background_color' => $palette['icon_bg'],
                    ]);
                    $ctaLabel = match ($item->cta_type) {
                        'email' => 'Email: ' . $item->cta_value,
                        'modal' => 'Opens application modal',
                        default => 'Link: ' . $item->cta_value,
                    };
                @endphp
                <div class="relative rounded-2xl border border-gray-100 overflow-hidden group cursor-pointer hover:shadow-md transition-all duration-200 bg-white"
                     @click="openEditModal({{ json_encode($itemForModal) }})">
                    <div class="h-1.5 w-full" style="background: linear-gradient(to right, {{ $item->accent_color ?: $palette['accent'] }}, {{ $item->accent_color_secondary ?: $palette['secondary'] }});"></div>
                    <div class="p-5">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-bold text-[#1d4e7a] text-sm">{{ $item->title }}</h4>
                            @unless($item->is_active)
                            <span class="text-[9px] font-bold text-gray-400 bg-gray-50 border border-gray-100 px-2 py-0.5 rounded-full uppercase tracking-wider">Inactive</span>
                            @endunless
                        </div>
                        <p class="text-gray-400 text-xs uppercase tracking-wide font-bold mb-3">{{ $item->subtitle }}</p>
                        <p class="text-gray-500 text-xs leading-relaxed line-clamp-2 mb-3">{{ Str::limit(strip_tags($item->description ?? ''), 100) }}</p>
                        <p class="text-[10px] text-gray-400 mb-1">CTA: {{ $ctaLabel }}</p>
                        <span class="text-[10px] font-bold text-gray-400">Order: {{ $item->sort_order }}</span>
                    </div>
                    <div class="absolute top-3 right-3 flex gap-1 items-center opacity-0 group-hover:opacity-100 transition-all duration-200">
                        <form action="{{ route('admin.volunteer-tracks.destroy', $item) }}" method="POST" @click.stop onsubmit="return confirm('Delete this volunteer track?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-7 h-7 rounded-full flex items-center justify-center bg-white/80 hover:bg-red-50 hover:text-red-600 text-gray-400 shadow-sm">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>

        {{-- Add/Edit Modal --}}
        <template x-teleport="body">
            <div x-show="showModal" x-cloak @keydown.escape.window="showModal = false"
                 class="fixed inset-0 z-[9999] flex items-start justify-center p-4 pt-10 sm:pt-16 sm:p-6 overflow-y-auto"
                 style="background: rgba(0,0,0,0.5); backdrop-filter: blur(6px);">
                <div @click="showModal = false" class="absolute inset-0 z-0"></div>
                <div class="relative z-10 w-full max-w-2xl bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden max-h-[90vh] overflow-y-auto">
                    <div class="h-1.5 w-full bg-gradient-to-r from-[#2d6fa3] via-[#8da83a] to-[#2d6fa3]"></div>
                    <div class="flex items-center justify-between px-6 pt-6 pb-4 border-b border-gray-50">
                        <h3 class="font-bold text-gray-800 text-sm" x-text="editMode ? 'Edit Track' : 'Add Track'">Add Track</h3>
                        <button @click="showModal = false" class="w-7 h-7 rounded-full flex items-center justify-center bg-gray-100 hover:bg-gray-200">
                            <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>
                    <div class="p-6">
                        <form x-bind:action="actionUrl" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="_method" value="PUT" x-bind:disabled="!editMode">

                            <div class="flex justify-end w-full mb-1">
                                <div class="lang-tabs">
                                    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click.prevent="lang = 'en'">EN</button>
                                    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click.prevent="lang = 'fr'">FR</button>
                                </div>
                            </div>

                            <div x-show="lang === 'en'">
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Title <span class="text-red-400">*</span></label>
                                <input type="text" name="title" x-model="title" required
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                       placeholder="e.g. Volunteering in Cambodia">
                            </div>
                            <div x-show="lang === 'fr'" x-cloak>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Title (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                                <input type="text" name="title_fr" x-model="titleFr"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>

                            <div x-show="lang === 'en'">
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Subtitle / Tag</label>
                                <input type="text" name="subtitle" x-model="subtitle"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                       placeholder="e.g. Locational Track">
                            </div>
                            <div x-show="lang === 'fr'" x-cloak>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Subtitle / Tag (French)</label>
                                <input type="text" name="subtitle_fr" x-model="subtitleFr"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>

                            <div x-show="lang === 'en'">
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Description</label>
                                <x-admin.rich-text id="track-description" name="description" :value="''" lang="en" :rows="3" @input="description = $event.target.value" />
                            </div>
                            <div x-show="lang === 'fr'" x-cloak>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Description (French)</label>
                                <x-admin.rich-text id="track-description-fr" name="description_fr" :value="''" lang="fr" :rows="3" @input="descriptionFr = $event.target.value" />
                            </div>

                            <div x-show="lang === 'en'">
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Extra Section Heading <span class="text-gray-400 font-normal">(e.g. "Requirements & Process:")</span></label>
                                <input type="text" name="extra_heading" x-model="extraHeading"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>
                            <div x-show="lang === 'fr'" x-cloak>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Extra Section Heading (French)</label>
                                <input type="text" name="extra_heading_fr" x-model="extraHeadingFr"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>

                            <div x-show="lang === 'en'">
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Extra Section Content <span class="text-gray-400 font-normal">(a bullet list works well here)</span></label>
                                <x-admin.rich-text id="track-extra-content" name="extra_content" :value="''" lang="en" :rows="3" @input="extraContent = $event.target.value" />
                            </div>
                            <div x-show="lang === 'fr'" x-cloak>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Extra Section Content (French)</label>
                                <x-admin.rich-text id="track-extra-content-fr" name="extra_content_fr" :value="''" lang="fr" :rows="3" @input="extraContentFr = $event.target.value" />
                            </div>

                            <div x-show="lang === 'en'">
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Footer Label <span class="text-gray-400 font-normal">(text next to the button)</span></label>
                                <input type="text" name="footer_label" x-model="footerLabel"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                       placeholder="e.g. To submit a volunteering project:">
                            </div>
                            <div x-show="lang === 'fr'" x-cloak>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Footer Label (French)</label>
                                <input type="text" name="footer_label_fr" x-model="footerLabelFr"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>

                            <div class="border-t border-gray-100 pt-4">
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Button Action</label>
                                <select name="cta_type" x-model="ctaType" class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                                    <option value="email">Email address (mailto: link)</option>
                                    <option value="modal">Open the "Apply to Volunteer" form</option>
                                    <option value="url">Custom URL</option>
                                </select>
                            </div>

                            <div x-show="ctaType === 'email'">
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Email Address</label>
                                <input type="text" name="cta_value" x-model="ctaValue" :required="ctaType === 'email'"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                       placeholder="communication@krousar-thmey.org">
                            </div>
                            <div x-show="ctaType === 'url'" x-cloak>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">URL</label>
                                <input type="text" name="cta_value" x-model="ctaValue" :required="ctaType === 'url'"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                       placeholder="https://example.com/volunteer">
                            </div>
                            <template x-if="ctaType === 'modal'">
                                <input type="hidden" name="cta_value" value="">
                            </template>

                            <div x-show="lang === 'en'">
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Button Text <span class="text-gray-400 font-normal">(leave blank to show the email/URL itself)</span></label>
                                <input type="text" name="cta_button_text" x-model="ctaButtonText"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                       placeholder="e.g. Apply to Volunteer">
                            </div>
                            <div x-show="lang === 'fr'" x-cloak>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Button Text (French)</label>
                                <input type="text" name="cta_button_text_fr" x-model="ctaButtonTextFr"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-2">Button Colors</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <label class="text-[11px] text-gray-500 space-y-1">
                                        <span>Button Background</span>
                                        <input type="color" name="button_color" x-model="buttonColor" class="h-10 w-full rounded-lg border border-gray-200 bg-white p-1 cursor-pointer">
                                    </label>
                                    <label class="text-[11px] text-gray-500 space-y-1">
                                        <span>Button Text</span>
                                        <input type="color" name="button_text_color" x-model="buttonTextColor" class="h-10 w-full rounded-lg border border-gray-200 bg-white p-1 cursor-pointer">
                                    </label>
                                </div>
                                <p class="text-[11px] text-gray-400 mt-1.5">Applies to this card's button no matter which action it's set to above (email, application form, or custom URL).</p>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-2">Card Colors</label>
                                <div class="grid grid-cols-3 gap-3">
                                    <label class="text-[11px] text-gray-500 space-y-1">
                                        <span>Top Border Start</span>
                                        <input type="color" name="accent_color" x-model="accentColor" class="h-10 w-full rounded-lg border border-gray-200 bg-white p-1 cursor-pointer">
                                    </label>
                                    <label class="text-[11px] text-gray-500 space-y-1">
                                        <span>Top Border End</span>
                                        <input type="color" name="accent_color_secondary" x-model="accentColorSecondary" class="h-10 w-full rounded-lg border border-gray-200 bg-white p-1 cursor-pointer">
                                    </label>
                                    <label class="text-[11px] text-gray-500 space-y-1">
                                        <span>Icon Background</span>
                                        <input type="color" name="icon_background_color" x-model="iconBackgroundColor" class="h-10 w-full rounded-lg border border-gray-200 bg-white p-1 cursor-pointer">
                                    </label>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1.5">Sort Order</label>
                                    <input type="number" name="sort_order" x-model="sortOrder"
                                           class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                                </div>
                                <div class="flex items-end pb-1">
                                    <label class="flex items-center gap-2 text-xs text-gray-600 cursor-pointer select-none">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" value="1" x-model="isActive"
                                               class="rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]/20 cursor-pointer">
                                        Active
                                    </label>
                                </div>
                            </div>

                            <div class="flex gap-3 pt-2">
                                <button type="submit" class="flex-1 btn-primary text-sm py-2.5">
                                    <span x-text="editMode ? 'Save Changes' : 'Add Track'">Add Track</span>
                                </button>
                                <button type="button" @click="showModal = false" class="px-5 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-xl">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>

@endsection
