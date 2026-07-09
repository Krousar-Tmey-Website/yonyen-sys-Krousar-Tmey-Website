<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('projects', function (Blueprint $table) {
            $table->id(); $table->string('title')->nullable(); $table->text('description')->nullable(); $table->string('image')->nullable(); $table->boolean('is_active')->default(true); $table->timestamps();
        });
        Schema::create('galleries', function (Blueprint $table) {
            $table->id(); $table->string('title')->nullable(); $table->string('image')->nullable(); $table->boolean('is_active')->default(true); $table->timestamps();
        });
        Schema::create('testimonials', function (Blueprint $table) {
            $table->id(); $table->string('name')->nullable(); $table->string('role')->nullable(); $table->text('content')->nullable(); $table->string('image')->nullable(); $table->boolean('is_active')->default(true); $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('projects'); Schema::dropIfExists('galleries'); Schema::dropIfExists('testimonials');
    }
};
