@extends('layouts.app')

@section('title', 'Our Programs — Krousar Thmey')
@section('description', 'Discover Krousar Thmey\'s three core programs: child welfare, special education for deaf and blind children, and cultural and artistic development.')

@section('content')

{{-- Page Header --}}
<div class="bg-[#1a3c6e] pt-16 pb-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/60 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white">Our Programs</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Our Programs</h1>
        <p class="text-white/70 text-lg max-w-2xl">
            Three comprehensive programs across 15 Cambodian provinces, reaching over 4,000 children every year.
        </p>
    </div>
</div>

{{-- Program Overview --}}
@php
    $programColours = ['bg-[#1a3c6e]', 'bg-[#e8a020]', 'bg-[#2554a0]'];
@endphp
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-3 gap-6">
            @forelse($programs as $i => $program)
            <a href="#program-{{ $program->slug ?? $loop->index }}"
               class="{{ $programColours[$i % 3] }} rounded-2xl p-7 text-white hover:opacity-90 transition-opacity block group">
                @if($program->stats && is_array($program->stats))
                <div class="text-2xl font-bold mb-1">{{ $program->stats['count'] ?? $program->stats[array_key_first($program->stats)] ?? 'Active' }}</div>
                @else
                <div class="text-2xl font-bold mb-1">Active</div>
                @endif
                <div class="font-semibold text-white/80 group-hover:text-white transition-colors">{{ $program->title }}</div>
            </a>
            @empty
            @foreach([
                ['id' => 'welfare', 'title' => 'Child Welfare', 'count' => '240 children', 'color' => 'bg-[#1a3c6e]'],
                ['id' => 'education', 'title' => 'Education for Deaf & Blind', 'count' => '768 students', 'color' => 'bg-[#e8a020]'],
                ['id' => 'culture', 'title' => 'Cultural Development', 'count' => '1,088 students', 'color' => 'bg-[#2554a0]'],
            ] as $prog)
            <a href="#{{ $prog['id'] }}" class="{{ $prog['color'] }} rounded-2xl p-7 text-white hover:opacity-90 transition-opacity block group">
                <div class="text-2xl font-bold mb-1">{{ $prog['count'] }}</div>
                <div class="font-semibold text-white/80 group-hover:text-white transition-colors">{{ $prog['title'] }}</div>
            </a>
            @endforeach
            @endforelse
        </div>
    </div>
</section>

