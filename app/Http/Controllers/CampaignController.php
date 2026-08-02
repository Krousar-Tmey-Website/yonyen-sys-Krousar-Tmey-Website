<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\HomeSetting;

class CampaignController extends Controller
{
    /** Static fallback banner photo, used whenever no image is set in Admin → Campaigns → Page Banner. */
    private const DEFAULT_BANNER_IMAGE = 'images/photo_2026-07-27_13-22-41.jpg';

    public function index()
    {
        $settings = HomeSetting::allKeyed();
        $campaigns = Campaign::active()->paginate(8);

        $banner = $this->banner($settings);

        return view('campaigns.index', compact('settings', 'campaigns', 'banner'));
    }

    public function show(Campaign $campaign)
    {
        abort_unless($campaign->is_active, 404);

        $settings = HomeSetting::allKeyed();

        $relatedCampaigns = Campaign::active()
            ->where('id', '!=', $campaign->id)
            ->take(3)
            ->get();

        $banner = $this->banner($settings);

        return view('campaigns.show', compact('settings', 'campaign', 'relatedCampaigns', 'banner'));
    }

    private function banner(array $settings): array
    {
        $image = $settings['campaigns_banner_image'] ?? '';

        if ($image === '') {
            $resolvedImage = asset(self::DEFAULT_BANNER_IMAGE);
        } elseif (str_starts_with($image, 'http')) {
            $resolvedImage = $image;
        } else {
            $resolvedImage = asset('storage/' . $image);
        }

        return [
            'title'    => $settings['campaigns_banner_title'] ?? 'Our Campaigns',
            'subtitle' => $settings['campaigns_banner_subtitle'] ?? 'Every campaign is a promise kept to a child in Cambodia. Discover the causes we are championing this year.',
            'image'    => $resolvedImage,
        ];
    }
}
