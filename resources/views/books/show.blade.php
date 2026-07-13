@extends('layouts.app')

@section('title', $book->title . ' — Books for Sale')
@section('description', $book->description ? Str::limit(strip_tags($book->description), 160) : 'Support children in Cambodia by purchasing ' . $book->title . '.')

@section('content')
<section class="py-24 bg-gradient-to-b from-[#f8f9fc] to-white">
    <div class="max-w-6xl mx-auto px-6">
        <a href="{{ route('involved') }}#book-for-sales" class="inline-flex items-center gap-2 text-[#1a3c6e] font-medium mb-10 hover:text-[#e8a020] transition-colors text-lg">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Back to Books for Sale
        </a>

        <div class="grid md:grid-cols-2 gap-16 items-center">
            <div>
                <img src="{{ $book->cover_image_url }}" alt="{{ $book->title }}" class="w-full rounded-3xl shadow-2xl object-cover">
            </div>
            <div>
                <span class="text-[#e8a020] font-semibold text-base uppercase tracking-wider">Book for Sale</span>
                <h1 class="text-4xl md:text-5xl font-bold text-[#1a3c6e] mt-4 mb-6 leading-tight">{{ $book->title }}</h1>
                <div class="text-4xl font-bold text-[#1a3c6e] mb-8">{{ $book->formatted_price }}</div>
                @if($book->description)
                <div class="text-gray-600 text-lg leading-loose">
                    {!! nl2br(e($book->description)) !!}
                </div>
                @endif
                <a href="{{ route('contact') }}"
                   class="inline-flex items-center justify-center gap-2 mt-8 px-8 py-3.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white font-semibold rounded-2xl transition-colors shadow-sm">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Order Book
                </a>
                <div class="mt-10 p-6 bg-white rounded-2xl shadow-sm">
                    <p class="text-base text-gray-600">100% of proceeds go directly to supporting children in Cambodia.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
