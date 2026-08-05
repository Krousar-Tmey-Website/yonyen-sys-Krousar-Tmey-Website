<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book_order_channels', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('url');
            $table->string('icon_key')->default('link');
            $table->string('label');
            $table->string('label_fr')->nullable();
            $table->string('value');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book_order_channels');
    }
};
