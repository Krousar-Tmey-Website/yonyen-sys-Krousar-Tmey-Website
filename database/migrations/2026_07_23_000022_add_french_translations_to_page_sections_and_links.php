<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('page_sections', function (Blueprint $table) {
            $table->longText('title_fr')->nullable()->after('title');
            $table->longText('description_fr')->nullable()->after('description');
        });

        Schema::table('links', function (Blueprint $table) {
            $table->string('text_fr')->nullable()->after('text');
        });
    }

    public function down(): void
    {
        Schema::table('links', function (Blueprint $table) {
            $table->dropColumn('text_fr');
        });

        Schema::table('page_sections', function (Blueprint $table) {
            $table->dropColumn(['title_fr', 'description_fr']);
        });
    }
};
