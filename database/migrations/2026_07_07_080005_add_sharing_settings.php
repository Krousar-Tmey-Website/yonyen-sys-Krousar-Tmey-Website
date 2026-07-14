<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $settings = [
            ['key' => 'sharing_enabled', 'value' => '1', 'label' => 'Enable Share Section', 'group' => 'sharing'],
            ['key' => 'sharing_title', 'value' => 'Share our impact', 'label' => 'Share Section Title', 'group' => 'sharing'],
            ['key' => 'sharing_facebook_icon', 'value' => 'images/social/facebook.svg', 'label' => 'Facebook Icon', 'group' => 'sharing'],
            ['key' => 'sharing_twitter_icon', 'value' => 'images/social/twitter.svg', 'label' => 'Twitter Icon', 'group' => 'sharing'],
            ['key' => 'sharing_linkedin_icon', 'value' => 'images/social/linkedin.svg', 'label' => 'LinkedIn Icon', 'group' => 'sharing'],
            ['key' => 'sharing_share_icon', 'value' => 'images/social/share.svg', 'label' => 'Share Icon', 'group' => 'sharing'],
        ];

        DB::table('home_settings')->upsert($settings, ['key'], ['value', 'label', 'group']);
    }

    public function down(): void
    {
        DB::table('home_settings')->where('group', 'sharing')->delete();
    }
};