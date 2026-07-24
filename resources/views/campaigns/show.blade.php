@extends('layouts.app')

@section('title', $campaign->title . ' — Krousar Thmey')
@section('description', Str::limit($campaign->description ?? 'Support our fundraising campaign.', 160))

@section('content')
{{-- Hero --}}
<section class="relative bg-gradient-to-br from-[#1d4e7a] via-[#254e7a] to-[#2d6fa3] py-20 md:py-28 overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-10 left-10 w-72 h-72 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-white rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-[#8da83a]/30 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('campaigns.public') }}" class="inline-flex items-center gap-2 text-white/60 hover:text-white transition-colors text-sm mb-8 group">
            <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
            Back to Campaigns
        </a>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
            <div>
                <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/10 text-white/80 text-xs font-semibold tracking-wider uppercase mb-4 backdrop-blur-sm border border-white/10">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    Fundraising Campaign
                </span>
                <h1 class="text-3xl md:text-5xl font-black text-white tracking-tight leading-tight">{{ $campaign->title }}</h1>
                @if($campaign->description)
                <p class="mt-4 text-white/70 text-lg leading-relaxed">{{ $campaign->description }}</p>
                @endif
            </div>
            @if($campaign->image_url)
            <div class="rounded-2xl overflow-hidden shadow-2xl ring-1 ring-white/10">
                <img src="{{ $campaign->image_url }}" alt="{{ $campaign->title }}" class="w-full h-64 md:h-80 object-cover">
            </div>
            @endif
        </div>
    </div>
</section>

{{-- Progress & Actions --}}
<section class="py-12 border-b border-gray-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-8">
            {{-- Stats Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-4 bg-gray-50/50 rounded-xl">
                    <div class="text-3xl font-black text-gray-800">{{ $campaign->formatted_goal }}</div>
                    <div class="text-sm text-gray-400 mt-1 font-medium">Campaign Goal</div>
                </div>
                <div class="text-center p-4 bg-emerald-50/50 rounded-xl">
                    <div class="text-3xl font-black text-emerald-600">{{ $campaign->formatted_collected }}</div>
                    <div class="text-sm text-emerald-500/70 mt-1 font-medium">Raised So Far</div>
                </div>
                <div class="text-center p-4 {{ $campaign->days_remaining !== null && $campaign->days_remaining > 0 ? 'bg-blue-50/50' : 'bg-gray-50/50' }} rounded-xl">
                    @if($campaign->days_remaining !== null)
                    <div class="text-3xl font-black {{ $campaign->days_remaining > 0 ? 'text-blue-600' : 'text-gray-400' }}">{{ $campaign->days_remaining }}</div>
                    <div class="text-sm {{ $campaign->days_remaining > 0 ? 'text-blue-500/70' : 'text-gray-400' }} mt-1 font-medium">{{ $campaign->days_remaining === 1 ? 'Day Remaining' : 'Days Remaining' }}</div>
                    @else
                    <div class="text-3xl font-black text-emerald-600">∞</div>
                    <div class="text-sm text-gray-400 mt-1 font-medium">Ongoing Campaign</div>
                    @endif
                </div>
            </div>

            {{-- Progress Bar --}}
            <div class="mt-6">
                <div class="flex items-center justify-between text-sm mb-2">
                    <span class="font-semibold text-gray-600">{{ $campaign->progress_percentage }}% funded</span>
                </div>
                <div class="h-4 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-1000 ease-out"
                         style="width: {{ $campaign->progress_percentage }}%; background: {{ $campaign->progress_percentage >= 100 ? '#16a34a' : '#2d6fa3' }};">
                    </div>
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="mt-6 flex flex-wrap gap-3 justify-center">
                <a href="{{ route('donate') }}" class="inline-flex items-center gap-2 px-8 py-3.5 bg-[#2d6fa3] text-white font-bold rounded-xl hover:bg-[#1d4e7a] transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    Donate to This Campaign
                </a>

                {{-- Share Buttons --}}
                @php
                    $shareUrl = url()->current();
                    $shareTitle = $campaign->title . ' — Krousar Thmey';
                    $shareDescription = Str::limit(strip_tags($campaign->description ?? 'Support our campaign'), 200);
                @endphp
                <button onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{ urlencode($shareUrl) }}', '_blank', 'width=600,height=400')"
                        class="inline-flex items-center gap-2 px-5 py-3.5 bg-blue-50 text-blue-600 font-semibold rounded-xl hover:bg-blue-100 transition-all border border-blue-100 hover:border-blue-200">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    Share
                </button>
                <button onclick="copyShareLink('{{ $shareUrl }}')"
                        class="inline-flex items-center gap-2 px-5 py-3.5 bg-gray-50 text-gray-600 font-semibold rounded-xl hover:bg-gray-100 transition-all border border-gray-100 hover:border-gray-200"
                        id="copyLinkBtn">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                    <span id="copyLabel">Copy Link</span>
                </button>

                @if($campaign->pdf_url)
                <a href="{{ $campaign->pdf_url }}" target="_blank" class="inline-flex items-center gap-2 px-5 py-3.5 bg-green-50 text-green-600 font-semibold rounded-xl hover:bg-green-100 transition-all border border-green-100">
                    <span>📄</span> Download PDF
                </a>
                @endif
            </div>

            {{-- Embedded Video Player --}}
            @if($campaign->has_youtube || $campaign->has_uploaded_video)
            <div class="mt-6 pt-6 border-t border-gray-100">
                <div class="mx-auto max-w-md">
                    @if($campaign->has_youtube)
                        <div class="relative pb-[56.25%] h-0 rounded-xl overflow-hidden bg-black shadow-md ring-1 ring-gray-200">
                            <iframe src="{{ $campaign->youtube_embed_url }}"
                                    class="absolute top-0 left-0 w-full h-full"
                                    title="{{ $campaign->title }} video"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                            </iframe>
                        </div>
                    @else
                        <video class="w-full rounded-xl overflow-hidden shadow-md ring-1 ring-gray-200" controls playsinline preload="metadata">
                            <source src="{{ $campaign->video_url }}" type="{{ $campaign->video_mime }}">
                            Your browser does not support the video tag.
                        </video>
                    @endif
                </div>
            </div>
            @endif

            {{-- Dates --}}
            @if($campaign->start_date || $campaign->end_date)
            <div class="mt-6 pt-4 border-t border-gray-100 text-center text-xs text-gray-400">
                <svg class="w-3.5 h-3.5 inline-block mr-1 -mt-0.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                @if($campaign->start_date)
                Started {{ $campaign->start_date->format('F d, Y') }}
                @endif
                @if($campaign->end_date)
                · Ends {{ $campaign->end_date->format('F d, Y') }}
                @endif
            </div>
            @endif
        </div>
    </div>
</section>

{{-- Related Campaigns --}}
@if(isset($relatedCampaigns) && $relatedCampaigns->count())
<section class="py-16 bg-gray-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl font-black text-gray-800">Other Campaigns</h2>
            <p class="text-gray-400 mt-2">Discover more ways to support our mission</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($relatedCampaigns as $related)
            <a href="{{ route('campaigns.public.show', $related) }}"
               class="group block bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden hover:-translate-y-1">
                <div class="relative h-40 bg-gray-100 overflow-hidden">
                    @if($related->image_url)
                    <img src="{{ $related->image_url }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-[#2d6fa3]/10 to-[#8da83a]/10 flex items-center justify-center">
                        <svg class="w-8 h-8 text-[#2d6fa3]/20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    @endif
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-3">
                        <div class="flex items-center justify-between text-white text-xs">
                            <span class="font-semibold">{{ $related->formatted_collected }}</span>
                            <span class="font-medium bg-white/20 backdrop-blur-sm px-2 py-0.5 rounded-full">{{ $related->progress_percentage }}%</span>
                        </div>
                        <div class="mt-1 h-1 bg-white/20 rounded-full overflow-hidden">
                            <div class="h-full rounded-full" style="width: {{ $related->progress_percentage }}%; background: #fff;"></div>
                        </div>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="text-sm font-bold text-gray-800 group-hover:text-[#2d6fa3] transition-colors">{{ $related->title }}</h3>
                    <div class="mt-2 flex items-center justify-between text-xs text-gray-400">
                        <span>Goal: <strong class="text-gray-600">{{ $related->formatted_goal }}</strong></span>
                        @if($related->days_remaining !== null)
                        <span class="{{ $related->days_remaining > 0 ? 'text-blue-500' : 'text-gray-400' }}">{{ $related->days_remaining_label }}</span>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- CTA Section --}}
