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

    public function getHasPdfFileAttribute(): bool
    {
        return !empty($this->file_path) && Storage::disk('public')->exists($this->file_path);
    }

    public function getFileUrlAttribute(): string
    {
        return $this->has_pdf_file ? Storage::disk('public')->url($this->file_path) : '';
    }
}
