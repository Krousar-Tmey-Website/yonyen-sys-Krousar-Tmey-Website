<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
    protected $fillable = [
        'section_name',
        'title',
        'description',
        'order',
        'active'
    ];


    public function images()
    {
        return $this->hasMany(Image::class, 'section_id');
    }


    public function links()
    {
        return $this->hasMany(Link::class, 'section_id');
    }
}
