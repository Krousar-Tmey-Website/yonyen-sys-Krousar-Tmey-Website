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
        Schema::create('news_stories', function (Blueprint $table) {
            $table->string('ArticleID', 50)->primary();
            $table->string('Title', 200);
            $table->date('PublishDate');
            $table->text('Content');
            $table->string('Author');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_stories');
    }
};
