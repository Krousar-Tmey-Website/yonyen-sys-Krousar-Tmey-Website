<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ResourcePage extends Model
{
    protected $table = 'resource_pages';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'items',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active'  => 'boolean',
        'items'      => 'array',
        'sort_order' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('title');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function resolveUrl(): string
    {
        return route('resources.show', $this->slug);
    }

    public function getItemsAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }
        return $value ?? [];
    }

    public function getItemsForDisplayAttribute(): array
    {
        $items = $this->items;

        return array_map(function ($item) {
            return [
                'title'       => $item['title'] ?? '',
                'description' => $item['description'] ?? '',
                'url'         => $this->resolveUrl(),
            ];
        }, $items);
    }
}
