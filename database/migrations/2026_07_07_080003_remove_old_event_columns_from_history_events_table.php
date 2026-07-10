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
        // Check if columns exist before dropping
        if (Schema::hasColumn('history_events', 'left_event') && Schema::hasColumn('history_events', 'right_event')) {
            Schema::table('history_events', function (Blueprint $table) {
                $table->dropColumn(['left_event', 'right_event']);
            });
        }
        // If columns don't exist, skip silently
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('history_events', function (Blueprint $table) {
            $table->text('left_event')->nullable();
            $table->text('right_event')->nullable();
        });
    }
};
