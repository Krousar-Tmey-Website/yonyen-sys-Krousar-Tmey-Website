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
        Schema::table('program_page_items', function (Blueprint $table) {
            $table->dropForeign(['program_page_id']);
            $table->dropColumn('program_page_id');
        });
        Schema::dropIfExists('program_pages');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Not implementing down for this cleanup
    }
};
