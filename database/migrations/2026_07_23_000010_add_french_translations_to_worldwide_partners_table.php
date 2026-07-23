<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('worldwide_partners', function (Blueprint $table) {
            $table->string('country_name_fr')->nullable()->after('country_name');
            $table->text('description_fr')->nullable()->after('description');
            $table->string('button_text_fr')->nullable()->after('button_text');
        });
    }

    public function down(): void
    {
        Schema::table('worldwide_partners', function (Blueprint $table) {
            $table->dropColumn(['country_name_fr', 'description_fr', 'button_text_fr']);
        });
    }
};
