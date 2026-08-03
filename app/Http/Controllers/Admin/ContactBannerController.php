<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactBannerController extends Controller
{
    public function index()
    {
        $bannerSettings = HomeSetting::whereIn('key', [
            'contact_banner_image',
            'contact_banner_overlay_color',
            'contact_banner_badge',
            'contact_banner_title',
            'contact_banner_subtitle',
            'contact_banner_subtitle_fr',
            'contact_banner_btn1_text',
            'contact_banner_btn1_url',
            'contact_banner_btn2_text',
            'contact_banner_btn2_url',
        ])->pluck('value', 'key');

        return view('admin.contact-banner.index', compact('bannerSettings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'contact_banner_badge'         => ['nullable', 'string', 'max:255'],
            'contact_banner_title'         => ['nullable', 'string', 'max:255'],
            'contact_banner_subtitle'      => ['nullable', 'string'],
            'contact_banner_subtitle_fr'   => ['nullable', 'string'],
            'contact_banner_overlay_color' => ['nullable', 'string', 'max:20'],
            'contact_banner_image'         => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            'contact_banner_image_url'     => ['nullable', 'url', 'max:2048'],
            'contact_banner_btn1_text'     => ['nullable', 'string', 'max:100'],
            'contact_banner_btn1_url'      => ['nullable', 'string', 'max:500'],
            'contact_banner_btn2_text'     => ['nullable', 'string', 'max:100'],
            'contact_banner_btn2_url'      => ['nullable', 'string', 'max:500'],
        ]);

        HomeSetting::setValue('contact_banner_badge', $request->input('contact_banner_badge', ''));
        HomeSetting::setValue('contact_banner_title', $request->input('contact_banner_title', ''));
        HomeSetting::setValue('contact_banner_subtitle', $request->input('contact_banner_subtitle', ''));
        HomeSetting::setValue('contact_banner_subtitle_fr', $request->input('contact_banner_subtitle_fr', ''));
        HomeSetting::setValue('contact_banner_overlay_color', $request->input('contact_banner_overlay_color', ''));
        HomeSetting::setValue('contact_banner_btn1_text', $request->input('contact_banner_btn1_text', ''));
        HomeSetting::setValue('contact_banner_btn1_url', $request->input('contact_banner_btn1_url', ''));
        HomeSetting::setValue('contact_banner_btn2_text', $request->input('contact_banner_btn2_text', ''));
        HomeSetting::setValue('contact_banner_btn2_url', $request->input('contact_banner_btn2_url', ''));

        if ($request->hasFile('contact_banner_image')) {
            $existing = HomeSetting::getValue('contact_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            $path = $request->file('contact_banner_image')->store('contact_banner', 'public');
            HomeSetting::setValue('contact_banner_image', $path);
        } elseif ($request->filled('contact_banner_image_url')) {
            $existing = HomeSetting::getValue('contact_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('contact_banner_image', $request->input('contact_banner_image_url'));
        } elseif ($request->boolean('contact_banner_image_clear')) {
            $existing = HomeSetting::getValue('contact_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('contact_banner_image', '');
        }

        return redirect()->route('admin.contact-page.index')->with('success', 'Contact page banner updated.');
    }
}
