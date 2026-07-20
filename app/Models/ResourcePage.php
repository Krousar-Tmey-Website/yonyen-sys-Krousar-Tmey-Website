<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ResourcePage extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'image',
        'header_text', 'detail_image', 'detail_description', 'items',
        'sort_order', 'is_active',
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
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('title');
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->resolveUrl($this->image);
    }

    public function getDetailImageUrlAttribute(): ?string
    {
        return $this->resolveUrl($this->detail_image);
    }

    public function getItemsAttribute(mixed $value): array
    {
        if (is_null($value) || $value === '') {
            return [];
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }

        return (array) $value;
    }

    public function getItemsForDisplayAttribute(): array
    {
        return array_map(function (array $item) {
            $item['image_url'] = !empty($item['image']) ? $this->resolveUrl($item['image']) : null;
            return $item;
        }, $this->items);
    }

    private function resolveUrl(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        return str_starts_with($path, 'http') ? $path : asset('storage/' . $path);
    }
}
