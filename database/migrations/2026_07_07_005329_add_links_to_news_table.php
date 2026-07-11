<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Only add the column if it doesn't already exist (protects against
        // partial/previous runs that left the column in place).
        if (! Schema::hasColumn('news', 'links')) {
            Schema::table('news', function (Blueprint $table) {
                $table->json('links')->nullable()->after('published_at');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('news', 'links')) {
            Schema::table('news', function (Blueprint $table) {
                $table->dropColumn('links');
            });
        }
    }
};