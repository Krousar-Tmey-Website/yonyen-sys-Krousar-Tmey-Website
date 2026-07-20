<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Adds gallery/video support and a labeled-link tag system to News,
     * alongside the existing `category` column (this branch keeps the
     * Categories admin feature — unlike the `develop` branch, which
     * dropped categories entirely in favor of these same columns).
     * All additions are guarded so this is safe to run whether or not
     * another branch's migrations already added some of these columns
     * against a shared database.
     */
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            if (!Schema::hasColumn('news', 'gallery')) {
                $table->json('gallery')->nullable()->after('image');
            }
            if (!Schema::hasColumn('news', 'videos')) {
                $table->json('videos')->nullable()->after('gallery');
            }
            if (!Schema::hasColumn('news', 'tag_links')) {
                $table->json('tag_links')->nullable()->after('links');
            }
        });

        // One-time best-effort migration of the old comma-separated `tags`
        // column into tag_links (label-only, no URL). Left untouched if a
        // row already has tag_links set, and the old `tags` column itself
        // is left in place rather than dropped, since it may still be
        // relied on elsewhere against this shared database.
        if (Schema::hasColumn('news', 'tags') && Schema::hasColumn('news', 'tag_links')) {
            DB::table('news')
                ->whereNotNull('tags')
                ->where('tags', '!=', '')
                ->where(function ($query) {
                    $query->whereNull('tag_links')->orWhere('tag_links', '');
                })
                ->orderBy('id')
                ->get(['id', 'tags'])
                ->each(function ($row) {
                    $labels = array_values(array_filter(array_map('trim', explode(',', $row->tags))));
                    if (!empty($labels)) {
                        DB::table('news')->where('id', $row->id)->update([
                            'tag_links' => json_encode(array_map(fn ($label) => ['label' => $label, 'url' => null], $labels)),
                        ]);
                    }
                });
        }
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            foreach (['gallery', 'videos', 'tag_links'] as $column) {
                if (Schema::hasColumn('news', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
