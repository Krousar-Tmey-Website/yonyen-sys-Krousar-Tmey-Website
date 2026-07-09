<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnualReport extends Model
{
    protected $fillable = ['title', 'year', 'file_path', 'is_active'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}