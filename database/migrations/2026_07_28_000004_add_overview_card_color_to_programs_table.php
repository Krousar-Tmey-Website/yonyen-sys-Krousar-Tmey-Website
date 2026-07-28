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
            if (!Schema::hasColumn('programs', 'overview_card_color')) {
                $table->string('overview_card_color', 7)->nullable()->after('accent_color');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('programs')) {
            return;
        }

        Schema::table('programs', function (Blueprint $table) {
            if (Schema::hasColumn('programs', 'overview_card_color')) {
                $table->dropColumn('overview_card_color');
            }
        });
    }
};
