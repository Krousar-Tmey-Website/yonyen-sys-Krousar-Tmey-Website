<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type')->default('image'); // image, video, document
            $table->string('file_path')->nullable();
            $table->string('external_url')->nullable();
            $table->text('description')->nullable();
            $table->string('alt_text')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_galleries');
    }
};