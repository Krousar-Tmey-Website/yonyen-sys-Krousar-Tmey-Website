@extends('admin.layouts.app')

@section('title', 'Job Opportunities')
@section('page-title', 'Job Opportunities')
@section('breadcrumb', 'Manage job postings on the Get Involved page')

@section('content')

<div x-data="{ openAddModal: {{ $errors->any() ? 'true' : 'false' }}, addLang: 'en' }">
    {{-- Add form modal --}}
    <div x-show="openAddModal" class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm" x-cloak>
        <div class="bg-white rounded-2xl border border-gray-100 p-6 max-w-lg w-full max-h-[90vh] overflow-y-auto shadow-2xl relative" @click.away="openAddModal = false">
            {{-- Close button --}}
            <button @click="openAddModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <h3 class="font-bold text-gray-800 text-lg mb-4">Add New Job</h3>
            <form action="{{ route('admin.jobs.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf


                <div x-show="addLang === 'en'">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Job Title <span class="text-red-400">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" :required="addLang === 'en'"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="e.g. Social Worker">
                </div>
                <div x-show="addLang === 'fr'" x-cloak>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Job Title (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <input type="text" name="title_fr" value="{{ old('title_fr') }}"
                           class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="ex. Travailleur social">
                </div>
                <div class="grid grid-cols-2 gap-3">
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
                </div>
                <div class="grid grid-cols-2 gap-3">
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
                </div>
                <div x-show="addLang === 'en'">
                    <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                    <textarea name="description" rows="3"
                              class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                              placeholder="Brief job description...">{{ old('description') }}</textarea>
                </div>
                <div x-show="addLang === 'fr'" x-cloak>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Description (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                    <textarea name="description_fr" rows="3"
                              class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                              placeholder="Description sommaire du poste...">{{ old('description_fr') }}</textarea>
                </div>
                {{-- Active checkbox --}}
                <label class="flex items-center gap-2 cursor-pointer select-none px-3.5 py-2.5 rounded-xl border border-gray-200 bg-gray-50 hover:border-gray-300 transition-all">
                    <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 accent-[#2d6fa3] cursor-pointer">
                    <span class="text-xs font-semibold text-gray-600">Active (visible on website)</span>
                </label>
                {{-- Image upload --}}
                <div>
                    <label class="block text-xs font-medium text-gray-600 mb-1">Job Image</label>
                    <label for="image" id="image-dropzone"
                           class="group flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-gray-300 rounded-2xl cursor-pointer bg-gray-50 hover:bg-[#2d6fa3]/5 hover:border-[#2d6fa3] transition-all duration-200">
                        <div class="flex flex-col items-center justify-center" id="image-placeholder">
                            <p class="text-xs font-semibold text-[#2d6fa3]">Click to upload image</p>
                            <p class="text-[10px] text-gray-400 mt-0.5">PNG, JPG, WebP</p>
                        </div>
                        <div class="hidden flex-col items-center justify-center gap-1" id="image-selected">
                            <p class="text-xs font-medium text-gray-700 px-4 text-center truncate max-w-full" id="image-filename"></p>
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
                <div class="flex justify-end gap-2 pt-2">
                    <button type="button" @click="openAddModal = false" class="px-4 py-2 border border-gray-200 rounded-xl text-sm font-medium text-gray-500 hover:bg-gray-50 transition">Cancel</button>
                    <button type="submit" class="btn-primary text-sm py-2 px-5">Add Job</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Jobs list --}}
    <div class="w-full">
        @if($jobs->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 py-12 text-center text-gray-400 text-sm flex flex-col items-center gap-4">
            <span>No job opportunities yet. Add your first one.</span>
            <button @click="openAddModal = true" class="btn-primary flex items-center gap-1.5 text-xs py-2 px-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add New Job
            </button>
        </div>
        @else
        {{-- Header & Table Card --}}
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm">
            <div class="px-5 py-3.5 bg-gray-50 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <h3 class="font-bold text-gray-800 text-base">Job Opportunities</h3>
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-[#2d6fa3]/5 text-[#2d6fa3]">
                        {{ $jobs->count() }} Job(s)
                    </span>
                </div>
                <button @click="openAddModal = true" class="btn-primary flex items-center gap-1.5 text-xs py-2 px-4 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add New Job
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-gray-100">
                            <th class="px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Job Info</th>
                            <th class="px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Type</th>
                            <th class="px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Location</th>
                            <th class="px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Posted Date</th>
                            <th class="px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-5 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($jobs as $job)
                        <tr x-data="{ editing: false, lang: 'en' }" class="hover:bg-slate-50/40 transition-colors">
                            {{-- View Row --}}
                            <td class="px-5 py-4 min-w-[250px]" x-show="!editing">
                                <div class="flex items-center gap-3">
                                    @if($job->image)
                                    <div class="w-10 h-10 rounded-lg overflow-hidden flex-shrink-0 border border-gray-100 bg-slate-100">
                                        <img src="{{ asset('storage/' . $job->image) }}" class="w-full h-full object-cover">
                                    </div>
                                    @else
                                    <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center text-xl flex-shrink-0 border border-gray-100">
                                        💼
                                    </div>
                                    @endif
                                    <div class="min-w-0">
                                        <span class="font-bold text-gray-800 text-sm block truncate">{{ $job->title }}</span>
                                        @if($job->description)
                                        <span class="text-xs text-gray-400 block truncate max-w-[200px] mt-0.5">{{ $job->description }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-xs font-medium text-gray-600" x-show="!editing">
                                {{ $job->type ?: '-' }}
                            </td>
                            <td class="px-5 py-4 text-xs text-gray-600" x-show="!editing">
                                {{ $job->location ?: '-' }}
                            </td>
                            <td class="px-5 py-4 text-xs text-gray-400" x-show="!editing">
                                {{ $job->posted_date ? $job->posted_date->format('M d, Y') : '-' }}
                            </td>
                            <td class="px-5 py-4" x-show="!editing">
                                <div class="flex items-center gap-1.5 flex-wrap">
                                    <span class="text-[9px] font-bold px-2 py-0.5 rounded-full 
                                        {{ $job->status === 'open' ? 'bg-green-50 text-green-700' : ($job->status === 'closed' ? 'bg-red-50 text-red-700' : 'bg-gray-100 text-gray-600') }}">
                                        {{ strtoupper($job->status) }}
                                    </span>
                                    @if(!$job->is_active)
                                    <span class="text-[9px] font-bold px-2 py-0.5 rounded-full bg-yellow-50 text-yellow-700">INACTIVE</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-5 py-4 text-right" x-show="!editing">
                                <div class="flex items-center justify-end gap-1.5">
                                    <button @click="editing = true" title="Edit" class="w-8 h-8 rounded-full bg-[#2d6fa3]/10 text-[#2d6fa3] hover:bg-[#2d6fa3]/20 flex items-center justify-center transition shadow-sm">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" title="Delete" class="w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center transition shadow-sm">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>

                            {{-- Edit Inline Row --}}
                            <td colspan="6" class="px-5 py-4 bg-slate-50/80" x-show="editing" x-cloak>
                                <form action="{{ route('admin.jobs.update', $job) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                    @csrf @method('PUT')
                                    <div class="flex items-center justify-between border-b border-gray-100 pb-2">
                                        <div class="flex items-center justify-between mb-4"><span class="text-xs font-bold text-gray-700">Edit Job: {{ $job->title }}</span>
    <div class="lang-tabs" title="Toggle editing language (English / French)">
    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
</div>
</div>
                                        <div class="flex items-center gap-3">
                                            <button type="button" @click="editing = false" class="text-gray-400 hover:text-gray-600">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
<div x-show="lang === 'en'">
                                            <label class="block text-[10px] font-medium text-gray-500 mb-0.5">Job Title</label>
                                            <input type="text" name="title" value="{{ $job->title }}" :required="lang === 'en'"
                                                   class="w-full px-2.5 py-1.5 border border-gray-200 rounded-lg text-xs focus:outline-none focus:border-[#2d6fa3]">
                                        </div>
                                        <div x-show="lang === 'fr'" x-cloak>
                                            <label class="block text-[10px] font-medium text-gray-500 mb-0.5">Job Title (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                                            <input type="text" name="title_fr" value="{{ $job->title_fr }}"
                                                   class="w-full px-2.5 py-1.5 border border-gray-200 rounded-lg text-xs focus:outline-none focus:border-[#2d6fa3]">
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-medium text-gray-500 mb-0.5">Type</label>
                                            <input type="text" name="type" value="{{ $job->type }}"
                                                   class="w-full px-2.5 py-1.5 border border-gray-200 rounded-lg text-xs focus:outline-none focus:border-[#2d6fa3]">
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-medium text-gray-500 mb-0.5">Location</label>
                                            <input type="text" name="location" value="{{ $job->location }}"
                                                   class="w-full px-2.5 py-1.5 border border-gray-200 rounded-lg text-xs focus:outline-none focus:border-[#2d6fa3]">
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-medium text-gray-500 mb-0.5">Posted Date</label>
                                            <input type="date" name="posted_date" value="{{ old('posted_date', $job->posted_date?->format('Y-m-d')) }}"
                                                   class="w-full px-2.5 py-1.5 border border-gray-200 rounded-lg text-xs focus:outline-none focus:border-[#2d6fa3]">
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                        <div class="md:col-span-2" x-show="lang === 'en'">
                                            <label class="block text-[10px] font-medium text-gray-500 mb-0.5">Description</label>
                                            <textarea name="description" rows="2"
                                                      class="w-full px-2.5 py-1.5 border border-gray-200 rounded-lg text-xs focus:outline-none focus:border-[#2d6fa3] resize-none">{{ $job->description }}</textarea>
                                        </div>
                                        <div class="md:col-span-2" x-show="lang === 'fr'" x-cloak>
                                            <label class="block text-[10px] font-medium text-gray-500 mb-0.5">Description (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                                            <textarea name="description_fr" rows="2"
                                                      class="w-full px-2.5 py-1.5 border border-gray-200 rounded-lg text-xs focus:outline-none focus:border-[#2d6fa3] resize-none">{{ $job->description_fr }}</textarea>
                                        </div>
                                        <div>
                                            <label class="block text-[10px] font-medium text-gray-500 mb-0.5">Status</label>
                                            <select name="status"
                                                    class="w-full px-2.5 py-1.5 border border-gray-200 rounded-lg text-xs focus:outline-none focus:border-[#2d6fa3] mb-2">
                                                @foreach(['open' => 'Open', 'closed' => 'Closed', 'draft' => 'Draft'] as $value => $label)
                                                    <option value="{{ $value }}" {{ $job->status === $value ? 'selected' : '' }}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                            <label class="flex items-center gap-1.5 cursor-pointer select-none">
                                                <input type="hidden" name="is_active" value="0">
                                                <input type="checkbox" name="is_active" value="1" {{ $job->is_active ? 'checked' : '' }} class="w-3.5 h-3.5 accent-[#2d6fa3] cursor-pointer">
                                                <span class="text-[10px] font-semibold text-gray-600">Active (visible on site)</span>
                                            </label>
                                        </div>
                                    </div>
                                    
                                    {{-- Edit image upload --}}
                                    <div class="border-t border-gray-100 pt-2 mt-2">
                                        <label class="block text-[10px] font-medium text-gray-500 mb-1">Job Image</label>
                                        <div class="flex items-center gap-3">
                                            @if($job->image)
                                            <div class="w-10 h-10 rounded bg-white border border-gray-100 overflow-hidden flex-shrink-0">
                                                <img src="{{ asset('storage/' . $job->image) }}" class="w-full h-full object-cover">
                                            </div>
                                            <label class="inline-flex items-center gap-1 text-[10px] text-red-500 cursor-pointer">
                                                <input type="checkbox" name="remove_image" value="1" class="w-3 h-3 accent-red-500">
                                                Remove image
                                            </label>
                                            @endif
                                            <input type="file" name="image" accept="image/*" class="text-xs text-gray-500 file:mr-2 file:py-1 file:px-2 file:rounded-md file:border-0 file:text-[10px] file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                                        </div>
                                    </div>
                                    <div class="flex gap-2 pt-2 border-t border-gray-100 mt-2">
                                        <button type="submit" class="btn-primary text-[11px] px-3.5 py-1.5">Save Changes</button>
                                        <button type="button" @click="editing = false" class="text-gray-400 hover:text-gray-600 text-[11px] px-3.5 py-1.5">Cancel</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
