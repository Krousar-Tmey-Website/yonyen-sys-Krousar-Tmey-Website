<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'country',
        'address',
        'availability',
        'interested_program',
        'skills',
        'motivation',
        'previous_experience',
        'resume',
        'emergency_contact',
        'agreed_to_terms',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth'   => 'date',
            'agreed_to_terms' => 'boolean',
            'status'          => 'string',
        ];
    }

    public function scopePending($query)
    {
        return $query->where('status', 'Pending');
    }

    public function scopeUnderReview($query)
    {
        return $query->where('status', 'Under Review');
    }

    public function scopeInterviewScheduled($query)
    {
        return $query->where('status', 'Interview Scheduled');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'Approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'Rejected');
    }
}
