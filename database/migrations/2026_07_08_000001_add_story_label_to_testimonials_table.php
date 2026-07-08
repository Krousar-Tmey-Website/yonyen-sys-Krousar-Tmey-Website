<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->string('label')->nullable()->after('name');   // e.g. "TESTIMONY"
            $table->text('story')->nullable()->after('content');  // long expanded story
            $table->integer('sort_order')->default(0)->after('is_active');
        });
    }
    public function down(): void {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['label', 'story', 'sort_order']);
        });
    }
};
