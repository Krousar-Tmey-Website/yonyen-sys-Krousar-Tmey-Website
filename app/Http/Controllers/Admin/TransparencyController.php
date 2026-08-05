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
        $hexRule = ['nullable', 'regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/'];

        $data = $request->validate([
            'transparency_financial_heading' => ['nullable', 'string', 'max:255'],
            'transparency_financial_heading_fr' => ['nullable', 'string', 'max:255'],
            'transparency_financial_body' => ['nullable', 'string'],
            'transparency_financial_body_fr' => ['nullable', 'string'],
            'transparency_financial_list_intro' => ['nullable', 'string', 'max:255'],
            'transparency_financial_list_intro_fr' => ['nullable', 'string', 'max:255'],
            'transparency_financial_outro' => ['nullable', 'string'],
            'transparency_financial_outro_fr' => ['nullable', 'string'],
            'transparency_financial_card_color' => $hexRule,
            'transparency_financial_ruler_color' => $hexRule,
            'transparency_origins_heading' => ['nullable', 'string', 'max:255'],
            'transparency_origins_heading_fr' => ['nullable', 'string', 'max:255'],
            'transparency_origins_body' => ['nullable', 'string'],
            'transparency_origins_body_fr' => ['nullable', 'string'],
            'transparency_origins_card_color' => $hexRule,
            'transparency_origins_ruler_color' => $hexRule,
            'transparency_award_prefix' => ['nullable', 'string', 'max:255'],
            'transparency_award_prefix_fr' => ['nullable', 'string', 'max:255'],
            'transparency_award_link_label' => ['nullable', 'string', 'max:255'],
            'transparency_award_link_label_fr' => ['nullable', 'string', 'max:255'],
            'transparency_award_link_url' => ['nullable', 'url', 'max:2048'],
            'transparency_award_suffix' => ['nullable', 'string', 'max:255'],
            'transparency_award_suffix_fr' => ['nullable', 'string', 'max:255'],
        ]);

        foreach ($data as $key => $value) {
            HomeSetting::setValue($key, $value ?? '');
        }

        return redirect()->route('admin.transparency.index')->with('success', 'Page content updated.');
    }

    public function updateBanner(Request $request)
    {
        $request->validate([
            'transparency_title'                => ['nullable', 'string'],
            'transparency_title_fr'              => ['nullable', 'string'],
            'transparency_banner_badge'         => ['nullable', 'string', 'max:255'],
            'transparency_banner_badge_fr'       => ['nullable', 'string', 'max:255'],
            'transparency_banner_subtitle'      => ['nullable', 'string', 'max:1000'],
            'transparency_banner_subtitle_fr'   => ['nullable', 'string', 'max:1000'],
            'transparency_banner_overlay_color' => ['nullable', 'string', 'max:20'],
            'transparency_banner_blur'          => ['nullable', 'integer', 'min:0', 'max:20'],
            'transparency_banner_image'         => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            'transparency_banner_image_url'     => ['nullable', 'url', 'max:2048'],
            'transparency_banner_btn1_text'     => ['nullable', 'string', 'max:100'],
            'transparency_banner_btn1_text_fr'  => ['nullable', 'string', 'max:100'],
            'transparency_banner_btn1_url'      => ['nullable', 'string', 'max:500'],
            'transparency_banner_btn2_text'     => ['nullable', 'string', 'max:100'],
            'transparency_banner_btn2_text_fr'  => ['nullable', 'string', 'max:100'],
            'transparency_banner_btn2_url'      => ['nullable', 'string', 'max:500'],
            'transparency_banner_btn3_text'     => ['nullable', 'string', 'max:100'],
            'transparency_banner_btn3_text_fr'  => ['nullable', 'string', 'max:100'],
            'transparency_banner_btn3_url'      => ['nullable', 'string', 'max:500'],
        ]);

        HomeSetting::setValue('transparency_title', $request->input('transparency_title', ''));
        HomeSetting::setValue('transparency_title_fr', $request->input('transparency_title_fr', ''));
        HomeSetting::setValue('transparency_banner_badge', $request->input('transparency_banner_badge', ''));
        HomeSetting::setValue('transparency_banner_badge_fr', $request->input('transparency_banner_badge_fr', ''));
        HomeSetting::setValue('transparency_banner_subtitle', $request->input('transparency_banner_subtitle', ''));
        HomeSetting::setValue('transparency_banner_subtitle_fr', $request->input('transparency_banner_subtitle_fr', ''));
        HomeSetting::setValue('transparency_banner_overlay_color', $request->input('transparency_banner_overlay_color', ''));
        HomeSetting::setValue('transparency_banner_blur', (string) $request->input('transparency_banner_blur', 0));
        HomeSetting::setValue('transparency_banner_btn1_text', $request->input('transparency_banner_btn1_text', ''));
        HomeSetting::setValue('transparency_banner_btn1_url', $request->input('transparency_banner_btn1_url', ''));
        HomeSetting::setValue('transparency_banner_btn2_text', $request->input('transparency_banner_btn2_text', ''));
        HomeSetting::setValue('transparency_banner_btn2_url', $request->input('transparency_banner_btn2_url', ''));
        HomeSetting::setValue('transparency_banner_btn3_text', $request->input('transparency_banner_btn3_text', ''));
        HomeSetting::setValue('transparency_banner_btn3_url', $request->input('transparency_banner_btn3_url', ''));

        if ($request->hasFile('transparency_banner_image')) {
            $existing = HomeSetting::getValue('transparency_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            $path = $request->file('transparency_banner_image')->store('transparency_banner', 'public');
            HomeSetting::setValue('transparency_banner_image', $path);
        } elseif ($request->filled('transparency_banner_image_url')) {
            $existing = HomeSetting::getValue('transparency_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('transparency_banner_image', $request->input('transparency_banner_image_url'));
        } elseif ($request->boolean('transparency_banner_image_clear')) {
            $existing = HomeSetting::getValue('transparency_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('transparency_banner_image', '');
        }

        return redirect()->route('admin.transparency.index')->with('success', 'Transparency banner updated.');
    }

    public function create()
    {
        return view('admin.transparency.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'title_fr' => ['nullable', 'string', 'max:255'],
            'year' => ['required', 'integer', 'min:1990', 'max:2100'],
            'description' => ['nullable', 'string'],
            'description_fr' => ['nullable', 'string'],
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
            'title_fr' => ['nullable', 'string', 'max:255'],
            'year' => ['required', 'integer', 'min:1990', 'max:2100'],
            'description' => ['nullable', 'string'],
            'description_fr' => ['nullable', 'string'],
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