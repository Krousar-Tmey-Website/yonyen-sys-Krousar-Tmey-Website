<?php

namespace App\Models\Concerns;

/**
 * Generalized version of the "_fr suffix falls back to the base column" pattern already used
 * on WorldwidePartner/ImpactStatistic, but keyed off the current locale rather than a hardcoded
 * 'fr' check — so it also works for 'km' (or any future locale) without extra code per locale.
 *
 * @mixin \Illuminate\Database\Eloquent\Model
 */
trait HasLocalizedFields
{
    protected function localized(string $field): ?string
    {
        $locale = app()->getLocale();
        $fallback = config('app.fallback_locale', 'en');

        if ($locale !== $fallback && !empty($this->{$field.'_'.$locale})) {
            return $this->{$field.'_'.$locale};
        }

        return $this->{$field};
    }
}
