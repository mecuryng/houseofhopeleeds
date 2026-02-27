<?php

namespace Database\Factories;

use App\Models\Donation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    protected $model = Donation::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'provider' => $this->faker->randomElement(['stripe', 'paypal']),
            'provider_id' => $this->faker->uuid(),
            'amount' => $this->faker->randomElement([1000, 2500, 5000, 10000]),
            'currency' => 'gbp',
            'frequency' => $this->faker->randomElement(['one_time', 'monthly']),
            'status' => 'succeeded',
            'email' => $this->faker->safeEmail(),
            'metadata' => [],
        ];
    }

    public function stripe(): static
    {
        return $this->state(fn (array $attributes) => [
            'provider' => 'stripe',
        ]);
    }

    public function paypal(): static
    {
        return $this->state(fn (array $attributes) => [
            'provider' => 'paypal',
        ]);
    }

    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    public function failed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'failed',
        ]);
    }

    public function monthly(): static
    {
        return $this->state(fn (array $attributes) => [
            'frequency' => 'monthly',
        ]);
    }
}
