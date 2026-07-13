<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'DonationDate',
        'PaymentMethod',
        'IsRecurring',
        'TaxReceiptIssued',
        'FiscalResidency',
        'Amount',
        'Currency',
        'TransactionID',
        'Status',
    ];

    protected $casts = [
        'DonationAmount'  => 'decimal:2',
        'Amount'          => 'decimal:2',
        'DonationDate'    => 'date',
        'IsRecurring'     => 'boolean',
        'TaxReceiptIssued' => 'boolean',
    ];

    public function donor(): BelongsTo
    {
        return $this->belongsTo(Donor::class, 'DonorID', 'DonorID');
    }

    public function scopeByDateRange($query, $startDate, $endDate)
    {
        return $query->whereBetween('DonationDate', [$startDate, $endDate]);
    }

    public function scopeByPaymentMethod($query, $method)
    {
        return $query->where('PaymentMethod', $method);
    }

    public function scopeCompleted($query)
    {
        return $query->whereNull('Status')->orWhere('Status', 'completed');
    }

    public function getFormattedAmountAttribute(): string
    {
        $amount = $this->Amount ?? $this->DonationAmount;
        $currency = $this->Currency ?? 'USD';
        $symbol = match ($currency) {
            'KHR' => '៛',
            'EUR' => '€',
            default => '$',
        };

        return $symbol . number_format((float) $amount, 2);
    }

    public function getPaymentMethodBadgeAttribute(): string
    {
        return match (strtolower($this->PaymentMethod)) {
            'aba'    => 'ABA',
            'acleda' => 'ACLEDA',
            default  => ucfirst($this->PaymentMethod),
        };
    }

    public function getStatusBadgeAttribute(): string
    {
        $status = $this->Status ?? 'completed';

        return match (strtolower($status)) {
            'completed' => 'Completed',
            'pending'   => 'Pending',
            'failed'    => 'Failed',
            default     => ucfirst($status),
        };
    }
}
