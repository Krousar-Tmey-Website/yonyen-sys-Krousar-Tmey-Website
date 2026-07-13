@extends('admin.layouts.app')

@section('title', 'Donation Reports')
@section('page-title', 'Donation Reports')
@section('breadcrumb', 'Monitor, filter, and export donation records')

@section('content')
    <div class="space-y-6">

        {{-- ── Header ─────────────────────────────── ──}}
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Donation Summary</h2>
                <p class="text-sm text-gray-500">Overview of all donations received.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.donations.reports.export.csv', request()->query()) }}"
                   class="inline-flex items-center gap-2 rounded-xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Export CSV
                </a>
                <a href="{{ route('admin.donations.reports.export.excel', request()->query()) }}"
                   class="inline-flex items-center gap-2 rounded-xl bg-[#1d4e7a] px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-[#173e63] transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Export Excel
                </a>
            </div>
        </div>

        {{-- ── Stat Cards ──────────────────────────── --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([
                ['label' => 'Total Amount',   'value' => '$' . number_format($totalAmount, 2),    'color' => 'bg-[#2d6fa3]', 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['label' => 'Total Donations', 'value' => number_format($totalDonations),          'color' => 'bg-[#8da83a]', 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                ['label' => 'Total Donors',    'value' => number_format($totalDonors),             'color' => 'bg-[#1d4e7a]', 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
                ['label' => 'Payment Methods', 'value' => $paymentMethods->count(),                 'color' => 'bg-[#e8a020]', 'icon' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z'],
            ] as $card)
            <div class="bg-white rounded-2xl p-5 border border-gray-100 hover:shadow-md transition-shadow">
                <div class="flex items-start justify-between mb-2">
                    <div class="text-3xl font-black text-gray-800">{{ $card['value'] }}</div>
                    <div class="w-10 h-10 rounded-xl {{ str_replace('bg-', 'bg-', $card['color']) }}/10 flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 {{ str_replace('bg-', 'text-', $card['color']) }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $card['icon'] }}" />
                        </svg>
                    </div>
                </div>
                <div class="text-gray-400 text-xs">{{ $card['label'] }}</div>
                <div class="h-1 {{ $card['color'] }} rounded-full mt-3 w-8"></div>
            </div>
            @endforeach
        </div>

        {{-- ── Filters ─────────────────────────────── --}}
        <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-sm sm:p-6">                    <form method="GET" action="{{ route('admin.donations.reports') }}" class="flex flex-col gap-4 md:flex-row md:items-end md:gap-4">
                <div class="w-full md:w-48">
                    <label for="start_date" class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1.5">Start Date</label>
                    <input id="start_date" name="start_date" type="date" value="{{ $startDate }}"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#1d4e7a] focus:outline-none focus:ring-2 focus:ring-[#1d4e7a]/20">
                </div>
                <div class="w-full md:w-48">
                    <label for="end_date" class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1.5">End Date</label>
                    <input id="end_date" name="end_date" type="date" value="{{ $endDate }}"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#1d4e7a] focus:outline-none focus:ring-2 focus:ring-[#1d4e7a]/20">
                </div>
                <div class="w-full md:w-48">
                    <label for="payment_method" class="block text-xs font-semibold uppercase tracking-wide text-gray-500 mb-1.5">Payment Method</label>
                    <select id="payment_method" name="payment_method"
                            class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#1d4e7a] focus:outline-none focus:ring-2 focus:ring-[#1d4e7a]/20">
                        <option value="">All Methods</option>
                        @foreach($paymentMethods as $method)
                            <option value="{{ $method }}" {{ $paymentMethod === $method ? 'selected' : '' }}>
                                {{ ucfirst($method) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.donations.reports') }}" class="rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                        Reset
                    </a>
                    <button type="submit" class="rounded-xl bg-[#1d4e7a] px-4 py-2.5 text-sm font-semibold text-white hover:bg-[#173e63] transition">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        {{-- ── Recent Donations (unfiltered) ───────── --}}
        <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-sm sm:p-6">
            <h3 class="text-sm font-semibold text-gray-700 mb-3">Recent Donations</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
                @forelse($recentDonations as $rd)
                    <div class="rounded-xl bg-gray-50 p-3 border border-gray-100">
                        <p class="text-xs text-gray-400 truncate">{{ $rd->donor?->full_name ?? 'Unknown' }}</p>
                        <p class="text-sm font-bold text-gray-800 mt-0.5">{{ $rd->formatted_amount }}</p>
                        <div class="flex items-center justify-between mt-1">
                            <span class="text-[10px] px-1.5 py-0.5 rounded-full bg-blue-50 text-blue-700 font-medium">{{ $rd->payment_method_badge }}</span>
                            <span class="text-[10px] text-gray-400">{{ $rd->DonationDate?->format('d M') }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center text-sm text-gray-400 py-4">No donations recorded yet.</div>
                @endforelse
            </div>
        </div>

        {{-- ── Donations Table ─────────────────────── --}}
        <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Donor</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Amount</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Payment Method</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Date</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Transaction ID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Status</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold uppercase tracking-wide text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($donations as $donation)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                                            <span class="text-xs font-bold text-[#2d6fa3]">
                                                {{ strtoupper(substr($donation->donor?->full_name ?? '?', 0, 2)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-gray-800">{{ $donation->donor?->full_name ?? 'Unknown' }}</p>
                                            <p class="text-xs text-gray-400">{{ $donation->donor?->Email ?? '' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="text-sm font-semibold text-gray-800">{{ $donation->formatted_amount }}</span>
                                </td>
                                <td class="px-4 py-4">
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium
                                        {{ strtolower($donation->PaymentMethod) === 'aba' ? 'bg-blue-50 text-blue-700' : '' }}
                                        {{ strtolower($donation->PaymentMethod) === 'acleda' ? 'bg-green-50 text-green-700' : '' }}
                                        {{ !in_array(strtolower($donation->PaymentMethod), ['aba', 'acleda']) ? 'bg-gray-50 text-gray-600' : '' }}">
                                        {{ $donation->payment_method_badge }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-sm text-gray-600">
                                    {{ $donation->DonationDate?->format('d M Y') ?? '—' }}
                                </td>
                                <td class="px-4 py-4">
                                    <span class="text-sm text-gray-500 font-mono text-xs">
                                        {{ $donation->TransactionID ?? '—' }}
                                    </span>
                                </td>
                                <td class="px-4 py-4">
                                    @php
                                        $statusColor = match(strtolower($donation->Status ?? 'completed')) {
                                            'completed' => 'bg-green-50 text-green-700',
                                            'pending'   => 'bg-amber-50 text-amber-700',
                                            'failed'    => 'bg-red-50 text-red-700',
                                            default     => 'bg-gray-50 text-gray-600',
                                        };
                                    @endphp
                                    <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium {{ $statusColor }}">
                                        {{ $donation->status_badge }}
                                    </span>
                                </td>
                                <td class="px-4 py-4 text-right">
                                    <a href="{{ route('admin.donations.reports.show', $donation) }}"
                                       class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-blue-200 text-blue-700 hover:bg-blue-50 transition"
                                       title="View donation details">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-12 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p class="text-sm text-gray-400">No donations found matching your filters.</p>
                                        <a href="{{ route('admin.donations.reports') }}" class="text-xs text-[#2d6fa3] hover:underline">Reset filters</a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($donations->hasPages())
                <div class="border-t border-gray-100 px-4 py-4">
                    {{ $donations->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
