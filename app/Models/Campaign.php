<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Campaign extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'goal_amount',
        'collected_amount',
        'start_date',
        'end_date',
        'is_active',
        'sort_order',
        'image',
        'video',
        'youtube_url',
        'pdf',
    ];

    protected function casts(): array
    {
        return [
            'goal_amount'      => 'decimal:2',
            'collected_amount' => 'decimal:2',
            'is_active'        => 'boolean',
            'start_date'       => 'date',
            'end_date'         => 'date',
            'sort_order'       => 'integer',
        ];
    }

    // ─── Scopes ────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at', 'desc');
    }

    public function scopeUpcoming($query)
    {
        return $query->active()->where(function ($q) {
            $q->whereNull('start_date')->orWhere('start_date', '<=', now());
        })->where(function ($q) {
            $q->whereNull('end_date')->orWhere('end_date', '>=', now());
        });
    }

    public function scopeExpired($query)
    {
        return $query->where('end_date', '<', now()->startOfDay());
    }

    // ─── Accessors / Mutators ──────────────────────────────

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) return null;

        return str_starts_with($this->image, 'http')
            ? $this->image
            : asset('storage/' . $this->image);
    }

    public function getVideoUrlAttribute(): ?string
    {
        if (!$this->video) return null;

        return str_starts_with($this->video, 'http')
            ? $this->video
            : asset('storage/' . $this->video);
    }

    public function getVideoMimeAttribute(): ?string
    {
        if (!$this->video) return null;

        $ext = strtolower(pathinfo($this->video, PATHINFO_EXTENSION));

        return match ($ext) {
            'mp4'  => 'video/mp4',
            'webm' => 'video/webm',
            'ogg'  => 'video/ogg',
            'mov'  => 'video/quicktime',
            'avi'  => 'video/x-msvideo',
            'mkv'  => 'video/x-matroska',
            default => 'video/mp4',
        };
    }

    public function getPdfUrlAttribute(): ?string
    {
        if (!$this->pdf) return null;

        return str_starts_with($this->pdf, 'http')
            ? $this->pdf
            : asset('storage/' . $this->pdf);
    }

    public function getPdfFilenameAttribute(): ?string
    {
        return $this->pdf ? basename($this->pdf) : null;
    }

    public function getHasVideoAttribute(): bool
    {
        return !empty($this->video) || !empty($this->youtube_url);
    }

    public function getYoutubeEmbedUrlAttribute(): ?string
    {
        if (!$this->youtube_url) return null;

        $url = $this->youtube_url;
        $videoId = null;

        // Handle youtu.be/XXX short URLs
        if (preg_match('/youtu\.be\/([a-zA-Z0-9_-]{11})/', $url, $m)) {
            $videoId = $m[1];
        }
        // Handle youtube.com/embed/XXX and youtube.com/shorts/XXX
        elseif (preg_match('/youtube\.com\/(?:embed|shorts)\/([a-zA-Z0-9_-]{11})/', $url, $m)) {
            $videoId = $m[1];
        }
        // Handle youtube.com/watch URLs (with any parameter order)
        elseif (preg_match('/youtube\.com\/watch/', $url)) {
            $parts = parse_url($url);
            if (!empty($parts['query'])) {
                parse_str($parts['query'], $query);
                $videoId = $query['v'] ?? null;
            }
        }

        return $videoId ? 'https://www.youtube.com/embed/' . $videoId : null;
    }

    public function getHasYoutubeAttribute(): bool
    {
        return !empty($this->youtube_url);
    }

    public function getHasUploadedVideoAttribute(): bool
    {
        return !empty($this->video);
    }

    public function getHasPdfAttribute(): bool
    {
        return !empty($this->pdf);
    }

    public function getProgressPercentageAttribute(): float
    {
        if ($this->goal_amount <= 0) return 0;

        return min(100, round(($this->collected_amount / $this->goal_amount) * 100, 1));
    }

    public function getFormattedGoalAttribute(): string
    {
        return '$' . number_format($this->goal_amount, 2);
    }

    public function getFormattedCollectedAttribute(): string
    {
        return '$' . number_format($this->collected_amount, 2);
    }

    // ─── Status Helpers ────────────────────────────────────

    public function getIsOngoingAttribute(): bool
    {
        if (!$this->start_date && !$this->end_date) {
            return $this->is_active;
        }

        $now = now()->startOfDay();

        if ($this->start_date && $now->lt($this->start_date)) {
            return false;
        }

        if ($this->end_date && $now->gt($this->end_date)) {
            return false;
        }

        return true;
    }

    public function getStatusAttribute(): string
    {
        if (!$this->is_active) return 'inactive';

        $now = now()->startOfDay();

        if ($this->start_date && $now->lt($this->start_date)) {
            return 'upcoming';
        }

        if ($this->end_date && $now->gt($this->end_date)) {
            return 'ended';
        }

        return 'active';
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'active'   => 'Active',
            'upcoming' => 'Upcoming',
            'ended'    => 'Ended',
            default    => 'Inactive',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'active'   => 'emerald',
            'upcoming' => 'blue',
            'ended'    => 'gray',
            default    => 'gray',
        };
    }

    public function getDaysRemainingAttribute(): ?int
    {
        if (!$this->end_date || !$this->is_active) return null;

        $now = now()->startOfDay();

        if ($now->gt($this->end_date)) return 0;

        return (int) $now->diffInDays($this->end_date, false);
    }

    public function getDaysRemainingLabelAttribute(): string
    {
        $days = $this->days_remaining;

        if ($days === null) return '—';

        if ($days === 0) return 'Ended';

        if ($days === 1) return '1 day left';

        return "{$days} days left";
    }

    // ─── Boot ──────────────────────────────────────────────

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Campaign $campaign) {
            if (empty($campaign->slug) && !empty($campaign->title)) {
                $campaign->slug = static::generateUniqueSlug($campaign->title);
            }
        });

        static::updating(function (Campaign $campaign) {
            if ($campaign->isDirty('title') && !$campaign->isDirty('slug')) {
                $campaign->slug = static::generateUniqueSlug($campaign->title, $campaign->id);
            }
        });
    }

    public static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $counter = 1;

        while (true) {
            $query = static::where('slug', $slug);
            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }
            if (!$query->exists()) break;
            $slug = $original . '-' . $counter++;
        }

        return $slug;
    }
}
