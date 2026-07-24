<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;

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
            'media_press_heading' => ['nullable', 'string', 'max:255'],
            'media_press_image_file' => ['nullable', 'image', 'max:4096'],
            'remove_media_press_image' => ['nullable', 'boolean'],
            'media_press_source_label' => ['nullable', 'string', 'max:255'],
            'media_press_source_name' => ['nullable', 'string', 'max:255'],
            'media_press_headline' => ['nullable', 'string', 'max:255'],
            'media_press_date' => ['nullable', 'string', 'max:255'],
            'media_press_excerpt' => ['nullable', 'string'],
            'media_press_article_url' => ['nullable', 'url', 'max:2048'],
            'media_latest_heading' => ['nullable', 'string', 'max:255'],
            'media_latest_intro' => ['nullable', 'string', 'max:255'],
        ]);

        if ($request->hasFile('media_press_image_file')) {
            $data['media_press_image'] = $request->file('media_press_image_file')->store('media-page', 'public');
        } elseif ($request->boolean('remove_media_press_image')) {
            $data['media_press_image'] = null;
        }

        unset($data['media_press_image_file'], $data['remove_media_press_image']);

        foreach ($data as $key => $value) {
            HomeSetting::setValue($key, $value);
        }

        return redirect()->route('admin.media-page.index')->with('success', 'Media page updated.');
    }
}
