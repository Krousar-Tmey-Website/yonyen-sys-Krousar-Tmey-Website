<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // No-op: avoid ALTERs that may conflict with existing auto-increment
        // columns. The categories table is normalized by other migrations and
        // manual fixes should be applied if necessary.
        return;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No-op reverse: nothing to rollback here.
        return;
    }
};