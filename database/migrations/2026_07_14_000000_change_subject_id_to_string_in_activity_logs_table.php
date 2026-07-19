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
        Schema::table('activity_logs', function (Blueprint $table) {
            // Drop the existing index that references subject_id
            $table->dropIndex(['subject_type', 'subject_id']);

            // Change subject_id from unsignedBigInteger to string
            // to support string primary keys (e.g. Donation::DonationID, Donor::DonorID)
            $table->string('subject_id', 50)->nullable()->change();

            // Re-create the index
            $table->index(['subject_type', 'subject_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropIndex(['subject_type', 'subject_id']);

            $table->unsignedBigInteger('subject_id')->nullable()->change();

            $table->index(['subject_type', 'subject_id']);
        });
    }
};
