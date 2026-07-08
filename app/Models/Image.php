<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'section_id',
        'path',
        'alt',
        'order'
    ];


    public function section()
    {
        return $this->belongsTo(PageSection::class);
    }
}
