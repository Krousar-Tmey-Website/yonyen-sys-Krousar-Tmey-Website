<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use App\Models\Concerns\HasPurifiedHtml;
use Illuminate\Database\Eloquent\Model;

class VolunteerTrack extends Model
{
    use HasLocalizedFields, HasPurifiedHtml;

    protected array $purifiedHtml = ['description', 'description_fr', 'extra_content', 'extra_content_fr'];

    protected $fillable = [
        'title',
        'title_fr',
        'subtitle',
        'subtitle_fr',
        'description',
        'description_fr',
        'extra_heading',
        'extra_heading_fr',
        'extra_content',
        'extra_content_fr',
        'footer_label',
        'footer_label_fr',
        'cta_type',
        'cta_value',
        'cta_button_text',
        'cta_button_text_fr',
        'accent_color',
        'accent_color_secondary',
        'icon_background_color',
        'button_color',
        'button_text_color',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'sort_order' => 'integer',
        'is_active' => 'boolean',
    ];

    public static function ordered()
    {
        return static::orderBy('sort_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getLocalizedTitleAttribute(): ?string
    {
        return $this->localized('title');
    }

    public function getLocalizedSubtitleAttribute(): ?string
    {
        return $this->localized('subtitle');
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        return $this->localized('description');
    }

    public function getLocalizedExtraHeadingAttribute(): ?string
    {
        return $this->localized('extra_heading');
    }

    public function getLocalizedExtraContentAttribute(): ?string
    {
        return $this->localized('extra_content');
    }

    public function getLocalizedFooterLabelAttribute(): ?string
    {
        return $this->localized('footer_label');
    }

    public function getLocalizedCtaButtonTextAttribute(): ?string
    {
        return $this->localized('cta_button_text');
    }
}
