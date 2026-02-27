<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Rsvp;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventReminderMail;

class SendEventReminders extends Command
{
    protected $signature = 'events:send-reminders {--hours=24 : hours_before_event}';
    protected $description = 'Send email reminders for upcoming events';

    public function handle()
    {
        $hours = (int) $this->option('hours');
        $reminderTime = now()->addHours($hours);
        
        $events = Event::where('date', $reminderTime->format('Y-m-d'))
            ->whereTime('time', '>=', $reminderTime->format('H:i:s'))
            ->whereTime('time', '<=', $reminderTime->addHour()->format('H:i:s'))
            ->get();

        if ($events->isEmpty()) {
            $this->info('No events found in the specified time window.');
            return;
        }

        $sentCount = 0;

        foreach ($events as $event) {
            $rsvps = Rsvp::where('event_id', $event->id)
                ->where('reminded_at', null)
                ->get();

            foreach ($rsvps as $rsvp) {
                if ($rsvp->email) {
                    try {
                        Mail::to($rsvp->email)->queue(new EventReminderMail($event, $rsvp));
                        $rsvp->update(['reminded_at' => now()]);
                        $sentCount++;
                    } catch (\Exception $e) {
                        $this->error("Failed to send reminder to {$rsvp->email}: {$e->getMessage()}");
                    }
                }
            }
        }

        $this->info("Sent {$sentCount} event reminders.");
    }
}
