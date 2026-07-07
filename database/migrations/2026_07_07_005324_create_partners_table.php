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
        Schema::table('partners', function (Blueprint $table) {
            $table->string('PartnerID', 50)->nullable()->unique();
            $table->string('PartnerName', 150)->nullable();
            $table->string('PartnerType', 100)->nullable();
            $table->string('ContactPerson', 100)->nullable();
            $table->string('ContactEmail', 150)->nullable();
            $table->string('ContactPhone', 50)->nullable();
            $table->date('PartnershipStartDate')->nullable();
            $table->date('PartnershipEndDate')->nullable();
            $table->text('Description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropUnique(['PartnerID']);
            $table->dropColumn([
                'PartnerID',
                'PartnerName',
                'PartnerType',
                'ContactPerson',
                'ContactEmail',
                'ContactPhone',
                'PartnershipStartDate',
                'PartnershipEndDate',
                'Description',
            ]);
        });
    }
};
