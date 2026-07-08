<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Check if the foreign key exists before trying to drop it
        $foreignKeys = DB::select("
            SELECT CONSTRAINT_NAME 
            FROM information_schema.KEY_COLUMN_USAGE 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'article_categories' 
            AND COLUMN_NAME = 'CategoryID' 
            AND REFERENCED_TABLE_NAME IS NOT NULL
        ");
        
        // No-op: categories and article_categories schema is managed by later
        // migrations that standardize the primary key to `CategoryID`/`id` and
        // the join table types. Running complex ALTER statements here caused
        // issues on some environments (conflicting auto-increment columns),
        // and the subsequent migrations already correct the structure.
        return;
    }

    public function down(): void
    {
        // No-op reverse: nothing to rollback here.
        return;
    }
};