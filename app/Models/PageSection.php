<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = [
        'section_name',
        'title',
        'title_fr',
        'description',
        'description_fr',
        'order',
        'active'
    ];

    public function getLocalizedTitleAttribute(): ?string
    {
        return $this->localized('title');
    }

    public function getLocalizedDescriptionAttribute(): ?string
    {
        return $this->localized('description');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'section_id');
    }


    public function links()
    {
        return $this->hasMany(Link::class, 'section_id');
    }

    private function localized(string $field): ?string
    {
        if (session('locale') === 'fr' && !empty($this->{$field . '_fr'})) {
            return $this->{$field . '_fr'};
        }

        return $this->{$field};
    }
}
