<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tables and their translatable columns.
     * Each column will be converted from text to JSON.
     * Existing plain-text values are automatically migrated to {"en": "value"} format.
     */
    private array $tables = [
        'programs' => [
            'title',
            'description',
            'full_description',
            'testimony_name',
            'testimony_story',
            'Status',
        ],
        'projects' => [
            'title',
            'description',
            'objective',
            'content',
            'activities',
            'testimony_name',
            'testimony_story',
        ],
        'program_page_items' => [
            'title',
            'short_content',
            'objective',
            'detail_content',
            'activities',
        ],
        'news' => [
            'title',
            'slug',
            'excerpt',
            'content',
        ],
        'resource_pages' => [
            'title',
            'description',
            'header_text',
            'detail_description',
        ],
    ];

    public function up(): void
    {
        foreach ($this->tables as $tableName => $columns) {
            if (!Schema::hasTable($tableName)) {
                continue;
            }

            // Step 1: Convert existing plain-text values to JSON format {"en": "value"}
            foreach ($columns as $column) {
                if (!Schema::hasColumn($tableName, $column)) {
                    continue;
                }

                $rows = DB::table($tableName)
                    ->whereNotNull($column)
                    ->where($column, '!=', '')
                    ->get(['id', $column]);

                foreach ($rows as $row) {
                    $value = $row->$column;

                    // Check if it's already valid JSON
                    $decoded = json_decode($value, true);
                    if (is_array($decoded)) {
                        continue; // Already JSON, skip
                    }

                    // Wrap plain text as English translation
                    $jsonValue = json_encode(['en' => $value], JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
                    DB::table($tableName)->where('id', $row->id)->update([$column => $jsonValue]);
                }
            }

            // Step 2: Change column type to JSON
            Schema::table($tableName, function (Blueprint $table) use ($columns) {
                foreach ($columns as $column) {
                    if (Schema::hasColumn($table->getTable(), $column)) {
                        $table->json($column)->nullable()->change();
                    }
                }
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $tableName => $columns) {
            if (!Schema::hasTable($tableName)) {
                continue;
            }

            Schema::table($tableName, function (Blueprint $table) use ($columns) {
                foreach ($columns as $column) {
                    if (Schema::hasColumn($table->getTable(), $column)) {
                        $table->text($column)->nullable()->change();
                    }
                }
            });
        }
    }
};
