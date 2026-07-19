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

    // Ensure items is always an array of ['title' => ..., 'description' => ..., 'image' => ...]
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

    // Encode array assignment to JSON for storage
    public function setItemsAttribute(mixed $value): void
    {
        $this->attributes['items'] = is_array($value) ? json_encode($value) : $value;
    }

    // Same items array, but with each image path resolved to a full URL for display
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
