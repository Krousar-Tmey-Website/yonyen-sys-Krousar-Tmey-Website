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
        $data = $request->validate([
            'intro_heading' => ['nullable', 'string', 'max:500'],
            'mission_title' => ['nullable', 'string', 'max:255'],
            'mission_text' => ['nullable', 'string'],
            'mission_image' => ['nullable', 'url', 'max:2048'],
            'mission_image_file' => ['nullable', 'image', 'max:4096'],
            'remove_mission_image' => ['nullable', 'boolean'],
            'vision_title' => ['nullable', 'string', 'max:255'],
            'vision_text' => ['nullable', 'string'],
            'vision_image' => ['nullable', 'url', 'max:2048'],
            'vision_image_file' => ['nullable', 'image', 'max:4096'],
            'remove_vision_image' => ['nullable', 'boolean'],
            'portfolio_text' => ['nullable', 'string'],
            'principle_quote' => ['nullable', 'string'],
            'portfolio_volunteers_text' => ['nullable', 'string'],
            'stat_provinces' => ['nullable', 'string'],
            'stat_employees' => ['nullable', 'string'],
            'stat_expats' => ['nullable', 'string'],
            'stat_budget' => ['nullable', 'string'],
            'stat_admin_costs' => ['nullable', 'string'],
            'worldwide_text' => ['nullable', 'string'],
        ]);

        // Handle mission image upload
        if ($request->hasFile('mission_image_file')) {
            $data['mission_image'] = $request->file('mission_image_file')->store('presentation', 'public');
        } elseif ($request->boolean('remove_mission_image')) {
            $data['mission_image'] = null;
        }

        // Handle vision image upload
        if ($request->hasFile('vision_image_file')) {
            $data['vision_image'] = $request->file('vision_image_file')->store('presentation', 'public');
        } elseif ($request->boolean('remove_vision_image')) {
            $data['vision_image'] = null;
        }

        unset($data['mission_image_file'], $data['remove_mission_image'], $data['vision_image_file'], $data['remove_vision_image']);

        foreach ($data as $key => $value) {
            if ($value !== null) {
                HomeSetting::setValue($key, $value);
            }
        }

        return redirect()->route('admin.presentation.index')->with('success', 'Presentation settings updated.');
    }
}
