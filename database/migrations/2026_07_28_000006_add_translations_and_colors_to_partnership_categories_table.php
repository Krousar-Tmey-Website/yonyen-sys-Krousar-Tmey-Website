<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('partnership_categories', function (Blueprint $table) {
            $table->string('name_fr')->nullable()->after('name');
            $table->string('name_km')->nullable()->after('name_fr');
            $table->text('description_fr')->nullable()->after('description');
            $table->text('description_km')->nullable()->after('description_fr');
            $table->string('accent_color', 7)->nullable()->after('sort_order');
            $table->string('card_background_color', 7)->nullable()->after('accent_color');
            $table->string('icon_background_color', 7)->nullable()->after('card_background_color');
        });
    }

    public function down(): void
    {
        Schema::table('partnership_categories', function (Blueprint $table) {
            $table->dropColumn([
                'name_fr', 'name_km', 'description_fr', 'description_km',
                'accent_color', 'card_background_color', 'icon_background_color',
            ]);
        });
    }
};
