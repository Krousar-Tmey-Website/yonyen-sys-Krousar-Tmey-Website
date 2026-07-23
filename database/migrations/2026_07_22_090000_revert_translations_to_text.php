<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tables and their translatable columns to revert.
     */
    private array $tables = [
        'programs' => [
            'title', 'description', 'full_description', 'testimony_name', 'testimony_story', 'Status',
        ],
        'projects' => [
            'title', 'description', 'objective', 'content', 'activities', 'testimony_name', 'testimony_story',
        ],
        'program_page_items' => [
            'title', 'short_content', 'objective', 'detail_content', 'activities',
        ],
        'news' => [
            'title', 'excerpt', 'content',
        ],
        'resource_pages' => [
            'title', 'description', 'header_text', 'detail_description',
        ],
    ];

    public function up(): void
    {
        foreach ($this->tables as $tableName => $columns) {
            if (!Schema::hasTable($tableName)) {
                continue;
            }

            // Step 1: Change column type from JSON to TEXT FIRST.
            // This automatically drops any CHECK(json_valid(...)) constraints
            // because MODIFY COLUMN replaces the entire column definition.
            foreach ($columns as $column) {
                if (!Schema::hasColumn($tableName, $column)) {
                    continue;
                }

                try {
                    DB::statement("ALTER TABLE `{$tableName}` MODIFY `{$column}` LONGTEXT NULL");
                } catch (\Exception $e) {
                    try {
                        DB::statement("ALTER TABLE `{$tableName}` MODIFY `{$column}` TEXT NULL");
                    } catch (\Exception $e2) {
                        echo "Warning: Could not modify column {$tableName}.{$column}: " . $e2->getMessage() . "\n";
                    }
                }
            }

            // Step 2: Convert JSON data back to plain text (extract English content)
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
                    $decoded = json_decode($value, true);

                    if (is_array($decoded)) {
                        $plainText = $decoded['en'] ?? $decoded[array_key_first($decoded)] ?? '';
                        DB::table($tableName)->where('id', $row->id)->update([$column => $plainText]);
                    }
                }
            }
        }
    }

    public function down(): void
    {
        // Not needed for this revert
    }
};
