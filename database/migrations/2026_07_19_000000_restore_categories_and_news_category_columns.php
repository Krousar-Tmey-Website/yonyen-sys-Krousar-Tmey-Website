<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * This branch's News/Category admin code (App\Models\Category,
     * NewsController, DashboardController) still expects the
     * `categories` table and `news.category` / `news.tags` columns.
     * Those were dropped and replaced with `gallery`/`videos`/`tag_links`
     * by migrations that only exist on a different branch but were run
     * against this shared database. This restores the schema this
     * branch's code actually relies on.
     */
    public function up(): void
    {
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id('CategoryID');
                $table->string('CategoryName');
                $table->text('Description')->nullable();
                $table->tinyInteger('CategoryStatus')->default(1);
                $table->timestamps();
            });
        }

        Schema::table('news', function (Blueprint $table) {
            if (!Schema::hasColumn('news', 'category')) {
                $table->string('category')->default('general')->after('image');
            }
            if (!Schema::hasColumn('news', 'tags')) {
                $table->string('tags')->nullable()->after('links');
            }
        });

        Schema::table('news', function (Blueprint $table) {
            foreach (['gallery', 'videos', 'tag_links'] as $column) {
                if (Schema::hasColumn('news', $column)) {
                    $table->dropColumn($column);
                }
            }
        });

        // Drop the phantom migration rows left behind by the other branch's
        // migrations so migrate:status doesn't reference files that don't exist here.
        DB::table('migrations')->whereIn('migration', [
            '2026_07_15_102521_remove_category_feature_from_news',
            '2026_07_15_114512_add_gallery_to_news_table',
            '2026_07_17_015310_add_videos_to_news_table',
        ])->delete();
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            if (Schema::hasColumn('news', 'category')) {
                $table->dropColumn('category');
            }
            if (Schema::hasColumn('news', 'tags')) {
                $table->dropColumn('tags');
            }
        });

        Schema::dropIfExists('categories');
    }
};
