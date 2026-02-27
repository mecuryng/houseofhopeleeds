<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Sermon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FeedController extends Controller
{
    public function eventsIcal()
    {
        $events = Event::where('date', '>=', now()->subMonths(3))
            ->orderBy('date', 'desc')
            ->get();

        $ical = "BEGIN:VCALENDAR\r\n";
        $ical .= "VERSION:2.0\r\n";
        $ical .= "PRODID:-//House of Hope Church Leeds//Events Calendar//EN\r\n";
        $ical .= "CALSCALE:GREGORIAN\r\n";
        $ical .= "METHOD:PUBLISH\r\n";
        $ical .= "X-WR-CALNAME:House of Hope Church Leeds Events\r\n";
        $ical .= "X-WR-TIMEZONE:Europe/London\r\n";

        foreach ($events as $event) {
            $startDate = $event->date->format('Ymd');
            $endDate = $event->date->addDay()->format('Ymd');
            $startTime = $event->time ? $this->formatIcalTime($event->time) : null;
            $uid = 'event-' . $event->id . '@houseofhopeleeds.org';
            $dtstamp = now()->format('Ymd\THis\Z');
            
            $ical .= "BEGIN:VEVENT\r\n";
            $ical .= "UID:$uid\r\n";
            $ical .= "DTSTAMP:$dtstamp\r\n";
            
            if ($startTime) {
                $ical .= "DTSTART;TZID=Europe/London:{$startDate}T{$startTime}\r\n";
                $endDateTime = $this->calculateEndTime($event->time, 2);
                $ical .= "DTEND;TZID=Europe/London:{$startDate}T{$endDateTime}\r\n";
            } else {
                $ical .= "DTSTART;VALUE=DATE:{$startDate}\r\n";
                $ical .= "DTEND;VALUE=DATE:{$endDate}\r\n";
            }
            
            $ical .= "SUMMARY:" . $this->escapeIcal($event->title) . "\r\n";
            
            if ($event->description) {
                $ical .= "DESCRIPTION:" . $this->escapeIcal($event->description) . "\r\n";
            }
            
            if ($event->location) {
                $ical .= "LOCATION:" . $this->escapeIcal($event->location) . "\r\n";
            }
            
            $ical .= "URL:" . route('events.show', $event->id) . "\r\n";
            $ical .= "STATUS:CONFIRMED\r\n";
            $ical .= "END:VEVENT\r\n";
        }

        $ical .= "END:VCALENDAR\r\n";

        return response($ical)
            ->header('Content-Type', 'text/calendar; charset=utf-8')
            ->header('Content-Disposition', 'attachment; filename="house-of-hope-events.ics"');
    }

    public function sermonsRss()
    {
        $sermons = Sermon::with('pastor')
            ->orderBy('date', 'desc')
            ->limit(50)
            ->get();

        $rss = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $rss .= '<rss version="2.0" xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:content="http://purl.org/rss/1.0/modules/content/">' . "\n";
        $rss .= '<channel>' . "\n";
        $rss .= '<title>House of Hope Church Leeds Sermons</title>' . "\n";
        $rss .= '<link>' . route('sermons') . '</link>' . "\n";
        $rss .= '<description>Inspiring messages and biblical teaching from House of Hope Church Leeds.</description>' . "\n";
        $rss .= '<language>en-gb</language>' . "\n";
        $rss .= '<copyright>&#169; ' . date('Y') . ' House of Hope Church Leeds</copyright>' . "\n";
        $rss .= '<itunes:author>House of Hope Church Leeds</itunes:author>' . "\n";
        $rss .= '<itunes:summary>Inspiring messages and biblical teaching from House of Hope Church Leeds.</itunes:summary>' . "\n";
        $rss .= '<itunes:owner>' . "\n";
        $rss .= '<itunes:name>House of Hope Church Leeds</itunes:name>' . "\n";
        $rss .= '<itunes:email>info@houseofhopeleeds.org</itunes:email>' . "\n";
        $rss .= '</itunes:owner>' . "\n";
        $rss .= '<itunes:category text="Religion &amp; Spirituality">' . "\n";
        $rss .= '<itunes:category text="Christianity"/>' . "\n";
        $rss .= '</itunes:category>' . "\n";
        $rss .= '<itunes:explicit>no</itunes:explicit>' . "\n";
        $rss .= '<itunes:image href="' . asset('Logo.png') . '"/>' . "\n";
        $rss .= '<image>' . "\n";
        $rss .= '<url>' . asset('Logo.png') . '</url>' . "\n";
        $rss .= '<title>House of Hope Church Leeds Sermons</title>' . "\n";
        $rss .= '<link>' . route('sermons') . '</link>' . "\n";
        $rss .= '</image>' . "\n";

        foreach ($sermons as $sermon) {
            $rss .= '<item>' . "\n";
            $rss .= '<title>' . htmlspecialchars($sermon->title) . '</title>' . "\n";
            $rss .= '<link>' . route('sermons.show', $sermon->id) . '</link>' . "\n";
            $rss .= '<description>' . htmlspecialchars($sermon->description ?? '') . '</description>' . "\n";
            $rss .= '<pubDate>' . $sermon->date->toRssString() . '</pubDate>' . "\n";
            $rss .= '<guid isPermaLink="true">' . route('sermons.show', $sermon->id) . '</guid>' . "\n";
            
            if ($sermon->pastor) {
                $rss .= '<itunes:author>' . htmlspecialchars($sermon->pastor->name) . '</itunes:author>' . "\n";
            }
            
            if ($sermon->video_url) {
                $rss .= '<enclosure url="' . htmlspecialchars($sermon->video_url) . '" type="audio/mpeg"/>' . "\n";
            }
            
            $rss .= '<itunes:duration>30:00</itunes:duration>' . "\n";
            $rss .= '</item>' . "\n";
        }

        $rss .= '</channel>' . "\n";
        $rss .= '</rss>';

        return response($rss)
            ->header('Content-Type', 'application/rss+xml; charset=utf-8');
    }

    private function formatIcalTime(string $time): string
    {
        $parsed = date_parse($time);
        return sprintf('%02d%02d00', $parsed['hour'] ?? 0, $parsed['minute'] ?? 0);
    }

    private function calculateEndTime(string $startTime, int $hoursDuration): string
    {
        $parsed = date_parse($startTime);
        $endHour = ($parsed['hour'] ?? 0) + $hoursDuration;
        return sprintf('%02d%02d00', $endHour % 24, $parsed['minute'] ?? 0);
    }

    private function escapeIcal(string $text): string
    {
        $text = str_replace('\\', '\\\\', $text);
        $text = str_replace('"', '\\"', $text);
        $text = str_replace(',', '\\,', $text);
        $text = str_replace(';', '\\;', $text);
        $text = str_replace("\n", '\\n', $text);
        return $text;
    }
}
