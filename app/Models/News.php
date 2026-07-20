<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $table = 'news';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'category',
        'image',
        'gallery',
        'videos',
        'links',
        'tag_links',
        'is_published',
        'author',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'gallery'      => 'array',
        'videos'       => 'array',
        'links'        => 'array',
        'tag_links'    => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($news) {
            if (empty($news->slug) && !empty($news->title)) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    public function getImageUrlAttribute()
    {
        if (empty($this->image)) {
            return asset('images/placeholder.jpg');
        }

        if (Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        if (Str::startsWith($this->image, 'news/')) {
            return Storage::url($this->image);
        }

        return Storage::url($this->image);
    }

    public function getGalleryUrlsAttribute()
    {
        if (empty($this->gallery)) {
            return [];
        }

        return array_map(function ($path) {
            if (Str::startsWith($path, ['http://', 'https://'])) {
                return $path;
            }
            return Storage::url($path);
        }, $this->gallery);
    }

    public function getVideosAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }
        return $value ?? [];
    }

    public function getVideoUrlsAttribute()
    {
        if (empty($this->videos)) {
            return [];
        }

        return array_map(function ($path) {
            if (Str::startsWith($path, ['http://', 'https://'])) {
                return $path;
            }
            return Storage::url($path);
        }, $this->videos);
    }

    public function getTagLinksAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }
        return $value ?? [];
    }

    public function getLinksAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? [];
        }
        return $value ?? [];
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category', 'CategoryName');
    }
}
