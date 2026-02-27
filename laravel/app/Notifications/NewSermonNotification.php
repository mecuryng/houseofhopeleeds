<?php

namespace App\Notifications;

use App\Models\Sermon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewSermonNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Sermon $sermon
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Sermon: ' . $this->sermon->title)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('A new sermon has been published at House of Hope Church Leeds.')
            ->line('**' . $this->sermon->title . '**')
            ->line($this->sermon->description)
            ->line('**Date:** ' . $this->sermon->date->format('l, F j, Y'))
            ->action('Listen Now', route('sermons.show', $this->sermon->id))
            ->line('May this message bless your heart!')
            ->salutation('Blessings, House of Hope Church Leeds');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'sermon_id' => $this->sermon->id,
            'title' => $this->sermon->title,
            'date' => $this->sermon->date->format('Y-m-d'),
            'message' => 'New sermon: ' . $this->sermon->title,
        ];
    }
}
