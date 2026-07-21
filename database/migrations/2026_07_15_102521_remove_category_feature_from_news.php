<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Idempotent: MySQL DDL auto-commits per statement, so a prior failed run
        // of this same migration may have already applied some of these steps.

        if (!Schema::hasColumn('news', 'tag_links')) {
            Schema::table('news', function (Blueprint $table) {
                $table->json('tag_links')->nullable()->after('tags');
            });
        }

        // Fold the old category + comma-separated tags into label-only tag_links
        // entries so existing article data isn't lost. URLs can be added afterward
        // via the new admin UI.
        if (Schema::hasColumn('news', 'category') || Schema::hasColumn('news', 'tags')) {
            $columns = array_filter(['id', 'category', 'tags'], fn ($c) => $c === 'id' || Schema::hasColumn('news', $c));
            DB::table('news')->orderBy('id')->get($columns)->each(function ($news) {
                $labels = [];
                if (!empty($news->category ?? null)) {
                    $labels[] = trim($news->category);
                }
                if (!empty($news->tags ?? null)) {
                    foreach (explode(',', $news->tags) as $tag) {
                        $tag = trim($tag);
                        if ($tag !== '') {
                            $labels[] = $tag;
                        }
                    }
                }
                $labels = array_values(array_unique($labels));

                if (!empty($labels)) {
                    DB::table('news')->where('id', $news->id)->update([
                        'tag_links' => json_encode(array_map(fn ($label) => ['label' => $label, 'url' => null], $labels)),
                    ]);
                }
            });
        }

        Schema::table('news', function (Blueprint $table) {
            if (Schema::hasColumn('news', 'category')) {
                $table->dropColumn('category');
            }
            if (Schema::hasColumn('news', 'tags')) {
                $table->dropColumn('tags');
            }
        });

        // Drop foreign key from media_categories before dropping categories
        if (Schema::hasTable('media_categories')) {
            Schema::table('media_categories', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
            });
            Schema::dropIfExists('media_categories');
        }

        // Unused legacy pivot table with no model/controller anywhere in the app;
        // its FK to categories.CategoryID blocks dropping that table otherwise.
        Schema::dropIfExists('article_categories');
        Schema::dropIfExists('categories');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('CategoryID');
            $table->string('CategoryName');
            $table->text('Description')->nullable();
            $table->integer('CategoryStatus')->default(1);
            $table->timestamps();
        });

        Schema::table('news', function (Blueprint $table) {
            $table->string('category')->nullable()->after('image');
            $table->string('tags')->nullable()->after('links');
        });

        // Best-effort restore: use each article's first tag_links label as its category.
        DB::table('news')->orderBy('id')->get(['id', 'tag_links'])->each(function ($news) {
            $labels = json_decode($news->tag_links ?? '[]', true) ?: [];
            if (!empty($labels)) {
                DB::table('news')->where('id', $news->id)->update([
                    'category' => $labels[0]['label'] ?? null,
                    'tags' => implode(', ', array_column(array_slice($labels, 1), 'label')),
                ]);
            }
        });

        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('tag_links');
        });
    }
};
