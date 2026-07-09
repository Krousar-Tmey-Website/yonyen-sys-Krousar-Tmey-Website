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
                                        @if ($report->file_path)
                                            <a href="{{ Storage::disk('public')->url($report->file_path) }}" target="_blank" rel="noopener noreferrer" class="rounded-lg border border-blue-200 px-3 py-1.5 text-xs font-semibold text-blue-700 hover:bg-blue-50">Preview / Download</a>
                                        @endif
                                        <a href="{{ route('admin.reports.edit', $report) }}" class="rounded-lg border border-amber-200 px-3 py-1.5 text-xs font-semibold text-amber-700 hover:bg-amber-50">Edit</a>
                                        <form action="{{ route('admin.reports.destroy', $report) }}" method="POST" onsubmit="return confirm('Delete this report?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-lg border border-red-200 px-3 py-1.5 text-xs font-semibold text-red-700 hover:bg-red-50">Delete</button>
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
            <div class="border-t border-gray-100 px-4 py-4">
                {{ $reports->links() }}
            </div>
        </div>
    </div>
@endsection
