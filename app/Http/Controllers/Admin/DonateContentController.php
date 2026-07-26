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
        'check_recipient',
        'check_description',
        'check_address',
        'tax_intro',
        'tax_association_text',
        'tax_coluche_text',
        'tax_receipt_note',
        'legacy_intro',
        'legacy_bequest_what_text',
        'legacy_bequest_types_note',
        'legacy_bequest_how_intro',
        'legacy_bequest_how_list',
        'legacy_donation_what_text',
        'legacy_donation_capped_note',
        'legacy_donation_how_text',
        'legacy_donation_conditions_note',
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
        'elsewhere_guarantee_note',
    ];

    public function update(Request $request)
    {
        $data = $request->validate([
            'helloasso_url' => ['nullable', 'url', 'max:500'],
            'paypal_url'    => ['nullable', 'url', 'max:500'],
        ]);

        $this->handleLogoUpload($request, 'helloasso_logo', 'france_helloasso_logo', 'remove_helloasso_logo', 'france-donation');
        $this->handleLogoUpload($request, 'paypal_logo', 'switzerland_paypal_logo', 'remove_paypal_logo', 'switzerland-donation');

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

        $tag = $request->input('redirect_tag', 'france');

        return redirect()->route('admin.payments.index', ['tag' => $tag])
            ->with('success', 'Donate page content saved successfully.');
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