<section class="bg-gradient-to-br from-[#1d4e7a] via-[#254e7a] to-[#2d6fa3] py-16 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-[#8da83a] rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-black text-white">Make a Difference Today</h2>
        <p class="mt-3 text-white/70 text-lg">100% of your contribution goes directly to supporting children in Cambodia.</p>
        <a href="{{ route('donate') }}" class="mt-8 inline-flex items-center gap-2 px-8 py-3.5 bg-white text-[#2d6fa3] font-bold rounded-xl hover:bg-gray-100 transition-all shadow-lg hover:shadow-xl hover:-translate-y-0.5">
            Donate Now
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
        </a>
    </div>
</section>

{{-- Sticky Mobile Donate Button --}}
<div class="fixed bottom-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm border-t border-gray-100 p-3 shadow-[0_-4px_20px_rgba(0,0,0,0.08)] md:hidden">
    <a href="{{ route('donate') }}" class="flex items-center justify-center gap-2 w-full py-3.5 bg-[#2d6fa3] text-white font-bold rounded-xl hover:bg-[#1d4e7a] transition-all shadow-md">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        Donate to This Campaign
    </a>
</div>

{{-- Padding for sticky mobile button --}}
<div class="h-[72px] md:hidden"></div>

<style>
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}
.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>

<script>
function copyShareLink(url) {
    navigator.clipboard.writeText(url).then(function() {
        var label = document.getElementById('copyLabel');
        var btn = document.getElementById('copyLinkBtn');
        label.textContent = 'Copied!';
        btn.classList.remove('bg-gray-50', 'text-gray-600', 'hover:bg-gray-100', 'border-gray-100', 'hover:border-gray-200');
        btn.classList.add('bg-emerald-50', 'text-emerald-600', 'border-emerald-200');
        setTimeout(function() {
            label.textContent = 'Copy Link';
            btn.classList.remove('bg-emerald-50', 'text-emerald-600', 'border-emerald-200');
            btn.classList.add('bg-gray-50', 'text-gray-600', 'hover:bg-gray-100', 'border-gray-100', 'hover:border-gray-200');
        }, 2000);
    }).catch(function() {
        // Fallback for older browsers
        var input = document.createElement('input');
        input.value = url;
        document.body.appendChild(input);
        input.select();
        document.execCommand('copy');
        document.body.removeChild(input);
        var label = document.getElementById('copyLabel');
        label.textContent = 'Copied!';
        setTimeout(function() { label.textContent = 'Copy Link'; }, 2000);
    });
}
</script>
@endsection
