@extends('admin.layouts.app')

@section('title', 'Annual Reports')
@section('page-title', 'Annual Reports')
@section('breadcrumb', 'Manage annual reports and downloadable PDFs')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">Annual Reports</h2>
                <p class="text-sm text-gray-500">Upload, search, and manage report PDFs for the public resources page.</p>
            </div>
            <a href="{{ route('admin.reports.create') }}" class="inline-flex items-center justify-center rounded-xl bg-[#1d4e7a] px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#173e63]">
                Add Report
            </a>
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

        <div class="overflow-hidden rounded-2xl border border-gray-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Report Title</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Year</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">File Name</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Uploaded Date</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @forelse ($reports as $report)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4 text-sm font-medium text-gray-800">{{ $report->title }}</td>
                                <td class="px-4 py-4 text-sm text-gray-600">{{ $report->year }}</td>
                                <td class="px-4 py-4 text-sm text-gray-600">{{ $report->original_filename ?? 'Uploaded PDF' }}</td>
                                <td class="px-4 py-4 text-sm text-gray-600">{{ $report->created_at->format('d M Y') }}</td>
                                <td class="px-4 py-4 text-sm">
                                    <div class="flex flex-wrap gap-2">
                                        <a href="{{ route('admin.reports.show', $report) }}" title="View report" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-blue-200 text-blue-700 hover:bg-blue-50">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        </a>
                                        <a href="{{ route('admin.reports.edit', $report) }}" title="Edit report" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-amber-200 text-amber-700 hover:bg-amber-50">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                                        </a>
                                        <form action="{{ route('admin.reports.destroy', $report) }}" method="POST" onsubmit="return confirm('Delete this report permanently?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Delete report" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-red-200 text-red-700 hover:bg-red-50">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-sm text-gray-500">No annual reports found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="pagination-links border-t border-gray-100 px-4 py-4">
                {{ $reports->links() }}
            </div>
        </div>
    </div>
@endsection
