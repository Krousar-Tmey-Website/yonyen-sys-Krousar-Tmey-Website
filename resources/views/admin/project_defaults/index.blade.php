@extends('admin.layouts.app')

@section('title', 'Project Defaults')
@section('page-title', 'Project Defaults')
@section('breadcrumb', 'Set fallback project information used on public project pages when a project leaves a field blank')

@section('content')

<div class="max-w-3xl mx-auto space-y-6">


    <div class="rounded-2xl border border-[#2d6fa3]/10 bg-[#2d6fa3]/5 p-5">
        <h2 class="text-sm font-bold text-[#1a3c6e] mb-2">How This Works</h2>
        <p class="text-sm text-gray-600 leading-relaxed">
            Set shared fallback values for all project pages here. You can also choose a specific project below and give it its own public-page details from this same screen.
        </p>
        <p class="text-xs text-gray-500 mt-3">
            Shared defaults are stored in the MySQL <code>home_settings</code> table under the <code>project_defaults</code> group. Project-specific values are stored in the MySQL <code>projects</code> table and are read automatically by the public project page.
        </p>
    </div>

    <form action="{{ route('admin.project-defaults.update') }}" method="POST" class="space-y-6">
        @csrf
        @if($selectedProject)
        <input type="hidden" name="selected_project_id" value="{{ $selectedProject->id }}">
        @endif

        @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 text-sm px-4 py-3 rounded-xl">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
            <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Public Project Defaults</h3>
            @if($selectedProject)
            <p class="text-xs text-gray-500">
                Saving shared defaults will keep <strong>{{ $selectedProject->title }}</strong> selected below so you can continue configuring that project from this page.
            </p>
            @endif

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label for="project_default_area_of_work" class="block text-sm font-medium text-gray-700 mb-1.5">Area of Work</label>
                    <input type="text"
                           id="project_default_area_of_work"
                           name="project_default_area_of_work"
                           value="{{ old('project_default_area_of_work', $settings['project_default_area_of_work']->value ?? '') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label for="project_default_duration" class="block text-sm font-medium text-gray-700 mb-1.5">Duration</label>
                    <input type="text"
                           id="project_default_duration"
                           name="project_default_duration"
                           value="{{ old('project_default_duration', $settings['project_default_duration']->value ?? '') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label for="project_default_location" class="block text-sm font-medium text-gray-700 mb-1.5">Location</label>
                    <input type="text"
                           id="project_default_location"
                           name="project_default_location"
                           value="{{ old('project_default_location', $settings['project_default_location']->value ?? '') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label for="project_default_beneficiaries" class="block text-sm font-medium text-gray-700 mb-1.5">Beneficiaries</label>
                    <input type="text"
                           id="project_default_beneficiaries"
                           name="project_default_beneficiaries"
                           value="{{ old('project_default_beneficiaries', $settings['project_default_beneficiaries']->value ?? '') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label for="project_default_make_difference_title" class="block text-sm font-medium text-gray-700 mb-1.5">Make a Difference Title</label>
                    <input type="text"
                           id="project_default_make_difference_title"
                           name="project_default_make_difference_title"
                           value="{{ old('project_default_make_difference_title', $settings['project_default_make_difference_title']->value ?? 'Make a Difference') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div class="md:col-span-2">
                    <label for="project_default_make_difference_text" class="block text-sm font-medium text-gray-700 mb-1.5">Make a Difference Text</label>
                    <textarea id="project_default_make_difference_text"
                              name="project_default_make_difference_text"
                              rows="4"
                              class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                              placeholder="e.g. $50 - food expenses per child per month">{{ old('project_default_make_difference_text', $settings['project_default_make_difference_text']->value ?? '') }}</textarea>
                    <p class="mt-1.5 text-xs text-gray-400">Shown on the public project page whenever a project leaves its own donation/details text blank.</p>
                </div>
                <div>
                    <label for="project_default_donate_button_text" class="block text-sm font-medium text-gray-700 mb-1.5">Donate Button Text</label>
                    <input type="text"
                           id="project_default_donate_button_text"
                           name="project_default_donate_button_text"
                           value="{{ old('project_default_donate_button_text', $settings['project_default_donate_button_text']->value ?? 'Donate Now') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
                <div>
                    <label for="project_default_contact_button_text" class="block text-sm font-medium text-gray-700 mb-1.5">Contact Button Text</label>
                    <input type="text"
                           id="project_default_contact_button_text"
                           name="project_default_contact_button_text"
                           value="{{ old('project_default_contact_button_text', $settings['project_default_contact_button_text']->value ?? 'Want to know more about this project? Contact us') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                </div>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-6 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-semibold rounded-xl transition-colors">
                Save Defaults
            </button>
            <a href="{{ route('admin.projects.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>

    <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
        <div>
            <h3 class="text-sm font-bold text-gray-700 uppercase tracking-wider">Specific Project Page Details</h3>
            <p class="mt-1 text-xs text-gray-500">
                Choose a project here if you want that one project page to use its own values instead of the shared defaults above.
            </p>
        </div>

        <form action="{{ route('admin.project-defaults.index') }}" method="GET" class="grid md:grid-cols-[1fr_auto] gap-3 items-end">
            <div>
                <label for="project" class="block text-sm font-medium text-gray-700 mb-1.5">Select Project</label>
                <select id="project" name="project"
                        class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    <option value="">Choose a project...</option>
                    @foreach($projects as $projectOption)
                    <option value="{{ $projectOption->id }}" {{ (string) optional($selectedProject)->id === (string) $projectOption->id ? 'selected' : '' }}>
                        {{ $projectOption->title }}
                    </option>
                    @endforeach
                </select>
                @if($selectedProject)
                <div class="mt-2 rounded-xl bg-[#f8f9fc] border border-gray-100 px-4 py-3">
                    <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 mb-1">Selected Project</p>
                    <p class="text-sm font-semibold text-gray-800 leading-snug">{{ $selectedProject->title }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $selectedProject->program?->title ?? 'No parent program' }}</p>
                </div>
                @else
                <p class="mt-2 text-xs text-gray-400">Choose a project to configure the exact public-page details shown on that project page.</p>
                @endif
            </div>
            <button type="submit" class="px-5 py-3 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white text-sm font-semibold rounded-xl transition-colors">
                Load Project
            </button>
        </form>

        @if($selectedProject)
        @php
            $projectDetailsMode = old('project_details_mode');
            if (!$projectDetailsMode) {
                $projectDetailsMode = $selectedProject->uses_specific_page_details
                    ? 'specific'
                    : 'defaults';
            }
        @endphp

        <div class="rounded-2xl border border-[#e8a020]/15 bg-[#e8a020]/5 p-5">
            <div class="mb-4">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="text-sm font-semibold text-gray-800">{{ $selectedProject->title }}</p>
                        <p class="text-xs text-gray-500">{{ $selectedProject->program?->title ?? 'No parent program' }}</p>
                        <div class="mt-2">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-medium {{ $selectedProject->uses_specific_page_details ? 'bg-[#e8a020]/15 text-[#9d6d00]' : 'bg-gray-100 text-gray-500' }}">
                                {{ $selectedProject->uses_specific_page_details ? 'Public page uses specific project data' : 'Public page uses shared defaults' }}
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('admin.projects.edit', $selectedProject) }}"
                       class="inline-flex items-center gap-2 px-3 py-2 border border-[#2d6fa3]/20 text-[#2d6fa3] hover:bg-[#2d6fa3]/5 text-xs font-semibold rounded-lg transition-colors">
                        Back to Project Edit
                    </a>
                </div>
            </div>

            <form action="{{ route('admin.project-defaults.project.update', $selectedProject) }}" method="POST" class="space-y-5"
                  x-data="{ detailsMode: '{{ $projectDetailsMode }}' }">
                @csrf

                <div class="grid md:grid-cols-2 gap-3">
                    <label class="flex items-start gap-3 rounded-xl border p-4 cursor-pointer transition-colors"
                           :class="detailsMode === 'defaults' ? 'border-[#2d6fa3] bg-white' : 'border-gray-200 bg-white/70'">
                        <input type="radio" name="project_details_mode" value="defaults" x-model="detailsMode"
                               class="mt-0.5 text-[#2d6fa3] focus:ring-[#2d6fa3]/20">
                        <span>
                            <span class="block text-sm font-semibold text-gray-700">Use Shared Defaults</span>
                            <span class="block text-xs text-gray-500 mt-1">This project page will use the values from the Project Defaults section above.</span>
                        </span>
                    </label>
                    <label class="flex items-start gap-3 rounded-xl border p-4 cursor-pointer transition-colors"
                           :class="detailsMode === 'specific' ? 'border-[#2d6fa3] bg-white' : 'border-gray-200 bg-white/70'">
                        <input type="radio" name="project_details_mode" value="specific" x-model="detailsMode"
                               class="mt-0.5 text-[#2d6fa3] focus:ring-[#2d6fa3]/20">
                        <span>
                            <span class="block text-sm font-semibold text-gray-700">Use Specific Project Details</span>
                            <span class="block text-xs text-gray-500 mt-1">This project page will use the values entered below instead of the shared defaults.</span>
                        </span>
                    </label>
                </div>

                <div class="grid md:grid-cols-2 gap-4 transition-opacity duration-200"
                     :class="detailsMode === 'specific' ? 'opacity-100' : 'opacity-60'">
                    <div>
                        <label for="area_of_work" class="block text-sm font-medium text-gray-700 mb-1.5">Area of Work</label>
                        <input type="text" id="area_of_work" name="area_of_work"
                               value="{{ old('area_of_work', $selectedProject->area_of_work) }}"
                               :disabled="detailsMode !== 'specific'"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-700 mb-1.5">Duration</label>
                        <input type="text" id="duration" name="duration"
                               value="{{ old('duration', $selectedProject->duration) }}"
                               :disabled="detailsMode !== 'specific'"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-1.5">Location</label>
                        <input type="text" id="location" name="location"
                               value="{{ old('location', $selectedProject->location) }}"
                               :disabled="detailsMode !== 'specific'"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label for="beneficiaries" class="block text-sm font-medium text-gray-700 mb-1.5">Beneficiaries</label>
                        <input type="text" id="beneficiaries" name="beneficiaries"
                               value="{{ old('beneficiaries', $selectedProject->beneficiaries) }}"
                               :disabled="detailsMode !== 'specific'"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>

                <div class="grid md:grid-cols-2 gap-4 transition-opacity duration-200" :class="detailsMode === 'specific' ? 'opacity-100' : 'opacity-60'">
                    <div class="md:col-span-2">
                        <label for="make_difference_title" class="block text-sm font-medium text-gray-700 mb-1.5">Make a Difference Title</label>
                        <input type="text" id="make_difference_title" name="make_difference_title"
                               value="{{ old('make_difference_title', $selectedProject->make_difference_title) }}"
                               :disabled="detailsMode !== 'specific'"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div class="md:col-span-2">
                        <label for="make_difference_text" class="block text-sm font-medium text-gray-700 mb-1.5">Make a Difference Text</label>
                        <textarea id="make_difference_text"
                                  name="make_difference_text"
                                  rows="4"
                                  :disabled="detailsMode !== 'specific'"
                                  class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] resize-none"
                                  placeholder="e.g. $50 - food expenses per child per month">{{ old('make_difference_text', $selectedProject->make_difference_text) }}</textarea>
                    </div>
                    <div>
                        <label for="donate_button_text" class="block text-sm font-medium text-gray-700 mb-1.5">Donate Button Text</label>
                        <input type="text" id="donate_button_text" name="donate_button_text"
                               value="{{ old('donate_button_text', $selectedProject->donate_button_text) }}"
                               :disabled="detailsMode !== 'specific'"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                    <div>
                        <label for="contact_button_text" class="block text-sm font-medium text-gray-700 mb-1.5">Contact Button Text</label>
                        <input type="text" id="contact_button_text" name="contact_button_text"
                               value="{{ old('contact_button_text', $selectedProject->contact_button_text) }}"
                               :disabled="detailsMode !== 'specific'"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit" class="px-5 py-2.5 bg-[#1d4e7a] hover:bg-[#163b5e] text-white text-sm font-semibold rounded-xl transition-colors">
                        Save Project Details
                    </button>
                    <a href="{{ route('projects.show', $selectedProject) }}" target="_blank" class="text-xs text-gray-400 hover:text-[#2d6fa3] transition-colors">
                        View live project page
                    </a>
                </div>
            </form>

            <div class="mt-5 rounded-2xl border border-[#1a3c6e]/10 bg-white p-5">
                <div class="flex items-center justify-between gap-3 mb-4">
                    <div>
                        <h4 class="text-sm font-bold text-[#1a3c6e]">Current Public Page Data</h4>
                        <p class="text-xs text-gray-500">This is the data the public project page will currently display for this selected project.</p>
                    </div>
                    <a href="{{ route('projects.show', $selectedProject) }}" target="_blank"
                       class="inline-flex items-center gap-2 px-3 py-2 border border-[#1a3c6e]/15 text-[#1a3c6e] hover:bg-[#1a3c6e]/5 text-xs font-semibold rounded-lg transition-colors">
                        Open Public Page
                    </a>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div class="rounded-xl bg-[#f8f9fc] border border-gray-100 p-4">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-1">Area of Work</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $selectedProject->effective_area_of_work ?: 'Not set' }}</p>
                    </div>
                    <div class="rounded-xl bg-[#f8f9fc] border border-gray-100 p-4">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-1">Duration</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $selectedProject->effective_duration ?: 'Not set' }}</p>
                    </div>
                    <div class="rounded-xl bg-[#f8f9fc] border border-gray-100 p-4">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-1">Location</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $selectedProject->effective_location ?: 'Not set' }}</p>
                    </div>
                    <div class="rounded-xl bg-[#f8f9fc] border border-gray-100 p-4">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-1">Beneficiaries</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $selectedProject->effective_beneficiaries ?: 'Not set' }}</p>
                    </div>
                </div>

                <div class="mt-4 rounded-xl bg-[#f8f9fc] border border-gray-100 p-4">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-1">Make a Difference Title</p>
                    <p class="text-sm text-gray-700 leading-relaxed font-semibold">{{ $selectedProject->effective_make_difference_title ?: 'Make a Difference' }}</p>
                </div>
                <div class="mt-4 rounded-xl bg-[#f8f9fc] border border-gray-100 p-4">
                    <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-1">Make a Difference Text</p>
                    <p class="text-sm text-gray-700 leading-relaxed whitespace-pre-line">{{ $selectedProject->effective_make_difference_text ?: 'Not set' }}</p>
                </div>
                <div class="grid md:grid-cols-2 gap-4 mt-4">
                    <div class="rounded-xl bg-[#f8f9fc] border border-gray-100 p-4">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-1">Donate Button</p>
                        <p class="text-sm text-gray-700 leading-relaxed font-semibold">{{ $selectedProject->effective_donate_button_text ?: 'Donate Now' }}</p>
                    </div>
                    <div class="rounded-xl bg-[#f8f9fc] border border-gray-100 p-4">
                        <p class="text-[11px] font-bold uppercase tracking-wider text-gray-400 mb-1">Contact Button</p>
                        <p class="text-sm text-gray-700 leading-relaxed font-semibold">{{ $selectedProject->effective_contact_button_text ?: 'Want to know more about this project? Contact us' }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
