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
            ['label' => 'Total Donations', 'value' => number_format($totalDonations, 2) . ' $', 'color' => 'bg-[#2d6fa3]'],
            ['label' => 'Total Donors',    'value' => number_format($totalDonors),             'color' => 'bg-[#8da83a]'],
            ['label' => 'Avg. Donation',   'value' => number_format($avgDonation, 2) . ' $',   'color' => 'bg-[#1d4e7a]'],
            ['label' => 'Recurring Gifts', 'value' => $recurringCount . ' / ' . $totalCount,   'color' => 'bg-[#e8a020]'],
        ];
    @endphp
    @foreach($statCards as $i => $card)
    <div class="fade-in d{{ $i + 2 }}">
        <div class="bg-white rounded-2xl p-5 border border-gray-100 hover:shadow-md transition-shadow">
            <div class="text-xl font-bold text-gray-800 mb-1">{{ $card['value'] }}</div>
            <div class="text-gray-400 text-xs">{{ $card['label'] }}</div>
            <div class="h-1 {{ $card['color'] }} rounded-full mt-3 w-8"></div>
        </div>
    </div>
    @endforeach
</div>

{{-- Charts Row --}}
<div class="grid grid-cols-1 lg:grid-cols-5 gap-4 mb-8">

    {{-- Monthly Chart --}}
    <div class="lg:col-span-3 fade-in d4">
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
                <h2 class="font-bold text-gray-800 text-sm">Monthly Donations <span class="text-gray-400 font-normal">{{ now()->year }}</span></h2>
                <span class="text-xs text-gray-400 bg-gray-50 px-2.5 py-1 rounded-full font-medium">{{ $monthlyDonations->count() }} months</span>
            </div>
            <div class="p-5">
                <canvas id="monthlyChart" height="200"
                    data-months='@json($monthlyDonations->pluck('month'))'
                    data-totals='@json($monthlyDonations->pluck('total'))'
                    data-counts='@json($monthlyDonations->pluck('count'))'>
                </canvas>
            </div>
        </div>
    </div>

    {{-- Payment Methods --}}
    <div class="lg:col-span-2 fade-in d5">
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden h-full">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
                <h2 class="font-bold text-gray-800 text-sm">By Payment Method</h2>
                <span class="text-xs text-gray-400 bg-gray-50 px-2.5 py-1 rounded-full font-medium">{{ $byPaymentMethod->count() }} methods</span>
            </div>
            <div class="p-5">
                @if($byPaymentMethod->isEmpty())
                    <div class="text-center text-gray-400 text-sm py-10">No payment data yet.</div>
                @else
                    <div class="space-y-4">
                        @foreach($byPaymentMethod as $method)
                        @php
                            $pct = $totalDonations > 0 ? round(($method->total / $totalDonations) * 100, 1) : 0;
                            $barColors = ['bg-[#2d6fa3]', 'bg-[#8da83a]', 'bg-[#1d4e7a]', 'bg-[#e8a020]', 'bg-[#c0392b]', 'bg-[#8e44ad]'];
                            $color = $barColors[$loop->index % count($barColors)];
                        @endphp
                        <div>
                            <div class="flex items-center justify-between text-sm mb-1.5">
                                <span class="font-medium text-gray-700">{{ $method->PaymentMethod ?: 'Unknown' }}</span>
                                <div class="text-right">
                                    <span class="font-semibold text-gray-800">{{ number_format($method->total, 2) }} $</span>
                                    <span class="text-gray-400 text-xs ml-1">({{ $pct }}%)</span>
                                </div>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                                <div class="h-full rounded-full transition-all duration-700 ease-out {{ $color }}" style="width: {{ $pct }}%"></div>
                            </div>
                            <p class="text-xs text-gray-400 mt-1">{{ $method->count }} {{ Str::plural('donation', $method->count) }}</p>
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

    {{-- Currency Breakdown --}}
    <div class="fade-in d6">
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden h-full">
            <div class="px-6 py-4 border-b border-gray-50">
                <h2 class="font-bold text-gray-800 text-sm">Currency Breakdown</h2>
            </div>
            <div class="p-5">
                @if($byCurrency->isEmpty())
                    <div class="text-center text-gray-400 text-sm py-6">No currency data yet.</div>
                @else
                    <div class="space-y-1">
                        @foreach($byCurrency as $currency)
                        @php
                            $currencyPct = $totalDonations > 0 ? round(($currency->total / $totalDonations) * 100, 1) : 0;
                        @endphp
                        <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0">
                            <div>
                                <span class="text-sm font-semibold text-gray-800">{{ $currency->Currency ?: 'N/A' }}</span>
                                <span class="text-xs text-gray-400 ml-2">{{ $currency->count }} donations</span>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-bold text-gray-800">{{ number_format($currency->total, 2) }} $</p>
                                <div class="w-16 h-1.5 bg-gray-100 rounded-full mt-1 ml-auto overflow-hidden">
                                    <div class="h-full rounded-full {{ $currencyPct > 50 ? 'bg-[#2d6fa3]' : ($currencyPct > 20 ? 'bg-[#8da83a]' : 'bg-[#e8a020]') }}" style="width: {{ $currencyPct }}%"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Recent Donations --}}
    <div class="lg:col-span-2 fade-in d7">
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-50">
                <h2 class="font-bold text-gray-800 text-sm">Recent Donations</h2>
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
                            <th class="px-6 py-3 text-left">Action</th>
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
                            <td class="px-6 py-3.5">
                                <div class="flex items-center gap-2">
                                    <button type="button" class="action-icon-btn view" title="View donation">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                    <button type="button" class="action-icon-btn edit" title="Edit donation">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <button type="button" class="action-icon-btn delete" title="Delete donation">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
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
@vite(['resources/js/admin-donations.js'])
@endpush
