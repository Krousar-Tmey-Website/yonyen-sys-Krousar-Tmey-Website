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
        // The resource_pages table already exists (see the
        // 2026_07_15_122309_create_resource_pages_table migration record).
        // This migration only widens two columns that needed more room.
        Schema::table('resource_pages', function (Blueprint $table) {
            $table->text('header_text')->nullable()->change();
            $table->longText('detail_description')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('resource_pages', function (Blueprint $table) {
            $table->string('header_text')->nullable()->change();
            $table->text('detail_description')->nullable()->change();
        });
    }
};
