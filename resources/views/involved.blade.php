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
                <button type="button" id="openVolunteerModal" class="btn-blue">Apply to Volunteer</button>
            </div>
        </div>
    </div>
</section>

{{-- Volunteer Modal --}}
<div id="volunteerModal"
    class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">

    {{-- Background Overlay --}}
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm close-volunteer-modal"></div>

    {{-- Modal Content --}}
    <div
        class="relative w-full max-w-lg max-h-[85vh] bg-white rounded-3xl shadow-2xl border border-slate-200 flex flex-col overflow-hidden">

        {{-- Sticky Header --}}
        <div class="flex-shrink-0 border-b border-slate-200 px-4 py-2 bg-white sticky top-0 z-10">
            <div class="flex items-center justify-between gap-2">
                <div class="min-w-0">
                    <h2 class="text-sm font-bold text-slate-900 truncate">
                        Volunteer Application
                    </h2>
                </div>
                <div class="flex items-center gap-1.5 flex-shrink-0">
                    <button type="button"
                        class="close-volunteer-modal flex h-6 w-6 items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-slate-200 hover:text-slate-700 transition-all">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- Scrollable Form Body --}}
        <div class="flex-1 overflow-y-auto p-3 scrollbar-thin">

            <form method="POST"
                action="{{ route('volunteer.store') }}"
                enctype="multipart/form-data"
                class="space-y-2">

                @csrf

                {{-- Personal Information - 2 columns --}}
                <div class="grid sm:grid-cols-2 gap-2">
                    <div>
                        <label class="block text-[11px] font-medium text-slate-600 mb-0.5">
                            Full Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                            name="full_name"
                            value="{{ old('full_name') }}"
                            required
                            placeholder="John Doe"
                            class="w-full rounded-xl border border-slate-300 px-3 py-1.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all">
                        @error('full_name')
                            <p class="text-red-500 text-xs mt-0.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-[11px] font-medium text-slate-600 mb-0.5">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            placeholder="you@example.com"
                            class="w-full rounded-xl border border-slate-300 px-3 py-1.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all">
                        @error('email')
                            <p class="text-red-500 text-xs mt-0.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-[11px] font-medium text-slate-600 mb-0.5">
                            Phone <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            required
                            placeholder="+855 12 345 678"
                            class="w-full rounded-xl border border-slate-300 px-3 py-1.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all">
                        @error('phone')
                            <p class="text-red-500 text-xs mt-0.5">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-[11px] font-medium text-slate-600 mb-0.5">
                            Country <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                            name="country"
                            value="{{ old('country') }}"
                            required
                            placeholder="Cambodia"
                            class="w-full rounded-xl border border-slate-300 px-3 py-1.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all">
                        @error('country')
                            <p class="text-red-500 text-xs mt-0.5">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-2">
                    <div>
                        <label class="block text-[11px] font-medium text-slate-600 mb-0.5">
                            Availability
                        </label>
                        <select name="availability"
                            class="w-full rounded-xl border border-slate-300 px-3 py-1.5 text-sm focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all">
                            <option value="">Select...</option>
                            <option value="Weekdays">Weekdays</option>
                            <option value="Weekends">Weekends</option>
                            <option value="Full-time">Full-time</option>
                            <option value="Part-time">Part-time</option>
                            <option value="Flexible">Flexible</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-[11px] font-medium text-slate-600 mb-0.5">
                            Interested Program
                        </label>
                        <select name="interested_program"
                            class="w-full rounded-xl border border-slate-300 px-3 py-1.5 text-sm focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all">
                            <option value="">Select...</option>
                            <option value="Education">Education</option>
                            <option value="Environment">Environment</option>
                            <option value="Community Development">Community Development</option>
                            <option value="Events">Events</option>
                            <option value="Healthcare">Healthcare</option>
                            <option value="Fundraising">Fundraising</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-slate-600 mb-0.5">
                        Skills <span class="text-red-500">*</span>
                    </label>
                    <textarea name="skills"
                        rows="1"
                        required
                        placeholder="e.g. Teaching, fundraising, content writing..."
                        class="w-full rounded-xl border border-slate-300 px-3 py-1.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all resize-none">{{ old('skills') }}</textarea>
                    @error('skills')
                        <p class="text-red-500 text-xs mt-0.5">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-slate-600 mb-0.5">
                        Motivation <span class="text-red-500">*</span>
                    </label>
                    <textarea name="motivation"
                        rows="1"
                        required
                        placeholder="Why do you want to volunteer?"
                        class="w-full rounded-xl border border-slate-300 px-3 py-1.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all resize-none">{{ old('motivation') }}</textarea>
                    @error('motivation')
                        <p class="text-red-500 text-xs mt-0.5">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-slate-600 mb-0.5">
                        Previous Experience
                    </label>
                    <textarea name="previous_experience"
                        rows="1"
                        placeholder="Any relevant experience..."
                        class="w-full rounded-xl border border-slate-300 px-3 py-1.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all resize-none">{{ old('previous_experience') }}</textarea>
                </div>

                <div>
                    <label class="block text-[11px] font-medium text-slate-600 mb-0.5">
                        Upload CV / Resume
                    </label>
                    <input type="file"
                        name="resume"
                        accept=".pdf,.doc,.docx"
                        class="w-full rounded-xl border border-slate-300 px-3 py-1.5 text-sm file:mr-2 file:py-0.5 file:px-2.5 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20 file:transition-all transition-all focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none">
                </div>

                {{-- Terms --}}
                <div class="flex items-start gap-2 bg-slate-50 border border-slate-200 p-2.5 rounded-xl">
                    <input type="checkbox"
                        name="agreed_to_terms"
                        value="1"
                        class="mt-0.5 h-4 w-4 rounded border-slate-300 text-[#2d6fa3] accent-[#2d6fa3] focus:ring-[#2d6fa3]/30 flex-shrink-0"
                        {{ old('agreed_to_terms') ? 'checked' : '' }}>
                    <label class="text-xs text-slate-500 leading-relaxed">
                        I agree to the volunteer terms and conditions and confirm the information is accurate. <span class="text-red-500">*</span>
                    </label>
                </div>
                @error('agreed_to_terms')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror

                <div class="flex items-center gap-2">
                    <button type="submit"
                        class="flex-1 bg-[#2d6fa3] text-white px-4 py-1.5 rounded-xl font-semibold text-sm hover:bg-[#245b87] active:bg-[#1d4e7a] transition-all">
                        Submit
                    </button>
                    <button type="button"
                        class="close-volunteer-modal flex-1 border border-slate-300 px-4 py-1.5 rounded-xl font-semibold text-sm text-slate-600 hover:bg-slate-100 active:bg-slate-200 transition-all">
                        Cancel
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- Success Modal --}}
<div id="volunteerSuccessModal"
    class="hidden fixed inset-0 z-[60] flex items-center justify-center p-4">

    {{-- Background Overlay --}}
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm close-success-modal"></div>

    {{-- Modal Content --}}
    <div
        class="relative w-full max-w-sm bg-white rounded-3xl shadow-2xl border border-green-200 flex flex-col overflow-hidden animate-fade-in">

        <div class="px-6 py-8 text-center">
            {{-- Success checkmark --}}
            <div class="mx-auto mb-4 w-16 h-16 rounded-full bg-green-100 flex items-center justify-center">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>

            <h3 class="text-xl font-bold text-slate-800 mb-2">Thank You!</h3>
            <p class="text-sm text-slate-500 leading-relaxed">
                Your volunteer application has been submitted successfully.
            </p>
            <p class="text-xs text-slate-400 mt-3">
                We will review your application and get back to you soon.
            </p>

            <button type="button"
                class="close-success-modal mt-6 w-full bg-gradient-to-r from-green-500 to-green-600 text-blue px-5 py-2.5 rounded-xl font-semibold text-sm hover:from-green-600 hover:to-green-700 active:scale-[0.98] transition-all shadow-sm">
                Got it!
            </button>
        </div>
    </div>
</div>

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
