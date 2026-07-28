<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('partner_principles', function (Blueprint $table) {
            $table->string('content_fr')->nullable()->after('content');
            $table->string('content_km')->nullable()->after('content_fr');
            $table->string('accent_color', 7)->nullable()->after('sort_order');
            $table->string('card_background_color', 7)->nullable()->after('accent_color');
            $table->string('icon_background_color', 7)->nullable()->after('card_background_color');
        });
    }

    public function down(): void
    {
        Schema::table('partner_principles', function (Blueprint $table) {
            $table->dropColumn(['content_fr', 'content_km', 'accent_color', 'card_background_color', 'icon_background_color']);
        });
    }
};
