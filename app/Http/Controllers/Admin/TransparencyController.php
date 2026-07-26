<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransparencyController extends Controller
{
    public function index()
    {
        $settings = HomeSetting::allKeyed();

        return view('admin.transparency.index', compact('settings'));
    }

    public function updateContent(Request $request)
    {
        $data = $request->validate([
            'transparency_financial_heading' => ['nullable', 'string', 'max:255'],
            'transparency_financial_heading_fr' => ['nullable', 'string', 'max:255'],
            'transparency_financial_p1' => ['nullable', 'string'],
            'transparency_financial_p1_fr' => ['nullable', 'string'],
            'transparency_financial_p2' => ['nullable', 'string'],
            'transparency_financial_p2_fr' => ['nullable', 'string'],
            'transparency_financial_p3' => ['nullable', 'string'],
            'transparency_financial_p3_fr' => ['nullable', 'string'],
            'transparency_financial_p4' => ['nullable', 'string'],
            'transparency_financial_p4_fr' => ['nullable', 'string'],
            'transparency_financial_outro' => ['nullable', 'string'],
            'transparency_financial_outro_fr' => ['nullable', 'string'],
            'transparency_origins_heading' => ['nullable', 'string', 'max:255'],
            'transparency_origins_heading_fr' => ['nullable', 'string', 'max:255'],
            'transparency_origins_p1' => ['nullable', 'string'],
            'transparency_origins_p1_fr' => ['nullable', 'string'],
            'transparency_origins_p2' => ['nullable', 'string'],
            'transparency_origins_p2_fr' => ['nullable', 'string'],
            'transparency_origins_p3' => ['nullable', 'string'],
            'transparency_origins_p3_fr' => ['nullable', 'string'],
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
            'transparency_title'                => ['nullable', 'string', 'max:255'],
            'transparency_title_fr'              => ['nullable', 'string', 'max:255'],
            'transparency_banner_badge'         => ['nullable', 'string', 'max:255'],
            'transparency_banner_badge_fr'       => ['nullable', 'string', 'max:255'],
            'transparency_banner_subtitle'      => ['nullable', 'string', 'max:1000'],
            'transparency_banner_subtitle_fr'   => ['nullable', 'string', 'max:1000'],
            'transparency_banner_overlay_color' => ['nullable', 'string', 'max:20'],
            'transparency_banner_blur'          => ['nullable', 'integer', 'min:0', 'max:20'],
            'transparency_banner_image'         => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            'transparency_banner_image_url'     => ['nullable', 'url', 'max:2048'],
        ]);

        HomeSetting::setValue('transparency_title', $request->input('transparency_title', ''));
        HomeSetting::setValue('transparency_title_fr', $request->input('transparency_title_fr', ''));
        HomeSetting::setValue('transparency_banner_badge', $request->input('transparency_banner_badge', ''));
        HomeSetting::setValue('transparency_banner_badge_fr', $request->input('transparency_banner_badge_fr', ''));
        HomeSetting::setValue('transparency_banner_subtitle', $request->input('transparency_banner_subtitle', ''));
        HomeSetting::setValue('transparency_banner_subtitle_fr', $request->input('transparency_banner_subtitle_fr', ''));
        HomeSetting::setValue('transparency_banner_overlay_color', $request->input('transparency_banner_overlay_color', ''));
        HomeSetting::setValue('transparency_banner_blur', (string) $request->input('transparency_banner_blur', 0));

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
}