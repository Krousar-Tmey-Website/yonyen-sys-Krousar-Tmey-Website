@extends('admin.layouts.app')

@section('title', 'Home Settings')
@section('page-title', 'Home Page Settings')
@section('breadcrumb', 'Customise all the text and content that appears on your homepage')

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
                ['key' => 'stat_children',       'label' => 'Number of Children Supported',           'type' => 'number', 'placeholder' => 'e.g. 10000'],
                ['key' => 'stat_children_label', 'label' => '— Label',                                'type' => 'text',   'default' => 'CHILDREN SUPPORTED'],
                ['key' => 'stat_children_sub',   'label' => '— Subtitle',                             'type' => 'text',   'default' => 'SINCE 1991'],
                ['key' => 'stat_employees',      'label' => 'Number of Employees',                    'type' => 'number', 'placeholder' => 'e.g. 70'],
                ['key' => 'stat_employees_label','label' => '— Label',                                'type' => 'text',   'default' => 'EMPLOYEES'],
                ['key' => 'stat_budget',         'label' => 'Annual Budget (number or e.g. 950K)',    'type' => 'budget', 'placeholder' => 'e.g. 950000 or 950K'],
                ['key' => 'stat_budget_label',   'label' => '— Label',                                'type' => 'text',   'default' => 'USD ANNUAL BUDGET'],
                ['key' => 'stat_provinces',      'label' => 'Number of Provinces',                    'type' => 'number', 'placeholder' => 'e.g. 15'],
                ['key' => 'stat_provinces_label','label' => '— Label',                                'type' => 'text',   'default' => 'PROVINCES IN CAMBODIA'],
            ],
        ],
        'programs' => [
            'icon'   => '🧩',
            'title'  => 'Programs Overview',
            'fields' => [
                ['key' => 'programs_badge',      'label' => 'Badge Text',                             'type' => 'text',   'default' => 'WHAT WE DO'],
                ['key' => 'programs_heading',    'label' => 'Heading',                                'type' => 'text',   'default' => 'Two Programs, One Mission'],
                ['key' => 'programs_subtitle',   'label' => 'Subtitle',                               'type' => 'textarea', 'default' => 'Operating across 15 Cambodian provinces, our programs address the most pressing needs of vulnerable children.'],
                ['key' => 'programs_learn_btn',  'label' => 'Learn More Button Text',                 'type' => 'text',   'default' => 'Learn More'],
                ['key' => 'programs_cta',        'label' => 'View All CTA Button Text',               'type' => 'text',   'default' => 'View All Programs'],
            ],
        ],
        'structure' => [
            'icon'   => '🗺️',
            'title'  => 'Program Structure Map',
            'fields' => [
                ['key' => 'structure_heading',           'label' => 'Section Heading',                 'type' => 'text',   'default' => "KROUSAR THMEY'S STRUCTURES"],
                ['key' => 'structure_welfare_title',     'label' => 'Child Welfare — Title',           'type' => 'text',   'default' => 'Child Welfare Program'],
                ['key' => 'structure_welfare_items',     'label' => 'Child Welfare — Items (one per line)', 'type' => 'textarea'],
                ['key' => 'structure_education_title',   'label' => 'Education — Title',               'type' => 'text',   'default' => 'Education for Deaf or Blind Children Program'],
                ['key' => 'structure_education_items',   'label' => 'Education — Items (one per line)',     'type' => 'textarea'],
                ['key' => 'structure_image',             'label' => 'Map Image',                        'type' => 'image'],
            ],
        ],
        'news' => [
            'icon'   => '📰',
            'title'  => 'Latest News Section',
            'fields' => [
                ['key' => 'news_title',      'label' => 'Section Badge / Title',                      'type' => 'text',   'default' => 'Latest Updates'],
                ['key' => 'news_subtitle',   'label' => 'Subtitle Description',                       'type' => 'textarea'],
                ['key' => 'news_view_all',   'label' => 'View All Link Text',                         'type' => 'text',   'default' => 'All News'],
            ],
        ],
        'projects' => [
            'icon'   => '🔧',
            'title'  => 'Cross-cutting Projects Section',
            'fields' => [
                ['key' => 'projects_badge',      'label' => 'Badge Text',                             'type' => 'text',   'default' => 'Our Projects'],
                ['key' => 'projects_title',      'label' => 'Section Heading',                        'type' => 'text',   'default' => 'Cross-cutting Initiatives'],
                ['key' => 'projects_read_more',  'label' => 'Read More Button Text',                  'type' => 'text',   'default' => 'Read More Detail'],
            ],
        ],


        'cta' => [
            'icon'   => '🚀',
            'title'  => 'Call to Action',
            'fields' => [
                ['key' => 'cta_label',             'label' => 'Badge Label',                          'type' => 'text',   'default' => 'Support Our Work'],
                ['key' => 'cta_title',             'label' => 'Heading',                              'type' => 'text',   'default' => 'Help a Child Build Their Future'],
                ['key' => 'cta_subtitle',          'label' => 'Subtitle Description',                 'type' => 'textarea'],
                ['key' => 'cta_primary_text',      'label' => 'Primary Button Text',                  'type' => 'text',   'default' => 'Donate Now'],
                ['key' => 'cta_primary_url',       'label' => 'Primary Button URL',                   'type' => 'url'],
                ['key' => 'cta_secondary_text',    'label' => 'Secondary Button Text',                'type' => 'text'],
                ['key' => 'cta_secondary_url',     'label' => 'Secondary Button URL',                 'type' => 'url'],
                ['key' => 'cta_annual_report_text','label' => 'Annual Report Button Text',            'type' => 'text',   'default' => 'Annual Report'],
            ],
        ],
        'partners' => [
            'icon'   => '🤝',
            'title'  => 'Partners Section',
            'fields' => [
                ['key' => 'partners_badge',    'label' => 'Badge Text',                               'type' => 'text',   'default' => 'OUR NETWORK'],
                ['key' => 'partners_heading',  'label' => 'Section Heading',                          'type' => 'text',   'default' => 'Supported by Our Partners Worldwide'],
                ['key' => 'partners_view_all', 'label' => 'View All Link Text',                       'type' => 'text',   'default' => 'View All Partners'],
            ],
        ],
    ];
    @endphp

    @foreach($sections as $id => $section)
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center gap-3 mb-4">
            <span class="text-xl">{{ $section['icon'] }}</span>
            <h3 class="font-bold text-gray-800 text-base">{{ $section['title'] }}</h3>
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
