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
@endphp

<div class="bg-white rounded-lg shadow-md overflow-hidden w-full mx-auto md:mx-0 md:max-w-md {{ $isLeft ? 'md:ml-auto md:mr-0' : 'md:mr-auto md:ml-0' }}"
     data-reveal="scale" style="--reveal-delay: {{ $delay }}">
    @if($image)
    <div class="relative w-full">
        <div class="w-full aspect-[4/3] overflow-hidden bg-gray-100">
            <img src="{{ $image }}" alt="{{ $title ?? ($year ? 'Historical photo, '.$year : 'Historical photo') }}"
                 class="w-full h-full object-cover">
        </div>

        @if($year)
        <div class="absolute top-0 inset-x-0 bg-[#1d4e7a]/90 px-4 py-2">
            <span class="block text-white font-bold text-sm tracking-wide {{ $isLeft ? 'text-right' : 'text-left' }}">{{ $year }}</span>
        </div>
        @endif
    </div>
    @endif

    <div class="pt-5 pb-5 px-5">
        @if($title)
        <h3 class="font-serif text-xl font-bold text-[#1F2A44] mb-2">{{ $title }}</h3>
        @endif

        @if($description)
        <p class="text-gray-600 text-sm leading-relaxed">{{ $description }}</p>
        @endif

        @if($link)
        <div class="mt-4">
            <x-learn-more-button :href="$link">Learn More</x-learn-more-button>
        </div>
        @endif
    </div>
</div>
