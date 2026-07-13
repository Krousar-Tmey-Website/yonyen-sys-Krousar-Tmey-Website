@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
    @include('admin.donations._card-styles')
@endpush

@section('title', 'Record a Donation')
@section('page-title', 'Record a Donation')
@section('breadcrumb', 'Donations → Record a new donation')

@section('content')

<div class="max-w-3xl mx-auto">
    <form action="{{ route('admin.donations.store') }}" method="POST">
        @csrf

        <div class="donate-create-card">
            {{-- Accent bar --}}
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
                        <h2 class="text-lg font-bold text-gray-800">New Donation</h2>
                        <p class="text-xs text-gray-400">Fill in the details below to record a donation</p>
                    </div>
                </div>
            </div>

            <div class="card-body-inner">

                {{-- ── Donor Section ── --}}
                <div class="field-section">
                    <div class="section-title">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Donor Information
                    </div>
                    <div class="donate-field">
                        <label class="field-label">Donor Name <span class="required-star">*</span></label>
                        <input type="text" name="DonorName" value="{{ old('DonorName', '') }}" required
                               class="field-input @error('DonorName') error @enderror"
                               placeholder="e.g. John Smith">
                        @error('DonorName')<div class="field-error">{{ $message }}</div>@enderror
                    </div>
                </div>

                {{-- ── Donation Section ── --}}
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
                                <input type="number" name="DonationAmount" value="{{ old('DonationAmount', '') }}" required step="0.01" min="0"
                                       class="field-input @error('DonationAmount') error @enderror"
                                       placeholder="0.00">
                            </div>
                            @error('DonationAmount')<div class="field-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="donate-field">
                            <label class="field-label">Donation Type <span class="required-star">*</span></label>
                            <select name="DonationType" required class="field-input @error('DonationType') error @enderror">
                                <option value="">— Select type —</option>
                                <option value="Money" {{ old('DonationType') === 'Money' ? 'selected' : '' }}>Money</option>
                                <option value="Clothes" {{ old('DonationType') === 'Clothes' ? 'selected' : '' }}>Clothes</option>
                                <option value="Food" {{ old('DonationType') === 'Food' ? 'selected' : '' }}>Food</option>
                                <option value="Books" {{ old('DonationType') === 'Books' ? 'selected' : '' }}>Books</option>
                            </select>
                            @error('DonationType')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="donate-grid-2" style="margin-top: 20px;">
                        <div class="donate-field">
                            <label class="field-label">Payment Method <span class="required-star">*</span></label>
                            <select name="PaymentMethod" required class="field-input @error('PaymentMethod') error @enderror">
                                <option value="">— Select method —</option>
                                <option value="Cash" {{ old('PaymentMethod') === 'Cash' ? 'selected' : '' }}>Cash</option>
                                <option value="Bank Transfer" {{ old('PaymentMethod') === 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                <option value="QR Code" {{ old('PaymentMethod') === 'QR Code' ? 'selected' : '' }}>QR Code</option>
                            </select>
                            @error('PaymentMethod')<div class="field-error">{{ $message }}</div>@enderror
                        </div>

                        <div class="donate-field">
                            <label class="field-label">Donation Date <span class="required-star">*</span></label>
                            <input type="date" name="DonationDate" value="{{ old('DonationDate', date('Y-m-d')) }}" required
                                   class="field-input @error('DonationDate') error @enderror">
                            @error('DonationDate')<div class="field-error">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                {{-- ── Status Section ── --}}
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
                            <label class="status-option {{ old('Status', 'Completed') === 'Completed' ? 'active' : '' }}">
                                <input type="radio" name="Status" value="Completed" {{ old('Status', 'Completed') === 'Completed' ? 'checked' : '' }}>
                                <span class="status-dot completed"></span>
                                <span class="status-label">Completed</span>
                            </label>
                            <label class="status-option {{ old('Status') === 'Pending' ? 'active' : '' }}">
                                <input type="radio" name="Status" value="Pending" {{ old('Status') === 'Pending' ? 'checked' : '' }}>
                                <span class="status-dot pending"></span>
                                <span class="status-label">Pending</span>
                            </label>
                            <label class="status-option {{ old('Status') === 'Failed' ? 'active' : '' }}">
                                <input type="radio" name="Status" value="Failed" {{ old('Status') === 'Failed' ? 'checked' : '' }}>
                                <span class="status-dot failed"></span>
                                <span class="status-label">Failed</span>
                            </label>
                            <label class="status-option {{ old('Status') === 'Refunded' ? 'active' : '' }}">
                                <input type="radio" name="Status" value="Refunded" {{ old('Status') === 'Refunded' ? 'checked' : '' }}>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Record Donation
                    </button>
                    <a href="{{ route('admin.donations.index') }}" class="btn-cancel-create">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Cancel
                    </a>
                </div>
                <span class="text-xs text-gray-400">All fields are required</span>
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
</script>

@endsection
