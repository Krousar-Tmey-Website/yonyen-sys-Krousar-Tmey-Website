@extends('admin.layouts.app')

@section('title', 'Website Settings')
@section('page-title', 'Website Settings')
@section('breadcrumb', 'Manage your site name, logo, social media, contact information, and footer content')

@section('content')

<form action="{{ route('admin.website.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-3xl mx-auto">
    @csrf

    @php
    $order = ['website', 'sharing', 'social', 'contact', 'footer'];
    $labels = [
        'website' => ['🌐', 'Website Identity'],
        'sharing' => ['📤', 'Share our impact'],
        'social'  => ['📱', 'Social Media Links'],
        'contact' => ['📞', 'Contact Information'],
        'footer'  => ['📍', 'Footer Settings'],
    ];

    $socialPlatforms = [
        'facebook'  => ['label' => 'Facebook',  'color' => '#1877F2', 'icon' => 'F', 'key' => 'social_facebook',  'defaultUrl' => 'https://www.facebook.com/KrousarThmey'],
        'instagram' => ['label' => 'Instagram', 'color' => '#E1306C', 'icon' => 'I', 'key' => 'social_instagram', 'defaultUrl' => 'https://www.instagram.com/krousarthmey/'],
        'linkedin'  => ['label' => 'LinkedIn',  'color' => '#0A66C2', 'icon' => 'in', 'key' => 'social_linkedin',  'defaultUrl' => 'https://www.linkedin.com/company/krousar-thmey/'],
        'youtube'   => ['label' => 'YouTube',   'color' => '#FF0000', 'icon' => '▶', 'key' => 'social_youtube',   'defaultUrl' => 'https://www.youtube.com/@KrousarThmey'],
        'telegram'  => ['label' => 'Telegram',  'color' => '#0088CC', 'icon' => 'T', 'key' => 'social_telegram',  'defaultUrl' => 'https://t.me/krousarthmey'],
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

        @if($group === 'sharing')
            {{-- ====== Share our impact - Manageable settings ====== --}}
            <div class="space-y-4">
                <p class="text-xs text-gray-500 mb-3">Manage the "Share our impact" section on the presentation page.</p>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Enable Share Section</label>
                        <label class="flex items-center gap-2 text-xs text-gray-600">
                            <input type="checkbox" name="settings[sharing_enabled]" value="1" {{ (old('settings.sharing_enabled', $items->firstWhere('key', 'sharing_enabled')->value ?? '1')) == '1' ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]/20">
                            Show share buttons on presentation page
                        </label>
                    </div>
                    
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Section Title</label>
                        <input type="text" name="settings[sharing_title]" 
                               value="{{ old('settings.sharing_title', $items->firstWhere('key', 'sharing_title')->value ?? 'Share our impact') }}"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>
                
                <div class="pt-3 border-t border-gray-100">
                    <p class="text-xs font-medium text-gray-700 mb-3">Social Media Icons</p>
                    
                    @php
                    $iconSettings = [
                        'sharing_facebook_icon' => ['label' => 'Facebook Icon', 'color' => '#1877F2', 'default' => 'images/social/facebook.svg'],
                        'sharing_twitter_icon' => ['label' => 'Twitter Icon', 'color' => '#1DA1F2', 'default' => 'images/social/twitter.svg'],
                        'sharing_linkedin_icon' => ['label' => 'LinkedIn Icon', 'color' => '#0A66C2', 'default' => 'images/social/linkedin.svg'],
                        'sharing_share_icon' => ['label' => 'Share Icon', 'color' => '#6B7280', 'default' => 'images/social/share.svg'],
                    ];
                    @endphp
                    
                    <div class="grid grid-cols-1 gap-4">
                        @foreach($iconSettings as $key => $config)
                        <div class="flex items-center gap-4">
                            <div class="flex-shrink-0 w-12 h-12 rounded-full overflow-hidden border border-gray-200">
                                @php
                                    $_previewIcon = $items->firstWhere('key', $key)->value ?? $config['default'];
                                    $_previewUrl = str_starts_with($_previewIcon, 'social/') ? asset('storage/' . $_previewIcon) : asset($_previewIcon);
                                @endphp
                                <img src="{{ $_previewUrl }}" alt="{{ $config['label'] }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <label class="block text-xs font-medium text-gray-600 mb-1">{{ $config['label'] }}</label>
                                <input type="file" name="{{ $key }}_file" accept="image/svg+xml,image/png,image/jpeg,image/webp"
                                       class="w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-[#2d6fa3]">
                                <input type="hidden" name="settings[{{ $key }}]" value="{{ $items->firstWhere('key', $key)->value ?? $config['default'] }}">
                                <p class="text-xs text-gray-400 mt-1">SVG, PNG, JPG, or WebP. Upload to replace icon.</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="p-3 bg-blue-50 border border-blue-100 rounded-xl text-xs text-blue-600 mt-4">
                        <strong>Note:</strong> Icons will be saved to <code>public/images/social/</code> directory. Upload takes priority over existing files.
                    </div>
                </div>

            </div>

        @elseif($group === 'contact')
            {{-- ====== Per-country office cards ====== --}}
            <div class="space-y-6">
                @foreach($countries as $id => $info)
                @php
                    $countryAddress = $items->firstWhere('key', "contact_{$id}_address");
                    $countryPhone   = $items->firstWhere('key', "contact_{$id}_phone");
                    $countryEmail   = $items->firstWhere('key', "contact_{$id}_email");
                @endphp
                <div class="bg-gray-50 rounded-xl border border-gray-100 p-5">
                    <h4 class="font-bold text-gray-800 text-sm mb-4 flex items-center gap-2">
                        <span class="text-lg">{{ $info['flag'] }}</span>
                        {{ $info['name'] }} Office
                    </h4>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-500 mb-1">Address</label>
                            <textarea name="settings[contact_{{ $id }}_address]" rows="3"
                                      class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('settings.contact_'.$id.'_address', $countryAddress->value ?? '') }}</textarea>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Phone</label>
                                <input type="text" name="settings[contact_{{ $id }}_phone]"
                                       value="{{ old('settings.contact_'.$id.'_phone', $countryPhone->value ?? '') }}"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 mb-1">Email</label>
                                <input type="text" name="settings[contact_{{ $id }}_email]"
                                       value="{{ old('settings.contact_'.$id.'_email', $countryEmail->value ?? '') }}"
                                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

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

        @elseif($group === 'social')
            {{-- ====== Social Media Links (Header / Footer) ====== --}}
            <div class="space-y-4">
                <p class="text-xs text-gray-500 mb-3">Manage the social media links displayed in the top bar and footer of your website.</p>

                @php
                    $urlItems = $items->filter(fn($s) => !str_contains($s->key, '_icon'));
                @endphp

                <div class="space-y-4">
                    @foreach($socialPlatforms as $name => $platform)
                    @php
                        $urlSetting = $urlItems->firstWhere('key', $platform['key']);
                        $urlValue = $urlSetting->value ?? '';
                    @endphp
                    <div class="flex items-center gap-4 p-3 rounded-xl border border-gray-50 bg-gray-50/50 hover:border-gray-200 transition-colors">
                        <div class="flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center font-bold text-sm"
                             style="background-color: {{ $platform['color'] }}15; color: {{ $platform['color'] }};">
                            {{ $platform['icon'] }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <label class="block text-xs font-medium text-gray-500 mb-1">{{ $platform['label'] }} URL</label>
                            <div class="flex items-center gap-2">
                                <input type="text" name="settings[{{ $platform['key'] }}]"
                                       value="{{ old('settings.'.$platform['key'], $urlValue) }}"
                                       placeholder="{{ $platform['defaultUrl'] }}"
                                       class="flex-1 min-w-0 px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                                @if($urlValue)
                                <a href="{{ $urlValue }}" target="_blank" rel="noopener noreferrer"
                                   class="flex-shrink-0 w-9 h-9 rounded-lg flex items-center justify-center border border-gray-200 text-gray-400 hover:bg-gray-100 hover:text-gray-600 transition-all"
                                   title="Open {{ $platform['label'] }} link">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                    </svg>
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

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
