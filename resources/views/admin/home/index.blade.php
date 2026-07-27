@extends('admin.layouts.app')

@section('title', 'Homepage Settings')
@section('page-title', 'Homepage Settings')
@section('breadcrumb', 'Configure homepage content — stats, map text, and more')

@section('content')

<form action="{{ route('admin.home.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-3xl mx-auto">
    @csrf

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
            ],
        ],

        'cta' => [
            'icon'   => '🎯',
            'title'  => 'Call to Action Banner',
            'fields' => [
                ['key' => 'cta_background_image', 'label' => 'Background Image',                               'type' => 'image'],
                ['key' => 'cta_label',            'label' => 'Badge Text',                                     'type' => 'text', 'placeholder' => 'Support Our Work'],
                ['key' => 'cta_title',            'label' => 'Title',                                          'type' => 'text', 'placeholder' => 'Help a Child Build Their Future'],
                ['key' => 'cta_subtitle',         'label' => 'Subtitle',                                       'type' => 'textarea', 'placeholder' => 'We guarantee that 100% of your donation...'],
                ['key' => 'cta_primary_text',     'label' => 'Button 1 — Text (Donate Now)',                   'type' => 'text', 'placeholder' => 'Donate Now'],
                ['key' => 'cta_primary_url',      'label' => 'Button 1 — URL',                                 'type' => 'url', 'placeholder' => '/donate'],
                ['key' => 'cta_secondary_text',   'label' => 'Button 2 — Text (Get Involved)',                  'type' => 'text', 'placeholder' => 'Get Involved'],
                ['key' => 'cta_secondary_url',    'label' => 'Button 2 — URL',                                 'type' => 'url', 'placeholder' => '/get-involved'],
                ['key' => 'cta_annual_report_text','label' => 'Button 3 — Text (Annual Report)',                'type' => 'text', 'placeholder' => 'Annual Report'],
                ['key' => 'cta_annual_report_url', 'label' => 'Button 3 — URL',                                'type' => 'url', 'placeholder' => '/resources'],
            ],
        ],
    ];
    @endphp

    @foreach($sections as $id => $section)
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center gap-3 mb-4">
            <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </span>
            <h3 class="font-semibold text-gray-700 text-sm">{{ $section['title'] }}</h3>
        </div>

        <hr class="mb-5 border-gray-100">

        <div class="space-y-5">
            @foreach($section['fields'] as $field)
            @php
                $k = $field['key'];
                $default = $field['default'] ?? '';
                $currentVal = $val($k, $default);
            @endphp
            <div>
                <label for="settings_{{ $k }}" class="block text-sm font-medium text-gray-700 mb-1.5">
                    {{ $field['label'] }}
                </label>

                @if($field['type'] === 'textarea')
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
    @endforeach

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="btn-primary">Save Settings</button>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600 text-sm transition-colors">Cancel</a>
    </div>
</form>

@endsection
