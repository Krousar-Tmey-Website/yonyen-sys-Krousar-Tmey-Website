<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->string('file_type')->default('image'); // 'image' or 'video'
            $table->string('mime_type')->nullable();
            $table->string('thumbnail_path')->nullable(); // auto-generated or manually uploaded thumbnail
            $table->unsignedBigInteger('file_size')->nullable(); // size in bytes
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
