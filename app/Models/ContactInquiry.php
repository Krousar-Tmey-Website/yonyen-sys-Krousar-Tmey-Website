<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInquiry extends Model
{
    protected $fillable = ['first_name', 'last_name', 'email', 'organisation', 'subject', 'message', 'consent'];

    protected function casts(): array
    {
        return [
            'consent' => 'boolean',
        ];
    }
}