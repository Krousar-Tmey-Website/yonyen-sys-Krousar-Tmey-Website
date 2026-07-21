<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MediaItem extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'caption',
        'category', 'source', 'published_at',
        'external_link', 'image', 'is_published', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_published' => 'boolean',
            'published_at' => 'datetime',
            'sort_order'   => 'integer',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (MediaItem $item) {
            if (empty($item->slug)) {
                $baseSlug = Str::slug($item->title);
                $slug = $baseSlug;
                $counter = 1;

                while (static::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                $item->slug = $slug;
            }

            if ($item->is_published && empty($item->published_at)) {
                $item->published_at = now();
            }
        });

        static::updating(function (MediaItem $item) {
            if ($item->is_published && empty($item->published_at)) {
                $item->published_at = now();
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('published_at', 'desc')->orderBy('id', 'desc');
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return asset('images/cover.jpg');
        }
        return str_starts_with($this->image, 'http')
            ? $this->image
            : asset('storage/' . $this->image);
    }
}
