@extends('layouts.app')

@section('title', 'Latest Updates — Krousar Thmey')
@section('description', 'Latest updates from Krousar Thmey — new events, volunteer opportunities, and published articles. No email required.')

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
            <span class="text-white">Latest Updates</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Latest Updates</h1>
        <p class="text-white/70 text-lg max-w-2xl">Stay informed about our newest events, volunteer opportunities, and stories — all in one place. No email required.</p>
    </div>
</div>

<section class="py-16 bg-gray-50">
    <div class="max-w-3xl mx-auto px-6">

        @if($groups->isEmpty())
            <div class="bg-white rounded-2xl border border-gray-100 p-12 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                <p class="text-gray-400 text-sm">No updates yet. Check back soon!</p>
            </div>
        @else
            @foreach($groups as $label => $notifications)
            <div class="mb-10">
                {{-- Date group label --}}
                <div class="flex items-center gap-3 mb-5">
                    <h2 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">{{ $label }}</h2>
                    <div class="flex-1 h-px bg-gray-200"></div>
                </div>

                <div class="space-y-4">
                    @foreach($notifications as $notification)
                        @php $meta = $notification->meta(); @endphp
                        <div class="bg-white rounded-2xl border border-gray-100 p-5 flex items-start gap-4 hover:shadow-sm transition-shadow">
                            {{-- Type icon (circle background) --}}
                            <div class="w-11 h-11 rounded-full flex items-center justify-center flex-shrink-0 {{ $meta['iconBg'] }}">
                                <svg class="w-5 h-5 {{ $meta['iconText'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $meta['icon'] }}"/>
                                </svg>
                            </div>

                            <div class="flex-1 min-w-0">
                                <span class="inline-block px-2.5 py-1 rounded-full text-xs font-medium mb-2 {{ $meta['badge'] }}">
                                    {{ $meta['label'] }}
                                </span>
                                <h3 class="font-bold text-gray-800 text-base leading-snug">{{ $notification->title }}</h3>
                                @if($notification->excerpt)
                                    <p class="text-gray-500 text-sm leading-relaxed mt-1.5">{{ $notification->excerpt }}</p>
                                @endif
                                @if($notification->link)
                                    <a href="{{ $notification->link }}"
                                       class="inline-flex items-center gap-1.5 mt-3 text-sm font-semibold text-[#2d6fa3] hover:text-[#1d4e7a] transition-colors">
                                        Learn more
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                    </a>
                                @endif
                            </div>

                            <time class="text-gray-400 text-xs whitespace-nowrap flex-shrink-0">
                                {{ $notification->created_at->format('g:i A') }}
                            </time>
                        </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        @endif

        {{-- Back to subscribe --}}
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-400 hover:text-[#2d6fa3] transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Back to home
            </a>
        </div>
    </div>
</section>

@endsection
