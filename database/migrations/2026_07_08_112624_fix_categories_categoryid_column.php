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
        // First, drop the primary key if it exists
        $primaryKey = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.TABLE_CONSTRAINTS 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'categories' 
            AND CONSTRAINT_TYPE = 'PRIMARY KEY'
        ");

        if (!empty($primaryKey)) {
            DB::statement('ALTER TABLE categories DROP PRIMARY KEY');
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
        // Drop primary key
        DB::statement('ALTER TABLE categories DROP PRIMARY KEY');

        // Remove auto-increment
        DB::statement('ALTER TABLE categories MODIFY COLUMN CategoryID VARCHAR(50) NOT NULL FIRST');

        // Add primary key back
        DB::statement('ALTER TABLE categories ADD PRIMARY KEY (CategoryID)');
    }
};