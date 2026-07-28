<?php

namespace App\Models;

use App\Models\Concerns\HasPurifiedHtml;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @mixin IdeHelperCampaign
 */
class Campaign extends Model
{
    use HasPurifiedHtml;

    protected array $purifiedHtml = ['description', 'description_fr'];

    protected $fillable = [
        'slug', 'year', 'title', 'title_fr', 'description', 'description_fr',
        'image', 'video', 'file', 'file_original_name', 'is_active', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active'  => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Campaign $campaign) {
            if (empty($campaign->slug)) {
                $campaign->slug = static::uniqueSlug($campaign->title);
            }
        });
    }

    /** Build a slug that no other campaign is already using. */
    public static function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'campaign';
        $slug = $base;
        $counter = 1;

        while (static::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $counter++;
        }

        return $slug;
    }

    /** Public listing order: manual sort first, then newest year, then newest record. */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true)->ordered();
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderByDesc('year')->orderByDesc('id');
    }

    // ── Localization ──────────────────────────────────────────
    // French text falls back to the English field whenever it hasn't been filled in yet.

    public function getLocalizedTitleAttribute(): string
    {
        return $this->localized('title') ?? '';
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        return $this->localized('description');
    }

    private function localized(string $field): ?string
    {
        if (app()->getLocale() === 'fr' && !empty($this->{$field . '_fr'})) {
            return $this->{$field . '_fr'};
        }

        return $this->{$field};
    }

    /** Plain-text teaser built from the localized rich-text description. */
    public function excerpt(int $limit = 160): string
    {
        $text = strip_tags((string) $this->localized_description);
        $text = trim(preg_replace('/\s+/', ' ', html_entity_decode($text, ENT_QUOTES | ENT_HTML5)));

        return Str::limit($text, $limit);
    }

    // ── Media ─────────────────────────────────────────────────

    public function getImageUrlAttribute(): string
    {
        if (!$this->image) {
            return asset('images/cover.jpg');
        }

        return $this->resolveUrl($this->image);
    }

    public function getHasImageAttribute(): bool
    {
        return !empty($this->image);
    }

    public function getHasVideoAttribute(): bool
    {
        return !empty($this->video);
    }

    /** True when the video is an external link (YouTube/Vimeo/…) rather than an uploaded file. */
    public function getIsExternalVideoAttribute(): bool
    {
        return $this->has_video && str_starts_with($this->video, 'http');
    }

    public function getVideoUrlAttribute(): ?string
    {
        return $this->video ? $this->resolveUrl($this->video) : null;
    }

    /** Embeddable player URL for YouTube/Vimeo links, so they render inside an <iframe>. */
    public function getVideoEmbedUrlAttribute(): ?string
    {
        if (!$this->is_external_video) {
            return null;
        }

        if (preg_match('#(?:youtube\.com/(?:watch\?v=|embed/|shorts/)|youtu\.be/)([A-Za-z0-9_-]{6,})#i', $this->video, $m)) {
            return 'https://www.youtube.com/embed/' . $m[1];
        }

        if (preg_match('#vimeo\.com/(?:video/)?(\d+)#i', $this->video, $m)) {
            return 'https://player.vimeo.com/video/' . $m[1];
        }

        return null;
    }

    public function getHasFileAttribute(): bool
    {
        return !empty($this->file) && Storage::disk('public')->exists($this->file);
    }

    public function getFileUrlAttribute(): ?string
    {
        return $this->has_file ? $this->resolveUrl($this->file) : null;
    }

    public function getFileNameAttribute(): string
    {
        return $this->file_original_name ?: basename((string) $this->file);
    }

    public function getFileSizeForHumansAttribute(): ?string
    {
        if (!$this->has_file) {
            return null;
        }

        $bytes = Storage::disk('public')->size($this->file);

        return $bytes >= 1048576
            ? round($bytes / 1048576, 1) . ' MB'
            : max(1, round($bytes / 1024)) . ' KB';
    }

    private function resolveUrl(string $path): string
    {
        return str_starts_with($path, 'http') ? $path : asset('storage/' . $path);
    }
}
