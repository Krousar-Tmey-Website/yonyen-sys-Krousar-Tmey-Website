@extends('admin.layouts.app')
@section('title', 'Add Testimonial')
@section('page-title', 'Add Testimonial')
@section('breadcrumb', 'Testimonials → Create')

@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">

            {{-- Name & Label --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Name <span class="text-red-400">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           placeholder="e.g. Davann, 17"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Label / Badge</label>
                    <input type="text" name="label" value="{{ old('label') }}"
                           placeholder="e.g. TESTIMONY"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    <p class="text-xs text-gray-400 mt-1">Shown in uppercase above the name.</p>
                </div>
            </div>

            {{-- Role --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Subtitle / Role</label>
                <input type="text" name="role" value="{{ old('role') }}"
                       placeholder="e.g. Welcomed in Siem Reap protection center"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            {{-- Short Content (quote) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Short Quote <span class="text-gray-400 text-xs">(shown on homepage)</span></label>
                <textarea name="content" rows="3"
                          placeholder="A short quote or excerpt shown in the testimonial card..."
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('content') }}</textarea>
            </div>

            {{-- Full Story --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Full Story <span class="text-gray-400 text-xs">(shown in collapsible section)</span></label>
                <textarea name="story" rows="6"
                          placeholder="The full story text that appears when the viewer clicks 'Read her/his story'..."
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-y">{{ old('story') }}</textarea>
            </div>

            {{-- Sort Order & Active --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div class="flex items-end pb-1">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl w-full">
                        <input type="checkbox" name="is_active" id="is_active" value="1" checked
                               class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                        <label for="is_active" class="text-sm font-medium text-gray-700">Active (visible on site)</label>
                    </div>
                </div>
            </div>

            {{-- Image: Upload or URL --}}
            <div x-data="{ imageType: 'upload' }">
                <div class="flex items-center gap-4 mb-3">
                    <label class="block text-sm font-medium text-gray-700">Photo</label>
                    <div class="flex items-center gap-1 bg-gray-100 p-1 rounded-lg">
                        <button type="button" @click="imageType = 'upload'"
                                :class="imageType === 'upload' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'"
                                class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Upload File</button>
                        <button type="button" @click="imageType = 'url'"
                                :class="imageType === 'url' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'"
                                class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Image URL</button>
                    </div>
                </div>
                <div x-show="imageType === 'upload'">
                    <input type="file" name="image" accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                    <p class="mt-2 text-xs text-gray-400">Recommended: square or portrait photo. Max 2MB.</p>
                </div>
                <div x-show="imageType === 'url'" style="display: none;">
                    <input type="url" name="image_url" placeholder="https://example.com/photo.jpg"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    <p class="mt-2 text-xs text-gray-400">Enter a direct link to the person's photo.</p>
                </div>
            </div>

        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-medium rounded-xl transition-colors">Create Testimonial</button>
            <a href="{{ route('admin.testimonials.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>
@endsection