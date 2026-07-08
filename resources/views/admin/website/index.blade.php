@extends('admin.layouts.app')

@section('title', 'Website Settings')
@section('page-title', 'Website Settings')
@section('breadcrumb', 'Manage your site name, logo, contact information, and footer content')

@section('content')

<form action="{{ route('admin.website.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-3xl mx-auto">
    @csrf

    @php
    $order = ['website', 'contact', 'footer'];
    $labels = [
        'website' => ['🌐', 'Website Identity'],
        'contact' => ['📞', 'Contact Information'],
        'footer'  => ['📍', 'Footer Settings'],
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
            @php $k = $setting->key; @endphp
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">{{ $setting->label ?? $setting->key }}</label>

                @if($k === 'site_logo')
                    <div class="flex items-center gap-4">
                        <div class="flex-shrink-0 w-20 h-20 rounded-xl border border-gray-200 bg-gray-50 flex items-center justify-center overflow-hidden">
                            @php
                                $logoPath = $setting->value;
                                $logoUrl = $logoPath ? (str_starts_with($logoPath, 'http') ? $logoPath : (str_starts_with($logoPath, 'logos/') ? asset('storage/' . $logoPath) : asset($logoPath))) : asset('images/logo.png');
                            @endphp
                            <img src="{{ $logoUrl }}"
                                 alt="Logo preview"
                                 class="w-full h-full object-contain p-1"
                                 onerror="this.parentElement.innerHTML='<span class=\\'text-gray-400 text-xs\\'>No logo</span>'">
                        </div>
                        <div class="flex-1">
                            <input type="file" name="logo" accept="image/png,image/jpeg,image/webp,image/svg+xml"
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-[#2d6fa3] hover:file:bg-blue-100 transition-colors">
                            <p class="text-xs text-gray-400 mt-1.5">PNG, JPG, WebP, or SVG. Max 2MB.</p>
                            <input type="hidden" name="settings[site_logo]" value="{{ $setting->value }}">
                        </div>
                    </div>

                @elseif(str_contains($k, 'description'))
                    <textarea name="settings[{{ $k }}]" rows="3"
                              class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('settings.'.$k, $setting->value) }}</textarea>

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
