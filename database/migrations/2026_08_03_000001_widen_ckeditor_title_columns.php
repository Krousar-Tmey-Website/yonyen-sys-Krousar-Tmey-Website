<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Several "Title" fields were switched from plain <input> to CKEditor in the
 * admin UI, but the columns backing them were only ever sized as varchar(255)
 * (fine for a handful of plain words, not for HTML markup once formatting is
 * applied). This widens those columns and, for projects.make_difference_title_fr /
 * make_difference_text_fr, adds them outright — the admin form and Project
 * model already read/write these two columns, but no prior migration ever
 * created them, so saving a project's French "Make a Difference" override has
 * been failing with an "Unknown column" error.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        Schema::table('core_values', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
            $table->text('title_fr')->nullable()->change();
            $table->text('headline')->nullable()->change();
            $table->text('headline_fr')->nullable()->change();
        });

        Schema::table('page_sections', function (Blueprint $table) {
            $table->longText('title')->nullable()->change();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->longText('make_difference_title')->nullable()->change();

            if (!Schema::hasColumn('projects', 'make_difference_title_fr')) {
                $table->longText('make_difference_title_fr')->nullable()->after('make_difference_title');
            }

            if (!Schema::hasColumn('projects', 'make_difference_text_fr')) {
                $table->longText('make_difference_text_fr')->nullable()->after('make_difference_text');
            }
        });
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        Schema::table('core_values', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
            $table->string('title_fr')->nullable()->change();
            $table->string('headline')->nullable()->change();
            $table->string('headline_fr')->nullable()->change();
        });

        Schema::table('page_sections', function (Blueprint $table) {
            $table->string('title')->nullable()->change();
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->string('make_difference_title')->nullable()->change();
            $table->dropColumn(['make_difference_title_fr', 'make_difference_text_fr']);
        });
    }
};
