@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin-donations.css'])
@endpush

@section('title', 'Donation Dashboard')
@section('page-title', 'Donation Dashboard')
@section('breadcrumb', 'Monitor donation statistics and fundraising performance')

@section('content')

{{-- Stat cards --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    @php
        $statCards = [
            [
                'label' => 'Total Donations',
                'value' => '$' . number_format($totalDonations, 2),
                'border' => 'border-l-[#2d6fa3]',
                'iconBg' => 'bg-[#2d6fa3]/10',
                'iconColor' => 'text-[#2d6fa3]',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>'
            ],
            [
                'label' => 'Total Donors',
                'value' => number_format($totalDonors),
                'border' => 'border-l-[#8da83a]',
                'iconBg' => 'bg-[#8da83a]/10',
                'iconColor' => 'text-[#8da83a]',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>'
            ],
            [
                'label' => 'Avg. Donation',
                'value' => '$' . number_format($avgDonation, 2),
                'border' => 'border-l-[#1d4e7a]',
                'iconBg' => 'bg-[#1d4e7a]/10',
                'iconColor' => 'text-[#1d4e7a]',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>'
            ],
            [
                'label' => 'In-Kind Gifts',
                'value' => $nonMoneyCount . ' / ' . $totalCount,
                'border' => 'border-l-[#e8a020]',
                'iconBg' => 'bg-[#e8a020]/10',
                'iconColor' => 'text-[#e8a020]',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>'
            ]
        ];
    @endphp
    @foreach($statCards as $i => $card)
    <div class="fade-in d{{ $i + 2 }}">
        <div class="bg-white rounded-2xl p-4 border border-gray-100 {{ $card['border'] }} border-l-4 hover-lift shadow-sm hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-gray-400 text-xs font-medium tracking-wide mb-1">{{ $card['label'] }}</div>
                    <div class="text-lg font-bold text-gray-800 tracking-tight">{{ $card['value'] }}</div>
                </div>
                <div class="w-8 h-8 rounded-lg {{ $card['iconBg'] }} flex items-center justify-center flex-shrink-0">
                    <svg class="w-4.5 h-4.5 {{ $card['iconColor'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        {!! $card['icon'] !!}
                    </svg>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Charts Row --}}
