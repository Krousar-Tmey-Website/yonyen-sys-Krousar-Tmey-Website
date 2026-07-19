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

        $countries = [
            'cambodia'    => ['flag' => '🇰🇭', 'name' => 'Cambodia'],
            'france'      => ['flag' => '🇫🇷', 'name' => 'France'],
            'singapore'   => ['flag' => '🇸🇬', 'name' => 'Singapore'],
            'switzerland' => ['flag' => '🇨🇭', 'name' => 'Switzerland'],
        ];

        return view('admin.website.index', compact('settings', 'countries'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'settings'        => ['required', 'array'],
            'settings.*'      => ['nullable', 'string'],
            'settings.site_logo' => ['nullable', 'string', 'max:255'],
        ]);

        foreach ($data['settings'] as $key => $value) {
            HomeSetting::setValue($key, $value ?? '');
        }

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $request->validate([
                'logo' => ['image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            ]);

            $path = $request->file('logo')->store('logos', 'public');
            HomeSetting::setValue('site_logo', $path);
        }

        // Handle share section icon uploads
        $shareIconKeys = ['sharing_facebook_icon', 'sharing_twitter_icon', 'sharing_linkedin_icon', 'sharing_share_icon'];
        foreach ($shareIconKeys as $iconKey) {
            $fileKey = $iconKey . '_file';
            if ($request->hasFile($fileKey)) {
                $request->validate([
                    $fileKey => ['image', 'mimes:svg,svg+xml,png,jpg,jpeg,webp', 'max:2048'],
                ]);

                $path = $request->file($fileKey)->store('social', 'public');
                HomeSetting::setValue($iconKey, $path);
            }
        }

        return redirect()->route('admin.website.index')->with('success', 'Website settings saved successfully.');
    }
}
