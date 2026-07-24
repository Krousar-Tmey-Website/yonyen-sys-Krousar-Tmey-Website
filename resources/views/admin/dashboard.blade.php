@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('breadcrumb', 'Welcome back, ' . auth()->user()->name)

@push('styles')
<style>
    .chart-container { position: relative; height: 220px; width: 100%; }
    .hover-lift { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .hover-lift:hover { transform: translateY(-3px); box-shadow: 0 16px 32px -10px rgba(0,0,0,0.12); }
    .fade-in-up { animation: fadeInUp 0.6s ease-out both; }
    .fade-in-up:nth-child(2) { animation-delay: 0.08s; }
    .fade-in-up:nth-child(3) { animation-delay: 0.16s; }
    .fade-in-up:nth-child(4) { animation-delay: 0.24s; }
    @keyframes fadeInUp { from { opacity: 0; transform: translateY(16px); } to { opacity: 1; transform: translateY(0); } }
</style>
@endpush

@section('content')

{{-- ── Stat Cards Row ── --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    @php
    $statCards = [
        ['label' => 'Total Articles', 'value' => $stats['news_total'], 'border' => 'border-l-[#2d6fa3]', 'route' => 'admin.news.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>'],
        ['label' => 'Programs',      'value' => $stats['programs'],       'border' => 'border-l-[#8da83a]', 'route' => 'admin.programs.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>'],
        ['label' => 'Projects',      'value' => $stats['projects'],       'border' => 'border-l-[#1d4e7a]', 'route' => 'admin.projects.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>'],
        ['label' => 'Donations',     'value' => $stats['donations'],      'border' => 'border-l-[#e8a020]', 'route' => 'admin.donations.index', 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'],
    ];
    @endphp

    @foreach($statCards as $card)
    <a href="{{ route($card['route']) }}"
       class="fade-in-up bg-white rounded-2xl p-4 border border-gray-100 {{ $card['border'] }} border-l-4 hover-lift relative group">
        <div class="flex items-start justify-between">
            <div>
                <div class="text-3xl font-black text-gray-800 mb-1 tracking-tight">{{ $card['value'] }}</div>
                <div class="text-gray-400 text-xs font-medium tracking-wide">{{ $card['label'] }}</div>
                @if($card['label'] === 'Donations')
                <div class="mt-2 inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-semibold">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    ${{ number_format($stats['donations_amount'], 0) }}
                </div>
                @endif
            </div>
            <div class="w-8 h-8 rounded-lg {{ str_replace('border-l-[', 'bg-[', $card['border']) }}/10 flex items-center justify-center flex-shrink-0">
                <svg class="w-4.5 h-4.5 {{ str_replace('border-l-', 'text-', $card['border']) }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    {!! $card['icon'] !!}
                </svg>
            </div>
        </div>
        <div class="mt-2 flex items-center gap-1 text-gray-300 text-xs group-hover:text-gray-500 transition-colors">
            <span>View details</span>
            <svg class="w-3 h-3 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </div>
    </a>
    @endforeach
</div>

{{-- ── Charts Row ── --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8 items-stretch">
        {{-- Donation Trends Chart --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 hover-lift h-full flex flex-col justify-center">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#e8a020] to-[#c4840a] flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800 text-sm">Donation Trends</h3>
                    <p class="text-xs text-gray-400">Monthly donation amounts</p>
                </div>
            </div>
            <div class="chart-container" style="height: 220px;">
                @if(!$chartData['donationMonths']->isEmpty())
                <canvas id="donationChart"></canvas>
                @else
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <svg class="w-12 h-12 text-gray-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-gray-400 text-sm font-medium">No donation data yet</p>
                    <p class="text-gray-300 text-xs mt-1">Donation trends will appear here once received.</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Partner Categories Chart --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 hover-lift h-full flex flex-col justify-center">
            <div class="flex items-start justify-between gap-4 mb-5">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#2d6fa3] to-[#1d4e7a] flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 text-sm">Partner Categories</h3>
                        <p class="text-xs text-gray-400">Distribution by category</p>
                    </div>
                </div>
                <span class="text-xs text-gray-400 bg-gray-50 px-3 py-1 rounded-full">{{ $chartData['partnerCategories']->sum() }} partners</span>
            </div>
            <div class="chart-container" style="height: 220px;">
                @if(!$chartData['partnerCategories']->isEmpty())
                <canvas id="categoryChart"></canvas>
                @else
                <div class="flex flex-col items-center justify-center h-full text-center">
                    <svg class="w-12 h-12 text-gray-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <p class="text-gray-400 text-sm font-medium">No partners yet</p>
                    <p class="text-gray-300 text-xs mt-1">Category distribution will appear once partners are added.</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Donation by Type --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 hover-lift h-full flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#8da83a] to-[#6b8828] flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-sm">Donation by Type</h3>
                            <p class="text-xs text-gray-400">Breakdown of donation categories</p>
                        </div>
                    </div>
                </div>
                <div class="chart-container" style="height: 180px;">
                    @if($chartData['donationByType']->isNotEmpty())
                    <canvas id="donationTypeChart"></canvas>
                    @else
                    <div class="flex flex-col items-center justify-center h-full text-center">
                        <p class="text-gray-400 text-sm font-medium">No donation types recorded</p>
                    </div>
                    @endif
                </div>
            </div>
            {{-- Type mini cards --}}
            <div class="grid grid-cols-3 gap-3 mt-5 pt-4 border-t border-gray-50">
                @php
                    $typeColors = [
                        'Food'   => ['bg' => 'bg-orange-50', 'text' => 'text-orange-700', 'dot' => 'bg-orange-500'],
                        'Money'  => ['bg' => 'bg-green-50', 'text' => 'text-green-700', 'dot' => 'bg-green-500'],
                        'Clothes'=> ['bg' => 'bg-blue-50', 'text' => 'text-blue-700', 'dot' => 'bg-blue-500'],
                    ];
                @endphp
                @foreach(['Food', 'Money', 'Clothes'] as $type)
                @php $tc = $typeColors[$type] ?? ['bg' => 'bg-gray-50', 'text' => 'text-gray-700', 'dot' => 'bg-gray-500']; @endphp
                <div class="text-center p-3 rounded-xl {{ $tc['bg'] }}">
                    <div class="flex items-center justify-center gap-1.5 mb-1">
                        <span class="w-2 h-2 rounded-full {{ $tc['dot'] }}"></span>
                        <span class="text-xs font-semibold {{ $tc['text'] }}">{{ $type }}</span>
                    </div>
                    <div class="text-lg font-bold text-gray-800">{{ $donationAmountStats[strtolower($type) . '_count'] ?? 0 }}</div>
                    <div class="text-xs {{ $tc['text'] }} font-medium">${{ number_format($donationAmountStats[strtolower($type) . '_total'] ?? 0, 0) }}</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Recent Donations --}}
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover-lift h-full flex flex-col">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#e8a020] to-[#c4840a] flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h2 class="font-bold text-gray-800 text-sm">Recent Donations</h2>
                </div>
                <a href="{{ route('admin.donations.index') }}" class="text-xs text-[#e8a020] hover:text-[#c4840a] font-medium transition-colors">View all</a>
            </div>
            <div class="flex-1 flex flex-col justify-center">
                @if($recentDonations->isEmpty())
                <div class="px-6 py-12 text-center">
                    <div class="w-12 h-12 mx-auto mb-3 rounded-xl bg-gray-50 border border-gray-100 flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-gray-400 text-sm">No donations yet</p>
                </div>
                @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Amount</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach($recentDonations as $donation)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-3">
                                    @php
                                        $typeStyle = match($donation->DonationType) {
                                            'Food' => 'bg-orange-50 text-orange-700',
                                            'Money' => 'bg-green-50 text-green-700',
                                            'Clothes' => 'bg-blue-50 text-blue-700',
                                            default => 'bg-gray-50 text-gray-600',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $typeStyle }}">
                                        {{ $donation->DonationType ?: '—' }}
                                    </span>
                                </td>
                                <td class="px-6 py-3 font-medium text-gray-700">
                                    ${{ number_format(($donation->DonationAmount ?? $donation->Amount ?? 0), 0) }}
                                </td>
                                <td class="px-6 py-3 text-gray-400 text-xs">
                                    {{ $donation->DonationDate ? \Carbon\Carbon::parse($donation->DonationDate)->format('d M Y') : '—' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
</div>

{{-- ── Bottom Section: Quick Stats + Recent Articles ── --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    {{-- Quick Stats Sidebar --}}
    <div class="lg:col-span-1 space-y-4">
        {{-- Stats Summary Card --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 hover-lift">
            <h3 class="font-bold text-gray-800 text-sm mb-4 flex items-center gap-2">
                <svg class="w-4 h-4 text-[#2d6fa3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Quick Overview
            </h3>
            <div class="space-y-3">
                @foreach([
                    ['label' => 'Published Articles', 'value' => $stats['news_published'], 'color' => 'text-green-600', 'bg' => 'bg-green-50'],
                    ['label' => 'Partners',           'value' => $stats['partners'],       'color' => 'text-[#2d6fa3]', 'bg' => 'bg-blue-50'],
                    ['label' => 'Awards',             'value' => $stats['awards'],         'color' => 'text-purple-600', 'bg' => 'bg-purple-50'],
                    ['label' => 'Additional Pages',   'value' => $stats['page_items'],     'color' => 'text-amber-600', 'bg' => 'bg-amber-50'],
                ] as $item)
                <div class="flex items-center justify-between p-3 rounded-xl {{ $item['bg'] }}">
                    <span class="text-xs font-medium text-gray-600">{{ $item['label'] }}</span>
                    <span class="text-sm font-bold {{ $item['color'] }}">{{ $item['value'] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Mini KPI Card --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 hover-lift">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400">Publication Rate</p>
                    <p class="text-lg font-bold text-gray-800">
                        {{ $stats['news_total'] > 0 ? round(($stats['news_published'] / $stats['news_total']) * 100) : 0 }}%
                    </p>
                </div>
            </div>
            <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-green-400 to-green-500 rounded-full transition-all duration-500"
                     style="width: {{ $stats['news_total'] > 0 ? ($stats['news_published'] / $stats['news_total']) * 100 : 0 }}%">
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-2">{{ $stats['news_published'] }} of {{ $stats['news_total'] }} articles published</p>
        </div>
    </div>

    {{-- Recent Articles Table (spans 2 columns) --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden hover-lift">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-[#2d6fa3] to-[#1d4e7a] flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <h2 class="font-bold text-gray-800">Recent Articles</h2>
                </div>
                <a href="{{ route('admin.news.create') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold px-4 py-2 rounded-xl bg-[#2d6fa3] text-white hover:bg-[#1a4a7a] transition-all hover-lift">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    New Article
                </a>
            </div>
            @if($recentNews->isEmpty())
            <div class="px-6 py-16 text-center">
                <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gray-50 border border-gray-100 flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <p class="text-gray-400 text-sm mb-2">No articles yet</p>
                <a href="{{ route('admin.news.create') }}" class="text-[#2d6fa3] underline text-sm font-medium">Create your first article.</a>
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Title</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($recentNews as $article)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center flex-shrink-0">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <span class="font-medium text-gray-700 max-w-xs truncate">{{ $article->title }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-[#2d6fa3]">
                                    {{ $article->category ?: 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold {{ $article->is_published ? 'bg-green-50 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $article->is_published ? 'bg-green-500' : 'bg-gray-400' }}"></span>
                                    {{ $article->is_published ? 'Published' : 'Draft' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-400 text-xs">{{ $article->created_at->format('d M Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Chart === 'undefined') return;

    // ── Donation Trends (Bar Chart) ──
    const donationCtx = document.getElementById('donationChart')?.getContext('2d');
    if (donationCtx) {
        new Chart(donationCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartData['donationMonths']) !!},
                datasets: [{
                    label: 'Donations ($)',
                    data: {!! json_encode($chartData['donationTotals']) !!},
                    backgroundColor: 'rgba(232, 160, 32, 0.6)',
                    borderColor: '#e8a020',
                    borderWidth: 2,
                    borderRadius: 6,
                    borderSkipped: false,
                    hoverBackgroundColor: '#e8a020',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(ctx) { return '$' + ctx.raw.toLocaleString(); }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: 100,
                        grid: { color: 'rgba(0,0,0,0.04)', drawBorder: false },
                        ticks: {
                            color: '#94a3b8',
                            font: { size: 11 },
                            precision: 0,
                            callback: function(value) { return '$' + value.toLocaleString(); }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#94a3b8', font: { size: 10 } }
                    }
                }
            }
        });
    }

    // ── Category Distribution (Doughnut Chart) ──
    const categoryCtx = document.getElementById('categoryChart')?.getContext('2d');
    if (categoryCtx) {
        const categoryLabels = {!! json_encode($chartData['partnerCategoryLabels']) !!};
        const categoryData = {!! json_encode($chartData['partnerCategories']) !!};
        const colors = ['#2d6fa3', '#8da83a', '#e8a020', '#1d4e7a', '#c4840a', '#4a7c59', '#6b7280', '#9ca3af'];

        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: categoryLabels,
                datasets: [{
                    data: categoryData,
                    backgroundColor: colors.slice(0, categoryLabels.length),
                    borderWidth: 0,
                    hoverOffset: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 16,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: { size: 11 },
                            color: '#64748b',
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        padding: 12,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(ctx) {
                                const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                const pct = total > 0 ? ((ctx.raw / total) * 100).toFixed(1) : 0;
                                return ctx.label + ': ' + ctx.raw + ' (' + pct + '%)';
                            }
                        }
                    }
                }
            }
        });
    }

    // ── Donation by Type (Pie Chart) ──
    const typeCtx = document.getElementById('donationTypeChart')?.getContext('2d');
    if (typeCtx) {
        const typeData = {!! json_encode($chartData['donationByType']->pluck('total')) !!};
        const typeLabels = {!! json_encode($chartData['donationByType']->pluck('DonationType')) !!};
        const typeColors = {
            'Food': '#f97316',
            'Money': '#22c55e',
            'Clothes': '#3b82f6',
        };
        const bgColors = typeLabels.map(l => typeColors[l] || '#94a3b8');

        new Chart(typeCtx, {
            type: 'doughnut',
            data: {
                labels: typeLabels,
                datasets: [{
                    data: typeData,
                    backgroundColor: bgColors,
                    borderWidth: 0,
                    hoverOffset: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '60%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 12,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: { size: 10 },
                            color: '#64748b',
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleColor: '#fff',
                        bodyColor: '#fff',
                        padding: 10,
                        cornerRadius: 8,
                        callbacks: {
                            label: function(ctx) {
                                const total = ctx.dataset.data.reduce((a, b) => a + b, 0);
                                const pct = total > 0 ? ((ctx.raw / total) * 100).toFixed(1) : 0;
                                return ctx.label + ': $' + ctx.raw.toLocaleString() + ' (' + pct + '%)';
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>
@endpush
