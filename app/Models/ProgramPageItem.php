<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramPageItem extends Model
{

    protected $fillable = [
        'title',
        'title_fr',
        'short_content',
        'short_content_fr',
        'objective',
        'objective_fr',
        'detail_content',
        'detail_content_fr',
        'activities',
        'activities_fr',
        'image',
        'image_2',
        'image_3',
        'is_active',
        'sort_order',
    ];

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

    // French text falls back to the English field whenever it hasn't been filled in yet.
    public function getLocalizedTitleAttribute(): ?string
    {
        return $this->localized('title');
    }

    public function getLocalizedObjectiveAttribute(): ?string
    {
        return $this->localized('objective');
    }

    public function getLocalizedShortContentAttribute(): ?string
    {
        return $this->localized('short_content');
    }

    public function getLocalizedDetailContentAttribute(): ?string
    {
        return $this->localized('detail_content');
    }

    public function getLocalizedActivitiesAttribute(): ?string
    {
        return $this->localized('activities');
    }

    private function localized(string $field): ?string
    {
        if (session('locale') === 'fr' && !empty($this->{$field . '_fr'})) {
            return $this->{$field . '_fr'};
        }

        return $this->{$field};
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) return asset('images/default.jpg');
        return str_starts_with($this->image, 'http') ? $this->image : asset('storage/' . $this->image);
    }

    public function getImage2UrlAttribute(): ?string
    {
        if (!$this->image_2) return null;
        return str_starts_with($this->image_2, 'http') ? $this->image_2 : asset('storage/' . $this->image_2);
    }

    public function getImage3UrlAttribute(): ?string
    {
        if (!$this->image_3) return null;
        return str_starts_with($this->image_3, 'http') ? $this->image_3 : asset('storage/' . $this->image_3);
    }
}
