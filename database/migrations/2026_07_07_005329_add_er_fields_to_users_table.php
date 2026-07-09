<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('AdminID', 50)->nullable()->unique();
            $table->string('Role', 100)->nullable();
            $table->boolean('Status')->default(true);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['AdminID']);
            $table->dropColumn(['AdminID', 'Role', 'Status']);
        });
    }
};
