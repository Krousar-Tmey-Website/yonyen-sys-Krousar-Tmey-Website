<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('annual_reports', 'thumbnail_path')) {
            Schema::table('annual_reports', function (Blueprint $table) {
                $table->string('thumbnail_path')->nullable()->after('file_path');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('annual_reports', 'thumbnail_path')) {
            Schema::table('annual_reports', function (Blueprint $table) {
                $table->dropColumn('thumbnail_path');
            });
        }
    }
};
