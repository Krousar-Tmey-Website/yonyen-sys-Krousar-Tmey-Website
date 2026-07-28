<?php

namespace App\Models;

use App\Models\Concerns\HasLocalizedFields;
use App\Models\Concerns\HasPurifiedHtml;
use Illuminate\Database\Eloquent\Model;

class InvolvedQuickLink extends Model
{
    use HasLocalizedFields, HasPurifiedHtml;

    protected array $purifiedHtml = ['description', 'description_km'];

    protected $fillable = [
        'icon_key',
        'title',
        'title_km',
        'description',
        'description_km',
        'link_url',
        'accent_color',
        'card_background_color',
        'icon_background_color',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * Preset icon choices offered in the admin picker — kept to a small, known-good set of
     * outline SVG paths already used elsewhere in the app, rather than letting admins paste
     * arbitrary markup into a public-facing <svg>.
     */
    public const ICONS = [
        'briefcase' => [
            'label' => 'Briefcase',
            'path' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 002 2v10a2 2 0 002 2z"/>',
        ],
        'heart' => [
            'label' => 'Heart',
            'path' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>',
        ],
        'people' => [
            'label' => 'People',
            'path' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>',
        ],
        'book' => [
            'label' => 'Book',
            'path' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>',
        ],
        'mail' => [
            'label' => 'Mail',
            'path' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>',
        ],
        'phone' => [
            'label' => 'Phone',
            'path' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>',
        ],
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

    public function getIconPathAttribute(): string
    {
        return self::ICONS[$this->icon_key]['path'] ?? self::ICONS['briefcase']['path'];
    }
}
