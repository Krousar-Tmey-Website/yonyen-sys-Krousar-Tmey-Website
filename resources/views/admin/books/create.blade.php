@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
@endpush

@section('title', 'Add Book')
@section('page-title', 'Add Book')
@section('breadcrumb', 'Book for Sales → Add Book')

@section('content')

<div class="form-container">
    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Book Details --}}
        <div class="form-card">
            <div class="card-header">
                <div class="icon blue">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <h3>Book Details</h3>
            </div>
            <div class="card-body">
                @include('admin.books._form', ['book' => null])
            </div>
        </div>

        {{-- Actions --}}
        <div class="form-actions">
            <button type="submit" class="btn-primary">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Book
            </button>
            <a href="{{ route('admin.books.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

@endsection
