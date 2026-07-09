@extends('admin.layouts.app')

@section('title', 'Annual Reports')
@section('page-title', 'Annual Reports')
@section('breadcrumb', 'Manage downloadable annual reports on the Resources page')

@section('content')

<div class="grid lg:grid-cols-3 gap-6">
    {{-- Add form --}}
    <div class="bg-white rounded-2xl border border-gray-100 p-6">
        <h3 class="font-bold text-gray-700 mb-4 text-sm">Add New Report</h3>
        <form action="{{ route('admin.annual-reports.store') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
            @csrf
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Title <span class="text-red-400">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="Annual Report 2024">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Year <span class="text-red-400">*</span></label>
                <input type="number" name="year" value="{{ old('year', date('Y')) }}" required min="1990" max="2100"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                <input type="text" name="description" value="{{ old('description') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="PDF · Full Report">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Upload PDF</label>
                <input type="file" name="file" accept=".pdf"
                       class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3] file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:bg-[#2d6fa3]/10 file:text-[#2d6fa3]">
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">— or External URL</label>
                <input type="url" name="file_url" value="{{ old('file_url') }}"
                       class="w-full px-3 py-2.5 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3]"
                       placeholder="https://...">
            </div>
            <button type="submit" class="w-full btn-primary text-sm py-2.5">Add Report</button>
        </form>
    </div>

    {{-- List --}}
    <div class="lg:col-span-2">
        @if($reports->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-100 py-12 text-center text-gray-400 text-sm">
            No reports yet. Add your first one.
        </div>
        @else
        <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
            <div class="px-5 py-3.5 bg-gray-50 border-b border-gray-100">
                <h4 class="font-semibold text-gray-700 text-sm">{{ $reports->count() }} Report(s)</h4>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($reports as $report)
                <div x-data="{ editing: false }">
                    {{-- View row --}}
                    <div class="flex items-center justify-between px-5 py-4 hover:bg-gray-50/50" x-show="!editing">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-9 h-9 rounded-lg bg-[#2d6fa3] flex items-center justify-center flex-shrink-0">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-700 text-sm">{{ $report->title }}</p>
                                <p class="text-gray-400 text-xs">{{ $report->year }} · {{ $report->description ?? 'PDF' }}
                                    @if($report->download_url)
                                    · <a href="{{ $report->download_url }}" target="_blank" class="text-[#2d6fa3] hover:underline">View</a>
                                    @endif
                                    @if(!$report->is_active)<span class="ml-1 text-orange-400">hidden</span>@endif
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 flex-shrink-0 ml-3">
                            <button @click="editing = true" class="text-[#2d6fa3] hover:text-[#1d4e7a] text-xs font-medium p-1">Edit</button>
                            <form action="{{ route('admin.annual-reports.destroy', $report) }}" method="POST"
                                  onsubmit="return confirm('Remove this report?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-300 hover:text-red-500 transition-colors p-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    {{-- Edit form --}}
                    <div class="px-5 py-4 bg-gray-50 border-t border-gray-100" x-show="editing" x-cloak>
                        <form action="{{ route('admin.annual-reports.update', $report) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                            @csrf @method('PUT')
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Title</label>
                                    <input type="text" name="title" value="{{ $report->title }}" required
                                           class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Year</label>
                                    <input type="number" name="year" value="{{ $report->year }}" required
                                           class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Description</label>
                                <input type="text" name="description" value="{{ $report->description }}"
                                       class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Replace PDF</label>
                                <input type="file" name="file" accept=".pdf"
                                       class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:text-xs file:bg-[#2d6fa3]/10 file:text-[#2d6fa3]">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">External URL</label>
                                <input type="url" name="file_url" value="{{ $report->file_url }}"
                                       class="w-full px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-[#2d6fa3]">
                            </div>
                            <div class="flex items-center gap-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="checkbox" name="is_active" value="1" {{ $report->is_active ? 'checked' : '' }}
                                           class="rounded accent-[#2d6fa3] w-4 h-4">
                                    <span class="text-xs text-gray-600">Active</span>
                                </label>
                            </div>
                            <div class="flex gap-2">
                                <button type="submit" class="btn-primary text-xs px-4 py-2">Save</button>
                                <button type="button" @click="editing = false" class="text-gray-400 hover:text-gray-600 text-xs px-4 py-2">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
