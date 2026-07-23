@extends('admin.layouts.app')
@section('title', 'Create Testimonial')
@section('page-title', 'Create Testimonial')

@section('content')
<div class="max-w-2xl mx-auto">
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
                        <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Role / Affiliation</label>
                <input type="text" name="role" value="{{ old('role') }}" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Content</label>
                <textarea name="content" data-ckeditor rows="4" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('content') }}</textarea>
            </div>
            
            <div class="flex items-end pb-1">
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl w-full">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked
                           class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                    <label for="is_active" class="text-sm font-medium text-gray-700">Active</label>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Upload Image</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-medium rounded-xl transition-colors">Create Testimonial</button>
            <a href="{{ route('admin.testimonials.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>
@endsection