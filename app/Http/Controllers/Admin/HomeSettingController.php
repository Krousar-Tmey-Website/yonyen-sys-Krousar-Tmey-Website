<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeSettingController extends Controller
{
    public function index()
    {
        $settings = HomeSetting::orderBy('group')->orderBy('id')
            ->where('group', '!=', 'programs_banner')
            ->where('group', '!=', 'project_defaults')
            ->get()
            ->groupBy('group');
        $keyedSettings = HomeSetting::allKeyed();
        return view('admin.home.index', compact('settings', 'keyedSettings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'settings'        => ['required', 'array'],
            'settings.*'      => ['nullable', 'string'],
        ]);

        // Handle structure_image file upload
        if ($request->hasFile('structure_image')) {
            $request->validate([
                'structure_image' => ['image', 'mimes:png,jpg,jpeg,webp,svg', 'max:5120'],
            ]);

            // Delete old file if it's a local upload
            $oldValue = HomeSetting::getValue('structure_image', '');
            if ($oldValue && !str_starts_with($oldValue, 'http')) {
                Storage::disk('public')->delete($oldValue);
            }

            $path = $request->file('structure_image')->store('structure', 'public');
            HomeSetting::setValue('structure_image', $path);

            // Remove from settings array so we don't overwrite with null
            unset($data['settings']['structure_image']);
        }

        // Handle structure_image removal
        if ($request->boolean('clear_structure_image')) {
            $oldValue = HomeSetting::getValue('structure_image', '');
            if ($oldValue && !str_starts_with($oldValue, 'http')) {
                Storage::disk('public')->delete($oldValue);
            }
            HomeSetting::setValue('structure_image', '');
            unset($data['settings']['structure_image']);
        }

        foreach ($data['settings'] as $key => $value) {
            // programs_banner keys are managed by ProgramsBannerController — skip here
            if (str_starts_with($key, 'programs_banner_')) continue;
            if (str_starts_with($key, 'project_default_')) continue;
            HomeSetting::setValue($key, $value ?? '');
        }

        return redirect()->route('admin.home.index')->with('success', 'Home page settings saved.');
    }
}
