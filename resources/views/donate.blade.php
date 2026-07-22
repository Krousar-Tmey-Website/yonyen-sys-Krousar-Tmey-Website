@extends('layouts.app')

@section('title', 'Donate — Krousar Thmey')
@section('description', 'Support children in Cambodia. Donate locally via ABA or ACLEDA QR.')

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
<section class="pt-16 pb-14 bg-[#f8f9fc]">
    <div class="max-w-[1040px] mx-auto px-4 sm:px-6 2xl:px-0">
        {{-- Switcher Tabs --}}
        <div class="flex justify-center gap-4 mb-8">
            <a href="{{ route('donate') }}"
               class="px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300 bg-[#2d6fa3] text-white shadow-[0_8px_18px_rgba(45,111,163,0.28)] flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                Local Donation (Cambodia)
            </a>
            <a href="{{ route('donate.international') }}"
               class="px-6 py-2.5 rounded-full text-sm font-bold transition-all duration-300 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                </svg>
                International Donation
            </a>
        </div>

        @if($paymentMethods->isNotEmpty())
        @php
            $logoPath = $settings['site_logo'] ?? 'images/logo.png';
            $logoUrl = str_starts_with($logoPath, 'http') ? $logoPath : (str_starts_with($logoPath, 'logos/') ? asset('storage/' . $logoPath) : asset($logoPath));
        @endphp
        <div class="max-w-[1040px] mx-auto bg-white rounded-[30px] shadow-[0_26px_70px_rgba(15,23,42,0.13)] overflow-hidden">
            <div class="grid lg:grid-cols-[430px_minmax(0,1fr)] gap-0 lg:min-h-[520px]">
                <div class="relative bg-white pb-7 lg:min-h-[520px] lg:pb-0">
                    <div class="relative h-[345px] overflow-hidden sm:h-[365px] lg:h-[305px]">
                        <img src="https://pbs.twimg.com/media/DSCk7u6XcAA0hrt.jpg"
                             alt="Children supported by Krousar Thmey"
                             class="absolute inset-0 w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/35 via-transparent to-transparent"></div>
                    </div>

                    <div class="relative z-20 mx-7 -mt-16 mb-1 bg-white rounded-[18px] p-5 shadow-[0_16px_32px_rgba(15,23,42,0.14)] sm:mx-10 sm:-mt-20 lg:absolute lg:left-[24px] lg:right-auto lg:bottom-[24px] lg:mx-0 lg:mt-0 lg:mb-0 lg:w-[382px] lg:min-h-[220px]">
                        <div class="flex items-center gap-3 mb-3.5">
                            <img src="{{ $logoUrl }}" alt="Krousar Thmey" class="w-10 h-10 rounded-full object-contain bg-gray-50 border border-gray-100">
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-slate-900 leading-tight truncate">Krousar Thmey</p>
                                <p class="text-xs text-slate-500">Cambodia · Since 1991</p>
                            </div>
                        </div>
                        <h3 class="text-[19px] font-extrabold text-slate-950 leading-tight mb-2.5">Your gift gives a child a home, a school, a future.</h3>
                        <p class="text-[14px] leading-relaxed text-slate-600">Every donation goes directly to supporting disadvantaged children across Cambodia — 100% of funds reach the children in our care.</p>
                    </div>
                </div>

                <div class="px-6 py-8 sm:p-9 lg:pt-[34px] lg:pr-[34px] lg:pb-[34px] lg:pl-[36px]">

                    {{-- Local Donation --}}
                    <div x-data="{ active: 0 }" class="w-full">
                        <div class="inline-flex flex-wrap items-center gap-1 bg-slate-100 rounded-full p-1 mb-7 shadow-inner">
                            @foreach($paymentMethods as $i => $method)
                            @php $accent = '#2d6fa3'; @endphp
                            <button type="button"
                                    @click="active = {{ $i }}"
                                    :class="active === {{ $i }} ? 'text-white shadow-[0_8px_18px_rgba(45,111,163,0.28)]' : 'text-slate-600 hover:text-slate-900'"
                                    class="min-w-[82px] px-4 py-1.5 rounded-full text-[15px] font-bold transition-all duration-200"
                                    :style="active === {{ $i }} ? 'background-color: {{ $accent }}' : ''">
                                {{ $method->name }}
                            </button>
                            @endforeach
                        </div>

                        @foreach($paymentMethods as $i => $method)
                        @php
                            $accent = '#2d6fa3';
                        @endphp
                        <div x-show="active === {{ $i }}" x-cloak class="space-y-5">
                            <div class="grid gap-5 xl:grid-cols-[190px_minmax(0,1fr)] items-start">
                                <div class="rounded-[22px] border-2 border-dashed border-[#cfe0ef] bg-white p-3.5 flex flex-col items-center justify-center gap-3 min-h-[205px]">
                                    @if($method->qr_code_url)
                                    <a href="{{ $method->qr_code_url . '?v=' . ($method->updated_at?->timestamp ?? time()) }}"
                                       target="_blank" rel="noopener"
                                       class="inline-flex w-full items-center justify-center p-1"
                                       aria-label="Open {{ $method->name }} QR code">
                                        <img src="{{ $method->qr_code_url . '?v=' . ($method->updated_at?->timestamp ?? time()) }}"
                                             alt="{{ $method->name }} QR"
                                             class="max-h-[158px] max-w-full object-contain rounded-xl shadow-[0_16px_30px_rgba(15,23,42,0.11)]"
                                             loading="lazy">
                                    </a>
                                    @else
                                    <div class="flex min-h-[158px] w-full flex-col items-center justify-center gap-3 rounded-[18px] border border-dashed border-slate-200 bg-slate-50 p-5 text-center">
                                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                        </svg>
                                        <p class="text-xs leading-snug text-slate-500">Add your QR file in admin</p>
                                    </div>
                                    @endif
                                    <p class="text-center text-sm font-bold text-slate-400">Scan with {{ $method->name }}</p>
                                </div>

                                <div class="space-y-3.5">
                                    <div class="grid gap-3 sm:grid-cols-2">
                                        <div class="rounded-2xl border border-slate-200 bg-white px-4 py-3.5 min-h-[68px]">
                                            <p class="text-[12px] uppercase tracking-[0.12em] text-slate-400 mb-2 font-bold">Account holder</p>
                                            <p class="text-base font-bold text-slate-900 leading-none">{{ $method->account_name ?: '—' }}</p>
                                        </div>
                                        <div class="rounded-2xl border border-slate-200 bg-white px-4 py-3.5 min-h-[68px]">
                                            <p class="text-[12px] uppercase tracking-[0.12em] text-slate-400 mb-2 font-bold">Currency</p>
                                            <p class="text-base font-bold text-slate-900 leading-none">
                                                @if($method->currency === 'Both')
                                                    <span class="inline-flex items-center gap-2">
                                                        <span class="rounded-full bg-slate-100 px-2 py-1 text-[11px] uppercase tracking-[0.2em]">USD</span>
                                                        <span class="rounded-full bg-slate-100 px-2 py-1 text-[11px] uppercase tracking-[0.2em]">KHR</span>
                                                    </span>
                                                @else
                                                    {{ $method->currency ?: '—' }}
                                                @endif
                                            </p>
                                        </div>
                                    </div>

                                    <div class="rounded-2xl border-2 border-[#cfe0ef] bg-slate-50/60 px-4 py-3.5 min-h-[80px]">
                                        <p class="text-[12px] uppercase tracking-[0.12em] text-slate-400 mb-2.5 font-bold">Account No.</p>
                                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                                            <span class="text-base font-bold text-slate-900 font-mono break-words">{{ $method->account_no ?: '—' }}</span>
                                            @if($method->code)
                                            <span style="background-color: {{ $accent }}" class="inline-flex items-center rounded-[10px] px-3.5 py-1.5 text-[13px] font-extrabold text-white">{{ $method->code }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="pt-2">
                                        <h4 class="text-[16px] font-extrabold uppercase tracking-[0.14em] text-slate-400 mb-3.5">How to pay</h4>
                                        <ol class="space-y-2.5">
                                            @php $steps = ['Open '.$method->name, 'Tap Pay → QR Payment', 'Scan the code above', 'Enter amount & confirm']; @endphp
                                            @foreach($steps as $index => $step)
                                            <li class="flex items-start gap-3">
                                                <span style="background-color: {{ $accent }}" class="mt-0.5 inline-flex h-6 w-6 shrink-0 items-center justify-center rounded-full text-[11px] font-bold text-white">{{ $index + 1 }}</span>
                                                <span class="text-[14px] leading-relaxed text-slate-700">{{ $step }}</span>
                                            </li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ $method->qr_code_url ? $method->qr_code_url . '?v=' . ($method->updated_at?->timestamp ?? time()) : '#' }}"
                               target="_blank" rel="noopener"
                               style="background-color: {{ $accent }}"
                               class="inline-flex w-full items-center justify-center gap-3 rounded-[13px] px-5 py-3.5 text-[15px] font-extrabold text-white shadow-[0_12px_20px_rgba(45,111,163,0.26)] transition hover:-translate-y-0.5 hover:brightness-105 xl:ml-[215px] xl:w-[320px]">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                                Scan QR to Donate via {{ $method->name }}
                            </a>
                        </div>
                        @endforeach
                    </div>
            </div>
        </div>
        @else
        {{-- Empty state --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center shadow-sm max-w-lg mx-auto">
            <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                </svg>
            </div>
            <p class="text-gray-500 text-sm font-medium">No local payment methods are available at this time.</p>
            <p class="text-gray-400 text-xs mt-1">Please check back later.</p>
        </div>
        @endif



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
