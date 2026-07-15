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
        {{-- Center rail: left rail on mobile, centered from tablet up --}}
        <div class="absolute top-0 bottom-0 w-0.5 bg-[#D4A44F] left-5 md:left-1/2 md:-translate-x-1/2"
             data-reveal="line"></div>

        <ol class="relative list-none pl-0 grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-14 md:gap-y-16">
            @forelse($items as $index => $item)
            @php $isLeft = $index % 2 === 0; @endphp
            <li class="relative pl-12 md:pl-0 {{ $isLeft ? '' : 'md:mt-20' }}">
                {{-- Marker dot on the center rail --}}
                <span class="absolute z-10 w-4 h-4 rounded-full bg-[#C89B4D] border-4 border-white shadow
                             top-6 left-5 -translate-x-1/2
                             {{ $isLeft ? 'md:-right-10 md:left-auto md:translate-x-0' : 'md:-left-10 md:translate-x-0' }}"></span>

                <x-timeline-item :item="$item" :is-left="$isLeft" :index="$index" />
            </li>
            @empty
            <li class="text-center text-gray-400 py-8 md:col-span-2">No history events yet.</li>
            @endforelse
        </ol>
    </div>
</div>
