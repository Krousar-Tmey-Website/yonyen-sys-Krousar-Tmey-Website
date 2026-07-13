<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Donor extends Model
{
    protected $table = 'donors';

    protected $primaryKey = 'DonorID';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'DonorID',
        'FirstName',
        'LastName',
        'Email',
        'Address',
        'Phone',
        'FullName',
    ];

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class, 'DonorID', 'DonorID');
    }

    public function getFullNameAttribute(): string
    {
        return $this->FullName ?? trim($this->FirstName . ' ' . $this->LastName);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('DonorID', 'like', "%{$term}%")
              ->orWhere('FirstName', 'like', "%{$term}%")
              ->orWhere('LastName', 'like', "%{$term}%")
              ->orWhere('Email', 'like', "%{$term}%")
              ->orWhere('FullName', 'like', "%{$term}%");
        });
    }
}
