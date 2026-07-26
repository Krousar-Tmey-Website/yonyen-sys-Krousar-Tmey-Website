@extends('admin.layouts.app')

@section('title', 'Edit Annual Report')
@section('page-title', 'Edit Annual Report')
@section('breadcrumb', 'Update an existing annual report PDF')

@section('content')
<div class="max-w-3xl mx-auto">

    <form action="{{ route('admin.reports.update', $report) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </span>
                Report Details
            </h3>

            <div x-data="bilingualForm()">
                <div class="mb-1 flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-700">Report Title <span class="text-red-500">*</span></span>

                    <div class="lang-tabs" title="Toggle editing language (English / French)">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                    </div>
                </div>

                <div x-show="lang === 'en'">
                    <input id="title" name="title" type="text" value="{{ old('title', $report->title) }}" class="w-full rounded-xl border {{ $errors->has('title') ? 'border-red-300 focus:ring-red-400' : 'border-gray-200 focus:ring-[#1d4e7a]' }} px-4 py-2.5 text-sm focus:border-[#1d4e7a] focus:outline-none focus:ring-2">
                    @error('title')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>

                <div x-show="lang === 'fr'" x-cloak>
                    <label for="title_fr" class="mb-1 block text-sm font-semibold text-gray-700">Report Title (French) <span class="optional">(optional)</span></label>
                    <input id="title_fr" name="title_fr" type="text" value="{{ old('title_fr', $report->title_fr) }}" class="w-full rounded-xl border {{ $errors->has('title_fr') ? 'border-red-300 focus:ring-red-400' : 'border-gray-200 focus:ring-[#1d4e7a]' }} px-4 py-2.5 text-sm focus:border-[#1d4e7a] focus:outline-none focus:ring-2">
                    @error('title_fr')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    <p class="mt-1 text-xs text-gray-500">Shown to French-language visitors. Leave blank to reuse the English title.</p>
                </div>

                <div x-show="lang === 'en'" class="mt-4">
                    <label for="description" class="mb-1 block text-sm font-semibold text-gray-700">Description</label>
                    <x-admin.rich-text name="description" :value="old('description', $report->description)" lang="en" />
                    @error('description')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>

                <div x-show="lang === 'fr'" x-cloak class="mt-4">
                    <label for="description_fr" class="mb-1 block text-sm font-semibold text-gray-700">Description (French) <span class="optional">(optional)</span></label>
                    <x-admin.rich-text name="description_fr" :value="old('description_fr', $report->description_fr)" lang="fr" />
                    @error('description_fr')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    <p class="mt-1 text-xs text-gray-500">Shown to French-language visitors. Leave blank to reuse the English description.</p>
                </div>
            </div>

            <div>
                <label for="year" class="mb-1 block text-sm font-semibold text-gray-700">Year <span class="text-red-500">*</span></label>
                <input id="year" name="year" type="number" min="1900" max="2100" value="{{ old('year', $report->year) }}" required class="w-full rounded-xl border {{ $errors->has('year') ? 'border-red-300 focus:ring-red-400' : 'border-gray-200 focus:ring-[#1d4e7a]' }} px-4 py-2.5 text-sm focus:border-[#1d4e7a] focus:outline-none focus:ring-2">
                @error('year')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="file" class="mb-1 block text-sm font-semibold text-gray-700">PDF File</label>
                <input id="file" name="file" type="file" accept=".pdf,application/pdf" class="block w-full rounded-xl border {{ $errors->has('file') ? 'border-red-300 focus:ring-red-400' : 'border-gray-200' }} text-sm file:mr-4 file:rounded-full file:border-0 file:bg-[#1d4e7a] file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white">
                @if ($report->file_path)
                    <p class="mt-2 text-sm text-gray-500">Current file: {{ $report->original_filename ?? basename($report->file_path) }}</p>
                @endif
                <p class="mt-1 text-xs text-gray-500">Leave empty to keep the current PDF. Only PDF files up to 10MB are allowed.</p>
                @error('file')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary">Update Report</button>
            <a href="{{ route('admin.reports.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>
@endsection
