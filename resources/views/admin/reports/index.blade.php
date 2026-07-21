@extends('admin.layouts.app')

@section('title', 'Annual Reports')
@section('page-title', 'Annual Reports')
@section('breadcrumb', 'Manage annual reports and downloadable PDFs')

@section('content')

<div class="space-y-6">
    {{-- Reports List --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm">
        {{-- Toolbar --}}
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between flex-wrap gap-4">
            <div class="flex items-center gap-2">
                <h3 class="font-bold text-gray-800">All Reports</h3>
                @if($reports->total() > 0)
                <span class="px-2.5 py-1 bg-[#2d6fa3]/10 text-[#2d6fa3] rounded-full text-xs font-semibold">
                    {{ $reports->total() }}
                </span>
                @endif
            </div>

            <div class="flex items-center gap-3">
                {{-- Search --}}
                <form method="GET" action="{{ route('admin.reports.index') }}" class="flex items-center gap-2">
                    <input name="search" type="text" value="{{ $search ?? '' }}" placeholder="Search by title or year"
                           class="px-3 py-2 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6fa3]/20 focus:border-[#2d6fa3] w-48">
                    <button type="submit"
                            class="px-3 py-2 bg-[#2d6fa3] text-white rounded-xl text-sm font-medium hover:bg-[#1d4e7a] transition-colors">
                        Search
                    </button>
                    @if(request('search'))
                    <a href="{{ route('admin.reports.index') }}"
                       class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-xl transition">
                        Reset
                    </a>
                    @endif
                </form>

                <a href="{{ route('admin.reports.create') }}"
                   class="inline-flex items-center gap-2 px-5 py-2.5 bg-[#2d6fa3] hover:bg-[#1d4e7a] text-white rounded-full text-sm font-semibold transition-colors shadow-sm hover:shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Report
                </a>
            </div>
        </div>

        {{-- Empty state --}}
        @if($reports->isEmpty())
        <div class="py-16 text-center text-gray-400">
            <div class="flex justify-center mb-4">
                <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <p class="text-sm font-medium text-gray-500">No annual reports found</p>
            <p class="text-xs mt-1">Click <strong>Add Report</strong> to upload your first report PDF.</p>
        </div>
        @else
        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-gray-400 text-xs border-b border-gray-50">
                        <th class="text-left font-medium px-6 py-3">Report Title</th>
                        <th class="text-left font-medium px-6 py-3">Year</th>
                        <th class="text-left font-medium px-6 py-3">File Name</th>
                        <th class="text-left font-medium px-6 py-3">Uploaded</th>
                        <th class="text-right font-medium px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reports as $report)
                    <tr class="border-t border-gray-50 hover:bg-gray-50/60 transition">
                        <td class="px-6 py-4">
                            <p class="font-semibold text-gray-800">{{ $report->title }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-gray-700">{{ $report->year }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-gray-500 text-xs">{{ $report->original_filename ?? 'Uploaded PDF' }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-gray-500 text-xs">{{ $report->created_at->format('d M Y') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-end gap-2">
                                {{-- View --}}
                                <a href="{{ route('admin.reports.show', $report) }}" title="View"
                                   class="w-8 h-8 rounded-full bg-green-50 text-green-600 hover:bg-green-100 flex items-center justify-center transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                                {{-- Edit --}}
                                <a href="{{ route('admin.reports.edit', $report) }}" title="Edit"
                                   class="w-8 h-8 rounded-full bg-[#2d6fa3]/10 text-[#2d6fa3] hover:bg-[#2d6fa3]/20 flex items-center justify-center transition">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                </a>
                                {{-- Delete --}}
                                <form action="{{ route('admin.reports.destroy', $report) }}" method="POST"
                                      onsubmit="return confirm('Delete this report permanently?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" title="Delete"
                                            class="w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center transition">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-between flex-wrap gap-4">
            <p class="text-xs text-gray-400">
                Showing <strong>{{ $reports->firstItem() ?? 0 }}</strong> to
                <strong>{{ $reports->lastItem() ?? 0 }}</strong> of
                <strong>{{ $reports->total() }}</strong> items
            </p>
            <div class="flex items-center gap-1">
                {{ $reports->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

@endsection
