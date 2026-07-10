<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->decimal('Amount', 12, 2)->nullable();
            $table->string('Currency')->nullable();
            $table->string('TransactionID')->nullable();
            $table->string('Status')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropColumn(['Amount', 'Currency', 'TransactionID', 'Status']);
        });
    }
};
