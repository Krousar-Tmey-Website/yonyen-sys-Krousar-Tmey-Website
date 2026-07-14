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
            <p class="text-gray-500 max-w-2xl mx-auto">
                {{ \App\Models\HomeSetting::getValue('values_supporting_description', 'The principles that guide everything we do, ensuring every child has the opportunity to grow, belong, and thrive.') }}
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse($coreValues as $i => $value)
            <a href="{{ route('core-values.show', $value) }}" class="group bg-white rounded-2xl border border-gray-100 shadow-md hover:shadow-xl hover:-translate-y-2 transition-all duration-350 overflow-hidden block"
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
                    @if($value->supporting_description)
                    <p class="text-gray-500 text-xs mt-2 line-clamp-2">{{ $value->supporting_description }}</p>
                    @endif
                </div>
            </a>
            @empty
            <p class="text-gray-400 text-center py-8 md:col-span-3">No values listed yet.</p>
            @endforelse
        </div>
    </div>
</section>

{{-- ========================================================
     OUR IMPACT SECTION
     ======================================================== --}}
<section class="py-24 bg-white scroll-mt-20 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16" data-reveal>
            <h2 class="text-4xl md:text-5xl font-bold text-[#1d4e7a] mb-4">Our Impact</h2>
            <p class="text-gray-500 max-w-2xl mx-auto">The difference we make together for Cambodia's children</p>
        </div>

        {{-- Statistics Grid - Featured card spans 2 columns on desktop --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">

            @php
                $featuredStat = $impactStatistics->where('is_featured', true)->first();
                $otherStats = $impactStatistics->where('is_featured', false);
            @endphp

            @if($featuredStat)
            {{-- Featured Hero Card --}}
            <div class="impact-card group relative rounded-3xl overflow-hidden shadow-xl cursor-pointer"
                 data-reveal="up" style="--reveal-delay: 0; background-image: url('{{ $featuredStat->image_url }}')">
                <div class="absolute inset-0 bg-black/40"></div>
                <div class="relative z-10 p-8 h-full flex flex-col justify-between">
                    <div>
                        <div class="text-5xl sm:text-6xl md:text-7xl font-black text-white mb-3 counter"
                             data-target="{{ preg_replace('/[^0-9]/', '', $featuredStat->value) }}">
                            {{ $featuredStat->value }}
                        </div>
                    </div>
                    <p class="text-white/90 text-lg font-semibold leading-tight">
                        {{ $featuredStat->label }}
                    </p>
                </div>
            </div>
            @endif

            @forelse($otherStats as $index => $stat)
            @php
                $format = 'plain';
                if (str_contains($stat->value, 'K')) $format = 'k';
                if (str_starts_with($stat->value, '<')) $format = 'less-than-percent';
            @endphp
            
            <div class="impact-card-small group relative rounded-2xl overflow-hidden shadow-md cursor-pointer"
                 data-reveal="up" style="--reveal-delay: {{ ($index + 1) * 100 }}; background-image: url('{{ $stat->image_url }}')">
                <div class="absolute inset-0 bg-black/40"></div>
                <div class="relative z-10 p-6 h-full flex flex-col justify-end">
                    <div>
                        <div class="text-3xl md:text-4xl font-black text-white mb-2 counter"
                             data-target="{{ preg_replace('/[^0-9]/', '', $stat->value) }}"
                             data-format="{{ $format }}">
                            @if($format === 'less-than-percent')
                            <span class="text-[#e8a020]"><</span> {{ preg_replace('/[^0-9]/', '', $stat->value) }}%
                            @elseif($format === 'k')
                            {{ $stat->value }}
                            @else
                            {{ $stat->value }}
                            @endif
                        </div>
                        <p class="text-white/90 text-sm font-semibold leading-tight">
                            {{ $stat->label }}
                        </p>
                    </div>
                </div>
            </div>
            @empty
            <p class="text-gray-400 text-center py-8 col-span-full">No impact statistics available yet.</p>
            @endforelse

        </div>
    </div>
</section>

{{-- Social Sharing --}}
@php
$sharingEnabled = \App\Models\HomeSetting::getValue('sharing_enabled', '1');
$facebookIcon = \App\Models\HomeSetting::getValue('sharing_facebook_icon', 'images/social/facebook.svg');
$twitterIcon = \App\Models\HomeSetting::getValue('sharing_twitter_icon', 'images/social/twitter.svg');
$linkedinIcon = \App\Models\HomeSetting::getValue('sharing_linkedin_icon', 'images/social/linkedin.svg');
$shareIcon = \App\Models\HomeSetting::getValue('sharing_share_icon', 'images/social/share.svg');
$facebookLink = \App\Models\HomeSetting::getValue('sharing_facebook_link', '');
$twitterLink = \App\Models\HomeSetting::getValue('sharing_twitter_link', '');
$linkedinLink = \App\Models\HomeSetting::getValue('sharing_linkedin_link', '');
@endphp
@if($sharingEnabled == '1')
<div class="max-w-7xl mx-auto px-6 pb-12" data-reveal>
    <div class="flex items-center justify-center gap-4">
        <div class="flex flex-wrap items-center justify-center gap-4 mt-8">

<div class="flex items-center gap-3 bg-white/80 backdrop-blur-md rounded-full px-6 py-4 shadow-lg border border-gray-100">

    <!-- Facebook -->
    <a href="{{ $facebookLink ?: 'https://www.addtoany.com/add_to/facebook?linkurl=' . urlencode(url()->current()) . '&linkname=' . urlencode('Presentation') . '&linknote=' . urlencode('Krousar Thmey - Our Impact') }}"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Share on Facebook"
        class="group w-14 h-14 rounded-full bg-[#1877F2] flex items-center justify-center shadow-md transition duration-300 hover:-translate-y-1 hover:scale-110 hover:shadow-xl">

        <img src="{{ asset($facebookIcon) }}"
            alt="Facebook"
            class="w-6 h-6 brightness-0 invert transition-transform duration-300 group-hover:scale-110">
    </a>

    <!-- Twitter -->
    <a href="{{ $twitterLink ?: 'https://www.addtoany.com/add_to/twitter?linkurl=' . urlencode(url()->current()) . '&linkname=' . urlencode('Presentation') . '&linknote=' . urlencode('Krousar Thmey - Our Impact') }}"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Share on Twitter"
        class="group w-14 h-14 rounded-full bg-[#1DA1F2] flex items-center justify-center shadow-md transition duration-300 hover:-translate-y-1 hover:scale-110 hover:shadow-xl">

        <img src="{{ asset($twitterIcon) }}"
            alt="Twitter"
            class="w-6 h-6 brightness-0 invert transition-transform duration-300 group-hover:scale-110">
    </a>

    <!-- LinkedIn -->
    <a href="{{ $linkedinLink ?: 'https://www.addtoany.com/add_to/linkedin?linkurl=' . urlencode(url()->current()) . '&linkname=' . urlencode('Presentation') . '&linknote=' . urlencode('Krousar Thmey - Our Impact') }}"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Share on LinkedIn"
        class="group w-14 h-14 rounded-full bg-[#0A66C2] flex items-center justify-center shadow-md transition duration-300 hover:-translate-y-1 hover:scale-110 hover:shadow-xl">

        <img src="{{ asset($linkedinIcon) }}"
            alt="LinkedIn"
            class="w-6 h-6 brightness-0 invert transition-transform duration-300 group-hover:scale-110">
    </a>

    <!-- Share -->
    <a href="https://www.addtoany.com/share#url={{ urlencode(url()->current()) }}&title={{ urlencode('Presentation') }}"
        target="_blank"
        rel="noopener noreferrer"
        aria-label="Share"
        class="group w-14 h-14 rounded-full bg-gray-700 flex items-center justify-center shadow-md transition duration-300 hover:-translate-y-1 hover:scale-110 hover:shadow-xl">

        <img src="{{ asset($shareIcon) }}"
            alt="Share"
            class="w-6 h-6 brightness-0 invert transition-transform duration-300 group-hover:scale-110">
    </a>

</div>
</div>
</div>
@endif

{{-- Impact Animation Script --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // ── Animated Number Counter ───────────────────────────────
        const counters = document.querySelectorAll(".counter");

        const countObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = +counter.dataset.target;
                    const format = counter.dataset.format || 'plain';

                    let start = 0;
                    const duration = 2000;
                    const startTime = performance.now();

                    const updateCount = (currentTime) => {
                        const elapsed = currentTime - startTime;
                        const progress = Math.min(elapsed / duration, 1);
                        const easeProgress = 1 - Math.pow(1 - progress, 3);

                        let current = Math.floor(start + (target - start) * easeProgress);

                        if (format === 'k') {
                            counter.innerText = current.toLocaleString() + 'K USD';
                        } else if (format === 'percent') {
                            counter.innerText = current + '%';
                        } else if (format === 'less-than-percent') {
                            counter.innerHTML = '<span class="text-[#e8a020]"><</span> ' + current + '%';
                        } else {
                            counter.innerText = current.toLocaleString();
                        }

                        if (progress < 1) {
                            requestAnimationFrame(updateCount);
                        }
                    };

                    requestAnimationFrame(updateCount);
                    countObserver.unobserve(counter);
                }
            });
        }, { threshold: 0.3 });

        counters.forEach(counter => countObserver.observe(counter));

        // ── Scroll reveal for impact cards ─────────────────────────
        const impactCards = document.querySelectorAll("[data-reveal]");
        const cardObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-revealed");
                    cardObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        impactCards.forEach(card => cardObserver.observe(card));
    });
