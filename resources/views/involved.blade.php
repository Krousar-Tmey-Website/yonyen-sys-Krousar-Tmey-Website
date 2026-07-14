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
                ['icon' => '🤝', 'title' => 'Partner',      'desc' => 'Formalize a CSR or institutional partnership with us.',         'anchor' => 'partner',   'color' => 'hover:border-[#2d6fa3]/40'],
                ['icon' => '✋', 'title' => 'Volunteer',    'desc' => 'Contribute your skills for a minimum of 3 months.',             'anchor' => 'volunteer', 'color' => 'hover:border-[#8da83a]/40'],
                ['icon' => '💼', 'title' => 'Work With Us', 'desc' => 'Join our Cambodian team across social, education & comms.',     'anchor' => 'jobs',      'color' => 'hover:border-[#e8a020]/40'],
                ['icon' => '📚', 'title' => 'Book for Sales', 'desc' => 'Browse our collection of books and order the titles you love.', 'anchor' => 'book-for-sales', 'color' => 'hover:border-[#d32f2f]/40'],
            ] as $index => $way)
            <a href="#{{ $way['anchor'] }}" class="group bg-[#f8f9fc] rounded-2xl p-7 border-2 border-gray-100 {{ $way['color'] }} hover:shadow-lg hover:-translate-y-1 transition-all duration-300"
               data-reveal="up" style="--reveal-delay: {{ $index * 100 }}">
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

