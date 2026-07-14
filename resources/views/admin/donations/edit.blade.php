@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
    @include('admin.donations._card-styles')
@endpush

@php use Illuminate\Support\Str; @endphp

@section('title', 'Edit Donation')
@section('page-title', 'Edit Donation')
@section('breadcrumb', 'Donations → ' . Str::limit($donation->donor?->full_name ?? 'Edit', 40))

@section('content')

<div class="max-w-3xl mx-auto">
    <form action="{{ route('admin.donations.update', $donation) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="donate-create-card">
            <div class="card-accent"></div>

            {{-- Header --}}
            <div class="px-9 pt-7 pb-0">
                <div class="flex items-center gap-3 mb-1">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#2d6fa3] to-[#4a90c4] flex items-center justify-center shadow-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-800">Edit Donation</h2>
                        <p class="text-xs text-gray-400">Update the donation record below</p>
                    </div>
                </div>
            </div>

            {{-- Form Body --}}
            <div class="card-body-inner">

                {{-- Donor Section --}}
                <div class="field-section">
                    <div class="section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Donor Information
                    </div>
                    <div class="donate-field">
                        <label class="field-label">Donor Name <span class="required-star">*</span></label>
                        <input type="text" name="DonorName" value="{{ old('DonorName', $donation->donor?->full_name ?? '') }}" required
                               class="field-input @error('DonorName') error @enderror"
                               placeholder="e.g. John Smith">
                        @error('DonorName')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- Donation Section --}}
                <div class="field-section">
                    <div class="section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Donation Details
                    </div>
                    <div class="donate-grid-2">
                        <div class="donate-field">
                            <label class="field-label">Amount <span class="required-star">*</span></label>
                            <div class="amount-wrapper">
                                <span class="dollar-sign">$</span>
                                <input type="number" name="DonationAmount"
                                       value="{{ old('DonationAmount', $donation->DonationAmount ?? $donation->Amount ?? '') }}" required step="0.01" min="0"
                                       class="field-input @error('DonationAmount') error @enderror"
                                       placeholder="0.00">
                            </div>
                            @error('DonationAmount')<div class="field-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="donate-field">
                            <label class="field-label">Donation Type <span class="required-star">*</span></label>
                            <select name="DonationType" required class="field-input @error('DonationType') error @enderror">
                                <option value="">— Select type —</option>
                                <option value="Money" {{ old('DonationType', $donation->DonationType) === 'Money' ? 'selected' : '' }}>💰 Money</option>
                                <option value="Clothes" {{ old('DonationType', $donation->DonationType) === 'Clothes' ? 'selected' : '' }}>👕 Clothes</option>
                                <option value="Food" {{ old('DonationType', $donation->DonationType) === 'Food' ? 'selected' : '' }}>🍲 Food</option>
                                <option value="Books" {{ old('DonationType', $donation->DonationType) === 'Books' ? 'selected' : '' }}>📚 Books</option>
                            </select>
                            @error('DonationType')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="donate-grid-2" style="margin-top: 20px;">
                        <div class="donate-field">
                            <label class="field-label">Payment Method <span class="required-star">*</span></label>
                            <select name="PaymentMethod" required class="field-input @error('PaymentMethod') error @enderror">
                                <option value="">— Select method —</option>
                                <option value="Cash" {{ old('PaymentMethod', $donation->PaymentMethod) === 'Cash' ? 'selected' : '' }}>💵 Cash</option>
                                <option value="Bank Transfer" {{ old('PaymentMethod', $donation->PaymentMethod) === 'Bank Transfer' ? 'selected' : '' }}>🏦 Bank Transfer</option>
                                <option value="QR Code" {{ old('PaymentMethod', $donation->PaymentMethod) === 'QR Code' ? 'selected' : '' }}>📱 QR Code</option>
                            </select>
                            @error('PaymentMethod')<div class="field-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="donate-field">
                            <label class="field-label">Donation Date <span class="required-star">*</span></label>
                            <input type="date" name="DonationDate"
                                   value="{{ old('DonationDate', $donation->DonationDate ? $donation->DonationDate->format('Y-m-d') : date('Y-m-d')) }}" required
                                   class="field-input @error('DonationDate') error @enderror">
                            @error('DonationDate')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                {{-- Status Section --}}
                <div class="field-section">
                    <div class="section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Status
                    </div>
                    <div class="donate-field">
                        <label class="field-label">Donation Status <span class="required-star">*</span></label>
                        <div class="donate-grid-4">
                            @php $currentStatus = old('Status', $donation->Status ?? 'Completed'); @endphp
                            <label class="status-option {{ $currentStatus === 'Completed' ? 'active' : '' }}">
                                <input type="radio" name="Status" value="Completed" {{ $currentStatus === 'Completed' ? 'checked' : '' }}>
                                <span class="status-dot completed"></span>
                                <span class="status-label">Completed</span>
                            </label>
                            <label class="status-option {{ $currentStatus === 'Pending' ? 'active' : '' }}">
                                <input type="radio" name="Status" value="Pending" {{ $currentStatus === 'Pending' ? 'checked' : '' }}>
                                <span class="status-dot pending"></span>
                                <span class="status-label">Pending</span>
                            </label>
                            <label class="status-option {{ $currentStatus === 'Failed' ? 'active' : '' }}">
                                <input type="radio" name="Status" value="Failed" {{ $currentStatus === 'Failed' ? 'checked' : '' }}>
                                <span class="status-dot failed"></span>
                                <span class="status-label">Failed</span>
                            </label>
                            <label class="status-option {{ $currentStatus === 'Refunded' ? 'active' : '' }}">
                                <input type="radio" name="Status" value="Refunded" {{ $currentStatus === 'Refunded' ? 'checked' : '' }}>
                                <span class="status-dot refunded"></span>
                                <span class="status-label">Refunded</span>
                            </label>
                        </div>
                        @error('Status')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                </div>

            </div>

            {{-- Actions --}}
            <div class="donate-actions-bar">
                <div class="left-actions">
                    <button type="submit" class="btn-record">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                        </svg>
                        Update Donation
                    </button>
                    <a href="{{ route('admin.donations.index') }}" class="btn-cancel-create">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </a>
                </div>
                <div class="flex items-center gap-4">
                    <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST" class="inline"
                          onsubmit="return confirm('Delete this donation record? This cannot be undone.')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-500 hover:text-red-700 hover:bg-red-50 px-3 py-1.5 rounded-lg transition-colors font-medium">
                            Delete
                        </button>
                    </form>
                    <span class="text-xs text-gray-400">ID: {{ $donation->DonationID }}</span>
                </div>
            </div>
        </div>
    </form>
