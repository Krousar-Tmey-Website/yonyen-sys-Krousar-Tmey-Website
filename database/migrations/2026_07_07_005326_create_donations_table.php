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
        Schema::create('donations', function (Blueprint $table) {
            $table->string('DonationID', 50)->primary();

            $table->string('DonorID', 50);
            $table->decimal('DonationAmount', 12, 2);
            $table->date('DonationDate');
            $table->string('PaymentMethod');
            $table->boolean('IsRecurring');
            $table->boolean('TaxReceiptIssued');
            $table->string('FiscalResidency');

            $table->foreign('DonorID')->references('DonorID')->on('donors');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
