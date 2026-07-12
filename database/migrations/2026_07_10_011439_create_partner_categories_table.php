<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('partner_categories')) {
            Schema::create('partner_categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->timestamps();
            });

            DB::table('partner_categories')->insert([
                ['name' => 'Authorities'],
                ['name' => 'Organizations'],
                ['name' => 'Companies'],
                ['name' => 'Towns'],
            ]);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('partner_categories');
    }
};
