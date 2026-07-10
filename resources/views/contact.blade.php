@extends('layouts.app')

@section('title', 'Contact — Krousar Thmey')
@section('description', 'Contact Krousar Thmey\'s offices in Cambodia, France, Switzerland, and Singapore.')

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
            <span class="text-white">Contact</span>
        </nav>
        <p class="text-[#8da83a] font-bold text-sm uppercase tracking-widest mb-3">Get in Touch</p>
        <h1 class="text-4xl md:text-5xl font-black uppercase tracking-wide text-white mb-4">Contact Us</h1>
        <p class="text-white/70 text-lg max-w-2xl">We have offices in Cambodia, France, Switzerland, and Singapore. Reach out to us for partnerships, donations, or general enquiries.</p>

        {{-- Quick contact strip --}}
        <div class="flex flex-wrap gap-4 mt-10">
            <a href="tel:+85523211955" class="flex items-center gap-2 bg-white/15 border border-white/20 rounded-full px-5 py-2.5 text-white text-sm font-medium hover:bg-white/25 transition-colors">
                <svg class="w-4 h-4 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                +855 (0)23 211 955
            </a>
            <a href="mailto:info@krousar-thmey.org" class="flex items-center gap-2 bg-white/15 border border-white/20 rounded-full px-5 py-2.5 text-white text-sm font-medium hover:bg-white/25 transition-colors">
                <svg class="w-4 h-4 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                info@krousar-thmey.org
            </a>
            <a href="https://www.facebook.com/KrousarThmey" target="_blank" rel="noopener" class="flex items-center gap-2 bg-white/15 border border-white/20 rounded-full px-5 py-2.5 text-white text-sm font-medium hover:bg-white/25 transition-colors">
                <svg class="w-4 h-4 text-[#8da83a]" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                Facebook
            </a>
        </div>
    </div>
</div>

{{-- Image strip --}}
<div class="grid grid-cols-3 h-56 -mt-1">
    <div class="relative overflow-hidden" data-reveal="scale">
        <img src="{{ asset('images/children.jpg') }}" alt="Children at Krousar Thmey"
             class="w-full h-full object-cover scale-105 hover:scale-100 transition-transform duration-700">
        <div class="absolute inset-0 bg-[#2d6fa3]/30"></div>
        <div class="absolute bottom-4 left-4">
            <span class="bg-white/90 text-[#2d6fa3] text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded-full">Cambodia HQ</span>
        </div>
    </div>
    <div class="relative overflow-hidden" data-reveal="scale" style="--reveal-delay: 100">
        <img src="{{ asset('images/cultural.jpg') }}" alt="Cultural programs"
             class="w-full h-full object-cover scale-105 hover:scale-100 transition-transform duration-700">
        <div class="absolute inset-0 bg-[#1d4e7a]/30"></div>
        <div class="absolute bottom-4 left-4">
            <span class="bg-white/90 text-[#2d6fa3] text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded-full">Our Programs</span>
        </div>
    </div>
    <div class="relative overflow-hidden" data-reveal="scale" style="--reveal-delay: 200">
        <img src="{{ asset('images/special-ed.jpg') }}" alt="Special education"
             class="w-full h-full object-cover scale-105 hover:scale-100 transition-transform duration-700">
        <div class="absolute inset-0 bg-[#8da83a]/30"></div>
        <div class="absolute bottom-4 left-4">
            <span class="bg-white/90 text-[#2d6fa3] text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded-full">Education</span>
        </div>
    </div>
</div>

