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
            <a href="{{ route('presentation') }}"
               class="px-5 py-2 rounded-full bg-white/15 text-white text-sm font-medium hover:bg-white/25 transition-colors border border-white/20">
                Presentation
            </a>
            <a href="#values"
               class="px-5 py-2 rounded-full bg-white/15 text-white text-sm font-medium hover:bg-white/25 transition-colors border border-white/20">
                Our Values
            </a>
            <a href="#history"
               class="px-5 py-2 rounded-full bg-white/15 text-white text-sm font-medium hover:bg-white/25 transition-colors border border-white/20">
                History
            </a>
            <a href="#awards"
               class="px-5 py-2 rounded-full bg-white/15 text-white text-sm font-medium hover:bg-white/25 transition-colors border border-white/20">
                Awards
            </a>
            <a href="#partners"
               class="px-5 py-2 rounded-full bg-white/15 text-white text-sm font-medium hover:bg-white/25 transition-colors border border-white/20">
                Partners
            </a>
            <a href="{{ route('transparency') }}"
               class="px-5 py-2 rounded-full bg-white/15 text-white text-sm font-medium hover:bg-white/25 transition-colors border border-white/20">
                Transparency
            </a>
        </div>
    </div>
</div>

{{-- ========================================================
     OUR VALUES
     ======================================================== --}}
<section id="values" class="py-20 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16" data-reveal>
            <p class="text-[#2d6fa3] font-bold text-sm uppercase tracking-widest mb-4">Our Values</p>
            <h2 class="text-4xl font-bold text-[#2d6fa3] mb-8">Core Values</h2>
            
            <p class="text-gray-700 max-w-3xl mx-auto leading-relaxed">
                Krousar Thmey offers a portfolio of cross-cutting programs and projects supporting 4,079 children in their development: Child Welfare, special and inclusive Education for Deaf or Blind Children, Cultural and Artistic Development, Academic and Career Counseling, as well as Health and Hygiene. In the spirit of sustainable action, Krousar Thmey ensures that its support does not lead to any privilege, dependence or disparity in the community.
            </p>
        </div>

        @php $valueAccents = ['#2d6fa3', '#8da83a', '#e8a020', '#1d4e7a']; @endphp
        <div class="grid md:grid-cols-3 gap-7">
            @forelse($coreValues as $i => $value)
            @php
                $accent = $valueAccents[$i % count($valueAccents)];
                $valueFallbackStyle = "background: linear-gradient(135deg, {$accent}, #1a3c6e)";
                $valueAccentBarStyle = "background: {$accent}";
            @endphp
            <a href="{{ route('core-values.show', $value) }}" class="group bg-white rounded-[28px] border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden block"
                 data-reveal="scale" style="--reveal-delay: {{ $i * 100 }}">
                <div class="relative h-44 overflow-hidden">
                    @if($value->image_url)
                    <img src="{{ $value->image_url }}" alt="{{ $value->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-6xl drop-shadow-md" style="{{ $valueFallbackStyle }}">{{ $value->icon }}</div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/10 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 px-6 py-4">
                        <h3 class="text-white font-bold text-lg drop-shadow-sm">{{ $value->title }}</h3>
                    </div>
                </div>
                <div class="p-6 text-center">
                    <div class="w-10 h-1 rounded-full mx-auto mb-4 group-hover:w-16 transition-all duration-300" style="{{ $valueAccentBarStyle }}"></div>
                    <p class="text-gray-500 text-sm leading-relaxed">{{ $value->description }}</p>
                    @if($value->supporting_description)
                    <p class="text-gray-400 text-xs mt-2 line-clamp-2">{{ $value->supporting_description }}</p>
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
     OUR HISTORY
     ======================================================== --}}
