@props([
    'years' => [],
])

@if(count($years))
<nav aria-label="Jump to year" class="hidden lg:block sticky top-28 self-start w-28 shrink-0">
    <div class="relative bg-gray-50 border border-gray-200 rounded-lg py-2 max-h-[70vh] overflow-y-auto">
        <div class="absolute top-4 bottom-4 right-6 w-px bg-gray-300" aria-hidden="true"></div>
        <ol class="relative list-none pl-0 m-0">
            @foreach($years as $year)
            <li>
                <a href="#year-{{ $year }}" data-year-nav="{{ $year }}"
                   class="year-nav-link relative z-10 flex items-center justify-between gap-3 pl-4 pr-4 py-1.5 text-sm font-semibold text-gray-500 border-l-4 border-transparent transition-colors hover:text-[#1d4e7a]">
                    <span>{{ $year }}</span>
                    <span class="year-nav-dot w-2.5 h-2.5 rounded-full bg-gray-400 ring-4 ring-gray-50 shrink-0"></span>
                </a>
            </li>
            @endforeach
        </ol>
    </div>
</nav>
@endif
