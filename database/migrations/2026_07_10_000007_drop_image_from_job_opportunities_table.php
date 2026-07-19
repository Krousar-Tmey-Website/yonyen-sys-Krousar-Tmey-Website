<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasColumn('job_opportunities', 'image')) {
            Schema::table('job_opportunities', function (Blueprint $table) {
                $table->dropColumn('image');
            });
        }
    }

    public function down(): void
    {
        if (! Schema::hasColumn('job_opportunities', 'image')) {
            Schema::table('job_opportunities', function (Blueprint $table) {
                $table->string('image')->nullable()->after('sort_order');
            });
        }
    }
};
