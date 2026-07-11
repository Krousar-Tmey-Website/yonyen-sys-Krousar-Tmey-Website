<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            if (Schema::hasColumn('partners', 'category') && !Schema::hasColumn('partners', 'category_id')) {
                $table->renameColumn('category', 'category_id');
            }
        });
    }

    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            if (Schema::hasColumn('partners', 'category_id') && !Schema::hasColumn('partners', 'category')) {
                $table->renameColumn('category_id', 'category');
            }
        });
    }
};
