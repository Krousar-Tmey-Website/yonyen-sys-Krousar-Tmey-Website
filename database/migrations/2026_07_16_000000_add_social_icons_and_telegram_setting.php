<?php

use App\Models\HomeSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $settings = [
            // Telegram URL (missing from original migration)
            ['key' => 'social_telegram', 'label' => 'Telegram URL', 'group' => 'social', 'value' => 'https://t.me/krousarthmey'],

            // Social media icon settings (for header/footer)
            ['key' => 'social_facebook_icon',  'label' => 'Facebook Icon',  'group' => 'social', 'value' => 'images/social/facebook.svg'],
            ['key' => 'social_instagram_icon', 'label' => 'Instagram Icon', 'group' => 'social', 'value' => 'images/social/instagram.svg'],
            ['key' => 'social_linkedin_icon',  'label' => 'LinkedIn Icon',  'group' => 'social', 'value' => 'images/social/linkedin.svg'],
            ['key' => 'social_youtube_icon',   'label' => 'YouTube Icon',   'group' => 'social', 'value' => 'images/social/youtube.svg'],
            ['key' => 'social_telegram_icon',  'label' => 'Telegram Icon',  'group' => 'social', 'value' => 'images/social/telegram.svg'],
        ];

        foreach ($settings as $setting) {
            HomeSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }

    public function down(): void
    {
        $keys = [
            'social_telegram',
            'social_facebook_icon',
            'social_instagram_icon',
            'social_linkedin_icon',
            'social_youtube_icon',
            'social_telegram_icon',
        ];
        HomeSetting::whereIn('key', $keys)->delete();
    }
};
