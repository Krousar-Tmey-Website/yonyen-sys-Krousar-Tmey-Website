<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class AnnualReport extends Model
{
    protected $fillable = [
        'title',
        'year',
        'file_path',
        'original_filename',
    ];

    protected $casts = [
        'year' => 'integer',
    ];

    public function getFileUrlAttribute(): string
    {
        return $this->file_path ? asset('storage/' . ltrim($this->file_path, '/')) : '';
    }
}
