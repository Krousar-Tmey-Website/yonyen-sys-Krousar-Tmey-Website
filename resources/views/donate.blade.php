@extends('layouts.app')

@section('title', 'Donate — Krousar Thmey')
@section('description', 'Support children in Cambodia. Donate locally via ABA or ACLEDA QR, or request a card/bank donation online.')

@section('content')

{{-- Header --}}
<div class="bg-[#2d6fa3] pt-14 pb-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-80 h-80 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-56 h-56 rounded-full bg-[#8da83a] translate-y-1/2 -translate-x-1/3"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-6 text-center">
        <div class="w-16 h-16 rounded-2xl bg-white/15 flex items-center justify-center mx-auto mb-5">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
            </svg>
        </div>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Support Our Mission</h1>
        <p class="text-white/75 text-lg max-w-2xl mx-auto leading-relaxed">
            Every donation goes directly to supporting children across Cambodia.<br>
            <span class="font-semibold text-white">100% of funds reach the children.</span>
        </p>
    </div>
</div>

{{-- Trust strip --}}
<div class="bg-[#8da83a]">
    <div class="max-w-7xl mx-auto px-6 py-4 flex flex-col sm:flex-row items-center justify-center gap-6 sm:gap-12 text-white text-sm font-medium">
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
            100% goes to children
        </div>
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            Annual independent audit
        </div>
        <div class="flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Team replies within 1–2 days
        </div>
    </div>
</div>

