<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('programs')) {
            return;
        }

        Schema::table('programs', function (Blueprint $table) {
            if (!Schema::hasColumn('programs', 'details_background_color')) {
                $table->string('details_background_color', 7)->nullable()->after('card_background_color');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('programs')) {
            return;
        }

        Schema::table('programs', function (Blueprint $table) {
            if (Schema::hasColumn('programs', 'details_background_color')) {
                $table->dropColumn('details_background_color');
            }
        });
    }
};
