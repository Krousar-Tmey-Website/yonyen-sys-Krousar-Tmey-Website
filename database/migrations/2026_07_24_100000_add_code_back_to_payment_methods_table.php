<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('payment_methods', 'code')) {
            Schema::table('payment_methods', function (Blueprint $table) {
                $table->string('code', 50)->nullable()->unique()->after('name');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('payment_methods', 'code')) {
            Schema::table('payment_methods', function (Blueprint $table) {
                $table->dropColumn('code');
            });
        }
    }
};
