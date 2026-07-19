<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * News::category stores the related Category's CategoryName (see
     * Category::news()) but the column was never added when that
     * relation was introduced.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('news', 'category')) {
            Schema::table('news', function (Blueprint $table) {
                $table->string('category')->nullable()->after('image');
            });
        }
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
