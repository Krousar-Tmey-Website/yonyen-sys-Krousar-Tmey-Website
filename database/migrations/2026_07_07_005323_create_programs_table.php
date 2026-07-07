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
        Schema::table('programs', function (Blueprint $table) {
            $table->string('ProgramID', 50)->nullable()->unique();
            $table->string('ProgramName', 150)->nullable();
            $table->date('StartDate')->nullable();
            $table->date('EndDate')->nullable();
            $table->decimal('Budget', 12, 2)->nullable();
            $table->string('Province')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('programs', function (Blueprint $table) {
            $table->dropUnique(['ProgramID']);
            $table->dropColumn([
                'ProgramID',
                'ProgramName',
                'StartDate',
                'EndDate',
                'Budget',
                'Province',
            ]);
        });
    }
};
