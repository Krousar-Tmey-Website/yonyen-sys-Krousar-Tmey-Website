@extends('admin.layouts.app')

@section('title', 'Awards')
@section('page-title', 'Awards')
@section('breadcrumb', 'Manage awards displayed on the About page')

@section('content')

<div class="space-y-6"
     x-data="{
        showModal: false,
        editing: false,
        editingId: null,
        form: {
            year: '',
            description: '',
            website_url: '',
            article_url: '',
            video_url: '',
            sort_order: 0,
            is_active: true,
            image_url: null,
        },
        search: @js($filters['search'] ?? ''),
        total: @js($totalAwards),
        loading: false,

        get modalTitle() {
            return this.editing ? 'Edit Award' : 'Add New Award';
        },

        get submitButtonText() {
            return this.editing ? 'Update Award' : 'Add Award';
        },

        openAddModal() {
            this.editing = false;
            this.editingId = null;
            this.form = {
                year: '', description: '',
                website_url: '', article_url: '', video_url: '', sort_order: 0,
                is_active: true, image_url: null,
            };
            this.showModal = true;
            this.$nextTick(() => this.resetImageInput());
        },

        openEditModal(award) {
            this.editing = true;
            this.editingId = award.id;
            this.form = {
                year: award.year ?? '',
                description: award.description ?? '',
                website_url: award.website_url ?? '',
                article_url: award.article_url ?? '',
                video_url: award.video_url ?? '',
                sort_order: award.sort_order ?? 0,
                is_active: Boolean(award.is_active),
                image_url: award.image_url ?? null,
            };
            this.showModal = true;
            this.$nextTick(() => this.resetImageInput());
        },

        closeModal() {
            this.showModal = false;
            this.editing = false;
            this.editingId = null;
        },

        resetImageInput() {
            const fileInput = document.getElementById('modal-image-input');
            if (fileInput) fileInput.value = '';
            document.getElementById('modal-image-placeholder')?.classList.remove('hidden');
            document.getElementById('modal-image-selected')?.classList.add('hidden');
            document.getElementById('modal-image-selected')?.classList.remove('flex');
        },

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

    {{-- Toolbar: title, count, search, add button --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
        <div class="flex items-center justify-between flex-wrap gap-4 mb-4">
            <div class="flex items-center gap-2">
                <h3 class="font-bold text-gray-800">All Awards</h3>
                <span class="px-2.5 py-1 bg-[#2d6fa3]/10 text-[#2d6fa3] rounded-full text-xs font-semibold">
                    Showing <span x-text="total">{{ $totalAwards }}</span>
                </span>
            </div>

            <button @click="openAddModal()"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-full text-sm font-semibold transition-colors shadow-sm hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add New Award
            </button>
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

    {{-- Modal Backdrop & Container --}}
    <template x-teleport="body">
        <div x-show="showModal"
             x-cloak
             class="fixed inset-0 z-50 flex items-center justify-center p-4"
             @keydown.escape.window="closeModal()">
            {{-- Backdrop --}}
            <div class="fixed inset-0 bg-black/40 backdrop-blur-sm" @click="closeModal()"></div>

            {{-- Modal panel --}}
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-xl max-h-[92vh] overflow-y-auto z-10"
                 @click.stop
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">

                {{-- Header --}}
                <div class="sticky top-0 bg-white border-b border-gray-100 px-5 py-3 flex items-center justify-between rounded-t-2xl z-10">
                    <h3 class="font-bold text-gray-800 text-sm" x-text="modalTitle"></h3>
                    <button @click="closeModal()" type="button"
                            class="w-7 h-7 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition">
                        <svg class="w-3.5 h-3.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Form --}}
                <form :action="editing ? '{{ route('admin.awards.update', '__ID__') }}'.replace('__ID__', editingId) : '{{ route('admin.awards.store') }}'"
                      method="POST" enctype="multipart/form-data" class="p-5 space-y-3">
                    @csrf
                    <template x-if="editing">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    <div class="grid grid-cols-2 gap-3">
                        {{-- YEAR --}}
                        <div>
                            <label for="modal-year" class="text-xs font-medium text-gray-600">Year <span class="text-gray-400 font-normal">(optional)</span></label>
                            <input type="text" id="modal-year" name="year" inputmode="numeric" maxlength="10" autocomplete="off"
                                   x-model="form.year"
                                   class="form-input text-sm"
                                   placeholder="e.g. 2019">
                        </div>

                        {{-- SORT ORDER --}}
                        <div>
                            <label for="modal-sort_order" class="text-xs font-medium text-gray-600">Order</label>
                            <input type="number" id="modal-sort_order" name="sort_order"
                                   x-model="form.sort_order"
                                   class="form-input text-sm">
                        </div>
                    </div>

                    {{-- DESCRIPTION --}}
                    <div>
                        <label for="modal-description" class="text-xs font-medium text-gray-600">Description</label>
                        <textarea id="modal-description" name="description" rows="2"
                                  class="form-input text-sm resize-none"
                                  placeholder="Short description..."
                                  x-model="form.description"></textarea>
                    </div>

                    {{-- LINKS --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="modal-website_url" class="text-xs font-medium text-gray-600">Website URL</label>
                            <input type="url" id="modal-website_url" name="website_url"
                                   x-model="form.website_url"
                                   class="form-input text-sm"
                                   placeholder="https://example.com">
                        </div>
                        <div>
                            <label for="modal-article_url" class="text-xs font-medium text-gray-600">Article URL</label>
                            <input type="url" id="modal-article_url" name="article_url"
                                   x-model="form.article_url"
                                   class="form-input text-sm"
                                   placeholder="https://article-link.com">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="modal-video_url" class="text-xs font-medium text-gray-600">Video URL</label>
                            <input type="url" id="modal-video_url" name="video_url"
                                   x-model="form.video_url"
                                   class="form-input text-sm"
                                   placeholder="https://youtube.com/watch?v=...">
                        </div>

                        {{-- ACTIVE (edit only — new awards are active by default) --}}
                        <template x-if="editing">
                            <div class="flex items-end pb-1.5">
                                <label class="flex items-center gap-2 cursor-pointer select-none px-3.5 py-2.5 rounded-xl border border-gray-300 bg-gray-50 hover:border-gray-400 hover:bg-white transition-all duration-150 w-full">
                                    <input type="hidden" name="is_active" value="0">
                                    <input type="checkbox" name="is_active" value="1"
                                           x-model="form.is_active"
                                           class="w-4 h-4 accent-[#2d6fa3] cursor-pointer">
                                    <span class="text-xs font-semibold text-gray-600">Active</span>
                                </label>
                            </div>
                        </template>
                    </div>

                    {{-- IMAGE --}}
                    <div>
                        <label class="text-xs font-medium text-gray-600">Award Image <span class="text-gray-400 font-normal">(PNG, JPG or SVG, max 2MB)</span></label>

                        <label for="modal-image-input" id="modal-image-dropzone"
                               class="group flex items-center justify-center w-full h-16 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-[#2d6fa3]/5 hover:border-[#2d6fa3] transition-all duration-200 mt-1">
                            <div class="flex items-center gap-2" id="modal-image-placeholder">
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-[#2d6fa3] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1117.9 9H18a4 4 0 010 8h-1m-4-4l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <p class="text-xs font-semibold text-[#2d6fa3]">Click to upload or drag and drop</p>
                            </div>
                            <div class="hidden items-center gap-2" id="modal-image-selected">
                                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-xs font-medium text-gray-700 truncate max-w-[240px]" id="modal-image-filename"></p>
                            </div>
                            <input id="modal-image-input" type="file" name="image" accept="image/png,image/jpeg,image/webp,image/svg+xml" class="hidden"
                                   onchange="
                                       const f = this.files[0];
                                       if (f) {
                                           document.getElementById('modal-image-placeholder').classList.add('hidden');
                                           document.getElementById('modal-image-selected').classList.remove('hidden');
                                           document.getElementById('modal-image-selected').classList.add('flex');
                                           document.getElementById('modal-image-filename').textContent = f.name;
                                       }
                                   ">
                        </label>

                        {{-- Current image (edit mode) --}}
                        <template x-if="editing && form.image_url">
                            <div class="mt-2 flex items-center gap-2 bg-gray-50 border border-gray-200 rounded-lg p-2">
                                <div class="w-8 h-8 bg-white rounded border border-gray-100 flex items-center justify-center overflow-hidden flex-shrink-0">
                                    <img :src="form.image_url" class="max-w-full max-h-full object-contain">
                                </div>
                                <p class="text-xs text-gray-400">Current image</p>
                                <label class="flex items-center gap-1.5 text-xs text-gray-500 ml-auto cursor-pointer">
                                    <input type="checkbox" name="remove_image" value="1"
                                           class="w-3.5 h-3.5 accent-[#2d6fa3] cursor-pointer">
                                    <span class="text-xs text-gray-600">Remove</span>
                                </label>
                            </div>
                        </template>
                    </div>

                    <div class="flex items-center gap-3 pt-1">
                        <button type="submit" class="flex-1 btn-primary justify-center text-sm py-2.5"
                                x-text="submitButtonText">
                        </button>
                        <button type="button" @click="closeModal()"
                                class="px-5 py-2.5 text-xs text-gray-400 hover:text-gray-600 transition-colors">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
@endsection