</script>

{{-- ========================================================
     KROUSAR THMEY WORLDWIDE SECTION
     ======================================================== --}}
<section class="py-24 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        {{-- Section Header --}}
        <div class="text-center mb-16" data-reveal>
            <span class="inline-block text-xs font-semibold text-[#2d6fa3] uppercase tracking-wider mb-3">GLOBAL NETWORK</span>
            <h2 class="text-4xl md:text-5xl font-bold text-[#1d4e7a] mb-4">Krousar Thmey Worldwide</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Krousar Thmey benefits from the support of partner organizations around the world.
                Through fundraising, advocacy, volunteer engagement, and international cooperation, these organizations help transform the lives of Cambodian children and young people.
            </p>
        </div>

        {{-- Country Cards Grid --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @forelse($worldwidePartners as $partner)
            <div class="group bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2"
                 data-reveal="up" style="--reveal-delay: {{ $loop->index * 100 }}">
                {{-- Large Country Image --}}
                <div class="relative aspect-video overflow-hidden">
                    <img src="{{ $partner->image_url }}" alt="{{ $partner->country_name }}" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-108"
                         loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                </div>
                
                {{-- Card Content --}}
                <div class="p-6">
                    <h3 class="text-xl font-bold text-[#1d4e7a] mb-2">{{ $partner->country_name }}</h3>
                    <span class="inline-block bg-[#e8a020]/10 text-[#e8a020] text-xs font-semibold px-3 py-1 rounded-full mb-3">
                        Supporting Cambodia Since 1991
                    </span>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4 line-clamp-3">
                        {{ $partner->description ?? 'Supports fundraising, strategic partnerships, and awareness campaigns that strengthen education and child welfare initiatives.' }}
                    </p>
                    <a href="{{ $partner->learn_more_url ?? '#' }}" 
                       class="inline-flex items-center gap-2 text-[#2d6fa3] font-semibold text-sm border border-[#2d6fa3] bg-white rounded-full px-4 py-2 hover:bg-[#2d6fa3] hover:text-white transition-all duration-300">
                        {{ $partner->button_text ?? 'Learn More' }}
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center text-gray-400 py-8">
                <p>Country partner information coming soon.</p>
            </div>
            @endforelse
        </div>

        {{-- CTA Section --}}
        <div class="text-center mt-20" data-reveal="up" style="--reveal-delay: 300">
            <h3 class="text-2xl font-bold text-[#1d4e7a] mb-4">Together Across Borders</h3>
            <p class="text-gray-600 max-w-2xl mx-auto mb-8">
                Our international partners work together to create brighter futures for Cambodian children through education, inclusion, child protection, and community development.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}" 
                   class="inline-flex items-center gap-2 px-8 py-3 bg-gradient-to-r from-[#2d6fa3] to-[#1d4e7a] text-white font-semibold rounded-full hover:from-[#1d4e7a] hover:to-[#2d6fa3] transition-all transform hover:scale-105 shadow-lg">
                    Become a Global Partner
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </a>
                <a href="{{ route('contact') }}" 
                   class="inline-flex items-center gap-2 px-8 py-3 border-2 border-[#2d6fa3] text-[#2d6fa3] font-semibold rounded-full hover:bg-[#2d6fa3] hover:text-white transition-all">
                    Contact Us
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ========================================================
     OUR PRINCIPLE SECTION
     ======================================================== --}}
