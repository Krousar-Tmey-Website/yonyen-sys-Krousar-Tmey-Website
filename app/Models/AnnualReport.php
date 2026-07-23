<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AnnualReport extends Model
{
    protected $fillable = [
        'title',
        'year',
        'file_path',
        'original_filename',
        'is_active',
    ];

    protected $casts = [
        'year' => 'integer',
    ];

    public function getHasPdfFileAttribute(): bool
    {
        return !empty($this->file_path) && Storage::disk('public')->exists($this->file_path);
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
        if ($this->has_pdf_file) {
            return route('reports.view', $this);
        }

        if ($this->file_path && preg_match('#^https?://#i', $this->file_path)) {
            return $this->file_path;
        }

        return null;
    }
}
