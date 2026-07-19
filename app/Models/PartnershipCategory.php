<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnershipCategory extends Model
{
    protected $fillable = [
        'name',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public static function ordered()
    {
        return static::orderBy('sort_order');
    }
}
