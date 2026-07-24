@extends('layouts.app')

@section('title', 'International Donation — Krousar Thmey')
@section('description', 'Support children in Cambodia. Donate internationally via bank wire transfer.')

@section('content')

{{-- Header --}}
<div class="relative overflow-hidden bg-[#1f3f66] pt-20 pb-24">
    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1400&q=80"
         alt="Children smiling together"
         class="absolute inset-0 h-full w-full object-cover opacity-70">
    <div class="absolute inset-0 bg-slate-950/30 backdrop-blur-[2px]"></div>
    <div class="absolute inset-0 opacity-30">
        <div class="absolute top-10 left-10 w-72 h-72 rounded-full bg-[#8da83a]/40 blur-3xl"></div>
        <div class="absolute bottom-12 right-8 w-56 h-56 rounded-full bg-white/10 blur-3xl"></div>
    </div>
    <div class="relative max-w-6xl mx-auto px-6 text-center">
        <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs uppercase tracking-[0.26em] text-slate-200 mb-6">
            <svg class="w-4 h-4 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
            </svg>
            International donations
        </span>
        <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight sm:text-6xl">Support Khmer children with an international donation.</h1>
        <p class="mt-6 text-base sm:text-lg text-slate-200 max-w-3xl mx-auto leading-8">
            Every gift helps a child access education, shelter, and medical care in Cambodia.
            Set up a secure bank wire transfer to help us build a brighter future.
        </p>
    </div>
</div>

