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
        Schema::create('article_programs', function (Blueprint $table) {
            $table->string('ArticleID', 50);
            $table->string('ProgramID', 50);

            $table->primary(['ArticleID', 'ProgramID']);

            $table->foreign('ArticleID')->references('ArticleID')->on('news_stories');
            $table->foreign('ProgramID')->references('ProgramID')->on('programs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_programs');
    }
};
