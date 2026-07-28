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
            if (!Schema::hasColumn('programs', 'accent_color')) {
                $table->string('accent_color', 7)->nullable()->after('image');
            }

            if (!Schema::hasColumn('programs', 'card_background_color')) {
                $table->string('card_background_color', 7)->nullable()->after('accent_color');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('programs')) {
            return;
        }

        Schema::table('programs', function (Blueprint $table) {
            $columns = array_filter(
                ['accent_color', 'card_background_color'],
                fn (string $column): bool => Schema::hasColumn('programs', $column)
            );

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
