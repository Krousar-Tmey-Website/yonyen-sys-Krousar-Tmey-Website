@extends('admin.layouts.app')

@section('title', 'Homepage Settings')
@section('page-title', 'Homepage Settings')

@section('content')

<div x-data="{ tab: 'cta' }">

    {{-- ── Professional Page Header ── --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8 mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-lg font-bold text-gray-800 flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-xl bg-gradient-to-br from-[#2d6fa3] to-[#1d4e7a] flex items-center justify-center flex-shrink-0 shadow-sm">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </span>
                    Homepage Settings
                </h2>
                <p class="text-sm text-gray-500 mt-1.5 ml-[42px]">Configure homepage content — call to action banner, stats and data.</p>
            </div>
            <a href="{{ route('home') }}" target="_blank"
               class="inline-flex items-center gap-2 px-4 py-2 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-medium rounded-xl transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5 flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                View Site
            </a>
        </div>

        {{-- Tab Navigation --}}
        <div class="flex justify-center mt-6 pt-5 border-t border-gray-100">
            <div class="inline-flex bg-gray-100/80 rounded-xl p-1 gap-1 shadow-inner">
                <button @click="tab = 'cta'"
                        :class="tab === 'cta' ? 'bg-white shadow-sm text-[#2d6fa3] font-semibold ring-1 ring-gray-200/50' : 'text-gray-500 hover:text-gray-700 font-medium'"
                        class="px-7 py-2.5 rounded-lg text-sm transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                    Call to Action Banner
                </button>
                <button @click="tab = 'stats'"
                        :class="tab === 'stats' ? 'bg-white shadow-sm text-[#2d6fa3] font-semibold ring-1 ring-gray-200/50' : 'text-gray-500 hover:text-gray-700 font-medium'"
                        class="px-7 py-2.5 rounded-lg text-sm transition-all duration-200 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    Stats & Data
                </button>
            </div>
        </div>
    </div>

    {{-- Tab Content Wrapper --}}
    <div class="space-y-6">

@php
// Helper: get current setting value with fallback
$val = function($key, $default = '') use ($keyedSettings) {
    return old('settings.'.$key, $keyedSettings[$key] ?? $default);
};

$sections = [
    'stats' => [
        'icon'   => '📊',
        'title'  => 'Stats & Data',
        'fields' => [
            ['key' => 'stat_children',       'label' => 'Children Supported',                     'type' => 'number', 'placeholder' => 'e.g. 10000'],
            ['key' => 'stat_employees',      'label' => 'Employees',                              'type' => 'number', 'placeholder' => 'e.g. 70'],
            ['key' => 'stat_budget',         'label' => 'Annual Budget (number or e.g. 950K)',    'type' => 'budget', 'placeholder' => 'e.g. 950000 or 950K'],
            ['key' => 'stat_provinces',      'label' => 'Provinces in Cambodia',                  'type' => 'number', 'placeholder' => 'e.g. 15'],
            ['key' => 'stats_background_color', 'label' => 'Background Color',                     'type' => 'color', 'default' => '#1a3c6e'],
            ['key' => 'stats_data_color',       'label' => 'Data Number Color',                    'type' => 'color', 'default' => '#e8a020'],
        ],
    ],

    'cta' => [
        'icon'   => '🎯',
        'title'  => 'Call to Action Banner',
        'fields' => [
            ['key' => 'cta_background_image', 'label' => 'Background Image',                               'type' => 'image'],
            ['key' => 'cta_label',            'label' => 'Badge Text',                                     'type' => 'bilingual_text', 'placeholder' => 'Support Our Work'],
            ['key' => 'cta_title',            'label' => 'Title',                                          'type' => 'richtext', 'placeholder' => 'Help a Child Build Their Future'],
            ['key' => 'cta_subtitle',         'label' => 'Subtitle',                                       'type' => 'richtext', 'placeholder' => 'We guarantee that 100% of your donation...'],
            ['key' => 'cta_primary_text',     'label' => 'Button 1 — Text (Donate Now)',                   'type' => 'bilingual_text', 'placeholder' => 'Donate Now'],
            ['key' => 'cta_primary_url',      'label' => 'Button 1 — URL',                                 'type' => 'url', 'placeholder' => '/donate'],
            ['key' => 'cta_secondary_text',   'label' => 'Button 2 — Text (Get Involved)',                  'type' => 'bilingual_text', 'placeholder' => 'Get Involved'],
            ['key' => 'cta_secondary_url',    'label' => 'Button 2 — URL',                                 'type' => 'url', 'placeholder' => '/get-involved'],
            ['key' => 'cta_annual_report_text','label' => 'Button 3 — Text (Annual Report)',                'type' => 'bilingual_text', 'placeholder' => 'Annual Report'],
            ['key' => 'cta_annual_report_url', 'label' => 'Button 3 — URL',                                'type' => 'url', 'placeholder' => '/resources'],
        ],
    ],
];
@endphp

<form action="{{ route('admin.home.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
    @csrf

    @foreach($sections as $id => $section)
    @php
        $sectionHasBilingual = collect($section['fields'])->pluck('type')->intersect(['richtext', 'bilingual_text'])->isNotEmpty();
    @endphp
    <div x-show="tab === '{{ $id }}'" @if($sectionHasBilingual) x-data="bilingualForm()" @endif>
        <div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 shadow-sm">
            <div class="flex items-center justify-between gap-3 mb-4">
                <div class="flex items-center gap-3">
                    <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @if($id === 'cta')
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                            @else
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            @endif
                        </svg>
                    </span>
                    <h3 class="font-semibold text-gray-700 text-sm">{{ $section['title'] }}</h3>
                </div>
                @if($sectionHasBilingual)
                <div class="lang-tabs" title="Toggle editing language (English / French) for this section">
                    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                </div>
                @endif
            </div>

            <hr class="mb-5 border-gray-100">

            <div class="grid lg:grid-cols-2 gap-5">
                @foreach($section['fields'] as $field)
                @php
                    $k = $field['key'];
                    $default = $field['default'] ?? '';
                    $currentVal = $val($k, $default);
                    $isWide = in_array($field['type'], ['textarea', 'image', 'richtext']);
                @endphp
                <div class="{{ $isWide ? 'lg:col-span-2' : '' }}">
                    @if(!in_array($field['type'], ['richtext', 'bilingual_text']))
                    <label for="settings_{{ $k }}" class="block text-sm font-medium text-gray-700 mb-1.5">
                        {{ $field['label'] }}
                    </label>
                    @endif

                    @if($field['type'] === 'bilingual_text')
                        @php $currentValFr = $val($k.'_fr'); @endphp
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ $field['label'] }}</label>
                        <div x-show="lang === 'en'">
                            <input type="text" id="settings_{{ $k }}" name="settings[{{ $k }}]"
                                   value="{{ $currentVal }}"
                                   placeholder="{{ $field['placeholder'] ?? '' }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>
                        <div x-show="lang === 'fr'" x-cloak>
                            <input type="text" id="settings_{{ $k }}_fr" name="settings[{{ $k }}_fr]"
                                   value="{{ $currentValFr }}"
                                   placeholder="{{ $field['placeholder'] ?? '' }}"
                                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            <p class="text-xs text-gray-400 mt-1">Leave blank to reuse the English text.</p>
                        </div>

                    @elseif($field['type'] === 'richtext')
                        @php $currentValFr = $val($k.'_fr'); @endphp
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ $field['label'] }}</label>
                        <div x-show="lang === 'en'">
                            <x-admin.rich-text id="settings_{{ $k }}" name="settings[{{ $k }}]" :value="$currentVal" lang="en" :rows="2" :placeholder="$field['placeholder'] ?? ''" />
                        </div>
                        <div x-show="lang === 'fr'" x-cloak>
                            <x-admin.rich-text id="settings_{{ $k }}_fr" name="settings[{{ $k }}_fr]" :value="$currentValFr" lang="fr" :rows="2" />
                            <p class="text-xs text-gray-400 mt-1">Leave blank to reuse the English text.</p>
                        </div>

                    @elseif($field['type'] === 'textarea')
                        <textarea id="settings_{{ $k }}" name="settings[{{ $k }}]" rows="2"
                                  class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ $currentVal }}</textarea>

                    @elseif($field['type'] === 'number')
                        <input type="number" id="settings_{{ $k }}" name="settings[{{ $k }}]"
                               value="{{ $currentVal }}"
                               min="0" step="1"
                               placeholder="{{ $field['placeholder'] ?? '' }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">

                    @elseif($field['type'] === 'budget')
                        <input type="text" id="settings_{{ $k }}" name="settings[{{ $k }}]"
                               value="{{ $currentVal }}"
                               placeholder="{{ $field['placeholder'] ?? 'e.g. 950000 or 950K' }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">

                    @elseif($field['type'] === 'color')
                        <div class="flex items-center gap-3">
                            <input type="color" id="settings_{{ $k }}" name="settings[{{ $k }}]"
                                   value="{{ $currentVal ?: $default }}"
                                   class="h-11 w-16 rounded-xl border border-gray-200 bg-white p-1 cursor-pointer focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            <span class="text-xs font-mono text-gray-400">{{ $currentVal ?: $default }}</span>
                        </div>

                    @elseif($field['type'] === 'image')
                        {{-- Current image preview --}}
                        @if($currentVal)
                        <div class="mb-3">
                            <img src="{{ str_starts_with($currentVal, 'http') ? $currentVal : asset('storage/' . $currentVal) }}"
                                 alt="Current image"
                                 class="w-full max-h-48 object-contain rounded-xl border border-gray-200 bg-gray-50 p-2">
                            <label class="mt-2 inline-flex items-center gap-2 text-xs text-gray-500 cursor-pointer">
                                <input type="checkbox" name="clear_{{ $k }}" value="1" class="rounded border-gray-300 text-red-500 focus:ring-red-400">
                                Remove current image
                            </label>
                        </div>
                        @endif

                        {{-- File upload --}}
                        <div class="border-2 border-dashed border-gray-200 rounded-xl p-4 text-center hover:border-[#2d6fa3]/40 transition-colors cursor-pointer"
                             x-data="{ fileName: '' }"
                             @dragover.prevent="$el.classList.add('border-[#2d6fa3]')"
                             @dragleave.prevent="$el.classList.remove('border-[#2d6fa3]')"
                             @drop.prevent="$el.classList.remove('border-[#2d6fa3]'); const f = $event.dataTransfer.files[0]; if(f) { $refs.fileInput.files = $event.dataTransfer.files; fileName = f.name; }"
                             @click="$refs.fileInput.click()">
                            <input type="file" id="file_{{ $k }}" name="{{ $k }}"
                                   accept="image/png,image/jpg,image/jpeg,image/webp,image/svg+xml"
                                   class="hidden" x-ref="fileInput"
                                   @change="fileName = $event.target.files[0]?.name || ''">
                            <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="text-sm text-gray-500" x-text="fileName || 'Click or drag & drop to upload'"></p>
                            <p class="text-xs text-gray-400 mt-1">PNG, JPG, WebP or SVG — max 5MB</p>
                        </div>

                        {{-- OR URL fallback --}}
                        <div class="mt-3" x-data="{ showUrl: {{ $currentVal && !str_starts_with($currentVal, 'http') ? 'false' : 'true' }} }">
                            <button type="button" @click="showUrl = !showUrl"
                                    class="text-xs text-[#2d6fa3] hover:text-[#1d4e7a] transition-colors mb-2">
                                <span x-show="!showUrl">+ Or paste an image URL instead</span>
                                <span x-show="showUrl">− Hide URL input</span>
                            </button>
                            <div x-show="showUrl" x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 -translate-y-2"
                                 x-transition:enter-end="opacity-100 translate-y-0">
                                <input type="text" id="settings_{{ $k }}" name="settings[{{ $k }}]"
                                       value="{{ $currentVal }}"
                                       placeholder="https://example.com/image.png"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">
                            </div>
                        </div>

                    @elseif($field['type'] === 'url')
                        <input type="text" id="settings_{{ $k }}" name="settings[{{ $k }}]"
                               value="{{ $currentVal }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">

                    @else
                        <input type="text" id="settings_{{ $k }}" name="settings[{{ $k }}]"
                               value="{{ $currentVal }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    @endif
                </div>
                @endforeach
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3 pt-1">
            <button type="submit" class="btn-primary">Save Settings</button>
            <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600 text-sm transition-colors">Cancel</a>
            <a href="{{ route('home') }}" target="_blank" class="ml-auto flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View live page
            </a>
        </div>
    </div>
    @endforeach

</form>

    </div>
    {{-- End Tab Content Wrapper --}}
</div>

@endsection
