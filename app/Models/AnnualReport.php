<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AnnualReport extends Model
{
    protected $fillable = [
        'title',
        'title_fr',
        'year',
        'file_path',
        'original_filename',
        'description',
        'description_fr',
        'is_active',
    ];

    protected $casts = [
        'year' => 'integer',
    ];

    public function getHasPdfFileAttribute(): bool
    {
        return !empty($this->file_path) && Storage::disk('public')->exists($this->file_path);
    }

    public function getFileUrlAttribute(): string
    {
        return $this->has_pdf_file ? Storage::disk('public')->url($this->file_path) : '';
    }

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderByDesc('year');
    }

    public function getDownloadUrlAttribute(): ?string
    {
        if ($this->file_url) return $this->file_url;
        if ($this->file_path) return asset('storage/' . $this->file_path);
        return null;
    }

    // French text falls back to the English field whenever it hasn't been filled in yet.
    public function getLocalizedTitleAttribute(): ?string
    {
        return $this->localized('title');
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        return $this->localized('description');
    }

    private function localized(string $field): ?string
    {
        if (session('locale') === 'fr' && !empty($this->{$field . '_fr'})) {
            return $this->{$field . '_fr'};
        }

        return $this->{$field};
    }
}
