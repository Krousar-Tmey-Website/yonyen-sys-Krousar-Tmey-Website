<?php

namespace Database\Seeders;

use App\Models\MapProject;
use Illuminate\Database\Seeder;

class MapProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Clear old records to prevent duplicates
        MapProject::truncate();

        $records = [
            // 1 - Banteay Meanchey, Poipet (2 Child Welfare)
            ['province_key' => 'banteay-meanchey', 'province_label' => 'Banteay Meanchey', 'location_name' => 'Poipet', 'project_type' => 'Child Welfare', 'sort_order' => 0],
            ['province_key' => 'banteay-meanchey', 'province_label' => 'Banteay Meanchey', 'location_name' => 'Poipet', 'project_type' => 'Outside Cases', 'sort_order' => 0],

            // 2 - Siem Reap
            ['province_key' => 'siem-reap', 'province_label' => 'Siem Reap', 'location_name' => 'Siem Reap', 'project_type' => 'Child Welfare', 'sort_order' => 0],
            ['province_key' => 'siem-reap', 'province_label' => 'Siem Reap', 'location_name' => 'Siem Reap', 'project_type' => 'Outside Cases', 'sort_order' => 1],
            ['province_key' => 'siem-reap', 'province_label' => 'Siem Reap', 'location_name' => 'Siem Reap', 'project_type' => 'School for Deaf or Blind Children', 'sort_order' => 2],

            // 3 - Battambang
            ['province_key' => 'battambang', 'province_label' => 'Battambang', 'location_name' => 'Battambang', 'project_type' => 'Outside Cases', 'sort_order' => 0],
            ['province_key' => 'battambang', 'province_label' => 'Battambang', 'location_name' => 'Battambang', 'project_type' => 'School for Deaf or Blind Children', 'sort_order' => 1],

            // 4 - Pursat
            ['province_key' => 'pursat', 'province_label' => 'Pursat', 'location_name' => 'Pursat', 'project_type' => 'Outside Cases', 'sort_order' => 0],

            // 5 - Kampong Thom
            ['province_key' => 'kampong-thom', 'province_label' => 'Kampong Thom', 'location_name' => 'Kampong Thom', 'project_type' => 'Outside Cases', 'sort_order' => 0],

            // 6 - Kampong Cham
            ['province_key' => 'kampong-cham', 'province_label' => 'Kampong Cham', 'location_name' => 'Kampong Cham', 'project_type' => 'Child Welfare', 'sort_order' => 0],
            ['province_key' => 'kampong-cham', 'province_label' => 'Kampong Cham', 'location_name' => 'Kampong Cham', 'project_type' => 'Outside Cases', 'sort_order' => 1],
            ['province_key' => 'kampong-cham', 'province_label' => 'Kampong Cham', 'location_name' => 'Kampong Cham', 'project_type' => 'School for Deaf or Blind Children', 'sort_order' => 2],

            // 7 - Tboung Khmum
            ['province_key' => 'tboung-khmum', 'province_label' => 'Tboung Khmum', 'location_name' => 'Tbong Khmum', 'project_type' => 'Outside Cases', 'sort_order' => 0],

            // 8 - Phnom Penh
            ['province_key' => 'phnom-penh', 'province_label' => 'Phnom Penh', 'location_name' => 'Phnom Penh', 'project_type' => 'School for Deaf or Blind Children', 'sort_order' => 0],

            // 9 - Kandal / Takhmao
            ['province_key' => 'kandal', 'province_label' => 'Kandal', 'location_name' => 'Takhmao', 'project_type' => 'Child Welfare', 'sort_order' => 0],
            ['province_key' => 'kandal', 'province_label' => 'Kandal', 'location_name' => 'Takhmao', 'project_type' => 'Outside Cases', 'sort_order' => 1],
            ['province_key' => 'kandal', 'province_label' => 'Kandal', 'location_name' => 'Takhmao', 'project_type' => 'School for Deaf or Blind Children', 'sort_order' => 2],
            ['province_key' => 'kandal', 'province_label' => 'Kandal', 'location_name' => 'Kandal', 'project_type' => 'Child Welfare', 'sort_order' => 4],
            ['province_key' => 'kandal', 'province_label' => 'Kandal', 'location_name' => 'Kandal', 'project_type' => 'Outside Cases', 'sort_order' => 5],

            // 10 - Kampong Speu
            ['province_key' => 'kampong-speu', 'province_label' => 'Kampong Speu', 'location_name' => 'Kampong Speu', 'project_type' => 'Outside Cases', 'sort_order' => 0],
            ['province_key' => 'kampong-speu', 'province_label' => 'Kampong Speu', 'location_name' => 'Kampong Speu', 'project_type' => 'Outside Cases', 'sort_order' => 1],

            // 11 - Prey Veng
            ['province_key' => 'prey-veng', 'province_label' => 'Prey Veng', 'location_name' => 'Prey Veng', 'project_type' => 'Outside Cases', 'sort_order' => 0],

            // 12 - Svay Rieng
            ['province_key' => 'svay-rieng', 'province_label' => 'Svay Rieng', 'location_name' => 'Svay Rieng', 'project_type' => 'Outside Cases', 'sort_order' => 0],

            // 13 - Takeo
            ['province_key' => 'takeo', 'province_label' => 'Takeo', 'location_name' => 'Takeo', 'project_type' => 'Outside Cases', 'sort_order' => 0],

            // 14 - Banteay Meanchey, Serei Sophorn
            ['province_key' => 'banteay-meanchey', 'province_label' => 'Banteay Meanchey', 'location_name' => 'Serei Sophorn', 'project_type' => 'School of Khmer Arts & Culture', 'sort_order' => 0],
        ];

        foreach ($records as $record) {
            MapProject::create($record);
        }

        $this->command->info('Seeded ' . count($records) . ' map project records.');
    }
}
