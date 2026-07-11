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
        DB::statement('ALTER TABLE history_events MODIFY left_text TEXT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("UPDATE history_events SET left_text = '' WHERE left_text IS NULL");
        DB::statement('ALTER TABLE history_events MODIFY left_text TEXT NOT NULL');
    }
};
