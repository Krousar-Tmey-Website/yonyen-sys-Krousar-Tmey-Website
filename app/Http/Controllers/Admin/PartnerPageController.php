<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerPageController extends Controller
{
    private const DEFAULTS = [
        'partner_banner_image'       => '',
        'partner_count'              => '70+',
        'partner_count_label'        => 'Partner organisations',
        'partner_cta_title'          => 'Interested in becoming a partner?',
        'partner_cta_description'    => "Let's build together our future cooperation",
        'partner_cta_button_text'    => 'Contact Us to Partner',
        'partner_cta_button_link'    => '',
    ];

    public function index()
    {
        $settings = HomeSetting::where('group', 'partner_page')
            ->orWhereIn('key', array_keys(self::DEFAULTS))
            ->get()
            ->keyBy('key');

        return view('admin.partner_page.index', compact('settings'))
            ->with('defaults', self::DEFAULTS);
    }

    public function update(Request $request)
    {
        $request->validate([
            'partner_cta_title'        => ['nullable', 'string', 'max:255'],
            'partner_cta_description'  => ['nullable', 'string', 'max:1000'],
            'partner_cta_button_text'  => ['nullable', 'string', 'max:255'],
            'partner_cta_button_link'  => ['nullable', 'string', 'max:2048'],
            'partner_count'            => ['nullable', 'string', 'max:50'],
            'partner_count_label'      => ['nullable', 'string', 'max:255'],
            'partner_banner_image'     => ['nullable', 'image', 'max:4096'],
            'partner_banner_image_url' => ['nullable', 'url', 'max:2048'],
        ]);

        $this->saveSetting('partner_cta_title', $request->input('partner_cta_title', self::DEFAULTS['partner_cta_title']), 'CTA Title');
        $this->saveSetting('partner_cta_description', $request->input('partner_cta_description', self::DEFAULTS['partner_cta_description']), 'CTA Description');
        $this->saveSetting('partner_cta_button_text', $request->input('partner_cta_button_text', self::DEFAULTS['partner_cta_button_text']), 'CTA Button Text');
        $this->saveSetting('partner_cta_button_link', $request->input('partner_cta_button_link', self::DEFAULTS['partner_cta_button_link']), 'CTA Button Link');
        $this->saveSetting('partner_count', $request->input('partner_count', self::DEFAULTS['partner_count']), 'Partner Count Stat');
        $this->saveSetting('partner_count_label', $request->input('partner_count_label', self::DEFAULTS['partner_count_label']), 'Partner Count Label');

        if ($request->hasFile('partner_banner_image')) {
            $this->deleteExistingBanner();
            $path = $request->file('partner_banner_image')->store('banners', 'public');
            $this->saveSetting('partner_banner_image', $path, 'Banner Image');
        } elseif ($request->filled('partner_banner_image_url')) {
            $this->deleteExistingBanner();
            $this->saveSetting('partner_banner_image', $request->input('partner_banner_image_url'), 'Banner Image');
        } elseif ($request->boolean('partner_banner_image_clear')) {
            $this->deleteExistingBanner();
            $this->saveSetting('partner_banner_image', '', 'Banner Image');
        }

        return redirect()->route('admin.partner-page.index')
            ->with('success', 'Become a Partner page updated successfully.');
    }

    // ── Helpers ──────────────────────────────────────────────────

    private function saveSetting(string $key, ?string $value, string $label): void
    {
        HomeSetting::updateOrCreate(
            ['key' => $key],
            ['value' => $value ?? '', 'group' => 'partner_page', 'label' => $label]
        );
    }

    private function deleteExistingBanner(): void
    {
        $existing = HomeSetting::getValue('partner_banner_image', '');
        if ($existing && !str_starts_with($existing, 'http')) {
            Storage::disk('public')->delete($existing);
        }
    }
}
