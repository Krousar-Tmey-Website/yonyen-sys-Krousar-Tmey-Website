<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ImpactStatistic;

class ImpactStatisticSeeder extends Seeder
{
    public function run(): void
    {
        ImpactStatistic::create([
            'value' => '+10K',
            'label' => 'Children Supported',
            'description' => 'Over 10,000 children supported through our programs across Cambodia.',
            'sort_order' => 1,
            'is_active' => true,
            'is_featured' => true,
        ]);

        ImpactStatistic::create([
            'value' => '70',
            'label' => 'Provinces Covered',
            'description' => 'Active in 70 provinces and districts throughout Cambodia.',
            'sort_order' => 2,
            'is_active' => true,
            'is_featured' => false,
        ]);

        ImpactStatistic::create([
            'value' => '$950K',
            'label' => 'Funds Raised',
            'description' => 'Over $950,000 raised to support our mission and programs.',
            'sort_order' => 3,
            'is_active' => true,
            'is_featured' => false,
        ]);

        ImpactStatistic::create([
            'value' => '15',
            'label' => 'Years of Service',
            'description' => '15 years of dedicated service to disadvantaged children in Cambodia.',
            'sort_order' => 4,
            'is_active' => true,
            'is_featured' => false,
        ]);
    }
}
