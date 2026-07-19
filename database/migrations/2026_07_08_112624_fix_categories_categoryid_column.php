<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the primary key if one exists; nothing to do otherwise.
        try {
            DB::statement('ALTER TABLE categories DROP PRIMARY KEY');
        } catch (\Throwable $e) {
            // No existing primary key on categories.
        }

        // Remove any existing auto-increment from other columns first
        DB::statement('ALTER TABLE categories MODIFY COLUMN CategoryID BIGINT UNSIGNED NOT NULL');

        // Now set it as primary key with auto-increment in one statement
        DB::statement('ALTER TABLE categories ADD PRIMARY KEY (CategoryID), MODIFY COLUMN CategoryID BIGINT UNSIGNED NOT NULL AUTO_INCREMENT');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op reverse: nothing to rollback here.
        return;
    }
};