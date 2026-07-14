<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Donation extends Model
{
    protected $table = 'donations';

    protected $primaryKey = 'DonationID';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'DonationID',
        'DonorID',
        'DonationAmount',
        'DonationType',
        'DonationDate',
        'PaymentMethod',
        'IsRecurring',
        'TaxReceiptIssued',
        'FiscalResidency',
        'Amount',
        'Currency',
        'TransactionID',
        'Status',
        'Notes',
    ];

    protected function casts(): array
    {
        return [
            'DonationDate'      => 'date',
            'DonationAmount'    => 'decimal:2',
            'Amount'            => 'decimal:2',
            'IsRecurring'       => 'boolean',
            'TaxReceiptIssued'  => 'boolean',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function (Donation $donation) {
            if (empty($donation->DonationID)) {
                $donation->DonationID = 'DON-' . strtoupper(Str::random(10));
            }
            if (empty($donation->DonationDate)) {
                $donation->DonationDate = now();
            }
        });
    }

    public function donor()
    {
        return $this->belongsTo(Donor::class, 'DonorID', 'DonorID');
    }

    /**
     * Get the effective donation amount (prefer DonationAmount, fallback to Amount).
     */
    public function getEffectiveAmountAttribute(): float
    {
        return (float) ($this->DonationAmount ?? $this->Amount ?? 0);
    }
}
