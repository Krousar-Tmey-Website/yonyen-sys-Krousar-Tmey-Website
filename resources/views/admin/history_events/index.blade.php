@extends('admin.layouts.app')

@section('title', 'History Events')
@section('page-title', 'History Timeline')
@section('breadcrumb', 'Who We Are → Our History')

@section('content')
<div class="space-y-5"
     x-data="{
        showModal: false,
        editing: false,
        editingId: null,
        submitting: false,
        form: {
            year: '',
            left_text: '',
            right_text: '',
            sort_order: 0,
            is_active: true,
        },
        imageFile: null,
        removeCurrentImage: false,
        currentImageUrl: null,
        errors: {},
        toast: { show: false, message: '', type: 'success' },
        search: @js($filters['search'] ?? ''),
        total: @js($totalEvents),
        loading: false,

        get modalTitle() {
            return this.editing ? 'Edit History Event' : 'Add History Event';
        },

        get submitButtonText() {
            return this.editing ? 'Update Event' : 'Add Event';
        },

        openAddModal() {
            this.editing = false;
            this.editingId = null;
            this.form = { year: '', left_text: '', right_text: '', sort_order: 0, is_active: true };
            this.imageFile = null;
            this.removeCurrentImage = false;
            this.currentImageUrl = null;
            this.errors = {};
            this.submitting = false;
            this.showModal = true;
            // Reset file input
            this.$nextTick(() => {
                const fileInput = document.getElementById('modal-image-input');
                if (fileInput) fileInput.value = '';
                this.updateImagePreview(null);
            });
        },

        openEditModal(eventData) {
            this.editing = true;
            this.editingId = eventData.id;
            this.form = {
                year: eventData.year ?? '',
                left_text: eventData.left_text ?? '',
                right_text: eventData.right_text ?? '',
                sort_order: eventData.sort_order ?? 0,
                is_active: Boolean(eventData.is_active),
            };
            this.imageFile = null;
            this.removeCurrentImage = false;
            this.currentImageUrl = eventData.image_url ?? null;
            this.errors = {};
            this.submitting = false;
            this.showModal = true;
            this.$nextTick(() => {
                const fileInput = document.getElementById('modal-image-input');
                if (fileInput) fileInput.value = '';
                this.updateImagePreview(null);
            });
        },

        closeModal() {
            this.showModal = false;
            this.editing = false;
            this.editingId = null;
            this.errors = {};
            this.submitting = false;
        },

        handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                this.imageFile = file;
                this.updateImagePreview(file);
            } else {
                this.imageFile = null;
                this.updateImagePreview(null);
            }
        },

        updateImagePreview(file) {
            const preview = document.getElementById('modal-image-preview-placeholder');
            const selected = document.getElementById('modal-image-selected');
            const filename = document.getElementById('modal-image-filename');
            if (!preview || !selected) return;

            if (file) {
                preview.classList.add('hidden');
                selected.classList.remove('hidden');
                selected.classList.add('flex');
                if (filename) filename.textContent = file.name;
            } else {
                preview.classList.remove('hidden');
                selected.classList.add('hidden');
                selected.classList.remove('flex');
            }
        },

        submitForm() {
            this.submitting = true;
            this.errors = {};

            const formData = new FormData();
            formData.append('year', this.form.year);
            formData.append('left_text', this.form.left_text);
            formData.append('right_text', this.form.right_text);
            formData.append('sort_order', this.form.sort_order);

            if (this.editing) {
                formData.append('is_active', this.form.is_active ? '1' : '0');
                if (this.removeCurrentImage) {
                    formData.append('remove_image', '1');
                }
            }

            if (this.imageFile) {
                formData.append('image', this.imageFile);
            }

            let url, method;
            if (this.editing) {
                url = '{{ route('admin.history-events.update', '__ID__') }}'.replace('__ID__', this.editingId);
                formData.append('_method', 'PUT');
            } else {
                url = '{{ route('admin.history-events.store') }}';
            }

            formData.append('_token', '{{ csrf_token() }}');

            fetch(url, {
                method: 'POST',
                body: formData,
                headers: { 'Accept': 'application/json' },
            })
            .then(response => response.json().then(data => ({ status: response.status, data })))
            .then(({ status, data }) => {
                if (status === 422) {
                    // Validation errors
                    if (data.errors) {
                        const flat = {};
                        Object.keys(data.errors).forEach(key => {
                            flat[key] = data.errors[key][0];
                        });
                        this.errors = flat;
                    }
                    this.submitting = false;
                    return;
                }

                if (data.success) {
                    this.closeModal();
                    this.showToast(data.message, 'success');
                    this.refreshList();
                } else {
                    this.showToast(data.message || 'An error occurred.', 'error');
                    this.submitting = false;
                }
            })
            .catch(() => {
                this.showToast('Network error. Please try again.', 'error');
                this.submitting = false;
            });
        },

        refreshList() {
            this.loading = true;
            const params = new URLSearchParams();
            if (this.search) params.set('search', this.search);
            const url = '{{ route('admin.history-events.index') }}' + (params.toString() ? '?' + params.toString() : '');
            fetch(url, { headers: { 'Accept': 'application/json' } })
                .then(r => r.json())
                .then(data => {
                    this.$refs.results.innerHTML = data.html;
                    this.total = data.total;
                    history.replaceState(null, '', url);
                    this.loading = false;
                })
                .catch(() => { this.loading = false; });
        },

        applyFilters() {
            this.loading = true;
            this.refreshList();
        },

        showToast(message, type = 'success') {
            this.toast = { show: true, message, type };
            setTimeout(() => { this.toast.show = false; }, 3000);
        },

        getFilterUrl() {
            const params = new URLSearchParams();
            if (this.search) params.set('search', this.search);
            const qs = params.toString();
            return '{{ route('admin.history-events.index') }}' + (qs ? '?' + qs : '');
        },
     }"
     x-init="$watch('search', () => applyFilters())">

    {{-- Toolbar --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
        <div class="flex items-center justify-between flex-wrap gap-4 mb-4">
            <div class="flex items-center gap-2">
                <h3 class="font-bold text-gray-800">All Events</h3>
                <span class="px-2.5 py-1 bg-[#2d6fa3]/10 text-[#2d6fa3] rounded-full text-xs font-semibold">
                    Showing <span x-text="total">{{ $totalEvents }}</span>
                </span>
            </div>

            <button @click="openAddModal()"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-full text-sm font-semibold transition-colors shadow-sm hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Event
            </button>
        </div>

        {{-- Search --}}
        <form method="GET" action="{{ route('admin.history-events.index') }}" class="flex flex-wrap items-center gap-3" @submit.prevent="applyFilters()">
            <div class="relative flex-1 min-w-[220px]">
                <svg class="w-4 h-4 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17 10a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                       x-model.debounce.400ms="search"
                       placeholder="Search by year or event..."
                       autocomplete="off"
                       class="w-full bg-gray-50 border border-gray-300 rounded-full pl-10 pr-4 py-2.5 text-sm text-gray-700 placeholder:text-gray-400 transition-all duration-150 hover:border-gray-400 focus:outline-none focus:bg-white focus:border-[#2d6fa3] focus:ring-4 focus:ring-[#2d6fa3]/15">
            </div>

            <button type="submit" @click.prevent="applyFilters()"
                    class="px-5 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-full text-sm font-semibold transition-colors">
                Search
            </button>

            <a href="{{ route('admin.history-events.index') }}" @click.prevent="search = ''; applyFilters()"
               class="px-5 py-2.5 bg-gray-50 hover:bg-gray-100 text-gray-500 rounded-full text-sm font-medium transition-colors">
                Reset
            </a>
        </form>
    </div>

    {{-- Results --}}
    <div x-ref="results" class="space-y-5" :class="loading ? 'opacity-50 pointer-events-none' : ''" style="transition: opacity 150ms">
        @include('admin.history_events._results', ['events' => $events, 'filters' => $filters])
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
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[92vh] overflow-y-auto z-10"
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
                <form @submit.prevent="submitForm()" class="p-5 space-y-3" enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-2 gap-3">
                        {{-- YEAR --}}
                        <div>
                            <label class="text-xs font-medium text-gray-600">
                                Year <span class="text-red-400 font-normal">*</span>
                            </label>
                            <input type="text" x-model="form.year" required
                                   autocomplete="off"
                                   class="form-input text-sm"
                                   :class="errors.year ? 'form-input-error' : ''"
                                   placeholder="e.g. 1991">
                            <p class="text-xs text-red-500 mt-1" x-show="errors.year" x-text="errors.year" x-cloak></p>
                        </div>

                        {{-- SORT ORDER --}}
                        <div>
                            <label class="text-xs font-medium text-gray-600">Order</label>
                            <input type="number" x-model="form.sort_order" class="form-input text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        {{-- LEFT COLUMN TEXT --}}
                        <div>
                            <label class="text-xs font-medium text-gray-600">
                                Left Column Text <span class="text-gray-400 font-normal">(optional)</span>
                            </label>
                            <textarea x-model="form.left_text" rows="2"
                                      class="form-input text-sm resize-none"
                                      :class="errors.left_text ? 'form-input-error' : ''"
                                      placeholder="Main event description..."></textarea>
                            <p class="text-xs text-red-500 mt-1" x-show="errors.left_text" x-text="errors.left_text" x-cloak></p>
                        </div>

                        {{-- RIGHT COLUMN TEXT --}}
                        <div>
                            <label class="text-xs font-medium text-gray-600">
                                Right Column Text <span class="text-gray-400 font-normal">(optional)</span>
                            </label>
                            <textarea x-model="form.right_text" rows="2"
                                      class="form-input text-sm resize-none"
                                      :class="errors.right_text ? 'form-input-error' : ''"
                                      placeholder="Second event for same year..."></textarea>
                            <p class="text-xs text-red-500 mt-1" x-show="errors.right_text" x-text="errors.right_text" x-cloak></p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 -mt-2">At least one of Left or Right Column Text is required.</p>

                    {{-- ACTIVE --}}
                    <label class="flex items-center gap-2 cursor-pointer select-none px-3.5 py-2 rounded-xl border border-gray-300 bg-gray-50 hover:border-gray-400 hover:bg-white transition-all duration-150 w-fit">
                        <input type="checkbox" x-model="form.is_active"
                               class="w-4 h-4 accent-[#2d6fa3] cursor-pointer">
                        <span class="text-xs font-semibold text-gray-600">Active</span>
                    </label>

                    {{-- IMAGE --}}
                    <div>
                        <label class="text-xs font-medium text-gray-600">Event Image <span class="text-gray-400 font-normal">(PNG, JPG or SVG, max 2MB)</span></label>

                        <label for="modal-image-input" id="modal-image-dropzone"
                               class="group flex items-center justify-center w-full h-16 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-[#2d6fa3]/5 hover:border-[#2d6fa3] transition-all duration-200 mt-1">
                            <div class="flex items-center gap-2" id="modal-image-preview-placeholder">
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
                            <input id="modal-image-input" type="file" name="image" accept="image/png,image/jpeg,image/webp,image/svg+xml"
                                   class="hidden" @change="handleImageUpload($event)">
                        </label>
                        <p class="text-xs text-red-500 mt-1.5" x-show="errors.image" x-text="errors.image" x-cloak></p>

                        {{-- Current image (edit mode) --}}
                        <template x-if="editing && currentImageUrl">
                            <div class="mt-2 flex items-center gap-2 bg-gray-50 border border-gray-200 rounded-lg p-2">
                                <div class="w-8 h-8 bg-white rounded border border-gray-100 flex items-center justify-center overflow-hidden flex-shrink-0">
                                    <img :src="currentImageUrl" class="max-w-full max-h-full object-contain">
                                </div>
                                <p class="text-xs text-gray-400">Current image</p>
                                <label class="flex items-center gap-1.5 text-xs text-gray-500 ml-auto cursor-pointer">
                                    <input type="checkbox" x-model="removeCurrentImage" class="w-3.5 h-3.5 rounded border-gray-300">
                                    Remove
                                </label>
                            </div>
                        </template>
                    </div>

                    <div class="flex items-center gap-3 pt-1">
                        <button type="submit"
                                class="flex-1 btn-primary justify-center text-sm py-2.5"
                                x-text="submitButtonText"
                                :disabled="submitting">
                        </button>
                        <button type="button" @click="closeModal()"
                                class="px-5 py-2.5 text-xs text-gray-400 hover:text-gray-600 transition-colors">
                            Cancel
                        </button>
                    </div>

                    <div x-show="submitting" class="text-center text-xs text-gray-400" x-cloak>
                        Saving...
                    </div>
                </form>
            </div>
        </div>
    </template>

    {{-- Toast Notification --}}
    <div x-show="toast.show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4"
         x-cloak
         class="fixed bottom-6 right-6 z-50 flex items-center gap-3 px-5 py-3.5 rounded-xl shadow-lg"
         :class="toast.type === 'success' ? 'bg-emerald-500 text-white' : 'bg-red-500 text-white'">
        <template x-if="toast.type === 'success'">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </template>
        <template x-if="toast.type !== 'success'">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </template>
        <span x-text="toast.message" class="text-sm font-medium"></span>
        <button @click="toast.show = false" class="ml-2 hover:opacity-80">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</div>
@endsection
