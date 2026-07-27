@extends('admin.layouts.app')

@section('title', 'New Transparency Report')
@section('page-title', 'New Transparency Report')
@section('breadcrumb', 'Transparency → Add New Report')

@section('content')

<div class="space-y-6">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-xl font-bold text-gray-900">New Transparency Report</h3>
            <p class="text-sm text-gray-500 mt-1">Create a new report with PDF upload or external URL.</p>
        </div>
        <a href="{{ route('admin.transparency.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-50 text-gray-700 border border-gray-200 rounded-xl text-sm font-medium hover:bg-gray-100 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back
        </a>
    </div>

    <form action="{{ route('admin.transparency.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Report Details --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8 space-y-5" x-data="bilingualForm()">
            <div class="flex items-center justify-between gap-3">
                <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                    <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </span>
                    Report Details
                </h3>
                <div class="lang-tabs" title="Toggle editing language (English / French)">
                    <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                    <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                </div>
            </div>

            <div x-show="lang === 'en'">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Report Title <span class="text-red-400">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="Annual Report 2025">
                @error('title')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
            </div>

            <div x-show="lang === 'fr'" x-cloak>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Report Title (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                <input type="text" name="title_fr" value="{{ old('title_fr') }}"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="Rapport annuel 2025">
                @error('title_fr')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                <p class="text-xs text-gray-400 mt-2">Shown to French-language visitors. Leave blank to reuse the English title.</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Year <span class="text-red-400">*</span></label>
                    <input type="number" name="year" value="{{ old('year', date('Y')) }}" required min="1990" max="2100"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    @error('year')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>
                <div>
                    <div x-show="lang === 'en'">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                        <input type="text" name="description" value="{{ old('description') }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="PDF · Full Report">
                        @error('description')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                    </div>
                    <div x-show="lang === 'fr'" x-cloak>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Description (French) <span class="text-gray-400 font-normal">(optional)</span></label>
                        <input type="text" name="description_fr" value="{{ old('description_fr') }}"
                               class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                               placeholder="PDF · Rapport complet">
                        @error('description_fr')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                        <p class="text-xs text-gray-400 mt-2">Shown to French-language visitors. Leave blank to reuse the English description.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Report File --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 lg:p-8 space-y-5">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-orange-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                </span>
                Report File
            </h3>

            <div class="grid lg:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Upload PDF</label>
                    <input type="file" name="file" accept="application/pdf"
                           class="w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] file:cursor-pointer border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                    @error('file')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">External URL</label>
                    <input type="url" name="file_url" value="{{ old('file_url') }}"
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="https://example.com/report.pdf">
                    @error('file_url')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>
            </div>
            <p class="text-xs text-gray-400">Provide either an uploaded PDF or an external URL.</p>
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.transparency.index') }}"
               class="px-5 py-2.5 text-sm font-medium text-gray-500 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                Cancel
            </a>
            <button type="submit" class="px-6 py-2.5 bg-[#2d6fa3] text-white rounded-xl text-sm font-semibold hover:bg-[#1d4e7a] transition">
                Add Report
            </button>
        </div>
    </form>
</div>

@endsection
