<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->string('SettingID', 50)->primary();
            $table->string('WebsiteName')->nullable();
            $table->string('LogoImage')->nullable();
            $table->text('FooterText')->nullable();
            $table->string('Email')->nullable();
            $table->string('Phone')->nullable();
            $table->string('Address')->nullable();
            $table->string('FacebookURL')->nullable();
            $table->string('TelegramURL')->nullable();
            $table->string('YoutubeURL')->nullable();
            $table->string('UpdatedBy', 50)->nullable();
            $table->dateTime('UpdatedAt')->nullable();

            $table->foreign('UpdatedBy')->references('AdminID')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
