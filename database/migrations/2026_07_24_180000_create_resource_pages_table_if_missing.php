<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('resource_pages')) {
            return;
        }

        Schema::create('resource_pages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_fr')->nullable();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('description_fr')->nullable();
            $table->string('image')->nullable();
            $table->text('header_text')->nullable();
            $table->text('header_text_fr')->nullable();
            $table->string('detail_image')->nullable();
            $table->longText('detail_description')->nullable();
            $table->longText('detail_description_fr')->nullable();
            $table->json('items')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resource_pages');
    }
};
