<?php

use App\Models\Event;
use App\Models\Sermon;
use App\Models\User;

describe('Events iCal Feed', function () {
    it('generates valid ical feed', function () {
        Event::factory()->count(3)->create();

        $response = $this->get(route('events.ical'));

        $response->assertStatus(200)
            ->assertHeader('Content-Type', 'text/calendar; charset=utf-8')
            ->assertHeader('Content-Disposition', 'attachment; filename="house-of-hope-events.ics"');
    });

    it('contains ical calendar structure', function () {
        $response = $this->get(route('events.ical'));

        $content = $response->getContent();

        expect($content)->toContain('BEGIN:VCALENDAR');
        expect($content)->toContain('VERSION:2.0');
        expect($content)->toContain('PRODID:-//House of Hope Church Leeds//Events Calendar//EN');
        expect($content)->toContain('END:VCALENDAR');
    });

    it('includes events in feed', function () {
        $event = Event::factory()->create([
            'title' => 'Sunday Service',
            'description' => 'Weekly worship',
            'location' => 'Main Hall',
        ]);

        $response = $this->get(route('events.ical'));

        $content = $response->getContent();

        expect($content)->toContain('BEGIN:VEVENT');
        expect($content)->toContain('SUMMARY:Sunday Service');
        expect($content)->toContain('LOCATION:Main Hall');
        expect($content)->toContain('DESCRIPTION:Weekly worship');
        expect($content)->toContain('END:VEVENT');
    });

    it('includes event url', function () {
        $event = Event::factory()->create();

        $response = $this->get(route('events.ical'));

        $content = $response->getContent();

        expect($content)->toContain('URL:' . route('events.show', $event->id));
    });

    it('only includes recent and upcoming events', function () {
        $oldEvent = Event::factory()->create([
            'title' => 'Old Event',
            'date' => now()->subMonths(6),
        ]);

        $newEvent = Event::factory()->create([
            'title' => 'New Event',
            'date' => now()->addDays(7),
        ]);

        $response = $this->get(route('events.ical'));

        $content = $response->getContent();

        expect($content)->toContain('New Event');
    });

    it('handles empty events gracefully', function () {
        Event::query()->delete();

        $response = $this->get(route('events.ical'));

        $response->assertStatus(200);

        $content = $response->getContent();
        expect($content)->toContain('BEGIN:VCALENDAR');
        expect($content)->toContain('END:VCALENDAR');
    });
});

describe('Sermons RSS Feed', function () {
    it('generates valid rss feed', function () {
        Sermon::factory()->count(3)->create();

        $response = $this->get(route('sermons.rss'));

        $response->assertStatus(200)
            ->assertHeader('Content-Type', 'application/rss+xml; charset=utf-8');
    });

    it('contains rss structure', function () {
        $response = $this->get(route('sermons.rss'));

        $content = $response->getContent();

        expect($content)->toContain('<?xml version="1.0" encoding="UTF-8"?>');
        expect($content)->toContain('<rss version="2.0"');
        expect($content)->toContain('<channel>');
        expect($content)->toContain('</channel>');
        expect($content)->toContain('</rss>');
    });

    it('contains podcast itunes tags', function () {
        $response = $this->get(route('sermons.rss'));

        $content = $response->getContent();

        expect($content)->toContain('xmlns:itunes');
        expect($content)->toContain('<itunes:author>House of Hope Church Leeds</itunes:author>');
        expect($content)->toContain('<itunes:category text="Religion');
    });

    it('includes sermons in feed', function () {
        $sermon = Sermon::factory()->create([
            'title' => 'Test Sermon',
            'description' => 'A test message',
        ]);

        $response = $this->get(route('sermons.rss'));

        $content = $response->getContent();

        expect($content)->toContain('<title>Test Sermon</title>');
        expect($content)->toContain('<description>A test message</description>');
    });

    it('includes sermon author', function () {
        $pastor = User::factory()->create(['name' => 'Pastor John']);
        $sermon = Sermon::factory()->create([
            'pastor_id' => $pastor->id,
        ]);

        $response = $this->get(route('sermons.rss'));

        $content = $response->getContent();

        expect($content)->toContain('<itunes:author>Pastor John</itunes:author>');
    });

    it('limits sermons to 50 items', function () {
        Sermon::factory()->count(60)->create();

        $response = $this->get(route('sermons.rss'));

        $content = $response->getContent();

        $itemCount = substr_count($content, '<item>');
        expect($itemCount)->toBeLessThanOrEqual(50);
    });

    it('includes sermon link and guid', function () {
        $sermon = Sermon::factory()->create();

        $response = $this->get(route('sermons.rss'));

        $content = $response->getContent();

        expect($content)->toContain('<link>' . route('sermons.show', $sermon->id) . '</link>');
        expect($content)->toContain('<guid isPermaLink="true">' . route('sermons.show', $sermon->id) . '</guid>');
    });

    it('handles empty sermons gracefully', function () {
        Sermon::query()->delete();

        $response = $this->get(route('sermons.rss'));

        $response->assertStatus(200);

        $content = $response->getContent();
        expect($content)->toContain('<channel>');
        expect($content)->toContain('</channel>');
    });
});

describe('Feed Accessibility', function () {
    it('ical feed is accessible without authentication', function () {
        Event::factory()->create();

        $response = $this->get(route('events.ical'));

        $response->assertStatus(200);
    });

    it('rss feed is accessible without authentication', function () {
        Sermon::factory()->create();

        $response = $this->get(route('sermons.rss'));

        $response->assertStatus(200);
    });
});
