<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('links', function (Blueprint $table) {

            $table->id();

            $table->foreignId('section_id')
                  ->constrained('page_sections')
                  ->cascadeOnDelete();


            $table->string('text');
            // Button name
            // Example: Read more


            $table->string('url');


            $table->enum('type', [
                'button',
                'text',
                'video',
                'external'
            ])
            ->default('button');


            $table->string('target')
                  ->default('_self');


            $table->integer('order')
                  ->default(0);


            $table->boolean('active')
                  ->default(true);


            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};