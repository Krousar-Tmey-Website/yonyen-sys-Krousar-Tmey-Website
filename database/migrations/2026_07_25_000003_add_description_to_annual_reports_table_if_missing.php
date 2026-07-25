<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * annual_reports.description is used throughout the app (model, controller validation,
 * admin forms) but no tracked migration ever created it — it only exists on databases
 * where it was added out-of-band. This closes that schema drift so a fresh `migrate`
 * on a clean database ends up with the same schema as production.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('annual_reports') && !Schema::hasColumn('annual_reports', 'description')) {
            Schema::table('annual_reports', function (Blueprint $table) {
                $table->longText('description')->nullable()->after('title_fr');
            });
        }
    }

    public function down(): void
    {
        // Intentionally not reverting — this migration only backfills schema drift that
        // predates it; dropping the column here could remove real production data.
    }
};
