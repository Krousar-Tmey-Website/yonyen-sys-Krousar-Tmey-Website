<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Partner extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'logo',
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
     * The partner category this partner belongs to.
     */
    public function partnerCategory(): BelongsTo
    {
        return $this->belongsTo(PartnerCategory::class, 'category_id');
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
}
