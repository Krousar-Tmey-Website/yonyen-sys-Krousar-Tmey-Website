<?php

use App\Models\Partner;
use App\Models\PartnerCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Replace the old `category` varchar column with a proper
     * `category_id` foreign key column referencing partner_categories.
     */
    public function up(): void
    {
        // Only run if the old `category` column still exists
        // and `category_id` does not already exist.
        if (! Schema::hasColumn('partners', 'category') || Schema::hasColumn('partners', 'category_id')) {
            return;
        }

        // 1. Ensure the default categories exist (in case the earlier migration was skipped)
        foreach (['Authorities', 'Organizations', 'Companies', 'Towns'] as $name) {
            PartnerCategory::firstOrCreate(['name' => $name]);
        }

        // 2. Add the new FK column (nullable while we migrate data)
        Schema::table('partners', function (Blueprint $table) {
            $table->foreignId('category_id')
                ->nullable()
                ->after('id')
                ->constrained('partner_categories')
                ->nullOnDelete();
        });

        // 3. Migrate existing string category values to the new FK
        $partners = Partner::whereNotNull('category')->get();
        foreach ($partners as $partner) {
            $category = PartnerCategory::where('name', $partner->category)->first();
            if ($category) {
                $partner->category_id = $category->id;
                $partner->save();
            }
        }

        // 4. Drop the obsolete varchar column
        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }

    public function down(): void
    {
        // Re-add the `category` varchar column and repopulate it from names
        Schema::table('partners', function (Blueprint $table) {
            $table->string('category')->nullable()->after('name');
        });

        $partners = Partner::whereNotNull('category_id')->get();
        foreach ($partners as $partner) {
            $category = PartnerCategory::find($partner->category_id);
            if ($category) {
                $partner->category = $category->name;
                $partner->save();
            }
        }

        Schema::table('partners', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
