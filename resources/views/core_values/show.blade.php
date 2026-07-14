@extends('layouts.app')

@section('title', $value->title . ' — Our Values | Krousar Thmey')
@section('description', $value->description ?? 'Learn about Krousar Thmey\'s core values and mission.')

@section('content')

@php
$heroSlides = \App\Models\PresentationSlide::active()->get();
@endphp

{{-- Hero Section with Slideshow --}}
<section class="relative h-[90vh] min-h-[520px] max-h-[800px] overflow-hidden"
    x-data="{
            current: 0,
            total: {{ max($heroSlides->count(), 1) }},
            timer: null,
            start() {
                if (this.total <= 1) return;
                this.timer = setInterval(() => {
                    this.current = (this.current + 1) % this.total;
                }, 5500);
            },
            go(i) {
                this.current = i;
                clearInterval(this.timer);
                this.start();
            }
         }"
    x-init="start()">

    @forelse($heroSlides as $slide)
    {{-- Slide {{ $loop->iteration }} --}}
    <div class="absolute inset-0 transition-opacity duration-1000"
        :class="current === {{ $loop->index }} ? 'opacity-100 z-10' : 'opacity-0 z-0'">
        <div class="absolute inset-0 bg-gradient-to-r from-[#0f2448]/85 via-[#0f2448]/60 to-transparent z-10"></div>
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: url('{{ $slide->image_url }}')"></div>
        <div class="relative z-20 h-full flex items-center">
            <div class="max-w-7xl mx-auto px-6 w-full">
                <div class="max-w-2xl"
                    x-show="current === {{ $loop->index }}"
                    x-transition:enter="transition ease-out duration-700 delay-300"
                    x-transition:enter-start="opacity-0 translate-y-8"
                    x-transition:enter-end="opacity-100 translate-y-0">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                        {{ $value->title }}
                    </h1>
                    @if($value->headline)
                    <p class="text-white/80 text-lg mb-8 leading-relaxed">{{ $value->headline }}</p>
                    @endif
                    @if($value->description)
                    <p class="text-white/60 text-sm bg-white/10 px-3 py-1 rounded-full inline-block">
                        {{ $value->description }}
                    </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @empty
    {{-- Fallback static hero --}}
    <div class="absolute inset-0 transition-opacity duration-1000 opacity-100 z-10">
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-black/20 to-black/60 z-10"></div>
        <div class="absolute inset-0">
            @php
            $heroImage = $settings['hero_image'] ?? null;
            $heroImageUrl = $heroImage ? (str_starts_with($heroImage, 'http') ? $heroImage : asset('storage/' . $heroImage)) : asset('images/children-hero.jpg');
            @endphp
            <img src="{{ $heroImageUrl }}" alt="Cambodian children" 
                 class="w-full h-full object-cover">
        </div>
        <div class="relative z-20 h-full flex items-center">
            <div class="max-w-4xl mx-auto px-6 w-full">
                <h1 class="text-6xl md:text-7xl lg:text-8xl font-bold text-white mb-6 tracking-tight">
                    {{ $value->title }}
                </h1>
                @if($value->headline)
                <p class="text-2xl md:text-3xl text-white/90 font-medium mb-4">
                    {{ $value->headline }}
                </p>
                @endif
                @if($value->description)
                <p class="text-lg text-white/70 max-w-2xl">
                    {{ $value->description }}
                </p>
                @endif
            </div>
        </div>
    </div>
    @endforelse

    {{-- Dot controls (only shown when multiple slides) --}}
    @if($heroSlides->count() > 1)
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-30 flex items-center gap-6">
        <template x-for="i in total" :key="i">
            <button @click="go(i - 1)"
                class="transition-all duration-300 rounded-full"
                :class="current === i - 1 ? 'w-8 h-3 bg-[#e8a020]' : 'w-3 h-3 bg-white/50 hover:bg-white/80'"
                :aria-label="'Go to slide ' + i">
            </button>
        </template>
    </div>

    <button @click="go((current - 1 + total) % total)"
        class="absolute left-4 top-1/2 -translate-y-1/2 z-30 w-11 h-11 rounded-full bg-white/20 backdrop-blur-sm text-white flex items-center justify-center hover:bg-white/30 transition-colors" aria-label="Previous">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button @click="go((current + 1) % total)"
        class="absolute right-4 top-1/2 -translate-y-1/2 z-30 w-11 h-11 rounded-full bg-white/20 backdrop-blur-sm text-white flex items-center justify-center hover:bg-white/30 transition-colors" aria-label="Next">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>
    @endif
</section>

{{-- Value Detail Content --}}
<section class="py-24 bg-white">
    <div class="max-w-6xl mx-auto px-6">
        <div class="grid lg:grid-cols-12 gap-12">
            {{-- Icon/Image --}}
            <div class="lg:col-span-4" data-reveal="left">
                <div class="sticky top-24">
                    <div class="bg-white rounded-3xl border border-gray-100 p-10 text-center shadow-xl transform hover:-translate-y-1 transition-transform duration-300">
                        @if($value->image_url)
                        <div class="w-44 h-44 mx-auto mb-6 rounded-2xl overflow-hidden shadow-lg">
                            <img src="{{ $value->image_url }}" alt="{{ $value->title }}" class="w-full h-full object-contain">
                        </div>
                        @else
                        <div class="w-44 h-44 bg-gradient-to-br from-[#2d6fa3]/10 to-[#8da83a]/10 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg">
                            <span class="text-7xl">{{ $value->icon }}</span>
                        </div>
                        @endif
                        <h2 class="text-2xl font-bold text-[#1d4e7a] mb-2">{{ $value->title }}</h2>
                        <div class="w-16 h-1 bg-gradient-to-r from-[#2d6fa3] to-[#8da83a] mx-auto rounded-full"></div>
                    </div>
                </div>
            </div>
            
            {{-- Content --}}
            <div class="lg:col-span-8" data-reveal="right">
                <div class="space-y-10">
                    @if($value->description)
                    <div class="border-l-4 border-[#2d6fa3] pl-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Overview</h3>
                        <p class="text-gray-600 leading-relaxed text-lg">{{ $value->description }}</p>
                    </div>
                    @endif
                    
                    @if($value->supporting_description)
                    <div class="border-l-4 border-[#8da83a] pl-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">Supporting Description</h3>
                        <p class="text-gray-600 leading-relaxed text-lg">{{ $value->supporting_description }}</p>
                    </div>
                    @endif
                </div>
                
                <div class="mt-16 pt-10 border-t border-gray-200">
                    <a href="{{ route('presentation') }}#our-values" class="inline-flex items-center gap-3 text-[#2d6fa3] font-semibold text-lg bg-white px-6 py-3 rounded-full shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Back to All Values
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection