@extends('layouts.app')

@section('title', 'Get Involved — Krousar Thmey')
@section('description', 'Join Krousar Thmey — volunteer, partner with us, find job opportunities, or make a donation to support children in Cambodia.')

@section('content')

{{-- Page Header --}}
<div class="bg-[#2d6fa3] pt-16 pb-24 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a] translate-y-1/2 -translate-x-1/3"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/50 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white">Get Involved</span>
        </nav>
        <p class="text-[#8da83a] font-bold text-sm uppercase tracking-widest mb-3">Join Our Mission</p>
        <h1 class="text-4xl md:text-5xl font-black uppercase tracking-wide text-white mb-4">Get Involved</h1>
        <p class="text-white/70 text-lg max-w-2xl">There are many ways to support Krousar Thmey's mission — from donating, to volunteering, to partnering with us.</p>
    </div>
</div>

{{-- Quick-nav cards --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach([
                ['icon' => '❤️', 'title' => 'Donate',       'desc' => 'Support children directly with a one-time or monthly gift.',   'anchor' => 'donate',    'color' => 'hover:border-[#d32f2f]/40'],
                ['icon' => '🤝', 'title' => 'Partner',      'desc' => 'Formalize a CSR or institutional partnership with us.',         'anchor' => 'partner',   'color' => 'hover:border-[#2d6fa3]/40'],
                ['icon' => '✋', 'title' => 'Volunteer',    'desc' => 'Contribute your skills for a minimum of 3 months.',             'anchor' => 'volunteer', 'color' => 'hover:border-[#8da83a]/40'],
                ['icon' => '💼', 'title' => 'Work With Us', 'desc' => 'Join our Cambodian team across social, education & comms.',     'anchor' => 'jobs',      'color' => 'hover:border-[#e8a020]/40'],
            ] as $way)
            <a href="#{{ $way['anchor'] }}" class="group bg-[#f8f9fc] rounded-2xl p-7 border-2 border-gray-100 {{ $way['color'] }} hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                <div class="text-4xl mb-4">{{ $way['icon'] }}</div>
                <div class="font-black text-[#2d6fa3] uppercase tracking-wide text-sm mb-2 group-hover:text-[#e8a020] transition-colors">{{ $way['title'] }}</div>
                <p class="text-gray-400 text-xs leading-relaxed mb-4">{{ $way['desc'] }}</p>
                <div class="flex items-center gap-1 text-[#2d6fa3] text-xs font-semibold group-hover:gap-2 transition-all">
                    Learn more
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Donate --}}
<section id="donate" class="py-20 bg-[#1d4e7a] scroll-mt-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="inline-flex items-center gap-2 bg-[#e8a020]/20 border border-[#e8a020]/30 text-[#e8a020] text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-5">Make a Difference</span>
                <h2 class="text-3xl md:text-4xl font-black uppercase tracking-wide text-white mb-2">Donate to Krousar Thmey</h2>
                <div class="w-12 h-1 bg-[#d32f2f] rounded-full mb-6"></div>
                <p class="text-white/70 leading-relaxed mb-5">
                    We guarantee that the totality of donated sums is used to support the children. With low administrative costs and full annual audits, you can be confident your donation makes a real difference.
                </p>
                <p class="text-white/70 leading-relaxed mb-8">
                    You can make a one-time donation or set up a monthly gift to provide sustained support for our programs.
                </p>
                <div class="flex items-center gap-3 p-4 bg-white/10 border border-white/15 rounded-xl mb-8">
                    <div class="w-8 h-8 rounded-full bg-[#8da83a] flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <p class="text-white/80 text-sm">100% of your donation goes directly to supporting children in Cambodia</p>
                </div>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('donate') }}" class="btn-primary text-base">Donate Online</a>
                    <a href="{{ route('about') }}#transparency" class="btn-outline text-base">View Our Audits</a>
                </div>
            </div>
            <div class="space-y-5">
                <div class="relative rounded-3xl overflow-hidden h-52 shadow-2xl">
                    <img src="{{ asset('images/children.jpg') }}" alt="Children supported by Krousar Thmey"
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1d4e7a]/90 via-[#1d4e7a]/30 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <p class="text-white font-black text-lg">4,079 children</p>
                        <p class="text-white/70 text-xs">supported across 15 Cambodian provinces</p>
                    </div>
                    <div class="absolute top-4 right-4 bg-[#8da83a] text-white text-xs font-bold px-3 py-1.5 rounded-full">100% reaches children</div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    @php
                    $tiers = [
                        ['amount' => $settings['donation_tier_1_amount'] ?? '€15',  'desc' => $settings['donation_tier_1_desc'] ?? 'School supplies for one student / month', 'icon' => $settings['donation_tier_1_icon'] ?? '📚'],
                        ['amount' => $settings['donation_tier_2_amount'] ?? '€30',  'desc' => $settings['donation_tier_2_desc'] ?? 'Food for a child in our care / month',    'icon' => $settings['donation_tier_2_icon'] ?? '🍚'],
                        ['amount' => $settings['donation_tier_3_amount'] ?? '€60',  'desc' => $settings['donation_tier_3_desc'] ?? "Deaf student's education / month",        'icon' => $settings['donation_tier_3_icon'] ?? '👂'],
                        ['amount' => $settings['donation_tier_4_amount'] ?? '€100', 'desc' => $settings['donation_tier_4_desc'] ?? 'Vocational training for a young adult',   'icon' => $settings['donation_tier_4_icon'] ?? '🎓'],
                    ];
                    @endphp
                    @foreach($tiers as $tier)
                    <div class="bg-white/10 border border-white/20 rounded-2xl p-5 text-center hover:bg-white/20 transition-colors">
                        <div class="text-xl mb-1">{{ $tier['icon'] }}</div>
                        <div class="text-2xl font-black text-[#e8a020] mb-1">{{ $tier['amount'] }}</div>
                        <p class="text-white/60 text-[11px] leading-relaxed">{{ $tier['desc'] }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Partner --}}
