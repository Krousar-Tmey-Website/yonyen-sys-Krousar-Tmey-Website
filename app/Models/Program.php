<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'full_description',
        'image', 'stats', 'sort_order', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'stats'     => 'array',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return asset('images/program.jpg');
        }
        return str_starts_with($this->image, 'http')
            ? $this->image
            : asset('storage/' . $this->image);
    }
}
