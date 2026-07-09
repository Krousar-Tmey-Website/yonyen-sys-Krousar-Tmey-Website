@extends('admin.layouts.app')

@section('title', $category->CategoryName)
@section('page-title', 'Category Details')
@section('breadcrumb', 'Categories → ' . $category->CategoryName)

@section('content')

<div class="max-w-2xl">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        {{-- Header --}}
        <div class="px-6 py-5 bg-gray-50 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-800">{{ $category->CategoryName }}</h2>
                    <p class="text-xs text-gray-400">Category ID: {{ $category->id }}</p>
                </div>
            </div>
        </div>

        {{-- Details --}}
        <div class="p-6 space-y-5">
            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Name</p>
                <p class="text-sm font-medium text-gray-800">{{ $category->CategoryName }}</p>
            </div>

            <div>
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Description</p>
                <p class="text-sm text-gray-600">{{ $category->Description ?? 'No description provided.' }}</p>
            </div>

            <div class="grid grid-cols-2 gap-6 pt-5 border-t border-gray-100">
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Created</p>
                    <p class="text-sm font-medium text-gray-800">{{ $category->created_at?->format('d M Y, h:i A') ?? '—' }}</p>
                </div>

                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-1">Last Updated</p>
                    <p class="text-sm font-medium text-gray-800">{{ $category->updated_at?->format('d M Y, h:i A') ?? '—' }}</p>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center gap-3">
            <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}"
               class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-medium transition flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit Category
            </a>
            <a href="{{ route('admin.categories.index') }}"
               class="px-4 py-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl text-sm font-medium transition">
                Back to Categories
            </a>
        </div>
    </div>
</div>

@endsection
