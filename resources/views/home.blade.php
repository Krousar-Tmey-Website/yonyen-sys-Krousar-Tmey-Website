@extends('layouts.app')

@section('title', 'Krousar Thmey — Helping Children in Cambodia Since 1991')
@section('description', 'Krousar Thmey is Cambodia\'s first organization helping disadvantaged children through child welfare, special education for deaf and blind students, and cultural development.')

@section('content')

{{-- ===== HERO CAROUSEL ===== --}}
<section class="relative h-[90vh] min-h-[520px] max-h-[800px] overflow-hidden"
    x-data="{
            current: 0,
            total: {{ max($slides->count(), 1) }},
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

    @forelse($slides as $slide)
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
                    @if(!empty($settings['hero_banner_text']))
                    <p class="text-white/80 text-lg mb-8 leading-relaxed">{{ $settings['hero_banner_text'] }}</p>
                    @elseif($slide->subtitle)
                    <p class="text-white/80 text-lg mb-8 leading-relaxed">{{ $slide->subtitle }}</p>
                    @endif

                    @php
                    $heroPrimaryText = $settings['hero_button_primary_text'] ?? $slide->cta_primary_text;
                    $heroPrimaryUrl = $settings['hero_button_primary_url'] ?? ($slide->cta_primary_url ?? '#');
                    $heroSecondaryText = $settings['hero_button_secondary_text'] ?? $slide->cta_secondary_text;
                    $heroSecondaryUrl = $settings['hero_button_secondary_url'] ?? ($slide->cta_secondary_url ?? route('donate'));
                    @endphp

                    @if($heroPrimaryText || $heroSecondaryText)
                    <div class="flex flex-wrap gap-4">
                        @if($heroPrimaryText)
                        <a href="{{ $heroPrimaryUrl }}" class="btn-primary">{{ $heroPrimaryText }}</a>
                        @endif
                        @if($heroSecondaryText)
                        <a href="{{ $heroSecondaryUrl }}" class="btn-outline">{{ $heroSecondaryText }}</a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="absolute inset-0 bg-[#1d4e7a] flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-5xl font-bold text-white mb-4">Krousar Thmey</h1>
            <p class="text-white/70 text-lg">Supporting Cambodia's children since 1991</p>
        </div>
    </div>
    @endforelse

    {{-- Dot controls (only shown when multiple slides) --}}
    @if($slides->count() > 1)
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-30 flex items-center gap-3">
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

{{-- ===== STATS / DATA SECTION ===== --}}
<section class="bg-[#1a3c6e] py-12 lg:py-16 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-10 animate-fade-up">
            <p class="text-white text-lg md:text-xl lg:text-2xl font-medium leading-relaxed max-w-4xl mx-auto">
                {{ $settings['hero_banner_text'] ?? 'The first Cambodian organization helping disadvantaged children, building a world in which children are empowered to grow into independent and responsible adults.' }}
            </p>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            @php
            $statsData = \App\Models\HomeSetting::getStats();

            $stats = [
            [
            'number' => $statsData['children']['number'],
            'display' => $statsData['children']['display'],
            'label' => 'CHILDREN SUPPORTED',
            'sub' => 'SINCE 1991',
            ],
            [
            'number' => $statsData['employees']['number'],
            'display' => $statsData['employees']['display'],
            'label' => 'EMPLOYEES',
            'sub' => '',
            ],
            [
            'number' => $statsData['budget']['number'],
            'display' => $statsData['budget']['display'],
            'label' => 'USD ANNUAL BUDGET',
            'sub' => '',
            ],
            [
            'number' => $statsData['provinces']['number'],
            'display' => $statsData['provinces']['display'],
            'label' => 'PROVINCES IN CAMBODIA',
            'sub' => '',
            ],
            ];
            @endphp

            @foreach($stats as $stat)
            <div class="group text-center opacity-0 translate-y-10 animate-stat">
                <div class="text-4xl lg:text-5xl font-bold text-[#e8a020] mb-2 counter"
                    data-target="{{ $stat['number'] }}"
                    data-final="{{ $stat['display'] }}">
                    {{ $stat['display'] }}
                </div>

                <div class="text-white font-bold text-sm lg:text-base">
                    {{ $stat['label'] }}
                </div>

                @if($stat['sub'])
                <div class="text-white/50 text-xs mt-1">
                    {{ $stat['sub'] }}
                </div>
                @endif
            </div>
            @endforeach

        </div>
    </div>
</section>


