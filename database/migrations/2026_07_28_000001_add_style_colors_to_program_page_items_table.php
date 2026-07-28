<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('program_page_items')) {
            return;
        }

        Schema::table('program_page_items', function (Blueprint $table) {
            if (!Schema::hasColumn('program_page_items', 'accent_color')) {
                $table->string('accent_color', 7)->nullable()->after('image_3');
            }

            if (!Schema::hasColumn('program_page_items', 'card_background_color')) {
                $table->string('card_background_color', 7)->nullable()->after('accent_color');
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('program_page_items')) {
            return;
        }

        Schema::table('program_page_items', function (Blueprint $table) {
            $columns = array_filter(
                ['accent_color', 'card_background_color'],
                fn (string $column): bool => Schema::hasColumn('program_page_items', $column)
            );

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
