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

        @if($group === 'contact')
            {{-- ====== Offices are now managed via the Offices CRUD ====== --}}
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 text-center">
                <div class="text-3xl mb-3">🏢</div>
                <h4 class="font-bold text-gray-800 text-sm mb-2">Office Locations</h4>
                <p class="text-gray-500 text-xs mb-4">Office locations are now managed from the dedicated <strong>Offices</strong> page, where you can add, edit, delete offices, set Google Maps links, and update office hours.</p>
                <a href="{{ route('admin.offices.index') }}"
                   class="inline-flex items-center gap-2 px-4 py-2 bg-[#2d6fa3] text-white text-sm font-medium rounded-xl hover:bg-[#1d4e7a] transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Manage Offices
                </a>
            </div>

            {{-- ====== General footer contact info ====== --}}
            @php
                $generalKeys = ['footer_address', 'footer_phone', 'footer_email'];
                $generalItems = $items->whereIn('key', $generalKeys);
            @endphp
            @if($generalItems->isNotEmpty())
            <div class="pt-2">
                <h4 class="font-bold text-gray-800 text-sm mb-4 flex items-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    General Contact (Footer)
                </h4>
                <div class="space-y-4">
                    @foreach($generalItems as $setting)
                    @php $k = $setting->key; @endphp
                    <div>
                        <label class="block text-xs font-medium text-gray-500 mb-1">{{ $setting->label ?? $setting->key }}</label>
                        <input type="text" name="settings[{{ $k }}]"
                               value="{{ old('settings.'.$k, $setting->value) }}"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        @else
            {{-- ====== Standard field rendering ====== --}}
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
        @endif
    </div>
    @endforeach

    <div class="flex items-center gap-3 pt-2">
        <button type="submit" class="btn-primary">Save Settings</button>
        <a href="{{ route('admin.dashboard') }}" class="text-gray-400 hover:text-gray-600 text-sm transition-colors">Cancel</a>
    </div>
</form>

@endsection
