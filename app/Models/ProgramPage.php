<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramPage extends Model
{
    protected $fillable = ['title', 'slug', 'short_content', 'content', 'image', 'is_active'];

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
        if (!$this->image) {
            return asset('images/default.jpg');
        }
        return str_starts_with($this->image, 'http')
            ? $this->image
            : asset('storage/' . $this->image);
    }

    public function items()
    {
        return $this->hasMany(ProgramPageItem::class, 'program_page_id')->orderBy('sort_order');
    }
}
