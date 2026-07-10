<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'CategoryID';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'CategoryName',
        'Description',
        'CategoryStatus',
    ];

    public $timestamps = true;

    public function news()
    {
        return $this->hasMany(News::class, 'category', 'CategoryName');
    }
}
