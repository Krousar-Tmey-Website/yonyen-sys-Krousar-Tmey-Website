<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('article_categories', function (Blueprint $table) {
            $table->string('ArticleID', 50);
            $table->string('CategoryID', 50);

            $table->primary(['ArticleID', 'CategoryID']);

            $table->foreign('ArticleID')->references('ArticleID')->on('news_stories');
            $table->foreign('CategoryID')->references('CategoryID')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_categories');
    }
};
