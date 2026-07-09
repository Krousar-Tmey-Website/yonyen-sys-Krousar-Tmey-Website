<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;

class HomeSettingController extends Controller
{
    public function index()
    {
        $settings = HomeSetting::orderBy('group')->orderBy('id')
            ->where('group', '!=', 'programs_banner')
            ->get()
            ->groupBy('group');
        return view('admin.home.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'settings'        => ['required', 'array'],
            'settings.*'      => ['nullable', 'string'],
        ]);

        foreach ($data['settings'] as $key => $value) {
            // programs_banner keys are managed by ProgramsBannerController — skip here
            if (str_starts_with($key, 'programs_banner_')) continue;
            HomeSetting::setValue($key, $value ?? '');
        }

        return redirect()->route('admin.home.index')->with('success', 'Home page settings saved.');
    }
}
