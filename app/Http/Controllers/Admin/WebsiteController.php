<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WebsiteController extends Controller
{
    public function index()
    {
        $settings = HomeSetting::orderBy('group')->orderBy('id')->get()->groupBy('group');

        return view('admin.website.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $imageRule = ['nullable', 'image:allow_svg', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'];

        $data = $request->validate([
            'settings'                    => ['required', 'array'],
            'settings.*'                  => ['nullable', 'string'],
            'settings.site_logo'          => ['nullable', 'string', 'max:255'],
            'logo'                        => $imageRule,
            'sharing_facebook_icon_file'  => $imageRule,
            'sharing_twitter_icon_file'   => $imageRule,
            'sharing_linkedin_icon_file'  => $imageRule,
            'sharing_share_icon_file'     => $imageRule,
            'social_facebook_icon_file'   => $imageRule,
            'social_instagram_icon_file'  => $imageRule,
            'social_linkedin_icon_file'   => $imageRule,
            'social_youtube_icon_file'    => $imageRule,
            'social_telegram_icon_file'   => $imageRule,
        ]);

        foreach ($data['settings'] as $key => $value) {
            HomeSetting::setValue($key, $value ?? '');
        }

        // Handle logo upload — only delete the previous file if it was a genuine
        // upload (under logos/), not the built-in default asset (images/logo.svg).
        if ($request->hasFile('logo')) {
            $oldLogo = HomeSetting::getValue('site_logo', '');
            if (str_starts_with($oldLogo, 'logos/')) {
                Storage::disk('public')->delete($oldLogo);
            }

            $path = $request->file('logo')->store('logos', 'public');
            HomeSetting::setValue('site_logo', $path);
        }

        // Handle share-section and social-link icon uploads (both stored under storage/app/public/social)
        $iconKeys = [
            'sharing_facebook_icon', 'sharing_twitter_icon', 'sharing_linkedin_icon', 'sharing_share_icon',
            'social_facebook_icon', 'social_instagram_icon', 'social_linkedin_icon', 'social_youtube_icon', 'social_telegram_icon',
        ];
        foreach ($iconKeys as $iconKey) {
            $fileKey = $iconKey . '_file';
            if ($request->hasFile($fileKey)) {
                $oldIcon = HomeSetting::getValue($iconKey, '');
                if (str_starts_with($oldIcon, 'social/')) {
                    Storage::disk('public')->delete($oldIcon);
                }

                $path = $request->file($fileKey)->store('social', 'public');
                HomeSetting::setValue($iconKey, $path);
            }
        }

        return redirect()->route('admin.website.index')->with('success', 'Website settings saved successfully.');
    }
}
