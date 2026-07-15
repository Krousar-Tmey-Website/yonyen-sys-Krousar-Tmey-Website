@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
@endpush

@php use Illuminate\Support\Str; @endphp

@section('title', 'Edit Payment Method')
@section('page-title', 'Edit Payment Method')
@section('breadcrumb', 'Payment Methods → ' . Str::limit($paymentMethod->name, 40))

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
            <div class="payment-form-icon edit-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <div>
                <h1>Edit Payment Method</h1>
                <p>Update details for <strong>{{ $paymentMethod->name }}</strong></p>
            </div>
        </div>
    </div>

    {{-- Main Form Card --}}
    <div class="payment-form-card">
        <form action="{{ route('admin.payments.update', ['payment' => $paymentMethod->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="payment-form-section">
                @include('admin.payments._form', ['paymentMethod' => $paymentMethod])
            </div>

            {{-- Form Actions --}}
            <div class="payment-form-actions">
                <a href="{{ route('admin.payments.index') }}" class="payments-btn-secondary">
                    Cancel
                </a>
                <div class="payment-form-actions-right">
                    <button type="submit" class="payments-btn-primary">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Update Payment Method
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Danger Zone --}}
    <div class="payment-form-card payment-form-card-danger">
        <div class="payment-form-section">
            <div class="payment-form-section-header danger">
                <div class="section-icon red">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div>
                    <h3>Danger Zone</h3>
                    <p>Irreversible actions for this payment method</p>
                </div>
            </div>
            <div class="payment-form-section-body danger">
                <div class="payment-form-danger-content">
                    <div class="danger-text">
                        <strong>Delete this payment method</strong>
                        <p>Once deleted, this method cannot be restored. Donors will no longer see it on the Donate page.</p>
                    </div>
                    <form action="{{ route('admin.payments.destroy', ['payment' => $paymentMethod->id]) }}" method="POST"
                          onsubmit="return confirm('Delete {{ addslashes($paymentMethod->name) }}? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="payments-btn-danger">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
