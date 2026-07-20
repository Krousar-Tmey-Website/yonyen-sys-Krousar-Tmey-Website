<?php

namespace App\Mail;

use App\Models\NewsletterCampaign;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class NewsletterMail extends Mailable
{
    use Queueable;

    public NewsletterCampaign $campaign;
    public string $subscriberEmail;

    public function __construct(NewsletterCampaign $campaign, string $subscriberEmail)
    {
        $this->campaign = $campaign;
        $this->subscriberEmail = $subscriberEmail;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->campaign->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter-campaign',
            with: [
                'campaign'        => $this->campaign,
                'subscriberEmail' => $this->subscriberEmail,
                'subject'         => $this->campaign->subject,
                'bodyContent'     => $this->campaign->content,
                'imageUrl'        => $this->campaign->image_url,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
