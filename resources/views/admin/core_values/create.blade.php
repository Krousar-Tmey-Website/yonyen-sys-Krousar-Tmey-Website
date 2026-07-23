@extends('admin.layouts.app')

@section('title', 'Add Value')
@section('page-title', 'Add Value')
@section('breadcrumb', 'Our Values → Add Value')

@section('content')    <div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="font-bold text-gray-800">New Value</h3>
                <p class="text-sm text-gray-400 mt-0.5">Add a new core value card to the About page.</p>
            </div>
            <a href="{{ route('admin.core-values.index') }}"
               class="px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-200 transition">
                Back to values
            </a>
        </div>

        <form action="{{ route('admin.core-values.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Title <span class="text-red-400">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="Enter value title">
                    @error('title')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Description <span class="text-gray-400">(optional)</span></label>
                    <textarea name="description" data-ckeditor rows="3"
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                              placeholder="Describe the value">{{ old('description') }}</textarea>
                    @error('description')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Order <span class="text-gray-400">(optional)</span></label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    @error('sort_order')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-between gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.core-values.index') }}"
                   class="px-4 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl transition">
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-semibold transition-all shadow-sm hover:shadow-md">
                    Add Value
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
