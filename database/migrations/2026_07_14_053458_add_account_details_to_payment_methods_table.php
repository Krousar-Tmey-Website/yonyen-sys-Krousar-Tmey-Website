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
        Schema::table('payment_methods', function (Blueprint $table) {
            $table->string('account_name')->nullable()->after('description');
            $table->string('account_no')->nullable()->after('account_name');
            $table->string('currency', 10)->nullable()->after('account_no');
        });
    }

    public function down(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            $table->dropColumn(['account_name', 'account_no', 'currency']);
        });
    }
};
