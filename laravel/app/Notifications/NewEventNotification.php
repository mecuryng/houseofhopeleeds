<?php

namespace App\Notifications;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewEventNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Event $event
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Event: ' . $this->event->title)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('A new event has been added at House of Hope Church Leeds.')
            ->line('**' . $this->event->title . '**')
            ->line($this->event->description)
            ->line('**Date:** ' . $this->event->date->format('l, F j, Y'))
            ->line('**Time:** ' . $this->event->time)
            ->line('**Location:** ' . $this->event->location)
            ->action('View Event Details', route('events.show', $this->event->id))
            ->line('We hope to see you there!')
            ->salutation('Blessings, House of Hope Church Leeds');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'event_id' => $this->event->id,
            'title' => $this->event->title,
            'date' => $this->event->date->format('Y-m-d'),
            'message' => 'New event: ' . $this->event->title,
        ];
    }
}
