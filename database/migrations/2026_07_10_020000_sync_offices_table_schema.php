<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('offices', function (Blueprint $table) {
            // Add columns expected by the model/views
            if (!Schema::hasColumn('offices', 'city')) {
                $table->string('city')->nullable()->after('country');
            }
            if (!Schema::hasColumn('offices', 'badge')) {
                $table->string('badge')->nullable()->after('flag');
            }
            if (!Schema::hasColumn('offices', 'accent_color')) {
                $table->string('accent_color')->default('border-[#2d6fa3]')->after('email');
            }
            if (!Schema::hasColumn('offices', 'badge_color')) {
                $table->string('badge_color')->default('bg-[#2d6fa3] text-white')->after('accent_color');
            }
        });

        // Copy name -> city for existing records, then drop name
        if (Schema::hasColumn('offices', 'name') && Schema::hasColumn('offices', 'city')) {
            DB::table('offices')->whereNull('city')->update(['city' => DB::raw('`name`')]);
            Schema::table('offices', function (Blueprint $table) {
                $table->dropColumn('name');
            });
        }
    }

    public function down(): void
    {
        Schema::table('offices', function (Blueprint $table) {
            $table->string('name')->nullable()->after('id');
            $columns = [];
            foreach (['city', 'badge', 'accent_color', 'badge_color'] as $col) {
                if (Schema::hasColumn('offices', $col)) {
                    $columns[] = $col;
                }
            }
            if (!empty($columns)) {
                $table->dropColumn($columns);
            }
        });
    }
};
