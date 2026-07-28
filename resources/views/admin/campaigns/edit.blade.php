@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
@endpush

@section('title', 'Edit Campaign')
@section('page-title', 'Edit Campaign')
@section('breadcrumb', 'Campaigns → ' . $campaign->title)

@section('content')

<div class="w-full space-y-5">
    <form action="{{ route('admin.campaigns.update', $campaign) }}" method="POST" enctype="multipart/form-data"
          class="space-y-5" x-data="bilingualForm()">
        @csrf
        @method('PUT')

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
                <div class="header-actions">
                    @if($campaign->is_active)
                    <a href="{{ route('campaigns.show', $campaign) }}" target="_blank"
                       class="text-xs font-medium text-[#2d6fa3] hover:underline">View on site ↗</a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                @include('admin.campaigns._form', ['campaign' => $campaign])
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.campaigns.index') }}" class="btn-cancel">Cancel</a>
            <button type="submit" class="btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                Save Changes
            </button>
        </div>
    </form>

    {{-- Danger zone --}}
    <div class="form-card danger-zone">
        <div class="card-header danger">
            <span class="icon red">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </span>
            <h3>Danger Zone</h3>
        </div>
        <div class="card-body danger">
            <div class="danger-content">
                <div class="danger-text">
                    <p class="title">Delete this campaign</p>
                    <p class="desc">Permanently removes the campaign along with its image, video and document. This cannot be undone.</p>
                </div>
                <form action="{{ route('admin.campaigns.destroy', $campaign) }}" method="POST" class="delete-form"
                      onsubmit="return confirm('Delete “{{ addslashes($campaign->title) }}”? This cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Delete Campaign
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