{{-- Animation Script --}}
<script>
    document.addEventListener("DOMContentLoaded", () => {

        const counters = document.querySelectorAll(".counter");

        const observer = new IntersectionObserver(entries => {

            entries.forEach(entry => {

                if (entry.isIntersecting) {

                    const counter = entry.target;
                    const target = +counter.dataset.target;

                    let count = 0;

                    const speed = target / 80;

                    const update = () => {

                        count += speed;

                        if (count < target) {
                            counter.innerText = Math.floor(count).toLocaleString();
                            requestAnimationFrame(update);
                        } else {
                            const finalValue = counter.dataset.final || target;
                            counter.innerText = finalValue;
                        }

                    };

                    update();

                    observer.unobserve(counter);
                }

            });

        }, {
            threshold: 0.5
        });


        counters.forEach(counter => {
            observer.observe(counter);
        });

    });
</script>


{{-- Tailwind custom animation --}}
<style>
    @keyframes fadeUp {

        from {
            opacity: 0;
            transform: translateY(40px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }

    }


    .animate-stat {
        animation: fadeUp .8s ease forwards;
    }


    .animate-stat:nth-child(1) {
        animation-delay: .1s;
    }

    .animate-stat:nth-child(2) {
        animation-delay: .2s;
    }

    .animate-stat:nth-child(3) {
        animation-delay: .3s;
    }

    .animate-stat:nth-child(4) {
        animation-delay: .4s;
    }

    .animate-fade-up {
        animation: fadeUp .8s ease forwards;
    }
</style>

{{-- ===== PROGRAMS ===== --}}
<section class="py-20 lg:py-28 bg-[#f8f9fc]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">WHAT WE DO</span>
            <h2 class="section-title mt-3 mx-auto">Two Programs, One Mission</h2>
        </div>
        <p class="section-subtitle mx-auto text-center">{{ $settings['programs_subtitle'] ?? 'Krousar Thmey operates 2 programs and 2 cross-cutting projects in 15 Cambodian provinces ' }}</p>

        <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-8 justify-center">
            @forelse($programs as $program)
            <a href="{{ route('programs') }}#{{ $program->slug }}"
                class="group relative overflow-hidden rounded-2xl bg-white shadow-lg hover:shadow-2xl transition-all duration-500 h-80">

                {{-- Image --}}
                <img src="{{ $program->image_url }}"
                    alt="{{ $program->title }}"
                    class="absolute inset-0 w-full h-full object-cover 
            group-hover:scale-110 transition-transform duration-700">


                {{-- Dark Blue Overlay --}}
                <div class="absolute inset-0 
            bg-gradient-to-t from-[#06264d] via-[#0b3b73]/60 to-transparent
            transition-all duration-500
            group-hover:from-[#06264d] 
            group-hover:via-[#0b3b73]/80">
                </div>


                <!-- {{-- Stats --}}
                @if(!empty($program->stats[0]['value']))
                <span class="absolute top-5 left-5 
            bg-[#e8a020] text-white text-xs font-bold 
            px-4 py-2 rounded-full shadow-lg z-10">
                    {{ $program->stats[0]['value'] }}
                    {{ $program->stats[0]['label'] ?? '' }}
                </span>
                @endif -->


                {{-- Content --}}
                <div class="absolute bottom-0 left-0 right-0 p-6 text-white z-10">


                    {{-- Title --}}
                    <h3 class="text-2xl font-bold 
                drop-shadow-[0_3px_5px_rgba(0,0,0,0.8)]
                transition-all duration-500
                group-hover:-translate-y-2">
                        {{ $program->title }}
                    </h3>


                    {{-- Description --}}
                    <div class="mt-3 
                opacity-0 translate-y-5
                group-hover:opacity-100
                group-hover:translate-y-0
                transition-all duration-500">

                        <p class="text-sm leading-relaxed text-white 
                    drop-shadow-[0_2px_4px_rgba(0,0,0,0.9)]">
                            {{ $program->description }}
                        </p>


                        {{-- Button --}}
                        <div class="mt-5 inline-flex items-center gap-2
                    bg-[#e8a020] px-5 py-2 rounded-full
                    font-semibold text-sm
                    hover:bg-white hover:text-[#0b3b73]
                    transition-all duration-300">

                            Learn More

                            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>

                        </div>

                    </div>

                </div>

            </a>

            @empty
            <div class="col-span-3 py-12 text-center text-gray-400">
                No programs are available yet.
            </div>
            @endforelse
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('programs') }}" class="btn-blue">View All Programs</a>
        </div>
    </div>
</section>
{{-- ===== PROGRAM STRUCTURE MAP SECTION ===== --}}
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">

            {{-- Left Side - Map --}}
            <div class="flex justify-center">
                <img
                    src="{{ asset('images/cambodia-map.png') }}"
                    alt="Cambodia Program Map"
                    class="w-full max-w-2xl object-contain">
            </div>

            {{-- Right Side - Content --}}
            <div>

                <h2 class="text-3xl font-bold text-[#1a3c6e] mb-8">
                    KROUSAR THMEY'S STRUCTURES
                </h2>

                {{-- Child Welfare --}}
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">
                        • Child Welfare Program
                    </h3>

                    <ul class="space-y-2 ml-8 text-gray-600">
                        <li>– 2 Temporary Protection Centers</li>
                        <li>– 2 Long-term Protection Centers</li>
                        <li>– 2 Family Houses</li>
                        <li>– Outside Cases</li>
                    </ul>
                </div>

                {{-- Education --}}
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">
                        • Education for Deaf or Blind Children Program
                    </h3>

                    <ul class="space-y-2 ml-8 text-gray-600">
                        <li>– 5 Special Education High Schools</li>
                    </ul>
                </div>
            </div>

        </div>

    </div>
</section>


{{-- ===== NEWS ===== --}}
<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-14 gap-4">
            <div>
                <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">{{ $settings['news_title'] ?? 'Latest Updates' }}</span>
                <h2 class="section-title mt-3">{{ $settings['news_title'] ?? 'News & Stories' }}</h2>
                <p class="text-gray-500 mt-3 max-w-2xl">{{ $settings['news_subtitle'] ?? 'News and stories about our impact, events, and community progress.' }}</p>
            </div>
            <a href="{{ route('news') }}" class="text-[#1a3c6e] font-semibold text-sm flex items-center gap-2 hover:text-[#e8a020] transition-colors flex-shrink-0">
                All News
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($latestNews as $article)
            <article class="card group flex flex-col">
                <div class="relative overflow-hidden h-52">
                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-[#1a3c6e] text-xs font-semibold px-3 py-1 rounded-full capitalize">{{ str_replace('-', ' ', $article->category) }}</span>
                </div>
                <div class="p-6 flex flex-col flex-1">
                    <time class="text-gray-400 text-xs mb-3 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $article->published_at?->format('F Y') ?? $article->created_at->format('F Y') }}
                    </time>
                    <h3 class="font-bold text-gray-800 text-lg mb-3 leading-snug group-hover:text-[#1a3c6e] transition-colors">{{ $article->title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed flex-1">{{ $article->excerpt }}</p>
                    <a href="{{ route('news') }}" class="mt-5 text-[#1a3c6e] font-semibold text-sm flex items-center gap-1.5 hover:text-[#e8a020] transition-colors">
                        Read More
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-3 py-12 text-center text-gray-400">
                <p class="text-sm">No articles published yet.</p>
                <a href="{{ route('news') }}" class="text-[#1a3c6e] text-sm underline mt-2 inline-block">Visit the news page</a>
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- ===== CALL TO ACTION ===== --}}
<section class="relative py-24 overflow-hidden">
    <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1400&q=80')] bg-cover bg-center"></div>
    <div class="absolute inset-0 bg-[#1a3c6e]/85"></div>
    <div class="relative z-10 max-w-3xl mx-auto px-6 text-center">
        <span class="inline-block bg-[#e8a020] text-white text-xs font-semibold px-4 py-1.5 rounded-full mb-6 uppercase tracking-wider">{{ $settings['cta_label'] ?? 'Support Our Work' }}</span>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6">
            {{ $settings['cta_title'] ?? 'Help a Child Build Their Future' }}
        </h2>
        <p class="text-white/80 text-lg leading-relaxed mb-10">
            {{ $settings['cta_subtitle'] ?? 'We guarantee that 100% of your donation is used to support children across Cambodia. Every contribution, big or small, changes a life.' }}
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ $settings['cta_primary_url'] ?? route('donate') }}" class="btn-primary text-base">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                {{ $settings['cta_primary_text'] ?? 'Donate Now' }}
            </a>
            @if(!empty($settings['cta_secondary_text']))
            <a href="{{ $settings['cta_secondary_url'] ?? route('get-involved') }}" class="btn-outline text-base">{{ $settings['cta_secondary_text'] }}</a>
            @endif
            <a href="{{ route('resources') }}" class="btn-outline text-base">Annual Report</a>
        </div>
    </div>
</section>

{{-- ===== PARTNERS ===== --}}
<section class="py-14 bg-[#f8f9fc] border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <p class="text-gray-400 text-sm uppercase tracking-wider mb-8 font-medium">Supported by our partners worldwide</p>
        @php
        $partners = array_filter(array_map('trim', explode(',', $settings['partners_logos'] ?? 'UNICEF, USAID, AFD, Handicap International, European Union, Aide et Action')));
        @endphp
        <div class="flex flex-wrap items-center justify-center gap-8 lg:gap-14 opacity-60">
            @foreach($partners as $partner)
            <span class="text-gray-500 font-bold text-sm tracking-wide">{{ $partner }}</span>
            @endforeach
        </div>
    </div>
</section>

@endsection