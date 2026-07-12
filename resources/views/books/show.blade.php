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
                @if($book->author)
                <p class="text-gray-500 text-lg mb-4">By {{ $book->author }}</p>
                @endif
                <div class="text-4xl font-bold text-[#1a3c6e] mb-8">{{ $book->formatted_price }}</div>
                @if($book->description)
                <div class="text-gray-600 text-lg leading-loose">
                    {!! nl2br(e($book->description)) !!}
                </div>
                @endif
                <div class="mt-10 p-6 bg-white rounded-2xl shadow-sm">
                    <p class="text-base text-gray-600">100% of proceeds go directly to supporting children in Cambodia.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
