<?php

use App\Models\Partner;
use App\Models\PartnerCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Map of old string category values to new PartnerCategory names
     */
    private const CATEGORY_MAP = [
        'authorities'    => 'Authorities',
        'organizations'  => 'Organizations',
        'companies'      => 'Companies',
        'towns'          => 'Towns',
    ];

    public function up(): void
    {
        // First ensure default categories exist
        foreach (self::CATEGORY_MAP as $name) {
            PartnerCategory::firstOrCreate(['name' => $name]);
        }

        // Add the column (nullable temporarily)
        Schema::table('partners', function (Blueprint $table) {
            $table->foreignId('category_id')
                ->nullable()
                ->after('id')
                ->constrained('partner_categories')
                ->cascadeOnDelete();
        });

        // Migrate existing string categories to the new FK
        foreach (self::CATEGORY_MAP as $oldValue => $newName) {
            $category = PartnerCategory::where('name', $newName)->first();
            if ($category) {
                Partner::where('category', $oldValue)
                    ->whereNull('category_id')
                    ->update(['category_id' => $category->id]);
            }
        }

        // For any remaining partners without a category, assign to the first category
        $firstCategory = PartnerCategory::first();
        if ($firstCategory) {
            Partner::whereNull('category_id')->update(['category_id' => $firstCategory->id]);
        }

        // Now make the column required (non-nullable) for future rows
        Schema::table('partners', function (Blueprint $table) {
            $table->foreignId('category_id')
                ->nullable(false)
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
