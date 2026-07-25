<?php

namespace App\Models;

use App\Models\Concerns\HasPurifiedHtml;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperMediaGallery
 */
class MediaGallery extends Model
{
    use HasPurifiedHtml;

    protected array $purifiedHtml = ['description'];

    protected $guarded = [];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    public function getImageUrlAttribute()
    {
        if ($this->file_path) {
            return str_starts_with($this->file_path, 'http') 
                ? $this->file_path 
                : asset('storage/' . $this->file_path);
        }
        return null;
    }
}