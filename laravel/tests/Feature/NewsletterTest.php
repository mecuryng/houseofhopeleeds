<?php

use App\Models\NewsletterSubscriber;
use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => 'admin']);
});

describe('Newsletter Subscription', function () {
    it('subscribes a new email', function () {
        $response = $this->postJson(route('newsletter.subscribe'), [
            'email' => 'new@example.com',
            'name' => 'John Doe',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Thank you for subscribing to our newsletter!',
            ]);

        $this->assertDatabaseHas('newsletter_subscribers', [
            'email' => 'new@example.com',
            'name' => 'John Doe',
            'is_active' => true,
        ]);
    });

    it('handles existing subscriber gracefully', function () {
        NewsletterSubscriber::factory()->create([
            'email' => 'existing@example.com',
            'is_active' => true,
        ]);

        $response = $this->postJson(route('newsletter.subscribe'), [
            'email' => 'existing@example.com',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'You are already subscribed to our newsletter!',
            ]);
    });

    it('resubscribes inactive subscriber', function () {
        NewsletterSubscriber::factory()->inactive()->create([
            'email' => 'inactive@example.com',
        ]);

        $response = $this->postJson(route('newsletter.subscribe'), [
            'email' => 'inactive@example.com',
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);

        $this->assertDatabaseHas('newsletter_subscribers', [
            'email' => 'inactive@example.com',
            'is_active' => true,
        ]);
    });
});

describe('Newsletter Unsubscribe', function () {
    it('unsubscribes an email', function () {
        $subscriber = NewsletterSubscriber::factory()->create([
            'email' => 'subscriber@example.com',
            'is_active' => true,
        ]);

        $response = $this->postJson(route('newsletter.unsubscribe'), [
            'email' => 'subscriber@example.com',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'You have been successfully unsubscribed.',
            ]);

        $this->assertDatabaseHas('newsletter_subscribers', [
            'email' => 'subscriber@example.com',
            'is_active' => false,
        ]);
    });

    it('handles non-existent email gracefully', function () {
        $response = $this->postJson(route('newsletter.unsubscribe'), [
            'email' => 'nonexistent@example.com',
        ]);

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    });

    it('confirms unsubscribe via token', function () {
        $subscriber = NewsletterSubscriber::factory()->create([
            'email' => 'token@example.com',
            'is_active' => true,
        ]);

        $token = base64_encode('token@example.com');

        $response = $this->get(route('newsletter.unsubscribe.confirm', $token));

        $response->assertRedirect();

        $this->assertDatabaseHas('newsletter_subscribers', [
            'email' => 'token@example.com',
            'is_active' => false,
        ]);
    });

    it('handles invalid unsubscribe token', function () {
        $response = $this->get(route('newsletter.unsubscribe.confirm', 'invalid-token'));

        $response->assertRedirect();
    });
});

describe('Admin Newsletter Management', function () {
    it('lists subscribers for admin', function () {
        NewsletterSubscriber::factory()->count(5)->create();

        $response = $this->actingAs($this->admin)
            ->get(route('admin.newsletter.index'));

        $response->assertStatus(200)
            ->assertSee('Newsletter');
    });

    it('filters subscribers by status', function () {
        NewsletterSubscriber::factory()->count(3)->create(['is_active' => true]);
        NewsletterSubscriber::factory()->inactive()->count(2)->create();

        $response = $this->actingAs($this->admin)
            ->get(route('admin.newsletter.index', ['status' => 'active']));

        $response->assertStatus(200);
    });

    it('searches subscribers', function () {
        NewsletterSubscriber::factory()->create(['email' => 'search@example.com']);
        NewsletterSubscriber::factory()->create(['email' => 'other@example.com']);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.newsletter.index', ['search' => 'search']));

        $response->assertStatus(200)
            ->assertSee('search@example.com');
    });

    it('exports subscribers as csv', function () {
        NewsletterSubscriber::factory()->count(3)->create();

        $response = $this->actingAs($this->admin)
            ->get(route('admin.newsletter.export'));

        $response->assertStatus(200)
            ->assertHeader('Content-Type', 'text/csv; charset=utf-8');
    });

    it('soft deletes a subscriber', function () {
        $subscriber = NewsletterSubscriber::factory()->create();

        $response = $this->actingAs($this->admin)
            ->delete(route('admin.newsletter.destroy', $subscriber));

        $response->assertRedirect();
        $this->assertSoftDeleted('newsletter_subscribers', ['id' => $subscriber->id]);
    });

    it('prevents non-admin from accessing newsletter admin', function () {
        $member = User::factory()->create(['role' => 'member']);

        $response = $this->actingAs($member)
            ->get(route('admin.newsletter.index'));

        $response->assertStatus(403);
    });
});

describe('Newsletter Rate Limiting', function () {
    it('rate limits subscription requests', function () {
        for ($i = 0; $i < 4; $i++) {
            $response = $this->postJson(route('newsletter.subscribe'), [
                'email' => "rate{$i}@example.com",
            ]);
        }

        $response->assertStatus(429);
    });
});
