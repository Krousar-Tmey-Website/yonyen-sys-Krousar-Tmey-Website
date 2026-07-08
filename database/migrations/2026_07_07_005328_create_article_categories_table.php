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
        // If a partial/incorrect table exists (from a failed run), remove it first so
        // the migration can create a clean, correctly-typed table.
        Schema::dropIfExists('article_categories');

        Schema::create('article_categories', function (Blueprint $table) {
            $table->string('ArticleID', 50);
            // categories table uses the default big-integer `id` column, so use
            // an unsignedBigInteger here to match types for the foreign key.
            $table->unsignedBigInteger('CategoryID');

            $table->primary(['ArticleID', 'CategoryID']);

            $table->foreign('ArticleID')
                ->references('ArticleID')
                ->on('news_stories')
                ->onDelete('cascade');

            $table->foreign('CategoryID')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
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
