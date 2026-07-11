<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    protected $fillable = ['key', 'value', 'label', 'group'];

    public static function getValue(string $key, string $default = ''): string
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    public static function setValue(string $key, ?string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value ?? '']);
    }

    public static function allKeyed(): array
    {
        return static::pluck('value', 'key')->toArray();
    }

    public static function getStats(): array
    {
        $settings = static::allKeyed();

        $children = static::formatCompactStat($settings['stat_children'] ?? '10000', true);
        $employees = static::formatPlainStat($settings['stat_employees'] ?? '70');
        $budget = static::formatBudget($settings['stat_budget'] ?? '950000');
        $provinces = static::formatPlainStat($settings['stat_provinces'] ?? '15');

        return [
            'children' => $children,
            'employees' => $employees,
            'budget' => $budget,
            'provinces' => $provinces,
        ];
    }

    protected static function formatCompactStat(string $value, bool $usePlusPrefix = false): array
    {
        $raw = trim((string) $value);
        $normalized = strtoupper($raw);
        $number = (int) preg_replace('/[^0-9]/', '', $raw);

        if (str_contains($normalized, 'K')) {
            $displayValue = $raw;
            $numericValue = $number * 1000;
        } elseif ($number > 0 && $number < 1000 && !str_contains($raw, ',')) {
            $displayValue = static::formatCompact($number * 1000);
            $numericValue = $number * 1000;
        } elseif ($number >= 1000) {
            $displayValue = static::formatCompact($number);
            $numericValue = $number;
        } else {
            $displayValue = static::formatCompact($number * 1000);
            $numericValue = $number * 1000;
        }

        if ($usePlusPrefix && $numericValue > 0 && !str_starts_with($displayValue, '+')) {
            $displayValue = '+' . $displayValue;
        }

        return [
            'number' => $numericValue,
            'display' => $displayValue,
        ];
    }

    protected static function formatPlainStat(string $value): array
    {
        $number = (int) preg_replace('/[^0-9]/', '', (string) $value);

        return [
            'number' => $number ?: 0,
            'display' => (string) ($number ?: 0),
        ];
    }

    protected static function formatBudget(string $value): array
    {
        $raw = trim((string) $value);
        $normalized = strtoupper($raw);
        $number = (int) preg_replace('/[^0-9]/', '', $raw);

        if (str_contains($normalized, 'K')) {
            return [
                'number' => $number * 1000,
                'display' => '$' . $raw,
            ];
        }

        if ($number >= 1000) {
            return [
                'number' => $number,
                'display' => '$' . static::formatCompact($number),
            ];
        }

        return [
            'number' => $number * 1000,
            'display' => '$' . static::formatCompact($number * 1000),
        ];
    }

    protected static function formatCompact(int $value): string
    {
        if ($value >= 1000) {
            $k = $value / 1000;
            if (floor($k) == $k) {
                return number_format($k, 0) . 'K';
            }

            if ($k < 10) {
                return rtrim(rtrim(number_format($k, 1), '0'), '.') . 'K';
            }

            return number_format($k, 0) . 'K';
        }

        return number_format($value);
    }
}
