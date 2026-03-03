<?php

namespace Database\Factories;

use App\Models\Dream;
use Illuminate\Database\Eloquent\Factories\Factory;

class DreamFactory extends Factory
{
    protected $model = Dream::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(3, true),
            'user_id' => null, // possible to set later
        ];
    }
}
