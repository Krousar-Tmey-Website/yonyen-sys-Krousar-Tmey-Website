<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partnership_emphases', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_fr')->nullable();
            $table->string('title_km')->nullable();
            $table->text('description')->nullable();
            $table->text('description_fr')->nullable();
            $table->text('description_km')->nullable();
            $table->string('accent_color', 7)->nullable();
            $table->string('card_background_color', 7)->nullable();
            $table->string('icon_background_color', 7)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        DB::table('partnership_emphases')->insert([
            [
                'title' => 'A close relationship',
                'description' => 'Translated by know-how and postures of listening, understanding and exchange / dialogue',
                'sort_order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Adapted & tailored solutions',
                'description' => 'The search for solutions adapted to the problems / needs of partners and indirectly children',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Duration & respect of pace',
                'description' => 'This in the duration and the respect of the rhythm of the partner',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('partnership_emphases');
    }
};
