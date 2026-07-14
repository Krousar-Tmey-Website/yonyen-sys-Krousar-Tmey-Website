<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('core_values', function (Blueprint $table) {
            $table->string('headline')->nullable()->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('core_values', function (Blueprint $table) {
            $table->dropColumn('headline');
        });
    }
};