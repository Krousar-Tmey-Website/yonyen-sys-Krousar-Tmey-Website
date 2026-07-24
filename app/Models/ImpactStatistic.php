<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImpactStatistic extends Model
{
    protected $fillable = [
        'value',
        'label',
        'label_fr',
        'description',
        'description_fr',
        'image',
        'sort_order',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    public static function active()
    {
        return static::where('is_active', true)->orderBy('sort_order');
    }

    public static function featured()
    {
        return static::where('is_featured', true)->where('is_active', true)->first();
    }

    // French text falls back to the English field whenever it hasn't been filled in yet.
    public function getLocalizedLabelAttribute(): ?string
    {
        return $this->localized('label');
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        return $this->localized('description');
    }

    private function localized(string $field): ?string
    {
        if (session('locale') === 'fr' && !empty($this->{$field . '_fr'})) {
            return $this->{$field . '_fr'};
        }

        return $this->{$field};
    }
}