@php
$principleSlides = \App\Models\PrincipleSlide::active()->get();
@endphp
<section class="relative h-screen min-h-screen overflow-hidden"
    x-data="{
            current: 0,
            total: {{ max($principleSlides->count(), 1) }},
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

    @forelse($principleSlides as $slide)
    {{-- Slide {{ $loop->iteration }} --}}
    <div class="absolute inset-0 transition-opacity duration-1000"
        :class="current === {{ $loop->index }} ? 'opacity-100 z-10' : 'opacity-0 z-0'">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="absolute inset-0 bg-cover bg-center bg-fixed" style="background-image: url('{{ $slide->image_url }}')"></div>
    </div>
    @empty
    {{-- Fallback static image --}}
    <div class="absolute inset-0 transition-opacity duration-1000 opacity-100 z-10">
        <div class="absolute inset-0 bg-black/60"></div>
        @php
        $principleImage = $settings['principle_image'] ?? null;
        $principleImageUrl = $principleImage ? (str_starts_with($principleImage, 'http') ? $principleImage : asset('storage/' . $principleImage)) : asset('images/children.jpg');
        @endphp
        <div class="absolute inset-0 bg-cover bg-center bg-fixed" style="background-image: url('{{ $principleImageUrl }}')"></div>
    </div>
    @endforelse

    <div class="relative z-10 h-full flex items-center justify-center" data-reveal="scale">
        <div class="max-w-4xl px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-10">{{ $settings['principle_title'] ?? 'Our Principle' }}</h2>
            
            <div class="relative">
                <svg class="w-16 h-16 text-[#d4af37] mx-auto mb-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-4.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069z"/></svg>
                
                <blockquote class="text-2xl md:text-3xl lg:text-4xl font-serif italic text-white leading-relaxed">
                    "{{ $settings['principle_quote'] ?? "Krousar Thmey's main principle is the development of projects led by Cambodians for Cambodians." }}"
                </blockquote>
            </div>
        </div>
    </div>

    {{-- Dot controls (only shown when multiple slides) --}}
    @if($principleSlides->count() > 1)
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-30 flex items-center gap-6">
        <template x-for="i in total" :key="i">
            <button @click="go(i - 1)"
                class="transition-all duration-300 rounded-full"
                :class="current === i - 1 ? 'w-8 h-3 bg-[#d4af37]' : 'w-3 h-3 bg-white/50 hover:bg-white/80'"
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

@endsection