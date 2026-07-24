<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('core_values', function (Blueprint $table) {
            $table->string('title_fr')->nullable()->after('title');
            $table->string('headline_fr')->nullable()->after('headline');
            $table->text('description_fr')->nullable()->after('description');
            $table->text('supporting_description_fr')->nullable()->after('supporting_description');
        });
    }

    public function down(): void
    {
        Schema::table('core_values', function (Blueprint $table) {
            $table->dropColumn(['title_fr', 'headline_fr', 'description_fr', 'supporting_description_fr']);
        });
    }
};
