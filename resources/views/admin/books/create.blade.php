@extends('admin.layouts.app')

@push('styles')
    @vite(['resources/css/admin.css', 'resources/css/admin-history.css'])
@endpush

@section('title', 'Add Book')
@section('page-title', 'Add Book')
@section('breadcrumb', 'Book for Sales → Add Book')

@section('content')

<div class="max-w-3xl mx-auto">
    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5" x-data="bilingualForm()">
        @csrf

        {{-- Book Details --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </span>
                    Book Details
                </h3>
                <span class="text-xs text-gray-400">Required *</span>
            </div>

            @include('admin.books._form', ['book' => null])
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary">Add Book</button>
            <a href="{{ route('admin.books.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>

@endsection
