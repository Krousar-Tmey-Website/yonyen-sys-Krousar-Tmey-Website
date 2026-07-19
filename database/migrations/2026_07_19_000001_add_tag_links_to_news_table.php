<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The News model, NewsController, and admin/public news views all
     * read/write `tag_links` (JSON [{label, url}] pairs). An earlier
     * migration (2026_07_19_000000_restore_categories_and_news_category_columns)
     * dropped this column based on a stale assumption that it belonged to
     * a different branch. It doesn't — restore it.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('news', 'tag_links')) {
            Schema::table('news', function (Blueprint $table) {
                $table->json('tag_links')->nullable()->after('links');
            });
        }
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            if (Schema::hasColumn('news', 'tag_links')) {
                $table->dropColumn('tag_links');
            }
        });
    }
};
