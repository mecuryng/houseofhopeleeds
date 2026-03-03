<?php

namespace Database\Factories;

use App\Models\Reflection;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReflectionFactory extends Factory
{
    protected $model = Reflection::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraphs(2, true),
            'date' => $this->faker->optional()->date(),
            'user_id' => null,
            'image_path' => null,
        ];
    }
}
