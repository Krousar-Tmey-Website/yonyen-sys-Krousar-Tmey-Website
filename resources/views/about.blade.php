@extends('layouts.app')

@section('title', 'Who We Are — Krousar Thmey')
@section('description', 'Krousar Thmey is the first Cambodian organization helping disadvantaged children, born in 1991 in the Site II refugee camp in Thailand.')

@section('content')

{{-- ========================================================
     PAGE HEADER
     ======================================================== --}}
<div class="bg-[#2d6fa3] pt-16 pb-24 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a] translate-y-1/2 -translate-x-1/3"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/50 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white">Who We Are</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Who We Are</h1>
        <p class="text-white/70 text-lg max-w-xl">Presentation · History · Awards · Partners · Transparency</p>

        {{-- In-page navigation --}}
        <div class="flex flex-wrap gap-3 mt-10">
            @foreach(['presentation'=>'Presentation','history'=>'Our History','awards'=>'Awards','partners'=>'Partners','transparency'=>'Transparency'] as $id => $label)
            <a href="#{{ $id }}"
               class="px-5 py-2 rounded-full bg-white/15 text-white text-sm font-medium hover:bg-white/25 transition-colors border border-white/20">
                {{ $label }}
            </a>
            @endforeach
        </div>
    </div>
</div>

{{-- ========================================================
     PRESENTATION
     ======================================================== --}}
