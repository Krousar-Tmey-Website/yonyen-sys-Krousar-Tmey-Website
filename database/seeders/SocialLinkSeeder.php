<?php

namespace Database\Seeders;

use App\Models\SocialLink;
use Illuminate\Database\Seeder;

class SocialLinkSeeder extends Seeder
{
    public function run(): void
    {
        $links = [
            [
                'platform_name' => 'Facebook',
                'icon'          => 'facebook',
                'url'           => 'https://www.facebook.com/share/1LC1ZVXgen/?mibextid=wwXIfr',
                'is_active'     => true,
                'sort_order'    => 1,
            ],
            [
                'platform_name' => 'Instagram',
                'icon'          => 'instagram',
                'url'           => 'https://www.instagram.com/krousar_thmey_foundation?igsh=MWJpZXQ4YXZraDAyNg==',
                'is_active'     => true,
                'sort_order'    => 2,
            ],
            [
                'platform_name' => 'LinkedIn',
                'icon'          => 'linkedin',
                'url'           => 'https://www.linkedin.com/company/krousar-thmey/',
                'is_active'     => true,
                'sort_order'    => 3,
            ],
            [
                'platform_name' => 'YouTube',
                'icon'          => 'youtube',
                'url'           => 'https://www.youtube.com/@krousarthmeyvideos',
                'is_active'     => true,
                'sort_order'    => 4,
            ],
            [
                'platform_name' => 'Telegram',
                'icon'          => 'telegram',
                'url'           => 'https://t.me/krousarthmey',
                'is_active'     => true,
                'sort_order'    => 5,
            ],
        ];

        foreach ($links as $link) {
            SocialLink::updateOrCreate(
                ['platform_name' => $link['platform_name']],
                $link
            );
        }
    }
}
