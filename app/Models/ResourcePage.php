<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ResourcePage extends Model
{
    protected $fillable = [
        'title', 'title_fr', 'slug', 'description', 'description_fr',
        'image', 'header_text', 'header_text_fr', 'detail_image', 'detail_description', 'detail_description_fr',
        'items', 'sort_order', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'items'     => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive(Builder $query)
    {
        return $query->where('is_active', true);
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

    public function getLocalizedHeaderTextAttribute(): ?string
    {
        return $this->localized('header_text');
    }

    public function getLocalizedDetailDescriptionAttribute(): ?string
    {
        return $this->localized('detail_description');
    }

    private function localized(string $field): ?string
    {
        if (session('locale') === 'fr' && !empty($this->{$field . '_fr'})) {
            return $this->{$field . '_fr'};
        }

        return $this->{$field};
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }
        return str_starts_with($this->image, 'http')
            ? $this->image
            : asset('storage/' . $this->image);
    }

    public function getDetailImageUrlAttribute(): ?string
    {
        if (!$this->detail_image) {
            return null;
        }
        return str_starts_with($this->detail_image, 'http')
            ? $this->detail_image
            : asset('storage/' . $this->detail_image);
    }

    // Feature items with their stored image paths resolved to full URLs and
    // their title/description resolved to the French value when available.
    public function getItemsForDisplayAttribute(): array
    {
        return array_map(function (array $item) {
            $item['image_url'] = !empty($item['image'])
                ? (str_starts_with($item['image'], 'http') ? $item['image'] : asset('storage/' . $item['image']))
                : null;

            if (session('locale') === 'fr' && !empty($item['title_fr'])) {
                $item['title'] = $item['title_fr'];
            }
            if (session('locale') === 'fr' && !empty($item['description_fr'])) {
                $item['description'] = $item['description_fr'];
            }

            return $item;
        }, $this->items ?? []);
    }
}