{{-- Our Offices --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-14" data-reveal>
            <span class="inline-flex items-center gap-2 bg-[#e8a020]/20 border border-[#e8a020]/30 text-[#e8a020] text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4">Our Offices</span>
            <h2 class="text-3xl md:text-4xl font-black uppercase tracking-wide text-[#2d6fa3]">Find Us Around the World</h2>
            <div class="w-16 h-1 bg-[#d32f2f] rounded-full mx-auto mt-4"></div>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($offices as $loc)
            <div class="bg-[#f8f9fc] rounded-3xl border-2 {{ $loc->accent_color }}/30 hover:border-opacity-100 hover:shadow-lg transition-all duration-300 overflow-hidden group"
                 data-reveal="up" style="--reveal-delay: {{ $loop->index * 100 }}">
                <div class="p-6">
                    <div class="flex items-start justify-between mb-4">
                        <span class="text-4xl">{{ $loc->flag }}</span>
                        @if($loc->badge)
                        <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full {{ $loc->badge_color }}">{{ $loc->badge }}</span>
                        @endif
                    </div>
                    <h3 class="text-lg font-black text-[#2d6fa3] uppercase tracking-wide">{{ $loc->country }}</h3>
                    <p class="text-[#8da83a] text-xs font-semibold mb-4">{{ $loc->city }}</p>

                    <div class="space-y-3">
                        <div class="flex items-start gap-2.5">
                            <svg class="w-3.5 h-3.5 text-[#e8a020] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            <p class="text-gray-500 text-xs leading-relaxed">{{ $loc->address }}</p>
                        </div>
                        @if($loc->phone)
                        <a href="tel:{{ preg_replace('/[^+0-9]/', '', $loc->phone) }}" class="flex items-center gap-2.5 group/link">
                            <svg class="w-3.5 h-3.5 text-[#e8a020] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            <span class="text-gray-500 text-xs group-hover/link:text-[#2d6fa3] transition-colors">{{ $loc->phone }}</span>
                        </a>
                        @endif
                        @if($loc->email)
                        <a href="mailto:{{ $loc->email }}" class="flex items-center gap-2.5 group/link">
                            <svg class="w-3.5 h-3.5 text-[#e8a020] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span class="text-gray-500 text-xs group-hover/link:text-[#2d6fa3] transition-colors break-all">{{ $loc->email }}</span>
                        </a>
                        @endif
                    </div>
                </div>
                @if($loc->email)
                <div class="px-6 pb-5">
                    <a href="mailto:{{ $loc->email }}" class="flex items-center justify-center gap-2 w-full py-2.5 rounded-xl bg-[#2d6fa3]/10 text-[#2d6fa3] text-xs font-semibold hover:bg-[#2d6fa3] hover:text-white transition-all duration-200">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Send Email
                    </a>
                </div>
                @endif
            </div>
            @empty
            <div class="col-span-4 py-12 text-center text-gray-400 text-sm">No offices configured yet.</div>
            @endforelse
        </div>
    </div>
</section>

{{-- Contact Form --}}
<section class="py-20 bg-[#f8f9fc]">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-5 gap-12 items-start">

            {{-- Left: Info sidebar --}}
            <div class="lg:col-span-2 space-y-6" data-reveal="left">
                <div>
                    <span class="inline-flex items-center gap-2 bg-[#e8a020]/20 border border-[#e8a020]/30 text-[#e8a020] text-xs font-bold uppercase tracking-widest px-4 py-1.5 rounded-full mb-4">Write to Us</span>
                    <h2 class="text-3xl font-black uppercase tracking-wide text-[#2d6fa3] mt-4 mb-2">Send Us a Message</h2>
                    <div class="w-12 h-1 bg-[#d32f2f] rounded-full mb-5"></div>
                    <p class="text-gray-500 text-sm leading-relaxed">We'll get back to you within 2 business days. For urgent matters, please call our Cambodia headquarters directly.</p>
                </div>

                {{-- Response time --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-5 space-y-4">
                    @foreach([
                        ['icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'label' => 'Response time', 'value' => 'Within 2 business days'],
                        ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label' => 'General enquiries', 'value' => 'info@krousar-thmey.org'],
                        ['icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'label' => 'Phone (HQ)', 'value' => '+855 (0)23 211 955'],
                    ] as $info)
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                            <svg class="w-4 h-4 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $info['icon'] }}"/></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs">{{ $info['label'] }}</p>
                            <p class="text-gray-700 text-sm font-medium">{{ $info['value'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Topics --}}
                <div class="bg-white rounded-2xl border border-gray-100 p-5">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">We can help with</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Donations', 'Partnerships', 'Volunteering', 'Job Applications', 'Media & Press', 'General Enquiries'] as $topic)
                        <span class="bg-[#2d6fa3]/8 text-[#2d6fa3] text-xs font-medium px-3 py-1.5 rounded-full border border-[#2d6fa3]/15">{{ $topic }}</span>
                        @endforeach
                    </div>
                </div>

                {{-- Warm image --}}
                <div class="relative rounded-2xl overflow-hidden h-48 shadow-md">
                    <img src="{{ asset('images/children.jpg') }}" alt="Children at Krousar Thmey"
                         class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1d4e7a]/80 via-transparent to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4">
                        <p class="text-white font-bold text-sm leading-snug">"Every message brings us closer to helping more children."</p>
                        <p class="text-white/60 text-xs mt-1">— Krousar Thmey Team</p>
                    </div>
                </div>
            </div>

            {{-- Right: Form --}}
            <div class="lg:col-span-3" data-reveal="right">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 lg:p-10">
                    <form class="space-y-5" method="POST" action="{{ route('contact.store') }}">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">First Name <span class="text-[#d32f2f]">*</span></label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" placeholder="John"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/10 text-sm transition-colors">
                                @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Last Name <span class="text-[#d32f2f]">*</span></label>
                                <input type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Doe"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/10 text-sm transition-colors">
                                @error('last_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Email Address <span class="text-[#d32f2f]">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="john@example.com"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/10 text-sm transition-colors">
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Organisation <span class="text-gray-400 font-normal normal-case">(optional)</span></label>
                            <input type="text" name="organisation" value="{{ old('organisation') }}" placeholder="Your organization"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/10 text-sm transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Subject <span class="text-[#d32f2f]">*</span></label>
                            <select name="subject" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/10 text-sm transition-colors bg-white text-gray-700">
                                <option value="">Select a topic</option>
                                <option value="Donation" {{ old('subject') === 'Donation' ? 'selected' : '' }}>Donation</option>
                                <option value="Partnership / Sponsorship" {{ old('subject') === 'Partnership / Sponsorship' ? 'selected' : '' }}>Partnership / Sponsorship</option>
                                <option value="Volunteering" {{ old('subject') === 'Volunteering' ? 'selected' : '' }}>Volunteering</option>
                                <option value="Job Application" {{ old('subject') === 'Job Application' ? 'selected' : '' }}>Job Application</option>
                                <option value="Media / Press" {{ old('subject') === 'Media / Press' ? 'selected' : '' }}>Media / Press</option>
                                <option value="General Enquiry" {{ old('subject') === 'General Enquiry' ? 'selected' : '' }}>General Enquiry</option>
                            </select>
                            @error('subject') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-600 mb-1.5 uppercase tracking-wide">Message <span class="text-[#d32f2f]">*</span></label>
                            <textarea rows="5" name="message" placeholder="Your message..."
                                      class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:outline-none focus:border-[#2d6fa3] focus:ring-2 focus:ring-[#2d6fa3]/10 text-sm transition-colors resize-none">{{ old('message') }}</textarea>
                            @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="flex items-start gap-3 bg-[#f8f9fc] rounded-xl p-4 border border-gray-100">
                            <input type="checkbox" id="consent" name="consent" value="1" {{ old('consent') ? 'checked' : '' }} class="mt-0.5 rounded accent-[#2d6fa3] w-4 h-4 flex-shrink-0">
                            <label for="consent" class="text-gray-500 text-xs leading-relaxed cursor-pointer">
                                I agree to Krousar Thmey storing my contact information to respond to my enquiry, in accordance with their privacy policy.
                            </label>
                        </div>
                        @error('consent') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        <button type="submit" class="btn-blue w-full justify-center py-4 rounded-xl text-base">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
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
        <p class="text-[#8da83a] font-bold text-sm uppercase tracking-widest mb-3">Support Our Work</p>
        <h2 class="text-3xl md:text-4xl font-black uppercase tracking-wide text-white mb-4">Make a Difference Today</h2>
        <p class="text-white/70 text-lg mb-8 max-w-2xl mx-auto">Every contribution goes directly to supporting children across Cambodia. 100% of funds reach the children.</p>
        <div class="flex flex-wrap gap-4 justify-center">
            <a href="{{ route('donate') }}" class="btn-primary text-base">Donate Now</a>
            <a href="{{ route('involved') }}" class="btn-outline text-base">Get Involved</a>
        </div>
    </div>
</section>

@endsection
