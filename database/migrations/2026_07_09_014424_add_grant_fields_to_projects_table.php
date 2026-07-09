<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('grant_label')->nullable()->after('make_difference_text');
            $table->decimal('grant_amount', 10, 2)->nullable()->after('grant_label');
            $table->string('grant_recipient')->nullable()->after('grant_amount');
        });
    }
    public function down(): void {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['grant_label', 'grant_amount', 'grant_recipient']);
        });
    }
};
