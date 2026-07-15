@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
@endpush

@section('title', 'Add Payment Method')
@section('page-title', 'Add Payment Method')
@section('breadcrumb', 'Payment Methods → Add Payment Method')

@section('content')

<div class="payment-form-page">
    {{-- Page Header --}}
    <div class="payment-form-header">
        <a href="{{ route('admin.payments.index') }}" class="payment-form-back">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 12H5m7 7l-7-7 7-7"/>
            </svg>
            Back to Payment Methods
        </a>
        <div class="payment-form-title-group">
            <div class="payment-form-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
            </div>
            <div>
                <h1>Add Payment Method</h1>
                <p>Create a new payment method for donors to use on the Donate page</p>
            </div>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="payment-form-card">
        <form action="{{ route('admin.payments.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="payment-form-section">
                <div class="payment-form-section-header">
                    <div class="section-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3>Basic Information</h3>
                        <p>General details about this payment method</p>
                    </div>
                </div>
                <div class="payment-form-section-body">
                    @include('admin.payments._form', ['paymentMethod' => null])
                </div>
            </div>

            <div class="payment-form-actions">
                <a href="{{ route('admin.payments.index') }}" class="payments-btn-secondary">
                    Cancel
                </a>
                <button type="submit" class="payments-btn-primary">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Create Payment Method
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
