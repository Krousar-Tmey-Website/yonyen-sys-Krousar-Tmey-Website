<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_opportunities', function (Blueprint $table) {
            $table->date('posted_date')->nullable()->after('location');
        });
    }

    public function down(): void
    {
        Schema::table('job_opportunities', function (Blueprint $table) {
            $table->dropColumn('posted_date');
        });
    }
};
