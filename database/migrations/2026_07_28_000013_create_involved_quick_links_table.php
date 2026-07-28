<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('involved_quick_links', function (Blueprint $table) {
            $table->id();
            $table->string('icon_key', 30)->default('briefcase');
            $table->string('title');
            $table->string('title_km')->nullable();
            $table->text('description')->nullable();
            $table->text('description_km')->nullable();
            $table->string('link_url')->default('#');
            $table->string('accent_color', 7)->nullable();
            $table->string('card_background_color', 7)->nullable();
            $table->string('icon_background_color', 7)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        DB::table('involved_quick_links')->insert([
            [
                'icon_key' => 'briefcase',
                'title' => 'Partner',
                'description' => 'Formalize a CSR or institutional partnership to empower Cambodian communities.',
                'link_url' => '#partner',
                'accent_color' => '#2d6fa3',
                'icon_background_color' => '#f0f9ff',
                'sort_order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon_key' => 'heart',
                'title' => 'Volunteer',
                'description' => 'Contribute your expertise, skills, and time for a minimum of 3 months.',
                'link_url' => '#volunteer',
                'accent_color' => '#8da83a',
                'icon_background_color' => '#ecfdf5',
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon_key' => 'people',
                'title' => 'Work With Us',
                'description' => 'Join our Cambodian team across social work, education, and communications.',
                'link_url' => '#jobs',
                'accent_color' => '#e8a020',
                'icon_background_color' => '#fffbeb',
                'sort_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'icon_key' => 'book',
                'title' => 'Book for Sales',
                'description' => 'Browse our curated collection of books and support children directly.',
                'link_url' => '#book-for-sales',
                'accent_color' => '#d32f2f',
                'icon_background_color' => '#fef2f2',
                'sort_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('involved_quick_links');
    }
};
