<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = [
        'section_id',
        'text',
        'url',
        'type',
        'target',
        'order',
        'active'
    ];


    public function section()
    {
        return $this->belongsTo(PageSection::class);
    }
}