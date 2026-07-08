@extends('admin.layouts.app')

@section('title', 'Add Social Link')
@section('page-title', 'Add Social Link')
@section('breadcrumb', 'Create a new social media link')

@section('content')

<div class="max-w-2xl">
    <form action="{{ route('admin.social-links.store') }}" method="POST" class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Platform Name *</label>
                <input type="text" name="platform_name" value="{{ old('platform_name') }}"
                       placeholder="e.g. Facebook, Twitter"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] @error('platform_name') border-red-300 @enderror">
                @error('platform_name') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Icon Identifier</label>
                <input type="text" name="icon" value="{{ old('icon') }}"
                       placeholder="e.g. facebook, instagram, youtube"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="text-xs text-gray-400 mt-1">Lowercase name matching the SVG icon (facebook, instagram, linkedin, youtube, telegram).</p>
                @error('icon') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1.5">URL *</label>
            <input type="url" name="url" value="{{ old('url') }}"
                   placeholder="https://www.facebook.com/your-page"
                   class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] @error('url') border-red-300 @enderror">
            @error('url') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            <div class="flex items-end pb-2.5">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]/20">
                    <span class="text-sm text-gray-600">Active</span>
                </label>
            </div>
        </div>

        <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="btn-primary">Create Social Link</button>
            <a href="{{ route('admin.social-links.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>

@endsection
