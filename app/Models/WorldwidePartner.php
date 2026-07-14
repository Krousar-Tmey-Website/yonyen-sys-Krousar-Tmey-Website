<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorldwidePartner extends Model
{
    protected $fillable = [
        'country_name', 'description', 'image', 'learn_more_url',
        'button_text', 'display_order', 'is_featured', 'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('display_order')->orderBy('id');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? (str_starts_with($this->image, 'http') ? $this->image : asset('storage/' . $this->image)) : asset('images/office-placeholder.jpg');
    }
}