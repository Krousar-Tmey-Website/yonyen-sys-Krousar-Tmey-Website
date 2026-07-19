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
        Schema::create('contact_inquiries', function (Blueprint $table) {
            $table->string('InquiryID', 50)->primary();

            $table->string('Name');
            $table->string('Email');
            $table->string('Subject', 200);
            $table->text('Message');
            $table->date('ReceivedDate');
            $table->string('Status');
            $table->string('TargetEntity');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_inquiries');
    }
};
