<?php

namespace App\Http\Controllers\Admin\Concerns;

/**
 * Shared hex-color validation/normalization for the card-color pickers on the
 * Partner Principles / Dynamic Emphasis / Partnership Categories admin forms —
 * same rules App\Http\Controllers\Admin\ImpactStatisticController uses for its
 * own (unrelated) color fields.
 */
trait HasHexColorFields
{
    protected function colorFields(): array
    {
        return ['accent_color', 'card_background_color', 'icon_background_color'];
    }

    protected function colorValidationRules(): array
    {
        $hexRule = ['nullable', 'regex:/^#(?:[0-9a-fA-F]{3}){1,2}$/'];

        return array_fill_keys($this->colorFields(), $hexRule);
    }

    protected function normalizeColorFields(array $data): array
    {
        foreach ($this->colorFields() as $field) {
            $data[$field] = $this->normalizeHexColor($data[$field] ?? null);
        }

        return $data;
    }

    protected function normalizeHexColor(?string $color): ?string
    {
        if ($color === null || $color === '') {
            return null;
        }

        $color = strtolower($color);

        if (strlen($color) === 4) {
            return '#'.$color[1].$color[1].$color[2].$color[2].$color[3].$color[3];
        }

        return $color;
    }
}
