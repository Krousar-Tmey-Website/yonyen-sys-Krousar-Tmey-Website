<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('awards', function (Blueprint $table) {
            if (!Schema::hasColumn('awards', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('sort_order');
            }
            if (!Schema::hasColumn('awards', 'website_url')) {
                $table->string('website_url')->nullable()->after('is_active');
            }
            if (!Schema::hasColumn('awards', 'article_url')) {
                $table->string('article_url')->nullable()->after('website_url');
            }
            if (!Schema::hasColumn('awards', 'video_url')) {
                $table->string('video_url')->nullable()->after('article_url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('awards', function (Blueprint $table) {
            $table->dropColumn(array_filter(
                ['is_active', 'website_url', 'article_url', 'video_url'],
                fn ($col) => Schema::hasColumn('awards', $col)
            ));
        });
    }
};
