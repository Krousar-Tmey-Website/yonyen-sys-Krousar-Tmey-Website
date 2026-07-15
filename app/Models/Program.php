<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'full_description',
        'image', 'icon_image', 'is_active', 'Status',
        'testimony_name', 'testimony_story', 'testimony_image',
        'facebook_url', 'linkedin_url', 'instagram_url', 'telegram_url', 'youtube_url',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return asset('images/program.jpg');
        }
        return str_starts_with($this->image, 'http')
            ? $this->image
            : asset('storage/' . $this->image);
    }

    public function getIconImageUrlAttribute(): ?string
    {
        if (!$this->icon_image) {
            return null;
        }
        return str_starts_with($this->icon_image, 'http')
            ? $this->icon_image
            : asset('storage/' . $this->icon_image);
    }
}
