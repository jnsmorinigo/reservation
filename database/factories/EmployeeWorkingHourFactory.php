<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\WorkingHour;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeWorkingHour>
 */
class EmployeeWorkingHourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $workingHour = WorkingHour::inRandomOrder()->first();

        $employee = Employee::whereNotIn('id', function ($query) use ($workingHour) {
            $query->select('employee_id')
            ->from('employee_working_hours')
            ->where('working_hour_id', $workingHour->id);
        })->inRandomOrder()->first();

        return [
            'employee_id' => $employee->id,
            'working_hour_id' => $workingHour->id,
        ];
    }
}
