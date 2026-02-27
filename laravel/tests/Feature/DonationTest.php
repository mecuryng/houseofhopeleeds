<?php

use App\Models\Donation;
use App\Models\User;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->admin = User::factory()->create(['role' => 'admin']);
});

describe('Donation Public Pages', function () {
    it('displays the donate page', function () {
        $response = $this->get(route('donate'));

        $response->assertStatus(200)
            ->assertSee('Giving')
            ->assertSee('Support');
    });
});

describe('Stripe Donation', function () {
    it('validates amount is required', function () {
        $response = $this->postJson(route('donate.stripe.create'), [
            'frequency' => 'one_time',
            'email' => 'donor@example.com',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['amount']);
    });

    it('validates amount is at least 1', function () {
        $response = $this->postJson(route('donate.stripe.create'), [
            'amount' => 0,
            'frequency' => 'one_time',
            'email' => 'donor@example.com',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['amount']);
    });

    it('validates email format', function () {
        $response = $this->postJson(route('donate.stripe.create'), [
            'amount' => 25,
            'frequency' => 'one_time',
            'email' => 'invalid-email',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    });
});

describe('PayPal Donation', function () {
    it('validates paypal amount is required', function () {
        $response = $this->postJson(route('donate.paypal.create'), [
            'frequency' => 'one_time',
            'email' => 'donor@example.com',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['amount']);
    });
});

describe('Stripe Webhook', function () {
    it('rejects webhook with invalid payload', function () {
        $response = $this->postJson(route('webhooks.stripe'), [
            'type' => 'checkout.session.completed',
            'data' => ['object' => []],
        ]);

        $response->assertStatus(200);
    });
});

describe('Admin Donations', function () {
    it('lists donations for admin', function () {
        Donation::factory()->count(3)->create(['status' => 'succeeded']);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.donations.index'));

        $response->assertStatus(200)
            ->assertSee('Donations');
    });

    it('shows single donation details', function () {
        $donation = Donation::factory()->create(['status' => 'succeeded']);

        $response = $this->actingAs($this->admin)
            ->get(route('admin.donations.show', $donation));

        $response->assertStatus(200);
    });

    it('deletes a donation', function () {
        $donation = Donation::factory()->create();

        $response = $this->actingAs($this->admin)
            ->delete(route('admin.donations.destroy', $donation));

        $response->assertRedirect();
        $this->assertDatabaseMissing('donations', ['id' => $donation->id]);
    });

    it('prevents non-admin from accessing donations', function () {
        $member = User::factory()->create(['role' => 'member']);

        $response = $this->actingAs($member)
            ->get(route('admin.donations.index'));

        $response->assertStatus(403);
    });
});
