<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkingHour>
 */
class WorkingHourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'day_of_week' => $this->faker->randomElement(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday']),
            'start_time' => $this->faker->time($format = 'H:i', $max = '09:00'),  // Horario de inicio (ejemplo: 09:00)
            'end_time' => $this->faker->time($format = 'H:i', $min = '17:00'),    // Horario de fin (ejemplo: 17:00)
        ];
    }
}
