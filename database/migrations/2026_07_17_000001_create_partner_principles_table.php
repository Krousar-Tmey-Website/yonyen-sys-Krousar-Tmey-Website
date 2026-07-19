<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partner_principles', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        DB::table('partner_principles')->insert([
            ['content' => 'Trust and respect', 'sort_order' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['content' => 'Compliance with commitments', 'sort_order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['content' => 'Reciprocity', 'sort_order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['content' => 'Equality of power in the relationship', 'sort_order' => 3, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('partner_principles');
    }
};