{{-- Main section --}}
<section class="pt-16 pb-20 bg-[#f8f9fc]">
    <div class="max-w-[1040px] mx-auto px-4 sm:px-6 2xl:px-0">

        {{-- Unified Tabs Switcher --}}
        <div class="bg-white rounded-2xl border border-slate-200/80 p-1.5 shadow-2xs mb-10 flex flex-wrap lg:flex-nowrap justify-between gap-1 max-w-[1040px] mx-auto">
            
            {{-- Tab: Cambodia --}}
            <a href="{{ route('donate') }}"
               class="flex-1 min-w-[200px] flex items-center justify-center gap-2.5 px-4 py-3 text-xs font-black rounded-xl transition-all duration-200 select-none text-slate-650 hover:bg-slate-50 hover:text-slate-800">
                <span class="text-base leading-none">🇰🇭</span>
                <span class="uppercase tracking-wider">Payment in Cambodia</span>
            </a>

            {{-- Tab: France --}}
            <a href="{{ route('donate.international') }}?residency=france"
               @click.prevent="residency = 'france'; window.history.replaceState({}, '', '?residency=france')"
               :class="residency === 'france' ? 'bg-[#2d6fa3] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800'"
               class="flex-1 min-w-[200px] flex items-center justify-center gap-2.5 px-4 py-3 text-xs font-black rounded-xl transition-all duration-200 select-none">
                <span class="text-base leading-none">🇫🇷</span>
                <span class="uppercase tracking-wider">Fiscal residency in France</span>
            </a>

            {{-- Tab: Switzerland --}}
            <a href="{{ route('donate.international') }}?residency=switzerland"
               @click.prevent="residency = 'switzerland'; window.history.replaceState({}, '', '?residency=switzerland')"
               :class="residency === 'switzerland' ? 'bg-[#2d6fa3] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800'"
               class="flex-1 min-w-[200px] flex items-center justify-center gap-2.5 px-4 py-3 text-xs font-black rounded-xl transition-all duration-200 select-none">
                <span class="text-base leading-none">🇨🇭</span>
                <span class="uppercase tracking-wider">Fiscal residency in Switzerland</span>
            </a>

            {{-- Tab: Elsewhere --}}
            <a href="{{ route('donate.international') }}?residency=elsewhere"
               @click.prevent="residency = 'elsewhere'; window.history.replaceState({}, '', '?residency=elsewhere')"
               :class="residency === 'elsewhere' ? 'bg-[#2d6fa3] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800'"
               class="flex-1 min-w-[200px] flex items-center justify-center gap-2.5 px-4 py-3 text-xs font-black rounded-xl transition-all duration-200 select-none">
                <span class="text-base leading-none">🌍</span>
                <span class="uppercase tracking-wider">Fiscal residency elsewhere</span>
            </a>
            
            {{-- Tab: Campaigns --}}
            @if(Route::has('campaigns.index'))
            <a href="{{ route('campaigns.index') }}"
               class="flex-none flex items-center justify-center gap-2 px-4 py-3 text-xs font-black rounded-xl transition-all duration-200 text-slate-500 hover:bg-slate-50 hover:text-slate-800 select-none">
                <span class="text-base leading-none">📣</span>
                <span class="uppercase tracking-wider">Campaigns</span>
            </a>
            @endif
        </div>

        {{-- Twin Columns Layout --}}
        <div class="grid md:grid-cols-2 gap-8 items-start">
            
            {{-- LEFT CARD: Impact Text --}}
            <div class="bg-white rounded-2xl border border-slate-200/80 p-8 shadow-sm flex flex-col justify-between min-h-[460px]">
                <div class="space-y-6">
                    <div class="text-center md:text-left space-y-3">
                        <span class="text-xs font-bold text-[#2d6fa3] tracking-widest uppercase block">Make a Difference</span>
                        <h2 class="text-3xl font-black text-slate-800 leading-tight">Support Children in Cambodia</h2>
                        <p class="text-sm text-slate-500 leading-relaxed">
                            At Krousar Thmey, we believe every child deserves a family, a quality education, and the opportunity to succeed. Your donations directly support our projects across Cambodia.
                        </p>
                    </div>

                    {{-- Highlighted bullet points --}}
                    <div class="space-y-4 pt-2">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-blue-50 text-[#2d6fa3] flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">Special Education</h4>
                                <p class="text-xs text-slate-400 leading-relaxed">Funding specialized schools and materials for deaf or blind children to learn and communicate.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">Child Welfare</h4>
                                <p class="text-xs text-slate-400 leading-relaxed">Providing protection, safe housing, and family integration for street-involved and vulnerable kids.</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-sm font-bold text-slate-800">Cultural & Artistic Development</h4>
                                <p class="text-xs text-slate-400 leading-relaxed">Supporting visual arts, traditional Khmer music, dance, and creative expression classes.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Guarantee Note --}}
                <div class="border-t border-slate-100 pt-4 mt-6 flex items-center gap-2.5 text-[11px] text-slate-450 font-bold">
                    <svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <span>100% of your funds go directly to supporting the children in Cambodia.</span>
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
                    sending: false,
                    error_message: '',
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
                    },
                    get impactMessage() {
                        if (this.amount <= 0) return '';
                        let amtUsd = this.currency === 'KHR' ? this.amount / 4000 : (this.currency === 'EUR' ? this.amount * 1.08 : this.amount);
                        if (amtUsd <= 5) return 'Covers clean water for a child for one week.';
                        if (amtUsd <= 15) return 'Provides books and art supplies for a student.';
                        if (amtUsd <= 30) return 'Covers educational games & toys for children.';
                        if (amtUsd <= 60) return 'Covers food and primary healthcare for a month.';
                        if (amtUsd <= 150) return 'Supports vocational training for a young adult.';
                        return 'Directly funds special education projects for deaf/blind students.';
                    },
                    submitDonation() {
                        if (!this.first_name || !this.last_name || !this.email) {
                            this.error_message = 'Please fill in all required fields.';
                            return;
                        }
                        this.sending = true;
                        this.error_message = '';
                        
                        fetch('{{ url('/donation/continue') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                first_name: this.first_name,
                                last_name: this.last_name,
                                email: this.email,
                                amount: this.amount,
                                currency: this.currency,
                                frequency: this.frequency,
                                message: this.message
                            })
                        })
                        .then(response => {
                            if (!response.ok) {
                                return response.json().then(err => { throw err; });
                            }
                            return response.json();
                        })
                        .then(data => {
                            this.step = 3;
                        })
                        .catch(err => {
                            this.error_message = err.message || 'Failed to send donation declaration. Please try again.';
                        })
                        .finally(() => {
                            this.sending = false;
                        });
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

                        <form @submit.prevent="submitDonation()" class="space-y-4">
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

                            {{-- Error message if any --}}
                            <div x-show="error_message" x-cloak class="text-xs text-red-500 font-bold bg-red-50 p-2.5 rounded-lg border border-red-100" x-text="error_message"></div>

                            {{-- Footer Button --}}
                            <div class="pt-4 border-t border-slate-100">
                                <button type="submit" :disabled="sending"
                                        class="inline-flex w-full items-center justify-center gap-2 rounded-lg px-5 py-3 text-sm font-bold text-white transition hover:brightness-105 disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none"
                                        style="background-color: #0070ba">
                                    <span x-show="!sending">Continue</span>
                                    <span x-show="sending">processing donation ....</span>
                                    <svg x-show="!sending" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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

                {{-- STEP 3: Thank You & Success --}}
                <div x-show="step === 3" x-cloak class="flex flex-col h-full justify-between">
                    {{-- Header --}}
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                        <div class="w-5"></div>
                        <span class="text-sm font-bold text-slate-800">Declaration Complete</span>
                        <div class="w-5"></div>
                    </div>

                    {{-- Green horizontal step progress --}}
                    <div class="h-1 bg-slate-100 rounded-full overflow-hidden">
                        <div class="h-full bg-emerald-500" style="width: 100%"></div>
                    </div>

                    {{-- Body form --}}
                    <div class="p-6 space-y-5 text-center flex-1 flex flex-col justify-center">
                        <div class="w-14 h-14 rounded-full bg-emerald-100 flex items-center justify-center mx-auto mb-2 text-emerald-600">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        
                        <div class="space-y-2">
                            <h3 class="text-xl font-extrabold text-slate-900">Thank you, <span x-text="first_name"></span>!</h3>
                            <p class="text-sm md:text-base text-slate-600 font-semibold leading-relaxed">
                                We have sent a confirmation email to <span class="font-bold text-slate-850" x-text="email"></span>.
                            </p>
                        </div>

                        <div class="bg-slate-50 p-4 rounded-xl text-left border border-slate-150 space-y-2.5">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Wire transfer details</span>
                            <div class="grid grid-cols-2 gap-y-1.5 text-[11px] font-mono">
                                <span class="text-slate-400">Amount:</span>
                                <span class="text-slate-800 font-bold text-right" x-text="formatPreset(amount)"></span>
                            </div>
                        </div>

                        <p class="text-[10px] text-slate-450 leading-relaxed italic">
                            Your donation details have been shared with our regional entities. Thank you for your support.
                        </p>
                    </div>

                    {{-- Footer badge --}}
                    <div class="p-4 border-t border-slate-100 bg-slate-50/50 flex items-center justify-center gap-1.5 text-[10px] text-slate-400 font-bold">
                        <button type="button" @click="step = 1; first_name=''; last_name=''; email=''; custom_amount=''; amount=5; activePreset=5;" class="text-[#0070ba] hover:underline font-bold">
                            Make another donation
                        </button>
                    </div>
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
