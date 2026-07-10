<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            // Drop the old foreign key constraint (named from original category_id column)
            $table->dropForeign('partners_category_id_foreign');
            // Change column from bigint unsigned to varchar(100)
            $table->string('category', 100)->change();
        });
    }

    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            // Cannot reliably revert without knowing the partner_categories schema
            // Just set it back to string to avoid data loss
            $table->string('category', 100)->change();
        });
    }
};
