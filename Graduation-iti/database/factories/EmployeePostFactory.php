<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeePost>
 */
class EmployeePostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(6, true),
            'user_id' => 1,
            'employee_class_id' => rand(1,3),
            'employment_type_id' => rand(1,3),
            'vacancy' => rand(1,5),
            'salary' => $this->faker->randomElement(['Negotiable', '$50,000', '$75,000']),
            'location' => $this->faker->city(),
            'description' => $this->faker->paragraph(),
            'benefits' => $this->faker->sentence(),
            'responsibility' => $this->faker->sentence(),
            'qualifications' => $this->faker->sentence(),
            'keywords' => $this->faker->words(5, true),
            'experience' => $this->faker->sentence(),
            'company_name' => $this->faker->company(),
            'company_location' => $this->faker->address(),
            'company_website' => $this->faker->url(),
        ];
    }
}