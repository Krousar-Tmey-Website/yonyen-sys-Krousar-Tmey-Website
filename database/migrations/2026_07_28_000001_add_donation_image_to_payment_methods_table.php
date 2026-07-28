<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            if (!Schema::hasColumn('payment_methods', 'donation_image')) {
                $table->string('donation_image')->nullable()->after('qr_code');
            }
        });
    }

    public function down(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            if (Schema::hasColumn('payment_methods', 'donation_image')) {
                $table->dropColumn('donation_image');
            }
        });
    }
};
