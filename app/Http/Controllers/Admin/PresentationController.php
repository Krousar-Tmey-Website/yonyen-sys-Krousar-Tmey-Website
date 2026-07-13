<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CoreValue;
use App\Models\HomeSetting;
use App\Models\Office;
use Illuminate\Http\Request;

class PresentationController extends Controller
{
    public function index()
    {
        $coreValues = CoreValue::ordered()->get();
        $offices = Office::active()->where('country', '!=', 'Cambodia')->get();
        $settings = HomeSetting::allKeyed();

        return view('admin.presentations.index', compact('coreValues', 'offices', 'settings'));
    }

    public function update(Request $request)
    {
        $section = $request->input('section', 'all');
        
        $data = $request->validate([
            'hero_title' => ['nullable', 'string', 'max:255'],
            'hero_subtitle' => ['nullable', 'string', 'max:255'],
            'hero_description' => ['nullable', 'string', 'max:255'],
            'hero_image' => ['nullable', 'url', 'max:2048'],
            'hero_image_file' => ['nullable', 'image', 'max:4096'],
            'remove_hero_image' => ['nullable', 'boolean'],
            'about_title' => ['nullable', 'string', 'max:255'],
            'about_description' => ['nullable', 'string'],
            'about_image' => ['nullable', 'url', 'max:2048'],
            'about_image_file' => ['nullable', 'image', 'max:4096'],
            'remove_about_image' => ['nullable', 'boolean'],
            'principle_title' => ['nullable', 'string', 'max:255'],
            'principle_quote' => ['nullable', 'string'],
            'principle_image' => ['nullable', 'url', 'max:2048'],
            'principle_image_file' => ['nullable', 'image', 'max:4096'],
            'remove_principle_image' => ['nullable', 'boolean'],
            'stat_children' => ['nullable', 'string'],
            'stat_welfare' => ['nullable', 'string'],
            'stat_special_ed' => ['nullable', 'string'],
            'stat_2025' => ['nullable', 'string'],
            'stat_arts' => ['nullable', 'string'],
            'stat_counseling' => ['nullable', 'string'],
            'stat_employees' => ['nullable', 'string'],
            'stat_budget' => ['nullable', 'string'],
            'stat_admin' => ['nullable', 'string'],
            'sharing_enabled' => ['nullable', 'string'],
            'sharing_title' => ['nullable', 'string', 'max:255'],
            'sharing_facebook_link' => ['nullable', 'url', 'max:2048'],
            'sharing_twitter_link' => ['nullable', 'url', 'max:2048'],
            'sharing_linkedin_link' => ['nullable', 'url', 'max:2048'],
            'sharing_facebook_icon' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'sharing_twitter_icon' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'sharing_linkedin_icon' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
            'sharing_share_icon' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp,svg', 'max:2048'],
        ]);

        // Handle hero image upload
        if ($request->hasFile('hero_image_file')) {
            $data['hero_image'] = $request->file('hero_image_file')->store('presentation', 'public');
        } elseif ($request->boolean('remove_hero_image')) {
            $data['hero_image'] = null;
        }

        // Handle about image upload
        if ($request->hasFile('about_image_file')) {
            $data['about_image'] = $request->file('about_image_file')->store('presentation', 'public');
        } elseif ($request->boolean('remove_about_image')) {
            $data['about_image'] = null;
        }

        // Handle principle image upload
        if ($request->hasFile('principle_image_file')) {
            $data['principle_image'] = $request->file('principle_image_file')->store('presentation', 'public');
        } elseif ($request->boolean('remove_principle_image')) {
            $data['principle_image'] = null;
        }

        // Handle sharing icon uploads
        $iconKeys = ['sharing_facebook_icon', 'sharing_twitter_icon', 'sharing_linkedin_icon', 'sharing_share_icon'];
        foreach ($iconKeys as $iconKey) {
            if ($request->hasFile($iconKey)) {
                $file = $request->file($iconKey);
                $filename = $iconKey . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path('images/social');
                
                // Create directory if it doesn't exist
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true);
                }
                
                $file->move($destinationPath, $filename);
                $data[$iconKey] = 'images/social/' . $filename;
            }
        }

        // Remove the file and remove flags from data before saving
        unset($data['hero_image_file'], $data['remove_hero_image'], $data['about_image_file'], $data['remove_about_image'], $data['principle_image_file'], $data['remove_principle_image']);

        foreach ($data as $key => $value) {
            if ($value !== null) {
                HomeSetting::setValue($key, $value);
            }
        }

        return redirect()->route('admin.presentation.index')->with('success', 'Presentation settings updated.');
    }
}