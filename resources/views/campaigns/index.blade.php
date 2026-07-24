@extends('layouts.app')

@section('title', 'Donation Campaigns — Krousar Thmey')
@section('description', 'Support our fundraising campaigns and make a difference in the lives of children in Cambodia.')

@section('content')
{{-- Banner --}}
<section class="relative bg-gradient-to-br from-[#1d4e7a] via-[#254e7a] to-[#2d6fa3] py-20 md:py-28 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-[#8da83a]/30 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block px-4 py-1.5 rounded-full bg-white/10 text-white/80 text-xs font-semibold tracking-wider uppercase mb-5 backdrop-blur-sm border border-white/10">Support Our Mission</span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight">
            Donation Campaigns
        </h1>
        <p class="mt-4 text-lg md:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed">
            Every contribution brings hope and opportunity to children across Cambodia. Choose a campaign to support.
        </p>
    </div>
</section>

{{-- Stats Bar --}}
@if($campaigns->count())
<section class="border-b border-gray-100 bg-white/80 backdrop-blur-sm sticky top-20 z-40 hidden md:block">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <div class="flex items-center justify-center gap-8 text-sm">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span class="text-gray-500"><strong class="text-gray-800">{{ $campaigns->count() }}</strong> Active Campaigns</span>
            </div>
            <div class="w-px h-4 bg-gray-200"></div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span class="text-gray-500"><strong class="text-gray-800">${{ number_format($campaigns->sum('goal_amount'), 0) }}</strong> Total Goal</span>
            </div>
            @php $totalRaised = $campaigns->sum('collected_amount'); $totalGoal = $campaigns->sum('goal_amount'); $overallProgress = $totalGoal > 0 ? round(($totalRaised / $totalGoal) * 100) : 0; @endphp
            <div class="w-px h-4 bg-gray-200"></div>
            <div class="flex items-center gap-2">
                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" /></svg>
                <span class="text-gray-500"><strong class="text-emerald-700">{{ $overallProgress }}%</strong> Overall Progress</span>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Campaigns Grid --}}
<section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($campaigns->count())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($campaigns as $index => $campaign)
            <a href="{{ route('campaigns.public.show', $campaign) }}"
               class="group block bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden hover:-translate-y-1.5"
               style="animation: fadeInUp 0.5s ease-out {{ $index * 0.1 }}s both;">
                {{-- Image --}}
                <div class="relative h-52 bg-gray-100 overflow-hidden">
                    @if($campaign->image_url)
                    <img src="{{ $campaign->image_url }}" alt="{{ $campaign->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-[#2d6fa3]/20 to-[#8da83a]/20 flex items-center justify-center">
                        <svg class="w-12 h-12 text-[#2d6fa3]/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    @endif

                    {{-- Attachment badges --}}
                    <div class="absolute top-3 right-3 flex gap-1.5">
                        @if($campaign->has_video)
                        <span class="w-7 h-7 rounded-full bg-black/40 backdrop-blur-sm flex items-center justify-center text-xs shadow-lg" title="Video available">🎬</span>
                        @endif
                        @if($campaign->has_pdf)
                        <span class="w-7 h-7 rounded-full bg-black/40 backdrop-blur-sm flex items-center justify-center text-xs shadow-lg" title="PDF available">📄</span>
                        @endif
                    </div>

                    {{-- Progress overlay --}}
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent p-4 pt-8">
                        <div class="flex items-center justify-between text-white text-sm">
                            <span class="font-bold">{{ $campaign->formatted_collected }}</span>
                            <span class="font-semibold bg-white/20 backdrop-blur-sm px-2 py-0.5 rounded-full text-xs">{{ $campaign->progress_percentage }}%</span>
                        </div>
                        <div class="mt-1.5 h-1.5 bg-white/20 rounded-full overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-700 ease-out"
                                 style="width: {{ $campaign->progress_percentage }}%; background: {{ $campaign->progress_percentage >= 100 ? '#16a34a' : '#fff' }};">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Content --}}
                <div class="p-5">
                    <h3 class="text-lg font-bold text-gray-800 group-hover:text-[#2d6fa3] transition-colors">{{ $campaign->title }}</h3>
                    @if($campaign->description)
                    <p class="mt-2 text-sm text-gray-500 line-clamp-2 leading-relaxed">{{ Str::limit($campaign->description, 120) }}</p>
                    @endif
                    <div class="mt-4 pt-4 border-t border-gray-50 flex items-center justify-between text-xs">
                        <span class="text-gray-400">Goal: <strong class="text-gray-600 font-semibold">{{ $campaign->formatted_goal }}</strong></span>
                        @if($campaign->days_remaining !== null)
                        <span class="inline-flex items-center gap-1 {{ $campaign->days_remaining > 0 ? 'text-blue-600 font-medium' : 'text-gray-400' }}">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            {{ $campaign->days_remaining_label }}
                        </span>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @else
        {{-- Empty state --}}
        <div class="text-center py-24">
            <div class="w-24 h-24 mx-auto mb-6 rounded-full bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200 flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-700">No Active Campaigns</h3>
            <p class="text-gray-400 mt-2 max-w-md mx-auto">There are no active fundraising campaigns at the moment. Please check back soon!</p>
            <a href="{{ route('donate') }}" class="mt-8 inline-flex items-center gap-2 px-8 py-3.5 bg-[#2d6fa3] text-white font-semibold rounded-xl hover:bg-[#1d4e7a] transition-all shadow-sm hover:shadow-md hover:-translate-y-0.5">
                Make a General Donation
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
            </a>
        </div>
        @endif
    </div>
</section>

{{-- CTA Section --}}
<section class="bg-gradient-to-br from-[#1d4e7a] via-[#254e7a] to-[#2d6fa3] py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-[#8da83a] rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-black text-white">Your Donation Changes Lives</h2>
        <p class="mt-3 text-white/70 text-lg">100% of your contribution goes directly to supporting children in Cambodia.</p>
        <a href="{{ route('donate') }}" class="mt-8 inline-flex items-center gap-2 px-8 py-3.5 bg-white text-[#2d6fa3] font-bold rounded-xl hover:bg-gray-100 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
            Donate Now
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
        </a>
    </div>
</section>

<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endsection
