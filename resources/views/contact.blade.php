@extends('layouts.app')

@section('title', 'Contact — Krousar Thmey')
@section('description', 'Contact Krousar Thmey\'s offices in Cambodia, France, Switzerland, and Singapore.')

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
            <span class="text-white">Contact</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Contact Us</h1>
        <p class="text-white/70 text-lg max-w-2xl">We have offices in Cambodia, France, Switzerland, and Singapore. Reach out to us for partnerships, donations, or general enquiries.</p>
    </div>
</div>

{{-- Office Tabs + Contact Form --}}
<section class="py-20 bg-[#f8f9fc]" x-data="{ office: 'cambodia' }">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-5 gap-12">

            {{-- Left: Offices --}}
            <div class="lg:col-span-2">
                <h2 class="text-xl font-bold text-[#1a3c6e] mb-6">Our Offices</h2>
                <div class="space-y-3">
                    @foreach([
                        ['id' => 'cambodia', 'flag' => '🇰🇭', 'country' => 'Cambodia', 'city' => 'Phnom Penh (HQ)',
                         'address' => '#58, Street 478, Phnom Penh, Cambodia',
                         'phone' => '+855 (0)23 211 955', 'email' => 'info@krousar-thmey.org'],
                        ['id' => 'france', 'flag' => '🇫🇷', 'country' => 'France', 'city' => 'Paris',
                         'address' => '75, rue de la Roquette, 75011 Paris, France',
                         'phone' => '+33 (0)1 43 14 84 84', 'email' => 'france@krousar-thmey.org'],
                        ['id' => 'switzerland', 'flag' => '🇨🇭', 'country' => 'Switzerland', 'city' => 'Geneva',
                         'address' => 'Case Postale 3018, 1211 Geneva 3, Switzerland',
                         'phone' => '+41 (0)79 456 78 90', 'email' => 'suisse@krousar-thmey.org'],
                        ['id' => 'singapore', 'flag' => '🇸🇬', 'country' => 'Singapore', 'city' => 'Singapore',
                         'address' => '10 Anson Road, #27-15, Singapore 079903',
                         'phone' => '+65 6123 4567', 'email' => 'singapore@krousar-thmey.org'],
                    ] as $loc)
                    <button @click="office = '{{ $loc['id'] }}'"
                            :class="office === '{{ $loc['id'] }}' ? 'border-[#1a3c6e] bg-white shadow-md' : 'border-gray-100 bg-white hover:border-gray-200'"
                            class="w-full text-left p-5 rounded-2xl border-2 transition-all duration-200">
                        <div class="flex items-center gap-3">
                            <span class="text-2xl">{{ $loc['flag'] }}</span>
                            <div>
                                <div class="font-bold text-gray-800 text-sm">{{ $loc['country'] }}</div>
                                <div class="text-gray-400 text-xs">{{ $loc['city'] }}</div>
                            </div>
                            <svg class="w-4 h-4 text-[#1a3c6e] ml-auto opacity-0 transition-opacity duration-200"
                                 :class="office === '{{ $loc['id'] }}' ? 'opacity-100' : ''"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </div>

                        <div x-show="office === '{{ $loc['id'] }}'" class="mt-4 space-y-2 pt-4 border-t border-gray-100">
                            <p class="text-gray-600 text-xs flex items-start gap-2">
                                <svg class="w-3.5 h-3.5 text-[#e8a020] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                {{ $loc['address'] }}
                            </p>
                            <p class="text-gray-600 text-xs flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-[#e8a020] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                {{ $loc['phone'] }}
                            </p>
                            <p class="text-gray-600 text-xs flex items-center gap-2">
                                <svg class="w-3.5 h-3.5 text-[#e8a020] flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                {{ $loc['email'] }}
                            </p>
                        </div>
                    </button>
                    @endforeach
                </div>
            </div>

            {{-- Right: Contact Form --}}
            <div class="lg:col-span-3">
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
                                <option>Donation</option>
                                <option>Partnership / Sponsorship</option>
                                <option>Volunteering</option>
                                <option>Job Application</option>
                                <option>Media / Press</option>
                                <option>General Enquiry</option>
                            </select>
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

@endsection