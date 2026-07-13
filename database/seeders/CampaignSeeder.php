<?php

namespace Database\Seeders;

use App\Models\Campaign;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        $campaigns = [
            [
                'title'            => 'Education for All 2026',
                'description'      => 'Help us provide school supplies, uniforms, and tuition support for 500 deaf and blind children across 15 provinces of Cambodia. Every child deserves access to quality education regardless of their abilities.',
                'goal_amount'      => 50000.00,
                'collected_amount' => 18250.00,
                'start_date'       => Carbon::parse('2026-01-01'),
                'end_date'         => Carbon::parse('2026-12-31'),
                'is_active'        => true,
            ],
            [
                'title'            => 'Nutrition Program',
                'description'      => 'Fund nutritious meals for children in our temporary and long-term protection centers. A balanced diet is essential for their physical and cognitive development.',
                'goal_amount'      => 25000.00,
                'collected_amount' => 25000.00,
                'start_date'       => Carbon::parse('2025-06-01'),
                'end_date'         => Carbon::parse('2026-06-30'),
                'is_active'        => true,
            ],
            [
                'title'            => 'New Family House Construction',
                'description'      => 'Support the construction of a new family house in Siem Reap province that will provide a safe, loving home for up to 12 children in need of long-term care.',
                'goal_amount'      => 120000.00,
                'collected_amount' => 45780.00,
                'start_date'       => Carbon::parse('2026-03-01'),
                'end_date'         => null,
                'is_active'        => true,
            ],
            [
                'title'            => 'Inactive: Holiday Fundraiser 2025',
                'description'      => 'This was a past holiday campaign that is now inactive.',
                'goal_amount'      => 10000.00,
                'collected_amount' => 8750.00,
                'start_date'       => Carbon::parse('2025-11-01'),
                'end_date'         => Carbon::parse('2025-12-31'),
                'is_active'        => false,
            ],
        ];

        foreach ($campaigns as $campaign) {
            Campaign::updateOrCreate(
                ['title' => $campaign['title']],
                $campaign
            );
        }

        $this->command->info('✅ 4 sample donation campaigns created!');
    }
}
