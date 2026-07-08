@extends('admin.layouts.app')

@section('title', 'Home Settings')
@section('page-title', 'Home Page Settings')
@section('breadcrumb', 'Manage homepage text content in website order')

@section('content')

<form action="{{ route('admin.home.update') }}" method="POST" class="space-y-6 max-w-3xl">
    @csrf

    @php
    $order = ['stats', 'programs', 'structure', 'news', 'cta', 'footer'];
    $labels = [
        'stats'     => ['📊', 'Stats & Data'],
        'programs'  => ['🧩', 'Programs Overview'],
        'structure' => ['🗺️', 'Structure Map'],
        'news'      => ['📰', 'Latest News Section'],
        'cta'       => ['🚀', 'Call to Action'],
        'footer'    => ['📍', 'Footer Contact Info'],
    ];
    @endphp

    @foreach($order as $group)
    @if(!isset($settings[$group])) @continue @endif
    @php $items = $settings[$group]; @endphp
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-700 mb-5 capitalize flex items-center gap-2">
            <span class="text-lg">{{ $labels[$group][0] }}</span> {{ $labels[$group][1] }}
        </h3>
        <div class="space-y-4">
            @foreach($items as $setting)
            @php
                $allowedStats = ['stat_children', 'stat_employees', 'stat_budget', 'stat_provinces'];
                $k = $setting->key;
            @endphp
            @if($group === 'stats' && !in_array($k, $allowedStats))
                @continue
            @endif
            @if($group === 'programs' && $k === 'programs_heading')
                @continue
            @endif
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">{{ $setting->label ?? $setting->key }}</label>
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
                           placeholder="Enter amount or use K shorthand (e.g. 950K or 950000)"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">

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

    <div class="flex items-center gap-3">
        <button type="submit" class="btn-primary">Save Settings</button>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
    </div>
</form>

@endsection
