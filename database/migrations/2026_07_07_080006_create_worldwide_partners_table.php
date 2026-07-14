<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('worldwide_partners', function (Blueprint $table) {
            $table->id();
            $table->string('country_name');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('learn_more_url')->nullable();
            $table->string('button_text')->default('Learn More');
            $table->integer('display_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('worldwide_partners');
    }
};