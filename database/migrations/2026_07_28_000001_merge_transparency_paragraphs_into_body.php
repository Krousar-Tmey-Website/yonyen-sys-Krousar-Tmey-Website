<?php

use App\Models\HomeSetting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Combines the separate per-paragraph Transparency fields (financial_p1..p4,
     * origins_p1..p3) into a single rich-text "body" field per section per
     * language, since the admin page now edits each section with one CKEditor
     * instead of several. Existing customized text is preserved; the "key stat"
     * paragraph (p3) is wrapped in a <blockquote> so it keeps a highlighted look.
     */
    public function up(): void
    {
        foreach (['', '_fr'] as $suffix) {
            $this->mergeGroup("transparency_financial_body{$suffix}", [
                "transparency_financial_p1{$suffix}",
                "transparency_financial_p2{$suffix}",
                "transparency_financial_p3{$suffix}",
                "transparency_financial_p4{$suffix}",
            ], quoteIndex: 2);

            $this->mergeGroup("transparency_origins_body{$suffix}", [
                "transparency_origins_p1{$suffix}",
                "transparency_origins_p2{$suffix}",
                "transparency_origins_p3{$suffix}",
            ], quoteIndex: 2);
        }
    }

    public function down(): void
    {
        HomeSetting::whereIn('key', [
            'transparency_financial_body', 'transparency_financial_body_fr',
            'transparency_origins_body', 'transparency_origins_body_fr',
        ])->delete();
    }

    private function mergeGroup(string $targetKey, array $sourceKeys, int $quoteIndex): void
    {
        $rows = DB::table('home_settings')->whereIn('key', $sourceKeys)->pluck('value', 'key');

        $html = '';
        foreach ($sourceKeys as $i => $key) {
            $value = trim($rows[$key] ?? '');
            if ($value === '') {
                continue;
            }
            if (!str_starts_with($value, '<')) {
                $value = "<p>{$value}</p>";
            }
            if ($i === $quoteIndex) {
                $value = "<blockquote>{$value}</blockquote>";
            }
            $html .= $value;
        }

        if ($html !== '') {
            HomeSetting::updateOrCreate(['key' => $targetKey], ['value' => $html]);
        }
    }
};
