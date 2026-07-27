<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnnualReport;
use App\Services\ReportThumbnailGenerator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

    public function store(Request $request, ReportThumbnailGenerator $thumbnails)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'title_fr' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_fr' => ['nullable', 'string'],
            'year'  => ['required', 'integer', 'min:1900', 'max:2100'],
            'file'  => ['required', 'file', 'mimes:pdf', 'max:40960'],
        ]);

        $file = $request->file('file');
        $data['file_path'] = $file->store('reports', 'public');
        $data['original_filename'] = $file->getClientOriginalName();
        $data['is_active'] = true;

        $report = AnnualReport::create($data);
        $this->generateThumbnail($report, $thumbnails);

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

    public function update(Request $request, AnnualReport $report, ReportThumbnailGenerator $thumbnails)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'title_fr' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_fr' => ['nullable', 'string'],
            'year'  => ['required', 'integer', 'min:1900', 'max:2100'],
            'file'  => ['nullable', 'file', 'mimes:pdf', 'max:40960'],
        ]);

        if ($request->hasFile('file')) {
            if ($report->file_path) {
                Storage::disk('public')->delete($report->file_path);
            }
            $file = $request->file('file');
            $data['file_path'] = $file->store('reports', 'public');
            $data['original_filename'] = $file->getClientOriginalName();
            if ($report->thumbnail_path) {
                Storage::disk('public')->delete($report->thumbnail_path);
            }
            $data['thumbnail_path'] = null;

        }

        $report->update($data);

        if ($request->hasFile('file')) {
            $this->generateThumbnail($report->fresh(), $thumbnails);
        }

        return redirect()->route('admin.reports.index')
            ->with('success', 'Report updated successfully.');
    }

    private function generateThumbnail(AnnualReport $report, ReportThumbnailGenerator $thumbnails): void
    {
        try {
            $thumbnails->generate($report);
        } catch (\Throwable $e) {
            Log::warning("Thumbnail generation failed for report #{$report->id}: " . $e->getMessage());
        }
    }

    public function destroy(AnnualReport $report)
    {
        if ($report->file_path) {
            Storage::disk('public')->delete($report->file_path);
        }
        if ($report->thumbnail_path) {
            Storage::disk('public')->delete($report->thumbnail_path);
        }

        $report->delete();

        return redirect()->route('admin.reports.index')
            ->with('success', 'Report deleted successfully.');
    }


}
