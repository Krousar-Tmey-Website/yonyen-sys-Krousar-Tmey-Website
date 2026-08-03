<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaBannerController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.media-page.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'media_banner_badge'         => ['nullable', 'string', 'max:255'],
            'media_banner_title'         => ['nullable', 'string'],
            'media_banner_title_fr'      => ['nullable', 'string'],
            'media_banner_subtitle'      => ['nullable', 'string', 'max:1000'],
            'media_banner_subtitle_fr'   => ['nullable', 'string', 'max:1000'],
            'media_banner_overlay_color' => ['nullable', 'string', 'max:20'],
            'media_banner_image'         => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            'media_banner_image_url'     => ['nullable', 'url', 'max:2048'],
            'media_banner_btn1_text'     => ['nullable', 'string', 'max:100'],
            'media_banner_btn1_url'      => ['nullable', 'string', 'max:500'],
            'media_banner_btn2_text'     => ['nullable', 'string', 'max:100'],
            'media_banner_btn2_url'      => ['nullable', 'string', 'max:500'],
            'media_banner_btn3_text'     => ['nullable', 'string', 'max:100'],
            'media_banner_btn3_url'      => ['nullable', 'string', 'max:500'],
        ]);

        HomeSetting::setValue('media_banner_badge', $request->input('media_banner_badge', ''));
        HomeSetting::setValue('media_banner_title', $request->input('media_banner_title', ''));
        HomeSetting::setValue('media_banner_title_fr', $request->input('media_banner_title_fr', ''));
        HomeSetting::setValue('media_banner_subtitle', $request->input('media_banner_subtitle', ''));
        HomeSetting::setValue('media_banner_subtitle_fr', $request->input('media_banner_subtitle_fr', ''));
        HomeSetting::setValue('media_banner_overlay_color', $request->input('media_banner_overlay_color', ''));
        HomeSetting::setValue('media_banner_btn1_text', $request->input('media_banner_btn1_text', ''));
        HomeSetting::setValue('media_banner_btn1_url', $request->input('media_banner_btn1_url', ''));
        HomeSetting::setValue('media_banner_btn2_text', $request->input('media_banner_btn2_text', ''));
        HomeSetting::setValue('media_banner_btn2_url', $request->input('media_banner_btn2_url', ''));
        HomeSetting::setValue('media_banner_btn3_text', $request->input('media_banner_btn3_text', ''));
        HomeSetting::setValue('media_banner_btn3_url', $request->input('media_banner_btn3_url', ''));

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

        return redirect()->route('admin.media-page.index')->with('success', 'Media page banner updated.');
    }
}
