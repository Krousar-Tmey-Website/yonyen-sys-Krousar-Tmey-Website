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
                    <div class="flex flex-wrap gap-4">
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
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
    </button>
    <button @click="go((current + 1) % total)"
            class="absolute right-4 top-1/2 -translate-y-1/2 z-30 w-11 h-11 rounded-full bg-white/20 backdrop-blur-sm text-white flex items-center justify-center hover:bg-white/30 transition-colors" aria-label="Next">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </button>
    @endif
</section>

{{-- ===== STATS SECTION ===== --}}
<section class="bg-[#1a3c6e] py-12 lg:py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            @foreach([
                ['number' => $settings['stat_children'] ?? '4,079', 'label' => 'Children Supported', 'sub' => 'Since 1991', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                ['number' => $settings['stat_provinces'] ?? '15', 'label' => 'Provinces', 'sub' => 'Across Cambodia', 'icon' => 'M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z'],
                ['number' => $settings['stat_special_ed'] ?? '768', 'label' => 'Special Ed Students', 'sub' => 'Deaf & Blind Schools', 'icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
                ['number' => $settings['stat_arts'] ?? '1,088', 'label' => 'Arts Students', 'sub' => 'School of Khmer Arts', 'icon' => 'M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3'],
            ] as $stat)
            <div class="text-center">
                <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-[#e8a020]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $stat['icon'] }}"/>
                    </svg>
                </div>
                <div class="text-3xl lg:text-4xl font-bold text-white mb-1">{{ $stat['number'] }}</div>
                <div class="text-white font-semibold text-sm mb-0.5">{{ $stat['label'] }}</div>
                <div class="text-white/50 text-xs">{{ $stat['sub'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== INTRO / MISSION ===== --}}
<section class="py-20 lg:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-14 items-center">
            <div>
                <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Our Mission</span>
                <h2 class="section-title mt-3 mb-6">The First Cambodian Organization for Disadvantaged Children</h2>
                <p class="text-gray-600 leading-relaxed mb-5">
                    Born in 1991 in the Site II refugee camp in Thailand, Krousar Thmey — meaning "New Family" in Khmer — was established with a single vision: that every disadvantaged child in Cambodia deserves safety, education, and a sense of cultural identity.
                </p>
                <p class="text-gray-600 leading-relaxed mb-8">
                    We believe in development led by Cambodians, for Cambodians. With three core programs spanning child welfare, special education, and cultural arts, we reach children across all 15 provinces of Cambodia.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('about') }}" class="btn-blue">Our Story</a>
                    <a href="{{ route('programs') }}" class="btn-primary">Our Programs</a>
                </div>
            </div>
            <div class="relative">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1527689368864-3a821dbccc34?w=700&q=80"
                         alt="Children in Cambodia"
                         class="w-full h-[420px] object-cover">
                </div>
                {{-- Floating badge --}}
                <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl shadow-xl p-5 flex items-center gap-4">
                    <div class="w-14 h-14 rounded-xl bg-[#1a3c6e] flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-bold text-xl">33</span>
                    </div>
                    <div>
                        <div class="font-bold text-gray-800 text-lg">Years of Impact</div>
                        <div class="text-gray-500 text-sm">Serving children since 1991</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== THREE PILLARS ===== --}}