<section id="history" class="pt-10 pb-20 bg-white scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6">
        {{-- Header --}}
        <div class="text-center mb-16" data-reveal>
            <p class="text-[#a67c3d] font-semibold text-sm uppercase tracking-[0.2em] mb-4 flex items-center justify-center gap-3">
                <span class="w-8 h-px bg-[#c9a45c]"></span>
                Our Journey Since 1991
                <span class="w-8 h-px bg-[#c9a45c]"></span>
            </p>
            <h2 class="font-serif text-4xl md:text-5xl font-bold text-[#1d4e7a] mb-4">A Story of Hope and Resilience</h2>
            <p class="text-gray-500 max-w-2xl mx-auto text-lg leading-relaxed">From a single orphanage in a refugee camp to a nationwide movement for Cambodia's children — every milestone below was made possible by people who believed in a better future.</p>
        </div>

        @php
            $timelineItems = [];
            foreach ($historyEvents as $event) {
                if ($event->left_text) {
                    $timelineItems[] = ['year' => $event->year, 'text' => $event->left_text, 'image' => $event->image_url];
                }
                if ($event->right_text) {
                    $timelineItems[] = ['year' => $event->year, 'text' => $event->right_text, 'image' => $event->left_text ? null : $event->image_url];
                }
                if (!$event->left_text && !$event->right_text && $event->image_url) {
                    $timelineItems[] = ['year' => $event->year, 'text' => null, 'image' => $event->image_url];
                }
            }
        @endphp

        <div class="relative">
            <div class="absolute left-1/2 top-0 bottom-0 w-px bg-gradient-to-b from-[#e8d7ae] via-[#c9a45c] to-[#e8d7ae] hidden md:block"></div>
            <div class="hidden md:flex justify-center mb-8">
                <div class="relative z-10 w-4 h-4 rounded-full border-2 border-[#c9a45c] bg-white"></div>
            </div>

            <div class="space-y-12">
                @forelse($timelineItems as $item)
                @php
                    $onLeft  = $loop->index % 2 === 0;
                    $rotate  = $loop->index % 2 === 0 ? '-rotate-1' : 'rotate-1';
                    $stagger = $loop->index % 2 === 1 ? 'md:mt-10' : '';
                @endphp
                <div class="relative {{ $stagger }}" data-reveal="scale" style="--reveal-delay: {{ min($loop->index * 70, 350) }}">
                    <div class="hidden md:flex justify-center absolute left-1/2 -translate-x-1/2 top-10 z-10">
                        <div class="w-3 h-3 rounded-full bg-[#c9a45c] ring-4 ring-white shadow"></div>
                    </div>

                    <div class="md:grid md:grid-cols-2 md:gap-16">
                        @if($onLeft)
                        <div class="relative mb-8 md:mb-0 md:pr-8">
                            <div class="hidden md:block absolute right-8 top-12 w-8 h-px bg-[#c9a45c]/50"></div>
                            @if($loop->first)
                            <p class="max-w-sm mx-auto md:mx-0 md:ml-auto text-right text-[#a67c3d] text-xs font-semibold uppercase tracking-[0.15em] mb-2">The Beginning</p>
                            @endif
                            <div class="max-w-sm mx-auto md:mx-0 md:ml-auto text-right">
                                @if($item['image'])
                                <div class="inline-block bg-white p-2 border border-[#e8d7ae] shadow-md {{ $rotate }} hover:rotate-0 transition-transform duration-300">
                                    <img src="{{ $item['image'] }}" alt="History event image" class="w-full h-48 object-cover" style="filter: sepia(0.12) saturate(1.05);">
                                </div>
                                @endif
                                <div class="relative {{ $item['image'] ? '-mt-5 mr-4' : '' }} inline-flex items-center justify-center min-w-[3.5rem] h-14 px-2 rounded-full bg-gradient-to-br from-[#d9b877] to-[#a67c3d] ring-4 ring-white shadow-lg">
                                    <span class="font-serif font-bold text-black whitespace-nowrap {{ strlen((string) $item['year']) > 4 ? 'text-xs' : 'text-sm' }}">{{ $item['year'] }}</span>
                                </div>
                                @if($item['text'])
                                <p class="text-gray-600 text-sm leading-relaxed mt-3">{{ $item['text'] }}</p>
                                @endif
                            </div>
                        </div>
                        <div></div>
                        @else
                        <div></div>
                        <div class="relative md:pl-8">
                            <div class="hidden md:block absolute left-8 top-12 w-8 h-px bg-[#c9a45c]/50"></div>
                            <div class="max-w-sm mx-auto md:mx-0">
                                @if($item['image'])
                                <div class="inline-block bg-white p-2 border border-[#e8d7ae] shadow-md {{ $rotate }} hover:rotate-0 transition-transform duration-300">
                                    <img src="{{ $item['image'] }}" alt="History event image" class="w-full h-48 object-cover" style="filter: sepia(0.12) saturate(1.05);">
                                </div>
                                @endif
                                <div class="relative {{ $item['image'] ? '-mt-5 ml-4' : '' }} inline-flex items-center justify-center min-w-[3.5rem] h-14 px-2 rounded-full bg-gradient-to-br from-[#d9b877] to-[#a67c3d] ring-4 ring-white shadow-lg">
                                    <span class="font-serif font-bold text-black whitespace-nowrap {{ strlen((string) $item['year']) > 4 ? 'text-xs' : 'text-sm' }}">{{ $item['year'] }}</span>
                                </div>
                                @if($item['text'])
                                <p class="text-gray-600 text-sm leading-relaxed mt-3">{{ $item['text'] }}</p>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @empty
                <p class="text-gray-400 text-center py-8">No history events yet.</p>
                @endforelse
            </div>

            @if(count($timelineItems) > 0)
            <div class="relative mt-16 pt-14 border-t border-[#e8d7ae] text-center" data-reveal="scale">
                <div class="hidden md:flex justify-center absolute left-1/2 -translate-x-1/2 -top-2.5 z-10">
                    <div class="w-4 h-4 rounded-full border-2 border-[#c9a45c] bg-white"></div>
                </div>
                <p class="text-[#a67c3d] font-semibold text-xs uppercase tracking-[0.2em] mb-3">Present Day</p>
                <h3 class="font-serif text-2xl md:text-3xl font-bold text-[#1d4e7a] mb-4">The Story Continues</h3>
                <p class="text-gray-500 max-w-2xl mx-auto leading-relaxed">
                    Today, Krousar Thmey supports <strong class="text-[#1d4e7a]">{{ $settings['stat_children'] ?? '4,079' }} children</strong> across 15 Cambodian provinces — carrying forward the same promise made in 1991: that every child deserves the chance to grow, learn, and thrive.
                </p>
            </div>
            @endif
        </div>
    </div>
