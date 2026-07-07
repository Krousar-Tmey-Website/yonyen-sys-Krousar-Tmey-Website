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
            // categories table uses the default `id` (unsigned big integer),
            // so use an unsignedBigInteger here to match the FK type.
            $table->unsignedBigInteger('CategoryID');

            $table->primary(['ArticleID', 'CategoryID']);

            $table->foreign('ArticleID')->references('ArticleID')->on('news_stories');
            // reference categories.id
            $table->foreign('CategoryID')->references('id')->on('categories')->onDelete('cascade');
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
