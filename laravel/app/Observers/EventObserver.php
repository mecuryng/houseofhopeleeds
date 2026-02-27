<?php

namespace App\Observers;

use App\Models\Event;
use App\Models\NewsletterSubscriber;
use App\Notifications\NewEventNotification;

class EventObserver
{
    public function created(Event $event): void
    {
        if (config('app.send_event_notifications', true)) {
            $subscribers = NewsletterSubscriber::active()->get();
            
            foreach ($subscribers as $subscriber) {
                if ($subscriber->email) {
                    \Illuminate\Support\Facades\Notification::route('mail', $subscriber->email)
                        ->notify(new NewEventNotification($event));
                }
            }
        }
    }

    public function updated(Event $event): void
    {
    }

    public function deleted(Event $event): void
    {
    }

    public function restored(Event $event): void
    {
    }

    public function forceDeleted(Event $event): void
    {
    }
}
