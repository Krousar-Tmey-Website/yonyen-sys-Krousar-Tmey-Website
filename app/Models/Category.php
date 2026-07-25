<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperCategory
 */
class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'CategoryID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'CategoryName',
        'Description',
    ];

    public $timestamps = true;
}
