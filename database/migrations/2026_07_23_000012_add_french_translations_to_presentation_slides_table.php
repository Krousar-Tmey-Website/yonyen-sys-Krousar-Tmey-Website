<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('presentation_slides', function (Blueprint $table) {
            $table->string('title_fr')->nullable()->after('title');
            $table->text('subtitle_fr')->nullable()->after('subtitle');
            $table->string('badge_text_fr')->nullable()->after('badge_text');
            $table->string('cta_primary_text_fr')->nullable()->after('cta_primary_text');
            $table->string('cta_secondary_text_fr')->nullable()->after('cta_secondary_text');
        });
    }

    public function down(): void
    {
        Schema::table('presentation_slides', function (Blueprint $table) {
            $table->dropColumn([
                'title_fr', 'subtitle_fr', 'badge_text_fr',
                'cta_primary_text_fr', 'cta_secondary_text_fr',
            ]);
        });
    }
};