<section id="partner" class="py-20 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="inline-flex items-center gap-2 bg-[#e8a020]/20 border border-[#e8a020]/30 text-[#e8a020] text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-5">Institutional Support</span>
                <h2 class="text-3xl md:text-4xl font-black uppercase tracking-wide text-[#2d6fa3] mb-2">Partner With Us</h2>
                <div class="w-12 h-1 bg-[#d32f2f] rounded-full mb-6"></div>
                <p class="text-gray-600 leading-relaxed mb-5">
                    We welcome partnerships with corporations, foundations, and institutions that share our values. Whether through financial support, skills sharing, or in-kind contributions, your organization can make a lasting impact.
                </p>
                <p class="text-gray-600 leading-relaxed mb-8">
                    All partnerships are formalized through a Memorandum of Understanding and include regular reporting on impact and use of funds.
                </p>
                <div class="space-y-3 mb-8">
                    @foreach(['Corporate donations & CSR initiatives', 'Foundation grants', 'Skills-based volunteering', 'In-kind donations', 'Event sponsorship'] as $type)
                    <div class="flex items-center gap-3 text-gray-600 text-sm">
                        <div class="w-5 h-5 rounded-full bg-[#8da83a]/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        {{ $type }}
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('contact') }}" class="btn-blue">Contact Us to Partner</a>
            </div>
            <div class="relative">
                <img src="{{ asset('images/cultural.jpg') }}" alt="Cultural partnership programs"
                     class="rounded-3xl shadow-2xl w-full h-[420px] object-cover object-center">
                <div class="absolute inset-0 rounded-3xl bg-gradient-to-t from-[#1d4e7a]/50 to-transparent"></div>
                <div class="absolute -bottom-5 -left-5 bg-[#2d6fa3] rounded-2xl p-5 shadow-xl">
                    <p class="text-white font-black text-2xl">70+</p>
                    <p class="text-white/70 text-xs">Partner organisations</p>
                </div>
                <div class="absolute top-5 right-5 bg-white/90 backdrop-blur-sm rounded-xl px-4 py-2.5 shadow-lg">
                    <p class="text-[#2d6fa3] font-bold text-xs uppercase tracking-wide">MOU Partnerships</p>
                    <p class="text-gray-500 text-[11px]">3 Cambodian Ministries</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Volunteer --}}
<section id="volunteer" class="py-20 bg-[#f8f9fc] scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="relative order-2 lg:order-1">
                <img src="{{ asset('images/special-ed.jpg') }}" alt="Special education volunteering"
                     class="rounded-3xl shadow-2xl w-full h-[420px] object-cover object-center">
                <div class="absolute inset-0 rounded-3xl bg-gradient-to-t from-[#1d4e7a]/40 to-transparent"></div>
                <div class="absolute -bottom-5 -right-5 bg-[#8da83a] rounded-2xl p-5 shadow-xl">
                    <p class="text-white font-black text-2xl">3 mo</p>
                    <p class="text-white/80 text-xs">Minimum commitment</p>
                </div>
                <div class="absolute top-5 left-5 bg-white/90 backdrop-blur-sm rounded-xl px-4 py-2.5 shadow-lg">
                    <p class="text-[#2d6fa3] font-bold text-xs uppercase tracking-wide">Hands-on Impact</p>
                    <p class="text-gray-500 text-[11px]">Work directly with children</p>
                </div>
            </div>
            <div class="order-1 lg:order-2">
                <span class="inline-flex items-center gap-2 bg-[#e8a020]/20 border border-[#e8a020]/30 text-[#e8a020] text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-5">Give Your Time</span>
                <h2 class="text-3xl md:text-4xl font-black uppercase tracking-wide text-[#2d6fa3] mb-2">Volunteer With Us</h2>
                <div class="w-12 h-1 bg-[#d32f2f] rounded-full mb-6"></div>
                <p class="text-gray-600 leading-relaxed mb-5">
                    Krousar Thmey operates primarily with Cambodian staff, but we welcome volunteers who bring specialized skills that complement our team's work. Volunteering is an opportunity to contribute meaningfully while experiencing Cambodia's culture.
                </p>
                <p class="text-gray-600 leading-relaxed mb-6">
                    We look for volunteers with skills in education, communications, fundraising, social work, or healthcare — for a minimum commitment of 3 months.
                </p>
                <div class="grid grid-cols-2 gap-3 mb-8">
                    @foreach(['Education', 'Communications', 'Fundraising', 'Healthcare', 'Social Work', 'IT & Technology'] as $skill)
                    <div class="flex items-center gap-2 text-gray-600 text-sm bg-white rounded-xl px-4 py-2.5 border border-gray-100 shadow-sm">
                        <span class="w-2 h-2 rounded-full bg-[#8da83a] flex-shrink-0"></span>
                        {{ $skill }}
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('contact') }}" class="btn-blue">Apply to Volunteer</a>
            </div>
        </div>
    </div>
