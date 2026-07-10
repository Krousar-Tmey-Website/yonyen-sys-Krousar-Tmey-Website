<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::beginTransaction();

        try {
            // 1. Drop the foreign key constraint from article_categories, if one exists.
            try {
                Schema::table('article_categories', function (Blueprint $table) {
                    $table->dropForeign(['CategoryID']);
                });
            } catch (\Throwable $e) {
                // No matching foreign key — nothing to fix, skip the rest silently.
                DB::rollBack();
                return;
            }

            // 2-4. Drop the primary key and re-add it with AUTO_INCREMENT in a single
            // statement. MySQL requires an AUTO_INCREMENT column to already be a key,
            // so doing this as separate ALTER statements (drop primary, then set
            // auto-increment) fails with "there can be only one auto column and it
            // must be defined as a key" — it has to happen atomically.
            DB::statement('ALTER TABLE categories DROP PRIMARY KEY, ADD PRIMARY KEY (CategoryID), MODIFY COLUMN CategoryID INT NOT NULL AUTO_INCREMENT');

            // 5. Re-add the foreign key constraint
            Schema::table('article_categories', function (Blueprint $table) {
                $table->foreign('CategoryID')
                      ->references('CategoryID')
                      ->on('categories')
                      ->onDelete('cascade');
            });

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function down(): void
    {
        // No-op reverse: nothing to rollback here.
        return;
    }
};