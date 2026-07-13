@extends('layouts.app')

@section('title', 'Presentation — Krousar Thmey')
@section('description', 'Krousar Thmey is the first Cambodian organization helping disadvantaged children, born in 1991 in the Site II refugee camp in Thailand.')

@section('content')

{{-- ========================================================
     HERO CAROUSEL (Like Homepage)
     ======================================================== --}}
@php
$heroSlides = \App\Models\PresentationSlide::active()->get();
@endphp
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
                    @if($slide->badge_text)
                    <span class="inline-block bg-[#e8a020] text-white text-xs font-semibold px-4 py-1.5 rounded-full mb-5 uppercase tracking-wider">{{ $slide->badge_text }}</span>
                    @endif
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                        {!! nl2br(e($slide->title)) !!}
                    </h1>
                    @if($slide->subtitle)
                    <p class="text-white/80 text-lg mb-8 leading-relaxed">{{ $slide->subtitle }}</p>
                    @endif

                    @if($slide->cta_primary_text || $slide->cta_secondary_text)
                    <div class="flex flex-wrap gap-6">
                        @if($slide->cta_primary_text)
                        <a href="{{ $slide->cta_primary_url ?? route('donate') }}" class="btn-primary">{{ $slide->cta_primary_text }}</a>
                        @endif
                        @if($slide->cta_secondary_text)
                        <a href="{{ $slide->cta_secondary_url ?? route('donate') }}" class="btn-outline">{{ $slide->cta_secondary_text }}</a>
                        @endif
                    </div>
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
            <div class="max-w-4xl mx-auto px-6 text-center">
                <h1 class="text-6xl md:text-7xl lg:text-8xl font-bold text-white mb-6 tracking-tight">
                    {{ $settings['hero_title'] ?? 'KROUSAR THMEY' }}
                </h1>
                <p class="text-2xl md:text-3xl text-white/90 font-medium mb-4">
                    {{ $settings['hero_subtitle'] ?? 'The First Cambodian Organization Helping Disadvantaged Children' }}
                </p>
                <p class="text-lg text-white/70 mb-10 max-w-2xl mx-auto">
                    {{ $settings['hero_description'] ?? 'Born in 1991 in the Site II Refugee Camp in Thailand.' }}
                </p>
                
                <div class="flex items-center justify-center gap-4 mb-10">
                    <div class="w-16 h-px bg-[#d4af37]"></div>
                    <div class="w-3 h-3 rounded-full bg-[#d4af37]"></div>
                    <div class="w-16 h-px bg-[#d4af37]"></div>
                </div>
                
                <a href="#who-we-are" 
                   class="inline-flex items-center gap-3 px-8 py-4 bg-[#2d6fa3] text-white font-semibold rounded-full hover:bg-[#1d4e7a] transition-all transform hover:scale-105 shadow-lg">
                    Discover Our Mission
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                </a>
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

{{-- ========================================================
     WHO WE ARE SECTION
     ======================================================== --}}
<section id="who-we-are" class="py-24 bg-[#f8f5f0] scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Left: Image --}}
            <div class="relative" data-reveal="left">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                    @php
                    $aboutImage = $settings['about_image'] ?? null;
                    $aboutImageUrl = $aboutImage ? (str_starts_with($aboutImage, 'http') ? $aboutImage : asset('storage/' . $aboutImage)) : asset('images/children-community.jpg');
                    @endphp
                    <img src="{{ $aboutImageUrl }}" alt="Cambodian children and community" 
                         class="w-full h-[500px] object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>
                {{-- Khmer pattern decoration --}}
                <div class="absolute -top-6 -right-6 w-24 h-24 opacity-10">
                    <svg viewBox="0 0 100 100" class="w-full h-full text-[#d4af37]"><path d="M50,0 L61,35 L98,35 L68,57 L79,92 L50,70 L21,92 L32,57 L2,35 L39,35 Z" fill="currentColor"/></svg>
                </div>
            </div>
            
            {{-- Right: Content --}}
            <div data-reveal="right">
                <h2 class="text-4xl md:text-5xl font-bold text-[#1d4e7a] mb-6">{{ $settings['about_title'] ?? 'Who We Are' }}</h2>
                <p class="text-lg text-gray-600 leading-relaxed mb-8">
                    {{ $settings['about_description'] ?? 'Krousar Thmey supports disadvantaged children through sustainable projects focused on child welfare, education, culture, inclusion, and health. The organization develops projects led by Cambodians for Cambodians.' }}
                </p>
                
                {{-- Statistics badge --}}
                <div class="inline-flex items-center gap-3 bg-white rounded-full px-6 py-3 shadow-md">
                    <span class="w-3 h-3 rounded-full bg-[#8da83a] animate-pulse"></span>
                    <span class="text-sm font-semibold text-gray-700">Supporting <span class="text-[#2d6fa3]">{{ $settings['stat_children'] ?? '4,079' }} children</span> across 15 provinces</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================
     OUR VALUES SECTION
     ======================================================== --}}
