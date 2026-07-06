@extends('layouts.app')

@section('title', 'Get Involved — Krousar Thmey')
@section('description', 'Join Krousar Thmey — volunteer, partner with us, find job opportunities, or make a donation to support children in Cambodia.')

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
            <span class="text-white">Get Involved</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Get Involved</h1>
        <p class="text-white/70 text-lg max-w-2xl">There are many ways to support Krousar Thmey's mission — from donating, to volunteering, to partnering with us.</p>
    </div>
</div>

{{-- Ways to Help --}}
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-5">
            @foreach([
                ['icon' => '❤️', 'title' => 'Donate', 'anchor' => 'donate'],
                ['icon' => '🤝', 'title' => 'Partner', 'anchor' => 'partner'],
                ['icon' => '✋', 'title' => 'Volunteer', 'anchor' => 'volunteer'],
                ['icon' => '💼', 'title' => 'Work With Us', 'anchor' => 'jobs'],
            ] as $way)
            <a href="#{{ $way['anchor'] }}" class="bg-[#f8f9fc] rounded-2xl p-7 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border border-gray-100 group">
                <div class="text-4xl mb-3">{{ $way['icon'] }}</div>
                <div class="font-bold text-[#1a3c6e] group-hover:text-[#e8a020] transition-colors">{{ $way['title'] }}</div>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- Donate --}}
<section id="donate" class="py-20 bg-[#1a3c6e]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Make a Difference</span>
                <h2 class="text-3xl md:text-4xl font-bold text-white mt-3 mb-6">Donate to Krousar Thmey</h2>
                <p class="text-white/70 leading-relaxed mb-5">
                    We guarantee that the totality of donated sums is used to support the children. With low administrative costs and full annual audits, you can be confident your donation makes a real difference.
                </p>
                <p class="text-white/70 leading-relaxed mb-8">
                    You can make a one-time donation or set up a monthly gift to provide sustained support for our programs.
                </p>
                <div class="flex items-center gap-3 p-4 bg-white/10 rounded-xl mb-8">
                    <div class="text-[#e8a020] text-2xl">✓</div>
                    <p class="text-white/80 text-sm">100% of your donation goes directly to supporting children in Cambodia</p>
                </div>
                <a href="https://www.helloasso.com/associations/les-amis-de-krousar-thmey" target="_blank" rel="noopener" class="btn-primary text-base">Donate Online</a>
            </div>
            <div class="grid grid-cols-2 gap-5">
                @foreach([
                    ['amount' => '€15', 'desc' => 'Provides school supplies for one student for a month'],
                    ['amount' => '€30', 'desc' => 'Covers food costs for a child for one month'],
                    ['amount' => '€60', 'desc' => 'Supports a deaf student\'s education for a month'],
                    ['amount' => '€100', 'desc' => 'Funds vocational training for a young adult'],
                ] as $tier)
                <div class="bg-white/10 border border-white/20 rounded-2xl p-6 text-center hover:bg-white/20 transition-colors cursor-pointer">
                    <div class="text-3xl font-bold text-[#e8a020] mb-2">{{ $tier['amount'] }}</div>
                    <p class="text-white/70 text-xs leading-relaxed">{{ $tier['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- Partner --}}
<section id="partner" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Institutional Support</span>
                <h2 class="section-title mt-3 mb-6">Partner With Us</h2>
                <p class="text-gray-600 leading-relaxed mb-5">
                    We welcome partnerships with corporations, foundations, and institutions that share our values. Whether through financial support, skills sharing, or in-kind contributions, your organization can make a lasting impact.
                </p>
                <p class="text-gray-600 leading-relaxed mb-8">
                    All partnerships are formalized through a Memorandum of Understanding and include regular reporting on impact and use of funds.
                </p>
                <div class="space-y-3 mb-8">
                    @foreach(['Corporate donations & CSR initiatives', 'Foundation grants', 'Skills-based volunteering', 'In-kind donations', 'Event sponsorship'] as $type)
                    <div class="flex items-center gap-3 text-gray-600 text-sm">
                        <div class="w-5 h-5 rounded-full bg-[#e8a020]/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-3 h-3 text-[#e8a020]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        {{ $type }}
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('contact') }}" class="btn-blue">Contact Us to Partner</a>
            </div>
            <div>
                <img src="https://images.unsplash.com/photo-1521791136064-7986c2920216?w=700&q=80"
                     alt="Partnership" class="rounded-3xl shadow-2xl w-full h-[400px] object-cover">
            </div>
        </div>
    </div>
</section>

{{-- Volunteer --}}
<section id="volunteer" class="py-20 bg-[#f8f9fc]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <img src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?w=700&q=80"
                     alt="Volunteering" class="rounded-3xl shadow-2xl w-full h-[400px] object-cover">
            </div>
            <div>
                <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Give Your Time</span>
                <h2 class="section-title mt-3 mb-6">Volunteer With Us</h2>
                <p class="text-gray-600 leading-relaxed mb-5">
                    Krousar Thmey operates primarily with Cambodian staff, but we welcome volunteers who bring specialized skills that complement our team's work. Volunteering is an opportunity to contribute meaningfully while experiencing Cambodia's culture.
                </p>
                <p class="text-gray-600 leading-relaxed mb-8">
                    We look for volunteers with skills in education, communications, fundraising, social work, or healthcare — for a minimum commitment of 3 months.
                </p>
                <div class="grid grid-cols-2 gap-4 mb-8">
                    @foreach(['Education', 'Communications', 'Fundraising', 'Healthcare', 'Social Work', 'IT & Technology'] as $skill)
                    <div class="flex items-center gap-2 text-gray-600 text-sm bg-white rounded-lg px-3 py-2 border border-gray-100">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#e8a020]"></span>
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
<section id="jobs" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14">
            <span class="text-[#e8a020] font-semibold text-sm uppercase tracking-wider">Career Opportunities</span>
            <h2 class="section-title mt-3 mx-auto">Work With Us</h2>
            <p class="section-subtitle mx-auto text-center">Join a dedicated team making a real difference in Cambodia. We hire primarily Cambodian professionals across a range of disciplines.</p>
        </div>

        <div class="bg-[#f8f9fc] rounded-2xl p-10 text-center border border-gray-100">
            <div class="w-16 h-16 rounded-2xl bg-[#1a3c6e]/10 flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-[#1a3c6e]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="text-xl font-bold text-[#1a3c6e] mb-3">Open Positions</h3>
            <p class="text-gray-500 mb-8 max-w-lg mx-auto text-sm">We regularly post new positions in social work, education, communications, and administration. Contact us to enquire about current openings.</p>
            <a href="{{ route('contact') }}" class="btn-blue">Send Your Application</a>
        </div>
    </div>
</section>

@endsection
