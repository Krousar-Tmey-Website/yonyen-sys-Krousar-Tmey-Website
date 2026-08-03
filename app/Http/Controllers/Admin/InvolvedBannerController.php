<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvolvedBannerController extends Controller
{
    public function index()
    {
        $bannerSettings = HomeSetting::whereIn('key', [
            // Hero Banner
            'involved_banner_image',
            'involved_banner_overlay_color',
            'involved_banner_badge',
            'involved_banner_title',
            'involved_banner_title_fr',
            'involved_banner_subtitle',
            'involved_banner_subtitle_fr',
            // Books for Sale Section
            'involved_books_banner_image',
            'involved_books_banner_overlay_color',
            'involved_books_banner_badge',
            'involved_books_banner_title',
            'involved_books_banner_title_fr',
            'involved_books_banner_subtitle',
            'involved_books_banner_subtitle_fr',
            // CTA Section
            'involved_cta_banner_image',
            'involved_cta_banner_overlay_color',
            'involved_cta_banner_badge',
            'involved_cta_banner_title',
            'involved_cta_banner_title_fr',
            'involved_cta_banner_subtitle',
            'involved_cta_banner_subtitle_fr',
        ])->pluck('value', 'key');

        return view('admin.involved-banner.index', compact('bannerSettings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            // Hero Banner
            'involved_banner_badge'         => ['nullable', 'string', 'max:255'],
            'involved_banner_title'         => ['nullable', 'string'],
            'involved_banner_title_fr'      => ['nullable', 'string'],
            'involved_banner_subtitle'      => ['nullable', 'string'],
            'involved_banner_subtitle_fr'   => ['nullable', 'string'],
            'involved_banner_overlay_color' => ['nullable', 'string', 'max:20'],
            'involved_banner_image'         => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            'involved_banner_image_url'     => ['nullable', 'url', 'max:2048'],

            // Books for Sale Section
            'involved_books_banner_badge'         => ['nullable', 'string', 'max:255'],
            'involved_books_banner_title'         => ['nullable', 'string'],
            'involved_books_banner_title_fr'      => ['nullable', 'string'],
            'involved_books_banner_subtitle'      => ['nullable', 'string'],
            'involved_books_banner_subtitle_fr'   => ['nullable', 'string'],
            'involved_books_banner_overlay_color' => ['nullable', 'string', 'max:20'],
            'involved_books_banner_image'         => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            'involved_books_banner_image_url'     => ['nullable', 'url', 'max:2048'],

            // CTA Section
            'involved_cta_banner_badge'         => ['nullable', 'string', 'max:255'],
            'involved_cta_banner_title'         => ['nullable', 'string'],
            'involved_cta_banner_title_fr'      => ['nullable', 'string'],
            'involved_cta_banner_subtitle'      => ['nullable', 'string'],
            'involved_cta_banner_subtitle_fr'   => ['nullable', 'string'],
            'involved_cta_banner_overlay_color' => ['nullable', 'string', 'max:20'],
            'involved_cta_banner_image'         => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            'involved_cta_banner_image_url'     => ['nullable', 'url', 'max:2048'],
        ]);

        // === Hero Banner ===
        HomeSetting::setValue('involved_banner_badge', $request->input('involved_banner_badge', ''));
        HomeSetting::setValue('involved_banner_title', $request->input('involved_banner_title', ''));
        HomeSetting::setValue('involved_banner_title_fr', $request->input('involved_banner_title_fr', ''));
        HomeSetting::setValue('involved_banner_subtitle', $request->input('involved_banner_subtitle', ''));
        HomeSetting::setValue('involved_banner_subtitle_fr', $request->input('involved_banner_subtitle_fr', ''));
        HomeSetting::setValue('involved_banner_overlay_color', $request->input('involved_banner_overlay_color', ''));

        if ($request->hasFile('involved_banner_image')) {
            $existing = HomeSetting::getValue('involved_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            $path = $request->file('involved_banner_image')->store('involved_banner', 'public');
            HomeSetting::setValue('involved_banner_image', $path);
        } elseif ($request->filled('involved_banner_image_url')) {
            $existing = HomeSetting::getValue('involved_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('involved_banner_image', $request->input('involved_banner_image_url'));
        } elseif ($request->boolean('involved_banner_image_clear')) {
            $existing = HomeSetting::getValue('involved_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('involved_banner_image', '');
        }

        // === Books for Sale Section Banner ===
        HomeSetting::setValue('involved_books_banner_badge', $request->input('involved_books_banner_badge', ''));
        HomeSetting::setValue('involved_books_banner_title', $request->input('involved_books_banner_title', ''));
        HomeSetting::setValue('involved_books_banner_title_fr', $request->input('involved_books_banner_title_fr', ''));
        HomeSetting::setValue('involved_books_banner_subtitle', $request->input('involved_books_banner_subtitle', ''));
        HomeSetting::setValue('involved_books_banner_subtitle_fr', $request->input('involved_books_banner_subtitle_fr', ''));
        HomeSetting::setValue('involved_books_banner_overlay_color', $request->input('involved_books_banner_overlay_color', ''));

        if ($request->hasFile('involved_books_banner_image')) {
            $existing = HomeSetting::getValue('involved_books_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            $path = $request->file('involved_books_banner_image')->store('involved_books_banner', 'public');
            HomeSetting::setValue('involved_books_banner_image', $path);
        } elseif ($request->filled('involved_books_banner_image_url')) {
            $existing = HomeSetting::getValue('involved_books_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('involved_books_banner_image', $request->input('involved_books_banner_image_url'));
        } elseif ($request->boolean('involved_books_banner_image_clear')) {
            $existing = HomeSetting::getValue('involved_books_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('involved_books_banner_image', '');
        }

        // === CTA Section Banner ===
        HomeSetting::setValue('involved_cta_banner_badge', $request->input('involved_cta_banner_badge', ''));
        HomeSetting::setValue('involved_cta_banner_title', $request->input('involved_cta_banner_title', ''));
        HomeSetting::setValue('involved_cta_banner_title_fr', $request->input('involved_cta_banner_title_fr', ''));
        HomeSetting::setValue('involved_cta_banner_subtitle', $request->input('involved_cta_banner_subtitle', ''));
        HomeSetting::setValue('involved_cta_banner_subtitle_fr', $request->input('involved_cta_banner_subtitle_fr', ''));
        HomeSetting::setValue('involved_cta_banner_overlay_color', $request->input('involved_cta_banner_overlay_color', ''));

        if ($request->hasFile('involved_cta_banner_image')) {
            $existing = HomeSetting::getValue('involved_cta_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            $path = $request->file('involved_cta_banner_image')->store('involved_cta_banner', 'public');
            HomeSetting::setValue('involved_cta_banner_image', $path);
        } elseif ($request->filled('involved_cta_banner_image_url')) {
            $existing = HomeSetting::getValue('involved_cta_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('involved_cta_banner_image', $request->input('involved_cta_banner_image_url'));
        } elseif ($request->boolean('involved_cta_banner_image_clear')) {
            $existing = HomeSetting::getValue('involved_cta_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('involved_cta_banner_image', '');
        }

        return redirect()->route('admin.involved-banner.index')->with('success', 'Get Involved page banners updated.');
    }
}
