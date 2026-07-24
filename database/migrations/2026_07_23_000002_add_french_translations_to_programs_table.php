<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->longText('title_fr')->nullable()->after('title');
            $table->longText('description_fr')->nullable()->after('description');
            $table->longText('full_description_fr')->nullable()->after('full_description');
            $table->longText('Status_fr')->nullable()->after('Status');
            $table->longText('testimony_name_fr')->nullable()->after('testimony_name');
            $table->longText('testimony_story_fr')->nullable()->after('testimony_story');
        });
    }

    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropColumn([
                'title_fr',
                'description_fr',
                'full_description_fr',
                'Status_fr',
                'testimony_name_fr',
                'testimony_story_fr',
            ]);
        });
    }
};
