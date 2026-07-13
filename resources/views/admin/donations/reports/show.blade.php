@extends('admin.layouts.app')

@section('title', 'Donation Details')
@section('page-title', 'Donation Details')
@section('breadcrumb', 'View complete donation information')

@section('content')
    <div class="mx-auto max-w-4xl space-y-6">

        {{-- ── Header ─────────────────────────────── --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Donation #{{ $donation->DonationID }}</h2>
                <p class="mt-1 text-sm text-gray-500">Complete information about this donation record.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.donations.reports') }}"
                   class="rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                    Back to Reports
                </a>
                <a href="{{ route('admin.donations.reports.export.csv', request()->only(['start_date', 'end_date', 'payment_method'])) }}"
                   class="rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition inline-flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Export CSV
                </a>
            </div>
        </div>

        {{-- ── Donor Information ──────────────────── --}}
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            <div class="flex items-center gap-4 border-b border-gray-100 pb-4 mb-5">
                <div class="w-12 h-12 rounded-full bg-[#2d6fa3]/10 flex items-center justify-center flex-shrink-0">
                    <span class="text-sm font-bold text-[#2d6fa3]">
                        {{ strtoupper(substr($donation->donor?->full_name ?? '?', 0, 2)) }}
                    </span>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800">{{ $donation->donor?->full_name ?? 'Unknown Donor' }}</h3>
                    <p class="text-sm text-gray-500">Donor Information</p>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="rounded-2xl bg-gray-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Donor ID</p>
                    <p class="mt-2 text-sm font-medium text-gray-800">{{ $donation->donor?->DonorID ?? 'N/A' }}</p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Email Address</p>
                    <p class="mt-2 text-sm font-medium text-gray-800">{{ $donation->donor?->Email ?? 'N/A' }}</p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Phone Number</p>
                    <p class="mt-2 text-sm font-medium text-gray-800">{{ $donation->donor?->Phone ?? 'N/A' }}</p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Address</p>
                    <p class="mt-2 text-sm font-medium text-gray-800">{{ $donation->donor?->Address ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        {{-- ── Donation Details ───────────────────── --}}
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold text-gray-700 border-b border-gray-100 pb-3 mb-5">Donation Details</h3>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="rounded-2xl bg-gray-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Donation ID</p>
                    <p class="mt-2 text-sm font-semibold text-gray-800 font-mono">{{ $donation->DonationID }}</p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Donation Amount</p>
                    <p class="mt-2 text-2xl font-black text-gray-800">{{ $donation->formatted_amount }}</p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Donation Date</p>
                    <p class="mt-2 text-sm font-medium text-gray-800">
                        {{ $donation->DonationDate?->format('l, d F Y') ?? 'N/A' }}
                    </p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Payment Method</p>
                    <p class="mt-2">
                        <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium
                            {{ strtolower($donation->PaymentMethod) === 'aba' ? 'bg-blue-50 text-blue-700' : '' }}
                            {{ strtolower($donation->PaymentMethod) === 'acleda' ? 'bg-green-50 text-green-700' : '' }}
                            {{ !in_array(strtolower($donation->PaymentMethod), ['aba', 'acleda']) ? 'bg-gray-50 text-gray-600' : '' }}">
                            {{ $donation->payment_method_badge }}
                        </span>
                    </p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Currency</p>
                    <p class="mt-2 text-sm font-medium text-gray-800">{{ $donation->Currency ?? 'USD' }}</p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Amount (donation field)</p>
                    <p class="mt-2 text-sm font-medium text-gray-800">${{ number_format((float) ($donation->DonationAmount ?? 0), 2) }}</p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Transaction ID</p>
                    <p class="mt-2 text-sm font-medium text-gray-800 font-mono">{{ $donation->TransactionID ?? 'N/A' }}</p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Status</p>
                    <p class="mt-2">
                        @php
                            $statusColor = match(strtolower($donation->Status ?? 'completed')) {
                                'completed' => 'bg-green-50 text-green-700',
                                'pending'   => 'bg-amber-50 text-amber-700',
                                'failed'    => 'bg-red-50 text-red-700',
                                default     => 'bg-gray-50 text-gray-600',
                            };
                        @endphp
                        <span class="inline-flex px-3 py-1 rounded-full text-sm font-medium {{ $statusColor }}">
                            {{ $donation->status_badge }}
                        </span>
                    </p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Recurring</p>
                    <p class="mt-2">
                        @if($donation->IsRecurring)
                            <span class="inline-flex items-center gap-1 text-sm font-medium text-green-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Yes
                            </span>
                        @else
                            <span class="text-sm font-medium text-gray-500">No</span>
                        @endif
                    </p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Fiscal Residency</p>
                    <p class="mt-2 text-sm font-medium text-gray-800">{{ $donation->FiscalResidency ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        {{-- ── Additional Info ────────────────────── --}}
        <div class="rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
            <h3 class="text-sm font-semibold text-gray-700 border-b border-gray-100 pb-3 mb-5">Record Information</h3>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="rounded-2xl bg-gray-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Created At</p>
                    <p class="mt-2 text-sm font-medium text-gray-800">{{ $donation->created_at->format('d M Y, H:i:s') }}</p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Last Updated</p>
                    <p class="mt-2 text-sm font-medium text-gray-800">{{ $donation->updated_at->format('d M Y, H:i:s') }}</p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Tax Receipt Issued</p>
                    <p class="mt-2">
                        @if($donation->TaxReceiptIssued)
                            <span class="inline-flex items-center gap-1 text-sm font-medium text-green-700">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Yes
                            </span>
                        @else
                            <span class="text-sm font-medium text-gray-500">No</span>
                        @endif
                    </p>
                </div>
                <div class="rounded-2xl bg-gray-50 p-5">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Amount (recorded)</p>
                    <p class="mt-2 text-sm font-medium text-gray-800">{{ $donation->Amount ? '$' . number_format((float) $donation->Amount, 2) : 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
