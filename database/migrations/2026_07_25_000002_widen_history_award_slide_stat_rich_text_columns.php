<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Widen the CKEditor-bound TEXT (65 KB) columns that
 * 2026_07_25_000001_widen_remaining_rich_text_columns.php missed: history_events,
 * presentation_slides, impact_statistics, and awards. CKEditor's font/color/size inline
 * styles can push these past the 65 KB TEXT cap, causing silent MySQL truncation on save.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return; // SQLite has no TEXT/LONGTEXT distinction
        }

        if (Schema::hasTable('history_events')) {
            Schema::table('history_events', function (Blueprint $table) {
                foreach (['left_text', 'left_text_fr', 'right_text', 'right_text_fr'] as $column) {
                    if (Schema::hasColumn('history_events', $column)) {
                        $table->longText($column)->nullable()->change();
                    }
                }
            });
        }

        if (Schema::hasTable('presentation_slides')) {
            Schema::table('presentation_slides', function (Blueprint $table) {
                foreach (['subtitle', 'subtitle_fr'] as $column) {
                    if (Schema::hasColumn('presentation_slides', $column)) {
                        $table->longText($column)->nullable()->change();
                    }
                }
            });
        }

        if (Schema::hasTable('impact_statistics')) {
            Schema::table('impact_statistics', function (Blueprint $table) {
                foreach (['description', 'description_fr'] as $column) {
                    if (Schema::hasColumn('impact_statistics', $column)) {
                        $table->longText($column)->nullable()->change();
                    }
                }
            });
        }

        if (Schema::hasTable('awards')) {
            Schema::table('awards', function (Blueprint $table) {
                foreach (['description', 'description_fr'] as $column) {
                    if (Schema::hasColumn('awards', $column)) {
                        $table->longText($column)->nullable()->change();
                    }
                }
            });
        }
    }

    public function down(): void
    {
        // Intentionally not reverting — shrinking LONGTEXT back to TEXT
        // would risk data loss if any row already exceeds 65 KB.
    }
};
