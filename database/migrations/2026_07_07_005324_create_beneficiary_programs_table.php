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
        Schema::create('beneficiary_programs', function (Blueprint $table) {
            $table->string('BeneficiaryID', 50);
            $table->string('ProgramID', 50);
            $table->date('AssociationDate');

            $table->primary(['BeneficiaryID', 'ProgramID']);

            $table->foreign('BeneficiaryID')->references('BeneficiaryID')->on('children');
            $table->foreign('ProgramID')->references('ProgramID')->on('programs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beneficiary_programs');
    }
};
