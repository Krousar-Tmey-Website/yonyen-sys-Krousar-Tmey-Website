@props([
    'items' => [],
    'kicker' => null,
])

<div class="relative">
    @if($kicker)
    <p class="relative z-10 text-center text-[18px] font-semibold tracking-[5px] uppercase text-[#C89B4D] mb-[50px]" data-reveal>
        {{ $kicker }}
    </p>
    @endif

    <div class="relative">
        {{-- Center rail: left rail on mobile, centered from tablet up.
             Deliberately NOT using data-reveal here — it's a structural wayfinding
             element, not a decorative flourish, so it must stay visible at all times.
             The IntersectionObserver-driven fade (see app.js) toggles visibility based on
             what fraction of an element is on-screen; for an element this tall, that ratio
             drifts in and out of the reveal threshold while scrolling through the middle of
             a long timeline, making the rail flicker in and out instead of staying put. --}}
        <div class="absolute top-0 bottom-0 w-0.5 bg-[#1d4e7a] left-5 md:left-1/2 md:-translate-x-1/2"></div>

        {{-- Hollow ring terminus marking the start of the timeline (desktop centered-rail only) --}}
        <div class="hidden md:block absolute -top-7 left-1/2 -translate-x-1/2 z-10 w-7 h-7 rounded-full border-[3px] border-[#1d4e7a] bg-white"></div>

        <ol class="relative list-none pl-0 grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-14 md:gap-y-16">
            @php $seenYears = []; @endphp
            @forelse($items as $index => $item)
            @php
                $isLeft = $index % 2 === 0;
                $year = $item['year'] ?? null;
                $isFirstForYear = $year && !in_array($year, $seenYears, true);
                if ($isFirstForYear) { $seenYears[] = $year; }
            @endphp
            {{-- Each pair (left+right) shares a grid row and always starts flush at the row's
                 top edge, so their dots land at the same height and the rail keeps an even,
                 predictable rhythum row-to-row regardless of how tall any one caption gets. --}}
            <li class="relative pl-12 md:pl-0 scroll-mt-28"
                @if($isFirstForYear) id="year-{{ $year }}" data-year-anchor="{{ $year }}" @endif>
                {{-- Marker dot on the center rail: one circle per unique year, not per card —
                     shown only the first time a year appears, even if that year has a second
                     card from left_text/right_text or a duplicate year row. Pulled in to -8
                     (not -10) so a left/right pair of DIFFERENT years sits tangent to each
                     other beside the rail instead of fully overlapping into one blob. --}}
                @if($isFirstForYear)
                <span class="absolute z-10 w-4 h-4 rounded-full bg-[#1d4e7a] border-4 border-white shadow
                             top-6 left-5 -translate-x-1/2
                             {{ $isLeft ? 'md:-right-8 md:left-auto md:translate-x-1/2' : 'md:-left-8 md:-translate-x-1/2' }}"></span>
                @endif

                <x-timeline-item :item="$item" :is-left="$isLeft" :index="$index" />
            </li>
            @empty
            <li class="text-center text-gray-400 py-8 md:col-span-2">No history events yet.</li>
            @endforelse
        </ol>
    </div>
</div>
