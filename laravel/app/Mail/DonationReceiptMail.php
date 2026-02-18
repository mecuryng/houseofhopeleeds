<?php

namespace App\Mail;

use App\Models\Donation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DonationReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Donation $donation)
    {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Donation Receipt - House of Hope Leeds',
        );
    }

    public function content(): Content
    {
        $amount = number_format($this->donation->amount / 100, 2);
        $frequency = $this->donation->frequency === 'recurring' ? 'Monthly' : 'One-time';
        
        return new Content(
            view: 'emails.donation-receipt',
            with: [
                'donation' => $this->donation,
                'amount' => $amount,
                'frequency' => $frequency,
                'provider' => ucfirst($this->donation->provider),
            ]
        );
    }
}
