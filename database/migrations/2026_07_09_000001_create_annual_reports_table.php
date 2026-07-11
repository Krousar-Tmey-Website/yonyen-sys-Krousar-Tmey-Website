<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('annual_reports')) {
            Schema::create('annual_reports', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->integer('year');
                $table->string('file_path')->nullable();
                $table->string('original_filename')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('annual_reports');
    }
};
