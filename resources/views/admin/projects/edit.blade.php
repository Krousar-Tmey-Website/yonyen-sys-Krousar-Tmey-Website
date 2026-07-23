@extends('admin.layouts.app')
@section('title', 'Edit Project — ' . $item->title)
@section('page-title', 'Edit Project')
@section('breadcrumb', $item->title)
@php use Illuminate\Support\Str; @endphp

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

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
                        @foreach($programs as $program)
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
                <textarea name="description" data-ckeditor rows="2" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('description', $item->description) }}</textarea>
                <p class="mt-1 text-xs text-gray-400">Shown as subtitle in the page header banner.</p>
            </div>
        </div>

        {{-- Detailed Content --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Detailed Content</h3>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Objective</label>
                <textarea name="objective" data-ckeditor rows="2" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('objective', $item->objective) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Project Content (HTML Supported)</label>
                <textarea name="content" data-ckeditor rows="5" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]" placeholder="Full content (HTML is supported)...">{{ old('content', $item->content) }}</textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Activities</label>
                <textarea name="activities" data-ckeditor rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none" placeholder="Activity 1&#10;Activity 2">{{ old('activities', $item->activities) }}</textarea>
                <p class="mt-1 text-xs text-gray-400">Each new line will be displayed as a bullet point on the public page.</p>
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
                <textarea name="testimony_story" data-ckeditor rows="4" class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">{{ old('testimony_story', $item->testimony_story) }}</textarea>
            </div>
        </div>

        <div class="bg-[#e8a020]/5 rounded-2xl border border-[#e8a020]/10 p-6 space-y-3">
            <h3 class="text-xs font-bold text-[#e8a020] uppercase tracking-wider">Public Project Page Details</h3>
            <p class="text-sm text-gray-600">
                Project-specific public page details are now managed from the dedicated <strong>Project Defaults</strong> page.
            </p>
            <div class="flex flex-wrap items-center gap-3 pt-1">
                <a href="{{ route('admin.project-defaults.index', ['project' => $item->id]) }}"
                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-[#1d4e7a] hover:bg-[#163b5e] text-white text-sm font-semibold rounded-xl transition-colors">
                    Configure This Project Page
                </a>
                <span class="text-xs text-gray-500">Set shared defaults or choose specific details for this project from that screen.</span>
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

    {{-- ── Income Generation Grants (outside project form — nested forms are invalid HTML) ── --}}
    <div class="bg-[#8da83a]/5 rounded-2xl border border-[#8da83a]/20 p-6 space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-xs font-bold text-[#8da83a] uppercase tracking-wider">Income Generation Grants</h3>
            <span class="text-xs text-gray-400">{{ $grants->count() }} {{ Str::plural('grant', $grants->count()) }}</span>
        </div>

        @if(session('success') && str_contains(session('success'), 'rant'))
        <div class="bg-green-50 border border-green-200 text-green-700 text-xs px-3 py-2 rounded-lg flex items-center gap-2">
            <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            {{ session('success') }}
        </div>
        @endif

        {{-- Existing grants --}}
        @forelse($grants as $grant)
        <div class="bg-white rounded-xl border border-[#8da83a]/20 p-4" x-data="{ editing: false }">
            {{-- View row --}}
            <div x-show="!editing" class="flex items-center gap-4">
                <div class="w-10 h-10 rounded-lg bg-[#8da83a] flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div class="flex-1 min-w-0">
                    @if($grant->title)<p class="text-xs font-bold text-[#1a3c6e] uppercase tracking-wide">{{ $grant->title }}</p>@endif
                    <p class="text-lg font-black text-[#1a3c6e]">${{ number_format($grant->amount, 2) }}</p>
                    <p class="text-xs text-gray-500">
                        @if($grant->label){{ $grant->label }}@endif
                        @if($grant->label && $grant->recipient) &middot; @endif
                        @if($grant->recipient){{ $grant->recipient }}@endif
                    </p>
                </div>
                <div class="flex items-center gap-2 flex-shrink-0">
                    <button type="button" @click="editing = true"
                            class="px-3 py-1.5 text-xs font-medium text-[#2d6fa3] border border-[#2d6fa3]/30 rounded-lg hover:bg-[#2d6fa3]/5 transition-colors">
                        Edit
                    </button>
                    <form action="{{ route('admin.projects.grants.destroy', [$item, $grant]) }}" method="POST"
                          onsubmit="return confirm('Delete this grant?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="px-3 py-1.5 text-xs font-medium text-red-500 border border-red-200 rounded-lg hover:bg-red-50 transition-colors">Delete</button>
                    </form>
                </div>
            </div>

            {{-- Edit row --}}
            <div x-show="editing" style="display:none">
                <form action="{{ route('admin.projects.grants.update', [$item, $grant]) }}" method="POST" class="space-y-3">
                    @csrf @method('PUT')
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Section Title <span class="text-gray-400 font-normal">(optional)</span></label>
                            <input type="text" name="title" value="{{ $grant->title }}"
                                   placeholder="e.g. Income Generation"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#8da83a]/20 focus:border-[#8da83a]">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Amount (USD) <span class="text-red-400">*</span></label>
                            <input type="number" name="amount" value="{{ $grant->amount }}" step="0.01" min="0" required
                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#8da83a]/20 focus:border-[#8da83a]">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Label</label>
                            <input type="text" name="label" value="{{ $grant->label }}"
                                   placeholder="e.g. Initial grant"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#8da83a]/20 focus:border-[#8da83a]">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Recipient</label>
                            <input type="text" name="recipient" value="{{ $grant->recipient }}"
                                   placeholder="e.g. Mrs. Huot Khatna"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#8da83a]/20 focus:border-[#8da83a]">
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="submit" class="px-4 py-1.5 bg-[#8da83a] hover:bg-[#7a9232] text-white text-xs font-semibold rounded-lg transition-colors">Save</button>
                        <button type="button" @click="editing = false" class="text-xs text-gray-400 hover:text-gray-600">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        @empty
        <p class="text-xs text-gray-400 text-center py-3">No grants yet. Add one below.</p>
        @endforelse

        {{-- Add new grant --}}
        <div x-data="{ open: {{ $grants->isEmpty() ? 'true' : 'false' }} }">
            <button type="button" @click="open = !open"
                    class="w-full flex items-center justify-center gap-2 px-4 py-2.5 border-2 border-dashed border-[#8da83a]/40 hover:border-[#8da83a] text-[#8da83a] text-xs font-semibold rounded-xl transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Add Grant
            </button>
            <div x-show="open" style="display:none" class="mt-3 bg-white rounded-xl border border-[#8da83a]/20 p-4">
                <form action="{{ route('admin.projects.grants.store', $item) }}" method="POST" class="space-y-3">
                    @csrf
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Section Title <span class="text-gray-400 font-normal">(optional)</span></label>
                            <input type="text" name="title" value="{{ old('title') }}"
                                   placeholder="e.g. Income Generation"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#8da83a]/20 focus:border-[#8da83a]">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Amount (USD) <span class="text-red-400">*</span></label>
                            <input type="number" name="amount" value="{{ old('amount') }}" step="0.01" min="0" required
                                   placeholder="e.g. 779.50"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#8da83a]/20 focus:border-[#8da83a]">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Label</label>
                            <input type="text" name="label" value="{{ old('label') }}"
                                   placeholder="e.g. Initial grant"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#8da83a]/20 focus:border-[#8da83a]">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Recipient</label>
                            <input type="text" name="recipient" value="{{ old('recipient') }}"
                                   placeholder="e.g. Mrs. Huot Khatna"
                                   class="w-full px-3 py-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#8da83a]/20 focus:border-[#8da83a]">
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="submit" class="px-4 py-1.5 bg-[#8da83a] hover:bg-[#7a9232] text-white text-xs font-semibold rounded-lg transition-colors">Add Grant</button>
                        <button type="button" @click="open = false" class="text-xs text-gray-400 hover:text-gray-600">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
