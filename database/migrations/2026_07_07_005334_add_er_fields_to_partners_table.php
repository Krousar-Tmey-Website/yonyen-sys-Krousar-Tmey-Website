<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->string('PartnerLogo')->nullable();
            $table->string('Email')->nullable();
            $table->string('Phone')->nullable();
            $table->string('WebsiteURL')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn(['PartnerLogo', 'Email', 'Phone', 'WebsiteURL']);
        });
    }
};
