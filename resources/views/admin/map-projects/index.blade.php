@extends('admin.layouts.app')

@section('title', 'Map Structure')
@section('page-title', 'Map Structure')
@section('breadcrumb', 'Manage which projects appear on the Cambodia map')

@section('content')

<style>
/* ── Mini Map Preview ──────────────────────────── */
.map-preview {
    width: 100%;
    max-width: 220px;
    height: auto;
    display: block;
    margin: 0 auto;
}

.map-preview .region {
    fill: #e5e7eb !important;
    stroke: #d1d5db !important;
    stroke-width: 1.5px;
    transition: fill 0.3s ease;
    cursor: pointer;
}

.map-preview .region.preview-highlighted {
    fill: #0F766E !important;
    stroke: #0d5e57 !important;
}

.map-preview .region.preview-highlighted:hover {
    fill: #0d5e57 !important;
}

/* ── Add Project Button ────────────────────────── */
.btn-add-project {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 28px;
    background: linear-gradient(135deg, #0F766E 0%, #0d5e57 100%);
    color: #ffffff;
    font-size: 14px;
    font-weight: 700;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 4px 14px rgba(15, 118, 110, 0.25);
    position: relative;
    overflow: hidden;
    letter-spacing: 0.01em;
}

.btn-add-project:hover {
    background: linear-gradient(135deg, #0d8a80 0%, #0b7a6e 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(15, 118, 110, 0.35);
}

.btn-add-project:active {
    transform: translateY(0) scale(0.98);
    box-shadow: 0 2px 8px rgba(15, 118, 110, 0.2);
}

.btn-add-project:focus-visible {
    outline: 2px solid #0F766E;
    outline-offset: 2px;
}

.btn-add-project::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255,255,255,0.12) 0%, transparent 50%, rgba(255,255,255,0.06) 100%);
    pointer-events: none;
}

.btn-add-project .icon-wrap {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 22px;
    height: 22px;
    border-radius: 9999px;
    background: rgba(255,255,255,0.25);
    flex-shrink: 0;
    transition: background 0.2s ease;
}

.btn-add-project:hover .icon-wrap {
    background: rgba(255,255,255,0.35);
}

.btn-add-project svg {
    width: 14px;
    height: 14px;
    stroke: #ffffff;
    stroke-width: 3;
}
</style>

