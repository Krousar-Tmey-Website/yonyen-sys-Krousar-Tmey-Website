@props([
    'item' => [],
    'isLeft' => true,
    'index' => 0,
])

@php
    $year        = $item['year'] ?? null;
    $title       = $item['title'] ?? null;
    $image       = $item['image'] ?? null;
    $description = $item['description'] ?? $item['text'] ?? null;
    $link        = $item['link'] ?? null;
    $delay       = min($index * 90, 400);

    // Break the uniform grid: cycle image size/shape and alternate a subtle tilt per item.
    $sizeVariants = [
        ['width' => 'xl:w-[420px]', 'aspect' => 'aspect-[4/3]'],
        ['width' => 'xl:w-[480px]', 'aspect' => 'aspect-square'],
        ['width' => 'xl:w-[360px]', 'aspect' => 'aspect-[3/4]'],
    ];
    $variant = $sizeVariants[$index % 3];
    $tilt = $index % 2 === 0 ? '-rotate-2' : 'rotate-2';
@endphp

<div class="xl:grid xl:grid-cols-2 xl:gap-16 xl:items-center">
    @if($image)
    <div class="relative w-full md:w-[320px] {{ $variant['width'] }} mx-auto {{ $isLeft ? 'xl:order-1 xl:ml-auto xl:mr-0' : 'xl:order-2 xl:mr-auto xl:ml-0' }}"
         data-reveal="scale" style="--reveal-delay: {{ $delay }}">
        <div class="w-full {{ $variant['aspect'] }} overflow-hidden border-[6px] border-white rounded-[4px] shadow-lg {{ $tilt }} transition-all duration-300 hover:shadow-2xl hover:rotate-0">
            <img src="{{ $image }}" alt="{{ $title ?? 'Historical photo' }}"
                 class="w-full h-full object-cover transition-transform duration-300 hover:scale-[1.03]">
        </div>

        @if($year)
        <div class="absolute -bottom-6 {{ $isLeft ? 'right-6' : 'left-6' }} w-[78px] h-[78px] rounded-full bg-[#C89B4D] border-[5px] border-white shadow-lg flex items-center justify-center"
             data-reveal="scale" style="--reveal-delay: {{ $delay + 160 }}">
            <span class="text-[24px] font-bold text-black leading-none">{{ $year }}</span>
        </div>
        @endif
    </div>
    @endif

    <div class="max-w-[460px] mx-auto text-center mt-5 xl:mt-0 {{ $isLeft ? 'xl:order-2' : 'xl:order-1' }}"
         data-reveal style="--reveal-delay: {{ $delay + 40 }}">
        @if($title)
        <h3 class="font-serif text-[36px] font-bold text-[#1F2A44] leading-tight mb-[14px]">{{ $title }}</h3>
        @endif

        @if($description)
        <p class="text-lg leading-[1.8] text-[#5E6778] mb-6">{{ $description }}</p>
        @endif

        @if($link)
        <x-learn-more-button :href="$link">Learn More</x-learn-more-button>
        @endif
    </div>
</div>
