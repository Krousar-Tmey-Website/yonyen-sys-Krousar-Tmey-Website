<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class News
 * 
 * @method static \Illuminate\Database\Eloquent\Builder latest(string $column = 'created_at')
 * @method static \Illuminate\Contracts\Pagination\LengthAwarePaginator paginate(int $perPage = 15)
 * @method static \Illuminate\Database\Eloquent\Builder published()
 * @method bool delete()
 * @method static News find(int $id)
 * @method static News create(array $attributes = [])
 */
class News extends Model
{
    protected $fillable = [
        'title', 'slug', 'excerpt', 'content',
        'image', 'gallery', 'videos', 'is_published', 'published_at',
        'links', 'tag_links',
    ];

    protected function casts(): array
    {
        return [
            'is_published'  => 'boolean',
            'published_at'  => 'datetime',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();
        
        // Fallback slug generation
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

        // Also handle updates
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

    // Ensure links is always returned as an array
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

    // Ensure tag_links is always returned as an array of ['label' => ..., 'url' => ...]
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

    // Ensure gallery is always returned as an array of stored image paths
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

    // Encode array assignment (e.g. from newly uploaded files) to JSON for storage
    public function setGalleryAttribute(mixed $value): void
    {
        $this->attributes['gallery'] = is_array($value) ? json_encode($value) : $value;
    }

    // Resolve each stored gallery path to a full URL
    public function getGalleryUrlsAttribute(): array
    {
        return array_map(
            fn (string $path) => str_starts_with($path, 'http') ? $path : asset('storage/' . $path),
            $this->gallery
        );
    }

    // Ensure videos is always returned as an array of stored video paths
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

    // Encode array assignment (e.g. from newly uploaded files) to JSON for storage
    public function setVideosAttribute(mixed $value): void
    {
        $this->attributes['videos'] = is_array($value) ? json_encode($value) : $value;
    }

    // Resolve each stored video path to a full URL
    public function getVideoUrlsAttribute(): array
    {
        return array_map(
            fn (string $path) => str_starts_with($path, 'http') ? $path : asset('storage/' . $path),
            $this->videos
        );
    }
}