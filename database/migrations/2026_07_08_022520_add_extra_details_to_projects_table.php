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
            $table->string('testimony_name')->nullable();
            $table->text('testimony_story')->nullable();
            $table->string('testimony_image')->nullable();
            $table->text('make_difference_text')->nullable();
            $table->string('area_of_work')->nullable();
            $table->string('duration')->nullable();
            $table->string('location')->nullable();
            $table->string('beneficiaries')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'testimony_name', 'testimony_story', 'testimony_image',
                'make_difference_text', 'area_of_work', 'duration',
                'location', 'beneficiaries'
            ]);
        });
    }
};
