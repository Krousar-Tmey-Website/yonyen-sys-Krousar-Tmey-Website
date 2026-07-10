<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $hasCategoryId = Schema::hasColumn('categories', 'CategoryID');
        $hasId = Schema::hasColumn('categories', 'id');

        if ($hasId && !$hasCategoryId) {
            // Rename 'id' to 'CategoryID'
            Schema::table('categories', function (Blueprint $table) {
                $table->renameColumn('id', 'CategoryID');
            });
        } elseif (!$hasCategoryId && !$hasId) {
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
        $hasCategoryId = Schema::hasColumn('categories', 'CategoryID');
        $hasId = Schema::hasColumn('categories', 'id');

        if ($hasCategoryId && !$hasId) {
            Schema::table('categories', function (Blueprint $table) {
                $table->renameColumn('CategoryID', 'id');
            });
        }
    }
};