</section>

{{-- ========================================================
     AWARDS
     ======================================================== --}}
<section id="awards" class="pt-10 pb-20 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16" data-reveal>
            <p class="text-[#8da83a] font-bold text-sm uppercase tracking-widest mb-3">Recognition</p>
            <h2 class="text-4xl font-bold text-[#2d6fa3]">Awards</h2>
        </div>

        @if($awards->isNotEmpty())
        @php $awardAccents = ['#2d6fa3', '#8da83a', '#e8a020', '#1d4e7a']; @endphp
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($awards as $i => $award)
            @php
                $accent = $awardAccents[$i % count($awardAccents)];
                $awardFallbackStyle = "background: linear-gradient(135deg, {$accent}, #1a3c6e)";
                $awardAccentBarStyle = "background: {$accent}";
            @endphp
            <div class="group bg-white rounded-[24px] border border-gray-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 overflow-hidden"
                 data-reveal="scale" style="--reveal-delay: {{ min($i * 90, 360) }}">
                <div class="relative h-32 overflow-hidden">
                    @if($award->image_url)
                    <img src="{{ $award->image_url }}" alt="{{ $award->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                    @else
                    <div class="w-full h-full flex items-center justify-center text-4xl drop-shadow-md" style="{{ $awardFallbackStyle }}">🏆</div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/10 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 right-0 px-4 py-3">
                        <p class="text-white font-bold text-sm leading-snug drop-shadow-sm">{{ $award->title }}</p>
                    </div>
                </div>
                <div class="p-5 text-center">
                    <div class="w-8 h-1 rounded-full mx-auto mb-3 group-hover:w-12 transition-all duration-300" style="{{ $awardAccentBarStyle }}"></div>
                    @if($award->recipient)
                    <span class="text-[#8da83a] text-xs font-bold uppercase tracking-wider block mb-1">{{ $award->recipient }}</span>
                    @endif
                    <p class="text-[#8da83a] text-xs font-semibold mb-2">{{ $award->organization }}</p>
                    @if($award->description)
                    <p class="text-gray-400 text-xs leading-relaxed mb-3">{{ $award->description }}</p>
                    @endif
                    
                    @if($award->website_url || $award->article_url || $award->video_url)
                    <div class="flex flex-wrap gap-2 justify-center">
                        @if($award->website_url)
                        <a href="{{ $award->website_url }}" target="_blank" 
                           class="px-3 py-1.5 bg-[#2d6fa3] text-white text-xs font-medium rounded-lg hover:bg-[#1d4e7a] transition-colors">
                            Visit Website
                        </a>
                        @endif
                        @if($award->article_url)
                        <a href="{{ $award->article_url }}" target="_blank"
                           class="px-3 py-1.5 bg-[#8da83a] text-white text-xs font-medium rounded-lg hover:bg-[#6b8a2b] transition-colors">
                            Read Article
                        </a>
                        @endif
                        @if($award->video_url)
                        <a href="{{ $award->video_url }}" target="_blank"
                           class="px-3 py-1.5 bg-red-500 text-white text-xs font-medium rounded-lg hover:bg-red-600 transition-colors">
                            Watch Video
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
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
        <div class="text-center mb-12" data-reveal>
            <p class="text-[#8da83a] font-bold text-sm uppercase tracking-widest mb-3">Support</p>
            <h2 class="text-4xl font-bold text-[#2d6fa3]">Partners</h2>
            <p class="text-gray-500 mt-4 max-w-3xl mx-auto text-sm leading-relaxed">
                Since its creation, Krousar Thmey has set up long-term partnerships with Cambodian and international organizations. Donors can financially support a program or project of their choice. Technical partners allow us to benefit from specific expertise.
            </p>
        </div>

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
                @foreach ($partnersByCategory as $cat => $partners)
                    <button @click="category = 'cat_{{ $cat }}'"
                            :class="category === 'cat_{{ $cat }}' ? 'bg-[#2d6fa3] text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200'"
                            class="px-5 py-2 rounded-full text-sm font-medium transition-all">{{ $cat }}</button>
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-3xl p-8 lg:p-10 border border-gray-100 shadow-sm mb-8"
             x-show="category === 'all' || category === 'cat_Authorities'">
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

        @php
            $categoryDisplayConfig = [
                'Authorities' => ['title' => 'Cambodian Public Authorities', 'dot' => 'bg-[#2d6fa3]', 'bgClass' => 'bg-white'],
                'Organizations' => ['title' => 'Organizations, Foundations & Institutions', 'dot' => 'bg-[#8da83a]', 'bgClass' => 'bg-white'],
                'Companies' => ['title' => 'Companies', 'dot' => 'bg-[#1d4e7a]', 'bgClass' => 'bg-white'],
                'Towns' => ['title' => 'Towns and Municipalities — Switzerland', 'dot' => 'bg-[#2d6fa3]', 'bgClass' => 'bg-[#2d6fa3]/5'],
            ];
        @endphp

        @foreach ($partnersByCategory as $cat => $partners)
            @if ($partners->isNotEmpty())
                @php $config = $categoryDisplayConfig[$cat] ?? ['title' => $cat, 'dot' => 'bg-[#2d6fa3]', 'bgClass' => 'bg-white']; @endphp
                <div class="{{ $config['bgClass'] }} rounded-3xl p-8 border border-gray-100 shadow-sm mb-8"
                     x-show="category === 'all' || category === 'cat_{{ $cat }}'">
                    <h3 class="text-lg font-bold text-[#2d6fa3] mb-6 flex items-center gap-2">
                        @if ($cat === 'Towns')
                            <span>🇨🇭</span>
                        @endif
                        {{ $config['title'] }}
                    </h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($partners as $partner)
                            @php $ps = json_encode(strtolower($partner->name)); @endphp
                            <div class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 bg-[#f8f9fc] hover:border-[#2d6fa3]/20 hover:shadow-sm transition-all"
                                 x-show="search === '' || {{ $ps }}.includes(search.toLowerCase())">
                                @if ($partner->logo_url)
                                    <div class="w-16 h-16 rounded-xl bg-white border border-gray-100 flex items-center justify-center overflow-hidden flex-shrink-0">
                                        <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}"
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

        <div class="text-center bg-[#2d6fa3] rounded-3xl p-10" data-reveal="scale">
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
        <div class="text-center mb-16" data-reveal>
            <p class="text-[#8da83a] font-bold text-sm uppercase tracking-widest mb-3">Accountability</p>
            <h2 class="text-4xl font-bold text-[#2d6fa3]">Transparency & Accountability</h2>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 mb-16">

            <div data-reveal="left">
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

            <div data-reveal="right">
                <h3 class="text-2xl font-bold text-[#2d6fa3] mb-5 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-[#8da83a] flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    Audited Financial Statements
                </h3>
                <p class="text-gray-500 text-sm mb-6">Audited statements are available for download. Our French and Swiss organisations' accounts are also audited annually.</p>
                <div class="space-y-3">
                    @forelse($reports as $report)
                    <a href="{{ $report->download_url }}"
                       {{ $report->download_url !== '#' ? 'target="_blank"' : '' }}
                       class="flex items-center justify-between bg-[#f8f9fc] border border-gray-100 rounded-xl px-5 py-4 hover:border-[#2d6fa3]/30 hover:shadow-sm transition-all group">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-lg bg-[#2d6fa3] flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <span class="text-gray-700 font-medium text-sm">{{ $report->title }}</span>
                        </div>
                        <svg class="w-4 h-4 text-gray-300 group-hover:text-[#2d6fa3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    </a>
                    @empty
                    <p class="text-gray-400 text-sm">No reports available yet. <a href="{{ route('resources') }}" class="text-[#2d6fa3] hover:underline">View resources page</a>.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="bg-[#f8f9fc] rounded-3xl p-8 lg:p-10 border border-gray-100" data-reveal>
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