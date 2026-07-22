@props([
    'items' => [],
])

@php
    $perSlide = 4;
    $slides = collect($items)->values()->chunk($perSlide)->values();
@endphp

@if($slides->isEmpty())
<p class="text-center text-gray-400 py-8">No history events yet.</p>
@else
<div class="p-4 sm:p-8 lg:p-[50px]" x-data="{ slide: 0, total: {{ $slides->count() }} }">
    <div class="flex items-center gap-2 sm:gap-3 md:gap-6">
        {{-- Prev --}}
        <button type="button" @click="slide = Math.max(0, slide - 1)" x-show="slide > 0" x-cloak
                class="group hidden md:flex flex-shrink-0 self-center w-10 h-10 lg:w-12 lg:h-12 rounded-full border border-gray-300 bg-white items-center justify-center text-gray-500 hover:text-[#1d4e7a] hover:border-[#1d4e7a] hover:shadow-md hover:scale-110 active:scale-95 transition-all shadow-sm"
                aria-label="Previous">
            <svg class="w-4 h-4 lg:w-5 lg:h-5 transition-transform duration-200 group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>

        {{-- Viewport --}}
        <div class="overflow-hidden flex-1 min-w-0">
            <div class="flex transition-transform duration-500 ease-out" :style="`transform: translateX(-${slide * 100}%)`">
                @foreach($slides as $slideItems)
                <div class="w-full flex-shrink-0">
                    <div class="relative grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-4 sm:gap-x-6 gap-y-10 sm:gap-y-12 lg:gap-y-0 px-2">
                        {{-- Dashed connector spanning this slide, centered on the year/dot row --}}
                        <div class="hidden lg:block absolute left-0 right-0 top-[252px] border-t-2 border-dashed border-gray-300" aria-hidden="true"></div>

                        @foreach($slideItems as $i => $item)
                        @php
                            $globalIndex = $loop->parent->index * $perSlide + $i;
                            $photoTop = $globalIndex % 2 !== 0;
                            $year = $item['year'] ?? null;
                            $text = $item['text'] ?? null;
                            $image = $item['image'] ?? null;
                        @endphp
                        <div class="relative flex flex-col items-center" data-reveal="up" style="--reveal-delay: {{ min($i * 100, 200) }}">
                            {{-- Top slot --}}
                            <div class="order-2 lg:order-1 relative z-10 flex flex-col justify-end items-center h-auto lg:h-56 pb-4 lg:pb-0 text-center px-3">
                                @if($photoTop)
                                    @if($image)
                                    <img src="{{ $image }}" alt="{{ $year }}" class="w-28 h-28 sm:w-36 sm:h-36 lg:w-56 lg:h-100 rounded-2xl object-contain bg-gray-100 shrink-0 transition-all duration-300 hover:scale-105 hover:shadow-lg" onerror="this.remove()">
                                    {{-- Straight connector: photo down to the year dot --}}
                                    <span class="hidden lg:block w-px h-[75px] shrink-0 bg-gray-300" aria-hidden="true"></span>
                                    @endif
                                @else
                                    @if($text)
                                    <p class="text-sm text-gray-700 leading-relaxed line-clamp-5 [&_strong]:text-[#29ABE2] [&_strong]:font-bold">{!! $text !!}</p>
                                    @endif
                                @endif
                            </div>

                            {{-- Year + dot, vertically centered on the dashed line --}}
                            <div class="order-1 lg:order-2 relative z-10 flex flex-col items-center gap-2 h-14 justify-center bg-white px-2">
                                @if($year)
                                <span class="text-xl sm:text-2xl md:text-3xl font-black text-gray-900 leading-none">{{ $year }}</span>
                                @endif
                                <span class="w-3.5 h-3.5 rounded-full bg-white border-[3px] border-[#29ABE2] transition-transform duration-300 hover:scale-125"></span>
                            </div>

                            {{-- Bottom slot --}}
                            <div class="order-3 relative z-10 flex flex-col justify-start items-center h-auto lg:h-56 pt-4 lg:pt-0 text-center px-3">
                                @if($photoTop)
                                    @if($text)
                                    <p class="text-sm text-gray-700 leading-relaxed line-clamp-5 [&_strong]:text-[#29ABE2] [&_strong]:font-bold">{!! $text !!}</p>
                                    @endif
                                @else
                                    @if($image)
                                    {{-- Straight connector: year dot down to the photo --}}
                                    <span class="hidden lg:block w-px h-[75px] shrink-0 bg-gray-300" aria-hidden="true"></span>
                                    <img src="{{ $image }}" alt="{{ $year }}" class="w-28 h-28 sm:w-36 sm:h-36 lg:w-56 lg:h-100 rounded-2xl object-contain bg-gray-100 shrink-0 transition-all duration-300 hover:scale-105 hover:shadow-lg" onerror="this.remove()">
                                    @endif
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Next --}}
        <button type="button" @click="slide = Math.min(total - 1, slide + 1)" x-show="slide < total - 1" x-cloak
                class="group hidden md:flex flex-shrink-0 self-center w-10 h-10 lg:w-12 lg:h-12 rounded-full border border-gray-300 bg-white items-center justify-center text-gray-500 hover:text-[#1d4e7a] hover:border-[#1d4e7a] hover:shadow-md hover:scale-110 active:scale-95 transition-all shadow-sm"
                aria-label="Next">
            <svg class="w-4 h-4 lg:w-5 lg:h-5 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>

    {{-- Slide dots --}}
    @if($slides->count() > 1)
    <div class="flex items-center justify-center gap-2 mt-16 sm:mt-24 lg:mt-[150px]">
        @foreach($slides as $index => $slideItems)
        <button type="button" @click="slide = {{ $index }}"
                class="h-2 rounded-full transition-all duration-300 hover:scale-125"
                :class="slide === {{ $index }} ? 'w-6 bg-[#1d4e7a]' : 'w-2 bg-gray-300'"
                aria-label="Go to slide {{ $index + 1 }}"></button>
        @endforeach
    </div>
    @endif
</div>
@endif
