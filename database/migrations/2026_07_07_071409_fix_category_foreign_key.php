<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Start a transaction
        DB::beginTransaction();
        
        try {
            // 1. Drop the foreign key constraint from article_categories
            Schema::table('article_categories', function (Blueprint $table) {
                $table->dropForeign(['CategoryID']);
            });
            
            // 2. Drop the primary key from categories
            Schema::table('categories', function (Blueprint $table) {
                $table->dropPrimary('CategoryID');
            });
            
            // 3. Modify CategoryID to auto-increment
            Schema::table('categories', function (Blueprint $table) {
                $table->integer('CategoryID')->autoIncrement()->change();
            });
            
            // 4. Set the primary key back
            Schema::table('categories', function (Blueprint $table) {
                $table->primary('CategoryID');
            });
            
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
        DB::beginTransaction();
        
        try {
            // Drop foreign key
            Schema::table('article_categories', function (Blueprint $table) {
                $table->dropForeign(['CategoryID']);
            });
            
            // Drop primary key
            Schema::table('categories', function (Blueprint $table) {
                $table->dropPrimary('CategoryID');
            });
            
            // Change back to regular integer
            Schema::table('categories', function (Blueprint $table) {
                $table->integer('CategoryID')->change();
            });
            
            // Re-add primary key
            Schema::table('categories', function (Blueprint $table) {
                $table->primary('CategoryID');
            });
            
            // Re-add foreign key
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
};