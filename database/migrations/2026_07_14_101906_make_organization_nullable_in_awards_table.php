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
        DB::statement('ALTER TABLE awards MODIFY organization VARCHAR(255) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("UPDATE awards SET organization = '' WHERE organization IS NULL");
        DB::statement('ALTER TABLE awards MODIFY organization VARCHAR(255) NOT NULL');
    }
};
