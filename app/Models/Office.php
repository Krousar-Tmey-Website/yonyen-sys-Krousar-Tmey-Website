<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = [
        'country', 'city', 'flag', 'badge', 'address',
        'phone', 'email', 'google_maps_link', 'office_hours',
        'accent_color', 'badge_color',
        'image_url', 'description', 'link',
        'sort_order', 'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('id');
    }
}
