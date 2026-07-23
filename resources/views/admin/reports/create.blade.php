@extends('admin.layouts.app')

@section('title', 'Add Annual Report')
@section('page-title', 'Add Annual Report')
@section('breadcrumb', 'Create a new annual report PDF')

@section('content')
    <div class="mx-auto max-w-3xl rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
        <h2 class="text-xl font-semibold text-gray-800">Add New Report</h2>
        <p class="mt-1 text-sm text-gray-500">Upload a PDF report for the resources section.</p>

        <form action="{{ route('admin.reports.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-5">
            @csrf

            <div x-data="bilingualForm()">
                <div class="mb-1 flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-700">Report Title <span class="text-red-500">*</span></span>
                
                    <div class="lang-tabs" title="Toggle editing language (English / French)">
                        <button type="button" class="lang-tab" :class="{ active: lang === 'en' }" @click="lang = 'en'; switchGTLang('en')">EN</button>
                        <button type="button" class="lang-tab" :class="{ active: lang === 'fr' }" @click="lang = 'fr'; switchGTLang('fr')">FR</button>
                    </div>
                </div>

                <div x-show="lang === 'en'">
                    <input id="title" name="title" type="text" value="{{ old('title') }}" class="w-full rounded-xl border {{ $errors->has('title') ? 'border-red-300 focus:ring-red-400' : 'border-gray-200 focus:ring-[#1d4e7a]' }} px-4 py-2.5 text-sm focus:border-[#1d4e7a] focus:outline-none focus:ring-2">
                    @error('title')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                </div>

                <div x-show="lang === 'fr'" x-cloak>
                    <label for="title_fr" class="mb-1 block text-sm font-semibold text-gray-700">Report Title (French) <span class="optional">(optional)</span></label>
                    <input id="title_fr" name="title_fr" type="text" value="{{ old('title_fr') }}" class="w-full rounded-xl border {{ $errors->has('title_fr') ? 'border-red-300 focus:ring-red-400' : 'border-gray-200 focus:ring-[#1d4e7a]' }} px-4 py-2.5 text-sm focus:border-[#1d4e7a] focus:outline-none focus:ring-2">
                    @error('title_fr')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                    <p class="mt-1 text-xs text-gray-500">Shown to French-language visitors. Leave blank to reuse the English title.</p>
                </div>
            </div>

            <div>
                <label for="year" class="mb-1 block text-sm font-semibold text-gray-700">Year <span class="text-red-500">*</span></label>
                <input id="year" name="year" type="number" min="1900" max="2100" value="{{ old('year') }}" required class="w-full rounded-xl border {{ $errors->has('year') ? 'border-red-300 focus:ring-red-400' : 'border-gray-200 focus:ring-[#1d4e7a]' }} px-4 py-2.5 text-sm focus:border-[#1d4e7a] focus:outline-none focus:ring-2">
                @error('year')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="file" class="mb-1 block text-sm font-semibold text-gray-700">PDF File <span class="text-red-500">*</span></label>
                <input id="file" name="file" type="file" accept=".pdf,application/pdf" required class="block w-full rounded-xl border {{ $errors->has('file') ? 'border-red-300 focus:ring-red-400' : 'border-gray-200' }} text-sm file:mr-4 file:rounded-full file:border-0 file:bg-[#1d4e7a] file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white">
                <p class="mt-1 text-xs text-gray-500">Only PDF files up to 10MB are allowed.</p>
                @error('file')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="rounded-xl bg-[#1d4e7a] px-5 py-2.5 text-sm font-semibold text-white hover:bg-[#173e63]">Save Report</button>
                <a href="{{ route('admin.reports.index') }}" class="rounded-xl border border-gray-200 px-5 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50">Cancel</a>
            </div>
        </form>
    </div>
@endsection
