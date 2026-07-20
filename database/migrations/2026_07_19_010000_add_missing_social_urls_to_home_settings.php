<?php

use App\Models\HomeSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    private array $settings = [
        ['key' => 'social_facebook',  'label' => 'Facebook URL',  'group' => 'social', 'value' => 'https://www.facebook.com/KrousarThmey'],
        ['key' => 'social_instagram', 'label' => 'Instagram URL', 'group' => 'social', 'value' => 'https://www.instagram.com/krousarthmey/'],
        ['key' => 'social_linkedin',  'label' => 'LinkedIn URL',  'group' => 'social', 'value' => 'https://www.linkedin.com/company/krousar-thmey/'],
        ['key' => 'social_youtube',   'label' => 'YouTube URL',   'group' => 'social', 'value' => 'https://www.youtube.com/@KrousarThmey'],
    ];

    public function up(): void
    {
        foreach ($this->settings as $setting) {
            HomeSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }

    public function down(): void
    {
        $keys = array_column($this->settings, 'key');
        HomeSetting::whereIn('key', $keys)->delete();
    }
};
