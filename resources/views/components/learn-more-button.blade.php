@props([
    'href' => '#',
])

<a href="{{ $href }}"
   class="inline-flex items-center justify-center gap-1.5 h-[46px] px-[30px] rounded-lg border border-[#D4A44F] bg-white text-[#C89B4D] font-semibold text-sm transition-colors duration-300 hover:bg-[#C89B4D] hover:text-white">
    {{ $slot->isEmpty() ? 'Learn More' : $slot }}
    <span aria-hidden="true">&rarr;</span>
</a>
