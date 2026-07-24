<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'title_fr',
        'slug',
        'description',
        'description_fr',
        'price',
        'stock',
        'cover_image',
        'is_available',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'price'        => 'decimal:2',
            'stock'        => 'integer',
            'is_available' => 'boolean',
            'sort_order'   => 'integer',
        ];
    }

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }

    // French text falls back to the English field whenever it hasn't been filled in yet.
    public function getLocalizedTitleAttribute(): string
    {
        return $this->localized('title');
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

    public function getCoverImageUrlAttribute(): ?string
    {
        if (!$this->cover_image) {
            return null;
        }

        return str_starts_with($this->cover_image, 'http')
            ? $this->cover_image
            : asset('storage/' . $this->cover_image);
    }

    public function getFormattedPriceAttribute(): string
    {
        return '$' . number_format($this->price, 2);
    }
}
