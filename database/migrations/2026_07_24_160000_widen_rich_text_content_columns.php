<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        Schema::table('projects', function (Blueprint $table) {
            $table->longText('description')->nullable()->change();
            $table->longText('description_fr')->nullable()->change();
            $table->longText('objective')->nullable()->change();
            $table->longText('objective_fr')->nullable()->change();
            $table->longText('content')->nullable()->change();
            $table->longText('content_fr')->nullable()->change();
            $table->longText('testimony_story')->nullable()->change();
            $table->longText('testimony_story_fr')->nullable()->change();
        });

        Schema::table('program_page_items', function (Blueprint $table) {
            $table->longText('short_content')->nullable()->change();
            $table->longText('short_content_fr')->nullable()->change();
            $table->longText('objective')->nullable()->change();
            $table->longText('objective_fr')->nullable()->change();
            $table->longText('detail_content')->nullable()->change();
            $table->longText('detail_content_fr')->nullable()->change();
        });
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        Schema::table('projects', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
            $table->text('description_fr')->nullable()->change();
            $table->text('objective')->nullable()->change();
            $table->text('objective_fr')->nullable()->change();
            $table->text('content')->nullable()->change();
            $table->text('content_fr')->nullable()->change();
            $table->text('testimony_story')->nullable()->change();
            $table->text('testimony_story_fr')->nullable()->change();
        });

        Schema::table('program_page_items', function (Blueprint $table) {
            $table->text('short_content')->nullable()->change();
            $table->text('short_content_fr')->nullable()->change();
            $table->text('objective')->nullable()->change();
            $table->text('objective_fr')->nullable()->change();
            $table->longText('detail_content')->nullable()->change();
            $table->text('detail_content_fr')->nullable()->change();
        });
    }
};
