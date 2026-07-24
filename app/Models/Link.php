<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'section_id',
        'text',
        'text_fr',
        'url',
        'type',
        'target',
        'order',
        'active'
    ];

    public function getLocalizedTextAttribute(): ?string
    {
        if (session('locale') === 'fr' && !empty($this->text_fr)) {
            return $this->text_fr;
        }

        return $this->text;
    }


    public function section()
    {
        return $this->belongsTo(PageSection::class);
    }
}
