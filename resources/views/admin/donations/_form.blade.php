@php
    $isEdit = isset($donation);
    $donor = $isEdit ? $donation->donor : null;

    if ($isEdit) {
        $donorName     = old('DonorName', $donor?->full_name ?? '');
        $donationAmount = old('DonationAmount', $donation->DonationAmount ?? $donation->Amount ?? '');
        $donationType  = old('DonationType', $donation->DonationType ?? '');
        $donationDate  = old('DonationDate', $donation->DonationDate ? $donation->DonationDate->format('Y-m-d') : date('Y-m-d'));
        $paymentMethod = old('PaymentMethod', $donation->PaymentMethod ?? '');
        $status         = old('Status', $donation->Status ?? 'Completed');
    } else {
        $donorName     = old('DonorName', '');
        $donationAmount = old('DonationAmount', '');
        $donationType  = old('DonationType', '');
        $donationDate  = old('DonationDate', date('Y-m-d'));
        $paymentMethod = old('PaymentMethod', '');
        $status         = old('Status', 'Completed');
    }
@endphp

{{-- Donor Name --}}
<div class="form-group">
    <label class="form-label">Donor Name <span class="required">*</span></label>
    <input type="text" name="DonorName" value="{{ $donorName }}" required
           class="form-control @error('DonorName') error @enderror"
           placeholder="e.g. John Smith">
    @error('DonorName')<div class="form-error">{{ $message }}</div>@enderror
</div>

{{-- Donation Amount --}}
<div class="form-group">
    <label class="form-label">Donation Amount <span class="required">*</span></label>
    <div class="relative">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 font-medium text-sm">$</span>
        <input type="number" name="DonationAmount" value="{{ $donationAmount }}" required step="0.01" min="0"
               class="form-control pl-8 @error('DonationAmount') error @enderror"
               placeholder="0.00">
    </div>
    @error('DonationAmount')<div class="form-error">{{ $message }}</div>@enderror
</div>

<div class="form-grid grid grid-cols-1 md:grid-cols-2 gap-4">
    {{-- Donation Type --}}
    <div class="form-group">
        <label class="form-label">Donation Type <span class="required">*</span></label>
        <select name="DonationType" required class="form-control @error('DonationType') error @enderror">
            <option value="">— Select type —</option>
            <option value="Money" {{ $donationType === 'Money' ? 'selected' : '' }}>Money</option>
            <option value="Clothes" {{ $donationType === 'Clothes' ? 'selected' : '' }}>Clothes</option>
            <option value="Food" {{ $donationType === 'Food' ? 'selected' : '' }}>Food</option>
            <option value="Books" {{ $donationType === 'Books' ? 'selected' : '' }}>Books</option>
        </select>
        @error('DonationType')<div class="form-error">{{ $message }}</div>@enderror
    </div>

    {{-- Payment Method --}}
    <div class="form-group">
        <label class="form-label">Payment Method <span class="required">*</span></label>
        <select name="PaymentMethod" required class="form-control @error('PaymentMethod') error @enderror">
            <option value="">— Select method —</option>
            <option value="Cash" {{ $paymentMethod === 'Cash' ? 'selected' : '' }}>Cash</option>
            <option value="Bank Transfer" {{ $paymentMethod === 'Bank Transfer' ? 'selected' : '' }}>Bank Transfer</option>
            <option value="QR Code" {{ $paymentMethod === 'QR Code' ? 'selected' : '' }}>QR Code</option>
        </select>
        @error('PaymentMethod')<div class="form-error">{{ $message }}</div>@enderror
    </div>
</div>

<div class="form-grid grid grid-cols-1 md:grid-cols-2 gap-4">
    {{-- Donation Date --}}
    <div class="form-group">
        <label class="form-label">Donation Date <span class="required">*</span></label>
        <input type="date" name="DonationDate" value="{{ $donationDate }}" required
               class="form-control @error('DonationDate') error @enderror">
        @error('DonationDate')<div class="form-error">{{ $message }}</div>@enderror
    </div>

    {{-- Status --}}
    <div class="form-group">
        <label class="form-label">Status <span class="required">*</span></label>
        <select name="Status" required class="form-control @error('Status') error @enderror">
            <option value="Completed" {{ $status === 'Completed' ? 'selected' : '' }}>Completed</option>
            <option value="Pending" {{ $status === 'Pending' ? 'selected' : '' }}>Pending</option>
            <option value="Failed" {{ $status === 'Failed' ? 'selected' : '' }}>Failed</option>
            <option value="Refunded" {{ $status === 'Refunded' ? 'selected' : '' }}>Refunded</option>
        </select>
        @error('Status')<div class="form-error">{{ $message }}</div>@enderror
    </div>
</div>
