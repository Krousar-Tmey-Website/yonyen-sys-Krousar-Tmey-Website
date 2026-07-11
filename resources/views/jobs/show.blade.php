@extends('layouts.app')

@section('title', $jobOpportunity->title . ' — Krousar Thmey')
@section('description', $jobOpportunity->description ?? 'Job opportunity at Krousar Thmey')

@section('content')

{{-- Header --}}
<div class="bg-white pt-10 pb-8">
    <div class="max-w-4xl mx-auto px-6">

        <div class="flex flex-wrap items-start gap-2 mb-1">
            <h1 class="text-xl md:text-2xl font-black text-[#2d6fa3] uppercase tracking-wide">{{ $jobOpportunity->title }}</h1>
            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full mt-0.5
                {{ $jobOpportunity->status === 'open' ? 'bg-green-50 text-green-700' : ($jobOpportunity->status === 'filled' ? 'bg-yellow-50 text-yellow-700' : 'bg-red-50 text-red-700') }}">
                {{ $jobOpportunity->status === 'filled' ? 'FILLED' : strtoupper($jobOpportunity->status) }}
            </span>
        </div>

        <div class="flex flex-wrap items-center gap-x-3 gap-y-0.5 text-gray-500 text-[11px]">
            @if($jobOpportunity->type) <span>{{ $jobOpportunity->type }}</span> @endif
            @if($jobOpportunity->type && $jobOpportunity->location) <span class="text-gray-300">|</span> @endif
            @if($jobOpportunity->location) <span>{{ $jobOpportunity->location }}</span> @endif
            @if(($jobOpportunity->type || $jobOpportunity->location) && $jobOpportunity->posted_date) <span class="text-gray-300">|</span> @endif
            @if($jobOpportunity->posted_date) <span>{{ $jobOpportunity->posted_date->format('M d, Y') }}</span> @endif
        </div>
    </div>
</div>

{{-- Content --}}
<section class="bg-white py-8">
    <div class="max-w-4xl mx-auto px-6">

        @if($jobOpportunity->image)
        <div class="mb-6 flex justify-center">
            <img src="{{ asset('storage/' . $jobOpportunity->image) }}" alt="{{ $jobOpportunity->title }}"
                 class="max-h-[40rem] w-auto object-contain rounded-xl shadow-sm ring-1 ring-gray-100">
        </div>
        @endif

        @if($jobOpportunity->description)
        <div class="text-gray-700 text-sm leading-relaxed whitespace-pre-line mb-6">
            {{ $jobOpportunity->description }}
        </div>
        @endif

        {{-- Apply box --}}
        <div class="bg-[#f8f9fc] rounded-xl border border-gray-200 p-5 mb-6">
            <h3 class="text-xs font-bold text-[#1a3c6e] uppercase tracking-widest mb-1">How to Apply</h3>
            <p class="text-gray-600 text-sm mb-3">Send your CV and cover letter to our HR department. Mention the position title in the subject line.</p>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('contact') }}" class="btn-blue text-xs py-2">Send Application</a>
                <a href="{{ route('involved') }}#jobs" class="text-[#2d6fa3] text-xs font-semibold hover:text-[#1d4e7a] transition-colors inline-flex items-center gap-1 self-center">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    All Openings
                </a>
            </div>
        </div>

        {{-- Details row --}}
        <div class="flex flex-wrap gap-x-6 gap-y-2 text-xs text-gray-500">
            @if($jobOpportunity->status)
            <div><span class="text-gray-400">Status:</span> <span class="font-semibold text-gray-700 capitalize">{{ $jobOpportunity->status === 'filled' ? 'Position Filled' : $jobOpportunity->status }}</span></div>
            @endif
            @if($jobOpportunity->type)
            <div><span class="text-gray-400">Type:</span> <span class="font-semibold text-gray-700">{{ $jobOpportunity->type }}</span></div>
            @endif
            @if($jobOpportunity->location)
            <div><span class="text-gray-400">Location:</span> <span class="font-semibold text-gray-700">{{ $jobOpportunity->location }}</span></div>
            @endif
            @if($jobOpportunity->posted_date)
            <div><span class="text-gray-400">Posted:</span> <span class="font-semibold text-gray-700">{{ $jobOpportunity->posted_date->format('M d, Y') }}</span></div>
            @endif
        </div>
    </div>
</section>

@endsection