</div>



<script>
document.querySelectorAll('.status-option').forEach(el => {
    el.addEventListener('click', function() {
        document.querySelectorAll('.status-option').forEach(e => e.classList.remove('active'));
        this.classList.add('active');
        this.querySelector('input').checked = true;
    });
});

// Toggle Amount & PaymentMethod required based on DonationType
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.querySelector('select[name="DonationType"]');
    const amountInput = document.querySelector('input[name="DonationAmount"]');
    const payMethodSelect = document.querySelector('select[name="PaymentMethod"]');

    function toggleRequiredFields() {
        const isMoney = typeSelect.value === 'Money';

        // Toggle Amount
        const amountStar = amountInput.closest('.donate-field').querySelector('.field-label .required-star');
        amountInput.required = isMoney;
        if (amountStar) amountStar.style.display = isMoney ? 'inline' : 'none';

        // Toggle Payment Method
        const payStar = payMethodSelect.closest('.donate-field').querySelector('.field-label .required-star');
        payMethodSelect.required = isMoney;
        if (payStar) payStar.style.display = isMoney ? 'inline' : 'none';
        // Clear validation error when field becomes not required
        if (!isMoney && payMethodSelect.value === '') {
            payMethodSelect.classList.remove('error');
        }
    }

    if (typeSelect) {
        typeSelect.addEventListener('change', toggleRequiredFields);
        toggleRequiredFields();
    }
});
</script>

@endsection
