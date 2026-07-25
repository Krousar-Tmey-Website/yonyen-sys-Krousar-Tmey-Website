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
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement('ALTER TABLE awards MODIFY title VARCHAR(255) NULL');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("UPDATE awards SET title = '' WHERE title IS NULL");
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement('ALTER TABLE awards MODIFY title VARCHAR(255) NOT NULL');
        }
    }
};
