<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $fillable = [
        'title', 'slug', 'excerpt', 'content',
        'image', 'gallery', 'category', 'videos', 'is_published', 'published_at',
        'links', 'tag_links',
    ];

    protected function casts(): array
    {
        return [
            'is_published'  => 'boolean',
            'published_at'  => 'datetime',
            'gallery'       => 'array',
            'videos'        => 'array',
            'links'         => 'array',
            'tag_links'     => 'array',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (News $news) {
            if (empty($news->slug)) {
                $baseSlug = Str::slug($news->title);
                $slug = $baseSlug;
                $counter = 1;

                while (static::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }
                $news->slug = $slug;
            }
            if ($news->is_published && empty($news->published_at)) {
                $news->published_at = now();
            }
        });

        static::updating(function (News $news) {
            if ($news->is_published && empty($news->published_at)) {
                $news->published_at = now();
            }
        });
    }

    public function scopePublished(Builder $query)
    {
        return $query->where('is_published', true);
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

    public function getLinksAttribute(mixed $value)
    {
        if (is_null($value) || $value === '') {
            return [];
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }

        return (array) $value;
    }

    public function getTagLinksAttribute(mixed $value): array
    {
        if (is_null($value) || $value === '') {
            return [];
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }

        return (array) $value;
    }

    public function getGalleryAttribute(mixed $value): array
    {
        if (is_null($value) || $value === '') {
            return [];
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }

        return (array) $value;
    }

    public function getGalleryUrlsAttribute(): array
    {
        return array_map(
            fn (string $path) => str_starts_with($path, 'http') ? $path : asset('storage/' . $path),
            $this->gallery
        );
    }

    public function getVideosAttribute(mixed $value): array
    {
        if (is_null($value) || $value === '') {
            return [];
        }

        if (is_string($value)) {
            $decoded = json_decode($value, true);
            return is_array($decoded) ? $decoded : [];
        }

        return (array) $value;
    }

    public function getVideoUrlsAttribute(): array
    {
        return array_map(
            fn (string $path) => str_starts_with($path, 'http') ? $path : asset('storage/' . $path),
            $this->videos
        );
    }
}
