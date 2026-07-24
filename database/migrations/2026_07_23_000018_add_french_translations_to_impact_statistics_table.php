<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('impact_statistics', function (Blueprint $table) {
            $table->string('label_fr')->nullable()->after('label');
            $table->text('description_fr')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('impact_statistics', function (Blueprint $table) {
            $table->dropColumn(['label_fr', 'description_fr']);
        });
    }
};
