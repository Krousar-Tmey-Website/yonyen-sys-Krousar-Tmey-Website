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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('make_difference_title')->nullable()->after('make_difference_text');
            $table->string('donate_button_text')->nullable()->after('make_difference_title');
            $table->string('contact_button_text')->nullable()->after('donate_button_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'make_difference_title',
                'donate_button_text',
                'contact_button_text'
            ]);
        });
    }
};
