<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnnualReport;
use App\Services\ActivityLogger;
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
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('year', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('year')
            ->orderByDesc('created_at')
            ->paginate(15)
            ->withQueryString();

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
            'year'  => ['required', 'integer', 'min:1900', 'max:2100'],
            'file'  => ['required', 'file', 'mimes:pdf', 'max:20480'],
        ]);

        $file = $request->file('file');
        $data['file_path'] = $file->store('reports', 'public');
        $data['original_filename'] = $file->getClientOriginalName();
        $data['is_active'] = true;

        $report = AnnualReport::create($data);

        ActivityLogger::log('created', $report, "Created annual report \"{$report->title}\"");

        return redirect()->route('admin.reports.index')
            ->with('success', 'Report created successfully.');
    }

    public function show(AnnualReport $report)
    {
        return view('admin.reports.show', compact('report'));
    }

    public function edit(AnnualReport $report)
    {
        return view('admin.reports.edit', compact('report'));
    }

    public function update(Request $request, AnnualReport $report)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'year'  => ['required', 'integer', 'min:1900', 'max:2100'],
            'file'  => ['nullable', 'file', 'mimes:pdf', 'max:20480'],
        ]);

        if ($request->hasFile('file')) {
            if ($report->file_path) {
                Storage::disk('public')->delete($report->file_path);
            }
            $file = $request->file('file');
            $data['file_path'] = $file->store('reports', 'public');
            $data['original_filename'] = $file->getClientOriginalName();
        }

        $report->update($data);

        ActivityLogger::log('updated', $report, "Updated annual report \"{$report->title}\"", [
            'changes' => array_keys($data),
        ]);

        return redirect()->route('admin.reports.index')
            ->with('success', 'Report updated successfully.');
    }

    public function destroy(AnnualReport $report)
    {
        if ($report->file_path) {
            Storage::disk('public')->delete($report->file_path);
        }
        $title = $report->title;

        $report->delete();

        ActivityLogger::log('deleted', null, "Deleted annual report \"{$title}\"", [
            'report_id' => $report->id,
            'title' => $title,
        ]);

        return redirect()->route('admin.reports.index')
            ->with('success', 'Report deleted successfully.');
    }
}
