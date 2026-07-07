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
        Schema::create('program_locations', function (Blueprint $table) {
            $table->string('ProgramID', 50);
            $table->string('LocationID', 50);

            $table->primary(['ProgramID', 'LocationID']);

            $table->foreign('ProgramID')->references('ProgramID')->on('programs');
            $table->foreign('LocationID')->references('LocationID')->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_locations');
    }
};
