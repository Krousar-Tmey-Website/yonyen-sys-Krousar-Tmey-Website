<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PrincipleSlide extends Model
{
    protected $fillable = [
        'title',
        'image',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public static function active()
    {
        return static::where('is_active', true)->orderBy('sort_order');
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return 'https://images.unsplash.com/photo-1509095176120-414c2c5a1c0a?w=1400&q=80';
        }
        
        return str_starts_with($this->image, 'http')
            ? $this->image
            : asset('storage/' . $this->image);
    }
}