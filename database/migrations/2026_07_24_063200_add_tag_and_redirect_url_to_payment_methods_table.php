<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            if (!Schema::hasColumn('payment_methods', 'tag')) {
                $table->string('tag')->default('cambodia')->after('is_active');
            }

            if (!Schema::hasColumn('payment_methods', 'redirect_url')) {
                $table->string('redirect_url', 500)->nullable()->after('tag');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            $columns = array_filter(
                ['tag', 'redirect_url'],
                fn (string $column): bool => Schema::hasColumn('payment_methods', $column)
            );

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