{{-- Main section --}}
<section class="py-16 lg:py-24 bg-[#f8f9fc]"
         x-data="{ tab: 'local' }">
    <div class="max-w-5xl mx-auto px-6">

        {{-- Tab Switcher --}}
        <div class="flex rounded-2xl bg-white border border-gray-200 p-1.5 gap-1.5 max-w-md mx-auto mb-14 shadow-sm">
            <button @click="tab = 'local'"
                    :class="tab === 'local' ? 'bg-[#2d6fa3] text-white shadow-md' : 'text-gray-500 hover:text-gray-700'"
                    class="flex-1 py-3 rounded-xl font-semibold text-sm transition-all duration-200 flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Local (Cambodia)
            </button>
            <button @click="tab = 'international'"
                    :class="tab === 'international' ? 'bg-[#2d6fa3] text-white shadow-md' : 'text-gray-500 hover:text-gray-700'"
                    class="flex-1 py-3 rounded-xl font-semibold text-sm transition-all duration-200 flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064"/></svg>
                International
            </button>
        </div>

        {{-- ===== LOCAL TAB ===== --}}
        <div x-show="tab === 'local'"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0">

            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-[#2d6fa3]">Donate Locally in Cambodia</h2>
                <p class="text-gray-500 mt-2 text-sm">Scan with your banking app · No internet transfer fees</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">

                {{-- ABA Pay --}}
                <div class="bg-white rounded-3xl border-2 border-gray-100 hover:border-[#003087]/20 hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="bg-[#003087] px-7 py-5 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center flex-shrink-0">
                            <span class="text-[#003087] font-black text-lg">ABA</span>
                        </div>
                        <div>
                            <div class="text-white font-bold text-lg">ABA Pay</div>
                            <div class="text-white/60 text-xs">ABA Bank · Cambodia</div>
                        </div>
                    </div>
                    <div class="p-7">
                        <div class="flex justify-center mb-6">
                            <div class="relative">
                                <img src="{{ asset('images/qr-aba.png') }}" alt="ABA QR"
                                     id="qr-aba"
                                     class="w-52 h-52 object-contain rounded-2xl border-2 border-gray-100"
                                     onerror="document.getElementById('qr-aba-ph').classList.remove('hidden');this.classList.add('hidden')">
                                <div id="qr-aba-ph" class="hidden w-52 h-52 rounded-2xl border-2 border-dashed border-[#003087]/30 bg-[#003087]/5 flex flex-col items-center justify-center gap-3">
                                    <svg class="w-10 h-10 text-[#003087]/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                                    <p class="text-[#003087]/40 text-xs text-center px-4 leading-snug">Add your QR file at<br><code class="bg-white px-1 rounded text-[10px]">public/images/qr-aba.png</code></p>
                                </div>
                                <div class="absolute bottom-2 right-2 w-7 h-7 rounded-lg bg-[#003087] flex items-center justify-center">
                                    <span class="text-white font-black text-[8px]">ABA</span>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2 mb-5">
                            <div class="flex justify-between bg-gray-50 rounded-xl px-4 py-2.5">
                                <span class="text-gray-400 text-xs">Account Name</span>
                                <span class="text-gray-800 font-semibold text-xs">KROUSAR THMEY</span>
                            </div>
                            <div class="flex justify-between bg-gray-50 rounded-xl px-4 py-2.5">
                                <span class="text-gray-400 text-xs">Account No.</span>
                                <span class="text-gray-800 font-mono font-semibold text-xs">000 123 456</span>
                            </div>
                            <div class="flex justify-between bg-gray-50 rounded-xl px-4 py-2.5">
                                <span class="text-gray-400 text-xs">Currency</span>
                                <span class="text-gray-800 font-semibold text-xs">KHR / USD</span>
                            </div>
                        </div>
                        <div class="bg-[#003087]/5 rounded-xl p-4">
                            <p class="text-[#003087] font-semibold text-xs mb-2 uppercase tracking-wider">How to pay</p>
                            <ol class="space-y-1.5">
                                @foreach(['Open ABA Mobile app','Tap Pay → Scan QR','Scan the code above','Enter amount & confirm'] as $i => $s)
                                <li class="flex items-start gap-2 text-xs text-gray-600">
                                    <span class="w-4 h-4 rounded-full bg-[#003087] text-white flex items-center justify-center flex-shrink-0 font-bold text-[9px] mt-0.5">{{ $i+1 }}</span>{{ $s }}
                                </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>

                {{-- ACLEDA --}}
                <div class="bg-white rounded-3xl border-2 border-gray-100 hover:border-[#e31e2d]/20 hover:shadow-xl transition-all duration-300 overflow-hidden">
                    <div class="bg-[#e31e2d] px-7 py-5 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-white flex items-center justify-center flex-shrink-0">
                            <span class="text-[#e31e2d] font-black text-[11px] leading-tight text-center">ACL<br>EDA</span>
                        </div>
                        <div>
                            <div class="text-white font-bold text-lg">ACLEDA Bank</div>
                            <div class="text-white/60 text-xs">ACLEDA · Cambodia</div>
                        </div>
                    </div>
                    <div class="p-7">
                        <div class="flex justify-center mb-6">
                            <div class="relative">
                                <img src="{{ asset('images/qr-acleda.png') }}" alt="ACLEDA QR"
                                     id="qr-acleda"
                                     class="w-52 h-52 object-contain rounded-2xl border-2 border-gray-100"
                                     onerror="document.getElementById('qr-acleda-ph').classList.remove('hidden');this.classList.add('hidden')">
                                <div id="qr-acleda-ph" class="hidden w-52 h-52 rounded-2xl border-2 border-dashed border-[#e31e2d]/30 bg-[#e31e2d]/5 flex flex-col items-center justify-center gap-3">
                                    <svg class="w-10 h-10 text-[#e31e2d]/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                                    <p class="text-[#e31e2d]/40 text-xs text-center px-4 leading-snug">Add your QR file at<br><code class="bg-white px-1 rounded text-[10px]">public/images/qr-acleda.png</code></p>
                                </div>
                                <div class="absolute bottom-2 right-2 w-7 h-7 rounded-lg bg-[#e31e2d] flex items-center justify-center">
                                    <span class="text-white font-black text-[8px]">ACL</span>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-2 mb-5">
                            <div class="flex justify-between bg-gray-50 rounded-xl px-4 py-2.5">
                                <span class="text-gray-400 text-xs">Account Name</span>
                                <span class="text-gray-800 font-semibold text-xs">KROUSAR THMEY</span>
                            </div>
                            <div class="flex justify-between bg-gray-50 rounded-xl px-4 py-2.5">
                                <span class="text-gray-400 text-xs">Account No.</span>
                                <span class="text-gray-800 font-mono font-semibold text-xs">0001 2345 678</span>
                            </div>
                            <div class="flex justify-between bg-gray-50 rounded-xl px-4 py-2.5">
                                <span class="text-gray-400 text-xs">Currency</span>
                                <span class="text-gray-800 font-semibold text-xs">KHR / USD</span>
                            </div>
                        </div>
                        <div class="bg-[#e31e2d]/5 rounded-xl p-4">
                            <p class="text-[#e31e2d] font-semibold text-xs mb-2 uppercase tracking-wider">How to pay</p>
                            <ol class="space-y-1.5">
                                @foreach(['Open ACLEDA Unity app','Tap QR Payment → Scan','Scan the code above','Enter amount & confirm'] as $i => $s)
                                <li class="flex items-start gap-2 text-xs text-gray-600">
                                    <span class="w-4 h-4 rounded-full bg-[#e31e2d] text-white flex items-center justify-center flex-shrink-0 font-bold text-[9px] mt-0.5">{{ $i+1 }}</span>{{ $s }}
                                </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>

            </div>

            {{-- After-payment note --}}
            <div class="mt-8 bg-white rounded-2xl border border-gray-100 p-5 flex items-start gap-4 shadow-sm">
                <div class="w-9 h-9 rounded-xl bg-[#8da83a]/10 flex items-center justify-center flex-shrink-0 mt-0.5">
                    <svg class="w-4 h-4 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed">
                    After paying, please send your <strong class="text-gray-700">payment screenshot</strong> to
                    <a href="#" @click.prevent="openEmail('info@krousar-thmey.org')" class="text-[#2d6fa3] hover:underline font-medium">info@krousar-thmey.org</a>
                    so we can send you a receipt and thank you note.
                </p>
            </div>
        </div>

        {{-- ===== INTERNATIONAL TAB ===== --}}
        <div x-show="tab === 'international'"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-data="{
                amount: 30,
                custom: '',
                currency: 'EUR',
                frequency: 'one-time',
                get finalAmount() { return this.custom ? this.custom : this.amount; },
                get symbol() { return this.currency === 'EUR' ? '€' : this.currency === 'KHR' ? '៛' : '$'; },
                get hint() {
                    const a = parseInt(this.finalAmount);
                    if (!a) return '';
                    if (a <= 15)  return 'Provides school supplies for one student for a month';
                    if (a <= 30)  return 'Covers food costs for a child in our care for a month';
                    if (a <= 60)  return 'Funds one month of special education for a deaf student';
                    if (a <= 100) return 'Supports vocational training for a young adult';
                    return 'Your generous gift makes a huge difference — thank you!';
                }
             }">

            {{-- Success message --}}
            @if(session('success'))
            <div class="bg-[#8da83a]/10 border border-[#8da83a]/30 rounded-2xl p-6 mb-8 flex items-start gap-4">
                <div class="w-10 h-10 rounded-full bg-[#8da83a] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <p class="font-bold text-[#8da83a] text-lg">Thank you, {{ session('donor_name') }}!</p>
                    <p class="text-gray-600 text-sm mt-1">
                        Your donation request has been received. We've sent a confirmation to your email address.
                        Our team will contact you within <strong>1–2 business days</strong> to arrange the payment.
                    </p>
                </div>
            </div>
            @endif

            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-[#2d6fa3]">Donate by Card or Bank Transfer</h2>
                <p class="text-gray-500 mt-2 text-sm">Choose an amount → fill your details → we contact you to process the payment</p>
            </div>

            <div class="grid lg:grid-cols-5 gap-8 items-start">

                {{-- Left: amount picker --}}
                <div class="lg:col-span-2 space-y-5">

                    {{-- Preset amounts --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                        <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider mb-4">Select Amount</p>
                        <div class="grid grid-cols-2 gap-3 mb-4">
                            @foreach([15, 30, 60, 100] as $amt)
                            <button @click="amount = {{ $amt }}; custom = ''"
                                    :class="amount === {{ $amt }} && !custom
                                        ? 'bg-[#2d6fa3] text-white border-[#2d6fa3] scale-105 shadow-md'
                                        : 'bg-white text-gray-700 border-gray-200 hover:border-[#2d6fa3]'"
                                    class="border-2 rounded-xl py-4 font-bold text-xl transition-all duration-200">
                                €{{ $amt }}
                            </button>
                            @endforeach
                        </div>
                        <div class="flex gap-2">
                            <div class="relative flex-1">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 font-semibold" x-text="symbol"></span>
                                <input type="number" min="1" placeholder="Other"
                                       x-model="custom"
                                       @input="if(custom) amount = null"
                                       class="w-full pl-8 pr-3 py-3 rounded-xl border-2 border-gray-200 focus:border-[#2d6fa3] focus:outline-none text-sm">
                            </div>
                            <select x-model="currency"
                                    class="px-3 py-3 rounded-xl border-2 border-gray-200 focus:border-[#2d6fa3] focus:outline-none text-sm bg-white text-gray-700">
                                <option value="EUR">EUR</option>
                                <option value="USD">USD</option>
                                <option value="KHR">KHR</option>
                            </select>
                        </div>
                        <p class="text-center text-xs text-[#8da83a] mt-3 min-h-[18px] font-medium" x-text="hint"></p>
                    </div>

                    {{-- Frequency --}}
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
                        <p class="text-gray-500 text-xs font-semibold uppercase tracking-wider mb-3">Frequency</p>
                        <div class="space-y-2">
                            @foreach(['one-time' => 'One-time gift', 'monthly' => 'Monthly (recurring)', 'annual' => 'Annual (once per year)'] as $val => $label)
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="radio" name="freq_display" value="{{ $val }}"
                                       x-model="frequency"
                                       class="accent-[#2d6fa3] w-4 h-4">
                                <span class="text-gray-700 text-sm group-hover:text-[#2d6fa3] transition-colors">{{ $label }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Impact preview --}}
                    <div class="bg-[#2d6fa3]/5 border border-[#2d6fa3]/15 rounded-2xl p-5">
                        <p class="text-[#2d6fa3] font-semibold text-xs uppercase tracking-wider mb-2">Your impact</p>
                        <p class="text-[#2d6fa3] text-2xl font-bold" x-text="symbol + (finalAmount || '0')"></p>
                        <p class="text-gray-500 text-xs mt-1" x-text="frequency === 'monthly' ? 'per month' : frequency === 'annual' ? 'per year' : 'one-time gift'"></p>
                    </div>
                </div>

                {{-- Right: contact form --}}
                <div class="lg:col-span-3">
                    <form action="{{ route('donate.send') }}" method="POST" class="bg-white rounded-3xl border border-gray-100 shadow-sm p-7 lg:p-8">
                        @csrf

                        {{-- Hidden fields synced from Alpine --}}
                        <input type="hidden" name="amount"    :value="finalAmount">
                        <input type="hidden" name="currency"  :value="currency">
                        <input type="hidden" name="frequency" :value="frequency">

                        <h3 class="font-bold text-gray-800 text-lg mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Your Contact Details
                        </h3>

                        @if($errors->any())
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4 mb-5">
                            <ul class="text-red-600 text-sm space-y-1">
                                @foreach($errors->all() as $error)
                                <li class="flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-red-400 flex-shrink-0"></span>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="space-y-4">
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Full Name <span class="text-red-400">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                           placeholder="Your full name"
                                           class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#2d6fa3] focus:outline-none text-sm transition-colors @error('name') border-red-300 @enderror">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 mb-1.5">Email Address <span class="text-red-400">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                           placeholder="you@example.com"
                                           class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#2d6fa3] focus:outline-none text-sm transition-colors @error('email') border-red-300 @enderror">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Phone / Telegram <span class="text-gray-400 font-normal">(optional)</span></label>
                                <input type="text" name="phone" value="{{ old('phone') }}"
                                       placeholder="+1 234 567 890 or @username"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#2d6fa3] focus:outline-none text-sm transition-colors">
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-600 mb-1.5">Message <span class="text-gray-400 font-normal">(optional)</span></label>
                                <textarea name="message" rows="3"
                                          placeholder="Any specific program you'd like to support, or questions for our team..."
                                          class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#2d6fa3] focus:outline-none text-sm resize-none transition-colors">{{ old('message') }}</textarea>
                            </div>

                            {{-- Summary box --}}
                            <div class="bg-[#f8f9fc] rounded-xl px-5 py-4 flex items-center justify-between gap-4 border border-gray-100">
                                <div>
                                    <p class="text-xs text-gray-400 font-medium">Donation request</p>
                                    <p class="text-[#2d6fa3] font-bold text-xl mt-0.5" x-text="symbol + (finalAmount || '—') + ' ' + currency"></p>
                                    <p class="text-gray-400 text-xs" x-text="frequency === 'monthly' ? '· monthly' : frequency === 'annual' ? '· annual' : '· one-time'"></p>
                                </div>
                                <svg class="w-8 h-8 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                            </div>

                            <button type="submit"
                                    class="w-full btn-blue justify-center py-4 rounded-xl text-base">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                Send Donation Request
                            </button>
                            <p class="text-center text-gray-400 text-xs">
                                We'll email you within 1–2 business days to arrange payment.
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- Impact photos --}}
<section class="py-14 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <p class="text-center text-gray-400 text-xs font-semibold uppercase tracking-wider mb-8">Your donation in action</p>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach([
                ['img'=>'special-ed.jpg',  'amount'=>'€60/mo', 'label'=>'Funds one deaf student\'s education'],
                ['img'=>'children.jpg',    'amount'=>'€30/mo', 'label'=>'Covers food for a child in our care'],
                ['img'=>'cultural.jpg',    'amount'=>'€15/mo', 'label'=>'Art supplies for Khmer arts students'],
                ['img'=>'hygiene.jpg',     'amount'=>'€100',   'label'=>'Vocational training for a young adult'],
            ] as $item)
            <div class="rounded-2xl overflow-hidden border border-gray-100 group hover:shadow-lg transition-shadow">
                <div class="relative h-40 overflow-hidden">
                    <img src="{{ asset('images/'.$item['img']) }}" alt="{{ $item['label'] }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1d4e7a]/70 to-transparent"></div>
                    <span class="absolute bottom-3 left-3 text-white font-bold text-lg">{{ $item['amount'] }}</span>
                </div>
                <div class="p-4 bg-white">
                    <p class="text-gray-500 text-xs leading-relaxed">{{ $item['label'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
