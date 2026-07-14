<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'stock')) {
                $table->unsignedInteger('stock')->default(0)->after('price');
            }
            if (!Schema::hasColumn('books', 'price')) {
                $table->decimal('price', 10, 2)->default(0.00)->after('description');
            }
            if (!Schema::hasColumn('books', 'cover_image')) {
                $table->string('cover_image')->nullable()->after('stock');
            }
            if (!Schema::hasColumn('books', 'author')) {
                $table->string('author')->nullable()->after('title');
            }
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['stock', 'price', 'cover_image', 'author']);
        });
    }
};
