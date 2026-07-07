<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->string('FullName')->nullable();
            $table->string('Position')->nullable();
            $table->string('Email')->nullable();
            $table->string('Phone')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(['FullName', 'Position', 'Email', 'Phone']);
        });
    }
};
