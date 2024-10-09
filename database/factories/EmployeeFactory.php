<?php

namespace Database\Factories;

use Carbon\Carbon;
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
        $lunchBreakStartNY = Carbon::createFromTime(12, 0, 0, config('app.timezone'));
        $lunchBreakEndNY = $lunchBreakStartNY->copy()->addHour();
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
            'lunch_break_start' => $lunchBreakStartNY->setTimezone('UTC')->toTimeString(),
            'lunch_break_end' => $lunchBreakEndNY->setTimezone('UTC')->toTimeString(),
            'block_duration' => 60,
        ];
    }
}
