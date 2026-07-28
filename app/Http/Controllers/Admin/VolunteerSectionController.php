<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VolunteerSectionController extends Controller
{
    public function index()
    {
        $settings = HomeSetting::allKeyed();

        return view('admin.volunteer-section.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'volunteer_badge' => ['nullable', 'string', 'max:255'],
            'volunteer_badge_fr' => ['nullable', 'string', 'max:255'],
            'volunteer_title' => ['nullable', 'string', 'max:255'],
            'volunteer_title_fr' => ['nullable', 'string', 'max:255'],
            'volunteer_intro' => ['nullable', 'string'],
            'volunteer_intro_fr' => ['nullable', 'string'],
            'volunteer_image_caption_title' => ['nullable', 'string', 'max:255'],
            'volunteer_image_caption_title_fr' => ['nullable', 'string', 'max:255'],
            'volunteer_image_caption_subtitle' => ['nullable', 'string', 'max:255'],
            'volunteer_image_caption_subtitle_fr' => ['nullable', 'string', 'max:255'],
            'volunteer_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:5120'],
            'volunteer_image_url' => ['nullable', 'url', 'max:2048'],
        ]);

        if ($request->hasFile('volunteer_image')) {
            $existing = HomeSetting::getValue('volunteer_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            $data['volunteer_image'] = $request->file('volunteer_image')->store('volunteer-section', 'public');
        } elseif ($request->filled('volunteer_image_url')) {
            $existing = HomeSetting::getValue('volunteer_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            $data['volunteer_image'] = $request->input('volunteer_image_url');
        } elseif ($request->boolean('volunteer_image_clear')) {
            $existing = HomeSetting::getValue('volunteer_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            $data['volunteer_image'] = '';
        }

        unset($data['volunteer_image_url']);

        foreach ($data as $key => $value) {
            HomeSetting::setValue($key, $value);
        }

        return redirect()->route('admin.volunteer-section.index', ['tab' => 'header'])->with('success', 'Volunteer section updated.');
    }
}
