<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('impact_statistics')) {
            return;
        }

        Schema::table('impact_statistics', function (Blueprint $table) {
            if (!Schema::hasColumn('impact_statistics', 'card_background_color')) {
                $table->string('card_background_color', 7)->nullable()->after('accent_color');
            }

            if (!Schema::hasColumn('impact_statistics', 'card_border_color')) {
                $table->string('card_border_color', 7)->nullable()->after('card_background_color');
            }

            if (!Schema::hasColumn('impact_statistics', 'icon_background_color')) {
                $table->string('icon_background_color', 7)->nullable()->after('card_border_color');
            }

            if (!Schema::hasColumn('impact_statistics', 'value_color')) {
                $table->string('value_color', 7)->nullable()->after('icon_background_color');
            }

            if (!Schema::hasColumn('impact_statistics', 'label_color')) {
                $table->string('label_color', 7)->nullable()->after('value_color');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('impact_statistics')) {
            return;
        }

        Schema::table('impact_statistics', function (Blueprint $table) {
            $columns = array_filter(
                [
                    'card_background_color',
                    'card_border_color',
                    'icon_background_color',
                    'value_color',
                    'label_color',
                ],
                fn (string $column): bool => Schema::hasColumn('impact_statistics', $column)
            );

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
