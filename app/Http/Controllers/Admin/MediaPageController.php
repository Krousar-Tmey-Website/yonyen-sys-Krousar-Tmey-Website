<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaPageController extends Controller
{
    public function index()
    {
        $settings = HomeSetting::allKeyed();

        return view('admin.media-page.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'media_title' => ['nullable', 'string', 'max:255'],
            'media_contact_email' => ['nullable', 'email', 'max:255'],
            'media_banner_badge' => ['nullable', 'string', 'max:255'],
            'media_banner_title' => ['nullable', 'string', 'max:255'],
            'media_banner_subtitle' => ['nullable', 'string', 'max:1000'],
            'media_banner_subtitle_fr' => ['nullable', 'string', 'max:1000'],
            'media_banner_overlay_color' => ['nullable', 'string', 'max:20'],
            'media_banner_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            'media_banner_image_url' => ['nullable', 'url', 'max:2048'],
            'media_press_heading' => ['nullable', 'string', 'max:255'],
            'media_press_image_file' => ['nullable', 'image', 'max:4096'],
            'remove_media_press_image' => ['nullable', 'boolean'],
            'media_press_source_label' => ['nullable', 'string', 'max:255'],
            'media_press_source_name' => ['nullable', 'string', 'max:255'],
            'media_press_headline' => ['nullable', 'string', 'max:255'],
            'media_press_date' => ['nullable', 'string', 'max:255'],
            'media_press_excerpt' => ['nullable', 'string'],
            'media_press_excerpt_fr' => ['nullable', 'string'],
            'media_press_article_url' => ['nullable', 'url', 'max:2048'],
            'media_latest_heading' => ['nullable', 'string', 'max:255'],
            'media_latest_intro' => ['nullable', 'string', 'max:255'],
        ]);

        if ($request->hasFile('media_press_image_file')) {
            $data['media_press_image'] = $request->file('media_press_image_file')->store('media-page', 'public');
        } elseif ($request->boolean('remove_media_press_image')) {
            $data['media_press_image'] = null;
        }

        unset($data['media_press_image_file'], $data['remove_media_press_image'], $data['media_banner_image'], $data['media_banner_image_url']);

        foreach ($data as $key => $value) {
            HomeSetting::setValue($key, $value);
        }

        if ($request->hasFile('media_banner_image')) {
            $existing = HomeSetting::getValue('media_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            $path = $request->file('media_banner_image')->store('media_banner', 'public');
            HomeSetting::setValue('media_banner_image', $path);
        } elseif ($request->filled('media_banner_image_url')) {
            $existing = HomeSetting::getValue('media_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('media_banner_image', $request->input('media_banner_image_url'));
        } elseif ($request->boolean('media_banner_image_clear')) {
            $existing = HomeSetting::getValue('media_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('media_banner_image', '');
        }

        return redirect()->route('admin.media-page.index')->with('success', 'Media page updated.');
    }
}
