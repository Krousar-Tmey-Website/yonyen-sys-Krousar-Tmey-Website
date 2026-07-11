<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
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
        return $query->where('is_available', true)->where('stock', '>', 0);
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
}
