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
                    @if($slide->subtitle)
                    <p class="text-white/80 text-lg mb-8 leading-relaxed">{{ $slide->subtitle }}</p>
                    @endif

                    @if($slide->cta_primary_text || $slide->cta_secondary_text)
                    <div class="flex flex-wrap gap-6">
                        @if($slide->cta_primary_text)
                        <a href="{{ $slide->cta_primary_url ?? '#' }}" class="btn-primary">{{ $slide->cta_primary_text }}</a>
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
    <div class="absolute inset-0 bg-[#1d4e7a] flex items-center justify-center">
        <div class="text-center">
            <h1 class="text-5xl font-bold text-white mb-4">Krousar Thmey</h1>
            <p class="text-white/70 text-lg">Supporting Cambodia's children since 1991</p>
        </div>
    </div>
    @endforelse

    {{-- Dot controls (only shown when multiple slides) --}}
    @if($slides->count() > 1)
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

{{-- ===== STATS / DATA SECTION ===== --}}
<section class="bg-[#1a3c6e] py-12 lg:py-16 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-10 animate-fade-up">
            <p class="text-white text-lg md:text-xl lg:text-2xl font-medium leading-relaxed max-w-4xl mx-auto">
                The first Cambodian organization helping disadvantaged children, building a world in which children are empowered to grow into independent and responsible adults.
            </p>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            @php
            $statsData = \App\Models\HomeSetting::getStats();

            $stats = [
            [
            'number' => $statsData['children']['number'],
            'display' => $statsData['children']['display'],
            'label' => $settings['stat_children_label'] ?? 'CHILDREN SUPPORTED',
            'sub' => $settings['stat_children_sub'] ?? 'SINCE 1991',
            ],
            [
            'number' => $statsData['employees']['number'],
            'display' => $statsData['employees']['display'],
            'label' => $settings['stat_employees_label'] ?? 'EMPLOYEES',
            'sub' => '',
            ],
            [
            'number' => $statsData['budget']['number'],
            'display' => $statsData['budget']['display'],
            'label' => $settings['stat_budget_label'] ?? 'USD ANNUAL BUDGET',
            'sub' => '',
            ],
            [
            'number' => $statsData['provinces']['number'],
            'display' => $statsData['provinces']['display'],
            'label' => $settings['stat_provinces_label'] ?? 'PROVINCES IN CAMBODIA',
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


        // ── Scroll animation for PageSections ──────────────
        const sectionBlocks = document.querySelectorAll(".animate-section");

        const sectionObserver = new IntersectionObserver(entries => {

            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-visible");
                    sectionObserver.unobserve(entry.target);
                }
            });

        }, {
            threshold: 0.15
        });


        sectionBlocks.forEach(el => {
            sectionObserver.observe(el);
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

    .animate-section {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s cubic-bezier(0.16, 1, 0.3, 1),
                    transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .animate-section.is-visible {
        opacity: 1;
        transform: translateY(0);
    }
</style>


{{-- ===== PROGRAMS ===== --}}
<section class="py-20 lg:py-28 bg-[#f8f9fc]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">{{ $settings['programs_badge'] ?? 'WHAT WE DO' }}</span>
            <h2 class="section-title mt-3 mx-auto">{{ $settings['programs_heading'] ?? 'Two Programs, One Mission' }}</h2>
        </div>
        <p class="section-subtitle mx-auto text-center">{{ $settings['programs_subtitle'] ?? 'Operating across 15 Cambodian provinces, our programs address the most pressing needs of vulnerable children.' }}</p>

        <div class="grid lg:grid-cols-3 gap-8">
            @foreach($programs as $program)
            <div class="card group flex flex-col">
                <div class="relative overflow-hidden h-56">
                    <img src="{{ $program->image_url }}"
                         alt="{{ $program->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0f2448]/70 to-transparent"></div>
                    @if($program->stats && count($program->stats) > 0)
                    <span class="absolute top-4 left-4 bg-[#e8a020] text-white text-xs font-bold px-3 py-1 rounded-full">{{ $program->stats[0]['value'] }} {{ $program->stats[0]['label'] }}</span>
                    @endif
                </div>

                {{-- Content --}}
                <div class="p-6 flex flex-col flex-1">
                    <h3 class="text-xl font-bold text-[#1a3c6e] mb-3">{{ $program->title }}</h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-5 line-clamp-3">
                        {{ $program->description }}
                    </p>
                    <ul class="space-y-1.5 mb-6">
                        @if($program->stats && count($program->stats) > 1)
                            @foreach(array_slice($program->stats, 1, 3) as $stat)
                            <li class="flex items-center gap-2 text-xs text-gray-500"><span class="w-1.5 h-1.5 rounded-full bg-[#e8a020] flex-shrink-0"></span>{{ $stat['value'] }} {{ strtolower($stat['label']) }}</li>
                            @endforeach
                        @endif
                    </ul>
                    <a href="{{ route('programs') }}#{{ $program->slug }}" class="mt-auto text-[#1a3c6e] font-semibold text-sm flex items-center gap-2 hover:text-[#e8a020] transition-colors group-hover:gap-3 duration-300">
                        {{ $settings['programs_learn_btn'] ?? 'Learn More' }}
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('programs') }}" class="btn-blue">{{ $settings['programs_cta'] ?? 'View All Programs' }}</a>
        </div>
    </div>
</section>
{{-- ===== PROGRAM STRUCTURE MAP SECTION ===== --}}
@php
$structureWelfareItems = array_filter(explode("\n", $settings['structure_welfare_items'] ?? "2 Temporary Protection Centers\n2 Long-term Protection Centers\n2 Family Houses\nOutside Cases"));
$structureEducationItems = array_filter(explode("\n", $settings['structure_education_items'] ?? "5 Special Education High Schools"));
$structureImage = $settings['structure_image'] ?? null;
@endphp
<section class="py-16 lg:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-14 items-center">

            {{-- Left Side - Map --}}
            <div class="flex justify-center">
                <img
                    src="{{ $structureImage ? (str_starts_with($structureImage, 'http') ? $structureImage : asset('storage/' . $structureImage)) : asset('images/cambodia-map.png') }}"
                    alt="Cambodia Program Map"
                    class="w-full max-w-2xl object-contain">
            </div>

            {{-- Right Side - Content --}}
            <div>

                <h2 class="text-3xl font-bold text-[#1a3c6e] mb-8">
                    {{ $settings['structure_heading'] ?? "KROUSAR THMEY'S STRUCTURES" }}
                </h2>

                {{-- Child Welfare --}}
                @if(!empty($structureWelfareItems))
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">
                        • {{ $settings['structure_welfare_title'] ?? 'Child Welfare Program' }}
                    </h3>

                    <ul class="space-y-2 ml-8 text-gray-600">
                        @foreach($structureWelfareItems as $item)
                        <li>– {{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Education --}}
                @if(!empty($structureEducationItems))
                <div class="mb-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">
                        • {{ $settings['structure_education_title'] ?? 'Education for Deaf or Blind Children Program' }}
                    </h3>

                    <ul class="space-y-2 ml-8 text-gray-600">
                        @foreach($structureEducationItems as $item)
                        <li>– {{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

        </div>

    </div>
</section>
{{-- ===== PAGE SECTIONS (Focus / Video / etc.) ===== --}}
@if($pageSections->isNotEmpty())
@foreach($pageSections as $index => $section)
@php
    $isReversed = $index % 2 !== 0;
    $sectionImage = $section->images->first();
    $sectionLinks = $section->links->where('active', true)->sortBy('order');
@endphp
<section class="py-20 lg:py-28 {{ $isReversed ? 'bg-[#f8f9fc]' : 'bg-white' }} overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            {{-- Image side --}}
            <div class="{{ $isReversed ? 'lg:order-2' : '' }}">
                <div class="relative group">
                    {{-- Decorative accent --}}
                    <div class="absolute -top-4 -left-4 w-24 h-24 rounded-2xl {{ $isReversed ? 'bg-[#8da83a]/10' : 'bg-[#2d6fa3]/10' }} -z-10"></div>
                    <div class="absolute -bottom-4 -right-4 w-32 h-32 rounded-2xl {{ $isReversed ? 'bg-[#2d6fa3]/10' : 'bg-[#8da83a]/10' }} -z-10"></div>

                    @if($sectionImage)
                    <img src="{{ str_starts_with($sectionImage->path, 'http') ? $sectionImage->path : asset('storage/' . $sectionImage->path) }}"
                         alt="{{ $sectionImage->alt ?? $section->title }}"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                         class="w-full h-[340px] lg:h-[420px] object-cover rounded-2xl shadow-xl
                                group-hover:shadow-2xl transition-all duration-700
                                group-hover:scale-[1.02]">
                    @endif
                    {{-- Placeholder (shown when no image or image fails to load) --}}
                    <div class="w-full h-[340px] lg:h-[420px] rounded-2xl shadow-xl
                                bg-gradient-to-br from-[#2d6fa3]/5 to-[#8da83a]/5
                                border-2 border-dashed border-gray-200
                                flex flex-col items-center justify-center text-gray-300
                                group-hover:border-[#2d6fa3]/30 group-hover:shadow-2xl transition-all duration-500
                                {{ $sectionImage ? 'hidden' : '' }}">
                        <svg class="w-16 h-16 mb-4 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <p class="text-sm font-medium">Image placeholder</p>
                        <p class="text-xs mt-1">Upload via admin panel</p>
                    </div>

                    {{-- Floating badge --}}
                    <div class="absolute -bottom-3 -right-3 bg-white rounded-xl shadow-lg px-4 py-2 border border-gray-100">
                        <span class="text-xs font-bold text-[#2d6fa3] uppercase tracking-wider">{{ $section->section_name }}</span>
                    </div>
                </div>
            </div>

            {{-- Content side --}}
            <div class="{{ $isReversed ? 'lg:order-1' : '' }} animate-section">
                {{-- Section label --}}
                <div class="flex items-center gap-6 mb-4">
                    <span class="h-px w-8 bg-[#e8a020]"></span>
                    <span class="text-[#e8a020] font-semibold text-xs uppercase tracking-[0.2em]">
                        {{ str_replace('-', ' ', $section->section_name) }}
                    </span>
                </div>

                {{-- Title --}}
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-800 leading-tight mb-6">
                    {{ $section->title }}
                </h2>

                {{-- Description --}}
                @if($section->description)
                <div class="text-gray-600 leading-relaxed space-y-4 mb-8">
                    @foreach(explode("\n\n", $section->description) as $paragraph)
                    <p>{{ $paragraph }}</p>
                    @endforeach
                </div>
                @endif

                {{-- CTA Buttons --}}
                @if($sectionLinks->isNotEmpty())
                <div class="flex flex-wrap gap-6">
                    @foreach($sectionLinks as $link)
                    <a href="{{ $link->url }}"
                       target="{{ $link->target ?? '_self' }}"
                       class="group inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold text-sm transition-all duration-300
                              {{ $loop->first
                                  ? 'bg-[#2d6fa3] text-white hover:bg-[#1d4e7a] shadow-md hover:shadow-lg'
                                  : 'bg-white text-[#2d6fa3] border-2 border-[#2d6fa3]/20 hover:border-[#2d6fa3] hover:bg-[#2d6fa3]/5'
                              }}">
                        <span>{{ $link->text }}</span>
                        <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                    @endforeach
                </div>
                @endif
            </div>

        </div>
    </div>
</section>
@endforeach
@endif



{{-- ===== PROJECTS ===== --}}
@if($projects->count())
<section class="py-16 lg:py-24 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">{{ $settings['projects_badge'] ?? 'Our Projects' }}</span>
            <h2 class="section-title mt-3 mx-auto">{{ $settings['projects_title'] ?? 'Cross-cutting Initiatives' }}</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($projects as $project)
            <div class="bg-[#f8f9fc] rounded-2xl p-7 border border-gray-100 hover:shadow-lg transition-shadow group">
                @if($project->image)
                <img src="{{ str_starts_with($project->image, 'http') ? $project->image : asset('storage/' . $project->image) }}" class="w-full h-40 object-cover rounded-xl mb-5 group-hover:opacity-90 transition-opacity">
                @endif
                <h3 class="text-xl font-bold text-[#1a3c6e] mb-3">{{ $project->title }}</h3>
                <p class="text-gray-600 text-sm leading-relaxed line-clamp-3 mb-5">{{ $project->description }}</p>
                <a href="{{ route('projects.show', $project) }}" class="inline-flex items-center gap-2 text-[#e8a020] font-bold text-sm hover:text-[#1a3c6e] transition-colors group-hover:gap-3 duration-300" style="color: #e8a020; font-weight: bold;">
                    {{ $settings['projects_read_more'] ?? 'Read More Detail' }}
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== GALLERY ===== --}}
@if($galleries->count())
<section class="py-16 lg:py-24 bg-[#1a3c6e]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">In Pictures</span>
            <h2 class="text-3xl font-bold text-white mt-3">A Glimpse Into Our Work</h2>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($galleries as $photo)
            <div class="group relative overflow-hidden rounded-xl aspect-square bg-white/5">
                @if($photo->image)
                <img src="{{ str_starts_with($photo->image, 'http') ? $photo->image : asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-5">
                    <p class="text-white font-medium text-sm">{{ $photo->title }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ===== NEWS ===== --}}
<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-14 gap-6">
            <div>
                <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">{{ $settings['news_title'] ?? 'Latest Updates' }}</span>
                <h2 class="section-title mt-3">{{ $settings['news_title'] ?? 'News & Stories' }}</h2>
                <p class="text-gray-500 mt-3 max-w-2xl">{{ $settings['news_subtitle'] ?? 'News and stories about our impact, events, and community progress.' }}</p>
            </div>
            <a href="{{ route('news') }}" class="text-[#1a3c6e] font-semibold text-sm flex items-center gap-2 hover:text-[#e8a020] transition-colors flex-shrink-0">
                {{ $settings['news_view_all'] ?? 'All News' }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
            </a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($latestNews as $article)
            <article class="card group flex flex-col">
                <a href="{{ route('news.show', $article->slug) }}" class="relative overflow-hidden h-52 block">
                    <img src="{{ $article->image_url }}" alt="{{ $article->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @if(!empty($article->tag_links[0]['label']))
                    <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-[#1a3c6e] text-xs font-semibold px-3 py-1 rounded-full">{{ $article->tag_links[0]['label'] }}</span>
                    @endif
                </a>
                <div class="p-6 flex flex-col flex-1">
                    <time class="text-gray-400 text-xs mb-3 flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $article->published_at?->format('F Y') ?? $article->created_at->format('F Y') }}
                    </time>
                    <h3 class="font-bold text-gray-800 text-lg mb-3 leading-snug">
                        <a href="{{ route('news.show', $article->slug) }}" class="group-hover:text-[#1a3c6e] transition-colors">{{ $article->title }}</a>
                    </h3>
                    <p class="text-gray-500 text-sm leading-relaxed flex-1">{{ $article->excerpt }}</p>
                    <a href="{{ route('news.show', $article->slug) }}" class="mt-5 text-[#1a3c6e] font-semibold text-sm flex items-center gap-1.5 hover:text-[#e8a020] transition-colors">
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

{{-- ===== TESTIMONIALS ===== --}}
@if($testimonials->count())
<section class="py-20 lg:py-28 bg-[#f8f9fc]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Voices</span>
            <h2 class="section-title mt-3 mx-auto">What People Say</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($testimonials as $testimony)
            <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100 relative">
                <svg class="w-10 h-10 text-[#e8a020]/20 absolute top-6 right-6" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" /></svg>
                <div class="flex items-center gap-4 mb-6 relative z-10">
                    @if($testimony->image)
                    <img src="{{ str_starts_with($testimony->image, 'http') ? $testimony->image : asset('storage/' . $testimony->image) }}" alt="{{ $testimony->name }}" class="w-14 h-14 rounded-full object-cover border-2 border-white shadow-md">
                    @else
                    <div class="w-14 h-14 rounded-full bg-[#1a3c6e]/10 flex items-center justify-center text-[#1a3c6e] font-bold text-xl">{{ substr($testimony->name, 0, 1) }}</div>
                    @endif
                    <div>
                        <h4 class="font-bold text-gray-800">{{ $testimony->name }}</h4>
                        <p class="text-xs text-gray-500">{{ $testimony->role }}</p>
                    </div>
                </div>
                <p class="text-gray-600 leading-relaxed text-sm italic line-clamp-4 relative z-10">"{{ $testimony->content }}"</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

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
        <div class="flex flex-col sm:flex-row gap-6 justify-center">
            <a href="{{ $settings['cta_primary_url'] ?? route('donate') }}" class="btn-primary text-base">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                {{ $settings['cta_primary_text'] ?? 'Donate Now' }}
            </a>
            @if(!empty($settings['cta_secondary_text']))
            <a href="{{ $settings['cta_secondary_url'] ?? route('get-involved') }}" class="btn-outline text-base">{{ $settings['cta_secondary_text'] }}</a>
            @endif
            <a href="{{ route('resources') }}" class="btn-outline text-base">{{ $settings['cta_annual_report_text'] ?? 'Annual Report' }}</a>
        </div>
    </div>
</section>

{{-- ===== PARTNERS ===== --}}
@php
$homePartners = \App\Models\Partner::active()->whereNotNull('logo')->where('logo', '!=', '')->get();
@endphp

@if($homePartners->isNotEmpty())
<section class="py-16 bg-[#f8f9fc] border-t border-gray-100 overflow-hidden">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Header --}}
        <div class="text-center mb-10">
            <span class="text-[#e8a020] font-semibold text-xs uppercase tracking-[0.2em]">{{ $settings['partners_badge'] ?? 'OUR NETWORK' }}</span>
            <h2 class="section-title mt-2">{{ $settings['partners_heading'] ?? 'Supported by Our Partners Worldwide' }}</h2>
            <p class="text-gray-400 text-sm mt-2 max-w-xl mx-auto">
                We are grateful for the trust and collaboration of {{ $homePartners->count() }} partner organisations across the globe.
            </p>
        </div>

        {{-- Infinite seamless marquee --}}
        <div class="relative"
             x-data="{ paused: false }"
             @mouseenter="paused = true"
             @mouseleave="paused = false">

            {{-- Gradient fade edges --}}
            <div class="absolute left-0 top-0 bottom-0 w-16 bg-gradient-to-r from-[#f8f9fc] to-transparent z-10 pointer-events-none"></div>
            <div class="absolute right-0 top-0 bottom-0 w-16 bg-gradient-to-l from-[#f8f9fc] to-transparent z-10 pointer-events-none"></div>

            <div class="overflow-hidden">
                <div class="flex marquee-track"
                     :style="{ animationPlayState: paused ? 'paused' : 'running' }">
                    {{-- Set 1 --}}
                    @foreach($homePartners as $partner)
                    <div class="flex items-center justify-center w-52 h-20 bg-white rounded-lg shadow-sm border border-gray-100 mx-3
                                hover:shadow-md hover:border-[#2d6fa3]/20 transition-all duration-300 flex-shrink-0">
                        <img src="{{ asset('storage/' . $partner->logo) }}"
                             alt="{{ $partner->name }}"
                             class="w-full h-full object-contain p-4 transition-all duration-500">
                    </div>
                    @endforeach
                    {{-- Duplicate set for seamless loop --}}
                    @foreach($homePartners as $partner)
                    <div class="flex items-center justify-center w-52 h-20 bg-white rounded-lg shadow-sm border border-gray-100 mx-3
                                hover:shadow-md hover:border-[#2d6fa3]/20 transition-all duration-300 flex-shrink-0">
                        <img src="{{ asset('storage/' . $partner->logo) }}"
                             alt="{{ $partner->name }}"
                             class="w-full h-full object-contain p-4 transition-all duration-500">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Bottom CTA --}}
        <div class="text-center mt-10">
            <a href="{{ route('partners') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-[#2d6fa3] hover:text-[#1d4e7a] transition-colors group">
                {{ $settings['partners_view_all'] ?? 'View All Partners' }}
                <svg class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>

    </div>
</section>

{{-- Marquee keyframes --}}
<style>
    @keyframes marqueeScroll {
        0% { transform: translate3d(0, 0, 0); }
        100% { transform: translate3d(-50%, 0, 0); }
    }
    .marquee-track {
        will-change: transform;
        animation: marqueeScroll 30s linear infinite;
    }
</style>
@endif

@endsection
