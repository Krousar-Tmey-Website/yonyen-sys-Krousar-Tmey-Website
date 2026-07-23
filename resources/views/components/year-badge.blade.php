@props([
    'year' => null,
    'size' => 'w-16',
    'ringColor' => '#C89B4D',
    'textColor' => '#1F2A44',
    'ribbon' => false,
])

@if($ribbon)
    {{-- Ribbon badge image (public/images/badges/award-ribbon.jpg) — the year is
         overlaid at 33% from the top, which is the vertical center of the badge's
         circular medallion (measured directly from the source image's pixels). --}}
    <div {{ $attributes->merge(['class' => "$size relative flex-shrink-0"]) }} style="aspect-ratio: 432 / 600;">
        <img src="{{ asset('images/badges/award-ribbon.jpg') }}" alt="" class="w-full h-full object-contain" aria-hidden="true">
        @if($year)
        <span class="absolute left-1/2 font-bold text-[11px] leading-none"
              style="top: 33%; transform: translate(-50%, -50%); font-family: Georgia, 'Times New Roman', serif; color: {{ $textColor }};">{{ $year }}</span>
        @endif
    </div>
@else
    @php
        $bumpCount = 20;
        $bumpRingRadius = 38;
        $bumpRadius = 10.5;
        $center = 50;
    @endphp
    <div {{ $attributes->merge(['class' => "$size aspect-square relative flex-shrink-0"]) }}>
        <svg viewBox="0 0 100 100" class="w-full h-full block" aria-hidden="true">
            @for ($i = 0; $i < $bumpCount; $i++)
                @php
                    $angle = ($i / $bumpCount) * 2 * M_PI;
                    $bx = $center + $bumpRingRadius * cos($angle);
                    $by = $center + $bumpRingRadius * sin($angle);
                @endphp
                <circle cx="{{ round($bx, 2) }}" cy="{{ round($by, 2) }}" r="{{ $bumpRadius }}" fill="{{ $ringColor }}" />
            @endfor

            <circle cx="{{ $center }}" cy="{{ $center }}" r="31.5" fill="none" stroke="#ffffff" stroke-width="3" />
            <circle cx="{{ $center }}" cy="{{ $center }}" r="29.5" fill="#ffffff" />
            <circle cx="{{ $center }}" cy="{{ $center }}" r="27.5" fill="none" stroke="{{ $ringColor }}" stroke-width="1" />
            <circle cx="{{ $center }}" cy="{{ $center }}" r="25.5" fill="none" stroke="{{ $ringColor }}" stroke-width="1" />

            @if($year)
            <text x="{{ $center }}" y="{{ $center }}" text-anchor="middle" dominant-baseline="central"
                  font-family="Georgia, 'Times New Roman', serif" font-weight="700" font-size="22" fill="{{ $textColor }}">{{ $year }}</text>
            @endif
        </svg>
    </div>
@endif
