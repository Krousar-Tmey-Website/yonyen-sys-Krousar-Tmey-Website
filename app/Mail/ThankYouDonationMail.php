<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThankYouDonationMail extends Mailable
{
    use SerializesModels;

    public $firstName;
    public $lastName;
    public $amount;
    public $currency;
    public $date;
    public $cardName;
    public $cardNumber;

    /**
     * Create a new message instance.
     */
    public function __construct($firstName, $lastName, $amount, $currency)
    {
        $this->firstName  = $firstName;
        $this->lastName   = $lastName;
        $this->amount     = $amount;
        $this->currency   = $currency;
        $this->date       = now()->format('F j, Y');
        $this->cardName   = 'Krousar Thmey';
        $this->cardNumber = '5325925500116673';
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject('Donation Receipt — Krousar Thmey')
            ->view('emails.thank-you');
    }
}
