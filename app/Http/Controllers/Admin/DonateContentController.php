<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DonateContentController extends Controller
{
    /**
     * France-related form fields, saved under a "france_" prefixed HomeSetting key.
     * HomeSetting::setValue() already runs everything through clean(), so both
     * plain strings and CKEditor HTML are sanitized safely here.
     */
    private const FRANCE_KEYS = [
        'helloasso_description',
        'check_content',
        'tax_content',
        'legacy_content',
    ];

    /**
     * Switzerland-related form fields, saved under a "switzerland_" prefixed key
     * (mirrors the France bank-transfer / online-donation card structure).
     */
    private const SWITZERLAND_KEYS = [
        'bank_name',
        'bank_account',
        'bank_description',
        'paypal_url',
        'paypal_description',
        'tax_note',
        'tax_receipt_note',
    ];

    /**
     * Elsewhere fields, saved as-is (already fully-qualified key names).
     */
    private const PLAIN_KEYS = [
        'elsewhere_description',
        'elsewhere_bullet_1_title',
        'elsewhere_bullet_1_desc',
        'elsewhere_bullet_2_title',
        'elsewhere_bullet_2_desc',
        'elsewhere_bullet_3_title',
        'elsewhere_bullet_3_desc',
    ];

    /**
     * Tag-to-setting-key mapping for donation banner images.
     * Each tag stores its banner image under a HomeSetting key like 'cambodia_donation_image'.
     */
    private const TAG_IMAGE_KEYS = [
        'cambodia'    => 'cambodia_donation_image',
        'france'      => 'france_donation_image',
        'switzerland' => 'switzerland_donation_image',
        'elsewhere'   => 'elsewhere_donation_image',
    ];

    public function update(Request $request)
    {
        $data = $request->validate([
            'helloasso_url' => ['nullable', 'url', 'max:500'],
            'paypal_url'    => ['nullable', 'url', 'max:500'],
        ]);

        $this->handleLogoUpload($request, 'helloasso_logo', 'france_helloasso_logo', 'remove_helloasso_logo', 'france-donation');
        $this->handleLogoUpload($request, 'paypal_logo', 'switzerland_paypal_logo', 'remove_paypal_logo', 'switzerland-donation');

        // Handle donation banner image uploads for each tag
        $tag = $request->input('redirect_tag', 'france');
        $imageSettingKey = self::TAG_IMAGE_KEYS[$tag] ?? null;
        if ($imageSettingKey) {
            $this->handleDonationImageUpload($request, $imageSettingKey, 'remove_donation_image');
        }

        HomeSetting::setValue('france_helloasso_url', $data['helloasso_url'] ?? '');
        HomeSetting::setValue('switzerland_paypal_url', $data['paypal_url'] ?? '');

        foreach (self::FRANCE_KEYS as $key) {
            if ($request->has($key)) {
                HomeSetting::setValue('france_' . $key, $request->input($key));
            }
        }

        foreach (self::SWITZERLAND_KEYS as $key) {
            if ($request->has($key)) {
                HomeSetting::setValue('switzerland_' . $key, $request->input($key));
            }
        }

        foreach (self::PLAIN_KEYS as $key) {
            if ($request->has($key)) {
                HomeSetting::setValue($key, $request->input($key));
            }
        }

        return redirect()->route('admin.payments.index', ['tag' => $tag])
            ->with('success', 'Donate page content saved successfully.');
    }

    /**
     * Handle donation banner image upload for a specific tag.
     */
    private function handleDonationImageUpload(Request $request, string $settingKey, string $removeField): void
    {
        if ($request->hasFile('donation_image')) {
            $request->validate([
                'donation_image' => ['image', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            ]);

            $oldImage = HomeSetting::getValue($settingKey, '');
            if ($oldImage && !str_starts_with($oldImage, 'http')) {
                Storage::disk('public')->delete($oldImage);
            }

            $path = $request->file('donation_image')->store('donation-banners', 'public');
            HomeSetting::setValue($settingKey, $path);

            return;
        }

        if ($request->boolean($removeField)) {
            $oldImage = HomeSetting::getValue($settingKey, '');
            if ($oldImage && !str_starts_with($oldImage, 'http')) {
                Storage::disk('public')->delete($oldImage);
            }
            HomeSetting::setValue($settingKey, '');
        }
    }

    private function handleLogoUpload(Request $request, string $fileField, string $settingKey, string $removeField, string $storageFolder): void
    {
        if ($request->hasFile($fileField)) {
            $request->validate([
                $fileField => ['image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
            ]);

            $oldLogo = HomeSetting::getValue($settingKey, '');
            if ($oldLogo && !str_starts_with($oldLogo, 'http')) {
                Storage::disk('public')->delete($oldLogo);
            }

            $path = $request->file($fileField)->store($storageFolder, 'public');
            HomeSetting::setValue($settingKey, $path);

            return;
        }

        if ($request->boolean($removeField)) {
            $oldLogo = HomeSetting::getValue($settingKey, '');
            if ($oldLogo && !str_starts_with($oldLogo, 'http')) {
                Storage::disk('public')->delete($oldLogo);
            }
            HomeSetting::setValue($settingKey, '');
        }
    }
}
