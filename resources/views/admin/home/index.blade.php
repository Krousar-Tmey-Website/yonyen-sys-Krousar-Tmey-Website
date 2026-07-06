@extends('admin.layouts.app')

@section('title', 'Home Settings')
@section('page-title', 'Home Page Settings')
@section('breadcrumb', 'Edit stats, hero slides, and mission text')

@section('content')

<form action="{{ route('admin.home.update') }}" method="POST" class="space-y-6 max-w-3xl">
    @csrf

    @foreach($settings as $group => $items)
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-700 mb-5 capitalize flex items-center gap-2">
            @if($group === 'stats')   <span class="text-lg">📊</span> Key Statistics
            @elseif($group === 'hero') <span class="text-lg">🖼️</span> Hero Slides
            @else <span class="text-lg">📝</span> {{ ucfirst($group) }}
            @endif
        </h3>
        <div class="space-y-4">
            @foreach($items as $setting)
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">{{ $setting->label ?? $setting->key }}</label>
                @if(str_contains($setting->key, 'text') || str_contains($setting->key, 'subtitle'))
                <textarea name="settings[{{ $setting->key }}]" rows="2"
                          class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('settings.'.$setting->key, $setting->value) }}</textarea>
                @else
                <input type="text" name="settings[{{ $setting->key }}]"
                       value="{{ old('settings.'.$setting->key, $setting->value) }}"
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
