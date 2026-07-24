<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('program_page_items', function (Blueprint $table) {
            $table->longText('title_fr')->nullable()->after('title');
            $table->longText('objective_fr')->nullable()->after('objective');
            $table->longText('short_content_fr')->nullable()->after('short_content');
            $table->longText('detail_content_fr')->nullable()->after('detail_content');
            $table->longText('activities_fr')->nullable()->after('activities');
        });
    }

    public function down(): void
    {
        Schema::table('program_page_items', function (Blueprint $table) {
            $table->dropColumn(['title_fr', 'objective_fr', 'short_content_fr', 'detail_content_fr', 'activities_fr']);
        });
    }
};
