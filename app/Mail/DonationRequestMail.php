<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DonationRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public array $data;
    public bool $forTeam;

    public function __construct(array $data, bool $forTeam = true)
    {
        $this->data    = $data;
        $this->forTeam = $forTeam;
    }

    public function envelope(): Envelope
    {
        $symbol    = match($this->data['currency']) {
            'EUR'   => '€',
            'KHR'   => '៛',
            default => '$',
        };
        $amount    = $symbol . number_format($this->data['amount'], 0);
        $subject   = $this->forTeam
            ? "New Donation Request — {$amount} from {$this->data['name']}"
            : "Thank you for your donation request — Krousar Thmey";

        return new Envelope(subject: $subject);
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.donation-request',
            with: [
                'data'    => $this->data,
                'forTeam' => $this->forTeam,
            ],
        );
    }
}
