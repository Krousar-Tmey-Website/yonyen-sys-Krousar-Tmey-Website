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
        Schema::create('partner_programs', function (Blueprint $table) {
            $table->string('PartnerID', 50);
            $table->string('ProgramID', 50);
            $table->string('SupportType');

            $table->primary(['PartnerID', 'ProgramID']);

            $table->foreign('PartnerID')->references('PartnerID')->on('partners');
            $table->foreign('ProgramID')->references('ProgramID')->on('programs');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partner_programs');
    }
};
