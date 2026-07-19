<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partnership_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        DB::table('partnership_categories')->insert([
            ['name' => 'Organizations from associative sector', 'sort_order' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Local education structures', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Research institutes', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Universities / Training institutes', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Public services', 'sort_order' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Companies and foundations from private sector', 'sort_order' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('partnership_categories');
    }
};
