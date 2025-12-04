<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\JobVacancy>
 */
class JobVacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraphs(3, true),
            'location' => fake()->city(),
            'company' => fake()->company(),
            'logo' => fake()->imageUrl(200, 200, 'business', true, 'logo'),
            'salary' => fake()->numberBetween(4000000, 20000000),
        ];
    }
}
