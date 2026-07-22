@extends('layouts.app')

@section('title', 'International Donation — Krousar Thmey')
@section('description', 'Support children in Cambodia. Donate internationally via bank wire transfer.')

@section('content')

{{-- Header --}}
<div class="relative overflow-hidden bg-[#2d6fa3] pt-20 pb-28">
    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1400&q=80"
         alt="Children smiling together"
         class="absolute inset-0 h-full w-full object-cover">
    <div class="absolute inset-0 bg-[#2d6fa3]/75"></div>
    <div class="absolute inset-0 opacity-15">
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

{{-- Main section --}}
<section class="pt-16 pb-20 bg-[#f8f9fc]">
    <div class="max-w-[1040px] mx-auto px-4 sm:px-6 2xl:px-0">

        {{-- Mode Switcher Tabs --}}
        <div class="flex justify-center gap-4 mb-10">
            <a href="{{ route('donate') }}"
               class="px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300 bg-white border border-slate-200 text-slate-650 hover:bg-slate-50 flex items-center gap-2">
                <svg class="w-4 h-4 text-slate-450" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Local Donation (Cambodia)
            </a>
            <a href="{{ route('donate.international') }}"
               class="px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300 bg-[#2d6fa3] text-white shadow-[0_8px_18px_rgba(45,111,163,0.25)] flex items-center gap-2">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                </svg>
                International Donation
            </a>
        </div>

        {{-- Twin Columns Layout --}}
        <div class="grid md:grid-cols-2 gap-8 items-start">
            
            {{-- LEFT CARD: Campaign Metrics --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 p-8 shadow-sm flex flex-col justify-between min-h-[460px]">
                <div class="text-center space-y-4">
                    <h2 class="text-3xl font-black text-slate-805">Support Our Cause</h2>
                    <p class="text-sm text-slate-500 leading-relaxed max-w-md mx-auto">
                        Help our organization by donating today! Donations go to making a difference for our cause.
                    </p>
                </div>

                {{-- Metric grid with borders --}}
                <div class="border border-slate-200 rounded-xl overflow-hidden bg-white grid grid-cols-3 divide-x divide-slate-250 py-4 my-8">
                    <div class="text-center">
                        <span class="block text-lg font-extrabold text-slate-900">${{ number_format($raised, 2) }}</span>
                        <span class="text-xs text-slate-450 mt-1 block">Raised</span>
                    </div>
                    <div class="text-center">
                        <span class="block text-lg font-extrabold text-slate-900">{{ $count }}</span>
                        <span class="text-xs text-slate-450 mt-1 block">Donations</span>
                    </div>
                    <div class="text-center">
                        <span class="block text-lg font-extrabold text-slate-900">${{ number_format($goal, 2) }}</span>
                        <span class="text-xs text-slate-450 mt-1 block">Goal</span>
                    </div>
                </div>

                {{-- Progress Bar --}}
                @php
                    $percent = min(100, ($raised / $goal) * 100);
                @endphp
                <div class="space-y-2">
                    <div class="h-4 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-500 rounded-full" style="width: {{ $percent }}%"></div>
                    </div>
                    <div class="flex items-center justify-between text-xs font-bold text-slate-500">
                        <span>${{ number_format($raised, 2) }} amount</span>
                        <span>${{ number_format($goal, 2) }} amount</span>
                    </div>
                </div>
            </div>

            {{-- RIGHT CARD: Dual-step Wizard --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden min-h-[460px]"
                 x-data="{
                    step: {{ $errors->any() ? 2 : 1 }},
                    currency: '{{ old('currency', 'USD') }}',
                    amount: {{ old('amount', 5) }},
                    custom_amount: '{{ old('custom_amount') }}',
                    activePreset: 5,
                    frequency: '{{ old('frequency', 'one-time') }}',
                    first_name: '{{ old('first_name') }}',
                    last_name: '{{ old('last_name') }}',
                    email: '{{ old('email') }}',
                    phone: '{{ old('phone') }}',
                    message: '{{ old('message') }}',
                    get presets() {
                        return this.currency === 'KHR'
                            ? [20000, 40000, 80000, 200000, 400000, 1000000]
                            : [5, 10, 20, 50, 100, 250];
                    },
                    formatPreset(val) {
                        if (this.currency === 'KHR') {
                            return '៛' + val.toLocaleString();
                        } else if (this.currency === 'EUR') {
                            return '€' + val.toFixed(2);
                        } else {
                            return '$' + val.toFixed(2);
                        }
                    }
                 }"
                 x-init="
                    $watch('currency', val => {
                        activePreset = presets[0];
                        amount = activePreset;
                        custom_amount = '';
                    });
                    if (!custom_amount) {
                        activePreset = amount;
                    }
                 ">
                
                {{-- STEP 1: Choose Amount --}}
                <div x-show="step === 1" class="flex flex-col h-full justify-between">
                    {{-- Header --}}
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                        <span class="text-sm font-bold text-slate-800">How much would you like to donate today?</span>
                        <span class="bg-slate-100 text-slate-600 px-2 py-0.5 rounded text-[10px] font-bold" x-text="currency + ' $'"></span>
                    </div>

                    {{-- Body --}}
                    <div class="p-6 space-y-6">
                        <p class="text-xs text-slate-500">
                            All donations directly impact our organization and help us further our mission.
                        </p>

                        <div class="space-y-3.5">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-700">Donation Amount <span class="text-red-500">*</span></span>
                                <select x-model="currency" class="bg-slate-50 border border-slate-200 rounded px-2 py-0.5 text-[11px] font-bold text-slate-700 focus:outline-none">
                                    <option value="USD">USD ($)</option>
                                    <option value="EUR">EUR (€)</option>
                                    <option value="KHR">KHR (៛)</option>
                                </select>
                            </div>

                            {{-- Presets --}}
                            <div class="grid grid-cols-3 gap-3">
                                <button type="button"
                                        @click="amount = presets[0]; custom_amount = ''; activePreset = presets[0]"
                                        :class="activePreset === presets[0] ? 'text-white shadow-sm' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50'"
                                        :style="activePreset === presets[0] ? 'background-color: #0070ba; border-color: #0070ba;' : ''"
                                        class="py-3 border rounded-lg text-sm font-bold transition-all duration-200 focus:outline-none">
                                    <span x-text="formatPreset(presets[0])"></span>
                                </button>
                                <button type="button"
                                        @click="amount = presets[1]; custom_amount = ''; activePreset = presets[1]"
                                        :class="activePreset === presets[1] ? 'text-white shadow-sm' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50'"
                                        :style="activePreset === presets[1] ? 'background-color: #0070ba; border-color: #0070ba;' : ''"
                                        class="py-3 border rounded-lg text-sm font-bold transition-all duration-200 focus:outline-none">
                                    <span x-text="formatPreset(presets[1])"></span>
                                </button>
                                <button type="button"
                                        @click="amount = presets[2]; custom_amount = ''; activePreset = presets[2]"
                                        :class="activePreset === presets[2] ? 'text-white shadow-sm' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50'"
                                        :style="activePreset === presets[2] ? 'background-color: #0070ba; border-color: #0070ba;' : ''"
                                        class="py-3 border rounded-lg text-sm font-bold transition-all duration-200 focus:outline-none">
                                    <span x-text="formatPreset(presets[2])"></span>
                                </button>
                                <button type="button"
                                        @click="amount = presets[3]; custom_amount = ''; activePreset = presets[3]"
                                        :class="activePreset === presets[3] ? 'text-white shadow-sm' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50'"
                                        :style="activePreset === presets[3] ? 'background-color: #0070ba; border-color: #0070ba;' : ''"
                                        class="py-3 border rounded-lg text-sm font-bold transition-all duration-200 focus:outline-none">
                                    <span x-text="formatPreset(presets[3])"></span>
                                </button>
                                <button type="button"
                                        @click="amount = presets[4]; custom_amount = ''; activePreset = presets[4]"
                                        :class="activePreset === presets[4] ? 'text-white shadow-sm' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50'"
                                        :style="activePreset === presets[4] ? 'background-color: #0070ba; border-color: #0070ba;' : ''"
                                        class="py-3 border rounded-lg text-sm font-bold transition-all duration-200 focus:outline-none">
                                    <span x-text="formatPreset(presets[4])"></span>
                                </button>
                                <button type="button"
                                        @click="amount = presets[5]; custom_amount = ''; activePreset = presets[5]"
                                        :class="activePreset === presets[5] ? 'text-white shadow-sm' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50'"
                                        :style="activePreset === presets[5] ? 'background-color: #0070ba; border-color: #0070ba;' : ''"
                                        class="py-3 border rounded-lg text-sm font-bold transition-all duration-200 focus:outline-none">
                                    <span x-text="formatPreset(presets[5])"></span>
                                </button>
                            </div>

                            {{-- Custom Amount --}}
                            <input type="number" 
                                   placeholder="Enter custom amount"
                                   x-model="custom_amount"
                                   @input="amount = parseFloat(custom_amount) || 0; activePreset = null"
                                   class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2.5 text-center text-xs font-bold text-slate-800 focus:outline-none focus:ring-1 focus:ring-[#0070ba]">
                        </div>

                        {{-- Hidden parameters for frequency --}}
                        <div class="sr-only">
                            <input type="radio" name="frequency" value="one-time" x-model="frequency" checked>
                        </div>
                    </div>

                    {{-- Footer Button --}}
                    <div class="p-6 border-t border-slate-100 bg-slate-50/50">
                        <button type="button" 
                                @click="if(amount > 0) { step = 2 }"
                                :disabled="!(amount > 0)"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-lg px-5 py-3 text-sm font-bold text-white transition hover:brightness-105 disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none"
                                style="background-color: #0070ba">
                            <span>Donate now</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- STEP 2: Who's Giving Today? --}}
                <div x-show="step === 2" x-cloak class="flex flex-col h-full justify-between">
                    {{-- Header --}}
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                        <button type="button" @click="step = 1" class="text-slate-400 hover:text-slate-600 transition-colors focus:outline-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                        </button>
                        <span class="text-sm font-bold text-slate-800">Who's Giving Today?</span>
                        <div class="w-5"></div> {{-- Spacer --}}
                    </div>

                    {{-- Green horizontal step progress --}}
                    <div class="h-1 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-500" style="width: 50%"></div>
                    </div>

                    {{-- Body form --}}
                    <div class="p-6 space-y-4">
                        <p class="text-xs text-slate-500">
                            We'll never share this information with anyone.
                        </p>

                        <form action="{{ route('donate.international.send') }}" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="frequency" value="one-time">
                            <input type="hidden" name="currency" :value="currency">
                            <input type="hidden" name="amount" :value="amount">
                            <input type="hidden" name="name" :value="first_name + ' ' + last_name">

                            {{-- First name --}}
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">First name <span class="text-red-500">*</span></label>
                                <input type="text" name="first_name" x-model="first_name" required placeholder="Enter your first name"
                                       class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2 text-xs text-slate-800 focus:outline-none focus:ring-1 focus:ring-[#0070ba]">
                            </div>

                            {{-- Last name --}}
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Last name <span class="text-red-500">*</span></label>
                                <input type="text" name="last_name" x-model="last_name" required placeholder="Enter your Last name"
                                       class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2 text-xs text-slate-800 focus:outline-none focus:ring-1 focus:ring-[#0070ba]">
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                                <input type="email" name="email" x-model="email" required placeholder="Enter your email"
                                       class="w-full bg-white border border-slate-200 rounded-lg px-4 py-2 text-xs text-slate-800 focus:outline-none focus:ring-1 focus:ring-[#0070ba]">
                            </div>

                            {{-- Optional parameters --}}
                            <div class="sr-only">
                                <input type="text" name="phone" x-model="phone">
                                <textarea name="message" x-model="message"></textarea>
                            </div>

                            {{-- Footer Button --}}
                            <div class="pt-4 border-t border-slate-100">
                                <button type="submit"
                                        class="inline-flex w-full items-center justify-center gap-2 rounded-lg px-5 py-3 text-sm font-bold text-white transition hover:brightness-105 focus:outline-none"
                                        style="background-color: #0070ba">
                                    <span>Continue</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Footer badge --}}
                    <div class="p-4 border-t border-slate-100 bg-slate-50/50 flex items-center justify-center gap-1.5 text-[10px] text-slate-400 font-bold">
                        <svg class="w-3.5 h-3.5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                        <span>100% Secure Donation</span>
                    </div>
                </div>

            </div>

        </div>

        {{-- Bank Wire instructions and national entities --}}
        <div class="grid md:grid-cols-2 gap-6 mt-12">
            
            {{-- SWIFT Info Card --}}
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-[#2d6fa3]/10 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Direct SWIFT Transfer</h3>
                <p class="text-xs text-slate-500 leading-relaxed mb-4">You can wire your donation directly to Krousar Thmey's main bank account in Cambodia using these credentials:</p>
                
                <div class="space-y-2.5 font-mono text-xs bg-slate-50 p-4 rounded-xl">
                    <div>
                        <span class="text-slate-400 block uppercase font-sans text-[9px] font-bold">Bank Name</span>
                        <span class="text-slate-800 font-bold">ABA Bank (Cambodia)</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block uppercase font-sans text-[9px] font-bold">Account Name</span>
                        <span class="text-slate-800 font-bold">KROUSAR THMEY</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block uppercase font-sans text-[9px] font-bold">Account Number (USD)</span>
                        <span class="text-slate-800 font-bold">000 765 432</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block uppercase font-sans text-[9px] font-bold">SWIFT / BIC</span>
                        <span class="text-slate-800 font-bold">ABAKKHPPXXX</span>
                    </div>
                </div>
            </div>

            {{-- Regional Offices Card --}}
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-[#8da83a]/10 flex items-center justify-center mb-4">
                    <svg class="w-5 h-5 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Regional Offices</h3>
                <p class="text-xs text-slate-500 leading-relaxed mb-4">If you are donating from Europe or Singapore, please contact our regional entities to benefit from local tax deductions:</p>
                
                <ul class="space-y-3 text-xs">
                    <li class="flex items-center justify-between border-b border-slate-100 pb-2">
                        <span class="font-bold text-slate-700">Krousar Thmey France</span>
                        <a href="https://www.krousar-thmey.org/fr" target="_blank" class="text-[#2d6fa3] hover:underline font-bold">Visit Site ↗</a>
                    </li>
                    <li class="flex items-center justify-between border-b border-slate-100 pb-2">
                        <span class="font-bold text-slate-700">Krousar Thmey Switzerland</span>
                        <a href="https://www.krousar-thmey.ch" target="_blank" class="text-[#2d6fa3] hover:underline font-bold">Visit Site ↗</a>
                    </li>
                    <li class="flex flex-col gap-0.5">
                        <span class="font-bold text-slate-700">Krousar Thmey Singapore</span>
                        <span class="text-slate-400 italic text-[11px]">singapore@krousar-thmey.org</span>
                    </li>
                </ul>
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
