@extends('admin.layouts.app')
@section('title', 'Edit Project — ' . $item->title)
@section('page-title', 'Edit Project')
@section('breadcrumb', $item->title)

@section('content')
<div class="max-w-3xl space-y-6">

    {{-- Header bar --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-gray-800">{{ $item->title }}</h2>
            <p class="text-xs text-gray-400 mt-0.5">{{ $item->program ? $item->program->title : 'No parent program' }}</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('projects.show', $item) }}" target="_blank"
               class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-medium text-[#2d6fa3] border border-[#2d6fa3]/30 bg-[#2d6fa3]/5 hover:bg-[#2d6fa3]/10 rounded-xl transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View Live Page
            </a>
        </div>
    </div>

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.projects.update', $item) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf @method('PUT')

        {{-- Banner Image --}}
        @php
            $bi = $item->banner_image ?? '';
            $biSrc = $bi ? (str_starts_with($bi, 'http') ? $bi : asset('storage/' . $bi)) : '';
            $biTypeInit = (str_starts_with($bi, 'http') && $bi !== '') ? 'url' : 'upload';
        @endphp
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider flex items-center gap-2">
                <span>&#127752;</span> Page Header Banner Image
                <span class="font-normal text-gray-400 normal-case">(optional &mdash; falls back to solid blue)</span>
            </h3>

            {{-- Preview strip --}}
            <div class="rounded-xl overflow-hidden">
                <div class="bg-[#1a3c6e] px-6 py-5 relative overflow-hidden"
                     id="banner-strip"
                     @if($biSrc) style="background-image: linear-gradient(to right, rgba(26,60,110,0.92) 45%, rgba(26,60,110,0.70)), url({{ $biSrc }}); background-size: cover; background-position: center;" @endif>
                    <div class="relative">
                        <p class="text-white/50 text-xs mb-1">Home &rsaquo; Our Programs &rsaquo; {{ $item->title }}</p>
                        <p class="text-white font-bold text-base uppercase tracking-tight">{{ $item->title }}</p>
                    </div>
                </div>
                <p class="text-center text-xs text-gray-400 bg-gray-50 py-1.5 border-t border-gray-100">Live preview of page banner</p>
            </div>

            @if($biSrc)
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                <img src="{{ $biSrc }}" alt="Banner" class="h-12 w-20 rounded-lg object-cover border border-gray-200 flex-shrink-0">
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-medium text-gray-600 mb-0.5">Current banner image</p>
                    <p class="text-xs text-gray-400 truncate">{{ $bi }}</p>
                </div>
                <label class="flex items-center gap-1.5 text-xs text-red-500 hover:text-red-700 cursor-pointer flex-shrink-0">
                    <input type="checkbox" name="banner_image_clear" value="1" class="rounded border-gray-300 text-red-500 w-3.5 h-3.5">
                    Remove
                </label>
            </div>
            @endif

            <div x-data="{ bannerMode: '{{ $biTypeInit }}' }">
                <div class="flex items-center gap-1 bg-gray-100 p-1 rounded-lg w-fit mb-3">
                    <button type="button" @click="bannerMode = 'upload'"
                            :class="bannerMode === 'upload' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'"
                            class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Upload File</button>
                    <button type="button" @click="bannerMode = 'url'"
                            :class="bannerMode === 'url' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'"
                            class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Image URL</button>
                </div>
                <div x-show="bannerMode === 'upload'" :style="bannerMode === 'upload' ? '' : 'display:none'">
                    <input type="file" name="banner_image" accept="image/*"
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                    <p class="mt-1.5 text-xs text-gray-400">Max 4MB. Recommended: 1400x400px landscape.</p>
                </div>
                <div x-show="bannerMode === 'url'" :style="bannerMode === 'url' ? '' : 'display:none'">
                    <input type="url" name="banner_image_url"
                           value="{{ $biTypeInit === 'url' ? $bi : '' }}"
                           placeholder="https://example.com/banner.jpg"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
        </div>

        {{-- Basic Info --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Basic Information</h3>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Parent Program</label>
                    <select name="program_id" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        <option value="">-- No Program --</option>
                        @foreach($programs ?? [] as $program)
                            <option value="{{ $program->id }}" {{ old('program_id', $item->program_id) == $program->id ? 'selected' : '' }}>{{ $program->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl w-full">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $item->is_active) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                        <label for="is_active" class="text-sm font-medium text-gray-700">Active (shown publicly)</label>
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Title <span class="text-red-400">*</span></label>
                <input type="text" name="title" value="{{ old('title', $item->title) }}" required
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Short Description</label>
                <textarea name="description" rows="2" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('description', $item->description) }}</textarea>
                <p class="mt-1 text-xs text-gray-400">Shown as subtitle in the page header banner.</p>
            </div>
        </div>

        {{-- Detailed Content --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Detailed Content</h3>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Objective</label>
                <textarea name="objective" rows="2" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('objective', $item->objective) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Project Content</label>
                <textarea name="content" rows="5" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">{{ old('content', $item->content) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Activities</label>
                <textarea name="activities" rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none" placeholder="Activity 1&#10;Activity 2">{{ old('activities', $item->activities) }}</textarea>
            </div>
        </div>

        {{-- Project Image --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4"
             x-data="{ imageMode: '{{ str_starts_with($item->image ?? '', 'http') ? 'url' : 'upload' }}' }">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Project Card Image</h3>
            @if($item->image)
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl border border-gray-100">
                <img src="{{ str_starts_with($item->image, 'http') ? $item->image : asset('storage/' . $item->image) }}" class="h-12 w-20 rounded-lg object-cover border border-gray-200 flex-shrink-0">
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-medium text-gray-600 mb-0.5">Current image</p>
                    <p class="text-xs text-gray-400 truncate">{{ $item->image }}</p>
                </div>
                <div class="flex items-center gap-1 bg-gray-100 p-0.5 rounded flex-shrink-0">
                    <button type="button" @click="imageMode = 'upload'" :class="imageMode === 'upload' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500'" class="px-2 py-1 text-[10px] font-medium rounded transition-all">Replace File</button>
                    <button type="button" @click="imageMode = 'url'" :class="imageMode === 'url' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500'" class="px-2 py-1 text-[10px] font-medium rounded transition-all">Replace URL</button>
                </div>
            </div>
            @else
            <div class="flex items-center gap-1 bg-gray-100 p-1 rounded-lg w-fit mb-1">
                <button type="button" @click="imageMode = 'upload'" :class="imageMode === 'upload' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500'" class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Upload File</button>
                <button type="button" @click="imageMode = 'url'" :class="imageMode === 'url' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500'" class="px-3 py-1.5 text-xs font-medium rounded-md transition-all">Image URL</button>
            </div>
            @endif
            <div x-show="imageMode === 'upload'" :style="imageMode === 'upload' ? '' : 'display:none'">
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] border border-gray-200 rounded-xl p-1">
            </div>
            <div x-show="imageMode === 'url'" :style="imageMode === 'url' ? '' : 'display:none'">
                <input type="url" name="image_url" placeholder="https://example.com/image.jpg"
                       value="{{ str_starts_with($item->image ?? '', 'http') ? $item->image : '' }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
        </div>

        {{-- Testimony --}}
        <div class="bg-[#2d6fa3]/5 rounded-2xl border border-[#2d6fa3]/10 p-6 space-y-4">
            <h3 class="text-xs font-bold text-[#2d6fa3] uppercase tracking-wider">Testimony</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Name &amp; Role</label>
                    <input type="text" name="testimony_name" value="{{ old('testimony_name', $item->testimony_name) }}"
                           placeholder="e.g., Sam March, 17 years old"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div x-data="{ testyMode: '{{ str_starts_with($item->testimony_image ?? '', 'http') ? 'url' : 'upload' }}' }">
                    @if($item->testimony_image)
                    <div class="flex items-center gap-2 mb-2">
                        <img src="{{ str_starts_with($item->testimony_image, 'http') ? $item->testimony_image : asset('storage/' . $item->testimony_image) }}" class="h-10 w-10 rounded-full object-cover shadow-sm border border-gray-200">
                        <span class="text-xs text-gray-500">Current photo</span>
                    </div>
                    @endif
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-sm font-medium text-gray-700">{{ $item->testimony_image ? 'Replace Photo' : 'Testimony Photo' }}</label>
                        <div class="flex items-center gap-1 bg-gray-100 p-0.5 rounded">
                            <button type="button" @click="testyMode = 'upload'" :class="testyMode === 'upload' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500'" class="px-2 py-1 text-[10px] font-medium rounded transition-all">File</button>
                            <button type="button" @click="testyMode = 'url'" :class="testyMode === 'url' ? 'bg-white shadow-sm text-[#2d6fa3]' : 'text-gray-500'" class="px-2 py-1 text-[10px] font-medium rounded transition-all">URL</button>
                        </div>
                    </div>
                    <div x-show="testyMode === 'upload'">
                        <input type="file" name="testimony_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] border border-gray-200 rounded-xl p-1">
                    </div>
                    <div x-show="testyMode === 'url'" :style="testyMode === 'url' ? '' : 'display:none'">
                        <input type="url" name="testimony_image_url" placeholder="https://"
                               value="{{ str_starts_with($item->testimony_image ?? '', 'http') ? $item->testimony_image : '' }}"
                               class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Story / Quote</label>
                <textarea name="testimony_story" rows="4" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">{{ old('testimony_story', $item->testimony_story) }}</textarea>
            </div>
        </div>

        {{-- Key Info & Donations --}}
        <div class="bg-[#e8a020]/5 rounded-2xl border border-[#e8a020]/10 p-6 space-y-4">
            <h3 class="text-xs font-bold text-[#e8a020] uppercase tracking-wider">Project Key Info &amp; Donations</h3>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Area of Work</label>
                    <input type="text" name="area_of_work" value="{{ old('area_of_work', $item->area_of_work) }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Duration</label>
                    <input type="text" name="duration" value="{{ old('duration', $item->duration) }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Location</label>
                    <input type="text" name="location" value="{{ old('location', $item->location) }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Beneficiaries</label>
                    <input type="text" name="beneficiaries" value="{{ old('beneficiaries', $item->beneficiaries) }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Make a Difference (Donation details)</label>
                <textarea name="make_difference_text" rows="3" placeholder="e.g. $50 - food expenses per child per month"
                          class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('make_difference_text', $item->make_difference_text) }}</textarea>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3 pb-4">
            <button type="submit" class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-semibold rounded-xl transition-colors">
                Save Changes
            </button>
            <a href="{{ route('admin.projects.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
            <a href="{{ route('projects.show', $item) }}" target="_blank"
               class="ml-auto flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View live page
            </a>
        </div>
    </form>
</div>
@endsection