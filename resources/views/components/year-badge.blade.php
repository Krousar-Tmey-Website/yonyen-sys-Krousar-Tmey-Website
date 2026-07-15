@props([
    'year' => null,
    'size' => 'w-16',
    'ringColor' => '#C89B4D',
    'textColor' => '#1F2A44',
    'ribbon' => false,
])

@php
    $bumpCount = 20;
    $bumpRingRadius = 38;
    $bumpRadius = 10.5;
    $center = 50;
    $viewBoxHeight = $ribbon ? 130 : 100;
    $aspect = $ribbon ? 'aspect-[100/130]' : 'aspect-square';
@endphp

<div {{ $attributes->merge(['class' => "$size $aspect relative flex-shrink-0"]) }}>
    <svg viewBox="0 0 100 {{ $viewBoxHeight }}" class="w-full h-full block" aria-hidden="true">
        @if($ribbon)
            <polygon points="37,50 49,50 46,112 41,100 32,112" fill="{{ $ringColor }}" />
            <polygon points="51,50 63,50 68,112 59,100 54,112" fill="{{ $ringColor }}" />
            <path d="M 30 75 Q 40 68 50 75 T 70 75" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" />
        @endif

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
