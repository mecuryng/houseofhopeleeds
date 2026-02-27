<?php

namespace App\Observers;

use App\Models\Sermon;
use App\Models\NewsletterSubscriber;
use App\Notifications\NewSermonNotification;

class SermonObserver
{
    public function created(Sermon $sermon): void
    {
        if (config('app.send_sermon_notifications', true)) {
            $subscribers = NewsletterSubscriber::active()->get();
            
            foreach ($subscribers as $subscriber) {
                if ($subscriber->email) {
                    \Illuminate\Support\Facades\Notification::route('mail', $subscriber->email)
                        ->notify(new NewSermonNotification($sermon));
                }
            }
        }
    }

    public function updated(Sermon $sermon): void
    {
    }

    public function deleted(Sermon $sermon): void
    {
    }

    public function restored(Sermon $sermon): void
    {
    }

    public function forceDeleted(Sermon $sermon): void
    {
    }
}
