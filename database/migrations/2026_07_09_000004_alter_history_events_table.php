<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop old columns and add new ones
        Schema::table('history_events', function (Blueprint $table) {
            $table->dropColumn(['side', 'event', 'image']);
        });

        Schema::table('history_events', function (Blueprint $table) {
            $table->text('left_text')->after('year');
            $table->text('right_text')->nullable()->after('left_text');
            $table->boolean('is_active')->default(true)->after('sort_order');
        });
    }

    public function down(): void
    {
        Schema::table('history_events', function (Blueprint $table) {
            $table->dropColumn(['left_text', 'right_text', 'is_active']);
            $table->string('side')->default('left');
            $table->text('event')->nullable();
            $table->string('image')->nullable();
        });
    }
};
