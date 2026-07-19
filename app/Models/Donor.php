<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'FullName',
        'Email',
        'Address',
        'Phone',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (Donor $donor) {
            if (empty($donor->DonorID)) {
                $donor->DonorID = 'DONOR-' . strtoupper(Str::random(10));
            }
        });
    }

    public function donations()
    {
        return $this->hasMany(Donation::class, 'DonorID', 'DonorID');
    }

    public function getFullNameAttribute(): string
    {
        $fullName = $this->attributes['FullName'] ?? null;
        if ($fullName) {
            return $fullName;
        }
        $first = $this->attributes['FirstName'] ?? '';
        $last  = $this->attributes['LastName'] ?? '';
        return trim("$first $last");
    }
}
