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
        'image', 'category', 'is_published', 'published_at',
        'links', 'tags',
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
                
                while (static::where('slug', $slug, '=', true)->exists()) {
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

    // Get the category from the relationship
    public function categoryRelation()
    {
        return $this->belongsTo(Category::class, 'category', 'CategoryName');
    }

    // Accessor for category name - returns the stored category name directly
    public function getCategoryNameAttribute(): string
    {
        return $this->category ?? '';
    }
}