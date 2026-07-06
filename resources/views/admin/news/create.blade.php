@extends('admin.layouts.app')

@section('title', 'New Article')
@section('page-title', 'New Article')
@section('breadcrumb', 'News → Create')

@section('content')

<div class="max-w-3xl">
    <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Title --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            <h3 class="font-semibold text-gray-700 text-sm">Article Details</h3>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Title <span class="text-red-400">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] @error('title') border-red-300 @enderror"
                       placeholder="Article title...">
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Category <span class="text-red-400">*</span></label>
                <select name="category" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] bg-white">
                    @foreach(['general'=>'General','program-update'=>'Program Update','event'=>'Event','announcement'=>'Announcement'] as $val => $label)
                    <option value="{{ $val }}" {{ old('category') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Short Excerpt</label>
                <textarea name="excerpt" rows="2"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                          placeholder="Short summary shown in article cards...">{{ old('excerpt') }}</textarea>
            </div>
        </div>

        {{-- Content --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <label class="block text-sm font-semibold text-gray-700 mb-3">Content (HTML)</label>
            <textarea name="content" rows="14"
                      class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono resize-y"
                      placeholder="<p>Article full content here...</p>">{{ old('content') }}</textarea>
        </div>

        {{-- Image + Publish --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            <h3 class="font-semibold text-gray-700 text-sm">Image & Publishing</h3>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Cover Image</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                <p class="text-xs text-gray-400 mt-1">Max 2 MB. JPG, PNG, or WebP.</p>
            </div>

            <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                       class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                <label for="is_published" class="text-sm font-medium text-gray-700">Publish immediately</label>
                <span class="text-xs text-gray-400">(uncheck to save as draft)</span>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary">Save Article</button>
            <a href="{{ route('admin.news.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>

@endsection
