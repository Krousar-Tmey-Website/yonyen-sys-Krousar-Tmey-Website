<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnnualReport;
use App\Models\HomeSetting;
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

        $settings = HomeSetting::allKeyed();

        return view('admin.reports.index', compact('reports', 'search', 'settings'));
    }

    public function create()
    {
        return view('admin.reports.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'title_fr' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_fr' => ['nullable', 'string'],
            'year'  => ['required', 'integer', 'min:1900', 'max:2100'],
            'file'  => ['required', 'file', 'mimes:pdf', 'max:20480'],
        ]);

        $file = $request->file('file');
        $data['file_path'] = $file->store('reports', 'public');
        $data['original_filename'] = $file->getClientOriginalName();
        $data['is_active'] = true;

        $report = AnnualReport::create($data);

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
            'title_fr' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'description_fr' => ['nullable', 'string'],
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

        return redirect()->route('admin.reports.index')
            ->with('success', 'Report updated successfully.');
    }

    public function destroy(AnnualReport $report)
    {
        if ($report->file_path) {
            Storage::disk('public')->delete($report->file_path);
        }

        $report->delete();

        return redirect()->route('admin.reports.index')
            ->with('success', 'Report deleted successfully.');
    }

    /**
     * Show the Resources (Annual Reports) banner settings page.
     */
    public function bannerIndex()
    {
        $settings = HomeSetting::allKeyed();
        $search = '';
        $reports = AnnualReport::query()
            ->orderByDesc('year')
            ->orderByDesc('created_at')
            ->paginate(15);
        return view('admin.reports.index', compact('settings', 'reports', 'search'));
    }

    /**
     * Handle the Resources banner settings update.
     */
    public function updateBanner(Request $request)
    {
        $request->validate([
            'resources_banner_badge'         => ['nullable', 'string', 'max:255'],
            'resources_banner_title'         => ['nullable', 'string', 'max:255'],
            'resources_banner_subtitle'      => ['nullable', 'string', 'max:1000'],
            'resources_banner_overlay_color' => ['nullable', 'string', 'max:20'],
            'resources_banner_image'         => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            'resources_banner_image_url'     => ['nullable', 'url', 'max:2048'],
            'resources_banner_btn1_text'     => ['nullable', 'string', 'max:100'],
            'resources_banner_btn1_url'      => ['nullable', 'string', 'max:500'],
            'resources_banner_btn2_text'     => ['nullable', 'string', 'max:100'],
            'resources_banner_btn2_url'      => ['nullable', 'string', 'max:500'],
            'resources_banner_btn3_text'     => ['nullable', 'string', 'max:100'],
            'resources_banner_btn3_url'      => ['nullable', 'string', 'max:500'],
        ]);

        HomeSetting::setValue('resources_banner_badge', $request->input('resources_banner_badge', ''));
        HomeSetting::setValue('resources_banner_title', $request->input('resources_banner_title', ''));
        HomeSetting::setValue('resources_banner_subtitle', $request->input('resources_banner_subtitle', ''));
        HomeSetting::setValue('resources_banner_overlay_color', $request->input('resources_banner_overlay_color', ''));
        HomeSetting::setValue('resources_banner_btn1_text', $request->input('resources_banner_btn1_text', ''));
        HomeSetting::setValue('resources_banner_btn1_url', $request->input('resources_banner_btn1_url', ''));
        HomeSetting::setValue('resources_banner_btn2_text', $request->input('resources_banner_btn2_text', ''));
        HomeSetting::setValue('resources_banner_btn2_url', $request->input('resources_banner_btn2_url', ''));
        HomeSetting::setValue('resources_banner_btn3_text', $request->input('resources_banner_btn3_text', ''));
        HomeSetting::setValue('resources_banner_btn3_url', $request->input('resources_banner_btn3_url', ''));

        if ($request->hasFile('resources_banner_image')) {
            $existing = HomeSetting::getValue('resources_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            $path = $request->file('resources_banner_image')->store('resources_banner', 'public');
            HomeSetting::setValue('resources_banner_image', $path);
        } elseif ($request->filled('resources_banner_image_url')) {
            $existing = HomeSetting::getValue('resources_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('resources_banner_image', $request->input('resources_banner_image_url'));
        } elseif ($request->boolean('resources_banner_image_clear')) {
            $existing = HomeSetting::getValue('resources_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('resources_banner_image', '');
        }

        return redirect()->route('admin.resources-banner.index')->with('success', 'Resources banner updated.');
    }
}
