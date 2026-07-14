<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Campaign extends Model
{
    protected $fillable = [
        'title',
        'description',
        'goal_amount',
        'collected_amount',
        'start_date',
        'end_date',
        'is_active',
        'image',
    ];

    protected function casts(): array
    {
        return [
            'goal_amount'      => 'decimal:2',
            'collected_amount' => 'decimal:2',
            'is_active'        => 'boolean',
            'start_date'       => 'date',
            'end_date'         => 'date',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        return str_starts_with($this->image, 'http')
            ? $this->image
            : asset('storage/' . $this->image);
    }

    public function getProgressPercentageAttribute(): float
    {
        if ($this->goal_amount <= 0) {
            return 0;
        }

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

    public function getIsOngoingAttribute(): bool
    {
        if (!$this->start_date && !$this->end_date) {
            return $this->is_active;
        }

        $now = now()->startOfDay();

        if ($this->start_date && $now->lt($this->start_date)) {
            return false; // Not started yet
        }

        if ($this->end_date && $now->gt($this->end_date)) {
            return false; // Ended
        }

        return true;
    }
}
