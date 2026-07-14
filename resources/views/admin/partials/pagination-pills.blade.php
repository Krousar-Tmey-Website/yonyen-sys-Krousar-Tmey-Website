@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination" class="flex items-center justify-center gap-2">
        {{-- Prev --}}
        @if ($paginator->onFirstPage())
            <span aria-disabled="true" aria-label="Prev"
                class="inline-flex items-center justify-center h-10 px-4 rounded-full border border-slate-200 text-sm font-medium text-slate-400 opacity-50 cursor-not-allowed select-none">
                <svg class="w-4 h-4 mr-1.5 -ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Prev
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="Prev"
                class="inline-flex items-center justify-center h-10 px-4 rounded-full border border-slate-200 text-sm font-medium text-slate-600 hover:bg-blue-50 hover:border-blue-200 hover:text-[#1d4e7a] transition-all duration-200">
                <svg class="w-4 h-4 mr-1.5 -ml-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Prev
            </a>
        @endif

        {{-- Page numbers --}}
        @foreach ($elements as $element)
            {{-- Ellipsis "..." separator --}}
            @if (is_string($element))
                <span aria-disabled="true"
                    class="inline-flex items-center justify-center min-w-[40px] h-10 px-2 rounded-full text-sm font-medium text-slate-400 select-none">
                    {{ $element }}
                </span>
            @endif

            {{-- Page links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span aria-current="page" aria-label="Page {{ $page }}"
                            class="inline-flex items-center justify-center min-w-[40px] h-10 px-3 rounded-full border border-blue-200 bg-blue-50 text-sm font-semibold text-[#1d4e7a] select-none shadow-sm">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" aria-label="Go to page {{ $page }}"
                            class="inline-flex items-center justify-center min-w-[40px] h-10 px-3 rounded-full border border-slate-200 text-sm font-medium text-slate-600 hover:bg-blue-50 hover:border-blue-200 hover:text-[#1d4e7a] transition-all duration-200">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next"
                class="inline-flex items-center justify-center h-10 px-4 rounded-full border border-slate-200 text-sm font-medium text-slate-600 hover:bg-blue-50 hover:border-blue-200 hover:text-[#1d4e7a] transition-all duration-200">
                Next
                <svg class="w-4 h-4 ml-1.5 -mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        @else
            <span aria-disabled="true" aria-label="Next"
                class="inline-flex items-center justify-center h-10 px-4 rounded-full border border-slate-200 text-sm font-medium text-slate-400 opacity-50 cursor-not-allowed select-none">
                Next
                <svg class="w-4 h-4 ml-1.5 -mr-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        @endif
    </nav>
@endif
