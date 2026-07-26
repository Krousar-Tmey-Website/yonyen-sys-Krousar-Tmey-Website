<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * @mixin IdeHelperGallery
 */
class Gallery extends Model
{
    protected $guarded = [];

    // French text falls back to the English field whenever it hasn't been filled in yet.
    public function getLocalizedTitleAttribute(): ?string
    {
        return $this->localized('title');
    }

    private function localized(string $field): ?string
    {
        if (app()->getLocale() === 'fr' && !empty($this->{$field . '_fr'})) {
            return $this->{$field . '_fr'};
        }

        return $this->{$field};
    }
}
