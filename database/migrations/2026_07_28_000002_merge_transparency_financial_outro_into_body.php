<?php

use App\Models\HomeSetting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Folds the "Closing Line" (transparency_financial_outro) into the single
     * Financial Transparency body editor, since the admin page now edits that
     * section with just one CKEditor instead of a body field plus a separate
     * closing-line field.
     */
    public function up(): void
    {
        foreach (['', '_fr'] as $suffix) {
            $rows = DB::table('home_settings')
                ->whereIn('key', ["transparency_financial_body{$suffix}", "transparency_financial_outro{$suffix}"])
                ->pluck('value', 'key');

            $outro = trim($rows["transparency_financial_outro{$suffix}"] ?? '');
            if ($outro === '') {
                continue;
            }
            if (!str_starts_with($outro, '<')) {
                $outro = "<p>{$outro}</p>";
            }

            $body = trim($rows["transparency_financial_body{$suffix}"] ?? '');
            HomeSetting::updateOrCreate(
                ['key' => "transparency_financial_body{$suffix}"],
                ['value' => $body . $outro]
            );
        }
    }

    public function down(): void
    {
        // No-op: the outro text remains merged into the body field.
    }
};
