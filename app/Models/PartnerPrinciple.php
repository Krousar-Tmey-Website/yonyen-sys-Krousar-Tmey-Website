<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPartnerPrinciple
 */
class PartnerPrinciple extends Model
{
    use HasLocalizedFields;

    protected $fillable = [
        'content',
        'content_fr',
        'content_km',
        'accent_color',
        'card_background_color',
        'icon_background_color',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public static function ordered()
    {
        return static::orderBy('sort_order');
    }

    public function getLocalizedContentAttribute(): ?string
    {
        return $this->localized('content');
    }
}
