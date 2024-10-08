<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lastname' => fake()->lastName(),
            'specialty' => $this->faker->randomElement([
                'Cardiology',
                'Dermatology',
                'Pediatrics',
                'Orthopedics',
                'Psychiatry',
                'Neurology'
            ]),
            'timezone' => $this->faker->timezone(),
            'country' => $this->faker->country(),
            'lunch_break_start' => '12:00',
            'lunch_break_end' => '13:00',
            'block_duration' => 60,
        ];
    }
}
