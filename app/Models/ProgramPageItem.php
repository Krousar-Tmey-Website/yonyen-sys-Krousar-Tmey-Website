<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramPageItem extends Model
{

    protected $fillable = [
        'title',
        'short_content',
        'objective',
        'detail_content',
        'activities',
        'image',
        'image_2',
        'image_3',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) return asset('images/default.jpg');
        return str_starts_with($this->image, 'http') ? $this->image : asset('storage/' . $this->image);
    }

    public function getImage2UrlAttribute(): ?string
    {
        if (!$this->image_2) return null;
        return str_starts_with($this->image_2, 'http') ? $this->image_2 : asset('storage/' . $this->image_2);
    }

    public function getImage3UrlAttribute(): ?string
    {
        if (!$this->image_3) return null;
        return str_starts_with($this->image_3, 'http') ? $this->image_3 : asset('storage/' . $this->image_3);
    }
}