<div class="grid grid-cols-1 lg:grid-cols-5 gap-4 mb-8">

    {{-- Monthly Chart --}}
    <div class="lg:col-span-3 fade-in d4">
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-3 border-b border-gray-50">
                <h2 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                    <span class="w-6 h-6 rounded-lg bg-blue-50 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </span>
                    Monthly Donations
                </h2>
                <div class="flex items-center gap-2">
                    <select onchange="location.href = '{{ route('admin.donations.dashboard') }}?year=' + this.value"
                            class="text-xs text-gray-600 bg-gray-50 border border-gray-100 px-2.5 py-1 rounded-full font-medium focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 cursor-pointer">
                        @foreach($availableYears as $y)
                        <option value="{{ $y }}" {{ (int) $year === $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                    <span class="text-xs text-gray-400 bg-gray-50 px-2.5 py-1 rounded-full font-medium">{{ count($donationMonths) }} months</span>
                </div>
            </div>
            <div class="p-4">
                <div class="relative h-[280px]">
                    <canvas id="monthlyChart"
                        data-months='@json($donationMonths)'
                        data-totals='@json($donationTotals)'
                        data-counts='@json($donationCounts)'>
                    </canvas>
                </div>
            </div>
        </div>
    </div>

    {{-- Payment Methods --}}
    <div class="lg:col-span-2 fade-in d5">
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden h-full">
            <div class="flex items-center justify-between px-5 py-3 border-b border-gray-50">
                <h2 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                    <span class="w-6 h-6 rounded-lg bg-green-50 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </span>
                    By Payment Method
                </h2>
                <span class="text-xs text-gray-400 bg-gray-50 px-2.5 py-1 rounded-full font-medium">{{ $byPaymentMethod->count() }} methods</span>
            </div>
            <div class="p-4">
                @if($byPaymentMethod->isEmpty())
                    <div class="text-center text-gray-400 text-sm py-10">No payment data yet.</div>
                @else
                    <div class="space-y-3">
                        @foreach($byPaymentMethod as $method)
                        @php
                            $pct = $totalDonations > 0 ? round(($method->total / $totalDonations) * 100, 1) : 0;
                            $barColors = ['bg-[#2d6fa3]', 'bg-[#8da83a]', 'bg-[#1d4e7a]', 'bg-[#e8a020]', 'bg-[#c0392b]', 'bg-[#8e44ad]'];
                            $color = $barColors[$loop->index % count($barColors)];
                        @endphp
                        <div>
                            <div class="flex items-center justify-between text-sm mb-1">
                                <span class="font-medium text-gray-700 text-xs">{{ $method->PaymentMethod ?: 'Unknown' }}</span>
                                <div class="text-right">
                                    <span class="font-semibold text-gray-800 text-xs">{{ number_format($method->total, 2) }} $</span>
                                    <span class="text-gray-400 text-[10px] ml-1">({{ $pct }}%)</span>
                                </div>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-1.5 overflow-hidden">
                                <div class="h-full rounded-full transition-all duration-700 ease-out {{ $color }}" style="width: {{ $pct }}%"></div>
                            </div>
                            <p class="text-[10px] text-gray-400 mt-0.5">{{ $method->count }} {{ Str::plural('donation', $method->count) }}</p>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Second Row --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-8">

    {{-- Donation Type Breakdown --}}
    <div class="fade-in d6">
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden h-full">
            <div class="px-5 py-3 border-b border-gray-50">
                <h2 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                    <span class="w-6 h-6 rounded-lg bg-orange-50 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/></svg>
                    </span>
                    Donation Types
                </h2>
            </div>
            <div class="p-4 flex items-center justify-center">
                @if($byType->isEmpty())
                    <div class="text-center text-gray-400 text-sm py-6">No donation type data yet.</div>
                @else
                    <div class="relative w-full h-[150px] flex items-center justify-center">
                        <canvas id="typeChart"
                            data-labels='@json($byType->pluck('DonationType'))'
                            data-totals='@json($byType->pluck('count'))'>
                        </canvas>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Recent Donations --}}
    <div class="lg:col-span-2 fade-in d7">
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-3 border-b border-gray-50">
                <h2 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                    <span class="w-6 h-6 rounded-lg bg-purple-50 flex items-center justify-center">
                        <svg class="w-3.5 h-3.5 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </span>
                    Recent Donations
                </h2>
                @if($recentDonations->isNotEmpty())
                <span class="text-xs text-gray-400 bg-gray-50 px-2.5 py-1 rounded-full font-medium">Last 20</span>
                @endif
            </div>
            @if($recentDonations->isEmpty())
            <div class="px-6 py-12 text-center text-gray-400 text-sm">
                No donations recorded yet.
            </div>
            @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 text-xs text-gray-500 uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">Donor</th>
                            <th class="px-6 py-3 text-left">Amount</th>
                            <th class="px-6 py-3 text-left">Method</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($recentDonations as $donation)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 text-xs font-bold flex-shrink-0">
                                        {{ strtoupper(substr($donation->donor?->full_name ?? '?', 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-medium text-gray-700 text-sm truncate max-w-[150px]">{{ $donation->donor?->full_name ?? 'Anonymous' }}</p>
                                        @if($donation->donor?->Email)
                                        <p class="text-xs text-gray-400 truncate max-w-[150px]">{{ $donation->donor->Email }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-3.5">
                                <span class="font-semibold text-gray-900">{{ number_format($donation->effective_amount, 2) }} $</span>
                            </td>
                            <td class="px-6 py-3.5">
                                <span class="text-sm text-gray-500">{{ $donation->PaymentMethod ?: '—' }}</span>
                            </td>
                            <td class="px-6 py-3.5">
                                @php
                                    $status = $donation->Status ?? 'Completed';
                                    $ss = [
                                        'Completed' => 'bg-green-50 text-green-600',
                                        'Pending'   => 'bg-yellow-50 text-yellow-600',
                                        'Failed'    => 'bg-red-50 text-red-600',
                                        'Refunded'  => 'bg-purple-50 text-purple-600',
                                    ];
                                    $sStyle = $ss[$status] ?? 'bg-gray-100 text-gray-500';
                                @endphp
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-medium {{ $sStyle }}">
                                    {{ $status }}
                                </span>
                            </td>
                            <td class="px-6 py-3.5 text-xs text-gray-400 whitespace-nowrap">
                                {{ $donation->DonationDate ? $donation->DonationDate->format('d M Y') : '—' }}
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

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const typeCanvas = document.getElementById('typeChart');
    if (typeCanvas) {
        const typeLabels = JSON.parse(typeCanvas.dataset.labels);
        const typeTotals = JSON.parse(typeCanvas.dataset.totals);
        new Chart(typeCanvas, {
            type: 'doughnut',
            data: {
                labels: typeLabels,
                datasets: [{
                    data: typeTotals,
                    backgroundColor: [
                        'rgba(45, 111, 163, 0.8)',
                        'rgba(141, 168, 58, 0.8)',
                        'rgba(232, 160, 32, 0.8)',
                        'rgba(29, 78, 122, 0.8)',
                        'rgba(192, 57, 43, 0.8)',
                        'rgba(142, 68, 173, 0.8)'
                    ],
                    borderColor: '#ffffff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 10,
                            font: { size: 10 }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1e293b',
                        titleFont: { size: 12 },
                        bodyFont: { size: 11 },
                        padding: 8,
                        cornerRadius: 6,
                        callbacks: {
                            label: function(context) {
                                return ` ${context.label}: ${context.raw} donation(s)`;
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>
@vite(['resources/js/admin-donations.js'])
@endpush
