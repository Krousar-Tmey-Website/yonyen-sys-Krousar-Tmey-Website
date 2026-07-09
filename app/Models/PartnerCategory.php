<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PartnerCategory extends Model
{
    protected $table = 'partner_categories';

    protected $fillable = [
        'name',
    ];

    /**
     * All partners in this category
     */
    public function partners(): HasMany
    {
        return $this->hasMany(Partner::class, 'category_id');
    }
}
