<?php

use App\Models\HomeSetting;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Reverses the previous merge: pulls the "Our French and Swiss
     * organisations' accounts are also audited annually." sentence back out
     * of the Financial Transparency body editor into its own field, since it
     * needs to render below the audited-statements file list rather than
     * inline with the rest of the paragraph text.
     */
    private const SNIPPET = "<p>Our French and Swiss organisations' accounts are also audited annually.</p>";

    public function up(): void
    {
        foreach (['', '_fr'] as $suffix) {
            $bodyKey = "transparency_financial_body{$suffix}";
            $outroKey = "transparency_financial_outro{$suffix}";

            $body = HomeSetting::getValue($bodyKey, '');
            if ($body === '' || !str_contains($body, self::SNIPPET)) {
                continue;
            }

            HomeSetting::setValue($bodyKey, str_replace(self::SNIPPET, '', $body));
            HomeSetting::setValue($outroKey, self::SNIPPET);
        }
    }

    public function down(): void
    {
        foreach (['', '_fr'] as $suffix) {
            $bodyKey = "transparency_financial_body{$suffix}";
            $outroKey = "transparency_financial_outro{$suffix}";

            $outro = HomeSetting::getValue($outroKey, '');
            if ($outro === '') {
                continue;
            }

            HomeSetting::setValue($bodyKey, HomeSetting::getValue($bodyKey, '') . $outro);
        }
    }
};
