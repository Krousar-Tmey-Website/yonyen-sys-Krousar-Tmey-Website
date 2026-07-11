<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'category',
        'category_id',
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
            'category_id' => 'integer',
        ];
    }

    public function categoryModel(): BelongsTo
    {
        return $this->belongsTo(PartnerCategory::class, 'category_id');
    }

    public function getCategoryAttribute(): ?string
    {
        if (array_key_exists('category', $this->attributes)) {
            return $this->attributes['category'];
        }

        return $this->relationLoaded('categoryModel')
            ? $this->categoryModel?->name
            : $this->categoryModel()->value('name');
    }

    public function setCategoryAttribute(?string $value): void
    {
        if ($value === null || $value === '') {
            $this->attributes['category_id'] = null;

            return;
        }

        $categoryId = is_numeric($value)
            ? (int) $value
            : PartnerCategory::query()
                ->where('name', $value)
                ->value('id');

        $this->attributes['category_id'] = $categoryId;
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
