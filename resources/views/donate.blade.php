@extends('layouts.app')

@section('title', 'Donate — Krousar Thmey')
@section('description', 'Support children in Cambodia. Donate locally via ABA or ACLEDA QR.')

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
<section class="py-16 lg:py-24 bg-[#f8f9fc]">
    <div class="max-w-6xl mx-auto px-6">

        {{-- Section Title --}}
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-[#2d6fa3]">Donate Locally in Cambodia</h2>
            <p class="text-gray-500 mt-2 text-sm">Scan with your banking app · No internet transfer fees</p>
        </div>

        @if($paymentMethods->isNotEmpty())
        <div class="grid lg:grid-cols-2 gap-8 max-w-5xl mx-auto">
            @foreach($paymentMethods as $method)
            @php
                $primary = $method->brand_color ?: '#2d6fa3';
                $initial = collect(explode(' ', $method->name))->map(fn($w) => substr($w, 0, 1))->take(2)->implode('');
                $shortLabel = strlen($method->code) > 8 ? $initial : $method->code;
                $subtitle = $method->description ?: $method->name . ' · Cambodia';
            @endphp

            {{-- Payment Method Card --}}
            <div class="relative bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5 flex flex-col">

                {{-- Header Band --}}
                <div class="px-6 py-5 flex items-center gap-4" style="background-color: {{ $primary }};">
                    <div class="w-11 h-11 rounded-lg bg-white flex items-center justify-center flex-shrink-0 shadow-sm">
                        <span class="font-bold text-sm" style="color: {{ $primary }};">{{ $shortLabel }}</span>
                    </div>
                    <div class="min-w-0 flex-1">
                        <h3 class="text-white font-bold text-base leading-tight truncate">{{ $method->name }}</h3>
                        <p class="text-white/70 text-xs mt-0.5 truncate">{{ $subtitle }}</p>
                    </div>
                </div>

                {{-- Card Body --}}
                <div class="p-6 flex flex-col flex-1">

                    {{-- QR Code Area --}}
                    <div class="relative mb-5">
                        <div class="aspect-square max-w-[220px] mx-auto rounded-xl border-2 border-dashed flex items-center justify-center overflow-hidden"
                             style="border-color: {{ $primary }}25; background-color: {{ $primary }}04;">
                            @if($method->qr_code_url)
                            <a href="{{ $method->qr_code_url . '?v=' . ($method->updated_at?->timestamp ?? time()) }}"
                               target="_blank" rel="noopener"
                               class="w-full h-full flex items-center justify-center p-3"
                               aria-label="Open {{ $method->name }} QR code">
                                <img src="{{ $method->qr_code_url . '?v=' . ($method->updated_at?->timestamp ?? time()) }}"
                                     alt="{{ $method->name }} QR"
                                     class="max-h-full max-w-full object-contain drop-shadow-sm"
                                     loading="lazy">
                            </a>
                            @else
                            <div class="flex flex-col items-center justify-center gap-2 p-6 text-center">
                                <svg class="w-8 h-8" style="color: {{ $primary }}40;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                </svg>
                                <p class="text-xs leading-snug" style="color: {{ $primary }}50;">Add your QR file in admin</p>
                            </div>
                            @endif
                        </div>

                        {{-- Badge in bottom-right corner --}}
                        <div class="absolute -bottom-1.5 -right-1.5 rounded-lg px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-white shadow-sm"
                             style="background-color: {{ $primary }};">
                            {{ $method->code }}
                        </div>
                    </div>

                    {{-- Info Rows --}}
                    <div class="space-y-0 mb-5">
                        {{-- Account Holder --}}
                        <div class="flex items-center justify-between py-2.5 border-b border-gray-100">
                            <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Account Holder</span>
                            <span class="text-sm font-semibold text-gray-800 text-right">{{ $method->account_name ?: '—' }}</span>
                        </div>
                        {{-- Account No. --}}
                        <div class="flex items-center justify-between py-2.5 border-b border-gray-100">
                            <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Account No.</span>
                            <span class="text-sm font-semibold text-gray-800 text-right font-mono">{{ $method->account_no ?: '—' }}</span>
                        </div>
                        {{-- Currency --}}
                        <div class="flex items-center justify-between py-2.5">
                            <span class="text-xs text-gray-400 font-medium uppercase tracking-wider">Currency</span>
                            <span class="text-sm font-semibold text-gray-800 text-right">
                                @if($method->currency === 'Both')
                                    <span class="inline-flex items-center gap-1">
                                        <span class="px-1.5 py-0.5 bg-gray-100 rounded text-xs">USD</span>
                                        <span class="text-gray-400">/</span>
                                        <span class="px-1.5 py-0.5 bg-gray-100 rounded text-xs">KHR</span>
                                    </span>
                                @else
                                    {{ $method->currency ?: '—' }}
                                @endif
                            </span>
                        </div>
                    </div>

                    {{-- HOW TO PAY Section --}}
                    <div class="rounded-xl p-4 mt-auto" style="background-color: {{ $primary }}10;">
                        <h4 class="text-xs font-extrabold uppercase tracking-widest mb-3" style="color: {{ $primary }};">How to Pay</h4>
                        <ol class="space-y-2.5">
                            @php $steps = ['Open '.$method->name, 'Tap Pay → QR Payment', 'Scan the code above', 'Enter amount & confirm']; @endphp
                            @foreach($steps as $i => $step)
                            <li class="flex items-start gap-3">
                                <span class="mt-0.5 inline-flex h-5 w-5 items-center justify-center rounded-full text-[10px] font-bold text-white flex-shrink-0"
                                      style="background-color: {{ $primary }};">{{ $i + 1 }}</span>
                                <span class="text-xs leading-relaxed" style="color: {{ $primary }}dd;">{{ $step }}</span>
                            </li>
                            @endforeach
                        </ol>
                    </div>

                </div>
            </div>
            @endforeach
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