{{-- Book for Sales --}}
<section id="book-for-sales" class="py-20 bg-[#1d4e7a] scroll-mt-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
    </div>
        <div class="relative max-w-7xl mx-auto px-6">
            <div class="max-w-2xl mb-12" data-reveal="left">
                <span class="inline-flex items-center gap-2 bg-[#e8a020]/20 border border-[#e8a020]/30 text-[#e8a020] text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-5">Book for Sales</span>
                <h2 class="text-3xl md:text-4xl font-black uppercase tracking-wide text-white mb-2">Book for Sales</h2>
                <div class="w-12 h-1 bg-[#d32f2f] rounded-full mb-6"></div>
                <p class="text-white/70 leading-relaxed">
                    Browse our collection of books and order the titles you love. Every purchase supports Krousar Thmey's work with children across Cambodia.
                </p>
            </div>

            @if($books->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($books as $book)
                <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 flex flex-col"
                     data-reveal="up" style="--reveal-delay: {{ $loop->index * 90 }}">
                    <a href="{{ route('books.show', $book) }}" class="block h-56 overflow-hidden bg-gray-100">
                        @if($book->cover_image_url)
                        <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-gray-300 text-5xl">📖</div>
                        @endif
                    </a>
                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="text-[#2d6fa3] font-black text-base mb-1">{{ $book->title }}</h3>
                        @if($book->description)
                        <p class="text-gray-500 text-sm leading-relaxed mb-4 line-clamp-3">{{ $book->description }}</p>
                        @endif
                        <div class="mt-auto flex items-center justify-between gap-3 pt-2">
                            <span class="text-[#e8a020] font-black text-xl">${{ number_format($book->price, 2) }}</span>
                            <a href="{{ route('books.show', $book) }}" class="btn-primary text-xs">View Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="bg-white/10 border border-white/20 rounded-2xl p-10 text-center">
                <p class="text-white/70 text-sm">No books available at the moment. Please check back soon.</p>
            </div>
            @endif
        </div>
</section>

{{-- Partner --}}
<section id="partner" class="py-20 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div data-reveal="left">
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
            <div class="relative" data-reveal="right">
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
            <div class="relative order-2 lg:order-1" data-reveal="left">
                <img src="{{ asset('images/special-ed.jpg') }}" alt="Special education volunteering"
                     class="rounded-3xl shadow-2xl w-full h-[420px] object-cover object-center">
                <div class="absolute inset-0 rounded-3xl bg-gradient-to-t from-[#1d4e7a]/40 to-transparent"></div>
                <div class="absolute top-5 left-5 bg-white/90 backdrop-blur-sm rounded-xl px-4 py-2.5 shadow-lg">
                    <p class="text-[#2d6fa3] font-bold text-xs uppercase tracking-wide">Hands-on Impact</p>
                    <p class="text-gray-500 text-[11px]">Work directly with children</p>
                </div>
            </div>
            <div class="order-1 lg:order-2" data-reveal="right">
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
    class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6">

    {{-- Background Overlay --}}
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm close-volunteer-modal"></div>

    {{-- Modal Content --}}
    <div
        class="relative w-full max-w-lg bg-white rounded-2xl shadow-xl border border-slate-200 flex flex-col"
        style="max-height: 90vh;">

        {{-- Header --}}
        <div class="flex-shrink-0 flex items-center justify-between px-5 py-3 border-b border-slate-100 bg-white rounded-t-2xl">
            <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center">
                    <svg class="w-4 h-4 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-slate-900">Apply to Volunteer</h2>
                    <p class="text-[10px] text-slate-400">Join our mission to help children in Cambodia</p>
                </div>
            </div>
            <button type="button"
                class="close-volunteer-modal flex h-7 w-7 items-center justify-center rounded-full bg-slate-100 text-slate-400 hover:bg-slate-200 hover:text-slate-600 transition-all flex-shrink-0">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Scrollable Form Body --}}
        <div class="flex-1 overflow-y-auto p-5 scroll-smooth"
             style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;">

            <form method="POST"
                action="{{ route('volunteer.store') }}"
                enctype="multipart/form-data"
                class="space-y-4">

                @csrf

                {{-- Section 1: Personal Details --}}
                <div class="border border-slate-200 rounded-none bg-white shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-2.5 px-4 py-3 border-b border-slate-100 bg-gradient-to-r from-[#2d6fa3]/5 to-transparent rounded-t-none">
                        <div class="w-6 h-6 rounded-full bg-[#2d6fa3] flex items-center justify-center">
                            <span class="text-white text-[10px] font-bold">1</span>
                        </div>
                        <span class="text-xs font-semibold text-slate-800">Personal Details</span>
                        <span class="text-[10px] text-slate-400 ml-auto">Your basic info</span>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" name="full_name" value="{{ old('full_name') }}" required placeholder="John Doe"
                                    class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                                @error('full_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Email <span class="text-red-500">*</span></label>
                                <input type="email" name="email" value="{{ old('email') }}" required placeholder="you@example.com"
                                    class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                                @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Phone <span class="text-red-500">*</span></label>
                                <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="+855 12 345 678"
                                    class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                                @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Country <span class="text-red-500">*</span></label>
                                <input type="text" name="country" value="{{ old('country') }}" required placeholder="Cambodia"
                                    class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                                @error('country')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Date of Birth <span class="text-slate-400">(opt)</span></label>
                                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                                    class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                                @error('date_of_birth')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Gender <span class="text-slate-400">(opt)</span></label>
                                <select name="gender"
                                    class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                                    <option value="">Select...</option>
                                    <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Other</option>
                                    <option value="Prefer not to say" {{ old('gender') === 'Prefer not to say' ? 'selected' : '' }}>Prefer not to say</option>
                                </select>
                                @error('gender')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section 2: Volunteer Details --}}
                <div class="border border-slate-200 rounded-none bg-white shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-2.5 px-4 py-3 border-b border-slate-100 bg-gradient-to-r from-[#2d6fa3]/5 to-transparent rounded-t-none">
                        <div class="w-6 h-6 rounded-full bg-[#2d6fa3] flex items-center justify-center">
                            <span class="text-white text-[10px] font-bold">2</span>
                        </div>
                        <span class="text-xs font-semibold text-slate-800">Volunteer Details</span>
                        <span class="text-[10px] text-slate-400 ml-auto">Your preferences</span>
                    </div>
                    <div class="p-4">
                        <div class="grid grid-cols-2 gap-3">
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Availability</label>
                                <select name="availability"
                                    class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                                    <option value="">Select...</option>
                                    <option value="Weekdays">Weekdays</option>
                                    <option value="Weekends">Weekends</option>
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Flexible">Flexible</option>
                                </select>
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label class="block text-xs font-medium text-slate-600 mb-1">Interested Program</label>
                                <select name="interested_program"
                                    class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
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
                    </div>
                </div>

                {{-- Section 3: Experience & Skills --}}
                <div class="border border-slate-200 rounded-none bg-white shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-2.5 px-4 py-3 border-b border-slate-100 bg-gradient-to-r from-[#2d6fa3]/5 to-transparent rounded-t-none">
                        <div class="w-6 h-6 rounded-full bg-[#2d6fa3] flex items-center justify-center">
                            <span class="text-white text-[10px] font-bold">3</span>
                        </div>
                        <span class="text-xs font-semibold text-slate-800">Experience &amp; Skills</span>
                        <span class="text-[10px] text-slate-400 ml-auto">Your background</span>
                    </div>
                    <div class="p-4 space-y-3">
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Skills <span class="text-red-500">*</span></label>
                            <input type="text" name="skills" value="{{ old('skills') }}" required placeholder="e.g. Teaching, fundraising, content writing..."
                                class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                            @error('skills')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Motivation <span class="text-red-500">*</span></label>
                            <textarea name="motivation" rows="2" required placeholder="Why do you want to volunteer with Krousar Thmey?"
                                class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all resize-none bg-white hover:border-slate-300">{{ old('motivation') }}</textarea>
                            @error('motivation')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-slate-600 mb-1">Previous Experience <span class="text-slate-400">(opt)</span></label>
                            <input type="text" name="previous_experience" value="{{ old('previous_experience') }}" placeholder="Any relevant experience..."
                                class="w-full rounded-2xl border-2 border-slate-200 px-3.5 py-2.5 text-sm placeholder:text-slate-400 focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] focus:outline-none transition-all bg-white hover:border-slate-300">
                        </div>
                    </div>
                </div>

                {{-- Section 4: Documents --}}
                <div class="border border-slate-200 rounded-none bg-white shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex items-center gap-2.5 px-4 py-3 border-b border-slate-100 bg-gradient-to-r from-[#2d6fa3]/5 to-transparent rounded-t-none">
                        <div class="w-6 h-6 rounded-full bg-[#2d6fa3] flex items-center justify-center">
                            <span class="text-white text-[10px] font-bold">4</span>
                        </div>
                        <span class="text-xs font-semibold text-slate-800">Documents</span>
                        <span class="text-[10px] text-slate-400 ml-auto">Optional files</span>
                    </div>
                    <div class="p-4">
                        <div id="resumeUploadZone"
                            class="border-2 border-dashed border-slate-200 rounded-none p-5 text-center hover:border-[#2d6fa3]/30 hover:bg-[#2d6fa3]/5 transition-all cursor-pointer group">
                            <div class="mb-2 group-hover:scale-105 transition-transform">
                                <svg class="w-8 h-8 text-slate-300 mx-auto group-hover:text-[#2d6fa3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                            </div>
                            <label class="block text-xs font-medium text-slate-600 mb-1 group-hover:text-[#2d6fa3] transition-colors">CV / Resume <span class="text-slate-400">(opt)</span></label>
                            <p class="text-[10px] text-slate-400 mb-2">PDF, DOC or DOCX (max 5MB)</p>
                            <input type="file" id="resumeInput" name="resume" accept=".pdf,.doc,.docx"
                                class="hidden">
                            <div id="resumeFileName" class="text-xs text-[#2d6fa3] font-medium hidden"></div>
                            <div class="inline-flex items-center gap-1.5 text-xs text-slate-500 bg-slate-50 border border-slate-200 px-3 py-1.5 rounded-lg group-hover:bg-white group-hover:border-[#2d6fa3]/30 group-hover:text-[#2d6fa3] transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                <span id="resumeBtnLabel">Choose file</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Terms --}}
                <div class="flex items-start gap-3 bg-gradient-to-r from-slate-50 to-white border border-slate-200 p-4 rounded-none">
                    <input type="checkbox" name="agreed_to_terms" value="1"
                        class="mt-0.5 h-4 w-4 rounded border-slate-300 text-[#2d6fa3] accent-[#2d6fa3] focus:ring-[#2d6fa3]/30 flex-shrink-0"
                        {{ old('agreed_to_terms') ? 'checked' : '' }}>
                    <label class="text-xs text-slate-500 leading-relaxed">
                        I agree to the volunteer terms and conditions and confirm that the information provided is accurate. <span class="text-red-500">*</span>
                    </label>
                </div>
                @error('agreed_to_terms')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror

                {{-- Buttons --}}
                <div class="flex items-center gap-3 pt-1">
                    <button type="submit"
                        class="flex-1 bg-[#2d6fa3] text-white px-5 py-3 rounded-2xl font-semibold text-sm hover:bg-[#245b87] transition-all shadow-sm hover:shadow-md active:scale-[0.98]">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Submit Application
                        </span>
                    </button>
                    <button type="button"
                        class="close-volunteer-modal flex-1 border-2 border-slate-200 px-5 py-3 rounded-2xl font-semibold text-sm text-slate-600 hover:bg-slate-50 hover:border-slate-300 transition-all active:scale-[0.98]">
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
                class="close-success-modal mt-6 w-full bg-gradient-to-r from-[#2d6fa3] to-[#1d4e7a] text-white px-5 py-2.5 rounded-xl font-semibold text-sm hover:from-[#1d4e7a] hover:to-[#153d63] active:scale-[0.98] transition-all shadow-sm">
                Got it!
            </button>
        </div>
    </div>
