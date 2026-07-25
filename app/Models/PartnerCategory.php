<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperPartnerCategory
 */
class PartnerCategory extends Model
{
    protected $fillable = [
        'name',
    ];

    public function partners(): HasMany
    {
        return $this->hasMany(Partner::class, 'category_id');
    }
}
