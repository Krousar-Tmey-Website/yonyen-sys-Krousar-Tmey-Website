@php
    $isEdit = isset($office);
    $val = fn (string $field, $default = '') => old($field, $isEdit ? ($office->{$field} ?? $default) : $default);
@endphp

{{-- Office Details --}}
<div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-4">
    <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
        <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </span>
        Office Details
    </h3>

    <div class="grid lg:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Country <span class="text-red-400">*</span></label>
            <input type="text" name="country" value="{{ $val('country') }}" required
                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                   placeholder="e.g. Cambodia">
            @error('country')<p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>@enderror
            <p class="text-xs text-gray-400 mt-1.5">Shown as the card title. Also the value used to route Contact form submissions to this office.</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Office Name <span class="text-red-400">*</span></label>
            <input type="text" name="city" value="{{ $val('city') }}" required
                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                   placeholder="e.g. Krousar Thmey Cambodia">
            @error('city')<p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>@enderror
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Flag Emoji <span class="text-gray-400 font-normal">(optional)</span></label>
            <input type="text" name="flag" value="{{ $val('flag') }}" maxlength="10"
                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                   placeholder="🇰🇭">
            @error('flag')<p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Sort Order</label>
            <input type="number" name="sort_order" value="{{ $val('sort_order', 0) }}" min="0"
                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            @error('sort_order')<p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>@enderror
            <p class="text-xs text-gray-400 mt-1.5">Lower numbers appear first, and the lowest becomes the default selected office on the Contact page.</p>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1.5">Address <span class="text-red-400">*</span></label>
        <textarea name="address" rows="3" required
                  class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                  placeholder="Street address, city, country">{{ $val('address') }}</textarea>
        @error('address')<p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>@enderror
    </div>

    <div class="grid lg:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Phone <span class="text-gray-400 font-normal">(optional)</span></label>
            <input type="text" name="phone" value="{{ $val('phone') }}"
                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                   placeholder="+855 (0)23 880 502">
            @error('phone')<p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Email <span class="text-gray-400 font-normal">(optional)</span></label>
            <input type="email" name="email" value="{{ $val('email') }}"
                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                   placeholder="office@krousar-thmey.org">
            @error('email')<p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>@enderror
            <p class="text-xs text-gray-400 mt-1.5">Contact form messages addressed to this office are emailed here.</p>
        </div>
    </div>
</div>

{{-- Card Badge --}}
<div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8 space-y-4">
    <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
        <span class="w-7 h-7 rounded-lg bg-orange-50 flex items-center justify-center">
            <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
            </svg>
        </span>
        Card Badge <span class="font-normal text-gray-400 normal-case">(optional)</span>
    </h3>
    <div class="grid lg:grid-cols-2 gap-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Badge Text</label>
            <input type="text" name="badge" value="{{ $val('badge') }}"
                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                   placeholder="e.g. Headquarters">
            @error('badge')<p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>@enderror
            <p class="text-xs text-gray-400 mt-1.5">Leave blank to hide the badge on this office's card.</p>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Badge Style</label>
            <input type="text" name="badge_color" value="{{ $val('badge_color', 'bg-[#2d6fa3] text-white') }}"
                   class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm font-mono text-xs focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            @error('badge_color')<p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>@enderror
            <p class="text-xs text-gray-400 mt-1.5">Tailwind classes, e.g. <code>bg-[#2d6fa3] text-white</code>.</p>
        </div>
    </div>
</div>

{{-- Settings --}}
<div class="bg-white rounded-2xl border border-gray-100 p-6 lg:p-8">
    <h3 class="font-semibold text-gray-700 text-sm mb-4 flex items-center gap-2">
        <span class="w-7 h-7 rounded-lg bg-gray-100 flex items-center justify-center">
            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
        </span>
        Settings
    </h3>
    <div class="flex items-center gap-2">
        <input type="checkbox" name="is_active" id="is_active" value="1" {{ $val('is_active', true) ? 'checked' : '' }}
               class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
        <label for="is_active" class="text-sm font-medium text-gray-700">Active (shown on the public Contact page)</label>
    </div>
</div>
