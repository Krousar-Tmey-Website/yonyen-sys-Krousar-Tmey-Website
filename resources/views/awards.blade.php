@extends('layouts.app')

@section('title', 'Awards — Krousar Thmey')
@section('description', 'Recognitions and awards received by Krousar Thmey for their humanitarian work in Cambodia.')

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
            <span class="text-white">Awards</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Awards & Recognitions</h1>
        <p class="text-white/70 text-lg max-w-2xl">Celebrating the achievements and recognition of Krousar Thmey's humanitarian work in Cambodia.</p>
    </div>
</div>

{{-- Awards Grid --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6">
        @if($awards->isEmpty())
        <div class="text-center py-16 bg-[#f8f9fc] rounded-3xl border border-gray-100">
            <div class="text-6xl mb-4">🏆</div>
            <p class="text-gray-400 text-lg">No awards have been added yet.</p>
        </div>
        @else
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($awards as $award)
            <div class="bg-[#f8f9fc] rounded-3xl p-7 border border-gray-100 hover:shadow-lg transition-shadow text-center flex flex-col h-full">
                @if($award->image)
                <img src="{{ $award->image_url }}" alt="{{ $award->title }}" class="w-20 h-20 rounded-2xl object-cover mb-5 mx-auto">
                @else
                <div class="text-5xl mb-5">{{ $award->icon }}</div>
                @endif
                @if($award->recipient)
                <span class="text-[#e8a020] text-xs font-bold uppercase tracking-wider block mb-1">{{ $award->recipient }}</span>
                @endif
                <h3 class="text-lg font-bold text-[#1a3c6e] mb-2 leading-snug">{{ $award->title }}</h3>
                <p class="text-[#2d6fa3] text-sm font-medium mb-3">{{ $award->organization }}</p>
                @if($award->description)
                <p class="text-gray-500 text-sm leading-relaxed mb-4 flex-grow">{{ $award->description }}</p>
                @endif
                @if($award->link_url)
                <a href="{{ $award->link_url }}" target="_blank" rel="noopener"
                   class="inline-flex items-center justify-center gap-2 bg-[#1a3c6e] text-white px-4 py-2 rounded-xl text-sm font-medium hover:bg-[#2d6fa3] transition-colors mt-auto">
                    @if($award->link_type === 'website')
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2v-8m0-6V6a2 2 0 112 2h-6m-6 0l6 6m-6-6l6-6"/></svg>
                    @elseif($award->link_type === 'article')
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13S12 1.253 12 6.253c0 0 0 5 6 6v8c0 0-6 1-6 6s6-6 6-6v-8c0-5-6-6-6-6z"/></svg>
                    @elseif($award->link_type === 'video')
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l1.252-1.252L12 5.5l-4 4.414L5.252 9.916l1.252 1.252L12 16.5l2.752-5.332z"/></svg>
                    @endif
                    {{ $award->link_text ?? ucfirst($award->link_type) }}
                </a>
                @endif
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

@endsection