</section>

{{-- Jobs --}}
<section id="jobs" class="py-20 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <span class="inline-flex items-center gap-2 bg-[#e8a020]/20 border border-[#e8a020]/30 text-[#e8a020] text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4">Career Opportunities</span>
            <h2 class="text-3xl md:text-4xl font-black uppercase tracking-wide text-[#2d6fa3] mt-4 mb-2">Work With Us</h2>
            <div class="w-12 h-1 bg-[#d32f2f] rounded-full mx-auto mb-5"></div>
            <p class="text-gray-500 max-w-2xl mx-auto text-sm leading-relaxed">Join a dedicated team making a real difference in Cambodia. We hire primarily Cambodian professionals across a range of disciplines.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-5 mb-10">
            @foreach([
                ['icon' => '🏫', 'title' => 'Education',      'desc' => 'Teachers and specialists for deaf and blind children programs.', 'img' => 'special-ed.jpg'],
                ['icon' => '📢', 'title' => 'Communications', 'desc' => 'Content, social media, and donor relations roles.',               'img' => 'cultural.jpg'],
                ['icon' => '🤲', 'title' => 'Social Work',    'desc' => 'Child welfare officers and community outreach staff.',            'img' => 'children.jpg'],
            ] as $dept)
            <div class="bg-[#f8f9fc] rounded-2xl overflow-hidden border border-gray-100 hover:border-[#2d6fa3]/30 hover:shadow-md transition-all group">
                <div class="relative h-32 overflow-hidden">
                    <img src="{{ asset('images/'.$dept['img']) }}" alt="{{ $dept['title'] }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1d4e7a]/70 to-transparent"></div>
                    <div class="absolute bottom-3 left-3 flex items-center gap-2">
                        <span class="text-xl">{{ $dept['icon'] }}</span>
                        <span class="text-white font-black text-xs uppercase tracking-wide">{{ $dept['title'] }}</span>
                    </div>
                </div>
                <div class="p-5">
                    <p class="text-gray-500 text-xs leading-relaxed">{{ $dept['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>

        <div class="bg-[#f8f9fc] rounded-3xl p-10 text-center border border-gray-100">
            <div class="w-16 h-16 rounded-2xl bg-[#2d6fa3]/10 flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="text-xl font-black text-[#2d6fa3] uppercase tracking-wide mb-3">Open Positions</h3>
            <p class="text-gray-500 mb-8 max-w-lg mx-auto text-sm leading-relaxed">We regularly post new positions in social work, education, communications, and administration. Contact us to enquire about current openings.</p>
            <a href="{{ route('contact') }}" class="btn-blue">Send Your Application</a>
        </div>
    </div>
</section>

{{-- CTA Banner --}}
<section class="bg-[#1d4e7a] py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-72 h-72 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 rounded-full bg-[#2d6fa3] translate-y-1/2 -translate-x-1/3"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-6 text-center">
        <p class="text-[#8da83a] font-bold text-sm uppercase tracking-widest mb-3">Ready to Help?</p>
        <h2 class="text-3xl md:text-4xl font-black uppercase tracking-wide text-white mb-4">Every Action Counts</h2>
        <p class="text-white/70 text-lg mb-8 max-w-2xl mx-auto">Whether you donate, volunteer, or partner with us — you are helping build a better future for Cambodia's children.</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('donate') }}" class="btn-primary text-base">Donate Now</a>
            <a href="{{ route('contact') }}" class="btn-outline text-base">Contact Us</a>
        </div>
    </div>
</section>

@endsection
