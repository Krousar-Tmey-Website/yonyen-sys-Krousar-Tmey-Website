@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
@endpush

@php use Illuminate\Support\Str; @endphp

@section('title', 'Donation Details')
@section('page-title', 'Donation Details')
@section('breadcrumb', 'Donations → ' . $donation->DonationID)

@section('content')

<div class="form-container">

    {{-- Donation Information --}}
    <div class="form-card">
        <div class="card-header">
            <div class="icon blue">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3>Donation Details</h3>
            <span class="badge">ID: {{ $donation->DonationID }}</span>
        </div>
        <div class="card-body">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                {{-- Donor Info --}}
                <div>
                    <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Donor</h4>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-sky-100 flex items-center justify-center text-sky-600 text-sm font-bold flex-shrink-0">
                            {{ strtoupper(substr($donation->donor?->full_name ?? '?', 0, 1)) }}
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800">{{ $donation->donor?->full_name ?? 'Anonymous' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Amount & Type --}}
                <div>
                    <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Amount &amp; Type</h4>
                    <p class="text-2xl font-black text-gray-800">${{ number_format($donation->effective_amount, 2) }}</p>
                    @if($donation->DonationType)
                    <p class="text-xs text-gray-500 mt-1">{{ $donation->DonationType }}</p>
                    @endif
                </div>

                {{-- Payment Info --}}
                <div>
                    <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Payment</h4>
                    <p class="text-sm text-gray-700">Method: <span class="font-medium">{{ $donation->PaymentMethod ?: '—' }}</span></p>
                    <p class="text-sm text-gray-700 mt-1">Status:
                        @php
                            $status = $donation->Status ?? 'Completed';
                            $ss = [
                                'Completed' => 'text-emerald-600 bg-emerald-50',
                                'Pending'   => 'text-amber-600 bg-amber-50',
                                'Failed'    => 'text-red-600 bg-red-50',
                                'Refunded'  => 'text-purple-600 bg-purple-50',
                            ];
                            $sStyle = $ss[$status] ?? 'text-gray-600 bg-gray-50';
                        @endphp
                        <span class="text-xs font-semibold px-2 py-0.5 rounded-full {{ $sStyle }}">{{ $status }}</span>
                    </p>
                </div>

                {{-- Date --}}
                <div>
                    <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Donation Date</h4>
                    <p class="text-sm font-medium text-gray-800">{{ $donation->DonationDate ? $donation->DonationDate->format('d M Y') : '—' }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Actions --}}
    <div class="form-actions">
        <a href="{{ route('admin.donations.edit', $donation) }}" class="btn-primary">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
            </svg>
            Edit Donation
        </a>
        <a href="{{ route('admin.donations.index') }}" class="btn-cancel">Back to List</a>
        <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST" class="inline" style="margin-left: auto;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger" onclick="return confirm('Delete this donation record? This cannot be undone.')">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Delete
            </button>
        </form>
    </div>
</div>

@endsection