</div>

{{-- Jobs --}}
<section id="jobs" class="py-20 bg-white scroll-mt-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14" data-reveal>
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
            <div class="bg-[#f8f9fc] rounded-2xl overflow-hidden border border-gray-100 hover:border-[#2d6fa3]/30 hover:shadow-md transition-all group"
                 data-reveal="up" style="--reveal-delay: {{ $loop->index * 100 }}">
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

        @if($jobs->isNotEmpty())
        <div class="mb-8">
            <h3 class="text-xl font-black text-[#2d6fa3] uppercase tracking-wide mb-6 text-center">Open Positions</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($jobs as $job)
            <div class="group bg-[#f8f9fc] rounded-2xl border border-gray-100 hover:border-[#2d6fa3]/30 hover:shadow-md transition-all duration-300 overflow-hidden flex flex-col">
                    @if($job->image)
                    <div class="h-32 overflow-hidden flex-shrink-0">
                        <img src="{{ asset('storage/' . $job->image) }}" alt="{{ $job->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    @endif
                    <div class="flex-1 p-4 flex flex-col">
                        <div class="flex items-center gap-2 flex-wrap mb-2">
                            <h4 class="font-black text-[#2d6fa3] uppercase tracking-wide text-xs">{{ $job->title }}</h4>
                            <span class="text-[9px] font-bold px-2 py-0.5 rounded-full
                                {{ $job->status === 'open' ? 'bg-green-50 text-green-700' : ($job->status === 'filled' ? 'bg-yellow-50 text-yellow-700' : ($job->status === 'closed' ? 'bg-red-50 text-red-700' : 'bg-gray-100 text-gray-600')) }}">
                                {{ $job->status === 'filled' ? 'FILLED' : strtoupper($job->status) }}
                            </span>
                        </div>
                        <div class="flex flex-wrap items-center gap-x-2 gap-y-1 text-[11px] text-gray-500 mb-1.5">
                            @if($job->type)
                            <span class="flex items-center gap-0.5">
                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 002 2v10a2 2 0 002 2z"/></svg>
                                {{ $job->type }}
                            </span>
                            @endif
                            @if($job->location)
                            <span class="flex items-center gap-0.5">
                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $job->location }}
                            </span>
                            @endif
                            @if($job->posted_date)
                            <span class="flex items-center gap-0.5">
                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 002 2v12a2 2 0 002 2z"/></svg>
                                {{ $job->posted_date->format('M d, Y') }}
                            </span>
                            @endif
                        </div>
                        @if($job->description)
                        <p class="text-gray-500 text-xs leading-relaxed mb-3 line-clamp-2">{{ $job->description }}</p>
                        @endif
                        <div class="mt-auto pt-1">
                            <a href="{{ route('jobs.show', $job) }}" class="inline-flex items-center gap-1.5 text-[#2d6fa3] text-xs font-bold group/link hover:gap-2.5 transition-all">
                                View Details
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
            </div>
            @endforeach
            </div>
        </div>
        @endif

        <div class="bg-[#f8f9fc] rounded-3xl p-10 text-center border border-gray-100">
            <div class="w-16 h-16 rounded-2xl bg-[#2d6fa3]/10 flex items-center justify-center mx-auto mb-5">
                <svg class="w-8 h-8 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 002 2v10a2 2 0 002 2z"/></svg>
            </div>
            <h3 class="text-xl font-black text-[#2d6fa3] uppercase tracking-wide mb-3">Don't see the right fit?</h3>
            <p class="text-gray-500 mb-8 max-w-lg mx-auto text-sm leading-relaxed">We regularly post new positions in social work, education, communications, and administration. Contact us to enquire about current openings or send your unsolicited application.</p>
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
    <div class="relative max-w-4xl mx-auto px-6 text-center" data-reveal="scale">
        <p class="text-[#8da83a] font-bold text-sm uppercase tracking-widest mb-3">Ready to Help?</p>
        <h2 class="text-3xl md:text-4xl font-black uppercase tracking-wide text-white mb-4">Every Action Counts</h2>
        <p class="text-white/70 text-lg mb-8 max-w-2xl mx-auto">Whether you buy a book, volunteer, partner with us, or send your application — you are helping build a better future for Cambodia's children.</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('involved') }}#book-for-sales" class="btn-primary text-base">Book for Sales</a>
            <a href="{{ route('contact') }}" class="btn-outline text-base">Contact Us</a>
        </div>
    </div>
