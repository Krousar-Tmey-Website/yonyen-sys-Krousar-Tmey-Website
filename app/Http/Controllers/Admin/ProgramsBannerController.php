<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramsBannerController extends Controller
{
    public function index()
    {
        $settings = HomeSetting::where('group', 'programs_banner')
            ->orderBy('id')
            ->get()
            ->keyBy('key');

        return view('admin.programs_banner.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'programs_banner_title'     => ['required', 'string', 'max:255'],
            'programs_banner_subtitle'  => ['nullable', 'string', 'max:1000'],
            'programs_banner_image'     => ['nullable', 'image', 'max:4096'],
            'programs_banner_image_url' => ['nullable', 'url', 'max:2048'],
            
            'programs_additional_label' => ['nullable', 'string', 'max:255'],
            'programs_additional_title' => ['nullable', 'string', 'max:255'],
            'programs_info_label'       => ['nullable', 'string', 'max:255'],
            'programs_info_title'       => ['nullable', 'string', 'max:255'],
            'programs_cta_label'        => ['nullable', 'string', 'max:255'],
            'programs_cta_title'        => ['nullable', 'string', 'max:255'],
            'programs_cta_subtitle'     => ['nullable', 'string', 'max:1000'],
        ]);

        HomeSetting::setValue('programs_banner_title',    $request->input('programs_banner_title'));
        HomeSetting::setValue('programs_banner_subtitle', $request->input('programs_banner_subtitle', ''));
        
        HomeSetting::setValue('programs_additional_label', $request->input('programs_additional_label', 'Cross-cutting Work'));
        HomeSetting::setValue('programs_additional_title', $request->input('programs_additional_title', 'Additional Programs'));
        
        HomeSetting::setValue('programs_info_label', $request->input('programs_info_label', 'Learn More'));
        HomeSetting::setValue('programs_info_title', $request->input('programs_info_title', 'Additional Information'));
        
        HomeSetting::setValue('programs_cta_label', $request->input('programs_cta_label', 'Support Our Mission'));
        HomeSetting::setValue('programs_cta_title', $request->input('programs_cta_title', 'Help Children in Cambodia'));
        HomeSetting::setValue('programs_cta_subtitle', $request->input('programs_cta_subtitle', 'Your donation goes directly to one of these programs. 100% of funds support children in Cambodia.'));

        if ($request->hasFile('programs_banner_image')) {
            $existing = HomeSetting::getValue('programs_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            $path = $request->file('programs_banner_image')->store('banners', 'public');
            HomeSetting::setValue('programs_banner_image', $path);
        } elseif ($request->filled('programs_banner_image_url')) {
            $existing = HomeSetting::getValue('programs_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('programs_banner_image', $request->input('programs_banner_image_url'));
        } elseif ($request->boolean('programs_banner_image_clear')) {
            $existing = HomeSetting::getValue('programs_banner_image', '');
            if ($existing && !str_starts_with($existing, 'http')) {
                Storage::disk('public')->delete($existing);
            }
            HomeSetting::setValue('programs_banner_image', '');
        }

        return redirect()->route('admin.programs-banner.index')
            ->with('success', 'Programs page banner updated successfully.');
    }
}