<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorldwidePartner extends Model
{
    protected $fillable = [
        'country_name', 'country_name_fr', 'description', 'description_fr', 'image', 'learn_more_url',
        'button_text', 'button_text_fr', 'display_order', 'is_featured', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('display_order')->orderBy('id');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? (str_starts_with($this->image, 'http') ? $this->image : asset('storage/' . $this->image)) : asset('images/office-placeholder.jpg');
    }

    // French text falls back to the English field whenever it hasn't been filled in yet.
    public function getLocalizedCountryNameAttribute(): ?string
    {
        return $this->localized('country_name');
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        return $this->localized('description');
    }

    public function getLocalizedButtonTextAttribute(): ?string
    {
        return $this->localized('button_text');
    }

    private function localized(string $field): ?string
    {
        if (session('locale') === 'fr' && !empty($this->{$field . '_fr'})) {
            return $this->{$field . '_fr'};
        }

        return $this->{$field};
    }
}