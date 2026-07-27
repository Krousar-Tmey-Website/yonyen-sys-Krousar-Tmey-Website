<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('impact_statistics') && !Schema::hasColumn('impact_statistics', 'accent_color')) {
            Schema::table('impact_statistics', function (Blueprint $table) {
                $table->string('accent_color', 7)->nullable()->after('image');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('impact_statistics') && Schema::hasColumn('impact_statistics', 'accent_color')) {
            Schema::table('impact_statistics', function (Blueprint $table) {
                $table->dropColumn('accent_color');
            });
        }
    }
};
