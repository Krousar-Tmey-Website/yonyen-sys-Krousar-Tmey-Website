<?php

namespace Tests\Feature;

use App\Mail\DonationRequestMail;
use App\Mail\ThankYouDonationMail;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ThankYouDonationTest extends TestCase
{
    /**
     * Test successful donation continue and email sending.
     */
    public function test_continue_donation_sends_emails(): void
    {
        Mail::fake();

        $response = $this->postJson('/donation/continue', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'sreydeth.khon@student.passerellesnumeriques.org',
            'amount' => 100,
            'currency' => 'USD',
            'frequency' => 'one-time',
            'message' => 'Test message',
        ]);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Thank you email sent successfully.']);

        // Assert ThankYouDonationMail was sent to the donor
        Mail::assertSent(ThankYouDonationMail::class, function ($mail) {
            return $mail->hasTo('sreydeth.khon@student.passerellesnumeriques.org') 
                && $mail->firstName === 'John'
                && $mail->lastName === 'Doe'
                && $mail->amount == 100
                && $mail->currency === 'USD'
                && $mail->cardCode === '1234567890';
        });

        // Assert DonationRequestMail was sent to notify the team
        Mail::assertSent(DonationRequestMail::class, function ($mail) {
            return $mail->hasTo(config('mail.donation_recipient', 'info@krousar-thmey.org')) 
                && $mail->data['name'] === 'John Doe';
        });
    }

    /**
     * Test validation rules for continue donation.
     */
    public function test_continue_donation_validation(): void
    {
        Mail::fake();

        $response = $this->postJson('/donation/continue', [
            // Missing first_name, last_name, email
            'amount' => 0, // Invalid amount
            'currency' => 'INVALID',
            'frequency' => 'invalid-freq',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['first_name', 'last_name', 'email', 'amount', 'currency', 'frequency']);

        Mail::assertNothingSent();
    }
}
