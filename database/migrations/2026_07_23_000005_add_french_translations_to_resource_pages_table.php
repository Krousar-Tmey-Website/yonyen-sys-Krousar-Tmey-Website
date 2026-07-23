<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('resource_pages', function (Blueprint $table) {
            $table->longText('title_fr')->nullable()->after('title');
            $table->longText('description_fr')->nullable()->after('description');
            $table->text('header_text_fr')->nullable()->after('header_text');
            $table->longText('detail_description_fr')->nullable()->after('detail_description');
        });
    }

    public function down(): void
    {
        Schema::table('resource_pages', function (Blueprint $table) {
            $table->dropColumn(['title_fr', 'description_fr', 'header_text_fr', 'detail_description_fr']);
        });
    }
};
