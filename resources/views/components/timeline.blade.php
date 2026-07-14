@props([
    'items' => [],
    'kicker' => null,
])

<div class="relative">
    {{-- Center line: left rail on mobile, centered from tablet up --}}
    <div class="absolute top-0 bottom-0 w-0.5 bg-[#D4A44F] left-5 md:left-1/2 md:-translate-x-1/2"
         data-reveal="line"></div>

    @if($kicker)
    <p class="relative z-10 text-center text-[18px] font-semibold tracking-[5px] uppercase text-[#C89B4D] mb-[50px]" data-reveal>
        {{ $kicker }}
    </p>
    @endif

    <ol class="relative list-none pl-0 space-y-[100px] xl:space-y-[130px]">
        @forelse($items as $index => $item)
        @php $isLeft = $index % 2 === 0; @endphp
        <li class="relative pl-12 md:pl-0">
            {{-- Marker dot: left rail (mobile) → above card (tablet) → centered on the split row (desktop) --}}
            <span class="absolute z-10 w-4 h-4 rounded-full bg-[#C89B4D] border-4 border-white shadow
                         top-10 left-5 -translate-x-1/2
                         md:-top-8 md:left-1/2 md:-translate-x-1/2
                         xl:top-1/2 xl:-translate-y-1/2"></span>

            <x-timeline-item :item="$item" :is-left="$isLeft" :index="$index" />
        </li>
        @empty
        <li class="text-center text-gray-400 py-8">No history events yet.</li>
        @endforelse
    </ol>
</div>
