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
        Schema::create('children', function (Blueprint $table) {
            $table->string('BeneficiaryID', 50)->primary();
            $table->string('FirstName');
            $table->string('LastName');
            $table->date('DateOfBirth');
            $table->string('Gender', 20);
            $table->date('EnrollmentDate');
            $table->date('ExitDate')->nullable();
            $table->string('Status');
            $table->string('NeedsCategory');

            $table->string('LocationID', 50);
            $table->foreign('LocationID')->references('LocationID')->on('locations');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
