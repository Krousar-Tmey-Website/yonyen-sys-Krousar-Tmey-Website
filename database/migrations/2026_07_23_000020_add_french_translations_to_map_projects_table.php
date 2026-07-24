<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('map_projects', function (Blueprint $table) {
            $table->string('location_name_fr')->nullable()->after('location_name');
        });
    }

    public function down(): void
    {
        Schema::table('map_projects', function (Blueprint $table) {
            $table->dropColumn(['location_name_fr']);
        });
    }
};
