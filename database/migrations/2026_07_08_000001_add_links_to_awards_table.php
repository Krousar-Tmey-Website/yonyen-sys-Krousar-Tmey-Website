<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('awards', function (Blueprint $table) {
            $table->string('link_url')->nullable()->after('description');
            $table->string('link_text')->nullable()->after('link_url');
            $table->string('link_type')->nullable()->after('link_text'); // website, article, video
        });
    }

    public function down(): void
    {
        Schema::table('awards', function (Blueprint $table) {
            $table->dropColumn(['link_url', 'link_text', 'link_type']);
        });
    }
};