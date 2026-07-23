@extends('admin.layouts.app')

@section('title', 'Our Values')
@section('page-title', 'Our Values')
@section('breadcrumb', 'Manage the value cards displayed on the About page')

@section('content')

<div class="space-y-6"
     x-data="{
        showModal: false,
        editing: false,
        editingId: null,
        lang: 'en',
        currentImageUrl: null,
        form: {
            title: '',
            title_fr: '',
            headline: '',
            headline_fr: '',
            description: '',
            description_fr: '',
            supporting_description: '',
            supporting_description_fr: '',
            sort_order: 0,
        },

        get modalTitle() {
            return this.editing ? 'Edit Value' : 'Add New Value';
        },

        get submitButtonText() {
            return this.editing ? 'Update Value' : 'Add Value';
        },

        openAddModal() {
            this.editing = false;
            this.editingId = null;
            this.lang = 'en';
            this.currentImageUrl = null;
            this.form = {
                title: '', title_fr: '', headline: '', headline_fr: '',
                description: '', description_fr: '',
                supporting_description: '', supporting_description_fr: '',
                sort_order: 0,
            };
            this.showModal = true;
        },

        openEditModal(value) {
            this.editing = true;
            this.editingId = value.id;
            this.lang = 'en';
            this.currentImageUrl = value.image_url ?? null;
            this.form = {
                title: value.title ?? '',
                title_fr: value.title_fr ?? '',
                headline: value.headline ?? '',
                headline_fr: value.headline_fr ?? '',
                description: value.description ?? '',
                description_fr: value.description_fr ?? '',
                supporting_description: value.supporting_description ?? '',
                supporting_description_fr: value.supporting_description_fr ?? '',
                sort_order: value.sort_order ?? 0,
            };
            this.showModal = true;
        },

        closeModal() {
            this.showModal = false;
            this.editing = false;
            this.editingId = null;
        },
     }">

    {{-- Values List --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
        {{-- Toolbar --}}
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center gap-2">
                <h3 class="font-bold text-gray-800">All Values</h3>
                @if($coreValues->isNotEmpty())
                <span class="px-2.5 py-1 bg-[#2d6fa3]/10 text-[#2d6fa3] rounded-full text-xs font-semibold">
                    {{ $coreValues->count() }}
                </span>
                @endif
            </div>

            <a href="{{ route('admin.core-values.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-full text-sm font-semibold transition-colors shadow-sm hover:shadow-md">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Value
            </a>
        </div>

        {{-- Empty state --}}
        @if($coreValues->isEmpty())
        <div class="py-16 text-center text-gray-400">
            <div class="text-4xl mb-3">📋</div>
            <p class="text-sm font-medium text-gray-500">No values yet</p>
            <p class="text-xs mt-1">Click <strong>Add Value</strong> to create your first value.</p>
        </div>
        @else
        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-400 text-xs border-b border-gray-50">
                        <th class="text-left font-medium px-6 py-3">Value</th>
                        <th class="text-left font-medium px-6 py-3">Headline</th>
                        <th class="text-left font-medium px-6 py-3">Order</th>
                        <th class="text-right font-medium px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($coreValues as $value)
                    <tr class="border-t border-gray-50 hover:bg-gray-50/60 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($value->image_url)
                                <img src="{{ $value->image_url }}" alt=""
                                     class="w-10 h-10 rounded-lg object-cover border border-gray-100 bg-white flex-shrink-0">
                                @endif
                                <div class="min-w-0">
                                    <p class="font-semibold text-gray-800">{{ $value->title }}</p>
                                    @if($value->description)
                                    <p class="text-gray-400 text-xs mt-0.5 line-clamp-1">{{ Str::limit($value->description, 50) }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-gray-500">
                            @if($value->headline)
                            <span class="text-xs">{{ $value->headline }}</span>
                            @else
                            <span class="text-xs text-gray-300">—</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs text-gray-500">{{ $value->sort_order }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button @click="openEditModal(@js($value->toArray()))" title="Edit"
                                        class="w-8 h-8 rounded-full bg-[#2d6fa3]/10 text-[#2d6fa3] hover:bg-[#2d6fa3]/20 flex items-center justify-center transition cursor-pointer">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </button>
                                <form action="{{ route('admin.core-values.destroy', $value) }}" method="POST"
                                      onsubmit="return confirm('Remove this value?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" title="Delete"
                                            class="w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
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
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto z-10"
                 @click.stop
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95">

                {{-- Header --}}
                <div class="sticky top-0 bg-white border-b border-gray-100 px-6 py-4 flex items-center justify-between rounded-t-2xl z-10">
                    <h3 class="font-bold text-gray-800" x-text="modalTitle"></h3>
                    <button @click="closeModal()" type="button"
                            class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center transition">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                {{-- Form --}}
                <form :action="editing ? '{{ route('admin.core-values.update', '__ID__') }}'.replace('__ID__', editingId) : '{{ route('admin.core-values.store') }}'"
                      method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
                    @csrf
                    <template x-if="editing">
                        <input type="hidden" name="_method" value="PUT">
                    </template>

                    {{-- Language toggle --}}
                    <div class="flex justify-end">
                        <div class="lang-tabs">
                            <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'">EN</button>
                            <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'">FR</button>
                        </div>
                    </div>

                    {{-- Title --}}
                    <div x-show="lang === 'en'">
                        <label class="block text-xs font-medium text-gray-600 mb-1">
                            Title <span class="text-red-400">*</span>
                        </label>
                        <input type="text" name="title" x-model="form.title" :required="lang === 'en'"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="e.g. Integration">
                    </div>
                    <div x-show="lang === 'fr'" x-cloak>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Title (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                        <input type="text" name="title_fr" x-model="form.title_fr"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="ex. Intégration">
                    </div>

                    {{-- Headline --}}
                    <div x-show="lang === 'en'">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Headline (e.g. "Every child belongs.")</label>
                        <input type="text" name="headline" x-model="form.headline"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="Every child belongs.">
                    </div>
                    <div x-show="lang === 'fr'" x-cloak>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Headline (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                        <input type="text" name="headline_fr" x-model="form.headline_fr"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="Chaque enfant a sa place.">
                    </div>

                    {{-- Description --}}
                    <div x-show="lang === 'en'">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                        <textarea name="description" x-model="form.description" rows="2"
                                  class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                                  placeholder="Full description..."></textarea>
                    </div>
                    <div x-show="lang === 'fr'" x-cloak>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Description (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                        <textarea name="description_fr" x-model="form.description_fr" rows="2"
                                  class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                                  placeholder="Description complète..."></textarea>
                    </div>

                    {{-- Supporting Description --}}
                    <div x-show="lang === 'en'">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Supporting Description <span class="text-gray-400 font-normal">(optional)</span></label>
                        <textarea name="supporting_description" x-model="form.supporting_description" rows="2"
                                  class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                                  placeholder="Extra detail shown below the description on the value's page..."></textarea>
                    </div>
                    <div x-show="lang === 'fr'" x-cloak>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Supporting Description (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                        <textarea name="supporting_description_fr" x-model="form.supporting_description_fr" rows="2"
                                  class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                                  placeholder="Détail supplémentaire affiché sous la description..."></textarea>
                    </div>

                    {{-- Image --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Image <span class="text-gray-400 font-normal">(optional)</span></label>
                        <template x-if="currentImageUrl">
                            <img :src="currentImageUrl" alt="" class="w-16 h-16 rounded-lg object-cover border border-gray-200 mb-2">
                        </template>
                        <input type="file" name="image" accept="image/*"
                               class="w-full text-sm text-gray-600 file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] file:text-sm file:font-medium">
                        <p class="text-[11px] text-gray-400 mt-1">Shown next to the icon on the value's detail page. Leave blank to keep the current image.</p>
                    </div>

                    {{-- Order --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Order</label>
                        <input type="number" name="sort_order" x-model="form.sort_order"
                               class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>

                    {{-- Buttons --}}
                    <div class="flex gap-3 pt-2">
                        <button type="submit"
                                class="flex-1 btn-primary justify-center text-sm py-2.5"
                                x-text="submitButtonText">
                        </button>
                        <button type="button" @click="closeModal()"
                                class="px-6 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-xl text-sm font-medium transition-colors">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </template>
</div>
@endsection
