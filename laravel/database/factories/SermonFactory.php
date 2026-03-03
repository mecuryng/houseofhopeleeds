<?php

namespace Database\Factories;

use App\Models\Sermon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SermonFactory extends Factory
{
    protected $model = Sermon::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'pastor_id' => User::factory(),
            'video_url' => $this->faker->url,
            'date' => $this->faker->date(),
            'image_path' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}