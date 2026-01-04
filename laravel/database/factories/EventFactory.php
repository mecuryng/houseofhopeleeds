<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'time' => $this->faker->time(),
            'location' => $this->faker->address,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}