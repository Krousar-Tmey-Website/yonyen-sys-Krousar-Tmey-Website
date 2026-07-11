@extends('admin.layouts.app')

@section('title', 'Add Book')
@section('page-title', 'Add Book')
@section('breadcrumb', 'Books for Sale → Add Book')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="font-bold text-gray-800">New Book</h3>
                <p class="text-sm text-gray-400 mt-0.5">Add a book that visitors can purchase.</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </div>
        </div>

        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @include('admin.books._form', ['book' => null])

            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <a href="{{ route('admin.books.index') }}"
                   class="px-4 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl transition">
                    Cancel
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white rounded-xl text-sm font-semibold transition-all flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Book
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
