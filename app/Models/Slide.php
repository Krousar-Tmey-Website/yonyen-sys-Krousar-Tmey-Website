<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = [
        'title', 'title_fr', 'subtitle', 'subtitle_fr', 'badge_text', 'badge_text_fr', 'image',
        'cta_primary_text', 'cta_primary_text_fr', 'cta_primary_url',
        'cta_secondary_text', 'cta_secondary_text_fr', 'cta_secondary_url',
        'sort_order', 'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order');
    }

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?w=1400&q=80';
        }
        return str_starts_with($this->image, 'http')
            ? $this->image
            : asset('storage/' . $this->image);
    }

    // French text falls back to the English field whenever it hasn't been filled in yet.
    public function getLocalizedTitleAttribute(): ?string
    {
        return $this->localized('title');
    }

    public function getLocalizedSubtitleAttribute(): ?string
    {
        return $this->localized('subtitle');
    }

    public function getLocalizedBadgeTextAttribute(): ?string
    {
        return $this->localized('badge_text');
    }

    public function getLocalizedCtaPrimaryTextAttribute(): ?string
    {
        return $this->localized('cta_primary_text');
    }

    public function getLocalizedCtaSecondaryTextAttribute(): ?string
    {
        return $this->localized('cta_secondary_text');
    }

    private function localized(string $field): ?string
    {
        if (session('locale') === 'fr' && !empty($this->{$field . '_fr'})) {
            return $this->{$field . '_fr'};
        }

        return $this->{$field};
    }
}
