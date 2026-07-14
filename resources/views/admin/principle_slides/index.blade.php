@extends('admin.layouts.app')

@section('title', 'Our Principle Slides')
@section('page-title', 'Our Principle Slides')
@section('breadcrumb', 'Manage background images for the Our Principle section')

@section('content')

<div class="grid lg:grid-cols-3 gap-6 mt-[300px]">
    {{-- Add slide form --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-700 mb-4 text-sm">Add New Slide</h3>
        <form action="{{ route('admin.principle-slides.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
            @csrf
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Title (optional)</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="e.g. Community Support">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Image <span class="text-red-400">*</span></label>
                <input type="file" name="image" accept="image/png,image/jpeg,image/webp,image/svg+xml"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="text-gray-400 text-xs mt-1">Or enter image URL below</p>
                <input type="url" name="image_url" value="{{ old('image_url') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] mt-2"
                       placeholder="https://example.com/image.jpg">
                @error('image')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                @error('image_url')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div class="flex items-end">
                    <label class="flex items-center gap-2 text-xs text-gray-600">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]/20">
                        Active
                    </label>
                </div>
            </div>
            <button type="submit" class="w-full btn-primary text-sm py-2.5">Add Slide</button>
        </form>
    </div>

    {{-- Slides list --}}
    <div class="lg:col-span-2">
        @if($slides->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 py-12 text-center text-gray-400 text-sm">
            No slides yet. Add your first one.
        </div>
        @else
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <div class="px-5 py-3.5 bg-gray-50 border-b border-gray-100">
                <h4 class="font-semibold text-gray-700 text-sm">{{ $slides->count() }} Slide(s)</h4>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($slides as $slide)
                <div x-data="{ editing: false }">
                    {{-- View row --}}
                    <div class="flex items-start justify-between px-5 py-4 hover:bg-gray-50/50" x-show="!editing">
                        <div class="flex items-start gap-3 min-w-0">
                            <img src="{{ $slide->image_url }}" alt="" class="w-16 h-12 object-cover flex-shrink-0 mt-0.5 rounded-lg">
                            <div class="min-w-0">
                                <p class="font-semibold text-gray-700 text-sm">{{ $slide->title ?? 'Untitled' }}</p>
                                <p class="text-gray-500 text-xs mt-1">Order: {{ $slide->sort_order }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0 ml-3">
                            <button @click="editing = true" class="text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium p-1">Edit</button>
                            <form action="{{ route('admin.principle-slides.destroy', $slide) }}" method="POST"
                                  onsubmit="return confirm('Remove this slide?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-300 hover:text-red-500 transition-colors p-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    {{-- Edit form --}}
                    <div class="px-5 py-4 bg-gray-50 border-t border-gray-100" x-show="editing" x-cloak>
                        <form action="{{ route('admin.principle-slides.update', $slide) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            @csrf @method('PUT')
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Title (optional)</label>
                                <input type="text" name="title" value="{{ $slide->title }}"
                                       class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]"
                                       placeholder="e.g. Community Support">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Image</label>
                                @if($slide->image_url)
                                <div class="flex items-center gap-2 mb-2">
                                    <img src="{{ $slide->image_url }}" alt="" class="w-16 h-12 object-cover rounded-lg border border-gray-200">
                                    <label class="flex items-center gap-1.5 text-xs text-gray-500">
                                        <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300">
                                        Remove current image
                                    </label>
                                </div>
                                @endif
                                <input type="file" name="image" accept="image/png,image/jpeg,image/webp,image/svg+xml"
                                       class="w-full px-3 py-2 border border-gray-200 rounded-xl text-xs focus:outline-none focus:border-[#2d6fa3]">
                                <input type="url" name="image_url" value="{{ $slide->image }}"
                                       class="w-full mt-2 px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]"
                                       placeholder="...or paste an image URL">
                                @error('image')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                                @error('image_url')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Order</label>
                                    <input type="number" name="sort_order" value="{{ $slide->sort_order }}"
                                           class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                                </div>
                                <div class="flex items-end">
                                    <label class="flex items-center gap-2 text-xs text-gray-600">
                                        <input type="checkbox" name="is_active" value="1" {{ $slide->is_active ? 'checked' : '' }}
                                               class="rounded border-gray-300 text-[#2d6fa3] focus:ring-[#2d6fa3]/20">
                                        Active
                                    </label>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="btn-primary text-xs px-4 py-2">Save</button>
                                <button type="button" @click="editing = false" class="text-gray-400 hover:text-gray-600 text-xs px-4 py-2">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

@endsection