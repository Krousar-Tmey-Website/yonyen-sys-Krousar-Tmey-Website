<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'category',
        'logo',
        'country',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active'   => 'boolean',
            'sort_order'  => 'integer',
        ];
    }

    /**
     * Scope: only active partners, ordered by sort_order then name.
     */
    public function scopeActive($query)
    {
        return $query
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name');
    }

    /**
     * Get the logo URL attribute.
     */
    public function getLogoUrlAttribute(): ?string
    {
        if (!$this->logo) {
            return null;
        }
        return str_starts_with($this->logo, 'http')
            ? $this->logo
            : asset('storage/' . $this->logo);
    }
}