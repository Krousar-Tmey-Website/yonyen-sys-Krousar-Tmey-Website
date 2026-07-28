<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerPageController extends Controller
{
    public function index()
    {
        $settings = HomeSetting::allKeyed();

        return view('admin.partner-page.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'partner_badge' => ['nullable', 'string', 'max:255'],
            'partner_badge_fr' => ['nullable', 'string', 'max:255'],
            'partner_badge_km' => ['nullable', 'string', 'max:255'],
            'partner_title' => ['nullable', 'string', 'max:255'],
            'partner_title_fr' => ['nullable', 'string', 'max:255'],
            'partner_title_km' => ['nullable', 'string', 'max:255'],
            'partner_intro' => ['nullable', 'string'],
            'partner_intro_fr' => ['nullable', 'string'],
            'partner_intro_km' => ['nullable', 'string'],
            'partner_who_intro' => ['nullable', 'string'],
            'partner_who_intro_fr' => ['nullable', 'string'],
            'partner_who_intro_km' => ['nullable', 'string'],
            'partner_cta_heading' => ['nullable', 'string', 'max:255'],
            'partner_cta_heading_fr' => ['nullable', 'string', 'max:255'],
            'partner_cta_heading_km' => ['nullable', 'string', 'max:255'],
            'partner_cta_subtext' => ['nullable', 'string', 'max:1000'],
            'partner_cta_subtext_fr' => ['nullable', 'string', 'max:1000'],
            'partner_cta_subtext_km' => ['nullable', 'string', 'max:1000'],
            'partner_cta_button_text' => ['nullable', 'string', 'max:255'],
            'partner_cta_button_text_fr' => ['nullable', 'string', 'max:255'],
            'partner_cta_button_text_km' => ['nullable', 'string', 'max:255'],
            'partner_cta_image_left' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:5120'],
            'partner_cta_image_left_url' => ['nullable', 'url', 'max:2048'],
            'partner_cta_image_right' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:5120'],
            'partner_cta_image_right_url' => ['nullable', 'url', 'max:2048'],
        ]);

        foreach (['partner_cta_image_left', 'partner_cta_image_right'] as $key) {
            if ($request->hasFile($key)) {
                $existing = HomeSetting::getValue($key, '');
                if ($existing && !str_starts_with($existing, 'http')) {
                    Storage::disk('public')->delete($existing);
                }
                $data[$key] = $request->file($key)->store('partner-page', 'public');
            } elseif ($request->filled($key.'_url')) {
                $existing = HomeSetting::getValue($key, '');
                if ($existing && !str_starts_with($existing, 'http')) {
                    Storage::disk('public')->delete($existing);
                }
                $data[$key] = $request->input($key.'_url');
            } elseif ($request->boolean($key.'_clear')) {
                $existing = HomeSetting::getValue($key, '');
                if ($existing && !str_starts_with($existing, 'http')) {
                    Storage::disk('public')->delete($existing);
                }
                $data[$key] = '';
            }

            unset($data[$key.'_url']);
        }

        foreach ($data as $key => $value) {
            HomeSetting::setValue($key, $value);
        }

        return redirect()->route('admin.partner-page.index', ['tab' => 'header'])->with('success', 'Become a Partner page updated.');
    }
}
