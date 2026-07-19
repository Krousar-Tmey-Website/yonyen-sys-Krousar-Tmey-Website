<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            if (!Schema::hasColumn('payment_methods', 'bank_type')) {
                $table->string('bank_type', 50)->nullable()->after('description');
            }
            if (!Schema::hasColumn('payment_methods', 'name_kh')) {
                $table->string('name_kh', 255)->nullable()->after('name');
            }
            if (!Schema::hasColumn('payment_methods', 'account_holder_kh')) {
                $table->string('account_holder_kh', 255)->nullable()->after('account_name');
            }
            if (!Schema::hasColumn('payment_methods', 'brand_color')) {
                $table->string('brand_color', 10)->nullable()->after('currency');
            }
        });
    }

    public function down(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            $columns = ['bank_type', 'name_kh', 'account_holder_kh', 'brand_color'];
            foreach ($columns as $col) {
                if (Schema::hasColumn('payment_methods', $col)) {
                    $table->dropColumn($col);
                }
            }
        });
    }
};
