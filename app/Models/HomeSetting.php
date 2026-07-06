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

    public static function setValue(string $key, string $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public static function allKeyed(): array
    {
        return static::pluck('value', 'key')->toArray();
    }
}
