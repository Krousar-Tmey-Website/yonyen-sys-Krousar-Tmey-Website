@extends('admin.layouts.app')

@section('title', 'Job Opportunities')
@section('page-title', 'Job Opportunities')
@section('breadcrumb', 'Manage job postings on the Get Involved page')

@section('content')

<div class="grid lg:grid-cols-3 gap-6">
    {{-- Add form --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-700 mb-4 text-sm">Add New Job</h3>
        <form action="{{ route('admin.jobs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
            @csrf
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Job Title <span class="text-red-400">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="e.g. Social Worker">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Type</label>
                <input type="text" name="type" value="{{ old('type') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="Full-time">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Location</label>
                <input type="text" name="location" value="{{ old('location') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="Phnom Penh">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Posted Date</label>
                <input type="date" name="posted_date" value="{{ old('posted_date', date('Y-m-d')) }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Status <span class="text-red-400">*</span></label>
                <select name="status"
                        class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    @foreach(['open' => 'Open', 'closed' => 'Closed', 'draft' => 'Draft'] as $value => $label)
                        <option value="{{ $value }}" {{ old('status', 'open') === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                <textarea name="description" rows="3"
                          class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                          placeholder="Brief job description...">{{ old('description') }}</textarea>
            </div>
            {{-- Active checkbox --}}
            <label class="flex items-center gap-2 cursor-pointer select-none px-3.5 py-2.5 rounded-xl border border-gray-200 bg-gray-50 hover:border-gray-300 transition-all">
                <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 accent-[#2d6fa3] cursor-pointer">
                <span class="text-xs font-semibold text-gray-600">Active (visible on website)</span>
            </label>
            {{-- Image upload --}}
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Job Image</label>
                <p class="text-xs text-gray-400 mb-2">PNG, JPG or WebP (max 2MB)</p>
                <label for="image" id="image-dropzone"
                       class="group flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-2xl cursor-pointer bg-gray-50 hover:bg-[#2d6fa3]/5 hover:border-[#2d6fa3] transition-all duration-200">
                    <div class="flex flex-col items-center justify-center" id="image-placeholder">
                        <div class="w-10 h-10 rounded-full bg-white border border-gray-200 shadow-sm flex items-center justify-center mb-2 group-hover:scale-110 group-hover:border-[#2d6fa3]/30 transition-all duration-200">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-[#2d6fa3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1117.9 9H18a4 4 0 010 8h-1m-4-4l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-[#2d6fa3]">Click to upload image</p>
                        <p class="text-xs text-gray-400 mt-0.5">or drag and drop — PNG, JPG, WebP</p>
                    </div>
                    <div class="hidden flex-col items-center justify-center gap-1" id="image-selected">
                        <div class="w-10 h-10 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-700 px-4 text-center truncate max-w-full" id="image-filename"></p>
                        <p class="text-xs text-[#2d6fa3]">Click to choose a different file</p>
                    </div>
                    <input id="image" type="file" name="image" accept="image/*" class="hidden"
                           onchange="
                               const f = this.files[0];
                               if (f) {
                                   document.getElementById('image-placeholder').classList.add('hidden');
                                   document.getElementById('image-selected').classList.remove('hidden');
                                   document.getElementById('image-selected').classList.add('flex');
                                   document.getElementById('image-filename').textContent = f.name;
                               }
                           ">
                </label>
                @error('image')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full btn-primary text-sm py-2.5">Add Job</button>
        </form>
    </div>

    {{-- Jobs list --}}
    <div class="lg:col-span-2">
        @if($jobs->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 py-12 text-center text-gray-400 text-sm">
            No job opportunities yet. Add your first one.
        </div>
        @else
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <div class="px-5 py-3.5 bg-gray-50 border-b border-gray-100">
                <h4 class="font-semibold text-gray-700 text-sm">{{ $jobs->count() }} Job(s)</h4>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($jobs as $job)
                <div x-data="{ editing: false }">
                    {{-- View row --}}
                    <div class="px-5 py-4 hover:bg-gray-50/50" x-show="!editing">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start gap-3 min-w-0">
                                @if($job->image)
                                <div class="w-10 h-10 rounded-lg overflow-hidden flex-shrink-0 mt-0.5 border border-gray-100">
                                    <img src="{{ asset('storage/' . $job->image) }}" class="w-full h-full object-cover" alt="{{ $job->title }}">
                                </div>
                                @endif
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <p class="font-semibold text-gray-700 text-sm">{{ $job->title }}</p>
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full
                                            {{ $job->status === 'open' ? 'bg-green-50 text-green-700' : ($job->status === 'closed' ? 'bg-red-50 text-red-700' : 'bg-gray-100 text-gray-600') }}">
                                            {{ strtoupper($job->status) }}
                                        </span>
                                        @if(!$job->is_active)
                                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-yellow-50 text-yellow-700">INACTIVE</span>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-3 mt-1 text-xs text-gray-500">
                                        @if($job->type)
                                        <span>{{ $job->type }}</span>
                                        @endif
                                        @if($job->location)
                                        <span>{{ $job->location }}</span>
                                        @endif
                                        @if($job->posted_date)
                                        <span class="flex items-center gap-1 text-gray-400">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            {{ $job->posted_date->format('M d, Y') }}
                                        </span>
                                        @endif
                                    </div>
                                    @if($job->description)
                                    <p class="text-gray-400 text-xs mt-1 line-clamp-2">{{ $job->description }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center gap-2 flex-shrink-0 ml-3">
                                <button @click="editing = true" title="Edit"
                                        class="w-8 h-8 rounded-full bg-[#2d6fa3]/10 text-[#2d6fa3] hover:bg-[#2d6fa3]/20 flex items-center justify-center transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" title="Delete"
                                            class="w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Edit form --}}
                    <div class="px-5 py-4 bg-gray-50 border-t border-gray-100" x-show="editing" x-cloak>
                        <form action="{{ route('admin.jobs.update', $job) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            @csrf @method('PUT')
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Title</label>
                                <input type="text" name="title" value="{{ $job->title }}" required
                                       class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Type</label>
                                <input type="text" name="type" value="{{ $job->type }}"
                                       class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Location</label>
                                <input type="text" name="location" value="{{ $job->location }}"
                                       class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Posted Date</label>
                                <input type="date" name="posted_date" value="{{ old('posted_date', $job->posted_date?->format('Y-m-d')) }}"
                                       class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Status</label>
                                <select name="status"
                                        class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                                    @foreach(['open' => 'Open', 'closed' => 'Closed', 'draft' => 'Draft'] as $value => $label)
                                        <option value="{{ $value }}" {{ $job->status === $value ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                                <textarea name="description" rows="3"
                                          class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3] resize-none">{{ $job->description }}</textarea>
                            </div>
                            {{-- Active checkbox --}}
                            <label class="flex items-center gap-2 cursor-pointer select-none px-3.5 py-2.5 rounded-xl border border-gray-200 bg-white hover:border-gray-300 transition-all">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" name="is_active" value="1" {{ $job->is_active ? 'checked' : '' }} class="w-4 h-4 accent-[#2d6fa3] cursor-pointer">
                                <span class="text-xs font-semibold text-gray-600">Active (visible on website)</span>
                            </label>
                            {{-- Edit image upload --}}
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Job Image</label>
                                <p class="text-xs text-gray-400 mb-2">PNG, JPG or WebP (max 2MB)</p>

                                @if($job->image)
                                <div class="mb-3 flex items-center gap-3 bg-white border border-gray-200 rounded-xl p-3">
                                    <div class="w-14 h-14 bg-white rounded-lg border border-gray-100 overflow-hidden flex-shrink-0">
                                        <img src="{{ asset('storage/' . $job->image) }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <p class="text-xs font-medium text-gray-700">Current image</p>
                                        <label class="inline-flex items-center gap-1.5 text-xs text-red-400 hover:text-red-600 cursor-pointer mt-1">
                                            <input type="checkbox" name="remove_image" value="1" class="w-3.5 h-3.5 accent-red-500">
                                            Remove this image
                                        </label>
                                    </div>
                                </div>
                                @endif

                                <label for="edit-image-{{ $job->id }}" id="edit-image-dropzone-{{ $job->id }}"
                                       class="group flex flex-col items-center justify-center w-full h-28 border-2 border-dashed border-gray-300 rounded-2xl cursor-pointer bg-white hover:bg-[#2d6fa3]/5 hover:border-[#2d6fa3] transition-all duration-200">
                                    <div class="flex flex-col items-center justify-center" id="edit-image-placeholder-{{ $job->id }}">
                                        <div class="w-9 h-9 rounded-full bg-white border border-gray-200 shadow-sm flex items-center justify-center mb-1.5 group-hover:scale-110 group-hover:border-[#2d6fa3]/30 transition-all duration-200">
                                            <svg class="w-4 h-4 text-gray-400 group-hover:text-[#2d6fa3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <p class="text-xs font-semibold text-[#2d6fa3]">{{ $job->image ? 'Replace image' : 'Upload image' }}</p>
                                        <p class="text-[11px] text-gray-400 mt-0.5">PNG, JPG, WebP</p>
                                    </div>
                                    <div class="hidden flex-col items-center justify-center gap-1" id="edit-image-selected-{{ $job->id }}">
                                        <div class="w-9 h-9 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-xs font-medium text-gray-700 px-3 text-center truncate max-w-full" id="edit-image-filename-{{ $job->id }}"></p>
                                    </div>
                                    <input id="edit-image-{{ $job->id }}" type="file" name="image" accept="image/*" class="hidden"
                                           onchange="
                                               const f = this.files[0];
                                               if (f) {
                                                   document.getElementById('edit-image-placeholder-{{ $job->id }}').classList.add('hidden');
                                                   document.getElementById('edit-image-selected-{{ $job->id }}').classList.remove('hidden');
                                                   document.getElementById('edit-image-selected-{{ $job->id }}').classList.add('flex');
                                                   document.getElementById('edit-image-filename-{{ $job->id }}').textContent = f.name;
                                               }
                                           ">
                                </label>
                                @error('image')
                                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                                @enderror
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
