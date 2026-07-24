<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryEvent extends Model
{
    protected $fillable = ['year', 'left_text', 'left_text_fr', 'right_text', 'right_text_fr', 'image', 'sort_order', 'is_active'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderBy('year');
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }
        return str_starts_with($this->image, 'http')
            ? $this->image
            : asset('storage/' . $this->image);
    }

    // French text falls back to the English field whenever it hasn't been filled in yet.
    public function getLocalizedLeftTextAttribute(): ?string
    {
        return $this->localized('left_text');
    }

    public function getLocalizedRightTextAttribute(): ?string
    {
        return $this->localized('right_text');
    }

    private function localized(string $field): ?string
    {
        if (session('locale') === 'fr' && !empty($this->{$field . '_fr'})) {
            return $this->{$field . '_fr'};
        }

        return $this->{$field};
    }
}