{{-- Program Detail Sections --}}
@php
    $fallbackPrograms = [
        'child-welfare' => [
            'title' => 'Child Welfare Program',
            'number' => 'Program 1',
            'description' => 'Our child welfare program provides a safety net for Cambodia\'s most vulnerable children — those who are orphaned, abandoned, trafficked, or living on the streets. We offer both temporary and long-term protection, always with the goal of family reunification where possible.',
            'full_description' => 'We follow a child-centered, family-based approach. Our family houses replicate the warmth of a real home, with house parents who provide stability and care. For children who cannot return to their families, we work toward safe and appropriate integration into the community.',
            'stats' => [
                ['title' => '2', 'label' => 'Temporary Protection Centers'],
                ['title' => '2', 'label' => 'Long-term Centers'],
                ['title' => '2', 'label' => 'Family Houses'],
                ['title' => '240', 'label' => 'Children Directly Supported'],
            ],
            'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=700&q=80',
            'images_sm' => [
                'https://images.unsplash.com/photo-1527689368864-3a821dbccc34?w=400&q=80',
                'https://images.unsplash.com/photo-1516627145497-ae6968895b40?w=400&q=80',
            ],
            'bg' => 'bg-[#f8f9fc]',
        ],
        'education-for-deaf-blind' => [
            'title' => 'Education for Deaf & Blind Children',
            'number' => 'Program 2',
            'description' => 'In Cambodia, children with hearing or visual impairments have historically been excluded from mainstream education. Krousar Thmey operates five specialized high schools that provide a full curriculum adapted for deaf and blind students.',
            'full_description' => 'Our schools use Cambodian Sign Language and Braille, train specialized teachers, and provide parent support workshops to ensure families understand how to support their children\'s learning at home.',
            'stats' => [
                ['title' => '5', 'label' => 'Specialized High Schools'],
                ['title' => '768', 'label' => 'Students Enrolled'],
                ['title' => 'KSL', 'label' => 'Cambodian Sign Language'],
                ['title' => 'Braille', 'label' => 'Visual Impairment Support'],
            ],
            'image' => 'https://images.unsplash.com/photo-1497486751825-1233686d5d80?w=700&q=80',
            'images_sm' => [
                'https://images.unsplash.com/photo-1580582932707-520aed937b7b?w=400&q=80',
                'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=400&q=80',
            ],
            'bg' => 'bg-white',
            'reverse' => true,
        ],
        'cultural-development' => [
            'title' => 'Cultural & Artistic Development',
            'number' => 'Program 3',
            'description' => 'Cambodia\'s Khmer arts and culture were severely disrupted during the Khmer Rouge era. The School of Khmer Arts and Culture was founded to preserve and pass on this irreplaceable heritage to a new generation of young Cambodians.',
            'full_description' => 'Students learn traditional dance, classical music, shadow puppetry, and visual arts. The school also performs regularly at cultural events, using the arts to advocate for children\'s rights and raise awareness of our mission.',
            'stats' => [
                ['title' => '1,088', 'label' => 'Students Enrolled'],
                ['title' => '1', 'label' => 'School of Khmer Arts'],
                ['title' => 'Dance', 'label' => 'Traditional Khmer Dance'],
                ['title' => 'Music', 'label' => 'Classical Instruments'],
            ],
            'image' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?w=700&q=80',
            'images_sm' => [
                'https://images.unsplash.com/photo-1520523839897-bd0b52f945a0?w=400&q=80',
                'https://images.unsplash.com/photo-1547036967-23d11aacaee0?w=400&q=80',
            ],
            'bg' => 'bg-[#f8f9fc]',
        ],
    ];

    // Merge DB programs with fallback data
    $progData = [];
    foreach ($programs as $program) {
        $slug = $program->slug ?? 'program-' . $loop->index;
        $fallback = $fallbackPrograms[$slug] ?? $fallbackPrograms[array_keys($fallbackPrograms)[$loop->index % 3]] ?? [];
        $progData[] = [
            'slug' => $slug,
            'title' => $program->title ?? $fallback['title'],
            'number' => $fallback['number'] ?? 'Program',
            'description' => $program->description ?? $fallback['description'] ?? '',
            'full_description' => $program->full_description ?? $fallback['full_description'] ?? '',
            'stats' => $program->stats ?? $fallback['stats'] ?? [],
            'image' => $program->image_url ?? $fallback['image'] ?? '',
            'images_sm' => $fallback['images_sm'] ?? [],
            'bg' => $fallback['bg'] ?? 'bg-white',
            'reverse' => $fallback['reverse'] ?? false,
        ];
    }

    // If no programs in DB, use all fallbacks
    if ($programs->isEmpty()) {
        $progData = [];
        foreach ($fallbackPrograms as $slug => $data) {
            $data['slug'] = $slug;
            $progData[] = $data;
        }
    }
@endphp

