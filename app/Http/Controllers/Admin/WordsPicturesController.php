<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WordsPicturesController extends Controller
{
    public function index()
    {
        $settings = HomeSetting::allKeyed();

        return view('admin.words-pictures.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'words_pictures_title' => ['nullable', 'string', 'max:255'],
            'words_pictures_objective_heading' => ['nullable', 'string', 'max:255'],
            'words_pictures_objective_text' => ['nullable', 'string'],
            'words_pictures_objective_text_fr' => ['nullable', 'string'],
            'words_pictures_project_heading' => ['nullable', 'string', 'max:255'],
            'words_pictures_project_p1' => ['nullable', 'string'],
            'words_pictures_project_p1_fr' => ['nullable', 'string'],
            'words_pictures_app_name' => ['nullable', 'string', 'max:255'],
            'words_pictures_project_p2' => ['nullable', 'string'],
            'words_pictures_project_p2_fr' => ['nullable', 'string'],
            'words_pictures_download_prefix' => ['nullable', 'string', 'max:255'],
            'words_pictures_download_url' => ['nullable', 'string', 'max:2048'],
            'words_pictures_download_suffix' => ['nullable', 'string', 'max:255'],
            'words_pictures_thanks_text' => ['nullable', 'string'],
            'words_pictures_thanks_text_fr' => ['nullable', 'string'],
            'words_pictures_dedication_text' => ['nullable', 'string', 'max:255'],
            'words_pictures_contact_prefix' => ['nullable', 'string', 'max:255'],
            'words_pictures_contact_email' => ['nullable', 'email', 'max:255'],
            'words_pictures_qr_image_file' => ['nullable', 'image', 'max:4096'],
            'remove_words_pictures_qr_image' => ['nullable', 'boolean'],
            'words_pictures_learn_more_text' => ['nullable', 'string', 'max:255'],
            'words_pictures_learn_more_url' => ['nullable', 'url', 'max:2048'],
            'words_pictures_donate_url' => ['nullable', 'string', 'max:2048'],
            'words_pictures_photo_file' => ['nullable', 'image', 'max:4096'],
            'remove_words_pictures_photo' => ['nullable', 'boolean'],
            'words_pictures_press_heading' => ['nullable', 'string', 'max:255'],
            'words_pictures_press_image_file' => ['nullable', 'image', 'max:4096'],
            'remove_words_pictures_press_image' => ['nullable', 'boolean'],
            'words_pictures_press_image_caption' => ['nullable', 'string', 'max:500'],
            'words_pictures_press_source_label' => ['nullable', 'string', 'max:255'],
            'words_pictures_press_source_name' => ['nullable', 'string', 'max:255'],
            'words_pictures_press_headline' => ['nullable', 'string', 'max:255'],
            'words_pictures_press_date' => ['nullable', 'string', 'max:255'],
            'words_pictures_press_excerpt' => ['nullable', 'string'],
            'words_pictures_press_excerpt_fr' => ['nullable', 'string'],
            'words_pictures_press_article_url' => ['nullable', 'url', 'max:2048'],
        ]);

        if ($request->hasFile('words_pictures_qr_image_file')) {
            $data['words_pictures_qr_image'] = $request->file('words_pictures_qr_image_file')->store('words-pictures', 'public');
        } elseif ($request->boolean('remove_words_pictures_qr_image')) {
            $data['words_pictures_qr_image'] = null;
        }

        if ($request->hasFile('words_pictures_photo_file')) {
            $data['words_pictures_photo'] = $request->file('words_pictures_photo_file')->store('words-pictures', 'public');
        } elseif ($request->boolean('remove_words_pictures_photo')) {
            $data['words_pictures_photo'] = null;
        }

        if ($request->hasFile('words_pictures_press_image_file')) {
            $data['words_pictures_press_image'] = $request->file('words_pictures_press_image_file')->store('words-pictures', 'public');
        } elseif ($request->boolean('remove_words_pictures_press_image')) {
            $data['words_pictures_press_image'] = null;
        }

        unset(
            $data['words_pictures_qr_image_file'], $data['remove_words_pictures_qr_image'],
            $data['words_pictures_photo_file'], $data['remove_words_pictures_photo'],
            $data['words_pictures_press_image_file'], $data['remove_words_pictures_press_image'],
        );

        foreach ($data as $key => $value) {
            HomeSetting::setValue($key, $value);
        }

        return redirect()->route('admin.words-pictures.index')->with('success', 'Words and Pictures page updated.');
    }

    /**
     * Handle the banner tab form submission.
     */
    public function updateBanner(Request $request)
    {
        $request->validate([
            'words_pictures_banner_badge'         => ['nullable', 'string', 'max:255'],
            'words_pictures_banner_badge_fr'      => ['nullable', 'string', 'max:255'],
            'words_pictures_banner_title'         => ['nullable', 'string'],
            'words_pictures_banner_title_fr'      => ['nullable', 'string'],
            'words_pictures_banner_subtitle'      => ['nullable', 'string', 'max:1000'],
            'words_pictures_banner_subtitle_fr'   => ['nullable', 'string', 'max:1000'],
            'words_pictures_banner_overlay_color' => ['nullable', 'string', 'max:20'],
            'words_pictures_banner_image'         => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            'words_pictures_banner_image_url'     => ['nullable', 'url', 'max:2048'],
            'words_pictures_banner_btn1_text'     => ['nullable', 'string', 'max:100'],
            'words_pictures_banner_btn1_text_fr'  => ['nullable', 'string', 'max:100'],
            'words_pictures_banner_btn1_url'      => ['nullable', 'string', 'max:500'],
            'words_pictures_banner_btn2_text'     => ['nullable', 'string', 'max:100'],
            'words_pictures_banner_btn2_text_fr'  => ['nullable', 'string', 'max:100'],
            'words_pictures_banner_btn2_url'      => ['nullable', 'string', 'max:500'],
            'words_pictures_banner_btn3_text'     => ['nullable', 'string', 'max:100'],
            'words_pictures_banner_btn3_text_fr'  => ['nullable', 'string', 'max:100'],
            'words_pictures_banner_btn3_url'      => ['nullable', 'string', 'max:500'],
        ]);

        HomeSetting::setValue('words_pictures_banner_badge', $request->input('words_pictures_banner_badge', ''));
        HomeSetting::setValue('words_pictures_banner_badge_fr', $request->input('words_pictures_banner_badge_fr', ''));
        HomeSetting::setValue('words_pictures_banner_title', $request->input('words_pictures_banner_title', ''));
        HomeSetting::setValue('words_pictures_banner_title_fr', $request->input('words_pictures_banner_title_fr', ''));
        HomeSetting::setValue('words_pictures_banner_subtitle', $request->input('words_pictures_banner_subtitle', ''));
        HomeSetting::setValue('words_pictures_banner_subtitle_fr', $request->input('words_pictures_banner_subtitle_fr', ''));
        HomeSetting::setValue('words_pictures_banner_overlay_color', $request->input('words_pictures_banner_overlay_color', ''));
        HomeSetting::setValue('words_pictures_banner_btn1_text', $request->input('words_pictures_banner_btn1_text', ''));
        HomeSetting::setValue('words_pictures_banner_btn1_text_fr', $request->input('words_pictures_banner_btn1_text_fr', ''));
        HomeSetting::setValue('words_pictures_banner_btn1_url', $request->input('words_pictures_banner_btn1_url', ''));
        HomeSetting::setValue('words_pictures_banner_btn2_text', $request->input('words_pictures_banner_btn2_text', ''));
        HomeSetting::setValue('words_pictures_banner_btn2_text_fr', $request->input('words_pictures_banner_btn2_text_fr', ''));
        HomeSetting::setValue('words_pictures_banner_btn2_url', $request->input('words_pictures_banner_btn2_url', ''));
        HomeSetting::setValue('words_pictures_banner_btn3_text', $request->input('words_pictures_banner_btn3_text', ''));
        HomeSetting::setValue('words_pictures_banner_btn3_text_fr', $request->input('words_pictures_banner_btn3_text_fr', ''));
        HomeSetting::setValue('words_pictures_banner_btn3_url', $request->input('words_pictures_banner_btn3_url', ''));

        if ($request->hasFile('words_pictures_banner_image')) {
            $existing = HomeSetting::getValue('words_pictures_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            $path = $request->file('words_pictures_banner_image')->store('words-pictures', 'public');
            HomeSetting::setValue('words_pictures_banner_image', $path);
        } elseif ($request->filled('words_pictures_banner_image_url')) {
            $existing = HomeSetting::getValue('words_pictures_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('words_pictures_banner_image', $request->input('words_pictures_banner_image_url'));
        } elseif ($request->boolean('words_pictures_banner_image_clear')) {
            $existing = HomeSetting::getValue('words_pictures_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('words_pictures_banner_image', '');
        }

        return redirect()->route('admin.words-pictures.index')->with('success', 'Words and Pictures banner updated.');
    }
}
