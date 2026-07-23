<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HistoryBannerController extends Controller
{
    public function index()
    {
        $bannerSettings = HomeSetting::whereIn('key', [
            'history_banner_image',
            'history_banner_overlay_color',
            'history_banner_badge',
            'history_banner_title',
            'history_banner_subtitle',
        ])->pluck('value', 'key');

        return view('admin.history_banner.index', compact('bannerSettings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'history_banner_badge'         => ['nullable', 'string', 'max:255'],
            'history_banner_title'         => ['nullable', 'string', 'max:255'],
            'history_banner_subtitle'      => ['nullable', 'string', 'max:1000'],
            'history_banner_overlay_color' => ['nullable', 'string', 'max:20'],
            'history_banner_image'         => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            'history_banner_image_url'     => ['nullable', 'url', 'max:2048'],
        ]);

        HomeSetting::setValue('history_banner_badge', $request->input('history_banner_badge', ''));
        HomeSetting::setValue('history_banner_title', $request->input('history_banner_title', ''));
        HomeSetting::setValue('history_banner_subtitle', $request->input('history_banner_subtitle', ''));
        HomeSetting::setValue('history_banner_overlay_color', $request->input('history_banner_overlay_color', ''));

        if ($request->hasFile('history_banner_image')) {
            $existing = HomeSetting::getValue('history_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            $path = $request->file('history_banner_image')->store('history_banner', 'public');
            HomeSetting::setValue('history_banner_image', $path);
        } elseif ($request->filled('history_banner_image_url')) {
            $existing = HomeSetting::getValue('history_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('history_banner_image', $request->input('history_banner_image_url'));
        } elseif ($request->boolean('history_banner_image_clear')) {
            $existing = HomeSetting::getValue('history_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('history_banner_image', '');
        }

        return redirect()->route('admin.history-banner.index')->with('success', 'History page banner updated.');
    }
}
