@props([
    'items' => [],
])

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
    @forelse($items as $index => $item)
    @php
        $year        = $item['year'] ?? null;
        $image       = $item['image'] ?? null;
        $title       = $item['title'] ?? null;
        $description = $item['description'] ?? null;
        $buttonText  = $item['buttonText'] ?? null;
        $buttonLink  = $item['buttonLink'] ?? null;
    @endphp
    <article class="bg-white rounded-lg border border-gray-100 p-5 text-center flex flex-col items-center transition-shadow duration-300 hover:shadow-lg"
             data-reveal="scale" style="--reveal-delay: {{ min($index * 80, 400) }}">

        @if($year)
        <x-year-badge :year="$year" size="w-20" :ribbon="true" ring-color="#1F5AB8" text-color="#1F5AB8" class="mx-auto mb-4 transition-transform duration-300 group-hover:scale-110" />
        @endif

        @if($image)
        <div class="w-full h-40 rounded-md overflow-hidden mb-4 bg-white flex items-center justify-center">
            <img src="{{ $image }}" alt="{{ $title }}" class="max-w-full max-h-full object-contain">
        </div>
        @endif

        @if($title)
        <h3 class="font-bold text-gray-900 mb-2">{{ $title }}</h3>
        @endif

        @if($description)
        <p class="text-gray-500 text-sm leading-relaxed line-clamp-4 mb-4">{{ $description }}</p>
        @endif

        @if($buttonText && $buttonLink)
        <a href="{{ $buttonLink }}" target="_blank" rel="noopener"
           class="mt-auto inline-block px-5 py-2 bg-[#0A5EA8] text-white text-sm font-medium rounded-full hover:bg-[#084b87] hover:-translate-y-0.5 transition-all duration-300">
            {{ $buttonText }}
        </a>
        @endif
    </article>
    @empty
    <p class="text-gray-400 text-center py-8 col-span-full">No awards yet.</p>
    @endforelse
</div>
