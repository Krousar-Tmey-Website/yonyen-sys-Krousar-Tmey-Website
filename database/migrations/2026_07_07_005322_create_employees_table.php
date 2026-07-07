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
        Schema::create('employees', function (Blueprint $table) {
            $table->string('EmployeeID', 50)->primary();
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('Role');
            $table->string('Department');
            $table->date('HireDate');

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
        Schema::dropIfExists('employees');
    }
};
