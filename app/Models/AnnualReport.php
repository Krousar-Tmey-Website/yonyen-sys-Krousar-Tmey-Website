<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnualReport extends Model
{
    protected $fillable = [
        'title', 'year', 'file_path', 'file_url',
        'description', 'sort_order', 'is_active',
    ];

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
}
