<?php

namespace App\Observers;

use App\Models\Donation;
use App\Services\ActivityLogger;

class DonationObserver
{
    public function created(Donation $donation): void
    {
        ActivityLogger::log(
            'created',
            $donation,
            "Donation {$donation->DonationID} was created.",
            $donation->toArray()
        );
    }

    public function updated(Donation $donation): void
    {
        ActivityLogger::log(
            'updated',
            $donation,
            "Donation {$donation->DonationID} was updated.",
            [
                'old' => $donation->getOriginal(),
                'new' => $donation->getChanges(),
            ]
        );
    }

    public function deleted(Donation $donation): void
    {
        ActivityLogger::log(
            'deleted',
            $donation,
            "Donation {$donation->DonationID} was deleted.",
            $donation->toArray()
        );
    }
}
