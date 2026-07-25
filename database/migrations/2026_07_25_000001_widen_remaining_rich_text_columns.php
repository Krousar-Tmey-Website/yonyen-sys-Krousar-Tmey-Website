<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Widen every rich-text column that is still TEXT (65 KB) to LONGTEXT (4 GB).
 * CKEditor output with inline font/color/size styles can easily exceed 65 KB
 * for longer articles, causing silent truncation in MySQL.
 *
 * Tables already widened by earlier migrations (projects, program_page_items,
 * books, campaigns, media_galleries) are intentionally omitted here.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return; // SQLite has no TEXT/LONGTEXT distinction
        }

        // news: excerpt columns are TEXT; content is already LONGTEXT
        Schema::table('news', function (Blueprint $table) {
            $table->longText('excerpt')->nullable()->change();
            $table->longText('excerpt_fr')->nullable()->change();
            $table->longText('content_fr')->nullable()->change();
        });

        // programs: description and full_description are TEXT
        Schema::table('programs', function (Blueprint $table) {
            $table->longText('description')->nullable()->change();
            $table->longText('description_fr')->nullable()->change();
            $table->longText('full_description')->nullable()->change();
            $table->longText('full_description_fr')->nullable()->change();
            $table->longText('testimony_story')->nullable()->change();
            $table->longText('testimony_story_fr')->nullable()->change();
        });

        // resource_pages: detail_description may be TEXT
        if (Schema::hasTable('resource_pages')) {
            Schema::table('resource_pages', function (Blueprint $table) {
                if (Schema::hasColumn('resource_pages', 'description')) {
                    $table->longText('description')->nullable()->change();
                }
                if (Schema::hasColumn('resource_pages', 'description_fr')) {
                    $table->longText('description_fr')->nullable()->change();
                }
                if (Schema::hasColumn('resource_pages', 'detail_description')) {
                    $table->longText('detail_description')->nullable()->change();
                }
                if (Schema::hasColumn('resource_pages', 'detail_description_fr')) {
                    $table->longText('detail_description_fr')->nullable()->change();
                }
            });
        }

        // annual_reports: description columns
        if (Schema::hasTable('annual_reports')) {
            Schema::table('annual_reports', function (Blueprint $table) {
                if (Schema::hasColumn('annual_reports', 'description')) {
                    $table->longText('description')->nullable()->change();
                }
                if (Schema::hasColumn('annual_reports', 'description_fr')) {
                    $table->longText('description_fr')->nullable()->change();
                }
            });
        }

        // slides: subtitle / body columns
        if (Schema::hasTable('slides')) {
            Schema::table('slides', function (Blueprint $table) {
                if (Schema::hasColumn('slides', 'subtitle')) {
                    $table->longText('subtitle')->nullable()->change();
                }
                if (Schema::hasColumn('slides', 'subtitle_fr')) {
                    $table->longText('subtitle_fr')->nullable()->change();
                }
            });
        }

        // page_sections: content columns
        if (Schema::hasTable('page_sections')) {
            Schema::table('page_sections', function (Blueprint $table) {
                if (Schema::hasColumn('page_sections', 'content')) {
                    $table->longText('content')->nullable()->change();
                }
                if (Schema::hasColumn('page_sections', 'content_fr')) {
                    $table->longText('content_fr')->nullable()->change();
                }
            });
        }

        // sponsors: description
        if (Schema::hasTable('sponsors')) {
            Schema::table('sponsors', function (Blueprint $table) {
                if (Schema::hasColumn('sponsors', 'description')) {
                    $table->longText('description')->nullable()->change();
                }
                if (Schema::hasColumn('sponsors', 'description_fr')) {
                    $table->longText('description_fr')->nullable()->change();
                }
            });
        }

        // worldwide_partners: description
        if (Schema::hasTable('worldwide_partners')) {
            Schema::table('worldwide_partners', function (Blueprint $table) {
                if (Schema::hasColumn('worldwide_partners', 'description')) {
                    $table->longText('description')->nullable()->change();
                }
                if (Schema::hasColumn('worldwide_partners', 'description_fr')) {
                    $table->longText('description_fr')->nullable()->change();
                }
            });
        }

        // testimonials: content
        if (Schema::hasTable('testimonials')) {
            Schema::table('testimonials', function (Blueprint $table) {
                if (Schema::hasColumn('testimonials', 'content')) {
                    $table->longText('content')->nullable()->change();
                }
                if (Schema::hasColumn('testimonials', 'content_fr')) {
                    $table->longText('content_fr')->nullable()->change();
                }
            });
        }

        // job_opportunities: description
        if (Schema::hasTable('job_opportunities')) {
            Schema::table('job_opportunities', function (Blueprint $table) {
                if (Schema::hasColumn('job_opportunities', 'description')) {
                    $table->longText('description')->nullable()->change();
                }
                if (Schema::hasColumn('job_opportunities', 'description_fr')) {
                    $table->longText('description_fr')->nullable()->change();
                }
            });
        }

        // partners: description
        if (Schema::hasTable('partners')) {
            Schema::table('partners', function (Blueprint $table) {
                if (Schema::hasColumn('partners', 'description')) {
                    $table->longText('description')->nullable()->change();
                }
                if (Schema::hasColumn('partners', 'description_fr')) {
                    $table->longText('description_fr')->nullable()->change();
                }
            });
        }
    }

    public function down(): void
    {
        // Intentionally not reverting — shrinking LONGTEXT back to TEXT
        // would risk data loss if any row already exceeds 65 KB.
    }
};
