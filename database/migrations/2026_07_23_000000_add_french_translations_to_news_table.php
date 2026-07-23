<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->string('title_fr')->nullable()->after('title');
            $table->text('excerpt_fr')->nullable()->after('excerpt');
            $table->longText('content_fr')->nullable()->after('content');
        });
    }

    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn(['title_fr', 'excerpt_fr', 'content_fr']);
        });
    }
};
