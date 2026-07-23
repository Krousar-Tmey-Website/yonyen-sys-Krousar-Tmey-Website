<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('map_projects', function (Blueprint $table) {
            $table->id();
            $table->string('province_key');          // e.g. 'banteay-meanchey'
            $table->string('province_label');        // e.g. 'Banteay Meanchey'
            $table->string('location_name');         // e.g. 'Poipet'
            $table->string('project_type');          // e.g. '🦋 Child Welfare'
            $table->integer('sort_order')->default(0);
            $table->timestamps();

            $table->index('province_key');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('map_projects');
    }
};
