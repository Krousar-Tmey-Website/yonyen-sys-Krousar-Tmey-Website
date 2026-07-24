<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('annual_reports', function (Blueprint $table) {
            $table->string('title_fr')->nullable()->after('title');
            $table->string('description_fr', 255)->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('annual_reports', function (Blueprint $table) {
            $table->dropColumn(['title_fr', 'description_fr']);
        });
    }
};
