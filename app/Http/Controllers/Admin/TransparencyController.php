<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnnualReport;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransparencyController extends Controller
{
    public function index()
    {
        $reports = AnnualReport::latest()->get();
        $settings = HomeSetting::allKeyed();

        return view('admin.transparency.index', compact('reports', 'settings'));
    }

    public function updateContent(Request $request)
    {
        $data = $request->validate([
            'transparency_title' => ['nullable', 'string', 'max:255'],
            'transparency_financial_heading' => ['nullable', 'string', 'max:255'],
            'transparency_financial_p1' => ['nullable', 'string'],
            'transparency_financial_p2' => ['nullable', 'string'],
            'transparency_financial_p3' => ['nullable', 'string'],
            'transparency_financial_p4' => ['nullable', 'string'],
            'transparency_financial_list_intro' => ['nullable', 'string', 'max:255'],
            'transparency_financial_outro' => ['nullable', 'string'],
            'transparency_origins_heading' => ['nullable', 'string', 'max:255'],
            'transparency_origins_p1' => ['nullable', 'string'],
            'transparency_origins_p2' => ['nullable', 'string'],
            'transparency_origins_p3' => ['nullable', 'string'],
            'transparency_award_prefix' => ['nullable', 'string', 'max:255'],
            'transparency_award_link_label' => ['nullable', 'string', 'max:255'],
            'transparency_award_link_url' => ['nullable', 'url', 'max:2048'],
            'transparency_award_suffix' => ['nullable', 'string', 'max:255'],
        ]);

        foreach ($data as $key => $value) {
            HomeSetting::setValue($key, $value);
        }

        return redirect()->route('admin.transparency.index')->with('success', 'Page content updated.');
    }

    public function create()
    {
        return view('admin.transparency.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer', 'min:1990', 'max:2100'],
            'description' => ['nullable', 'string', 'max:255'],
            'file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'file_url' => ['nullable', 'url', 'max:2048'],
        ]);

        $data['is_active'] = true;

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('reports', 'public');
        } elseif (!empty($data['file_url'])) {
            $data['file_path'] = $data['file_url'];
        }

        unset($data['file_url']);

        AnnualReport::create($data);

        return redirect()->route('admin.transparency.index')->with('success', 'Report added.');
    }

    public function update(Request $request, AnnualReport $report)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer', 'min:1990', 'max:2100'],
            'description' => ['nullable', 'string', 'max:255'],
            'file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'file_url' => ['nullable', 'url', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('file')) {
            if ($report->file_path && !str_starts_with($report->file_path, 'http')) {
                Storage::disk('public')->delete($report->file_path);
            }
            $data['file_path'] = $request->file('file')->store('reports', 'public');
        } elseif (!empty($data['file_url'])) {
            $data['file_path'] = $data['file_url'];
        }

        unset($data['file_url']);

        $report->update($data);

        return redirect()->route('admin.transparency.index')->with('success', 'Report updated.');
    }

    public function edit(AnnualReport $report)
    {
        return view('admin.transparency.edit', compact('report'));
    }

    public function destroy(AnnualReport $report)
    {
        if ($report->file_path && !str_starts_with($report->file_path, 'http')) {
            Storage::disk('public')->delete($report->file_path);
        }
        $report->delete();

        return redirect()->route('admin.transparency.index')->with('success', 'Report removed.');
    }
}