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

<style>
    #volunteerModal .scrollbar-thin::-webkit-scrollbar {
        width: 3px;
    }
    #volunteerModal .scrollbar-thin::-webkit-scrollbar-track {
        background: transparent;
    }
    #volunteerModal .scrollbar-thin::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 999px;
    }
    #volunteerModal .scrollbar-thin::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
    #volunteerModal .scrollbar-thin {
        scrollbar-width: thin;
        scrollbar-color: #cbd5e1 transparent;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95) translateY(10px); }
        to   { opacity: 1; transform: scale(1) translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.3s ease-out;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {

    // ── Volunteer Modal ──
    const volunteerModal = document.getElementById('volunteerModal');
    const openButton = document.getElementById('openVolunteerModal');
    const closeButtons = document.querySelectorAll('.close-volunteer-modal');
    const volunteerModalContent = volunteerModal?.querySelector('.relative');

    function openVolunteerModalFn() {
        if (!volunteerModal) return;
        volunteerModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
        const scrollContainer = volunteerModal.querySelector('.overflow-y-auto');
        if (scrollContainer) scrollContainer.scrollTop = 0;
    }

    function closeVolunteerModalFn() {
        if (!volunteerModal) return;
        volunteerModal.classList.add('hidden');
        // Only remove body scroll lock if success modal is also hidden
        const successModal = document.getElementById('volunteerSuccessModal');
        if (successModal?.classList.contains('hidden')) {
            document.body.classList.remove('overflow-hidden');
        }
    }

    if (openButton) {
        openButton.addEventListener('click', openVolunteerModalFn);
    }

    closeButtons.forEach(function(button) {
        button.addEventListener('click', closeVolunteerModalFn);
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !volunteerModal?.classList.contains('hidden')) {
            closeVolunteerModalFn();
        }
    });

    if (volunteerModalContent) {
        volunteerModalContent.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }

    // ── Success Modal ──
    const successModal = document.getElementById('volunteerSuccessModal');
    const successCloseButtons = document.querySelectorAll('.close-success-modal');
    const successModalContent = successModal?.querySelector('.relative');

    function openSuccessModalFn() {
        if (!successModal) return;
        // Close volunteer modal first
        closeVolunteerModalFn();
        // Show success modal
        successModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeSuccessModalFn() {
        if (!successModal) return;
        successModal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    successCloseButtons.forEach(function(button) {
        button.addEventListener('click', closeSuccessModalFn);
    });

    if (successModalContent) {
        successModalContent.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !successModal?.classList.contains('hidden')) {
            closeSuccessModalFn();
        }
    });

    // ── Auto-open on flash / errors ──
    @if(session('success'))
        openSuccessModalFn();
    @elseif($errors->any())
        openVolunteerModalFn();
    @endif

});
</script>
@endsection
