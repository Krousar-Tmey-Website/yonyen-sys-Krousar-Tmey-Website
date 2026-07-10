<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // No-op: `links` column already exists on `news` (created in create_news_table).
    }

    public function down(): void
    {
        // No-op
    }
};