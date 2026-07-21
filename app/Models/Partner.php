<?php

namespace App\Models;

use App\Enums\PartnerCategory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'category',
        'subcategory',
        'logo',
        'country',
        'description',
        'website_url',
        'sort_order',
        'is_active',
    ];

    protected $appends = ['logo_url'];

    protected function casts(): array
    {
        return [
            'is_active'  => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        // A Technical Partner never carries a Financial subcategory, regardless
        // of what was posted — enforced here in addition to form validation.
        static::saving(function (Partner $partner) {
            if ($partner->category !== PartnerCategory::Financial->value) {
                $partner->subcategory = null;
            }
        });
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
