<?php

namespace App\Mail;

use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterWelcomeMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public NewsletterSubscriber $subscriber
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to House of Hope Church Leeds Newsletter',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.newsletter-welcome',
            with: [
                'subscriber' => $this->subscriber,
                'unsubscribeUrl' => route('newsletter.unsubscribe.confirm', base64_encode($this->subscriber->email)),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
