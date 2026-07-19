<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContactInquiry extends Model
{
    protected $table = 'contact_inquiries';

    protected $primaryKey = 'InquiryID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'InquiryID',
        'Name',
        'Email',
        'Subject',
        'Message',
        'ReceivedDate',
        'Status',
        'TargetEntity',
    ];

    protected function casts(): array
    {
        return [
            'ReceivedDate' => 'date',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (ContactInquiry $inquiry) {
            if (empty($inquiry->InquiryID)) {
                $inquiry->InquiryID = 'INQ-' . strtoupper(Str::random(10));
            }
            if (empty($inquiry->ReceivedDate)) {
                $inquiry->ReceivedDate = now();
            }
            if (empty($inquiry->Status)) {
                $inquiry->Status = 'New';
            }
        });
    }
}
