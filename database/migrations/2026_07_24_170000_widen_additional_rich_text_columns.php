<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        Schema::table('books', function (Blueprint $table) {
            $table->longText('description')->nullable()->change();
            $table->longText('description_fr')->nullable()->change();
        });

        Schema::table('campaigns', function (Blueprint $table) {
            $table->longText('description')->nullable()->change();
        });

        Schema::table('media_galleries', function (Blueprint $table) {
            $table->longText('description')->nullable()->change();
        });
    }

    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        Schema::table('books', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
            $table->text('description_fr')->nullable()->change();
        });

        Schema::table('campaigns', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
        });

        Schema::table('media_galleries', function (Blueprint $table) {
            $table->text('description')->nullable()->change();
        });
    }
};
