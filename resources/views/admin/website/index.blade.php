@extends('admin.layouts.app')

@section('title', 'Website Settings')
@section('page-title', 'Website Settings')
@section('breadcrumb', 'Manage your site name, logo, social media, contact information, and footer content')

@section('content')

<form action="{{ route('admin.website.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 max-w-3xl mx-auto">
    @csrf

    @php
    $order = ['website', 'social', 'media', 'sharing', 'contact', 'footer'];
    $labels = [
        'website' => ['🌐', 'Website Identity'],
        'social'  => ['📱', 'Social Media Links'],
        'media'   => ['📺', 'Media Page'],
        'sharing' => ['📤', 'Share our impact'],
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
    @php
        $items = $settings[$group] ?? collect();
    @endphp
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-center gap-3 mb-4">
            <span class="text-xl">{{ $labels[$group][0] }}</span>
            <h3 class="font-bold text-gray-800 text-base">{{ $labels[$group][1] }}</h3>
        </div>

        <hr class="mb-5 border-gray-100">

        @if($group === 'social')
            {{-- ====== Social media links with platform icons ====== --}}
            @php
                $platforms = [
                    'social_facebook'  => ['icon' => 'M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z', 'color' => '#1877F2', 'label' => 'Facebook'],
                    'social_instagram' => ['icon' => 'M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z', 'color' => '#E4405F', 'label' => 'Instagram'],
                    'social_linkedin'  => ['icon' => 'M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z', 'color' => '#0A66C2', 'label' => 'LinkedIn'],
                    'social_youtube'   => ['icon' => 'M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z', 'color' => '#FF0000', 'label' => 'YouTube'],
                ];
            @endphp
            <div class="grid grid-cols-1 gap-4">
                @foreach($items as $setting)
                @php $k = $setting->key; $platform = $platforms[$k] ?? null; @endphp
                <div>
                    <label class="flex items-center gap-2 text-sm font-medium text-gray-700 mb-1.5">
                        @if($platform)
                            <svg class="w-5 h-5 flex-shrink-0" viewBox="0 0 24 24" fill="{{ $platform['color'] }}">
                                <path d="{{ $platform['icon'] }}"/>
                            </svg>
                        @endif
                        {{ $setting->label ?? $k }}
                    </label>
                    <input type="text" name="settings[{{ $k }}]"
                           value="{{ old('settings.'.$k, $setting->value) }}"
                           placeholder="https://{{ $platform ? strtolower($platform['label']) : '...' }}.com/..."
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                @endforeach
            </div>

        @elseif($group === 'media')
            {{-- ====== Media Page Settings ====== --}}
            <div class="space-y-4">
                <p class="text-xs text-gray-500 mb-3">Configure the <a href="{{ route('media') }}" target="_blank" class="text-[#2d6fa3] hover:underline font-medium">Media page</a> header, social links, and contact email.</p>

                <div class="space-y-4">
                    @php
                        $mediaFields = [
                            'media_title' => ['label' => 'Page Title', 'type' => 'text', 'default' => 'MEDIA', 'placeholder' => 'MEDIA'],
                            'media_contact_email' => ['label' => 'Contact Email', 'type' => 'email', 'default' => 'communication@krousar-thmey.org', 'placeholder' => 'communication@krousar-thmey.org'],
                            'media_facebook_url' => ['label' => 'Facebook URL', 'type' => 'url', 'default' => 'https://www.facebook.com/KrousarThmey/', 'placeholder' => 'https://facebook.com/...'],
                            'media_twitter_url' => ['label' => 'Twitter/X URL', 'type' => 'url', 'default' => 'https://twitter.com/krousarthmey', 'placeholder' => 'https://twitter.com/...'],
                            'media_linkedin_url' => ['label' => 'LinkedIn URL', 'type' => 'url', 'default' => 'https://www.linkedin.com/company/krousar-thmey/', 'placeholder' => 'https://linkedin.com/...'],
                        ];
                    @endphp

                    @foreach($mediaFields as $key => $field)
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">{{ $field['label'] }}</label>
                        @if($field['type'] === 'textarea')
                            <textarea name="settings[{{ $key }}]" rows="3"
                                      class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                                      placeholder="{{ $field['placeholder'] }}">{{ old('settings.'.$key, $items->firstWhere('key', $key)->value ?? $field['default']) }}</textarea>
                        @else
                            <input type="{{ $field['type'] }}" name="settings[{{ $key }}]"
                                   value="{{ old('settings.'.$key, $items->firstWhere('key', $key)->value ?? $field['default']) }}"
                                   class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                                   placeholder="{{ $field['placeholder'] }}">
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

        @elseif($group === 'sharing')
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
