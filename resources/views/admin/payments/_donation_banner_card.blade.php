@php
    $bannerImage = $settings[$settingsKey] ?? '';
    $hasImage = filled($bannerImage);
    $tagLabel = match($tag) {
        'cambodia' => 'Cambodia',
        'france' => 'France',
        'switzerland' => 'Switzerland',
        'elsewhere' => 'Elsewhere',
        default => ucfirst($tag),
    };
@endphp

<div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
    <div class="flex items-center justify-between">
        <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider flex items-center gap-2">
            <span class="text-base">🖼️</span> Banner Image
        </h3>
        <span class="text-xs px-3 py-1 rounded-full font-semibold {{ $hasImage ? 'bg-emerald-50 text-emerald-600 border border-emerald-200' : 'bg-slate-100 text-slate-400 border border-slate-200' }}">
            {{ $hasImage ? '✓ Set' : 'Not set' }}
        </span>
    </div>

    <p class="text-xs text-gray-400">Upload a banner image shown at the top of the <strong>{{ $tagLabel }}</strong> section on the Donate page.</p>

    @if($hasImage)
    <div class="flex items-center gap-4 p-3 bg-blue-50/60 rounded-xl border border-blue-100">
        <div class="relative shrink-0">
            <img src="{{ str_starts_with($bannerImage, 'http') ? $bannerImage : asset('storage/' . $bannerImage) . '?v=' . time() }}"
                 alt="{{ $tagLabel }} banner"
                 class="h-20 w-36 rounded-xl border-2 border-white shadow-sm bg-white object-cover">
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-xs font-semibold text-gray-700 mb-0.5">Current banner</p>
            <p class="text-xs text-gray-400 truncate">{{ basename($bannerImage) }}</p>
        </div>
        <label class="flex items-center gap-1.5 text-xs font-semibold text-red-500 hover:text-red-700 cursor-pointer flex-shrink-0 bg-white px-3 py-1.5 rounded-lg border border-red-200 hover:bg-red-50 transition-colors">
            <input type="checkbox" name="remove_donation_image" value="1" class="rounded border-gray-300 text-red-500 w-3.5 h-3.5">
            Remove
        </label>
    </div>
    @endif

    <div class="relative border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-[#2d6fa3] hover:bg-blue-50/30 transition-all duration-200 cursor-pointer group"
         onclick="this.querySelector('input[type=file]').click()">
        <input type="file" name="donation_image" accept="image/*" class="hidden"
               onchange="handleBannerPreview(this, '{{ $tag }}')">
        <div class="flex flex-col items-center gap-2 pointer-events-none">
            <div class="w-12 h-12 rounded-xl bg-gray-100 group-hover:bg-[#2d6fa3]/10 flex items-center justify-center transition-colors">
                <svg class="w-6 h-6 text-gray-400 group-hover:text-[#2d6fa3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600 group-hover:text-[#2d6fa3] transition-colors">Click to upload banner image</p>
                <p class="text-xs text-gray-400 mt-0.5">JPG, PNG, GIF or WebP &bull; Max 5MB</p>
            </div>
        </div>
    </div>
    <div id="bannerPreview_{{ $tag }}" class="hidden"></div>
</div>
