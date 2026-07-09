<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnnualReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnnualReportController extends Controller
{
    public function index()
    {
        $reports = AnnualReport::orderByDesc('year')->get();
        return view('admin.annual_reports.index', compact('reports'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'year'        => ['required', 'integer', 'min:1990', 'max:2100'],
            'description' => ['nullable', 'string', 'max:255'],
            'file_url'    => ['nullable', 'url', 'max:500'],
            'file'        => ['nullable', 'file', 'mimes:pdf', 'max:20480'],
            'sort_order'  => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('reports', 'public');
        }

        $data['sort_order'] = $data['sort_order'] ?? 0;
        unset($data['file']);
        AnnualReport::create($data);

        return redirect()->route('admin.annual-reports.index')->with('success', 'Report added.');
    }

    public function update(Request $request, AnnualReport $annualReport)
    {
        $data = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'year'        => ['required', 'integer', 'min:1990', 'max:2100'],
            'description' => ['nullable', 'string', 'max:255'],
            'file_url'    => ['nullable', 'url', 'max:500'],
            'file'        => ['nullable', 'file', 'mimes:pdf', 'max:20480'],
            'sort_order'  => ['nullable', 'integer'],
            'is_active'   => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('file')) {
            if ($annualReport->file_path) Storage::disk('public')->delete($annualReport->file_path);
            $data['file_path'] = $request->file('file')->store('reports', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        unset($data['file']);
        $annualReport->update($data);

        return redirect()->route('admin.annual-reports.index')->with('success', 'Report updated.');
    }

    public function destroy(AnnualReport $annualReport)
    {
        if ($annualReport->file_path) Storage::disk('public')->delete($annualReport->file_path);
        $annualReport->delete();
        return redirect()->route('admin.annual-reports.index')->with('success', 'Report removed.');
    }
}
