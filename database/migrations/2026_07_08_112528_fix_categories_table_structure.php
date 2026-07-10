<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if CategoryID column exists
        $hasCategoryID = DB::select("
            SELECT COLUMN_NAME 
            FROM information_schema.COLUMNS 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'categories' 
            AND COLUMN_NAME = 'CategoryID'
        ");

        // Check if id column exists
        $hasId = DB::select("
            SELECT COLUMN_NAME 
            FROM information_schema.COLUMNS 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'categories' 
            AND COLUMN_NAME = 'id'
        ");

        if (!empty($hasId) && empty($hasCategoryID)) {
            // Rename 'id' to 'CategoryID'
            Schema::table('categories', function (Blueprint $table) {
                $table->renameColumn('id', 'CategoryID');
            });
        } elseif (empty($hasCategoryID) && empty($hasId)) {
            // Neither exists, add CategoryID as auto-increment primary key
            Schema::table('categories', function (Blueprint $table) {
                $table->id('CategoryID')->first();
            });
        }
        // If CategoryID already exists, nothing to do
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $hasCategoryID = DB::select("
            SELECT COLUMN_NAME 
            FROM information_schema.COLUMNS 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'categories' 
            AND COLUMN_NAME = 'CategoryID'
        ");

        $hasId = DB::select("
            SELECT COLUMN_NAME 
            FROM information_schema.COLUMNS 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'categories' 
            AND COLUMN_NAME = 'id'
        ");

        if (!empty($hasCategoryID) && empty($hasId)) {
            Schema::table('categories', function (Blueprint $table) {
                $table->renameColumn('CategoryID', 'id');
            });
        }
    }
};