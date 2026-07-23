@extends('admin.layouts.app')
@section('title', 'Create Project')
@section('page-title', 'Create Project')
@section('breadcrumb', 'Add a new sub-page under a program')

@section('content')
<div class="max-w-3xl mx-auto space-y-5">
    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        {{-- Basic Info --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Basic Information</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Parent Program</label>
                    <select name="program_id" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        <option value="">-- No Program --</option>
                        @foreach($programs as $program)
                            <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>{{ $program->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl w-full">
                        <input type="checkbox" name="is_active" id="is_active" value="1" checked
                               class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                        <label for="is_active" class="text-sm font-medium text-gray-700">Active (shown publicly)</label>
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Title <span class="text-red-400">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Short Description</label>
                <textarea name="description" data-ckeditor rows="2" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('description') }}</textarea>
                <p class="mt-1 text-xs text-gray-400">Shown as subtitle in the page header banner.</p>
            </div>
        </div>

        {{-- Banner Image --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider flex items-center gap-2">
                <span>&#127752;</span> Page Header Banner Image
                <span class="font-normal text-gray-400 normal-case">(optional)</span>
            </h3>
            <div x-data="{ bannerMode: 'upload' }">
                <div class="flex items-center gap-1 bg-gray-100 p-1 rounded-lg w-fit mb-3">
                    <button type="button" @click="bannerMode = 'upload'"
                            :class="bannerMode === 'upload' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'"
                            class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Upload File</button>
                    <button type="button" @click="bannerMode = 'url'"
                            :class="bannerMode === 'url' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'"
                            class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Image URL</button>
                </div>
                <div x-show="bannerMode === 'upload'">
                    <input type="file" name="banner_image" accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                    <p class="mt-1.5 text-xs text-gray-400">Max 4MB. Recommended: 1400x400px landscape.</p>
                </div>
                <div x-show="bannerMode === 'url'" style="display:none">
                    <input type="url" name="banner_image_url" placeholder="https://example.com/banner.jpg"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
        </div>

        {{-- Detailed Content --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Detailed Content</h3>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Objective</label>
                <textarea name="objective" data-ckeditor rows="2" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('objective') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Project Content (HTML Supported)</label>
                <textarea name="content" data-ckeditor rows="5" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]" placeholder="Full content (HTML is supported)...">{{ old('content') }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Activities</label>
                <textarea name="activities" data-ckeditor rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none" placeholder="Activity 1&#10;Activity 2">{{ old('activities') }}</textarea>
                <p class="mt-1 text-xs text-gray-400">Each new line will be displayed as a bullet point on the public page.</p>
            </div>
        </div>

        {{-- Project Card Image --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4" x-data="{ imageMode: 'upload' }">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Project Card Image</h3>
            <div class="flex items-center gap-1 bg-gray-100 p-1 rounded-lg w-fit mb-1">
                <button type="button" @click="imageMode = 'upload'" :class="imageMode === 'upload' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500'" class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Upload File</button>
                <button type="button" @click="imageMode = 'url'" :class="imageMode === 'url' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500'" class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Image URL</button>
            </div>
            <div x-show="imageMode === 'upload'">
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] border border-gray-200 rounded-xl p-1">
            </div>
            <div x-show="imageMode === 'url'" style="display:none">
                <input type="url" name="image_url" placeholder="https://example.com/image.jpg"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
        </div>

        {{-- Testimony --}}
        <div class="bg-[#2d6fa3]/5 rounded-2xl border border-[#2d6fa3]/10 p-6 space-y-4">
            <h3 class="text-xs font-bold text-[#2d6fa3] uppercase tracking-wider">Testimony</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Name &amp; Role</label>
                    <input type="text" name="testimony_name" value="{{ old('testimony_name') }}"
                           placeholder="e.g., Sam March, 17 years old"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div x-data="{ testyMode: 'upload' }">
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-sm font-medium text-gray-700">Testimony Photo</label>
                        <div class="flex items-center gap-1 bg-gray-100 p-0.5 rounded">
                            <button type="button" @click="testyMode = 'upload'" :class="testyMode === 'upload' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500'" class="px-2 py-1 text-[10px] font-medium rounded transition-all">File</button>
                            <button type="button" @click="testyMode = 'url'" :class="testyMode === 'url' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500'" class="px-2 py-1 text-[10px] font-medium rounded transition-all">URL</button>
                        </div>
                    </div>
                    <div x-show="testyMode === 'upload'">
                        <input type="file" name="testimony_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] border border-gray-200 rounded-xl p-1">
                    </div>
                    <div x-show="testyMode === 'url'" style="display:none">
                        <input type="url" name="testimony_image_url" placeholder="https://"
                               class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Story / Quote</label>
                <textarea name="testimony_story" data-ckeditor rows="4" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">{{ old('testimony_story') }}</textarea>
            </div>
        </div>

        <div class="bg-[#e8a020]/5 rounded-2xl border border-[#e8a020]/10 p-6 space-y-3">
            <h3 class="text-xs font-bold text-[#e8a020] uppercase tracking-wider">Public Project Page Details</h3>
            <p class="text-sm text-gray-600">
                After you create this project, manage its public page details from the dedicated <strong>Project Defaults</strong> page.
            </p>
            <p class="text-xs text-gray-500">
                There you can choose whether this project uses shared defaults or its own specific public-page details.
            </p>
        </div>

        {{-- Income Generation Grants --}}
        <div class="bg-[#8da83a]/5 rounded-2xl border border-[#8da83a]/20 p-5 flex items-start gap-3">
            <svg class="w-5 h-5 text-[#8da83a] flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-xs text-gray-500"><span class="font-semibold text-[#8da83a]">Income Generation Grants</span> can be added after you create the project. Save first, then open the project to manage grants.</p>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3 pb-4">
            <button type="submit" class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-semibold rounded-xl transition-colors">
                Create Project
            </button>
            <a href="{{ route('admin.projects.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>
@endsection
