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
                        ['id' => 'cambodia', 'flag' => '🇰🇭', 'country' => 'Cambodia', 'city' => '',
                         'address' => "Krousar Thmey Cambodia\n#145 street 132, Toeuk Laâk I, Toul Kork\nPhnom Penh - PO Box 1393",
                         'phone' => '+855 (0)23 880 502', 'email' => 'communication@krousar-thmey.org'],
                        ['id' => 'france', 'flag' => '🇫🇷', 'country' => 'France', 'city' => '',
                         'address' => "Krousar Thmey France\n62 rue Greneta\n75002 Paris",
                         'phone' => '01 40 13 06 30', 'email' => 'france@krousar-thmey.org'],
                        ['id' => 'singapore', 'flag' => '🇸🇬', 'country' => 'Singapore', 'city' => '',
                         'address' => "Krousar Thmey Singapore\n29 Leonie Hill, Horizon Towers West\nApt 13-04\nSingapore",
                         'phone' => '+65 98 506 438', 'email' => 'singapore@krousar-thmey.org'],
                        ['id' => 'switzerland', 'flag' => '🇨🇭', 'country' => 'Switzerland', 'city' => '',
                         'address' => "Krousar Thmey Switzerland\nc/o Mme Sylvie Bédat\nRoute de Florissant 89 A\n1206 Geneva",
                         'phone' => '+41 79 203 70 82', 'email' => 'switzerland@krousar-thmey.org'],
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
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 lg:p-10 relative"
                     x-data="{ showPopup: {{ session('success') ? 'true' : 'false' }} }"
                     x-init="if (showPopup) { setTimeout(() => showPopup = false, 5000) }">

                    <h2 class="text-xl font-bold text-[#1a3c6e] mb-2">Send Us a Message</h2>
                    <p class="text-gray-500 text-sm mb-8">We'll get back to you within 2 business days.</p>

                    {{-- Success Popup Notification --}}
                    <div x-show="showPopup"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                         @click.outside="showPopup = false"
                         class="fixed right-4 top-4 z-50 w-[calc(100%-2rem)] max-w-sm rounded-xl border border-green-200 bg-white/95 p-3 shadow-lg backdrop-blur"
                         x-cloak>
                        <div class="flex items-start gap-3">
                            <div class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-lg bg-green-100">
                                <svg class="h-4 w-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-sm font-semibold text-green-900">Thank you for reaching out!</h3>
                                <p class="mt-0.5 text-xs text-green-700">Your message has been received and our team will reply soon.</p>
                            </div>
                            <button @click="showPopup = false" class="flex-shrink-0 text-green-500 transition-colors hover:text-green-700">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Contact Form --}}
                    <form method="POST" action="{{ route('contact.store') }}" class="space-y-5">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-5">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1.5">First Name *</label>
                                <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required
                                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1a3c6e] focus:ring-2 focus:ring-[#1a3c6e]/10 text-sm transition-colors @error('first_name') border-red-300 @enderror"
                                       placeholder="John">
                                @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1.5">Last Name *</label>
                                <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                                       class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1a3c6e] focus:ring-2 focus:ring-[#1a3c6e]/10 text-sm transition-colors @error('last_name') border-red-300 @enderror"
                                       placeholder="Doe">
                                @error('last_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">Email Address *</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1a3c6e] focus:ring-2 focus:ring-[#1a3c6e]/10 text-sm transition-colors @error('email') border-red-300 @enderror"
                                   placeholder="john@example.com">
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="organisation" class="block text-sm font-medium text-gray-700 mb-1.5">Organisation (optional)</label>
                            <input type="text" name="organisation" id="organisation" value="{{ old('organisation') }}"
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1a3c6e] focus:ring-2 focus:ring-[#1a3c6e]/10 text-sm transition-colors"
                                   placeholder="Your organization">
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1.5">Subject *</label>
                            <select name="subject" id="subject" required
                                    class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1a3c6e] focus:ring-2 focus:ring-[#1a3c6e]/10 text-sm transition-colors bg-white @error('subject') border-red-300 @enderror">
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
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1.5">Message *</label>
                            <textarea name="message" id="message" rows="5" required
                                      class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:border-[#1a3c6e] focus:ring-2 focus:ring-[#1a3c6e]/10 text-sm transition-colors resize-none @error('message') border-red-300 @enderror"
                                      placeholder="Your message...">{{ old('message') }}</textarea>
                            @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="flex items-start gap-3">
                            <input type="checkbox" name="consent" id="consent" value="1" class="mt-0.5 rounded accent-[#1a3c6e]" {{ old('consent') ? 'checked' : '' }}>
                            <label for="consent" class="text-gray-500 text-xs leading-relaxed">
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

@endsection
