@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
@endpush

@section('title', 'Add Payment Method')
@section('page-title', 'Add Payment Method')
@section('breadcrumb', 'Payment Methods → Add Payment Method')

@section('content')

<div class="max-w-2xl mx-auto">
    <form action="{{ route('admin.payments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-card" style="border-radius:16px;border:1px solid #eef2f6;box-shadow:0 1px 3px rgba(0,0,0,0.02);margin-bottom:20px;">
            <div class="card-header">
                <div class="icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <h3>Payment Method Details</h3>
                <span class="badge">Required *</span>
            </div>
            <div class="card-body">
                @include('admin.payments._form', ['paymentMethod' => null])
            </div>
            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:18px;height:18px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Payment Method
                </button>
                <a href="{{ route('admin.payments.index') }}" class="btn-cancel">Cancel</a>
            </div>
        </div>
    </form>
</div>

@endsection
