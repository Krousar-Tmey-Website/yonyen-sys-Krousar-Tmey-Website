<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('volunteers', function (Blueprint $table) {
            $table->text('address')->nullable()->after('country');
            $table->string('availability')->nullable()->after('address');
        });

        // Modify the status enum to include new values
        DB::statement("ALTER TABLE volunteers MODIFY COLUMN status ENUM('Pending', 'Under Review', 'Interview Scheduled', 'Approved', 'Rejected') DEFAULT 'Pending'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE volunteers MODIFY COLUMN status ENUM('Pending', 'Approved', 'Rejected') DEFAULT 'Pending'");

        Schema::table('volunteers', function (Blueprint $table) {
            $table->dropColumn(['address', 'availability']);
        });
    }
};
