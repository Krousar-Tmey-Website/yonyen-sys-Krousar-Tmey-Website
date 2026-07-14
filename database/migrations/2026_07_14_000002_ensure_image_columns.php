<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tables that should contain an `image` column.
     * Several migrations defined this column after the schema was first
     * migrated, so the live database is missing it on these tables.
     */
    private array $tables = [
        'awards',
        'campaigns',
        'core_values',
        'history_events',
        'home_settings',
        'impact_statistics',
        'job_opportunities',
        'news',
        'presentation_slides',
        'principle_slides',
        'program_page_items',
        'programs',
        'projects',
        'slides',
        'worldwide_partners',
    ];

    public function up(): void
    {
        foreach ($this->tables as $table) {
            if (!Schema::hasTable($table) || Schema::hasColumn($table, 'image')) {
                continue;
            }

            Schema::table($table, function (Blueprint $table) {
                $table->string('image')->nullable();
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $table) {
            if (!Schema::hasTable($table) || !Schema::hasColumn($table, 'image')) {
                continue;
            }

            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }
    }
};
