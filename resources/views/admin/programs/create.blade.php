@extends('admin.layouts.app')

@section('title', 'Create Program')
@section('page-title', 'Create Program')
@section('breadcrumb', 'Programs → Create')

@section('content')

@php
    $previewTitle = old('title');
    $previewObjective = old('description');
    $previewProgramText = old('full_description');
    $previewImage = old('image_url') ?: asset('images/program.jpg');
@endphp

<div class="max-w-3xl mx-auto">
    <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
        @endif

        <div class="bg-[#2d6fa3]/5 rounded-2xl border border-[#2d6fa3]/10 p-6 space-y-4">
            <div>
                <h3 class="text-sm font-bold text-[#1a3c6e] uppercase tracking-wider">Public Page Mapping</h3>
                <p class="mt-1 text-sm text-gray-600">This form controls the main program section on the public <strong>Our Programs</strong> page.</p>
            </div>
            <div class="grid md:grid-cols-2 gap-3 text-sm text-gray-600">
                <div class="rounded-xl bg-white/80 border border-white p-4">
                    <p><strong>Section Title</strong> -> large heading</p>
                    <p><strong>Objective Text</strong> -> Objective block</p>
                    <p><strong>Program Text</strong> -> Program block</p>
                </div>
                <div class="rounded-xl bg-white/80 border border-white p-4">
                    <p><strong>Public Section Image</strong> -> right-side image</p>
                    <p><strong>Social Media Links</strong> -> icons below the image</p>
                    <p><strong>Projects</strong> -> the “Know more about the projects” button appears automatically when this program has projects</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
            <div class="text-xs font-medium text-gray-400 uppercase tracking-wider px-4 py-2 bg-gray-50 border-b border-gray-100">
                Public Section Preview
            </div>
            <div class="p-6 md:p-8">
                <div class="grid lg:grid-cols-2 gap-8 items-start">
                    <div>
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-1.5 h-14 bg-[#d32f2f] rounded-full"></div>
                            <h2 class="text-3xl font-black text-[#1a3c6e] uppercase tracking-wide leading-tight">{{ $previewTitle ?: 'Program Title' }}</h2>
                        </div>
                        <div class="mb-6">
                            <h3 class="text-xs font-bold text-[#2d6fa3] uppercase tracking-widest mb-2">Objective</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $previewObjective ?: 'Objective text will appear here.' }}</p>
                        </div>
                        <div class="mb-6">
                            <h3 class="text-xs font-bold text-[#8da83a] uppercase tracking-widest mb-2">Program</h3>
                            <p class="text-gray-700 leading-relaxed whitespace-pre-line">{{ $previewProgramText ?: 'Program text will appear here.' }}</p>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-3">
                            <div class="btn-blue justify-center text-center w-full sm:w-auto opacity-90">Know more about the projects</div>
                            <div class="btn-primary justify-center text-center w-full sm:w-auto opacity-90">Donate now</div>
                        </div>
                    </div>
                    <div class="space-y-5">
                        <img src="{{ $previewImage }}" alt="{{ $previewTitle ?: 'Program preview' }}" class="w-full rounded-3xl border-4 border-white shadow-xl object-cover max-h-[420px]">
                        <div class="flex items-center justify-center gap-2">
                            <span class="w-9 h-9 rounded-lg bg-[#1877f2]"></span>
                            <span class="w-9 h-9 rounded-lg bg-[#0088cc]"></span>
                            <span class="w-9 h-9 rounded-lg bg-[#0a66c2]"></span>
                            <span class="w-9 h-9 rounded-lg bg-[#e1306c]"></span>
                            <span class="w-9 h-9 rounded-lg bg-[#ff0000]"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Section Title <span class="text-red-400">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    <p class="mt-2 text-xs text-gray-400">Shown as the large blue heading on the public Our Programs page.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Overview Card Status</label>
                    <input type="text" name="Status" value="{{ old('Status') }}" placeholder="e.g. Active, Ongoing, Planning..."
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    <p class="mt-2 text-xs text-gray-400">Used on the small program card near the top of the public page.</p>
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Objective Text</label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('description') }}</textarea>
                <p class="mt-2 text-xs text-gray-400">This fills the Objective paragraph on the public program section.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Program Text</label>
                <textarea name="full_description" rows="6"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-y">{{ old('full_description') }}</textarea>
                <p class="mt-2 text-xs text-gray-400">This fills the main Program content block on the public page.</p>
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
                <p class="text-xs text-gray-400 -mt-2 mb-4">These links appear under the right-side image on the public program section when filled.</p>
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
                    <label class="block text-sm font-medium text-gray-700">Public Section Image</label>
                    <div class="flex items-center gap-1 bg-gray-100 p-1 rounded-lg">
                        <button type="button" @click="imageType = 'upload'" :class="imageType === 'upload' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'" class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Upload File</button>
                        <button type="button" @click="imageType = 'url'" :class="imageType === 'url' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'" class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Image URL</button>
                    </div>
                </div>
                <p class="text-xs text-gray-400 mb-3">This is the large image shown on the right side of this program on the public Our Programs page.</p>

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

            {{-- Presentation Page Icon --}}
            <div class="pt-4 border-t border-gray-100" x-data="{ iconType: 'upload' }">
                <div class="flex items-center gap-4 mb-3">
                    <label class="block text-sm font-medium text-gray-700">Presentation Page Icon</label>
                    <div class="flex items-center gap-1 bg-gray-100 p-1 rounded-lg">
                        <button type="button" @click="iconType = 'upload'" :class="iconType === 'upload' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'" class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Upload File</button>
                        <button type="button" @click="iconType = 'url'" :class="iconType === 'url' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'" class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Image URL</button>
                    </div>
                </div>
                <p class="text-xs text-gray-400 mb-3">The small round icon shown for this program on the Presentation page's "Our Reach" strip. Falls back to a generic line icon if not set.</p>

                <div x-show="iconType === 'upload'">
                    <input type="file" name="icon_image" accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                    <p class="mt-2 text-xs text-gray-400">Max 2MB. Square icon graphics work best.</p>
                </div>

                <div x-show="iconType === 'url'" style="display: none;">
                    <input type="url" name="icon_image_url" placeholder="https://example.com/icon.png"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    <p class="mt-2 text-xs text-gray-400">Enter a direct link to the icon image.</p>
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
