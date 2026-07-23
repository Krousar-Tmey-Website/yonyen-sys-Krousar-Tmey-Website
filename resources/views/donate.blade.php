@extends('layouts.app')

@section('title', 'Donate — Krousar Thmey')
@section('description', 'Support children in Cambodia. Donate locally via ABA or ACLEDA QR.')

@section('content')

{{-- Header --}}
<div class="relative overflow-hidden bg-[#1f3f66] pt-24 pb-28">
    <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1400&q=80"
         alt="Children smiling together"
         class="absolute inset-0 h-full w-full object-cover opacity-80">
    <div class="absolute inset-0 bg-slate-950/75"></div>
    <div class="absolute inset-0 opacity-30">
        <div class="absolute top-10 left-10 w-72 h-72 rounded-full bg-[#8da83a]/40 blur-3xl"></div>
        <div class="absolute bottom-12 right-8 w-56 h-56 rounded-full bg-white/10 blur-3xl"></div>
    </div>
    <div class="relative max-w-6xl mx-auto px-6 text-center">
        <span class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-xs uppercase tracking-[0.26em] text-slate-200 mb-6">
            <svg class="w-4 h-4 text-[#8da83a]" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1.857-10.143a.75.75 0 10-1.714 0V10H7.857a.75.75 0 000 1.5h2.286v2.286a.75.75 0 001.5 0V11.5h2.286a.75.75 0 000-1.5H11.857V7.857z" clip-rule="evenodd" />
            </svg>
            Local QR donations
        </span>
        <h1 class="text-4xl md:text-5xl font-black text-white tracking-tight sm:text-6xl">Support Khmer children with a secure local donation.</h1>
        <p class="mt-6 text-base sm:text-lg text-slate-200 max-w-3xl mx-auto leading-8">
            Every gift helps a child access education, shelter, and medical care in Cambodia.
            Scan directly from ABA or ACLEDA and avoid extra transfer fees.
        </p>
    </div>
</div>

<section class="pt-14 pb-16 bg-[#f6f7fb]">
    <div class="max-w-[1040px] mx-auto px-4 sm:px-6">

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
                                class="min-h-[42px] px-4 py-2 rounded-[9px] text-[14px] font-bold border transition-all duration-200">
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
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
                                            class="shrink-0 w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-50 transition-colors"
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
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
