<?php

namespace Database\Seeders;

use App\Models\PartnerCategory;
use Illuminate\Database\Seeder;

class PartnerCategorySeeder extends Seeder
{
    /**
     * Default categories that map to existing string-based categories.
     */
    private const DEFAULT_CATEGORIES = [
        ['name' => 'Authorities'],
        ['name' => 'Organizations'],
        ['name' => 'Companies'],
        ['name' => 'Towns'],
    ];

    public function run(): void
    {
        foreach (self::DEFAULT_CATEGORIES as $cat) {
            PartnerCategory::firstOrCreate($cat);
        }
    }
}
