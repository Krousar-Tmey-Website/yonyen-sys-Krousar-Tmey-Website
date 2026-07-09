<?php

use App\Models\HomeSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $settings = [
            // Website group
            ['key' => 'site_name',        'label' => 'Website Name',           'group' => 'website', 'value' => 'Krousar Thmey'],
            ['key' => 'site_tagline',     'label' => 'Website Tagline',        'group' => 'website', 'value' => 'គ្រួសារថ្មី · New Family'],
            ['key' => 'site_logo',        'label' => 'Site Logo (path)',       'group' => 'website', 'value' => 'images/logo.png'],
            ['key' => 'site_description', 'label' => 'Meta Description',       'group' => 'website', 'value' => "Krousar Thmey is Cambodia's first organization dedicated to helping disadvantaged children — through child welfare, special education, and cultural development."],

            // Social group
            ['key' => 'social_facebook',  'label' => 'Facebook URL',  'group' => 'social', 'value' => 'https://www.facebook.com/KrousarThmey'],
            ['key' => 'social_instagram', 'label' => 'Instagram URL', 'group' => 'social', 'value' => 'https://www.instagram.com/krousarthmey/'],
            ['key' => 'social_linkedin',  'label' => 'LinkedIn URL',  'group' => 'social', 'value' => 'https://www.linkedin.com/company/krousar-thmey/'],
            ['key' => 'social_youtube',   'label' => 'YouTube URL',   'group' => 'social', 'value' => 'https://www.youtube.com/@KrousarThmey'],

            // Footer group
            ['key' => 'footer_copyright',  'label' => 'Footer Copyright Text', 'group' => 'footer', 'value' => 'Krousar Thmey. All rights reserved.'],
            ['key' => 'footer_description','label' => 'Footer Brand Description', 'group' => 'footer', 'value' => "Cambodia's first organization helping disadvantaged children — building a world where every child grows into an independent, responsible adult."],
        ];

        foreach ($settings as $setting) {
            HomeSetting::updateOrCreate(['key' => $setting['key']], $setting);
        }
    }

    public function down(): void
    {
        $keys = [
            'site_name', 'site_tagline', 'site_logo', 'site_description',
            'social_facebook', 'social_instagram', 'social_linkedin', 'social_youtube',
            'footer_copyright', 'footer_description',
        ];
        HomeSetting::whereIn('key', $keys)->delete();
    }
};
