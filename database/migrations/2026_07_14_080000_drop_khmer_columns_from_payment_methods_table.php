<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            if (Schema::hasColumn('payment_methods', 'name_kh')) {
                $table->dropColumn('name_kh');
            }
            if (Schema::hasColumn('payment_methods', 'account_holder_kh')) {
                $table->dropColumn('account_holder_kh');
            }
        });
    }

    public function down(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            if (!Schema::hasColumn('payment_methods', 'name_kh')) {
                $table->string('name_kh', 255)->nullable()->after('name');
            }
            if (!Schema::hasColumn('payment_methods', 'account_holder_kh')) {
                $table->string('account_holder_kh', 255)->nullable()->after('account_name');
            }
        });
    }
};
