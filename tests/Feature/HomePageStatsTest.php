<?php

namespace Tests\Feature;

use App\Models\HomeSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageStatsTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_stats_are_loaded_from_the_database(): void
    {
        HomeSetting::updateOrCreate(
            ['key' => 'stat_children'],
            ['key' => 'stat_children', 'label' => 'Children Supported', 'group' => 'stats', 'value' => '200K']
        );
        HomeSetting::updateOrCreate(
            ['key' => 'stat_employees'],
            ['key' => 'stat_employees', 'label' => 'Employees', 'group' => 'stats', 'value' => '70']
        );
        HomeSetting::updateOrCreate(
            ['key' => 'stat_budget'],
            ['key' => 'stat_budget', 'label' => 'USD Annual Budget', 'group' => 'stats', 'value' => '950K']
        );
        HomeSetting::updateOrCreate(
            ['key' => 'stat_provinces'],
            ['key' => 'stat_provinces', 'label' => 'Provinces', 'group' => 'stats', 'value' => '15']
        );

        $stats = HomeSetting::getStats();

        $this->assertSame('+200K', $stats['children']['display']);
        $this->assertSame('70', $stats['employees']['display']);
        $this->assertSame('$950K', $stats['budget']['display']);
        $this->assertSame('15', $stats['provinces']['display']);
    }

    public function test_child_support_values_are_formatted_as_compact_k_values(): void
    {
        HomeSetting::updateOrCreate(
            ['key' => 'stat_children'],
            ['key' => 'stat_children', 'label' => 'Children Supported', 'group' => 'stats', 'value' => '1000']
        );

        $stats = HomeSetting::getStats();

        $this->assertSame('+1K', $stats['children']['display']);
        $this->assertSame(1000, $stats['children']['number']);

        HomeSetting::updateOrCreate(
            ['key' => 'stat_children'],
            ['key' => 'stat_children', 'label' => 'Children Supported', 'group' => 'stats', 'value' => '10000']
        );

        $stats = HomeSetting::getStats();

        $this->assertSame('+10K', $stats['children']['display']);
        $this->assertSame(10000, $stats['children']['number']);
    }
}
