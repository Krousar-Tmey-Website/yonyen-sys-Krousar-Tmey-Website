<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            if (!Schema::hasColumn('partners', 'description')) {
                $table->text('description')->nullable()->after('subcategory');
            }
            if (!Schema::hasColumn('partners', 'website_url') && !Schema::hasColumn('partners', 'WebsiteURL')) {
                $table->string('website_url')->nullable()->after('description');
            }
        });
    }

    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn(['description', 'website_url']);
        });
    }
};
