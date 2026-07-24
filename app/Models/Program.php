<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{

    protected $fillable = [
        'title', 'title_fr', 'slug', 'description', 'description_fr',
        'full_description', 'full_description_fr',
        'image', 'icon_image', 'is_active', 'Status', 'Status_fr',
        'testimony_name', 'testimony_name_fr', 'testimony_story', 'testimony_story_fr', 'testimony_image',
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

    // French text falls back to the English field whenever it hasn't been filled in yet.
    public function getLocalizedTitleAttribute(): string
    {
        return $this->localized('title');
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        return $this->localized('description');
    }

    public function getLocalizedFullDescriptionAttribute(): ?string
    {
        return $this->localized('full_description');
    }

    public function getLocalizedStatusAttribute(): ?string
    {
        return $this->localized('Status');
    }

    public function getLocalizedTestimonyNameAttribute(): ?string
    {
        return $this->localized('testimony_name');
    }

    public function getLocalizedTestimonyStoryAttribute(): ?string
    {
        return $this->localized('testimony_story');
    }

    private function localized(string $field): ?string
    {
        if (session('locale') === 'fr' && !empty($this->{$field . '_fr'})) {
            return $this->{$field . '_fr'};
        }

        return $this->{$field};
    }
}
