<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use App\Models\Concerns\HasPurifiedHtml;
use Illuminate\Database\Eloquent\Model;

class PartnershipEmphasis extends Model
{
    use HasLocalizedFields, HasPurifiedHtml;

    protected array $purifiedHtml = ['description', 'description_fr', 'description_km'];

    protected $fillable = [
        'title',
        'title_fr',
        'title_km',
        'description',
        'description_fr',
        'description_km',
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

    public function getLocalizedTitleAttribute(): ?string
    {
        return $this->localized('title');
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        return $this->localized('description');
    }
}