@foreach($progData as $i => $prog)
<section id="program-{{ $prog['slug'] }}" class="py-20 {{ $prog['bg'] }} scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-start{{ isset($prog['reverse']) && $prog['reverse'] ? '' : '' }}">
            @if(isset($prog['reverse']) && $prog['reverse'])
            {{-- Images first (for reversed layout) --}}
            <div class="order-2 lg:order-1 space-y-5">
                <img src="{{ $prog['image'] }}" alt="{{ $prog['title'] }}"
                     class="rounded-2xl w-full h-64 object-cover shadow-lg">
                @if(count($prog['images_sm']) >= 2)
                <div class="grid grid-cols-2 gap-5">
                    <img src="{{ $prog['images_sm'][0] }}" alt="{{ $prog['title'] }}"
                         class="rounded-2xl h-40 object-cover w-full shadow-md">
                    <img src="{{ $prog['images_sm'][1] }}" alt="{{ $prog['title'] }}"
                         class="rounded-2xl h-40 object-cover w-full shadow-md">
                </div>
                @endif
            </div>
            <div class="order-1 lg:order-2">
                <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">{{ $prog['number'] }}</span>
                <h2 class="section-title mt-3 mb-6">{{ $prog['title'] }}</h2>
                @if($prog['description'])
                <p class="text-gray-600 leading-relaxed mb-5">{{ $prog['description'] }}</p>
                @endif
                @if($prog['full_description'])
                <p class="text-gray-600 leading-relaxed mb-8">{{ $prog['full_description'] }}</p>
                @endif

                @if(count($prog['stats']) > 0)
                <div class="grid grid-cols-2 gap-4 mb-8">
                    @foreach($prog['stats'] as $stat)
                    <div class="bg-[#f8f9fc] rounded-xl p-5 border border-gray-100">
                        <div class="text-3xl font-bold text-[#1a3c6e] mb-1">{{ is_array($stat) ? ($stat['title'] ?? $stat[array_key_first($stat)] ?? '') : $stat }}</div>
                        <div class="text-gray-500 text-sm">{{ is_array($stat) ? ($stat['label'] ?? '') : '' }}</div>
                    </div>
                    @endforeach
                </div>
                @endif

                <a href="{{ route('donate') }}" class="btn-blue">Support This Program</a>
            </div>
            @else
            {{-- Content first (default layout) --}}
            <div>
                <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">{{ $prog['number'] }}</span>
                <h2 class="section-title mt-3 mb-6">{{ $prog['title'] }}</h2>
                @if($prog['description'])
                <p class="text-gray-600 leading-relaxed mb-5">{{ $prog['description'] }}</p>
                @endif
                @if($prog['full_description'])
                <p class="text-gray-600 leading-relaxed mb-8">{{ $prog['full_description'] }}</p>
                @endif

                @if(count($prog['stats']) > 0)
                <div class="grid grid-cols-2 gap-4 mb-8">
                    @foreach($prog['stats'] as $stat)
                    <div class="bg-white rounded-xl p-5 border border-gray-100">
                        <div class="text-3xl font-bold text-[#1a3c6e] mb-1">{{ is_array($stat) ? ($stat['title'] ?? $stat[array_key_first($stat)] ?? '') : $stat }}</div>
                        <div class="text-gray-500 text-sm">{{ is_array($stat) ? ($stat['label'] ?? '') : '' }}</div>
                    </div>
                    @endforeach
                </div>
                @endif

                <a href="{{ route('donate') }}" class="btn-blue">Support This Program</a>
            </div>
            <div class="space-y-5">
                <img src="{{ $prog['image'] }}" alt="{{ $prog['title'] }}"
                     class="rounded-2xl w-full h-64 object-cover shadow-lg">
                @if(count($prog['images_sm']) >= 2)
                <div class="grid grid-cols-2 gap-5">
                    <img src="{{ $prog['images_sm'][0] }}" alt="{{ $prog['title'] }}"
                         class="rounded-2xl h-40 object-cover w-full shadow-md">
                    <img src="{{ $prog['images_sm'][1] }}" alt="{{ $prog['title'] }}"
                         class="rounded-2xl h-40 object-cover w-full shadow-md">
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</section>
@endforeach

{{-- Additional Projects --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Cross-cutting Work</span>
            <h2 class="section-title mt-3 mx-auto">Additional Projects</h2>
        </div>
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-[#f8f9fc] rounded-2xl p-8 border border-gray-100">
                <div class="w-12 h-12 rounded-xl bg-[#1a3c6e] flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div class="text-[#e8a020] font-semibold text-sm mb-2">357 youths</div>
                <h3 class="text-xl font-bold text-[#1a3c6e] mb-3">Academic &amp; Career Counseling</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Supporting young people as they transition out of our programs and into independent adult life, through mentorship, career guidance, and academic support.</p>
            </div>
            <div class="bg-[#f8f9fc] rounded-2xl p-8 border border-gray-100">
                <div class="w-12 h-12 rounded-xl bg-[#e8a020] flex items-center justify-center mb-5">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                </div>
                <div class="text-[#e8a020] font-semibold text-sm mb-2">Nationwide</div>
                <h3 class="text-xl font-bold text-[#1a3c6e] mb-3">Health &amp; Hygiene</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Providing health education, hygiene training, and access to basic healthcare for children in our programs and their communities across 15 provinces.</p>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-16 bg-[#1a3c6e]">
    <div class="max-w-3xl mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-white mb-4">Support Our Programs</h2>
        <p class="text-white/70 mb-8">Your donation goes directly to one of these programs. 100% of funds support children in Cambodia.</p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('donate') }}" class="btn-primary">Donate Now</a>
            <a href="{{ route('contact') }}" class="btn-outline">Contact Us</a>
        </div>
    </div>
</section>

@endsection
