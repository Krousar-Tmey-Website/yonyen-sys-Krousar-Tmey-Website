<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ResourcePage extends Model
{
    protected $fillable = [
        'title', 'slug', 'description',
        'image', 'header_text', 'detail_image', 'detail_description',
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

    // Feature items with their stored image paths resolved to full URLs
    public function getItemsForDisplayAttribute(): array
    {
        return array_map(function (array $item) {
            $item['image_url'] = !empty($item['image'])
                ? (str_starts_with($item['image'], 'http') ? $item['image'] : asset('storage/' . $item['image']))
                : null;
            return $item;
        }, $this->items ?? []);
    }
}
