<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FranceDonationController extends Controller
{
    public function index()
    {
        $settings = HomeSetting::allKeyed();

        return view('admin.france-donation.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'helloasso_url' => ['nullable', 'url', 'max:500'],
            'helloasso_description' => ['nullable', 'string', 'max:2000'],
            'check_address' => ['nullable', 'string', 'max:1000'],
        ]);

        // Handle logo upload
        if ($request->hasFile('helloasso_logo')) {
            $request->validate([
                'helloasso_logo' => ['image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
            ]);

            // Delete old logo if it's a local upload
            $oldLogo = HomeSetting::getValue('france_helloasso_logo', '');
            if ($oldLogo && !str_starts_with($oldLogo, 'http')) {
                Storage::disk('public')->delete($oldLogo);
            }

            $path = $request->file('helloasso_logo')->store('france-donation', 'public');
            HomeSetting::setValue('france_helloasso_logo', $path);
        }

        // Handle logo removal
        if ($request->boolean('remove_helloasso_logo')) {
            $oldLogo = HomeSetting::getValue('france_helloasso_logo', '');
            if ($oldLogo && !str_starts_with($oldLogo, 'http')) {
                Storage::disk('public')->delete($oldLogo);
            }
            HomeSetting::setValue('france_helloasso_logo', '');
        }

        // Save text settings
        HomeSetting::setValue('france_helloasso_url', $data['helloasso_url'] ?? '');
        HomeSetting::setValue('france_helloasso_description', $data['helloasso_description'] ?? '');
        HomeSetting::setValue('france_check_address', $data['check_address'] ?? '');

        return redirect()->route('admin.payments.index', ['tag' => 'france'])
            ->with('success', 'France donation settings saved successfully.');
    }
}
