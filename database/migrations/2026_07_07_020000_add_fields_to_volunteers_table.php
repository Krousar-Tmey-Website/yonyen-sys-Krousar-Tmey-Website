<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('volunteers', function (Blueprint $table) {
            $table->date('date_of_birth')->nullable()->after('phone');
            $table->string('gender')->nullable()->after('date_of_birth');
            $table->string('interested_program')->nullable()->after('motivation');
            $table->text('previous_experience')->nullable()->after('interested_program');
            $table->string('emergency_contact')->nullable()->after('resume');
            $table->boolean('agreed_to_terms')->default(false)->after('emergency_contact');
        });
    }

    public function down(): void
    {
        Schema::table('volunteers', function (Blueprint $table) {
            $table->dropColumn([
                'date_of_birth',
                'gender',
                'interested_program',
                'previous_experience',
                'emergency_contact',
                'agreed_to_terms',
            ]);
        });
    }
};
