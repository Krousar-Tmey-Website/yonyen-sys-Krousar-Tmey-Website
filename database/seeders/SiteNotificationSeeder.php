<?php

namespace Database\Seeders;

use App\Models\SiteNotification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SiteNotificationSeeder extends Seeder
{
    public function run(): void
    {
        $samples = [
            [
                'type'      => 'event',
                'title'     => 'Community Health & Education Fair 2026',
                'excerpt'   => 'Join us for a day of free health check-ups, children\'s activities, and education workshops in Phnom Penh.',
                'link'      => '/',
                'created_at' => Carbon::now(),
            ],
            [
                'type'      => 'volunteer',
                'title'     => 'Volunteer Recruitment: Special Education Program',
                'excerpt'   => 'We are looking for passionate volunteers to support our special education classes for deaf and blind children.',
                'link'      => '/volunteer',
                'created_at' => Carbon::now()->subDay(),
            ],
            [
                'type'      => 'article',
                'title'     => 'New Success Story: Sovann Learns to Read',
                'excerpt'   => 'After two years in our literacy program, Sovann read his first full book. Read his inspiring journey.',
                'link'      => '/news',
                'created_at' => Carbon::now()->subDays(3),
            ],
            [
                'type'      => 'event',
                'title'     => 'Annual Charity Gala in Geneva',
                'excerpt'   => 'Our supporters in Switzerland gathered to celebrate another year of impact for children in Cambodia.',
                'link'      => '/',
                'created_at' => Carbon::now()->subDays(6),
            ],
        ];

        foreach ($samples as $sample) {
            SiteNotification::create($sample);
        }
    }
}
