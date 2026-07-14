<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_id')->constrained('media')->cascadeOnDelete();
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('category_id')
                  ->references('CategoryID')
                  ->on('categories')
                  ->cascadeOnDelete();

            $table->unique(['media_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_categories');
    }
};
