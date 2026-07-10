@extends('admin.layouts.app')

@section('title', 'Annual Report Details')
@section('page-title', 'Annual Report Details')
@section('breadcrumb', 'Review report details and file information')

@section('content')
    <div class="mx-auto max-w-4xl rounded-2xl border border-gray-100 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 border-b border-gray-100 pb-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">{{ $report->title }}</h2>
                <p class="mt-1 text-sm text-gray-500">Report details, uploaded file, and publication year.</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.reports.edit', $report) }}" class="rounded-xl border border-amber-200 px-4 py-2 text-sm font-semibold text-amber-700 hover:bg-amber-50">Edit</a>
                <a href="{{ route('admin.reports.index') }}" class="rounded-xl border border-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Back</a>
            </div>
        </div>

        <div class="mt-6 grid gap-6 md:grid-cols-2">
            <div class="rounded-2xl bg-gray-50 p-5">
                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Report Title</p>
                <p class="mt-2 text-lg font-semibold text-gray-800">{{ $report->title }}</p>
            </div>
            <div class="rounded-2xl bg-gray-50 p-5">
                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Year</p>
                <p class="mt-2 text-lg font-semibold text-gray-800">{{ $report->year }}</p>
            </div>
            <div class="rounded-2xl bg-gray-50 p-5">
                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">File Name</p>
                <p class="mt-2 text-lg font-semibold text-gray-800">{{ $report->original_filename ?? 'Uploaded PDF' }}</p>
            </div>
            <div class="rounded-2xl bg-gray-50 p-5">
                <p class="text-xs font-semibold uppercase tracking-wide text-gray-500">Upload Date</p>
                <p class="mt-2 text-lg font-semibold text-gray-800">{{ $report->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>

        <div class="mt-6 rounded-2xl border border-blue-100 bg-blue-50/50 p-5">
            <p class="text-sm font-semibold text-blue-800">Uploaded PDF</p>
            @if ($report->has_pdf_file)
                <div class="mt-3 flex flex-wrap gap-3">
                    <a href="{{ $report->file_url }}" target="_blank" rel="noopener noreferrer" class="rounded-xl bg-[#1d4e7a] px-4 py-2 text-sm font-semibold text-white hover:bg-[#173e63]">View PDF</a>
                    <a href="{{ $report->file_url }}" download="{{ $report->original_filename ?? $report->title . '.pdf' }}" class="rounded-xl border border-[#1d4e7a] px-4 py-2 text-sm font-semibold text-[#1d4e7a] hover:bg-[#1d4e7a] hover:text-white">Download PDF</a>
                </div>
            @else
                <p class="mt-3 text-sm text-gray-600">No PDF file available.</p>
                <div class="mt-3 flex flex-wrap gap-3">
                    <button type="button" disabled class="cursor-not-allowed rounded-xl bg-gray-300 px-4 py-2 text-sm font-semibold text-gray-600">View PDF</button>
                    <button type="button" disabled class="cursor-not-allowed rounded-xl border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-500">Download PDF</button>
                </div>
            @endif
        </div>
    </div>
@endsection
