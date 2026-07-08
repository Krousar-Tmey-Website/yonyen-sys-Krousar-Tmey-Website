@extends('admin.layouts.app')

@section('title', 'Create Program')
@section('page-title', 'Create Program')
@section('breadcrumb', 'Programs → Create')

@section('content')

<div class="max-w-3xl mx-auto">
    <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Title <span class="text-red-400">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
                    <input type="text" name="Status" value="{{ old('Status') }}" placeholder="e.g. Active, Ongoing, Planning..."
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Short Description</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Full Description</label>
                <textarea name="full_description" rows="6"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-y">{{ old('full_description') }}</textarea>
            </div>


            {{-- Testimony Settings --}}
            <div class="pt-4 mt-2 border-t border-gray-100">
                <h3 class="text-sm font-bold text-gray-800 mb-4 uppercase tracking-wider">Testimony</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Name & Subtitle</label>
                        <input type="text" name="testimony_name" value="{{ old('testimony_name') }}" placeholder="e.g. Davann, 17, welcomed in Siem Reap..."
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div x-data="{ testImage: 'upload' }">
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="block text-sm font-medium text-gray-700">Testimony Image</label>
                            <div class="flex items-center gap-1 bg-gray-100 p-0.5 rounded flex-shrink-0">
                                <button type="button" @click="testImage = 'upload'" :class="testImage === 'upload' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'" class="px-2 py-1 text-[10px] font-medium rounded transition-all">File</button>
                                <button type="button" @click="testImage = 'url'" :class="testImage === 'url' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'" class="px-2 py-1 text-[10px] font-medium rounded transition-all">URL</button>
                            </div>
                        </div>
                        <div x-show="testImage === 'upload'">
                            <input type="file" name="testimony_image" accept="image/*"
                                   class="w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20 border border-gray-200 rounded-xl p-1">
                        </div>
                        <div x-show="testImage === 'url'" style="display: none;">
                            <input type="url" name="testimony_image_url" placeholder="https://example.com/image.jpg"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        </div>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Story Content</label>
                    <textarea name="testimony_story" rows="4" placeholder="Enter testimony story text here..."
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-y">{{ old('testimony_story') }}</textarea>
                </div>
            </div>

            {{-- Social Media Links --}}
            <div class="pt-4 mt-2 border-t border-gray-100">
                <h3 class="text-sm font-bold text-gray-800 mb-4 uppercase tracking-wider">Social Media Links</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Facebook URL</label>
                        <input type="url" name="facebook_url" value="{{ old('facebook_url') }}" placeholder="https://facebook.com/..."
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">LinkedIn URL</label>
                        <input type="url" name="linkedin_url" value="{{ old('linkedin_url') }}" placeholder="https://linkedin.com/company/..."
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Instagram URL</label>
                        <input type="url" name="instagram_url" value="{{ old('instagram_url') }}" placeholder="https://instagram.com/..."
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Telegram URL</label>
                        <input type="url" name="telegram_url" value="{{ old('telegram_url') }}" placeholder="https://t.me/..."
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">YouTube URL</label>
                        <input type="url" name="youtube_url" value="{{ old('youtube_url') }}" placeholder="https://youtube.com/..."
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                       class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                <label for="is_active" class="text-sm font-medium text-gray-700">Active (visible on site)</label>
            </div>

            <div x-data="{ imageType: 'upload' }">
                <div class="flex items-center gap-4 mb-3">
                    <label class="block text-sm font-medium text-gray-700">Program Image</label>
                    <div class="flex items-center gap-1 bg-gray-100 p-1 rounded-lg">
                        <button type="button" @click="imageType = 'upload'" :class="imageType === 'upload' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'" class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Upload File</button>
                        <button type="button" @click="imageType = 'url'" :class="imageType === 'url' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'" class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Image URL</button>
                    </div>
                </div>

                <div x-show="imageType === 'upload'">
                    <input type="file" name="image" accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                    <p class="mt-2 text-xs text-gray-400">Max 2MB. Recommended: 800×600px or wider.</p>
                </div>

                <div x-show="imageType === 'url'" style="display: none;">
                    <input type="url" name="image_url" placeholder="https://example.com/image.jpg"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    <p class="mt-2 text-xs text-gray-400">Enter a direct link to the image.</p>
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary">Create Program</button>
            <a href="{{ route('admin.programs.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>

@endsection