<div class="max-w-5xl mx-auto space-y-8"
     x-data="mapProjectsManager()">

    {{-- ===== TAB NAVIGATION ===== --}}
    <div class="flex items-center gap-1 border-b border-gray-200">
        <button @click="activeTab = 'projects'"
                class="relative px-5 py-3 text-sm font-semibold transition-colors duration-150 ease-out"
                :class="activeTab === 'projects' ? 'text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'">
            <span>Map Projects</span>
            <span x-show="activeTab === 'projects'"
                  class="absolute bottom-0 left-0 right-0 h-0.5 bg-[#2d6fa3]"
                  x-transition:enter="transition ease-out duration-200"
                  x-transition:enter-start="opacity-0 scale-x-0"
                  x-transition:enter-end="opacity-100 scale-x-100"
                  x-transition:leave="transition ease-out duration-150"
                  x-transition:leave-start="opacity-100 scale-x-100"
                  x-transition:leave-end="opacity-0 scale-x-0"></span>
        </button>
        <button @click="activeTab = 'content'"
                class="relative px-5 py-3 text-sm font-semibold transition-colors duration-150 ease-out"
                :class="activeTab === 'content' ? 'text-[#2d6fa3]' : 'text-gray-500 hover:text-gray-700'">
            <span>Content</span>
            <span x-show="activeTab === 'content'"
                  class="absolute bottom-0 left-0 right-0 h-0.5 bg-[#2d6fa3]"
                  x-transition:enter="transition ease-out duration-200"
                  x-transition:enter-start="opacity-0 scale-x-0"
                  x-transition:enter-end="opacity-100 scale-x-100"
                  x-transition:leave="transition ease-out duration-150"
                  x-transition:leave-start="opacity-100 scale-x-100"
                  x-transition:leave-end="opacity-0 scale-x-0"></span>
        </button>
    </div>

    {{-- ===== TAB 1: MAP PROJECTS ===== --}}
    <div x-show="activeTab === 'projects'"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-out duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2">

    {{-- Top bar: Title + Add button --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Map Projects</h2>
            <p class="text-sm text-gray-400 mt-1">{{ $projects->count() }} project{{ $projects->count() !== 1 ? 's' : '' }} configured</p>
        </div>
        <button @click="openAddModal()" class="btn-primary text-sm">
            <span class="icon-wrap">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
            </span>
            Add Project
        </button>
    </div>

    {{-- Projects table --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        @if($projects->isEmpty())
        <div class="px-6 py-16 text-center">
            <div class="w-16 h-16 mx-auto mb-4 rounded-2xl bg-gray-50 border border-gray-100 flex items-center justify-center">
                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                </svg>
            </div>
            <p class="text-gray-400 text-sm mb-2">No projects on the map yet.</p>
            <button @click="openAddModal()" class="text-[#0F766E] text-sm font-medium hover:underline">Add your first project.</button>
        </div>
        @else
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Province</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Project Type</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-400 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($projects as $project)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-3">
                            <span class="font-medium text-gray-700">{{ $project->province_label }}</span>
                            <span class="text-xs text-gray-400 ml-1">({{ $project->province_key }})</span>
                        </td>
                        <td class="px-6 py-3 text-gray-600">{{ $project->location_name }}</td>
                        <td class="px-6 py-3">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-medium border border-gray-100"
                                  style="background:{{ $project->project_type === 'Child Welfare' ? '#fef2f2' : ($project->project_type === 'Outside Cases' ? '#fef2f2' : ($project->project_type === 'School for Deaf or Blind Children' ? '#f0fdf4' : '#faf5ff')) }}; color:{{ $project->project_type === 'School for Deaf or Blind Children' ? '#16A34A' : ($project->project_type === 'School of Khmer Arts & Culture' ? '#7E22CE' : '#DC2626') }};">
                                <span class="w-2 h-2 rounded-full flex-shrink-0"
                                      style="background:{{ $project->project_type === 'School for Deaf or Blind Children' ? '#22C55E' : ($project->project_type === 'School of Khmer Arts & Culture' ? '#A855F7' : '#EF4444') }};"></span>
                                {{ $project->project_type }}
                            </span>
                        </td>
                        <td class="px-6 py-3 text-center text-gray-400">{{ $project->sort_order }}</td>
                        <td class="px-6 py-3 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <button @click="openEditModal({{ $project->id }}, '{{ $project->province_key }}', '{{ $project->province_label }}', '{{ addslashes($project->location_name) }}', '{{ addslashes($project->location_name_fr ?? '') }}', '{{ addslashes($project->project_type) }}', {{ $project->sort_order }})"
                                        class="text-xs text-[#2d6fa3] hover:text-[#1d4e7a] font-medium transition-colors">
                                    Edit
                                </button>
                                <button @click="openDeleteModal({{ $project->id }}, '{{ addslashes($project->location_name) }}', '{{ addslashes($project->project_type) }}')"
                                        class="text-xs text-red-400 hover:text-red-600 font-medium transition-colors">
                                    Delete
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>

    {{-- ===== ADD / EDIT MODAL ===== --}}
    <div x-cloak x-show="addEditModalOpen"
         class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">

        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"
             @click="addEditModalOpen = false"></div>

        {{-- Modal --}}
        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4">

            {{-- Header --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <span class="w-8 h-8 rounded-lg flex items-center justify-center text-lg"
                          :class="editingId ? 'bg-[#2d6fa3]/10 text-[#2d6fa3]' : 'bg-[#0F766E]/10 text-[#0F766E]'">
                        <span x-text="editingId ? '✏️' : '+'"></span>
                    </span>
                    <h3 class="font-bold text-gray-800" x-text="editingId ? 'Edit Project' : 'Add Project'"></h3>
                </div>
                <button @click="addEditModalOpen = false"
                        class="p-1.5 rounded-lg hover:bg-gray-100 text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- Form --}}
            <form :action="editingId ? '{{ route('admin.map-projects.update', 'REPLACE') }}'.replace('REPLACE', editingId) : '{{ route('admin.map-projects.store') }}'"
                  method="POST" class="p-6 space-y-5">
                <input type="hidden" name="_method" :value="editingId ? 'PUT' : 'POST'">
                @csrf

                {{-- Province --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Province</label>
                    <select name="province_key" x-model="formProvinceKey"
                            x-ref="provinceSelect"
                            @change="formProvinceLabel = $event.target.options[$event.target.selectedIndex].text"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                            required>
                        <option value="">Select province...</option>
                        @foreach($provinces as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="province_label" :value="formProvinceLabel">
                </div>

                {{-- Location --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-sm font-medium text-gray-700">Location / City</label>
                        <div class="lang-tabs">
                            <button type="button" class="lang-tab" :class="{ active: locationLang === 'en' }" @click="locationLang = 'en'">EN</button>
                            <button type="button" class="lang-tab" :class="{ active: locationLang === 'fr' }" @click="locationLang = 'fr'">FR</button>
                        </div>
                    </div>
                    <div x-show="locationLang === 'en'">
                        <input type="text" name="location_name" x-model="formLocation"
                               placeholder="e.g. Poipet"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               :required="locationLang === 'en'">
                    </div>
                    <div x-show="locationLang === 'fr'" x-cloak>
                        <input type="text" name="location_name_fr" x-model="formLocationFr"
                               placeholder="ex. Poipet"
                               class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                        <p class="text-[11px] text-gray-400 mt-1">Optional — French name for this location.</p>
                    </div>
                </div>

                {{-- Project Type --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Project Type</label>
                    <select name="project_type" x-model="formProjectType"
                            class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                            required>
                        <option value="">Select type...</option>
                        @foreach($projectTypes as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Order --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Order</label>
                    <input type="number" name="sort_order" x-model="formOrder" min="0"
                           class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
                    <button type="button" @click="addEditModalOpen = false"
                            class="px-4 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                            class="btn-primary text-sm px-6 py-2.5 font-semibold text-black rounded-xl transition-all hover:shadow-lg bg-[#0F766E] hover:bg-[#0d5e57]"
                            :class="editingId ? 'bg-[#2d6fa3] hover:bg-[#1d4e7a]' : ''">
                        <span x-text="editingId ? 'Save Changes' : 'Add to Map'"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ===== DELETE CONFIRM MODAL ===== --}}
    <div x-cloak x-show="deleteModalOpen"
         class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">

        <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm"
             @click="deleteModalOpen = false"></div>

        <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm overflow-hidden"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4">

            <div class="p-6 text-center">
                <div class="w-14 h-14 mx-auto mb-4 rounded-full bg-red-50 border border-red-100 flex items-center justify-center">
                    <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Remove Project?</h3>
                <p class="text-sm text-gray-500 mb-1">
                    You are about to remove
                    <span class="font-semibold text-gray-700" x-text="deleteLocation"></span>
                    —
                    <span class="font-semibold text-gray-700" x-text="deleteType"></span>
                </p>
                <p class="text-xs text-gray-400 mb-6">This action cannot be undone.</p>

                <form :action="'{{ route('admin.map-projects.destroy', 'REPLACE') }}'.replace('REPLACE', deleteId)"
                      method="POST">
                    @csrf @method('DELETE')
                    <div class="flex items-center justify-center gap-3">
                        <button type="button" @click="deleteModalOpen = false"
                                class="px-5 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 bg-gray-50 hover:bg-gray-100 rounded-xl transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                                class="px-5 py-2.5 text-sm font-semibold text-white bg-red-500 hover:bg-red-600 rounded-xl transition-all hover:shadow-lg">
                            Yes, Remove
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- How it works --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6 shadow-sm">
        <div class="flex items-center gap-3 mb-4">
            <span class="text-lg">💡</span>
            <h3 class="font-bold text-gray-800">How it works</h3>
        </div>
        <ul class="space-y-2 text-sm text-gray-600">
            <li class="flex items-start gap-2">
                <span class="text-[#0F766E] mt-0.5">•</span>
                <span>Each row = one project marker on the map. Add multiple entries for the same location with different project types.</span>
            </li>
            <li class="flex items-start gap-2">
                <span class="text-[#0F766E] mt-0.5">•</span>
                <span>The <strong>Order</strong> field controls how projects are listed in the tooltip (lower numbers first).</span>
            </li>
            <li class="flex items-start gap-2">
                <span class="text-[#0F766E] mt-0.5">•</span>
                <span>Provinces without any projects will show "No programs" on hover.</span>
            </li>
            <li class="flex items-start gap-2">
                <span class="text-[#0F766E] mt-0.5">•</span>
                <span>Available project types: Child Welfare, Outside Cases, School for Deaf or Blind Children, School of Khmer Arts &amp; Culture</span>
            </li>
        </ul>
    </div>

    </div>{{-- END TAB 1: Map Projects --}}

    {{-- ===== TAB 2: RIGHT SIDE CONTENT ===== --}}
    <div x-show="activeTab === 'content'"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-out duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-2">

    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/30">
            <div class="flex items-center gap-3">
                <span class="text-lg"></span>
                <h3 class="font-bold text-gray-800">Right Side Content</h3>
            </div>
            <p class="text-xs text-gray-400 mt-1 ml-10">
                Edit the text that appears on the right side of the Cambodia map on the homepage.
            </p>
        </div>

        <form action="{{ route('admin.map-projects.settings') }}" method="POST" class="p-6 space-y-5">
            @csrf

            {{-- Section Heading --}}
            <div>
                <label for="structure_heading" class="block text-sm font-medium text-gray-700 mb-1.5">Section Heading (Main Title)</label>
                <input type="text" id="structure_heading" name="structure_heading"
                       value="{{ old('structure_heading', $settings['structure_heading'] ?? "KROUSAR THMEY'S STRUCTURES") }}"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            {{-- Welfare Title --}}
            <div>
                <label for="structure_welfare_title" class="block text-sm font-medium text-gray-700 mb-1.5">Welfare Section Title</label>
                <input type="text" id="structure_welfare_title" name="structure_welfare_title"
                       value="{{ old('structure_welfare_title', $settings['structure_welfare_title'] ?? 'Child Welfare Program') }}"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            {{-- Welfare Items --}}
            <div>
                <label for="structure_welfare_items" class="block text-sm font-medium text-gray-700 mb-1.5">Welfare Items (one per line)</label>
                <textarea id="structure_welfare_items" name="structure_welfare_items" rows="4"
                          class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('structure_welfare_items', $settings['structure_welfare_items'] ?? "2 Temporary Protection Centers\n2 Long-term Protection Centers\n2 Family Houses\nOutside Cases") }}</textarea>
            </div>

            {{-- Education Title --}}
            <div>
                <label for="structure_education_title" class="block text-sm font-medium text-gray-700 mb-1.5">Education Section Title</label>
                <input type="text" id="structure_education_title" name="structure_education_title"
                       value="{{ old('structure_education_title', $settings['structure_education_title'] ?? 'Education for Deaf or Blind Children Program') }}"
                       class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            {{-- Education Items --}}
            <div>
                <label for="structure_education_items" class="block text-sm font-medium text-gray-700 mb-1.5">Education Items (one per line)</label>
                <textarea id="structure_education_items" name="structure_education_items" rows="3"
                          class="w-full px-4 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none">{{ old('structure_education_items', $settings['structure_education_items'] ?? '5 Special Education High Schools') }}</textarea>
            </div>


            <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
                <button type="submit"
                        class="px-6 py-2.5 text-sm font-semibold text-white bg-[#2d6fa3] hover:bg-[#1d4e7a] rounded-xl transition-all hover:shadow-lg">
                    Save Content
                </button>
            </div>
        </form>
    </div>

    </div>{{-- END TAB 2: Right Side Content --}}

</div>

<script>
function mapProjectsManager() {
    return {
        // Tab state
        activeTab: 'projects',

        // Add/Edit modal state
        addEditModalOpen: false,
        editingId: null,
        formProvinceKey: '',
        formProvinceLabel: '',
        formLocation: '',
        formLocationFr: '',
        locationLang: 'en',
        formProjectType: '',
        formOrder: 0,

        // Delete modal state
        deleteModalOpen: false,
        deleteId: null,
        deleteLocation: '',
        deleteType: '',

        openAddModal() {
            this.editingId = null;
            this.formProvinceKey = '';
            this.formProvinceLabel = '';
            this.formLocation = '';
            this.formLocationFr = '';
            this.locationLang = 'en';
            this.formProjectType = '';
            this.formOrder = 0;
            this.addEditModalOpen = true;
        },

        openEditModal(id, provinceKey, provinceLabel, location, locationFr, projectType, order) {
            this.editingId = id;
            this.formProvinceKey = provinceKey;
            this.formProvinceLabel = provinceLabel;
            this.formLocation = location;
            this.formLocationFr = locationFr;
            this.locationLang = 'en';
            this.formProjectType = projectType;
            this.formOrder = order;
            this.addEditModalOpen = true;

            // Ensure province select updates label after Alpine sets value
            this.$nextTick(() => {
                const select = this.$refs.provinceSelect;
                if (select) {
                    this.formProvinceLabel = select.options[select.selectedIndex]?.text || provinceLabel;
                }
            });
        },

        openDeleteModal(id, location, type) {
            this.deleteId = id;
            this.deleteLocation = location;
            this.deleteType = type;
            this.deleteModalOpen = true;
        },
    };
}
</script>

@endsection
