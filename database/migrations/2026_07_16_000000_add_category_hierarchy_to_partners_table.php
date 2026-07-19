<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Maps the old partner_categories rows (which were really the four
     * Financial Partner subcategories) onto the new subcategory labels.
     */
    private const SUBCATEGORY_MAP = [
        'Authorities'   => 'Cambodian Public Authorities',
        'Organizations' => 'Organizations, Foundations and Institutions',
        'Companies'     => 'Companies',
        'Towns'         => 'Towns and Municipalities',
    ];

    public function up(): void
    {
        Schema::table('partners', function (Blueprint $table) {
            $table->string('category')->nullable()->after('name');
            $table->string('subcategory')->nullable()->after('category');
        });

        if (Schema::hasTable('partner_categories') && Schema::hasColumn('partners', 'category_id')) {
            $categories = DB::table('partner_categories')->pluck('name', 'id');

            foreach ($categories as $id => $name) {
                $subcategory = self::SUBCATEGORY_MAP[$name] ?? null;

                if ($subcategory === null) {
                    continue;
                }

                DB::table('partners')
                    ->where('category_id', $id)
                    ->update([
                        'category'    => 'Financial Partners',
                        'subcategory' => $subcategory,
                    ]);
            }
        }

        if (Schema::hasColumn('partners', 'category_id')) {
            Schema::table('partners', function (Blueprint $table) {
                $table->dropForeign(['category_id']);
                $table->dropColumn('category_id');
            });
        }

        Schema::dropIfExists('partner_categories');
    }

    public function down(): void
    {
        Schema::create('partner_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        $now = now();
        DB::table('partner_categories')->insert(
            collect(array_keys(self::SUBCATEGORY_MAP))
                ->map(fn ($name) => ['name' => $name, 'created_at' => $now, 'updated_at' => $now])
                ->all()
        );

        Schema::table('partners', function (Blueprint $table) {
            $table->foreignId('category_id')
                ->nullable()
                ->after('id')
                ->constrained('partner_categories')
                ->nullOnDelete();
        });

        $categoryIds = DB::table('partner_categories')->pluck('id', 'name');

        foreach (self::SUBCATEGORY_MAP as $oldName => $subcategoryLabel) {
            $id = $categoryIds[$oldName] ?? null;

            if ($id === null) {
                continue;
            }

            DB::table('partners')
                ->where('subcategory', $subcategoryLabel)
                ->update(['category_id' => $id]);
        }

        Schema::table('partners', function (Blueprint $table) {
            $table->dropColumn(['category', 'subcategory']);
        });
    }
};
