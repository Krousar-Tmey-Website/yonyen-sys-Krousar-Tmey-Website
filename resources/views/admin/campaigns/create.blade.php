@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
@endpush

@section('title', 'Create Campaign')
@section('page-title', 'Create Campaign')
@section('breadcrumb', 'Campaigns → Create Campaign')

@section('content')

<div class="max-w-4xl mx-auto">
    <form action="{{ route('admin.campaigns.store') }}" method="POST" enctype="multipart/form-data"
          class="space-y-5" x-data="bilingualForm()">
        @csrf

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
            <p class="font-semibold mb-1">Please fix the following:</p>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <div class="form-card">
            <div class="card-header">
                <span class="icon green">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                    </svg>
                </span>
                <h3>Campaign Details</h3>
                <span class="badge">Required *</span>
            </div>
            <div class="card-body">
                @include('admin.campaigns._form', ['campaign' => null])
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.campaigns.index') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Create Campaign
            </button>
        </div>
    </form>
</div>

@endsection
