@extends('admin.layouts.app')

@section('title', 'Become a Partner')
@section('page-title', 'Become a Partner')
@section('breadcrumb', 'Get Involved → Become a Partner')

@section('content')

@php
    $sv = fn ($key, $default = '') => old($key, $settings[$key] ?? $default);

    $cardPalette = [
        ['accent' => '#2d6fa3', 'card_bg' => '#eff6ff', 'icon_bg' => '#dbeafe'],
        ['accent' => '#8da83a', 'card_bg' => '#ecfdf5', 'icon_bg' => '#d1fae5'],
        ['accent' => '#e8a020', 'card_bg' => '#fffbeb', 'icon_bg' => '#fef3c7'],
        ['accent' => '#d32f2f', 'card_bg' => '#fef2f2', 'icon_bg' => '#fee2e2'],
    ];

    $principles = \App\Models\PartnerPrinciple::ordered()->get();
    $emphases = \App\Models\PartnershipEmphasis::ordered()->get();
    $categories = \App\Models\PartnershipCategory::ordered()->get();
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
            <button @click="tab = 'principles'"
                    :class="tab === 'principles' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Partnership Principles
            </button>
            <button @click="tab = 'emphasis'"
                    :class="tab === 'emphasis' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Dynamic Emphasis
            </button>
            <button @click="tab = 'categories'"
                    :class="tab === 'categories' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                Who Can Partner
            </button>
            <button @click="tab = 'cta'"
                    :class="tab === 'cta' ? 'border-[#2d6fa3] text-[#2d6fa3]' : 'border-transparent text-gray-500'"
                    class="py-4 px-1 border-b-2 font-medium text-sm whitespace-nowrap">
                CTA Block
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

            <form action="{{ route('admin.partner-page.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div x-show="lang === 'en'">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Badge Label</label>
                    <input type="text" name="partner_badge" value="{{ $sv('partner_badge', 'Institutional Support') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Badge Label (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <input type="text" name="partner_badge_fr" value="{{ $sv('partner_badge_fr') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>

                <div x-show="lang === 'en'">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Title</label>
                    <input type="text" name="partner_title" value="{{ $sv('partner_title', 'Become a Partner') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Title (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <input type="text" name="partner_title_fr" value="{{ $sv('partner_title_fr') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>

                <div x-show="lang === 'en'">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Intro Paragraph</label>
                    <x-admin.rich-text name="partner_intro" :value="$sv('partner_intro', 'The partnership is based on a <strong>co-construction dynamic</strong> built on shared values and mutual respect.')" lang="en" :rows="3" />
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Intro Paragraph (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <x-admin.rich-text name="partner_intro_fr" :value="$sv('partner_intro_fr')" lang="fr" :rows="3" />
                </div>

                <div x-show="lang === 'en'">
                    <label class="block text-xs font-medium text-gray-600 mb-1">"Who Can Partner" Intro Text</label>
                    <x-admin.rich-text name="partner_who_intro" :value="$sv('partner_who_intro', 'Krousar Thmey may work in partnership with a variety of public, private and civil society actors and at different administrative levels: village, district, province, region, country. The following list, although not exhaustive, gives an overview of the type of organizations Krousar Thmey can work with.')" lang="en" :rows="3" />
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <label class="block text-xs font-medium text-gray-600 mb-1">"Who Can Partner" Intro Text (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <x-admin.rich-text name="partner_who_intro_fr" :value="$sv('partner_who_intro_fr')" lang="fr" :rows="3" />
                </div>

                <button type="submit" class="btn-primary text-sm py-2.5">Save Header</button>
            </form>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════ --}}
    {{-- PARTNERSHIP PRINCIPLES TAB --}}
    {{-- ═══════════════════════════════════════════ --}}
    <div x-show="tab === 'principles'" x-cloak class="space-y-6"
         x-data="{
             showModal: false,
             editMode: false,
             lang: 'en',
             actionUrl: '{{ route('admin.partner-principles.store') }}',
             itemId: '',
             content: '',
             contentFr: '',
             accentColor: '#2d6fa3',
             cardBackgroundColor: '#eff6ff',
             iconBackgroundColor: '#dbeafe',
             sortOrder: 0,
             openAddModal() {
                 this.editMode = false;
                 this.lang = 'en';
                 this.actionUrl = '{{ route('admin.partner-principles.store') }}';
                 this.itemId = '';
                 this.content = '';
                 this.contentFr = '';
                 this.accentColor = '#2d6fa3';
                 this.cardBackgroundColor = '#eff6ff';
                 this.iconBackgroundColor = '#dbeafe';
                 this.sortOrder = 0;
                 this.showModal = true;
             },
             openEditModal(item) {
                 this.editMode = true;
                 this.lang = 'en';
                 this.actionUrl = `/admin/partner-principles/${item.id}`;
                 this.itemId = item.id;
                 this.content = item.content || '';
                 this.contentFr = item.content_fr || '';
                 this.accentColor = item.accent_color || item.fallback_accent_color || '#2d6fa3';
                 this.cardBackgroundColor = item.card_background_color || item.fallback_card_background_color || '#eff6ff';
                 this.iconBackgroundColor = item.icon_background_color || item.fallback_icon_background_color || '#dbeafe';
                 this.sortOrder = item.sort_order;
                 this.showModal = true;
             }
         }">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-bold text-gray-700 text-sm">Partnership Principles</h3>
                    <p class="text-xs text-gray-400 mt-0.5">The 4 icon cards shown under "Our Partnership Principles".</p>
                </div>
                <button @click="openAddModal()"
                        class="inline-flex items-center gap-1.5 text-xs font-medium text-white bg-[#2d6fa3] hover:bg-[#1d4e7a] px-3.5 py-2 rounded-lg transition-all duration-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Principle
                </button>
            </div>

            @if($principles->isEmpty())
            <div class="bg-gray-50 rounded-xl py-12 text-center text-gray-400">
                <p class="text-sm font-medium mb-2">No principles configured yet.</p>
                <button @click="openAddModal()" class="text-[#2d6fa3] text-sm underline hover:text-[#1d4e7a]">Add your first principle</button>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                @foreach($principles as $index => $item)
                @php
                    $palette = $cardPalette[$index % count($cardPalette)];
                    $itemForModal = array_merge($item->toArray(), [
                        'fallback_accent_color' => $palette['accent'],
                        'fallback_card_background_color' => $palette['card_bg'],
                        'fallback_icon_background_color' => $palette['icon_bg'],
                    ]);
                @endphp
                <div class="relative rounded-2xl border-2 border-gray-100 overflow-hidden group cursor-pointer hover:shadow-md transition-all duration-200"
                     style="background-color: {{ $item->card_background_color ?: $palette['card_bg'] }};"
                     @click="openEditModal({{ json_encode($itemForModal) }})">
                    <div class="p-5 flex items-start gap-4">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0" style="background-color: {{ $item->icon_background_color ?: $palette['icon_bg'] }};">
                            <span class="w-3 h-3 rounded-full" style="background-color: {{ $item->accent_color ?: $palette['accent'] }};"></span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-[#1d4e7a] text-sm mb-1">{{ $item->content }}</h4>
                            <span class="text-[10px] font-bold text-gray-400">Order: {{ $item->sort_order }}</span>
                        </div>
                    </div>
                    <div class="absolute top-3 right-3 flex gap-1 items-center opacity-0 group-hover:opacity-100 transition-all duration-200">
                        <form action="{{ route('admin.partner-principles.destroy', $item) }}" method="POST" @click.stop onsubmit="return confirm('Delete this principle?')">
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
                <div class="relative z-10 w-full max-w-lg bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden max-h-[90vh] overflow-y-auto">
                    <div class="h-1.5 w-full bg-gradient-to-r from-[#2d6fa3] via-[#8da83a] to-[#2d6fa3]"></div>
                    <div class="flex items-center justify-between px-6 pt-6 pb-4 border-b border-gray-50">
                        <h3 class="font-bold text-gray-800 text-sm" x-text="editMode ? 'Edit Principle' : 'Add Principle'">Add Principle</h3>
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
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Content <span class="text-red-400">*</span></label>
                                <input type="text" name="content" x-model="content" required
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                       placeholder="e.g. Trust and respect">
                            </div>
                            <div x-show="lang === 'fr'" x-cloak>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Content (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                                <input type="text" name="content_fr" x-model="contentFr"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-2">Card Colors</label>
                                <div class="grid grid-cols-3 gap-3">
                                    <label class="text-[11px] text-gray-500 space-y-1">
                                        <span>Ruler / Icon</span>
                                        <input type="color" name="accent_color" x-model="accentColor" class="h-10 w-full rounded-lg border border-gray-200 bg-white p-1 cursor-pointer">
                                    </label>
                                    <label class="text-[11px] text-gray-500 space-y-1">
                                        <span>Card Background</span>
                                        <input type="color" name="card_background_color" x-model="cardBackgroundColor" class="h-10 w-full rounded-lg border border-gray-200 bg-white p-1 cursor-pointer">
                                    </label>
                                    <label class="text-[11px] text-gray-500 space-y-1">
                                        <span>Icon Background</span>
                                        <input type="color" name="icon_background_color" x-model="iconBackgroundColor" class="h-10 w-full rounded-lg border border-gray-200 bg-white p-1 cursor-pointer">
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Sort Order</label>
                                <input type="number" name="sort_order" x-model="sortOrder"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>

                            <div class="flex gap-3 pt-2">
                                <button type="submit" class="flex-1 btn-primary text-sm py-2.5">
                                    <span x-text="editMode ? 'Save Changes' : 'Add Principle'">Add Principle</span>
                                </button>
                                <button type="button" @click="showModal = false" class="px-5 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-xl">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>

    {{-- ═══════════════════════════════════════════ --}}
    {{-- DYNAMIC EMPHASIS TAB --}}
    {{-- ═══════════════════════════════════════════ --}}
    <div x-show="tab === 'emphasis'" x-cloak class="space-y-6"
         x-data="{
             showModal: false,
             editMode: false,
             lang: 'en',
             actionUrl: '{{ route('admin.partnership-emphases.store') }}',
             itemId: '',
             title: '',
             titleFr: '',
             description: '',
             descriptionFr: '',
             accentColor: '#2d6fa3',
             cardBackgroundColor: '#eff6ff',
             iconBackgroundColor: '#dbeafe',
             sortOrder: 0,
             openAddModal() {
                 this.editMode = false;
                 this.lang = 'en';
                 this.actionUrl = '{{ route('admin.partnership-emphases.store') }}';
                 this.itemId = '';
                 this.title = '';
                 this.titleFr = '';
                 this.description = '';
                 this.descriptionFr = '';
                 this.accentColor = '#2d6fa3';
                 this.cardBackgroundColor = '#eff6ff';
                 this.iconBackgroundColor = '#dbeafe';
                 this.sortOrder = 0;
                 this.showModal = true;
                 this.$nextTick(() => this.syncCKEditors());
             },
             openEditModal(item) {
                 this.editMode = true;
                 this.lang = 'en';
                 this.actionUrl = `/admin/partnership-emphases/${item.id}`;
                 this.itemId = item.id;
                 this.title = item.title || '';
                 this.titleFr = item.title_fr || '';
                 this.description = item.description || '';
                 this.descriptionFr = item.description_fr || '';
                 this.accentColor = item.accent_color || item.fallback_accent_color || '#2d6fa3';
                 this.cardBackgroundColor = item.card_background_color || item.fallback_card_background_color || '#eff6ff';
                 this.iconBackgroundColor = item.icon_background_color || item.fallback_icon_background_color || '#dbeafe';
                 this.sortOrder = item.sort_order;
                 this.showModal = true;
                 this.$nextTick(() => this.syncCKEditors());
             },
             syncCKEditors() {
                 window.setCKEditorContent?.(document.getElementById('emphasis-description'), this.description);
                 window.setCKEditorContent?.(document.getElementById('emphasis-description-fr'), this.descriptionFr);
             }
         }">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-bold text-gray-700 text-sm">This Dynamic Emphasizes</h3>
                    <p class="text-xs text-gray-400 mt-0.5">The 3 cards shown under "This Dynamic Emphasizes".</p>
                </div>
                <button @click="openAddModal()"
                        class="inline-flex items-center gap-1.5 text-xs font-medium text-white bg-[#2d6fa3] hover:bg-[#1d4e7a] px-3.5 py-2 rounded-lg transition-all duration-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Card
                </button>
            </div>

            @if($emphases->isEmpty())
            <div class="bg-gray-50 rounded-xl py-12 text-center text-gray-400">
                <p class="text-sm font-medium mb-2">No cards configured yet.</p>
                <button @click="openAddModal()" class="text-[#2d6fa3] text-sm underline hover:text-[#1d4e7a]">Add your first card</button>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
                @foreach($emphases as $index => $item)
                @php
                    $palette = $cardPalette[$index % count($cardPalette)];
                    $itemForModal = array_merge($item->toArray(), [
                        'fallback_accent_color' => $palette['accent'],
                        'fallback_card_background_color' => $palette['card_bg'],
                        'fallback_icon_background_color' => $palette['icon_bg'],
                    ]);
                @endphp
                <div class="relative rounded-2xl border border-gray-100 overflow-hidden group cursor-pointer hover:shadow-md transition-all duration-200"
                     style="background-color: {{ $item->card_background_color ?: $palette['card_bg'] }};"
                     @click="openEditModal({{ json_encode($itemForModal) }})">
                    <div class="p-5">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mb-4" style="background-color: {{ $item->icon_background_color ?: $palette['icon_bg'] }};">
                            <span class="w-3 h-3 rounded-full" style="background-color: {{ $item->accent_color ?: $palette['accent'] }};"></span>
                        </div>
                        <h4 class="font-bold text-[#1d4e7a] text-sm mb-2">{{ $item->title }}</h4>
                        <p class="text-gray-500 text-xs leading-relaxed line-clamp-2">{{ Str::limit(strip_tags($item->description ?? ''), 90) }}</p>
                        <span class="text-[10px] font-bold text-gray-400 mt-3 inline-block">Order: {{ $item->sort_order }}</span>
                    </div>
                    <div class="absolute top-3 right-3 flex gap-1 items-center opacity-0 group-hover:opacity-100 transition-all duration-200">
                        <form action="{{ route('admin.partnership-emphases.destroy', $item) }}" method="POST" @click.stop onsubmit="return confirm('Delete this card?')">
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
                        <h3 class="font-bold text-gray-800 text-sm" x-text="editMode ? 'Edit Card' : 'Add Card'">Add Card</h3>
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
                                       placeholder="e.g. A close relationship">
                            </div>
                            <div x-show="lang === 'fr'" x-cloak>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Title (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                                <input type="text" name="title_fr" x-model="titleFr"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>

                            <div x-show="lang === 'en'">
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Description</label>
                                <x-admin.rich-text id="emphasis-description" name="description" :value="''" lang="en" :rows="2" @input="description = $event.target.value" />
                            </div>
                            <div x-show="lang === 'fr'" x-cloak>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Description (French)</label>
                                <x-admin.rich-text id="emphasis-description-fr" name="description_fr" :value="''" lang="fr" :rows="2" @input="descriptionFr = $event.target.value" />
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-2">Card Colors</label>
                                <div class="grid grid-cols-3 gap-3">
                                    <label class="text-[11px] text-gray-500 space-y-1">
                                        <span>Ruler / Icon</span>
                                        <input type="color" name="accent_color" x-model="accentColor" class="h-10 w-full rounded-lg border border-gray-200 bg-white p-1 cursor-pointer">
                                    </label>
                                    <label class="text-[11px] text-gray-500 space-y-1">
                                        <span>Card Background</span>
                                        <input type="color" name="card_background_color" x-model="cardBackgroundColor" class="h-10 w-full rounded-lg border border-gray-200 bg-white p-1 cursor-pointer">
                                    </label>
                                    <label class="text-[11px] text-gray-500 space-y-1">
                                        <span>Icon Background</span>
                                        <input type="color" name="icon_background_color" x-model="iconBackgroundColor" class="h-10 w-full rounded-lg border border-gray-200 bg-white p-1 cursor-pointer">
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Sort Order</label>
                                <input type="number" name="sort_order" x-model="sortOrder"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>

                            <div class="flex gap-3 pt-2">
                                <button type="submit" class="flex-1 btn-primary text-sm py-2.5">
                                    <span x-text="editMode ? 'Save Changes' : 'Add Card'">Add Card</span>
                                </button>
                                <button type="button" @click="showModal = false" class="px-5 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-xl">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>

    {{-- ═══════════════════════════════════════════ --}}
    {{-- WHO CAN PARTNER (CATEGORIES) TAB --}}
    {{-- ═══════════════════════════════════════════ --}}
    <div x-show="tab === 'categories'" x-cloak class="space-y-6"
         x-data="{
             showModal: false,
             editMode: false,
             lang: 'en',
             actionUrl: '{{ route('admin.partnership-categories.store') }}',
             itemId: '',
             name: '',
             nameFr: '',
             description: '',
             descriptionFr: '',
             accentColor: '#2d6fa3',
             cardBackgroundColor: '#eff6ff',
             iconBackgroundColor: '#dbeafe',
             sortOrder: 0,
             openAddModal() {
                 this.editMode = false;
                 this.lang = 'en';
                 this.actionUrl = '{{ route('admin.partnership-categories.store') }}';
                 this.itemId = '';
                 this.name = '';
                 this.nameFr = '';
                 this.description = '';
                 this.descriptionFr = '';
                 this.accentColor = '#2d6fa3';
                 this.cardBackgroundColor = '#eff6ff';
                 this.iconBackgroundColor = '#dbeafe';
                 this.sortOrder = 0;
                 this.showModal = true;
                 this.$nextTick(() => this.syncCKEditors());
             },
             openEditModal(item) {
                 this.editMode = true;
                 this.lang = 'en';
                 this.actionUrl = `/admin/partnership-categories/${item.id}`;
                 this.itemId = item.id;
                 this.name = item.name || '';
                 this.nameFr = item.name_fr || '';
                 this.description = item.description || '';
                 this.descriptionFr = item.description_fr || '';
                 this.accentColor = item.accent_color || item.fallback_accent_color || '#2d6fa3';
                 this.cardBackgroundColor = item.card_background_color || item.fallback_card_background_color || '#eff6ff';
                 this.iconBackgroundColor = item.icon_background_color || item.fallback_icon_background_color || '#dbeafe';
                 this.sortOrder = item.sort_order;
                 this.showModal = true;
                 this.$nextTick(() => this.syncCKEditors());
             },
             syncCKEditors() {
                 window.setCKEditorContent?.(document.getElementById('category-description'), this.description);
                 window.setCKEditorContent?.(document.getElementById('category-description-fr'), this.descriptionFr);
             }
         }">
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-bold text-gray-700 text-sm">Who Can Partner — Categories</h3>
                    <p class="text-xs text-gray-400 mt-0.5">The partner-type cards shown under "Who Can Partner".</p>
                </div>
                <button @click="openAddModal()"
                        class="inline-flex items-center gap-1.5 text-xs font-medium text-white bg-[#2d6fa3] hover:bg-[#1d4e7a] px-3.5 py-2 rounded-lg transition-all duration-200">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Category
                </button>
            </div>

            @if($categories->isEmpty())
            <div class="bg-gray-50 rounded-xl py-12 text-center text-gray-400">
                <p class="text-sm font-medium mb-2">No categories configured yet.</p>
                <button @click="openAddModal()" class="text-[#2d6fa3] text-sm underline hover:text-[#1d4e7a]">Add your first category</button>
            </div>
            @else
            <div class="space-y-3">
                @foreach($categories as $index => $item)
                @php
                    $palette = $cardPalette[$index % count($cardPalette)];
                    $itemForModal = array_merge($item->toArray(), [
                        'fallback_accent_color' => $palette['accent'],
                        'fallback_card_background_color' => $palette['card_bg'],
                        'fallback_icon_background_color' => $palette['icon_bg'],
                    ]);
                @endphp
                <div class="relative bg-gray-50 rounded-xl border-l-4 overflow-hidden group cursor-pointer hover:shadow-md transition-all duration-200 p-4"
                     style="border-color: {{ $item->accent_color ?: $palette['accent'] }};"
                     @click="openEditModal({{ json_encode($itemForModal) }})">
                    <div class="flex items-center justify-between gap-3">
                        <div class="min-w-0">
                            <h4 class="font-bold text-[#1d4e7a] text-sm mb-1 truncate">{{ $item->name }}</h4>
                            @if($item->description)
                            <p class="text-gray-400 text-xs line-clamp-1">{{ Str::limit(strip_tags($item->description), 100) }}</p>
                            @endif
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0 opacity-0 group-hover:opacity-100 transition-all duration-200">
                            <span class="text-[10px] font-bold text-gray-400">Order: {{ $item->sort_order }}</span>
                            <form action="{{ route('admin.partnership-categories.destroy', $item) }}" method="POST" @click.stop onsubmit="return confirm('Delete this category?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-7 h-7 rounded-full flex items-center justify-center bg-white hover:bg-red-50 hover:text-red-600 text-gray-400 shadow-sm">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
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
                        <h3 class="font-bold text-gray-800 text-sm" x-text="editMode ? 'Edit Category' : 'Add Category'">Add Category</h3>
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
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Name <span class="text-red-400">*</span></label>
                                <input type="text" name="name" x-model="name" required
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                       placeholder="e.g. Organizations from associative sector">
                            </div>
                            <div x-show="lang === 'fr'" x-cloak>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Name (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                                <input type="text" name="name_fr" x-model="nameFr"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>

                            <div x-show="lang === 'en'">
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Description</label>
                                <x-admin.rich-text id="category-description" name="description" :value="''" lang="en" :rows="4" @input="description = $event.target.value" />
                            </div>
                            <div x-show="lang === 'fr'" x-cloak>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Description (French)</label>
                                <x-admin.rich-text id="category-description-fr" name="description_fr" :value="''" lang="fr" :rows="4" @input="descriptionFr = $event.target.value" />
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-2">Card Colors</label>
                                <div class="grid grid-cols-3 gap-3">
                                    <label class="text-[11px] text-gray-500 space-y-1">
                                        <span>Left Ruler</span>
                                        <input type="color" name="accent_color" x-model="accentColor" class="h-10 w-full rounded-lg border border-gray-200 bg-white p-1 cursor-pointer">
                                    </label>
                                    <label class="text-[11px] text-gray-500 space-y-1">
                                        <span>Card Background</span>
                                        <input type="color" name="card_background_color" x-model="cardBackgroundColor" class="h-10 w-full rounded-lg border border-gray-200 bg-white p-1 cursor-pointer">
                                    </label>
                                    <label class="text-[11px] text-gray-500 space-y-1">
                                        <span>Icon Background</span>
                                        <input type="color" name="icon_background_color" x-model="iconBackgroundColor" class="h-10 w-full rounded-lg border border-gray-200 bg-white p-1 cursor-pointer">
                                    </label>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1.5">Sort Order</label>
                                <input type="number" name="sort_order" x-model="sortOrder"
                                       class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>

                            <div class="flex gap-3 pt-2">
                                <button type="submit" class="flex-1 btn-primary text-sm py-2.5">
                                    <span x-text="editMode ? 'Save Changes' : 'Add Category'">Add Category</span>
                                </button>
                                <button type="button" @click="showModal = false" class="px-5 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-xl">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </template>
    </div>

    {{-- ═══════════════════════════════════════════ --}}
    {{-- CTA BLOCK TAB --}}
    {{-- ═══════════════════════════════════════════ --}}
    <div x-show="tab === 'cta'" x-cloak class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 p-6" x-data="bilingualForm()">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-bold text-gray-700 text-sm">"Interested in becoming a partner?" CTA</h3>
                <div class="lang-tabs">
                    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                </div>
            </div>

            <form action="{{ route('admin.partner-page.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div x-show="lang === 'en'">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Heading</label>
                    <input type="text" name="partner_cta_heading" value="{{ $sv('partner_cta_heading', 'Interested in becoming a partner?') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Heading (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <input type="text" name="partner_cta_heading_fr" value="{{ $sv('partner_cta_heading_fr') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>

                <div x-show="lang === 'en'">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Subtext</label>
                    <input type="text" name="partner_cta_subtext" value="{{ $sv('partner_cta_subtext', 'Let\'s build together our future cooperation') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Subtext (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <input type="text" name="partner_cta_subtext_fr" value="{{ $sv('partner_cta_subtext_fr') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>

                <div x-show="lang === 'en'">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Button Text</label>
                    <input type="text" name="partner_cta_button_text" value="{{ $sv('partner_cta_button_text', 'Contact us') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div x-show="lang === 'fr'" x-cloak>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Button Text (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <input type="text" name="partner_cta_button_text_fr" value="{{ $sv('partner_cta_button_text_fr') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach(['partner_cta_image_left' => 'Left Image', 'partner_cta_image_right' => 'Right Image'] as $key => $label)
                    @php $current = $sv($key); @endphp
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">{{ $label }}</label>
                        @if($current)
                        <div class="flex items-center gap-3 mb-2">
                            <img src="{{ str_starts_with($current, 'http') ? $current : asset('storage/' . $current) }}" class="w-24 h-16 object-cover rounded-lg border border-gray-200">
                            <label class="flex items-center gap-1.5 text-xs text-gray-500">
                                <input type="checkbox" name="{{ $key }}_clear" value="1" class="rounded border-gray-300">
                                Remove
                            </label>
                        </div>
                        @endif
                        <input type="file" name="{{ $key }}" accept="image/png,image/jpg,image/jpeg,image/webp"
                               class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        <div class="flex items-center gap-2 my-1.5">
                            <div class="flex-1 h-px bg-gray-200"></div>
                            <span class="text-xs text-gray-400">OR</span>
                            <div class="flex-1 h-px bg-gray-200"></div>
                        </div>
                        <input type="url" name="{{ $key }}_url" placeholder="https://example.com/image.jpg"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    @endforeach
                </div>

                <button type="submit" class="btn-primary text-sm py-2.5">Save CTA</button>
            </form>
        </div>
    </div>
</div>

@endsection
