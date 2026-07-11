@extends('admin.layouts.app')

@section('title', 'Awards')
@section('page-title', 'Awards')
@section('breadcrumb', 'Manage awards displayed on the About page')

@section('content')

<div class="grid lg:grid-cols-3 gap-6">

    {{-- Add / Edit Award form --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 h-fit">
        <h3 class="font-bold text-gray-700 mb-5 text-sm">
            {{ isset($editAward) ? 'Edit Award' : 'Add New Award' }}
        </h3>

        <form action="{{ isset($editAward) ? route('admin.awards.update', $editAward) : route('admin.awards.store') }}"
              method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @if(isset($editAward))
                @method('PUT')
            @endif

            {{-- TITLE --}}
            <div>
                <label for="title" class="form-label">
                    Award Title <span class="text-red-400 font-normal">*</span>
                </label>
                <input type="text" id="title" name="title" required autocomplete="off"
                       value="{{ old('title', $editAward->title ?? '') }}"
                       class="form-input {{ $errors->has('title') ? 'form-input-error' : '' }}"
                       placeholder="e.g. International Education Award">
                @error('title')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- ORGANIZATION --}}
            <div>
                <label for="organization" class="form-label">
                    Organization <span class="text-red-400 font-normal">*</span>
                </label>
                <input type="text" id="organization" name="organization" required autocomplete="off"
                       value="{{ old('organization', $editAward->organization ?? '') }}"
                       class="form-input {{ $errors->has('organization') ? 'form-input-error' : '' }}"
                       placeholder="Awarding organization...">
                @error('organization')
                    <p class="text-xs text-red-500 mt-1.5">{{ $message }}</p>
                @enderror
            </div>

            {{-- RECIPIENT --}}
            <div>
                <label for="recipient" class="form-label">
                    Recipient <span class="text-gray-400 font-normal">(optional)</span>
                </label>
                <input type="text" id="recipient" name="recipient" autocomplete="off"
                       value="{{ old('recipient', $editAward->recipient ?? '') }}"
                       class="form-input"
                       placeholder="Person name if applicable...">
            </div>

            {{-- DESCRIPTION --}}
            <div>
                <label for="description" class="form-label">
                    Description
                </label>
                <textarea id="description" name="description" rows="2"
                          class="form-input resize-none"
                          placeholder="Short description...">{{ old('description', $editAward->description ?? '') }}</textarea>
            </div>

            {{-- LINKS --}}
            <div>
                <label class="form-label mb-2">Links for Visitors</label>
                <p class="text-xs text-gray-400 mb-3">Add URLs for visitors to learn more (optional)</p>
                
                <div class="space-y-3">
                    <div>
                        <label for="website_url" class="text-xs font-medium text-gray-600">Website URL</label>
                        <input type="url" id="website_url" name="website_url" 
                               value="{{ old('website_url', $editAward->website_url ?? '') }}"
                               class="form-input text-sm"
                               placeholder="https://example.com">
                    </div>
                    <div>
                        <label for="article_url" class="text-xs font-medium text-gray-600">Article URL</label>
                        <input type="url" id="article_url" name="article_url"
                               value="{{ old('article_url', $editAward->article_url ?? '') }}"
                               class="form-input text-sm"
                               placeholder="https://article-link.com">
                    </div>
                    <div>
                        <label for="video_url" class="text-xs font-medium text-gray-600">Video URL</label>
                        <input type="url" id="video_url" name="video_url"
                               value="{{ old('video_url', $editAward->video_url ?? '') }}"
                               class="form-input text-sm"
                               placeholder="https://youtube.com/watch?v=...">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                {{-- SORT ORDER --}}
                <div>
                    <label for="sort_order" class="form-label">Order</label>
                    <input type="number" id="sort_order" name="sort_order"
                           value="{{ old('sort_order', $editAward->sort_order ?? 0) }}"
                           class="form-input">
                </div>

                {{-- ACTIVE (edit only — new awards are active by default) --}}
                @if(isset($editAward))
                <div class="flex items-end pb-1.5">
                    <label class="flex items-center gap-2 cursor-pointer select-none px-3.5 py-2.5 rounded-xl border border-gray-300 bg-gray-50 hover:border-gray-400 hover:bg-white transition-all duration-150 w-full">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $editAward->is_active) ? 'checked' : '' }}
                               class="w-4 h-4 accent-[#2d6fa3] cursor-pointer">
                        <span class="text-xs font-semibold text-gray-600">Active</span>
                    </label>
                </div>
                @endif
            </div>

            {{-- IMAGE --}}
            <div>
                <label class="form-label">Award Image</label>
                <p class="text-xs text-gray-400 mb-2.5">PNG, JPG or SVG (max 2MB)</p>

                <label for="image" id="image-dropzone"
                       class="group flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-gray-300 rounded-2xl cursor-pointer bg-gray-50 hover:bg-[#2d6fa3]/5 hover:border-[#2d6fa3] transition-all duration-200">
                    <div class="flex flex-col items-center justify-center" id="image-placeholder">
                        <div class="w-11 h-11 rounded-full bg-white border border-gray-200 shadow-sm flex items-center justify-center mb-2.5 group-hover:scale-110 group-hover:border-[#2d6fa3]/30 transition-all duration-200">
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-[#2d6fa3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1117.9 9H18a4 4 0 010 8h-1m-4-4l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-[#2d6fa3]">Click to upload image</p>
                        <p class="text-xs text-gray-400 mt-0.5">or drag and drop — PNG, JPG, SVG</p>
                    </div>
                    <div class="hidden flex-col items-center justify-center gap-1.5" id="image-selected">
                        <div class="w-11 h-11 rounded-full bg-emerald-50 border border-emerald-100 flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-medium text-gray-700 px-4 text-center truncate max-w-full" id="image-filename"></p>
                        <p class="text-xs text-[#2d6fa3]">Click to choose a different file</p>
                    </div>
                    <input id="image" type="file" name="image" accept="image/png,image/jpeg,image/webp,image/svg+xml" class="hidden"
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

                @if(isset($editAward) && $editAward->image_url)
                <div class="mt-4 flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-3">
                    <div class="w-12 h-12 bg-white rounded-lg border border-gray-100 flex items-center justify-center">
                        <img src="{{ $editAward->image_url }}" class="max-w-full max-h-full object-contain p-1">
                    </div>
                    <p class="text-xs text-gray-400">Current image</p>
                </div>
                <div class="mt-2">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" name="remove_image" value="1"
                               class="w-4 h-4 accent-[#2d6fa3] cursor-pointer">
                        <span class="text-xs text-gray-600">Remove current image</span>
                    </label>
                </div>
                @endif
            </div>

            <button type="submit" class="w-full btn-primary justify-center text-sm py-2.5">
                {{ isset($editAward) ? 'Update Award' : 'Add Award' }}
            </button>

            @if(isset($editAward))
            <a href="{{ route('admin.awards.index') }}" class="block text-center text-xs text-gray-400 hover:text-gray-600 transition-colors">Cancel edit</a>
            @endif
        </form>
    </div>

    {{-- Awards list --}}
    <div class="lg:col-span-2 space-y-5"
         x-data="{
            search: @js($filters['search'] ?? ''),
            total: @js($totalAwards),
            loading: false,
            applyFilters() {
                this.loading = true;
                const params = new URLSearchParams();
                if (this.search) params.set('search', this.search);
                const url = '{{ route('admin.awards.index') }}' + (params.toString() ? '?' + params.toString() : '');
                fetch(url, { headers: { 'Accept': 'application/json' } })
                    .then(r => r.json())
                    .then(data => {
                        this.$refs.results.innerHTML = data.html;
                        this.total = data.total;
                        history.replaceState(null, '', url);
                        this.loading = false;
                    })
                    .catch(() => { this.loading = false; });
            }
         }"
         x-init="$watch('search', () => applyFilters())">

        {{-- Toolbar: title, count, search --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-center justify-between flex-wrap gap-4 mb-4">
                <div class="flex items-center gap-2">
                    <h3 class="font-bold text-gray-800">All Awards</h3>
                    <span class="px-2.5 py-1 bg-[#2d6fa3]/10 text-[#2d6fa3] rounded-full text-xs font-semibold">
                        Showing <span x-text="total">{{ $totalAwards }}</span>
                    </span>
                </div>
            </div>

            <form method="GET" action="{{ route('admin.awards.index') }}" class="flex flex-wrap items-center gap-3" @submit.prevent="applyFilters()">
                <div class="relative flex-1 min-w-[220px]">
                    <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                           x-model.debounce.400ms="search"
                           placeholder="Search by title or organization..."
                           autocomplete="off"
                           class="w-full bg-gray-50 border border-gray-300 rounded-full pl-10 pr-4 py-2.5 text-sm text-gray-700 placeholder:text-gray-400 transition-all duration-150 hover:border-gray-400 focus:outline-none focus:bg-white focus:border-[#2d6fa3] focus:ring-4 focus:ring-[#2d6fa3]/15">
                </div>

                <button type="submit" @click.prevent="applyFilters()"
                        class="px-5 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-full text-sm font-semibold transition-colors">
                    Search
                </button>

                <a href="{{ route('admin.awards.index') }}" @click.prevent="search = ''; applyFilters()"
                   class="px-5 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-500 rounded-full text-sm font-medium transition-colors">
                    Reset
                </a>
            </form>
        </div>

        {{-- Results --}}
        <div x-ref="results" class="space-y-5" :class="loading ? 'opacity-50' : ''" style="transition: opacity 150ms">
            @include('admin.awards._results', ['awards' => $awards, 'filters' => $filters])
        </div>
    </div>
</div>

@endsection