<section class="py-24 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16" data-reveal>
            <h2 class="text-4xl md:text-5xl font-bold text-[#1d4e7a] mb-4">Our Values</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">The principles that guide everything we do, ensuring every child has the opportunity to grow, belong, and thrive.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse($coreValues as $i => $value)
            <div class="group bg-white rounded-2xl border border-gray-100 shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-350 overflow-hidden"
                 data-reveal="up" style="--reveal-delay: {{ $i * 100 }}">
                {{-- Image --}}
                <div class="relative h-48 overflow-hidden">
                    @if($value->image_url)
                    <img src="{{ $value->image_url }}" alt="{{ $value->title }}" 
                         class="w-full h-full object-cover transition-transform duration-350 group-hover:scale-110">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-[#2d6fa3]/10 to-[#8da83a]/10 flex items-center justify-center">
                        <span class="text-6xl">{{ $value->icon }}</span>
                    </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>
                
                {{-- Content --}}
                <div class="p-6">
                    <h3 class="text-xl font-bold text-[#1d4e7a] mb-2 uppercase tracking-wide">{{ $value->title }}</h3>
                    <p class="text-lg font-semibold text-[#2d6fa3] mb-3">
                        {{ $value->headline ?? ($value->description ? $value->description : 'Making a difference.') }}
                    </p>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ $value->description }}
                    </p>
                </div>
            </div>
            @empty
            <p class="text-gray-400 text-center py-8 md:col-span-3">No values listed yet.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ========================================================
     OUR PROGRAMS SECTION
     ======================================================== --}}
<section class="py-24 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16" data-reveal>
            <h2 class="text-4xl md:text-5xl font-bold text-[#1d4e7a] mb-4">Our Programs</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">Five comprehensive programs dedicated to helping children across Cambodia learn, grow, stay healthy, and build brighter futures.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse($programs as $i => $program)
            <div class="card group flex flex-col"
                 data-reveal="up" style="--reveal-delay: {{ $i * 100 }}">
                <div class="relative overflow-hidden h-56">
                    <img src="{{ $program->image_url }}"
                         alt="{{ $program->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0f2448]/70 to-transparent"></div>
                </div>

                {{-- Content --}}
                <div class="p-6 flex flex-col flex-1">
                    <h3 class="text-xl font-bold text-[#1a3c6e] mb-3">{{ $program->title }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-5 line-clamp-3">
                        {{ $program->description ?? 'Program description coming soon.' }}
                    </p>
                    <a href="{{ route('programs') }}#{{ $program->slug }}" class="mt-auto text-[#1a3c6e] font-semibold text-sm flex items-center gap-2 hover:text-[#e8a020] transition-colors group-hover:gap-3 duration-300">
                        Learn More
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
            @empty
            <p class="text-gray-400 text-center py-8 md:col-span-3">No programs listed yet.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ========================================================
     IMPACT / KEY FIGURES SECTION
     ======================================================== --}}
