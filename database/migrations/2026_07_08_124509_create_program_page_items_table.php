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
        Schema::create('program_page_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_page_id')->nullable()->constrained('program_pages')->onDelete('cascade');
            $table->string('title');
            $table->text('short_content')->nullable();
            $table->longText('detail_content')->nullable();
            $table->string('image')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_page_items');
    }
};