<section id="presentation" class="py-20 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">

        {{-- Hero statement --}}
        <div class="text-center mb-16 max-w-4xl mx-auto">
            <p class="text-[#2d6fa3] font-bold text-sm uppercase tracking-widest mb-4">Our Mission</p>
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold text-gray-800 leading-tight">
                Krousar Thmey,<br>
                <span class="text-[#2d6fa3]">The first Cambodian organization</span><br>
                helping disadvantaged children,<br>
                <span class="text-[#8da83a] text-2xl md:text-3xl font-semibold">born in 1991 in the Site II refugee camp in Thailand.</span>
            </h2>
        </div>

        {{-- Values --}}
        <div class="grid md:grid-cols-3 gap-6 mb-20">
            @foreach([
                ['title'=>'Identity',    'icon'=>'🏛️', 'desc'=>'Every child can reconnect with their roots and traditions.'],
                ['title'=>'Integration', 'icon'=>'🤝', 'desc'=>'Every child is fully integrated into Cambodian society.'],
                ['title'=>'Dignity',     'icon'=>'⭐', 'desc'=>'Every child is respected and can build the future they deserve.'],
            ] as $value)
            <div class="group relative bg-[#f8f9fc] rounded-3xl p-8 border border-gray-100 hover:border-[#2d6fa3]/30 hover:shadow-lg transition-all duration-300 text-center overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-[#8da83a] scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left rounded-t-3xl"></div>
                <div class="text-5xl mb-5">{{ $value['icon'] }}</div>
                <h3 class="text-xl font-bold text-[#2d6fa3] mb-3">{{ $value['title'] }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $value['desc'] }}</p>
            </div>
            @endforeach
        </div>

        {{-- Mission text --}}
        <div class="grid lg:grid-cols-2 gap-14 items-center mb-20">
            <div>
                <p class="text-gray-600 leading-relaxed text-lg mb-6">
                    Krousar Thmey offers a portfolio of cross-cutting programs and projects supporting <strong class="text-[#2d6fa3]">4,079 children</strong> in their development: Child Welfare, special and inclusive Education for Deaf or Blind Children, Cultural and Artistic Development, Academic and Career Counseling, as well as Health and Hygiene.
                </p>
                <p class="text-gray-600 leading-relaxed mb-6">
                    In the spirit of sustainable action, Krousar Thmey ensures that its support does not lead to any privilege, dependence or disparity in the community.
                </p>
                <div class="bg-[#2d6fa3] rounded-2xl p-6 text-white">
                    <p class="font-bold text-lg leading-snug uppercase tracking-wide">
                        Krousar Thmey's main principle is the development of projects<br>led by Cambodians for Cambodians.
                    </p>
                </div>
                <p class="text-gray-500 leading-relaxed text-sm mt-6">
                    Only two foreign volunteers provide the organization with support in communication, donor relations and project coordination. Apolitical and secular, the action of Krousar Thmey has been acknowledged internationally for its impact, capacity for innovation and sustainability.
                </p>
            </div>
            <div>
                <img src="{{ asset('images/children.jpg') }}" alt="Children at Krousar Thmey"
                     class="rounded-3xl shadow-2xl w-full h-[420px] object-cover">
            </div>
        </div>

        {{-- 3 Programs + 2 Projects --}}
        <div class="mb-20">
            <div class="text-center mb-10">
                <div class="inline-block bg-[#2d6fa3] text-white font-bold text-lg px-6 py-3 rounded-2xl mb-4">
                    Krousar Thmey operates 3 programs and 2 cross-cutting projects in 15 Cambodian provinces
                </div>
            </div>
            <div class="grid md:grid-cols-3 gap-6 mb-6">
                @foreach([
                    ['title'=>'Child Welfare',                      'img'=>'children.jpg',    'color'=>'bg-[#2d6fa3]',  'href'=>route('programs').'#welfare'],
                    ['title'=>'Education for Deaf or Blind Children','img'=>'special-ed.jpg',  'color'=>'bg-[#1d4e7a]',  'href'=>route('programs').'#education'],
                    ['title'=>'Cultural and Artistic Development',   'img'=>'cultural.jpg',    'color'=>'bg-[#8da83a]',  'href'=>route('programs').'#culture'],
                ] as $prog)
                <a href="{{ $prog['href'] }}" class="group block rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="relative h-44 overflow-hidden">
                        <img src="{{ asset('images/'.$prog['img']) }}" alt="{{ $prog['title'] }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    </div>
                    <div class="{{ $prog['color'] }} px-5 py-4">
                        <p class="text-white font-semibold text-sm">{{ $prog['title'] }}</p>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="grid md:grid-cols-2 gap-6 max-w-2xl mx-auto">
                @foreach([
                    ['title'=>'Academic and Career Counseling', 'img'=>'program.jpg',  'href'=>route('programs')],
                    ['title'=>'Health and Hygiene',             'img'=>'hygiene.jpg',  'href'=>route('programs')],
                ] as $proj)
                <a href="{{ $proj['href'] }}" class="group block rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                    <div class="relative h-36 overflow-hidden">
                        <img src="{{ asset('images/'.$proj['img']) }}" alt="{{ $proj['title'] }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    </div>
                    <div class="bg-[#2d6fa3]/80 px-5 py-3">
                        <p class="text-white font-semibold text-sm">{{ $proj['title'] }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        {{-- Key Figures --}}
        <div class="bg-[#1d4e7a] rounded-3xl p-10 mb-20">
            <h3 class="text-white font-bold text-2xl text-center mb-10 uppercase tracking-wider">Key Figures</h3>
            <div class="grid grid-cols-2 lg:grid-cols-5 gap-6 text-center">
                @foreach([
                    ['n'=>'4,079', 'label'=>'Children supported'],
                    ['n'=>'240',   'label'=>'In Child Welfare'],
                    ['n'=>'768',   'label'=>'Special Ed students'],
                    ['n'=>'1,088', 'label'=>'Arts & Culture students'],
                    ['n'=>'357',   'label'=>'Career counseling'],
                ] as $fig)
                <div class="text-white">
                    <div class="text-3xl lg:text-4xl font-black text-[#8da83a] mb-2">{{ $fig['n'] }}</div>
                    <div class="text-white/70 text-xs leading-snug">{{ $fig['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Worldwide --}}
        <div>
            <h3 class="text-2xl font-bold text-[#2d6fa3] mb-3">Krousar Thmey Worldwide</h3>
            <p class="text-gray-500 mb-8 text-sm leading-relaxed max-w-3xl">
                Krousar Thmey benefits from the support of various entities around the world. Their fundraising and communication networks greatly contribute to the success of all programs and projects.
            </p>
            <div class="grid md:grid-cols-3 gap-5">
                @forelse($offices as $office)
                <div class="bg-[#f8f9fc] border border-gray-100 rounded-2xl p-6 flex items-center gap-4 hover:border-[#2d6fa3]/30 hover:shadow-md transition-all">
                    <span class="text-4xl">{{ $office->flag ?? '🏢' }}</span>
                    <div>
                        <p class="font-bold text-[#2d6fa3] text-sm">{{ $office->name }}</p>
                        @if($office->country)
                        <p class="text-gray-400 text-xs">{{ $office->country }}</p>
                        @endif
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center text-gray-400 text-sm py-8">
                    Office information coming soon.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>

{{-- ========================================================
     OUR HISTORY
     ======================================================== --}}
<section id="history" class="py-20 bg-gradient-to-b from-white to-[#f8f9fc] scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6">
        {{-- Header --}}
        <div class="text-center mb-16">
            <p class="text-[#8da83a] font-bold text-sm uppercase tracking-widest mb-3 flex items-center justify-center gap-2">
                <span class="w-8 h-0.5 bg-[#8da83a]"></span>
                Our Journey
                <span class="w-8 h-0.5 bg-[#8da83a]"></span>
            </p>
            <h2 class="text-4xl md:text-5xl font-bold text-[#2d6fa3] mb-4">Our History</h2>
            <p class="text-gray-500 max-w-2xl mx-auto text-lg">Discover the milestones that have shaped Krousar Thmey since its founding in 1991</p>
        </div>

        @if($history->isEmpty())
        <div class="text-center py-16 bg-white rounded-3xl border border-gray-100 shadow-sm">
            <div class="text-6xl mb-4">📅</div>
            <p class="text-gray-400 text-lg">No history events have been added yet.</p>
        </div>
        @else
        @php
            $eventsByYear = $history->sortByDesc('year')->groupBy('year');
        @endphp
        <div class="relative">
            {{-- Vertical timeline line - centered --}}
            <div class="absolute left-1/2 top-0 bottom-0 w-0.5 bg-gradient-to-b from-[#2d6fa3] via-[#8da83a] to-[#2d6fa3] hidden md:block"></div>

            <div class="space-y-16">
                @foreach($eventsByYear as $year => $yearEvents)
                <div class="relative">
                    {{-- Year badge - centered on timeline --}}
                    <div class="flex justify-center mb-10">
                        <div class="relative z-20 bg-white border-2 border-[#2d6fa3] text-[#2d6fa3] font-bold text-xl px-8 py-3 rounded-full shadow-lg ring-4 ring-white">
                            {{ $year }}
                        </div>
                    </div>

                    @php
                        $leftEvents = $yearEvents->where('side', 'left');
                        $rightEvents = $yearEvents->where('side', 'right');
                        $hasLeft = $leftEvents->count() > 0;
                        $hasRight = $rightEvents->count() > 0;
                    @endphp

                    <div class="md:grid md:grid-cols-2 md:gap-16">
                        {{-- Left events --}}
                        @if($hasLeft)
                        <div class="relative md:pr-16">
                            {{-- Connector line to center --}}
                            <div class="hidden md:block absolute top-1/2 right-0 w-16 h-0.5 bg-gradient-to-l from-[#2d6fa3] to-transparent"></div>
                            {{-- Timeline dot --}}
                            <div class="hidden md:block absolute top-1/2 right-0 translate-x-1/2 -translate-y-1/2 w-5 h-5 rounded-full bg-[#2d6fa3] border-4 border-white shadow-md z-10"></div>

                            <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-500 hover:-translate-y-1 relative overflow-hidden group">
                                {{-- Left accent bar --}}
                                <div class="absolute top-0 left-0 w-1 h-full bg-[#2d6fa3]"></div>

                                @foreach($leftEvents as $event)
                                    @if($event->image)
                                    <div class="mb-5 overflow-hidden rounded-xl">
                                        <img src="{{ asset('storage/' . $event->image) }}" alt="History image {{ $year }}"
                                             class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-700">
                                    </div>
                                    @endif
                                @endforeach
                                <div class="space-y-4">
                                    @foreach($leftEvents as $event)
                                        <div class="pl-4">
                                            <p class="text-gray-700 leading-relaxed">{!! $event->event !!}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @else
                        {{-- Empty left column to maintain grid --}}
                        <div></div>
                        @endif

                        {{-- Right events --}}
                        @if($hasRight)
                        <div class="relative md:pl-16 mt-8 md:mt-0">
                            {{-- Connector line to center --}}
                            <div class="hidden md:block absolute top-1/2 left-0 w-16 h-0.5 bg-gradient-to-r from-[#8da83a] to-transparent"></div>
                            {{-- Timeline dot --}}
                            <div class="hidden md:block absolute top-1/2 left-0 -translate-x-1/2 -translate-y-1/2 w-5 h-5 rounded-full bg-[#8da83a] border-4 border-white shadow-md z-10"></div>

                            <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 hover:shadow-2xl transition-all duration-500 hover:-translate-y-1 relative overflow-hidden group">
                                {{-- Right accent bar --}}
                                <div class="absolute top-0 right-0 w-1 h-full bg-[#8da83a]"></div>

                                <div class="space-y-4">
                                    @foreach($rightEvents as $event)
                                        <div class="pr-4">
                                            <p class="text-gray-700 leading-relaxed">{!! $event->event !!}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @else
                        {{-- Empty right column to maintain grid --}}
                        <div></div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>

{{-- ========================================================
     AWARDS
     ======================================================== --}}
<section id="awards" class="py-20 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <p class="text-[#8da83a] font-bold text-sm uppercase tracking-widest mb-3">Recognition</p>
            <h2 class="text-4xl font-bold text-[#2d6fa3]">Awards</h2>
        </div>

        {{-- Awards from DB --}}
        @if($awards->isNotEmpty())
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($awards as $award)
            <div class="bg-[#f8f9fc] rounded-3xl p-6 border border-gray-100 hover:shadow-lg transition-shadow text-center">
                <div class="text-4xl mb-4">{{ $award->icon }}</div>
                @if($award->recipient)
                <span class="text-[#8da83a] text-xs font-bold uppercase tracking-wider block mb-1">{{ $award->recipient }}</span>
                @endif
                <h3 class="text-sm font-bold text-[#2d6fa3] mb-2 leading-snug">{{ $award->title }}</h3>
                <p class="text-[#8da83a] text-xs font-semibold mb-2">{{ $award->organization }}</p>
                @if($award->description)
                <p class="text-gray-400 text-xs leading-relaxed">{{ $award->description }}</p>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-400 text-center py-8">No awards listed yet.</p>
        @endif
    </div>
</section>

{{-- ========================================================
     PARTNERS
     ======================================================== --}}
<section id="partners" class="py-20 bg-[#f8f9fc] scroll-mt-20"
         x-data="{ category: 'all', search: '' }">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <p class="text-[#8da83a] font-bold text-sm uppercase tracking-widest mb-3">Support</p>
            <h2 class="text-4xl font-bold text-[#2d6fa3]">Partners</h2>
            <p class="text-gray-500 mt-4 max-w-3xl mx-auto text-sm leading-relaxed">
                Since its creation, Krousar Thmey has set up long-term partnerships with Cambodian and international organizations. Donors can financially support a program or project of their choice. Technical partners allow us to benefit from specific expertise.
            </p>
        </div>

        {{-- Search & Filter Controls --}}
        <div class="mb-10 max-w-2xl mx-auto space-y-4">
            <div class="relative">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" x-model="search" placeholder="Search partners..."
                       class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-200 focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/20 transition-all outline-none text-sm bg-white">
            </div>
            <div class="flex flex-wrap justify-center gap-2">
                <button @click="category = 'all'"
                        :class="category === 'all' ? 'bg-[#2d6fa3] text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200'"
                        class="px-5 py-2 rounded-full text-sm font-medium transition-all">All Partners</button>
                @foreach ($partnerCategories as $cat)
                    <button @click="category = 'cat_{{ $cat->id }}'"
                            :class="category === 'cat_{{ $cat->id }}' ? 'bg-[#2d6fa3] text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200'"
                            class="px-5 py-2 rounded-full text-sm font-medium transition-all">{{ $cat->name }}</button>
                @endforeach
            </div>
        </div>

        {{-- Partnerships with Cambodian Authorities --}}
        <div class="bg-white rounded-3xl p-8 lg:p-10 border border-gray-100 shadow-sm mb-8"
             x-show="category === 'all' || category === 'cat_{{ $partnerCategories->firstWhere('name', 'Authorities')?->id }}">
            <h3 class="text-xl font-bold text-[#2d6fa3] mb-4 flex items-center gap-3">
                <span class="text-2xl">🇰🇭</span> Partnerships with the Cambodian Authorities
            </h3>
            <p class="text-gray-500 text-sm leading-relaxed mb-6">
                Krousar Thmey constantly seeks to develop and maintain lasting relations with the Cambodian authorities. «&nbsp;Memorandums of understanding&nbsp;» are regularly renewed between Krousar Thmey and governing authorities:
            </p>
            <div class="grid md:grid-cols-3 gap-4 mb-6">
                @foreach([
                    ['ministry'=>'Ministry of Education, Youth and Sport','prog'=>'Education for Deaf or Blind Children Program'],
                    ['ministry'=>'Ministry of Social Affairs',            'prog'=>'Child Welfare Program'],
                    ['ministry'=>'Ministry of Culture and Fine Arts',     'prog'=>'Cultural and Artistic Development Program'],
                ] as $mou)
                <div class="bg-[#2d6fa3]/5 border border-[#2d6fa3]/15 rounded-xl p-5">
                    <p class="text-[#2d6fa3] font-bold text-sm mb-1">{{ $mou['ministry'] }}</p>
                    <p class="text-gray-500 text-xs">{{ $mou['prog'] }}</p>
                </div>
                @endforeach
            </div>
            <div class="bg-[#8da83a]/10 border border-[#8da83a]/20 rounded-xl p-4 text-sm text-gray-600">
                Whether for an inauguration or to show their support, H.M. the King, the Prime Minister and his wife, as well as members of the royal family, regularly visit Krousar Thmey's structures. From 2020 onwards, Krousar Thmey works collaboratively with the Ministry of Education, Youth and Sport on the Education for Deaf or Blind Children Program.
            </div>
        </div>

        {{-- Dynamic partner category sections from DB --}}
        @php
            $categoryDisplayConfig = [
                'Authorities' => ['title' => 'Cambodian Public Authorities', 'dot' => 'bg-[#2d6fa3]', 'bgClass' => 'bg-white'],
                'Organizations' => ['title' => 'Organizations, Foundations & Institutions', 'dot' => 'bg-[#8da83a]', 'bgClass' => 'bg-white'],
                'Companies' => ['title' => 'Companies', 'dot' => 'bg-[#1d4e7a]', 'bgClass' => 'bg-white'],
                'Towns' => ['title' => 'Towns and Municipalities — Switzerland', 'dot' => 'bg-[#2d6fa3]', 'bgClass' => 'bg-[#2d6fa3]/5'],
            ];
        @endphp

        @foreach ($partnerCategories as $cat)
            @if ($cat->partners->isNotEmpty())
                @php $config = $categoryDisplayConfig[$cat->name] ?? ['title' => $cat->name, 'dot' => 'bg-[#2d6fa3]', 'bgClass' => 'bg-white']; @endphp
                <div class="{{ $config['bgClass'] }} rounded-3xl p-8 border border-gray-100 shadow-sm mb-8"
                     x-show="category === 'all' || category === 'cat_{{ $cat->id }}'">
                    <h3 class="text-lg font-bold text-[#2d6fa3] mb-6 flex items-center gap-2">
                        @if ($cat->name === 'Towns')
                            <span>🇨🇭</span>
                        @endif
                        {{ $config['title'] }}
                    </h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($cat->partners as $partner)
                            @php $ps = json_encode(strtolower($partner->name)); @endphp
                            <div class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 bg-[#f8f9fc] hover:border-[#2d6fa3]/20 hover:shadow-sm transition-all"
                                 x-show="search === '' || {{ $ps }}.includes(search.toLowerCase())">
                                @if ($partner->logo)
                                    <div class="w-16 h-16 rounded-xl bg-white border border-gray-100 flex items-center justify-center overflow-hidden flex-shrink-0">
                                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                             class="max-w-full max-h-full object-contain p-2">
                                    </div>
                                @else
                                    <div class="w-16 h-16 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                                        <span class="text-lg font-bold text-blue-500">{{ Str::substr($partner->name, 0, 1) }}</span>
                                    </div>
                                @endif
                                <span class="text-sm font-medium text-gray-700 leading-tight">{{ $partner->name }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach

        {{-- CTA --}}
        <div class="text-center bg-[#2d6fa3] rounded-3xl p-10">
            <p class="text-white/80 text-lg mb-2">Many thanks to all our partners for their support!</p>
            <h3 class="text-white font-bold text-2xl mb-6">Do you wish to get involved with Krousar Thmey?</h3>
            <a href="{{ route('involved') }}" class="btn-primary text-base">Learn More</a>
        </div>
    </div>
</section>

{{-- ========================================================
     TRANSPARENCY AND ACCOUNTABILITY
     ======================================================== --}}
<section id="transparency" class="py-20 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <p class="text-[#8da83a] font-bold text-sm uppercase tracking-widest mb-3">Accountability</p>
            <h2 class="text-4xl font-bold text-[#2d6fa3]">Transparency & Accountability</h2>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 mb-16">

            {{-- Financial Transparency --}}
            <div>
                <h3 class="text-2xl font-bold text-[#2d6fa3] mb-5 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#2d6fa3] flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 11h.01M12 11h.01M15 11h.01M9 14h.01M12 14h.01M15 14h.01M3 6a2 2 0 012-2h14a2 2 0 012 2v10a2 2 0 01-2 2H5a2 2 0 01-2-2V6z"/></svg>
                    </div>
                    Financial Transparency
                </h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Financial transparency is a key principle for Krousar Thmey. Everybody has the right to know how the funds raised are used. The implementation of programs and projects is our priority.
                </p>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Thanks to strict financial management and the involvement of European volunteers, <strong class="text-[#2d6fa3]">all administrative costs remain under 4% of the total budget.</strong>
                </p>
                <p class="text-gray-600 leading-relaxed mb-6">
                    Krousar Thmey Cambodia's accounts are all audited and certified each year by an independent audit firm (<strong>PricewaterhouseCoopers since 2013</strong> and KPMG before then). Working closely with the auditors, Krousar Thmey is committed to constantly improving the quality and precision of its financial processes.
                </p>
                <div class="grid grid-cols-2 gap-4">
                    @foreach([
                        ['v'=>'< 4%',   'l'=>'Administrative costs'],
                        ['v'=>'100%',   'l'=>'Funds reach the children'],
                        ['v'=>'Annual', 'l'=>'Independent audit (PwC)'],
                        ['v'=>'2013',   'l'=>'PricewaterhouseCoopers since'],
                    ] as $fig)
                    <div class="bg-[#f8f9fc] rounded-2xl p-5 border border-gray-100">
                        <div class="text-2xl font-black text-[#2d6fa3] mb-1">{{ $fig['v'] }}</div>
                        <div class="text-gray-500 text-xs">{{ $fig['l'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- Audited Statements --}}
            <div>
                <h3 class="text-2xl font-bold text-[#2d6fa3] mb-5 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#8da83a] flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    Audited Financial Statements
                </h3>
                <p class="text-gray-500 text-sm mb-6">Audited statements are available for download. Our French and Swiss organisations' accounts are also audited annually.</p>
                <div class="space-y-3">
                    @foreach([2021, 2020, 2019, 2018, 2017, 2016] as $year)
                    <a href="{{ route('resources') }}"
                       class="flex items-center justify-between bg-[#f8f9fc] border border-gray-100 rounded-xl px-5 py-4 hover:border-[#2d6fa3]/30 hover:shadow-sm transition-all group">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-[#2d6fa3] flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <span class="text-gray-700 font-medium text-sm">Audited Financial Statement {{ $year }}</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-300 group-hover:text-[#2d6fa3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Origins of Funds --}}
        <div class="bg-[#f8f9fc] rounded-3xl p-8 lg:p-10 border border-gray-100">
            <h3 class="text-2xl font-bold text-[#2d6fa3] mb-5 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#1d4e7a] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                </div>
                Origins of the Funds
            </h3>
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <p class="text-gray-600 leading-relaxed mb-4 text-sm">
                        In support of its local activity in Cambodia, Krousar Thmey benefits from the involvement of volunteers in international entities: Krousar Thmey France, Krousar Thmey Switzerland and Krousar Thmey Singapore. As their main activity is fundraising, these branches are a privileged relay to donors outside of Cambodia.
                    </p>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Donations received in Cambodia come mainly from non-governmental organizations and to a lesser extent from private donors and the Cambodian authorities.
                    </p>
                </div>
                <div>
                    <p class="text-gray-600 leading-relaxed mb-4 text-sm">
                        Financial or in-kind donations from the Cambodian authorities have increased steadily over the past few years, accounting for nearly <strong class="text-[#2d6fa3]">8% of Krousar Thmey's resources</strong>. All staff of special schools for deaf or blind children are civil servants of the Ministry of Education, Youth and Sports.
                    </p>
                    <div class="bg-[#8da83a]/10 border border-[#8da83a]/20 rounded-xl p-4 text-sm text-gray-600">
                        🏆 Krousar Thmey won the label <strong>Ideas</strong> in 2010 — recognising organisations committed to social innovation and impact.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection