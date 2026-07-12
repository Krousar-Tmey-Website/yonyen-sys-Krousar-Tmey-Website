@extends('layouts.app')

@section('title', $book->title . ' — Krousar Thmey')
@section('description', $book->description ?? 'Order ' . $book->title . ' from Krousar Thmey')

@section('content')

{{-- Header --}}
<div class="bg-[#2d6fa3] pt-16 pb-20 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 rounded-full bg-white -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 rounded-full bg-[#8da83a] translate-y-1/2 -translate-x-1/3"></div>
    </div>
    <div class="relative max-w-5xl mx-auto px-6">
        <nav class="flex items-center gap-2 text-sm text-white/50 mb-8">
            <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <a href="{{ route('involved') }}#donate" class="hover:text-white transition-colors">Book for Sales</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            <span class="text-white">{{ $book->title }}</span>
        </nav>
        <p class="text-[#8da83a] font-bold text-sm uppercase tracking-widest mb-3">Book for Sales</p>
        <h1 class="text-3xl md:text-4xl font-black uppercase tracking-wide text-white mb-2">{{ $book->title }}</h1>
    </div>
</div>

{{-- Content --}}
<section class="bg-white py-12 -mt-10 relative z-10">
    <div class="max-w-5xl mx-auto px-6">
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="grid md:grid-cols-2 gap-0">
                {{-- Cover --}}
                <div class="bg-gray-100 flex items-center justify-center p-8 min-h-[24rem]">
                    @if($book->cover_image_url)
                    <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}"
                         class="max-h-[28rem] w-auto object-contain rounded-xl shadow-md">
                    @else
                    <div class="text-gray-300 text-7xl">📖</div>
                    @endif
                </div>

                {{-- Details --}}
                <div class="p-8 md:p-10 flex flex-col">
                    <div class="flex items-center justify-between gap-4 mb-5">
                        <span class="text-3xl font-black text-[#e8a020]">${{ number_format($book->price, 2) }}</span>
                        <span class="text-xs font-semibold px-3 py-1.5 rounded-full
                            {{ $book->stock > 0 ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700' }}">
                            {{ $book->stock > 0 ? $book->stock . ' in stock' : 'Out of stock' }}
                        </span>
                    </div>

                    <h2 class="text-lg font-black text-[#2d6fa3] uppercase tracking-wide mb-3">About this book</h2>
                    @if($book->description)
                    <p class="text-gray-600 leading-relaxed mb-8">{{ $book->description }}</p>
                    @else
                    <p class="text-gray-400 leading-relaxed mb-8">No description available yet.</p>
                    @endif

                    <div class="mt-auto flex flex-wrap gap-3 pt-2">
                        <a href="{{ route('contact') }}" class="btn-primary text-base">Order Book</a>
                        <a href="{{ route('involved') }}#donate" class="btn-outline text-base">Back to Book for Sales</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Related / CTA --}}
        <div class="mt-10 bg-[#f8f9fc] rounded-3xl p-10 text-center border border-gray-100">
            <h3 class="text-xl font-black text-[#2d6fa3] uppercase tracking-wide mb-3">Support our mission</h3>
            <p class="text-gray-500 mb-8 max-w-lg mx-auto text-sm leading-relaxed">Every book you order helps fund Krousar Thmey's work with children across Cambodia. Get in touch to place your order.</p>
            <a href="{{ route('contact') }}" class="btn-blue">Contact Us</a>
        </div>
    </div>
</section>

@endsection
