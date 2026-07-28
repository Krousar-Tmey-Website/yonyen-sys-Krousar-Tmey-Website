@extends('admin.layouts.app')

@section('title', 'Quick Links Cards')
@section('page-title', 'Quick Links Cards')
@section('breadcrumb', 'Get Involved → Quick Links Cards')

@section('content')

@php
    $icons = \App\Models\InvolvedQuickLink::ICONS;
    $cardPalette = [
        ['accent' => '#2d6fa3', 'icon_bg' => '#f0f9ff'],
        ['accent' => '#8da83a', 'icon_bg' => '#ecfdf5'],
        ['accent' => '#e8a020', 'icon_bg' => '#fffbeb'],
        ['accent' => '#d32f2f', 'icon_bg' => '#fef2f2'],
    ];
@endphp

<div class="space-y-6"
     x-data="{
         showModal: false,
         editMode: false,
         lang: 'en',
         actionUrl: '{{ route('admin.involved-quick-links.store') }}',
         itemId: '',
         iconKey: 'briefcase',
         title: '',
         titleKm: '',
         description: '',
         descriptionKm: '',
         linkUrl: '#partner',
         accentColor: '#2d6fa3',
         cardBackgroundColor: '#ffffff',
         iconBackgroundColor: '#f0f9ff',
         sortOrder: 0,
         openAddModal() {
             this.editMode = false;
             this.lang = 'en';
             this.actionUrl = '{{ route('admin.involved-quick-links.store') }}';
             this.itemId = '';
             this.iconKey = 'briefcase';
             this.title = '';
             this.titleKm = '';
             this.description = '';
             this.descriptionKm = '';
             this.linkUrl = '#partner';
             this.accentColor = '#2d6fa3';
             this.cardBackgroundColor = '#ffffff';
             this.iconBackgroundColor = '#f0f9ff';
             this.sortOrder = 0;
             this.showModal = true;
             this.$nextTick(() => this.syncCKEditors());
         },
         openEditModal(item) {
             this.editMode = true;
             this.lang = 'en';
             this.actionUrl = `/admin/involved-quick-links/${item.id}`;
             this.itemId = item.id;
             this.iconKey = item.icon_key || 'briefcase';
             this.title = item.title || '';
             this.titleKm = item.title_km || '';
             this.description = item.description || '';
             this.descriptionKm = item.description_km || '';
             this.linkUrl = item.link_url || '#';
             this.accentColor = item.accent_color || item.fallback_accent_color || '#2d6fa3';
             this.cardBackgroundColor = item.card_background_color || '#ffffff';
             this.iconBackgroundColor = item.icon_background_color || item.fallback_icon_background_color || '#f0f9ff';
             this.sortOrder = item.sort_order;
             this.showModal = true;
             this.$nextTick(() => this.syncCKEditors());
         },
         syncCKEditors() {
             window.setCKEditorContent?.(document.getElementById('quicklink-description'), this.description);
             window.setCKEditorContent?.(document.getElementById('quicklink-description-km'), this.descriptionKm);
         }
     }">
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="font-bold text-gray-700 text-sm">Quick Links Cards</h3>
                <p class="text-xs text-gray-400 mt-0.5">The cards shown right under the "Get Involved" banner (Partner, Volunteer, Work With Us, Book for Sales).</p>
            </div>
            <button @click="openAddModal()"
                    class="inline-flex items-center gap-1.5 text-xs font-medium text-white bg-[#2d6fa3] hover:bg-[#1d4e7a] px-3.5 py-2 rounded-lg transition-all duration-200">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Card
            </button>
        </div>

        @if($items->isEmpty())
        <div class="bg-gray-50 rounded-xl py-12 text-center text-gray-400">
            <p class="text-sm font-medium mb-2">No quick link cards configured yet.</p>
            <button @click="openAddModal()" class="text-[#2d6fa3] text-sm underline hover:text-[#1d4e7a]">Add your first card</button>
        </div>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($items as $index => $item)
            @php
                $palette = $cardPalette[$index % count($cardPalette)];
                $itemForModal = array_merge($item->toArray(), [
                    'fallback_accent_color' => $palette['accent'],
                    'fallback_icon_background_color' => $palette['icon_bg'],
                ]);
            @endphp
            <div class="relative rounded-2xl border-2 border-gray-100 overflow-hidden group cursor-pointer hover:shadow-md transition-all duration-200"
                 style="background-color: {{ $item->card_background_color ?: '#ffffff' }};"
                 @click="openEditModal({{ json_encode($itemForModal) }})">
                <div class="p-5">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4" style="background-color: {{ $item->icon_background_color ?: $palette['icon_bg'] }};">
                        <svg class="w-5 h-5" fill="none" stroke="{{ $item->accent_color ?: $palette['accent'] }}" viewBox="0 0 24 24">{!! $item->icon_path !!}</svg>
                    </div>
                    <h4 class="font-bold text-[#1d4e7a] text-sm mb-1">{{ $item->title }}</h4>
                    <p class="text-gray-500 text-xs leading-relaxed line-clamp-2 mb-2">{{ Str::limit(strip_tags($item->description ?? ''), 80) }}</p>
                    <span class="text-[10px] font-mono text-gray-400">{{ $item->link_url }}</span>
                    <span class="text-[10px] font-bold text-gray-400 block mt-1">Order: {{ $item->sort_order }}</span>
                </div>
                <div class="absolute top-3 right-3 flex gap-1 items-center opacity-0 group-hover:opacity-100 transition-all duration-200">
                    <form action="{{ route('admin.involved-quick-links.destroy', $item) }}" method="POST" @click.stop onsubmit="return confirm('Delete this card?')">
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
                                <button type="button" class="lang-tab" :class="{ active: lang === 'km' }" @click.prevent="lang = 'km'">KM</button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-2">Icon</label>
                            <div class="grid grid-cols-6 gap-2">
                                @foreach($icons as $key => $icon)
                                <label class="flex items-center justify-center h-11 rounded-xl border-2 cursor-pointer transition-all duration-150"
                                       :class="iconKey === '{{ $key }}' ? 'border-[#2d6fa3] bg-[#2d6fa3]/5' : 'border-gray-200 hover:border-gray-300'">
                                    <input type="radio" name="icon_key" value="{{ $key }}" x-model="iconKey" class="sr-only" title="{{ $icon['label'] }}">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $icon['path'] !!}</svg>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <div x-show="lang === 'en'">
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Title <span class="text-red-400">*</span></label>
                            <input type="text" name="title" x-model="title" required
                                   class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                   placeholder="e.g. Partner">
                        </div>
                        <div x-show="lang === 'km'" x-cloak>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Title (Khmer) <span class="text-gray-400 font-normal">(optional)</span></label>
                            <input type="text" name="title_km" x-model="titleKm"
                                   class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>

                        <div x-show="lang === 'en'">
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Description</label>
                            <x-admin.rich-text id="quicklink-description" name="description" :value="''" lang="en" :rows="3" @input="description = $event.target.value" />
                        </div>
                        <div x-show="lang === 'km'" x-cloak>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Description (Khmer)</label>
                            <x-admin.rich-text id="quicklink-description-km" name="description_km" :value="''" lang="km" :rows="3" @input="descriptionKm = $event.target.value" />
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1.5">Link (anchor like <code class="bg-gray-100 px-1 rounded">#volunteer</code> or a full URL)</label>
                            <input type="text" name="link_url" x-model="linkUrl" required
                                   class="w-full px-3.5 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                   placeholder="#partner">
                        </div>

                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-2">Card Colors</label>
                            <div class="grid grid-cols-3 gap-3">
                                <label class="text-[11px] text-gray-500 space-y-1">
                                    <span>Icon / Accent</span>
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

@endsection
