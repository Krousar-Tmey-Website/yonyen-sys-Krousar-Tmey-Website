<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news_stories', function (Blueprint $table) {
            $table->text('ShortDescription')->nullable();
            $table->string('ThumbnailImage')->nullable();
            $table->string('Slug')->nullable()->unique();
            $table->string('ExternalURL')->nullable();
            $table->boolean('OpenNewTab')->default(false);
            $table->string('Status')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('news_stories', function (Blueprint $table) {
            $table->dropUnique(['Slug']);
            $table->dropColumn([
                'ShortDescription',
                'ThumbnailImage',
                'Slug',
                'ExternalURL',
                'OpenNewTab',
                'Status',
            ]);
        });
    }
};
