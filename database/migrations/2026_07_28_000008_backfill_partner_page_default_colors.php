<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Writes the palette that was previously hardcoded in involved.blade.php into the new
     * color columns, cycled by row order, so the public page looks identical the moment this
     * migration runs — before any admin ever opens the new color pickers.
     */
    protected array $palette = [
        ['accent' => '#2d6fa3', 'card_bg' => '#eff6ff', 'icon_bg' => '#dbeafe'],
        ['accent' => '#8da83a', 'card_bg' => '#ecfdf5', 'icon_bg' => '#d1fae5'],
        ['accent' => '#e8a020', 'card_bg' => '#fffbeb', 'icon_bg' => '#fef3c7'],
        ['accent' => '#d32f2f', 'card_bg' => '#fef2f2', 'icon_bg' => '#fee2e2'],
    ];

    public function up(): void
    {
        $this->backfill('partner_principles');
        $this->backfill('partnership_categories');
        $this->backfill('partnership_emphases');
    }

    protected function backfill(string $table): void
    {
        $rows = DB::table($table)->orderBy('sort_order')->orderBy('id')->get(['id']);

        foreach ($rows as $index => $row) {
            $colors = $this->palette[$index % count($this->palette)];

            DB::table($table)->where('id', $row->id)->update([
                'accent_color' => $colors['accent'],
                'card_background_color' => $colors['card_bg'],
                'icon_background_color' => $colors['icon_bg'],
            ]);
        }
    }

    public function down(): void
    {
        foreach (['partner_principles', 'partnership_categories', 'partnership_emphases'] as $table) {
            DB::table($table)->update([
                'accent_color' => null,
                'card_background_color' => null,
                'icon_background_color' => null,
            ]);
        }
    }
};
