<?php

namespace App\Models;

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
        static::creating(function (News $news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
            if ($news->is_published && empty($news->published_at)) {
                $news->published_at = now();
            }
        });
    }

    public function scopePublished($query)
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
}
