@extends('admin.layouts.app')

@section('title', 'Edit Article')
@section('page-title', 'Edit Article')
@section('breadcrumb', 'News → ' . Str::limit($news->title, 40))

@section('content')

<div class="max-w-3xl">
    <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')

        {{-- Title --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            <h3 class="font-semibold text-gray-700 text-sm">Article Details</h3>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Title <span class="text-red-400">*</span></label>
                <input type="text" name="title" value="{{ old('title', $news->title) }}" required
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] @error('title') border-red-300 @enderror">
                @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Category</label>
                <select name="category" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] bg-white">
                    @foreach(['general'=>'General','program-update'=>'Program Update','event'=>'Event','announcement'=>'Announcement'] as $val => $label)
                    <option value="{{ $val }}" {{ old('category', $news->category) === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Short Excerpt</label>
                <textarea name="excerpt" rows="2"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('excerpt', $news->excerpt) }}</textarea>
            </div>
        </div>

        {{-- Content --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6">
            <label class="block text-sm font-semibold text-gray-700 mb-3">Content (HTML)</label>
            <textarea name="content" rows="14"
                      class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] font-mono resize-y">{{ old('content', $news->content) }}</textarea>
        </div>

        {{-- Image + Publish --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            <h3 class="font-semibold text-gray-700 text-sm">Image & Publishing</h3>

            @if($news->image)
            <div>
                <p class="text-xs text-gray-500 mb-2">Current image:</p>
                <img src="{{ $news->image_url }}" alt="Current image" class="h-32 w-auto rounded-xl object-cover border border-gray-200">
            </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Replace Image</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
            </div>

            <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl">
                <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $news->is_published) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                <label for="is_published" class="text-sm font-medium text-gray-700">Published</label>
                @if($news->published_at)
                <span class="text-xs text-gray-400">since {{ $news->published_at->format('d M Y') }}</span>
                @endif
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary">Update Article</button>
            <a href="{{ route('admin.news.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
            <form action="{{ route('admin.news.destroy', $news) }}" method="POST" class="ml-auto"
                  onsubmit="return confirm('Permanently delete this article?')">
                @csrf @method('DELETE')
                <button type="submit" class="text-red-400 hover:text-red-600 text-sm">Delete Article</button>
            </form>
        </div>
    </form>
</div>

@php use Illuminate\Support\Str; @endphp

@endsection
