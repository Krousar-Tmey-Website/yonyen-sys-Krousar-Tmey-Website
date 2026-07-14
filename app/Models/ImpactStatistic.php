<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImpactStatistic extends Model
{
    protected $fillable = [
        'value',
        'label',
        'description',
        'image',
        'sort_order',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    public static function active()
    {
        return static::where('is_active', true)->orderBy('sort_order');
    }

    public static function featured()
    {
        return static::where('is_featured', true)->where('is_active', true)->first();
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return 'https://images.unsplash.com/photo-1509095176120-414c2c5a1c0a?w=600&q=80';
        }
        
        return str_starts_with($this->image, 'http') 
            ? $this->image 
            : asset('storage/' . $this->image);
    }
}
