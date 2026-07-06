@extends('admin.layouts.app')

@section('title', 'Edit Program')
@section('page-title', 'Edit Program')
@section('breadcrumb', 'Programs → ' . $program->title)

@section('content')

<div class="max-w-2xl">
    <form action="{{ route('admin.programs.update', $program) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Title</label>
                <input type="text" name="title" value="{{ old('title', $program->title) }}" required
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Short Description</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('description', $program->description) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Full Description</label>
                <textarea name="full_description" rows="6"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-y">{{ old('full_description', $program->full_description) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $program->sort_order) }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div class="flex items-end pb-1">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl w-full">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $program->is_active) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                        <label for="is_active" class="text-sm font-medium text-gray-700">Active</label>
                    </div>
                </div>
            </div>

            @if($program->image)
            <div>
                <p class="text-xs text-gray-500 mb-2">Current image:</p>
                <img src="{{ asset('images/' . $program->image) }}" class="h-28 w-auto rounded-xl object-cover border border-gray-200">
            </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Replace Image</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary">Save Changes</button>
            <a href="{{ route('admin.programs.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>

@endsection
