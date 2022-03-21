<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(rand(15, 25)),
            'content' => $this->faker->realText(rand(50, 70)),
            'person_in_charge' => $this->faker->name(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
