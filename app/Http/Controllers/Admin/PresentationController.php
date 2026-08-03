<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PresentationController extends Controller
{
    public function index()
    {
        $settings = HomeSetting::allKeyed();

        return view('admin.presentations.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'mission_title' => ['nullable', 'string', 'max:255'],
            'mission_title_fr' => ['nullable', 'string', 'max:255'],
            'mission_text' => ['nullable', 'string'],
            'mission_text_fr' => ['nullable', 'string'],
            'mission_image_file' => ['nullable', 'image', 'max:4096'],
            'remove_mission_image' => ['nullable', 'boolean'],
            'vision_title' => ['nullable', 'string', 'max:255'],
            'vision_title_fr' => ['nullable', 'string', 'max:255'],
            'vision_text' => ['nullable', 'string'],
            'vision_text_fr' => ['nullable', 'string'],
            'vision_image_file' => ['nullable', 'image', 'max:4096'],
            'remove_vision_image' => ['nullable', 'boolean'],
            'portfolio_text' => ['nullable', 'string'],
            'portfolio_text_fr' => ['nullable', 'string'],
            'principle_quote' => ['nullable', 'string'],
            'principle_quote_fr' => ['nullable', 'string'],
            'portfolio_volunteers_text' => ['nullable', 'string'],
            'portfolio_volunteers_text_fr' => ['nullable', 'string'],
            'stat_provinces' => ['nullable', 'string'],
            'stat_employees' => ['nullable', 'string'],
            'stat_expats' => ['nullable', 'string'],
            'stat_budget' => ['nullable', 'string'],
            'stat_admin_costs' => ['nullable', 'string'],
            'worldwide_text' => ['nullable', 'string'],
        ]);

        // Handle mission image upload
        if ($request->hasFile('mission_image_file')) {
            $data['mission_image'] = $request->file('mission_image_file')->store('presentation', 'public');
        } elseif ($request->boolean('remove_mission_image')) {
            $data['mission_image'] = null;
        }

        // Handle vision image upload
        if ($request->hasFile('vision_image_file')) {
            $data['vision_image'] = $request->file('vision_image_file')->store('presentation', 'public');
        } elseif ($request->boolean('remove_vision_image')) {
            $data['vision_image'] = null;
        }

        unset($data['mission_image_file'], $data['remove_mission_image'], $data['vision_image_file'], $data['remove_vision_image']);

        // Save all values including empty strings
        foreach ($data as $key => $value) {
            HomeSetting::setValue($key, $value);
        }

        return redirect()->route('admin.presentation.index')->with('success', 'Presentation settings updated.');
    }

    /**
     * Handle the banner tab form submission.
     */
    public function updateBanner(Request $request)
    {
        $request->validate([
            'presentation_banner_badge'         => ['nullable', 'string', 'max:255'],
            'presentation_banner_title'         => ['nullable', 'string', 'max:255'],
            'presentation_banner_subtitle'      => ['nullable', 'string'],
            'presentation_banner_subtitle_fr'   => ['nullable', 'string'],
            'presentation_banner_overlay_color' => ['nullable', 'string', 'max:20'],
            'presentation_banner_image'         => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            'presentation_banner_image_url'     => ['nullable', 'url', 'max:2048'],
            'presentation_banner_btn1_text'     => ['nullable', 'string', 'max:100'],
            'presentation_banner_btn1_url'      => ['nullable', 'string', 'max:500'],
            'presentation_banner_btn2_text'     => ['nullable', 'string', 'max:100'],
            'presentation_banner_btn2_url'      => ['nullable', 'string', 'max:500'],
            'presentation_banner_btn3_text'     => ['nullable', 'string', 'max:100'],
            'presentation_banner_btn3_url'      => ['nullable', 'string', 'max:500'],
        ]);

        HomeSetting::setValue('presentation_banner_badge', $request->input('presentation_banner_badge', ''));
        HomeSetting::setValue('presentation_banner_title', $request->input('presentation_banner_title', ''));
        HomeSetting::setValue('presentation_banner_subtitle', $request->input('presentation_banner_subtitle', ''));
        HomeSetting::setValue('presentation_banner_subtitle_fr', $request->input('presentation_banner_subtitle_fr', ''));
        HomeSetting::setValue('presentation_banner_overlay_color', $request->input('presentation_banner_overlay_color', ''));
        HomeSetting::setValue('presentation_banner_btn1_text', $request->input('presentation_banner_btn1_text', ''));
        HomeSetting::setValue('presentation_banner_btn1_url', $request->input('presentation_banner_btn1_url', ''));
        HomeSetting::setValue('presentation_banner_btn2_text', $request->input('presentation_banner_btn2_text', ''));
        HomeSetting::setValue('presentation_banner_btn2_url', $request->input('presentation_banner_btn2_url', ''));
        HomeSetting::setValue('presentation_banner_btn3_text', $request->input('presentation_banner_btn3_text', ''));
        HomeSetting::setValue('presentation_banner_btn3_url', $request->input('presentation_banner_btn3_url', ''));

        if ($request->hasFile('presentation_banner_image')) {
            $existing = HomeSetting::getValue('presentation_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            $path = $request->file('presentation_banner_image')->store('presentation', 'public');
            HomeSetting::setValue('presentation_banner_image', $path);
        } elseif ($request->filled('presentation_banner_image_url')) {
            $existing = HomeSetting::getValue('presentation_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('presentation_banner_image', $request->input('presentation_banner_image_url'));
        } elseif ($request->boolean('presentation_banner_image_clear')) {
            $existing = HomeSetting::getValue('presentation_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('presentation_banner_image', '');
        }

        return redirect()->route('admin.presentation.index')->with('success', 'Presentation banner updated.');
    }
}
