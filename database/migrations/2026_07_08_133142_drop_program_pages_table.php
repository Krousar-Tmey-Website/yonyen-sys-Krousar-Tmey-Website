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
        // Cleanup already handled — program_page_items has no FK, program_pages never created
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
