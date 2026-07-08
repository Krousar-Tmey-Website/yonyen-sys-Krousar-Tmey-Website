<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if columns exist before dropping
        $columns = DB::select("
            SELECT COLUMN_NAME 
            FROM information_schema.COLUMNS 
            WHERE TABLE_SCHEMA = DATABASE() 
            AND TABLE_NAME = 'history_events' 
            AND COLUMN_NAME IN ('left_event', 'right_event')
        ");
        
        $columnNames = array_column($columns, 'COLUMN_NAME');
        
        if (in_array('left_event', $columnNames) && in_array('right_event', $columnNames)) {
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