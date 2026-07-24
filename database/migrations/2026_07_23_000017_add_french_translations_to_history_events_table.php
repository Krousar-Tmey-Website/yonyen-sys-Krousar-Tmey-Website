<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('history_events', function (Blueprint $table) {
            $table->text('left_text_fr')->nullable()->after('left_text');
            $table->text('right_text_fr')->nullable()->after('right_text');
        });
    }

    public function down(): void
    {
        Schema::table('history_events', function (Blueprint $table) {
            $table->dropColumn(['left_text_fr', 'right_text_fr']);
        });
    }
};
