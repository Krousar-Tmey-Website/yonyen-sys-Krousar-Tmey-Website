<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('payment_methods', 'description')) {
            Schema::table('payment_methods', function (Blueprint $table) {
                $table->text('description')->nullable()->after('redirect_url');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('payment_methods', 'description')) {
            Schema::table('payment_methods', function (Blueprint $table) {
                $table->dropColumn('description');
            });
        }
    }
};
