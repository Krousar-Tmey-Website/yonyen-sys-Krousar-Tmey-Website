@extends('layouts.app')

@section('title', 'Donate — Krousar Thmey')
@section('description', 'Support children in Cambodia. Donate locally via ABA/ACLEDA QR or internationally via wire transfer.')

@section('content')

<div x-data="{ residency: '{{ request('residency', 'cambodia') }}' }" class="bg-[#f8f9fc]">

    {{-- Hero Banner --}}
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
                <svg class="w-4 h-4 text-[#8da83a]" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="residency !== 'cambodia'" x-cloak>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                </svg>
                <svg class="w-4 h-4 text-[#8da83a]" viewBox="0 0 20 20" fill="currentColor" x-show="residency === 'cambodia'">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1.857-10.143a.75.75 0 10-1.714 0V10H7.857a.75.75 0 000 1.5h2.286v2.286a.75.75 0 001.5 0V11.5h2.286a.75.75 0 000-1.5H11.857V7.857z" clip-rule="evenodd" />
                </svg>
                <span x-text="residency === 'cambodia' ? 'Local QR donations' : 'International donations'">Local QR donations</span>
            </span>
            <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight sm:text-6xl"
                x-text="residency === 'cambodia' ? 'Support Khmer children with a secure local donation.' : 'Support Khmer children with an international donation.'">
                Support Khmer children with a secure local donation.
            </h1>
            <p class="mt-6 text-base sm:text-lg text-slate-200 max-w-3xl mx-auto leading-8"
               x-text="residency === 'cambodia' ? 'Every gift helps a child access education, shelter, and medical care in Cambodia. Scan directly from ABA or ACLEDA and avoid extra transfer fees.' : 'Every gift helps a child access education, shelter, and medical care in Cambodia. Set up a secure bank wire transfer to help us build a brighter future.'">
                Every gift helps a child access education, shelter, and medical care in Cambodia.
                Scan directly from ABA or ACLEDA and avoid extra transfer fees.
            </p>
        </div>
    </div>

    {{-- Main section --}}
    <section class="pt-16 pb-20 bg-[#f8f9fc]">
        <div class="max-w-[1040px] mx-auto px-4 sm:px-6 2xl:px-0">
            
            {{-- Unified Tabs Switcher --}}
            <div class="bg-white rounded-xl border border-slate-200/80 p-1 shadow-2xs mb-12 flex flex-wrap lg:flex-nowrap justify-between gap-1 max-w-[1040px] mx-auto">
                
                {{-- Tab: Cambodia --}}
                <button type="button"
                   @click="residency = 'cambodia'; window.history.replaceState({}, '', '?residency=cambodia')"
                   :class="residency === 'cambodia' ? 'bg-[#2d6fa3] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800'"
                   class="flex-1 flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold rounded-lg transition-all duration-200 select-none focus:outline-none cursor-pointer">
                    <span>Payment in Cambodia</span>
                    <img src="{{ asset('images/Flag_of_Cambodia.svg.webp') }}" class="h-3.5 w-auto rounded-xs object-contain shrink-0 border border-slate-200/60 shadow-3xs" alt="KH">
                </button>

                {{-- Tab: France --}}
                <button type="button"
                   @click="residency = 'france'; window.history.replaceState({}, '', '?residency=france')"
                   :class="residency === 'france' ? 'bg-[#2d6fa3] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800'"
                   class="flex-1 flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold rounded-lg transition-all duration-200 select-none focus:outline-none cursor-pointer">
                    <span>Fiscal residency in France</span>
                    <img src="{{ asset('images/Flag_of_France.svg.webp') }}" class="h-3.5 w-auto rounded-xs object-contain shrink-0 border border-slate-200/60 shadow-3xs" alt="FR">
                </button>

                {{-- Tab: Switzerland --}}
                <button type="button"
                   @click="residency = 'switzerland'; window.history.replaceState({}, '', '?residency=switzerland')"
                   :class="residency === 'switzerland' ? 'bg-[#2d6fa3] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800'"
                   class="flex-1 flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold rounded-lg transition-all duration-200 select-none focus:outline-none cursor-pointer">
                    <span>Fiscal residency in Switzerland</span>
                    <img src="{{ asset('images/Flag_of_Switzerland_(Pantone).svg.webp') }}" class="h-3.5 w-auto rounded-xs object-contain shrink-0 border border-slate-200/60 shadow-3xs" alt="CH">
                </button>

                {{-- Tab: Elsewhere --}}
                <button type="button"
                   @click="residency = 'elsewhere'; window.history.replaceState({}, '', '?residency=elsewhere')"
                   :class="residency === 'elsewhere' ? 'bg-[#2d6fa3] text-white shadow-xs' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-800'"
                   class="flex-1 flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold rounded-lg transition-all duration-200 select-none focus:outline-none cursor-pointer">
                    <span>Fiscal residency elsewhere</span>
                    <svg class="w-4 h-4 shrink-0" :class="residency === 'elsewhere' ? 'text-white' : 'text-slate-500'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                    </svg>
                </button>
                
                {{-- Tab: Campaigns --}}
                @if(Route::has('campaigns.index'))
                <a href="{{ route('campaigns.index') }}"
                   class="flex-none flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold rounded-lg transition-all duration-200 text-slate-500 hover:bg-slate-50 hover:text-slate-800 select-none">
                    <span>Campaigns</span>
                    <span class="text-sm leading-none">📣</span>
                </a>
                @endif
            </div>

            {{-- ──────────────────────────────────────────────
                 CAMBODIA VIEW (QR LOCAL)
                 ────────────────────────────────────────────── --}}
            <div x-show="residency === 'cambodia'" x-cloak>
                @if($paymentMethods->isNotEmpty())
                @php
                    $logoPath = $settings['site_logo'] ?? 'images/logo.png';
                    $logoUrl = str_starts_with($logoPath, 'http') ? $logoPath : (str_starts_with($logoPath, 'logos/') ? asset('storage/' . $logoPath) : asset($logoPath));
                @endphp
                <div class="overflow-hidden rounded-[28px] bg-white p-4 shadow-[0_20px_52px_rgba(15,23,42,0.11)] sm:p-6">
                    <div class="grid items-stretch gap-6 lg:grid-cols-[1.05fr_0.95fr]">

                        {{-- Left column --}}
                        <div class="flex flex-col justify-between gap-6 lg:min-h-[560px]">
                            <img src="https://pbs.twimg.com/media/DSCk7u6XcAA0hrt.jpg"
                                  alt="Children supported by Krousar Thmey"
                                  class="h-[230px] w-full rounded-tl-[24px] object-cover sm:h-[300px]">

                            <div class="mx-auto mb-0 w-full max-w-[385px] rounded-[18px] bg-white p-5 shadow-[0_16px_38px_rgba(15,23,42,0.08)]">
                                <div class="flex items-center gap-3 mb-3.5">
                                    <img src="{{ $logoUrl }}" alt="Krousar Thmey" class="w-10 h-10 rounded-full object-contain bg-gray-50 border border-gray-100">
                                    <div class="min-w-0">
                                        <p class="text-sm font-bold text-slate-900 leading-tight truncate">Krousar Thmey</p>
                                        <p class="text-xs text-slate-500">Cambodia · Since 1991</p>
                                    </div>
                                </div>
                                <h3 class="text-[18px] font-extrabold text-slate-950 leading-tight mb-2.5">Your gift gives a child a home, a school, a future.</h3>
                                <p class="text-[13px] leading-relaxed text-slate-500">Every donation goes directly to supporting disadvantaged children across Cambodia — 100% of funds reach the children in our care.</p>
                            </div>
                        </div>

                        {{-- Right column --}}
                        <div class="flex justify-center">
                            <div class="flex w-full max-w-[420px] flex-col gap-4 rounded-[17px] bg-white p-5 shadow-[0_18px_42px_rgba(15,23,42,0.08)]" x-data="{ active: 0 }">
                                {{-- Bank Tabs --}}
                                <div class="grid grid-cols-2 gap-2">
                                    @foreach($paymentMethods as $i => $method)
                                    <button type="button"
                                            @click="active = {{ $i }}"
                                            :class="active === {{ $i }} ? 'bg-[#1c3a5e] text-white border-[#1c3a5e] shadow-[0_10px_18px_rgba(28,58,94,0.22)]' : 'bg-white text-gray-500 border-gray-300 hover:border-gray-400 hover:text-gray-700'"
                                            class="min-h-[42px] px-4 py-2 rounded-[9px] text-[14px] font-bold border transition-all duration-200 cursor-pointer focus:outline-none">
                                        {{ $method->name }}
                                    </button>
                                    @endforeach
                                </div>

                                @foreach($paymentMethods as $i => $method)
                                <div x-show="active === {{ $i }}" x-cloak class="flex flex-col gap-4 flex-1">
                                    {{-- QR Section --}}
                                    <div class="rounded-[13px] border border-gray-200 bg-[#fbfcfd] px-4 py-5 text-center">
                                        <div class="w-[140px] h-[140px] mx-auto bg-white rounded-[9px] border border-gray-200 flex items-center justify-center overflow-hidden shrink-0 shadow-sm">
                                            @if($method->qr_code_url)
                                            <a href="{{ $method->qr_code_url . '?v=' . ($method->updated_at?->timestamp ?? time()) }}"
                                               target="_blank" rel="noopener"
                                               aria-label="Open {{ $method->name }} QR code">
                                                <img src="{{ $method->qr_code_url . '?v=' . ($method->updated_at?->timestamp ?? time()) }}"
                                                     alt="{{ $method->name }} QR"
                                                     width="134" height="134"
                                                     class="object-contain"
                                                     style="max-width:134px;max-height:134px;width:134px;height:134px;"
                                                     loading="lazy">
                                            </a>
                                            @else
                                            <div class="flex flex-col items-center justify-center gap-2">
                                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                                </svg>
                                                <p class="text-xs text-gray-400">No QR code uploaded</p>
                                            </div>
                                            @endif
                                        </div>
                                        <p class="text-center text-[14px] text-gray-600 mt-3 font-medium">Scan with {{ $method->name }} app</p>
                                    </div>

                                    {{-- Account Details --}}
                                    <div class="overflow-hidden rounded-[12px] border border-gray-100 bg-white divide-y divide-gray-100 shadow-sm">
                                        <div class="flex items-start justify-between px-4 py-3">
                                            <div>
                                                <p class="text-[10px] uppercase tracking-[0.14em] text-gray-400 font-bold">Account holder</p>
                                                <p class="text-[14px] font-bold text-slate-950 mt-1">{{ $method->account_name ?: '—' }}</p>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-[10px] uppercase tracking-[0.14em] text-gray-400 font-bold">Currency</p>
                                                <p class="text-[14px] font-bold text-slate-950 mt-1">
                                                    @if($method->currency === 'Both')
                                                        <span class="inline-flex items-center gap-1">
                                                            <span class="rounded bg-gray-100 px-1.5 py-0.5 text-[11px]">USD</span>
                                                            <span class="text-gray-300">/</span>
                                                            <span class="rounded bg-gray-100 px-1.5 py-0.5 text-[11px]">KHR</span>
                                                        </span>
                                                    @else
                                                        {{ $method->currency ?: '—' }}
                                                    @endif
                                                </p>
                                            </div>
                                        </div>

                                        <div class="px-4 py-3">
                                            <p class="text-[10px] uppercase tracking-[0.14em] text-gray-400 font-bold mb-1.5">Account number</p>
                                            <div class="flex items-center justify-between gap-3">
                                                <span class="text-[14px] font-mono font-bold text-slate-950 tracking-wide break-all">{{ $method->account_no ?: '—' }}</span>
                                                @php $accountNo = $method->account_no; @endphp
                                                @if($accountNo)
                                                <button x-data="{ no: @js($accountNo) }"
                                                        @click="navigator.clipboard.writeText(no); $el.querySelector('svg').classList.add('text-[#1c3a5e]'); setTimeout(() => $el.querySelector('svg').classList.remove('text-[#1c3a5e]'), 1500);"
                                                        class="shrink-0 w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-50 transition-colors cursor-pointer focus:outline-none"
                                                        title="Copy account number"
                                                        aria-label="Copy account number">
                                                    <svg class="w-4 h-4 text-gray-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <rect x="9" y="9" width="13" height="13" rx="2" stroke-width="1.5"/>
                                                        <path d="M5 15H4a2 2 0 01-2-2V4a2 2 0 012-2h9a2 2 0 012 2v1" stroke-width="1.5"/>
                                                    </svg>
                                                </button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Primary CTA --}}
                                    <a href="{{ $method->qr_code_url ? $method->qr_code_url . '?v=' . ($method->updated_at?->timestamp ?? time()) : '#' }}"
                                       target="{{ $method->qr_code_url ? '_blank' : '_self' }}" rel="noopener"
                                       class="mt-auto w-full inline-flex items-center justify-center gap-3 rounded-[10px] bg-[#1c3a5e] px-5 py-[13px] text-[14px] font-extrabold text-white shadow-[0_2px_0_rgba(0,0,0,0.8)] transition-colors hover:bg-[#152d4a] active:bg-[#0f2238]">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                        </svg>
                                        Scan QR to donate via {{ $method->name }}
                                    </a>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
                @else
                <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center shadow-sm max-w-lg mx-auto">
                    <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                        </svg>
                    </div>
                    <p class="text-gray-500 text-sm font-medium">No local payment methods are available at this time.</p>
                    <p class="text-gray-400 text-xs mt-1">Please check back later.</p>
                </div>
                @endif
            </div>

            {{-- ──────────────────────────────────────────────
                 INTERNATIONAL VIEW (FRANCE, SWITZERLAND, ELSEWHERE)
                 ────────────────────────────────────────────── --}}
            <div x-show="residency !== 'cambodia'" x-cloak>
                
                {{-- France view: full width rows (centered layout) --}}
                <div x-show="residency === 'france'" class="space-y-8 max-w-4xl mx-auto">
                    
                    {{-- Ways to Donate (Full Width Card) --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-10 shadow-sm space-y-10">
                        
                        {{-- HelloAsso Section --}}
                        <div class="space-y-6">
                            <p class="text-sm md:text-base text-slate-655 leading-relaxed font-semibold">
                                You can make a one-time or regular donation on our dedicated website, you will be redirected to our HelloAsso page:
                            </p>
                            <div class="flex flex-col items-center justify-center space-y-5">
                                <img src="{{ asset('images/helloasso.jpg') }}" alt="HelloAsso logo" class="h-16 w-auto object-contain">
                                <a href="https://www.helloasso.com/associations/krousar-thmey-nouvelle-famille" target="_blank" rel="noopener"
                                   class="inline-flex items-center justify-center px-6 py-2.5 border border-[#1b4d75] hover:bg-[#1b4d75] text-[#1b4d75] hover:text-white text-xs font-black rounded-lg shadow-2xs transition-all cursor-pointer select-none">
                                    HelloAsso (One-time or regular donation)
                                </a>
                            </div>
                        </div>

                        <div class="border-t border-slate-100"></div>

                        {{-- Check Section --}}
                        <div class="space-y-6">
                            <p class="text-sm md:text-base text-slate-655 leading-relaxed font-semibold">
                                You can also send a check payable to <strong class="text-slate-800">Krousar Thmey France</strong> at the following address:
                            </p>
                            <div class="text-center font-bold text-slate-700 leading-relaxed text-sm md:text-base space-y-1">
                                <p class="text-[#2d6fa3] font-black text-lg">Krousar Thmey France</p>
                                <p>62 rue Greneta</p>
                                <p>75002 Paris</p>
                            </div>
                        </div>

                    </div>

                    {{-- Tax Deductions & Legacy (Under it, Accordions) --}}
                    <div x-data="{ activeSection: 'tax' }" class="space-y-6">
                        
                        {{-- Tax deductions card --}}
                        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                            <button type="button" @click="activeSection = (activeSection === 'tax' ? '' : 'tax')"
                                    class="w-full flex items-center justify-between p-6 focus:outline-none text-left cursor-pointer select-none">
                                <div class="space-y-1">
                                    <span class="text-[10px] font-bold text-[#2d6fa3] tracking-widest uppercase block">Tax Exemption</span>
                                    <h2 class="text-xl font-black text-slate-800 tracking-wide uppercase">Tax Deductions</h2>
                                </div>
                                <svg class="w-5 h-5 text-slate-500 transition-transform duration-300" :class="activeSection === 'tax' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            
                            <div x-show="activeSection === 'tax'" x-collapse>
                                <div class="p-6 pt-0 border-t border-slate-100 space-y-4">
                                    <p class="text-xs text-slate-500 leading-relaxed font-semibold">
                                        The Krousar Thmey entities in France and Switzerland are recognized as being of public interest, so you can get tax deductions based on your donation.
                                    </p>
                                    
                                    {{-- Association 1901 --}}
                                    <div class="border-l-4 border-emerald-500 pl-4 py-1 space-y-1">
                                        <h4 class="text-xs font-black text-slate-755 uppercase tracking-wide text-[#2d6fa3]">Under an association of 1901 general interest</h4>
                                        <p class="text-xs text-slate-505 leading-relaxed">
                                            Deduction of <strong class="text-slate-800">66% of income tax (IR)</strong> and up to 20% of taxable income. If the limit is exceeded, the excess entitles you to a tax reduction for the next five years.
                                        </p>
                                    </div>

                                    {{-- Loi Coluche --}}
                                    <div class="border-l-4 border-blue-500 pl-4 py-1 space-y-1">
                                        <h4 class="text-xs font-black text-slate-755 uppercase tracking-wide text-[#2d6fa3]">Under the loi Coluche</h4>
                                        <p class="text-xs text-slate-550 leading-relaxed">
                                            Deduction of <strong class="text-slate-800">75% of income tax</strong> capped at <strong class="text-slate-800">€530</strong>. Beyond that, donations are deductible up to 66% of income tax and up to 20% of taxable income. If the limit is exceeded, the surplus entitles the holder to a tax reduction for the next five years.
                                        </p>
                                    </div>

                                    {{-- Tax Receipt Note --}}
                                    <div class="bg-slate-50 rounded-xl p-3 border border-slate-200 text-xs text-slate-505 flex gap-2">
                                        <svg class="w-4.5 h-4.5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span>A tax receipt will be sent to you in March of the year following your donation.</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Legacy card --}}
                        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
                            <button type="button" @click="activeSection = (activeSection === 'legacy' ? '' : 'legacy')"
                                    class="w-full flex items-center justify-between p-6 focus:outline-none text-left cursor-pointer select-none">
                                <div class="space-y-1">
                                    <span class="text-[10px] font-bold text-[#2d6fa3] tracking-widest uppercase block">Estate Planning</span>
                                    <h2 class="text-xl font-black text-slate-800 tracking-wide uppercase">Legacy</h2>
                                </div>
                                <svg class="w-5 h-5 text-slate-500 transition-transform duration-300" :class="activeSection === 'legacy' ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                            </button>
                            
                            <div x-show="activeSection === 'legacy'" x-collapse>
                                <div class="p-6 pt-0 border-t border-slate-100 space-y-4" x-data="{ legacyType: 'bequest' }">
                                    <p class="text-xs text-slate-500 leading-relaxed font-semibold">
                                        As a recognized association of public utility, Krousar Thmey is entitled to receive bequests and donations.
                                    </p>

                                    {{-- Accordion Tabs --}}
                                    <div class="flex gap-2 border-b border-slate-100 pb-3">
                                        <button type="button" @click="legacyType = 'bequest'"
                                                :class="legacyType === 'bequest' ? 'bg-[#8da83a] text-white shadow-xs' : 'bg-slate-100 text-slate-655 hover:bg-slate-200/60'"
                                                class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all focus:outline-none cursor-pointer">
                                            Bequest (Wills)
                                        </button>
                                        <button type="button" @click="legacyType = 'donation'"
                                                :class="legacyType === 'donation' ? 'bg-[#8da83a] text-white shadow-xs' : 'bg-slate-100 text-slate-655 hover:bg-slate-200/60'"
                                                class="px-3 py-1.5 rounded-lg text-xs font-bold transition-all focus:outline-none cursor-pointer">
                                            Donation (Lifetime)
                                        </button>
                                    </div>

                                    {{-- Bequest block --}}
                                    <div x-show="legacyType === 'bequest'" class="space-y-4">
                                        <div class="bg-slate-50 rounded-xl p-4.5 border border-slate-200/60 space-y-2">
                                            <h4 class="text-xs font-extrabold text-slate-805 uppercase tracking-wider">What is a bequest?</h4>
                                            <p class="text-xs text-slate-500 leading-relaxed">
                                                A bequest is a testamentary disposition whereby a person transfers all or part of his or her property to the designated person. You can bequeath your property to an association recognized of public interest such as Krousar Thmey; Whatever the amount, the gift is exempt from all inheritance taxes.
                                            </p>
                                            <div class="text-[11px] text-slate-400 font-semibold border-t border-slate-150 pt-2 mt-1">
                                                There are several types of legacies: The universal legacy (all property), the legacy of a part of patrimony, or the particular legacy (bequest of one or more properties identified).
                                            </div>
                                        </div>

                                        <div class="bg-slate-50 rounded-xl p-4.5 border border-slate-200/60 space-y-2">
                                            <h4 class="text-xs font-extrabold text-slate-805 uppercase tracking-wider">How to make a legacy to Krousar Thmey?</h4>
                                            <p class="text-xs text-slate-500 leading-relaxed">
                                                You have to write a will. The most common forms are:
                                            </p>
                                            <ul class="list-disc pl-5 text-xs text-slate-500 space-y-1.5 leading-relaxed">
                                                <li><strong>The holograph will:</strong> document written, dated and signed by the hand of the testator, it is easy and inexpensive. However, it can sometimes be challenged when it is not drafted with the help of a specialized lawyer.</li>
                                                <li><strong>The authentic testament:</strong> drawn up by a notary in the presence of two witnesses or a second notary, the authentic will must be signed by the testator. The notary writes it himself under the dictation of his client.</li>
                                            </ul>
                                        </div>
                                    </div>

                                    {{-- Donation block --}}
                                    <div x-show="legacyType === 'donation'" x-cloak class="space-y-4">
                                        <div class="bg-slate-50 rounded-xl p-4.5 border border-slate-200/60 space-y-2">
                                            <h4 class="text-xs font-extrabold text-slate-805 uppercase tracking-wider">What is a donation?</h4>
                                            <p class="text-xs text-slate-505 leading-relaxed">
                                                A donation is a contract by which you, as a donor, transfer ownership of a property to a beneficiary. You can give to a recognized public interest association, whatever the amount, this donation is exempt from all rights of succession.
                                            </p>
                                            <div class="text-[11px] text-slate-400 font-semibold border-t border-slate-150 pt-2 mt-1">
                                                <strong>Capped Share:</strong> The share you can transmit is called the amount available and corresponds to 1/2 of your assets if you have only one child, 1/3 if you have two children, and 1/4 if you have three or more children. It can be all or part of the estate if you have no other heirs.
                                            </div>
                                        </div>

                                        <div class="bg-slate-50 rounded-xl p-4.5 border border-slate-200/60 space-y-2">
                                            <h4 class="text-xs font-extrabold text-slate-850 uppercase tracking-wider">How to make a donation to Krousar Thmey?</h4>
                                            <p class="text-xs text-slate-500 leading-relaxed">
                                                Contrary to the will, which takes effect only at the death of the testator, this transmission takes place during the lifetime of its author. In principle, recourse to the notary is compulsory at the time of a donation. Nevertheless, the donor can hand over goods or money directly (manual donation).
                                            </p>
                                            <div class="text-[11px] text-slate-400 font-semibold border-t border-slate-150 pt-2 mt-1">
                                                Three conditions of any contract must be met for a donation to be valid: the donor must have the capacity to give, the donee must have the capacity to receive, and donor and recipient must agree to the donation.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Switzerland view: full width rows (centered layout) --}}
                <div x-show="residency === 'switzerland'" class="space-y-8 max-w-4xl mx-auto" x-cloak>
                    
                    {{-- Ways to Donate (Full Width Card) --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-10 shadow-sm text-center space-y-8">
                        
                        {{-- Bank Transfer Section --}}
                        <div class="space-y-4">
                            <p class="text-sm md:text-base text-slate-655 leading-relaxed max-w-2xl mx-auto">
                                To make a donation to our entity in Switzerland, you can make a money transfer to our bank account:
                            </p>
                            <div class="text-slate-800 leading-relaxed text-sm md:text-base font-semibold">
                                <p>Banque Cler IBAN CH87</p>
                                <p>0844 0459 1242 9009 0</p>
                            </div>
                        </div>

                        {{-- PayPal Section --}}
                        <div class="space-y-4">
                            <p class="text-sm md:text-base text-slate-655 leading-relaxed max-w-2xl mx-auto">
                                You can make a online donation via our PayPal account
                            </p>
                            <div class="flex flex-col items-center justify-center space-y-4">
                                <img src="{{ asset('images/paypal.jpg') }}" alt="PayPal logo" class="h-14 w-auto object-contain">
                                <a href="https://www.paypal.com" target="_blank" rel="noopener"
                                   class="inline-flex items-center justify-center px-6 py-2.5 border border-[#1b4d75] hover:bg-[#1b4d75] text-[#1b4d75] hover:text-white text-xs font-black rounded-lg shadow-2xs transition-all cursor-pointer select-none">
                                    Make a donation via PayPal
                                </a>
                                <p class="text-[11px] text-slate-400 font-semibold italic text-center">
                                    (secure payment Visa card or Mastercard accepted)
                                </p>
                            </div>
                        </div>

                        {{-- Tax Section --}}
                        <div class="space-y-1 pt-2">
                            <p class="text-sm md:text-base text-slate-700 leading-relaxed font-semibold">
                                Donations are tax deductible in Switzerland.
                            </p>
                            <p class="text-xs text-slate-550 leading-relaxed font-semibold">
                                A donation receipt will be sent in February of the year following your transfer
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Elsewhere view: side-by-side columns --}}
                <div x-show="residency === 'elsewhere'" class="grid md:grid-cols-2 gap-8 items-start" x-cloak>
                    
                    {{-- LEFT COLUMN: Standard Impact Description --}}
                    <div class="bg-white rounded-2xl border border-slate-200/80 p-8 shadow-sm flex flex-col justify-between min-h-[460px]">
                        <div class="space-y-6">
                            <div class="text-center md:text-left space-y-3">
                                <span class="text-xs font-bold text-[#2d6fa3] tracking-widest uppercase block">Make a Difference</span>
                                <h2 class="text-3xl font-black text-slate-800 leading-tight">Support Children in Cambodia</h2>
                                
                                {{-- Elsewhere description --}}
                                <div class="space-y-3">
                                    <p class="text-sm text-slate-550 leading-relaxed">
                                        For donors residing elsewhere in the world, your international donation goes directly to support Krousar Thmey's child welfare, special education, and cultural development programs in Cambodia.
                                    </p>
                                </div>
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
                        <div class="border-t border-slate-100 pt-4 mt-6 flex items-center gap-2.5 text-[11px] text-slate-455 font-bold">
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
                                <span class="bg-slate-100 text-slate-655 px-2 py-0.5 rounded text-[10px] font-bold" x-text="currency"></span>
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
                                                class="py-3 border rounded-lg text-sm font-bold transition-all duration-200 focus:outline-none cursor-pointer">
                                            <span x-text="formatPreset(presets[0])"></span>
                                        </button>
                                        <button type="button"
                                                @click="amount = presets[1]; custom_amount = ''; activePreset = presets[1]"
                                                :class="activePreset === presets[1] ? 'text-white shadow-sm' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50'"
                                                :style="activePreset === presets[1] ? 'background-color: #0070ba; border-color: #0070ba;' : ''"
                                                class="py-3 border rounded-lg text-sm font-bold transition-all duration-200 focus:outline-none cursor-pointer">
                                            <span x-text="formatPreset(presets[1])"></span>
                                        </button>
                                        <button type="button"
                                                @click="amount = presets[2]; custom_amount = ''; activePreset = presets[2]"
                                                :class="activePreset === presets[2] ? 'text-white shadow-sm' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50'"
                                                :style="activePreset === presets[2] ? 'background-color: #0070ba; border-color: #0070ba;' : ''"
                                                class="py-3 border rounded-lg text-sm font-bold transition-all duration-200 focus:outline-none cursor-pointer">
                                            <span x-text="formatPreset(presets[2])"></span>
                                        </button>
                                        <button type="button"
                                                @click="amount = presets[3]; custom_amount = ''; activePreset = presets[3]"
                                                :class="activePreset === presets[3] ? 'text-white shadow-sm' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50'"
                                                :style="activePreset === presets[3] ? 'background-color: #0070ba; border-color: #0070ba;' : ''"
                                                class="py-3 border rounded-lg text-sm font-bold transition-all duration-200 focus:outline-none cursor-pointer">
                                            <span x-text="formatPreset(presets[3])"></span>
                                        </button>
                                        <button type="button"
                                                @click="amount = presets[4]; custom_amount = ''; activePreset = presets[4]"
                                                :class="activePreset === presets[4] ? 'text-white shadow-sm' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50'"
                                                :style="activePreset === presets[4] ? 'background-color: #0070ba; border-color: #0070ba;' : ''"
                                                class="py-3 border rounded-lg text-sm font-bold transition-all duration-200 focus:outline-none cursor-pointer">
                                            <span x-text="formatPreset(presets[4])"></span>
                                        </button>
                                        <button type="button"
                                                @click="amount = presets[5]; custom_amount = ''; activePreset = presets[5]"
                                                :class="activePreset === presets[5] ? 'text-white shadow-sm' : 'bg-white text-slate-700 border-slate-200 hover:bg-slate-50'"
                                                :style="activePreset === presets[5] ? 'background-color: #0070ba; border-color: #0070ba;' : ''"
                                                class="py-3 border rounded-lg text-sm font-bold transition-all duration-200 focus:outline-none cursor-pointer">
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
                                        class="inline-flex w-full items-center justify-center gap-2 rounded-lg px-5 py-3 text-sm font-bold text-white transition hover:brightness-105 disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none cursor-pointer"
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
                                <button type="button" @click="step = 1" class="text-slate-400 hover:text-slate-600 transition-colors focus:outline-none cursor-pointer">
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
                                        <input type="text" name="last_name" x-model="last_name" required placeholder="Enter your last name"
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
                                                class="inline-flex w-full items-center justify-center gap-2 rounded-lg px-5 py-3 text-sm font-bold text-white transition hover:brightness-105 disabled:opacity-50 disabled:cursor-not-allowed focus:outline-none cursor-pointer"
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
                                    <p class="text-sm md:text-base text-slate-650 font-semibold leading-relaxed">
                                        We have sent a confirmation email to <span class="font-bold text-slate-850" x-text="email"></span>.
                                    </p>
                                </div>

                                <div class="bg-slate-50 p-4 rounded-xl text-left border border-slate-150 space-y-2.5">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Wire transfer details</span>
                                    <div class="grid grid-cols-2 gap-y-1.5 text-[11px] font-mono">
                                        <span class="text-slate-400">Amount:</span>
                                        <span class="text-slate-850 font-bold text-right" x-text="formatPreset(amount)"></span>
                                    </div>
                                </div>

                                <p class="text-[10px] text-slate-455 leading-relaxed italic">
                                    Your donation details have been shared with our regional entities. Thank you for your support.
                                </p>
                            </div>

                            {{-- Footer badge --}}
                            <div class="p-4 border-t border-slate-100 bg-slate-50/50 flex items-center justify-center gap-1.5 text-[10px] text-slate-400 font-bold">
                                <button type="button" @click="step = 1; first_name=''; last_name=''; email=''; custom_amount=''; amount=5; activePreset=5;" class="text-[#0070ba] hover:underline font-bold cursor-pointer">
                                    Make another donation
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Mutualisation of donations disclaimer --}}
                <div x-show="residency === 'france' || residency === 'switzerland'" x-cloak class="mt-12 space-y-8">
                    <p class="text-[11px] text-slate-500 leading-relaxed italic text-center max-w-3xl mx-auto">
                        <strong>Mutualisation of donations:</strong> Krousar Thmey has the principle of not affecting the donations and to pool the funds received on all of its missions. This clear principle allows for intervention only on the basis of actual needs on the ground and not on the basis of financial considerations. Therefore, if the donations received exceed the commitments made, they will be reallocated according to the other programs.
                    </p>
                    <div class="text-center space-y-6">
                        <h2 class="text-xl md:text-2xl lg:text-3xl font-black text-[#1c3a5e] tracking-tight max-w-2xl mx-auto leading-snug">
                            On behalf of the children, we warmly thank you for your support!
                        </h2>
                        <div class="relative max-w-3xl mx-auto rounded-2xl overflow-hidden shadow-[0_15px_35px_rgba(15,23,42,0.08)] border border-slate-100/80 transition-all duration-300 hover:shadow-[0_20px_45px_rgba(15,23,42,0.12)]">
                            <img src="https://www.krousar-thmey.org/wp-content/uploads/2023/02/donate.webp"
                                 alt="Thank you for your support"
                                 class="w-full h-auto object-cover transform hover:scale-[1.01] transition-transform duration-500"
                                 loading="lazy">
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

</div>

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
                    <p class="text-gray-550 text-xs leading-relaxed">{{ $item['label'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
