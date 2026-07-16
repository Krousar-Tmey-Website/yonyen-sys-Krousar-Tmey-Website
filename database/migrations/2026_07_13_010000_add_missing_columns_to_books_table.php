<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'is_available')) {
                $table->boolean('is_available')->default(true)->after('cover_image');
            }
            if (!Schema::hasColumn('books', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('is_available');
            }
            if (!Schema::hasColumn('books', 'stock')) {
                $table->integer('stock')->default(0)->after('price');
            }
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['is_available', 'sort_order', 'stock']);
        });
    }
};
