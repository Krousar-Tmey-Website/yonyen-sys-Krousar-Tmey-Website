@extends('admin.layouts.app')

@section('title', 'Annual Reports')
@section('page-title', 'Annual Reports')
@section('breadcrumb', 'Manage annual reports and downloadable PDFs')

@section('content')
    <div class="space-y-6">
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between flex-wrap gap-4">
                <div class="flex items-center gap-2">
                    <h3 class="font-bold text-gray-800">Annual Reports</h3>
                    <span class="px-2.5 py-1 bg-[#2d6fa3]/10 text-[#2d6fa3] rounded-full text-xs font-semibold">{{ $reports->total() }}</span>
                </div>
                <a href="{{ route('admin.reports.create') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-full text-sm font-semibold transition-colors shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Report
                </a>
            </div>
            <p class="px-6 pt-3 pb-4 text-sm text-gray-500">Upload, search, and manage report PDFs for the public resources page.</p>
        </div>

        <div class="rounded-2xl border border-gray-100 bg-white p-4 shadow-sm sm:p-6">
            <form method="GET" action="{{ route('admin.reports.index') }}" class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div class="w-full md:max-w-md">
                    <label for="search" class="sr-only">Search</label>
                    <input id="search" name="search" type="text" value="{{ $search }}" placeholder="Search by title or year" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm focus:border-[#1d4e7a] focus:outline-none focus:ring-2 focus:ring-[#1d4e7a]/20">
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('admin.reports.index') }}" class="rounded-xl border border-gray-200 px-4 py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-50">Reset</a>
                    <button type="submit" class="rounded-xl bg-[#1d4e7a] px-4 py-2.5 text-sm font-semibold text-white hover:bg-[#173e63]">Search</button>
                </div>
            </form>
        </div>

        <div class="rounded-2xl border border-gray-100 bg-white shadow-sm p-6 space-y-3">
            @forelse ($reports as $report)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 rounded-xl border border-gray-100 bg-white p-5 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex-1 min-w-0">
                        <h4 class="text-sm font-bold text-gray-800 truncate">{{ $report->title }}</h4>
                        <div class="flex flex-wrap items-center gap-x-3 gap-y-1 mt-1">
                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-[#2d6fa3] bg-[#2d6fa3]/10 px-2 py-0.5 rounded-full">{{ $report->year }}</span>
                            <span class="text-xs text-gray-400 truncate">{{ $report->original_filename ?? 'Uploaded PDF' }}</span>
                            <span class="text-xs text-gray-400">• {{ $report->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <a href="{{ route('admin.reports.show', $report) }}" title="View report" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-blue-200 text-blue-700 hover:bg-blue-50 transition-colors">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                        </a>
                        <a href="{{ route('admin.reports.edit', $report) }}" title="Edit report" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-amber-200 text-amber-700 hover:bg-amber-50 transition-colors">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                        </a>
                        <form action="{{ route('admin.reports.destroy', $report) }}" method="POST" onsubmit="return confirm('Delete this report permanently?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Delete report" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-red-200 text-red-700 hover:bg-red-50 transition-colors">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="py-16 text-center text-gray-400">
                    <div class="text-4xl mb-3">📄</div>
                    <p class="text-sm font-medium text-gray-500">No annual reports found</p>
                    <p class="text-xs mt-1">Click <strong>Add Report</strong> to create your first report.</p>
                </div>
            @endforelse

            <div class="mt-6 pt-4 border-t border-gray-100">
                {{ $reports->links() }}
            </div>
        </div>
    </div>
@endsection
