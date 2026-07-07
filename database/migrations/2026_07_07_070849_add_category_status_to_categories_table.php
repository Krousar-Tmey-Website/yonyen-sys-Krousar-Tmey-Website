<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            // Add Description if not exists
            if (!Schema::hasColumn('categories', 'Description')) {
                $table->text('Description')->nullable()->after('CategoryName');
            }
            
            // Add CategoryStatus if not exists
            if (!Schema::hasColumn('categories', 'CategoryStatus')) {
                $table->tinyInteger('CategoryStatus')->default(1)->after('Description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            if (Schema::hasColumn('categories', 'Description')) {
                $table->dropColumn('Description');
            }
            if (Schema::hasColumn('categories', 'CategoryStatus')) {
                $table->dropColumn('CategoryStatus');
            }
        });
    }
};