<section class="py-24 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16" data-reveal>
            <h2 class="text-4xl md:text-5xl font-bold text-[#1d4e7a] mb-4">Our Impact</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">The difference we make together for Cambodia's children</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
            @php
            $figures = [
                ['n' => $settings['stat_children'] ?? '4,079', 'label' => 'Children Supported', 'color' => 'text-[#2d6fa3]'],
                ['n' => $settings['stat_welfare'] ?? '240', 'label' => 'Child Welfare Program', 'color' => 'text-[#8da83a]'],
                ['n' => $settings['stat_special_ed'] ?? '768', 'label' => 'Special Education Students', 'color' => 'text-[#1d4e7a]'],
                ['n' => $settings['stat_2025'] ?? '3,526', 'label' => 'Children in 2025', 'color' => 'text-[#d4af37]'],
                ['n' => $settings['stat_arts'] ?? '1,088', 'label' => 'Arts & Culture Students', 'color' => 'text-[#2d6fa3]'],
                ['n' => $settings['stat_counseling'] ?? '357', 'label' => 'Career Counseling', 'color' => 'text-[#8da83a]'],
                ['n' => $settings['stat_employees'] ?? '68', 'label' => 'Employees', 'color' => 'text-[#1d4e7a]'],
                ['n' => $settings['stat_budget'] ?? '950K', 'label' => 'Annual Budget (USD)', 'color' => 'text-[#d4af37]'],
                ['n' => $settings['stat_admin'] ?? '< 4%', 'label' => 'Administrative Costs', 'color' => 'text-[#2d6fa3]'],
            ];
            @endphp
            
            @foreach($figures as $i => $fig)
            <div class="bg-[#f8f5f0] rounded-2xl p-6 text-center border border-gray-100 hover:border-[#2d6fa3]/20 transition-all"
                 data-reveal="scale" style="--reveal-delay: {{ min($i * 60, 300) }}">
                <div class="text-3xl lg:text-4xl font-black {{ $fig['color'] }} mb-2">{{ $fig['n'] }}</div>
                <div class="text-gray-500 text-xs leading-snug">{{ $fig['label'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========================================================
     OUR PRINCIPLE SECTION
     ======================================================== --}}
<section class="py-24 relative overflow-hidden">
    <div class="absolute inset-0">
        @php
        $principleImage = $settings['principle_image'] ?? null;
        $principleImageUrl = $principleImage ? (str_starts_with($principleImage, 'http') ? $principleImage : asset('storage/' . $principleImage)) : asset('images/community-work.jpg');
        @endphp
        <img src="{{ $principleImageUrl }}" alt="Cambodian community" 
             class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-b from-black/50 to-black/70"></div>
    </div>
    
    <div class="relative z-10 max-w-4xl mx-auto px-6 text-center" data-reveal="scale">
        <h2 class="text-3xl md:text-4xl font-bold text-white mb-10">{{ $settings['principle_title'] ?? 'Our Principle' }}</h2>
        
        <div class="relative">
            <svg class="w-16 h-16 text-[#d4af37] mx-auto mb-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-4.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069z"/></svg>
            
            <blockquote class="text-2xl md:text-3xl lg:text-4xl font-serif italic text-white leading-relaxed">
                "{{ $settings['principle_quote'] ?? "Krousar Thmey's main principle is the development of projects led by Cambodians for Cambodians." }}"
            </blockquote>
        </div>
    </div>
</section>

{{-- ========================================================
     KROUSAR THMEY WORLDWIDE SECTION
     ======================================================== --}}
<section class="py-24 bg-[#f8f5f0] scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16" data-reveal>
            <h2 class="text-4xl md:text-5xl font-bold text-[#1d4e7a] mb-4">Krousar Thmey Worldwide</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">International partnerships supporting our mission</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse($offices as $woffice)
            <div class="bg-white rounded-2xl p-8 text-center border border-gray-100 shadow-md hover:shadow-xl transition-all"
                 data-reveal="up" style="--reveal-delay: {{ $loop->index * 100 }}">
                <div class="w-16 h-16 rounded-full bg-gradient-to-br from-[#2d6fa3] to-[#1d4e7a] flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">{{ $woffice->flag }}</span>
                </div>
                <h3 class="font-bold text-gray-800 text-lg mb-2">Krousar Thmey {{ $woffice->country }}</h3>
                <p class="text-gray-500 text-sm">{{ $woffice->city }}, {{ $woffice->country }}</p>
            </div>
            @empty
            <div class="col-span-3 text-center text-gray-400 py-8">
                <p>Office information coming soon.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection