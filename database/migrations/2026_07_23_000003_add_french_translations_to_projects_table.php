<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->longText('title_fr')->nullable()->after('title');
            $table->longText('description_fr')->nullable()->after('description');
            $table->longText('objective_fr')->nullable()->after('objective');
            $table->longText('content_fr')->nullable()->after('content');
            $table->longText('activities_fr')->nullable()->after('activities');
            $table->longText('testimony_name_fr')->nullable()->after('testimony_name');
            $table->longText('testimony_story_fr')->nullable()->after('testimony_story');
        });
    }

    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'title_fr',
                'description_fr',
                'objective_fr',
                'content_fr',
                'activities_fr',
                'testimony_name_fr',
                'testimony_story_fr',
            ]);
        });
    }
};
