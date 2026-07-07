@extends('admin.layouts.app')

@section('title', 'Home Settings')
@section('page-title', 'Home Page Settings')
@section('breadcrumb', 'Edit stats, hero slides, and mission text')

@section('content')

<form action="{{ route('admin.home.update') }}" method="POST" class="space-y-6 max-w-3xl">
    @csrf

    @foreach($settings as $group => $items)
    @if($group === 'general')
        @continue
    @endif
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-700 mb-5 capitalize flex items-center gap-2">
            @if($group === 'hero')
                <span class="text-lg">🎯</span> Hero Banner
            @elseif($group === 'about')
                <span class="text-lg">🏛️</span> About Section
            @elseif($group === 'stats')
                <span class="text-lg">📊</span> STATS / DATA SECTION
            @elseif($group === 'programs')
                <span class="text-lg">🧩</span> Programs Overview
            @elseif($group === 'news')
                <span class="text-lg">📰</span> Latest News Section
            @elseif($group === 'partners')
                <span class="text-lg">🤝</span> Partners Section
            @elseif($group === 'cta')
                <span class="text-lg">🚀</span> Call to Action
            @elseif($group === 'footer')
                <span class="text-lg">📍</span> Footer Contact Info
            @else
                <span class="text-lg">📝</span> {{ ucfirst($group) }}
            @endif
        </h3>
        <div class="space-y-4">
            @foreach($items as $setting)
            @php
                // Only show a limited set of stats on the admin page
                $allowedStats = ['stat_children', 'stat_employees', 'stat_budget', 'stat_provinces'];
                $k = $setting->key;
            @endphp
            @if($group === 'stats' && !in_array($k, $allowedStats))
                @continue
            @endif
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">{{ $setting->label ?? $setting->key }}</label>
                @if(str_contains($k, 'text') || str_contains($k, 'subtitle'))
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
