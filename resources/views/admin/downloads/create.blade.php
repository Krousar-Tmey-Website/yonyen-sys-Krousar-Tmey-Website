@extends('admin.layouts.app')
@section('title', 'Add Download')
@section('page-title', 'Add Download')

@section('content')
<div class="max-w-3xl mx-auto">
    <form action="{{ route('admin.downloads.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        {{-- Download Details --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
                Download Details
            </h3>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Description (optional)</label>
                <x-admin.rich-text name="description" :value="old('description')" lang="en" :rows="3" />
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Sort Order</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>

            <div class="flex items-end pb-1">
                <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl w-full">
                    <input type="checkbox" name="is_active" id="is_active" value="1" checked
                           class="rounded border-gray-300 text-[#2d6fa3] w-4 h-4">
                    <label for="is_active" class="text-sm font-medium text-gray-700">Active</label>
                </div>
            </div>
        </div>

        {{-- File --}}
        <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
            <h3 class="font-semibold text-gray-700 text-sm flex items-center gap-2">
                <span class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </span>
                File
            </h3>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Upload File</label>
                <input type="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.zip"
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-[#2d6fa3]/10 file:text-[#2d6fa3] hover:file:bg-[#2d6fa3]/20">
                <p class="mt-1.5 text-xs text-gray-400">Max 500MB. PDF, Word, Excel, PowerPoint, text, and ZIP files supported.</p>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">External URL (optional)</label>
                <input type="url" name="external_url" value="{{ old('external_url') }}" placeholder="https://..."
                       class="w-full px-4 py-3 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
                <p class="mt-1.5 text-xs text-gray-400">If provided, users will be redirected to this URL instead of downloading the file.</p>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            <button type="submit" class="btn-primary">Create Download</button>
            <a href="{{ route('admin.downloads.index') }}" class="text-gray-400 hover:text-gray-600 text-sm">Cancel</a>
        </div>
    </form>
</div>
@endsection
