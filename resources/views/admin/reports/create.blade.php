@extends('admin.layouts.app')

@section('title', 'Add Annual Report')
@section('page-title', 'Add Annual Report')
@section('breadcrumb', 'Reports → Add')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="font-bold text-gray-800">New Annual Report</h3>
                <p class="text-sm text-gray-400 mt-0.5">Upload a PDF report for the resources section.</p>
            </div>
            <a href="{{ route('admin.reports.index') }}"
               class="px-4 py-2.5 bg-gray-100 text-gray-700 rounded-xl text-sm font-medium hover:bg-gray-200 transition">
                Back to reports
            </a>
        </div>

        <form action="{{ route('admin.reports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="space-y-4">
                {{-- Report Title --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Report Title <span class="text-red-400">*</span></label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="e.g. Annual Report 2025">
                    @error('title')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>

                {{-- Year --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Year <span class="text-red-400">*</span></label>
                    <input type="number" name="year" value="{{ old('year') }}" min="1900" max="2100" required
                           class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                           placeholder="e.g. 2025">
                    @error('year')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>

                {{-- PDF File --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">PDF File <span class="text-red-400">*</span></label>
                    <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 bg-gray-50/30 text-center cursor-pointer hover:border-[#2d6fa3]/40 transition-colors"
                         onclick="document.getElementById('fileInput').click()">
                        <input type="file" name="file" id="fileInput" accept=".pdf,application/pdf" required class="hidden">
                        <div id="filePlaceholder">
                            <svg class="mx-auto h-10 w-10 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="text-sm font-medium text-gray-600 mb-1">Click to upload PDF</p>
                            <p class="text-xs text-gray-400">Only PDF files up to 10MB are allowed.</p>
                        </div>
                        <div id="fileInfo" class="hidden mt-3"></div>
                    </div>
                    @error('file')<p class="text-xs text-red-500 mt-2">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex flex-wrap items-center justify-between gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('admin.reports.index') }}"
                   class="px-4 py-2.5 text-sm font-medium text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl transition">
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl text-sm font-semibold transition-all shadow-sm hover:shadow-md">
                    Save Report
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('fileInput');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const info = document.getElementById('fileInfo');
            const placeholder = document.getElementById('filePlaceholder');
            const file = e.target.files[0];

            if (file) {
                placeholder.classList.add('hidden');
                info.classList.remove('hidden');
                info.innerHTML = `
                    <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-100 rounded-lg px-4 py-2">
                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <div class="text-left">
                            <p class="text-sm font-medium text-blue-700">${file.name}</p>
                            <p class="text-xs text-blue-500">${(file.size / 1024).toFixed(1)} KB</p>
                        </div>
                        <button type="button" class="ml-2 text-blue-400 hover:text-blue-600"
                                onclick="document.getElementById('fileInput').value=''; info.innerHTML=''; info.classList.add('hidden'); placeholder.classList.remove('hidden');">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                `;
            }
        });
    }
});
</script>

@endsection