<section class="py-6 bg-[#f8f9fc]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-3 gap-6">
            @foreach([
                ['title' => 'Identity', 'desc' => 'Reconnecting children with their Khmer roots, traditions, and cultural heritage to build a strong sense of self.', 'color' => 'bg-[#1a3c6e]', 'icon' => '🏛️'],
                ['title' => 'Integration', 'desc' => 'Enabling full societal participation so every child — regardless of ability or background — can contribute to Cambodia.', 'color' => 'bg-[#e8a020]', 'icon' => '🤝'],
                ['title' => 'Dignity', 'desc' => 'Ensuring every child receives the respect and opportunity they deserve to build a future of independence.', 'color' => 'bg-[#2554a0]', 'icon' => '⭐'],
            ] as $pillar)
            <div class="bg-white rounded-2xl p-7 border border-gray-100 hover:shadow-lg transition-all duration-300 group">
                <div class="text-3xl mb-4">{{ $pillar['icon'] }}</div>
                <h3 class="text-xl font-bold text-[#1a3c6e] mb-3 group-hover:text-[#e8a020] transition-colors">{{ $pillar['title'] }}</h3>
                <p class="text-gray-600 text-sm leading-relaxed">{{ $pillar['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== PROGRAMS ===== --}}
<section class="py-20 lg:py-28 bg-[#f8f9fc]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">What We Do</span>
            <h2 class="section-title mt-3 mx-auto">Three Programs, One Mission</h2>
            <p class="section-subtitle mx-auto text-center">Operating across 15 Cambodian provinces, our programs address the most pressing needs of vulnerable children.</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            @foreach($programs as $program)
            <div class="card group">
                <div class="relative overflow-hidden h-56">
                    <img src="{{ $program->image_url }}"
                         alt="{{ $program->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0f2448]/70 to-transparent"></div>
                    @if($program->stats && count($program->stats) > 0)
                    <span class="absolute top-4 left-4 bg-[#e8a020] text-white text-xs font-bold px-3 py-1 rounded-full">{{ $program->stats[0]['value'] }} {{ $program->stats[0]['label'] }}</span>
                    @endif
                </div>
                <div class="p-7">
                    <div class="w-12 h-12 rounded-xl bg-[#1a3c6e]/10 flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-[#1a3c6e]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    </div>
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
                    <a href="{{ route('programs') }}#{{ $program->slug }}" class="text-[#1a3c6e] font-semibold text-sm flex items-center gap-2 hover:text-[#e8a020] transition-colors group-hover:gap-3 duration-300">
                        Learn More
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('programs') }}" class="btn-blue">View All Programs</a>
        </div>
    </div>
</section>

{{-- ===== PROJECTS ===== --}}
@if($projects->count())
<section class="py-16 lg:py-24 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Our Projects</span>
            <h2 class="section-title mt-3 mx-auto">Cross-cutting Initiatives</h2>
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
                    Read More Detail
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
        <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-14 gap-4">
            <div>
                <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Latest Updates</span>
                <h2 class="section-title mt-3">News &amp; Stories</h2>
            </div>
            <a href="{{ route('news') }}" class="text-[#1a3c6e] font-semibold text-sm flex items-center gap-2 hover:text-[#e8a020] transition-colors flex-shrink-0">
                All News
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
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
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $article->published_at?->format('F Y') ?? $article->created_at->format('F Y') }}
                    </time>
                    <h3 class="font-bold text-gray-800 text-lg mb-3 leading-snug group-hover:text-[#1a3c6e] transition-colors">{{ $article->title }}</h3>
                    <p class="text-gray-500 text-sm leading-relaxed flex-1">{{ $article->excerpt }}</p>
                    <a href="{{ route('news') }}" class="mt-5 text-[#1a3c6e] font-semibold text-sm flex items-center gap-1.5 hover:text-[#e8a020] transition-colors">
                        Read More
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
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
        <span class="inline-block bg-[#e8a020] text-white text-xs font-semibold px-4 py-1.5 rounded-full mb-6 uppercase tracking-wider">Support Our Work</span>
        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-6">
            Help a Child Build Their Future
        </h2>
        <p class="text-white/80 text-lg leading-relaxed mb-10">
            We guarantee that 100% of your donation is used to support children across Cambodia. Every contribution, big or small, changes a life.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('donate') }}" class="btn-primary text-base">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                Donate Now
            </a>
            <a href="{{ route('involved') }}" class="btn-outline text-base">Get Involved</a>
        </div>
    </div>
</section>

{{-- ===== PARTNERS ===== --}}
<section class="py-14 bg-[#f8f9fc] border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-6 text-center">
        <p class="text-gray-400 text-sm uppercase tracking-wider mb-8 font-medium">Supported by our partners worldwide</p>
        <div class="flex flex-wrap items-center justify-center gap-8 lg:gap-14 opacity-60">
            @foreach(['UNICEF', 'USAID', 'AFD', 'Handicap International', 'European Union', 'Aide et Action'] as $partner)
            <span class="text-gray-500 font-bold text-sm tracking-wide">{{ $partner }}</span>
            @endforeach
        </div>
    </div>
</section>

@endsection
