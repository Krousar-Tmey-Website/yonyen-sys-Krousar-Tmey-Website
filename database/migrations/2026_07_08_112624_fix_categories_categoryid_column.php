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
        // Already applied — categories table already has CategoryID as primary key
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};