</section>

{{-- Modal JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    const volunteerModal = document.getElementById('volunteerModal');
    const successModal = document.getElementById('volunteerSuccessModal');
    const openBtn = document.getElementById('openVolunteerModal');
    const body = document.body;

    /** Lock/unlock body scroll */
    function lockScroll() {
        body.style.overflow = 'hidden';
    }

    function unlockScroll() {
        body.style.overflow = '';
    }

    /** Show a modal (remove 'hidden') */
    function showModal(modal) {
        if (!modal) return;
        modal.classList.remove('hidden');
        lockScroll();
    }

    /** Hide a modal (add 'hidden') */
    function hideModal(modal) {
        if (!modal) return;
        modal.classList.add('hidden');
        unlockScroll();
    }

    // ── Open volunteer modal ──
    if (openBtn && volunteerModal) {
        openBtn.addEventListener('click', function(e) {
            e.preventDefault();
            showModal(volunteerModal);
        });
    }

    // ── Close volunteer modal ──
    if (volunteerModal) {
        // Close on overlay, X button, or Cancel click
        volunteerModal.addEventListener('click', function(e) {
            if (e.target.closest('.close-volunteer-modal')) {
                hideModal(volunteerModal);
            }
        });
    }

    // ── Show success modal if form was submitted successfully ──
    @if(session('volunteer_success'))
        if (successModal) {
            showModal(successModal);
        }
    @endif

    // ── Auto-open volunteer modal on validation errors ──
    @if($errors->any())
        if (volunteerModal) {
            showModal(volunteerModal);
        }
    @endif

    // ── Resume upload: click zone triggers hidden file input ──
    const uploadZone = document.getElementById('resumeUploadZone');
    const resumeInput = document.getElementById('resumeInput');
    const resumeFileName = document.getElementById('resumeFileName');

    if (uploadZone && resumeInput) {
        uploadZone.addEventListener('click', function(e) {
            // Don't trigger if the user clicks the actual file input (it's hidden anyway)
            if (e.target !== resumeInput) {
                resumeInput.click();
            }
        });

        resumeInput.addEventListener('change', function() {
            if (resumeInput.files && resumeInput.files.length > 0) {
                const name = resumeInput.files[0].name;
                if (resumeFileName) {
                    resumeFileName.textContent = 'Selected: ' + name;
                    resumeFileName.classList.remove('hidden');
                }
                // Update the "Choose file" label
                const btnLabel = document.getElementById('resumeBtnLabel');
                if (btnLabel) {
                    btnLabel.textContent = 'Change file';
                }
            }
        });
    }

    // ── Close success modal ──
    if (successModal) {
        successModal.addEventListener('click', function(e) {
            if (e.target.classList.contains('close-success-modal')) {
                hideModal(successModal);
            }
        });
    }

    // ── Escape key closes any open modal ──
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            if (successModal && !successModal.classList.contains('hidden')) {
                hideModal(successModal);
            } else if (volunteerModal && !volunteerModal.classList.contains('hidden')) {
                hideModal(volunteerModal);
            }
        }
    });

    // ── Clean up body scroll on page unload (just in case) ──
    window.addEventListener('beforeunload', function() {
        unlockScroll();
    });
});
</script>

@endsection
