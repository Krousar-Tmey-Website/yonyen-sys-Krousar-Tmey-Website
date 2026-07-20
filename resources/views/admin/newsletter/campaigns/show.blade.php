@extends('admin.layouts.app')

@php use Illuminate\Support\Str; @endphp

@section('title', $campaign->subject)
@section('page-title', 'Campaign Details')
@section('breadcrumb', 'Campaigns → ' . Str::limit($campaign->subject, 40))

@push('styles')
<style>
    .email-render h1, .email-render h2, .email-render h3 { color: #2d6fa3; margin-top: 1.2em; margin-bottom: 0.5em; }
    .email-render h1 { font-size: 1.3rem; }
    .email-render h2 { font-size: 1.1rem; }
    .email-render h3 { font-size: 1rem; }
    .email-render p { margin-bottom: 0.75rem; line-height: 1.7; }
    .email-render ul, .email-render ol { margin: 0.5rem 0 1rem 1.5rem; }
    .email-render li { margin-bottom: 0.3rem; }
    .email-render a { color: #2d6fa3; }
    .email-render img { max-width: 100%; border-radius: 6px; margin: 0.75rem 0; }
</style>
@endpush

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- Back link --}}
    <a href="{{ route('admin.newsletter.campaigns.index') }}"
       class="inline-flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors mb-5 group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Back to Campaigns
    </a>

    {{-- ──────── HERO / HEADER ──────── --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm mb-6 overflow-hidden">
        <div class="px-6 py-5 flex flex-col sm:flex-row sm:items-center gap-4">
            {{-- Icon --}}
            <div class="w-12 h-12 rounded-xl bg-[#2d6fa3] flex items-center justify-center flex-shrink-0 shadow-sm">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>

            {{-- Info --}}
            <div class="flex-1 min-w-0">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div>
                        <h1 class="text-xl font-bold text-gray-900 truncate">{{ $campaign->subject }}</h1>
                        <div class="mt-1.5 flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-gray-400">
                            <span class="inline-flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Created {{ $campaign->created_at->format('M j, Y \\a\\t g:i A') }}
                            </span>
                            @if($campaign->sent_at)
                                <span class="inline-flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Sent {{ $campaign->sent_at->format('M j, Y \\a\\t g:i A') }}
                                </span>
                            @endif
                        </div>
                    </div>
                    @php
                        $statusStyles = [
                            'draft'   => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                            'sending' => 'bg-blue-50 text-blue-700 border-blue-200',
                            'sent'    => 'bg-green-50 text-green-700 border-green-200',
                            'partial' => 'bg-orange-50 text-orange-700 border-orange-200',
                            'failed'  => 'bg-red-50 text-red-700 border-red-200',
                        ];
                        $statusIcons = [
                            'draft'   => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>',
                            'sending' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>',
                            'sent'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                            'partial' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>',
                            'failed'  => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>',
                        ];
                    @endphp
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-sm font-medium border {{ $statusStyles[$campaign->status] ?? 'bg-gray-100 text-gray-500' }}">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $statusIcons[$campaign->status] ?? '' !!}
                        </svg>
                        {{ ucfirst($campaign->status) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- ──────── MAIN GRID ──────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- ═══ Left Column: Content & Stats ═══ --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- ── Email Content Card ── --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50 flex items-center gap-2">
                    <div class="w-7 h-7 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-700">Email Content</span>
                    <span class="ml-auto">
                        <a href="{{ route('admin.newsletter.campaigns.preview', $campaign) }}" target="_blank"
                           class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium text-[#2d6fa3] bg-[#2d6fa3]/5 hover:bg-[#2d6fa3]/10 rounded-lg transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                            </svg>
                            Full Preview
                        </a>
                    </span>
                </div>
                <div class="p-6">
                    {{-- Email mockup --}}
                    <div class="border border-gray-100 rounded-xl overflow-hidden shadow-sm">
                        {{-- Email header --}}
                        <div class="bg-gradient-to-r from-[#2d6fa3] to-[#1d4e7a] px-8 py-6 text-center">
                            <h3 class="text-white font-bold text-lg leading-snug">{{ $campaign->subject }}</h3>
                        </div>
                        {{-- Email image --}}
                        @if($campaign->image)
                            <img src="{{ $campaign->image_url }}" alt="Newsletter image"
                                 class="w-full max-h-52 object-cover border-b border-gray-100">
                        @endif
                        {{-- Email body --}}
                        <div class="px-8 py-6 email-render text-sm text-gray-700 leading-relaxed">
                            {!! $campaign->content !!}
                        </div>
                        {{-- Email footer --}}
                        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 text-center">
                            <p class="text-xs text-gray-400">
                                <strong class="text-[#2d6fa3]">Krousar Thmey</strong> · Cambodia since 1991
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Sending Stats Card ── --}}
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-50 flex items-center gap-2">
                    <div class="w-7 h-7 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-gray-700">Delivery Statistics</span>
                    @if(in_array($campaign->status, ['sent', 'partial']))
                        @php $pct = $campaign->total_recipients > 0 ? round(($campaign->sent_count / $campaign->total_recipients) * 100) : 0; @endphp
                        <span class="ml-auto text-xs font-medium {{ $pct >= 90 ? 'text-green-600' : ($pct >= 50 ? 'text-orange-600' : 'text-red-600') }}">
                            {{ $pct }}% delivered
                        </span>
                    @endif
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-center p-5 bg-gray-50 rounded-xl">
                            <div class="w-8 h-8 mx-auto mb-2 rounded-lg bg-gray-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-gray-800">{{ $campaign->total_recipients ?: '—' }}</p>
                            <p class="text-xs text-gray-400 mt-1">Total Recipients</p>
                        </div>
                        <div class="text-center p-5 bg-green-50 rounded-xl">
                            <div class="w-8 h-8 mx-auto mb-2 rounded-lg bg-green-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-green-600">{{ $campaign->sent_count ?: '—' }}</p>
                            <p class="text-xs text-green-600 mt-1">Sent</p>
                        </div>
                        <div class="text-center p-5 bg-red-50 rounded-xl">
                            <div class="w-8 h-8 mx-auto mb-2 rounded-lg bg-red-100 flex items-center justify-center">
                                <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <p class="text-2xl font-bold text-red-500">{{ $campaign->failed_count ?: '—' }}</p>
                            <p class="text-xs text-red-500 mt-1">Failed</p>
                        </div>
                    </div>

                    {{-- Progress bar for sent campaigns --}}
                    @if(in_array($campaign->status, ['sent', 'partial']) && $campaign->total_recipients > 0)
                        <div class="mt-5 pt-5 border-t border-gray-100">
                            <div class="flex items-center gap-3">
                                <div class="flex-1 bg-gray-100 rounded-full h-2.5 overflow-hidden">
                                    <div class="bg-green-500 h-full rounded-full transition-all duration-700 ease-out"
                                         style="width: {{ $pct }}%"></div>
                                </div>
                                <span class="text-xs font-semibold text-gray-600 whitespace-nowrap min-w-[4rem] text-right">{{ $pct }}% delivered</span>
                            </div>
                            <div class="flex justify-between text-[10px] text-gray-400 mt-1">
                                <span>{{ $campaign->sent_count }} sent</span>
                                <span>{{ $campaign->failed_count }} failed</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ═══ Right Column: Actions ═══ --}}
        <div class="space-y-4">

            @if($campaign->isDraft())
                {{-- ── Send Card ── --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-50">
                        <h3 class="text-sm font-bold text-gray-800 flex items-center gap-2">
                            <span class="w-6 h-6 rounded-lg bg-[#2d6fa3]/10 flex items-center justify-center">
                                <svg class="w-3.5 h-3.5 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                            </span>
                            Send Newsletter
                        </h3>
                    </div>
                    <div class="p-5 space-y-3">
                        <p class="text-xs text-gray-500 leading-relaxed">
                            Send this newsletter to <strong class="text-gray-700">{{ \App\Models\NewsletterSubscriber::count() }}</strong> active subscribers.
                        </p>
                        <form action="{{ route('admin.newsletter.campaigns.send', $campaign) }}" method="POST"
                              onsubmit="return confirm('Send this newsletter to all subscribers?\n\nSubject: {{ $campaign->subject }}\n\nThis action cannot be undone.');">
                            @csrf
                            <button type="submit"
                                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-sm font-semibold bg-[#2d6fa3] text-white hover:bg-[#1d4e7a] active:scale-[0.98] transition-all shadow-sm hover:shadow-md">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                                Send Now
                            </button>
                        </form>
                    </div>
                </div>

                {{-- ── Edit & Delete ── --}}
                <a href="{{ route('admin.newsletter.campaigns.edit', $campaign) }}"
                   class="flex items-center justify-center gap-2 w-full px-4 py-3 rounded-xl text-sm font-medium bg-gray-50 text-gray-700 border border-gray-200 hover:bg-gray-100 hover:border-gray-300 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit Campaign
                </a>

                {{-- ── Danger Zone ── --}}
                <div class="bg-white rounded-2xl border border-red-200 overflow-hidden">
                    <div class="px-5 py-3.5 border-b border-red-100 bg-red-50/50">
                        <h3 class="text-xs font-bold text-red-700 flex items-center gap-1.5 uppercase tracking-wider">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                            </svg>
                            Danger Zone
                        </h3>
                    </div>
                    <div class="p-4">
                        <form action="{{ route('admin.newsletter.campaigns.destroy', $campaign) }}" method="POST"
                              onsubmit="return confirm('Delete this campaign draft permanently? This action cannot be undone.');">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-medium bg-red-50 text-red-600 hover:bg-red-100 active:scale-[0.98] transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete Campaign
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            {{-- ── Preview ── --}}
            <a href="{{ route('admin.newsletter.campaigns.preview', $campaign) }}" target="_blank"
               class="flex items-center justify-center gap-2 w-full px-4 py-3 rounded-xl text-sm font-medium bg-gray-50 text-gray-700 border border-gray-200 hover:bg-gray-100 hover:border-gray-300 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
                Preview as Email
            </a>

            {{-- Already sent notice --}}
            @if(!$campaign->isDraft())
                <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 text-center">
                    <div class="w-10 h-10 mx-auto mb-3 rounded-full bg-blue-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-blue-800">Already sent</p>
                    <p class="text-xs text-blue-600 mt-1">This campaign has been delivered. Editing and resending are not available.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
