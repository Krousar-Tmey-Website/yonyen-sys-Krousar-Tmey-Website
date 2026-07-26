<?php

namespace App\Models;

use App\Models\Concerns\HasPurifiedHtml;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperJobOpportunity
 */
class JobOpportunity extends Model
{
    use HasPurifiedHtml;

    protected array $purifiedHtml = ['description', 'description_fr'];

    protected $fillable = ['title', 'title_fr', 'description', 'description_fr', 'location', 'posted_date', 'type', 'status', 'is_active', 'sort_order', 'image'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
            'posted_date' => 'date:Y-m-d',
        ];
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    // French text falls back to the English field whenever it hasn't been filled in yet.
    public function getLocalizedTitleAttribute(): string
    {
        return $this->localized('title');
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
}
