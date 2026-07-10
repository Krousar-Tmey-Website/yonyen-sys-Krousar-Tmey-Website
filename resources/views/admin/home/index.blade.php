@extends('admin.layouts.app')

@section('title', 'Home Settings')
@section('page-title', 'Home Page Settings')
@section('breadcrumb', 'Customise the text and content that appears on your homepage')

@section('content')

<div class="max-w-3xl mx-auto mb-6">
    <a href="{{ route('admin.page-sections.index') }}"
       class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2d6fa3] text-white rounded-xl hover:bg-[#1d4e7a] transition-all text-sm font-medium shadow-sm hover:shadow-md">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
        </svg>
        Manage Page Sections
    </a>
</div>

<form action="{{ route('admin.home.update') }}" method="POST" class="space-y-6 max-w-3xl mx-auto">
    @csrf

    @php
    $order = ['stats', 'programs', 'structure', 'news', 'cta'];
    $labels = [
        'stats'     => ['📊', 'Stats & Data'],
        'programs'  => ['🧩', 'Programs Overview'],
        'structure' => ['🗺️', 'Structure Map'],
        'news'      => ['📰', 'Latest News Section'],
        'cta'       => ['🚀', 'Call to Action'],
    ];
    @endphp

    @foreach($order as $group)
    @if(!isset($settings[$group])) @continue @endif
    @php $items = $settings[$group]; @endphp
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center gap-3 mb-4">
            <span class="text-xl">{{ $labels[$group][0] }}</span>
            <h3 class="font-bold text-gray-800 text-base">{{ $labels[$group][1] }}</h3>
        </div>

        <hr class="mb-5 border-gray-100">

        <div class="space-y-5">
            @foreach($items as $setting)
            @php
                $allowedStats = ['stat_children', 'stat_employees', 'stat_budget', 'stat_provinces'];
                $k = $setting->key;
            @endphp
            @if($group === 'stats' && !in_array($k, $allowedStats))
                @continue
            @endif
            @if($group === 'programs' && in_array($k, ['programs_heading', 'programs_subtitle']))
                @continue
            @endif
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ $setting->label ?? $setting->key }}</label>

                @if(str_contains($k, 'text') || str_contains($k, 'subtitle') || str_contains($k, 'items'))
                    <textarea name="settings[{{ $k }}]" rows="2"
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('settings.'.$k, $setting->value) }}</textarea>

                @elseif(in_array($k, ['stat_employees', 'stat_provinces', 'stat_children']))
                    <input type="number" name="settings[{{ $k }}]"
                           value="{{ old('settings.'.$k, $setting->value) }}"
                           min="0" step="1"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">

                @elseif($k === 'stat_budget')
                    <input type="text" name="settings[{{ $k }}]"
                           value="{{ old('settings.'.$k, $setting->value) }}"
                           placeholder="e.g. 950000 or 950K"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">

                @elseif(in_array($k, ['cta_primary_url', 'cta_secondary_url', 'structure_image']))
                    <input type="text" name="settings[{{ $k }}]"
                           value="{{ old('settings.'.$k, $setting->value) }}"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono text-xs">

                @else
                    <input type="text" name="settings[{{ $k }}]"
                           value="{{ old('settings.'.$k, $setting->value) }}"
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
