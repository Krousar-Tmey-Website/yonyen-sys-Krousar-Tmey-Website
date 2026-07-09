<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnnualReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnualReportController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));

        $reports = AnnualReport::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%')
                      ->orWhere('year', 'like', '%' . $search . '%');
                });
            })
            ->latest('created_at')
            ->paginate(10)
            ->appends($request->only('search'));

        return view('admin.reports.index', compact('reports', 'search'));
    }

    public function create()
    {
        return view('admin.reports.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer', 'min:1900', 'max:2100'],
            'file' => ['required', 'file', 'mimes:pdf', 'max:10240'],
        ], [
            'file.required' => 'Please upload a PDF report file.',
            'file.mimes' => 'Only PDF files are allowed.',
            'file.max' => 'The PDF file must not exceed 10MB.',
        ]);

        $file = $request->file('file');
        $data['file_path'] = $file->store('annual-reports', 'public');
        $data['original_filename'] = $file->getClientOriginalName();

        AnnualReport::create($data);

        return redirect()->route('admin.reports.index')->with('success', 'Annual report added successfully.');
    }

    public function edit(AnnualReport $report)
    {
        return view('admin.reports.edit', compact('report'));
    }

    public function update(Request $request, AnnualReport $report)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer', 'min:1900', 'max:2100'],
            'file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
        ], [
            'file.mimes' => 'Only PDF files are allowed.',
            'file.max' => 'The PDF file must not exceed 10MB.',
        ]);

        if ($request->hasFile('file')) {
            if ($report->file_path) {
                Storage::disk('public')->delete($report->file_path);
            }

            $file = $request->file('file');
            $data['file_path'] = $file->store('annual-reports', 'public');
            $data['original_filename'] = $file->getClientOriginalName();
        }

        $report->update($data);

        return redirect()->route('admin.reports.index')->with('success', 'Annual report updated successfully.');
    }

    public function destroy(AnnualReport $report)
    {
        if ($report->file_path) {
            Storage::disk('public')->delete($report->file_path);
        }

        AnnualReport::destroy($report->id);

        return redirect()->route('admin.reports.index')->with('success', 'Annual report deleted successfully.');
    }
}
