@extends('admin.layouts.app')

@section('title', 'Edit Book')
@section('page-title', 'Edit Book')
@section('breadcrumb', 'Books for Sale → Edit Book')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="font-bold text-gray-800">Edit Book</h3>
                <p class="text-sm text-gray-400 mt-0.5">Update details for "{{ $book->title }}".</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
        </div>

        <form action="{{ route('admin.books.update', $book) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')
            @include('admin.books._form', ['book' => $book])

            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <a href="{{ route('admin.books.index') }}"
                   class="px-4 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl transition">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white rounded-xl text-sm font-semibold transition-all flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Update Book
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
